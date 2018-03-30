<?php
/*
Template Name: Portfolio Masonry
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
$custom_layout = YSettings::g('berg_masonry_layout');

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

global $layout_index1;
$layout_index1 = 0;
$pageId = get_the_id();
?>
<div id="gallery2" class="section-scroll main-section">
	<section id="gallery-wrapper" class="">
		<?php
		
		$categories = get_post_meta(get_the_id());

		if (isset($categories['portfolio_categories'][0])) {
			$categories = maybe_unserialize($categories['portfolio_categories'][0]);
			$terms = get_terms('berg_portfolio_categories', array('include'=>$categories, 'hide_empty' =>false));	
		} else {
			$categories = '';
			$terms = get_terms('berg_portfolio_categories');	
		}


		$termsArray = array();

		$categories = '';
		foreach ($terms as $term) {
			$termsArray[$term->term_id] = array('name'=>$term->name, 'slug'=>$term->slug);
			$categories[] = $term->term_id;
		}
		?>
		<?php if(count($categories) > 1 && YSettings::g('berg_portfolio_filters') == 1): ?>
		<ul class="list-category">
			<li>
				<span class="filter" data-filter="*"><?php echo __('Show all', 'BERG');?></span>
			</li>
			<?php if (is_array($categories)): ?>
			<?php foreach ($categories as $cat): ?>
			<li>
				<span class="filter" data-filter=".category-<?php echo $termsArray[$cat]['slug'] ?>"><?php echo $termsArray[$cat]['name'] ?></span>
			</li>
			<?php endforeach;?>
			<?php endif; ?> 
		</ul>
		<?php endif;?>
		<?php if(YSettings::g('berg_show_page_title')) : ?>
		<header class="section-header">
			<h2 class="h3"><?php the_title(); ?></h2>
		</header> 
		<?php endif; ?>
		<div class="portfolio-masonry">
			<div class="grid-sizer"></div>
			<?php
			$images = YSettings::g('berg_images_per_page', 9);

			
		$args = array(
			'post_type'=>'berg_portfolio',
			'posts_per_page'=> $images,
			'orderby'=>'date ID',
			'paged'=>1,
		);
		if (is_array($categories)) {
			$args['tax_query'] = array(array('taxonomy'=>'berg_portfolio_categories','terms'=>$categories,'field' => 'term_id'));
		}
		$the_query = new WP_Query($args);
				?>
			<!-- 	<div class="gallery-content three-columns" data-columns="3" data-pages="<?php //echo $the_query->max_num_pages;?>"> -->
				<?php
				if ($the_query->have_posts()) {
					while ($the_query->have_posts()) {
						$the_query->the_post();
						include(locate_template('portfolio-single2.php'));
						$layout_index1++;

						if ( !isset($layouts[$layout_index1]) ) {
							$layout_index1 = 0;
						}
					}
				} else {
					get_template_part('empty', 'portfolio');
				}
				?>
				<!-- </div> -->
				<div class="load-page-counter" data-next-layout="<?php echo $layout_index1; ?>"></div>
				<!-- <div class="load-page-counter" data-next-page="<?php //echo $next_page; ?>" data-next-layout="<?php //echo $layout_index1; ?>"></div> -->
				<div class="hidden-content"></div>

				<?php //if (isset($the_query)): ?>
			
		</div>
		<?php if ($the_query->max_num_pages > 1): ?>
		<article class="load-more post" data-layout="<?php echo $layout_index1;?>">
			<div class="load-more-text">
				<span class="hidden-xs hidden-sm"><?php echo __('Load more', 'BERG');?></span>
				<button class="visible-xs visible-sm"><?php echo __('Load more', 'BERG');?></button>
			</div>
			<div class="js-loading "><div class="masonry-spinner"><div></div><div></div><div></div><div></div></div><div class="ie-fallback">Please wait...</div></div>
		</article>
		<?php endif; ?>
	</section>
</div>
<?php wp_reset_postdata(); ?>
<?php
	berg_getFooter();
	get_template_part('footer'); 
?>