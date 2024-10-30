<div class="col-lg-3">
    <div class="card border-0 shadow mb-4 p-3">
    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3 {{ Request::is('admin/dashboard') ? 'active1' : '' }}">
                    <a href="{{route('admin.dashboard')}}">Dashboard</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3 {{ Request::is('admin/users') ? 'active1' : '' }}">
                    <a href="{{route('admin.users')}}">Users</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3 {{ Request::is('admin/jobs') ? 'active1' : '' }}">
                    <a href="{{route('admin.jobs')}}">Jobs</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
    
</div>