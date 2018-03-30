<?php
    $woo_page_id = '';
    if (is_shop()) {
	$woo_page_id = get_option('woocommerce_shop_page_id');
    } elseif (is_cart()) {
	$woo_page_id = get_option('woocommerce_cart_page_id');
    } elseif (is_checkout()) {
	$woo_page_id = get_option('woocommerce_checkout_page_id');
    } elseif (is_account_page()) {
	$woo_page_id = get_option('woocommerce_myaccount_page_id');
    } else {
	$woo_page_id = get_option('woocommerce_shop_page_id');
    }
    //Page settings
    $d_breacrumb = get_post_meta($woo_page_id, 'mom_disbale_breadcrumb', true);
    $hpt = get_post_meta($woo_page_id, 'mom_hide_pagetitle', true);
    $PS = get_post_meta($woo_page_id, 'mom_page_share', true);
    $PC = get_post_meta($woo_page_id, 'mom_page_comments', true);
    //Page Layout
    $custom_page = get_post_meta($woo_page_id, 'mom_custom_page', true);
    $layout = get_post_meta($woo_page_id, 'mom_page_layout', true);
    $right_sidebar = get_post_meta($woo_page_id, 'mom_right_sidebar', true);
    $left_sidebars = get_post_meta($woo_page_id, 'mom_left_sidebar', true);
    
?>
<?php get_header(); ?>
    <div class="inner">
        <?php if ($layout == 'fullwidth') { ?>
                <?php if ($d_breacrumb != true) { ?>
                <div class="category-title">
                        <div class="mom_breadcrumb"><?php woocommerce_breadcrumb(); ?></div>
                </div>
                <?php } ?>
                <?php if ($custom_page) { ?>
			<?php woocommerce_content(); ?>
                <?php } else { ?>
                        <div class="base-box page-wrap">
                        <?php if ($hpt != true) { ?><h1 class="page-title"><?php woocommerce_page_title(); ?></h1><?php } ?>
			<?php woocommerce_content(); ?>
			</div> <!-- base box -->
                <?php } // end cutom page  ?>
        <?php } else { //if not full width ?>
            <div class="main_container">
           <div class="main-col">
                <?php if ($d_breacrumb != true) { ?>
                <div class="category-title">
                        <div class="mom_breadcrumb"><?php woocommerce_breadcrumb(); ?></div>
                </div>
                <?php } ?>
<?php if ($custom_page) { ?>
			<?php woocommerce_content(); ?>
<?php } else { ?>
        <div class="base-box page-wrap">
           <?php if ($hpt != true) { ?><h1 class="page-title"><?php woocommerce_page_title(); ?></h1><?php } ?>
			<?php woocommerce_content(); ?>
        </div> <!-- base box -->
        <?php if ($PC == true) comments_template(); ?>        
<?php } ?>
            </div> <!--main column-->
            <?php get_sidebar('secondary'); ?>
            <div class="clear"></div>
</div> <!--main container-->            
<?php get_sidebar(); ?>
<?php }// end full width ?>             
</div> <!--main inner-->
            
<?php get_footer(); ?>