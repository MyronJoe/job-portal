<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //Redirect Logged-in user function
    public function __construct()
    {
        $this->middleware('guest')->only(['Login', 'Register', 'LoginUser', 'RegisterUser']);
    }

    //Login Function
    public function Login()
    {

        return view('frontend.webpages.login');
    }

    //Register Function
    public function Register()
    {

        return view('frontend.webpages.register');
    }

    //Register-User Function
    public function RegisterUser(Request $request)
    {
        $profilePicture = 'default.jpg';

        //validate user form
        $request->validate([
            'username' => 'required|string',
            'user_type' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:8',
            'confirm-password' => 'required_with:password|same:password|min:8|string'
        ]);

        //Checks if the user already exist b4 adding to the database
        $email =  User::where('email', $request->email)->exists();

        $data  = new User();

        if ($email) {
            Alert::error('Registration Failed', 'email already exist');
            return redirect()->back();
        } else {

            $data->name = $request->username;
            $data->email = $request->email;
            $data->user_type = $request->user_type;
            $data->profile_pic = $profilePicture;
            $data->password = Hash::make($request->password);

            $data->save();

            // Notify the user that the Account has been successfully added to the database
            Alert::success('Account Created successfully', 'user can now login');
            return redirect('login');
        }
    }

    //Login-User Function
    public function LoginUser(Request $request)
    {
        //validate Login form
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/');
        } else {
            Alert::error('Login Failed', 'Invalid Credentials');
            return redirect()->back();
        }
    }

    //Logout-User Function
    public function LogoutUser()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    //User Settings Function
    public function User_settings($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            return view('frontend.userpages.settings', compact('user'));
        } else {
            return redirect('/');
        }
    }

    //User Settings Function
    public function User_update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'about' => 'required|string',
        ]);

        $user = User::findOrFail($request->userId);

        //checks if the email already exist && != any other email in the database b4 adding to database
        $email = User::where('email', $request->email)->exists();

        if ($email && $user->email !== $request->email) {

            Alert::error('Registration Failed', 'email already exist');
            return redirect()->back();
        } else {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->about = $request->about;

            if ($request->profile_pic) {
                $imageName = time() . '_' . $request->profile_pic->getClientOriginalName();
                $request->profile_pic->move('assets/frontend/uploads', $imageName);
                $user->profile_pic = $imageName;
            }

            if ($request->cv) {
                $uniqueFileName = uniqid() . $request->cv->getClientOriginalName();
                $request->cv->move('assets/frontend/uploads', $uniqueFileName);
                $user->cv = $uniqueFileName;
            }

            $user->save();

            Alert::success('Update Successful', 'User Updated');
            return redirect('profile');
        }
    }
}
