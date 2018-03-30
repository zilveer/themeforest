<div class="post clearfix">

	<div class="post-video">
                        <?php  
                        if (get_post_meta( get_the_ID(), 'rnr_blog_video_type', true ) == 'vimeo') {  
                            echo '<iframe src="http://player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'rnr_blog_video_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="960" height="540" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';  
                        }  
                        else if (get_post_meta( get_the_ID(), 'rnr_blog_video_type', true ) == 'youtube') {  
                            echo '<iframe width="960" height="540" src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'rnr_blog_video_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe>';  
                        }  
                        else {  
                            echo get_post_meta( get_the_ID(), 'rnr_blog_video_embed', true ); 
                        }  
                        ?>                        
       
	</div>
	
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
