<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 10/29/2015
 * Time: 4:10 PM
 */
$g5plus_options = &G5Plus_Global::get_options();

$layout_style = isset($_GET['layout']) ? $_GET['layout'] : '';
if (!in_array($layout_style, array('full','container','container-fluid'))) {
	$layout_style = isset($g5plus_options['search_layout']) ? $g5plus_options['search_layout'] : 'container';
}

$sidebar = isset($_GET['sidebar']) ? $_GET['sidebar'] : '';
if (!in_array($sidebar, array('none','left','right','both'))) {
	$sidebar = isset($g5plus_options['search_sidebar']) ? $g5plus_options['search_sidebar'] : 'left' ;
}

$sidebar_width = isset($_GET['sidebar_width']) ? $_GET['sidebar_width'] : '';
if (!in_array($sidebar_width, array('small','large'))) {
	$sidebar_width = isset($g5plus_options['search_sidebar_width']) ? $g5plus_options['search_sidebar_width'] : 'small';
}

$left_sidebar = isset($g5plus_options['search_left_sidebar']) ? $g5plus_options['search_left_sidebar'] : '';
$right_sidebar = isset($g5plus_options['search_right_sidebar']) ? $g5plus_options['search_right_sidebar'] : '';

$sidebar_col = 'col-md-3';
if ($sidebar_width == 'large') {
	$sidebar_col = 'col-md-4';
}

$content_col_number = 12;
if (is_active_sidebar( $left_sidebar ) && (($sidebar == 'both') || ($sidebar == 'left'))) {
	if ($sidebar_width == 'large') {
		$content_col_number -= 4;
	}
	else {
		$content_col_number -= 3;
	}
}
if (is_active_sidebar( $right_sidebar ) && (($sidebar == 'both') || ($sidebar == 'right'))) {
	if ($sidebar_width == 'large') {
		$content_col_number -= 4;
	}
	else {
		$content_col_number -= 3;
	}
}

$content_col = 'col-md-' . $content_col_number;
if (($content_col_number == 12) && ($layout_style == 'full')) {
	$content_col = '';
}

global $wp_query;
$total_results = $wp_query->found_posts;

?>
<?php
/**
 * @hooked - g5plus_archive_heading - 5
 **/
do_action('g5plus_before_archive');
?>
<main class="page-search margin-bottom-100">
	<?php if ($layout_style != 'full'): ?>
		<div class="<?php echo esc_attr($layout_style) ?> clearfix">
	<?php endif;?>
			<?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
				<div class="row clearfix">
			<?php endif;?>

					<?php if (is_active_sidebar( $left_sidebar ) && (($sidebar == 'left') || ($sidebar == 'both'))): ?>
						<div class="sidebar left-sidebar <?php echo esc_attr($sidebar_col) ?> hidden-sm hidden-xs sidebar-<?php echo esc_attr($sidebar_width); ?>">
							<?php dynamic_sidebar( $left_sidebar );?>
						</div>
					<?php endif;?>

					<div class="page-search-inner <?php echo esc_attr($content_col) ?>">
						<div class="archive-search-wrap">
							<div class="archive-search-box">
								<div class="heading color-dark text-left">
									<h6 class="fs-32"><?php esc_html_e('New Search','g5plus-academia') ?></h6>
									<p class="s-font"><?php esc_html_e('If you are not happy with the results below please do another search','g5plus-academia') ?></p>
								</div>
								<div class="search-form-lg">
									<?php get_search_form(); ?>
								</div>
							</div>
							<div class="archive-search-result">
								<h6 class="fs-24"><?php printf(esc_html__('%s Search Results for: "%s"', 'g5plus-academia'),$total_results, get_search_query());?></h6>
							</div>
							<?php if (have_posts()) : ?>
							<div class="archive-search-wrap-inner">
								<?php
									while ( have_posts() ) : the_post();
										/*
										 * Include the post format-specific template for the content. If you want to
										 * use this in a child theme, then include a file called called content-___.php
										 * (where ___ is the post format) and that will be used instead.
										 */
										g5plus_get_template( 'archive/content-search');
									endwhile;
								?>
							</div>
							<?php endif; ?>

							<?php
							global $wp_query;
							if ( $wp_query->max_num_pages > 1 ) :
								?>
								<div class="blog-paging-default">
									<?php echo g5plus_paging_nav();?>
								</div>
							<?php endif;?>
						</div>
					</div>

					<?php if (is_active_sidebar( $right_sidebar ) && (($sidebar == 'right') || ($sidebar == 'both'))): ?>
						<div class="sidebar right-sidebar <?php echo esc_attr($sidebar_col) ?> hidden-sm hidden-xs sidebar-<?php echo esc_attr($sidebar_width); ?>">
							<?php dynamic_sidebar( $right_sidebar );?>
						</div>
					<?php endif;?>


			<?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
				</div>
			<?php endif;?>

	<?php if ($layout_style != 'full'): ?>
		</div>
	<?php endif;?>

</main>
