<?php
/**
 * Template Name: Full Width
 *
 *
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 */

get_header(); ?>

<?php
$page_comments = get_post_meta($post->ID,'ct_mb_page_comments', true);
$ct_breadcrumb = $ct_options['ct_breadcrumb'];
?>

<!-- InTouch -->
<?php if ( $ct_breadcrumb ) : ?>
<div class="entry-navigation">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="entry-breadcrumb ct-google-font">
					<?php ct_breadcrumb(); ?>
				</div><!-- .entry-breadcrumb -->
			</div><!-- .col-lg-12 -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .entry-navigation -->
<?php endif; ?>	


<?php if ( is_active_sidebar('ct_page_top') ): ?>
<!-- START TOP SINGLE WIDGETS AREA -->
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="top-widgets-area">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('ct_page_top') ) : ?>
				<?php endif; ?>
			</div> <!-- .top-widgets-area -->
		</div><!-- .col-lg-12 -->
	</div><!-- .row -->
</div><!-- .container -->
<!-- END TOP SINGLE WIDGETS AREA -->
<?php endif; ?>	

<div class="container">
	<div class="row">
		<div id="primary" class="site-content col-lg-12">
			<div id="content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
					<?php if ( $page_comments == '1') : ?>
						<?php comments_template( '', true ); ?>
					<?php endif; ?>
				<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- .col-lg-12 #content -->
	</div><!-- .row -->
</div> <!-- .container -->

<?php get_footer(); ?>