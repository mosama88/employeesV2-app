@extends('dashboard.layouts.master')
@section('title', 'أضافة موظف')
@section('css')
    <!---Internal Fancy uploader css-->
    <link href="{{ asset('dashboard') }}/assets/plugins/fancyuploder/fancy_fileupload.css" rel="stylesheet" />

    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/sumoselect/sumoselect-rtl.css">

    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/telephoneinput/telephoneinput-rtl.css">

    <!--- Animations css-->
    <link href="{{ asset('dashboard') }}/assets/css/animate.css" rel="stylesheet">


@endsection

@section('page-title', 'أضافة موظف')
@section('page-link-back')
    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i class="fas fa-home"></i></a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.employees.index') }}">الموظفين</a>
    </li>
@endsection
@section('current-page', 'أضافة موظف')
@section('content')

    <div class="row row-sm">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0 ">
                <div class="card-header">
                    @include('dashboard.messages_alert')

                    <h4 class="card-title mb-1 text-center">أدخل بيانات الموظف</h4>
                </div>
                <div class="card-body pt-0">

                    {{-- Form Add Employee --}}
                    <form id="employeeForm" action="{{ route('dashboard.employees.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        {{-- Success Message --}}
                        <div id="successMessage" class="alert alert-success d-none" role="alert">
                            تم أضافة بيانات الموظف بنجاح <a href="{{ route('dashboard.employees.index') }}"
                                class="alert-link">أضغط هنا لمشاهدة الأضافة</a>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                {{-- Name Inputs --}}
                                <label for="exampleInputEmail1">أسم الموظف</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    id="name" placeholder="أدخل الأسم">
                                <div id="name-error" class="error-message alert alert-danger d-none"></div>
                            </div>

                            {{-- Appointments Inputs --}}
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">الراحة الاسبوعية</label>
                                <select multiple="multiple" class="testselect2" name="appointments[]">
                                    <option disabled selected>افتح قائمة التحديد</option>
                                    @foreach ($appointments as $appointment)
                                        <option value="{{ $appointment->id }}"
                                            {{ is_array(old('appointments')) && in_array($appointment->id, old('appointments')) ? 'selected' : '' }}>
                                            {{ $appointment->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="appointments-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                {{-- phone Inputs --}}
                                <label for="exampleInputEmail1">الهاتف</label>
                                <input type="tel" value="{{ old('phone') }}" class="form-control" name="phone"
                                    id="exampleInputEmail1" placeholder="01111111">
                                <div id="phone-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                            <div class="form-group col-6">
                                {{-- alter_phone Inputs --}}
                                <label for="exampleInputPassword1">هاتف أخر</label>
                                <input type="tel" value="{{ old('alter_phone') }}" class="form-control"
                                    name="alter_phone" id="exampleInputPassword1" placeholder="01111111">
                                <div id="alter_phone-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- birth_date Inputs --}}
                            <div class="form-group col-3">
                                <label for="birth_date">تاريخ الميلاد</label>
                                <input id="birth_date" class="form-control fc-datepicker" name="birth_date" placeholder="MM/DD/YYYY" type="date">
                                <div id="birth_date-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                            {{-- hiring_date Inputs --}}
                            <div class="form-group col-3">
                                <label for="hiring_date">تاريخ التعيين</label>
                                <input id="hiring_date" class="form-control fc-datepicker" name="hiring_date" placeholder="MM/DD/YYYY" type="date">
                                <div id="hiring_date-error" class="error-message alert alert-danger d-none"></div>
                            </div>


                            {{-- start_from Inputs --}}
                            <div class="form-group col-3">
                                <label for="start_from">بداية أستلام العمل بالادارة</label>
                                <input class="form-control fc-datepicker"
                                    name="start_from" placeholder="MM/DD/YYYY" type="date">
                                <div id="start_from-error" class="error-message alert alert-danger d-none"></div>
                            </div>

                            {{-- add_service Inputs --}}
                            <div class="form-group col-3">
                                <label for="add_service">ضم خدمه</label>
                                <input type="number" name="add_service" value="{{ old('add_service') }}" class="form-control" id="add_service" placeholder="أدخل ضم خدمه">
                                <div id="add_service-error" class="error-message alert alert-danger d-none"></div>
                            </div>

                            {{-- years_service Inputs --}}
                            <div class="form-group col-3">
                                <label for="years_service">عدد سنوات الخدمه</label>
                                <input type="text" name="years_service" value="{{ old('years_service') }}" class="form-control" id="years_service" placeholder="أدخل عدد سنوات الخدمه" readonly>
                                <div id="years_service-error" class="error-message alert alert-danger d-none"></div>
                            </div>

                            {{-- num_of_days Inputs --}}
                            <div class="form-group col-3">
                                <label for="num_of_days">عدد الأجازات المستحقه</label>
                                <input id="num_of_days" name="num_of_days" class="form-control fc-datepicker" placeholder="أدخل الاجازات المستحقه" type="text" readonly>
                                <div id="num_of_days-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="form-group col-4">
                                {{-- Address Inputs --}}
                                <label for="exampleInputaddress">المحافظة</label>
                                <select name="address_id" value="{{ old('address_id') }}" class="form-control select2">
                                    <option disabled selected="">افتح قائمة التحديد</option>
                                    @foreach ($addresses as $address)
                                        <option
                                            value="{{ $address->id }}"{{ old('address_id') == $address->id ? 'selected' : '' }}>
                                            {{ $address->city }}</option>
                                    @endforeach
                                </select>
                                <div id="address_id-error" class="error-message alert alert-danger d-none"></div>
                            </div>

                            <div class="form-group col-4">
                                <label for="exampleInputdepartment">النيابة /الإدارة التابع لها</label>
                                <select name="department_id" value="{{ old('department_id') }}"
                                    class="form-control select2">
                                    <option disabled selected="">افتح قائمة التحديد</option>
                                    @foreach ($departments as $department)
                                        <option
                                            value="{{ $department->id }}"{{ old('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->branch }}</option>
                                    @endforeach
                                </select>
                                <div id="department_id-error" class="error-message alert alert-danger d-none"></div>
                            </div>

                            <div class="form-group col-4">
                                {{-- job_grades_id Inputs --}}
                                <label for="selectFormgrade">الدرجه الوظيفية</label>
                                <select name="job_grades_id" value="{{ old('job_grades_id') }}"
                                    class="form-control select2">
                                    <option disabled selected="">افتح قائمة التحديد</option>
                                    @foreach ($jobgrades as $jobgrade)
                                        <option
                                            value="{{ $jobgrade->id }}"{{ old('job_grades_id') == $jobgrade->id ? 'selected' : '' }}>
                                            {{ $jobgrade->name }}</option>
                                    @endforeach
                                </select>
                                <div id="job_grades_id-error" class="error-message alert alert-danger d-none"></div>
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
                            <div class="form-group col-12">
                                <label for="example-text-input">صورة الموظف</label>
                                <input class="form-control" accept="image/*" name="photo" value="{{ old('photo') }}"
                                    type="file" id="example-text-input" onchange="loadFile(event)">
                                <img class="rounded-circle avatar-xl my-3" id="output" />
                                <div id="photo-error" class="error-message alert alert-danger d-none"></div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="row row-xs wd-xl-80p">
                            <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0"><button type="submit"
                                    class="btn btn-success btn-with-icon btn-block"><i class="typcn typcn-edit"></i> تأكيد
                                    البيانات</button></div>
                            <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0"><a
                                    href="{{ route('dashboard.employees.index') }}" type="submit"
                                    class="btn btn-info btn-with-icon btn-block"><i
                                        class="typcn typcn-arrow-back-outline"></i> رجوع</a></div>
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
    <script src="{{ asset('dashboard') }}/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>

    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ asset('dashboard') }}/assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js"></script>

    <!-- Ionicons js -->
    <script src="{{ asset('dashboard') }}/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js"></script>

    <!--Internal  pickerjs js -->
    <script src="{{ asset('dashboard') }}/assets/plugins/pickerjs/picker.min.js"></script>



    <!--Internal  Form-elements js-->
    <script src="{{ asset('dashboard') }}/assets/js/advanced-form-elements.js"></script>

    <!--Internal Sumoselect js-->
    <script src="{{ asset('dashboard') }}/assets/plugins/sumoselect/jquery.sumoselect.js"></script>

    <!-- Internal  js-->

    <!--Internal  Datepicker js -->
    <script src="{{ asset('dashboard') }}/assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>


    <!--Internal  jquery.maskedinput js -->
    <script src="{{ asset('dashboard') }}/assets/plugins/jquery.maskedinput/jquery.maskedinput.js"></script>

    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ asset('dashboard') }}/assets/plugins/spectrum-colorpicker/spectrum.js"></script>



    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ asset('dashboard') }}/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>

    <script src="{{ asset('dashboard/assets/js/projects/add-employee.js') }}"></script>


    {{--  add-employee.blade.php --}}

    <script>
        document.getElementById('hiring_date').addEventListener('change', calculateVacationDays);
        document.getElementById('birth_date').addEventListener('change', calculateVacationDays);
        document.getElementById('add_service').addEventListener('change', calculateVacationDays);

        function calculateVacationDays() {
            var hiringDate = document.getElementById('hiring_date').value;
            var birthDate = document.getElementById('birth_date').value;
            var addService = document.getElementById('add_service').value || 0;

            if (hiringDate && birthDate) {
                fetch('{{ route('dashboard.calculateVacationDays') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            hiring_date: hiringDate,
                            birth_date: birthDate,
                            add_service: addService
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('num_of_days').value = data.vacation_days;
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        // Function to calculate years of service
        function calculateYearsOfService() {
            var hiringDate = new Date(document.getElementById('hiring_date').value);
            var addService = parseInt(document.getElementById('add_service').value || 0);
            var currentDate = new Date();

            var yearsOfService = currentDate.getFullYear() - hiringDate.getFullYear();
            yearsOfService += addService;

            document.getElementById('years_service').value = yearsOfService;
        }

        document.getElementById('hiring_date').addEventListener('change', calculateYearsOfService);
        document.getElementById('add_service').addEventListener('input', calculateYearsOfService);
    </script>



@endsection
