<?php
/**
 * Template Name: Sitemap
 *
 * @package WordPress
 * @subpackage Strelok
 * @since Strelok 1.0
 *
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
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header>

						<div class="entry-content clearfix">
							<?php the_content(); ?>
						</div><!-- .entry-content -->

				<div class="entry-sitemap">
						<h3 id="posts"><?php _e('Posts','color-theme-framework'); ?></h3>
						<ul class="posts-name">
							<?php
						// Add categories seprated with comma (,) you'd like to hide to display on sitemap
					$cats = get_categories('exclude=');
					foreach ($cats as $cat) {
							echo "<li><h5>".$cat->cat_name."</h5>";
							echo "<ul>";
							query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
							while(have_posts()) {
							the_post();
							$category = get_the_category();
							// Only display a post link once, even if it's in multiple categories
							if ($category[0]->cat_ID == $cat->cat_ID) {
									echo '<li class="ct-google-font"><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
							}
							}
							echo "</ul>";
							echo "</li>";
					}
					?>
						</ul>

				<!-- Display Categories -->
						<h3><?php _e('Categories','color-theme-framework'); ?></h3>
						<ul class="category-name">
						<?php 
								//$catrssimg = "/img/icons/rss16x16.png";
								//$catrssurl = get_template_directory_uri() . $catrssimg;        
							wp_list_categories("sort_column=name&optioncount=1&hierarchical=0");
							//wp_list_categories("sort_column=name&feed_image=$catrssurl&optioncount=1&hierarchical=0");
						?>
						</ul>
			
				<!-- Display Pages -->
						<h3 id="pages"><?php _e('Pages','color-theme-framework'); ?></h3>
						<ul class="pages-name">
						<?php
					// Add pages seprated with comma[,] that you'd like to hide to display on sitemap
					wp_list_pages(
						array(
							'exclude' => '',
							'title_li' => '',
							 )
					);
				?>
						</ul>
				</div><!-- entry-sitemap -->
					</article><!-- #post -->
				<?php wp_reset_query();  ?>
			</div><!-- #content -->
		</div><!-- .col-lg-8 -->

		<div id="secondary" class="widget-area <?php echo $sidebar_class.' '.$col_lg_pull; ?>" role="complementary">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('ct_page_sidebar') ) : ?>
			<?php endif; ?>
		</div><!-- .col-lg-4 -->
	</div><!-- .row -->
</div> <!-- .container -->

<?php get_footer(); ?>