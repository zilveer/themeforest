<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/page.php
 * @file	 	1.0
 */
?>
<?php get_header(); ?>

	<?php do_action('before_main_content'); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

				<?php
					if(plugin_is_active('woocommerce/woocommerce.php')=="activated") {
						if( is_user_logged_in() && $data[$prefix."woocommerce_page_bar"]=="1" && ( is_cart() ||  is_page( woocommerce_get_page_id( 'pay' ) ) ||  is_page( woocommerce_get_page_id( 'order_tracking' ) ) ||  is_account_page() ) ) {
							do_action('before_title_user_info');
						}
					}
				?>

				<header>

					<h1 class="page-title" itemprop="headline">
						<?php
							if(plugin_is_active('woocommerce/woocommerce.php')=="activated") {
								if($data[$prefix."woocommerce_pagetitle_icons"]=="1") {
									if(is_cart()) {
										echo '<em class="icon-basket"></em> ';
									} elseif(is_page( woocommerce_get_page_id( 'pay' ) )) {
										echo '<em class="icon-dollar"></em> ';
									} elseif(is_page( woocommerce_get_page_id( 'terms' ) )) {
										echo '<em class="icon-th-list-summary"></em> ';
									} elseif(is_checkout()) {
										echo '<em class="icon-check"></em> ';
									} elseif(is_page( woocommerce_get_page_id( 'thanks' ) )) {
										echo '<em class="icon-ok"></em> ';
									}  elseif(is_page( woocommerce_get_page_id( 'order_tracking' ) )) {
										echo '<em class="icon-chart"></em> ';
									} elseif(is_account_page()) {
										if(is_page( woocommerce_get_page_id( 'change_password' ) )) {
											echo '<em class="icon-key"></em> ';
										} elseif(is_page( woocommerce_get_page_id( 'view_order' ) )) {
											echo '<em class="icon-search"></em> ';
										}  elseif(is_page( woocommerce_get_page_id( 'edit_address' ) )) {
											echo '<em class="icon-edit"></em> ';
										} elseif(is_page( woocommerce_get_page_id( 'terms' ) )) {
											echo '<em class=""></em> ';
										} else {
											if(is_user_logged_in()) {
												echo '<em class="icon-lock-open"></em> ';
											} else {
												echo '<em class="icon-lock"></em> ';
											}
										}
									}
								}
							}
						?>
						<?php the_title(); ?>
					</h1>
					<?php if(get_post_meta($post->ID,"page_subtitle",true)!="") { ?>
						<h4 class="subheader"><?php echo get_post_meta($post->ID,"page_subtitle",true); ?></h4>
					<?php } ?>

				</header> <!-- end article header -->

				<section class="post_content clearfix" itemprop="articleBody">

					<?php the_content(); ?>

				</section> <!-- end article section -->

			</article> <!-- end article -->

		<?php endwhile; ?>

		<?php else : ?>

			<?php article_not_found(); ?>

		<?php endif; ?>

	<?php do_action('after_main_content'); ?>

<?php get_footer(); ?>