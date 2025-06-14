<!-- Header Start -->
@include('frontend.includes.header')
<!-- Header End -->

<!-- Navbar Start -->
@include('frontend.includes.navbar')
<!-- Navbar End -->

<!-- Breadcrumb End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Application Details</h1>
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
                    <img src="../../../assets/frontend/uploads/{{$data->applicant_profile_pic}}" alt="{{$data->applicant_name}}" style="height: 80px; width:80px; border-radius:50%; object-fit:cover">

                    <div class="text-start ">


                        <div class="d-flex">
                            <h3 class="mb-3 me-1">{{$data->applicant_name}}</h3>

                            <i class="fa fa-check-circle text-primary" style="font-size:20px; display:block; margin-top:-6px;"></i>
                        </div>
                        <h5 class="mb-3 me-1">
                            <i class="fa fa-briefcase text-primary me-2"></i> Applied Position: {{$data->job_title}}
                        </h5>

                        <span class="text-truncate comp-detail2 me-2"><i class="fa fa-user text-primary me-2"></i>{{$data->applicant_email}}</span>

                        <span class="text-truncate me-2 comp-detail"><i
                                class="far fa-clock text-primary me-2"></i>{{$data->job_type}}</span>

                        <span class="text-truncate me-2 comp-detail ml-2"><i
                                class="far fa-calendar-alt text-primary me-2"></i>{{$data->created_at->diffForHumans()}}</span>


                    </div>
                </div>

                @if($data->status === '2')

                <span class="breadcrumb-item"><a href="#" class="btn btn-success py-md-2 px-md-3 animated slideInRight">Accepted</a></span>

                @endif

                <div class="mb-4">

                    <hr style="background-color: #1967D2;">

                    <p>{{$data->applicant_about}}</p>

                    <hr style="background-color: #1967D2;">

                </div>

                <div class="mb-4">

                    <p>View CV of <a target="_blank" href="../assets/frontend/uploads/{{$data->Cv}}">{{$data->applicant_name}}</a>.</p>

                    <hr style="background-color: #1967D2;">

                </div>

                <div class="mb-4">

                    <p>View Cover Letter of <a target="_blank" href="../assets/frontend/uploads/{{$data->cover_later}}">{{$data->applicant_name}}</a>.</p>

                    <hr style="background-color: #1967D2;">

                </div>





                @if($data->status !== '2')

                    <div class="mb-4">

                    <span class="breadcrumb-item"><a href="{{route('accept_application', $data->id)}}" class="btn btn-primary py-md-2 px-md-3 animated slideInRight">Accept</a></span>

                    <span class="breadcrumb-item"><a href="{{route('reject_application', $data->id)}}" class="btn btn-danger py-md-2 px-md-3 animated slideInRight">Reject</a></span>

                </div>

                @endif


            </div>
        </div>
    </div>
</div>
<!-- Job Detail End -->




<!-- Jobs Start -->
@include('frontend.includes.footer')
<!-- Jobs End -->