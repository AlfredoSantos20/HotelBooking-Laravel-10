$(document).ready(function () {
    // $('#EmploginForm').on('submit', function(e) {

    //     e.preventDefault();

    //     let formData = {
    //         email: $('#emp-email').val(),  // Corrected the ID
    //         password: $('#emp-password').val(),
    //         _token: $('input[name="_token"]').val()  // CSRF token
    //     };

    //     // Clear previous errors
    //     $('#emp-signin-error, #emp-signin-email, #emp-signin-password').text('');

    //     // Send AJAX request
    //     $.post('/empSignin', formData)
    //     .done(function(response) {
    //         if (response.success) {
    //             window.location.href = response.redirect_url;
    //         } else {

    //             $('#emp-signin-error').text(response.message);  // Show invalid email or password message
    //         }
    //     })
    //     .fail(function(xhr) {
    //         console.log(xhr);
    //         console.log(xhr.responseJSON);


    //         $('#emp-signin-error').text(xhr.responseJSON.message || '');  // Show invalid email or password message
    //     });
    // });
    $('#EmploginForm').on('submit', function(e) {
        e.preventDefault();

        let formData = {
            email: $('#emp-email').val(),  // Get the email input value
            _token: $('input[name="_token"]').val()  // CSRF token
        };

        // Clear previous error messages
        $('#emp-signin-error, #emp-signin-email').text('');

        // Send AJAX request
        $.post('/empSignin', formData)
        .done(function(response) {
            if (response.success) {
                // Redirect to the login page if the email exists
                window.location.href = response.redirect_url;
            } else {
                // Show error message if email is invalid or doesn't exist
                $('#emp-signin-error').text(response.message);
            }
        })
        .fail(function(xhr) {
            console.log(xhr);
            console.log(xhr.responseJSON);

            // Show any validation or server errors
            $('#emp-signin-error').text(xhr.responseJSON.message || 'An error occurred.');
        });
    });



});
