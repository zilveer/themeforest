<?php
/*
Template Name: Blog Masonry
*/

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package berg-wp
 */

get_header(); 

$args = array('all');
$the_query = new WP_Query( $args );

$post_meta = get_post_meta(get_the_id());
$categories = $post_meta;

if (isset($categories['blog_categories'][0])) {
	$categories = maybe_unserialize($categories['blog_categories'][0]);
} else {
	$categories = '';
}

$sidebar = '';
$posts_size_content = '';
$page_meta = $post_meta;
$pageId = get_the_id();

if (isset($page_meta['sidebar_settings'][0])) {
	$sidebar_settings = $page_meta['sidebar_settings'][0];

	if ($sidebar_settings == 'disabled') {
		$sidebar = 'hidden';
		$posts_size_content = 'col-md-8 col-md-offset-2';
	}
	if ($sidebar_settings == 'right') {
		$sidebar = 'sidebar-right';
		$posts_size_content = 'col-md-8';
	}
	if ($sidebar_settings == 'left') {
		$sidebar = 'sidebar-left';
		$posts_size_content = 'col-md-8 content-right';
	}
}
if (isset($page_meta['sidebar_object'][0])) {
	$sidebar_object = $page_meta['sidebar_object'][0];
}

$default_layout = array(
	'w2-h2', 'w2-h1', 'w1-h1', 'w1-h1',
	'w1-h1', 'w1-h2', 'w1-h1', 'w1-h1', 'w1-h1', 'w2-h1',
	'w1-h1', 'w1-h1', 'w2-h2', 'w1-h1', 'w1-h1',
	'w2-h1', 'w1-h1', 'w1-h1',
	'w2-h1', 'w1-h2', 'w1-h1', 'w1-h1', 'w1-h1', 'w1-h1',
	'w2-h1', 'w1-h1', 'w1-h1', 'w1-h1', 'w1-h1', 'w2-h1',
	'w1-h1', 'w2-h1', 'w1-h1',
	'w1-h1', 'w1-h1', 'w2-h1',
	'w1-h1', 'w2-h2', 'w1-h1', 'w1-h1', 'w1-h1',
);
$custom_layout = YSettings::g('berg_blog_masonry_layout', $pageId);

if ( isset($custom_layout) && $custom_layout != '' ) {

	$custom_layout = str_replace('1', 'w1-h1', $custom_layout);
	$custom_layout = str_replace('2', 'w2-h1', $custom_layout);
	$custom_layout = str_replace('3', 'w1-h2', $custom_layout);
	$custom_layout = str_replace('4', 'w2-h2', $custom_layout);
	$custom_layout = explode(',', $custom_layout);
	$layouts = $custom_layout;
} else {
	$layouts = $default_layout;
}
$next_page = 2;
// global $layout_index;
$layout_index = 0;


?>
<section id="blog-new-masonry" class="section-scroll main-section blog-content" data-masonry-categories="" data-posts-count="<?php echo YSettings::g('blog_post_per_page');?> ">
	<?php if(YSettings::g('berg_show_page_title')) : ?>
	<header class="section-header">
		<h2 class="h3"><?php echo the_title();?></h2>
	</header>
	<?php endif; ?>
	<div class="blog-masonry">
		<div class="grid-sizer"></div>



		<?php
		if ($categories == '') {
			$the_query = new WP_Query(array(
				'posts_per_page' => YSettings::g('blog_post_per_page', $pageId)
			));
		} else {
			$the_query = new WP_Query(array(
				'posts_per_page' => YSettings::g('blog_post_per_page', $pageId),
				'tax_query' => array(array(
					'taxonomy' => 'category',
					'terms' => $categories,
					'field' => 'term_id'
				))
			));
		}
		?>
		
		<?php if ($the_query->have_posts()) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php
					include(locate_template('content-blog-masonry.php'));
					$layout_index++;

					if ( !isset($layouts[$layout_index]) ) {
						$layout_index = 0;
					}
				?>
			<?php endwhile; ?>
			<?php berg_wp_paging_nav(); ?>
		<?php else : ?>
			<?php get_template_part('content', 'none'); ?>
		<?php endif; ?>
		<div class="load-page-counter" data-next-page="<?php echo $next_page; ?>" data-next-layout="<?php echo $layout_index; ?>"></div>

		<div class="hidden-content"></div>
	</div>
	<?php if ($the_query->max_num_pages > 1) : ?>
	<article class="load-more post" data-layout="<?php echo $layout_index;?>">
		<div class="load-more-text">
			<span class="hidden-xs hidden-sm"><?php echo __('Load more', 'BERG'); ?></span>
			<button class="visible-xs visible-sm"><?php echo __('Load more', 'BERG'); ?></button>
		</div>
		<div class="js-loading "><div class="masonry-spinner"><div></div><div></div><div></div><div></div></div><div class="ie-fallback">Please wait...</div></div>
	</article>
	<?php endif; ?>

</section>
<?php
wp_reset_postdata();
berg_getFooter();
get_template_part('footer');