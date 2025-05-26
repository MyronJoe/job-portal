<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="/" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <h1 class="m-0 text-primary">Job Portal</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
        data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="/" class="nav-item nav-link active">Home</a>
            <a href="about.html" class="nav-item nav-link">About</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Jobs</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="job-list.html" class="dropdown-item">Job List</a>
                    <a href="job-detail.html" class="dropdown-item">Job Detail</a>
                </div>
            </div>

            <a href="contact.html" class="nav-item nav-link">Contact</a>



            @if (Route::has('login'))
            @auth
            @if (Auth::user()->user_type === 'Recruiter')

            <a href="{{Route('profile')}}" class="nav-item nav-link"> <span class="fa fa-user me-2 text-warning"></span> Profile</a>

            @elseif (Auth::user()->user_type === 'ad046js')

            <a href="{{Route('admin_dashboard')}}" class="nav-item nav-link"> <span class="fa fa-user me-2 text-success"></span> Dashboard</a>

            @else
            <a href="{{Route('profile')}}" class="nav-item nav-link"> <span class="fa fa-user me-2 text-primary"></span> Profile</a>
            @endif
            @endauth
            @endif


        </div>
        @if (Route::has('login'))
        @auth
        <a href="{{Route('logoutUser')}}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Logout<i class="fa fa-arrow-right ms-3"></i></a>
        @else
        <a href="{{Route('login')}}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Login<i class="fa fa-arrow-right ms-3"></i></a>
        @endauth
        @endif
    </div>
</nav>