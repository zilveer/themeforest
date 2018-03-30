<?php /* if the post has a WP 2.9+ Thumbnail */
if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
    <div class="post-thumb">

        <?php if( !is_singular() ) { ?>

    	    <a title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-large'); ?></a>
    	    
    	<?php } else {
    	    
    	    the_post_thumbnail('blog-large');
    	    
    	} ?>
    	    
    </div>
<?php } ?>