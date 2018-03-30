<div class="col-sm-4 text-center mb40 mb-xs-24 grid-extra-small">
    <?php 
    	the_post_thumbnail('box', array('class' => 'mb24'));
    	the_title('<h5 class="mb0"><a href="'. get_permalink() .'">', '</a></h5><h6 class="uppercase">'. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</h6>'); 
    	get_template_part('inc/content-team','social'); 
    ?>
</div>