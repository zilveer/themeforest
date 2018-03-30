<?php
/**
 * Template Name: Full width with sidebar
 * The Page base for MPC Themes
 *
 * Displays single page.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */

get_header();

global $page_id;
global $paged;

$header_content = get_field('mpc_header_content');
$hide_title = get_field('mpc_hide_title');

if (function_exists('is_account_page') && is_account_page()) {
	$url = $_SERVER['REQUEST_URI'];

	if (strpos($url, 'edit-address') !== false)
		$hide_title = true;
}

?>

<div id="mpcth_main">
	<?php if ($header_content != '') { ?>
	<div class="mpcth-page-custom-header">
		<?php echo do_shortcode($header_content); ?>
	</div>
	<?php } ?>
	<div id="mpcth_main_container">
		<?php get_sidebar(); ?>
		<div id="mpcth_content_wrap">
			<div id="mpcth_content">
				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						<article id="page-<?php the_ID(); ?>" <?php post_class('mpcth-page'); ?> >
							<?php if (! $hide_title) { ?>
							<header class="mpcth-page-header">
								<?php
									if (function_exists('is_checkout') && is_checkout()) {
										$order_url = $_SERVER['REQUEST_URI'];
										$order_received = strpos($order_url, '/order-received');
										?>
										<div class="mpcth-order-path">
											<span><?php _e('Shopping Cart', 'mpcth'); ?></span>
											<i class="fa fa-angle-right"></i>
											<span <?php echo ! $order_received ? 'class="mpcth-color-main-color"' : ''; ?>><?php _e('Checkout Details', 'mpcth'); ?></span>
											<i class="fa fa-angle-right"></i>
											<span <?php echo $order_received ? 'class="mpcth-color-main-color"' : ''; ?>><?php _e('Order Complete', 'mpcth'); ?></span>
										</div>
									<?php }
								?>
								<h1 class="mpcth-page-title mpcth-deco-header">
									<?php mpcth_breadcrumbs(); ?>
									<span class="mpcth-color-main-border">
										<?php the_title(); ?>
									</span>
								</h1>
							</header>
							<?php } ?>
							<section class="mpcth-page-content">
								<?php the_content(); ?>
							</section>
							<footer class="mpcth-page-footer">
								<?php if (comments_open()) { ?>
									<div id="mpcth_comments">
										<?php comments_template('', true); ?>
									</div>
								<?php } ?>
							</footer>
						</article>
					<?php endwhile; ?>
				<?php endif; ?>
			</div><!-- end #mpcth_content -->
		</div><!-- end #mpcth_content_wrap -->
	</div><!-- end #mpcth_main_container -->
</div><!-- end #mpcth_main -->

<?php get_footer();