<?php
/* 
 * Template for displaying Aside
 */
 ?>						
<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	
	<?php media_center_post_header();?>

	<div class="post-entry">
		<div class="post-content">

			<?php media_center_post_content();?>
			
		</div><!-- /.post-content -->
	</div><!-- /.post-entry -->
	
</div><!-- /.post -->