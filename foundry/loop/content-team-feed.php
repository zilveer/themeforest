<div class="row mb40 mb-xs-24 p0">

    <div class="col-sm-7 mb64 mb-xs-24">
        <?php the_post_thumbnail('full'); ?>
    </div>
    
    <div class="col-sm-5 mb64 mb-xs-24 team-feed">
    	<?php
    		the_title('<h5 class="uppercase mb0"><a href="'. get_permalink() .'">', '</a></h5><span class="inline-block mb40 mb-xs-24">'. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</span>');
    		the_content();
    		get_template_part('inc/content-team','social'); 
    	?>
    </div>
    
</div>