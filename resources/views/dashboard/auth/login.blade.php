@section('title', 'دخول')

@include('dashboard.layouts.css')

<body class="main-body bg-light">

<!-- Loader -->
<div id="global-loader">
    <img src="{{ asset('dashboard') }}/assets//img/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->

<!-- Page -->
<div class="page">

    <div class="container-fluid">
        <div class="row no-gutter">

            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex"> <a href="#"><img
                                                src="{{ asset('dashboard') }}/assets/img/media/logo-Administrative-Prosecution.png"
                                                class="sign-favicon ht-40" alt="logo"></a>
                                        <h1 class="main-logo1 mr-1 my-auto tx-28">هيئة<span> النيابه</span>
                                            الأدارية</h1>
                                    </div>
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h5 class="font-weight-semibold">من فضلك سجل دخولك للمتابعة.</h5>
                                            <div class="container">

                                            </div><!-- col-4 -->
                                            {{-- Login Admin --}}
                                            <div class="login-form">
                                                <div class="font-size-18 mt-5 text-center">
                                                    <h2>مرحبًا بعودتك!</h2>
                                                    <p class="text-muted text-center">الدخول</p>
                                                </div>

                                                <form id="login-form" method="POST"
                                                      action="{{ route('login') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label> البريد الالكتروني</label>
                                                        <input class="form-control" name="email"
                                                               value="{{ old('email') }}"
                                                               placeholder="أدخل بريدك الإلكتروني" type="text">
                                                        <div class="alert alert-danger d-none" id="email-error">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>كلمة المرور</label>
                                                        <input class="form-control" name="password"
                                                               placeholder="ادخل رقمك السري" type="password">
                                                        <div class="alert alert-danger d-none" id="password-error">
                                                        </div>
                                                    </div>
                                                    <div class="alert alert-danger d-none" id="general-error"></div>
                                                    <button type="button" class="btn btn-main-primary btn-block"
                                                            id="login-button">تسجيل الدخول</button>
                                                    <div class="row row-xs"></div>
                                                </form>



                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->

            <!-- The image half -->

            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex " style="background-color:#2C2930">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{ asset('dashboard/assets/img/media/Administrative-Prosecution.png') }}"
                             class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo"
                             style="border-radius: 10px;">
                    </div>
                </div>
            </div>



        </div>
    </div>

</div>
<!-- End Page -->

<!-- JQuery min js -->
<script src="{{ asset('dashboard') }}/assets//plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Bundle js -->
<script src="{{ asset('dashboard') }}/assets//plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Ionicons js -->
<script src="{{ asset('dashboard') }}/assets//plugins/ionicons/ionicons.js"></script>

<!-- Moment js -->
<script src="{{ asset('dashboard') }}/assets//plugins/moment/moment.js"></script>

<!-- eva-icons js -->
<script src="{{ asset('dashboard') }}/assets//js/eva-icons.min.js"></script>

<!-- Rating js-->
<script src="{{ asset('dashboard') }}/assets//plugins/rating/jquery.rating-stars.js"></script>
<script src="{{ asset('dashboard') }}/assets//plugins/rating/jquery.barrating.js"></script>

<!-- custom js -->
<script src="{{ asset('dashboard') }}/assets//js/custom.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#login-button').click(function(e) {
            e.preventDefault();

            var email = $('input[name="email"]').val();
            var password = $('input[name="password"]').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: $('#login-form').attr('action'),
                method: 'POST',
                data: {
                    _token: _token,
                    email: email,
                    password: password
                },
                success: function(response) {
                    $('.alert').addClass('d-none'); // Hide all alerts initially

                    if (response.status === 'error') {
                        if (response.errors) {
                            if (response.errors.email) {
                                $('#email-error').text(response.errors.email).removeClass(
                                    'd-none');
                            }
                            if (response.errors.password) {
                                $('#password-error').text(response.errors.password)
                                    .removeClass('d-none');
                            }
                        } else {
                            $('#general-error').text(response.message).removeClass(
                                'd-none');
                        }
                    } else {
                        window.location.href = "{{ route('dashboard.user') }}";
                    }
                },
                error: function(response) {
                    $('.alert').addClass('d-none'); // Hide all alerts initially

                    if (response.responseJSON && response.responseJSON.errors) {
                        var errors = response.responseJSON.errors;
                        if (errors.email) {
                            $('#email-error').text(errors.email).removeClass('d-none');
                        }
                        if (errors.password) {
                            $('#password-error').text(errors.password).removeClass(
                                'd-none');
                        }
                    } else {
                        $('#general-error').text('An error occurred. Please try again.')
                            .removeClass('d-none');
                    }
                }
            });
        });
    });
</script>





</body>

</html>
