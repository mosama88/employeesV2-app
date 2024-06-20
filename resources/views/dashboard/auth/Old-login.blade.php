@section('title', 'دخول')
<style>
    .login-form {
        display: none;
    }

    .select-hide {

        margin-top: 100px;
    }
</style>
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
                                                <div class="container select-hide">
                                                    {{-- Select To login --}}
                                                    <h5 class="mg-b-10">حدد طريقة الدخول</h5>
                                                    <select name="somename" class="form-control select2-no-search"
                                                        id="selectForm" aria-label="Default select example"
                                                        onclick="console.log($(this).val())"
                                                        onchange="console.log('change is firing')" tabindex="-1">
                                                        <option disabled selected="">افتح قائمة التحديد</option>
                                                        <option value="admin">أدمن</option>
                                                        <option value="user">مستخدم</option>
                                                    </select>

                                                    @if ($errors->any())
                                                        @foreach ($errors->all() as $error)
                                                            <div class="alert alert-danger text-center mt-1">
                                                                {{ $error }}
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div><!-- col-4 -->
                                                {{-- Login Admin --}}
                                                <div class="login-form" id="admin">
                                                    <div class="font-size-18 mt-5 text-center">
                                                        <h2>مرحبًا بعودتك!</h2>
                                                        <p class="text-muted text-center">الدخول بواسطة الأدمن</p>
                                                    </div>

                                                    <form method="POST" action="{{ route('admin.login') }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label> البريد الالكتروني للأدمن</label>
                                                            <input class="form-control" name="email"
                                                                placeholder="أدخل بريدك الإلكتروني" type="text">
                                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                                        </div>
                                                        <div class="form-group">
                                                            <label>كلمة المرور</label>
                                                            <input class="form-control" name="password"
                                                                placeholder="ادخل رقمك السري" type="password">
                                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                                        </div><button class="btn btn-main-primary btn-block">تسجيل
                                                            الدخول</button>
                                                        <div class="row row-xs">

                                                        </div>
                                                    </form>
                                                </div>

                                                {{-- Login User --}}
                                                <div class="login-form" id="user">
                                                    <div class="font-size-18 mt-5 text-center">
                                                        <h2>مرحبًا بعودتك!</h2>
                                                        <p class="text-muted text-center">الدخول بواسطة المستخدم
                                                        </p>
                                                    </div>
                                                    <form method="POST" action="{{ route('user.login') }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>البريد الالكتروني للمستخدم</label>
                                                            <input class="form-control" name="email"
                                                                placeholder="أدخل بريدك الإلكتروني" type="text">
                                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                                        </div>
                                                        <div class="form-group">
                                                            <label>كلمة المرور</label>
                                                            <input class="form-control" name="password"
                                                                placeholder="ادخل رقمك السري" type="password">
                                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                                        </div><button class="btn btn-main-primary btn-block">تسجيل
                                                            الدخول</button>

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
    <script>
        $('#selectForm').change(function() {
            var myID = $(this).val();
            $('.login-form').each(function() {
                myID === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        });
    </script>
</body>

</html>
