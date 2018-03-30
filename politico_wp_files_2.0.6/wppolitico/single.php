<?php 
get_header();
if (have_posts()) : while (have_posts()) : the_post(); 
?>
	<div <?php post_class(); ?>>
			
		<div class="entry">
			<?php 
			get_template_part('meta');
			the_content();
			wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); 
			the_tags('<p>'.__('Tagged with:','themolitor').' ',', ','</p>');
			?>				
			<div class="clear"></div>
        </div><!--end entry-->
                                
        <div id="commentsection">
			<?php comments_template(); ?>
        </div>

	</div><!--end post-->

<?php 
endwhile; endif;
get_footer(); 
?>