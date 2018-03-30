jQuery.download = function(url, data, method){
    if( url && data ){
        data = typeof data == 'string' ? data : jQuery.param(data);
        var inputs = '';
        jQuery.each(data.split('&'), function(){
            var pair = this.split('=');
            inputs+='<input type="hidden" name="'+ pair[0] +'" value="'+ pair[1] +'" />';
        });
        jQuery('<form action="'+ url +'" method="'+ (method||'post') +'">'+inputs+'</form>')
            .appendTo('body').submit().remove();
    };
};

(function($){
    $(document).ready(function() {
        //import backup theme settings
        $(".import-data").on("click",function(e){
            e.preventDefault();
            $("#save-alert").css({"opacity":"1","display":"block"});
            var idata = $("textarea.import-data-text").val();
            $.post(ajaxurl,{'action': "import_theme_settings", 'data': idata},
                function(data, textStatus, jqXHR ){
                    var obj = JSON.parse(data);
                    if(obj.type=="success"){
                        $("#save-alert i").removeClass("dashicons-update").addClass("dashicons-yes");
                        setTimeout(function() {
                            $("#save-alert").css({"opacity":"0","display":"none"});
                            $("#save-alert i").removeClass("dashicons-yes").addClass("dashicons-update");

                        }, 1000);
                        $(".md-alert-boxs").html("<div class=\"alert-box alert-success\"><strong>Success!</strong> Please wait to reload data (^_^)</div>");
                        setTimeout(function(){
                            $(".alert-success").remove();
                        },2000);
                        setInterval(function(){
                            window.location.href=window.location.href;
                        }, 3000)
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
        });
        //save backup theme settings to file
        $(".export-data").on("click",function(e){
            e.preventDefault();
            $.download(ajaxurl,'action=export_theme_settings');
        });

        //save theme options via ajax
        $('input[name=save-theme]').click(function(){
            $("#save-alert").css({"opacity":"1","display":"block"});

            var values = $("#awe_form").serialize();
            $("#awe_form").find(":checkbox").each(function(){
               if($(this).is(":not(:checked)"))
                values += '&'+encodeURIComponent($(this).attr("name"))+'=0';
            });

            values = JSON.stringify(values);
            $.post(ajaxurl,{'action': "awe_save", 'data': values,_wpnonce: $("input[name='_wpnonce']").val(),_wp_http_referer: $("input[name='_wp_http_referer']").val()},
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



        // logo image
        if(!$("input[name='theme[logo][enable_image]']").is(":checked")){
           $(".extra-logo-image").hide();
        }
        $('.enable-logo-image .click-enable').on("click", function(){
            $(".extra-logo-image").fadeIn();
        });

        $('.enable-logo-image .click-disable').on("click", function(){
            $(".extra-logo-image").fadeOut();
        });
        $(".extra-logo-image .img-preview img").resizable({
            resize:function(event,ui){
                var parent = $(this).parent().parent().parent().parent();
                parent.find('.awe-resize-image-width').val(ui.size.width);
                parent.find('.awe-resize-image-height').val(ui.size.height);
            }
        });
        $(".upload-logo").upload_single_image({
            callback:function(e){
                e.current.parent().find(".img-preview img").resizable({
                    resize:function(event,ui){
                        var parent = $(this).parent().parent().parent().parent();
                        parent.find('.awe-resize-image-width').val(ui.size.width);
                        parent.find('.awe-resize-image-height').val(ui.size.height);
                    }

                });
            }
        });



        //slogan
        if(!$("input[name='theme[logo][enable_slogan]']").is(":checked")){
            $(".extra-slogan").hide();
        }
        $('.enable-slogan .click-enable').on("click", function(){
            $(".extra-slogan").fadeIn();
        });

        $('.enable-slogan .click-disable').on("click", function(){
            $(".extra-slogan").fadeOut();
        });


        //select content type to display
        $("select[name='theme[content][archives]']").on("click",function(){
           if($(this).val()=='content')
               $(".limit-content").fadeIn()
           else
               $(".limit-content").fadeOut()
        });

        // choose blog layout
        $(".md-layout-choose li").on("click",function(){
            $(".md-layout-choose li.chosen").removeClass('chosen');
            $(this).addClass('chosen');
            $(this).parent().parent().find("input").val($(this).attr("data-name"));
            return false;
        });
        $('.md-footer-conent .click-enable').on("click", function(){
            $(".md-footer-layout").fadeIn();
        });

        $('.md-footer-conent .click-disable').on("click", function(){
            $(".md-footer-layout").fadeOut();
        });



        //display feature image on post
        $("input[name='theme[content][feature-image]']").on("click",function(){
            if($(this).is(":checked"))
                $(".md-feature-image").show();
            else
                $(".md-feature-image").hide();
        });

        /************ TYPOGRAPHY ********/
        // choose color for site-link
        $("input.choose-color2").wpColorPicker({
            defaultColor: false
        });

        //choose color font for typography
        $("input.choose-color").wpColorPicker({

            defaultColor: false,
            change: function(event, ui){
                var color = $(this).val().toString();
                $(this).closest(".md-tabcontent-row").find(".demo-font p").css('color',color);
            },
            clear: function() {
                $(this).closest(".md-tabcontent-row").find(".demo-font p").css('color','');
            },
            hide: true,
            palettes: true
        });

        // Enable Custom Font
        // Enable Custom Font
        $("input:checkbox[name*='theme[typography']").on("click",function(){
            if($(this).is(":checked")){
                $(this).closest(".md-tabcontent-row").find(".md-row-element").last().fadeIn();
                $(this).closest(".md-tabcontent-row").find(".demo-font").fadeIn();
                $(this).closest(".md-tabcontent-row").find(".apply-for").fadeIn();
            }else{
                $(this).closest(".md-tabcontent-row").find(".md-row-element").last().fadeOut();
                $(this).closest(".md-tabcontent-row").find(".demo-font").fadeOut();
                $(this).closest(".md-tabcontent-row").find(".apply-for").fadeOut();
            }
        });



        // choose Font weight
        $(".choose-weight").change(function(){
            var weight = $(this).find(":selected");
            $(this).closest(".md-tabcontent-row").find(".demo-font p").css("font-weight",getFontWeight(weight.val()));
            $(this).closest(".md-tabcontent-row").find(".demo-font p").css("font-style",getFontStyle(weight.val()));
//            $(this).parent().find("input.font-style").val(getFontStyle(weight.val()));
            $(this).parent().find("input.font-weight").val(weight.val());

            console.log(getFontStyle(weight.val()));
        });
        // Choose font line height
        $(".choose-lineheight").on("change",function(){
            $(this).closest(".md-tabcontent-row").find(".demo-font p").css("line-height",$(this).val()+'px');
        });
        // choose font size
        $(".choose-size").on("change",function(){
            $(this).closest(".md-tabcontent-row").find(".demo-font p").css("font-size",$(this).val()+'px');
        })

        // choose font family
        $(".choose-font").change(function(){
            var selected = $(this).find(":selected");
            var styles = selected.attr("data-style");
            if(styles=='' || styles==undefined)
            {
                var options = '<option value="" selected="selected"></option>';
                $(this).closest(".form-inline").find("input.font-style").val('');
                $(this).closest(".form-inline").find("input.font-weight").val('');
                $(this).closest(".md-tabcontent-row").find(".demo-font p").css("font-weight",'');
                $(this).closest(".md-tabcontent-row").find(".demo-font p").css("font-style",'');
            }else{
                styles = styles.split(",");
                var options = '';
                for(var i=0;i<styles.length;i++)
                {
                    options += '<option value="'+styles[i]+'">'+expandFontWeight(styles[i])+'</option>';
                }
                // $(this).closest(".form-inline").find("input.font-weight").val('400');
            }

            var style = $(this).closest(".form-inline").find("select.choose-weight").html(options);
            var font_weight = $(this).parents('.form-inline').find('input.font-weight').val('');
            if(selected.val()=='' || selected.val()== undefined)
                $(this).closest(".md-tabcontent-row").find(".demo-font p").css("font-family","");
            else
                $(this).closest(".md-tabcontent-row").find(".demo-font p").css("font-family",selected.val());

        });

        //choose text-transform
        $(".choose-transform").change(function(){
            var selected = $(this).find(":selected");
            if(selected.val()=='none' || selected.val()== undefined)
                $(this).closest(".md-tabcontent-row").find(".demo-font p").css("text-transform","");
            else
                $(this).closest(".md-tabcontent-row").find(".demo-font p").css("text-transform",selected.val());
        })


        var default_fonts = { "":"","Arial":"n4,n7,i4,i7", "Verdana":"n4,n7,i4,i7", "Trebuchet MS":"n4,n7,i4,i7","Georgia":"n4,n7,i4,i7", "Times New Roman":"n4,n7,i4,i7", "Tahoma":"n4,n7,i4,i7"};
        $("textarea[name='theme[font][google]']").on("change",function(){
            if($(this).length)
            {
                updateGoogleFont($(this).val())
            }
        });

        function updateGoogleFont(fonts) {
            var regex = /([^\?]+)(\?family=)?([^&\']+)/i;
            var matches = regex.exec(fonts);

            if(matches && matches[3] != undefined) {
                $("head").append(fonts);
                var gfonts = matches[3].split("|");

                $(".choose-font").each(function(){
                    var selected = $(this).find(":selected").val(),optionHtml = "";
                    for (var key in default_fonts)
                    {
                        if(selected==key)
                            optionHtml += '<option data-style="'+default_fonts[key]+'" value="'+key+'" selected="selected">'+key+'</option>';
                        else
                            optionHtml += '<option data-style="'+default_fonts[key]+'" value="'+key+'">'+key+'</option>';
                    }
                    for (var i = 0; i < gfonts.length; i++) {
                        var gfontsdetail = gfonts[i].split(":"),
                            gfontname = gfontsdetail[0].replace("+", " "),
                            gfontweight = gfontsdetail[1] ? gfontsdetail[1] : "";
                        if(selected==key)
                            optionHtml += '<option data-style="' + gfontweight + '" value="' + gfontname + '" selected="selected">' + gfontname + '</option>';
                        else
                            optionHtml += '<option data-style="' + gfontweight + '" value="' + gfontname + '">' + gfontname + '</option>';
                    };
                    $(this).html(optionHtml)
                })
            }
        }

        //get font style
        function getFontStyle(fw){
            var italic =["i1","i2","i3","i4","i5","i6","i7","i8","i9","100italic","200italic","300italic","400italic","500italic","600italic","700italic","800italic","900italic"]
            return italic.indexOf(fw) != -1 ? "italic" : "normal";
        }
        // Convert and get font weight
        function getFontWeight(fw)
        {
            var fontExpands = {
                "n1": "100",
                "i1": "100",
                "n2": "200",
                "i2": "200",
                "n3": "300",
                "i3": "300",
                "n4": "400",
                "i4": "400",
                "n5": "500",
                "i5": "500",
                "n6": "600",
                "i6": "600",
                "n7": "700",
                "i7": "700",
                "n8": "800",
                "i8": "800",
                "n9": "900",
                "i9": "900",
                "100": "100",
                "100italic": "100",
                "200": "200",
                "200italic": "200",
                "300": "300",
                "300italic": "300",
                "400": "400",
                "400italic": "400",
                "500": "500",
                "500italic": "500",
                "600": "600",
                "600italic": "600",
                "700": "700",
                "700italic": "700",
                "800": "800",
                "800italic": "800",
                "900": "900",
                "900italic": "900",
                "": "400"
            }
            return fontExpands[fw] != undefined ? fontExpands[fw] : "400";
        }

        function expandFontWeight(fw) {
            var fontExpands = {
                "n1": "Thin",
                "i1": "Thin Italic",
                "n2": "Extra Light",
                "i2": "Extra Light Italic",
                "n3": "Light",
                "i3": "Light Italic",
                "n4": "Normal",
                "i4": "Italic",
                "n5": "Medium",
                "i5": "Medium Italic",
                "n6": "Semi Bold",
                "i6": "Semi Bold Italic",
                "n7": "Bold",
                "i7": "Bold Italic",
                "n8": "Extra Bold",
                "i8": "Extra Bold Italic",
                "n9": "Heavy",
                "i9": "Heavy Italic",
                "100": "Thin",
                "100italic": "Thin Italic",
                "200": "Extra Light",
                "200italic": "Extra-Light Italic",
                "300": "Light",
                "300italic": "Light Italic",
                "400": "Normal",
                "400italic": "Italic",
                "500": "Medium",
                "500italic": "Medium Italic",
                "600": "Semi Bold",
                "600italic": "Semi-Bold Italic",
                "700": "Bold",
                "700italic": "Bold Italic",
                "800": "Extra Bold",
                "800italic": "Extra-Bold Italic",
                "900": "Ultra Bold",
                "900italic": "Ultra-Bold Italic",
                "": "Normal"
            }
            return fontExpands[fw] != undefined ? fontExpands[fw] : "undefined";
        }
                /*
        ** add new section script 
        ** create by ytd
        */ 
        $('button.add-new-section').click(function(e){
            e.preventDefault();
            ajax_load_new_section('add_new','');
        });

        $('.section-edit').click(function(){
            var section_key = $(this).data();
            console.log(section_key.sectionId);
            ajax_load_new_section('edit',section_key.sectionId);
        });

        function ajax_load_new_section(method,section_key){
            $.ajax({
                type: "post",
                url: ajaxurl,
                data:{
                    action: 'awe_add_new_section',
                    method: method,
                    section_key: section_key,
                },
                beforeSend: function(){
                    $('.popup-loading').fadeIn();
                },
                success: function(respond){
                    $('.js-show-popup').fadeIn();
                    $('.js-show-popup').html(respond);
                    $('.popup-loading').fadeOut();
                    $('#custom-new-section-background-color').wpColorPicker({
                        defaultColor: false,
                        hide: true,
                        palettes: true,
                    });
                    $('#custom-new-section-overlay-color').spectrum({
                        showButtons: false,
                        allowEmpty:true, // Clear Color
                        showInput: true, // True: show input
                        showInitial: true, // True : show initial color
                        showAlpha: true, // True: Allow alpha transparency selection
                        containerClassName: "spb-spectrum", // Add class to jus the container element to custom
                        replacerClassName: "spb-pickercolor", // Add class to just the replacer element
                    });
                    $('.upload-img').upload_single_image();
                }
            });
        }

        function ajax_new_section_content(action,data){
            $.ajax({
                type: "post",
                url: ajaxurl,
                data: {
                    action: 'awe_new_section_content',
                    method: action,
                    data_send: data,
                },
                beforeSend: function(){

                },
                success: function(respond){
                    if(respond==''){
                        location.reload(); 
                    }else{
                        $('.message-error').html(respond);
                    }
                }
            });

        }
        $('.js-show-popup').on("click",".new-section-save",function(e){
            e.preventDefault();
            var method = $(this).data();
            tinyMCE.triggerSave();
            var content = tinyMCE.get('add_new_textarea').getContent();
            var data = $('#popup-new-section').serialize();
            ajax_new_section_content(method.method,data);
        })
        $('.js-show-popup').on("click",'.md-popup-close',function(e){
            e.preventDefault();
            $('.js-show-popup').fadeOut();
        });
        $('.js-show-popup').on('bind','#custom-new-section-background-color',function(){
            $(this).wpColorPicker({
                defaultColor: false,
                hide: true,
                palettes: true,
            })
        });

        $('.section-del').click(function(){
            var section_key = $(this).data();
            alert("You sure delete this section?");
            $.ajax({
                type: "post",
                url: ajaxurl,
                data: {
                    action: 'awe_delete_section',
                    section_key: section_key.sectionId,
                },
                success: function(respond){
                    if(respond==''){
                        location.reload();
                    }else{
                        alert(respond);
                    }
                },
            });
        })

        


        $('.js-show-popup').on("click",'.new-section-background-select',function(){
            if($(this).val()=='parallax'){
                $('.select-color').fadeOut();
                $('.select-parallax').fadeIn();
            }else{
                $('.select-color').fadeIn();
                $('.select-parallax').fadeOut();
            }
        });
        $('.js-show-popup').on("click",".new-section-overlay-select",function(){
            if($(this).val()=='pattern'){
                $('.select-overlay-color').fadeOut();
                $('.select-overlay-pattern').fadeIn();
            }else{
                $('.select-overlay-color').fadeIn();
                $('.select-overlay-pattern').fadeOut();
            }
        });

        $('.js-show-popup').on("click",".background_enable",function(){
            if($(this).is(":checked")){
                $('.enable-background-parallax').fadeIn();
            }else{
                $('.enable-background-parallax').fadeOut();
            }
        });

        $('.js-show-popup').on("click",".overlay_enable",function(){
            if($(this).is(":checked")){
                $('.enable-section-overlay').fadeIn();
            }else{
                $('.enable-section-overlay').fadeOut();
            }
        });





    });
})(jQuery);