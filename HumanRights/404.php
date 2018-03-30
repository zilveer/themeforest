<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package WPCharming
 */

get_header(); ?>

	<div class="error-page-wrapper">
		<div class="error-box-wrap">
			<div class="text-center">
				<h1 class="heading-404"><i class="fa fa-info-circle"></i><?php echo _e('404', 'wpcharming'); ?></h1>
				<div class="error-box">
					<h3><?php echo __('Page Not Found', 'wpcharming') ?></h3>
					<p><?php echo __('The page you are looking for does not appear to exist. Please go back or head on over our homepage to choose a new direction.', 'wpcharming'); ?></p>
					<div class="error-action clearfix">
						<a href="javascript: history.go(-1)" class="btn btn-large btn-light error-previous"><?php echo __('Go to previous page', 'wpcharming'); ?></a>
						<a href="<?php echo esc_url( site_url() ); ?>" class="btn  btn-large btn-light error-home"><?php echo __('Go back to homepage', 'wpcharming'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
