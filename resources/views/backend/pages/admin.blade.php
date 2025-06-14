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




        <div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Admin Users</h4>


         

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> S/N </th>
                                        <th> Image</th>
                                        <th> Name </th>
                                        <th> Email </th>
                                        <th> Role </th>
                                        <th> Delete </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $user)
                                    <tr>
                                        <td> {{$key + 1}} </td>
                                        <td class="py-1">
                                            <img src="../../../assets/frontend/uploads/{{$user->profile_pic}}" alt="image" />
                                        </td>
                                        <td> {{$user->name}} </td>
                                        <td> {{$user->email}} </td>
                                        <td>
                                            Admin
                                        </td>
                                        <td>
                                            <a onclick="confirmation(event)" href="{{route('delete_user', $user->id)}}" class="badge badge-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
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
            text: "To Deleted This Data!",
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