<!-- Header Start -->
@include('frontend.includes.header')
<!-- Header End -->

<!-- Navbar Start -->
@include('frontend.includes.navbar')
<!-- Navbar End -->


<!-- Jobs Start -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-2 wow fadeInUp" data-wow-delay="0.1s">All Featured Jobs ({{$count}})</h1>
        <p class="text-center mt-n1 mb-5">Know your worth and find the job that qualify your life</p>
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

                                    <p class="mb-2"><a href="{{route('job_details', $job->id)}}" style="color: black;">{{$job->job_title}}</a></p>

                                    <span class="text-truncate me-2 comp-detail"><i
                                            class="fa fa-map-marker-alt text-primary me-2"></i>{{$job->city}}, {{$job->country}}</span>

                                    <span class="text-truncate me-2 comp-detail"><i
                                            class="far fa-clock text-primary me-2"></i>{{$job->job_type}}</span>
                                    <span class="text-truncate me-2 comp-detail"><i
                                            class="far fa-money-bill-alt text-primary me-2"></i>${{$job->min_salary}} -
                                        ${{$job->max_salary}}</span>


                                    <span class="text-truncate me-2 comp-detail"><i
                                            class="fa fa-briefcase text-primary me-2"></i>{{$job->experience}} Level</span>

                                    <span class="text-truncate me-2 comp-detail"><i
                                            class="fa fa-briefcase text-primary me-2"></i>{{$job->category}}</span>

                                    <span class="text-truncate me-2 comp-detail ml-2"><i
                                            class="far fa-calendar-alt text-primary me-2"></i>{{$job->created_at->diffForHumans()}}</span>

                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <a class="btn btn-light btn-square me-3" href="{{Route('save_job', $job->id)}}"><i
                                        class="far fa-heart text-primary"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

                @if($count === 0)
                    <p>No Data Available</p>
                @endif

            </div>

        </div>
    </div>
</div>
<!-- Jobs End -->


<!-- Footer Start -->
@include('frontend.includes.footer')
<!-- Footer End -->