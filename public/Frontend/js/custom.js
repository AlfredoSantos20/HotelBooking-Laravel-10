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
        } else {
            $("#timer-" + id).text(countdown);
        }
    }, 1000);
}

// Function to start a 30-second real-time countdown and disable/enable the Sign-in button
function startRealTimeCountdown() {
    var countdown = 30;
    var timerElement = $("#countdown-timer");
    var button = $("#signin-button");
    var timer = setInterval(function() {
        countdown--;
        timerElement.text(countdown + " seconds");
        button.prop('disabled', true); // Disable the button
        timerElement.show(); // Show the timer

        if (countdown <= 0) {
            clearInterval(timer);
            timerElement.text("30 seconds"); // Reset the timer display
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

});


