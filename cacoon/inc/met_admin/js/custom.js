jQuery(document).ready(function($){

    $('.controls .btn').click(function(){
        if(!$(this).hasClass('clear_image')){
            var container = $(this).parent('div').parent('div');
            var patt = /\s.*?_file.*?/;
            if(!$(this).hasClass('btn-primary') && patt.test($(this).attr('class')) == false){
                container.children('div').children('.btn-primary').removeClass('btn-primary');
                $(this).addClass('btn-primary');
            }
        }
    });

/* FILE UPLOAD/DELETE CONTROLS STARTS */
    /*
    $('[class*="_file"].btn').click(function() {
        eee = $(this).attr('class').split(' ')[($(this).attr('class').split(' ').length - 1)];

        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });

    window.send_to_editor = function(html) {
        imgurl = $('img',html).attr('src');
        imgElem = $('#'+eee);

        imgElem.parent('label').parent('div').prepend('<img src="'+imgurl+'" alt="" /><br>');
        imgElem.val(imgurl);
        imgElem.parent('label').next('.clear_image').addClass('show_button');
        tb_remove();
    }*/


    var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;

    $('.uploader .button').click(function(e) {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = $(this);
        var id = button.attr('id').replace('_button', '');
        _custom_media = true;

        wp.media.editor.send.attachment = function(props, attachment){
            if ( _custom_media ) {
                $("#"+id).val(attachment.url);
                $("#uploader_media_preview"+id).attr('src',attachment.url).css('display','block');
            } else {
                return _orig_send_attachment.apply( this, [props, attachment] );
            };
        }

        wp.media.editor.open(button);
        return false;
    });

    $('.add_media').on('click', function(){
        _custom_media = false;
    });

    $('.clear_image').click(function(e){
        e.preventDefault();
        $(this).parent().children('img').css('display','none');
        $(this).parent('div').children('input[type="hidden"]').val('');
        $(this).parents('.input').children('input[type="hidden"]').val('');
        $(this).removeClass('show_button');
    });
/* FILE UPLOAD/DELETE CONTROLS RNDS */

    var myOptions = {
        // a callback to fire whenever the color changes to a valid color
        change: function(event, ui){},
        // a callback to fire when the input is emptied or an invalid color
        clear: function() {},
        // hide the color picker controls on load
        hide: true,
        // show a group of common colors beneath the square
        // or, supply an array of colors to customize further
        palettes: true
    };
    $('.my-color-field').wpColorPicker(myOptions);

    $('.widgetbox').bind('submit',function(e){
        $(this).find('.listline').each(function(){
            var howMany = $(this).children('.in-text').length;
            var counter = 0;
            $(this).children('.in-text').each(function(){
                if($(this).val() == ''){
                    counter++;
                }
            });
            if(howMany == counter){
                $(this).remove();
            }
        });

    });

    jQuery('.delete-list-item').tooltip();

    /*$('.add-list-item').click(function(){
        var father      = $(this).parent();
        var grandFather = father.parent('.input');
        grandFather.append('<div>'+father.html()+'</div>');
    });*/
});

function menu_toggler(){
    if(!jQuery('.met-options-menu').hasClass('left-menu-closed')){
        jQuery('#menu').addClass('left-menu-closed');
        jQuery('#content').addClass('right-content-open');
    }else{
        jQuery('#menu').removeClass('left-menu-closed');
        jQuery('#content').removeClass('right-content-open');
    }
}

function deleteListItem(i){

    var number = i.prev().attr('data-original-number');
    var name = i.prev().attr('name').split('[')[0];

    var categoryPart = i.parents('form').attr('action').split('subPage=')[1];
    var category = categoryPart.split('&')[0];
    jQuery.ajax({
        type: "POST",
        url: "admin.php?page=settings&subPage=ajax",
        data: 'name=' + name + '&id=' + number + '&category=' + category/*,
        success: function(returnBack){
            console.log(returnBack)
        }*/
    });

    i.parent().removeClass('listline').fadeOut('slow',function(){
        jQuery(this).remove();
    });
    reorderList(i);
}

function addListItem(i){
    var father      = i.parent();
    var grandFather = father.parent('.input');
    grandFather.append('<div class="hide-first listline">'+father.html()+'</div>');
    jQuery('.hide-first').fadeIn('slow',function(){
        jQuery(this).removeClass('hide-first');
    });
    i.removeClass('icon-plus').addClass('icon-minus').attr('onclick','deleteListItem(jQuery(this));');
    reorderList(i);
}

function reorderList(i){
    var count  = 0;
    var grandFather = i.parents('.input');
    grandFather.children('.listline').each(function(){
        jQuery(this).children('.in-text').each(function(){
            jQuery(this).attr('name',jQuery(this).attr('name').replace(/\[\d+\]/g,'['+count+']'));
        });
        count++;
    });
}