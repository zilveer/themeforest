<li>
    <?php the_content(); ?>
    <div class="quote-author">
        <?php 
        	the_post_thumbnail(); 
        	the_title('<h6 class="uppercase">', '</h6><span>'. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</span>');
        ?>
    </div>
</li>