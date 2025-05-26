<!-- Header Start -->
@include('backend.includes.header')
<!-- Header End -->

<!-- Sidebar Start -->
@include('backend.includes.sidebar')
<!-- Sidebar End -->

<!-- Navbar Start -->
@include('backend.includes.navbar')
<!-- Navbar End -->




<div class="main-panel">
    <div class="content-wrapper">




        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Create Category</h4>

                        <a href="{{Route('all_category')}}" class="badge badge-outline-primary">All Category</a>

                        <form class="forms-sample" action="{{Route('add_category')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                @error('category')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="exampleInputcategory1">Category</label>
                                <input type="text" class="form-control" name="category" id="exampleInputcategory1" placeholder="category" style="color: white;" value="{{ old('category') }}">
                            </div>

                            <!-- <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Confirm Password</label>
                                <input type="password" class="form-control" id="exampleInputConfirmPassword1"
                                    placeholder="Password">
                            </div>
                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"> Remember me </label>
                            </div> -->

                            <button type="submit" class="btn btn-primary mr-2">Create</button>
                            <!-- <button class="btn btn-dark">Cancel</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>




    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Job Portal
                2025</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a
                    href="/" target="_blank">Job Portal</a></span>
        </div>
    </footer>
    <!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->









<!-- Footer Section -->


</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="../../assets/backend/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="../../assets/backend/vendors/chart.js/Chart.min.js"></script>
<script src="../../assets/backend/vendors/progressbar.js/progressbar.min.js"></script>
<script src="../../assets/backend/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="../../assets/backend/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../../assets/backend/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../../assets/backend/js/off-canvas.js"></script>
<script src="../../assets/backend/js/hoverable-collapse.js"></script>
<script src="../../assets/backend/js/misc.js"></script>
<script src="../../assets/backend/js/settings.js"></script>
<script src="../../assets/backend/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="../../assets/backend/js/dashboard.js"></script>
<!-- End custom js for this page -->
</body>

</html>