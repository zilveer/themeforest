
<?php
/**
 * Template Name: Portfolio
 * The Portfolio base for MPC Themes
 *
 * Displays all portfolio posts.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */

get_header();

global $page_id;
global $paged;

$display_posts_number = get_field('mpc_display_posts_number');
if ($display_posts_number === false)
	$display_posts_number = get_option('posts_per_page');

$limit_visible_categories = array();
if (get_field('mpc_limit_visible_categories')) {
	$limit_visible_categories[] = array(
		'taxonomy' 	=> 'mpc_portfolio_cat',
		'field' 	=> 'id',
		'terms' 	=> get_field('mpc_limit_visible_categories')
	);
}

$query = new WP_Query();

$query->query(array(
	'post_type'			=> 'mpc_portfolio',
	'posts_per_page'	=> $display_posts_number,
	'paged'				=> $paged,
	'tax_query' 		=> $limit_visible_categories
));

$portfolio_columns = 4;
if (get_field('mpc_portfolio_columns'))
	$portfolio_columns = get_field('mpc_portfolio_columns');

$enable_category_filters = false;
//if (get_field('mpc_enable_category_filters') && empty($limit_visible_categories))
if ( get_field('mpc_enable_category_filters') )
	$enable_category_filters = true;


$portfolio_load_more = false;
if (get_field('mpc_portfolio_load_more'))
	$portfolio_load_more = get_field('mpc_portfolio_load_more');

?>

<div id="mpcth_main">
	<div id="mpcth_main_container">
		<?php get_sidebar(); ?>
		<div id="mpcth_content_wrap" class="<?php echo !$enable_category_filters ? 'mpcth-disable-filters' : ''; ?> <?php if ($portfolio_load_more) echo 'mpcth-load-more' ?>">
			<div id="mpcth_page_content">
				<?php //the_content(); ?>
			</div>
			<?php if ($enable_category_filters) { ?>
				<div id="mpcth_portfolio_sorts">
					<span><?php _e('Order by:', 'mpcth'); ?></span>
					<ul>
					<?php
						echo '<li class="mpcth-portfolio-sort mpcth-color-main-color-hover active" data-sort="data-date">' . __('Date', 'mpcth') . '</li>';
						echo '<li class="mpcth-portfolio-sort mpcth-color-main-color-hover" data-sort="data-title">' . __('Name', 'mpcth') . '</li>';
						echo '<li class="mpcth-portfolio-sort mpcth-color-main-color-hover" data-sort="random">' . __('Shuffle', 'mpcth') . '</li>';
					?>
					</ul>
					<select class="mpcth-portfolio-sort-select">
						<option value="data-date" selected=selected><?php _e('Date', 'mpcth'); ?></option>
						<option value="data-title"><?php _e('Name', 'mpcth'); ?></option>
						<option value="random"><?php _e('Shuffle', 'mpcth'); ?></option>
					</select>
				</div>
				<div id="mpcth_portfolio_filters">
					<span><?php _e('Filter by:', 'mpcth'); ?></span>
					<ul>
					<?php
						if( !empty( $limit_visible_categories ) )
							$all_categories = get_terms('mpc_portfolio_cat', array( 'include' => get_field('mpc_limit_visible_categories') ) );
						else
							$all_categories = get_terms('mpc_portfolio_cat');

						if (! empty($all_categories) && ! is_wp_error($all_categories)) {
							echo '<li class="mpcth-portfolio-filter mpcth-color-main-color-hover active" data-filter="all">' . __('All', 'mpcth') . '</li>';

							foreach ($all_categories as $category) {
								echo '<li class="mpcth-portfolio-filter mpcth-color-main-color-hover" data-filter="filter-' . $category->slug . '">' . $category->name . '</li>';
							}
						}
					?>
					</ul>
					<select class="mpcth-portfolio-filter-select">
					<?php
						if( !empty( $limit_visible_categories ) )
							$all_categories = get_terms('mpc_portfolio_cat', array( 'include' => get_field('mpc_limit_visible_categories') ) );
						else
							$all_categories = get_terms('mpc_portfolio_cat');

						if (! empty($all_categories) && ! is_wp_error($all_categories)) {
							echo '<option value="all" selected=selected>' . __('All', 'mpcth') . '</option>';

							foreach ($all_categories as $category) {
								echo '<option value="filter-' . $category->slug . '">' . $category->name . '</option>';
							}
						}
					?>
					</select>
				</div>
			<?php } ?>
			<div id="mpcth_content" class="mpcth-horizontal-columns-<?php echo $portfolio_columns; ?>">
				<?php if ($query->have_posts()) : ?>
					<?php while ($query->have_posts()) : $query->the_post();
						$post_format = get_post_format();

						if($post_format === false)
							$post_format = 'standard';

						$categories = get_the_terms(get_the_ID(), 'mpc_portfolio_cat');
						$categories_data = '';
						if ($categories && ! is_wp_error($categories)) {
							foreach ($categories as $category) {
								$categories_data .= ' filter-' . $category->slug ;
							}
						}

					?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('mpcth-post mpcth-waypoint' . $categories_data); ?> data-title="<?php the_title(); ?>" data-date="<?php the_date('Ymd'); ?>">
							<header class="mpcth-post-header">
								<div class="mpcth-post-thumbnail">
									<?php
									if ($portfolio_columns == 4) $portfolio_columns = 3;
									if (has_post_thumbnail()) {
										the_post_thumbnail('mpcth-horizontal-columns-' . $portfolio_columns);
									} elseif ($post_format == 'gallery') {
										$images = get_field('mpc_gallery_images');

										if (! empty($images))
											echo wp_get_attachment_image($images[0]['id'], 'mpcth-horizontal-columns-' . $portfolio_columns);
									} ?>
								</div>
							</header>
							<section class="mpcth-post-content">
								<a href="<?php the_permalink(); ?>" class="mpcth-post-background-link"></a>
								<?php mpcth_add_lightbox(); ?>
								<div class="mpcth-post-spacer"></div>
								<div class="mpcth-post-wrapper">
									<h5 class="mpcth-post-title">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
									</h5>
									<?php
									$categories = get_the_term_list(get_the_ID(), 'mpc_portfolio_cat', '', ', ', '');

									if ($categories)
										echo '<span class="mpcth-post-categories">' . $categories . '</span>';
									?>
								</div>
							</section>
						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<article id="post-0" class="mpcth-post mpcth-post-not-found">
						<header class="mpcth-post-header">
							<div class="mpcth-post-thumbnail">

							</div>
							<h3 class="mpcth-post-title">
								<?php _e('Nothing Found', 'mpcth'); ?>
							</h3>
							<div class="mpcth-post-meta">

							</div>
						</header>
						<section class="mpcth-post-content">
							<?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mpcth'); ?>
						</section>
						<footer class="mpcth-post-footer">

						</footer>
					</article>
				<?php endif; ?>
			</div><!-- end #mpcth_content -->
			<?php if ($query->max_num_pages > 1) { ?>
			<div id="mpcth_pagination">
				<?php
					if ($portfolio_load_more)
						mpcth_display_load_more($query);
					else
						mpcth_display_pagination($query);
				?>
			</div>
			<?php } ?>
		</div><!-- end #mpcth_content_wrap -->
	</div><!-- end #mpcth_main_container -->
</div><!-- end #mpcth_main -->

<?php get_footer();
