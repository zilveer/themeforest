<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(cshero_generetor_blog_column()); ?>>
	<div class="cs-blog">
		<header class="cs-blog-header">
		    <div class="blog-title-top">
    		    <div class="date-box table-cell">
    				<div class="date left">
                        <span class="day"><?php echo get_the_date('j'); ?></span>
                        <span class="month"><?php echo get_the_date('M'); ?></span>
    				</div>
    				<span class="icon-type-post right"><i class="<?php echo cshero_get_icon_post_type(); ?>"></i></span>
    			</div>
			    <?php echo cshero_title_render(); ?>
			</div>
			<div class="cs-blog-media">
			<?php
			$gallery_ids = cshero_grab_ids_from_gallery()->ids;
			if(!empty($gallery_ids)):
			?>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
   	                <div class="carousel-inner">
   	                <?php $i = 0; ?>
   	                <?php foreach ($gallery_ids as $image_id): ?>
    					<?php
   	                    $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
   	                    if($attachment_image[0] != ''):?>
							<div class="item <?php if($i==0){ echo 'active'; } ?>">
   	                    		<img style="width:100%;" data-src="holder.js" src="<?php echo esc_url($attachment_image[0]);?>" alt="" />
   	                    	</div>
   	                    <?php $i++; endif; ?>
   	                <?php endforeach; ?>
   	                </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					    <span class="ion-ios7-arrow-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					    <span class="ion-ios7-arrow-right"></span>
					</a>
				</div>
			<?php elseif (has_post_thumbnail() && ! post_password_required() && ! is_attachment()): ?>
    			<div class="cs-blog-thumbnail">
    				<?php the_post_thumbnail(); ?>
    			</div><!-- .entry-thumbnail -->
			<?php endif; ?>
			</div>
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_info_bar_render(); ?>
			</div>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<?php cshero_content_render(); ?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->

