<?php
/* ************************************
* Sort it for the Display List too
*************************************** */
add_filter( 'posts_orderby', 'mtheme_orderby');
function mtheme_orderby($orderby){
global $wpdb;

if (is_admin())
$orderby = "{$wpdb->posts}.menu_order, {$wpdb->posts}.post_date DESC";

return($orderby);
}

/* ************************************
* Ajax Sort for Featured
*************************************** */
function enable_featured_sort() {
    add_submenu_page('edit.php?post_type=mtheme_featured', 'Sort Fullscreen', 'Sort Fullscreen Slides', 'edit_posts', basename(__FILE__), 'sort_featured');
}
add_action('admin_menu' , 'enable_featured_sort');

 
/**
 * Display Sort admin
 *
 * @return void
 * @author Soul
 **/
function sort_featured() {
	$featured = new WP_Query('post_type=mtheme_featured&posts_per_page=-1&orderby=menu_order&order=ASC');
?>
	<div class="wrap">
	<h2>Sort Featured Slides<img src="<?php echo home_url(); ?>/wp-admin/images/loading.gif" id="loading-animation" /></h2>
	<div class="description">
	Drag and Drop the slides to order them
	</div>
	<ul id="featured-list">
	<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>
		<li id="<?php the_id(); ?>">
		<?php $image_url=wp_get_attachment_thumb_url( get_post_thumbnail_id() );	?>
		<?php if ($image_url) { echo '<img class="mtheme_admin_sort_image" src="'.$image_url.'" width="30px" height="30px" alt="" />'; } ?>
		<span class="mtheme_admin_sort_title"><?php the_title(); ?></span>
		</li>		
	<?php endwhile; ?>
	</div><!-- End div#wrap //-->
 
<?php
}

/**
 * Upadate the Featured Sort order
 *
 * @return void
 * @author Soul
 **/
function save_featured_order() {
	global $wpdb; // WordPress database class
 
	$order = explode(',', $_POST['order']);
	$counter = 0;
 
	foreach ($order as $sort_id) {
		$wpdb->update($wpdb->posts, array( 'menu_order' => $counter ), array( 'ID' => $sort_id) );
		$counter++;
	}
	die(1);
}
add_action('wp_ajax_featured_sort', 'save_featured_order');






/* ************************************
* Ajax Sort for Portfolio
*************************************** */

function enable_portfolio_sort() {
    add_submenu_page('edit.php?post_type=mtheme_portfolio', 'Sort Portfolio', 'Sort Portfolio Slides', 'edit_posts', basename(__FILE__), 'sort_portfolio');
}
add_action('admin_menu' , 'enable_portfolio_sort');

 
/**
 * Display Sort admin
 *
 * @return void
 * @author Soul
 **/
function sort_portfolio() {
	$portfolio = new WP_Query('post_type=mtheme_portfolio&posts_per_page=-1&orderby=menu_order&order=ASC');
?>
	<div class="wrap">
	<h2>Sort portfolio Slides<img src="<?php echo home_url(); ?>/wp-admin/images/loading.gif" id="loading-animation" /></h2>
	<div class="description">
	Drag and Drop the slides to order them
	</div>
	<ul id="portfolio-list">
	<?php while ( $portfolio->have_posts() ) : $portfolio->the_post(); ?>
		<li id="<?php the_id(); ?>">
		<div>
		<?php 
		$image_url=wp_get_attachment_thumb_url( get_post_thumbnail_id() );
		$custom = get_post_custom(get_the_ID());
		$portfolio_cats = get_the_terms( get_the_ID(), 'types' );
		
		?>
		<?php if ($image_url) { echo '<img class="mtheme_admin_sort_image" src="'.$image_url.'" width="30px" height="30px" alt="" />'; } ?>
		<span class="mtheme_admin_sort_title"><?php the_title(); ?></span>
		<?php
		if ($portfolio_cats) {
		?>
		<span class="mtheme_admin_sort_categories"><?php foreach ($portfolio_cats as $taxonomy) { echo ' | ' . $taxonomy->name; } ?></span>
		<?php
		}
		?>
		</div>

		</li>
	<?php endwhile; ?>
	</div><!-- End div#wrap //-->
 
<?php
}

/**
 * Upadate the portfolio Sort order
 *
 * @return void
 * @author Soul
 **/
function save_portfolio_order() {
	global $wpdb; // WordPress database class
 
	$order = explode(',', $_POST['order']);
	$counter = 0;
 
	foreach ($order as $sort_id) {
		$wpdb->update($wpdb->posts, array( 'menu_order' => $counter ), array( 'ID' => $sort_id) );
		$counter++;
	}
	die(1);
}
add_action('wp_ajax_portfolio_sort', 'save_portfolio_order');

?>