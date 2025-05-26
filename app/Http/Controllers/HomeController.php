<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use App\Models\jobs;
use App\Models\SavedJobs;
use App\Models\tags;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    //Home Function
    public function Home()
    {
        $data = jobs::orderBy('created_at', 'desc')->paginate(8);

        return view('frontend.index', compact('data'));
    }

    //Profile Function
    public function Profile()
    {
        $data = jobs::where('created_user', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);

        $job_data = Applications::where('applicant_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        $saved_job = SavedJobs::where('applicant_id', Auth::user()->id)->where('saved_status', 1)->orderBy('created_at', 'desc')->paginate(10);


        return view('frontend.userpages.profile', compact('data', 'job_data', 'saved_job'));
    }

    //Create_job
    public function Create_job($id)
    {
        $user = User::findOrFail($id);

        $data = tags::orderBy('created_at', 'desc')->paginate(30);

        if ($user->user_type !== 'Recruiter') {
            Alert::error('Failed', 'Invalid Page');
            return redirect()->back();
        } else {
            return view('frontend.userpages.createjobs', compact('data'));
        }
    }

    //Add_job
    public function Add_job(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string',
            'job_type' => 'required|string',
            'address' => 'required|string',
            'min_salary' => 'required|string',
            'max_salary' => 'required|string',
            'company_name' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'category' => 'required|string',
            'description' => 'required|string',
            'experience' => 'required|string',
        ]);

        $data = new jobs();

        $data->job_title = $request->job_title;
        $data->job_type = $request->job_type;
        $data->address = $request->address;
        $data->min_salary = $request->min_salary;
        $data->max_salary = $request->max_salary;
        $data->applicants_count = 0;
        $data->created_user = Auth::user()->id;
        $data->company_name = $request->company_name;
        $data->city = $request->city;
        $data->country = $request->country;
        $data->category = $request->category;
        $data->description = $request->description;
        $data->experience = $request->experience;


        if ($request->company_logo) {
            $imageName = time() . '_' . $request->company_logo->getClientOriginalName();
            $request->company_logo->move('assets/frontend/uploads', $imageName);
            $data->company_logo = $imageName;
        } else {
            $data->company_logo = 'default2.jpg';
        }

        $data->save();

        // Notify the user that the Job has been successfully added to the database
        Alert::success('Success', 'Job Created successfully');
        return redirect('profile');

        // dd($request->all());
    }

    //Delete_job Function
    public function Delete_job($id)
    {
        $job = jobs::findOrFail($id);

        if ($job->created_user == Auth::user()->id) {

            $job->delete();

            // Notify the user that the Job has been successfully Deleted from the database
            Alert::success('Success', 'Job Deleted successfully');
            return redirect('profile');
        } else {
            Alert::error('Error', 'Server Error');
            return redirect()->back();
        }
    }

    //Edit_job Function
    public function Edit_job($id)
    {
        $job = jobs::findOrFail($id);

        $data = tags::orderBy('created_at', 'desc')->paginate(30);

        if ($job->created_user == Auth::user()->id) {
            return view('frontend.userpages.editjob', compact('data', 'job'));
        } else {
            Alert::error('Error', 'Server Error');
            return redirect()->back();
        }
    }

    //Job_details Function
    public function Job_details($id)
    {
        $data = jobs::findOrFail($id);

        return view('frontend.userpages.job_details', compact('data'));
    }

    //Apply_job Function
    public function Apply_job(Request $request, $id)
    {

        $user_data = User::where('id', Auth::user()->id)->first();
        $Job_data = jobs::where('id', $id)->first();

        $application_data = Applications::where('job_id', $id)->first();


        if ($application_data) {
            if ($application_data->applicant_id == Auth::user()->id) {
                Alert::error('Error', 'You have already applied for this job');
                return redirect()->back();
            }
        }

        if (!$user_data->cv) {
            Alert::error('Error', 'Please Upload your Curriculum vitae through your profile and try again');
            return redirect()->back();
        } else {

            $request->validate([
                'cover_later' => 'required',
            ]);

            $data = new Applications();

            if ($request->cover_later) {
                $uniqueFileName = uniqid() . $request->cover_later->getClientOriginalName();
                $request->cover_later->move('assets/frontend/uploads', $uniqueFileName);
                $data->cover_later = $uniqueFileName;
            }

            $data->applicant_id = Auth::user()->id;
            $data->job_id = $id;
            $data->job_poster_id = $Job_data->created_user;
            $data->Cv = $user_data->cv;
            $data->application_status = 0;

            $data->job_title = $Job_data->job_title;
            $data->job_type = $Job_data->job_type;
            $data->address = $Job_data->address;
            $data->min_salary = $Job_data->min_salary;
            $data->max_salary = $Job_data->max_salary;
            $data->company_name = $Job_data->company_name;
            $data->city = $Job_data->city;
            $data->country = $Job_data->country;
            $data->category = $Job_data->category;
            $data->experience = $Job_data->experience;
            $data->company_logo = $Job_data->company_logo;


            $applicants_count_no = $Job_data->applicants_count + 1;

            $Job_data->applicants_count = $applicants_count_no;

            $Job_data->save();

            $data->save();

            Alert::success('Success', 'Application Sent');
            return redirect()->back();
        }
    }

    //Save_job Function
    public function Save_job($id)
    {
        $Job_data = jobs::where('id', $id)->first();

        $application_data = SavedJobs::where('job_id', $id)->first();


        if ($application_data) {
            if ($application_data->applicant_id == Auth::user()->id) {
                Alert::error('Error', 'You have already saved this job');
                return redirect()->back();
            }
        }

        $data = new SavedJobs();

        $data->applicant_id = Auth::user()->id;
        $data->job_id = $id;
        $data->job_poster_id = $Job_data->created_user;

        $data->saved_status = 1;

        $data->job_title = $Job_data->job_title;
        $data->job_type = $Job_data->job_type;
        $data->address = $Job_data->address;
        $data->min_salary = $Job_data->min_salary;
        $data->max_salary = $Job_data->max_salary;
        $data->company_name = $Job_data->company_name;
        $data->city = $Job_data->city;
        $data->country = $Job_data->country;
        $data->category = $Job_data->category;
        $data->experience = $Job_data->experience;
        $data->company_logo = $Job_data->company_logo;

        $data->save();

        Alert::success('Success', 'Job Saved');
        return redirect()->back();
    }

    //Unsave_job Function
    public function Unsave_job($id)
    {

        $job = SavedJobs::findOrFail($id);

        if ($job->applicant_id == Auth::user()->id) {

            $job->delete();

            // Notify the user that the Saved Job has been successfully Deleted from the database
            Alert::success('Success', 'Job Removed From Saved Directory');
            return redirect('profile');
        } else {
            Alert::error('Error', 'Server Error');
            return redirect()->back();
        }
    }


    //Update_job Function
    public function Update_job($id, Request $request)
    {
        $data = jobs::findOrFail($id);

        if ($data->created_user == Auth::user()->id) {

            $request->validate([
                'job_title' => 'required|string',
                'job_type' => 'required|string',
                'address' => 'required|string',
                'min_salary' => 'required|string',
                'max_salary' => 'required|string',
                'company_name' => 'required|string',
                'city' => 'required|string',
                'country' => 'required|string',
                'category' => 'required|string',
                'description' => 'required|string',
                'experience' => 'required|string',
            ]);


            $data->job_title = $request->job_title;
            $data->job_type = $request->job_type;
            $data->address = $request->address;
            $data->min_salary = $request->min_salary;
            $data->max_salary = $request->max_salary;

            $data->company_name = $request->company_name;
            $data->city = $request->city;
            $data->country = $request->country;
            $data->category = $request->category;
            $data->description = $request->description;
            $data->experience = $request->experience;


            if ($request->company_logo) {
                $imageName = time() . '_' . $request->company_logo->getClientOriginalName();
                $request->company_logo->move('assets/frontend/uploads', $imageName);
                $data->company_logo = $imageName;
            }

            $data->save();

            // Notify the user that the Job has been successfully updated in the database
            Alert::success('Success', 'Job Update successfully');
            return redirect('profile');
        } else {
            Alert::error('Error', 'Server Error');
            return redirect()->back();
        }
    }
}
