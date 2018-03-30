<?php 
get_header();
if (have_posts()) : while (have_posts()) : the_post(); 
?>
	<div class="entry">
		<?php the_content(); ?>		
		<div class="clear"></div>		
	</div>
 
	<div id="commentsection">
		<?php comments_template(); ?>
    </div>
	
<?php 
endwhile; endif; 
get_footer(); 
?>