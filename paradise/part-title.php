<?php

if (is_front_page()) {
	$_title = '';
} elseif (is_singular()) {
	$_title = the_title(null, null, false);
} elseif (is_category()) {
	$_title = single_cat_title(null, false);
} elseif (is_tax()) {
	$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
	$_title = $term->name;
} elseif (is_search()) {
	$_title = sprintf(__('Search result for: <span>%s</span>', TEMPLATENAME), esc_attr(apply_filters('the_search_query', get_search_query(false))));
} elseif (is_author()) {
	$_title = sprintf(__( 'Posts by: <span>%s</span>', TEMPLATENAME ), get_the_author());
} elseif (is_archive()) {
	if (is_day())
		$_title = sprintf(__('Daily Archives: <span>%s</span>', TEMPLATENAME), get_the_date());
	elseif (is_month())
		$_title = sprintf(__('Monthly Archives: <span>%s</span>', TEMPLATENAME), get_the_date('F Y'));
	elseif (is_year())
		$_title = sprintf(__('Yearly Archives: <span>%s</span>', TEMPLATENAME), get_the_date('Y'));
	else
		$_title = __('All Archives', TEMPLATENAME);
}

if (!empty($_title)) :
 ?>
	<!-- Start Page Title -->
	<div class="PageTitle">
		<h1><?php echo $_title; ?></h1>
	</div>
	<!-- End Page Title -->
<?php
endif;

global $_theme_layout;
global $_theme_side_sidebar;
global $_theme_bottom_sidebar;
$_theme_layout = $_theme_side_sidebar = $_theme_bottom_sidebar = '';
if (is_singular()) {
	$_theme_layout = get_post_meta(get_the_ID(), 'layout', true);
	$_theme_side_sidebar = get_post_meta(get_the_ID(), 'side_bar', true);
	$_theme_bottom_sidebar = get_post_meta(get_the_ID(), 'bottom_bar', true);
}
if (empty($_theme_layout)) {
	if (is_page())
		$_theme_layout = get_option('default_pages_layout', 3);
	else
		$_theme_layout = get_option('default_blog_layout', 1);
}
if (empty($_theme_side_sidebar))
	if (is_category() || (is_single() && is_post_type('post')))
		$_theme_side_sidebar = get_option('blog_side_sidebar', 'disable');
	else
		$_theme_side_sidebar = get_option('default_side_sidebar', 'disable');
if (empty($_theme_bottom_sidebar))
	if (is_portfolio())
		$_theme_bottom_sidebar = get_option('portfolio_bottom_sidebar', 'disable');
	elseif (is_category())
		$_theme_bottom_sidebar = get_option('blog_bottom_sidebar', 'disable');
	elseif (is_tax('gallery'))
		$_theme_bottom_sidebar = get_option('gallery_bottom_sidebar', 'disable');
	else
		$_theme_bottom_sidebar = get_option('default_bottom_sidebar', 'disable');

?>