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

                        <h4 class="card-title">Website Settings</h4>


                        <form class="forms-sample" action="{{Route('save_settings', $data->id)}}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                @error('title')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="exampleInputtitle1">Title</label>
                                <input type="text" class="form-control" name="title" id="exampleInputtitle1" placeholder="Title" style="color: white;" value="{{ $data->title }}">
                            </div>

                            <div class="form-group">
                                @error('logo_name')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="exampleInputlogo_name1">Logo Name</label>
                                <input type="text" class="form-control" name="logo_name" id="exampleInputlogo_name1" placeholder="Logo Name" style="color: white;" value="{{ $data->logo_name }}">
                            </div>

                            <div class="form-group">
                                @error('email')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="exampleInputemail1">Email</label>
                                <input type="email" class="form-control" name="email" id="exampleInputemail1" placeholder="Email" style="color: white;" value="{{ $data->email }}">
                            </div>

                            <div class="form-group">
                                @error('address')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="exampleInputaddress1">Address</label>
                                <input type="text" class="form-control" name="address" id="exampleInputaddress1" placeholder="Address" style="color: white;" value="{{ $data->address }}">
                            </div>

                            <div class="form-group">
                                @error('phone_no')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="exampleInputphone_no1">Phone Number</label>
                                <input type="tel" class="form-control" name="phone_no" id="exampleInputphone_no1" placeholder="Phone Number" style="color: white;" value="{{ $data->phone_no }}">
                            </div>

                            <div class="form-group">
                                @error('seo')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="exampleInputseo1">Seo</label>
                                <input type="text" class="form-control" name="seo" id="exampleInputseo1" placeholder="Seo" style="color: white;" value="{{ $data->seo }}">
                            </div>

                            <div class="form-group">
                                @error('about')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="exampleInputabout1">About</label>
                                <textarea class="form-control" style="color: white;" name="about" id="">{{ $data->about }}</textarea>
                            </div>

                            
                            <div class="form-group">
                                <img style="width: 100px; height:100px; object-fit:cover;" src="../../../../assets/frontend/uploads/{{ $data->fave_icon }}" alt="{{ $data->title}}">
                                <br>
                                @error('fave_icon')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="exampleInputfave_icon1">Fave_icon</label>
                                <input type="file" class="form-control" name="fave_icon" id="exampleInputfave_icon1" placeholder="Fave_icon">
                            </div>

                            <br>

                            <button type="submit" class="btn btn-primary mr-2">Update</button>
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