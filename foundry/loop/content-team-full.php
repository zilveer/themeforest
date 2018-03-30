<div class="col-md-4 col-sm-6 p0">
    <div class="image-tile inner-title hover-reveal text-center mb0">
    
        <?php the_post_thumbnail('full'); ?>
        
        <div class="title">
            <?php 
            	the_title('<h5 class="uppercase mb0"><a href="'. get_permalink() .'">', '</a></h5><span>'. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</span>'); 
            	get_template_part('inc/content-team','social')
            ?>
        </div>
        
    </div>
</div>