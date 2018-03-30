/**
 * Created by duongle on 5/7/14.
 */
var awe_custom_js_is_run = true;
(function($){
    "use strict";

    $(window).load(function(){
        // Prevents code from running twice due to live preview window.load firing in addition to the main customizer window.
        if( true == awe_custom_js_is_run ) {
            awe_custom_js_is_run = false;
        } else {
            return;
        }
        var api = wp.customize;
        
        $(".intro-bg-slider-speed-select").change(function(){
            var parent = $(this).parent().parent().parent();
            console.log(parent);
            update_introduction_bg(parent);
           // console.log("hehehe");
        });
        $('.intro-info-slogan-speed-select').change(function(){

            var parent = $(this).parent().parent().parent();
            console.log(parent);
            update_introduction_info(parent);
        });
        /* Choose Style Color */
        $(".awe-style-color li").on("click",function(){
            $(this).parent().find("li.choose").removeClass("choose");
            $(this).addClass("choose");
            var style_value = $(this).find("a").attr("rel");
            var input_id = $("input.awe-style-color").attr("data-customize-setting-link");
            api.instance(input_id).set( style_value );
            $(".awe-style-color-custom").removeClass("choose");
            return true;
        });

        /* Sortable */
        $(".section-order-reset").on("click",function(){
            var input_id = $(this).parent().find("input.section-order").attr("data-customize-setting-link");
            api.instance(input_id).set("about,service,funfact,team,skill,portfolio,idea,twitter,pricing,lastedpost,client,testimonial,address,map");
            var order = ['about','service','funfact','team','skill','portfolio','idea','twitter','pricing','lastedpost','client','testimonial','address','map'];
            for(var i=0;i<order.length;i++)
            {
                $("li[data-name='"+order[i]+"']").detach().appendTo($(this).parent().find("ul"));
            }
            return false;
        });
        $( "#sortable" ).sortable({
            update: function(event, ui) {
                var order = [];
                $('#sortable li').each( function(e) {
                    order.push( $(this).attr('data-name'));
                });
                // join the array as single variable...
                var positions = order.join(','),input_id = $("input.section-order").attr("data-customize-setting-link");
                api.instance(input_id).set( positions );
                return true;
            }
        });
        $( "#sortable" ).disableSelection();


        /* Custom color picker */
        $("input.style-color-custom-picker").wpColorPicker({

            defaultColor: false,
            change: function(event, ui){
                var input_id = $(this).attr("data-customize-setting-link");
                api.instance(input_id).set( $(this).val());
                var input_color_style = $("body").find('input.awe-style-color').attr("data-customize-setting-link");
                api.instance(input_color_style).set('custom');
                $(".awe-style-color li.choose").removeClass("choose");
                $(".awe-style-color-custom").addClass("choose");
                console.log($(this).val());
            },
            clear: function() {},
            hide: true,
            palettes: true
        });

        /************************ Introduction Info *********************/
        var introduction = {};
        $("body").on("keyup change","input[class*='intro-info-']",function(){
            var parent = $(this).parent().parent().parent();
            update_introduction_info(parent);

        });
        $("select[class*='intro-info-']").on("change",function(){
            var parent = $(this).parent().parent().parent();
            update_introduction_info(parent);
        });

        function update_introduction_info(parent){

            var logo_enable = ( $(parent).find(".intro-info-logo-show" ).is(":checked")) ? 1 : 0,
                logo_url = parent.find("#customize-control-wm_options-logo-image .img-preview img").attr("src");
            introduction.logo = {'enable':logo_enable,'url':logo_url};
            var title_enable = (parent.find(".intro-info-title-show").is(":checked")) ? 1 : 0,
                title_position = (parent.find(".intro-info-title-position").find(":selected").val())?parent.find(".intro-info-title-position").find(":selected").val():'above',
                title_text = (parent.find(".intro-info-title-input").val())?parent.find(".intro-info-title-input").val():'',
                title = {'enable':title_enable,'text':title_text,'position':title_position};
            introduction.title = title;
            var slogan_enable = (parent.find(".intro-info-slogan-show").is(":checked")) ? 1 : 0,
                slogan_type = (parent.find(".intro-info-slogan-type").find(":selected").val())?parent.find(".intro-info-slogan-type").find(":selected").val():'static',
                slogan_style = (parent.find(".intro-info-slogan-style").find(":selected").val())?parent.find(".intro-info-slogan-style").find(":selected").val():'owl-text',
                slogan_static_text = (parent.find(".intro-info-slogan-static-text").val())?parent.find(".intro-info-slogan-static-text").val():'',
                slogan_slider_text = [];
            parent.find(".intro-info-slogan-slider-text").each(function(){
                slogan_slider_text.push($(this).val());
            });
            var slogan_slider_speed = parent.find(".intro-info-slogan-speed-select").val();
            var slogan_slider_transition = (parent.find(".intro-info-slogan-transition-select").find(":selected").val())?parent.find(".intro-info-slogan-transition-select").find(":selected").val():'',
                slogan = {"enable":slogan_enable,"type":slogan_type,"style":slogan_style,"static_text":slogan_static_text,"slider_text":slogan_slider_text,"transition":slogan_slider_transition,'speed':slogan_slider_speed};
            introduction.slogan=slogan;

            var button_enable = (parent.find(".intro-info-button-show").is(":checked"))?1: 0,
                button_text = (parent.find(".intro-info-button-text").val())?parent.find(".intro-info-button-text").val():'',
                button_link = (parent.find(".intro-info-button-link").val())?parent.find(".intro-info-button-link").val():'',
                button = {'enable':button_enable,'text':button_text,'link':button_link};
            introduction.button = button;
            var link_enable = (parent.find(".intro-info-link-show").is(":checked"))?1: 0,
                link_items = [];
            parent.find(".intro-info-link-item").each(function(){
                var title = ($(this).find('input.intro-info-link-text').val())?$(this).find('input.intro-info-link-text').val():'',
                    url = ($(this).find('input.intro-info-link-url').val())?$(this).find('input.intro-info-link-url').val():'',
                    item = {'title':title,'url':url};
                link_items.push(item);
            });
            var link = {'enable':link_enable,'items':link_items};
            introduction.links= link;
//            console.log(encodeURIComponent(JSON.stringify(introduction)));
            var input_hidden = parent.find('.info_data').attr("data-customize-setting-link");
            api.instance(input_hidden).set( encodeURIComponent(JSON.stringify(introduction)) );
            console.log(parent.find('.info_data').val());
        }


        $(".intro-info-button-show").on("click",function(){
           if($(this).is(":checked"))
               $(".intro-info-button-settings").fadeIn();
           else
               $(".intro-info-button-settings").fadeOut();
        });
        $(".intro-info-link-show").on("click",function(){
            if($(this).is(":checked"))
                $(".intro-info-link-items").fadeIn();
            else
                $(".intro-info-link-items").fadeOut();
        });
        $("select.intro-info-slogan-type").on("change",function(){
            if($(this).val()=='static')
            {
                $(".intro-info-slogan-static").fadeIn();
                $(".intro-info-slogan-slider").fadeOut();
            }else
            {
                $(".intro-info-slogan-static").fadeOut();
                $(".intro-info-slogan-slider").fadeIn();
            }
            return false;
        });

        $("input.intro-info-slogan-slider-addmore").on("click",function(){
            $(this).before('<div class="slogan-item"><input type="text" class="intro-info-slogan-slider-text" value=""><a class="intro-info-slogan-item-remove" href="#">Delete</a></div>');
            return false;
        });

        $("input.intro-info-link-item-addmore").on("click",function(){
           $(this).before('<div class="intro-info-link-item"> <span class="customize-control-title">Title</span> <input type="text" class="intro-info-link-text"> <br> <span class="customize-control-title">Link</span> <input type="text" class="intro-info-link-url"> <br> <a href="#" class="intro-info-link-item-remove">Delete</a> </div>');
           return false;
        });

        $("body").on("click","a.intro-info-slogan-item-remove",function(){
            var parent = $(this).parent().parent().parent();
            var i =0;
            parent.find('.slogan-item').each(function(){
                i++;
            });
            if(i>1){
                $(this).parent().remove();
                update_introduction_info(parent);
                return false;    
            }
            
        });
        /*************** Introduction Background Settings ****************/
        function update_introduction_bg(parent)
        {
            
            var introSave = parent.find('.intro-bg-data');
            var intro_bg_data = $.parseJSON(introSave.val());
            var type = parent.find(".select-bg-type").val(),
                video = {},
                video_url = parent.find(".intro-bg-video-url").val(),
                video_autoplay = (parent.find(".intro-bg-video-autoplay").is(":checked"))? 1 : 0,
                video_control = (parent.find(".intro-bg-video-control").is(":checked"))? 1 : 0,
                video_mute = (parent.find(".intro-bg-video-mute").is(":checked"))? 1 : 0,
                video_loop = (parent.find(".intro-bg-video-loop").is(":checked"))? 1 : 0,
                placeholder = (parent.find(".intro-bg-video-place-holder").is(":checked"))? 1 : 0,
                video_place_holder = parent.find(".video_place_holder_url").val(),

                video_hide = (parent.find(".intro-bg-video-hide").is(":checked"))? 1 : 0,
                static_image = parent.find(".intro-bg-static-image-url").val(),
                static_mouse = (parent.find(".intro-bg-static-mouse").is(":checked")) ? 1 : 0,
                color = parent.find(".intro-bg-color").val(),
                slider_images =JSON.parse( parent.find(".intro-bg-slider-images").val() ),
                slider_transition =(parent.find(".intro-bg-slider-transition-select").find(":selected").val()) ? parent.find(".intro-bg-slider-transition-select").find(":selected").val() :'fade';
                var speed = parent.find('.intro-bg-slider-speed-select').val();
                intro_bg_data.type = type;
                intro_bg_data.static = {'image':static_image,'mouse':static_mouse};
                intro_bg_data.color = color;
                intro_bg_data.slider = {'images':slider_images,'transition':slider_transition,'speed':speed};
                intro_bg_data.video = {'url':video_url,'hide':video_hide,'autoplay':video_autoplay,'control':video_control,'loop':video_loop,'mute':video_mute,'placeholder':placeholder,'video_place_holder':video_place_holder};
                intro_bg_data.overlay.color = $('.intro-overlay-colors').val();
                var array = [];
                if(parent.find('.intro-overlay-pattern').is(":checked")) array.push("pattern");
                if(parent.find('.intro-overlay-color').is(":checked")) array.push("color");
                var enable = "1";
                (parent.find('.introl-overlay-enable').is(":checked")) ? enable="1" : enable = "0";
                intro_bg_data.overlay.enable = enable;
                intro_bg_data.overlay.color = parent.find('.intro-overlay-colors').val();
                intro_bg_data.overlay.type = array;
                intro_bg_data.overlay.pattern = parent.find('.overlay-pattern-url').val();
            var input_hidden = introSave.attr("data-customize-setting-link");
            console.log(input_hidden);
            api.instance(input_hidden).set( JSON.stringify(intro_bg_data) );

        }

        function update_introduction_blog_bg(parent){
            var introSave = parent.find('.intro-bg-data');
            var intro_bg_data = $.parseJSON(introSave.val());
            var static_image = parent.find(".blog-intro-bg-static-image-url").val();
                intro_bg_data.static = {'image':static_image};
                var array = [];
                if(parent.find('.blog-intro-overlay-pattern').is(":checked")) array.push("pattern");
                if(parent.find('.blog-intro-overlay-color').is(":checked")) array.push("color");
                var enable = "1";
                (parent.find('.blog-introl-overlay-enable').is(":checked")) ? enable="1" : enable = "0";
                intro_bg_data.overlay.enable = enable;
                intro_bg_data.overlay.color = parent.find('.blog-intro-overlay-colors').val();
                intro_bg_data.overlay.type = array;
                intro_bg_data.overlay.pattern = parent.find('.blog-overlay-pattern-url').val();
            var input_hidden = introSave.attr("data-customize-setting-link");
            api.instance(input_hidden).set( JSON.stringify(intro_bg_data) );
        }

        $('.introl-overlay-enable').click(function(){
            var parent = $(this).parent().parent().parent();
            update_introduction_bg(parent);
            if($(this).is(":checked"))
                $(this).parent().next().fadeIn();
            else $(this).parent().next().fadeOut();
        });

        $('.intro-overlay-color').click(function(){
            var parent = $(this).parent().parent().parent().parent();
            update_introduction_bg(parent);
        });

        $('.intro-overlay-pattern').click(function(){
            var parent = $(this).parent().parent().parent().parent();
            update_introduction_bg(parent);
        });

        $('.blog-introl-overlay-enable').click(function(){
            var parent = $(this).parent().parent().parent();
            update_introduction_blog_bg(parent);
            if($(this).is(":checked"))
                $(this).parent().next().fadeIn();
            else $(this).parent().next().fadeOut();
        });

        $('.blog-intro-overlay-color').click(function(){
            var parent = $(this).parent().parent().parent().parent();
            update_introduction_blog_bg(parent);
        });
        $('.blog-intro-overlay-pattern').click(function(){
            var parent = $(this).parent().parent().parent().parent();
            update_introduction_blog_bg(parent);
        });
        $('.blog-intro-overlay-colors').spectrum({
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
                        var parent = $(this).parent().parent().parent();
                        update_introduction_blog_bg(parent);
                },
                hide: function (color) {
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                        $(this).val(color);
                        var parent = $(this).parent().parent().parent();
                        update_introduction_blog_bg(parent);
                    }
        });


        $('.intro-overlay-colors').spectrum({
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
                        var parent = $(this).parent().parent().parent();
                        update_introduction_bg(parent);
                },
                hide: function (color) {
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                        $(this).val(color);
                        var parent = $(this).parent().parent().parent();
                        update_introduction_bg(parent);
                    }
        });
        
        $(".intro-bg-color").spectrum({
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
                        var parent = $(this).parent().parent().parent();
                        update_introduction_bg(parent);
                },
                hide: function (color) {
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                        $(".intro-bg-color").val(color);
                        var parent = $(this).parent().parent().parent();
                        update_introduction_bg(parent);
                }
        });


        $(".intro-bg-slider-upload-multi-img").upload_multi_images({
            instance:false,
            callback: function(e){
                var input = e.current.parent().find(".intro-bg-slider-images");
                var parent = e.current.parent().parent().parent().parent();
                var array = $.parseJSON(input.val());
                for(var i=0;i<e.urls.length;i++){
                    array.push(e.urls[i]);
                }
                input.val(JSON.stringify(array));
                console.log(parent);
                update_introduction_bg(parent);
                delImage();
            }
        });

        $('.multi-iamges-sort').sortable({
            update: function(event, ui) {
                var array = [];
                $(this).find("img").each(function(){
                    var src = $(this).attr("src");
                    array.push(src);
                });
                $('.intro-bg-slider-images').val(JSON.stringify(array));
                var parent = $(this).parent().parent().parent().parent().parent();
                update_introduction_bg(parent);
                delImage();
            }
        });

        function delImage(){
            $('.js-del').click(function(){
                var array = [];
                var parent = $(this).parent().parent();
                var parent_change = $(this).parent().parent().parent().parent().parent().parent();
                $(this).parent().remove();
                parent.find("img").each(function(){
                    var src = $(this).attr("src");
                    array.push(src);
                });
                $('.intro-bg-slider-images').val(JSON.stringify(array));
                update_introduction_bg(parent_change);
            });
        }
        delImage();
        $(".intro-bg-slider-remove-multi-img").remove_multi_upload_image({
            instance:false,
            callback: function(e){
                var a = [];
                e.current.parent().find(".intro-bg-slider-images").val(JSON.stringify(a));
                var parent = e.current.parent().parent().parent().parent().parent().parent();
                update_introduction_bg(parent);
            }
        });

        $(".intro-pattern-upload-img").upload_single_image({
            instance:false,
            callback: function(e){
                e.current.parent().find(".intro-bg-pattern-image-url").val(e.image_url);
                var parent = e.current.parent().parent().parent().parent();
                //console.log(parent);
                update_introduction_bg(parent);
            }
        });
        
        $(".video-place-holder-upload-img").upload_single_image({
            instance: false,
            callback: function(e){
                e.current.parent().find(".video_place_holder_url").val(e.image_url);
                var parent = e.current.parent().parent().parent().parent();
                update_introduction_bg(parent);
            }
        });

        $(".intro-static-upload-img").upload_single_image({
            instance:false,
            callback: function(e){
                e.current.parent().find(".intro-bg-static-image-url").val(e.image_url);
                var parent = e.current.parent().parent().parent();
                update_introduction_bg(parent);
            }
        });
        $(".blog-intro-static-upload-img").upload_single_image({
            instance:false,
            callback: function(e){
                e.current.parent().find(".blog-intro-bg-static-image-url").val(e.image_url);
                var parent = e.current.parent().parent();
                update_introduction_blog_bg(parent);
            }
        });

        $('.intro-bg-video-place-holder').click(function(){
           //console.log('dsadas');
            var parent = $(this).closest('ul');
            if($(this).is(":checked")){
                parent.find('.intro-bg-video-image-upload').fadeIn();
                parent.find('.intro-bg-video-autoplay').attr("checked",false);    
            }else{
                parent.find('.intro-bg-video-image-upload').fadeOut();    
            }
            
            update_introduction_bg(parent);
        });
        $('.intro-overlay-upload-img').upload_single_image({
            instance: false,
            callback: function(e){
                e.current.parent().find(".overlay-pattern-url").val(e.image_url);
                var parent = e.current.parent().parent().parent().parent();
                update_introduction_bg(parent);
            }
        })
        $('.blog-intro-overlay-upload-img').upload_single_image({
            instance: false,
            callback: function(e){
                e.current.parent().find(".blog-overlay-pattern-url").val(e.image_url);
                var parent = e.current.parent().parent().parent().parent();
                update_introduction_blog_bg(parent);
            }
        });
        $('.intro-bg-video-mute').click(function()
        {
            var parent = $(this).closest('ul');
            update_introduction_bg(parent);
        })
        // $('input[class*="intro-bg-video-"]').click(function(){
        //     var parent = $(this).parent().parent();
        //     update_introduction_bg(parent);
        // });

        $(".intro-static-remove-img").remove_upload_image({
            instance:false,
            callback: function(e){
                e.current.parent().find(".intro-bg-static-image-url").val('');
                var parent = e.current.parent().parent().parent().parent();
                update_introduction_bg(parent);
            }
        });
        $(".intro-bg-video-url").on("change keyup",function(){
            var parent = $(this).parent().parent();
            update_introduction_bg(parent);
        })
        $(".intro-bg-slider-transition-select").on("change",function(){
            var parent = $(this).parent().parent().parent();
            update_introduction_bg(parent);
        });
        $(".intro-bg-video-autoplay").on("click",function(){
            var parent = $(this).closest('ul');
            console.log(parent);
            if($(this).is(":checked"))
            {   
                parent.find(".intro-bg-video-place-holder").attr("checked",false);
            }
            else
            {
               parent.find(".intro-bg-video-place-holder").attr("checked",true);
            }
            update_introduction_bg(parent);
        });
        $('.video_place_holder').click(function(){
            var parent = $(this).parent().parent().parent();
            update_introduction_bg(parent);
        })
        $(".intro-bg-video-image-enable").on("click",function(){
            if($(this).is(":checked"))
                $(".intro-bg-video-image-upload").fadeIn();
            else
                $(".intro-bg-video-image-upload").fadeOut();
        })

        $('.select-bg-type').change(function(){
            switch ($(this).val())
            {
                case 'static':
                    $(".intro-bg-static").fadeIn();
                    $(".intro-bg-slider").fadeOut();
                    $(".intro-bg-video").fadeOut();
                    $(".intro-bg-pattern").fadeOut();
                    break;
                case 'color':
                    $(".intro-bg-static").fadeOut();
                    $(".intro-bg-slider").fadeOut();
                    $(".intro-bg-video").fadeOut();
                    $(".intro-bg-pattern").fadeIn();
                    break;
                case 'slider':
                    $(".intro-bg-static").fadeOut();
                    $(".intro-bg-slider").fadeIn();
                    $(".intro-bg-video").fadeOut();
                    $(".intro-bg-pattern").fadeOut();
                    break;
                case 'video':
                    $(".intro-bg-static").fadeOut();
                    $(".intro-bg-slider").fadeOut();
                    $(".intro-bg-video").fadeIn();
                    $(".intro-bg-pattern").fadeOut();
                    break;
            }
            var parent = $(this).parent().parent();
            update_introduction_bg(parent);

        });
        
        $('.add-join-team-image').upload_single_image();


        /************* SECTION SCRIPTS ****************/


            $(".enable-parallax").on("click",function(){
                var input_parallax = $(this).closest("li").find("input.section-parallax"),
                    options_parallax = {};
                if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                    options_parallax = JSON.parse(input_parallax.val());
                options_parallax.enable = ($(this).is(":checked")) ? 1 : 0;
                api.instance(input_parallax.attr("data-customize-setting-link")).set(JSON.stringify(options_parallax));
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
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                    var input_parallax = $(this).closest('li').find("input.section-parallax"),
                        options_parallax = {};
                    if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                        options_parallax = JSON.parse(input_parallax.val());
                    options_parallax.color = color;
                    api.instance(input_parallax.attr("data-customize-setting-link")).set(JSON.stringify(options_parallax));
                },
                hide: function (color) {
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                    var input_parallax = $(this).closest("li").find("input.section-parallax"),
                        options_parallax = {};
                    if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                        options_parallax = JSON.parse(input_parallax.val());

                    options_parallax.color = color;
                    api.instance(input_parallax.attr("data-customize-setting-link")).set(JSON.stringify(options_parallax));
                }
            });

            $(".parallax-upload-img").upload_single_image({
                instance:false,
                callback:function(e){
                    var input_parallax = e.current.closest("li").find("input.section-parallax"),
                        options_parallax = {};
                    if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                        options_parallax = JSON.parse(input_parallax.val());
                    options_parallax.image = e.image_url;
                    api.instance(input_parallax.attr("data-customize-setting-link")).set(JSON.stringify(options_parallax));
                }
            });
            $(".parallax-remove-img").remove_upload_image({
                instance:false,
                callback:function(e){
                    var input_parallax = e.current.closest("li").find("input.section-parallax"),
                        options_parallax = {};
                    if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                        options_parallax = JSON.parse(input_parallax.val());
                    options_parallax.image = '';
                    api.instance(input_parallax.attr("data-customize-setting-link")).set(JSON.stringify(options_parallax));
                }
            });
            $(".parallax-transparent").spectrum({
                showButtons: false,
                allowEmpty:true, // Clear Color
                showInput: true, // True: show input
                showInitial: true, // True : show initial color
                showAlpha: true, // True: Allow alpha transparency selection
                containerClassName: "spb-spectrum", // Add class to jus the container element to custom
                replacerClassName: "spb-pickercolor", // Add class to just the replacer element
                move: function(color) {
                    var input_parallax = $(this).closest("li").find("input.section-parallax"),
                        options_parallax = {};
                    if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                        options_parallax = JSON.parse(input_parallax.val());

                    if(color)
                        color=color.toRgbString();
                    else
                        color='';

                    options_parallax.transparent = color;
                    api.instance(input_parallax.attr("data-customize-setting-link")).set(JSON.stringify(options_parallax));
                },
                hide: function (color) {
                    var input_parallax = $(this).closest("li").find("input.section-parallax"),
                        options_parallax = {};
                    if(input_parallax.val()!='' && input_parallax.val()!=undefined)
                        options_parallax = JSON.parse(input_parallax.val());

                    if(color)
                        color=color.toRgbString();
                    else
                        color='';

                    options_parallax.transparent = color;
                    api.instance(input_parallax.attr("data-customize-setting-link")).set(JSON.stringify(options_parallax));
                }
            });

            /* Section Slider */
            $(".enable-slider").on("click",function(){
                if($(this).is(":checked"))
                    $(this).closest("li").find("label.select-number-items-slider").fadeIn();
                else
                    $(this).closest("li").find("label.select-number-items-slider").fadeOut();
            });

            $(".enable-slider,.select-number-items-slider").on("click change select",function(){
                var enable = ($(this).closest("li").find(".enable-slider").is(":checked")) ? 1 : 0,
                    num = ($(this).closest("li").find(".select-number-items-slider").find(":selected").val()) ? $(this).closest("li").find(".select-number-items-slider").find(":selected").val() : '1',
                    input_id = $(this).closest("li").find("input.section-slider").attr("data-customize-setting-link"),
                    options = {};
                options.enable=enable;
                options.num = num;
                api.instance(input_id).set(JSON.stringify(options));
            });
            //========= Overlay Section Customize =============//

            function updateSectionOverlay(parent){
                //$('.section-overlay-enable')
                var color = parent.find('.section-overlay-color-change').val();
                var pattern = parent.find('.overlay-section-pattern-url').val();
                var array = [];
                if(parent.find('.section-overlay-color-enable').is(":checked")) array.push("color");
                if(parent.find('.section-overlay-pattern').is(":checked")) array.push("pattern");
                var enable = "1";
                if(parent.find('.section-overlay-enable').is(":checked")) enable = 1; else enable = 0;
                
                var input_save = parent.find('.section_overlay_save');
                var input_hidden = input_save.attr("data-customize-setting-link");
                //console.log(input_save.val());
                var overlay = JSON.parse(input_save.val());
                overlay.enable = enable;
                overlay.color = color;
                overlay.pattern = pattern;
                overlay.type = array;
                api.instance(input_hidden).set(JSON.stringify(overlay));
            }

            $('.section-overlay-enable').click(function(){
                var parent = $(this).parent().parent();
                var color = parent.find('.section-overlay-color-change').val();
                var pattern = parent.find('.overlay-section-pattern-url').val();
                var array = [];
                if(parent.find('.section-overlay-color-enable').is(":checked")) array.push("color");
                if(parent.find('.section-overlay-pattern').is(":checked")) array.push("pattern");
                //var enable_color = parent.find('.section-overlay-color');
                var input_save = parent.find('.section_overlay_save');
                var input_hidden = input_save.attr("data-customize-setting-link");
               // console.log(input_save.val());
                var overlay = JSON.parse(input_save.val());
                if($(this).is(":checked")){ 
                    parent.find(".display-overlay").css("display","block");
                    overlay.enable = "1";
                }else{
                    overlay.enable = "0";
                    parent.find(".display-overlay").css("display","none");
                }
                overlay.color = color;
                overlay.pattern = pattern;
                overlay.type = array;
                api.instance(input_hidden).set(JSON.stringify(overlay));
            });
            $('.section-overlay-color-enable').click(function(){
                var parent = $(this).parent().parent().parent();
                console.log(parent);
                updateSectionOverlay(parent);
            });
            $('.section-overlay-pattern').click(function(){
                var parent = $(this).parent().parent().parent();
                updateSectionOverlay(parent);
            });
            $('.section-overlay-color-change').spectrum({
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
                    var parent = $(this).parent().parent();
                    updateSectionOverlay(parent);
                },
                hide: function (color) {
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                    $(this).val(color);
                    var parent = $(this).parent().parent();
                    updateSectionOverlay(parent);
                }
            });
            $('.section-overlay-upload-img').upload_single_image({
                instance: false,
                callback: function(e){
                    e.current.parent().find(".overlay-section-pattern-url").val(e.image_url);
                    var data = e.current.parent().parent().parent();
                    updateSectionOverlay(data);  
                }
            });
            $('.customize-control-checkbox').find('input[type="checkbox"]').on("click",function(){
                var parent = $(this).parent().parent();
                var id = parent.attr('id');
                var res = id.split('-');
                
                var next_id = res[0]+'-'+res[1]+'-'+res[2]+'-'+res[3]+'-'+res[4]+'-'+res[5]+'-'+res[6]+'-text';
                console.log(next_id);
                if($(this).is(":checked")){
                    $("#"+next_id).fadeIn();
                    if(res[6]=='button'){
                        var next_id_link = res[0]+'-'+res[1]+'-'+res[2]+'-'+res[3]+'-'+res[4]+'-'+res[5]+'-'+res[6]+'-link';
                        $('#'+next_id_link).fadeIn();
                    }
                }else{
                    $("#"+next_id).fadeOut();
                    if(res[6]=='button'){
                        var next_id_link = res[0]+'-'+res[1]+'-'+res[2]+'-'+res[3]+'-'+res[4]+'-'+res[5]+'-'+res[6]+'-link';
                        $('#'+next_id_link).fadeOut();
                    }
                }
            });
            $('.customize-control-checkbox').each(function(){

                
                var parent = $(this).find('input[type="checkbox"]').parent().parent();
                var id = parent.attr('id');
                var res = id.split('-');
                
                var next_id = res[0]+'-'+res[1]+'-'+res[2]+'-'+res[3]+'-'+res[4]+'-'+res[5]+'-'+res[6]+'-text';
                //console.log(next_id);
                if($(this).find('input[type="checkbox"]').is(":checked")){
                    $("#"+next_id).fadeIn();
                    if(res[6]=='button'){
                        var next_id_link = res[0]+'-'+res[1]+'-'+res[2]+'-'+res[3]+'-'+res[4]+'-'+res[5]+'-'+res[6]+'-link';
                        $('#'+next_id_link).fadeIn();
                    }
                }else{
                    $("#"+next_id).fadeOut();
                    if(res[6]=='button'){
                        var next_id_link = res[0]+'-'+res[1]+'-'+res[2]+'-'+res[3]+'-'+res[4]+'-'+res[5]+'-'+res[6]+'-link';
                        $('#'+next_id_link).fadeOut();
                    }
                }
            });


    });
})(jQuery);