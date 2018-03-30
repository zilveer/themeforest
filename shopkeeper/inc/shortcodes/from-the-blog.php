<?php

// [from_the_blog]
function shortcode_from_the_blog($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"posts" => '',
		"category" => ''
	), $atts));
	ob_start();
	?> 
    
    <script>
	jQuery(document).ready(function($) {
		$("#from-the-blog-<?php echo $sliderrandomid ?>").owlCarousel({
			items:3,
			itemsDesktop : [1200,3],
			itemsDesktopSmall : [1000,2],
			itemsTablet: false,
			itemsMobile : [600,1],
			lazyLoad : true,
			/*autoHeight : true,*/
		});
	});
	</script>
    
	<div class="row">
    <div class="from-the-blog-wrapper">
	
        <div id="from-the-blog-<?php echo $sliderrandomid ?>" class="owl-carousel">
					
			<?php
    
            $args = array(
                'post_status' => 'publish',
                'post_type' => 'post',
                'category_name' => $category,
                'posts_per_page' => $posts
            );
            
            $recentPosts = new WP_Query( $args );
            
            if ( $recentPosts->have_posts() ) : ?>
                        
                <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
            
                    <?php $post_format = get_post_format(get_the_ID()); ?>
                    
                    <div class="from_the_blog_item <?php echo $post_format ? $post_format: 'standard'; ?> <?php if ( !has_post_thumbnail()) : ?>no_thumb<?php endif; ?>">
                        
						<a class="from_the_blog_link" href="<?php the_permalink() ?>">
							<span class="from_the_blog_img_container">
								<span class="from_the_blog_overlay"></span>
								
								<?php if ( has_post_thumbnail()) :
									$image_id = get_post_thumbnail_id();
									$image_url = wp_get_attachment_image_src($image_id,'large', true);
								?>
									<span class="from_the_blog_img" style="background-image: url(<?php echo esc_url($image_url[0]); ?> );"></span>
									<span class="with_thumb_icon"></span>
								<?php else : ?>
									<span class="from_the_blog_noimg"> <!--<img id="from_the_blog_nothumb" src="<?php //echo get_template_directory_uri(); ?>/images/from_the_blog_noimg.png" class="error" alt="From the blog no_image background" />--></span>
									<span class="no_thumb_icon"></span>
								<?php endif;  ?>
								
								<?php if ( has_post_thumbnail()) :
									$image_id = get_post_thumbnail_id();
									$image_url = wp_get_attachment_image_src($image_id,'large', true);
								?>
									<span class="from_the_blog_img" style="background-image: url(<?php echo esc_url($image_url[0]); ?> );"></span>
									<span class="with_thumb_icon"></span>
								<?php else : ?>
									<span class="from_the_blog_noimg"> <!--<img id="from_the_blog_nothumb" src="<?php //echo get_template_directory_uri(); ?>/images/from_the_blog_noimg.png" class="error" alt="From the blog no_image background" />--></span>
									<span class="no_thumb_icon"></span>
								<?php endif;  ?>
							</span><!--.from_the_blog_img_container-->
							<span class="from_the_blog_title" href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></span>
						</a>
                        
                        <div class="from_the_blog_content">
                            <div class="post_meta_archive"><?php shopkeeper_entry_archives(); ?></div>                       
                        </div>
                        
                    </div>
        
                <?php endwhile; // end of the loop. ?>
                
            <?php

            endif;
            
            ?> 
              
        </div>
	</div>
    </div>
	
	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("from_the_blog", "shortcode_from_the_blog");