<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cs-blog">
		<header class="cs-blog-header">
			<div class="cs-blog-media">
				<div class="cs-blog-thumbnail">
					<?php if (has_post_thumbnail() && ! post_password_required() && ! is_attachment() && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)) { ?>
						<?php
							$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
			                $image_resize = mr_image_resize( $attachment_image[0], 570, 385, true, 'c', false );
			                echo '<img alt="" class="" src="'. esc_url($image_resize)  .'"/>';
						?>
					<?php } else { 
						$no_image = get_template_directory_uri().'/assets/images/no-image.jpg';
			    		$image_resize = mr_image_resize( $no_image, 570, 385, true,'c', false );
						?>
						<img alt="" src="<?php echo $image_resize; ;?>" />
					<?php } ?>
					<?php echo cshero_info_category_render('categories'); ?>
					<?php echo cshero_read_more_overlay_render();?>
				</div><!-- .entry-thumbnail -->
			</div>
		</header><!-- .entry-header -->

		<div class="cs-blog-content">
			<div class="cs-blog-meta cs-itemBlog-meta">
			<?php
				echo cshero_title_render();
				echo cshero_info_bar_render();
			?>
			</div>
			<?php cshero_content_render(); ?>
			<?php echo cshero_info_footer_render(); ?>
		</div><!-- .entry-content -->
		
	</div>
</article><!-- #post-## -->
