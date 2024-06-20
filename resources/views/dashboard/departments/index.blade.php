@extends('dashboard.layouts.master')

@section('title', 'النيابات')
@section('page-title', 'النيابات')
@section('page-link-back')
    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
    </li>
@endsection
@section('current-page', 'النيابات')
@section('content')
    <div class="col-xl-12">
        <div class="card">
            @include('dashboard.messages_alert')
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="col-sm-6 col-md-3 mb-4">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#modaldemo8">
                            <i class="fas fa-plus-square"></i>
                            أضافة نيابة / إداره
                        </a>
                    </div>
                    @include('dashboard.departments.add')
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mg-b-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نيابة / إداره</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $department->branch }}</td>
                                        <td>
                                            {{-- Edit --}}
                                            <a class="modal-effect btn btn-outline-info btn-sm" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $department->id }}"><i
                                                    class="fas fa-edit"></i></a>
                                            @include('dashboard.departments.edit')

                                            {{-- Delete --}}
                                            <a class="modal-effect btn btn-outline-danger btn-sm" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $department->id }}">
                                                <i class="fas fa-trash-alt"></i></a>
                                        </td>
                                        @include('dashboard.departments.delete')
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- bd -->
                </div><!-- bd -->
                {{ $departments->render('pagination::bootstrap-4') }}
            </div><!-- bd -->
        </div>




        <!--Internal  Datepicker js -->
        <script src="{{ asset('dashboard/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
        <script>
            var date = $('.fc-datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            }).val();
        </script>




    @endsection
