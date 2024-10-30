@extends('front.layout.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            @include('admin.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card shadow-lg border-0 mb-4" style="height: 260px;">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div>
                        <h3 class="card-title text-primary mb-3 text-center">Welcome, Admin!</h3>
                        <p class="card-text text-center">
                            You can manage your dashboard from here, review jobs, manage users, and more.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>
    
@endsection