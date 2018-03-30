<?php
/**
 * Template Name: Archives
 *
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 */

get_header(); ?>

<?php
$mb_sidebar_position = get_post_meta( $post->ID, 'ct_mb_sidebar_position', true);
$ct_breadcrumb = $ct_options['ct_breadcrumb'];

if ( $mb_sidebar_position == '' ) $mb_sidebar_position = 'right';

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
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header>

						<div class="entry-content clearfix">
							<?php the_content(); ?>
						</div><!-- .entry-content -->

						<!-- archive-lists -->
						<div class="row entry-archives">
							<div class="col-lg-4">
								<h3><?php _e('Last 30 Posts', 'color-theme-framework') ?></h3>
								
								<ul class="archives ct-posts-archives">
									<?php $archive_30 = get_posts('numberposts=30');
									foreach($archive_30 as $post) : ?>
										<li class="ct-google-font"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
									<?php endforeach; ?>
								</ul>
							</div><!-- .col-lg-4 -->

							<div class="col-lg-4">
								<h3><?php _e('Archives by Month:', 'color-theme-framework') ?></h3>
								
								<ul class="archives ct-monthly-archives" style="">
									<?php wp_get_archives('type=monthly'); ?>
								</ul>
							</div><!-- .col-lg-4 -->

							<div class="col-lg-4">
								<h3><?php _e('Archives by Subject:', 'color-theme-framework') ?></h3>
								
								<ul class="archives ct-subject-archives">
									<?php wp_list_categories( 'title_li=' ); ?>
								</ul>
							</div><!-- .col-lg-4 -->
						</div>
						<!-- .archive-lists -->
					</article><!-- #post -->
				<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- .col-lg-8 -->

		<div id="secondary" class="widget-area <?php echo $sidebar_class.' '.$col_lg_pull; ?>" role="complementary">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('ct_page_sidebar') ) : ?>
			<?php endif; ?>
		</div><!-- .col-lg-4 -->
	</div><!-- .row -->
</div> <!-- .container -->

<?php get_footer(); ?>