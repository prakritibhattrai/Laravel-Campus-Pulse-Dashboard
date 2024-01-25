
//Initialize Base Url
let baseurl = window.location.origin;

$(document).ready(function(){
    $('#description').summernote({
        height: 180,
        toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
        ]
    });

})
$(document).ready(function(){

    $('input[id=tags]').tagsinput();
    $('.bootstrap-tagsinput input').keydown(function( event ) {
        if ( event.which == 13 ) {
                $(this).blur();
                $(this).focus();
                return false;
        }
    });

});


 //Dropzone.autoDiscover = false;
 $(document).ready(function(){

    var myDropzone = new Dropzone(".dropzone", {
    //autoProcessQueue: false,
    addRemoveLinks: true,
    maxFilesize: 1,
    acceptedFiles: ".jpeg,.jpg,.png,.gif"
    });

    $('#uploadFile').click(function(){
        myDropzone.processQueue();
    });
});

////////////////

$(document).on('click', '#images', function(event) {
    event.preventDefault();
    /* Act on the event */
    getImages();

});
$(document).on('click', '#nav-home-tab', function(event) {
    event.preventDefault();
    /* Act on the event */

    getImages();

});
var getImages = function(){

    $.ajax({
        type:'GET',
        url:baseurl+'/admin/gallery/getallImages', //Make sure your URL is correct
        dataType: 'json', //Make sure your returning data type dffine as json
        success:function(data){
            console.log(data);
            let html = "<div class='row'>"
                var images = $("#preview-image").find("img").map(function() { return this.src; }).get();
                if(images.length == 0) {
                   images = $("#preview").find("img").map(function() { return this.src; }).get();
                }
            $.each(data.images, function (key, value) {
               var all_images=baseurl+'/'+value.title;

               if(images.includes(all_images)) {
                var select_class='select';

                } else {
                    var select_class='';
                }

                html+='<div class="col-lg-2">'
                html+='<img src="'+baseurl+'/'+
                value.title+'" width="100%" height="155px" style="object-fit:contain;margin-bottom:20px;" class="gal_image '+select_class+'" title="'+value.title+'" data-id="'+value.title+'">'
                html+='</div>'

            });
            html+='</div>'
            $("#nav-home").html(html);
        }
    });
}

///////////
jQuery(function ($) {
    var image_arr=[];
    var dataid=$('#images_input').val().split(" ");

$(document).on('click', '.gal_image', function(event) {
    var myLink = "this";
    var data_id=$(this).attr("data-id");

    if ($(this).hasClass('select')) {

        $(this).removeClass('select');
        delete image_arr[image_arr.indexOf(this.src)];
        delete dataid[dataid.indexOf(data_id)];
        image_arr=image_arr.filter(function(e){return e});
        dataid=dataid.filter(function(e){return e});
    }
    else {
        $(this).addClass('select');
        image_arr.push(this.src);
        dataid.push(data_id);
        dataid=dataid.filter(function(e){return e});
    }

    $(document).on('click', '#image_send', function(event) {
        console.log(dataid)
        var html='<div class="row" style="margin:20px auto;">';

        $.each(dataid, function (key, value) {
            html+='<div class="col-lg-2 mb-3">';
            html+='<img src="'+baseurl+'/'+value+
            '" class="upload_image" data-id="'+value+
            '" width="100%" height="" style="height:80px; width:80px; padding:5px; object-fit:contain; border:1px solid rgb(201, 198, 198);">';
            html+='</div>';

        });
        html+='</div>';

        $("#preview").html(html);
        $("#preview-image").remove();
        document.forms['my_form']['photos'].value = dataid;

        $(document).on('click', '.upload_image', function(event) {

            delete dataid[dataid.indexOf($(this).attr("data-id"))];
            dataid=dataid.filter(function(e){return e});
            $(this).parent().remove();
            document.forms['my_form']['photos'].value = dataid;

        });
    });

});
});

/////Remove Themes Image//////
$('document').ready(function(){
    $('.removeimage').on('click',function(){

        console.log($(this).attr('data-name'));
        var name=$(this).attr('data-name');
        var id=$('.image_background').data("id");
        $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $.ajax({
            type: "GET",
            url: baseurl+'/admin/themes/remove-image/'+id,
            data:{ name : name },
            success: function(data) {
                console.log(data)
                $('*[data-name="'+name+'"]').hide();
            }

        });
    });
});
