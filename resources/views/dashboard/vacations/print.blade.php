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
                            <div class="row mg-t-10">
                                <div class="col-12">
                                    <h1 class="text-center">أجازه {{ $vacation->typeVaction() }}</h1>
                                </div>
                            </div>
                            <div class="row mg-t-10">
                                <div class="col-6">
                                    <h4>الأسم / @foreach ($vacation->vacationEmployee as $employee)
                                            {{ $employee?->name }}
                                            @if (!$loop->last)
                                                ،
                                            @endif
                                        @endforeach
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <h4>الوظيفية / إدارة التحول الرقمى</h4>
                                </div>
                            </div>
                            <div class="row mg-t-10">
                                {{-- <div class="col-6">
                                    <h4>جهه العمل / {{ $employee->department->name }}</h4>
                                </div> --}}
                                <div class="col-6">
                                    <h4>مدة الأجازه / {{ $vacation->calculateTotalDaysExcludingFridays() }} يوم</h4>
                                </div>
                            </div>
                            <div class="row mg-t-10">
                                <div class="col-12">
                                    <h4> من يوم {{ $startDay }} الموافق
                                        {{ Carbon::parse($vacation->start)->locale('ar')->isoFormat('D/MMMM /YYYY') }}
                                        حتى {{ $endDay }} الموافق
                                        {{ Carbon::parse($vacation->to)->locale('ar')->isoFormat('D/MMMM /YYYY') }}
                                    </h4>

                                </div>
                            </div>


                            <div class="row mg-t-10">
                                <div class="col-7">
                                    <h4> يوم الراحة الأسبوعية .................. الموافق 12/5/2024</h4>
                                </div>

                                <div class="col-5">
                                    <h4 class="text-center">أسم القائم بأعماله</h4>
                                    <h3>أتعهد بالقيام بالعمل أثناء الأجازه :
                                        {{ $vacation->employee?->name }}</h3>
                                </div>
                            </div>



                            <div class="row mg-t-10">
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
                                            <th class="wd-25p tx-center">رصيد السنوات السابقة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="tx-center">1</td>
                                            <td class="tx-center">2</td>
                                            <td class="tx-center">3</td>
                                            <td class="tx-center">4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mg-t-10">
                                <div class="col-8">
                                    <h4>مسئول شئون العاملين : ........................</h4><br>
                                    <h4>تحريرآ فى : 25/9/2024</h4>
                                </div>
                                <div class="col-4">
                                    <h4>نائب رئيس الهيئة</h4>
                                    <h4>مدير</h4>
                                    <h4>المستشار / </h4>
                                </div>
                            </div>

                            <br>
                            <div class="row mg-t-10">
                                <div class="col-12">
                                    <h3 class="text-center">إقرار القيام</h3><br>
                                    <h4 class="text-center">بعد التحيه...</h4><br>
                                </div>
                                <div class="col-12">
                                    <h5>أقر أنا @foreach ($vacation->vacationEmployee as $employee)
                                            {{ $employee->name }}
                                            @if (!$loop->last)
                                                ،
                                            @endif
                                        @endforeach
                                        بأننى أتممت اعمالى المصلحية
                                        اليوم............................. الموافق 25 / 8/ 2024 و هو أخر يوم من ايام العمل.
                                    </h5>
                                </div>
                            </div>

                            <div class="row mg-t-10">
                                <div class="col-6">
                                    <h5>توقيع الموظف</h5><br>
                                    <p>........................</p>
                                </div>
                                <div class="col-6">
                                    <h5>مدير السكرتارية</h5><br>
                                    <p>........................</p>

                                </div>
                            </div>


                            <div class="row mg-t-10">
                                <div class="col-12">
                                    <h3 class="text-center">إقرار عوده</h3><br>
                                    <h4 class="text-center">بعد التحيه...</h4><br>
                                </div>
                                <div class="col-12">
                                    <h5>أقر أنا
                                        @foreach ($vacation->vacationEmployee as $employee)
                                            {{ $employee->name }}
                                            @if (!$loop->last)
                                                ،
                                            @endif
                                        @endforeach
                                        بأننى أستلمت العمل اليوم الموافق
                                        26/8/2024 بعد أنتهاء الأجازه ال{{ $vacation->typeVaction() }} الممنوحه لى من
                                        {{ Carbon::parse($vacation->start)->locale('ar')->isoFormat('D/MMMM/YYYY') }}
                                        حتى
                                        {{ Carbon::parse($vacation->to)->locale('ar')->isoFormat('D/MMMM/YYYY') }}
                                    </h5>
                                </div>
                            </div>

                            <div class="row mg-t-10">
                                <div class="col-6">
                                    <h5>توقيع الموظف</h5><br>
                                    <p>........................</p>

                                </div>
                                <div class="col-6">
                                    <h5>مدير السكرتارية</h5><br>
                                    <p>........................</p>

                                </div>
                            </div>

                            <hr class="mg-b-40">
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
