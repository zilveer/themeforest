<?php get_header(); ?>

<div class="fixed">
	<?php get_template_part( 'partials/primary-nav' ); ?>
	<?php get_template_part( 'partials/featured' ); ?>
</div>




<section class="body">

	<?php if ( function_exists( 'ot_get_option' ) ) : ?>
	<div id="homepage-three-steps">
		<div class="container">
			<div class="row">
				<div class="span4" id="step-invest">
					<span class="animated icon-bg"><i class="<?php echo ot_get_option( '1_step_icon',  'icon-heart') ?>"></i></span>
					<h3><a class="" href="<?php echo ot_get_option( '1_step_url',  '/features') ?>"><?php echo ot_get_option( '1_step_title',  'Features') ?></a></h3>
					<p class="lead"><?php echo ot_get_option( '1_step_text',  'Discover our best exhibitions with our website') ?></p>
					<a class="btn btn-primary" href="<?php echo ot_get_option( '1_step_url',  '/features') ?>"><?php _e('Read more', 'spritz' ) ?></a>
				</div>
				<div class="span4 sbl" id="step-own">
					<span class="animated icon-bg"><i class="<?php echo ot_get_option( '2_step_icon',  'icon-beer') ?>"></i></span>
					<h3><a class="" href="<?php echo ot_get_option( '2_step_url',  '/typography') ?>"><?php echo ot_get_option( '2_step_title',  'Food &amp Drink') ?></a></h3>
					<p class="lead"><?php echo ot_get_option( '2_step_text',  'Taste our special traditional dishes') ?></p>
					<a class="btn btn-primary" href="<?php echo ot_get_option( '2_step_url',  '/typography') ?>"><?php _e('Read more', 'spritz' ) ?></a>
				</div>
				<div class="span4 sbl" id="step-build">
					<span class="animated icon-bg"><i class="<?php echo ot_get_option( '3_step_icon',  'icon-food') ?>"></i></span>
					<h3><a class="" href="<?php echo ot_get_option( '3_step_url',  '/contacts') ?>"><?php echo ot_get_option( '3_step_title',  'Entertainment') ?></a></h3>
					<p class="lead"><?php echo ot_get_option( '3_step_text',  'Relax and enjoy our fantastic music') ?></p>
					<a class="btn btn-primary" href="<?php echo ot_get_option( '3_step_url',  '/contacts') ?>"><?php _e('Read more', 'spritz' ) ?></a>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>


	<div class="container hp-news">


		<h2 class="intro"><i class="icon-star-empty"></i> <?php _e('Latest News', 'spritz' ) ?> <i class="icon-star-empty"></i></h2>

		<div class="row boxes">

			<?php get_template_part( 'partials/box-news' ); ?>

		</div>

	</div>

	<?php get_template_part( 'partials/citation' ); ?>



	<div class="container hp-event">

		<h2 class="intro"><i class="icon-star-empty"></i> <?php _e('Events', 'spritz' ) ?> <i class="icon-star-empty"></i></h2>

		<div class="row boxes">

			<div class="span4">
				<?php get_template_part( 'partials/box-slider' ); ?>
			</div>

			<div class="span3">
				<?php get_template_part( 'partials/box-calendar' ); ?>
			</div>

			<div class="span5">
				<?php get_template_part( 'partials/box-tab' ); ?>
			</div>

		</div>

	</div>

</section>


<?php get_footer(); ?>