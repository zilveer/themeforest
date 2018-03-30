<div id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>

    <?php global $blog_post_type; 
    
    $blog_slides = get_post_meta( get_the_ID( ), 'rnr_blogitemslides', false ); 

    if(!empty($blog_slides)) { ?>   
    <div class="post-media">      
        <div class="flexslider">
            <ul class="slides">

                <?php global $wpdb, $post;

                if ( !is_array( $blog_slides ) )
                    $blog_slides = ( array ) $blog_slides;

                if ( !empty( $blog_slides ) ) {

                    foreach ( $blog_slides as $att ) {
                        // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
                        $image_src = wp_get_attachment_image_src( $att, 'blog-standard' );
                        $image_src2= wp_get_attachment_image_src( $att, '');
                        $image_src = $image_src[0];
                        $image_src2 = $image_src2[0]; 
                        $slide = get_attachment_caption($att);?>
                        <li><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'rocknrolla'), the_title_attribute('echo=0') ); ?>"
                        rel="bookmark"><?php 
						            echo '<img src="'.$image_src.'" /><div class="flex-caption">';									
									if(!empty($slide['caption'])) echo '<h4>'.$slide['caption'].'</h2>';
									if(!empty($slide['description'])) echo '<p>'.$slide['description'].'</p>';
									echo '</div>'; ?>
						</a></li> 
                    <?php 
                    } // ends foreach loop
                } // ends if block (!empty $blogs_slides)
                ?>

            </ul>
        </div><!-- Ends Flexslider -->
    </div><!-- Ends Post Media -->
    <?php } // ends if block (!empty $blogs_slides)?>

    <div class="post-title">
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'rocknrolla'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
    </div><!-- End of Title -->

	<div class="post-meta">
		<?php _e('<i class="fa fa-tasks"></i> ', 'rocknrolla'); the_category(', '); ?>,  <i class="fa fa-time"></i> <?php the_time('d'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?> <span><?php if ( comments_open() ) { comments_popup_link(__('<i class="fa fa-comments-o"></i> 0', 'rocknrolla'), __('<i class="fa fa-comments-o"></i> 1', 'rocknrolla'), __('<i class="fa fa-comments-o"></i> %', 'rocknrolla'), 'comments-link', ''); } ?></span> 
	</div><!-- End of Meta Date -->

    <div class="post-content">
        <?php the_excerpt(); ?>
        <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?> 
    </div><!-- End of Content -->

    <div class="post-tags styled-list">
        <ul>
            <?php the_tags( '<ul><li><i class="fa fa-tags"></i>', '</li><li><i class="fa fa-tags"></i>', '</li></ul>'); ?>
        </ul>
    </div><!-- End of Tags -->

</div><!-- End of Post -->
