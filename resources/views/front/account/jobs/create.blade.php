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
            @include('front.account.sidebar')
            <div class="col-lg-9">
                @include('front.account.message')
                <div class="card border-0 shadow mb-4 ">
                    <form action="{{route('store.job')}}" method="POST">
                        @csrf
                    <div class="card-body card-form p-4">
                        <h3 class="fs-4 mb-1">Job Details</h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Title<span class="req">*</span></label>
                                <input type="text" value="{{old('title')}}" placeholder="Job Title" id="title" name="title" class="form-control @error('title') is-invalid @enderror">
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
                                    <option value={{$category->id}}>{{$category->name}}</option>
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
                                        <option value={{$jobtype->id}}>{{$jobtype->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('jobType')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                            </div>
                            <div class="col-md-6  mb-4">
                                <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                <input type="number" value="{{old('vacancy')}}"  min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control @error('vacancy') is-invalid @enderror">
                                @error('vacancy')
                                <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Salary</label>
                                <input type="text" value="{{old('salary')}}" placeholder="Salary" id="salary" name="salary" class="form-control">
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Location<span class="req">*</span></label>
                                <input type="text" value="{{old('location')}}" placeholder="location" id="location" name="location" class="form-control @error('location') is-invalid  @enderror">
                                @error('location')
                                <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="" class="mb-2">Description<span class="req">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>
                            @error('description')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Benefits</label>
                            <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{old('benefits')}}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Responsibility</label>
                            <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{old('responsibility')}}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Qualifications</label>
                            <textarea class="form-control" name="qualification" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{old('qualification')}}</textarea>
                        </div>
                        
                        

                        <div class="mb-4">
                            <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                            <input type="text" value="{{old('keywords')}}" placeholder="keywords" id="keywords" name="keywords" class="form-control @error('keywords') is-invalid @enderror">
                            @error('keywords')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="" class="mb-2">Experiance<span class="req">*</span></label>
                            <select name="experiance" id="experiance" class="form-select">
                                <option value="1">1 Year</option>
                                <option value="2">2 Years</option>
                                <option value="3">3 Years</option>
                                <option value="4">4 Years</option>
                                <option value="5">5 Years</option>
                                <option value="6">6 Years</option>
                                <option value="7">7 Years</option>
                                <option value="8">8 Years</option>
                                <option value="9">9 Years</option>
                                <option value="10">10 Years</option>
                                <option value="10_plus">10+ Years</option>
                            </select>
                            @error('experiance')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>

                        <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Name<span class="req">*</span></label>
                                <input type="text" value="{{old('company_name')}}"  placeholder="Company Name" id="company_name" name="company_name" class="form-control">
                                @error('company_name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Location</label>
                                <input type="text" value="{{old('company_location')}}" placeholder="Location" id="location" name="company_location" class="form-control">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Website</label>
                            <input type="text" value="{{old('webiste')}}" placeholder="Website" id="website" name="website" class="form-control">
                        </div>
                    </div> 
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Save Job</button>
                    </div>               
                </form>
            </div>               
            </div>
        </div>
    </div>
</section>
    
@endsection