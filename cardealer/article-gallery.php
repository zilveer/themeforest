<?php
if (!defined('ABSPATH')) exit();

if (is_single()) {
	$thumb_size = '840*500';
} else {
	$thumb_size = '460*290';
}

$gall = array();
$post_type_values = get_post_meta( get_the_ID(), 'post_type_values', true );

if (isset($post_type_values['gallery'])) {
	$gall = $post_type_values['gallery'];
}

$path = wp_upload_dir();

if (!empty($gall)) {
	wp_enqueue_script('tmm_cycle_js');

	$article_class = is_single() ? '' : 'image-post-slider-listing ';
	?>

	<div class="<?php echo $article_class; ?>image-post-slider">
		<ul>
			<?php
			if (!empty($gall)) {

				foreach ($gall as $key => $source_url) {
					/* fix for multisite */
					if (is_multisite()) {
						$temp = explode('wp-content/uploads', $source_url);
						$source_url = $path['baseurl'] . $temp[1];
					}
					?>
					<li>
						<a data-fancybox-group="lightbox" href="<?php the_permalink() ?>" class="single-image plus-icon">
							<img src="<?php echo esc_url( TMM_Helper::resize_image( $source_url, $thumb_size ) ); ?>" alt="<?php the_title_attribute(); ?>"/>
						</a>
					</li>
					<?php
				}

			}
			?>
		</ul>
	</div><!--/ .image-post-slider-->

	<?php
}else{
	?>
	<a href="<?php the_permalink() ?>" class="single-image link-icon">
		<img class="entry-image" src="<?php echo esc_url( TMM_Helper::get_post_featured_image( get_the_ID(), $thumb_size ) ); ?>" alt="<?php the_title_attribute(); ?>" />
	</a>
	<?php
}