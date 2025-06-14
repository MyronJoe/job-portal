<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">

            <div class="col-lg-6 col-md-6">
                <h5 class="text-white mb-4">Quick Links</h5>
                <a class="btn btn-link text-white-50" href="/">Home</a>
                <a class="btn btn-link text-white-50" href="{{Route('view_more')}}">Find Jobs</a>
                <a class="btn btn-link text-white-50" href="{{Route('categories')}}">View Categories</a>
                <a class="btn btn-link text-white-50" href="{{Route('profile')}}">Profile</a>
                 @if (Route::has('login'))
                @auth
                <a class="btn btn-link text-white-50" href="{{Route('logoutUser')}}">Logout</a>
                @else
               <a class="btn btn-link text-white-50" href="{{Route('login')}}">Login</a>
                @endauth
                @endif


            </div>
            <div class="col-lg-6 col-md-6">
                <h5 class="text-white mb-4">Contact</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{$settings->address}}</p>
                <a href="tel:{{$settings->phone_no}}">
                    <p class="mb-2" style="color: #959CA0;"><i class="fa fa-phone-alt me-3"></i>{{$settings->phone_no}}</p>
                </a>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{$settings->email}}</p>

               

                <!-- <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-linkedin-in"></i></a>
                </div> -->
            </div>

        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">{{$settings->logo_name}}</a>, All Right Reserved.</a>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="/">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

@include('sweetalert::alert')

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/frontend/lib/wow/wow.min.js"></script>
<script src="../../assets/frontend/lib/easing/easing.min.js"></script>
<script src="../../assets/frontend/lib/waypoints/waypoints.min.js"></script>
<script src="../../assets/frontend/lib/owlcarousel/owl.carousel.min.js"></script>

<script src="../../assets/frontend/js/main.js"></script>
</body>

</html>