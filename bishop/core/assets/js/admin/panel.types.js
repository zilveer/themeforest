/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
jQuery(document).ready(function($){
    "use strict";

    // preview
    $('.yit-options .upload_img_url').change(function(){
        var url = $(this).val();
        var re = new RegExp("(http|ftp|https)://[a-zA-Z0-9@?^=%&amp;:/~+#-_.]*.(gif|jpg|jpeg|png|ico)");

        var preview = $(this).parent().siblings('.upload_img_preview');
        if(re.test(url)) {
            preview.html('<img src="'+url+'" style="max-width:600px; max-height:300px;" />');
        } else {
            preview.html('');
        }
    }).change();

    // refresh main color
    $('a.refresh-main-color').on( 'click', function(e){
        e.preventDefault();

        var button = $(this),
            button_text = $(this).text(),
            field_id = button.data('field_id'),
            spinner = button.next(),
            input = $( '#' + field_id + '-color');

        spinner.css( 'display', 'inline-block' );
        button.attr( 'disabled', true ).text( yit_panel_l10n.submit_loading );
        button.prev().css('opacity', 0.4);

        $.post( ajaxurl, {
            _yitnonce: yit_panel_l10n.yit_panel_refresh_color_nonce,
            field_id: field_id,
            action: 'yit-refresh-color',
            color: input.val()

        }, function( response ){
            spinner.hide();
            button.attr( 'disabled', false ).text( button_text );
            button.prev().css('opacity', '');
            $.each(response, function (id, color) {
                $( '#' + id + '-color').iris( 'color', color );
            });

        }, 'json' );
    });

    //upload
    var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;

    $(document).on('click', '.yit-options .upload_button', function(e) {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = $(this);
        var id = button.attr('id').replace('-button', '');
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){
            if ( _custom_media ) {
                console.log(id);
                if( $("#"+id).is('input[type=text]') ) {
                    $("#"+id).val(attachment.url);
                } else {
                    $("#"+id + '_custom').val(attachment.url);
                }

            } else {
                return _orig_send_attachment.apply( this, [props, attachment] );
            };
        }

        wp.media.editor.open(button);
        return false;
    });

    $('.yit-options .add_media').on('click', function(){
        _custom_media = false;
    });


    // select
    var select_value = function() {
        var value = '';

        if( $(this).attr('multiple')){
            $(this).children("option:selected").each(function(i,v){
                if( i != 0)
                    value += ', ';

                value += $(v).text();
            });

            if( value == '' ){
                $(this).children().children("option:selected").each(function(i,v){
                    if( i != 0)
                        value += ', ';

                    value += $(v).text();
                });
            }
        }
        else{
            value = $(this).children("option:selected").text();

            if( value == '' )
                value = $(this).children().children("option:selected").text();
        }


        if ( $(this).parent().find('span').length <= 0 ) {
            $(this).before('<span></span>');
        }

        $(this).parent().children('span').replaceWith('<span>'+value +'</span>');
    };

    $('.yit-options .select_wrapper select').each(select_value).change(select_value);

    //Open select multiple
    $('.yit-options .select_wrapper').click( function(e){
        e.stopPropagation();
        $(this).find('select[multiple]').toggle();
    });
    //Stops click propagation on select, to prevent select hide
    $('.yit-options .select_wrapper select[multiple]').click( function(e){
        e.stopPropagation();
    });
    //Hides select on window click
    $(window).click(function(){
        $('select[multiple]').hide();
    })


    //colorpicker
    $('.yit-options .panel-colorpicker').wpColorPicker({
        //onInit: function(){ console.log('test');},
        change: function(event, ui){
            $('#'+event.target.id).parents('.typography_container').find('.font-preview > p').css('color', ui.color.toString());
        },
        clear: function(){
            var input = $(this);
            input.val(input.data('default-color'));
            input.change();
        }
    });

    $('.yit-options .panel-colorpicker').each( function() {
        var select_label = $(this).data('variations-label');
        $(this).parent().parent().find('a.wp-color-result').attr('title', select_label);
    });


    //on-off
    $('.yit-options .onoff_container span').on('click', function(){

        var input = $( this ).prev( 'input' );
        var checked = input.prop( 'checked' );

        if( checked ) {
            input.prop( 'checked', false ).attr( 'value', 'no' ).removeClass('onoffchecked');
        } else {
            input.prop( 'checked', true ).attr( 'value', 'yes' ).addClass('onoffchecked');
        }

        input.change();
    });


    //number
    $('.yit-options .number_container .number').each(function(){
        var min = $(this).data('min') ? $(this).data('min') : null,
            max = $(this).data('max') ? $(this).data('max') : null,
            value = $(this).val();

        $(this).spinner({
            min: min,
            max: max,
            defaultValue: value,
            interval: 1
        });
    });


    //slider
    $('.yit-options .slider_container .ui-slider-horizontal').each(function(){
        var val      = $(this).data('val');
        var minValue = $(this).data('min');
        var maxValue = $(this).data('max');
        var step     = $(this).data('step');
        var labels   = $(this).data('labels');

        $(this).slider({
            value: val,
            min: minValue,
            max: maxValue,
            range: 'min',
            step: step,

            slide: function( event, ui ) {
                $(this).find('input').val( ui.value );
                $(this).siblings('.feedback').find('strong' ).text( ui.value + labels );
            }
        });
    });

    //wp editor
    $('.submit [type=submit]').on('click', function(){
        $('.wp-editor-wrap.tmce-active .switch-html').click(function(){
            $(this).addClass('yit_switch_changed');
        }).click();

        $('.yit_switch_changed').removeClass('yit_switch_changed').next().click();
    });

    //bgpreview
    $('.rm_bg-preview').each(function() {
        var self = $(this);
        var element_id = "#"+$(this).attr('id');
        if( self.find('select').val() == 'custom' || $(this).find('select').val() == '' ) {
            self.find('.bg-preview div').hide();
        }
        $(this).find('select').change(function(){
            if( $(this).val() == 'custom' || $(this).val() == '' ) {
                self.find('.bg-preview div').hide();
            } else {
                self.find('.bg-preview div').css('background-image', 'url('+$( 'option:selected', this).val()+')').show();
            }
        });


    });

    //connectedlist
    $('.rm_connectedlist').each(function(){
        var ul = $(this).find('ul');
        var input = $(this).find(':hidden');
        var sortable = ul.sortable({
            connectWith: ul,
            update: function(event, ui) {
                var value = {};

                ul.each(function(){
                    var options = {};

                    $(this).children().each(function(){
                        options[ $(this).data('option') ] = $(this).text();
                    });

                    value[ $(this).data('list') ] = options;
                });

                input.val( (JSON.stringify(value)).replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0') );
            }
        }).disableSelection();
    });

    //selecticon
    $('.rm_selecticon select').each(function(){
        var container = $(this).parents('.yit_options');
        $(this).on('change', function(){
            $('.icon-preview span', container).removeAttr('class').addClass('icon-' + $(this).val());
        });
    });

    //typography
    $('.typography_container').yit_panel_typography();

    //select-icon
    $('.select_wrapper.icon_type').on('change', function(){

        var t       = $(this);
        var parents = $('#' + t.parents('div.select_icon').attr('id'));
        var option  = $('option:selected', this).val();
        var to_show = option == 'none' ? '' : option == 'icon'  ? '.awesome_icon' : '.custom_icon';

        parents.find('.option > div:not(.icon_type)').addClass('hidden');
        parents.find( to_show ).removeClass( 'hidden' ).addClass( 'show' );
    });

    $('.select_wrapper.icon_type').trigger('change');


    // icon-list
    $('.select_wrapper.icon_list_type').on('change', function(){

        var t       = $(this);
        var parents = $('#' + t.parents('div.select_icon').attr('id'));
        var option  = $('option:selected', this).val();
        var to_show = option == 'none' ? '' : option == 'icon'  ? '.icon-manager-wrapper' : '.custom_icon';

        parents.find('.option > div:not(.icon_list_type)').addClass('hidden');
        parents.find( to_show ).removeClass( 'hidden' ).addClass( 'show' );
    });

    $('.select_wrapper.icon_list_type').trigger('change');

    var $icon_list = $('.yit-options').find('ul.icon-list-wrapper'),
        $preview = $('.icon-preview'),
        $element_list = $icon_list.find('li'),
        $icon_text = $('.icon-text');

    $element_list.on("click", function () {
        var $t = $(this);
        $element_list.removeClass('active');
        $t.addClass('active');
        $preview.attr('data-font', $t.data('font'));
        $preview.attr('data-icon', $t.data('icon'));
        $preview.attr('data-name', $t.data('name'));
        $preview.attr('data-key', $t.data('key'));

        $icon_text.val($t.data('font') + ':' + $t.data('name'));

    });


    $('.select_wrapper.skin_type').on('change', function(e){
        var t               = $( this );
        var selected_skin   = t.find('option:selected').data( 'skin_name' );
        var skin_preview    = $('.skin_image .skin_preview');
        var preview_url     = skin_preview.data( 'previewurl' );
        var new_image       = preview_url + selected_skin + '.png';
        skin_preview.fadeOut('slow', function(){

        $( '.change-theme-skin').add('.reset-theme-skin').add('#install-sample-data');

        skin_preview.attr( 'src', new_image ).fadeIn('slow');

        });
    });

    //iport-export select/deselect all

    $( '.yit_options .import_select .select_all').on( 'click', function(e){
        e.preventDefault();
        $( ' .yit_options .import_select .importcheck').attr( 'checked', true );
    });

     $( '.yit_options .import_select .deselect_all').on( 'click', function(e){
        e.preventDefault();
        $( ' .yit_options .import_select .importcheck').attr( 'checked', false );
    });

    //select sampledata
    $('#sampledata_skins_list').on('change', function(e){
        var selected_skin   = $(this).val();
        var hidden_field = $(this).parents('div.sampledata').find('#sampledata_file');
        hidden_field.val( selected_skin );
    });

    //select sample image
    $('#select_multi_link').on('change', function(e){
        var a_tag = $( this ).parents().parents().find('a.multi_link');
        a_tag.attr( 'href', $(this).val() );
    });

});
