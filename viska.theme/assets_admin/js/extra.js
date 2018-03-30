/**
 * Created by duongle on 5/25/14.
 */
(function($){
    $(document).ready(function() {

        $("input.display-section").on("click",function(){
            var dataname = $(this).attr("dataname");
            if($(this).is(":checked")){
                $(this).parent().parent().find(".custom-section").fadeIn();
                $("li[data-name='"+dataname+"']").fadeIn();
            }
            else {
                $(this).parent().parent().find(".custom-section").fadeOut();
                $("li[data-name='"+dataname+"']").fadeOut();
            }
        })
        $("input.display-contact").on("click",function(){
            if($(this).is(":checked")){
                $(this).parent().parent().find(".custom-contact").fadeIn();
                $("li[data-name='contact']").fadeIn();
            }
            else {
                $(this).parent().parent().find(".custom-contact").fadeOut();
                $("li[data-name='contact']").fadeOut();
            }
        })

        $("input.display-pricing").on("click",function(){
            if($(this).is(":checked")){
                $(this).parent().parent().find(".custom-pricing").fadeIn();
                $("li[data-name='pricing']").fadeIn();
            }
            else {
                $(this).parent().parent().find(".custom-pricing").fadeOut();
                $("li[data-name='pricing']").fadeOut();
            }
        })

        $("input.display-map").on("click",function(){
            if($(this).is(":checked")){
                $(this).parent().parent().find(".custom-map").fadeIn();
                $("li[data-name='map']").fadeIn();
            }
            else {
                $(this).parent().parent().find(".custom-map").fadeOut();
                $("li[data-name='map']").fadeOut();
            }
        })
        $("input.display-parallax-facts").on("click",function(){
            if($(this).is(":checked"))
                $(this).parent().parent().find(".custom-parallax-facts").fadeIn();
            else $(this).parent().parent().find(".custom-parallax-facts").fadeOut();
        })
        $("input.display-parallax-testimonials").on("click",function(){
            if($(this).is(":checked"))
                $(this).parent().parent().find(".custom-parallax-testimonials").fadeIn();
            else $(this).parent().parent().find(".custom-parallax-testimonials").fadeOut();
        })
        $("input.display-parallax-twitter").on("click",function(){
            if($(this).is(":checked"))
                $(this).parent().parent().find(".custom-parallax-twitter").fadeIn();
            else $(this).parent().parent().find(".custom-parallax-twitter").fadeOut();
        })
        $("input.display-parallax-skills").on("click",function(){
            if($(this).is(":checked"))
                $(this).parent().parent().find(".custom-parallax-skills").fadeIn();
            else $(this).parent().parent().find(".custom-parallax-skills").fadeOut();
        })

        /* Choose Style Color */
        $(".maf-style-color li").on("click",function(){
            $(this).parent().find("li.choose").removeClass("choose");
            $(this).addClass("choose");
            var style_value = $(this).find("a").attr("rel");
            $("input.maf-style-color").val( style_value );
            $(".maf-style-color-custom").removeClass("choose");
            return false;
        });

        $("input.style-color-custom-picker").wpColorPicker({

            defaultColor: false,
            change: function(event, ui){
                $(this).val( $(this).val());
                $("body").find('input.maf-style-color').val('custom');
                $(".maf-style-color li.choose").removeClass("choose");
                $(".maf-style-color-custom").addClass("choose");
            },
            clear: function() {},
            hide: true,
            palettes: true
        });

        $(".extra-color-picker").wpColorPicker({
            defaultColor: false,
            hide: true,
            palettes: true
        });

        /* SECTION */
        $(".section-order-reset").on("click",function(){
           $("#sortable input").val("about,funfact,resume,portfolio,service,testimonial,map,contact");
           var order = ['about','funfact','resume','portfolio','service','testimonial','map','contact'];
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
        $("#sortable").disableSelection();

        /*********** Introduction ***********/

        $.fn.extend({
            display_check: function(object){
                $(this).on("click",function(){
                    if($(this).is(":checked"))
                        $(object).fadeIn();
                    else
                        $(object).fadeOut();
                })
            },

        });

        /* title */
        $('.intro-info-title-show').display_check('.intro-title-settings');

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
        });

        //addmore
        $(".slogan-slider-addmore").on("click",function(){
            $(this).parent().before('<div class="form-group "><input type="text" value="" class="big intro-info-slogan-slider-text"><button class="md-button gray slogan-slider-remove">Delete</button></div>')
            return false;
        });

        //remove
        $("body").on("click",".slogan-slider-remove",function(){
            $(this).parent().remove();
            update_introduction_info();
            return false;
        })

        /* button */
        $('.intro-info-button-show').display_check('.intro-button-settings');

        /* links */
        $('.intro-info-link-show').display_check('.intro-links-settings');

        $(".links-addmore").on("click",function(){
            $(this).parent().before('<div class="form-group intro-info-link-item"><input type="text" value="" placeholder="Title" class="big intro-info-link-title"><input type="text" placeholder="Url" value="" class="big intro-info-link-url"><button class="md-button gray link-remove">Delete</button></div>')
            return false;
        });

        $("body").on("click",".link-remove",function(){
            $(this).parent().remove();
            update_introduction_info();
            return false;
        })

        var introduction = {};
        $("body").on("keyup change","input[class*='intro-info-']",function(){
            update_introduction_info();

        });
        $("select[class*='intro-info-']").on("change",function(){
            update_introduction_info();
        });

        function update_introduction_info(){
            var logo_enable = ($(".intro-info-logo-show").is(":checked")) ? 1 : 0,
                logo_url = $(".extra-logo-image .img-preview img").attr("src");
            introduction.logo = {'enable':logo_enable,'url':logo_url};

            var title_enable = ($(".intro-info-title-show").is(":checked")) ? 1 : 0,
                title_text = ($(".intro-info-title-text").val()) ? $(".intro-info-title-text").val() : '',
                title = {'enable':title_enable,'text':title_text}
            introduction.title = title;

            var slogan_enable = ($(".intro-info-slogan-show").is(":checked")) ? 1 : 0,
                slogan_type = ($(".intro-info-slogan-type").find(":selected").val()) ? $(".intro-info-slogan-type").find(":selected").val() : 'static',
                slogan_style = ($(".intro-info-slogan-style").find(":selected").val()) ? $(".intro-info-slogan-style").find(":selected").val() : 'owl-text',
                slogan_static_text = ($(".intro-info-slogan-static-text").val()) ? $(".intro-info-slogan-static-text").val() : '',
                slogan_slider_text = [];
            $(".intro-info-slogan-slider-text").each(function(){
                slogan_slider_text.push($(this).val());
            });
            var slogan_slider_transition = ($(".intro-info-slogan-transition-select").find(":selected").val()) ? $(".intro-info-slogan-transition-select").find(":selected").val() : '',
                slogan = {"enable":slogan_enable,"type":slogan_type,"style":slogan_style,"static_text":slogan_static_text,"slider_text":slogan_slider_text,"transition":slogan_slider_transition};
            introduction.slogan=slogan;


            var button_enable = ($(".intro-info-button-show").is(":checked")) ? 1 : 0,
                button_text = ($(".intro-info-button-text").val()) ? $(".intro-info-button-text").val() : '',
                button_link = ($(".intro-info-button-link").val()) ? $(".intro-info-button-link").val() : '',
                button = {'enable':button_enable,'text':button_text,'link':button_link};
            introduction.button = button;

            var link_enable = ($(".intro-info-link-show").is(":checked"))? 1 : 0,
                link_items = [];
            $(".intro-info-link-item").each(function(){
                var title = ($(this).find('input.intro-info-link-text').val())?$(this).find('input.intro-info-link-text').val():'',
                    url = ($(this).find('input.intro-info-link-url').val())?$(this).find('input.intro-info-link-url').val():'',
                    item = {'title':title,'url':url};
                link_items.push(item);
            });
            var link = {'enable':link_enable,'items':link_items};
            introduction.links= link;
            $("input[name='theme[extra][intro_data]']").val( JSON.stringify(introduction) );
        }

        /******* Intro Background *******/
        function update_introduction_bg()
        {
            var intro_bg_data ={},
                type = ($("select.intro-bg-type").find(":selected").val()) ? $("select.intro-bg-type").find(":selected").val() : 'static',
                video = {},
                video_url = $(".intro-bg-video-url").val(),
                video_autoplay = ($(".intro-bg-video-autoplay").is(":checked"))? 1 : 0,
                video_control = ($(".intro-bg-video-control").is(":checked"))? 1 : 0,
                video_mute = ($(".intro-bg-video-mute").is(":checked"))? 1 : 0,
                video_loop = ($(".intro-bg-video-loop").is(":checked"))? 1 : 0,
                video_image_enable = ($(".intro-bg-video-image-enable").is(":checked"))? 1 : 0,
                video_image_url = $(".intro-bg-video-image-url").val(),
                static_image = $(".intro-bg-static-image-url").val(),
                slider_images = ($("input.intro-bg-slider-images").val()!='' && $("input.intro-bg-slider-images").val()!=undefined) ? JSON.parse($("input.intro-bg-slider-images").val()) : '',
                slider_transition =($(".intro-bg-slider-transition").find(":selected").val()) ? $(".intro-bg-slider-transition").find(":selected").val() :'fade';
            intro_bg_data.type = type;
            intro_bg_data.static = {'image':static_image};
            intro_bg_data.slider = {'images':slider_images,'transition':slider_transition};
            intro_bg_data.video = {'url':video_url,'autoplay':video_autoplay,'control':video_control,'loop':video_loop,'mute':video_mute,'image':{'enable':video_image_enable,'url':video_image_url}};

            $("input[name='theme[extra][intro_bg_data]']").val( JSON.stringify(intro_bg_data) );
        }
        $("input[class*='intro-bg-']").on("change keyup",function(){
            update_introduction_bg();
        })
        $("select[class*='intro-bg-']").on("change",function(){
            update_introduction_bg();
        });

        $('.intro-bg-video-autoplay').display_check('.intro-bg-video-control-box');
        $('.intro-bg-video-image-enable').display_check('.intro-bg-video-image-upload');
        $("select.intro-bg-type").on('change',function(){
            switch ($(this).find(":selected").val())
            {
                case 'static':
                    $(".intro-bg-static").fadeIn();
                    $(".intro-bg-slider").fadeOut();
                    $(".intro-bg-video").fadeOut();
                    break;
                case 'slider':
                    $(".intro-bg-static").fadeOut();
                    $(".intro-bg-slider").fadeIn();
                    $(".intro-bg-video").fadeOut();
                    break;
                case 'video':
                    $(".intro-bg-static").fadeOut();
                    $(".intro-bg-slider").fadeOut();
                    $(".intro-bg-video").fadeIn();
                    break;
            }
        });

        $(".intro-bg-upload-image").upload_single_image({
           callback: function(e){
               update_introduction_bg();
           }
        });

        $(".intro-bg-remove-img").remove_upload_image({
            callback: function(e){
                update_introduction_bg();
            }
        })

        $(".intro-bg-upload-slider-image").upload_multi_image({
            callback: function(e){
                update_introduction_bg();
            }
        });
        $(".intro-bg-remove-slider-image").remove_multi_upload_image({
            callback: function(e){
                update_introduction_bg();
            }
        });
        
    });
})(jQuery);
