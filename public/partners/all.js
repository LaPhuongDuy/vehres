
    $('#province').on('change',function(e){
        console.log(e);
        var province_id=e.target.value;
        $.get('/vehres/public/partner/findPlace?id='+province_id,function(data){
            $('#ward').empty();
            $('#district').empty();
            $.each(data,function (index, district) {
                $('#district').append('<option value="'+district.id+'">'+district.name+'</option>');
            })
        })
    });
    $('#district').on('change',function (e) {
        console.log(e);
        var ward_id=e.target.value;
        $.get('/vehres/public/partner/findPlace?id='+ ward_id,function(data){
            $('#ward').empty();
            $.each(data,function (index, ward) {
                $('#ward').append('<option value="'+ward.id+'">'+ward.name+'</option>');
            })
        })
    })
