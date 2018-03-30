<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post;

$vcourses=array();

$vcourses=apply_filters('wplms_product_course_order_filter',vibe_sanitize(get_post_meta($post->ID,'vibe_courses',false)));

if(count($vcourses)){
	echo '<div class="connected_courses"><h6>';
	_e('Courses Included','vibe');
	echo '</h6><ul>';
	foreach($vcourses as $course){
		echo '<li><a href="'.get_permalink($course).'"><i class="icon-book-open"></i> '.get_the_title($course).'</a></li>';
	}
	echo '</ul></div>';
}

if ( ! $post->post_excerpt ) return;
?>
<div itemprop="description">
	<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
</div>