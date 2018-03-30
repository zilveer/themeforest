<div class="col-md-4 col-sm-6">
    <div class="image-tile outer-title text-center">
    
        <?php the_post_thumbnail('full'); ?>
        
        <div class="title mb16">
            <?php the_title('<h5 class="uppercase mb0"><a href="'. get_permalink() .'">', '</a></h5><span>'. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</span>'); ?>
        </div>
        
        <?php 
        	the_content();
        	get_template_part('inc/content-team','social'); 
        ?>
        
    </div>
</div>