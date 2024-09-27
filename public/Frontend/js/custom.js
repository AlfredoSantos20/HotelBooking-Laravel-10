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
$('#signupForm').on('submit', function(e) {
    e.preventDefault();

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
                    title: 'Error',
                    text: 'Please check all of the fields.',
                });
            }
        },
        error: function(xhr) {
            // Clear previous errors
            $('.error').text('');

            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;

                // Display validation errors in form fields
                for (const [field, messages] of Object.entries(errors)) {
                    $(`#${field}-error`).text(messages.join(', '));
                }

                // Check if there's a g-recaptcha-response error
                if (errors['g-recaptcha-response']) {
                    Swal.fire({
                        icon: 'error',
                        title: 'reCAPTCHA Error',
                        text: errors['g-recaptcha-response'].join(', '),  // Show reCAPTCHA error in SweetAlert
                    });
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




// Forgotpass Form & Request OTP
let otpTimer; // To hold the timer interval
let otpTimeLeft = 60; // 60 seconds

$('#forgotpassForm').on('submit', function(e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        url: '/forgotUserPassword',
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.type === 'success') {
                var email = $("input[id='email']").val();
                $("#hiddenEmail").val(email);

                // Hide the Send OTP form and show the Verify OTP form
                $('#forgotpassForm').hide();
                $('#otpForm').show();

                // Start the OTP timer
                startOtpTimer();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Please check all of the fields.',
                });
            }
        }
    });
});

// Start OTP timer
function startOtpTimer() {
    $('#otpTimer').show();
    $('#resendOtp').hide(); // Hide resend button initially
    otpTimeLeft = 60; // Reset timer
    $('#timerDisplay').text(otpTimeLeft);

    otpTimer = setInterval(function() {
        otpTimeLeft--;
        $('#timerDisplay').text(otpTimeLeft);

        if (otpTimeLeft <= 0) {
            clearInterval(otpTimer);
            $('#otpTimer').hide();
            $('#resendOtp').show(); // Show resend button after timer expires
        }
    }, 1000);
}

// Resend OTP function
$('#resendOtp').on('click', function() {
    var email = $("#hiddenEmail").val();

    $.ajax({
        url: '/forgotUserPassword',
        type: 'POST',
        data: {
            email: email, // Include the email for OTP resend
            _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
        },
        success: function(response) {
            if (response.type === 'success') {
                // Reset the timer
                clearInterval(otpTimer);
                startOtpTimer();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'New OTP sent to your registered email.',
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Could not resend OTP.',
                });
            }
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: xhr.responseJSON.message || 'Something went wrong.',
            });
        }
    });
});

// Verify OTP
$('#otpForm').on('submit', function(e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        url: '/forgotUserPassword',
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.type === 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid OTP',
                    text: response.message,
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'New password has been sent to your registered email.',
                });

                // Close modal and reset forms
                $('#forgotpassword').modal('hide');
                $('#forgotpassForm')[0].reset();
                $('#otpForm')[0].reset();
                $('#otpForm').hide();
                $('#forgotpassForm').show();
                clearInterval(otpTimer); // Clear timer
            }
        }
    });
});

//Hide un hide select date and days
$('#selectDaysBtn').click(function() {
    $('#daySelection').show(); // Show the day selection
    $('#dateSelection').hide(); // Hide the date selection
    clearInputsDateSelection(); // Clear previous date inputs
    $('#day').focus(); // Focus on the day select to avoid invalid control error
});

$('#selectDatesBtn').click(function() {
    $('#dateSelection').show();
    $('#daySelection').hide();
    clearInputsDaySelection(); // Clear day selection inputs
    $('input[name="checkin_date"], input[name="checkout_date"]').prop('required', true); // Set required
    $('select[name="day"]').prop('required', false); // Remove required
});

function clearInputsDateSelection() {
    $('input[name="checkin_date"]').val('');
    $('input[name="checkout_date"]').val('');
}

function clearInputsDaySelection() {
    $('#day').val(''); // Clear the day select element
}




//   // Saving booking
  $('#bookingForm').on('submit', function(e) {
    e.preventDefault();

    // Serialize form data
    var formData = $(this).serialize();
    console.log('Form Data:', formData); // Log the form data

    $.ajax({
        url: '/saveBooking',
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('Response:', response); // Log the response

            // Handle response status and messages
            if (response.status) {
                switch (response.status) {
                    case 'occupied':
                        Swal.fire({
                            icon: 'error',
                            title: 'All Rooms Occupied',
                            text: response.message || 'All rooms of this type are occupied for the selected dates.',
                        });
                        break;
                    case "capacity_exceeded":
                    case "error_checkPersonCapacity":
                    case "invalid_dates":
                    case "invalid_booking_period":
                    case "invalid_booking_duration":
                    case "invalid_checkout_date":
                    case "occupied_days":
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                        break;
                    default:
                        // If the booking is saved successfully, show SweetAlert success message
                        Swal.fire({

                            icon: 'success',
                            title: 'Your booking has been saved in Room No: ' + response.room_id,
                            showConfirmButton: true,

                        });

                        // Optionally, clear the form fields
                        $('#bookingForm')[0].reset();
                }
            } else if (response.message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.message,
                });
            }
        },
        error: function(xhr) {
            // Log the entire response to help debug
            console.error('AJAX Error Response:', xhr.responseText);

            // Try to parse JSON if possible
            try {
                var jsonResponse = JSON.parse(xhr.responseText);
                if (jsonResponse.message) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: jsonResponse.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again.',
                    });
                }
            } catch (e) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please try again.',
                });
            }
        }
    });
});





//CHECK AVAILABLE ROOM
$('#availabilityForm').on('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    // Serialize form data
    var formData = $(this).serialize();

    $.ajax({
        url: '/checkAvailableRoom',
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            let title, text;

            // Determine the title and text based on the response status
            if (response.status === 'available') {
                title = 'Room Available!';
                text = 'Room No: ' + response.room_id + ' is available.';
            } else if (response.status === 'invalid_booking_period' || response.status === 'invalid_checkout') {
                title = 'Sorry!';
                text = response.message;
            } else {
                title = 'Sorry!';
                text = response.message; // Reuse the message for invalid states
            }

            // Display a success or error message using SweetAlert
            Swal.fire({
                icon: response.status === 'available' ? 'success' : 'error',
                title: title,
                text: text,
            });
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            let errorMessages = '';

            // Loop through validation errors and concatenate them
            $.each(errors, function(key, messages) {
                errorMessages += messages.join('<br>') + '<br>';
            });

            // Display validation error messages using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Sorry!',
                html: errorMessages // Use html to render line breaks
            });
        }
    });
});







//EMPLOYE SIGN
$('#EmploginForm').on('submit', function(e) {
    e.preventDefault();

    let formData = {
        email: $('#emp-email').val(),  // Corrected the ID
        password: $('#emp-password').val(),
        _token: $('input[name="_token"]').val()  // CSRF token
    };

    // Clear previous errors
    $('#emp-signin-error, #emp-signin-email, #emp-signin-password').text('');

    // Send AJAX request
    $.post('/empSignin', formData)
    .done(function(response) {
        if (response.success) {
            window.location.href = response.redirect_url;
        }else if(response.success){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: response.message,
            });
        }
    })
    .fail(function(xhr) {
        console.log(xhr);  // Log the entire xhr object
        console.log(xhr.responseJSON);  // Log the responseJSON part

        let errors = xhr.responseJSON.errors || {};
        $('#emp-signin-email').text(errors.email ? errors.email[0] : '');
        $('#emp-signin-password').text(errors.password ? errors.password[0] : '');
        $('#emp-signin-error').text(xhr.responseJSON.message || '');  // Show invalid email or password message
    });

});


// Employee password visibility
$('#show-password').on('click', function() {
    var passwordInput = $('#emp-password');
    if (passwordInput.attr('type') === 'password') {
        passwordInput.attr('type', 'text');
    } else {
        passwordInput.attr('type', 'password');
    }
});

$('#show-password-signup').on('click', function() {
    var passwordInput = $('#signup-password');
    var passwordConfirmationInput = $('#signup-password_confirmation');

    if (passwordInput.attr('type') === 'password') {
        passwordInput.attr('type', 'text');
        passwordConfirmationInput.attr('type', 'text');
    } else {
        passwordInput.attr('type', 'password');
        passwordConfirmationInput.attr('type', 'password');
    }
});


$('#show-password-signin').on('click', function() {
    var passwordInput = $('#user-password');
    if (passwordInput.attr('type') === 'password') {
        passwordInput.attr('type', 'text');
    } else {
        passwordInput.attr('type', 'password');
    }
});

 // Get today's date in YYYY-MM-DD format
 let today = new Date().toISOString().split('T')[0];

 // Set the min attribute to disable past dates
 $('#checkin_dates').attr('min', today);
 $('#checkout_dates').attr('min', today);

});

