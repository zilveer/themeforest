/**
 * Created by duongle on 5/20/14.
 */
var awe_js_is_run = true;
(function($){
        /*********** JS Library *************/
        $.fn.upload_single_image = function(options)
        {
            var default_options = {
                callback:null,
                instance:true,
            };
            options = $.extend({},default_options,options);

            $(this).on("click",function(){
                var current = $(this),
                    send_attachment_bkp = wp.media.editor.send.attachment;
                wp.media.editor.send.attachment = function(props, attachment) {
                    var image_size =  props.size;
                    var image_url = attachment.sizes[image_size].url;
                    if(options.instance){
                        var input_id = current.parent().find("input.awe-img").attr('data-customize-setting-link');
                        api.instance(input_id).set( image_url );
                    }

                    current.parent().find(".img-preview").html("<img src='"+image_url+"' >");
                    current.parent().find(".input-remove").attr('disabled', false);
                    current.val("Change");
                    if (typeof options.callback == 'function'){
                        options.callback({'current':current,'image_url':image_url});

                    };

                    wp.media.editor.send.attachment = send_attachment_bkp;
                }

                wp.media.editor.open();
                return false;
            });


            var input = $(this).parent().find("input:text.image-url");
            input.on("change keyup",function(){
                var image_url = $(this).val();
                if(image_url!=undefined && image_url!='')
                    $(this).parent().find(".img-preview").html("<img src='"+image_url+"' >");
                else
                    $(this).parent().find(".img-preview").html("");
            })
        }

        $.fn.remove_upload_image = function(options)
        {
            var default_options = {
                callback:null,
                instance:true,
            };
            options = $.extend({},default_options,options);
            $(this).on("click",function(){
                if(options.instance){
                    var input_id = $(this).parent().find("input.awe-img").attr('data-customize-setting-link');
                    api.instance(input_id).set('');
                }
                $(this).parent().find(".img-preview").html("");
                $(this).parent().find(".input-upload").val("Upload");
                $(this).attr("disabled",true);
                if (typeof options.callback == 'function'){
                    options.callback({'current':$(this)});

                };
                return false;
            });
        }
        //======= Multi Upload Images =============//
        $.fn.upload_multi_images = function(options)
        {
            var default_options = {
                callback:null,
                instance:true,
            };
            options = $.extend(default_options,options);
            var image_custom_uploader;
            $(this).on("click",function(){
                var self = $(this);
                //If the uploader object has already been created, reopen the dialog
                if (image_custom_uploader) {
                    image_custom_uploader.open();
                    return false;
                }
                //Extend the wp.media object
                image_custom_uploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    },
                    multiple: true
                });
                //When a file is selected, grab the URL and set it as the text field's value
                image_custom_uploader.on('select', function() {
                    selection = image_custom_uploader.state().get('selection');
                    var ids = [], urls=[];
                    selection.map(function(attachment)
                    {
                        attachment 	= attachment.toJSON();
                        ids.push(attachment.id);
                        urls.push(attachment.url);

                    });
                    var img_prev = '';
                    for(var i=0;i<urls.length;i++)
                    {
                        img_prev += '<div class="img-thumbail"><img src="'+urls[i]+'"><span class="js-del fa fa-times"></span></div>';
                    }
                    if(img_prev!='')
                        self.parent().find(".img-previews").append(img_prev);

                    if(options.instance){
                        var input_id = current.parent().find("input.awe-multi-img").attr('data-customize-setting-link');
                        api.instance(input_id).set( JSON.stringify(urls) );
                    }

                    if (typeof options.callback == 'function'){
                        options.callback({'current':self,'urls':urls});

                    };


                });
                image_custom_uploader.open();
                return false;
            });
        }

                $.fn.upload_multi_image = function(options)
        {
            var default_options = {
                callback:null,
                instance:true,
            };
            options = $.extend(default_options,options);
            var image_custom_uploader;
            $(this).on("click",function(){
                var self = $(this);
                //If the uploader object has already been created, reopen the dialog
                if (image_custom_uploader) {
                    image_custom_uploader.open();
                    return false;
                }
                //Extend the wp.media object
                image_custom_uploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    },
                    multiple: true
                });
                //When a file is selected, grab the URL and set it as the text field's value
                image_custom_uploader.on('select', function() {
                    selection = image_custom_uploader.state().get('selection');
                    var ids = [], urls=[];
                    selection.map(function(attachment)
                    {
                        attachment  = attachment.toJSON();
                        ids.push(attachment.id);
                        urls.push(attachment.url);

                    });
                    var img_prev = '';
                    for(var i=0;i<urls.length;i++)
                    {
                        img_prev += '<img src="'+urls[i]+'">';
                    }
                    if(img_prev!='')
                        self.parent().find(".img-previews").html(img_prev);

                    if(options.instance){
                        var input_id = current.parent().find("input.awe-multi-img").attr('data-customize-setting-link');
                        api.instance(input_id).set( JSON.stringify(urls) );
                    }

                    if (typeof options.callback == 'function'){
                        options.callback({'current':self,'urls':urls});

                    };


                });
                image_custom_uploader.open();
                return false;
            });
        }


        $.fn.remove_multi_upload_image = function(options)
        {
            var default_options = {
                callback:null,
                instance:true,
            };
            options = $.extend({},default_options,options);

            $(this).on("click",function(){
                if(options.instance){
                    var input_id = current.parent().find("input.awe-multi-img").attr('data-customize-setting-link');
                    api.instance(input_id).set( "" );
                }
                $(this).parent().find(".img-previews").html("");
                if (typeof options.callback == 'function'){
                    options.callback({'current':$(this)});

                };
                return false;
            });
        }
        // Prevents code from running twice due to live preview window.load firing in addition to the main customizer window.
        if( true == awe_js_is_run ) {
            awe_js_is_run = false;
        } else {
            return;
        }
        var api = wp.customize;


        $(document).ready(function(){
            //upload image via wp media
            if($(".upload-img").length){
                $(".upload-img").upload_single_image();
                $(".remove-img").remove_upload_image();
            }


            if($(".upload-multi-img").length){
                $(".upload-multi-img").upload_multi_image();
                $(".remove-multi-img").remove_multi_upload_image();
            }


            //Sub Section Click
            $(".customize-sub-section h4").on("click",function(){
                $(this).toggleClass("active");
                $(".customize-sub-section").each(function(){
                    var section = $(this).find(".customize-sub-content");
                    if(section.is(":visible"))
                        section.fadeOut();
                })
                var content = $(this).parent().find(".customize-sub-content");
                if(content.is(":visible"))
                    content.fadeOut();
                else
                    content.fadeIn();

                // ScrollTo
                var $getSectionId = $(this).parent().attr("data-name");
                    $getOffSet = 0;

                    if ( $getSectionId != '' && typeof $getSectionId != 'undefined' )
                    {
                        if ( $("iframe").contents().find("#"+$getSectionId).length>0 )
                        {
                            $getOffSet = $("iframe").contents().find("#"+$getSectionId).offset().top;
                           
                            $("iframe").contents().scrollTop($getOffSet);
                        }
                    }
            });

            $(".spectrum-color-picker").spectrum({
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
                    var input_id = $(this).attr('data-customize-setting-link');
                    api.instance(input_id).set( color );
                },
                hide: function (color) {
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                    var input_id = $(this).attr('data-customize-setting-link');
                    api.instance(input_id).set( color );
                }
            });


            //LOGO & SLOGAN
            $(".add-logo-image").upload_single_image({
                // callback: function(e){
                //     update_logo_data();
                // }
            });
            $(".remove-logo-image").remove_upload_image({
                // callback: function(e){
                //     var input_name = e.current.prev();
                //     api.instance(input_name).set(input_name.val());
                // }
            });


            // $("input[data-customize-setting-link*='"+name_option+"[logo]'],textarea[data-customize-setting-link*='"+name_option+"[logo]']").on("click change keyup",function(){

            //     update_logo_data();
            // });
            // function update_logo_data()
            // {
            //     var logo_text = $("input[data-customize-setting-link='"+name_option+"[logo][text]']").val();
            //     logo_text = (logo_text!=undefined)?logo_text:'';
            //     var logo_image =$("input[data-customize-setting-link='"+name_option+"[logo][image]']").val();
            //     logo_image = (logo_image!=undefined)?logo_image:'';
            //     var image_height =$("input[data-customize-setting-link='"+name_option+"[logo][image_height]']").val();
            //     image_height = (image_height!=undefined)?image_height:'';
            //     var image_width =$("input[data-customize-setting-link='"+name_option+"[logo][image_width]']").val();
            //     image_width = (image_width!=undefined)?image_width:'';

            //     var logo_image_enable = ($("input[data-customize-setting-link='"+name_option+"[logo][enable_image]']").length)? false: true;
            //     if(logo_image_enable==false)
            //         logo_image_enable = ($("input[data-customize-setting-link='"+name_option+"[logo][enable_image]']").is(":checked"))?true:false;
            //     var slogan_enable = ($("input[data-customize-setting-link='"+name_option+"[logo][enable_slogan]']").is(":checked"))?true:false;
            //     var slogan = $("textarea[data-customize-setting-link='"+name_option+"[logo][slogan]']").val();
            //     slogan = (slogan!=undefined)?slogan:'';
            //     var data = {text:logo_text,image:logo_image,image_width:image_width,image_height:image_height,image_enable:logo_image_enable,slogan:slogan,slogan_enable:slogan_enable};
            //     var input_name = $("input[data-customize-setting-link='awe-logo']").attr("data-customize-setting-link");
            //     api.instance(input_name).set( JSON.stringify(data) );
            // }
            ///SOCIAL NETWORK
            $("input.input-social, input:checkbox[data-customize-setting-link*='"+name_option+"[social]']").on("change keyup",function(){
                var data = [];
                data.push({display:($("input[data-customize-setting-link='"+name_option+"[social][enable]']").is(":checked"))?"on":"off"})
                $("input.input-social").each(function(){
                    var display = ($(this).closest("li").prev().find("input").is(":checked"))?"on":"off";
                    data.push({show:display,name:$(this).attr("data-name"),icon:$(this).parent().find("i").attr("class"),href:$(this).val()});

                })
                var input_name = $("input[data-customize-setting-link='awe-social']").attr("data-customize-setting-link");
                api.instance(input_name).set( JSON.stringify(data) );
            });

            /// TYPOGRAPHY
            var typography = ['logo','slogan','h1','h2','h3','h4','h5','h6','p','navbar','body','content'];

            $("input[data-customize-setting-link*='"+name_option+"[typography]'], select[data-customize-setting-link*='"+name_option+"[typography]']").on("change keyup",function(){
                var typography_options=[];
                for(var i=0;i<typography.length;i++){
                    var enable = $("input[data-customize-setting-link='"+name_option+"[typography]["+typography[i]+"][enable]']");
                    if(enable.is(":checked")==1){
                        var item_font = $("select[data-customize-setting-link='"+name_option+"[typography]["+typography[i]+"][font]']").find(":selected").val();
                        var item_weight = $("select[data-customize-setting-link='"+name_option+"[typography]["+typography[i]+"][weight]']").find(":selected").val();
                        var item_size = $("input[data-customize-setting-link='"+name_option+"[typography]["+typography[i]+"][size]']").val();
                        var item_color = $("li#customize-control-"+typography[i]+"-font-color input.wp-color-picker").val();
                        var item_transform = $("select[data-customize-setting-link='"+name_option+"[typography]["+typography[i]+"][transform]']").find(":selected").val();
                        var item_lineheight = $("select[data-customize-setting-link='"+name_option+"[typography]["+typography[i]+"][lineheight]']").find(":selected").val();
                        typography_options.push({name:typography[i],font:item_font, weight:item_weight,size:item_size,color:item_color,transform:item_transform,lineheight:item_lineheight});
                    }
                }
                var input_name = $("input[data-customize-setting-link='awe-typography']").attr("data-customize-setting-link");
                api.instance(input_name).set( JSON.stringify(typography_options) );

            });


            for(var i=0;i<typography.length;i++)
            {
                var enable = $("input[data-customize-setting-link='"+name_option+"[typography]["+typography[i]+"][enable]']");
                if(enable.is(":checked")==1)
                    typography_show(typography[i]);
                else
                    typography_hide(typography[i]);

                $(enable).on("click",function(){
                    var input_id = $(this).attr('data-customize-setting-link');
                    if($(this).is(":checked"))
                    {

                        api.instance(input_id).set( 1 );
                        typography_show($(this).attr('data-name'));
                    }
                    else
                    {
                        api.instance(input_id).set( 0 );
                        typography_hide($(this).attr('data-name'));
                    }

                });

                var font_family = $("select[data-customize-setting-link='"+name_option+"[typography]["+typography[i]+"][font]']");
                $(font_family).change(function(){

                    var selected = $(this).find(":selected")
                    var styles = selected.attr('data-style');
                    var font_weight = $("select[data-customize-setting-link='"+name_option+"[typography]["+$(this).attr('data-name')+"][weight]']");
                    styles = styles.split(",");
                    var options = '';
                    for(var i=0;i<styles.length;i++)
                    {
                        options += '<option value="'+styles[i]+'">'+expandFontWeight(styles[i])+'</option>';
                    }

                    font_weight.html(options);
                });
            }

            function typography_show(name)
            {
                $("li#customize-control-"+name+"-font-family").fadeIn();
                $("li#customize-control-"+name+"-font-size").fadeIn();
                $("li#customize-control-"+name+"-font-color").fadeIn();
                $("li#customize-control-"+name+"-font-weight").fadeIn();
                $("li#customize-control-"+name+"-transform").fadeIn();
                $("li#customize-control-"+name+"-lineheight").fadeIn();
            }

            function typography_hide(name)
            {
                $("li#customize-control-"+name+"-font-family").fadeOut();
                $("li#customize-control-"+name+"-font-size").fadeOut();
                $("li#customize-control-"+name+"-font-color").fadeOut();
                $("li#customize-control-"+name+"-font-weight").fadeOut();
                $("li#customize-control-"+name+"-transform").fadeOut();
                $("li#customize-control-"+name+"-lineheight").fadeOut();
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
                    "": ""
                }
                return fontExpands[fw] != undefined ? fontExpands[fw] : "undefined";
            }





            $(".accordion-section-title").bind("click",function(){

                if($(this).closest(".accordion-section").hasClass("open")){
                    $(this).closest(".accordion-section").addClass("js-hide");
                    $("li.accordion-section").each(function(){
                        $(this).removeClass("js-hide");
                    });
                }
                else{
                    $("li.accordion-section").each(function(){
                        $(this).addClass("js-hide");
                    });
                    $(this).closest(".accordion-section").removeClass("js-hide");

                }
            });
        });
})(jQuery);