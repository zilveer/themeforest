<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Search
 * @version 1.0.0
 */
if ( !defined( 'YITH_WCAS' ) ) {
    exit;
} // Exit if accessed directly


wp_enqueue_script( 'yith_wcas_jquery-autocomplete' );
$rand_id = rand();
?>
<div class="yith-ajaxsearchform-container">
    <div id="sb-search" class="sb-search">
        <form role="search" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/' ) ) ?>">
            <label class="screen-reader-text" for="yith-s"><?php _e( 'Search for:', 'commercegurus' ) ?></label>
            <input class="sb-search-input" type="search" value="<?php echo get_search_query() ?>" name="s" id="yith-s" placeholder="<?php _e( 'Search for products', 'commercegurus' ); ?>" />
            <input class="sb-search-submit" type="submit" id="yith-searchsubmit" value="<?php _e( 'Search for products', 'commercegurus' ); ?>" />
            <input type="hidden" name="post_type" value="product" />
        </form>
    </div>
</div>
<script type="text/javascript">
    jQuery( function( $ ) {
        var fetching_url = '<?php echo get_template_directory_uri(); ?>/images/fetching.gif';
        $( '#yith-s' ).yithautocomplete( {
            minChars: <?php echo get_option( 'yith_wcas_min_chars' ) * 1; ?>,
            appendTo: '.yith-ajaxsearchform-container',
            serviceUrl: woocommerce_params.ajax_url + '?action=yith_ajax_search_products',
            onSearchStart: function() {
                $( this ).css( 'background',
                        'url(' + fetching_url + ') #fff no-repeat 80% 50%' );
            },
            onSearchComplete: function() {
                $( this ).css( 'background', '#fff' );
            },
            onSelect: function( suggestion ) {
                if ( suggestion.id != - 1 ) {
                    window.location.href = suggestion.url;
                }
            }
        } );
    } );
</script>