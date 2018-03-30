function st_setCookie(c_name,value,exdays)
{
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=c_name + "=" + c_value;
}

function st_getCookie(c_name)
{
    var i,x,y,ARRcookies=document.cookie.split(";");
    for (i=0;i<ARRcookies.length;i++)
    {
        x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
        y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
        x=x.replace(/^\s+|\s+$/g,"");
        if (x==c_name)
        {
            return unescape(y);
        }
    }
}



jQuery.noConflict();


function st_close_lightbox(){
    jQuery('#stlb-lightbox, #stlb-overlay').remove();
    return;
}

function st_lightbox_postion(){
    var w = jQuery(window).width();
    var h = jQuery(window).height();
    // stlb-lightbox
    var bh =jQuery('#stlb-lightbox').height();
    var bw = jQuery('#stlb-lightbox').width();
    var top = 0, left=0;

    if(h<bh) bh = h;
    if(w<bw) bw = w;

    top = (h-bh)/2;

    left =  (w-bw)/2;

    jQuery('#stlb-lightbox').css({'top': top+'px','left' : left+'px','width': bw+'px','height': bh+'px'});
}
function st_open_lightbox(html){
    var lightboxHTML = '<div id="stlb-overlay"></div>' +
        '<div id="stlb-lightbox"><div class="stlb-inner">'+html+'</div></div>';

    var box = jQuery(lightboxHTML).appendTo('body').
        hide();

    st_lightbox_postion();
    jQuery(window).resize(function(){
        st_lightbox_postion();
    });


    jQuery('#stlb-overlay').css('opacity', '0.8');

    jQuery('#stlb-overlay, #stlb-lightbox').show();

    jQuery('#stlb-close').click(function(event) {
        close_st_lightbox();
        event.preventDefault();
    });

    return box;
}
//------------------------end light box-----------------------------------



//var  STpanel_options = document.STpanel_options;

jQuery(document).ready(function() {

    // for style buttons
    //alert(typeof(jQuery.iButton));
    if(typeof(jQuery.iButton)!='undefined'){
        jQuery(".ibutton").iButton().trigger("change");;
    }

    jQuery(".chzn-select").chosen();


    jQuery( ".st_datepicker" ).datepicker({'dateFormat' : 'yy-mm-dd', changeMonth: true , changeYear: true });


    // end for style buttons

    // for upload
    jQuery('.STpanel-box-upload').each(function() {
        var  p = jQuery(this);
        image = jQuery('input.bp-input-upload',p).val();
        image = jQuery.trim(image);
        if(image!=''){
            jQuery('.remove_image',p).show();
        }else{
            jQuery('.remove_image',p).hide();
        }

    });

    jQuery('.STpanel-box-upload .remove_image').live('click',function(){
        var p   = jQuery(this).parent('.STpanel-box-upload');
        jQuery('input.bp-input-upload',p).val('');
        jQuery('.STpanel-image-preview',p).html('');
        jQuery('.remove_image',p).hide();
        return false;
    });



    jQuery('.STpanel-box-upload .bp-upload-button').live('click',function() {

        var p   = jQuery(this).parent('.STpanel-box-upload');
        var  formfield = jQuery('.bp-input-upload',p).attr('name');
        STpanel_options.uploadID = jQuery(this).attr('for-id');
        STpanel_options.upload_type= jQuery(this).attr('data-type');

        //alert(STpanel_options.uploadID);
        // if  input type not is ID
        if(jQuery(this).attr('data-type')!='id'){
            window.send_to_editor = function(html) {
                var  imgurl = jQuery('img',html).attr('src');
                // var id= jQuery('img',html).attr('id');
                // alert(html);
                jQuery('.bp-input-upload',p).val(imgurl);
                jQuery('.STpanel-image-preview',p).html('<a class="viewfull-image" title="'+STpanel_options.view_full_image+'" href="'+imgurl+'" target="_blank"><img src="'+imgurl+'" alt=""/></a>');
                jQuery('.remove_image').fadeIn();
                tb_remove();
            }
        }


        var _custom_media = true;
        var frame = wp.media;
        var _orig_send_attachment = wp.media.editor.send.attachment;
        var send_attachment_bkp = wp.media.editor.send.attachment;


        /*
         var frame = wp.media({
         title : 'Upload and select image',
         multiple : false,
         library : { type : 'image'},
         button : { text : 'Insert' },
         filterable: true
         });
         */
        // console.log(frame);
        frame.view.settings.mimeTypes ={'image' : 'Images'};
        frame.view.l10n.allMediaItems ='All Images';
        frame.view.l10n.insertMediaTitle ='Upload and select image';
        frame.view.l10n.insertIntoPost = 'Insert';

        frame.view.settings.tabs = false;
        frame.editor.send.attachment = function(props, attachment) {
            return _orig_send_attachment.apply( this, [props, attachment] );
        };

        /*
         frame.on('open',function(){
         alert('ok');
         });
         */


        frame.editor.open();

        // console.log(frame.editor);
        //	frame.open();
        return false;
    });


    // end for upload
    //-------------------------------------------------------------------
    // for tab when load
    show_default_tab=function(){

        var  id = st_getCookie('st_pntab_active');
        var  p = st_getCookie('st_pntab_active_parent');

        jQuery('.STpanel-tab').fadeOut();
        jQuery('.STpanel-click-tabs a').removeClass('active');
        if(typeof(id)!='undefined' && id!=''){
            jQuery('#'+id).fadeIn();
            jQuery('.STpanel-click-tabs a[href="#'+id+'"]').addClass('active');
        }else{
            var ftab = jQuery('.STpanel-click-tabs li').eq(0);
            if(ftab.find('ul').length){ // had child
                var a =   ftab.find('ul').find('li').eq(0).find('a');
                a.addClass('active');
                ftab.addClass('parent_active');
                id = a.attr('href');
                jQuery('.STpanel-tab').hide();
                jQuery('.STpanel-tab'+id).show();
                // alert(id);

            }else{


                jQuery('.STpanel-tab').eq(0).fadeIn();
                jQuery('.STpanel-click-tabs a').eq(0).addClass('active');
            }


        }

        if(jQuery('.tab-'+p).length){
            jQuery('.tab-'+p).addClass('parent_active');
        }


        //Tab Sidebar Height
        if(typeof(id)!='undefined'){
            id = id.replace(/#/,'');
            jQuery('.STpanel-content #'+id).css('height','auto');
            jQuery('.STpanel-tabs').css('height','auto');

            var id_height = jQuery('.STpanel-content #'+id).height();
            var sidebar_height = jQuery('.STpanel-tabs').height();
            if(sidebar_height < id_height){
                jQuery('.STpanel-tabs').css('min-height',id_height);
            } else {
                jQuery('.STpanel-content').css('min-height',sidebar_height);
            }
        }


    }

    show_default_tab();


    jQuery('.STpanel-click-tabs > li.parent').not('li.parent_active').hover(function(){
        jQuery(this).addClass('hover');
    },function(){
        jQuery(this).removeClass('hover');
    });



    jQuery('.STpanel-click-tabs > li.parent').click(function(){
        jQuery('.STpanel-click-tabs > li.parent').not(jQuery(this)).removeClass('parent_active').find('ul').slideUp();
        jQuery('.STpanel-click-tabs > li.no-child >a').removeClass('active');

        if(jQuery(this).hasClass('parent_active')){

        }else{
            jQuery('.STpanel-click-tabs > li.parent').removeClass('parent_active');
            jQuery(this).find('ul').slideDown();
            jQuery(this).find('ul > li > a').eq(0).click();
            jQuery(this).addClass('parent_active');
        }

        jQuery(this).removeClass('parent-f-hover');
        return false;
    });


    // for tab when click  in item had childs
    jQuery('.STpanel-click-tabs .parent li a, .STpanel-click-tabs  li.no-child a').click(function(){
        var li = jQuery(this).parent('li');
        var id = jQuery(this).attr('href');

        jQuery('.STpanel-click-tabs > li.parent').not(jQuery(this).parents('.parent')).removeClass('parent_active').find('ul').slideUp()

        jQuery('.STpanel-tab').fadeOut();
        jQuery(id).fadeIn();
        jQuery('.STpanel-click-tabs a').removeClass('active');
        jQuery(this).addClass('active');
        id = id.replace(/#/,'');

        if(jQuery(this).attr('parent')){
            var  p= jQuery(this).attr('parent');
            if(jQuery('.tab-'+p).length){
                jQuery('.tab-'+p).addClass('parent_active');
            }
            st_setCookie('st_pntab_active_parent',p,20);
        }else{

            if(li.hasClass('parent')){
                li.addClass('parent_active');
            }

            st_setCookie('st_pntab_active_parent',id,20);
        }

        st_setCookie('st_pntab_active',id,20);


        var ph = jQuery(this).parents('.parent') ||  false
        if(ph.hasClass('parent-f-hover')){
            ph.removeClass('parent-f-hover');
        }

        //Tab Sidebar Height
        jQuery('.STpanel-content #'+id).css('height','auto');
        jQuery('.STpanel-tabs').css('height','auto');

        var id_height = jQuery('.STpanel-content #'+id).height();
        var sidebar_height = jQuery('.STpanel-tabs').height();
        if(sidebar_height < id_height){
            jQuery('.STpanel-tabs').css('min-height',id_height);
        } else {
            jQuery('.STpanel-content').css('min-height',sidebar_height);
        }

        // window.location.hash='#!/'+id;
        return false;
    });

    // when how this tab

    jQuery('.STpanel-click-tabs li.parent').hover(function(){
        var  p= jQuery(this);
        if(!p.hasClass('parent_active')){
            p.addClass('parent-f-hover');
        }
    },function(){
        var  p= jQuery(this);
        p.removeClass('parent-f-hover');

    });




    // for select layout
    jQuery('.STpanel-box-layout .layout-label input[type=radio]').change(function(){
        var p = jQuery(this).parents('.STpanel-box-layout');
        var sp = jQuery(this).parent('.STpanel-box-layout .layout-label');

        jQuery('.layout-label',p).removeClass('layout-label-checked');
        jQuery('.layout-label input[type=radio]',p).removeClass('checked');


        if(jQuery(this).attr('checked')){

            sp.addClass('layout-label-checked');
            jQuery(this).addClass('checked');
        }
    });


    // end for select layout

    // for color---------------------------------

    jQuery('.colorSelector-wrap').each(function(){

        var p= jQuery(this);
        var  c =  jQuery('.colorSelector-input',p).val();
        c ='#'+c;

        jQuery('.colorSelector',p).ColorPicker({
            color: c,
            onShow: function (colpkr) {
                jQuery(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                jQuery(colpkr).fadeOut(500);
                return false;
            },
            onSubmit: function(hsb, hex, rgb, el) {
                jQuery(el).val(hex);
                jQuery(el).ColorPickerHide();
                jQuery('.colorSelector div',p).css('backgroundColor', '#' + hex);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                jQuery('.colorSelector div',p).css('backgroundColor', '#' + hex);
                jQuery('.colorSelector-input',p).val(hex);
            },
            onBeforeShow: function () {
                var c = jQuery('.colorSelector-input',p).val();
                jQuery(this).ColorPickerSetColor(c);
            }
        });

        jQuery('.colorSelector-input',p).ColorPicker({

            onSubmit: function(hsb, hex, rgb, el) {
                jQuery(el).val(hex);
                jQuery(el).ColorPickerHide();
                jQuery('.colorSelector div',p).css('backgroundColor', '#' + hex);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                jQuery('.colorSelector-input',p).val(hex);
                jQuery('.colorSelector div',p).css('backgroundColor', '#' + hex);
            },
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value);
            }
        }).bind('keyup', function(){
                jQuery(this).ColorPickerSetColor(this.value);
                jQuery('.colorSelector div',p).css('backgroundColor', '#' + this.value);
            });

    });

    // end for color-----------------------------------------------------------

    // for style -----------------------------------------------------------------------------
    function style_preview(obj){
        var fontSize = jQuery('input.font-size',obj).val();
        var fontUnit = jQuery('.font-size-unit',obj).val();
        // var lineHight;
        var lineHight = jQuery('input.line-height',obj).val();

        var lineHightUnit = jQuery('.line-height-unit',obj).val();
        var color = jQuery('.font-color',obj).val();

        var font_selected =jQuery('.font-family option:selected',obj);

        var fontFamilyName = font_selected.text();
        var fontFamilyUrl =  font_selected.attr('url');

        if(fontFamilyUrl!=''){
            if(!jQuery('head link[href="'+fontFamilyUrl+'"]').length){
                jQuery('head').append("<link href='"+fontFamilyUrl+"' rel='stylesheet' type='text/css'>");
            }
            /*
             if(!jQuery('head link[href="http://fonts.googleapis.com/css?family='+fontFamilyName+'"]').length){
             jQuery('head').append("<link href='http://fonts.googleapis.com/css?family="+fontFamilyName+"' rel='stylesheet' type='text/css'>");
             }
             */
        }


        var fontStyle = jQuery('select.font-style',obj).val();
        var fontWeight = jQuery('select.font-weight',obj).val();
        var letterSpacing = jQuery('input.letter-spacing',obj).val();
        var letterSpacingUnit = jQuery('.letter-spacing-unit',obj).val();


        jQuery('.previewtxt',obj).css({
            'font-size': fontSize+fontUnit,
            'line-height' : lineHight+lineHightUnit,
            //  'color':  '#'+color,
            'font-family' : '"'+fontFamilyName+'"',
            'font-style': fontStyle,
            'font-weight' : fontWeight
            // 'letter-spacing' : letterSpacing+letterSpacingUnit
        });
    }


    // Slider
    jQuery('.js-slider-wrap').each(function(){
        var p = jQuery(this);
        var gp =  p.parent();
        var  value = jQuery('.hidden-amount',p).val();

        jQuery('.js-slider',p).slider({
            range: 'min',
            min: 0,
            max: 70,
            value: value,
            slide: function( event, ui ) {
                jQuery( ".amount" ,p).text( ui.value );
                jQuery('.hidden-amount',p).val(ui.value);
                var  unit = jQuery('.style-unit',p).val();
                unit =unit.toLowerCase()
                if(unit=='px' || unit==''){
                    style_preview(gp);
                }

            }
        });


        jQuery('.js-slider-percent',p).slider({
            range: 'min',
            min: 0,
            step:10,
            max: 400,
            value: value,
            slide: function( event, ui ) {
                jQuery( ".amount" ,p).text( ui.value );
                jQuery('.hidden-amount',p).val(ui.value);
                var  unit = jQuery('select.style-unit',p).val();
                unit =unit.toLowerCase()
                if(unit=='%'){
                    style_preview(gp);
                }
            }
        });

        jQuery('.js-slider-em',p).slider({
            range: 'min',
            min: 0,
            max: 7,
            step:0.1,
            value: value,
            slide: function( event, ui ) {
                jQuery( ".amount" ,p).text( ui.value );
                jQuery('.hidden-amount',p).val(ui.value);
                var  unit = jQuery('select.style-unit',p).val();
                unit =unit.toLowerCase()
                if(unit=='em'){
                    style_preview(gp);
                }
            }
        });


        jQuery('.js-slider-pt',p).slider({
            range: 'min',
            min: 0,
            max: 70,
            value: value,
            slide: function( event, ui ) {
                jQuery( ".amount" ,p).text( ui.value );
                jQuery('.hidden-amount',p).val(ui.value);
                var  unit = jQuery('select.style-unit',p).val();
                unit =unit.toLowerCase()
                if(unit=='pt'){
                    style_preview(gp);
                }
            }
        });


    });


    jQuery('.colorSelector-txt').each(function(){
        var p= jQuery(this);
        var gp = p.parent().parent();
        var  c =  jQuery('.font-color',p).val();
        jQuery('.colorSelector',p).ColorPicker({
            color: c,
            onShow: function (colpkr) {
                jQuery(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                jQuery(colpkr).fadeOut(500);
                return false;
            },
            onSubmit: function(hsb, hex, rgb, el) {
                jQuery(el).val(hex);
                jQuery(el).ColorPickerHide();
                jQuery('.colorSelector div',p).css('backgroundColor', '#' + hex);
                style_preview(gp);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                jQuery('.colorSelector div',p).css('backgroundColor', '#' + hex);
                jQuery('.font-color',p).val(hex);
                style_preview(gp);
            },
            onBeforeShow: function () {
                var c = jQuery('.font-color',p).val();
                jQuery(this).ColorPickerSetColor(c);
                style_preview(gp);
            }
        });

        jQuery('.font-color',p).ColorPicker({

            onSubmit: function(hsb, hex, rgb, el) {
                jQuery(el).val(hex);
                jQuery(el).ColorPickerHide();
                jQuery('.colorSelector div',p).css('backgroundColor', '#' + hex);
                style_preview(gp);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                jQuery('.font-color',p).val(hex);
                jQuery('.colorSelector div',p).css('backgroundColor', '#' + hex);
                style_preview(gp);
            },
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value);
            }
        }).bind('keyup', function(){
                jQuery(this).ColorPickerSetColor(this.value);
                jQuery('.colorSelector div',p).css('backgroundColor', '#' + this.value);
                style_preview(gp);
            });


    });

    jQuery('.STpanel-box-style .js-slider-wrap select ,.STpanel-box-style .style-inline select').change(function(){
        var  gp  = jQuery(this).parents('.STpanel-box-style');
        var  p = jQuery(this).parents('.js-slider-wrap');

        var o = jQuery(this);
        if(o.hasClass('style-unit')){
            var  unit = jQuery('select.style-unit',p).val();
            var  val = jQuery('.hidden-amount',p).val();
            unit =unit.toLowerCase();
            jQuery('.js-s-g',p).hide();
            switch(unit){
                case '%':
                    jQuery('.js-slider-percent',p).show();
                    break;
                case 'em':
                    if(val>7){
                        val =7;
                        jQuery('.amount',p).text(val);
                        jQuery('.hidden-amount',p).val(val);
                    }
                    jQuery('.js-slider-em',p).show();
                    break;
                case 'pt':
                    if(val>70){
                        val =70;
                        jQuery('.amount',p).text(val);
                        jQuery('.hidden-amount',p).val(val);
                    }
                    jQuery('.js-slider-pt',p).show();
                    break;
                default:
                    if(val>70){
                        val =70;
                        jQuery('.amount',p).text(val);
                        jQuery('.hidden-amount',p).val(val);
                    }
                    jQuery('.js-slider',p).show();

            }
        }

        //alert(gp.attr('class'));
        style_preview(gp);
    });


    jQuery('.STpanel-box-style .js-slider-wrap select,.STpanel-box-style .style-inline select').each(function(){
        var  gp  = jQuery(this).parents('.STpanel-box-style');
        var  p = jQuery(this).parents('.js-slider-wrap');

        var o = jQuery(this);
        if(o.hasClass('style-unit')){
            var  unit = jQuery('select.style-unit',p).val();
            var  val = jQuery('.hidden-amount',p).val();
            unit =unit.toLowerCase();
            jQuery('.js-s-g',p).hide();
            switch(unit){
                case '%':
                    jQuery('.js-slider-percent',p).show();
                    break;
                case 'em':
                    if(val>7){
                        val =7;
                        jQuery('.amount',p).text(val);
                        jQuery('.hidden-amount',p).val(val);
                    }
                    jQuery('.js-slider-em',p).show();
                    break;
                case 'pt':
                    if(val>70){
                        val =70;
                        jQuery('.amount',p).text(val);
                        jQuery('.hidden-amount',p).val(val);
                    }
                    jQuery('.js-slider-pt',p).show();
                    break;
                default:
                    if(val>70){
                        val =70;
                        jQuery('.amount',p).text(val);
                        jQuery('.hidden-amount',p).val(val);
                    }
                    jQuery('.js-slider',p).show();

            }
        }

        style_preview(gp);
    });

    // when style load
    jQuery('.STpanel-box-style').each(function(){
        var obj = jQuery(this);
        jQuery('.font-family option:selected',obj).each(function(){
            var font_selected =jQuery(this);

            var fontFamilyName = font_selected.val();
            var fontFamilyUrl =  font_selected.attr('url');
            //var fontFamilyName = font_selected.text();
            if(fontFamilyUrl!=''){

                if(fontFamilyUrl!=''){
                    if(!jQuery('head link[href="'+fontFamilyUrl+'"]').length){
                        jQuery('head').append("<link href='"+fontFamilyUrl+"' rel='stylesheet' type='text/css'>");
                    }
                    /*
                     if(!jQuery('head link[href="http://fonts.googleapis.com/css?family='+fontFamilyName+'"]').length){
                     jQuery('head').append("<link href='http://fonts.googleapis.com/css?family="+fontFamilyName+"' rel='stylesheet' type='text/css'>");
                     }
                     */
                }
            }


        });

    });

    // end for style ---------------------------------------------------------------------------------------
    // for gallery ----------------

    function re_name_gallery_meta(g){
        var pre_name= jQuery('.gallery-meta-name',g).val();
        jQuery('.st-img-items li',g).each(function(i){
            var li= jQuery(this);
            jQuery('.gtitle',li).attr('name',pre_name+'['+i+'][title]');
            jQuery('.gcaption',li).attr('name',pre_name+'['+i+'][caption]');
            jQuery('.gurl',li).attr('name',pre_name+'['+i+'][url]');
        });
    }

    // when page load

    jQuery('.st-gallery').each(function(){
        re_name_gallery_meta(jQuery(this));
    });

    jQuery( ".st-gallery .sortable" ).sortable({
        stop: function(event,ui){
            var data = jQuery(this).sortable("serialize");
            re_name_gallery_meta(jQuery(this).parents('.st-gallery '));
            //  alert(data);
        }
    });
    jQuery( ".st-gallery .sortable" ).disableSelection();

    // load images from libraly
    jQuery('.st-gallery .add_more_image , .st-gallery .st-s-btn').live('click',function(){
        var  p  = jQuery(this).parents('.st-gallery');
        var s= jQuery('input.st-s',p).val();
        if(s=='undefined'){
            s = '';
        }

        if(true){
            var data = {
                action:  'st_get_images',
                paged : 1,
                s: s,
                ajax_nonce: STpanel_options.ajax_nonce,
                rand: (new Date().getTime())
            };

            jQuery.ajax({
                type : "POST",
                url : ajaxurl,
                data : data,
                dataType : "html",
                cache: false,
                success : function(data){
                    jQuery('.ajax-media-cont',p).html(data);
                    jQuery('.ajax-media-cont',p).show();
                }
            });
        }else{
            jQuery('.ajax-media-cont',p).show();
        }

        return false;
    });

    // close list media image
    jQuery('.st-gallery  .close_ajax_images').click(function(){
        var  p  = jQuery(this).parents('.st-gallery');
        jQuery('.ajax-media-cont',p).hide();
        return false;
    });

    // pagination when lick to link
    jQuery('.st-gallery .paginate a').live('click',function(){
        var  p  = jQuery(this).parents('.st-gallery');

        var s= jQuery('input.st-s',p).val();
        if(s=='undefined'){
            s = '';
        }

        var data = {
            action:  'st_get_images',
            url: jQuery(this).attr('href'),
            ajax_nonce: STpanel_options.ajax_nonce,
            s:  s, // for seach
            rand: (new Date().getTime())
        };

        jQuery.ajax({
            type : "POST",
            url : ajaxurl,
            data : data,
            dataType : "html",
            cache: false,
            success : function(data){
                jQuery('.ajax-media-cont',p).html(data);
                jQuery('.ajax-media-cont',p).show();
            }
        });


        return false;
    });

    // for clone image whe user addd
    jQuery('.st-gallery .add_img').live('click',function(){
        var  p  = jQuery(this).parents('.st-gallery');
        var id  = jQuery(this).attr('img-id');

        // var c =  jQuery(this).clone().appendTo(jQuery(".st-img-items",p));
        var c = jQuery(this).clone();
        var name=  jQuery('.gallery-name',p).val();
        jQuery('.imw',c).append('<input type="hidden" name="'+name+'" value="'+id+'"/>');
        c.removeClass('add_img');
        c.attr('id',c.attr('id-name'));

        //  c.prependTo(".st-img-items",p);

        jQuery(".st-img-items",p).append(c);


        re_name_gallery_meta(p);
        return false;
    });

    // for remove mage .st_delete

    jQuery('.st-gallery li .st_delete').live('click',function(){
        var  p  = jQuery(this).parents('li');
        var gp = jQuery(this).parents('.st-gallery');
        p.remove();
        re_name_gallery_meta(gp);
        return false;

    });
    // for edit email
    jQuery('.st-gallery li .st_edit').live('click',function(){
        var  p  = jQuery(this).parents('.st-gallery');
        var  li  = jQuery(this).parents('li');
        var showid=  jQuery('.st-gallery-editct',p).attr('id');
        var w = (jQuery('.st-gallery-editct',p).width()+30);
        var h = (jQuery('.st-gallery-editct',p).height()+30);
        var gebox = jQuery('.st-gallery-editct',p) ;

        jQuery('.for-img-index',p).val(li.index());

        // load meta data from elment
        //alert(jQuery('.gtitle',li).val());
        var html = jQuery('#'+showid).html();
        var box = st_open_lightbox(html);
        jQuery('.stn-title',box).val(jQuery('.gtitle',li).val());
        jQuery('.stn-caption',box).val(jQuery('.gcaption',li).val());
        jQuery('.stn-url',box).val(jQuery('.gurl',li).val());

        //  jQuery('#'+showid).show();


        return false;
    });

    // for save meta
    jQuery('.st-meta .g-save-meta').live('click',function(){
        var  p  = jQuery(this).parents('.st-meta');
        var gboxid=  jQuery('.galleryid',p).val();
        var i  = jQuery('.for-img-index',p).val();
        var g  = jQuery('#'+gboxid);
        var li = jQuery('.st-img-items li',g).eq(i);

        jQuery('.gtitle',li).val(jQuery('.stn-title',p).val());
        jQuery('.gcaption',li).val(jQuery('.stn-caption',p).val());
        jQuery('.gurl',li).val(jQuery('.stn-url',p).val());

        // remove data
        jQuery('.stn-title',g).val('');
        jQuery('.stn-caption',g).val('');
        jQuery('.stn-url',g).val('');


        st_close_lightbox();
        return false;
    });

    // for gallery plugin  select  display type


    // when load
    jQuery('.gallery_settings select.gallery_display_type').each(function(){
        var  p  = jQuery(this).parents('.gallery_settings');
        var type = jQuery(this).val();
        // alert(type);
        jQuery('.st-glmset',p).hide();
        jQuery('.'+type,p).show();
    });
    // when change
    jQuery('.gallery_settings select.gallery_display_type').live('change',function(){
        var  p  = jQuery(this).parents('.gallery_settings');
        var type = jQuery(this).val();
        // alert(type);
        jQuery('.st-glmset',p).hide(500,function(){
            jQuery('.'+type,p).show();
        });
    });

    // when click to show hide advance button
    jQuery('.gallery_settings .st-adv-btn').live('click',function(){
        var  p  = jQuery(this).parents('.gallery_settings');
        jQuery('.st-g-adv-set',p).toggle();
        return false;
    });

    // ------------End galerry------------------------------------------------------------------------------------------------



    // ======================= For post type meta box ============================================ */
    // st_meta_boxs
    jQuery('.st_meta_boxs .st_pt_tab').live('click',function(){
        var p =  jQuery(this).parents('.st_meta_boxs');
        var tabid=  jQuery(this).attr('for-tab');
        if(jQuery('#'+tabid,p).length){
            // for tabs
            jQuery('.st_pt_tabs .st_pt_tab',p).removeClass('active');
            jQuery(this).addClass('active');

            // for tab coontent
            jQuery('.st_pt_tab_cont',p).hide(300).removeClass('active').addClass('tab-hide');
            jQuery('#'+tabid,p).show(300).addClass('active').removeClass('tab-hide');
        }
        return false;
    });

    // ======================= END For post type meta box ============================================ */


    // ======================= For UI ============================================ */

    // for toggle
    jQuery('.st-widget .ui-handlediv').live('click',function(){
        var p =  jQuery(this).parents('.st-widget');

        if(p.hasClass('closed')){
            p.removeClass('closed');
        }else{
            p.addClass('closed');
        }

        // return false;
    });

    // for close
    jQuery('.st-widget .close').live('click',function(){
        var p =  jQuery(this).parents('.st-widget');
        p.addClass('closed');
        return false;
    });




    function re_name_ui_meta(g){
        var pre_name= jQuery('.st-ui-name',g).val();
        jQuery('li',g).each(function(i){
            var li= jQuery(this);
            jQuery('.ui-title',li).attr('name',pre_name+'['+i+'][title]');
            jQuery('.ui-cont',li).attr('name',pre_name+'['+i+'][content]');
            jQuery('.ui-img',li).attr('name',pre_name+'['+i+'][img]');
            jQuery('.ui-autop',li).attr('name',pre_name+'['+i+'][autop]');
            jQuery('.ui-autoid',li).attr('name',pre_name+'['+i+'][id]');
            jQuery('.ui-url',li).attr('name',pre_name+'['+i+'][url]');
        });
    }

    // for remove
    jQuery('.st-ui li .st-widget .remove').live('click',function(){
        var p =  jQuery(this).parents('li');
        var g =  jQuery(this).parents('.st-ui');
        p.remove();
        re_name_ui_meta(g);
        return false;
    });


    jQuery( ".st-ui .st-ui-list.sortable" ).sortable({
        handle: ".st-hndle" ,
        stop: function(event,ui){
            // var data = jQuery(this).sortable("serialize");
            re_name_ui_meta(jQuery(this).parents('.st-ui'));
        }
    });

    //  jQuery( ".st-ui .st-ui-list.sortable" ).disableSelection();

    jQuery('.st-ui .st-ui-more').live('click',function(){
        var p =  jQuery(this).parents('.st-ui');
        var temp = jQuery('.ui-temp-code',p).clone();
        var uniq = 'id' + (new Date()).getTime();


        jQuery('.ui-autoid',temp).val(uniq); // set auto ID
        html = temp.html();
        jQuery(".st-ui-list",p).append('<li>'+html+'</li>');
        re_name_ui_meta(p);
        // alert('ok');
        return false;
    });

    // when write something in  input title
    jQuery('.st-widget .ui-title').live('keyup',function(){
        var p =  jQuery(this).parents('.st-widget');
        var t = jQuery('.ui-title',p).val();
        jQuery('.st-hndle span',p).text(t);
    });



    // ======================= END For UI ============================================ */

}); //  end  ready