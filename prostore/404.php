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
 * @package 	proStore/404.php
 * @file	 	1.0
 */
?>
<?php get_header(); ?>

	<?php do_action('before_main_content'); ?>

		<article id="post-not-found" class="clearfix text-center">

			<header>

				<h1 class="page-title primary-color">Whoops, Error 404</h1>

			</header> <!-- end article header -->

			<section class="post_content">

				<div class="row text-left">
					<div class="six columns">
						<img src="<?php echo get_template_directory_uri(); ?>/img/plane.png">
					</div>
					<div class="six columns">
						<h5>The page you were looking for was not found or does not exist !</h5>
					</div>
				</div>

				<p class="submit-changes">
					<a href="<?php echo home_url( '/'); ?>" class="button large"><em class="icon-left-open"></em>Back to Home</a>
				</p>

			</section> <!-- end article section -->

			<footer>

			</footer> <!-- end article footer -->

		</article> <!-- end article -->

	<?php do_action('after_main_content'); ?>

<?php get_footer(); ?>