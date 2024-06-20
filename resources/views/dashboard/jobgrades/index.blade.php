@extends('dashboard.layouts.master')

@section('title', 'الدرجات الوظيفية')
@section('page-title', 'الدرجات الوظيفية')
@section('page-link-back')
    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
    </li>
@endsection
@section('current-page', 'الدرجات الوظيفية')
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
                            أضافة درجه وظيفية
                        </a>
                    </div>
                    @include('dashboard.jobgrades.add')
                </div>

                {{-- Success Message --}}
                <div id="successMessage" class="alert alert-solid-success d-none" role="alert">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">×</span></button>
                    <strong>Well done!</strong> تم حذف الدرجه الوظيفية بنجاح
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mg-b-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الدرجه الوظيفية</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobgrades as $jobgrade)
                                    <tr id="JobgradeRow{{ $jobgrade->id }}">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $jobgrade->name }}</td>
                                        <td>
                                            {{-- Edit --}}
                                            <a class="modal-effect btn btn-outline-info btn-sm" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $jobgrade->id }}"><i
                                                    class="fas fa-edit"></i></a>
                                            @include('dashboard.jobgrades.edit')

                                            {{-- Delete --}}
                                            <a class="modal-effect btn btn-outline-danger btn-sm" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $jobgrade->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>

                                            <!-- End Modal effects-->
                                            <div class="modal" id="delete{{ $jobgrade->id }}">
                                                <!-- Modal content -->
                                            </div>


                                        </td>
                                        @include('dashboard.jobgrades.delete')
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
    let actionUrl = "{{ route('dashboard.jobgrades.store') }}";

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
    successMessage.text('تم أضافة الدرجه الوظيفية بنجاح');
    successMessage.removeClass('d-none');

                // Reload the page after 3 seconds to show the new job grade
                setTimeout(() => {
        location.reload();
                }, 2000); // Adjust the duration as needed
            } else {
        console.error('Error adding job grade: ' + data.message);
            }
        })
        .catch(error => {
        console.error('Error:', error);
    alert('An error occurred while adding the job grade.');
        });
}



// Delete
function deleteJobgrade(jobgradeId) {
    let form = document.getElementById('deleteJobgradeForm' + jobgradeId);
    let formData = new FormData(form);
    let actionUrl = "{{ route('dashboard.jobgrades.destroy', '') }}/" + jobgradeId;

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
                console.error('Error deleting Job Grades: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the Job Grades.');
        });
}
</script>
    @endsection
