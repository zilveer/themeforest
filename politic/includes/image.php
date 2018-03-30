<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
    
    <div class="post-thumb">
        <?php if( is_singular() ) { 
            
        	the_post_thumbnail('thumbnail-large');
        	
        } else { ?>
            
        	<a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
        	    <?php the_post_thumbnail('thumbnail-large', array('class' => 'post-thumb')); ?>
        	</a>
        	
    	<?php } ?>
    </div>
    
<?php } ?>
