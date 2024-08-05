$(document).ready(function(){
    $('#employee').DataTable();
    $('#banner').DataTable();
    $('#room').DataTable();
    $('#foods').DataTable();

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



    //Feching Regions Provinces Cities and Barangays
    $(document).ready(function() {

        $('#region').change(function(event) {
            var idRegion = this.value;
            $('#province').html('');
            $('#city').html('<option value="">Select City</option>');
            $('#barangay').html('<option value="">Select Barangay</option>');

            console.log('Selected Region ID:', idRegion);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/fetch-provinces",
                type: 'POST',
                dataType: 'json',
                data: {region_id: idRegion},
                success: function(response) {
                    console.log('Response:', response);

                    $('#province').html('<option value ="">Select Province</option>');
                    $.each(response.provinces, function(index, val) {
                        $('#province').append('<option value="' + val.province_id + '">' + val.name + '</option>');
                    });
                    // if (initialProvinceId) {
                    //     $('#province').val(initialProvinceId).trigger('change');
                    // }
                }
            });
        });

//---START Update Employee status
$(document).on("click", ".updateEmployeeStatus", function(){
    var status = $(this).children("i").attr("status");
    var employee_id = $(this).attr("employee_id");

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: '/users-management/update-employee-status',
        data: { status: status, employee_id: employee_id },
        success: function(resp) {
            if (resp.status == 0) {
                // Update label badge and icon for Inactive status
                $("#status-label-" + employee_id).removeClass('badge-success').addClass('badge-danger').text('Inactive');
                $("#employee-" + employee_id + " i").removeClass('text-success').addClass('text-danger').attr('status', 'Inactive');
            } else if (resp.status == 1) {
                // Update label badge and icon for Active status
                $("#status-label-" + employee_id).removeClass('badge-danger').addClass('badge-success').text('Active');
                $("#employee-" + employee_id + " i").removeClass('text-danger').addClass('text-success').attr('status', 'Active');
            }
        },
        error: function() {
            alert("Error occurred while updating status");
        }
    });
});

//--- End Update Employee status

        $('#province').change(function(event) {
            var idProvince = this.value;
            $('#city').html('');
            $('#barangay').html('<option value="">Select Barangay</option>');

            console.log('Selected Province ID:', idProvince);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/fetch-cities",
                type: 'POST',
                dataType: 'json',
                data: {province_id: idProvince},
                success: function(response) {
                    console.log('Response:', response);

                    $('#city').html('<option value ="">Select City</option>');
                    $.each(response.cities, function(index, val) {
                        $('#city').append('<option value="' + val.city_id + '">' + val.name + '</option>');
                    });
                    // if (initialCityId) {
                    //     $('#city').val(initialCityId).trigger('change');
                    // }
                }
            });
        });

        $('#city').change(function(event) {
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
                success: function(response) {
                    console.log('Response:', response);

                    $('#barangay').html('<option value ="">Select Barangay</option>');
                    $.each(response.barangays, function(index, val) {
                        $('#barangay').append('<option value="' + val.id + '">' + val.name + '</option>');
                    });
                    // if (initialBarangayId) {
                    //     $('#barangay').val(initialBarangayId);
                    // }
                }
            });
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

//Delete Employee function
$(document).on("click",".employeeDelete",function(){
    var module = $(this).attr('module');
    var moduleid = $(this).attr('moduleid');

    //ito ay para sa sweetalert2
    Swal.fire({
        title: 'Are you sure?',
        text: "You wont retrieve this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          window.location= "/users-management/delete-"+module+"/"+moduleid;
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

//--- START Form submission via AJAX add-edit-banner With status and delete function
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
$(document).on("click",".bannerDelete",function(){
    var module = $(this).attr('module');
    var moduleid = $(this).attr('moduleid');

    //ito ay para sa sweetalert2
    Swal.fire({
        title: 'Are you sure?',
        text: "You wont retrieve this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          window.location= "/banners-management/delete-"+module+"/"+moduleid;
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

//--- End Form submission via AJAX add-edit-banner With status and delete function


//--- START Form submission via AJAX add-edit-room With update status and delete function
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

//Update Room status
$(document).on("click", ".updateRoomStatus", function(){
    var status = $(this).children("i").attr("status");
    var room_id = $(this).attr("room_id");

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: '/rooms-management/update-room-status',
        data: { status: status, room_id: room_id },
        success: function(resp) {
            if (resp.status == 0) {
                // Update label badge and icon for Inactive status
                $("#status-label-" + room_id).removeClass('badge-success').addClass('badge-danger').text('Inactive');
                $("#room-" + room_id + " i").removeClass('text-success').addClass('text-danger').attr('status', 'Inactive');
            } else if (resp.status == 1) {
                // Update label badge and icon for Active status
                $("#status-label-" + room_id).removeClass('badge-danger').addClass('badge-success').text('Active');
                $("#room-" + room_id + " i").removeClass('text-danger').addClass('text-success').attr('status', 'Active');
            }
        },
        error: function() {
            alert("Error occurred while updating status");
        }
    });
});


//Delete Room function
$(document).on("click",".deleteRoom",function(){
    var module = $(this).attr('module');
    var moduleid = $(this).attr('moduleid');

    //ito ay para sa sweetalert2
    Swal.fire({
        title: 'Are you sure?',
        text: "You wont retrieve this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          window.location= "/rooms-management/delete-"+module+"/"+moduleid;
        }
      });
});

//--- End Form submission via AJAX add-edit-ROOM With status and delete function

//--- START Form submission via AJAX add-edit-roomtype With update status and delete function
$('#roomtypeForm').on('submit', function(event) {
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

//Update Roomtype status
$(document).on("click", ".updateRoomtypeStatus", function(){
    var status = $(this).children("i").attr("status");
    var roomtype_id = $(this).attr("roomtype_id");

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: '/rooms-management/update-roomtype-status',
        data: { status: status, roomtype_id: roomtype_id },
        success: function(resp) {
            if (resp.status == 0) {
                // Update label badge and icon for Inactive status
                $("#status-label-" + roomtype_id).removeClass('badge-success').addClass('badge-danger').text('Inactive');
                $("#roomtype-" + roomtype_id + " i").removeClass('text-success').addClass('text-danger').attr('status', 'Inactive');
            } else if (resp.status == 1) {
                // Update label badge and icon for Active status
                $("#status-label-" + roomtype_id).removeClass('badge-danger').addClass('badge-success').text('Active');
                $("#roomtype-" + roomtype_id + " i").removeClass('text-danger').addClass('text-success').attr('status', 'Active');
            }
        },
        error: function() {
            alert("Error occurred while updating status");
        }
    });
});

//Delete Roomtype function
$(document).on("click",".deleteRoomType",function(){
    var module = $(this).attr('module');
    var moduleid = $(this).attr('moduleid');

    //ito ay para sa sweetalert2
    Swal.fire({
        title: 'Are you sure?',
        text: "You wont retrieve this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          window.location= "/rooms-management/delete-"+module+"/"+moduleid;
        }
      });
});

//--- End Form submission via AJAX add-edit-roomtype With status and delete function

// --START ADD EDIT FOOD FUNCTION WITH STATUS AND DELETE
$('#foodForm').on('submit', function(event) {
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

//Update Food status
$(document).on("click", ".updateFoodStatus", function(){
    var status = $(this).children("i").attr("status");
    var food_id = $(this).attr("food_id");

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: '/foods-management/update-foods-status',
        data: { status: status, food_id: food_id },
        success: function(resp) {
            if (resp.status == 0) {
                // Update label badge and icon for Inactive status
                $("#status-label-" + food_id).removeClass('badge-success').addClass('badge-danger').text('Inactive');
                $("#food-" + food_id + " i").removeClass('text-success').addClass('text-danger').attr('status', 'Inactive');
            } else if (resp.status == 1) {
                // Update label badge and icon for Active status
                $("#status-label-" + food_id).removeClass('badge-danger').addClass('badge-success').text('Active');
                $("#food-" + food_id + " i").removeClass('text-danger').addClass('text-success').attr('status', 'Active');
            }
        },
        error: function() {
            alert("Error occurred while updating status");
        }
    });
});

//Delete Food function
$(document).on("click",".deleteFood",function(){
    var module = $(this).attr('module');
    var moduleid = $(this).attr('moduleid');

    //ito ay para sa sweetalert2
    Swal.fire({
        title: 'Are you sure?',
        text: "You wont retrieve this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          window.location= "/foods-management/delete-"+module+"/"+moduleid;
        }
      });
});
// --END ADD EDIT FOOD FUNCTION WITH STATUS AND DELETE
});

