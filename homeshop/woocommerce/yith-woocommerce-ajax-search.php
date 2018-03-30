<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Search
 * @version 1.1.1
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly


wp_enqueue_script('yith_wcas_jquery-autocomplete' );

?>

<div class="row sidebar-box">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="sidebar-box-content">


<div class="yith-ajaxsearchform-container" style="padding: 20px;" >
<form role="search" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
    <div>
       
        <input style="border: 1px solid #e6e6e6; margin: 0 0 5px; width: 90%; padding: 10px;" type="search" value="<?php echo get_search_query() ?>" name="s" id="yith-s" placeholder="<?php echo get_option('yith_wcas_search_input_label') ?>" />
        <input type="submit" id="yith-searchsubmit" value="<?php echo get_option('yith_wcas_search_submit_label') ?>" />
        <input type="hidden" name="post_type" value="product" />
    </div>
</form>
</div>


</div>
</div>


<script type="text/javascript">
jQuery(function($){
    var search_loader_url = <?php echo apply_filters('yith_wcas_ajax_search_icon', 'woocommerce_params.ajax_loader_url') ?>;

    $('#yith-s').autocomplete({
        minChars: <?php echo get_option('yith_wcas_min_chars') * 1; ?>,
        appendTo: '.yith-ajaxsearchform-container',
        serviceUrl: woocommerce_params.ajax_url + '?action=yith_ajax_search_products',
        onSearchStart: function(){
            $(this).css('background', 'url('+search_loader_url+') no-repeat right center');
        },
        onSearchComplete: function(){
            $(this).css('background', 'transparent');
        },
        onSelect: function (suggestion) {
            if( suggestion.id != -1 ) {
                window.location.href = suggestion.url;
            }
        }
    });
});
</script>


</div>

