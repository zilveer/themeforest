<?php while (have_posts()) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('blogItem'); ?>>
	    <div class="bPhoto">
		    <?php echo wp_get_attachment_image(get_the_ID(), array(870, 1024))?>
	    </div>
    </div> <!-- / blogItem -->
<?php endwhile; ?>