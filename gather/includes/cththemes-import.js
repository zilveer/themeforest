(function($) {
    "use strict";
    $('.cththemes_import').click(function(event){
        event.preventDefault();
        var import_true = confirm('are you sure to import demo content ? it will overwrite the existing data');
        if(import_true == false) {
            //console.log('confirm false');
            return;
        }
        $('#cththemes_import_message').html(' Demo Data for this theme is being imported please be patient :)  ');
        var data = {
            'action': 'cththemes_import'       
        };

        $("#cththemes_import_loading").css('display','inline-block');

       // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        // $.post(ajaxurl, data, function(response) {
        //     $('#cththemes_import_message').html('<div class="import_message_success">'+ response +'</div>');
        //     $("#cththemes_import_loading").css('display','none');
        //     //alert('Got this from the server: ' + response); <i class="fa fa-spinner fa-3x fa-spin"></i>
        // });
        //console.log('imported');

        $.ajax({
            // xhr: function()
            // {
            //     var xhr = new window.XMLHttpRequest();
            //     //Upload progress
            //     // xhr.upload.addEventListener("progress", function(evt){
            //     //   if (evt.lengthComputable) {
            //     //     var percentComplete = evt.loaded / evt.total;
            //     //     //Do something with upload progress
            //     //     console.log(percentComplete);
            //     //   }
            //     // }, false);
            //     xhr.addEventListener("onprogress", function(evt){
            //         console.log(evt);
            //         // if (evt.lengthComputable) {
            //         //   var percentComplete = evt.loaded / evt.total;
            //         //   //Do something with download progress
            //         //   console.log(percentComplete);
            //         // }
            //     }, false);
            //     //Download progress
            //     xhr.addEventListener("progress", function(evt){
            //         console.log(evt);
            //         // if (evt.lengthComputable) {
            //         //   var percentComplete = evt.loaded / evt.total;
            //         //   //Do something with download progress
            //         //   console.log(percentComplete);
            //         // }
            //     }, false);
            //     return xhr;
            // },
            type: 'POST',
            url: ajaxurl,
            data: data,
            success: function(response){
                console.log(response);
                //Do something success-ish
                $('#cththemes_import_message').html('<div class="import_message_success">'+ response +'</div>');
                $("#cththemes_import_loading").css('display','none');
            }
        });


    });
})(jQuery);