<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Search
 * @version 1.1.1
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly

global $yith_ajax_searchform_count;
if (!isset($yith_ajax_searchform_count))
    $yith_ajax_searchform_count = 0;
$yith_ajax_searchform_count++;
?>
<div class="yith-ajaxsearchform-container_<?php echo $yith_ajax_searchform_count ?>">
<form role="search" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>" class="searchform">
    <fieldset>
        <span class="text"><input type="search" value="<?php echo get_search_query() ?>" name="s" id="yith-s_<?php echo $yith_ajax_searchform_count ?>" placeholder="<?php echo __('Search here', 'venedor'); ?>" autocomplete="off" /></span>
        <span class="button-wrap"><button id="yith-searchsubmit" class="btn btn-special" title="<?php echo __('Search', 'venedor'); ?>" type="submit"><span class="fa fa-search"></span></button></span>
        <input type="hidden" name="post_type" value="product" />
    </fieldset>
</form>
</div>
<script type="text/javascript">
jQuery(function($){
    var search_loader_url = js_venedor_vars.ajax_loader_url;

    $('#yith-s_<?php echo $yith_ajax_searchform_count ?>').<?php echo version_compare(YITH_WCAS_VERSION, '1.3.1', '>=') ? 'yithautocomplete' : 'autocomplete' ?>({
        minChars: <?php echo get_option('yith_wcas_min_chars') * 1; ?>,
        appendTo: '.yith-ajaxsearchform-container_<?php echo $yith_ajax_searchform_count ?>',
        <?php
        $admin_ajax = admin_url( 'admin-ajax.php', 'relative' );
        if (strpos($admin_ajax, '?') === false) $admin_ajax .= '?';
        else $admin_ajax .= '&';
        ?>
        serviceUrl: '<?php echo $admin_ajax ?>action=yith_ajax_search_products',
        onSearchStart: function(){
            $(this).css({
                'background-image': 'url('+search_loader_url+')',
                'background-repeat': 'no-repeat'
            });
        },
        onSearchComplete: function(){
            $(this).css({
                'background-image': 'none',
                'background-repeat': 'no-repeat'
            });
        },
        onSelect: function (suggestion) {
            if( suggestion.id != -1 ) {
                window.location.href = suggestion.url;
            }
        },
	formatResult: function (suggestion, currentValue) {
            var pattern = '(' + $.<?php echo version_compare(YITH_WCAS_VERSION, '1.3.1', '>=') ? 'YithAutocomplete' : 'Autocomplete' ?>.utils.escapeRegExChars(currentValue) + ')';
            var html = '';

            if ( typeof suggestion.img !== 'undefined' ) {
                html += suggestion.img;
            }

            html += '<div class="yith_wcas_result_content"><div class="title">';
            html += suggestion.value.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>');
            html += '</div>';

            if ( typeof suggestion.div_badge_open !== 'undefined' ) {
                html += suggestion.div_badge_open;
            }

            if ( typeof suggestion.on_sale !== 'undefined' ) {
                html += suggestion.on_sale;
            }

            if ( typeof suggestion.featured !== 'undefined' ) {
                html += suggestion.featured;
            }

            if ( typeof suggestion.div_badge_close !== 'undefined' ) {
                html += suggestion.div_badge_close;
            }

            if ( typeof suggestion.price !== 'undefined' && suggestion.price != '' ) {
                html += ' ' + suggestion.price;
            }

            if ( typeof suggestion.excerpt !== 'undefined' ) {
                html += ' ' +  suggestion.excerpt.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>');
            }

            html += '</div>';


            return html;
        }
    });
});
</script>