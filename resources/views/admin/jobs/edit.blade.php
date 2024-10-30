@extends('front.layout.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            @include('admin.sidebar')
        </div>
            <div class="col-lg-9">
                @include('front.account.message')
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-end">
                        <a href="{{route('admin.jobs')}}" class="btn btn-secondary">Back</a>
                        </div>
                        <form action="{{route('admin.jobs.update',$job->id)}}" method="POST">
                            @csrf
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Update Job Details</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Title<span class="req">*</span></label>
                                    <input type="text" value="{{$job->title}}" placeholder="Job Title" id="title" name="title" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Category<span class="req">*</span></label>
                                    <select name="category" id="category" class="form-control form-select">
                                        <option value="">Select a Category</option>
                                    @if ($categories->isNotEmpty())
                                        @foreach ($categories as $category)
                                        <option {{($job->category_id== $category->id) ? 'selected': ''}} value={{$category->id}}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('category')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                            </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Job Type<span class="req">*</span></label>
                                    <select name="jobType" id="jobType" class="form-select">
                                        <option value="">select a job type</option>
                                        @if ($jobTypes->isNotEmpty())
                                            @foreach ($jobTypes as $jobtype)
                                            <option {{($job->job_type_id == $jobtype->id)? 'selected': ''}} value={{$jobtype->id}}>{{$jobtype->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('jobType')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                    <input type="number" value="{{$job->vacancy}}"  min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control @error('vacancy') is-invalid @enderror">
                                    @error('vacancy')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Salary</label>
                                    <input type="text" value="{{$job->salary}}" placeholder="Salary" id="salary" name="salary" class="form-control">
                                </div>
    
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location<span class="req">*</span></label>
                                    <input type="text" value="{{$job->location}}" placeholder="location" id="location" name="location" class="form-control @error('location') is-invalid  @enderror">
                                    @error('location')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <div class="form-check">
                                        <input {{($job->featured==1)? 'checked':''}} class="form-check-input" name='featured' type="checkbox" value="1" id="featured">
                                        <label class="form-check-label" for="featured">
                                          Featured
                                        </label>
                                      </div>
                                 </div>
                                 <div class="mb-4 col-md-6">
                                 <div class="form-check-inline">
                                    <input {{($job->status==1)? 'checked':''}} class="form-check-input" value="1" type="radio" name="status" id="status-active">
                                    <label class="form-check-label" for="active">
                                      Active
                                    </label>
                                  </div>
                                  <div class="form-check-inline">
                                    <input {{($job->status==0)? 'checked':''}} class="form-check-input" value="0" type="radio" name="status" id="status-block">
                                    <label class="form-check-label" for="block">
                                      Block
                                    </label>
                                  </div>
                                 </div>
                            </div>
    
                            <div class="mb-4">
                                <label for="" class="mb-2">Description<span class="req">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="5" rows="5" placeholder="Description">{{$job->description}}</textarea>
                                @error('description')
                                <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Benefits</label>
                                <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{$job->benefits}}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Responsibility</label>
                                <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{$job->responsibility}}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Qualifications</label>
                                <textarea class="form-control" name="qualification" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{$job->qualification}}</textarea>
                            </div>
                            
                            
    
                            <div class="mb-4">
                                <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                                <input type="text" value="{{$job->keywords}}" placeholder="keywords" id="keywords" name="keywords" class="form-control @error('keywords') is-invalid @enderror">
                                @error('keywords')
                                <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Experiance<span class="req">*</span></label>
                                <select name="experiance" id="experiance" class="form-select">
                                    <option {{($job->experiance==1) ? 'selected': ''}} value="1">1 Year</option>
                                    <option {{($job->experiance==2) ? 'selected': ''}} value="3">3 Years</option>
                                    <option {{($job->experiance==3) ? 'selected': ''}} value="2">2 Years</option>
                                    <option {{($job->experiance==4) ? 'selected': ''}} value="4">4 Years</option>
                                    <option {{($job->experiance==5) ? 'selected': ''}} value="5">5 Years</option>
                                    <option {{($job->experiance==6) ? 'selected': ''}} value="6">6 Years</option>
                                    <option {{($job->experiance==7) ? 'selected': ''}} value="7">7 Years</option>
                                    <option {{($job->experiance==8) ? 'selected': ''}} value="8">8 Years</option>
                                    <option {{($job->experiance==9) ? 'selected': ''}} value="9">9 Years</option>
                                    <option {{($job->experiance==10) ? 'selected': ''}} value="10">10 Years</option>
                                    <option {{($job->experiance=='10_plus') ? 'selected': ''}} value="10_plus">10+ Years</option>
                                </select>
                                @error('experiance')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                            </div>
    
                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>
    
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Name<span class="req">*</span></label>
                                    <input type="text" value="{{$job->company_name}}"  placeholder="Company Name" id="company_name" name="company_name" class="form-control">
                                    @error('company_name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                                </div>
    
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location</label>
                                    <input type="text" value="{{$job->company_location}}" placeholder="Location" id="location" name="company_location" class="form-control">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Website</label>
                                <input type="text" value="{{$job->company_website}}" placeholder="Website" id="website" name="website" class="form-control">
                            </div>
                        </div> 
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Update Job</button>
                        </div>               
                    </form>
                    </div>
                </div>             
            </div>
       
    </div>
</section>
    
@endsection