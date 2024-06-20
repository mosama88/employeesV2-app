@extends('dashboard.layouts.master')
@section('title', 'لوحة التحكم')
@section('content')
    @section('page-title', 'إدارة التحول الرقمى')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <div>
                    <h3 class="mg-b-0 mt-4">  برنامج شئون الموظفين  </h3>
                </div>
            </div>

        </div>
        <!-- /breadcrumb -->

        <!-- row -->
        <div class="row row-sm mx-auto">
            <div class="col-xl-6 col-lg-6 col-md-6 col-xm-12 ">
                <div class="card overflow-hidden sales-card bg-primary-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">الموظفين</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <a class="btn btn-outline btn-block text-center text-white"
                                   href="{{ route('dashboard.employees.create') }}">
                                    <i class="fas fa-plus-square"></i>
                                    أضافة موظف
                                </a>
                                <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                    <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-success-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 ">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">الأجازات</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <a class="btn btn-outline btn-block text-center text-white"
                                   href="{{ route('dashboard.vacations.create') }}">
                                    <i class="fas fa-plus-square"></i>
                                    أضافة أجازه
                                </a>
                                <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                    <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                </div>
            </div>

        </div>
        <!-- row closed -->


        <div class="row row-sm row-deck">

            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card card-table-two">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-1"><span class="card-category" style="color: #0BA2E0">أجازات  {{ $textToday }}
                                {{ $today }}</span>
                        </h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <span class="tx-12 tx-muted mb-3 "></span>
                    <div class="table-responsive country-table">
                        <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">أسم الموظف</th>
                                <th class="border-bottom-0">نوع الأجازه</th>
                                <th class="border-bottom-0">من</th>
                                <th class="border-bottom-0">إلى</th>
                                <th class="border-bottom-0">عدد الايام</th>
                                <th class="border-bottom-0">حالة الأجازه</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($vacations) == 0)
                                <tr>
                                    <td colspan="9" class="text-center">لا توجد أجازات اليوم</td>
                                </tr>
                            @else
                                @foreach ($vacations as $vacation)
                                    <tr id="vacationRow{{ $loop->iteration }}">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            @foreach ($vacation->vacationEmployee as $employee)
                                                {{ $employee->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $vacation->typeVaction() }}</td>
                                        <td>{{ $vacation->start }}</td>
                                        <td>{{ $vacation->to }}</td>
                                        <td>{{ $vacation->calculateTotalDaysExcludingFridays() }}</td>
                                        <td>
                                            @if ($vacation->status == 'pending')
                                                <span class="badge badge-info">معلق</span>
                                            @elseif ($vacation->status == 'approve')
                                                <span class="badge badge-success">موافق عليه</span>
                                            @elseif ($vacation->status == 'reject')
                                                <span class="badge badge-danger">مرفوض</span>
                                            @endif
                                            <div class="{{ $vacation->status == '1' ? 'success' : 'danger' }} ml-1">
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-8 col-md-12 col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header pb-1">
                        <h3 class="card-title mb-2">الموظفين بالأداره</h3>

                    </div>
                    <div class="card-body p-0 customers mt-1">
                        <div class="list-group list-lg-group list-group-flush">
                            @foreach ($employees as $employee)
                                <a class="list-group-item list-group-item-action"
                                   href="{{ route('dashboard.employees.show', $employee->id) }}">
                                    <div class="media mt-0">

                                        @if ($employee->image)
                                            <img class="avatar-lg rounded-circle ml-3 my-auto"
                                                 src="{{ asset('dashboard/assets/images/uploads/employees/' . $employee->image->filename) }}"
                                                 data-holder-rendered="true" title="{{ $employee->name }}">
                                        @else
                                            <img class="avatar-lg rounded-circle ml-3 my-auto"
                                                 src="{{ asset('dashboard/assets/img/employees-default.png') }}"
                                                 data-holder-rendered="true" title="{{ $employee->name }}">
                                        @endif


                                        <div class="media-body">
                                            <div class="d-flex align-items-center">
                                                <div class="mt-0">
                                                    <h5 class="mb-1 tx-15">{{ $employee->name }}</h5>
                                                    <p class="mb-0 tx-13 text-muted">

                                                        <span class="text-success mr-2">{{ $employee->phone }}</span>
                                                    </p>
                                                </div>
                                                <span class="mr-auto wd-45p fs-16 mt-2">
                                                <div class="wd-100p">
                                                    @foreach ($employee->employeeAppointments as $appointment)
                                                        {{ $appointment->name }}
                                                    @endforeach
                                                </div>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- row close -->

        <!-- row opened -->

        <!-- /row -->
    </div>
    </div>

@endsection
