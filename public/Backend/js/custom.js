$(document).ready(function(){
    $('#employee').DataTable();
    $('#banner').DataTable();
    $('#room').DataTable();

    //FOR BIRTHDAY TO AGE CONVERTER
    $('#employee_birthday').on('change', function() {
        var birthdate = new Date($(this).val());
        var age = calculateAge(birthdate);
        $('#employee_age').val(age);
    });


     //FOR BIRTHDAY TO AGE CONVERTER
    function calculateAge(birthdate) {
        var today = new Date();
        var age = today.getFullYear() - birthdate.getFullYear();
        var m = today.getMonth() - birthdate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthdate.getDate())) {
            age--;
        }
        return age;
    }
    //Fetching Provinces of Region
    $('#region').change(function(event){
        var idRegion = this.value;
        $('#province').html('');

        console.log('Selected Region ID:', idRegion);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/api/fetch-provinces",
            type: 'POST',
            dataType: 'json',
            data: {region_id: idRegion},
            success: function(response){
                console.log('Response:', response);

                $('#province').html('<option value ="">Select Province</option>');
                $.each(response.provinces, function(index, val){
                    $('#province').append('<option value="' + val.province_id + '">' + val.name + '</option>');
                });
                $('#city').html('<option value="">Select City</option>');

            }
        });
    });

      //Fetching Cities of Province
    $('#province').change(function(event){
        var idProvince = this.value;
        $('#city').html('');

        console.log('Selected Province ID:', idProvince);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/api/fetch-cities",
            type: 'POST',
            dataType: 'json',
            data: {province_id: idProvince},
            success: function(response){
                console.log('Response:', response);

                $('#city').html('<option value ="">Select City</option>');
                $.each(response.cities, function(index, val){
                    $('#city').append('<option value="' + val.city_id + '">' + val.name + '</option>');
                });
                $('#barangay').html('<option value="">Select Barangay</option>');

            }
        });
    });

    //Fetching Brgys of Cities
    $('#city').change(function(event){
        var idCity = this.value;
        $('#barangay').html('');

        console.log('Selected City ID:', idCity);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/api/fetch-barangay",
            type: 'POST',
            dataType: 'json',
            data: {city_id: idCity},
            success: function(response){
                console.log('Response:', response);

                $('#barangay').html('<option value ="">Select Barangay</option>');
                $.each(response.barangays, function(index, val){
                    $('#barangay').append('<option value="' + val.id + '">' + val.name + '</option>');
                });


            }
        });
    });

    // Form submission via AJAX adding-edit-employee
    $('#employeeForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        var formData = new FormData(this); // Create a FormData object

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).attr('action'), // Get the action URL from the form
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success response
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Data has been saved",
                    showConfirmButton: false,
                    timer: 5000 //5 seconds
                });
                // Optionally, you can reload the DataTable or redirect the user
                location.reload();
            },
            error: function(response) {
                // Handle error response
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    var errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '\n';
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: errorMessage
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred. Please try again.'
                    });
                }
            }
        });
    });



    // Function to zoom in on image in table
    function zoomIn(element) {
        $(element).css('transform', 'scale(1.2)');
    }

    // Function to reset image zoom
    function zoomOut(element) {
        $(element).css('transform', 'scale(1)');
    }

    // Event handler for image hover
    $('.zoomable-image').hover(
        function() {
            zoomIn(this);
        },
        function() {
            zoomOut(this);
        }
    );

// START Form submission via AJAX add-edit-banner With status and delete function
$('#bannerForm').on('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    var formData = new FormData(this); // Create a FormData object

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $(this).attr('action'), // Get the action URL from the form
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Handle success response
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: response.message,
                showConfirmButton: false,
                timer: 5000 // 5 seconds
            });

            location.reload();
        },
        error: function(response) {
            // Handle error response
            if (response.status === 422) {
                var errors = response.responseJSON.errors;
                var errorMessage = '';
                $.each(errors, function(key, value) {
                    errorMessage += value[0] + '\n';
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: errorMessage
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred. Please try again.'
                });
            }
        }
    });
});

//Delete Banner function
$(document).on("click", ".confirmDelete", function(){
    var module = $(this).attr('module');
    var moduleid = $(this).attr('moduleid');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't retrieve this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "/banners-management/delete-"+module+"/"+moduleid,
                type: 'DELETE',
                success: function(response) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                    location.reload();
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'There was an error deleting your file.',
                        'error'
                    );
                }
            });
        }
    });
});

//Update Banner status
$(document).on("click", ".updateBannerStatus", function(){
    var status = $(this).children("i").attr("status");
    var banner_id = $(this).attr("banner_id");

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: '/banners-management/update-banner-status',
        data: { status: status, banner_id: banner_id },
        success: function(resp) {
            if (resp.status == 0) {
                // Update label badge and icon for Inactive status
                $("#status-label-" + banner_id).removeClass('badge-success').addClass('badge-danger').text('Inactive');
                $("#banner-" + banner_id + " i").removeClass('text-success').addClass('text-danger').attr('status', 'Inactive');
            } else if (resp.status == 1) {
                // Update label badge and icon for Active status
                $("#status-label-" + banner_id).removeClass('badge-danger').addClass('badge-success').text('Active');
                $("#banner-" + banner_id + " i").removeClass('text-danger').addClass('text-success').attr('status', 'Active');
            }
        },
        error: function() {
            alert("Error occurred while updating status");
        }
    });
});

// End Form submission via AJAX add-edit-banner With status and delete function

// START Form submission via AJAX add-edit-room With update status and delete function
$('#roomForm').on('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    var formData = new FormData(this); // Create a FormData object

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $(this).attr('action'), // Get the action URL from the form
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Handle success response
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: response.message,
                showConfirmButton: false,
                timer: 5000 // 5 seconds
            });

            location.reload();
        },
        error: function(response) {
            // Handle error response
            if (response.status === 422) {
                var errors = response.responseJSON.errors;
                var errorMessage = '';
                $.each(errors, function(key, value) {
                    errorMessage += value[0] + '\n';
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: errorMessage
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred. Please try again.'
                });
            }
        }
    });
});

//Delete Banner function
$(document).on("click", ".confirmDelete", function(){
    var module = $(this).attr('module');
    var moduleid = $(this).attr('moduleid');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't retrieve this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "/rooms-management/delete-"+module+"/"+moduleid,
                type: 'DELETE',
                success: function(response) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                    location.reload();
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'There was an error deleting your file.',
                        'error'
                    );
                }
            });
        }
    });
});

//Update Banner status
$(document).on("click", ".updateBannerStatus", function(){
    var status = $(this).children("i").attr("status");
    var banner_id = $(this).attr("banner_id");

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: '/banners-management/update-banner-status',
        data: { status: status, banner_id: banner_id },
        success: function(resp) {
            if (resp.status == 0) {
                // Update label badge and icon for Inactive status
                $("#status-label-" + banner_id).removeClass('badge-success').addClass('badge-danger').text('Inactive');
                $("#banner-" + banner_id + " i").removeClass('text-success').addClass('text-danger').attr('status', 'Inactive');
            } else if (resp.status == 1) {
                // Update label badge and icon for Active status
                $("#status-label-" + banner_id).removeClass('badge-danger').addClass('badge-success').text('Active');
                $("#banner-" + banner_id + " i").removeClass('text-danger').addClass('text-success').attr('status', 'Active');
            }
        },
        error: function() {
            alert("Error occurred while updating status");
        }
    });
});

// End Form submission via AJAX add-edit-banner With status and delete function

});

