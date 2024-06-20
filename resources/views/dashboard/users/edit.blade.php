@extends('dashboard.layouts.master')
@section('title', 'أضافة مستخدم')

@section('css')
    <!---Internal Fancy uploader css-->
    <link href="{{ asset('dashboard/assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal TelephoneInput css-->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
    <!--- Animations css-->
    <link href="{{ asset('dashboard/assets/css/animate.css') }}" rel="stylesheet">
@endsection

@section('page-title', 'أضافة مستخدم')
@section('page-link-back')
    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.employees.index') }}">المستخدمين</a></li>
@endsection
@section('current-page', 'أضافة مستخدم')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-header">
                    {{--                    @include('dashboard.messages_alert')--}}
                    <h4 class="card-title mb-1 text-center">أدخل بيانات المستخدم</h4>
                </div>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="card-body pt-0">
                    <form id="employeeForm" action="{{ route('dashboard.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- Success Message --}}
                        <div id="successMessage" class="alert alert-success d-none" role="alert">
                            تم أضافة بيانات المستخدم بنجاح <a href="{{ route('dashboard.users.index') }}" class="alert-link">أضغط هنا لمشاهدة الأضافة</a>
                        </div>

                        <div class="row">
                            {{-- Name Input --}}
                            <div class="form-group col-6">
                                <label for="name">أسم المستخدم</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name" placeholder="أدخل الأسم">
                                <div id="name-error" class="error-message alert alert-danger d-none"></div>
                            </div>

                            {{-- Email Input --}}
                            <div class="form-group col-6">
                                <label for="email">البريد الالكترونى</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder="أدخل البريد الالكترونى">
                                <div id="email-error" class="error-message alert alert-danger d-none"></div>
                            </div>

                            {{-- Password Input --}}
                            <div class="form-group col-6">
                                <label for="password">كلمة المرور</label>
                                <input type="password" name="password"  class="form-control" id="password" placeholder="أدخل كلمة المرور">
                                <div id="password-error" class="error-message alert alert-danger d-none"></div>
                            </div>

                            {{-- Confirmation Password Input --}}
                            <div class="form-group col-6">
                                <label for="confirm-password">تأكيد كلمة المرور</label>
                                <input type="password" name="confirm-password"  class="form-control" id="confirm-password" placeholder="أدخل تأكيد كلمة المرور">
                                <div id="confirm-password-error" class="error-message alert alert-danger d-none"></div>
                            </div>

                            {{-- Roles Input --}}
                            <div class="form-group col-6">
                                <label for="roles">صلاحية المستخدم</label>
                                <select class="form-control multiple" multiple name="roles[]">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                                <div id="roles-error" class="error-message alert alert-danger d-none"></div>
                            </div>

                            {{-- Status Input --}}
                            <div class="form-group col-6">
                                <label for="status">حالة المستخدم</label>
                                <select name="status" value="{{ old('status') }}" class="form-control select2">
                                    <option value="{{ $user->status}}">{{ $user->status}}</option>
                                    <option value="مفعل">مفعل</option>
                                    <option value="غير مفعل">غير مفعل</option>
                                </select>
                                <div id="status-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="row row-xs wd-xl-80p my-3">
                            <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">
                                <button type="submit" class="btn btn-success btn-with-icon btn-block">
                                    <i class="typcn typcn-edit"></i> تأكيد البيانات
                                </button>
                            </div>
                            <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">
                                <a href="{{ route('dashboard.users.index') }}" class="btn btn-info btn-with-icon btn-block">
                                    <i class="typcn typcn-arrow-back-outline"></i> رجوع
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Internal Select2.min js -->
    <script src="{{ asset('dashboard/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ asset('dashboard/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!--Internal jquery-simple-datetimepicker js -->
    <script src="{{ asset('dashboard/assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <!-- Ionicons js -->
    <script src="{{ asset('dashboard/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
    <!--Internal pickerjs js -->
    <script src="{{ asset('dashboard/assets/plugins/pickerjs/picker.min.js') }}"></script>
    <!--Internal Form-elements js-->
    <script src="{{ asset('dashboard/assets/js/advanced-form-elements.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ asset('dashboard/assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal Datepicker js -->
    <script src="{{ asset('dashboard/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal jquery.maskedinput js -->
    <script src="{{ asset('dashboard/assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal spectrum-colorpicker js -->
    <script src="{{ asset('dashboard/assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ asset('dashboard/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>

    <script src="{{ asset('dashboard/assets/js/projects/add-users.js') }}"></script>
@endsection
