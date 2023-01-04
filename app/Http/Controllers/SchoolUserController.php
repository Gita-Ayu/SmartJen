<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolUserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\SchoolAdminModel;
class SchoolUserController extends Controller
{
    /**
     * Fetch user dashboard home.
     *
     * @param  n/a
     * @return Laravel view()
     */

    public function index()
    {
        if(!Auth::guard('users')->check())
            return redirect()->route('users.login');

        $school = SchoolAdminModel::findOrFail(Auth::guard('users')->user()->school_admin_id);

        return view('users.home',['title'=>'Smartjen','school'=>$school]);
    }

    /**
     * Fetch user login form.
     *
     * @param  n/a
     * @return laravel view()
     */

    public function login()
    {
        if(Auth::guard('users')->check())
        {
            session()->flash('message','You are already logged in');
            return view('users.message',['title'=>'Already logged in']);
        }
        else return view('users.login',['title'=>'Login']);
    }

    /**
     * Authenticate the login data.
     *
     * @param  Request $request
     * @return Laravel view() depending on the condition.
     */

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'user_email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::guard('users')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('users');
        }
        else
        {
            session()->flash('message','Please provide correct credentials');
            return view('users.message',['title'=>'Unable to login']);
        }
    }

    /**
     * Logs admin out.
     *
     * @param  n/a
     * @return Laravel view() for admin message.
     */

    public function logout()
    {
        Auth::guard('users')->logout();
        session()->flash('message','You are logged out');
        return view('users.message',['title'=>'You are successfully logged out. You need to login to use the dashboard again.']);
    }

    public function chat()
    {
        //dd(Auth::guard('users')->id());
        $admin = SchoolAdminModel::findOrFail(Auth::guard('users')->user()->school_admin_id);

        return view('users.chat',['title'=>'Chat with admin','admin'=>$admin]);
    }

}
