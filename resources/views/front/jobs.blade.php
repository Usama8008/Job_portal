@extends('front.layout.app')
@section('main')
<section class="section-3 py-5 bg-2 ">
    <div class="container">     
        <div class="row">
            <div class="col-6 col-md-10 ">
                <h2>Find Jobs</h2>  
            </div>
             <!-- Use GET or POST as needed -->
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <form method="GET" action="{{ route('find.job') }}">
                        <select name="sort" id="sort" class="form-control form-select" onchange="this.form.submit()">
                            <option value="latest" {{ request()->sort == 'latest' ? 'selected' : '' }}>Latest</option>
                             <option value="oldest" {{ request()->sort == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        </select>
                    </form>
                    </div>
                </div>
            
        </div>

        <div class="row pt-5">
            <div class="col-md-4 col-lg-3 sidebar mb-4">
                <form action="{{route('find.job')}}" method="GET">
                <div class="card border-0 shadow p-4">
                    <div class="mb-4">
                        <h2>Keywords</h2>
                        <input type="text" value="{{Request::get('keyword')}}" name="keyword" id="keyword" placeholder="Keywords" class="form-control">
                    </div>

                    <div class="mb-4">
                        <h2>Location</h2>
                        <input type="text" value="{{Request::get('location')}}" name="location" id="location" placeholder="Location" class="form-control">
                    </div>

                    <div class="mb-4">
                        <h2>Category</h2>
                        <select name="category" id="category" class="form-control form-select">
                            <option value="">Select a Category</option>
                            @if ($categories->isNotEmpty())
                            @foreach ($categories as $category)
                            <option {{(Request::get('category')==$category->id)? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach                                
                            @endif
                            
                            
                            
                        </select>
                    </div>                   

                    <div class="mb-4">
                        <h2>Job Type</h2>
                        @if ($jobtypes->isNotEmpty())
                           @foreach ($jobtypes as $jobtype)
                           <div class="form-check mb-2"> 
                            <input class="form-check-input " name="job_type[]" type="checkbox" value="{{$jobtype->id}}" id="jobid-{{$jobtype->id}}"
                            {{ is_array(request()->get('job_type')) && in_array($jobtype->id, request()->get('job_type')) ? 'checked' : '' }}>    
                            <label class="form-check-label " for="jobid-{{$jobtype->id}}">{{$jobtype->name}}</label>
                        </div>
                           @endforeach                         
                        @endif
                                          
                   </div>

                    <div class="mb-4">
                        <h2>Experience</h2>
                        <select name="experiance" id="experiance" class="form-control form-select">
                            <option  value="">Select Experience</option>
                            <option {{(Request::get('experiance')==1)? 'selected': ''}} value="1">1 Year</option>
                            <option {{(Request::get('experiance')==2)? 'selected': ''}} value="2">2 Years</option>
                            <option {{(Request::get('experiance')==3)? 'selected': ''}} value="3">3 Years</option>
                            <option {{(Request::get('experiance')==4)? 'selected': ''}} value="4">4 Years</option>
                            <option {{(Request::get('experiance')==5)? 'selected': ''}} value="5">5 Years</option>
                            <option {{(Request::get('experiance')==6)? 'selected': ''}} value="6">6 Years</option>
                            <option {{(Request::get('experiance')==7)? 'selected': ''}} value="7">7 Years</option>
                            <option {{(Request::get('experiance')==7)? 'selected': ''}} value="8">8 Years</option>
                            <option {{(Request::get('experiance')==9)? 'selected': ''}} value="9">9 Years</option>
                            <option {{(Request::get('experiance')==10)? 'selected': ''}} value="10">10 Years</option>
                            <option {{(Request::get('experiance')=='10_plus')? 'selected': ''}} value="10_pus">10+ Years</option>
                        </select>
                    </div>  
                    <button class="btn btn-primary" type="submit">Search</button>                  
                    <a href="{{route('find.job')}}" class="btn mt-2" type="submit">Reset</a>                  
                </div>
            </form>
            </div>
            <div class="col-md-8 col-lg-9 ">
                <div class="job_listing_area">                    
                    <div class="job_lists">
                    <div class="row">
                        @if($jobs->isNotEmpty())
                        @foreach ($jobs as $job)
                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{$job->title}}</h3>
                                    <p>{{Str::words($job->description,5)}}</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">{{$job->location}}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                            <span class="ps-1">{{$job->jobType->name}}</span>
                                        </p>
                                        @if (!is_null($job->salary))
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                            <span class="ps-1">{{$job->salary}}</span>
                                        </p>
                                        @endif
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="{{route('job.details',$job->id)}}" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else()
                        <p>No Jobs found</p>
                        @endif                                               
                    </div>
                    
                    </div>
                </div>
            </div>
            {{$jobs->withQueryString()->links('pagination::bootstrap-5')}}
        </div>
    </div>
    
</section>
    
@endsection