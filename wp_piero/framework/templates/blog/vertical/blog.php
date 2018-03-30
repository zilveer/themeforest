<?php
/**
 * @package cshero
 */
	global $smof_data,$post; 
	if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) { 
		$class1 = 'col-xs-12 col-sm-12 col-md-6 col-lg-6 nopaddingall';
		$class2 = 'col-xs-12 col-sm-12 col-md-6 col-lg-6';
	} else {
		$class1 ='col-xs-12 col-sm-12 col-md-12 col-lg-12 nopaddingall';
		$class2 ='col-xs-12 col-sm-12 col-md-12 col-lg-12';
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cs-blog row">
		<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
		<div class="<?php echo $class1;?>">
		<div class="cs-blog-media">
			<div class="cs-blog-thumbnail">
				<?php
					$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
	                $image_resize = mr_image_resize( $attachment_image[0], 570, 380, true, 'c', false );
	                echo '<img alt="" class="" src="'. esc_url($image_resize)  .'"/>';
				?>
				<?php echo cshero_info_category_render('categories'); ?>
				<?php echo cshero_read_more_overlay_render();?>
			</div><!-- .entry-thumbnail -->
		</div>
		</div><!-- .entry-header -->
		<?php endif; ?>
		<div class="cs-blog-content  <?php echo $class2;?>">
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php
				echo cshero_title_render();
				echo cshero_info_bar_render();?>
			</div>
			<?php cshero_content_render(); ?>
			
			<?php echo cshero_info_footer_render(); ?>
			
		</div><!-- .entry-content -->
		
	</div>
</article><!-- #post-## -->
