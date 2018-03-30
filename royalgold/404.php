<?php get_header(); ?>

	<section id="main">
		<div class="wrapper">
			<h2><?php _e( '404 Error ', 'royalgold' ); ?></h2>
<?php if(!empty($smof_data['404_text'])) : ?>
			<p><?php echo $smof_data['404_text'] ?></p>
<?php endif; ?>

			<div class="sep"><span></span></div>
			<p><?php _e( 'Perhaps searching will help find a related item.', 'royalgold' ); ?></p>
<?php get_search_form(); ?>

		</div>
	</section>

<?php get_footer(); ?>