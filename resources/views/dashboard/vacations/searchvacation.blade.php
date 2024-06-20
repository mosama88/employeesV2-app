@extends('dashboard.layouts.master')
@section('title', 'الأجازات')
@section('current-page', 'الأجازات')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ asset('dashboard') }}/assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('dashboard') }}/assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    @include('dashboard.messages_alert')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between my-4">
                        @php
                            if ($type == 'satisfying') {
                                echo 'مرضى';
                            } elseif ($type == 'emergency') {
                                echo 'عارضه';
                            } elseif ($type == 'regular') {
                                echo 'إعتيادى';
                            } elseif ($type == 'Annual') {
                                echo 'سنوى';
                            } elseif ($type == 'mission') {
                                echo 'مأمورية';
                            }
                        @endphp
                        @if ($type)
                            <h4 class="main-content-label mg-b-5">{{ $type }}</h4>
                        @else
                            @php
                                $employeeNames = $vacations
                                    ->flatMap(function ($vacation) {
                                        return $vacation->vacationEmployee->pluck('name');
                                    })
                                    ->unique()
                                    ->implode(', ');
                            @endphp
                            <h4 class="main-content-label mg-b-5">{{ $employeeNames }}</h4>
                        @endif
                    </div>


                    <div class="table-responsive">
                        <table id="vacationTable" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">أسم الموظف</th>
                                    <th class="border-bottom-0">نوع الأجازه</th>
                                    <th class="border-bottom-0">من</th>
                                    <th class="border-bottom-0">إلى</th>
                                    <th class="border-bottom-0">عدد الايام</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($vacations) == 0)
                                    <tr>
                                        <td colspan="9" class="text-center">لا توجد بيانات فى عملية البحث</td>
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
                                            <td>{{ $vacation->notes }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
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
        // Delete
        function deleteVacation(vacationId) {
            let form = document.getElementById('deleteVacationForm' + vacationId);
            let formData = new FormData(form);
            let actionUrl = "{{ route('dashboard.vacations.destroy', '') }}/" + vacationId;

            fetch(actionUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hide the delete modal after successful deletion
                        $('#delete' + vacationId).modal('hide');

                        // Remove the deleted vacation row from the table
                        let row = document.getElementById('vacationRow' + vacationId);
                        if (row) {
                            row.remove();
                        }

                        // Show the success message
                        let successMessage = $('#successMessage');
                        successMessage.removeClass('d-none');

                        // Hide the success message slowly after 3 seconds
                        setTimeout(() => {
                            successMessage.fadeOut('slow', function() {
                                successMessage.addClass('d-none')
                                    .show(); // Ensure it is hidden and reset for next time
                            });
                        }, 3000); // Adjust the duration as needed
                    } else {
                        console.error('Error deleting vacation: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the vacation.');
                });
        }
    </script>


@endsection
