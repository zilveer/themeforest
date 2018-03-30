<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Search
 * @version 1.1.1
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly


$class = '';

if( defined( 'YITH_WCAS_PREMIUM' ) ) {
    wp_enqueue_script('yith_wcas_frontend' );
    $class='class="yith-search-premium"';
}

$research_post_type = ( get_option('yith_wcas_default_research') ) ? get_option('yith_wcas_default_research') : 'product';

?>

<div class="yith-ajaxsearchform-container">
    <label class="screen-reader-text" for="yith-s"><?php _e( 'Search', 'yit' ) ?></label>
    <?php


    $args = apply_filters( 'yit_ajaxsearch_form_cat_args', array(
        'menu_order'	=> 'ASC',
        'parent'        => 0,
        'hide_empty'	=> 1,
        'hierarchical'	=> 0,
        'taxonomy' => 'product_cat',
    ) );

    if( function_exists( 'yith_wcas_get_shop_categories' ) ) {
        $product_categories = yith_wcas_get_shop_categories( get_option( 'yith_wcas_show_category_list_all' ) == 'all' );
    } else {
        $product_categories     = get_categories( $args );
    }

    $selected_category = ( isset( $_REQUEST['product_cat']) ) ?  $_REQUEST['product_cat'] : '';

    if(  !empty( $product_categories ) ) : ?>
        <select class="search_categories selectbox" id="search_categories">
            <option value="" <?php selected( '', $selected_category ) ?>><?php _e( 'All', 'yit' ) ?></option>
            <?php foreach( $product_categories as $cat ): ?>
                <option value="<?php echo $cat->slug ?>" <?php selected( $cat->slug, $selected_category ) ?>><?php echo $cat->name ?></option>
            <?php endforeach; ?>
        </select>
    <?php endif ?>
<form role="search" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>" <?php echo $class ?>>
    <div>
        <input type="submit" id="yith-searchsubmit" value="<?php echo get_option('yith_wcas_search_submit_label') ?>" />
        <div class="nav-searchfield">
            <div id="nav-searchfield-container">

                <?php
                if ( get_option( 'yith_wcas_show_search_list' ) == 'yes' ):

                    $selected_search = ( isset( $_REQUEST['post_type'] ) ) ? $_REQUEST['post_type'] : $research_post_type; ?>

                    <select class="yit_wcas_post_type selectbox" id="yit_wcas_post_type" name="post_type">
                        <option value="product" <?php selected( 'product', $selected_search ) ?>><?php _e( 'Products', 'yit' ) ?></option>
                        <option value="any" <?php selected( 'any', $selected_search ) ?>><?php _e( 'All', 'yit' ) ?></option>
                    </select>

                <?php else: ?>
                    <input type="hidden" name="post_type" class="yit_wcas_post_type" id="yit_wcas_post_type" value="<?php echo $research_post_type ?>" />
                <?php endif; ?>

                <?php
                if ( get_option( 'yith_wcas_show_category_list' ) == 'yes' ):

                    $selected_category = ( isset( $_REQUEST['product_cat'] ) ) ? $_REQUEST['product_cat'] : '';

                    if ( !empty( $product_categories ) ) : ?>
                        <select class="search_categories selectbox" id="search_categories" name="product_cat">
                            <option value="" <?php selected( '', $selected_category ) ?>><?php _e( 'All', 'yit' ) ?></option>
                            <?php foreach ( $product_categories as $cat ): ?>
                                <option value="<?php echo $cat->slug ?>" <?php selected( $cat->slug, $selected_category ) ?>><?php echo $cat->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif ?>

                <?php endif ?>

                <input type="search"
                       value="<?php echo get_search_query() ?>"
                       name="s"
                       id="yith-s"
                       class="yith-s"
                       placeholder="<?php echo esc_attr( get_option('yith_wcas_search_input_label') ) ?>"
                       data-loader-icon="<?php echo esc_attr( str_replace( '"', '', apply_filters('yith_wcas_ajax_search_icon', '') ) ) ?>"
                       data-min-chars="<?php echo esc_attr( get_option('yith_wcas_min_chars') ); ?>" />
            </div>
            </div>

        <input type="hidden" id="product_cat" class="yith_wcas_produc_cat" name="product_cat" value="" />
    </div>
    <?php if ( defined( 'ICL_LANGUAGE_CODE' ) ): ?>
        <input type="hidden" name="lang" class="lang_param"  value="<?php echo( ICL_LANGUAGE_CODE ); ?>" />
    <?php endif ?>
</form>
</div>
<script type="text/javascript">
jQuery(function($){

    $.fn.setCursorToTextEnd = function() {
        var $initialVal = this.val();
        this.val($initialVal);
    };
/*
    if( $('.yith-search-premium').length ){
        return false;
    }
    */
    var search =  $('#yith-s'),
        search_loader_url = '<?php echo apply_filters('yith_wcas_ajax_search_icon', 'woocommerce_params.ajax_loader_url') ?>',
        search_categories = $('#search_categories'),
        cat = '',
        options = {
            minChars: <?php echo get_option('yith_wcas_min_chars') * 1; ?>,
            appendTo: '.yith-ajaxsearchform-container',
            serviceUrl: '<?php echo admin_url('admin-ajax.php?action=yith_ajax_search_products') ?>',
            onSearchStart: function(){

                $(this).css('background', 'url('+search_loader_url+') no-repeat right center');
                $(document).trigger('yit_ajax_search_init');


            },
            onSearchComplete: function(){
                $(this).css('background', 'transparent');
            },
            onSelect: function (suggestion) {
                if( suggestion.id != -1 ) {
                    window.location.href = suggestion.url;
                }
            }
        };

    var ac = search.yithautocomplete(options);

    if( search_categories.length ){
        search_categories.on( 'change', function( e ){
            $('.yith_wcas_produc_cat').val( search_categories.val() ) ;
            if( search_categories.val() != '' ) {
                ac.yithautocomplete( 'setOptions', { serviceUrl:  woocommerce_params.ajax_url + '?action=yith_ajax_search_products&product_cat=' + search_categories.val() });
            }else{
                ac.yithautocomplete( 'setOptions', { serviceUrl:  woocommerce_params.ajax_url + '?action=yith_ajax_search_products' });
            }
        });
    }


});
</script>