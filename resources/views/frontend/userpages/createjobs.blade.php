<!-- Header Start -->
@include('frontend.includes.header')
<!-- Header End -->

<!-- Navbar Start -->
@include('frontend.includes.navbar')
<!-- Navbar End -->

<!-- Breadcrumb End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Create Job</h1>
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


                <div class="wow fadeInUp" data-wow-delay="0.5s">
                    <form action="{{Route('add_job')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                @error('job_title')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="job_title" placeholder="Job Title" value="{{ old('job_title') }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                @error('job_type')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="email" name="job_type" placeholder="Job Type" value="{{ old('job_type') }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                @error('min_salary')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="min_salary" placeholder="Min Salary" value="{{ old('min_salary') }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                @error('max_salary')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="email" name="max_salary" placeholder="Max Salary" value="{{ old('max_salary') }}">

                                </div>
                            </div>



                            <div class="col-md-6">
                                @error('company_name')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="email" name="company_name" placeholder="Company Name" value="{{ old('company_name') }}">

                                </div>
                            </div>



                            <div class="col-md-6">
                                @error('address')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="address" id="subject" placeholder="Address" value="{{ old('address') }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                @error('city')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="city" id="subject" placeholder="City" value="{{ old('city') }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                @error('country')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="email" name="country" placeholder="Country" value="{{ old('country') }}">

                                </div>
                            </div>


                            <div class="col-12">
                                @error('experience')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="">Experience Level</label>
                                <div class="form-floating">
                                    <select name="experience" id="experience" class="form-control">
                                        <option value="{{ old('experience') }}">{{ old('experience') }}</option>
                                        
                                        <option value="none">none</option>
                                        <option value="Junior">Junior</option>
                                        <option value="Mid">Mid</option>
                                        <option value="Senior">Senior</option>
                                       
                                    </select>

                                </div>
                            </div>

                            <div class="col-12">
                                @error('category')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="">Job Category</label>
                                <div class="form-floating">
                                    <select name="category" id="category" class="form-control">
                                        <option value="{{ old('category') }}">{{ old('category') }}</option>
                                        @foreach($data as $key => $category)
                                        <option value="{{$category->category}}">{{$category->category}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-12">
                                @error('company_logo')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="">Company Logo</label>
                                <div class="form-floating">
                                    <input type="file" class="form-control" id="email" name="company_logo" placeholder="company_logo" value="{{ old('company_logo') }}">

                                </div>
                            </div>

                            <div class="col-12">
                                @error('description')
                                <span style="text-align: left;" class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="message">Job Description</label>

                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Description" id="editor" style="height: 150px" name="description">
                                    {{ old('description') }}
                                    </textarea>

                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Create Job</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Job Detail End -->


<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>


<!-- Jobs Start -->
@include('frontend.includes.footer')
<!-- Jobs End -->