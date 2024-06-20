@extends('dashboard.layouts.master')

@section('title', 'المسمى الوظيفى')
@section('page-title', 'المسمى الوظيفى')
@section('page-link-back')
    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
    </li>
@endsection
@section('current-page', 'المسمى الوظيفى')
@section('content')
    <div class="col-xl-12">
        <div class="card">
            @include('dashboard.messages_alert')
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <!-- Button to open modal -->
                    <div class="col-sm-6 col-md-3 mb-4">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#modaldemo8">
                            <i class="fas fa-plus-square"></i>
                            أضافة وظيفه
                        </a>
                    </div>
                    @include('dashboard.jobs.add')
                </div>

                {{-- Success Message --}}
                <div id="successMessage" class="alert alert-solid-success d-none" role="alert">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">×</span></button>
                    <strong>Well done!</strong> تم حذف الوظيفه بنجاح
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mg-b-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الوظيفه</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $job)
                                    <tr id="JobgradeRow{{ $job->id }}">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $job->name }}</td>
                                        <td>
                                            {{-- Edit --}}
                                            <a class="modal-effect btn btn-outline-info btn-sm" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $job->id }}"><i
                                                    class="fas fa-edit"></i></a>
                                            @include('dashboard.jobs.edit')

                                            {{-- Delete --}}
                                            <a class="modal-effect btn btn-outline-danger btn-sm" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $job->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>

                                            <!-- End Modal effects-->
                                            <div class="modal" id="delete{{ $job->id }}">
                                                <!-- Modal content -->
                                            </div>


                                        </td>
                                        @include('dashboard.jobs.delete')
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>






    @endsection

    @section('scripts')
        <!--Internal  Datepicker js -->
        <script src="{{ asset('dashboard/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>



        <script>
            var date = $('.fc-datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            }).val();




            // Add
            function addJobGrade() {
                let form = document.getElementById('addJobGradeForm');
                let formData = new FormData(form);
                let actionUrl = "{{ route('dashboard.jobs.store') }}";

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
                            // Hide the add modal after successful addition
                            $('#modaldemo8').modal('hide');

                            // Reset the form
                            form.reset();

                            // Show the success message
                            let successMessage = $('#successMessage');
                            successMessage.text('تم أضافة المسمى الوظيفى بنجاح');
                            successMessage.removeClass('d-none');

                            // Reload the page after 3 seconds to show the new job grade
                            setTimeout(() => {
                                location.reload();
                            }, 2000); // Adjust the duration as needed
                        } else {
                            console.error('Error adding jobs: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while adding the jobs.');
                    });
            }



            // Delete
            function deleteJobgrade(jobgradeId) {
                let form = document.getElementById('deleteJobgradeForm' + jobgradeId);
                let formData = new FormData(form);
                let actionUrl = "{{ route('dashboard.jobs.destroy', '') }}/" + jobgradeId;

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
                            $('#delete' + jobgradeId).modal('hide');

                            // Remove the deleted holiday row from the table
                            $('#JobgradeRow' + jobgradeId).remove();

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
                            console.error('Error deleting Jobs: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the Jobs.');
                    });
            }
        </script>
    @endsection
