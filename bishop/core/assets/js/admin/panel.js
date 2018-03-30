/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
(function ($) {
    "use strict";

    var YIT_Panel = function(){};
    YIT_Panel.prototype = (function(){
        var openTab = function(elem) {
            if( !$(elem).parent().hasClass('active') ) {
                hideTabs();
                openMenu(elem);

                var tab = $(elem).attr('href');
                $(tab).fadeIn();

                //add active class to the element
                $(elem).parent().addClass('active');

                //trigger tab opened event
                //$( '#yit-content' ).trigger( 'panelLoaded' );
            }

            //if user clicked on rightmenu item
            if( $(elem).parents('.yit-rightmenu').length > 0 ) {
                var href = $(elem).attr('href');
                $(elem).parents('.yit-menu-top').find('a[href=' + href + ']').parent().addClass('active')
            }
        };

        var hideTabs = function() {
            $('.yit-box').hide();
        };

        var openMenu = function(elem) {
            $('#yit-adminmenuwrap li.active').removeClass('active');

            //if menu already opened do nothing
            if ( $(elem).parents('.yit-menu-top').hasClass( 'open' ) ) { return false; }

            //close other menus
            $('#yit-adminmenuwrap li.yit-menu-top').removeClass('open').removeClass('current');
            $('#yit-adminmenuwrap .yit-submenu.open').removeClass('open').slideUp().parent().removeClass('current');

            //open selected menu
            $(elem).parents('.yit-menu-top')
                .addClass( 'open' )
                .addClass( 'current' )
                .find( '.yit-submenu' )
                .slideDown()
                .addClass( 'open' );
        };

        var createRightMenus = function() {
            $('#yit-adminmenuwrap li.yit-has-submenu').each(function(item){
                $(this).hover(function(){
                    //if the right menu has not been created
                    if( $(this).find('.yit-rightmenu').length == 0 ) {
                        $('<div/>', {'class':'yit-rightmenu'}).html('<ul>' + $(this).find('.yit-submenu').html() + '</ul>')
                            .appendTo( $(this) );
                    }
                });
            });
        };

        //Handle dependencies.
        var dependencies_handler = function( id, deps, values ) {
            if( typeof( $ ) != 'function' )
            { var $ = jQuery; }

            var result = true;

            //Single dependency
            if( typeof( deps ) == 'string' ) {
                if( deps.substr( 0, 6 ) == ':radio' )
                { deps = deps + ':checked'; }

                var values = values.split( ',' );

                for( var i = 0; i < values.length; i++ ) {

                    if( $( deps ).val() != values[i] )
                    { result = false; }
                    else
                    { result = true; break; }
                }
            }

            if( !result ) {
                $( id + '-container' ).hide();
            } else {
                $( id + '-container' ).show();
            }
        };

        var savePanel = function( form ) {
            var data = form.serialize(),
                submit = form.find('input[type="submit"]'),
                submit_value = submit.val();

            submit.val( yit_panel_l10n.submit_loading ).attr('disabled', true);

            $.ajax({
                url: ajaxurl,
                data: data,
                type: 'POST',
                success: function(message){
                    submit.val( submit_value ).attr('disabled', false);
                    var change_theme_skin       = $('a.change-theme-skin');
                    var skin_select             = $('#' + field_id);
                    var selected_skin           = change_theme_skin.data( 'selected' );
                    var field_id                = change_theme_skin.data( 'field_id' );
                    var skin_option             = skin_select.find( 'option' );
                    var skin_option_selected    = skin_select.find( 'option:selected').val();

                    if( $( ".messages-panel" ).length == 0  ) {
                        $( "#yit-utility-bar" ).after(message);
                    }

                    if( skin_option_selected != selected_skin ){
                        skin_option.prop('selected', function() {
                                return this.defaultSelected;
                            }
                        );

                        skin_select.trigger('change');
                    }
                }
            });
        };

        var sendAjaxRequest = function( submit ){

            var data = {
                    action: submit.data('action'),
                    die: 1
                };

            $.ajax({
                beforeSend: function(){
                    submit.siblings('.spinner').css('display', 'inline-block');
                    submit.addClass('button-secondary-disabled');
                },
                complete: function(){
                    submit.siblings('.spinner').css('display', 'none');
                    submit.removeClass('button-secondary-disabled');
                },
                data: data,
                error: function(){

                },
                success: function( message ){ console.log(message);
                    if( $( ".messages-panel" ).length == 0  ) {
                        $( ".messages-global").remove();
                        $( "#yit-utility-bar" ).after(message);
                    }
                },
                type: 'POST',
                url: ajaxurl
            });
        };

        var backupRequest = function( submit, type ){

            var data        = '';
            var input_field = '';
            var file_name   = '';
            var action      = '';

            if( type == 'backup-new' ) {

                input_field = $( '#' + submit.data('action') + '-name');
                file_name   = input_field.val();
                action      = submit.data('action');

            }else if( type == 'backup-delete' ) {

                file_name   = submit.data('name');
                action      = submit.data('action');
            }else if( type == 'backup-restore' ){

                file_name   = submit.data('name');
                action      = submit.data('action');
            }

            data = {
                    action: action,
                    backup_name: file_name,
                    die: 1
                };

            $.ajax({
                beforeSend: function(){
                    var spinner_styles = {
                        "display"   : "inline-block",
                        "margin-top": "0",
                        "float"     : "none"
                    };
                    submit.siblings('.spinner').css( spinner_styles );
                    submit.addClass('button-secondary-disabled');
                },
                complete: function(){
                    submit.siblings('.spinner').css('display', 'none');
                    submit.removeClass('button-secondary-disabled');
                },
                data: data,
                error: function(){

                },
                success: function( message ){

                    if( $( ".messages-panel" ).length == 0  ) {
                        $( ".messages-global").remove();
                        $( "#yit-utility-bar" ).after(message);
                    }

                    if( type == 'backup-new' ) {

                        var new_file_name = $('#backup-temp-name').data('name');
                        $('#backup-temp-name').remove();

                        if( $('#no-backup-file').is(':visible') ){
                            $( '#no-backup-file').toggleClass('hidden');
                            $( '.yit_options.backup .yit-backup-list').toggleClass('hidden');
                        }

                        var new_field =  '<li class="yit-panel-backup-list">' +
                                            '<span class="backup-name">' + new_file_name + '</span>' +
                                            '<span class="backup-restore" data-action="yit_restore_backup" data-name="' + new_file_name + '"><i class="fa fa-rotate-left"></i></span>' +
                                            '<span class="backup-delete"  data-action="yit_delete_backup" data-name="' + new_file_name + '"><i class="fa fa-times"></i></span>' +
                                        '</li>';

                        var new_field =  '<tr class="yit-panel-backup-list">' +
                                            '<td class="backup-name">' + new_file_name + '</td>' +
                                            '<td class="backup-restore" data-action="yit_restore_backup" data-name="' + new_file_name + '"><i class="fa fa-rotate-left"></i></td>' +
                                            '<td class="backup-delete"  data-action="yit_delete_backup" data-name="' + new_file_name + '"><i class="fa fa-times"></i></td>' +
                                        '</tr>';

                        $( '.yit_options.backup .yit-backup-list').find('tbody').append( new_field );
                        input_field.val('');
                    }

                    if( type == 'backup-delete' ) {
                        submit.parent('tr').remove();
                        if( $( '.yit_options.backup .yit-backup-list tr').length == 1 ){
                            $( '.yit_options.backup .yit-backup-list').toggleClass('hidden');
                            $( '#no-backup-file').toggleClass('hidden');
                        }
                    }
                },
                type: 'POST',
                url: ajaxurl
            });
        };

        var importData = function( submit ){

            var data = {
                    action: submit.data('action'),
                    file: $('#import-file').val(),
                    upload: true,
                    die: 1
                };

            $.ajax({
                beforeSend: function(){
                },
                complete: function(){
                },
                data: data,
                error: function(){

                },
                success: function( message ){ console.log(message);
                    if( $( ".messages-panel" ).length == 0  ) {
                        $( ".messages-global").remove();
                        $( "#yit-utility-bar" ).after(message);
                    }
                },
                type: 'POST',
                url: ajaxurl
            });
        };

        var importSampleData = function( submit ){
            var sampledata_file = $('#sampledata_file').val();

            var data = {
                    action: submit.data('action'),
                    file: sampledata_file,
                    upload: false,
                    sampledata: true,
                    die: 1
                };

            $.ajax({
                beforeSend: function(){
                },
                complete: function(){
                },
                data: data,
                error: function(){

                },
                success: function( message ){
                    submit.parent().find('span.error_message').empty();
                    submit.parent().find('span.spinner').css('display', 'none');
                    if( $( ".messages-panel" ).length == 0  ) {
                        $( ".messages-global").remove();
                        $( "#yit-utility-bar" ).after(message);
                    }
                },
                type: 'POST',
                url: ajaxurl
            });
        };

        var changeSkin = function( submit ){

            var data = {
                    action: submit.data('action'),
                    general_skin: $( '#' + submit.data( 'field_id' )).val(),
                    die: 1
                };

            $.ajax({
                beforeSend: function(){
                    var spinner_styles = {
                        "display"       : "inline-block",
                        "margin-top"    : "0",
                        "float"         : "none",
                        "vertical-align": 'top'
                    };
                    submit.siblings('.spinner').css( spinner_styles );
                    submit.addClass( 'button-' + ( submit.hasClass('button-primary') ? 'primary' : 'secondary' ) + '-disabled' );
                },
                complete: function(){

                },
                data: data,
                error: function(){

                },
                success: function( message ){

                    if( $( ".messages-panel" ).length == 0  ) {
                        $( ".messages-global").remove();
                        $( "#yit-utility-bar" ).after(message);
                    }

                    location.reload();
                },
                type: 'POST',
                url: ajaxurl
            });
        };


        return {
            init : function() {
                //hide all tabs
                hideTabs();

                //create right-menus
                createRightMenus();

                $('#yit-adminmenuwrap').on('click', 'li.yit-menu-top a', function(e){
                    e.preventDefault();
                    parent.location.hash = $(this).attr('href');

                    if( $(this).parent().hasClass('yit-has-submenu') ) {
                        if ( !$(this).parent().hasClass( 'open' ) ) {
                            $(this).parent().find('li:first a').click();
                        }
                    } else {
                        openTab(this);
                    }

                    // lazyload
                    var tab = $(this).attr('href');
                    $(tab).find('.upload_img_preview img').each(function(i){
                        var src     = $(this).attr('src');
                        var dataSrc = $(this).attr('data-src');
                        if(src.indexOf('sleep.png')) $(this).attr('src', dataSrc);
                    });
                });

                if( parent.location.hash ) {
                    $('li.yit-menu-top a[href="' + parent.location.hash + '"]').click();
                } else {
                    $('li.yit-menu-top a').filter(':first').click();
                }

                //dependencies handler
                $('[data-field]').each(function(){
                    var t = $(this);

                    var field = '#' + t.data('field'),
                        dep = '#' + t.data('dep'),
                        value = t.data('value');

                    $(dep).on('change', function(){
                        dependencies_handler( field, dep, value.toString() );
                    }).change();
                });

                // save panel in AJAX
                $('form#yit_panel.ajax-save').on( 'submit', function(e){
                    e.preventDefault();
                    savePanel( $(this) );
                });

                // create backup in AJAX
                $('form#yit_panel_backup_and_reset.ajax-save input[type=submit].backup').on( 'click', function(e){
                    e.preventDefault();
                    backupRequest( $(this), 'backup-new' );
                });

                // delete cache in AJAX
                $('form#yit_panel_backup_and_reset.ajax-save input[type=submit].reset').on( 'click', function(e){
                    e.preventDefault();
                    sendAjaxRequest( $(this) );
                });

                // create backup in AJAX
                $(document).on( 'click', 'form#yit_panel_backup_and_reset.ajax-save td.backup-delete', function(e){
                    e.preventDefault();
                    var accept = confirm( backup_delete_restore.delete.replace( '%filename%', $( this ).data('name') ) );
                    if( accept ){
                        backupRequest( $(this), 'backup-delete' );
                    }
                });

                // restore backup in AJAX
                $(document).on( 'click', 'form#yit_panel_backup_and_reset.ajax-save td.backup-restore', function(e){
                    e.preventDefault();
                    var accept = confirm( backup_delete_restore.restore.replace( '%filename%', $( this ).data('name') ) );
                    if( accept ){
                        backupRequest( $(this), 'backup-restore' );
                    }
                });

                $('a.change-theme-skin, a.reset-theme-skin').on('click', function(e){
                    e.preventDefault();
                    var t = $(this);
                    var message = t.hasClass('change-theme-skin') ? skins.change : skins.reset,
                        accept = confirm( message.replace( '%skin_name%', t.parent().find('select').val() ) );

                    if( accept ){
                        changeSkin( t );
                    }
                });

                // restore backup in AJAX
                $(document).on( 'click', 'form#yit_panel_backup_and_reset.ajax-save input[type=button].import', function(e){
                    var t = $( this );
                    t.parent().find('span.error_message').empty();
                    if( 'import_data' != $( '#yit-panel-action').val() ){
                        t.parent().find('span.error_message').empty().append( backup_delete_restore.import_no_file );
                    }else{
                        var accept = confirm( backup_delete_restore.import );
                        if( accept ){
                            t.parents('form').trigger('submit');
                            t.parent().find('span.error_message').empty().append( backup_delete_restore.import_please_wait );
                            t.parent().find('span.spinner').css('display', 'inline-block');
                        }
                    }

                });

                $( "#import-file" ).on( 'change', function(){
                    if( '' != $( "#import-file").val() ){
                        $( '#yit-panel-action').val('import_data');
                        $( this ).parent().find('span.error_message').empty().css('display', 'inline-block');
                    }else{
                        $( '#yit-panel-action').val('');
                        $( this ).parent().find('span.error_message').empty().append( backup_delete_restore.import_no_file );
                    }
                });

                $(document).on( 'click', 'form#yit_panel_sample_data.ajax-save input[type=button].sampledata', function(e){
                    e.preventDefault();
                    var accept = confirm( backup_delete_restore.import );
                    if( accept ){
                        $( this ).parent().find('span.error_message').empty().append( backup_delete_restore.import_please_wait );
                        $( this ).parent().find('span.spinner').css('display', 'inline-block');
                        importSampleData( $( this ) );
                    }
                });
            }
        }
    }());

    $(function(){
        YIT_Panel = new YIT_Panel();
        YIT_Panel.init();
    });

})(jQuery);
