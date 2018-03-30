<?php
/**
*	Template for standart Posts
*/

    $postClass = 'blog-post';
    $postId = get_the_ID();
    $lightbox = etheme_get_option('blog_lightbox');
    $blog_slider = etheme_get_option('blog_slider');
    $post_format = get_post_format();
    
    $post_content = get_the_content('<span class="btn big pull-right read-more">'.__('Read More', ET_DOMAIN).'</span>');
    preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
    $attach_ids = array();
    $filtered_content = '';
    if(!empty($ids)) {
	    $attach_ids = explode(",", $ids[1]);
	    $content =  str_replace($ids[0], "", $post_content);
	    $filtered_content = apply_filters( 'the_content', $content);
    }

    $slider_id = rand(100,10000);
    $postClass .= ' content-'.etheme_get_option('blog_layout');

    if(etheme_get_option('blog_byline')) {
    	$postClass .= ' byline-on';
    } else {
    	$postClass .= ' byline-off';
    }
?>


<article <?php post_class($postClass); ?> id="post-<?php the_ID(); ?>" >
	<?php 
		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '<span class="sticky-post">%s</span>', __( 'Featured', ET_DOMAIN ) );
		}
 	?>

	<div>
		<?php if($post_format == 'quote' || $post_format == 'video'): ?>
	    
	            <?php the_content('<span class="btn big pull-right read-more">'.__('Read More', ET_DOMAIN).'</span>'); ?>
	        
		<?php elseif($post_format == 'gallery'): ?>
	            <?php if(count($attach_ids) > 0): ?>
	                <div class="post-gallery-slider slider_id-<?php echo $slider_id; ?>">
	                    <?php foreach($attach_ids as $attach_id): ?>
	                        <div>
	                            <?php echo wp_get_attachment_image($attach_id, 'large'); ?>
	                        </div>
	                    <?php endforeach; ?>
	                </div>
	    
	                <script type="text/javascript">
	                    jQuery('.slider_id-<?php echo $slider_id; ?>').owlCarousel({
	                        items:1,
	                        navigation: true,
	                        lazyLoad: false,
	                        rewindNav: false,
	                        addClassActive: true,
	                        singleItem : true,
	                        autoHeight : true,
	                        itemsCustom: [1600, 1]
	                    });
	                </script>
	            <?php endif; ?>
	    
		<?php elseif(has_post_thumbnail()): ?>
			<div class="wp-picture">
				<?php the_post_thumbnail('large'); ?>
				<div class="zoom">
					<div class="btn_group">
						<a href="<?php echo etheme_get_image(); ?>" class="btn btn-black xmedium-btn" rel="pphoto"><span><?php _e('View large', ET_DOMAIN); ?></span></a>
						<a href="<?php the_permalink(); ?>" class="btn btn-black xmedium-btn"><span><?php _e('More details', ET_DOMAIN); ?></span></a>
					</div>
					<i class="bg"></i>
				</div>
			</div>
		<?php endif; ?>
	    
		<?php if($post_format != 'quote'): ?>
	        <h6 class="active"><?php the_category(',&nbsp;') ?></h6>
	
	        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	        
			<?php et_byline(); ?>
			
	    <?php endif; ?>
	
	    <?php if($post_format != 'quote' && $post_format != 'video' && $post_format != 'gallery'): ?>
	        <div class="content-article">
	        	<?php the_excerpt(); ?>
     			<a href="<?php the_permalink(); ?>" class="more-link"><span class="btn big pull-right read-more"><?php _e('Read More', ET_DOMAIN); ?></span></a>
	        </div>
	    <?php elseif($post_format == 'gallery'): ?>
	        <div class="content-article">
	            <?php echo $filtered_content; ?>
	        </div>
	    <?php endif; ?>
    </div>
    <?php if(etheme_get_option('blog_byline') && etheme_get_option('blog_layout') == 'timeline'): ?>
        <div class="meta-post-timeline">
            <?php the_time(get_option('date_format')); ?> / 
            <?php the_time(get_option('time_format')); ?>
        </div>
    <?php endif; ?>
</article>