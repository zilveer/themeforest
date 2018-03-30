<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 */

get_header(); ?>

<?php
$page_comments = get_post_meta($post->ID,'ct_mb_page_comments', true);
$mb_sidebar_position = get_post_meta( $post->ID, 'ct_mb_sidebar_position', true);
$ct_breadcrumb = $ct_options['ct_breadcrumb'];

if ( ($mb_sidebar_position == '') and is_rtl() ) : $mb_sidebar_position = 'left'; endif;

$col_lg_push = '';
$col_lg_pull = '';
$content_class = 'col-lg-8';
$sidebar_class = 'col-lg-4';

if ( $mb_sidebar_position == 'left-wide' ) :
	$col_lg_push = 'col-lg-push-4';
	$col_lg_pull = 'col-lg-pull-8';
elseif ( $mb_sidebar_position == 'right-narrow' ) :
	$content_class = 'col-lg-9';
	$sidebar_class = 'col-lg-3';
elseif ( $mb_sidebar_position == 'left-narrow' ) :
	$content_class = 'col-lg-9';
	$sidebar_class = 'col-lg-3';
	$col_lg_push = 'col-lg-push-3';
	$col_lg_pull = 'col-lg-pull-9';	
endif;
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
		<div id="primary" class="site-content <?php echo $content_class.' '.$col_lg_push; ?>">
			<div id="content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
						<?php if ( $page_comments == '1') : ?>
						<?php comments_template( '', true ); ?>
					<?php endif; ?>
				<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- .col-lg-8 #content -->

		<div id="secondary" class="widget-area <?php echo $sidebar_class.' '.$col_lg_pull; ?>" role="complementary">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('ct_page_sidebar') ) : ?>
			<?php endif; ?>
		</div><!-- .col-lg-4 -->
	</div><!-- .row -->
</div> <!-- .container -->

<?php get_footer(); ?>