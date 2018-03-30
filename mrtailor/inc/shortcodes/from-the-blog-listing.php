<?php

// [from_the_blog]
function shortcode_from_the_blog_listing($atts, $content = null) {
	extract(shortcode_atts(array(
		"posts" => '9',
		"category" => ''
	), $atts));
	ob_start();
	?> 
    
	<div class="row">
        <div class="blog-list-wrapper">

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
            
                    <?php 
                    $bg_style = "";
                    if ( has_post_thumbnail()) :
                        $image_id = get_post_thumbnail_id();
                        $image_url = wp_get_attachment_image_src($image_id,'large', true);
                        $bg_style = 'background-image: url(' . $image_url[0] . ')';
                    endif;
                    ?>
					
				<div class="blog-list-item">	
					<a class="blog_list_img_link" href="<?php the_permalink(); ?>">
					
						<span class="blog_list_overlay"></span>
					
						<span class="blog_list_img" style="<?php echo $bg_style; ?>"></span>
						
						<span class="blog-list-content-wrapper">
							<span class="blog-list-content-inner">
								
								<span class="blog-list-day"><?php echo get_the_time('d'); ?></span>
								
								<span class="blog-list-content">
									<span class="blog-list-date"><?php echo get_the_time('F'); ?> <?php echo get_the_time('Y'); ?></span>
									<h3 class="blog-list-title"><?php echo get_the_title(); ?></h3>
								</span><!--.blog-list-content-->
								
							</span><!--blog-list-content-inner-->
						</span><!--.blog-list-content-wrapper-->
						
					</a>
				</div><!--.blog-list-item-->
				
                <?php endwhile; // end of the loop. ?>

            <?php endif; ?>

        </div>
    </div>
	
	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("from_the_blog_listing", "shortcode_from_the_blog_listing");