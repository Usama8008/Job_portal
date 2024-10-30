<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use App\Http\Middleware\adminMiddleware;
use App\Http\Controllers\admin\jobController;
use App\Http\Controllers\admin\userController;
use App\Http\Controllers\admin\adminController;

// Route::get('/', function () {
//     return view('welcome');
// });
 Route::get('/',[HomeController::class, 'home'])->name('home');
 Route::get('/jobs',[JobsController::class, 'findjobs'])->name('find.job');
 Route::get('/job-Details/{id}',[JobsController::class, 'jobDetails'])->name('job.details');
 Route::post('/apply-job/{id}',[JobsController::class, 'applyJob'])->name('job.apply');
 Route::get('/apply-job/{id}', function () {
   abort(404); // Return a 404 error for GET requests
});
// this will save the job 
Route::post('/save-job/{id}',[JobsController::class, 'savejob'])->name('job.save');
  
// admin panel routes--------------------------
Route::group(['prefix'=>'admin','middleware'=>adminMiddleware::class], function(){
      Route::get('/dashboard',[adminController::class,'dashboard'])->name('admin.dashboard');
      // this will fetch all users 
      Route::get('/users',[userController::class,'users'])->name('admin.users');
      Route::get('/user/{id}/edit',[userController::class,'editUser'])->name('admin.user.edit');
      Route::post('/user/{id}/update',[userController::class,'updateUser'])->name('admin.user.update');
      Route::get('/user/{id}/delete',[userController::class,'destroy'])->name('admin.user.delete');
      
      // this will fetch all jobs 
      Route::get('/jobs',[jobController::class,'jobs'])->name('admin.jobs');
      Route::get('/jobs/{id}/edit',[jobController::class,'edit'])->name('admin.jobs.edit');
      Route::post('/jobs/{id}/update',[jobController::class,'update'])->name('admin.jobs.update');
      Route::get('/jobs/{id}/delete',[jobController::class,'destroy'])->name('admin.jobs.delete');
});

//  these are guest middleware------------------------------
 Route::group(['middleware'=>'guest'], function(){
    Route::get('/register',[AuthController::class, 'registration'])->name('account.registration');
    Route::get('/login',[AuthController::class, 'login'])->name('account.login');
    Route::post('/accountregister',[AuthController::class, 'accountregister'])->name('account.register');
    Route::post('/lgoinuser',[AuthController::class, 'loginuser'])->name('user.login');
 });

//  these are auth middlewares----------------------------
 Route::group(['middleware'=>'auth'],function(){
    Route::get('/profile',[AuthController::class, 'profile'])->name('user.profile');
    Route::post('/profile/{id}/update',[AuthController::class, 'updateProfile'])->name('update.profile');
    Route::post('/profile/{id}/update-passoword',[AuthController::class, 'updatePassword'])->name('update.password');
    Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
    Route::post('/profile/upload', [AuthController::class, 'uploadProfilePicture'])->name('profile.upload');
    Route::get('/create-job', [AuthController::class, 'createjob'])->name('create.job');    
    Route::post('/store-job', [AuthController::class, 'storejob'])->name('store.job');
    
   //  this is for show the page of  created jobs 
    Route::get('/myjobs', [AuthController::class, 'createdjobs'])->name('created.job');    
    Route::get('/myjobs/edit-job/{jobId}', [AuthController::class, 'editjob'])->name('edit.job');    
    Route::post('/myjobs/update-job/{jobId}', [AuthController::class, 'updatejob'])->name('update.job');    
    Route::get('/myjobs/delete/{jobId}', [AuthController::class, 'deletejob'])->name('delete.job');  
    
   //  this is for show the page of applied jobs 
   Route::get('/applied-jobs', [AuthController::class, 'appliedJobs'])->name('applied.job');
   Route::get('applied_job/delete/{id}',[AuthController::class, 'removeAppliedJob'])->name('appliedJob.delete');
  
   // this will show the saved job page 
   Route::get('/saved-jobs', [AuthController::class, 'showSavedJobs'])->name('saved.job');
   Route::get('/saved-jobs/delete/{id}', [AuthController::class, 'removeSavedJobs'])->name('remove_saved.job');
 });