(function($){
    $(document).ready(function() {

        //save theme options via ajax
        $('input[name=save-generate]').click(function(){

            $("#save-alert").css({"opacity":"1","display":"block"});

            var values = $("#awe_form").serialize();

            $("#awe_form").find(":checkbox").each(function(){
                if($(this).is(":not(:checked)"))
                    values += '&'+$(this).attr("name")+'=0';
            });
            values = JSON.stringify(values);
            $.post(ajaxurl,{'action': "awe_frame_save", 'data': values,_wpnonce: $("input[name='_wpnonce']").val(),_wp_http_referer: $("input[name='_wp_http_referer']").val()},
                function(data, textStatus, jqXHR ){
                    var obj = JSON.parse(data);
                    if(obj.type=="success"){
                        $("#save-alert i").removeClass("dashicons-update").addClass("dashicons-yes");
                        setTimeout(function() {
                            $("#save-alert").css({"opacity":"0","display":"none"});
                            $("#save-alert i").removeClass("dashicons-yes").addClass("dashicons-update");
                            location.reload();

                        }, 2000);
                        $(".md-alert-boxs").html("<div class=\"alert-box alert-success\"><strong>Success!</strong> Save Ok!</div>");
                        setTimeout(function(){
                            $(".alert-success").remove();
                        },5000);
                    }else
                    {
                        $("#save-alert i").removeClass("dashicons-update").addClass("dashicons-no");
                        setTimeout(function() {
                            $("#save-alert").css({"opacity":"0","display":"none"});
                            $("#save-alert i").removeClass("dashicons-no").addClass("dashicons-update");

                        }, 2000);
                        $(".md-alert-boxs").html("<div class=\"alert-box alert-error\"><strong>Success!</strong> Save Error!</div>");
                        setTimeout(function(){
                            $(".alert-error").remove();
                        },5000);
                    }
                    return false;
                });
            return false;
        });

    });
})(jQuery);
