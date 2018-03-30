<li class="cbp-item">

	<?php if( has_post_thumbnail() ) : ?>
	    <a href="<?php the_permalink(); ?>" class="cbp-caption cbp-singlePage">
	        <div class="cbp-caption-defaultWrap">
	            <?php the_post_thumbnail('team'); ?>
	        </div>
	        <div class="cbp-caption-activeWrap">
	            <div class="cbp-l-caption-alignCenter">
	                <div class="cbp-l-caption-body">
	                    <div class="cbp-l-caption-text"><?php _e('VIEW PROFILE','flair'); ?></div>
	                </div>
	            </div>
	        </div>
	    </a>
    <?php endif; ?>
    
	<?php the_title('<a href="'. get_permalink() .'" class="cbp-singlePage cbp-l-grid-team-name">', '</a>'); ?>
    <div class="cbp-l-grid-team-position"><?php echo get_post_meta( $post->ID, '_ebor_the_job_title', true ); ?></div>
    
</li>