<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\jobType;
use App\Models\saveJob;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\jobApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // this will show registration page
    public function registration(){
        return view('front.account.registration');

    }

    // this will save the user into database 
    public function accountregister(Request $request){
        $validator= Validator::make($request->all(),[
          'name'=>'required|min:3',
          'email'=>'required|email|unique:users,email',
          'password'=>'required|min:5|same:confirm_password',
          'confirm_password'=>'required',
        ]);

        if($validator->passes()){
        User::create([
         'name'=>$request->name,
         'email'=>$request->email,
         'password'=>Hash::make($request->password)
        ]);
        return redirect()->route('account.login')->with('msg','your account has been created successfully.');
        }else{
            return redirect()->route('account.registration')->withErrors($validator);
        }
    }

    // this will show the loin page 
    public function login(){
        return view('front.account.login');
    }
    
    public function loginuser(Request $request){
        $validator= Validator::make($request->all(),[
         'email' => 'required|email',
         'password' => 'required',
        ]);
        if($validator->passes()){
            if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
              return redirect()->route('user.profile');
            }else{
                return redirect()->route('account.login')->with('error','Either Email/Password did not match');
            }

        }else{
            return redirect()->route('account.login')
            ->withErrors($validator)
            ->withInput($request->only('email'));
        }
    }
    

    // this will show the profile of the user 
    public function profile(){
        $id = Auth::id();
        $user= User::findorfail($id);
        return view('front.account.profile',compact('user'));
    }  

    // this will update the User's detail
    public function updateProfile(Request $request){
        $id= Auth::id();
        $validator= Validator::make($request->all(),[
        'name'=> 'required|min:3|max:20',
        'email'=> 'required|email|unique:users,email,'.$id.',id',
        'mobile'=> 'min:11|max:11'
        ]);
       
        if($validator->passes()){
            User::findorfail($id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'designation'=>$request->designation,
                'mobile'=>$request->mobile,
            ]);
            return redirect()->route('user.profile')->with('msg','User Updated successfully');
            
        }else {
            return redirect()->route('user.profile')->withErrors($validator);
        }
    }

    // this will update the image 
   
    // this will update the password 
    public function updatePassword(Request $request){
        $validator= Validator::make($request->all(),[
             'old_password'=>'required',
             'new_password'=>'required|min:5',
             'confirm_password'=>'required|same:new_password'
        ]);
        if($validator->fails()){
          return redirect()->route('user.profile')->withErrors($validator);
        }
        if(Hash::check($request->old_password, Auth::user()->password)==false){
            return redirect()->route('user.profile')->with('error','Your Old Password is not Correct');
        }

        $user= User::findorfail(Auth::id())->update([
             'password'=>$request->new_password,
        ]);

        return redirect()->route('user.profile')->with('msg','You successfully  update your password');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }

    // this will show the create job page 
    public function createjob(){
        $categories= Category::orderBy('name','ASC')->where('status',1)->get();
        $jobTypes= jobType::orderBy('name','ASC')->where('status',1)->get();
        return view('front.account.jobs.create',compact('categories','jobTypes'));

    }

    // this will save the job table data into the database 
    public function storejob(Request $request){
        $rules= [
               'title'=> 'required|min:3|max:50',
               'category' =>'required',
               'jobType' =>'required',
               'vacancy' =>'required|integer',
               'location' =>'required|max:50',
               'description' =>'required',
               'keywords' =>'required',
               'experiance' =>'required',
               'company_name' =>'required|min:3|max:70',
        ];
        $validator= Validator::make($request->all(),$rules);

        if($validator->passes()){
          $job= Job::create([
            'title'=>$request->title,
            'category_id'=>$request->category,
            'job_type_id'=>$request->jobType,
            'user_id'=>Auth::id(),
            'vacancy'=>$request->vacancy,
            'salary'=>$request->salary,
            'location'=>$request->location,
            'description'=>$request->description,
            'benefits'=>$request->benefits,
            'responsibility'=>$request->responsibility,
            'qualification'=>$request->qualification,
            'keywords'=>$request->keywords,
            'experiance'=>$request->experiance,
            'company_name'=>$request->company_name,
            'company_location'=>$request->company_location,
            'company_website'=>$request->website,
          ]);
          return redirect()->route('created.job')->with('msg','your job posted successfully');
        }else{
            return redirect()->route('create.job')->withInput()->withErrors($validator);
        }
    }
    
    // this will show the details of created jobs 
    public function createdjobs(){
        $jobs= Job::where('user_id', Auth::id())->orderBy('created_at','DESC')->paginate(10);
        return view('front.account.jobs.myjobs',compact('jobs'));
    }

    // this will show the edit job page 
    public function editjob(string $id){
      $categories= Category::orderBy('name','ASC')->where('status',1)->get();
      $jobTypes= jobType::orderBy('name','ASC')->where('status',1)->get();
      $job= Job::where('user_id',Auth::id())->where('id', $id)->first();

      if($job==null){
        abort(404);
      }
       return view('front.account.jobs.edit',compact('categories','jobTypes','job'));
    }


    // this will update the jobs 
    public function updatejob(Request $request,$id){
        $rules= [
               'title'=> 'required|min:3|max:50',
               'category' =>'required',
               'jobType' =>'required',
               'vacancy' =>'required|integer',
               'location' =>'required|max:50',
               'description' =>'required',
               'keywords' =>'required',
               'experiance' =>'required',
               'company_name' =>'required|min:3|max:70',
        ];
        $validator= Validator::make($request->all(),$rules);

        if($validator->passes()){
          $job= Job::findorfail($id)->update([
            'title'=>$request->title,
            'category_id'=>$request->category,
            'job_type_id'=>$request->jobType,
            'user_id'=>Auth::id(),
            'vacancy'=>$request->vacancy,
            'salary'=>$request->salary,
            'location'=>$request->location,
            'description'=>$request->description,
            'benefits'=>$request->benefits,
            'responsibility'=>$request->responsibility,
            'qualification'=>$request->qualification,
            'keywords'=>$request->keywords,
            'experiance'=>$request->experiance,
            'company_name'=>$request->company_name,
            'company_location'=>$request->company_location,
            'company_website'=>$request->website,
          ]);
          return redirect()->route('created.job')->with('msg','your job updated successfully');
        }else{
            return redirect()->route('edit.job')->withInput()->withErrors($validator);
        }
    }

    // this will deleted the jobs
    public function deletejob(string $id){
        $job= Job::where('user_id',Auth::id())->where('id',$id)->first();
        if($job==null){
            return redirect()->route('created.job')->with('error', 'Either this job is not found or already deleted');
        }

        job::findorfail($id)->delete();
        return redirect()->route('created.job')->with('msg','Job deleted successfully');
    }
    
    // this will show the applied job page
    public function appliedJobs(){
        $jobApplications= jobApplication::where('user_id',Auth::id())->with(['job','job.jobType','job.applications'])->paginate(10);
        return view('front.account.jobs.applied_jobs',compact('jobApplications'));
    }

    // this will delete the applied jobs
    public function removeAppliedJob(string $id){
         $jobApplication= jobApplication::where(['id'=>$id, 'user_id'=>Auth::id()])->first();
         if($jobApplication==null){
            return redirect()->route('applied.job')->with('error','job not found it may deleted or removed');
    }
        $jobApplication->delete();
        return redirect()->route('applied.job')->with('msg','Job Removed Successfully');
            }

    // this will show the saved job page 
    public function showSavedJobs(){
        $savedjobs= saveJob::where('user_id',Auth::id())->with(['job','job.jobType','job.applications'])->paginate(10);
        return view('front.account.jobs.saved_jobs',compact('savedjobs'));
    }

    // this will remove the saved jobs 
    public function removeSavedJobs(string $id){
        $savedjobs= saveJob::where(['id'=>$id ,'user_id'=>Auth::id()])->first();
        if($savedjobs==null){
            return redirect()->route('saved.job')->with('error','this job not found or may deleted from your saved');
        }
        $savedjobs->delete();
        return redirect()->route('saved.job')->with('msg','Removed form your saves');

    }

}
 