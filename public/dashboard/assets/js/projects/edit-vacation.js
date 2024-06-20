$(document).ready(function () {
    // Hide fields initially
    $('#int_ext_field').hide();
    $('#department_field').hide();
    $('#acting_employee_field').hide();

    // Show/hide fields based on the selected vacation type
    $('select[name="type"]').change(function () {
        var selectedOption = $(this).val();
        if (selectedOption === 'mission') {
            $('#int_ext_field').show();
            $('#acting_employee_field').hide();
        } else {
            $('#int_ext_field').hide();
            $('#acting_employee_field').show();
        }
    });

    // Show/hide department field based on internal/external selection
    $('select[name="int_ext"]').change(function () {
        var selectedOption = $(this).val();
        if (selectedOption === 'internal') {
            $('#department_field').show();
        } else {
            $('#department_field').hide();
        }
    });

    // Form submission handling
    $('#vacationForm').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        // Hide all error messages initially
        $('.error-message').addClass('d-none').html('');

        // Hide success message initially
        $('#successMessage').addClass('d-none');

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'), // Use form action URL
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Handle successful response
                $('#vacationForm')[0].reset(); // Reset form fields
                $('#output').attr('src', '').hide(); // Clear and hide image preview
                $('#successMessage').removeClass('d-none'); // Show success message

                // Fade out success message after 5 seconds
                setTimeout(function () {
                    $('#successMessage').fadeOut('slow', function () {
                        // Redirect to the vacation index page
                        window.location.href = "/vacations";
                    });
                }, 1000); // 1000 milliseconds = 1 seconds
            },
            error: function (xhr) {
                // Handle error response by displaying error messages under each input
                var errors = xhr.responseJSON.errors;
                for (var field in errors) {
                    var errorMessage = errors[field].join('<br>');
                    $('#' + field + '-error').html(errorMessage).removeClass('d-none');
                }
            }
        });
    });
});

// Load file function to preview image
var loadFile = function (event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src); // Free memory
    }
};
