@extends('dashboard.layouts.master')
@section('title', 'الأجازات')
@section('current-page', 'الأجازات')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ asset('dashboard') }}/assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('dashboard') }}/assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>

@endsection

@section('content')
    @php
        use Carbon\Carbon;
        $startDay = Carbon::parse($vacation->start)->locale('ar')->dayName;
        $endDay = Carbon::parse($vacation->to)->locale('ar')->dayName;
    @endphp
    @php
        $totalEmergencyDays = 0;
        foreach ($vac as $vacations) {
            if ($vacations->type === 'emergency' && $vacations->status === 'approve') {
                $totalEmergencyDays += $vacations->calculateTotalDaysExcludingFridays();
            }
        }

        $totalRegularDays = 0;
        foreach ($vac as $vacation) {
            if ($vacation->type === 'regular' && $vacation->status === 'approve') {
                $totalRegularDays += $vacation->calculateTotalDaysExcludingFridays();
            }
        }

        $totalAnnualDays = 0;
        foreach ($vac as $vacation) {
            if ($vacation->type === 'Annual' && $vacation->status === 'approve') {
                $totalAnnualDays += $vacation->calculateTotalDaysExcludingFridays();
            }
        }

        $totalSatisfyingDays = 0;
        foreach ($vac as $vacation) {
            if ($vacation->type === 'satisfying' && $vacation->status === 'approve') {
                $totalSatisfyingDays += $vacation->calculateTotalDaysExcludingFridays();
            }
        }
    @endphp
    <div class="container-fluid">
        {{-- Start Row --}}
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 ">
                        <div class="col-sm-12 col-md-12 col-xl-12">

                            <!-- row -->
                            <div class="row row-sm">
                                <div class="col-md-12 col-xl-12">
                                    <div class=" main-content-body-invoice" id="print">
                                        <div class="card card-invoice">
                                            <div class="card-body">
                                                <div class="invoice-header">
                                                    <img src="{{ asset('dashboard/assets/img/logo-print-vacation.jpg') }}"
                                                        style="width: 100px; height:100px;" alt="">
                                                    <h1 class="invoice-title">إدارة التحول الرقمى</h1>
                                                    <div class="billed-from">
                                                        <h6>نموذج أدارة الاجازات - بإدارة النيابات</h6>
                                                        <p>مكتب / نيابة التحول الرقمى<br>
                                                    </div><!-- billed-from -->
                                                </div><!-- invoice-header -->
                                                <div class="row mg-t-20">
                                                    <div class="col-12">
                                                        <h1 class="text-center">أجازة عارضه</h1>
                                                    </div>
                                                </div>
                                                <div class="row mg-t-20">
                                                    <div class="col-6">
                                                        <h4>الأسم / @foreach ($vacation->vacationEmployee as $employee)
                                                                {{ $employee->name }}
                                                                @if (!$loop->last)
                                                                    ،
                                                                @endif
                                                            @endforeach
                                                        </h4>
                                                    </div>
                                                    <div class="col-6">
                                                        <h4>الوظيفية / {{ $employee->department?->name }}</h4>
                                                    </div>

                                                </div>
                                                <div class="row mg-t-20">
                                                    <div class="col-6">
                                                        <h4>جهه العمل / </h4>
                                                    </div>
                                                    <div class="col-6">
                                                        <h4>مدة الأجازه /
                                                            {{ $vacation->calculateTotalDaysExcludingFridays() }} يوم</h4>
                                                    </div>
                                                </div>
                                                <div class="row mg-t-20">
                                                    <div class="col-12">
                                                        <h4> من يوم {{ $startDay }} الموافق
                                                            {{ Carbon::parse($vacation->start)->locale('ar')->isoFormat('D/MMMM /YYYY') }}
                                                            حتى {{ $endDay }} الموافق
                                                            {{ Carbon::parse($vacation->to)->locale('ar')->isoFormat('D/MMMM /YYYY') }}
                                                        </h4>

                                                    </div>
                                                </div>


                                                <div class="row mg-t-20">
                                                    <div class="col-8">
                                                        <h4> يوم الراحة الأسبوعية (@foreach ($employee->employeeAppointments as $appointment)
                                                                {{ $appointment->name }}
                                                            @endforeach)

                                                            الموافق 12/5/2024</h4>
                                                    </div>


                                                </div>



                                                <div class="row mg-t-20">
                                                    <div class="col-12">
                                                        <h4>هل الأيام المقدم عنها الأجازه صادف يوم تفتيش مفاجىء على النيابة
                                                            / المكتب : (نعم لا).............................</h4>
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
                                                                            $totalEmergencyDays +
                                                                            $totalRegularDays +
                                                                            $totalAnnualDays +
                                                                            $totalSatisfyingDays;
                                                                        echo $calcVacations;
                                                                    @endphp
                                                                </td>
                                                                <td class="tx-center">
                                                                    @php
                                                                        $calcVacations =
                                                                            $totalEmergencyDays +
                                                                            $totalRegularDays +
                                                                            $totalAnnualDays +
                                                                            $totalSatisfyingDays;
                                                                        $remainingDays =
                                                                            $employee->num_of_days - $calcVacations;
                                                                        echo $remainingDays;
                                                                    @endphp
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row mg-t-20">
                                                    <div class="col-8">
                                                        <h4>مسئول شئون العاملين : ........................</h4><br>
                                                        <h4 class="my-4">تحريرآ فى : 25/9/2024</h4>
                                                    </div>
                                                    <div class="col-4">
                                                        <h4 class="my-4">توقيع طالب الاجازه</h4>
                                                        <h4>الأسم ثلاثى / ..................</h4>
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="row mg-t-20">
                                                    <div class="col-12">
                                                        <h5 class="">مدير السكرتارية</h5><br>
                                                        <h4 class="">....................</h4><br>
                                                    </div>
                                                </div>

                                                <div class="row mg-t-20">

                                                    <div class="col-8">

                                                    </div>


                                                    <div class="col-4">
                                                        <h5 class="">نائب رئيس الهيئة</h5><br>
                                                        <h5 class="">مدير</h5><br>
                                                        <h4 class="">المستشار / </h4><br>
                                                    </div>
                                                </div>



                                                <hr class="row mg-b-40">
                                                <a href="#" class="btn btn-danger float-left mt-3 mr-2"
                                                    id="print_Button" onclick="printDiv()">
                                                    <i class="mdi mdi-printer ml-1"></i>طباعه
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- COL-END -->
                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- COL-END -->
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>









@endsection
@section('scripts')
    <!-- main-content closed -->
    <!--Internal  Chart.bundle js -->
    <script src="{{ asset('dashboard') }}/assets/libs/chart.js/Chart.bundle.min.js"></script>

    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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
@endsection
