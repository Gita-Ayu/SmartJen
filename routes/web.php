<?php

use App\Events\MyEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolAdminController;
use App\Http\Controllers\SchoolUserController;
use App\Mail\UserInvitationMail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home',['title','Welcome!']);}
    )->name('web.home');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| All the routes handling school admin functionalities
|
*/

Route::get('admin',[SchoolAdminController::class,'index'])->name('admin.home');
Route::get('admin/signup', [SchoolAdminController::class,'signup'])->name('admin.signup');
Route::get('admin/login',  [SchoolAdminController::class,'login'])->name('admin.login');
Route::get('admin/logout', [SchoolAdminController::class,'logout'])->name('admin.logout');
Route::post('admin/register',[SchoolAdminController::class,'register'])->name('admin.register');
Route::post('admin/authenticate',[SchoolAdminController::class,'authenticate'])->name('admin.authenticate');

Route::get('admin/user/delete/{id?}', [SchoolAdminController::class,'delete'])->where(['id'=>'[0-9]{12}'])->name('admin.user.delete');
Route::get('admin/user/edit/{id?}',[SchoolAdminController::class,'edit'])->where(['id'=>'[0-9]{12}'])->name('admin.user.edit');
Route::put('admin/user/update/{id?}', [SchoolAdminController::class,'update'])->name('admin.user.update');
Route::get('admin/user/invitation', [SchoolAdminController::class,'invitationForm'])->name('admin.user.invitation');
Route::post('admin/user/registration', [SchoolAdminController::class,'invitationRegistration'])->name('admin.user.register');

Route::get('admin/user/email',function(){
    return new UserInvitationMail;
});
Route::get('admin/user/send-email',[SchoolAdminController::class,'sendUserInvitation'])->name('admin.user.sendemail');

Route::get('admin/user/chat/test',function(){
    return view('admin.chat_test');
});
Route::get('admin/user/chat/{id?}',[SchoolAdminController::class,'chat'])->name('admin.user.chat');

Route::post('pusher', function (Request $request) {
    event(new MyEvent($request->input('message'),
        [
            'channel' =>$request->input('channel'),
            'event'   =>$request->input('event')
        ]));
})->name('pusher');

Route::get('users',[SchoolUserController::class,'index'])->name('users.home');
Route::get('users/login', [SchoolUserController::class,'login'])->name('users.login');
Route::get('users/logout', [SchoolUserController::class,'logout'])->name('users.logout');
Route::get('users/chat', [SchoolUserController::class,'chat'])->name('users.chat');

Route::post('users/authenticate',[SchoolUserController::class,'authenticate'])->name('users.authenticate');



