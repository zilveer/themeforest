<?php get_header(); ?>

<div class="inner">

	<ul id="posts">
	
		<?php
		
		$paged = 1;
		if ( get_query_var('paged') ) $paged = get_query_var('paged');
		if ( get_query_var('page') ) $paged = get_query_var('page');
        query_posts("ignore_sticky_posts=1&paged=".$paged);
		if (have_posts()) : while (have_posts()) : the_post();
		
		?>
		
			<?php
		
			$format = get_post_format();
			get_template_part( "formats/".$format );
			
			if($format == "")
			get_template_part( "formats/standard" );
			
			?>
			
		<?php endwhile; ?>
	
	</ul>
	
	<!--=== Begin Post Navigation ===-->
	<div id="post_nav">
		<div class="alignleft older"><?php next_posts_link( __("&laquo; Older Posts", "shorti") ) ?></div>
		<div class="alignright newer"><?php previous_posts_link( __("Newer Posts &raquo;", "shorti") ) ?></div>
		<?php wp_link_pages(); ?>
	</div>
	<!--=== End Post Navigation ===-->
	
	<?php endif; wp_reset_query(); ?>
	
	<?php shorti_blog_script(); ?>
	
</div>

<?php get_footer(); ?>