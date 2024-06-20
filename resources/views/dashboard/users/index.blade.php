@extends('dashboard.layouts.master')
@section('title', 'قائمة المستخدمين')
@section('current-page', 'قائمة المستخدمين')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ asset('dashboard') }}/assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('dashboard') }}/assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('dashboard') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet">

    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ asset('dashboard') }}/assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css"
        rel="stylesheet">
    <link href="{{ asset('dashboard') }}/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css"
        rel="stylesheet">
    <link href="{{ asset('dashboard') }}/assets/plugins/pickerjs/picker.min.css" rel="stylesheet">
@endsection

@section('content')
    @include('dashboard.messages_alert')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a class="btn btn-outline-primary btn-block" href="{{route('dashboard.users.create')}}">
                                <i class="fas fa-plus-square"></i>
                                أضافة مستخدم
                            </a>
                        </div>
                    </div>
                    {{-- Success Message --}}
                    <div id="successMessage" class="alert alert-solid-success d-none" role="alert">
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                            <span aria-hidden="true">×</span></button>
                        <strong>Well done!</strong> تم حذف المستخدم بنجاح
                    </div>

                    <div class="table-responsive">
                        <table id="vacationTable" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">أسم المستخدم</th>
                                    <th class="border-bottom-0">البريد الالكترونى</th>
                                    <th class="border-bottom-0">حالة المستخدم</th>
                                    <th class="border-bottom-0">نوع المستخدم</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;?>
                            @foreach($data as $key=>$user)
                                <?php $i++;?>
                                <tr id="vacationRow">
                                    <th scope="row">{{$i}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status}}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                                <label class="badge badge-secondary text-dark">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Show -->
                                        <a class="btn btn-outline-primary btn-sm"
                                           href="{{ route('dashboard.users.show',$user->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Edit -->
                                        <a class="btn btn-outline-info btn-sm"
                                           href="{{ route('dashboard.users.edit',$user->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <a class="modal-effect btn btn-outline-danger btn-sm"
                                           data-effect="effect-scale" data-toggle="modal"
                                           href="#delete{{ $user->id }}">
                                            <i class="fas fa-trash-alt"></i></a>

                                    </td>
                                        @include('dashboard.users.delete')
                                </tr>
                            @endforeach
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
    <!-- Internal Select2.min js -->
    <script src="{{ asset('dashboard/assets/js/projects/vacations.js') }}"></script>

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

    <script>
        // Function to delete a vacation
        function deleteVacation(vacationId) {
            // Get the form associated with the specific vacation ID
            let form = document.getElementById('deleteVacationForm' + vacationId);
            let formData = new FormData(form); // Create a FormData object from the form
            let actionUrl = "{{ route('dashboard.vacations.destroy', '') }}/" + vacationId; // Construct the action URL

            // Perform the fetch request to delete the vacation
            fetch(actionUrl, {
                    method: 'POST', // Use POST method for deletion
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token for security
                        'X-Requested-With': 'XMLHttpRequest', // Specify the request is made via AJAX
                        'Accept': 'application/json', // Expect a JSON response
                    },
                    body: formData // Send the form data
                })
                .then(response => response.json()) // Parse the response as JSON
                .then(data => {
                    if (data.success) { // If the deletion was successful
                        // Hide the delete modal
                        $('#delete' + vacationId).modal('hide');

                        // Reload the page to refresh the table and other data
                        window.location.reload();
                    } else {
                        // Log an error if deletion was not successful
                        console.error('Error deleting vacation: ' + data.message);
                    }
                })
                .catch(error => {
                    // Log any errors that occur during the fetch request
                    console.error('Error:', error);
                    alert('An error occurred while deleting the vacation.'); // Show an alert if an error occurs
                });
        }
    </script>
    <script>
        //  Script to validate form before submission
        $(document).ready(function() {
            $('#searchButton').on('click', function() {
                // Check if employee_id and type are not selected
                if (!$('[name="employee_id"]').val() && !$('[name="type"]').val()) {
                    $('#alertMessage').removeClass('d-none'); // Show the alert message

                    // Hide the alert message after 2 seconds
                    setTimeout(function() {
                        $('#alertMessage').addClass('fade-out'); // Add the fade-out effect
                        setTimeout(function() {
                            $('#alertMessage').addClass(
                                'd-none'
                            ); // Hide the alert message after the fade-out effect
                        }, 1500); // 1.5 seconds for the fade-out transition
                    }, 2000); // 2 seconds before starting the fade-out
                } else {
                    $('#alertMessage').addClass('d-none'); // Hide the alert message if it's visible
                    $('#search-form').submit(); // Submit the form if one of the fields is selected
                }
            });
        });
    </script>
    <style>
        .fade-out {
            opacity: 0;
            transition: opacity 1.5s ease-out;
        }
    </style>

@endsection
