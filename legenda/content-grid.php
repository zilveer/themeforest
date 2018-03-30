<?php
    $post_format 	= get_post_format();
    $slider_id 		= rand(100,10000);
    $postClass 		= et_post_class();
    $postClass[]	= 'post-grid span4';
    $read_more 		= et_get_read_more();
    $post_content 	= get_the_content( $read_more );
    $gallery_filter = et_gallery_from_content( $post_content );
	$lightbox = etheme_get_option('blog_lightbox');
	$postId = get_the_ID();
?>

<article <?php post_class($postClass); ?> id="post-<?php the_ID(); ?>" >
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
	    
	<div class="post-information <?php if (!has_post_thumbnail()): ?>border-top<?php endif ?>">
		<?php if($post_format != 'quote'): ?>
	
			<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php et_byline( array( 'author' => 1 ) ); ?>
			
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
		<div class="clear"></div>
    </div>
    <div class="clear"></div>
</article>