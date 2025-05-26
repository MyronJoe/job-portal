<!-- Header Start -->
@include('frontend.includes.header')
<!-- Header End -->

<!-- Navbar Start -->
@include('frontend.includes.navbar')
<!-- Navbar End -->

<!-- Breadcrumb End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Register</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Register</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->


<div class="p-4" style="display: flex; justify-content:center;">

    <form class="col-sm-12 col-md-5" action="{{Route('registerUser')}}" method="POST">
        @csrf
        <h4 class="mb-4" style="border-left: 6px solid #1967D2; padding-left:5px;">Sing Up Now</h4>
        <div class="row g-3">

            <div class="col-12">
                @error('username')
                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                @enderror
                <input type="text" class="form-control" placeholder="Your Name" name="username" value="{{ old('username') }}">
            </div>

            <div class="col-12">
                @error('email')
                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                @enderror
                <input type="email" class="form-control" placeholder="Your Email" name="email" value="{{ old('email') }}">
            </div>

            <div class="col-12">
                @error('password')
                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                @enderror
                <input type="password" class="form-control" placeholder="Your Password" name="password" value="{{ old('password') }}">
            </div>

            <div class="col-12">
                @error('confirm-password')
                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                @enderror
                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm-password" value="{{ old('confirm-password') }}">
            </div>

            <div class="col-12">
                @error('user_type')
                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                @enderror
                <select name="user_type" class="form-control">
                    <option value="{{ old('user_type') }}">{{ old('user_type') }} (Choose Account Type)</option>
                    <option value="Job Seeker">Job Seeker</option>
                    <option value="Recruiter">Recruiter</option>
                </select>
            </div>

            <small>Already have an account? <a href="{{route('login')}}">Sign In</a></small>

            <div class="col-4">
                <button class="btn btn-primary w-100" type="submit">Sign Up</button>
            </div>
        </div>
    </form>
</div>


<!-- Jobs Start -->
@include('frontend.includes.footer')
<!-- Jobs End -->