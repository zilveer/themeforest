<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/single-product/product-image.php
 * @sub-package WooCommerce/Templates/single-product/product-image.php
 * @file		1.2
 * @file(Woo)	1.6.4
 */
?>
<?php global $post, $woocommerce, $prefix, $data; ?>
<div class="images seven columns">

	<section class="slider text-center">
		<?php
			switch(get_post_meta($post->ID,'featured_media_type',true)) {
				case "video";
					echo get_vid_sc(get_post_meta($post->ID,'featured_media_video_provider',true),get_post_meta($post->ID,'featured_media_video_id',true));
					break;
				case "image" :
					if (has_post_thumbnail() ) :
						the_post_thumbnail('full');
					else :
						echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" />';
					endif;
					break;
				case "revslider" :
					$rev_slider = get_post_meta($post->ID,'featured_media_revslider_id',true);
					if($rev_slider != "") {
						if(function_exists('putRevSlider')) {
							putRevSlider($rev_slider);
						}
					}
					break;
				default :
					$wp_version = get_bloginfo('version');
					if( version_compare($wp_version, '3.4.2', '>') && get_post_meta($post->ID,'featured_media_slider_custom',true)=="on") {
						$gallery_ids = get_post_meta($post->ID,'featured_slider_image_ids',true);
							echo efs_get_slider(get_the_ID(),'true','true',$data[$prefix."woocommerce_product_zoom"]=="1"?"true":"false",'true','','true',$gallery_ids);
					} else {
						if (has_post_thumbnail() ) :
							echo efs_get_slider(get_the_ID(),'true','true',$data[$prefix."woocommerce_product_zoom"]=="1"?"true":"false",'true','','','');
						else :
							echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" />
';
						endif;
					}
					break;
			}
		?>
      </section>

</div>