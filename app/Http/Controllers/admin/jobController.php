<?php

namespace App\Http\Controllers\admin;

use App\Models\Job;
use App\Models\jobType;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class jobController extends Controller
{
    public function jobs(){
        $jobs= Job::orderBy('created_at','DESC')->with('user','applications')->paginate(10);
        return view('admin.jobs.list',compact('jobs'));
    }

    public function edit($id){
        $job= Job::findorfail($id);
        $categories = Category::orderBy('name','ASC')->get();
        $jobTypes = jobType::orderBy('name','ASC')->get();
     return view('admin.jobs.edit',compact('job','categories','jobTypes'));
    }

    public function update(Request $request, $id){
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
         'status'=>$request->status,
         'featured' => (!empty($request->featured)) ? $request->featured : 0
       ]);
       return redirect()->route('admin.jobs')->with('msg','Job updated successfully');
     }else{
         return redirect()->route('admin.jobs.edit')->withInput()->withErrors($validator);
     }
    }

    public function destroy($id){
      $job= Job::findorfail($id);
      $job->delete();
      return redirect()->route('admin.jobs')->with('msg','Job deleted Successfully');
    }
}
