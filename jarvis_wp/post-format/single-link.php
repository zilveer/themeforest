<div class="post clearfix">

	<div class="post-single-content">
    
    
		<div class="post-title post-link">
			<h2><a href="<?php echo esc_attr(get_post_meta($post->ID, 'rnr_bloglinkurl', true)); ?>" title="<?php printf( esc_attr__('Link to %s', 'rocknrolla'), the_title_attribute('echo=0') ); ?>" rel="bookmark"
             target="_blank">
				<?php the_title(); ?>
			</a><span><div class="post-link"><?php echo esc_attr(get_post_meta($post->ID, 'rnr_bloglinkurl', true)); ?></div></span></h2>
        </div>
        
        
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
