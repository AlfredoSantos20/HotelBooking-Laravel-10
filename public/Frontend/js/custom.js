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
});
