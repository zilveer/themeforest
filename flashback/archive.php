<?php get_header(); ?>

<div class="inner">

	<h2 id="page_title">
	
		<?php if ( is_day() ) : ?>
						<?php printf( __( 'Daily Archives: <span>%s</span>', 'shorti' ), get_the_date() ); ?>
		<?php elseif ( is_month() ) : ?>
						<?php printf( __( 'Monthly Archives: <span>%s</span>', 'shorti' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'shorti' ) ) ); ?>
		<?php elseif ( is_year() ) : ?>
						<?php printf( __( 'Yearly Archives: <span>%s</span>', 'shorti' ), get_the_date( _x( 'Y', 'yearly archives date format', 'shorti' ) ) ); ?>
		<?php else : ?>
						<?php _e( 'Blog Archives', 'shorti' ); ?>
		<?php endif; ?> 
	
	</h2>
	
	<ul id="posts">
	
		<?php rewind_posts(); ?>
	
		<?php
		
		if ( have_posts() ) : while (have_posts()) : the_post();
		
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
	<div class="post-navigation">
		<div class="alignleft older"><?php next_posts_link( __("&laquo; Older Posts", "shorti") ) ?></div>
		<div class="alignright newer"><?php previous_posts_link( __("Newer Posts &raquo;", "shorti") ) ?></div>
		<?php wp_link_pages(); ?>
	</div>
	<!--=== End Post Navigation ===-->
	
	<?php endif; wp_reset_query(); ?>
	
	<?php shorti_blog_script(); ?>

</div>

<?php get_footer(); ?>