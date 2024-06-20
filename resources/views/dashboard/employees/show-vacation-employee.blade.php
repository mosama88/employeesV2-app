@extends('dashboard.layouts.master')

@section('title', 'بيانات الموظفين')
@section('page-title', 'بيانات الموظفين')
@section('page-link-back')
    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
    </li>
@endsection

@section('current-page', 'بيانات الموظفين')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ asset('dashboard') }}/assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('dashboard') }}/assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">الصورة</th>
                                        <th class="border-bottom-0">أسم الموظف</th>
                                        <th class="border-bottom-0">الهاتف</th>
                                        <th class="border-bottom-0">هاتف أخر</th>
                                        <th class="border-bottom-0">المحافظة</th>
                                        <th class="border-bottom-0">القسم</th>
                                        <th class="border-bottom-0">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td class="text-center">
                                                @if ($employee->image)
                                                    <img class="img-thumbnail rounded me-2" alt="200x200"
                                                        style="width: 50px; height:50px"
                                                        src="{{ asset('dashboard/assets/images/uploads/employees/' . $employee->image->filename) }}"
                                                        data-holder-rendered="true">
                                                @else
                                                    <img class="img-thumbnail rounded me-2" alt="200x200"
                                                        style="width: 50px; height:50px"
                                                        src="{{ asset('dashboard/assets/img/employees-default.png') }}"
                                                        data-holder-rendered="true">
                                                @endif
                                            </td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->phone }}</td>
                                            <td>{{ $employee->alter_phone }}</td>
                                            <td>{{ $employee->address->city }}</td>
                                            <td>{{ $employee->department->branch }}</td>
                                            <td>
                                                {{-- Show --}}
                                                <a class="btn btn-outline-primary btn-sm"
                                                    href="{{ route('dashboard.employees.show', $employee->id) }}"><i
                                                        class="fas fa-eye"></i></a>
                                            </td>
                                            @include('dashboard.employees.delete')
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- bd -->
                    </div><!-- bd -->
                </div><!-- bd -->
            </div>
        </div>
    </div>

    <div class="main-navbar-backdrop"></div>


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
@endsection
@endsection
