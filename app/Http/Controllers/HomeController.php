<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $categories= Category::where('status',1)->orderBy('name','ASC')->take(8)->get();
        $newcategories= Category::where('status',1)->orderBy('name','ASC')->get();
        $featuredjob= Job::where('status',1)->where('featured',1)->orderBy('created_at','DESC')->take(6)->get();
        $latestjobs= Job::where('status',1)->orderBy('created_at','DESC')->take(6)->get();

        return view('front.home',compact('categories','featuredjob','latestjobs','newcategories'));
    }
}
