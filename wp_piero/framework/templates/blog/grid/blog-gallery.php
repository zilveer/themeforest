<?php
/**
 * @package cshero
 */
?>

<?php global $smof_data; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="cs-blog">
		<header class="cs-blog-header">
			<div class="cs-blog-media">
				<?php
				$gallery_ids = cshero_grab_ids_from_gallery()->ids;
				if(!empty($gallery_ids)):
				?>
					<div id="carousel-example-generic<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
	   	                <div class="carousel-inner">
	   	                <?php $i = 0; ?>
	   	                <?php foreach ($gallery_ids as $image_id): ?>
	    					<?php
	   	                    $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);

	   	                    if($attachment_image[0] != ''):
	   	                    	$image_resize = mr_image_resize( $attachment_image[0], 570, 385, true, 'c', false );
	   	                    	?>
								<div class="item <?php if($i==0){ echo 'active'; } ?>">
	   	                    		<img style="width:100%;" data-src="holder.js" src="<?php echo esc_url($image_resize);?>" alt="" />
	   	                    	</div>
	   	                    <?php $i++; endif; ?>
	   	                <?php endforeach; ?>
	   	                </div>
	                    <a class="left carousel-control" href="#carousel-example-generic<?php the_ID(); ?>" role="button" data-slide="prev">
						    <span class="pe-7s-angle-left"></span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic<?php the_ID(); ?>" role="button" data-slide="next">
						    <span class="pe-7s-angle-right"></span>
						</a>
					</div>
				<?php elseif (has_post_thumbnail() && ! post_password_required() && ! is_attachment()): ?>
	    			<div class="cs-blog-thumbnail">
	    				<?php the_post_thumbnail(); ?>
	    				<?php echo cshero_info_category_render('categories'); ?>
	    				<?php echo cshero_read_more_overlay_render();?>
	    			</div><!-- .entry-thumbnail -->
				<?php endif; ?>
			</div>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_title_render(); ?>
				<?php echo cshero_info_bar_render();?>
			</div>
			<?php cshero_content_render(); ?>
			<?php echo cshero_info_footer_render(); ?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->

