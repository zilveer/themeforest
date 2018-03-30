<?php
/**
 * Add new field for contact customize panel.
 *
 * Page for adding new field to contact module.
 *
 * @package Wordpress
 * @subpackage Kassyopea
 * @since 1.1
 */

@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));

?>
<html <?php if( yit_ie_version() < 9 && yit_ie_version() > 0 ) { echo 'class="ie8"'; } ?>xmlns="http://www.w3.org/1999/xhtml" <?php do_action('admin_xml_ns'); ?> <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
    <title><?php _e("Add shortcode", 'yit') ?></title>
    <?php if( isset($sitepress) ) : ?>
        <script type="text/javascript">
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
    <?php endif; ?>
    <?php
    wp_admin_css( 'wp-admin', true );

    wp_enqueue_style( 'yit_tinymce', YIT_CORE_URL . '/assets/css/tinymce.css' );
    wp_print_styles( 'colors-admin' );
    wp_print_styles( 'yiw-tinymce-insert-tool' );
    wp_print_scripts( 'jquery' );
    wp_print_scripts( 'thickbox' );

    wp_enqueue_style( 'color-picker', YIT_CORE_ASSETS_URL . '/css/colorpicker.css', false, '1.0', 'all' );
    wp_enqueue_script( 'color-picker', YIT_CORE_ASSETS_URL . '/js/colorpicker.js', '1', true );
    wp_enqueue_script( 'spinner', YIT_CORE_ASSETS_URL . '/js/jquery.spinner.js', '1', true );

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
    foreach( yit_get_model('shortcodes')->shortcodes as $shortcode=>$atts ): ?>
        <?php if (!isset($atts['hide'])) : ?>
            <div class="shortcode <?php echo $atts['tab']; ?>" id="shortcode-<?php echo $shortcode ?>" title="<?php echo $atts['description'] ?>">
                <img src="<?php echo yit_shortcode_icon($shortcode) ?>" alt="" width="78" height="78" />
                <span class="shortcode-title"><?php echo $atts['title'] ?></span>
                <input type="hidden" name="shortcode[<?php echo $shortcode ?>]" value='<?php echo yit_shortcode_print_code($shortcode) ?>' />
            </div>
            <?php echo yit_shortcode_print_form($shortcode); ?>
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

                if ( $(this).find('input[name^=shortcode]').attr('class') != 'number' && $(this).find('input[name^=shortcode]').attr('type') == 'text' ){

                    var name = $(this).find('input[name^=shortcode]').attr('name').replace('shortcode-', '');
                    var number = name.match(/\d/g).join('');
                    var name_no = name.replace(number, '')
                    copy = copy.replace('for="' + name + '-', 'for="' + name_no + (Number(number) + 1) + '-' );
                    copy = copy.replace('id="' + name + '-', 'id="' + name_no + (Number(number) + 1) + '-' );
                    copy = copy.replace('shortcode-' + name, 'shortcode-' + name_no + (Number(number) + 1) );
                    copy = copy.replace('$(\'#' + name + '-', '$(\'#' + name_no + (Number(number) + 1) + '-');

                }
                else if ( $(this).find('input[name^=shortcode]').attr('type') == 'text' && $(this).find('input[name^=shortcode]').attr('class') == 'number' ){

                    var name = $(this).find('input[name^=shortcode]').attr('name').replace('shortcode-', '');
                    var number = name.match(/\d/g).join('');
                    var name_no = name.replace(number, '')
                    copy = copy.replace('for="' + name + '-', 'for="' + name_no + (Number(number) + 1) + '-' );
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

        $(document).on('click', '.button-primary', function(){

            //$(this).find('input[name^=shortcode]').val();
            var sc_id = $(this).parents('div.yit-shortcodes-form').attr('id');

            var sc_name = $('#' + sc_id).find('input[name=sc_name]').val();
            var code = $('input[name=code-' + sc_name + ']').val();
            var str = '';
            if ( code == undefined ) {
                str = '[' + sc_name + ' ';

                $('#' + sc_id).find('input[name^=shortcode]').each(function(){
                    if ( $(this).attr('type') == 'checkbox' ){
                        if ($(this).prop('checked'))
                            str = str + $(this).attr('name').replace('shortcode-', '') + '="yes" ';
                        else
                            str = str + $(this).attr('name').replace('shortcode-', '') + '="no" ';
                    }

                    if ( $(this).attr('type') == 'text' ){
                        str = str + $(this).attr('name').replace('shortcode-', '') + '="' + $(this).val() + '" ';
                    }


                });

                $('#' + sc_id).find('select[name^=shortcode]').each(function(){
                    str = str + $(this).attr('name').replace('shortcode-', '') + '="' + $(this).val() + '" ';
                });

                var list = '';
                $('#' + sc_id).find('.checklist').each(function(){
                    str = str + $(this).find('input[name^=list][type="checkbox"]').attr('name').replace('list-', '') + '="' ;
                    $(this).find('input[name^=list][type="checkbox"]').each(function(){
                        if ($(this).is(':checked'))
                            str = str + $(this).val() + ', ';
                    });
                    str = str + '" ';
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


            var win = window.dialogArguments || opener || parent || top;
            win.send_to_editor(str);
            var ed;
            if ( typeof tinyMCE != 'undefined' && ( ed = tinyMCE.activeEditor ) && !ed.isHidden() ) {
                ed.setContent(ed.getContent());
            }

            tb_remove();
        });

        // select
        var select_value = function() {
            var value = $(this).children("option:selected").text();

            if( value == '' )
                value = $(this).children().children("option:selected").text();


            if ( $(this).parent().find('span').length <= 0 ) {
                $(this).before('<span></span>');
            }

            $(this).parent().children('span').replaceWith('<span>' + value + '</span>');
        };
        $('.select_wrapper select').each(select_value);
        $(document).on('change', '.select_wrapper select', select_value);

    });
</script>

</body>
</html>