<?php

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

$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'original');
$img_url = $img_url[0];

if ($img_url != '') {
	$post_meta = get_post_meta(get_the_ID());

	if (isset($post_meta['section_intro'][0])) {
		$section_intro = $post_meta['section_intro'][0];

		if ($section_intro == 'section_intro_2') {
			get_template_part( 'intro', 'fullscreen');
		} else if($section_intro == 'section_intro_3') {
			get_template_part( 'intro', 'halfscreen' );
		}
	}
}
?>
	<section id="third-menu" class="section-scroll main-section menu">
		<div class="container-fluid menu-content mixitup">
		<?php
			$obj = get_queried_object();
			$cat = get_term($obj->term_id, 'berg_menu_categories');
		?>
		<div class="mix category-<?php echo $cat->slug;?>" data-myorder="1">
			<div class="row">
				<div class="col-xs-12 menu-category sticky-header sticky-header first-header fixed visible">
					<h2><?php echo $cat->name; ?></h2>
				</div>
			</div>
			<div class="container">
				<div class="row items-content">
					<?php 
					$t_id = $cat->term_id;
					$term_meta = get_option("taxonomy_$t_id");

					if (isset($term_meta['order'])) {
						$the_query = new WP_Query(array('post_type'=>'berg_menu', 'posts_per_page'=>-1, 'orderby'=>'post__in', 'post__in'=>maybe_unserialize($term_meta['order']), 'tax_query'=>array(array('taxonomy'=>'berg_menu_categories', 'terms'=>$cat->term_id, 'field' => 'term_id'))));
					} else {
						$the_query = new WP_Query(array('post_type'=>'berg_menu', 'posts_per_page'=>-1, 'tax_query'=>array(array('taxonomy'=>'berg_menu_categories', 'terms'=>$cat->term_id, 'field' => 'term_id'))));
					}

					if ($the_query->have_posts()) {
						while ($the_query->have_posts()) {
							$the_query->the_post(); 
							get_template_part('menu', 'single3');
						}
					} else {
						get_template_part('menu', 'none');
					}
					?>
				</div>
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	</section>
<?php get_template_part('footer'); ?>