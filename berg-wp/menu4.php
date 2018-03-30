<?php
/*
Template Name: Food Menu List NEW
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

global $items_links;
$items_links = YSettings::g('berg_food_menu_links');

if (YSettings::g('food_menu_sticky_category') == '1') {
	$stickyClass = 'list-category-sticky';
} else {
	$stickyClass = '';
}

$class = '';
$contentPosition = get_post_meta(get_the_id(), 'menu_content_position', true);
if($contentPosition === false) {
	$contentPosition = 'below'; 
}

?>

<section id="menu-list-new" class="section-scroll main-section menu <?php echo $stickyClass ;?>">
	<?php
	$termsArray = array();
	$categories = get_post_meta(get_the_id());
	$order = get_option('berg_menu_categories_order');
	if($order != '') {
		$order = explode(',', $order);
	}

	if (isset($categories['menu_categories'][0])) {
		$categories = maybe_unserialize($categories['menu_categories'][0]);
		$terms = get_terms('berg_menu_categories', array('include'=>$categories, 'hide_empty'=>false));
		foreach ($terms as $term) {
			$termsArray[$term->term_id] = array('name'=>$term->name, 'slug'=>$term->slug, 'ID'=>$term->term_id);
		}
	} else {
		$termsExclude = '';
		$categories = '';
		if($order != false && $order != '') {
			$terms = get_terms('berg_menu_categories', array('hide_empty'=>true, 'include'=>$order, 'orderby'=>'include'));
			$termsExclude = get_terms('berg_menu_categories', array('hide_empty'=>true, 'exclude'=>$order));
		} else {
			$terms = get_terms('berg_menu_categories', array('hide_empty'=>true));
		}

		foreach ($terms as $term) {
			$termsArray[$term->term_id] = array('name'=>$term->name, 'slug'=>$term->slug, 'ID'=>$term->term_id);
			$categories[] = $term->term_id;
		}
		if($termsExclude != '') {
			foreach ($termsExclude as $term) {
				$termsArray[$term->term_id] = array('name'=>$term->name, 'slug'=>$term->slug, 'ID'=>$term->term_id);
				$categories[] = $term->term_id;
			}	
		}
	}
	?>

	<?php if($contentPosition === 'above' && $post->post_content != '' && $post->post_content != '' && $post->post_content != '[vc_row el_class="hidden"][vc_column width="1/1"][/vc_column][/vc_row]') : ?>
		<div class="container above-content">
			<div class="row">
				<div class="col-md-12">
					<?php echo apply_filters('the_content', $post->post_content); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>


	<?php if (count($categories) > 1 && YSettings::g('berg_food_menu_filters') == 1): ?>
	<div class="list-category-wrapper">
	<ul class="list-category">
		<?php if (is_array($categories)): ?>
		<?php foreach ($categories as $cat) : ?>
			<?php if (isset($termsArray[$cat])): ?>
			<li>
				<span class="filter" data-filter=".category-<?php echo $termsArray[$cat]['ID']; ?>"><?php echo $termsArray[$cat]['name'] ?></span>
			</li>
			<?php endif; ?>
		<?php endforeach; ?>
		<?php endif; ?>
	</ul>
	</div>
	<?php else : $class = 'padding-filters' ;?>
	<?php endif; ?>

	<div class="menu-content <?php echo $class ;?>">
		<?php  if (is_array($categories)) : ?>
		<?php foreach ($categories as $cat) : ?>
		<?php $term_meta = get_option("taxonomy_$cat");	?>
		<?php if(isset($term_meta['menu_category_icon_image']) && $term_meta['menu_category_icon_image'] != '') {
				if(is_numeric($term_meta['menu_category_icon_image'])) {

					$image = wp_get_attachment_image_src($term_meta['menu_category_icon_image'], 'large', '', array('class' => 'upload-img upload-img-id'));
					$class = '';
					$style = "background-image: url(". esc_url( $image[0] )."); background-position: center center; background-size: cover;";
					$overlay = '<div class="overlay-section-header" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.4);"></div>';
					$parallax = 'data-background="'.esc_url( $image[0] ).'"';
				} else {
					$class = '';
					$style = "background-image: url(". esc_url( $term_meta['menu_category_icon_image'] )."); background-position: center center; background-size: cover;";
					$overlay = '<div class="overlay-section-header" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.4);"></div>';
					$parallax = 'data-background="'.esc_url( $term_meta['menu_category_icon_image'] ).'"';
				}
			} else {
				$style = $overlay = '';
				$class = 'no-img-header';
				$parallax = '';
			}
		;?>
		<div class="category-<?php echo $termsArray[$cat]['ID']; ?>" data-myorder="1">
			<!-- Setting: Box Section Header-->
			<div class="container boxed-section-header <?php echo $class ;?>">

				<div class="row">
					<div class="col-xs-12">
						<div class="menu-category fixed visible" style="<?php echo $style ;?>position: relative; " <?php echo $parallax; ?>>
						<?php echo $overlay ;?>
						<h2><?php echo $termsArray[$cat]['name']; ?></h2>
							<?php
							$description = term_description($cat, 'berg_menu_categories');
							if ($description != ''):
						?>
				
						<div class="category-description">
							<!-- <div class="col-md-12"> -->
								<?php echo $description; ?>
							<!-- </div> -->
							<!-- </div> -->
						</div>

						<?php endif; ?>
						</div>
					</div>
				</div>

			</div>
			<!--End Setting: Box Section Header-->
			
			<div class="container">
				<div class="row">
					<!-- <div class="col-md-12"> -->
					
						<?php
						
					
						$term_id = $termsArray[$cat]['ID'];
						$termchildren = get_term_children($term_id, 'berg_menu_categories');
						if(is_array($order)) {
							$termchildren = array_intersect($order,$termchildren);
						}
						$term_meta = get_option("taxonomy_$cat");	

						if(!empty($termchildren)) {
							echo '	<div class="grid"><div class="grid-sizer"></div>';
							foreach ( $termchildren as $child ) {
								$term = get_term_by( 'id', $child, 'berg_menu_categories' );
								echo '<div class="grid-item menu-grid-item">';
								echo '<h3>' . $term->name ;
								$description = term_description($child, 'berg_menu_categories');
								if ($description != '') {
									echo '<div class="category-description">'.$description.'</div>';
								}
								echo '</h3>';
								if (isset($term_meta['order'])) {
									$the_query = new WP_Query(array('post_type'=>'berg_menu', 'posts_per_page'=>-1, 'orderby'=>'post__in', 'post__in'=>maybe_unserialize($term_meta['order']), 'tax_query'=>array(array('taxonomy'=>'berg_menu_categories', 'terms'=>$child, 'field' => 'term_id'))));
									$the_query2 = new WP_Query(array('posts_per_page'=>-1, 'post_type'=>'berg_menu', 'orderby'=>'post__in', 'post__not_in'=>maybe_unserialize($term_meta['order']), 'tax_query'=>array(array('taxonomy'=>'berg_menu_categories', 'terms'=>$child, 'field' => 'term_id'))));
								} else {
									$the_query = new WP_Query(array('post_type'=>'berg_menu', 'posts_per_page'=>-1, 'tax_query'=>array(array('taxonomy'=>'berg_menu_categories', 'terms'=>$child, 'field' => 'term_id'))));
								}
								if ($the_query->have_posts()) {
									while ($the_query->have_posts()) {
										$the_query->the_post();							
										get_template_part('menu', 'single4');
									}
							
								}

								if (isset($the_query2)) {
									if ($the_query2->have_posts()) {
										while ($the_query2->have_posts()) {
											$the_query2->the_post();
											get_template_part('menu', 'single4');
										}
									}
								
								}
								echo '</div>';
							
							}
							echo '</div>';
						} else {
							if (isset($term_meta['order'])) {
								$the_query = new WP_Query(array('post_type'=>'berg_menu', 'posts_per_page'=>-1, 'orderby'=>'post__in', 'post__in'=>maybe_unserialize($term_meta['order']), 'tax_query'=>array(array('taxonomy'=>'berg_menu_categories', 'terms'=>$cat, 'field' => 'term_id'))));
								$the_query2 = new WP_Query(array('posts_per_page'=>-1, 'post_type'=>'berg_menu', 'orderby'=>'post__in', 'post__not_in'=>maybe_unserialize($term_meta['order']), 'tax_query'=>array(array('taxonomy'=>'berg_menu_categories', 'terms'=>$cat, 'field' => 'term_id'))));
							} else {
								$the_query = new WP_Query(array('post_type'=>'berg_menu', 'posts_per_page'=>-1, 'tax_query'=>array(array('taxonomy'=>'berg_menu_categories', 'terms'=>$cat, 'field' => 'term_id'))));
							}
							if ($the_query->have_posts()) {
								while ($the_query->have_posts()) {
									$the_query->the_post();							
									get_template_part('menu', 'single4');
								}
						
							}

							if (isset($the_query2)) {
								if ($the_query2->have_posts()) {
									while ($the_query2->have_posts()) {
										$the_query2->the_post();
										get_template_part('menu', 'single4');
									}
								}
							
							}
						}
						

						
						
						
						?>
					
						<!-- </div> -->
					<!-- </div> -->
				</div>
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
		<?php endforeach; ?>
		<?php else: ?>
		<?php get_template_part('empty', 'menu'); ?>
		<?php endif ;?>
	</div>

	<?php if($contentPosition === 'below' && $post->post_content != '' && $post->post_content != '[vc_row el_class="hidden"][vc_column width="1/1"][/vc_column][/vc_row]') : ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php echo apply_filters('the_content', $post->post_content); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</section>
<?php
	berg_getFooter();
	get_template_part('footer'); 
?>