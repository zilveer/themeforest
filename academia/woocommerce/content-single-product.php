<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$g5plus_woocommerce_single = G5Plus_Global::get_woocommerce_single();
$has_sidebar =  $g5plus_woocommerce_single['has_sidebar'];
$product_image_wrap = 'col-lg-6 col-md-5 col-sm-6 col-sm-12 margin-bottom-70 single-product-image-wrap';
$product_summary_wrap = 'col-lg-6 col-md-7 col-sm-6 col-sm-12 margin-bottom-70';
if ($has_sidebar) {
    $product_image_wrap = 'col-md-5 col-sm-6 col-sm-12 single-product-image-wrap margin-bottom-70 has-sidebar';
    $product_summary_wrap = 'col-md-7 col-sm-6 col-sm-12 margin-bottom-70';
}
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row single-product-info clearfix">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="single-product-image">
                <?php
                /**
                 * woocommerce_before_single_product_summary hook
                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked woocommerce_show_product_images - 20
                 */
                do_action( 'woocommerce_before_single_product_summary' );
                ?>

            </div>
            <?php
            $course_id = get_the_ID();
            $teacher_meta = get_post_meta( $course_id, 'teacher', false );
            $args = array(
                'orderby' => 'post__in',
                'post__in' => $teacher_meta,
                'post_type' => 'ourteacher',
                'post_status' => 'publish');

            $posts_array = new WP_Query($args);
            if($posts_array->found_posts>0) :
            ?>

            <div class="instructor-wrap">
                <h2 class="hd-block p-font">
                    <?php esc_html_e('About Instructor','g5plus-academia'); ?>
                </h2>
                <div class="owl-carousel" data-plugin-options='{"margin" : 15 ,"items" : 2, "responsive" :  {"0":{"items": 1}, "480":{"items": 1},"600":{"items": 2},"768":{"items": 2},"980":{"items": 2},"1200":{"items": 2} },"dots": false, "dotsEach" : true, "nav": false, "autoplay": true}'>
                    <?php

                        while ($posts_array->have_posts()) : $posts_array->the_post();
                            $teacher_name = get_the_title();
                            $teacher_id = get_the_ID();
                            $teacher_thumbnail_id = get_post_thumbnail_id(  $teacher_id );
                            $teacher_thumbnail = matthewruddy_image_resize_id($teacher_thumbnail_id, 100,100 );
                            $departments = wp_get_post_terms($teacher_id, array('ourteacher-category'));
                        ?>
                            <div class="instructor">
                                <img src="<?php echo esc_url($teacher_thumbnail) ?>" alt="<?php echo wp_kses_post($teacher_name); ?>">
                                <div class="info">
                                    <div class="name"><h4 class="p-font"><a href="<?php echo get_permalink($teacher_id) ?>" target="_blank"><?php echo wp_kses_post($teacher_name); ?></a></h4></div>
                                    <?php  foreach ($departments as $department) { ?>
                                        <div class="cat"><?php echo wp_kses_post($department->name) ?></div>
                                    <?php } ?>
                                    <div class="phone">
                                        <i class="fa fa-phone"></i>
                                        <?php echo get_post_meta($teacher_id, 'phone', true ) ?>
                                    </div>
                                    <div class="email">
                                        <i class="fa fa-envelope"></i>
                                        <?php echo get_post_meta($teacher_id, 'mail', true ) ?>
                                    </div>
                                    <div class="social">
                                        <ul>
                                            <?php
                                            $meta_social = get_post_meta($teacher_id, 'academia_ourteacher_social_settings', TRUE);
                                            if(isset($meta_social) && is_array($meta_social) && count($meta_social['ourteacher'])>0){
                                                foreach($meta_social['ourteacher'] as $social){ ?>
                                                    <li>
                                                        <a href="<?php echo esc_attr($social['socialLink']); ?>">
                                                            <i class="<?php echo esc_attr($social['socialIcon']); ?>"></i>
                                                        </a>
                                                    </li>
                                                <?php }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    ?>
                </div>
            </div>

            <?php endif; ?>
            <div class="lesson-list margin-top-70">
                <?php
                /**
                 * woocommerce_after_single_product_summary hook
                 *
                 * @hooked woocommerce_output_product_data_tabs - 10 - Removed
                 * @hooked woocommerce_upsell_display - 15 - Removed
                 * @hooked woocommerce_output_related_products - 20 - Removed
                 * @hooked g5plus_after_single_product_summary - 20 - Added
                 */
                do_action( 'woocommerce_after_single_product_summary' );
                ?>
            </div>
        </div>

    </div>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
