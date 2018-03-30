<?php
$att_args = array( 'post_type'      => 'attachment',
				   'numberposts'    => -1,
				   'post_status'    => null,
				   'post_parent'    => $post->ID,
				   'post_mime_type' => 'image',
				   'orderby'        => 'menu_order'
			);
$attachments = get_posts( $att_args );
?>

<?php if( $attachments ): ?>

	<?php 
	$lightbox        = isset( $GLOBALS['post-carousel'] ) ? null              : 'class="image-gallery"';
	$lightbox_group  = isset( $GLOBALS['post-carousel'] ) ? null              : 'rel="image-group-' . $attachments[0]->post_parent . '"';
	$attachment_size = isset( $GLOBALS['post-carousel'] ) ? 'blog-post-thumb' : 'blog-post';

	$slider_effect  = of_get_option('ss_gallery_slider_effect');
	$slider_speed   = of_get_option('ss_use_custom_gallery_slider_speed')   ? of_get_option('ss_custom_gallery_slider_speed')   : of_get_option('ss_gallery_slider_speed');
	$slider_timeout = of_get_option('ss_use_custom_gallery_slider_timeout') ? of_get_option('ss_custom_gallery_slider_timeout') : of_get_option('ss_gallery_slider_timeout');
	?>
	
	<div class="image-gallery-slider">

		<ul data-effect="<?php echo $slider_effect; ?>" data-speed="<?php echo $slider_speed; ?>" data-timeout="<?php echo $slider_timeout; ?>">

		<?php foreach( $attachments as $attachment ): ?>
		
			<?php $permalink = isset( $GLOBALS['post-carousel'] ) ? get_permalink() : $attachment->guid; ?>
			<?php $attachment_img = wp_get_attachment_image_src( $attachment->ID, $attachment_size, false ); ?>

			<li>
				<a href="<?php echo $permalink; ?>" title="<?php echo $attachment->post_title; ?>" <?php echo $lightbox; ?> <?php echo $lightbox_group; ?>>
					<img src="<?php echo $attachment_img[0]; ?>" alt="<?php echo $attachment->post_name; ?>" title="<?php echo $attachment->post_title; ?>" class="entry-image">
				</a>
			</li>

		<?php endforeach; ?>
			
		</ul>
		
	</div><!-- end .image-gallery-slider -->

<?php endif; ?>

<div class="entry-body">

	<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'ss_framework'), the_title_attribute('echo=0')); ?>" rel="bookmark">
		<h1 class="title"><?php the_title(); ?></h1>
	</a>

<?php echo ss_framework_post_content(); ?>

</div><!-- end .entry-body -->

<div class="entry-meta">

<?php echo ss_framework_post_meta(); ?>

</div><!-- end .entry-meta -->