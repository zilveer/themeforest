<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * Used for single and index/archive/blog/search.
 *
 * @package WordPress
 * @subpackage Mango
 * @since Mango 1.0
 */
?>
<?php
		global $post, $mango_settings,$blog_settings,$thumbnail_size;
		$app_gallery = get_post_meta($post->ID, 'mango_option_image', false);
		if( ! empty( $app_gallery ) ): ?>
				<div id="<?php echo esc_attr($post->ID); ?>" class="entry-media carousel slide" data-ride="carousel" data-interval="7000">
					<div class="entry-media carousel-inner">
    <?php
		$class = "active";
		foreach ($app_gallery as $image_id) { ?>
    <div class="item <?php echo esc_attr($class); ?>">
        <?php $class = '';
        $img_src = wp_get_attachment_image_src( $image_id, $thumbnail_size ) ;
        ?>
        <a href="<?php the_permalink() ?>">
            <img src="<?php echo esc_url($img_src[0]) ?>" class="img-responsive" alt="">
        </a>
    </div><!-- End .item -->
<?php } ?>
</div><!-- End .carousel-inner -->
<!-- Controls -->
    <a class="left carousel-control" href="#<?php echo esc_attr($post->ID); ?>" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
    <a class="right carousel-control" href="#<?php echo esc_attr($post->ID); ?>" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
</div><!-- End .entry-media -->
<?php endif; ?>