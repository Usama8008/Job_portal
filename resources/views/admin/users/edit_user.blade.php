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
                <div class="card border-0 shadow mb-4">
                    <div class="card-body  p-4">
                        <h3 class="fs-4 mb-1">User Profile</h3>
                        <form action="{{route('admin.user.update',$user->id)}}" method="POST">
                            @csrf
                        <div class="mb-4">
                            <label for="" class="mb-2">Name*</label>
                            <input type="text" name="name" placeholder="Enter Name" class="form-control" 
                            value=" {{old('name',$user->name)}}">
                            @error('name')
                                <p class="text-danger"> {{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" name="email" placeholder="Enter Email" class="form-control"
                             value="{{old('email',$user->email)}}">
                             @error('email')
                                <p class="text-danger"> {{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Designation*</label>
                            <input type="text" name="designation" placeholder="Designation" class="form-control" 
                            value="{{$user->designation}}">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Mobile*</label>
                            <input type="text" name= "mobile" placeholder="Mobile" class="form-control" 
                            value="{{$user->mobile}}">
                            @error('mobile')
                                <p class="text-danger"> {{$message}}</p>
                            @enderror
                        </div>                        
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('admin.users')}}" class="btn btn-secondary">back</a>
                    </div>
                </form>
                </div>              
            </div>
    </div>
</section>
    
@endsection