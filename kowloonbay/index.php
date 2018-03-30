<?php 
/* Header */
get_header();

global $kowloonbay_require_scripts;
$kowloonbay_require_scripts['stackbox'] = true;

global $kowloonbay_blog_url;
global $kowloonbay_blog_title;
global $kowloonbay_blog_desc;
global $kowloonbay_blog_layout;

global $kowloonbay_redux_opts;

$kowloonbay_blog_layout = get_query_var("blog_layout");
if ($kowloonbay_blog_layout === '') $kowloonbay_blog_layout = $kowloonbay_redux_opts['blog_layout'];

if (empty($kowloonbay_blog_layout)) $kowloonbay_blog_layout = 'masonry';

$blog_infinite_scroll = get_query_var("blog_infinite_scroll");
if ($blog_infinite_scroll === '') $blog_infinite_scroll = $kowloonbay_redux_opts['blog_infinite_scroll'];

$is_masonry = ($kowloonbay_blog_layout === 'masonry');
$no_sidebar = !($kowloonbay_blog_layout === 'left_sidebar' || $kowloonbay_blog_layout === 'right_sidebar');

global $kowloonbay_allowed_html;
?>

<section>
	<div class="section-heading">
		<h2><a href="<?php echo esc_url( $kowloonbay_blog_url ); ?>"><?php echo esc_html( $kowloonbay_blog_title ); ?></a></h2>
		<div class="row">
			<div class="col-md-4">
				<p class="section-desc"><?php echo esc_html( $kowloonbay_blog_desc ); ?></p>
			</div>
			<div class="col-md-8">
				<?php if ($no_sidebar) get_template_part('inc/kowloonbay-blog', 'toolbar'); ?>
			</div>
		</div>
	</div>

	<?php if ($no_sidebar) get_template_part('inc/kowloonbay-blog', 'stackboxes'); ?>

	<?php if (!$no_sidebar): ?>
	<div class="row">
	<?php endif; ?>

		<?php if ($kowloonbay_blog_layout === 'left_sidebar') get_sidebar(); ?>

		<?php if (!$no_sidebar): ?>
		<div class="col-md-8">
		<?php endif; ?>

			<?php if (is_archive() || is_tag() || is_category() || is_search()): ?>
			<div class="light-primary-bg-3 title-text-color title-font medium-text padding-v-half padding-h-1x margin-b-1x">
				<div class="row">
					<div class="col-md-6">

						<?php if (is_archive() && !is_tag() && !is_category()): ?>
						<strong><?php esc_html_e('Archive', 'KowloonBay'); ?>:</strong> <?php single_month_title(' '); ?>
						<?php endif; ?>

						<?php if (is_tag()): ?>
						<strong><?php esc_html_e('Tag', 'KowloonBay'); ?>:</strong> <?php single_tag_title(' '); ?>
						<?php endif; ?>

						<?php if (is_category()): ?>
						<strong><?php esc_html_e('Category', 'KowloonBay'); ?>:</strong> <?php single_cat_title(' '); ?>
						<?php endif; ?>

						<?php if (is_search()): ?>
						<strong><?php esc_html_e('Search', 'KowloonBay'); ?>:</strong> <?php echo esc_html(get_search_query() === '' ? '(Empty)' : get_search_query()) ; ?>
						<?php endif; ?>

					</div>
					<div class="col-md-6 text-right"><a href="<?php echo esc_url( $kowloonbay_blog_url ); ?>" class="alert-link">All Blog Posts<i class="fa fa-chevron-right fa-custom-sm fa-custom-margin-left fa-custom-no-margin-right"></i></a></div>
				</div>
			</div>
			<?php endif; ?>

			<ul class="blog-list list-reset <?php echo esc_attr($is_masonry?'two-cols':''); ?> jscroll-to-add">
				<?php

				// Retrieve sticky posts if there is any

				global $wp_query;
				$sticky = get_option('sticky_posts');
				$current_page = max(1, get_query_var('paged'));


				if ( $wp_query->is_home() && $wp_query->is_main_query() && sizeof($sticky) > 0 && $current_page === 1) {
					$sticky_query = new WP_Query(array(
						'posts_per_page' => -1,
						'post__in' => $sticky,
						'ignore_sticky_posts' => 1
						));
					if ($sticky_query->have_posts()){
						while($sticky_query->have_posts()){
							$sticky_query->the_post();
							get_template_part('inc/kowloonbay-blog', 'row');
						}
					}
				}

				wp_reset_postdata();
				?>

				<?php

				if (have_posts()){
					while(have_posts()){
						the_post();
						get_template_part('inc/kowloonbay-blog', 'row');
					}
				}
				else{
					_e('<p>(No blog posts found)</p>', 'KowloonBay');
				}
				?>

			</ul>

		<?php if (!$no_sidebar): ?>
		</div>
		<?php endif; ?>

		<?php if ($kowloonbay_blog_layout === 'right_sidebar') get_sidebar(); ?>

	<?php if (!$no_sidebar): ?>
	</div>
	<?php endif; ?>

	<?php
	global $wp_query;
	$big = 999999999; // need an unlikely integer

	$paged = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages,
		'type'  => 'array',
		'prev_text'    => '&laquo;',
		'next_text'    => '&raquo;',
	) );

	if ($blog_infinite_scroll === '0'){
		if (is_array($paged)){
			echo '<div class="paging text-'. esc_attr( $kowloonbay_redux_opts['blog_pagination_align'] ). '"><ul class="pageList list-inline">';
			foreach ($paged as $p) {
				echo '<li>';
				echo wp_kses($p, $kowloonbay_allowed_html);
				echo '</li>';
			}
			echo '</ul></div>';
		}
	} else {
	echo '<div class="infinite-scroll">';
		if ($wp_query->max_num_pages > 1 && $wp_query->max_num_pages > $current_page){
			// for infinite scroll
			$nextArchivePageLink = add_query_arg('paged', $current_page + 1);
			echo '<a class="jscroll-next jscroll-to-add" href="'. esc_url( $nextArchivePageLink ) .'">Load More</a>';
		}
		echo '</div>';
	}

	wp_reset_postdata();
	?>

</section>

<?php
/* Footer */
get_footer();