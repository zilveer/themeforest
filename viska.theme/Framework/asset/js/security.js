(function($){
    "use strict";
    $(document).ready(function(){

        //save theme options via ajax
        $('input[name=save-security]').click(function(){
            $("#save-alert").css({"opacity":"1","display":"block"});

            var values = $("#awe_form").serialize();

            $("#awe_form").find(":checkbox").each(function(){
                if($(this).is(":not(:checked)"))
                    values += '&'+encodeURIComponent($(this).attr("name"))+'=0';
            });

            values = JSON.stringify(values);
            $.post(ajaxurl,{'action': "awe_security_save", 'data': values},
                function(data, textStatus, jqXHR ){
                    var obj = JSON.parse(data);
                    if(obj.type=="success"){
                        $("#save-alert i").removeClass("dashicons-update").addClass("dashicons-yes");
                        setTimeout(function() {
                            $("#save-alert").css({"opacity":"0","display":"none"});
                            $("#save-alert i").removeClass("dashicons-yes").addClass("dashicons-update");

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
                        $(".md-alert-boxs").html("<div class=\"alert-box alert-error\"><strong>Error!</strong> Save Error!</div>");
                        setTimeout(function(){
                            $(".alert-error").remove();
                        },5000);
                    }

                });
            return false;
        });

        $("button[name=awe_generate_key]").on("click", function(e){
            $.ajax({
                type:	'POST',
                cache:	false,
                url:	ajaxurl,
                data:	{ "action" : "generate_key"},
                success: function(data, status){
                    $("input[name='security[secret-key]']").val(data);
                }
            });
            e.preventDefault();
        });

        $(".have-extra .click-enable").on("click", function(){

            $(this).parent().parent().find(".extra").show();
        });
        $(".have-extra .click-disable").on("click", function(){
            $(this).parent().parent().find(".extra").hide();
        });

        $('#security_form .click-enable,#security_form .click-disable, #security_form .label-checkbox' ).bind( "change click select", function() {
            $(".md-alert-change").html("<div class=\"alert-box alert-warning\"><strong>Warning! </strong>The settings have been changed. In order to save them please don't forget to click the 'Save' button.</div>").fadeIn();
        });
        $('.md-captcha .click-enable').on("click", function(){
            console.log("ok");
//            $("#md-captcha").show();
            $(".md-tabs-framewp li.md-captcha").show();
        });

        $('.md-captcha .click-disable').on("click", function(){
//            $("#md-captcha").hide();
            $(".md-tabs-framewp li.md-captcha").hide();
        });

        if(isRewrite=='1')
        {
            $("input[name='security[slug-login]']").on("change keyup",function(){
                $(".awe-new-login-url").text(siteUrl+'/'+$(this).val());
                $(".awe-new-login-url").attr("href",siteUrl+'/'+$(this).val());
            });
        }else{
            $("input[name='security[secret-key]']").on("change keyup",function(){
                $(".awe-new-login-url").text(siteUrl+'/wp-login.php?awe_key='+$(this).val());
                $(".awe-new-login-url").attr("href",siteUrl+'/wp-login.php?awe_key='+$(this).val());
            });
        }
    });

})(jQuery);