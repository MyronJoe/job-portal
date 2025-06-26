<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use App\Models\jobs;
use App\Models\Messages;
use App\Models\SavedJobs;
use App\Models\tags;
use App\Models\User;
use App\Notifications\JobNotification;
use Illuminate\Console\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    //Home Function
    public function Home()
    {
        $data = jobs::orderBy('created_at', 'desc')->paginate(6);

        $tags2 = tags::orderBy('created_at', 'asc')->paginate(6);

        return view('frontend.index', compact('data', 'tags2'));
    }

    //Categories Function
    public function Categories()
    {
        $data = tags::orderBy('created_at', 'desc')->get();

        $count = tags::orderBy('created_at', 'desc')->count();

        return view('frontend.userpages.categories', compact('data', 'count'));
    }

    //View_more Function
    public function View_more()
    {
        $data = jobs::orderBy('created_at', 'desc')->get();

        $count = jobs::orderBy('created_at', 'desc')->count();

        return view('frontend.userpages.morejobs', compact('data', 'count'));
    }

    //Saved_jobs Function
    public function Saved_jobs()
    {
        $data = SavedJobs::where('applicant_id', Auth::user()->id)->where('saved_status', 1)->orderBy('created_at', 'desc')->get();

        $count = SavedJobs::where('applicant_id', Auth::user()->id)->where('saved_status', 1)->orderBy('created_at', 'desc')->count();

        return view('frontend.userpages.morejobs', compact('data', 'count'));
    }

    //Applied_jobs Function
    public function Applied_jobs()
    {
        $data = Applications::where('applicant_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        $count = Applications::where('applicant_id', Auth::user()->id)->orderBy('created_at', 'desc')->count();

        return view('frontend.userpages.morejobs', compact('data', 'count'));
    }

    //Created_jobs Function
    public function Created_jobs()
    {
        $data = jobs::where('created_user', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        $count = jobs::where('created_user', Auth::user()->id)->orderBy('created_at', 'desc')->count();

        return view('frontend.userpages.morejobs', compact('data', 'count'));
    }

    //Category Jobs Function
    public function Category($id)
    {
        $data = jobs::where('category', $id)->orderBy('created_at', 'desc')->get();

        $count = jobs::where('category', $id)->count();

        return view('frontend.userpages.morejobs', compact('data', 'count'));
    }

    //Profile Function
    public function Profile()
    {
        $data = jobs::where('created_user', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        $job_data = Applications::where('applicant_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(6);

        $saved_job = SavedJobs::where('applicant_id', Auth::user()->id)->where('saved_status', 1)->orderBy('created_at', 'desc')->paginate(6);

        $message_no = Messages::where('applicant_id', Auth::user()->id)->count();


        return view('frontend.userpages.profile', compact('data', 'job_data', 'saved_job', 'message_no'));
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

            $saved_job = SavedJobs::where('job_id', $id)->get();

            $applied_job = Applications::where('job_id', $id)->get();

            foreach ($saved_job as $item) {
                $item->delete();
            }

            foreach ($applied_job as $item2) {
                $item2->delete();
            }

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

        $application_data = Applications::where('job_id', $id)->get();


        if ($application_data) {

            foreach ($application_data as $item) {

                // dd($item->applicant_id);

                if ($item->applicant_id == Auth::user()->id) {
                    Alert::error('Error', 'You have already applied for this job');
                    return redirect()->back();
                }
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
            $data->applicant_email = Auth::user()->email;
            $data->applicant_name = Auth::user()->name;
            $data->applicant_about = Auth::user()->about;
            $data->status = '0';
            $data->applicant_profile_pic = Auth::user()->profile_pic;
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

            $mailer = Auth::user();

            $details = [
                'greeting' => 'Dear ' . Auth::user()->name,

                'first_line' => 'The Recruiting Team ' . $Job_data->company_name,

                'body' => "You have successfully submitted your application for the following position: "
                    .$Job_data->job_title.
                ", Someone will review your qualifications shortly. If your profile meets our requirements, we will contact you to discuss the next steps in the application process.",

                'next_last_line' => 'Thank you for your interest in ' . $Job_data->company_name,

                'last_line' => 'Sincerely, © ' . $Job_data->company_name,
            ];

            // Notification::send($mailer, new JobNotification($details));

            Alert::success('Success', 'Application Sent');
            return redirect()->back();
        }
    }

    //Save_job Function
    public function Save_job($id)
    {
        $Job_data = jobs::where('id', $id)->first();

        $application_data = SavedJobs::where('job_id', $id)->get();

        if ($application_data) {

            foreach ($application_data as $item) {

                if ($item->applicant_id == Auth::user()->id) {
                    Alert::error('Error', 'You have already saved this job');
                    return redirect()->back();
                }
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

    //Job Applications
    public function Job_applications($id)
    {

        $data = Applications::where('job_id', $id)->orderBy('created_at', 'desc')->paginate(20);

        return view('frontend.userpages.applications', compact('data'));
    }

    //View Job Applications
    public function view_application($id)
    {

        $data = Applications::findOrFail($id);

        // dd($id);

        return view('frontend.userpages.view_applications', compact('data'));
    }

    //Accept_application
    public function Accept_application($id)
    {

        $data = Applications::findOrFail($id);

        $message = new Messages();

        $message->message = 'Congratulation!!! ' . $data->applicant_name;

        $message->measage_body = "
        I am writing to formally inform you that your application for " . $data->job_title . " at " . $data->company_name . " have been reviewed and we're pleased to announce to you that you have been selected for the role of " . $data->job_title . " at " . $data->company_name . "
        We are thrilled to have you join our team and contribute to the company's success.
        Other details will be communicated to you via your provided email address.
        
        Thank you!.";

        $message->meassage_footer = 'Sincerly, ' . $data->company_name;

        $message->applicant_id = $data->applicant_id;

        $message->applicant_name = $data->applicant_name;

        $message->job_id = $data->job_id;

        $message->company_name = $data->company_name;

        $message->application_id = $data->id;

        $message->job_title = $data->job_title;

        $message->company_logo = $data->company_logo;

        $message->status = '2';

        $data->status = '2';

        $message->save();

        $data->save();

        Alert::success('Success', 'Job Accepted');
        return redirect('profile');
    }

    //Reject_application
    public function Reject_application($id)
    {

        $data = Applications::findOrFail($id);

        $message = new Messages();

        $message->message = 'Dear ' . $data->applicant_name;

        $message->measage_body = "I trust this message finds you well. Thank you for your interest in the " . $data->job_title . " at " . $data->company_name . ". We appreciate the time and effort you invested in the application process.

After careful consideration, we regret to inform you that we have chosen to move forward with other candidates for this particular " . $data->job_title . " opportunity. The decision was not easy, as we received many qualified applications.

We genuinely appreciate your interest in joining " . $data->company_name . ", and we encourage you to explore other opportunities that align with your skills and career goals. We believe that your skills and experiences will undoubtedly contribute to your future success.

Thank you once again for considering " . $data->company_name . ", and we wish you the best in all your future endeavors.";

        $message->meassage_footer = 'Best Regards, ' . $data->company_name;

        $message->applicant_id = $data->applicant_id;

        $message->applicant_name = $data->applicant_name;

        $message->job_id = $data->job_id;

        $message->company_name = $data->company_name;

        $message->application_id = $data->id;

        $message->job_title = $data->job_title;

        $message->company_logo = $data->company_logo;

        $message->status = '1';

        $message->save();

        $data->delete();

        Alert::success('Success', 'Job Rejected');
        return redirect('profile');
    }

    //Get_messages
    public function Get_messages()
    {

        $data = Messages::where('applicant_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $message_no = Messages::where('applicant_id', Auth::user()->id)->count();

        return view('frontend.userpages.messages', compact('data', 'message_no'));
    }

    //View_message
    public function View_message($id)
    {

        $data = Messages::findOrFail($id);

        $message_no = Messages::where('applicant_id', Auth::user()->id)->count();

        return view('frontend.userpages.view_message', compact('data', 'message_no'));
    }

    //Delete_message
    public function Delete_message($id)
    {
        $data = Messages::findOrFail($id);

        $check_owner = $data->applicant_id == Auth::user()->id;

        if ($check_owner) {

            $data->delete();

            Alert::success('Success', 'Message  Deleted');
            return redirect('get_messages');
        } else {
            Alert::error('Denied', 'Server Down');
            return redirect()->back();
        }
    }

    //Delete_application
    public function Delete_application($id)
    {
        $data = Applications::findOrFail($id);

        $check_owner = $data->applicant_id == Auth::user()->id;

        $job_data = jobs::where('id', $data->job_id)->first();

        $h = $job_data->applicants_count + -1;

        if ($check_owner) {

            $data->delete();

            $job_data->applicants_count = $h;

            $job_data->save();

            Alert::success('Success', 'Application  Deleted');
            return redirect('profile');
        } else {
            Alert::error('Denied', 'Server Not Responding');
            return redirect()->back();
        }
    }

    //SearchTerm
    public function SearchTerm(Request $request)
    {

        $input1 = $request->keyword;

        $input2 = $request->country;

        if ($input1 AND !$input2) {
            $jobs = jobs::where('category', 'like', '%' . $input1 . '%')->get();

            $count = jobs::where('category', 'like', '%' . $input1 . '%')->count();

            if ($jobs) {

                $data = $jobs;

                return view('frontend.userpages.morejobs', compact('data', 'count'));
            } else {
                Alert::error('Denied', 'No Data Found');
                return redirect()->back();
            }

        }elseif($input2 AND !$input1){

            $jobs = jobs::where('country', 'like', '%' . $input2 . '%')->get();

            $count = jobs::where('country', 'like', '%' . $input2 . '%')->count();

            if ($jobs) {

                $data = $jobs;

                return view('frontend.userpages.morejobs', compact('data', 'count'));
            } else {
                Alert::error('Denied', 'No Data Found');
                return redirect()->back();
            }
        }elseif($input2 AND $input1){

            $jobs = jobs::where('country', 'like', '%' . $input2 . '%')->where('category', 'like', '%' . $input1 . '%')->get();

            $count = jobs::where('country', 'like', '%' . $input2 . '%')->where('category', 'like', '%' . $input1 . '%')->count();

            if ($jobs) {

                $data = $jobs;

                return view('frontend.userpages.morejobs', compact('data', 'count'));
            } else {
                Alert::error('Denied', 'No Data Found');
                return redirect()->back();
            }
        }else{
           return redirect()->back(); 
        }

        // dd($data);
    }
}
