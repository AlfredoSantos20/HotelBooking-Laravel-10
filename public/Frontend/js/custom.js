$(document).ready(function() {
    // Function to zoom in on image in table
    function zoomIn(element) {
        $(element).css('transform', 'scale(1.2)');
    }

    // Function to reset image zoom
    function zoomOut(element) {
        $(element).css('transform', 'scale(1)');
    }

    // Event listeners for zoom in and out
    $('.zoomable-img').hover(
        function() {
            zoomIn(this);
        }, function() {
            zoomOut(this);
        }
    );


    var failedAttempts = 0; // Initialize a counter for failed login attempts
    var countdownActive = false; // Flag to check if the countdown is active

    // User Login Form Ajax
    $("#loginForm").submit(function(e) {
        e.preventDefault();  // Prevent the default form submission

        // Check if reCAPTCHA is filled
        var recaptchaResponse = grecaptcha.getResponse();
        if (!recaptchaResponse) {
            $("#signin-error").attr('style', 'color:red');
            $("#signin-error").html('reCAPTCHA is required!');
            return; // Exit if reCAPTCHA is not filled
        }

        var formdata = $(this).serialize() + '&g-recaptcha-response=' + recaptchaResponse;

        $.ajax({
            url: "/signin",
            type: "POST",
            data: formdata,
            success: function(resp) {
                if (resp.type == "error") {
                    $.each(resp.errors, function(i, error) {
                        $("#signin-" + i).attr('style', 'color:red');
                        $("#signin-" + i).html(error + ' <span id="timer-' + i + '"></span>');

                        // Start the countdown timer for validation messages
                        startCountdown(i, "#signin-" + i);
                    });

                    // Increment the failed attempts counter
                    failedAttempts++;
                    handleFailedAttempts();
                } else if (resp.type == "incorrect") {
                    $("#signin-error").attr('style', 'color:red');
                    $("#signin-error").html(resp.message + ' <span id="timer-error"></span>');
                    startCountdown("error", "#signin-error");

                    // Increment the failed attempts counter
                    failedAttempts++;
                    handleFailedAttempts();
                } else if (resp.type == "inactive") {
                    $("#signin-error").attr('style', 'color:red');
                    $("#signin-error").html(resp.message + ' <span id="timer-error"></span>');
                    startCountdown("error", "#signin-error");

                    // Increment the failed attempts counter
                    failedAttempts++;
                    handleFailedAttempts();
                } else if (resp.type == "success") {
                    window.location.href = resp.url;
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    function startCountdown(id, selector) {
        var countdown = 5;
        var timer = setInterval(function() {
            countdown--;
            if (countdown <= 0) {
                clearInterval(timer);
                $(selector).css({'display': 'none'});
            }
            // Removed the line that displays the countdown number
        }, 1000);
    }

    // Function to start a 30-second real-time countdown and disable/enable the Sign-in button
    function startRealTimeCountdown() {
        var countdown = 30;
        var timerElement = $("#countdown-timer");
        var button = $("#signin-button");
        var timer = setInterval(function() {
            countdown--;
            timerElement.text("Too many login attempts. Please try again later." + " " + countdown + " seconds");
            button.prop('disabled', true); // Disable the button
            timerElement.show(); // Show the timer

            if (countdown <= 0) {
                clearInterval(timer);
                timerElement.text("Too many login attempts. Please try again later. 30 seconds "); // Reset the timer display
                button.prop('disabled', false); // Enable the button
                timerElement.hide(); // Hide the timer
                failedAttempts = 0; // Reset the failed attempts counter
            }
        }, 1000);
    }

    // Handle failed login attempts
    function handleFailedAttempts() {
        if (failedAttempts >= 5 && !countdownActive) {
            countdownActive = true;
            startRealTimeCountdown();
        }
    }

// Signup customer

// JavaScript code for form submission and validation
$('#signupForm').on('submit', function(e) {
    e.preventDefault();

    var password = $('#password').val();
    var confirmPassword = $('#password_confirmation').val();

    if (password !== confirmPassword) {
        $('#passwordHelp').text('Passwords do not match.');
        return;
    } else {
        $('#passwordHelp').text('');
    }

    var formData = $(this).serialize();

    $.ajax({
        url: '/signup',
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.status === 'createdAccount') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your Account Has Been Successfully Created!',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#signupForm')[0].reset();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Wrong Credentials',
                    text: 'Please check all of the fields.',
                });
            }
        },
        error: function(xhr) {
            // To Clear previous errors
            $('.error').text('');

            if (xhr.status === 422) {
                // Extract validation errors from the response
                const errors = xhr.responseJSON.errors;

                // Display errors
                for (const [field, messages] of Object.entries(errors)) {
                    $(`#${field}-error`).text(messages.join(', '));

                    //Set time 3secs
                    setTimeout(function() {
                        errorElement.text('');
                    }, 3000);

                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please try again.',
                });
            }
        }
    });
});





  // Saving booking
$('#bookingForm').on('submit', function(e) {
    e.preventDefault();

    // Serialize form data
    var formData = $(this).serialize();

    $.ajax({
        url: '/saveBooking',
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.status === 'occupied') {
                // Show SweetAlert error if all rooms of this type are occupied
                Swal.fire({
                    icon: 'error',
                    title: 'All Rooms Occupied',
                    text: 'All rooms of this type are occupied for the selected dates.',
                });
            } else if(response.message === "Login first to start Booking!") {
                // Show SweetAlert error if user is not logged in
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.message,
                });
            } else if(response.status === "capacity_exceeded") {
                // Show SweetAlert error if children/adults capacity exceeded
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.message,
                });
            }else if(response.status === "error_checkPersonCapacity") {
                // Show SweetAlert error if  error checkPersonCapacity
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.message,
                });
            } else {
                // If the booking is saved successfully, show SweetAlert success message
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your booking has been saved in Room ID: ' + response.room_id,
                    showConfirmButton: false,
                    timer: 1500
                });

                // Optionally, clear the form fields
                $('#bookingForm')[0].reset();
            }
        },
        error: function(xhr, status, error) {
            // Handle other errors
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong! Please try again.',
            });
        }
    });
});

});


