<div class="feature boxed">
    <?php the_content(); ?>
    <div class="spread-children">
    	<?php 
    		the_post_thumbnail('full', array('class' => 'image-xs')); 
    		the_title('<span>', ' - '. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</span>');
    	?>
    </div>
</div>