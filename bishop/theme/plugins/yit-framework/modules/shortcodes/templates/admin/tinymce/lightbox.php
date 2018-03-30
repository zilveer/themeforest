<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Add new field for contact customize panel.
 *
 * Page for adding new field to contact module.
 *
 * @package Yithemes
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

YIT_Shortcodes()->shortcodes = apply_filters( 'yit-admin-shortcodes', YIT_Shortcodes()->shortcodes );

@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));

?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php do_action( 'admin_xml_ns' ); ?> <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php echo get_option( 'blog_charset' ); ?>" />
    <title><?php _e( "Add shortcode", 'yit' ) ?></title>
    <?php  global $sitepress; if( isset($sitepress) ) : ?>
        <script type="text/javascript">
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
    <?php endif; ?>
    <?php
    wp_admin_css( 'wp-admin', true );

    wp_enqueue_style( 'yit_tinymce', YIT_Shortcodes()->plugin_url . '/assets/css/tinymce.css' );
    wp_print_styles( 'colors-admin' );
    wp_print_styles( 'buttons' );
    wp_print_scripts( 'jquery' );
    wp_print_scripts( 'thickbox' );

    // Color Picker
    wp_enqueue_style( 'wp-color-picker' );
    wp_print_scripts( 'wp-color-picker' );
    wp_enqueue_style( 'yit-color-picker', YIT_Shortcodes()->plugin_url . '/assets/css/colorpicker.css' );
    wp_enqueue_style( 'yit-font-awesome', $this->plugin_assets_url . '/css/font-awesome.min.css', false, '', 'all' );

    do_action('yit_lightbox_style');
    wp_enqueue_script( 'spinner', YIT_Shortcodes()->plugin_url. '/assets/js/jquery.spinner.js', '1', true );

    remove_action('admin_print_styles', array( 'WC_Name_Your_Price_Admin', 'add_help_tab' ), 20);

  
    do_action('admin_print_styles');
    do_action('admin_print_scripts');
    do_action('admin_head');
    ?>
    <style type="text/css">
        html, body { min-height:100%; height:inherit; background: #fff; }
        body { padding:10px; }
    </style>
</head>
<body id="media-upload">

<div id="media-upload-header">
    <label class="css-mce-label"><?php _e( 'Filter Shortcodes', 'yit' ) ?></label>
    <input type="text" name="filter" value="" placeholder="<?php _e( 'Filter Shortcodes', 'yit' ) ?>" />
</div>

<div id="shortcode-back">
    <label class="shortcode-back"><?php _e( 'Back to shortcodes list', 'yit' ) ?></label>
</div>

<div id="media-shortcodes">
    <?php $tabs = '';
    foreach( YIT_Shortcodes()->shortcodes as $shortcode => $atts ): if( empty( $atts ) ){ continue; }?>
        <?php if( ! isset( $atts['hide'] ) ) :?>
            <div class="shortcode <?php echo $atts['tab']; ?>" id="shortcode-<?php echo $shortcode ?>" title="<?php echo $atts['description'] ?>">
                <img src="<?php echo YIT_Shortcodes()->shortcode_icon( $shortcode ) ?>" alt="" width="78" height="78" />
                <span class="shortcode-title"><?php echo $atts['title'] ?></span>
                <input type="hidden" name="shortcode[<?php echo $shortcode ?>]" value='<?php echo YIT_Shortcodes()->shortcode_print_code( $shortcode ) ?>' />
            </div>
            <?php echo YIT_Shortcodes()->shortcode_print_form( $shortcode ); ?>
            <?php $tabs[] = $atts['tab']; ?>
        <?php endif; ?>
    <?php endforeach ?>
</div>

<div id="shortcode-tab">
    <ul id="sidemenu">
        <?php foreach ($name_tab as $tab => $name) : ?>
            <li id=""><a id="show-<?php echo $tab; ?>" href="#"><?php echo $name; ?></a></li>
        <?php endforeach; ?>
    </ul>

</div>


<script type="text/javascript">
    jQuery(document).ready(function($){
        $('input[name=filter]').keyup(function(){
            var filter = $(this).val(), count = 0;

            $(".shortcode").each(function(){
                if ($(this).find('span:visible').text().search(new RegExp(filter, "i")) < 0) {
                    if ($(this).is(':visible')) $(this).addClass('ripristina');
                    $(this).fadeOut();
                } else {
                    if ($(this).hasClass('ripristina')) {
                        $(this).removeClass('ripristina');
                        $(this).fadeIn();
                        count++;
                    }
                }
            });
        });

        //dependencies handler
        $('[data-field]').each(function(){
            var t = $(this);

            var field = '#' + t.data('field'),
                dep = '#' + t.data('dep'),
                value = t.data('value');

            $(dep).on('change', function(){
                dependencies_handler( field, dep, value.toString(), true );
            }).change();
        });

        $('#shortcode-tab a').click(function(){
            var filter = $(this).text();
            $('#media-upload-header').children('.css-mce-label').text('<?php _e('Filter ', 'yit') ?>' + filter);
            $('#media-upload-header').children('input').attr('placeholder', '<?php _e('Filter ', 'yit') ?>' + filter);
            $('#shortcode-tab a').removeClass('current');
            $(this).addClass('current');
            $('.shortcode').fadeOut('slow');
            var show = $(this).attr('id').replace('show-','');
            $('.shortcode.' + show).fadeIn('slow');
            $('.shortcode-back').attr('id', 'back-' + show);
            return false;
        }).filter(':first').click();

        $(document).on('click', '.shortcode', function(){
            $('.shortcode').hide();
            $('#shortcode-tab').hide();
            $('#media-upload-header').hide('slow');
            $('#shortcode-back').show();
            var sc = $(this).attr('id').replace('shortcode-','');
            $('#form-' + sc).fadeIn('slow');
        });

        $(document).on('click', '.shortcode-back', function(){
            $('.yit-shortcodes-form').hide('slow');
            $('#shortcode-back').hide('slow');
            $('#shortcode-tab').show();
            $('#media-upload-header').show('slow');
            var back = $(this).attr('id').replace('back-','');
            $('#shortcode-tab a').filter('#show-' + back).click();
        });

        $(document).on('click', 'a.add-more-fields', function(){
            $('.more-fields').before('<div class="line-sep" style=""></div>');

            $(this).parents('div.yit-shortcodes-form').children('span.multiple').each(function(){

                var copy = $(this).removeClass('multiple').html();

                var class_name = $(this).find('input[name^=shortcode]').attr('class')!= null ? $(this).find('input[name^=shortcode]').attr('class') .trim() : '' ;

                if ( class_name != 'number' && $(this).find('input[name^=shortcode]').attr('type') == 'text' ){

                    var name = $(this).find('input[name^=shortcode]').attr('name').replace('shortcode-', '');
                    var number = name.match(/\d/g).join('');
                    var name_no = name.replace(number, '')
                    copy = copy.replace('for="' + name + '-', 'for="' + name_no + (Number(number) + 1) + '-' );
                    copy = copy.replace('id="' + name + '-', 'id="' + name_no + (Number(number) + 1) + '-' );
                    copy = copy.replace('shortcode-' + name, 'shortcode-' + name_no + (Number(number) + 1) );
                    copy = copy.replace('$(\'#' + name + '-', '$(\'#' + name_no + (Number(number) + 1) + '-');

                }
                else if ( $(this).find('input[name^=shortcode]').attr('type') == 'text' && class_name == 'number' ){

                    var name = $(this).find('input[name^=shortcode]').attr('name').replace('shortcode-', '');

                    var number = name.match(/\d/g).join('');
                    var name_no = name.replace(number, '');

                    copy = copy.replace('for="' + name + '-', 'for="' + name_no + (Number(number) + 1) + '-' );
                    copy = copy.replace('id="' + name + '-', 'id="' + name_no + (Number(number) + 1) + '-' );
                    copy = copy.replace('id="' + name + '-', 'id="' + name_no + (Number(number) + 1) + '-' );
                    copy = copy.replace('shortcode-' + name, 'shortcode-' + name_no + (Number(number) + 1) );
                    copy = copy.replace('$(\'#' + name + '-', '$(\'#' + name_no + (Number(number) + 1) + '-');
                    copy = copy.replace('<div class="spinner-wrapper">', '');
                    copy = copy.replace('<button class="button-plus spinner-button">+</button><button class="button-minus spinner-button">-</button></div>', '');
                    copy = copy.replace('<button class="button-plus spinner-button" style="">+</button><button class="button-minus spinner-button" style="">-</button></div>', '');

                }
                else if ( $(this).find('select[name^=shortcode]') ){

                    var name = $(this).find('select[name^=shortcode]').attr('name').replace('shortcode-', '');
                    var number = name.match(/\d/g).join('');
                    var name_no = name.replace(number, '')
                    copy = copy.replace('for="' + name + '-', 'for="' + name_no + (Number(number) + 1) + '-' );
                    copy = copy.replace('id="' + name + '-', 'id="' + name_no + (Number(number) + 1) + '-' );
                    copy = copy.replace('shortcode-' + name, 'shortcode-' + name_no + (Number(number) + 1) );

                }

                $('.more-fields').before('<span class="multiple">' + copy + '</span>');
            });

            $(document).trigger('yit_shortcodes_add_more_fields');

            return false;
        });

        var spinner = function(){
            $('.yit-shortcodes-form .number').each(function(){
                $(this).spinner({
                    min: $(this).data('min'),
                    max: $(this).data('max'),
                    interval: 1,
                    defaultValue: $(this).data('std')
                });
            });
        };
        spinner();




        $(document).on('yit_shortcodes_add_more_fields', spinner);


//        function insertContent (content, canvas) {
//            var sel, startPos, endPos, scrollTop, text;
//            console.log(canvas);
//
//            if ( !canvas ) {
//                console.log('esco');
//                return false;
//            }
//
//            if ( parent.document.selection ) { //IE
//                console.log('selection');
//                canvas.focus();
//                sel = parent.document.selection.createRange();
//                sel.text = content;
//                canvas.focus();
//            } else if ( canvas.selectionStart || canvas.selectionStart === 0 ) { // FF, WebKit, Opera
//                console.log('selectionStart');
//                text = canvas.value;
//                startPos = canvas.selectionStart;
//                endPos = canvas.selectionEnd;
//                scrollTop = canvas.scrollTop;
//
//                canvas.value = text.substring(0, startPos) + content + text.substring(endPos, text.length);
//
//                canvas.focus();
//                canvas.selectionStart = startPos + content.length;
//                canvas.selectionEnd = startPos + content.length;
//                canvas.scrollTop = scrollTop;
//            } else {
//
//                canvas.value += content;
//
//
//                $(canvas).focus();
//                console.log('aggiungo');
//            }
//            return true;
//        };

        $(document).on('click', '.button-primary', function(){

            //$(this).find('input[name^=shortcode]').val();
            var sc_id = $(this).parents('div.yit-shortcodes-form').attr('id');

            var sc_name = $('#' + sc_id).find('input[name=sc_name]').val();
            var code = $('input[name=code-' + sc_name + ']').val();
            var str = '';
            if ( code == undefined ) {
                str = '[' + sc_name + ' ';

                $('#' + sc_id).find('input[name^=shortcode]').each(function(){
                    var t = $(this).parents('[id$=-container]');
                    var use_field = true;

                    if( t.data('field') != undefined ){
                        var field = '#' + t.data('field'),
                            dep = '#' + t.data('dep'),
                            value = t.data('value');

                        use_field = dependencies_handler( field, dep, value.toString(), false );
                    }

                    if(use_field){
                        if ( $(this).attr('type') == 'checkbox' ){
                            if ($(this).prop('checked'))
                                str = str + $(this).attr('name').replace('shortcode-', '') + '="yes" ';
                            else
                                str = str + $(this).attr('name').replace('shortcode-', '') + '="no" ';
                        }

                        if ( $(this).attr('type') == 'text' ){
                            str = str + $(this).attr('name').replace('shortcode-', '') + '="' + $(this).val() + '" ';
                        }
                    }

                });

                $('#' + sc_id).find('select[name^=shortcode]').each(function(){
                    var t = $(this).parents('[id$=-container]');
                    var use_field = true;

                    if( t.data('field') != undefined ){
                        var field = '#' + t.data('field'),
                            dep = '#' + t.data('dep'),
                            value = t.data('value');

                        use_field = dependencies_handler( field, dep, value.toString(), false );
                    }

                    if(use_field){
                        str = str + $(this).attr('name').replace('shortcode-', '') + '="' + $(this).val() + '" ';
                    }
                });

                var list = '';
                $('#' + sc_id).find('.checklist').each(function(){
                    var t = $(this).parents('[id$=-container]');
                    var use_field = true;

                    if( t.data('field') != undefined ){
                        var field = '#' + t.data('field'),
                            dep = '#' + t.data('dep'),
                            value = t.data('value');

                        use_field = dependencies_handler( field, dep, value.toString(), false );
                    }

                    if(use_field){
                        str = str + $(this).find('input[name^=list][type="checkbox"]').attr('name').replace('list-', '') + '="' ;
                        $(this).find('input[name^="list"][type="checkbox"]').each(function(){
                            if ($(this).is(':checked'))
                                str = str + $(this).val() + ', ';
                        });
                        str = str + '" ';
                    }
                });

                str = str + ']';

                // content
                $('#' + sc_id).find('textarea[name^=shortcode]').each(function(){
                    str = str + $(this).val();
                    str = str + '[/' + sc_name + ']';
                });
            }
            else{
                str = code;
            }


            var wpActiveEditor, editor, hasQuicktags = typeof parent.QTags !== 'undefined', hasTinymce = typeof parent.tinyMCE !== 'undefined';
            var win = window.dialogArguments || opener || parent || top;

            if ( ! wpActiveEditor ) {
                if ( hasTinymce && parent.tinyMCE.activeEditor ) {
                    editor = parent.tinyMCE.activeEditor;
                    wpActiveEditor = editor.id;
                } else if ( ! hasQuicktags ) {
                    return false;
                }
            } else if ( hasTinymce ) {
                editor = parent.tinyMCE.get( wpActiveEditor );
            }

            if ( editor && ! editor.isHidden() ) {
                editor.execCommand( 'mceInsertContent', false, str );
            } else if ( hasQuicktags ) {
//               console.log(parent.QTags);
                parent.QTags.insertContent( str );
               // insertContent(str, $('#'+wpActiveEditor, parent.document).get() );
            } else {
                parent.getElementById( wpActiveEditor ).value += str;
            }


            parent.tb_remove();
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

            $(this).parent().children('span').replaceWith('<span>' + value + '</span>');
        };
        $('.select_wrapper select').each(select_value);
        $(document).on('change', '.select_wrapper select', select_value);

        //Open select multiple
        var multiple_select_handler = function(){
            //Clears previous events
            $('.select_wrapper').off( 'click' );

            $('.select_wrapper').click( function(e){
                e.stopPropagation();
                $(this).find('select[multiple]').toggle();
            });
            //Stops click propagation on select, to prevent select hide
            $('.select_wrapper select[multiple]').click( function(e){
                e.stopPropagation();
            });
            //Hides select on window click
            $(window).click(function(){
                $('select[multiple]').hide();
            })
        };

        multiple_select_handler();

        $(document).on('yit_shortcodes_add_more_fields', multiple_select_handler);

    });

    function dependencies_handler ( id, deps, values, hide_fields ) {
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
        } else { //Multiple dependencies
            //@TODO
        }

        if(hide_fields){
            if( !result ) {
                $( id + '-container' ).hide();
            } else {
                $( id + '-container' ).show();
            }
        }
        return result;
    };
</script>

</body>
</html>