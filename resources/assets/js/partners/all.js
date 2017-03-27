$('#number').on('change', function (e) {
    var number = e.target.value;
    console.log(number);
    window.location = '/vehres/public/partner/garages?number=' + number;
});
$('#selectProvincesField').on('click', '#province_id',function(e){
    var province_id=e.target.value;
    $.get('/vehres/public/partner/findPlace?id='+province_id + '&type=district_id',function(data){
        $('#selectWardsField').empty();
        $('#selectDistrictsField').html(data);
    })
}).change(function () {
    $(this).click();
});
$('#selectDistrictsField').on('click',  '#district_id',function (e) {
    var ward_id=e.target.value;
    $.get('/vehres/public/partner/findPlace?id='+ ward_id + '&type=ward_id',function(data){
        $('#selectWardsField').html(data);
    })
}).change(function () {
    $(this).click();
});

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.btn-delete').click(function (event) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
        }, function () {
            var btn = $(event.currentTarget);
            var garageId = btn.data('garage-id');
            $.ajax({
                url: laroute.action('App\Http\Controllers\Partner\GarageController@destroy', {'garage' : garageId}),
                method: 'POST',
                data: {'_method' : 'DELETE'},
                success: function () {
                    swal({
                        title: "Deleted!",
                        text: "Your imaginary file has been deleted.",
                        type: "success",
                        showOkButton: false,
                        timer: 2000
                    });
                    btn.closest('tr').remove();
                }
            });
        });
    });
});
