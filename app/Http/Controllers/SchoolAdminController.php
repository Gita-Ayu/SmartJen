<?php

namespace App\Http\Controllers;

use App\Models\SchoolAdminModel;
use App\Models\SchoolUserModel;
use App\Http\Requests\SchoolAdminValidator;
use App\Http\Requests\SchoolUserValidator;
use App\Mail\UserInvitationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SchoolAdminController extends Controller
{
    /**
     * Fetch admin dashboard home.
     *
     * @param  n/a
     * @return Laravel view()
     */

    public function index()
    {
        if(!Auth::guard('school')->check())
            return redirect()->route('admin.login');

        $teachers = DB::table('school_users')
                ->where('school_admin_id','=',Auth::guard('school')->id())
                ->where('user_role','=','teacher')
                ->get();

        $students = DB::table('school_users')
                ->where('school_admin_id','=',Auth::guard('school')->id())
                ->where('user_role','=','student')
                ->get();

        return view('admin.home',
            [
                'title'=>'Admin Dashboard',
                'teachers'=>$teachers,
                'students'=>$students
            ]);
    }

    /**
     * Fetch admin login form.
     *
     * @param  n/a
     * @return laravel view()
     */

    public function login()
    {
        if(Auth::guard('school')->check())
        {
            session()->flash('message','You are already logged in');
            return view('admin.message',['title'=>'Already logged in']);
        }
        else return view('admin.login',['title'=>'Login']);
    }

    /**
     * Fetch school admin signup form.
     *
     * @param  n/a
     * @return laravel view()
     */
    public function signup()
    {
        return view('admin.signup',['title'=>'Signup']);
    }

    /**
     * Store newly created school account data into the database.
     *
     * @param  SchoolAdminValidator $request
     * @return Laravel view() for admin message.
     */

    public function register(SchoolAdminValidator $request)
    {
        $validated = $request->validated();
        $validated['school_admin_id'] = ranum(12);
        $validated['password'] = Hash::make($validated['password']);

        SchoolAdminModel::create($validated);

        session()->flash('message','You are signed-up');
        return view('admin.message',['title'=>'Signed Up']);
    }

    /**
     * Delete a user record from the database.
     *
     * @param  User id `school_users`.`user_id`
     * @return Laravel view() for admin message.
     */

    public function delete($id)
    {
        if(!Auth::guard('school')->check())
            return redirect()->route('admin.login');

        $user = SchoolUserModel::find($id);
        $user->delete();

        session()->flash('message','User is deleted');
        return view('admin.message',['title'=>'User deleted']);
    }

    /**
     * Fetch user editing page with the form
     *
     * @param  Unique user id `school_users`.`user_id`
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        if(!Auth::guard('school')->check())
            return redirect()->route('admin.login');

        $user = SchoolUserModel::find($id);
        return view('admin.user_edit',
            [
                'Title' => 'Edit '.$user->user_name,
                'user'  => $user
            ]);
    }

    /**
     * Update a user record in the database.
     *
     * @param  Resource SchoolUserValidator $request, unique user id `school_users`.`user_id`
     * @return Laravel view() for admin message.
     */

    public function update(SchoolUserValidator $request, $id)
    {
        if(!Auth::guard('school')->check())
            return redirect()->route('admin.login');

        $user = SchoolUserModel::findOrFail($id);
        Rule::unique('school_users')->ignore($user->id,'user_id');

        $validated = $request->validated();
        $user->fill($validated);
        $user->save();

        $request->session()->flash('status','User is updated');
        return view('admin.message',['title'=>'User updated']);
    }

    /**
     * Fetch user invitation form.
     *
     * @param  n/a
     * @return Laravel view()
     */

    public function invitationForm()
    {
        if(!Auth::guard('school')->check())
            return redirect()->route('admin.login');

        return view('admin.user_invitation',['title'=>'Signup']);
    }

    /**
     * Store the user data into the database.
     * Generate the invitation email and send
     * it to the recipient.
     *
     * @param  Resource class SchoolUserValidator and $request
     * @return Generated email view.
     */

    public function invitationRegistration(SchoolUserValidator $request)
    {
        if(!Auth::guard('school')->check())
            return redirect()->route('admin.login');

        $password = Str::random(12);

        $validated = $request->validated();
        $validated['user_id'] = ranum(12);
        $validated['school_admin_id'] = Auth::guard('school')->id();
        $validated['password'] = Hash::make($password);

        SchoolUserModel::create($validated);

        $validated['school_name'] = Auth::guard('school')->user()->school_name;
        $validated['unhashed'] = $password;
        $validated['url'] = route('users.login');

        $email = new UserInvitationMail($validated);
        Mail::to($validated['user_email'])->send($email);
        return $email->build();
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
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('school')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin');
        }
        else
        {
            session()->flash('message','Please provide correct credentials');
            return view('admin.message',['title'=>'Unable to login']);
        }
    }
    /**
     * Logs the user out.
     *
     * @param  n/a
     * @return Laravel view() for admin message.
     */

    public function logout()
    {
        Auth::guard('school')->logout();
        session()->flash('message','You are logged out');
        return view('admin.message',['title'=>'You are successfully logged out. You need to login to use the dashboard again.']);
    }

    public function chat($id)
    {
        if(!Auth::guard('school')->check())
            return redirect()->route('admin.login');

        $user = SchoolUserModel::findOrFail($id);
        return view('admin.chat',['title'=>'Chat with '.$user->user_name,'user'=>$user]);
    }
}
