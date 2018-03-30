<div class="col-md-3 col-sm-4 mb24 small-team-grid">
    <?php 
    	the_post_thumbnail('box', array('class' => 'mb24')); 
    	the_title('<h6 class="uppercase mb0 color-primary"><a href="'. get_permalink() .'">', '</a></h6><span>'. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</span>');
    	get_template_part('inc/content-team','social');
    ?>
</div>