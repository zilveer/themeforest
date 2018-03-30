<?php
/**
 * Single portfolio template
 *
 * @package wpv
 * @subpackage health-center
 */

if(isset($_SERVER['HTTP_X_VAMTAM']) && $_SERVER['HTTP_X_VAMTAM'] == 'ajax-portfolio' && have_posts()) {
	the_post();

	list($terms_slug, $terms_name) = wpv_get_portfolio_terms();
	include 'single-portfolio-content.php';
	exit;
}

if(!wpv_is_reduced_response()):

get_header(); ?>
	<div class="row page-wrapper">
<?php endif; // reduced response ?>
		<?php WpvTemplates::left_sidebar() ?>

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php
				$rel_group = 'portfolio_'.get_the_ID();
				extract(wpv_get_portfolio_options('true', $rel_group));

				list($terms_slug, $terms_name) = wpv_get_portfolio_terms();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(WpvTemplates::get_layout().' '.$type); ?>>
				<div class="page-content">
					<?php
						global $wpv_has_header_sidebars;
						if( $wpv_has_header_sidebars)
							WpvTemplates::header_sidebars();

						$column_width = wpv_get_central_column_width();
						$size = $column_width;
					?>

					<div class="clearfix">
					<?php if($type != 'document'): ?>
						<div class="portfolio-image-wrapper fullwidth-folio">
							<?php
								if($type == 'gallery'):
									list($gallery, ) = WpvPostFormats::get_first_gallery(get_the_content(), null, 'single-portfolio');
									echo do_shortcode($gallery);
								elseif($type == 'video'):
									global $wp_embed;
									echo do_shortcode( $wp_embed->run_shortcode('[embed width="'.$size.'"]'.$href.'[/embed]') );
								elseif($type == 'html'):
									echo do_shortcode(get_post_meta(get_the_ID(), 'portfolio-top-html', true));
							 	else:
							 		the_post_thumbnail('single-portfolio');
								endif;
							?>
						</div>
					<?php endif ?>
					</div>

					<div class="portfolio-text-content">
						<?php include 'single-portfolio-content.php' ?>
					</div>

					<div class="clearboth">
						<?php comments_template(); ?>
					</div>
				</div>
			</article>

		<?php endwhile ?>

		<?php WpvTemplates::right_sidebar() ?>

		<?php if(wpv_get_optionb('show-related-portfolios') && WPV_Portfolio::in_category($terms_slug) > 1): ?>
			<div class="clearfix related-portfolios">
				<div class="grid-1-1">
					<?php echo apply_filters( 'wpv_related_portfolios_title', '<h2 class="related-content-title">'.wpv_get_option('related-portfolios-title').'</h3>' ) ?>
					<?php echo WPV_Portfolio::shortcode(array(
						'column' => 4,
						'cat' => $terms_slug,
						'ids' => '',
						'max' => 8,
						'height' => 400,
						'title' => 'below',
						'desc' => true,
						'more' => __('View', 'health-center'),
						'nopaging' => 'true',
						'group' => 'true',
						'layout' => 'scrollable',
						'post__not_in' => get_the_ID(),
					)); ?>
				</div>
			</div>
		<?php endif ?>
<?php if(!wpv_is_reduced_response()): ?>
	</div>
<?php get_footer(); ?>
<?php else: wpv_reduced_footer(); ?>
<?php endif; // reduced ?>