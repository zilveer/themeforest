/**
 * Created by duongle on 5/25/14.
 */
(function($){
    "use strict";
    $(document).ready(function() {

        $("input.display-section").on("click",function(){
            var dataname = $(this).attr("dataname");
            if($(this).is(":checked")){
                $(this).parent().parent().find(".custom-section").fadeIn();
                
            }
            else {
                $(this).parent().parent().find(".custom-section").fadeOut();
                
            }
        })
        /* Choose Style Color */
        $(".awe-style-color li").on("click",function(){
            $(this).parent().find("li.choose").removeClass("choose");
            $(this).addClass("choose");
            var style_value = $(this).find("a").attr("rel");
            $("input.awe-style-color").val( style_value );
            $(".awe-style-color-custom").removeClass("choose");
            return false;
        });

        $("input.style-color-custom-picker").wpColorPicker({

            defaultColor: false,
            change: function(event, ui){
                $(this).val( $(this).val());
                $("body").find('input.awe-style-color').val('custom');
                $(".awe-style-color li.choose").removeClass("choose");
                $(".awe-style-color-custom").addClass("choose");
            },
            clear: function() {},
            hide: true,
            palettes: true
        });

        /* SECTION */
        $(".section-order-reset").on("click",function(){
           $("#sortable input").val("about,skill,team,funfact,idea,portfolio,testimonial,pricing,twitter,service,subscribe,client,lastedpost,contact,map,address");
           var order = ['about','skill','team','funfact','idea','portfolio','testimonial','pricing','twitter','service','subscribe','client','lastedpost','contact','map','address'];
           for(var i=0;i<order.length;i++)
           {
               $("li[data-name='"+order[i]+"']").detach().appendTo("#sortable");
           }
           return false;
        });
        $("#sortable").sortable({
            update: function(event, ui) {
                var order = [];
                $('#sortable li').each( function(e) {
                    order.push( $(this).attr('data-name'));
                });
                // join the array as single variable...
                var positions = order.join(',');
                $("input.section-order").val( positions );
                return true;
            }
        });


        /********** Slider Section **********/

        $("input.enable-section-slider").on("click",function(){
            var input_slider = $(this).parent().parent().find(".slider-settings input"),
                options_slider = {};
            if(input_slider.val()!='' && input_slider.val()!=undefined)
                options_slider = JSON.parse(input_slider.val());
            if($(this).is(":checked"))
                options_slider.enable=1;
            else
                options_slider.enable=0;
            input_slider.val(JSON.stringify(options_slider));
        });

        $("select.section-content-slider-items").on("change",function(){
            var input_slider = $(this).parent().parent().parent().parent().find(".slider-settings input"),
                options_slider = {};
            if(input_slider.val()!='' && input_slider.val()!=undefined)
                options_slider = JSON.parse(input_slider.val());

            options_slider.num=$(this).find(":selected").val();
            input_slider.val(JSON.stringify(options_slider));
        });

        /********** Parallax Section ********/
        $("input.enable-parallax").on("click",function(){
            var input_parallax = $(this).parent().parent().find(".parallax-settings input"),
                options_parallax = {};
            if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                options_parallax = JSON.parse(input_parallax.val());
            if($(this).is(":checked"))
                options_parallax.enable=1;
            else
                options_parallax.enable=0;
            input_parallax.val(JSON.stringify(options_parallax));
        });
//////////////////////////////////////////////////


        $(".parallax-upload-image").upload_single_image({
            callback: function(e){
                var input_parallax = e.current.parent().parent().parent().find(".parallax-settings input"),
                    options_parallax = {};
                if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                    options_parallax = JSON.parse(input_parallax.val());
                options_parallax.image = e.image_url;
                input_parallax.val(JSON.stringify(options_parallax));
            }
        });

        $(".parallax-remove-image").remove_upload_image({
            callback: function(e){
                var input_parallax = e.current.parent().parent().parent().find(".parallax-settings input"),
                    options_parallax = {};
                if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                    options_parallax = JSON.parse(input_parallax.val());
                options_parallax.image = '';
                input_parallax.val(JSON.stringify(options_parallax));
            }
        });

        $(".parallax-color-picker").spectrum({
            showButtons: false,
            allowEmpty:true, // Clear Color
            showInput: true, // True: show input
            showInitial: true, // True : show initial color
            showAlpha: true, // True: Allow alpha transparency selection
            containerClassName: "spb-spectrum", // Add class to jus the container element to custom
            replacerClassName: "spb-pickercolor", // Add class to just the replacer element
            move: function(color) {
                var input_parallax = $(this).parent().parent().find(".parallax-settings input"),
                    options_parallax = {};
                if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                    options_parallax = JSON.parse(input_parallax.val());

                if(color)
                    color=color.toRgbString();
                else
                    color='';

                options_parallax.color = color;
                input_parallax.val(JSON.stringify(options_parallax));
            },
            hide: function (color) {
                var input_parallax = $(this).parent().parent().find(".parallax-settings input"),
                    options_parallax = {};
                if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                    options_parallax = JSON.parse(input_parallax.val());

                if(color)
                    color=color.toRgbString();
                else
                    color='';

                options_parallax.color = color;
                input_parallax.val(JSON.stringify(options_parallax));
            }
        });

        $(".parallax-transparent-picker").spectrum({
            showButtons: false,
            allowEmpty:true, // Clear Color
            showInput: true, // True: show input
            showInitial: true, // True : show initial color
            showAlpha: true, // True: Allow alpha transparency selection
            containerClassName: "spb-spectrum", // Add class to jus the container element to custom
            replacerClassName: "spb-pickercolor", // Add class to just the replacer element
            move: function(color) {
                var input_parallax = $(this).parent().parent().find(".parallax-settings input"),
                    options_parallax = {};
                if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                    options_parallax = JSON.parse(input_parallax.val());

                if(color)
                    color=color.toRgbString();
                else
                    color='';

                options_parallax.transparent = color;
                input_parallax.val(JSON.stringify(options_parallax));
            },
            hide: function (color) {
                var input_parallax = $(this).parent().parent().find(".parallax-settings input"),
                    options_parallax = {};
                if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                    options_parallax = JSON.parse(input_parallax.val());

                if(color)
                    color=color.toRgbString();
                else
                    color='';

                options_parallax.transparent = color;
                input_parallax.val(JSON.stringify(options_parallax));
            }
        });

        /*********** Introduction ***********/

        $.fn.extend({
            display_check: function(object){
                $(this).on("click",function(){
                    if($(this).is(":checked"))
                        $(object).fadeIn();
                    else
                        $(object).fadeOut();
                })
            }

        });


        /* slogan */
        $('.intro-info-slogan-show').display_check('.intro-slogan-settings');


        $("#intro_slogan_type").on("change",function(){
            switch($(this).val()){
                case 'slider':
                    $(".slogan-slider-text").fadeIn();
                    $(".slogan-static-text").fadeOut();
                    break;
                case 'static':
                    $(".slogan-slider-text").fadeOut();
                    $(".slogan-static-text").fadeIn();
                    break;
            }
            update_introduction_info();
        });

        $("#blog_slogan_type").on("change",function(){
            switch($(this).val()){
                case 'slider':
                    $(".slogan-blog-slider-text").fadeIn();
                    $(".slogan-blog-static-text").fadeOut();
                    break;
                case 'static':
                    $(".slogan-blog-slider-text").fadeOut();
                    $(".slogan-blog-static-text").fadeIn();
                    break;
            }
            //update_blog_info();
        });

        //addmore
        $(".slogan-slider-addmore").on("click",function(){
            $(this).parent().before('<div class="form-group "><input type="text" value="" class="big intro-info-slogan-slider-text"><button class="md-button gray slogan-slider-remove">Delete</button></div>')
            return false;
        });

        $('.blog-slogan-slider-addmore').on("click",function(){
            $(this).parent().before('<div class="form-group "><input type="text" value="" class="big blog-info-slogan-slider-text"><button class="md-button gray blog-slogan-slider-remove">Delete</button></div>');
            return false;
        })

        //remove
        $("body").on("click",".slogan-slider-remove",function(){
            $(this).parent().remove();
            update_introduction_info();
            return false;
        });

        $('.blog-info-slogan-slider-text').on("change","keyup",function(){
            update_blog_info();
            console.log("dsadsa");
        });

        $("body").on("click",".blog-slogan-slider-remove",function(){
            $(this).parent().remove();
            update_blog_info();
        })
        /* button */
        $('.intro-info-button-show').display_check('.intro-button-settings');

        
        $("body").on("keyup change","input[class*='intro-info-']",function(){
            update_introduction_info();

        });
        $("body").on("keyup change","input[class*='blog-info-button-']",function(){
            update_blog_info();

        });
        $("body").on("keyup change","input[class*='blog-info-slogan-']",function(){
            update_blog_info();
        });
        $("select[class*='intro-info-']").on("change",function(){
            update_introduction_info();
        });

        function update_introduction_info(){
            var introduction = {};
            var logo_enable = ($(".intro-info-logo-show").is(":checked")) ? 1 : 0,
                logo_url = $(".extra-logo-image .img-preview img").attr("src");
            introduction.logo = {'enable':logo_enable,'url':logo_url};

            var slogan_enable = ($(".intro-info-slogan-show").is(":checked")) ? 1 : 0,
                slogan_type = ($(".intro-info-slogan-type").find(":selected").val()) ? $(".intro-info-slogan-type").find(":selected").val() : 'static',
                slogan_static_text = ($(".intro-info-slogan-static-text").val()) ? $(".intro-info-slogan-static-text").val() : '',
                slogan_speed = $('.intro-info-slogan-speed').val(),
                slogan_slider_text = [];
            $("body .intro-info-slogan-slider-text").each(function(){
                slogan_slider_text.push($(this).val());
            });
            var slogan_slider_transition = ($(".intro-info-slogan-transition-select").find(":selected").val()) ? $(".intro-info-slogan-transition-select").find(":selected").val() : '',
                slogan = {"enable":slogan_enable,"type":slogan_type,"static_text":slogan_static_text,"slider_text":slogan_slider_text,"transition":slogan_slider_transition,"speed":slogan_speed};
            introduction.slogan=slogan;


            var button_enable = ($(".intro-info-button-show").is(":checked")) ? 1 : 0,
                button_text = ($(".intro-info-button-text").val()) ? $(".intro-info-button-text").val() : '',
                button = {'enable':button_enable,'text':button_text};
            introduction.button = button;

            $("input[name='theme[extra][intro_data]']").val( encodeURIComponent(JSON.stringify(introduction)) );
        }

        function update_blog_info(){
            // var logo_enable = ($(".intro-info-logo-show").is(":checked")) ? 1 : 0,
            //     logo_url = $(".extra-logo-image .img-preview img").attr("src");
            // introduction.logo = {'enable':logo_enable,'url':logo_url};
            var introduction = {};
            var slogan_enable = ($(".blog-info-slogan-show").is(":checked")) ? 1 : 0,
                slogan_type = ($(".blog-slogan-type").val()) ? $(".blog-slogan-type").val() : 'static',
                slogan_static_text = ($(".blog-slogan-static-text").val()) ? $(".blog-slogan-static-text").val() : '',
                slogan_speed = $('.blog-info-slogan-speed').val(),
                slogan_slider_text = [];
            $("body .blog-info-slogan-slider-text").each(function(){
                slogan_slider_text.push($(this).val());
                console.log($(this).val());
            });
            var slogan_slider_transition = ($(".blog-info-slogan-transition-select").find(":selected").val()) ? $(".blog-info-slogan-transition-select").find(":selected").val() : '',
                slogan = {"enable":slogan_enable,"type":slogan_type,"static_text":slogan_static_text,"slider_text":slogan_slider_text,"transition":slogan_slider_transition,"speed":slogan_speed};
            introduction.slogan=slogan;


            var button_enable = ($(".blog-info-button-show").is(":checked")) ? 1 : 0,
                button_text = ($(".blog-info-button-text").val()) ? $(".blog-info-button-text").val() : '',
                button = {'enable':button_enable,'text':button_text};
            introduction.button = button;

            $("input[name='theme[extra][blog_data]']").val( encodeURIComponent(JSON.stringify(introduction)) );
        }
        $('.blog-slogan-static-text').on("change","keyup",function(){
            update_blog_info();
        })
        $('.blog-info-slogan-show, .blog-info-button-show').click(function(){
            update_blog_info();
            console.log("ok");
        });
        $('.blog-info-button-text').on("change","keyup",function(){
            update_blog_info();
            console.log("dsad");
        });
        $('.blog-slogan-type, .blog-info-slogan-transition-select, .blog-info-slogan-speed').change(function(){
            update_blog_info();
            console.log('ssssss');
        })
        /******* Intro Background *******/
        function update_introduction_bg()
        {   
            var array = [];
            if($('.intro-overlay-color').is(":checked")) array.push("color");
            if($('.intro-overlay-pattern').is(":checked")) array.push("pattern");
            var intro_bg_data ={},
                type = ($("select.intro-bg-type").find(":selected").val()) ? $("select.intro-bg-type").find(":selected").val() : 'static',
                video = {},
                video_url = $(".intro-bg-video-url").val(),
                video_autoplay = ($(".intro-bg-video-autoplay").is(":checked"))? 1 : 0,
                video_control = ($(".intro-bg-video-control").is(":checked"))? 1 : 0,
                video_mute = ($(".intro-bg-video-mute").is(":checked"))? 1 : 0,
                video_loop = ($(".intro-bg-video-loop").is(":checked"))? 1 : 0,
                video_image = $(".intro-bg-video-image-url").val(),
                video_placeholder = ($('.intro-bg-video-placeholder').is(":checked"))? 1 :0,
                static_image = $(".intro-bg-static-image-url").val(),
                color = $(".intro-bg-color-spectrum").val(),
                slider_images = ($("input.intro-bg-slider-images").val()!='' && $("input.intro-bg-slider-images").val()!=undefined) ? JSON.parse($("input.intro-bg-slider-images").val()) : '',
                slider_transition =($(".intro-bg-slider-transition").find(":selected").val()) ? $(".intro-bg-slider-transition").find(":selected").val() :'fade',
                speed = $(".intro-bg-slider-speed").val(),
                overlay_enable = ($('.intro-overlay').is(":checked")) ? 1 :0,
                overlay_color = $('.overlay-custom-color').val(),
                overlay_pattern = $('.intro-overlay-pattern-url').val(),
                overlay_type = array;
            intro_bg_data.type = type;
            intro_bg_data.static = {'image':static_image};
            intro_bg_data.color = color;
            intro_bg_data.slider = {'images':slider_images,'transition':slider_transition,'speed':speed};
            intro_bg_data.video = {'url':video_url,'autoplay':video_autoplay,'control':video_control,'loop':video_loop,'mute':video_mute,'placeholder':video_placeholder,'video_place_holder':video_image};
            intro_bg_data.overlay = {'enable':overlay_enable,'type':array,'color':overlay_color,'pattern':overlay_pattern};

            $("input[name='theme[extra][intro_bg_data]']").val( encodeURIComponent(JSON.stringify(intro_bg_data)) );
            //console.log("call");
        }

        function update_blog_bg()
        {   
            var array = [];
            if($('.blog-overlay-color').is(":checked")) array.push("color");
            if($('.blog-overlay-pattern').is(":checked")) array.push("pattern");
            var intro_bg_data ={},
                type = ($("select.blog-bg-type").find(":selected").val()) ? $("select.blog-bg-type").find(":selected").val() : 'static',
                video = {},
                video_url = $(".blog-bg-video-url").val(),
                video_autoplay = ($(".blog-bg-video-autoplay").is(":checked"))? 1 : 0,
                video_control = ($(".blog-bg-video-control").is(":checked"))? 1 : 0,
                video_mute = ($(".blog-bg-video-mute").is(":checked"))? 1 : 0,
                video_loop = ($(".blog-bg-video-loop").is(":checked"))? 1 : 0,
                video_placeholder = ($(".intro-bg-blog-video-placeholder").is(":checked"))? 1 : 0,
                video_image = $(".intro-bg-blog-video-image-url").val(),
                //video_hide = $(".blog-bg-video-hide").is(":checked") ? 1 : 0,
                static_image = $(".blog-bg-static-image-url").val(),
                color = $(".blog-bg-color-spectrum").val(),
                slider_images = ($("input.blog-bg-slider-images").val()!='' && $("input.blog-bg-slider-images").val()!=undefined) ? JSON.parse($("input.blog-bg-slider-images").val()) : '',
                slider_transition =($(".blog-bg-slider-transition").find(":selected").val()) ? $(".blog-bg-slider-transition").find(":selected").val() :'fade',
                speed = $(".blog-bg-slider-speed").val(),
                overlay_enable = ($('.blog-overlay').is(":checked")) ? 1 :0,
                overlay_color = $('.blog-overlay-custom-color').val(),
                overlay_pattern = $('.blog-overlay-pattern-url').val(),
                overlay_type = array;
            intro_bg_data.type = type;
            intro_bg_data.static = {'image':static_image};
            intro_bg_data.color = color;
            intro_bg_data.slider = {'images':slider_images,'transition':slider_transition,'speed':speed};
            intro_bg_data.video = {'url':video_url,'autoplay':video_autoplay,'control':video_control,'loop':video_loop,'mute':video_mute,'placeholder':video_placeholder,'video_place_holder':video_image};
            intro_bg_data.overlay = {'enable':overlay_enable,'type':array,'color':overlay_color,'pattern':overlay_pattern};

            $("input[name='theme[extra][blog_bg]']").val( encodeURIComponent(JSON.stringify(intro_bg_data)) );
            //console.log("call");
        }// function update_blog_bg 

        $('body').on("change keyup","input[class*='blog-bg-']",function(){
            update_blog_bg();
        });
        
        $("input[class*='intro-bg-']").on("change keyup",function(){
            update_introduction_bg();
        })
        $(".intro-bg-video-autoplay").on("click",function(){
            console.log("dsa");
            if($(this).is(":checked")){
                $('.intro-bg-video-placeholder').attr("checked",false);
            }
            update_introduction_bg();
        });
        $(".intro-bg-video-placeholder").on("click",function(){
            if($(this).is(":checked")){
                $('.intro-bg-video-autoplay').attr("checked",false);
            }
            update_introduction_bg();
        });
        $('.blog-bg-video-control, .blog-bg-video-mute, .blog-bg-video-loop, .blog-overlay, .blog-overlay-color, .blog-overlay-pattern').click(function(){
            console.log("ok");
            update_blog_bg();
        });
        $('.blog-bg-video-autoplay').on("click",function(){
            if($(this).is(":checked")){
                $('.intro-bg-blog-video-placeholder').attr("checked",false);
            }
            update_blog_bg();
        });
        $('.intro-bg-blog-video-placeholder').on("click",function(){
            if($(this).is(":checked")){
                $('.blog-bg-video-autoplay').attr("checked",false);
            }
            update_blog_bg();
        });
        $('.intro-bg-blog-upload-video-image').upload_single_image({
            callback: function(e){
                e.current.prev().val(e.image_url);
                update_blog_bg();
            }
        })
        $('.intro-bg-color-spectrum').spectrum({
                showButtons: false,
                allowEmpty:true, // Clear Color
                showInput: true, // True: show input
                showInitial: true, // True : show initial color
                showAlpha: true, // True: Allow alpha transparency selection
                containerClassName: "spb-spectrum", // Add class to jus the container element to custom
                replacerClassName: "spb-pickercolor", // Add class to just the replacer element
                move: function(color) {
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                    $('.intro-bg-color-spectrum').val(color);
                    update_introduction_bg();
                },
                hide: function (color) {
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                    $('.intro-bg-color-spectrum').val(color);
                    update_introduction_bg();
                }
        });
        
        $('.blog-bg-color-spectrum, .blog-overlay-custom-color').spectrum({
            showButtons: false,
                allowEmpty:true, // Clear Color
                showInput: true, // True: show input
                showInitial: true, // True : show initial color
                showAlpha: true, // True: Allow alpha transparency selection
                containerClassName: "spb-spectrum", // Add class to jus the container element to custom
                replacerClassName: "spb-pickercolor", // Add class to just the replacer element
                move: function(color) {
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                    $(this).val(color);
                    update_blog_bg();
                },
                hide: function (color) {
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                    $(this).val(color);
                    update_blog_bg();
                }
        });

        $('.blog-bg-slider-transition,.blog-bg-slider-speed').change(function(){
            update_blog_bg();
        });

        //$('.intro-bg-video-autoplay').display_check('.intro-bg-video-control-box');
        
        $("select.intro-bg-type").on('change',function(){
            switch ($(this).find(":selected").val())
            {
                case 'static':
                    $(".intro-bg-static").fadeIn();
                    $(".intro-bg-color").fadeOut();
                    $(".intro-bg-slider").fadeOut();
                    $(".intro-bg-video").fadeOut();
                    break;
                case 'color':
                    $(".intro-bg-static").fadeOut();
                    $(".intro-bg-color").fadeIn();
                    $(".intro-bg-slider").fadeOut();
                    $(".intro-bg-video").fadeOut();
                    break;
                case 'slider':
                    $(".intro-bg-static").fadeOut();
                    $(".intro-bg-color").fadeOut();
                    $(".intro-bg-slider").fadeIn();
                    $(".intro-bg-video").fadeOut();
                    break;
                case 'video':
                    $(".intro-bg-static").fadeOut();
                    $(".intro-bg-color").fadeOut();
                    $(".intro-bg-slider").fadeOut();
                    $(".intro-bg-video").fadeIn();
                    break;
            }
        });

        $("select.blog-bg-type").on('change',function(){
            switch ($(this).find(":selected").val())
            {
                case 'static':
                    $(".blog-bg-static").fadeIn();
                    $(".blog-bg-color").fadeOut();
                    $(".blog-bg-slider").fadeOut();
                    $(".blog-bg-video").fadeOut();
                    break;
                case 'color':
                    $(".blog-bg-static").fadeOut();
                    $(".blog-bg-color").fadeIn();
                    $(".blog-bg-slider").fadeOut();
                    $(".blog-bg-video").fadeOut();
                    break;
                case 'slider':
                    $(".blog-bg-static").fadeOut();
                    $(".blog-bg-color").fadeOut();
                    $(".blog-bg-slider").fadeIn();
                    $(".blog-bg-video").fadeOut();
                    break;
                case 'video':
                    $(".blog-bg-static").fadeOut();
                    $(".blog-bg-color").fadeOut();
                    $(".blog-bg-slider").fadeOut();
                    $(".blog-bg-video").fadeIn();
                    break;
            }
        });
        
        $(".intro-bg-upload-video-image").upload_single_image({
            callback: function(e){
                e.current.prev().val(e.image_url);
                update_introduction_bg();
            }
        });


        $(".intro-bg-upload-image").upload_single_image({
           callback: function(e){
                e.current.prev().val(e.image_url);
                update_introduction_bg();
           }
        });
        $('.intro-overlay-upload-pattern').upload_single_image({
            callback: function(e){
                e.current.prev().val(e.image_url);
                update_introduction_bg();
            }
        })
        $('.blog-overlay-upload-pattern').upload_single_image({
            callback: function(e){
                e.current.prev().val(e.image_url);
                update_blog_bg();
           }
        });

        $('.blog-overlay-remove-pattern').remove_upload_image({
            callback: function(e){
                e.current.prev().val();
                update_blog_bg();
            }
        })

        $(".intro-bg-remove-img").remove_upload_image({
            callback: function(e){
                e.current.prev().val();
                update_introduction_bg();
            }
        });

        $("select[class*='intro-bg-']").on("change",function(){
            update_introduction_bg();
        });
        $('.blog-bg-upload-image').upload_single_image({
            callback: function(e){
                e.current.prev().val(e.image_url);
                update_blog_bg();
            }
        })
        $(".intro-bg-upload-slider-image").upload_multi_images({
            callback: function(e){
                update_introduction_bg();
                $('.js-del').removeImage({
                    callback: function(e){
                        update_introduction_bg();
                    }
                });
            }
        });

        $('.blog-bg-upload-slider-image').upload_multi_images({
            callback: function(e){
                update_blog_bg();
                $('.js-del').removeImage({
                    callback: function(e){
                        update_blog_bg();
                    }
                });
            }
        });

        $(".intro-bg-remove-slider-image").remove_multi_upload_image({
            callback: function(e){
                update_introduction_bg();
            }
        });
        $('.slider-sortable').imageSort({
            callback: function(e){
                update_introduction_bg();
                update_blog_bg();
                $('.js-del').removeImage({
                    callback: function(e){
                        update_introduction_bg();
                        update_blog_bg();
                    }
                });
            }
        });

        $('.js-del').removeImage({
            callback: function(e){
                update_introduction_bg();
                update_blog_bg();
            }
        });

        $('.overlay-custom-color').spectrumPicker({
            callback: function(e){
                $('.overlay-custom-color').val(e.color);
                update_introduction_bg();
            }
        });
        $('.intro-overlay').click(function(){
            update_introduction_bg();
        });
        $('.intro-overlay-color').click(function(){
            update_introduction_bg();
        });
        $('.intro-overlay-pattern').click(function(){
            update_introduction_bg();
        });
        $('.enable-footer-title, .enable-footer-subtitle, .enable-footer-desc').on("click",function(){
            if($(this).is(":checked")){
                $(this).parent().next().fadeIn();    
            }else{
                $(this).parent().next().fadeOut();
            }
            
        });
        $('.enable-footer-title, .enable-footer-subtitle, .enable-footer-desc').each(function(){
            if($(this).is(":checked")){
                $(this).parent().next().fadeIn();    
            }else{
                $(this).parent().next().fadeOut();
            }
            
        });
        $('.enable-footer-button').on("click",function(){
            if($(this).is(":checked")){
                $(this).parent().next().fadeIn();
                $(this).parent().next().next().fadeIn();     
            }else{
                $(this).parent().next().fadeOut();
                $(this).parent().next().next().fadeOut();
            }
        });
        $('.enable-footer-button').each(function(){
            if($(this).is(":checked")){
                $(this).parent().next().fadeIn();
                $(this).parent().next().next().fadeIn();     
            }else{
                $(this).parent().next().fadeOut();
                $(this).parent().next().next().fadeOut();
            }
        });
        
        function section_overlay(obj)
        {
            var array = [];
            var data = {};
            var parent = obj.parents('.parents_overlay');
            var overlay = parent.find('.setion-overlay');
            if(overlay.val()!='' && overlay.val()!=undefined)
                data = JSON.parse(overlay.val());
            
            data.enable = ( parent.find('.section-enable-overlay').is(":checked") ) ? 1: 0;
            if(parent.find('.section-overlay-color-enable').is(":checked")) array.push("color");
            if( parent.find('.section-overlay-pattern-enable').is(":checked") ) array.push("pattern");
            var color = parent.find('.overlay-color-picker').val();
            var image = parent.find('.image-url').val();
            data.type = array;
            data.color = color;
            data.pattern = image;
            overlay.val(JSON.stringify(data));
        }

        $('.section-enable-overlay').on('click', function()
        {
            var obj = $(this);
            section_overlay(obj);
            // return false;
        });
        $('.section-overlay-color-enable, .section-overlay-pattern-enable').on('click', function()
        {
            var obj = $(this);
            section_overlay(obj);
           
        });

        $('.overlay-color-picker').spectrum({
                showButtons: false,
                allowEmpty:true, // Clear Color
                showInput: true, // True: show input
                showInitial: true, // True : show initial color
                showAlpha: true, // True: Allow alpha transparency selection
                containerClassName: "spb-spectrum", // Add class to jus the container element to custom
                replacerClassName: "spb-pickercolor", // Add class to just the replacer element
                move: function(color) {
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                    $(this).val(color);
                    section_overlay($(this));
                },
                hide: function (color) {
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                    $(this).val(color);
                    section_overlay($(this));
                }
        });
        
        $(".overlay-upload-image").upload_single_image({
            callback: function(e){
                var obj = e.current;
                section_overlay(obj);
            }
        });
        $(".section-overlay-remove-pattern").remove_upload_image({
            callback: function(e){
                section_overlay($(this));
            }
        });
    });
})(jQuery);
