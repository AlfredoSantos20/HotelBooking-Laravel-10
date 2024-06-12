$(document).ready(function(){
    $('#employee').DataTable();

    //for birthday to age converter
    $('#employee_birthday').on('change', function() {
        var birthdate = new Date($(this).val());
        var age = calculateAge(birthdate);
        $('#employee_age').val(age);
    });

    $('#addEmployeeForm').submit(function(e) {
        e.preventDefault();

        var fname = $('#employee_name').val();
        var lname = $('#employee_lname').val();
        var position = $('#employee_position').val();

        $.ajax({
            url: '{{ route("add-employee") }}',
            type: 'POST',
            data: {
                Fname: fname,
                Lname: lname,
                position: position,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                $('#addEmployee').modal('hide');
                // Refresh the page or update the table using JavaScript if needed
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });

     //for birthday to age converter
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


});
