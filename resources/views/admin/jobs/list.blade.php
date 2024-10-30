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
                        <div>
                            <h3 class="fs-4 mb-1">All Jobs</h3>
                        </div>                              
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Created By</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($jobs->isNotEmpty())
                                        @foreach ($jobs as $job)
    
                                        <tr class="active">
                                            <td><div class="job-name fw-500">{{$job->id}}</div></td>
                                            <td>
                                                <p>{{$job->title}}</p>
                                                <p>Applicants: {{$job->applications->count()}}</p>
                                            </td>
                                            <td><div class="job-name fw-500">{{$job->user->name}}</div></td>
                                            <td>{{\carbon\carbon::parse($job->created_at)->format('d M, Y')}}</td>

                                            <td>
                                                @if ($job->status==1)
                                                <p class="text-success">Active</p>
                                                @else
                                                <p class="text-danger">Blocked</p>
                                                @endif
                                                
                                                
                                            </td>
                                            <td>
                                                <div class="action-dots float-end">
                                                    <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href=""> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                        <li><a class="dropdown-item" href="{{route('admin.jobs.edit',$job->id)}}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                                                        <li>
                                                            <form action="{{route('admin.jobs.delete',$job->id)}}"  onsubmit="return confirmDelete()">
                                                                @csrf
                                                                @method('DELETE')
                                                            <button type="submit" class="dropdown-item" ><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>
                                                        </form>
                                                        {{-- confirmation before delete job  --}}
                                                        <script>
                                                            function confirmDelete() {
                                                                return confirm('Are you sure you want to delete this job? This action cannot be undone.');
                                                            }
                                                        </script>
                                                        {{-- ---------------------}}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                            
                                        @endforeach 
                                        @endif
                                        
                                    </tbody>
                                    
                                </table>
                                {{$jobs->links('pagination::bootstrap-5')}}
                            </div>                          
                        
                        
                    </div>
                </div>             
            </div>
       
    </div>
</section>
    
@endsection