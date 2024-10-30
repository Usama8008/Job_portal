@extends('front.layout.app')

@section('main')


<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                @if (session('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>{{ session('msg') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
                <div class="card shadow border-0 p-5">
                  {{-- @include('front.account.message') --}}
                    <h1 class="h3">Login</h1>
                    <form action="{{route('user.login')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" value="{{old('email')}}" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@example.com">
                             @if (session('error'))
                                 <p style="color: rgb(199, 18, 18)">{{session('error')}}</p>
                             @endif
                            @error('email')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Password*</label>
                            <input type="password" name="password" id="pass" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">
                            @error('password')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                        </div> 
                        <div class="justify-content-between d-flex">
                        <button class="btn btn-primary mt-2">Login</button>
                            <a href="forgot-password.html" class="mt-3">Forgot Password?</a>
                        </div>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Do not have an account? <a  href="{{route('account.registration')}}">Register</a></p>
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
    </div>
</section>
    
@endsection