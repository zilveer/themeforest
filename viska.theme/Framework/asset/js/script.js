(function($){
    /************** Framework Library **************/
    $.fn.upload_single_image = function(options)
    {
        var default_options = {
          callback:null
        };
        options = $.extend({},default_options,options);

        $(this).on("click",function(){
            var current = $(this),
                send_attachment_bkp = wp.media.editor.send.attachment;
            wp.media.editor.send.attachment = function(props, attachment) {
                var image_size =  props.size;
                var image_url = attachment.sizes[image_size].url;
                current.parent().find(".image-url").val(image_url);
                current.parent().find(".img-preview").html("<img src='"+image_url+"' >");
                current.parent().find(".ui-wrapper").css("width",attachment.width);
                current.parent().find(".ui-wrapper").css("height",attachment.height);
                var parent_row_element = current.parent().parent().parent();
                parent_row_element.find('.awe-resize-image-width').val(attachment.width);
                parent_row_element.find('.awe-resize-image-height').val(attachment.height);
                console.log(attachment.height+' and '+attachment.width);
                if (typeof options.callback == 'function'){
                    options.callback({'current':current,'image_url':image_url});

                };

                wp.media.editor.send.attachment = send_attachment_bkp;
            }

            wp.media.editor.open();
            return false;
        });


        var input = $(this).parent().find(".image-url");
        input.on("change keyup",function(){
            var image_url = $(this).val();
            if(image_url!=undefined && image_url!='')
                $(this).parent().find(".img-preview").html("<img src='"+image_url+"' >");
            else
                $(this).parent().find(".img-preview").html("");
        })
    }

    $.fn.spectrumPicker = function(options){
        var default_options = {
            callback:null
        };
        options = $.extend({},default_options,options);
        $(this).spectrum({
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
                        if(typeof options.callback == 'function'){
                            options.callback({'current':$(this),'color':color})
                        };
                },
                hide: function (color) {
                    if(color)
                        color=color.toRgbString();
                    else
                        color='';
                    if(typeof options.callback == 'function'){
                        options.callback({'current':$(this),'color':color})
                    };
                }
                
        });
    }

    $.fn.remove_upload_image = function(options)
    {
        var default_options = {
            callback:null
        };
        options = $.extend({},default_options,options);
        $(this).on("click",function(){
            $(this).parent().find("input:hidden.image-url").val("");
            $(this).parent().find(".img-preview").html("");
            if (typeof options.callback == 'function'){
                options.callback({'current':$(this)});

            };
            return false;
        });
    }

    $.fn.upload_multi_image = function(options)
    {
        var default_options = {
            callback:null
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
                    img_prev += '<img src="'+urls[i]+'">';
                }
                if(img_prev!='')
                    self.parent().find(".img-previews").html(img_prev);
                self.parent().find("input.multi-image-url").val( JSON.stringify(urls) );

                if (typeof options.callback == 'function'){
                    options.callback({'self':self,'urls':urls});

                };


            });
            image_custom_uploader.open();
            return false;
        });
    }

    //=========== Multi Upload Images by Dang Y ==================//

    $.fn.upload_multi_images = function(options)
    {
        var default_options = {
            callback:null
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
                    img_prev += '<div class="img-thumbail"><img src="'+urls[i]+'"><span class="js-del fa fa-times"></span></div>';
                }
                if(img_prev!='')
                    self.parent().find(".img-previews").append(img_prev);
                    var images_array = self.parent().find("input.multi-image-url");
                    images = JSON.parse(images_array.val());
                    for(var i = 0;i<urls.length;i++){
                        images.push(urls[i]);
                    }
                    images_array.val(JSON.stringify(images));
                if (typeof options.callback == 'function'){
                    options.callback({'self':self,'urls':urls});
                };


            });
            image_custom_uploader.open();
            return false;
        });
    }
    //========= Sort Images By Dang Y ======================//

    $.fn.imageSort = function(options)
    {
        var default_options = {
            callback: null
        };
        options = $.extend({},default_options,options);

        $(this).sortable({
            update: function(event, ui) {
                var array = [];
                $(this).find("img").each(function(){
                    var src = $(this).attr("src");
                    array.push(src);
                });
                $(this).parent().find('.multi-image-url').val(JSON.stringify(array));
                if (typeof options.callback == 'function'){
                    options.callback({'current':$(this)});
                };
                //return false;
            }
        })
    }
    //========= Remove Image By Dang Y ======================//

    $.fn.removeImage = function(options)
    {
        var default_options = {
            callback: null
        };
        options = $.extend({},default_options,options);

        $(this).on("click",function(){
            var parent = $(this).parent().parent();
            $(this).parent().remove();
            var array = [];
            parent.find('img').each(function(){
                var src = $(this).attr("src");
                array.push(src);
            });
            parent.parent().find('.multi-image-url').val(JSON.stringify(array));
            if (typeof options.callback == 'function'){
                options.callback({'current':$(this)});
            };
            return false;
                
        });
    }

    $.fn.remove_multi_upload_image = function(options)
    {
        var default_options = {
            callback:null
        };
        options = $.extend({},default_options,options);

        $(this).on("click",function(){
            $(this).parent().find("input.multi-image-url").val("");
            $(this).parent().find(".img-previews").html("");
            if (typeof options.callback == 'function'){
                options.callback({'current':$(this)});

            };
            return false;
        });
    }

    $(window).load(function(){

    /*========== Tabs jqueryui ==========*/

        var tabCookieName = "mytabs";
        $(".md-tabs").tabs({
            active : ($.cookie(tabCookieName) || 0),
            activate : function( event, ui ) {
                var newIndex = ui.newTab.parent().children().index(ui.newTab);
                $.cookie(tabCookieName, newIndex, { expires: 1 });
            }
        });
        var subTabCookieName = "mysubtabs";
        $(".md-sub-tabs").tabs({
            active : ($.cookie(subTabCookieName) || 0),
            activate : function( event, ui ) {
                var newIndex = ui.newTab.parent().children().index(ui.newTab);
                $.cookie(subTabCookieName, newIndex, { expires: 1 });
            }
        });
        var subsubTabCookieName = "mysubsubtabs";
        $(".md-subtabs").tabs({
            active : ($.cookie(subsubTabCookieName) || 0),
            activate : function( event, ui ) {
                var newIndex = ui.newTab.parent().children().index(ui.newTab);
                $.cookie(subsubTabCookieName, newIndex, { expires: 1 });
            }
        });


    /*========== Slides Accordion ==========*/

        $( ".md-accordion-wrapper" ).accordion({
            collapsible: true,
            active: false,
            heightStyle: "content"
        });
    /*========== Script ON-OFF , ENABLE - DISABLEr ==========*/
        $(".click-disable").on("click",function(){
            $(this).parent().addClass("disabled");
            $(this).parent().find(".input-checkbox").removeAttr('checked');
        });
        $(".click-enable").on("click",function(){
            $(this).parent().removeClass("disabled");
            $(this).parent().find(".input-checkbox").attr('checked','checked');
        });

    /*========== Range Slicer ==========*/
        
        $( "#slider-range-min" ).slider({
            range: "min",
            value: 100,
            min: 1,
            max: 700,
            slide: function( event, ui ) {
                $( "#amount" ).val( ui.value );
            }
        });
        $( "#amount" ).val($( "#slider-range-min" ).slider( "value" ));


    /*========== Slides Accordion ==========*/

        $( ".md-accordion-item .md-field" ).accordion({
            collapsible: true,
            active: false 
        });

    /*========== Drag and Drop ==========*/
        $( "#md-block-enabled, #md-block-disabled, #md-block-backup" ).sortable({
            placeholder: "placeholder",
            revert: true
        });
        $( "#md-block-enabled, #md-block-disabled, #md-block-backup" ).disableSelection();



        /*========== Addition Script = Do not remove ==========*/

        //choose color
        $('.choose-color').wpColorPicker({
            color: false,
            border: true,
            controls: {
                horiz: 's', // horizontal defaults to saturation
                vert: 'l', // vertical defaults to lightness
                strip: 'h' // right strip defaults to hue
            }
        });

        //upload image via wp media
        if($(".upload-img").length){
            $(".upload-img").upload_single_image();
            $(".remove-img").remove_upload_image();
        }


        if($(".upload-multi-img").length){
            $(".upload-multi-img").upload_multi_image();
            $(".remove-multi-img").remove_multi_upload_image();
        }


    });
})(jQuery);