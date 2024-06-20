@extends('dashboard.layouts.master')
@section('title', 'الأجازات')
@section('page-title', 'الأجازات')
@section('page-link-back')
    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
    </li>
@endsection
@section('current-page', 'الأجازات')
@section('css')
    <link href="{{ asset('dashboard/assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
@endsection

@php
    $currentYear = date('Y');
    $startYear = $currentYear - 5; // Adjust the number of previous years you want to display
@endphp
@section('content')
    @include('dashboard.messages_alert')



    <div class="row row-sm">
        <div class="col-xl-10 mx-auto">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between mx-auto">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="">
                                <a class="main-header-arrow" href="" id="ChatBodyHide"><i
                                        class="icon ion-md-arrow-back"></i></a>
                                <div class="main-content-body main-content-body-contacts card custom-card">
                                    <div class="main-contact-info-header pt-3">
                                        <div class="media">
                                            <div class="main-img-user">
                                                @if ($employee->image)
                                                    <img alt="Responsive image" class="img-thumbnail wd-100p wd-sm-200"
                                                        src="{{ asset('dashboard/assets/images/uploads/employees/' . $employee->image->filename) }}"
                                                        data-holder-rendered="true"><a
                                                        href="#"><i
                                                            class="fe fe-camera"></i></a>
                                                @else
                                                    <img alt="Responsive image" class="img-thumbnail wd-100p wd-sm-200"
                                                        src="{{ asset('dashboard/assets/img/employees-default.png') }}"
                                                        data-holder-rendered="true"><a href=""><i
                                                            class="fe fe-camera"></i></a>
                                                @endif
                                            </div>
                                            <div class="media-body">
                                                <h5>{{ $employee->name }}</h5>
                                                <p>{{ $employee->jobgrade->name }}</p>
                                            </div>
                                        </div>

                                        <div class="main-contact-action btn-list pt-3 pr-3">
                                            <a href="{{ route('dashboard.employees.edit', $employee->id) }}"
                                                class="btn ripple btn-primary text-white btn-icon" data-placement="top"
                                                data-toggle="tooltip" title="" data-original-title="تعديل المستخدم"><i
                                                    class="fe fe-edit"></i></a>
                                        </div>
                                    </div>

                                    <div class="main-contact-info-body p-4 ps">
                                        <div>

                                        </div>
                                        <div class="media-list pb-0">
                                            <div class="media">
                                                <div class="media-body">
                                                    <div>
                                                        <label>موبايل</label> <span
                                                            class="tx-medium">{{ $employee->phone }}</span>
                                                    </div>
                                                    <div>
                                                        <label>موبايل أخر</label> <span
                                                            class="tx-medium">{{ $employee->alter_phone }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-body">


                                                    <div>
                                                        <label>تاريخ الميلاد</label> <span
                                                            class="tx-medium">{{ $employee->birth_date }}</span>
                                                    </div>
                                                    <div>
                                                        <label>تاريخ التعيين</label> <span
                                                            class="tx-medium">{{ $employee->hiring_date }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="media">
                                                <div class="media-body">
                                                    <div>
                                                        <label>ضم خدمه</label>
                                                        <span class="tx-medium">
                                                            @php
                                                                $addServiceText = 'لا يوجد ضم خدمه';
                                                                if ($employee->add_service == 1) {
                                                                    $addServiceText = 'سنه';
                                                                } elseif ($employee->add_service == 2) {
                                                                    $addServiceText = 'سنتين';
                                                                } elseif ($employee->add_service > 2) {
                                                                    $addServiceText = $employee->add_service . ' سنوات';
                                                                }
                                                            @endphp
                                                            {{ $addServiceText }}
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <label>عدد سنوات الخدمه</label> <span
                                                            class="tx-medium">{{ $employee->years_service }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="media">
                                                <div class="media-body">
                                                    <div>
                                                        <label>بداية أستلام العمل بالأداره</label> <span
                                                            class="tx-medium">{{ $employee->start_from }}</span>
                                                    </div>

                                                    <div>
                                                        <label>الراحه الاسبوعيه</label> <span class="tx-medium">
                                                            @foreach ($employee->employeeAppointments as $appointment)
                                                                {{ $appointment->name }}
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media mb-0">
                                                <div class="media-body">

                                                    <div>
                                                        <label>النيابة / مكتب</label> <span
                                                            class="tx-medium">{{ $employee->department->branch }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ps__rail-x" style="left: 0px; top: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; right: 653px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-x" style="left: 0px; top: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; right: 653px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mx-auto">
                            <div class="btn-group dropdown">
                                <button data-toggle="dropdown" class="btn btn-primary btn-block"
                                    class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate"
                                    aria-expanded="false">أختر السنه <i
                                        class="icon ion-ios-arrow-down tx-11 mg-l-3"></i></button>
                                <button type="button" class="btn btn-primary"
                                    id="selectedYear">{{ $currentYear }}</button>
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate">
                                    @for ($year = $currentYear; $year >= $startYear; $year--)
                                        <a class="dropdown-item" href="#"
                                            onclick="setActiveYear({{ $year }})">{{ $year }}</a>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mx-auto">
                        <h4>حساب الاجازات</h4>
                        <div class="table-responsive mg-t-20">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        {{-- emergency --}}
                                        <td>عارضه</td>
                                        <td class="text-right">
                                            @php
                                                $totalEmergencyDays = 0;
                                                foreach ($vacations as $vacation) {
                                                    if (
                                                        $vacation->type === 'emergency' &&
                                                        $vacation->status === 'approve'
                                                    ) {
                                                        $totalEmergencyDays += $vacation->calculateTotalDaysExcludingFridays();
                                                    }
                                                }

                                                echo $totalEmergencyDays;
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                if ($totalEmergencyDays >= 7) {
                                                    echo "<p style='color:red;'>رصيدك من أجازات العارضه قد نفذ</p>";
                                                } elseif ($totalEmergencyDays >= 5) {
                                                    echo "<p style='color:orange;'>أحذر على وشك أنتهاء أجازات العارضه</p>";
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        {{-- regular --}}
                                        <td><span>إعتيادى</span></td>
                                        <td class="text-right">
                                            @php
                                                $totalRegularDays = 0;
                                                foreach ($vacations as $vacation) {
                                                    if (
                                                        $vacation->type === 'regular' &&
                                                        $vacation->status === 'approve'
                                                    ) {
                                                        $totalRegularDays += $vacation->calculateTotalDaysExcludingFridays();
                                                    }
                                                }
                                                echo $totalRegularDays;
                                            @endphp
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        {{-- Annual --}}
                                        <td>سنوى</td>
                                        <td class="text-right">
                                            @php
                                                $totalAnnualDays = 0;
                                                foreach ($vacations as $vacation) {
                                                    if (
                                                        $vacation->type === 'Annual' &&
                                                        $vacation->status === 'approve'
                                                    ) {
                                                        $totalAnnualDays += $vacation->calculateTotalDaysExcludingFridays();
                                                    }
                                                }
                                                echo $totalAnnualDays;
                                            @endphp
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        {{-- satisfying --}}
                                        <td>مرضى</td>
                                        <td class="text-right">
                                            @php
                                                $totalSatisfyingDays = 0;
                                                foreach ($vacations as $vacation) {
                                                    if (
                                                        $vacation->type === 'satisfying' &&
                                                        $vacation->status === 'approve'
                                                    ) {
                                                        $totalSatisfyingDays += $vacation->calculateTotalDaysExcludingFridays();
                                                    }
                                                }
                                                echo $totalSatisfyingDays;
                                            @endphp
                                        </td>
                                        <td> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive mg-t-40">
                        <table class="table table-bordered text-md-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th class="wd-25p tx-center">الأجازه المستحقه من السنه
                                        الحالية</th>
                                    <th class="wd-25p tx-center">الاجازه السابق منحها فى السنه
                                        الحالية</th>
                                    <th class="wd-25p tx-center">الرصيد المتبقى من السنه الحالية
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="tx-center">{{ $employee->num_of_days }}</td>
                                    <td class="tx-center">
                                        @php
                                            $calcVacations =
                                                $totalRegularDays +
                                                $totalAnnualDays +
                                                $totalSatisfyingDays;
                                            echo $calcVacations;
                                        @endphp
                                    </td>
                                    <td class="tx-center">
                                        @php
                                            $calcVacations =
                                                $totalRegularDays +
                                                $totalAnnualDays +
                                                $totalSatisfyingDays;
                                            $remainingDays = $employee->num_of_days - $calcVacations;
                                            echo $remainingDays;
                                        @endphp
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-4 mb-4">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>نوع الأجازه</th>
                                        <th>من</th>
                                        <th>إلى</th>
                                        <th>القائم بأعماله</th>
                                        <th>عدد الأيام</th>
                                        <th>حالة الاجازه</th>
                                        <th>المرفقات</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vacations as $index => $vacation)
                                        <tr>
                                            <th scope="row">{{ $vacation->code_num }}</th>
                                            <td>{{ $vacation->typeVaction() }}</td>
                                            <td>{{ $vacation->start }}</td>
                                            <td>{{ $vacation->to }}</td>
                                            <td>{{ $vacation->employee?->name }}</td>
                                            <td>{{ $vacation->calculateTotalDaysExcludingFridays() }}</td>
                                            <td>
                                                @if (isset($vacation) && $vacation->status == 'pending')
                                                    <span class="badge badge-info">معلق</span>
                                                @elseif(isset($vacation) && $vacation->status == 'approve')
                                                    <span class="badge badge-success">موافق</span>
                                                @elseif(isset($vacation) && $vacation->status == 'reject')
                                                    <span class="badge badge-danger">مرفوض</span>
                                                @endif

                                            <td>
                                                @if ($vacation->image)
                                                    <a class="btn btn-outline-primary btn-sm"
                                                        href="{{ asset('dashboard/assets/images/uploads/vacations/' . $vacation->image->filename) }}"
                                                        download>
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                @else
                                                    لا يوجد مرفقات
                                                @endif
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="main-navbar-backdrop"></div>
    @endsection

    @section('scripts')

        <!-- Internal Data tables -->
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/jszip.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>

        <!--Internal  Datatable js -->
        <script src="{{ asset('dashboard/assets/js/table-data.js') }}"></script>

        <script>
            function setActiveYear(year) {
                document.getElementById('selectedYear').textContent = year;
            }
        </script>
    @endsection
