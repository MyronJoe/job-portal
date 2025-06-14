<!-- Header Start -->
@include('frontend.includes.header')
<!-- Header End -->

<!-- Navbar Start -->
@include('frontend.includes.navbar')
<!-- Navbar End -->

<!-- Breadcrumb End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Job Applications</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">

                <li class="breadcrumb-item"><a href="/" class="btn btn-primary py-md-2 px-md-3 animated slideInRight">Home</a></li>

                <li class="breadcrumb-item"><a href="{{route('profile')}}" class="btn btn-secondary py-md-2 px-md-3 animated slideInRight">Profile</a></li>


            </ol>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Job Detail Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gy-5 gx-4">
            <div class="col-lg-12">
                <div class=" mb-2">



                    @if (Route::has('login'))
                    @auth
                    @if (Auth::user()->user_type === 'Recruiter')

                    <hr style="background-color: #1967D2;">
                    <h4 class="mb-3">Job Applications</h4>
                    <hr style="background-color: #1967D2;">
                    <div class="mb-3">
                        <div class=" py-3">
                            <div class="">
                                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="row">

                                        @foreach($data as $key => $job2)
                                        <div class="mb-4 col-sm-12 col-md-6">
                                            <div class="job-item p-2">
                                                <div style="display: flex; align-items: flex-start; justify-content: space-between;">

                                                    <div class=" d-flex align-items-center">


                                                        <img class="flex-shrink-0 img-fluid border rounded" src="../../../assets/frontend/uploads/{{$job2->applicant_profile_pic}}" alt="{{$job2->job_title}}"
                                                            style="width: 80px; height: 80px;">

                                                        <div class="text-start ps-2">

                                                            <p class="mb-2"><a href="{{route('view_application', $job2->id)}}" style="color: black;"><i
                                                                        class="fa fa-briefcase text-primary me-2"></i> {{$job2->job_title}}</a></p>

                                                            <small class="mb-2"><a href="{{route('view_application', $job2->id)}}" style="color: black;"> <i class="fa fa-user text-primary me-2"></i>{{$job2->applicant_name}} | {{$job2->applicant_email}}</a></small>


                                                        </div>
                                                    </div>

                                                    <div class="d-flex mb-3">
                                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                                class="far fa-heart text-primary"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach



                                        <a class="btn btn-primary py-3 px-5" href="#">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @else
                    <a href="/" class="btn btn-secondary py-md-2 px-md-3 animated slideInRight">Admin Dashboard</a>
                    @endif
                    @endauth
                    @endif


                </div>
            </div>
        </div>
    </div>
    <!-- Job Detail End -->


    <style>
        .swal2-modal .swal2-title {
            color: black !important;
        }

        .swal2-icon.swal2-warning {
            margin-top: 20px;
        }

        .swal2-icon.swal2-success {
            margin-top: 20px;
        }
    </style>

    <script>
        function confirmation(e) {

            e.preventDefault();
            var link = e.currentTarget.getAttribute('href');


            Swal.fire({
                title: 'Are you sure?',
                text: "To Remove This Job!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes, Delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Swal.fire(
                    // 	'Deleted!',
                    // 	'Data Has Been Deleted Successfully.',
                    // 	'success'
                    // )
                    window.location.href = link
                }
            });

        }
    </script>

    <script src="assets/backend/js/sweetalert2.all.min.js"></script>

    <!-- Jobs Start -->
    @include('frontend.includes.footer')
    <!-- Jobs End -->