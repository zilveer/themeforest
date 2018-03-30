<?php
/**
 * ThemesDepot Theme Specific Functions that do not belong to the framework,
 * and integrate with external plugins.
 *
 * Plugin integration: WP Restaurant Manager lite and pro.
 *
 * @package SmartFood
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Remove plugin specific css styles.
 * They will be overwritten by the theme.
 *
 * @since 1.0.0
 */
function tdp_remove_wprm_style_and_scripts() {

	wp_dequeue_style( 'wprm-front-css' );

}
add_action('wp_enqueue_scripts','tdp_remove_wprm_style_and_scripts');

/**
 * Adds theme specific menu styles options.
 *
 * @since 1.0.0
 */
function tdp_add_wprm_menu_styles( $menu_styles ) {

	unset($menu_styles['minimal']);

	$menu_styles['simple'] = __('Simple Menu List', 'smartfood');
	$menu_styles['simple_images'] = __('Images Menu List', 'smartfood');

	return $menu_styles;

}
add_action('wprm_get_menu_styles','tdp_add_wprm_menu_styles');

/**
 *  Extend body class depending on certain layout settings.
 *  @since 1.0.0
 */
function tdp_adjust_body_class_wprm_menu($classes) {
	
	$menu_style = wprm_get_option('menu_style');
	$classes[] = $menu_style;
	
    // return the $classes array
    return $classes;
}
add_filter('body_class','tdp_adjust_body_class_wprm_menu');

/**
 *  Enable Taxonomy Archive
 *  @since 1.0.0
 */
function tdp_wprm_enable_taxonomy_archive($args) {
	
	$args['exclude_from_search'] = false;
	
    return $args;
}
add_filter( 'wprm_menu_post_type_args','tdp_wprm_enable_taxonomy_archive');

/**
 *  Load all items into the taxonomy page.
 *  @since 1.0.0
 */
function tdp_wprm_taxonomy_archive_posts_per_page(&$query) {   

    if (!is_admin() && $query->is_main_query() && is_tax('menu_category')) {
        $query->set('posts_per_page', -1);
    }

    return $query;
}
add_action('pre_get_posts', 'tdp_wprm_taxonomy_archive_posts_per_page');

/**
 *  Class to overwrite the food category
 *  shortcode function.
 *  
 *  @since 1.0.0
 */
class TDP_Modify_Food_Category_Shortcode extends WPRM_Shortcodes {
	
	function __construct() {
       parent::__construct();
       remove_action( 'admin_head', array( $this, 'wprm_shortcodes_add_mce_button' ));
   }

	/**
	 * Menu Section/Category Shortcode
	 *
	 * @access public
	 * @since  1.0.0
	 * @return $output shortcode output
	 */
	public function wprm_menu_category_shortcode( $atts, $content=null ) {

		extract( shortcode_atts( array(
			'category_slug' => '',
			'category_title' => '',
			'category_description' => '',
			'hyperlink' => '',
			'description' => '',
			'price' => '',
			'display_images' => ''
		), $atts ) );

		if ( ! $category_slug )
			return;

		ob_start();

		$args = apply_filters('wprm_menu_category_args',array(
			'post_type'   => 'wprm_menu',
			'posts_per_page'	=> -1,
			'tax_query' => array(
				array(
					'taxonomy' => 'menu_category',
					'field'    => 'slug',
					'terms'    => esc_attr($category_slug),
				),
			),
		), $category_slug );

		$the_menu_category = get_term_by( 'slug', esc_attr($category_slug), 'menu_category');

		$menu_items = new WP_Query( $args );

		if ( $menu_items->have_posts() ) : 

			do_action( 'wprm_menu_category_before', $category_slug );

			?>
			<?php if($category_title == 'true'): ?>
			<div class="menu-box">
				<div class="menu-box-border">
					<div class="title"><?php echo $the_menu_category->name;?></div>
					<?php if($category_description == 'true'): ?>
					<div class="restaurant"><?php echo apply_filters( 'wprm_menu_category_description', $the_menu_category->description, $category_slug );?></div>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>

			<?php while ( $menu_items->have_posts() ) : $menu_items->the_post(); ?>

				<?php get_wprm_template( 'shortcode-single-menu-item.php', array(
						'hyperlink'     => esc_attr($hyperlink),
						'description'   => esc_attr($description),
						'price'			=> esc_attr($price),
						'display_images'=> esc_attr($display_images)
				)); ?>

			<?php endwhile; 

			do_action( 'wprm_menu_category_after', $category_slug );

			?>

		<?php endif;

		wp_reset_postdata();

		return '<div class="wprm_shortcode wprm_category_menu wprm_single_menu_item '.wprm_get_option('menu_style').'">' . ob_get_clean() . '</div>';

	}

	/**
	 * Full menu Shortcode
	 *
	 * @access public
	 * @since  1.0.0
	 * @return $output shortcode output
	 */
	public function wprm_menu_full( $atts, $content=null ) {

		extract( shortcode_atts( array(
			'category_title' => '',
			'category_description' => '',
			'hyperlink' => '',
			'description' => '',
			'price' => '',
			'display_images' => ''
		), $atts ) );

		ob_start();

		$menu_categories = get_terms( 'menu_category', 'hide_empty=0' );

		foreach ($menu_categories as $menu_category ) {

			$args = apply_filters('wprm_full_menu_args', array(
				'post_type'   => 'wprm_menu',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'menu_category',
						'field'    => 'slug',
						'terms'    => array($menu_category->slug),
					),
				),
			));

			$menu_items = new WP_Query( $args );

			if ( $menu_items->have_posts() ) : 

				do_action( 'wprm_fullmenu_before' );

				?>

				<?php if($category_title == 'true'): ?>
				<div class="menu-box">
					<div class="menu-box-border">
						<div class="title"><?php echo $menu_category->name;?></div>
						<?php if($category_description == 'true'): ?>
						<div class="restaurant"><?php echo apply_filters( 'wprm_menu_category_description', $menu_category->description, $menu_category->slug );?></div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>

				<?php while ( $menu_items->have_posts() ) : $menu_items->the_post(); ?>

					<?php get_wprm_template( 'shortcode-single-menu-item.php', array(
							'hyperlink'     => esc_attr($hyperlink),
							'description'   => esc_attr($description),
							'price'			=> esc_attr($price),
							'display_images'=> esc_attr($display_images)
					)); ?>

				<?php endwhile; 

				do_action( 'wprm_fullmenu_after' );

				?>

			<?php endif;

			wp_reset_postdata();

		}

		return '<div class="wprm_shortcode wprm_category_menu wprm_full_menu wprm_single_menu_item '.wprm_get_option('menu_style').'">' . ob_get_clean() . '</div>';

	}

}
new TDP_Modify_Food_Category_Shortcode();