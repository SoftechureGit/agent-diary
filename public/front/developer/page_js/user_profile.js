function get_state(value)
{
	 $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: BASE_URL+'/get-state',
        type: 'POST',
        data: {id: value },
        success: function (data) {
            $("#state_list").html(data);
        },
        error: function () {
            console.log('There is some error in user deleting. Please try again.');
        }
    });
}

function get_city(value)
{
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: BASE_URL+'/get-city',
        type: 'POST',
        data: {id: value },
        success: function (data) {
            $("#city_list").html(data);
        },
        error: function () {
            console.log('There is some error in user deleting. Please try again.');
        }
    });
}