<?php
/*
Template Name: Contact
*/
get_header(); ?>

	<div id="primary" class="content-area container">
		<div class="row">
			<div class="col-12">
				<div class="gmap" id="gmap" data-center="<?php echo get_theme_mod('gmap'); ?>"></div>
			</div>
		</div>

		<main id="main" class="site-main row" role="main">
			<div class="col-sm-4">
				<div class="row">
					<div class="col-xs-2"><i class="fa fa-map-marker"></i></div>
					<div class="col-xs-10">
					<?php echo get_theme_mod('add1'); ?><br>
					<?php echo get_theme_mod('add2'); ?><br>
					<?php echo get_theme_mod('city'); ?> <?php echo get_theme_mod('state'); ?><br>
					<?php echo get_theme_mod('country'); ?>
					</div>
				</div>
				<?php if(get_theme_mod('email')) : ?>
				<div class="row">
					<div class="col-xs-2"><i class="fa fa-envelope-o"></i></div>
					<div class="col-xs-10">
						<a href="mailto:<?php echo get_theme_mod('email'); ?>" target="_blank"><?php echo get_theme_mod('email'); ?></a>
					</div>
				</div>
				<?php endif; ?>
				<?php if(get_theme_mod('phone')) : ?>
				<div class="row">
					<div class="col-xs-2"><i class="fa fa-phone"></i></div>
					<div class="col-xs-10">
						<?php echo get_theme_mod('phone'); ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if(get_theme_mod('fax')) : ?>
				<div class="row">
					<div class="col-xs-2"><i class="fa fa-print"></i></div>
					<div class="col-xs-10">
						<?php echo get_theme_mod('fax'); ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<div class="col-sm-8">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>	
			</div>

			<?php //get_sidebar(); ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php get_footer(); ?>
