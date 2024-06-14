$(document).ready(function(){
    $('#employee').DataTable();

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

    // Form submission via AJAX
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
                        timer: 3000
                    });
                    // Optionally, you can reload the DataTable or redirect the user
                    location.reload();
                },
                error: function(response) {
                    // Handle error response
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred. Please try again.'
                    });
                }
            });
        });


    // Function to zoom in on image
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
});
