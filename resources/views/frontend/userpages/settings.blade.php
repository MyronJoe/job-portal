<!-- Header Start -->
@include('frontend.includes.header')
<!-- Header End -->

<!-- Navbar Start -->
@include('frontend.includes.navbar')
<!-- Navbar End -->

<!-- Breadcrumb End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">User Settings</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">

                <li class="breadcrumb-item"><a href="/" class="btn btn-primary py-md-2 px-md-3 animated slideInRight">Home</a></li>

                @if (Route::has('login'))
                @auth
                @if (Auth::user()->user_type === 'Recruiter')

                <li class="breadcrumb-item"><a href="{{route('create_job', Auth::user()->id)}}" class="btn btn-success py-md-2 px-md-3 animated slideInRight">Create Job</a></li>

                @endif
                @endauth
                @endif

                <li class="breadcrumb-item"><a href="{{route('profile')}}" class="btn btn-secondary py-md-2 px-md-3 animated slideInRight">Profile</a></li>

            </ol>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->


<div class="px-4">

    <h4 class="mb-3">Update User Details</h4>

    <div>
        <div class="wow fadeInUp" data-wow-delay="0.5s">
            <form action="{{Route('user_update')}}" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="row g-3">

                    <input type="text" value="{{$user->id}}" name="userId" readonly hidden>

                    <div class="col-md-6">
                        <label for="name">Your Name</label>
                        @error('name')
                        <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating" style="padding-top: 0px; padding-bottom:0px">
                            <input type="text" class="form-control" name="name" placeholder="Your Name" value="{{$user->name}}">

                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="email">Your Email</label>
                        @error('email')
                        <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating" style="padding-top: 0px; padding-bottom:0px">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" value="{{$user->email}}">

                        </div>
                    </div>

                    <div class="col-12">
                        <label for="about">About</label>
                        @error('about')
                        <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating" style="padding-top: 0px; padding-bottom:0px">
                            <textarea class="form-control" placeholder="Leave a message here" name="about" style="height: 100px">
                            {{$user->about}}
                            </textarea>
                        </div>
                    </div>

                    <hr>

                    <h4>Profile Image</h4>

                    <img src="../assets/frontend/uploads/{{$user->profile_pic}}" alt="{{$user->name}}" style="height: 100px; width:115px; border-radius:50%; object-fit:cover">

                    <div class="custom-file">

                        <input type="file" class="form-control" name="profile_pic" accept="image/*">


                    </div>


                    <hr>

                    <h4 class="mb-1">Upload CV.</h4>

                    <p>Download CV <a href="../assets/frontend/uploads/{{$user->cv}}">{{$user->name}}</a>.</p>



                    <div class="custom-file mb-4">

                        <!-- <label class="custom-file-label" for="profile_pic" style="background-color: #1967D2; display:block; margin:5px 10px; width:6%; text-align:center; cursor:pointer; color:white; ">Upload</label> -->

                        <input type="file" class="form-control" name="cv" accept="application/pdf,application/vnd.ms-excel">

                    </div>




                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Update Details</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>


<!-- Jobs Start -->
@include('frontend.includes.footer')
<!-- Jobs End -->