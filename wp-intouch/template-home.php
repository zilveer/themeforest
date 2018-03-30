<?php
/**
 * Template Name: Homepage
 *
 *
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 */

get_header(); ?>

<?php
$home_layout = $ct_options['ct_home_layout'];
$col_lg = '';
$col_lg_push = '';
$col_lg_pull = '';
$layout_3_class1 = 'col-lg-9';
$layout_3_class2 = 'col-lg-8';
$layout_3_class3 = 'col-lg-3';

if ( $home_layout == 'home_layout_2' ) :
	$col_lg_push = 'col-lg-push-3';
	$col_lg_pull = 'col-lg-pull-9';
elseif ( $home_layout == 'home_layout_3' ) :
	$layout_3_class1 = 'col-lg-8';
	$layout_3_class2 = 'col-lg-12';
	$layout_3_class3 = 'col-lg-4';
elseif ( $home_layout == 'home_layout_4' ) :
	$col_lg_push = 'col-lg-push-4';
	$col_lg_pull = 'col-lg-pull-8';
	$layout_3_class1 = 'col-lg-8';
	$layout_3_class2 = 'col-lg-12';
	$layout_3_class3 = 'col-lg-4';
endif;
?>

<div id="primary" class="content-area">
	<?php if ( is_active_sidebar( 'ct_homepage_top' ) ) : ?>
		<!-- START SINGLE HEADER SIDEBAR -->
		<div class="container">
			<div class="row">
				<div class="col-lg-12 homepage_top_area">
					<?php dynamic_sidebar( 'ct_homepage_top' ); ?>
				</div><!-- .col-lg-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
		<!-- END SINGLE HEADER SIDEBAR -->
	<?php endif; ?>

	<!-- START HOMEPAGE AREA [InTouch] -->
	<div class="container homepage_area <?php echo $home_layout; // add a class to indicate the current layout ?>">
		<div class="row">
			<div class="<?php echo $layout_3_class1; ?> <?php echo $col_lg_push; ?>">
				<?php if ( is_active_sidebar( 'ct_homepage_slider' ) ) : ?>
				<div class="row">
					<div class="col-lg-12 homepage_slider_area">
						<?php dynamic_sidebar( 'ct_homepage_slider' ); ?>
					</div><!-- .col-lg-12 -->
				</div><!-- .row -->
				<?php endif; ?>

				<div class="row homepage_main_area">
					<div class="col-lg-12">
						<div class="row">
							<div class="<?php echo $layout_3_class2; //default col-lg-8 ?>">
								<?php dynamic_sidebar( 'ct_homepage_main' ); ?>
							</div><!-- .col-lg-8 -->

							<?php if ( ($home_layout == 'home_layout_1') or ($home_layout == 'home_layout_2') ) : ?>
							<div class="col-lg-4">
								<?php dynamic_sidebar( 'ct_homepage_main_r' ); ?>
							</div><!-- .col-lg-4 -->
							<?php endif; ?>
						</div><!-- .row -->
					</div><!-- .col-lg-12 -->
				</div><!-- .row .homepage_main_area -->

				<?php if ( is_active_sidebar( 'ct_homepage_bottom' ) ) : ?>
				<div class="row homepage_bottom_area">
					<div class="col-lg-12">
						<?php dynamic_sidebar( 'ct_homepage_bottom' ); ?>
					</div><!-- .col-lg-12 -->
				</div><!-- .row .homepage_bottom_area -->
				<?php endif; ?>
			</div><!-- .col-lg-9 -->
			<div class="<?php echo $layout_3_class3; ?> <?php echo $col_lg_pull; ?> homepage_sidebar">
				<?php dynamic_sidebar( 'ct_homepage_sidebar' ); ?>
			</div><!-- .col-lg-3 -->
		</div><!-- .row -->
	</div><!-- .container -->
	<!-- END HOMEPAGE AREA -->
</div><!-- #primary -->

<?php get_footer(); ?>