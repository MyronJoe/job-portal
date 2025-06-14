<!-- Header Start -->
@include('frontend.includes.header')
<!-- Header End -->

<!-- Navbar Start -->
@include('frontend.includes.navbar')
<!-- Navbar End -->

<!-- Breadcrumb End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Messages</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">

                <li class="breadcrumb-item"><a href="/" class="btn btn-primary py-md-2 px-md-3 animated slideInRight">Home</a></li>


                @if (Route::has('login'))
                @auth
                @if (Auth::user()->user_type === 'Job Seeker')

                <li class="breadcrumb-item"><a href="{{Route('get_messages')}}" class="btn btn-success py-md-2 px-md-3 animated slideInRight">Notification <span class="badge badge-light" style="background-color: white; color:black">{{$message_no}}</span></a></li>

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


     
        <div style="display:flex; justify-content:space-between; align-items:flex-start; background-color:#F8FBF1; padding:15px; border-radius:6px; margin-bottom:15px; flex-direction:column;">

            <style>
                .p {
                    margin-top: 10px;
                }
            </style>

            <h5>{{$data->message}}</h5>

            <p class="p">{{$data->measage_body}}</p>

            <h6>{{$data->meassage_footer}}</h6>
            
            <small>Thank You!</small>

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