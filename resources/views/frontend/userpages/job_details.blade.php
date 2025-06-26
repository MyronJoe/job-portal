<!-- Header Start -->
@include('frontend.includes.header')
<!-- Header End -->

<!-- Navbar Start -->
@include('frontend.includes.navbar')
<!-- Navbar End -->

<!-- Breadcrumb End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Job Detail</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">

                <li class="breadcrumb-item"><a href="/" class="btn btn-primary py-md-2 px-md-3 animated slideInRight">Home</a></li>

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
                    <img src="../../../assets/frontend/uploads/{{$data->company_logo}}" alt="{{$data->job_title}}" style="height: 80px; width:80px; border-radius:50%; object-fit:cover">

                    <div class="text-start ">


                        <div class="d-flex">
                            <h3 class="mb-3 mt-3 me-1">{{$data->job_title}} </h3>


                        </div>


                        <span class="text-truncate comp-detail2 me-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$data->city}}, {{$data->country}}</span>
                        <span class="text-truncate comp-detail2 me-2"><i class="far fa-clock text-primary me-2"></i>{{$data->job_type}}</span>
                        <span class="text-truncate comp-detail2 me-2"><i class="far fa-money-bill-alt text-primary me-2"></i>${{$data->min_salary}} -
                            ${{$data->max_salary}}</span>
                        <span class="text-truncate comp-detail2 me-2"><i class="fa fa-briefcase text-primary me-2"></i>{{$data->experience}} Level</span>

                        <span class="text-truncate comp-detail2 me-2 ml-2"><i
                                class="far fa-calendar-alt text-primary me-2"></i>{{$data->created_at->diffForHumans()}}</span>


                        @if($data->applicants_count == 0)
                        <span class="text-truncate comp-detail2 me-2 ml-2"><i
                                class="fa fa-user me-2 text-primary"></i>No Applicant</span>
                        @elseif($data->applicants_count == 1)
                        <span class="text-truncate comp-detail2 me-2 ml-2"><i
                        class="fa fa-user me-2 text-primary"></i>{{$data->applicants_count}} Person Apllied</span>
                        @else
                        <span class="text-truncate comp-detail2 me-2 ml-2"><i
                                class="fa fa-user me-2 text-primary"></i>{{$data->applicants_count}} persons apllied</span>
                        @endif
                    </div>
                </div>

                <hr>

                <div>
                    {!! $data->Description !!}
                </div>

                <div class="">
                    <h4 class="mb-4">Apply For The Job</h4>
                    <form enctype="multipart/form-data" method="POST" action="{{Route('apply_job', $data->id)}}">
                        @csrf
                        <div class="row g-3">

                            @error('cover_later')
                            <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                            @enderror <br>

                            <label for="">Cover Later</label>
                            <div class="col-12">
                                <input type="file" class="form-control bg-white" name="cover_later" accept="application/pdf,application/vnd.ms-excel">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Apply Now</button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- Job Detail End -->



<!-- Jobs Start -->
@include('frontend.includes.footer')
<!-- Jobs End -->