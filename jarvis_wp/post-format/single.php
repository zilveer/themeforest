<div class="post clearfix">

	<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-image">
		<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" title="<?php the_title(); ?>" data-rel="prettyPhoto">
			<?php the_post_thumbnail('full'); ?>
		</a>
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

