<?php global $mango_settings, $search_button_class, $filter;
include_once ( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( isset( $mango_settings[ 'mango_search_type' ] ) && $mango_settings[ 'mango_search_type' ] === 'product' && is_plugin_active ( 'yith-woocommerce-ajax-search/init.php' ) && class_exists ( 'WooCommerce' ) ) {
    global $con_class;
    $con_class = "header-search-container";
    $wc_get_template = function_exists ( 'wc_get_template' ) ? 'wc_get_template' : 'woocommerce_get_template';
    $wc_get_template( 'yith-woocommerce-ajax-search.php', array (), '', YITH_WCAS_DIR . 'templates/' );
    return;
} ?>
	<div class="header-search-container">
	<form action="<?php echo home_url(); ?>" method="get" class="search-form<?php echo $s ? ' input-visible' : ''; ?>" enctype="application/x-www-form-urlencoded">
    <div class="input-group">
<?php 
 if($mango_settings[ 'search-id' ]==1){ 
 ?>
	  <input type="text" class="form-control search-input" name="s" placeholder="<?php echo esc_attr($mango_settings[ 'search_field_placeholder' ]); ?>" value="<?php echo esc_attr($s); ?>">
       <span class="input-group-btn">
		<button class="btn<?php echo esc_attr ( $search_button_class ) ?>" type="submit">
		<i class="fa fa-search"></i></button>
       </span>
 <?php  } else{ ?>
<input type="search" class="form-control"
                   placeholder="<?php echo esc_attr($mango_settings[ 'search_field_placeholder' ]); ?>"
                   value="<?php echo get_search_query () ?>" name="s" id="s"/>
            <?php $type = $mango_settings[ 'mango_search_type' ];
            if ( !post_type_exists ( $type ) ) {
                $type = 'post';
            }
            $filter_args = array (
                'show_option_all' => __ ( 'All Categories', 'mango' ),
                'name' => 'post_cat_filter',
                'taxonomy' => 'category',
                'hide_if_empty' => true,
            );
            ?>

            <input type="hidden" name="post_type" value="<?php echo esc_attr($type) ?>"/>
            <?php $lang_code = explode ( '-', get_bloginfo ( "language" ) ); ?>
            <input type="hidden" name="lang" value="<?php echo esc_attr($lang_code[ 0 ]); ?>"/>
            <?php if ( $type == 'post' ) {
                $filter = $mango_settings[ 'mango_search_dropdown_post' ];

                if ( $filter == 'category' ) { ?>
                    <span class="input-group-addon">
                        <?php wp_dropdown_categories ( $filter_args ); ?>
                    </span>
                <?php } elseif ( $filter == 'tag' ) {
                    $filter_args = array (
                        'show_option_all' => __ ( 'All Tags', 'mango' ),
                        'name' => 'post_tag_filter',
                        'taxonomy' => 'post_tag',
                    ); ?>
                    <span class="input-group-addon">
                        <?php wp_dropdown_categories ( $filter_args ); ?>
                    </span>
                <?php }

            } elseif ( $type == 'portfolio' && $mango_settings[ 'mango_search_dropdown_portfolio' ] ) {
                $filter_args = array (
                    'show_option_all' => __ ( 'All Categories', 'mango' ),
                    'name' => 'portfolio_cat_filter',
                    'taxonomy' => 'portfolio-category',
                ); ?>
                <span class="input-group-addon">
                        <?php wp_dropdown_categories ( $filter_args ); ?>
                    </span>
            <?php } elseif ( $type == 'product' && $mango_settings[ 'mango_search_dropdown_product' ] ) {
                $filter_args = array (
                    'show_option_all' => __ ( 'All Categories', 'mango' ),
                    'name' => 'product_cat_filter',
                    'taxonomy' => 'product_cat',
                ); ?>
                <span class="input-group-addon">
                  <?php wp_dropdown_categories ( $filter_args ); ?>
                </span>
            <?php } ?>
            <span class="input-group-btn">
            <button class="btn<?php echo esc_attr ( $search_button_class ) ?>" type="submit"><i class="fa fa-search"></i></button>
            </span>
 <?php 
 }
 ?>
   </div>
        <!-- End .input-group -->
  </form>
</div><!-- End .header-search-container -->

