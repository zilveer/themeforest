<div id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>

    <?php global $blog_post_type; ?>
    
    <div class="post-media">      
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
    </div><!-- Ends Post Media -->

    <div class="post-title">
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'rocknrolla'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
    </div><!-- End of Title -->

	<div class="post-meta">
		<?php _e('<i class="fa fa-tasks"></i> ', 'rocknrolla'); the_category(', '); ?>,  <i class="fa fa-time"></i> <?php the_time('d'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?> <span><?php if ( comments_open() ) { comments_popup_link(__('<i class="fa fa-comments-o"></i> 0', 'rocknrolla'), __('<i class="fa fa-comments-o"></i> 1', 'rocknrolla'), __('<i class="fa fa-comments-alt"></i> %', 'rocknrolla'), 'comments-link', ''); } ?></span> 
	</div><!-- End of Meta Date -->

    <div class="post-content">
        <?php the_excerpt(); ?>
        <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?> 
    </div><!-- End of Content -->

    <div class="post-tags styled-list">
        <ul>
            <?php the_tags( '<ul> <li><i class="fa fa-tags"></i> ', ' , </li><li><i class="fa fa-tags"></i> ', ' </li> </ul>'); ?>
        </ul>
    </div><!-- End of Tags -->

</div><!-- End of Post -->