<li>
	<h5><?php echo strip_tags(get_the_content()); ?></h5>
    <div class="quote-author">
        <?php 
        	the_post_thumbnail('medium', array('class' => 'image-xs mb16')); 
        	the_title('<h6 class="uppercase mb0">', '</h6><span>'. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</span>');
        ?>
    </div>
</li>