function stpb_close_lightbox() {
    jQuery('#stpblb-lightbox, #stpblb-overlay, #stpblb-lightbox-wrap').remove();
    return;
}

function stpb_lightbox_postpbion() {
    var w = jQuery(window).width();
    var h = jQuery(window).height();

    var bh = jQuery('#stpblb-lightbox').height();
    var bw = jQuery('#stpblb-lightbox').width();
    var top = 0,
        left = 0;

    jQuery('#stpblb-lightbox-ww').height(h - 90);
    bh = h - 130 - 40;
    jQuery('.stpblb-wrap-inner .stpblb-inner').height(bh);
    jQuery('#stpblb-lightbox-wrap').css({
        'display': 'block'
    });

}

function stpb_open_lightbox(html) {
    var lightboxHTML = '<div id="stpblb-overlay"></div>\
                        <div id="stpblb-lightbox-wrap">\
                        <div id="stpblb-lightbox-ww">\
                             <div id="stpblb-lightbox">\
                                 <h2 class="stpb-lightbox-title"></h2>\
                                 <div class="stpblb-wrap-inner">\
                                  <div class="stpblb-inner"><div class="bpbd-c">' + html + '</div></div>\
                                 </div>\
                                 <div class="pblb-btns"><div class="btns-i"></div></div>\
                            </div>\
                            </div>\
                         </div>';



    var box = jQuery(lightboxHTML).appendTo('body').hide();
    var title = jQuery('.stpb_title', box).html();
    var btns = jQuery('.pb-btns', box).hide(0).html();

    if (typeof (title) != 'undefined' && title != '') {
        jQuery('.stpb-lightbox-title', box).html('<span class="lt">' + title + '</span>');
        jQuery('.stpb_title', box).hide();

    } else {
        jQuery('.stpb-lightbox-title', box).hide();
    }

    jQuery('.pblb-btns .btns-i', box).html(btns);


    stpb_lightbox_postpbion();
    jQuery(window).resize(function () {
        stpb_lightbox_postpbion();
    });

    jQuery('#stpblb-overlay').css('opacity', '0.8');
    jQuery('#stpblb-overlay, #stpblb-lightbox').show();
    jQuery('#stpblb-close').click(function (event) {
        close_stpb_lightbox();
        event.preventDefault();
    });

    if (typeof (jQuery.iButton) != 'undefined')
        jQuery(".lb-ibutton", box).iButton();

    jQuery(".lb-chzn-select", box).each(function () {
        var select = this;
        jQuery(this).removeAttr('id');
        jQuery(this).chosen().trigger("liszt:updated");
    });



    return box;
}

function re_name_ui_meta(g) {
    var pre_name = jQuery('.stpb-ui-name', g).val();
    jQuery('li', g).each(function (i) {
        var li = jQuery(this);
        jQuery('.ui-title', li).attr('name', pre_name + '[' + i + '][title]');
        jQuery('.ui-cont', li).attr('name', pre_name + '[' + i + '][content]');
        jQuery('.ui-img', li).attr('name', pre_name + '[' + i + '][img]');
        jQuery('.ui-autop', li).attr('name', pre_name + '[' + i + '][autop]');
        jQuery('.ui-autoid', li).attr('name', pre_name + '[' + i + '][id]');
        jQuery('.ui-url', li).attr('name', pre_name + '[' + i + '][url]');
    });
}


function re_name_gallery_meta(g) {
    var pre_name = jQuery('.gallery-meta-name', g).val();
    jQuery('.stpb-img-items li', g).each(function (i) {
        var li = jQuery(this);
        jQuery('.gtitle', li).attr('name', pre_name + '[' + i + '][title]');
        jQuery('.gcaption', li).attr('name', pre_name + '[' + i + '][caption]');
        jQuery('.gurl', li).attr('name', pre_name + '[' + i + '][url]');
    });
}


//------------------------end light box-----------------------------------

if (typeof (STpanel_options) != 'undefined') {

} else {
    STpanel_options = window['STpb_options'];
}

// type = success, warning

function show_builder_notifications(type) {

    clearTimeout(time_out_note);
    jQuery('.stbuilder-items .notifications .n').hide();
    jQuery('.stbuilder-items .notifications .' + type).show(100);

    time_out_note = setTimeout('jQuery(".stbuilder-items .notifications .' + type + '").hide(200)', 3000);
}

var time_out_note;


jQuery(document).ready(function () {

    // for style buttons
    // end for style buttons
    // re set select with select mulltipe
    jQuery('.stpb_pd_w select[multiple=multiple]').each(function () {
        var s = jQuery(this);
        var ids = jQuery(this).attr('selected-ids');
        if (typeof (ids) == 'undefined' || ids == '') {

        } else {
            ids = ids.split(',');
            jQuery('option', s).each(function () {
                var v = jQuery(this).val();
                if (jQuery.inArray(v, ids) >= 0) {
                    jQuery(this).attr('selected', 'selected');
                }
            });
        }


        if (s.hasClass('lt-chzn-select')) {
            s.chosen();
        }

    });

    // from  0 - > 9
    //  var pd_item_width = ['1_1', '4_5', '3_4','2_3','3_5','1_2','2_5','1_3','1_4','1_5'];
    var pd_item_width = ['1_1', '3_4', '2_3', '1_2', '1_3', '1_4'];

    // change width 

    function change_buider_size(size, p) {
        var c_name = pd_item_width[size];
        var c_txt = c_name.replace('_', '/');

        for (i = 0; i < pd_item_width.length; i++) {
            p.removeClass('col_' + pd_item_width[i]);
        }

        p.attr('numc', size);
        p.addClass('col_' + c_name);
        jQuery('.builder-with', p).val(c_name);
        jQuery('.with-info', p).html(c_txt);
    }

    //-------------
    jQuery('.obj-item .up').live('click', function () {

        var p = jQuery(this).parents('.obj-item');
        var c = p.attr('numc');
        if (typeof (c) == 'undefined' || c == '') {
            c = 0;
        }
        if (c > 0) {
            c--;
        }
        change_buider_size(c, p);
        return false;
    });

    jQuery('.obj-item .down').live('click', function () {
        var p = jQuery(this).parents('.obj-item');
        var c = p.attr('numc');
        if (typeof (c) == 'undefined' || c == '') {
            c = 0;
        }
        //  alert(c);
        if (c < pd_item_width.length - 1) {
            c++;
        } else {
            c = pd_item_width.length - 1;
        }

        change_buider_size(c, p);
        return false;

    });


    //  remname builder objects

    function rename_builders(a) {
        jQuery('.stbuilder .stbuilder-area .obj-item').each(function (i) {
            var gp = jQuery(this).parents('.stbuilder');
            var p = jQuery(this);
            var gpre_name = jQuery('.builder_pre_name', gp).val();
            //  jQuery('.with-info',p).html(i); // debug only
            jQuery('.group-name', p).each(function (j) {
                var afname = jQuery(this).attr('group-name');
                var name = '';

                if (typeof (afname) == 'undefined' || afname == '') {
                    name = gpre_name + '[' + i + '][]';
                } else {
                    name = gpre_name + '[' + i + ']' + afname;
                }

                if (jQuery(this).hasClass('val-only')) {
                    jQuery(this).val(name);
                } else {
                    jQuery(this).attr('name', name);
                }

            });
            // rename ui
            re_name_ui_meta(p);
            re_name_gallery_meta(p);
        });



    }
    rename_builders(); // call function

    //for area  sortable
    jQuery('.stbuilder-area.sortable').sortable({
        stop: function (event, ui) {
            rename_builders(true); // call function
        }
    });

    // for click when add builder item 
    jQuery('.stbuilder-o-items .bd-item .act-add').click(function () {
        var p = jQuery(this).parents('.bd-item');
        var html = jQuery('.item-js-options', p).html();
        jQuery('.stbuilder-area').append(html);
        rename_builders();

        // show notifications;
        show_builder_notifications('success');

        return false;
    });


    // for remove builder object 
    jQuery('.obj-item .pbremove').live('click', function () {
        jQuery(this).parents('.obj-item').remove();
        return false;
    });

    // for edit box
    jQuery('.stbuilder-area-wprap .obj-item .pbedit').live('click', function () {

        var p = jQuery(this).parents('.obj-item');
        var html = jQuery('.obj-js-edit', p).html();
        var box = stpb_open_lightbox(html);
        jQuery('#stpblb-lightbox').attr('for-index', p.index());
        // for sortable 
        jQuery('.sortable', box).sortable({
            handle: '.stpb-hndle',
            stop: function (event, ui) {
                re_name_ui_meta(box);
            }
        });

        return false;
    });


    // when hit done button 
    jQuery('#stpblb-lightbox .pbdone').live('click', function () {
        var gp = jQuery(this).parents('#stpblb-lightbox');

        // destroy ibutton, select
        if (typeof (jQuery.iButton) != 'undefined')
            jQuery(".lb-ibutton", gp).iButton('destroy');

        jQuery("select.chzn-done", gp).each(function () {
            var s = jQuery(this);
            s.removeClass("chzn-done").css('display', 'inherit').removeAttr('id').removeData('chosen');
            // console.debug(s.data().chosen);
        });

        // jQuery("select option",gp).removeData();
        jQuery(".chzn-container", gp).not(jQuery('.lb-chzn-select')).remove();

        // do some thing here 
        var i = gp.attr('for-index');

        var f = jQuery('.stpblb-inner', gp);

        // clone value
        jQuery('input[type=text], input[type=hidden]', f).each(function () {
            jQuery(this).attr('value', jQuery(this).val());
        });

        jQuery('textarea', f).each(function () {
            jQuery(this).text(jQuery(this).val());
        });

        jQuery('select option:selected', f).each(function () {
            jQuery(this).attr('selected', 'selected');
        });

        jQuery('select option:not(:selected)', f).each(function () {
            jQuery(this).removeAttr('selected');
        });

        jQuery('input[type=checkbox]:checked, input[type=radio]:checked', f).each(function () {
            jQuery(this).attr('checked', 'checked');
        });

        jQuery('input[type=checkbox]:not(:checked), input[type=radio]:not(:checked)', f).each(function () {
            jQuery(this).removeAttr('checked');
        });


        var html = f.html();
        f.hide().html('');
        jQuery('.stbuilder-area .obj-item').eq(i).find('.obj-js-edit').html(html);
        stpb_close_lightbox();
        return false;
    });


    // when hit done button 
    jQuery('#stpblb-lightbox .pbcancel').live('click', function () {
        var gp = jQuery(this).parents('#stpblb-lightbox');
        // do some thing here 

        // remove chosen data
        jQuery("select.chzn-done, .stbuilder .obj-js-edit .lb-chzn-select", gp).each(function () {
            var s = jQuery(this);
            s.removeClass("chzn-done").css('display', 'inherit').removeAttr('id').removeData('chosen');
            // console.debug(s.data().chosen);
        });
        jQuery(".chzn-container", gp).not(jQuery('.lb-chzn-select')).remove()
        jQuery(".stbuilder .obj-js-edit .chzn-container").not(jQuery('.lb-chzn-select')).remove()
        // end remove chosen data



        jQuery('#stpblb-lightbox .stpblb-inner', gp).html('');
        stpb_close_lightbox();
        return false;
    });

    //  rename builder object group 

    //---------------------------------------------------------

    // for select layout 
    jQuery('.stpb_pd_w .layout-wrap .layout .stpb-layout-item input').live('change', function () {
        var p = jQuery(this).parents('.layout');
        var gp = jQuery(this).parents('.layout-wrap');
        var sp = jQuery(this).parents('.stpb-layout-item');

        var v = jQuery(this).val();
        v = parseInt(v);
        switch (v) {
        case 1:
            jQuery('.sidebar', gp).hide(200);
            break;
        case 2:
            jQuery('.sidebar', gp).show(200, function () {
                jQuery('.left_sidebar', gp).hide(200, function () {
                    jQuery('.right_sidebar', gp).show();
                });
            });

            break;
        case 3:

            jQuery('.sidebar', gp).show(200, function () {
                jQuery('.right_sidebar', gp).hide(200, function () {
                    jQuery('.left_sidebar', gp).show();
                });
            });

            break;

        default:
            jQuery('.sidebar', gp).show(200, function () {
                jQuery('.right_sidebar, .left_sidebar', gp).show();
            });

        }

        jQuery('.stpb-layout-item', p).removeClass('label-checked');
        sp.addClass('label-checked');
    });




    // ======================= For UI ============================================ */
    // for toggle
    jQuery('.stpb-widget .ui-handlediv').live('click', function () {
        var p = jQuery(this).parents('.stpb-widget');

        if (p.hasClass('closed')) {
            p.removeClass('closed');
        } else {
            p.addClass('closed');
        }

        // return false;
    });

    // for close 
    jQuery('.stpb-widget .close').live('click', function () {
        var p = jQuery(this).parents('.stpb-widget');
        p.addClass('closed');
        return false;
    });

    // for remove  
    jQuery('.stpb-ui .stpb-widget .remove').live('click', function () {
        var p = jQuery(this).parents('.stpb-widget');
        var g = jQuery(this).parents('.stpb-ui');
        p.remove();
        re_name_ui_meta(g);
        return false;
    });


    jQuery('.stpb-ui .stpb-ui-more').live('click', function () {
        var p = jQuery(this).parents('.stpb-ui');
        var temp = jQuery('.ui-temp-code', p).clone();
        var uniq = 'id' + (new Date()).getTime();


        jQuery('.ui-autoid', temp).val(uniq); // set auto ID
        html = temp.html();
        jQuery(".stpb-ui-list", p).append('<li>' + html + '</li>');
        re_name_ui_meta(p);
        // alert('ok');
        return false;
    });

    // when write something in  input title
    jQuery('.stpb-widget .ui-title').live('keyup', function () {
        var p = jQuery(this).parents('.stpb-widget');
        var t = jQuery('.ui-title', p).val();
        jQuery('.stpb-hndle span', p).text(t);
    });

    // ======================= END For UI ============================================ */
    // for gallery ---------------
    // when page load 
    jQuery('.stpb-gallery').each(function () {
        re_name_gallery_meta(jQuery(this));
    });

    jQuery(".stpb-gallery .sortable").sortable({
        stop: function (event, ui) {
            ///  var data = jQuery(this).sortable("serialize");
            re_name_gallery_meta(jQuery(this).parents('.stpb-gallery '));
            //  alert(data);
        }
    });
    // jQuery( ".stpb-gallery .sortable" ).disableSelection();

    // load images from libraly
    jQuery('.stpb-gallery .add_more_image, .stpb-gallery .st-s-btn, .stpb-gallery .pb-only-img-p').live('click', function () {
        var p = jQuery(this).parents('.stpb-gallery');
        var s = jQuery('input.st-s', p).val();
        if (s == 'undefined') {
            s = '';
        }

        var post_ID = jQuery('input#post_ID').val();
        if (typeof (post_ID) == 'undefined' || post_ID == '') {
            post_ID = 0;
        }

        var this_p_only = jQuery('input.pb-only-img-p', p).attr('checked') ? 1 : 0;

        // show loading
        jQuery('.ajax-media-cont', p).html('<div class="loading"></div>');


        if (true) {
            var data = {
                action: 'stpb_get_images',
                paged: 1,
                s: s,
                only: this_p_only,
                post_id: post_ID,
                ajax_nonce: STpb_options.ajax_nonce,
                rand: (new Date().getTime())
            };

            jQuery.ajax({
                type: "POST",
                url: ajaxurl,
                data: data,
                dataType: "html",
                cache: false,
                success: function (data) {
                    jQuery('.ajax-media-cont', p).html(data);
                    jQuery('.ajax-media-cont', p).show();
                }
            });
        } else {
            jQuery('.ajax-media-cont', p).show();
        }
        if (jQuery(this).hasClass('pb-only-img-p')) {

        } else {
            return false;
        }

    });

    // close listpb media image
    jQuery('.stpb-gallery  .close_ajax_images').live('click', function () {
        var p = jQuery(this).parents('.stpb-gallery');
        jQuery('.ajax-media-cont', p).hide();
        return false;
    });

    // pagination when lick to link
    jQuery('.stpb-gallery .paginate a').live('click', function () {
        var p = jQuery(this).parents('.stpb-gallery');

        var s = jQuery('input.st-s', p).val();
        if (s == 'undefined') {
            s = '';
        }

        var post_ID = jQuery('input#post_ID').val();
        if (typeof (post_ID) == 'undefined' || post_ID == '') {
            post_ID = 0;
        }

        var this_p_only = jQuery('input.pb-only-img-p', p).attr('checked') ? 1 : 0;

        var data = {
            action: 'stpb_get_images',
            url: jQuery(this).attr('href'),
            only: this_p_only,
            post_id: post_ID,
            ajax_nonce: STpb_options.ajax_nonce,
            s: s, // for seach
            rand: (new Date().getTime())
        };

        jQuery('.ajax-media-cont', p).html('<div class="loading"></div>');

        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            dataType: "html",
            cache: false,
            success: function (data) {
                jQuery('.ajax-media-cont', p).html(data);
                jQuery('.ajax-media-cont', p).show();
            }
        });


        return false;
    });

    // for clone image whe user addd
    jQuery('.stpb-gallery .add_img').live('click', function () {
        var p = jQuery(this).parents('.stpb-gallery');
        var id = jQuery(this).attr('img-id');

        // var c =  jQuery(this).clone().appendTo(jQuery(".stpb-img-items",p));
        var c = jQuery(this).clone();
        var name = jQuery('.gallery-name', p).val();
        jQuery('.imw', c).append('<input type="hidden" class="group-name" group-name="[images][]" name="' + name + '" value="' + id + '"/>');
        c.removeClass('add_img');
        c.attr('id', c.attr('id-name'));

        jQuery('.stpb-img-items', p).removeClass('no-image');

        jQuery(".stpb-img-items", p).append(c);


        re_name_gallery_meta(p);
        return false;
    });

    // for remove mage .stpb_delete
    jQuery('.stpb-gallery   li .stpb_delete').live('click', function () {
        var p = jQuery(this).parents('li');
        var gp = jQuery(this).parents('.stpb-gallery');

        p.remove();
        re_name_gallery_meta(gp);

        var l = jQuery('.stpb-img-items li', gp).length;
        if (l > 0) {
            jQuery('.stpb-img-items', gp).removeClass('no-image');
        } else {
            jQuery('.stpb-img-items', gp).addClass('no-image');
        }
        return false;

    });


    jQuery('.gallery-builder .btn-actions .close_ajax_images').live('click', function () {
        var p = jQuery(this).parents('.gallery-builder ');
        jQuery('.ajax-media-cont', p).html('').hide();
        return false;
    });


    // for edit gallery in builder object  in lightbox
    jQuery('.stpb-gallery  li .stpb_edit').live('click', function () {
        var p = jQuery(this).parents('.stpb-gallery ');

        var li = jQuery(this).parents('li');
        var box = jQuery('.stpb-gallery-editct', p); // 

        box.attr('for-img-index', li.index());

        jQuery('.ajax-media-cont', p).hide();
        // load meta data from elment
        var imgsrc = jQuery('.imgid', li).attr('src');

        jQuery('.image_preview', box).html('<img src=' + imgsrc + ' alt=""/>');

        jQuery('.stpbn-title', box).val(jQuery('.gtitle', li).val());
        jQuery('.stpbn-caption', box).val(jQuery('.gcaption', li).val());
        jQuery('.stpbn-url', box).val(jQuery('.gurl', li).val());

        var images_div = jQuery('.stpb-img-items', p) || jQuery('.stpb-iws', p);
        images_div.hide(200, function () {
            box.show(200);
        });
        return false;
    });

    // for save meta
    jQuery('.stpb-gallery .g-save-meta').live('click', function () {
        var p = jQuery(this).parents('.stpb-gallery');
        var box = jQuery('.stpb-gallery-editct', p);
        var i = box.attr('for-img-index');

        var li = jQuery('.stpb-img-items li', p).eq(i);

        jQuery('.gtitle', li).val(jQuery('.stpbn-title', box).val());
        jQuery('.gcaption', li).val(jQuery('.stpbn-caption', box).val());
        jQuery('.gurl', li).val(jQuery('.stpbn-url', box).val());

        // remove data
        jQuery('.stpbn-title', box).val('');
        jQuery('.stpbn-caption', box).val('');
        jQuery('.stpbn-url', box).val('');


        box.hide(200, function () {
            jQuery('.stpb-img-items', p).show(200);
        });
        return false;
    });

    jQuery('.stpb-gallery .close').live('click', function () {
        var p = jQuery(this).parents('.stpb-gallery');

        var box = jQuery('.stpb-gallery-editct', p);
        jQuery('.stpbn-title', box).val('');
        jQuery('.stpbn-caption', box).val('');
        jQuery('.stpbn-url', box).val('');

        box.hide(200, function () {
            jQuery('.stpb-img-items', p).show(200);
        });

    });




    // for gallery plugin  select  display type 

    // ------------End galerry------------------------------------------------------------------------------------------------
    // for upload ====================
    jQuery('.pb-box-upload .pb-upload-button').live('click', function () {
        var p = jQuery(this).parent('.pb-box-upload');
        var formfield = jQuery('.pb-input-upload', p).attr('name');
        var post_ID = jQuery('input#post_ID').val();
        if (typeof (post_ID) == 'undefined' || post_ID == '') {
            post_ID = 0;
        }


        STpanel_options.uploadID = jQuery(this).attr('for-id');
        STpanel_options.upload_type = jQuery(this).attr('data-type');

        if (jQuery(this).attr('data-type') != 'id') {
            window.send_to_editor = function (html) {
                html = jQuery( html );
                var imgurl;
                if ( jQuery('img', html).length ) {
                    imgurl = jQuery('img', html).attr('src');
                } else {
                    imgurl = html.attr('src');
                }
                // var id= jQuery('img',html).attr('id');
                //  alert(html);
                jQuery('.pb-input-upload', p).val(imgurl);
                jQuery('.pb-image-preview', p).html('<a class="viewfull-image" title="View full image" href="' + imgurl + '" target="_blank"><img src="' + imgurl + '" alt=""/></a>');
                jQuery('.remove_image', p).fadeIn();
                tb_remove();
            }
        }

        var _custom_media = true;
        var frame = wp.media;
        var _orig_send_attachment = wp.media.editor.send.attachment;
        var send_attachment_bkp = wp.media.editor.send.attachment;

        frame.view.settings.mimeTypes = {
            'image': 'Images'
        };
        frame.view.l10n.allMediaItems = 'All Images';
        frame.view.l10n.insertMediaTitle = 'Upload and select image';
        frame.view.l10n.insertIntoPost = 'Insert';

        frame.view.settings.tabs = false;
        frame.editor.send.attachment = function (props, attachment) {
            return _orig_send_attachment.apply(this, [props, attachment]);
        }


        frame.editor.open();



        return false;
    });

    // for remove upload image 
    jQuery('.pb-box-upload .remove_image').live('click', function () {
        var p = jQuery(this).parent('.pb-box-upload');
        jQuery('input.pb-input-upload', p).val('');
        jQuery('.pb-image-preview', p).html('');
        jQuery('.remove_image', p).hide();
        return false;
    });


    // for select thumbnail
    jQuery('.stpb_pd_w .thumbnail .tt').live('change', function () {


        var gp = jQuery(this).parents('.thumbnail');
        if (jQuery(this).val() == 'video') {
            jQuery('.thumbnail_images, .thumbnail_html', gp).hide(200, function () {
                jQuery('.thumbnail_video', gp).show();
            });

        } else if (jQuery(this).val() == 'image') {
            jQuery('.thumbnail_video', gp).hide();
            jQuery('.thumbnail_images, .thumbnail_html', gp).hide();
        } else if (jQuery(this).val() == 'html') {

            jQuery('.thumbnail_images, .thumbnail_video', gp).hide(function () {
                jQuery('.thumbnail_html', gp).show();
            });
        } else {
            jQuery('.thumbnail_video, .thumbnail_html', gp).hide(200, function () {
                jQuery('.thumbnail_images', gp).show();
            });
        }

    });

    //-------------------------------------------------
    //  for Top Slider
    jQuery('.stpb_pd_w  .show_top_slider_ibutton').iButton({
        change: function (t) {
            var p = t.parents('.stpb_pd_w');
            if (t.attr('checked')) {
                jQuery('.slider-types', p).show();
                // show slider type
                var st = jQuery('.st-slider-type', p).val();
                jQuery('.st-slider-data', p).hide();
                jQuery('.st-' + st, p).show();


            } else {
                jQuery('.slider-types', p).hide();
                jQuery('.st-slider-data', p).hide();
            }
        }

    });

    jQuery('.stpb_pd_w  .slider-types .st-slider-type').change(function () {
        var p = jQuery(this).parents('.stpb_pd_w');
        var st = jQuery(this).val();
        jQuery('.st-slider-data', p).hide();
        jQuery('.st-' + st, p).show();

    });




});