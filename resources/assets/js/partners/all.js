$('#number').on('change', function (e) {
    var number = e.target.value;
    console.log(number);
    window.location = '/vehres/public/partner/garages?number=' + number;
});
$('#province').on('change',function(e){
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
    var ward_id=e.target.value;
    $.get('/vehres/public/partner/findPlace?id='+ ward_id,function(data){
        $('#ward').empty();
        $.each(data,function (index, ward) {
            $('#ward').append('<option value="'+ward.id+'">'+ward.name+'</option>');
        })
    })
})

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

tinymce.init({
    selector: 'textarea',
    height: 350,
    theme: 'modern',
    plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
    ],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
    image_advtab: true,
    templates: [
        { title: 'Test template 1', content: 'Test 1' },
        { title: 'Test template 2', content: 'Test 2' }
    ],
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
    ]
});
