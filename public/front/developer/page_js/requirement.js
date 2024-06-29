function get_location()
{  var city=$("#city option:selected").text();

    jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-location',
              type: 'POST',
              //dataType: 'json',
              data: {id:city},
              success: function (data) {
                  $("#location").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });

}

function get_city(id)
{
    jQuery.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
              url: BASE_URL + '/get-city',
              type: 'POST',
              //dataType: 'json',
              data: {id:id},
              success: function (data) {
                  $("#city").html(data);
                 },
                error: function (error) {
                     console.log(error);
                 }
             });

}