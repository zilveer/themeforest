jQuery(document).ready( function($) {

$('.menu_icon_bt').on('click',function() {
    mid = "#edit-menu-item-micon-" + $(this).attr('data-id');
    prv = "#icon_prv_" + $(this).attr('data-id');
    $('#mom_menu_icon').on('click',function() {
        var icon = $('input[name="mom_menu_item_icon"]:checked').val();
        $(mid).val(icon);
        $(prv).removeClass().addClass('icon_prv '+icon);
        $(prv).find('.remove_icon').show();
            tb_remove();
            return false;
    });
});
$('.icon_prv').each(function() {
    $(this).addClass($(this).next('input').val());
});

$('.icon_prv .remove_icon').click(function () {
    $(this).hide();
   $(this).parent().removeClass().addClass('icon_prv');
   $(this).parent().next('input').val('');
   return false;
});
$('.edit-menu-item-micon').each(function() {
    if ($(this).val() === '') {
        $(this).prev('.icon_prv').find('.remove_icon').hide();
    }
});

$.mom_mega_menus_type = function () {
$('.edit-menu-item-mtype').on('change', function() {
    var t = $(this);
    var id = $(this).attr('id');
    id = id.split('-');
    if ($(this).val() === 'cats') {
        $(this).parent().parent().parent().find('.field-mcats_layout').slideDown(250);
        $(this).parent().parent().parent().find('.field-mcustom').slideUp('fast');
    } else if ($(this).val() === 'custom') {
        $(this).parent().parent().parent().find('.field-mcustom').slideDown(250);
        $(this).parent().parent().parent().find('.field-mcats_layout').slideUp('fast');
    } else {
        $(this).parent().parent().parent().find('.field-mcustom').slideUp('fast');
        $(this).parent().parent().parent().find('.field-mcats_layout').slideUp('fast');
    }
});
}
$.mom_mega_menus_type();

$('.edit-menu-item-mtype').each(function() {
    if ($(this).val() === 'cats') {
        $(this).parent().parent().parent().find('.field-mcats_layout').slideDown(250);
        $(this).parent().parent().parent().find('.field-mcustom').slideUp('fast');
    } else if ($(this).val() === 'custom') {
        $(this).parent().parent().parent().find('.field-mcustom').slideDown(250);
        $(this).parent().parent().parent().find('.field-mcats_layout').slideUp('fast');
    } else {
        $(this).parent().parent().parent().find('.field-mcustom').slideUp('fast');
        $(this).parent().parent().parent().find('.field-mcats_layout').slideUp('fast');
    }
});

$(document).on('click mouseover', '.mom_select_icon_menu', function(){        
    if ( $.isFunction($.mom_load_menu_icons)) { 
        $.mom_load_menu_icons();
    }               
});

$(document).on('mouseover', '.edit-menu-item-mtype', function(){        
    if ( $.isFunction($.mom_mega_menus_type)) { 
        $.mom_mega_menus_type();
    }               
});

});