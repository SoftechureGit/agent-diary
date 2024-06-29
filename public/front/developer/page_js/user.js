function get_state(id)
{
  $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: BASE_URL+'/builder/get-state',
            type: 'POST',
            data: {id: id },
            success: function (data) {
               
              $('#state_list').html(data);
            },
            error: function () {
                console.log('There is some error in user deleting. Please try again.');
            }
        });
}

function get_city(id)
{
    $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: BASE_URL+'/builder/get-city',
            type: 'POST',
            data: {id: id },
            success: function (data) {
               $('#city_list').html(data);
            },
            error: function () {
                console.log('There is some error in user deleting. Please try again.');
            }
        });
}
