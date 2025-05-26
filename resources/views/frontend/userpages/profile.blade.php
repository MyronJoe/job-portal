<!-- Header Start -->
@include('frontend.includes.header')
<!-- Header End -->

<!-- Navbar Start -->
@include('frontend.includes.navbar')
<!-- Navbar End -->

<!-- Breadcrumb End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Profile</h1>
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

                <li class="breadcrumb-item"><a href="user_settings/{{Auth::user()->id}}" class="btn btn-secondary py-md-2 px-md-3 animated slideInRight">Settings</a></li>

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
                    <img src="../../../assets/frontend/uploads/{{Auth::user()->profile_pic}}" alt="{{Auth::user()->name}}" style="height: 80px; width:80px; border-radius:50%; object-fit:cover">

                    <div class="text-start ">
                        @if (Route::has('login'))
                        @auth
                        @if (Auth::user()->user_type === 'Recruiter')

                        <div class="d-flex">
                            <h3 class="mb-3 me-1">{{Auth::user()->name}} </h3>

                            <i class="fa fa-check-circle text-warning" style="font-size:20px; display:block; margin-top:-6px;"></i>
                        </div>

                        @elseif (Auth::user()->user_type === 'Job Seeker')

                        <div class="d-flex">
                            <h3 class="mb-3 me-1">{{Auth::user()->name}} </h3>

                            <i class="fa fa-check-circle text-primary" style="font-size:20px; display:block; margin-top:-6px;"></i>
                        </div>

                        @else
                        <div class="d-flex">
                            <h3 class="mb-3 me-1">{{Auth::user()->name}} </h3>

                            <i class="fa fa-check-circle text-success" style="font-size:20px; display:block; margin-top:-6px;"></i>
                        </div>
                        @endif
                        @endauth
                        @endif
                        <!-- <span class="text-truncate comp-detail2 me-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                        <span class="text-truncate comp-detail2 me-2"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                        <span class="text-truncate comp-detail2 me-2"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span> -->
                        <span class="text-truncate comp-detail2 me-2"><i class="fa fa-briefcase text-primary me-2"></i>FullStack Developer</span>


                    </div>
                </div>

                <div class="mb-4">

                    <hr style="background-color: #1967D2;">

                    <p>{{Auth::user()->about}}</p>

                </div>


                @if (Route::has('login'))
                @auth
                @if (Auth::user()->user_type === 'Recruiter')

                <hr style="background-color: #1967D2;">
                <h4 class="mb-3">Jobs Created</h4>
                <hr style="background-color: #1967D2;">
                <div class="mb-3">
                    <div class=" py-3">
                        <div class="">
                            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                                <div class="row">

                                    @foreach($data as $key => $job)
                                    <div class="mb-4 col-sm-12 col-md-6">
                                        <div class="job-item p-2">
                                            <div style="display: flex; align-items: flex-start; justify-content: space-between;">

                                                <div class=" d-flex align-items-center">

                                                    <img class="flex-shrink-0 img-fluid border rounded" src="../../../assets/frontend/uploads/{{$job->company_logo}}" alt="{{$job->job_title}}"
                                                        style="width: 80px; height: 80px;">

                                                    <div class="text-start ps-2">

                                                        <p class="mb-2"><a href="{{route('edit_job', $job->id)}}" style="color: black;">{{$job->job_title}}</a></p>

                                                        <span class="text-truncate me-2 comp-detail"><i
                                                                class="fa fa-map-marker-alt text-primary me-2"></i>{{$job->city}}, {{$job->country}}</span>

                                                        <span class="text-truncate me-2 comp-detail"><i
                                                                class="far fa-clock text-primary me-2"></i>{{$job->job_type}}</span>
                                                        <span class="text-truncate me-2 comp-detail"><i
                                                                class="far fa-money-bill-alt text-primary me-2"></i>${{$job->min_salary}} -
                                                            ${{$job->min_salary}}</span>


                                                        <span class="text-truncate me-2 comp-detail"><i
                                                                class="fa fa-briefcase text-primary me-2"></i>{{$job->experience}} Level</span>

                                                        <span class="text-truncate me-2 comp-detail ml-2"><i
                                                                class="far fa-calendar-alt text-primary me-2"></i>{{$job->created_at->diffForHumans()}}</span>

                                                    </div>
                                                </div>

                                                <div class="d-flex mb-3">
                                                    <a class="btn btn-light btn-square me-3" href="{{route('delete_job', $job->id)}}"><i
                                                            class="fa fa-trash text-primary"></i></a>
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

                @elseif (Auth::user()->user_type === 'Job Seeker')

               
                <hr style="background-color: #1967D2;">
                <h4 class="mb-3">Saved Jobs</h4>
                <hr style="background-color: #1967D2;">
                

                <div class="mb-3">
                    <div class=" py-3">
                        <div class="">
                            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                                <div class="row">

                                    @foreach($saved_job as $key => $job2)
                                    <div class="mb-4 col-sm-12 col-md-6">
                                        <div class="job-item p-2">
                                            <div style="display: flex; align-items: flex-start; justify-content: space-between;">

                                                <div class=" d-flex align-items-center">

                                                    <img class="flex-shrink-0 img-fluid border rounded" src="../../../assets/frontend/uploads/{{$job2->company_logo}}" alt="{{$job2->job_title}}"
                                                        style="width: 80px; height: 80px;">

                                                    <div class="text-start ps-2">

                                                        <p class="mb-2"><a href="{{route('job_details', $job2->job_id)}}" style="color: black;">{{$job2->job_title}}</a></p>

                                                        <span class="text-truncate me-2 comp-detail"><i
                                                                class="fa fa-map-marker-alt text-primary me-2"></i>{{$job2->city}}, {{$job2->country}}</span>

                                                        <span class="text-truncate me-2 comp-detail"><i
                                                                class="far fa-clock text-primary me-2"></i>{{$job2->job_type}}</span>
                                                        <span class="text-truncate me-2 comp-detail"><i
                                                                class="far fa-money-bill-alt text-primary me-2"></i>${{$job2->min_salary}} -
                                                            ${{$job2->min_salary}}</span>


                                                        <span class="text-truncate me-2 comp-detail"><i
                                                                class="fa fa-briefcase text-primary me-2"></i>{{$job2->experience}} Level</span>

                                                        <span class="text-truncate me-2 comp-detail ml-2"><i
                                                                class="far fa-calendar-alt text-primary me-2"></i>{{$job2->created_at->diffForHumans()}}</span>

                                                    </div>
                                                </div>

                                                <div class="d-flex mb-3">
                                                    <a class="btn btn-light btn-square me-3" href="{{Route('unsave_job', $job2->id)}}"><i
                                                            class="fa fa-heart text-primary"></i></a>
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

           
                

                <hr style="background-color: #1967D2;">
                <h4 class="mb-3">Applied Jobs</h4>
                <hr style="background-color: #1967D2;">
                <div class="mb-3">
                    <div class=" py-3">
                        <div class="">
                            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                                <div class="row">

                                    @foreach($job_data as $key => $job2)
                                    <div class="mb-4 col-sm-12 col-md-6">
                                        <div class="job-item p-2">
                                            <div style="display: flex; align-items: flex-start; justify-content: space-between;">

                                                <div class=" d-flex align-items-center">

                                                    <img class="flex-shrink-0 img-fluid border rounded" src="../../../assets/frontend/uploads/{{$job2->company_logo}}" alt="{{$job2->job_title}}"
                                                        style="width: 80px; height: 80px;">

                                                    <div class="text-start ps-2">

                                                        <p class="mb-2"><a href="{{route('job_details', $job2->job_id)}}" style="color: black;">{{$job2->job_title}}</a></p>

                                                        <span class="text-truncate me-2 comp-detail"><i
                                                                class="fa fa-map-marker-alt text-primary me-2"></i>{{$job2->city}}, {{$job2->country}}</span>

                                                        <span class="text-truncate me-2 comp-detail"><i
                                                                class="far fa-clock text-primary me-2"></i>{{$job2->job_type}}</span>
                                                        <span class="text-truncate me-2 comp-detail"><i
                                                                class="far fa-money-bill-alt text-primary me-2"></i>${{$job2->min_salary}} -
                                                            ${{$job2->min_salary}}</span>


                                                        <span class="text-truncate me-2 comp-detail"><i
                                                                class="fa fa-briefcase text-primary me-2"></i>{{$job2->experience}} Level</span>

                                                        <span class="text-truncate me-2 comp-detail ml-2"><i
                                                                class="far fa-calendar-alt text-primary me-2"></i>{{$job2->created_at->diffForHumans()}}</span>

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



<!-- Jobs Start -->
@include('frontend.includes.footer')
<!-- Jobs End -->