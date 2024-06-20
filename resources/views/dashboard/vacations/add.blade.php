@extends('dashboard.layouts.master')
@section('title', 'طلب أجازة')
@section('page-title', 'طلب أجازة')
@section('page-link-back')
    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.employees.index') }}">طلب أجازة</a></li>
@endsection
@section('current-page', 'طلب أجازة')
@section('css')
    <link href="{{ asset('dashboard/assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
@endsection

@section('content')
    @include('dashboard.messages_alert')

    <div class="row row-sm">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0 ">
                <div class="card-header">
                    <h4 class="card-title mb-1 text-center">طلب أجازه</h4>
                </div>
                <div class="card-body pt-0">
                    <form id="vacationForm" action="{{ route('dashboard.vacations.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Success Message -->
                        <div id="successMessage" class="alert alert-success d-none" role="alert">
                            تم أضافة أجازة الموظف بنجاح <a href="{{ route('dashboard.vacations.index') }}"
                                class="alert-link">أضغط هنا لمشاهدة الأضافة</a>
                        </div>

                        <div class="row">
                            {{-- Employee Input --}}
                            <div class="form-group col-6">
                                <label for="employeeSelect">أختر الموظف</label>
                                <select name="employee_id" id="employeeSelect"
                                    class="form-control select2 @error('employee_id') is-invalid @enderror">
                                    <option disabled selected>افتح قائمة التحديد</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                                <div id="employee_id-error" class="error-message alert alert-danger d-none"></div>
                            </div>

                            {{-- Type Of Vacation Input --}}
                            <div class="form-group col-6" id="type_field">
                                <label for="typeSelect">نوع الأجازه</label>
                                <select name="type" id="typeSelect"
                                    class="form-control select2-no-search @error('type') is-invalid @enderror">
                                    <option value="" selected disabled> -- افتح قائمة التحديد --</option>
                                    <option value="satisfying">مرضى</option>
                                    <option value="emergency">عارضه</option>
                                    <option value="regular">إعتيادى</option>
                                    <option value="Annual">سنوى</option>
                                    <option value="mission">مأمورية</option>
                                </select>
                                <div id="type-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Internal And External Input --}}
                            <div class="form-group col-6" id="int_ext_field">
                                <label for="intExtSelect">داخلية / خارجيه</label>
                                <select name="int_ext" id="intExtSelect"
                                    class="form-control select2 @error('int_ext') is-invalid @enderror">
                                    <option disabled selected>افتح قائمة التحديد</option>
                                    <option value="internal">نيابات</option>
                                    <option value="external">جهه خارجيه</option>
                                </select>
                                <div id="int_ext-error" class="error-message alert alert-danger d-none"></div>
                            </div>

                            {{-- Department Input --}}
                            <div class="form-group col-6" id="department_field">
                                <label for="departmentSelect">النيابات</label>
                                <select name="department_id" id="departmentSelect" class="form-control select2">
                                    <option disabled selected>افتح قائمة التحديد</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->branch }}</option>
                                    @endforeach
                                </select>
                                <div id="department_id-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Acting Employee Input --}}
                            <div class="form-group col-6" id="acting_employee_field">
                                <label for="actingEmployeeSelect">القائم بأعماله</label>
                                <select name="acting_employee_id" id="actingEmployeeSelect"
                                    class="form-control select2 @error('acting_employee_id') is-invalid @enderror">
                                    <option disabled selected>افتح قائمة التحديد</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                                <div id="acting_employee_id-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Start Input --}}
                            <div class="form-group col-6">
                                <label for="startInput">من يوم</label>
                                <input name="start" id="startInput"
                                    class="form-control fc-datepicker @error('start') is-invalid @enderror" type="date">
                                <div id="start-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                            <div class="form-group col-6">
                                <label for="toInput">إلى يوم</label>
                                <input name="to" id="toInput"
                                    class="form-control fc-datepicker @error('to') is-invalid @enderror" type="date">
                                <div id="to-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Notes Input --}}
                            <div class="form-group col-12">
                                <label for="notesTextarea">ملاحظات</label>
                                <textarea name="notes" id="notesTextarea" class="form-control" placeholder="أدخل ملاحظاتك" rows="3"></textarea>
                                <div id="notes-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                        </div>


                        <div class="row">
                            {{-- Image Inputs --}}
                            <div class="form-group col-10">
                                <label for="example-text-input" class="col-form-label">المرفقات</label>
                                <input class="form-control @error('photo') is-invalid @enderror" accept="photo/*"
                                    name="photo" type="file" id="example-text-input" onchange="loadFile(event)">
                                <img class="rounded-circle avatar-xl my-3" />

                                <img alt="Responsive image" class="img-fluid" id="output">
                                <div id="file-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                        </div>



                        {{-- Submit --}}
                        <div class="row row-xs wd-xl-80p">
                            <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">
                                <button type="submit" class="btn btn-success btn-with-icon btn-block">
                                    <i class="typcn typcn-edit"></i> تأكيد البيانات
                                </button>
                            </div>
                            <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">
                                <a href="{{ route('dashboard.vacations.index') }}"
                                    class="btn btn-info btn-with-icon btn-block">
                                    <i class="typcn typcn-arrow-back-outline"></i> رجوع
                                </a>
                            </div>
                        </div>
                    </form>
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
        <!-- Internal Datepicker js -->
        <script src="{{ asset('dashboard/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
        <!--Internal jquery.maskedinput js -->
        <script src="{{ asset('dashboard/assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
        <!--Internal spectrum-colorpicker js -->
        <script src="{{ asset('dashboard/assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
        <!--Internal Ion.rangeSlider.min js -->
        <script src="{{ asset('dashboard/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>

        <script src="{{ asset('dashboard/assets/js/projects/add-vacation.js') }}"></script>


    @endsection
