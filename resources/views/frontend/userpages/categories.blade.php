<!-- Header Start -->
@include('frontend.includes.header')
<!-- Header End -->

<!-- Navbar Start -->
@include('frontend.includes.navbar')
<!-- Navbar End -->


<!-- Jobs Start -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-2 wow fadeInUp" data-wow-delay="0.1s">All Job Categories ({{$count}})</h1>
        <p class="text-center mt-n1 mb-5">Browse different job categories</p>
        <div class="row g-4">

            @foreach($data as $tag)
            <div class="col-sm-12 col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                <a href="{{Route('category', $tag->category)}}" class="cat-item rounded p-4" style="display: flex; align-items: center;">
                    <div style="background-color: #f2f5ff; width: 80px; height: 80px; margin-right: 20px; border-radius: 7px;"
                        class="p-3">
                        <i class="fa fa fa-mail-bulk text-primary mb-4" style="font-size: 45px;"></i>
                    </div>
                    <div>
                        <h6 class="mb-3">{{$tag->category}}</h6>

                        <p class="mb-0">View More <i class="fa fa-arrow-circle-right"></i></p>
                    </div>
                </a>
            </div>
            @endforeach





        </div>
    </div>
</div>

@if($count === 0)
<p>No Data Available</p>
@endif
<!-- Jobs End -->


<!-- Footer Start -->
@include('frontend.includes.footer')
<!-- Footer End -->