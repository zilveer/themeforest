<div class="post clearfix">

	<div class="post-audio">
		<?php echo get_post_meta($post->ID, 'rnr_blogaudiourl', true); ?>
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
