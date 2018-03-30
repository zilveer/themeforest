<?php
/*
Template Name: Portfolio Grid
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
$pageId = get_the_id();
?>
<div id="gallery" class="section-scroll main-section">
	<section id="gallery-wrapper" class="">
		<?php
		$categories = get_post_meta(get_the_id());

		if (isset($categories['portfolio_categories'][0])) {
			$categories = maybe_unserialize($categories['portfolio_categories'][0]);
			$terms = get_terms('berg_portfolio_categories', array('include'=>$categories, 'hide_empty'=>false));	
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
		<?php if(count($categories) > 1 && YSettings::g('berg_portfolio_filters') == 1 ) : ?>
		<ul class="list-category">
			<li>
				<span class="filter" data-filter="all"><?php echo __('Show all', 'BERG');?></span>
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
		<?php endif;?>
		<?php
		$images = YSettings::g('berg_images_per_page');
		$colCount = YSettings::g('berg_column_count');
		$col = '';
		if($colCount == 'two-columns') {
			$col = '2';
		} elseif ($colCount == 'three-columns') {
			$col = '3';
		} elseif ($colCount == 'four-columns') {
			$col = '4';
		}
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
			<div class="gallery-content <?php echo $colCount ;?>" data-columns="<?php echo $col;?>" data-pages="<?php echo $the_query->max_num_pages;?>">
			<?php
			if ($the_query->have_posts()) {
				while ($the_query->have_posts()) {
					$the_query->the_post();
					include(locate_template('portfolio-single.php'));
					// get_template_part('portfolio', 'single');
				}
			}
			?>
			</div>
			<div class="new-content hidden"></div>

			<?php if ($the_query->max_num_pages > 1): ?>
			<div class="load-more post">
				<div class="load-more-text">
					<span class="hidden-xs hidden-sm"><?php echo __('Load more', 'BERG');?></span>
					<button class="visible-xs visible-sm"><?php echo __('Load more', 'BERG');?></button>
				</div>
				<div class="js-loading "><div class="masonry-spinner"><div></div><div></div><div></div><div></div></div><div class="ie-fallback">Please wait...</div></div>
			</div>
		<?php endif; ?>
	</section>
</div>
<?php wp_reset_postdata(); ?>
<?php
	berg_getFooter();
	get_template_part('footer'); 
?>