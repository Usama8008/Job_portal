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
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">saved Jobs</h3>
                            </div>                           
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if ($savedjobs->isNotEmpty())
                                    @foreach ($savedjobs as $savedjob)

                                    <tr class="active">
                                        <td>
                                            <div class="job-name fw-500">{{$savedjob->job->title}}</div>
                                            <div class="info1">{{$savedjob->job->jobType->name}} . {{$savedjob->job->location}}</div>
                                        </td>
                                        <td>{{$savedjob->job->applications->count()}} Applications</td>
                                        <td>
                                            @if ($savedjob->job->status==1)
                                            <div class="job-status text-capitalize">active</div>
                                            @else
                                            <div class="job-status text-capitalize">Expired</div>  
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-dots">
                                                <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="{{route('job.details',$savedjob->job_id)}}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                       <form action="{{route('remove_saved.job',$savedjob->id )}}"  onsubmit="return confirmDelete()">
                                                            @csrf
                                                            @method('DELETE')
                                                        <button type="submit" class="dropdown-item" ><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>
                                                    </form>
                                                    {{-- confirmation before delete job  --}}
                                                    <script>
                                                        function confirmDelete() {
                                                            return confirm('Are you sure you unsave this job');
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
                            {{$savedjobs->links('pagination::bootstrap-5')}}
                        </div>
                    </div>
                </div>             
            </div>
        </div>
    </div>
</section>
    
@endsection