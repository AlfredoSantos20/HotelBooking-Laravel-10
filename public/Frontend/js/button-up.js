$(document).ready(function() {
    // Show or hide the "Go Up" button depending on scroll position
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('#goUpButton').fadeIn();
        } else {
            $('#goUpButton').fadeOut();
        }
    });

    // Scroll to top when the button is clicked
    $('#goUpButton').click(function() {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });
});
