$(document).ready(function() {
    $('#employeeForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Hide all error messages initially
        $('.error-message').addClass('d-none').html('');

        // Hide success message initially
        $('#successMessage').addClass('d-none');

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'), // Use the form's action attribute
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response
                $('#employeeForm')[0].reset(); // Optionally, reset the form fields
                $('#output').attr('src', '').hide(); // Clear the selected image preview and hide it
                $('#successMessage').removeClass('d-none'); // Show success message

                // Slowly fade out the success message after 5 seconds
                setTimeout(function() {
                    $('#successMessage').fadeOut('slow', function() {
                        window.location.href = "/employees";
                    });
                }, 1000); // 5000 milliseconds = 5 seconds
            },
            error: function(xhr) {
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

// Function to load and preview the selected image
var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};
