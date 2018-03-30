<?php get_header(); ?>
	<div class="content">
		<?php tie_breadcrumbs() ?>
		
		<div class="page-head">
			<?php if ( have_posts() ) the_post(); ?>
			<h2 class="page-title">
				<?php if ( is_day() ) : ?>
					<?php printf( __ti( 'Daily Archives: <span>%s</span>' ), get_the_date() ); ?>
				<?php elseif ( is_month() ) : ?>
					<?php printf( __ti( 'Monthly Archives: <span>%s</span>' ), get_the_date( 'F Y' ) ); ?>
				<?php elseif ( is_year() ) : ?>
					<?php printf( __ti( 'Yearly Archives: <span>%s</span>' ), get_the_date( 'Y' ) ); ?>
				<?php else : ?>
					<?php _eti( 'Blog Archives' ); ?>
				<?php endif; ?>
			</h2>
			<div class="stripe-line"></div>
		</div>

				
		<?php
		rewind_posts();
		get_template_part( 'loop' );	?>
		<?php if ($wp_query->max_num_pages > 1) tie_pagenavi(); ?>
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>