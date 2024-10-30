<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\jobType;
use App\Models\saveJob;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\jobApplication;
use App\Mail\jobNotificationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobsController extends Controller
{
    // this will show the all jobs into find job

    public function findjobs(Request $request){
        $categories= Category::where('status',1)->orderBy('name','ASC')->get();
        $jobtypes= jobType::where('status',1)->orderBy('name','ASC')->get();
        $jobs= Job::where('status',1);
        
        // search by keyword and location 
        if(!empty($request->keyword))
        $jobs= $jobs->where(function($query) use($request){
              $query->orwhere('title','like','%'.$request->keyword .'%');
              $query->orwhere('keywords','like','%'.$request->keyword .'%');
        });

        // search by location 
        if(!empty($request->location)){
            $jobs= $jobs->where('location',$request->location);
        }

        // search by category
        if(!empty($request->category)){
            $jobs= $jobs->where('category_id',$request->category);
        }

         // search by tobtype
         if($request->has('job_type') && !empty($request->job_type)){
            $jobs= $jobs->whereIn('job_type_id',$request->job_type);
        }

         // search by experience
         if(!empty($request->experiance)){
            $jobs= $jobs->where('experiance',$request->experiance);
        }

          if ($request->has('sort')) {
        if ($request->sort == 'latest') {
            // Oldest first
            $jobs = $jobs->orderBy('created_at', 'DESC');
        } else {
            // Latest first (default)
            $jobs = $jobs->orderBy('created_at', 'ASC');
        }
    } else {
        // Default to 'Latest'
        $jobs = $jobs->orderBy('created_at', 'DESC');
    }
           

        $jobs= $jobs->with(['jobType','category'])->paginate(9);


        return view('front.jobs',compact('categories','jobtypes','jobs'));
    }

    public function jobDetails(string $id){
        $job= Job::where([
            'id'=>$id, 
            'status'=>1
        ])->with(['jobType','Category'])->first();
        if ($job==null) {
            return abort(404);
        }
         
        // this will hide the save button that user can not apply same job twice
        $savedAlready= saveJob::where([
            'job_id'=>$id,
            'user_id'=>Auth::id(),
        ])->count();

        // feth job applicatios 
        $applications= jobApplication::where('job_id',$id)->with('user')->get();

        return view('front.jobDetails',compact('job','savedAlready','applications'));
    }

    // for apply jobs 
    public function applyJob(Request $request, string $id){

         $job=Job::findorfail($id);

        //  user can not apply his own created jobs
        // $employerId=  $job->user_id;
        // if ($employerId==Auth::id()) {
        //     return redirect()->route('job.details',$id)->with('error','You Can not Apply your own created Jobs');
        // }

        $existingApplication= jobApplication::where([
            'user_id'=>Auth::id(),
            'job_id'=>$id
        ])->first();
        if ($existingApplication) {
             return redirect()->route('job.details',$id)->with('error','You Already Applied for this job');
        }
        
         $request->validate([
          'resume'=> 'required|mimes:pdf'
        ]);

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public'); //upload resumes

        $employerId=  $job->user_id;
        $applyJob= jobApplication::create([
            'job_id'=> $id,
            'user_id'=>Auth::id(),
            'employer_id'=> $employerId,
            'resume'=> $resumePath,
            'applied_date'=>now()
        ]);

        // send notification email to user 
        // $emloyer= User::where('id',$employerId)->first();
        // $maildata=[
        //    'employer'=>$emloyer,
        //    'user'=>Auth::user(),
        //    'job'=>$job ,
        //    'resume'=>$resumePath
        // ];

        // Mail::to($emloyer->email)->send(new jobNotificationEmail($maildata));

       return redirect()->route('job.details',$id)->with('msg', 'You successfully Applied for this job');
    }
    return redirect()->route('job.details',$id)->witherros();
    }

    // this will save the job 
    public function savejob(Request $request,string $id){
       $job= Job::findorfail($id);
        
         // this will make sure the user can not apply same job twice
       $savedAlready= saveJob::where([
           'job_id'=>$id,
           'user_id'=>Auth::id(),
       ])->first();
       if ($savedAlready) {
        return redirect()->route('job.details',$id)->with('error','You already saved this job');
   }
       $savejob= saveJob::create([
           'job_id'=>$id,
           'user_id'=>Auth::id()
        ]);
        return redirect()->route('job.details',$id)->with('msg','You saved this job');
    }
}
