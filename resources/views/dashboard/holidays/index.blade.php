@extends('dashboard.layouts.master')

@section('title', 'العطلات الرسميه')
@section('page-title', 'العطلات الرسميه')
@section('page-link-back')
    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
    </li>
@endsection
@section('current-page', 'العطلات الرسميه')
@section('content')
    @include('dashboard.messages_alert')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="col-sm-6 col-md-3 mb-4">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#modaldemo8">
                            <i class="fas fa-plus-square"></i>
                            أضافة عطلة رسمية
                        </a>
                    </div>
                    @include('dashboard.holidays.add')
                </div>

                {{-- Success Message --}}
                <div id="successMessage" class="alert alert-solid-success d-none" role="alert">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">×</span></button>
                    <strong>Well done!</strong> تم حذف العطلة بنجاح
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mg-b-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>أسم العطلة</th>
                                    <th>من</th>
                                    <th>إلى</th>
                                    <th>عدد الأيام</th>
                                    <th>العمليات</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($holidays as $holiday)
                                    <tr id="holidayRow{{ $holiday->id }}">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $holiday->name }}</td>
                                        <td>{{ $holiday->from }}</td>
                                        <td>{{ $holiday->to }}</td>
                                        <td>
                                            {{ $holiday->calculateTotalDaysExcludingFridays() }}
                                        </td>
                                        <td>
                                            {{-- Edit --}}
                                            <a class="modal-effect btn btn-outline-info btn-sm" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $holiday->id }}"><i
                                                    class="fas fa-edit"></i></a>
                                            @include('dashboard.holidays.edit')

                                            {{-- Delete --}}
                                            {{-- <a id="holidayRow{{ $holiday->id }}"
                                                class="modal-effect btn btn-outline-danger btn-sm"
                                                data-effect="effect-scale" data-toggle="modal"
                                                href="#delete{{ $holiday->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a> --}}

                                            <!-- End Modal effects-->
                                            <div class="modal" id="delete{{ $holiday->id }}">
                                                <!-- Modal content -->
                                            </div>
                                        </td>
                                        @include('dashboard.holidays.delete')
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>






        <!--Internal  Datepicker js -->
        <script src="{{ asset('dashboard/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
        <script>
            var date = $('.fc-datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            }).val();
        </script>


        <script>
            function deleteHoliday(holidayId) {
                let form = document.getElementById('deleteHolidayForm' + holidayId);
                let formData = new FormData(form);
                let actionUrl = "{{ route('dashboard.holidays.destroy', '') }}/" + holidayId;

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
                            $('#delete' + holidayId).modal('hide');

                            // Remove the deleted holiday row from the table
                            $('#holidayRow' + holidayId).remove();

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
                            console.error('Error deleting holiday: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the holiday.');
                    });
            }
        </script>

    @endsection
