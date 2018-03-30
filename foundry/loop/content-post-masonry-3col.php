<?php $format = get_post_format(); ?>

<div class="col-sm-4 post-snippet masonry-item">

    <?php get_template_part('inc/content-format', $format); ?>
    
    <?php if(!( 'quote' == $format )) : ?>
	    <div class="inner">
	    
	        <a href="<?php the_permalink(); ?>">
	            <?php the_title('<h5 class="mb0">', '</h5><span class="inline-block mb16">'. get_the_time(get_option('date_format')) .'</span>'); ?>
	        </a>
	        
	        <hr>
	        
	        <?php 
	        	if(!( 'page' == get_post_type() ))
	        		the_excerpt(); 
	        ?>
	        
	        <a class="btn btn-sm" href="<?php the_permalink(); ?>"><?php _e('Read More','foundry'); ?></a>
	        
	        <?php get_template_part('inc/content','post-sharing'); ?>
	        
	    </div>
	<?php endif; ?>
    
</div>