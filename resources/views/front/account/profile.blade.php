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
                <div class="card border-0 shadow mb-4">
                    <div class="card-body  p-4">
                        <h3 class="fs-4 mb-1">My Profile</h3>
                        <form action="{{route('update.profile',Auth::id())}}" method="POST">
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
                    </div>
                </form>
                </div>


                <div class="card border-0 shadow mb-4">
                    <form action="{{route('update.password',Auth::id())}}" method="POST">
                        @csrf
                    <div class="card-body p-4">
                        <h3 class="fs-4 mb-1">Change Password</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Old Password*</label>
                            <input type="password" name="old_password" placeholder="Old Password" class="form-control">
                        @error('old_password')
                        <p class="text-danger"> {{$message}}</p>
                        @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">New Password*</label>
                            <input type="password" name="new_password" placeholder="New Password" class="form-control">
                            @error('new_password')
                            <p class="text-danger"> {{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                        </div>                        
                        @error('confirm_password')
                        <p class="text-danger"> {{$message}}</p>
                        @enderror
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                </div>                
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
            <form>
                @csrf
                <div class="mb-3">
                    <label for="image" class="form-label">Profile Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <span class="text-danger" id="image-error"></span>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mx-3">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
            
        </div>
      </div>
    </div>
  </div> 



@endsection