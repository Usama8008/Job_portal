@extends('front.layout.app')
@section('main')
<style>
    @media (max-width: 768px) {
        .pt-3.text-end {
            text-align: center;
        }
        .btn {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        form {
            display: block;
            width: 100%;
        }
    }
</style>

<section class="section-4 bg-2">    
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('find.job')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                    </ol>
                </nav>
            </div>
        </div> 
    </div>
    <div class="container job_details_area">
        <div class="row pb-5">
            <div class="col-md-8">
                @include('front.account.message')
                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                
                                <div class="jobs_conetent">
                                    <a href="#">
                                        <h4>{{$job->title}}</h4>
                                    </a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i> {{$job->location}}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> {{$job->jobType->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <form action="{{route('job.save',$job->id)}}" method="POST">
                                    @csrf
                                    @if (Auth::check())
                                    @cannot('user', $job->user_id)
                                    <div class="apply_now {{($savedAlready ==1) ? 'saved_job':''}}">
                                        <button type="submit" class="heart_mark"> 
                                            <i class="fa fa-heart-o" aria-hidden="true"></i> 
                                        </button>
                                    </div>
                                    @endcan
                                    @endif
                                
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Job description</h4>
                            {{$job->description}}
                        </div>

                        @if (!empty($job->responsibility))
                        <div class="single_wrap">
                            <h4>Responsibility</h4>
                            {{$job->responsibility}}
                        </div>
                        @endif

                        @if (!empty($job->qualification))
                        <div class="single_wrap">
                            <h4>Qualifications</h4>
                            {{$job->qualification}}
                        </div>
                        @endif
                        
                        @if (!empty($job->benefits))
                        <div class="single_wrap">
                            <h4>Benefits</h4>
                           {{$job->benefits}}
                        </div>
                        @endif
                        
                        <div class="border-bottom"></div>
                        <div class="pt-3 text-end">
                            {{-- applied gate for can not apply his own created jobs --}}
                            @cannot('user', $job->user_id)
                            <form action="{{route('job.save',$job->id)}}" method="POST" onsubmit="return saveConfirmation()" style="display: inline;">
                            @csrf
                            @if (Auth::check())
                            <button type="submit"  class="btn btn-secondary {{($savedAlready==1)?'disabled': ''}}">Save</button>
                            @endif
                            </form>
                            <form action="{{route('job.apply',$job->id)}}" method="POST" onsubmit="return applyConfirmation()"  style="display: inline;" enctype="multipart/form-data">
                                @csrf
                                @if (Auth::check())
                                <label for="resume" class="btn btn-secondary" id="resume-label" style="margin-right: 10px;">Upload your resume</label>
                               <input type="file" id="resume" name="resume" style="display: none;" onchange="updateLabel(event)">
                            @error('resume')
                                <p style="color: red">{{$message}}</p>
                            @enderror
                               <button type="submit" class="btn btn-primary">Apply</button>
                            
                            @else
                            <a href="#" class="btn btn-primary disabled">Login to Apply </a>
                            @endif
                        </form>
                        
                        @endcannot
                        
                        <script>
                            function saveConfirmation(){
                              return confirm('Are you sure you want to save this job?')
                            }
                            function applyConfirmation(){
                              return confirm('Are you sure you want to Apply for this job?')
                            }
                            document.querySelector('label[for="resume"]').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default label click behavior
            document.getElementById('resume').click();
        });

        function updateLabel(event) {
            var input = document.getElementById('resume');
            var label = document.getElementById('resume-label');
            if (input.files.length > 0) {
                label.textContent = input.files[0].name;
            } else {
                label.textContent = 'Upload your resume';
            }
        }

                              
                        </script>
                            
                        </div>
                       
                    </div>
                </div>

             {{-- job applications  --}}
            @if (Auth::check())
                @if (Auth::id()== $job->user_id)         
             <div class="card shadow border-0 mt-3">
                <div class="job_details_header">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center">
                            <div class="jobs_conetent">
                                    <h4>Applicants</h4>
                            </div>
                        </div>
                        <div class="jobs_right"></div>
                    </div>
                </div>
                <div class="descript_wrap white-bg">
                  <table class="table table-striped">
                    <tr>
                        <th>Name </th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Applied-Date</th>
                    </tr>
                   
                        @if ($applications->isNotEmpty())
                        @foreach ($applications as $application)
                        <tr>
                            <td>{{$application->user->name}}</td>
                            <td>{{$application->user->email}}</td>
                            <td>{{$application->user->mobile}}</td>
                            <td>{{\Carbon\Carbon::parse($application->applied_date)->format('d M,Y')}}</td>
                        </tr>
                         @endforeach
                        @else
                        <tr>
                            <td colspan="4">Nobody Applied Yet</td>
                        </tr>
                        @endif
                    
                  </table>
                    
                </div>
            </div>
            @endif 
            @endif
             {{-- end job applications  --}}

            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Job Summery</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Published on: <span>{{\carbon\carbon::parse($job->created_at)->format('d M, Y')}}</span></li>
                                <li>Vacancy: <span>{{$job->vacancy}}</span></li>
                                <li>Salary: <span>RS: {{$job->salary}}</span></li>
                                <li>Location: <span>{{$job->location}}</span></li>
                                <li>Job Nature: <span> {{$job->jobType->name}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Company Details</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Name: <span>{{$job->company_name}}</span></li>
                                <li>Locaion: <span>{{$job->company_location}}</span></li>
                                <li>Webite: <span>{{$job->company_website}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection