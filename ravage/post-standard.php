<?php 
if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) { ?>
    
    <div class="post-media">
    	<?php if( is_singular() ) { ?>
    		<?php the_post_thumbnail('thumbnail-large'); ?>
    	<?php } else { ?>
    	<a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail-large'); ?></a>
    	<?php } ?>
    </div>
    
<?php } ?>
