<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use App\Models\jobs;
use App\Models\Settings;
use App\Models\tags;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    //Admin Dashboard
    public function Admin_dashboard()
    {
        $job_seeker = User::where('user_type', 'Job Seeker')->orderBy('created_at', 'desc')->paginate(30);
        $job_seeker_no = User::where('user_type', 'Job Seeker')->count();

        $recruter = User::where('user_type', 'Recruiter')->orderBy('created_at', 'desc')->paginate(30);
        $recruter_no = User::where('user_type', 'Recruiter')->count();

        $admin = User::where('user_type', 'ad046js')->orderBy('created_at', 'desc')->paginate(30);
        $admin_no = User::where('user_type', 'ad046js')->count();

        $all_users = User::orderBy('created_at', 'desc')->count();

        $tags_no = tags::orderBy('created_at', 'desc')->count();

        $jobs = jobs::orderBy('created_at', 'desc')->count();

        $pending_app = Applications::where('status', '0')->count();

        $accepted_app = Applications::where('status', '2')->count();

        return view('backend.index', compact('job_seeker', 'job_seeker_no', 'recruter', 'recruter_no', 'admin', 'admin_no', 'all_users', 'tags_no', 'pending_app', 'accepted_app', 'jobs'));
    }

    //Create_category
    public function Create_category()
    {
        return view('backend.pages.createcategory');
    }

    //Add_category
    public function Add_category(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
        ]);

        $data  = new tags();

        //Checks if the category already exist b4 adding to the database
        $category =  tags::where('category', $request->category)->exists();

        if ($category) {
            Alert::error('Failed', 'category already exist');
            return redirect()->back();
        } else {
            $data->category = $request->category;

            $data->save();

            // Notify the user that the Category has been successfully added to the database
            Alert::success('Success', 'Category Created successfully');
            // return redirect('login');
            return redirect('all_category');
        }
    }


    //All_category
    public function All_category()
    {
        $data = tags::orderBy('created_at', 'desc')->paginate(30);

        return view('backend.pages.allcategory', compact('data'));
    }

    //All_users
    public function All_users()
    {
        $data = User::orderBy('created_at', 'desc')->get();

        return view('backend.pages.users', compact('data'));
    }

    //job_seeker
    public function Job_seeker()
    {
        $data = User::where('user_type', 'Job Seeker')->orderBy('created_at', 'desc')->get();

        return view('backend.pages.job_seeker', compact('data'));
    }

    //recriuter
    public function Recruiter()
    {
        $data = User::where('user_type', 'Recruiter')->orderBy('created_at', 'desc')->get();

        return view('backend.pages.recriuter', compact('data'));
    }

    //admin
    public function Admin()
    {
        $data = User::where('user_type', 'ad046js')->orderBy('created_at', 'desc')->get();

        return view('backend.pages.admin', compact('data'));
    }

    //jobs
    public function Jobs()
    {
        $data = jobs::orderBy('created_at', 'desc')->get();

        return view('backend.pages.jobs', compact('data'));
    }

    //applications
    public function Applications()
    {
        $data = Applications::orderBy('created_at', 'desc')->get();

        return view('backend.pages.applications', compact('data'));
    }

    //Edit_category
    public function Edit_category($id)
    {

        $data = tags::findOrFail($id);

        if ($data) {
            return view('backend.pages.updatecategory', compact('data'));
        } else {
            return redirect()->back();
            Alert::error('Failed', 'Inavlid Entry');
        }
    }

    //Update_category
    public function Update_category($id, Request $request)
    {
        $request->validate([
            'category' => 'required|string',
        ]);

        $data = tags::findOrFail($id);

        //checks if the category already exist && != any other category in the database b4 adding to database
        $category = tags::where('category', $request->category)->exists();

        if ($category && $data->category !== $request->category) {

            Alert::error('Registration Failed', 'Category already exist');
            return redirect()->back();
        } else {
            $data->category = $request->category;

            $data->save();

            // Notify the user that the Category has been successfully updated in the database
            Alert::success('Success', 'Category Updated successfully');
            return redirect('all_category');
        }
    }

    //Delete_category
    public function Delete_category($id)
    {
        $tag = tags::findOrFail($id);

        $tag->delete();

        // Notify the user that the Category has been successfully Deleted from the database
        Alert::success('Success', 'Category Deleted successfully');
        return redirect('all_category');
    }

    //delete_user
    public function Delete_user($id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->user_type === 'ad046js') {

            $user->delete();

            // Notify the user that the user has been successfully Deleted from the database
            Alert::success('Success', 'User Deleted successfully');
            return redirect()->back();
        } else {
            Alert::error('Error', 'Access Denied');
            return redirect()->back();
        }
    }

    //delete_job
    public function Delete_job($id)
    {
        $job = jobs::findOrFail($id);

        $data = Applications::where('job_id', $id)->get();

        if (Auth::user()->user_type === 'ad046js') {

            foreach ($data as $item) {
                $item->delete();
            }

            $job->delete();

            // Notify the user that the job has been successfully Deleted from the database
            Alert::success('Success', 'Job Deleted successfully');
            return redirect()->back();
        } else {
            Alert::error('Error', 'Access Denied');
            return redirect()->back();
        }
    }

    //settings finction
    public function Settings()
    {

        $data = Settings::findOrFail('1');

        return view('backend.pages.settings', compact('data'));
    }

    //save_settings finction
    public function Save_settings($id, Request $request)
    {

        $data = Settings::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'logo_name' => 'required|string',
            'email' => 'required|string',
            'address' => 'required|string',
            'phone_no' => 'required|string',
            'seo' => 'required|string',
            'about' => 'required|string',
        ]);

        $data->about = $request->about;
        $data->seo = $request->seo;
        $data->phone_no = $request->phone_no;
        $data->address = $request->address;
        $data->email = $request->email;
        $data->logo_name = $request->logo_name;
        $data->title = $request->title;

        if ($request->fave_icon) {
            $imageName = time() . '_' . $request->fave_icon->getClientOriginalName();
            $request->fave_icon->move('assets/frontend/uploads', $imageName);
            $data->fave_icon = $imageName;
        }

        $data->save();

        Alert::success('Saved', 'Settings Updated');
        return redirect()->back();
    }
}
