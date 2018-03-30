<?php
global $post, $product;

wp_enqueue_script( 'dokan-tabs-scripts' );

$post_id        = $post->ID;
$seller_id      = get_current_user_id();
$from_shortcode = false;

if ( isset( $_GET['product_id'] ) ) {
    $post_id        = intval( $_GET['product_id'] );
    $post           = get_post( $post_id );
    $product        = get_product( $post_id );
    $from_shortcode = true;
}

// bail out if not author
if ( $post->post_author != $seller_id ) {
    wp_die( __( 'Access Denied', 'mediacenter' ) );
}

$_regular_price         = get_post_meta( $post_id, '_regular_price', true );
$_sale_price            = get_post_meta( $post_id, '_sale_price', true );
$is_discount            = ( $_sale_price != '' ) ? true : false;
$_sale_price_dates_from = get_post_meta( $post_id, '_sale_price_dates_from', true );
$_sale_price_dates_to   = get_post_meta( $post_id, '_sale_price_dates_to', true );

$_sale_price_dates_from = !empty( $_sale_price_dates_from ) ? date_i18n( 'Y-m-d', $_sale_price_dates_from ) : '';
$_sale_price_dates_to   = !empty( $_sale_price_dates_to ) ? date_i18n( 'Y-m-d', $_sale_price_dates_to ) : '';
$show_schedule          = false;

if ( !empty( $_sale_price_dates_from ) && !empty( $_sale_price_dates_to ) ) {
    $show_schedule = true;
}

$_featured       = get_post_meta( $post_id, '_featured', true );
$_weight         = get_post_meta( $post_id, '_weight', true );
$_length         = get_post_meta( $post_id, '_length', true );
$_width          = get_post_meta( $post_id, '_width', true );
$_height         = get_post_meta( $post_id, '_height', true );
$_downloadable   = get_post_meta( $post_id, '_downloadable', true );
$_stock_status   = get_post_meta( $post_id, '_stock_status', true );
$_visibility     = get_post_meta( $post_id, '_visibility', true );
$_enable_reviews = $post->comment_status;

if ( ! $from_shortcode ) {
    get_header();
}
?>

<div id="main-content" class="main-content">

<?php

    /**
     *  dokan_edit_product_wrap_before hook
     *
     *  @since 2.4
     */
    do_action( 'dokan_edit_product_wrap_before', $post, $post_id );
?>

<div class="dokan-dashboard-wrap">

    <?php

        /**
         *  dokan_dashboard_content_before hook
         *  dokan_before_edit_product_content_area hook
         *
         *  @hooked get_dashboard_side_navigation
         *
         *  @since 2.4
         */
        do_action( 'dokan_dashboard_content_before' );
        do_action( 'dokan_before_edit_product_content_area' );
    ?>

    <div class="dokan-dashboard-content dokan-product-edit">

        <?php

            /**
             *  dokan_before_edit_product_inside_content_area hook
             *
             *  @since 2.4
             */
            do_action( 'dokan_before_edit_product_inside_content_area' );
        ?>

        <div class="dokan-product-edit-area">

            <header class="dokan-pro-edit-breadcrumb">
                <h1 class="dokan-header-crumb">
                    <span class="dokan-breadcrumb"><a href="<?php echo dokan_get_navigation_url( 'products' ) ?>"><?php _e( 'Products', 'mediacenter' ); ?></a> &rarr; </span>
                    <?php echo $post->post_title; ?>

                    <?php if ( $_visibility == 'hidden' ) { ?>
                        <span class="dokan-label dokan-label-default"><?php _e( 'Hidden', 'mediacenter' ); ?></span>
                    <?php } ?>

                    <?php if ( $post->post_status == 'publish' ) { ?>
                        <span class="dokan-right">
                            <a class="view-product dokan-btn dokan-btn-sm" href="<?php echo get_permalink( $post->ID ); ?>" target="_blank"><?php _e( 'View Product', 'mediacenter' ); ?></a>
                        </span>
                    <?php } ?>
                </h1>
            </header>

            <?php if ( dokan_is_seller_enabled( get_current_user_id() ) ) { ?>

                <form class="dokan-form-container" role="form" method="post">
                    <?php wp_nonce_field( 'dokan_edit_product', 'dokan_edit_product_nonce' ); ?>
                    <div class="product-edit-container dokan-clearfix">

                        <div class="dokan-product-edit-left">

                            <?php if ( isset( $_GET['message'] ) && $_GET['message'] == 'success') { ?>
                                <div class="dokan-message">
                                    <button type="button" class="dokan-close" data-dismiss="alert">&times;</button>
                                    <strong><?php _e( 'Success!', 'mediacenter' ); ?></strong> <?php _e( 'The product has been updated successfully.', 'mediacenter' ); ?>

                                    <?php if ( $post->post_status == 'publish' ) { ?>
                                        <a href="<?php echo get_permalink( $post_id ); ?>" target="_blank"><?php _e( 'View Product &rarr;', 'mediacenter' ); ?></a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <?php if ( Dokan_Template_Products::$errors ) { ?>
                                <div class="dokan-alert dokan-alert-danger">
                                    <a class="dokan-close" data-dismiss="alert">&times;</a>

                                    <?php foreach ( Dokan_Template_Products::$errors as $error) { ?>

                                        <strong><?php _e( 'Error!', 'mediacenter' ); ?></strong> <?php echo $error ?>.<br>

                                    <?php } ?>
                                </div>
                            <?php } ?>

                            <div id="tab-container" class='tab-container'> <!-- Only required for left/right tabs -->

                                <ul class="dokan_tabs">
                                    <?php
                                    $terms                   = wp_get_object_terms( $post->ID, 'product_type' );
                                    $product_type            = sanitize_title( current( $terms )->name );
                                    $variations_class        = ($product_type == 'simple' ) ? 'dokan-hide' : '';
                                    $dokan_product_data_tabs = apply_filters( 'dokan_product_data_tabs', array(

                                        'edit' => array(
                                            'label'  => __( 'Edit', 'mediacenter' ),
                                            'target' => 'edit-product',
                                            'class'  => array( 'active' ),
                                        ),
                                        'options' => array(
                                            'label'  => __( 'Options', 'mediacenter' ),
                                            'target' => 'product-options',
                                            'class'  => array(),
                                        ),
                                        'inventory' => array(
                                            'label'  => __( 'Inventory', 'mediacenter' ),
                                            'target' => 'product-inventory',
                                            'class'  => array(),
                                        ),
                                        'shipping' => array(
                                            'label'  => __( 'Shipping', 'mediacenter' ),
                                            'target' => 'product-shipping',
                                            'class'  => array(),
                                        ),
                                        'attributes' => array(
                                            'label'  => __( 'Attributes', 'mediacenter' ),
                                            'target' => 'product-attributes',
                                            'class'  => array(),
                                        ),
                                        'variations' => array(
                                            'label'  => __( 'Variations', 'mediacenter' ),
                                            'target' => 'product-variations',
                                            'class'  => array( 'show_if_variable', $variations_class ),
                                        ),

                                    ) );

                                    foreach ( $dokan_product_data_tabs as $key => $tab ) { ?>
                                        <li class="<?php echo $key; ?>_options <?php echo $key; ?>_tab <?php echo implode( ' ' , $tab['class'] ); ?>">
                                            <a href="#<?php echo $tab['target']; ?>" data-toggle="tab"><?php echo esc_html( $tab['label'] ); ?></a>
                                        </li>
                                    <?php
                                    }

                                    do_action( 'dokan_product_data_panel_tabs' );
                                    ?>

                                </ul>

                                <div id="tabs_container">
                                    <div id="edit-product">

                                        <?php do_action( 'dokan_product_edit_before_main' ); ?>

                                        <div class="dokan-clearfix">
                                            <div class="content-half-part">
                                                <div class="dokan-feat-image-upload">
                                                    <?php
                                                    $wrap_class        = ' dokan-hide';
                                                    $instruction_class = '';
                                                    $feat_image_id     = 0;

                                                    if ( has_post_thumbnail( $post_id ) ) {
                                                        $wrap_class        = '';
                                                        $instruction_class = ' dokan-hide';
                                                        $feat_image_id     = get_post_thumbnail_id( $post_id );
                                                    }
                                                    ?>

                                                    <div class="instruction-inside<?php echo $instruction_class; ?>">
                                                        <input type="hidden" name="feat_image_id" class="dokan-feat-image-id" value="<?php echo $feat_image_id; ?>">

                                                        <i class="fa fa-cloud-upload"></i>
                                                        <a href="#" class="dokan-feat-image-btn btn btn-sm"><?php _e( 'Upload a product cover image', 'mediacenter' ); ?></a>
                                                    </div>

                                                    <div class="image-wrap<?php echo $wrap_class; ?>">
                                                        <a class="close dokan-remove-feat-image">&times;</a>
                                                        <?php if ( $feat_image_id ) { ?>
                                                            <?php echo get_the_post_thumbnail( $post_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array( 'height' => '', 'width' => '' ) ); ?>
                                                        <?php } else { ?>
                                                            <img height="" width="" src="" alt="">
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="content-half-part">

                                                <div class="dokan-form-group">
                                                    <input type="hidden" name="dokan_product_id" value="<?php echo $post_id; ?>">
                                                    <?php dokan_post_input_box( $post_id, 'post_title', array( 'placeholder' => 'Product name..', 'value' => $post->post_title ) ); ?>
                                                </div>

                                                <div class="show_if_simple dokan-clearfix">
                                                    <div class="dokan-form-group">
                                                        <div class="dokan-input-group">
                                                            <span class="dokan-input-group-addon"><?php echo get_woocommerce_currency_symbol(); ?></span>
                                                            <?php dokan_post_input_box( $post_id, '_regular_price', array( 'placeholder' => '0.00' ) ); ?>
                                                        </div>
                                                    </div>


                                                    <div class="discount-price">
                                                        <label>
                                                            <input type="checkbox" <?php checked( $is_discount, true ); ?> class="_discounted_price" name="_discounted_price"> <?php _e( 'Enable Discounted Price', 'mediacenter' ); ?>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="show_if_simple">
                                                    <div class="special-price-container<?php echo $is_discount ? '' : ' dokan-hide'; ?>">
                                                        <div class="dokan-form-group dokan-clearfix">
                                                            <div class="dokan-input-group dokan-left" style="width:55%">
                                                                <span class="dokan-input-group-addon"><?php echo get_woocommerce_currency_symbol(); ?></span>
                                                                <?php dokan_post_input_box( $post_id, '_sale_price', array( 'placeholder' => __( 'Special Price', 'mediacenter' ) ) ); ?>
                                                            </div>

                                                            <div class="dokan-right">
                                                                <a href="#" class="sale-schedule dokan-right"><?php _e( 'Schedule', 'mediacenter' ); ?></a>
                                                            </div>
                                                        </div>

                                                        <div class="sale-schedule-container<?php echo $show_schedule ? '' : ' dokan-hide'; ?>">
                                                            <div class="dokan-form-group">
                                                                <div class="dokan-input-group">
                                                                    <span class="dokan-input-group-addon"><?php _e( 'From', 'mediacenter' ); ?></span>
                                                                    <input type="text" name="_sale_price_dates_from" class="dokan-form-control datepicker" value="<?php echo esc_attr( $_sale_price_dates_from ); ?>" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="YYYY-MM-DD">
                                                                </div>
                                                            </div>

                                                            <div class="dokan-form-group">
                                                                <div class="dokan-input-group">
                                                                    <span class="dokan-input-group-addon"><?php _e( 'To', 'mediacenter' ); ?></span>
                                                                    <input type="text" name="_sale_price_dates_to" class="dokan-form-control datepicker" value="<?php echo esc_attr( $_sale_price_dates_to ); ?>" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="YYYY-MM-DD">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- .show_if_simple -->


                                                <div class="dokan-form-group">
                                                    <?php dokan_post_input_box( $post_id, 'post_excerpt', array( 'placeholder' => 'Short description about the product...', 'value' => $post->post_excerpt ), 'textarea' ); ?>
                                                </div>

                                                <?php if ( dokan_get_option( 'product_category_style', 'dokan_selling', 'single' ) == 'single' ): ?>
                                                    <div class="dokan-form-group">

                                                        <?php
                                                        $product_cat = -1;
                                                        $term = array();
                                                        $term = wp_get_post_terms( $post_id, 'product_cat', array( 'fields' => 'ids') );

                                                        if ( $term ) {
                                                            $product_cat = reset( $term );
                                                        }
                                                        
                                                        $category_args = array(
                                                            'show_option_none' => __( '- Select a category -', 'mediacenter' ),
                                                            'hierarchical'     => 1,
                                                            'hide_empty'       => 0,
                                                            'name'             => 'product_cat',
                                                            'id'               => 'product_cat',
                                                            'taxonomy'         => 'product_cat',
                                                            'title_li'         => '',
                                                            'class'            => 'product_cat dokan-form-control chosen',
                                                            'exclude'          => '',
                                                            'selected'         => $product_cat,
                                                        );

                                                        wp_dropdown_categories( apply_filters( 'dokan_product_cat_dropdown_args', $category_args ) );
                                                ?>
                                                    </div>
                                                <?php elseif ( dokan_get_option( 'product_category_style', 'dokan_selling', 'single' ) == 'multiple' ): ?>
                                                    <div class="dokan-form-group dokan-list-category-box">
                                                        <h5><?php _e( 'Choose a category', 'mediacenter' );  ?></h5>
                                                        <ul class="dokan-checkbox-cat">
                                                            <?php
                                                            $term = array();
                                                            $term = wp_get_post_terms( $post_id, 'product_cat', array( 'fields' => 'ids') );

                                                            include_once DOKAN_LIB_DIR.'/class.category-walker.php';
                                                            wp_list_categories(array(
                                                                'walker'       => new DokanCategoryWalker(),
                                                                'title_li'     => '',
                                                                'id'           => 'product_cat',
                                                                'hide_empty'   => 0,
                                                                'taxonomy'     => 'product_cat',
                                                                'hierarchical' => 1,
                                                                'selected'     => $term
                                                            ));
                                                            ?>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="dokan-form-group">

                                                        <?php

                                                        require_once DOKAN_LIB_DIR.'/class.tag-walker.php';

                                                        $term = wp_get_post_terms( $post_id, 'product_tag', array( 'fields' => 'ids') );
                                                        $selected = ( $term ) ? $term : array();
                                                        $drop_down_tags = wp_dropdown_categories( array(
                                                            'show_option_none' => __( '', 'mediacenter' ),
                                                            'hierarchical'     => 1,
                                                            'hide_empty'       => 0,
                                                            'name'             => 'product_tag[]',
                                                            'id'               => 'product_tag',
                                                            'taxonomy'         => 'product_tag',
                                                            'title_li'         => '',
                                                            'class'            => 'product_tags dokan-form-control',
                                                            'exclude'          => '',
                                                            'selected'         => $selected,
                                                            'echo'             => 0,
                                                            'walker'           => new Dokan_Walker_Tag_Multi()
                                                        ) );

                                                        echo str_replace( '<select', '<select data-placeholder="' . __( 'Select product tags', 'mediacenter' ) . '" multiple="multiple" ', $drop_down_tags );

                                                        ?>
                                                </div>

                                            </div>
                                        </div>
                                        
                                        <div class="dokan-rich-text-wrap">
                                            <div>
                                                <?php wp_editor( $post->post_content , 'post_content', array('editor_height' => 50, 'quicktags' => false, 'media_buttons' => false, 'teeny' => false, 'editor_class' => 'post_content') ); ?>
                                            </div>
                                        </div>

                                        <?php do_action( 'dokan_product_edit_after_main' ); ?>

                                    </div> <!-- #edit-product -->

                                    <div id="product-options">

                                        <?php dokan_get_template_part( 'products/edit/options', '', array( 'pro' => true, 'post' => $post, 'post_id' => $post_id ) ); ?>
                                        <?php do_action( 'dokan_product_edit_after_options' ); ?>

                                    </div> <!-- #product-options -->

                                    <div id="product-inventory">

                                        <?php dokan_get_template_part( 'products/edit/inventory', '', array( 'pro' => true, 'post' => $post, 'post_id' => $post_id )  ); ?>
                                        <?php do_action( 'dokan_product_edit_after_inventory' ); ?>

                                    </div> <!-- #product-inventory -->

                                    <div id="product-shipping">

                                        <?php dokan_get_template_part( 'products/edit/shipping', '', array( 'pro' => true, 'post' => $post, 'post_id' => $post_id )  ); ?>
                                        <?php do_action( 'dokan_product_edit_after_shipping' ); ?>

                                    </div>

                                    <!-- ===== Attributes ===== -->

                                    <div class="show_if_simple" id="product-attributes">

                                        <?php
                                            dokan_get_template_part( 'products/edit/attributes', '', array( 'pro' => true, 'post' => $post, 'post_id' => $post_id )  );
                                            dokan_get_template_part( 'products/edit/templates-js', '', array( 'pro' => true, 'post' => $post, 'post_id' => $post_id )  );
                                        ?>

                                        <?php do_action( 'dokan_product_edit_after_attributes' ); ?>

                                    </div> <!-- #product-attributes -->

                                    <div class="show_if_variable" id="product-variations">

                                        <?php dokan_variable_product_type_options(); ?>

                                        <?php do_action( 'dokan_product_edit_after_variations' ); ?>

                                    </div> <!-- #product-variations -->

                                    <?php do_action( 'dokan_product_tab_content', $post, $seller_id ); ?>

                                </div> <!-- .tab-content -->
                            </div> <!-- .tabbable -->

                        </div> <!-- .col-md-7 -->

                        <!-- #################### Sidebar ######################### -->

                        <div class="dokan-product-edit-right dokan-edit-sidebar">

                            <?php dokan_get_template_part( 'products/edit/sidebar', '', array( 'pro' => true, 'post' => $post, 'post_id' => $post_id )  ); ?>

                        </div> <!-- .dokan-edit-sidebar -->
                    </div> <!-- .product-edit-container -->
                </form>

            <?php } else { ?>

                <?php dokan_seller_not_enabled_notice(); ?>

            <?php } ?>

        </div> <!-- .row -->

        <?php

            /**
             *  dokan_after_edit_product_inside_content_area hook
             *
             *  @since 2.4
             */
            do_action( 'dokan_after_edit_product_inside_content_area' );
        ?>

    </div> <!-- #primary .content-area -->

    <?php

        /**
         *  dokan_dashboard_content_after hook
         *  dokan_after_edit_product_content_area hook
         *
         *  @hooked get_dashboard_side_navigation
         *
         *  @since 2.4
         */
        do_action( 'dokan_dashboard_content_after' );
        do_action( 'dokan_after_edit_product_content_area' );
    ?>

</div><!-- .dokan-dashboard-wrap -->

<?php

    /**
     *  dokan_edit_product_wrap_after hook
     *
     *  @since 2.4
     */
    do_action( 'dokan_edit_product_wrap_after', $post, $post_id );
?>

</div>

<script>
    (function($){
        $(document).ready(function(){
            $('#tab-container').easytabs({
                animate: true,
                animationSpeed: 10,                
                updateHash: false,                         
            });
            $('#tab-container').bind('easytabs:before', function(){
                $('select.product_tags').chosen();
                $('#product_tag_chosen').css({ width: '100%' });
            });
        });
    })(jQuery)
</script>

<?php
wp_reset_postdata();

if ( ! $from_shortcode ) {
    get_footer();
}
