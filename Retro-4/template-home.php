<?php
/* template name: Homepage Template */

$retro_home_query = array(
	'post_type' => $post->post_name,
	'nopaging' => true,
	'orderby' => 'menu_order',
	'order' => 'asc'
);

$retro_home_query = new WP_Query( $retro_home_query );
?>

<?php get_header(); ?>

<?php get_template_part( 'nav' ); ?>
	
<?php if ( $retro_home_query->have_posts() ) : ?>

	<main role="main">

		<?php while ( $retro_home_query->have_posts() ) : ?>
				
			<?php $retro_home_query->the_post(); ?>
			
			<?php get_template_part( 'part', 'section' ); ?>
		
		<?php endwhile; ?>

	</main>

	<?php if ( op_theme_opt( 'show-loader' ) ) : ?>

		<div class="landing">
			<ul>
				<li class="land1"></li>
				<li class="land2"></li>
				<li class="land3"></li>
				<li class="land4"></li>
				<li class="land5"></li>
				<li class="land6"></li>
				<li class="land7"></li>
				<li class="land8"></li>
				<li class="land9"></li>
			</ul>
			<div class="counter"><span></span></div>
			<div class="loading"><?php _e( '... Loading ...', 'openframe' ) ?></div>
		</div>	

	<?php endif; ?>

<?php endif; ?>
	
<?php wp_reset_postdata(); ?>
	
<?php get_footer(); ?>