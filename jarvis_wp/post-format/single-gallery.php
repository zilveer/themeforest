<div class="post clearfix">

<?php
				 $blog_slides = get_post_meta( get_the_ID( ), 'rnr_blogitemslides', false );	
				 
				 if(!empty($blog_slides)) { ?>           
                   <div class="post-gallery flexslider">
                            <ul class="slides">
                            <?php global $wpdb, $post;
                            if ( !is_array( $blog_slides ) )
                                $blog_slides = ( array ) $blog_slides;
                            if ( !empty( $blog_slides ) ) {
                                  foreach ( $blog_slides as $att ) {
                                    // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
                                    $image_src = wp_get_attachment_image_src( $att, 'full' );
                                    $image_src2= wp_get_attachment_image_src( $att, '');
                                    $image_src = $image_src[0];
                                    $image_src2 = $image_src2[0];
									$slide = get_attachment_caption($att);
                                    // Show image
                                    echo '<li><a href="'. $image_src2 . '" data-rel="prettyPhoto">';
									echo '<img src="'.$image_src.'" /><div class="flex-caption">';									
									if(!empty($slide['caption'])) echo '<h4>'.$slide['caption'].'</h2>';
									if(!empty($slide['description'])) echo '<p>'.$slide['description'].'</p>';
									echo '</div>';									
									echo '</a></li>';

                                }
                            } ?>
                            </ul>
                        </div>
<?php } ?>
	
	<div class="post-single-content">
		<div class="post-excerpt"><?php the_content(); ?></div>	    
                 <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>       
			<div class="post-single-meta"><?php get_template_part( 'includes/meta-single' ); ?></div>
		
        
        <div class="post-tags styled-list">
            <ul>
                <?php the_tags( '<ul> <li><i class="fa fa-tags"></i> ', ',&nbsp; </li><li><i class="fa fa-tags"></i> ', ' </li> </ul>'); ?>
            </ul>
        </div><!-- End of Tags -->
	</div>

</div>
