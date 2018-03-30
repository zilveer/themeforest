<div class="col-md-4 col-sm-6 team-member">
    <div class="feature">
    
        <?php the_post_thumbnail('box'); ?>
        
        <ul class="accordion accordion-1">
            <li>
                <div class="title">
                	<?php the_title('<span>', '</span><span class="pull-right">'. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</span>'); ?>
                </div>
                <div class="content">
                    <?php 
                    	the_content(); 
                    	get_template_part('inc/content-team','social'); 
                    ?>
                </div>
            </li>
        </ul>

    </div>
</div>