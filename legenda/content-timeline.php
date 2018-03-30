<?php
    $post_format 	= get_post_format();
    $slider_id 		= rand(100,10000);
    $postClass 		= et_post_class();
    $postClass[]	= 'post-timeline';
    $read_more 		= et_get_read_more();
    $post_content 	= get_the_content( $read_more );
    $gallery_filter = et_gallery_from_content( $post_content );
	$lightbox = etheme_get_option('blog_lightbox');
	$postId = get_the_ID();
?>

<article <?php post_class($postClass); ?> id="post-<?php the_ID(); ?>" >	
	<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<div class="post-info">
		<span class="posted-by"> <?php _e('Posted by', ETHEME_DOMAIN);?> <?php the_author_posts_link(); ?></span> / 
		<span class="posted-in"><?php the_category(',&nbsp;') ?></span> 
		<?php // Display Comments 

			if(comments_open() && !post_password_required()) {
				echo ' / ';
				comments_popup_link('0', '1 Comment', '% Comments', 'post-comments-count');
			}

		 ?>
	</div>
	<?php if($post_format == 'gallery'): ?>
        <?php if(count($gallery_filter['ids']) > 0): ?>
            <div class="nav-type-small<?php if (count($gallery_filter['ids'])>1): ?> images-slider<?php endif; ?> slider_id-<?php echo $slider_id; ?>">
                <?php foreach($gallery_filter['ids'] as $attach_id): ?>
                    <div>
                        <?php echo wp_get_attachment_image($attach_id, 'large'); ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <script type="text/javascript">
            	<?php et_owl_init( '.slider_id-' . $slider_id ); ?>
            </script>
        <?php endif; ?>
    
	<?php elseif(has_post_thumbnail()): ?>
		<div class="post-images">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
			<div class="blog-mask">
				<div class="mask-content">
					<?php if($lightbox): ?><a href="<?php echo etheme_get_image(get_post_thumbnail_id($postId)); ?>" rel="lightbox"><i class="icon-resize-full"></i></a><?php endif; ?>
					<a href="<?php the_permalink(); ?>"><i class="icon-link"></i></a>
				</div>
			</div>
		</div>
	<?php endif; ?>

    <?php if($post_format != 'gallery'): ?>
        <div class="post-description">
        	<?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>" class="more-link"><span class="button right read-more"><?php _e('Read More', ETHEME_DOMAIN); ?></span></a>
        </div>
    <?php elseif($post_format == 'gallery'): ?>
        <div class="post-description">
            <?php echo $gallery_filter['filtered_content']; ?>
        </div>
    <?php endif; ?>


	<div class="post-date">
		<span class="post-day"><?php echo get_the_time('d'); ?></span>
		<span class="post-month"><?php echo get_the_time('M'); ?> <?php echo get_the_time('Y'); ?></span>
	</div>

	<div class="clear"></div>

	<hr>
	
	<div class="blog-line"></div>

	<div class="clear"></div>

</article>