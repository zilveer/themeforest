<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package CookingPress
 */
$classes = 'col-md-3 col-md-pull-9';
if(is_singular()) {
	global $post;
	$layout  = get_post_meta($post->ID, 'pp_sidebar_layout', true);
} else {
	$layout = ot_get_option('pp_blog_layout','left-sidebar');
}
switch ($layout) {

	case 'left-sidebar':
	$classes = 'col-md-3 col-md-pull-9';
	break;

	case 'right-sidebar':
	$classes = 'col-md-3 col-md-offset-1';
	break;

	default:
	$classes = 'col-md-3 col-md-pull-9';
	break;
}
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $layout == 'right-sidebar' ) { $classes = 'col-md-3'; }
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $layout == 'left-sidebar' ) { $classes = 'col-md-3 col-md-pull-9'; }


?>
<div class="<?php echo $classes; ?>">
	<div id="secondary" class="sidebar widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php
		if(is_singular()) { $sidebar = get_post_meta($post->ID, "pp_sidebar_set", $single = true); } else { $sidebar='';}
		if ($sidebar) {
			if ( ! dynamic_sidebar(  $sidebar) ) { ?>

			<aside id="search" class="widget widget_search">
				<h3 class="widget-title"><span><?php _e( 'Search', 'cookingpress' ); ?></span></h3>
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h3 class="widget-title"><span><?php _e( 'Archives', 'cookingpress' ); ?></span></h3>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h3 class="widget-title"><span><?php _e( 'Meta', 'cookingpress' ); ?></span></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

			<?php }
		}
		if (!$sidebar) {
			if (!dynamic_sidebar('sidebar'))  { ?>
			<aside id="search" class="widget widget_search">
				<h3 class="widget-title"><span><?php _e( 'Search', 'cookingpress' ); ?></span></h3>
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h3 class="widget-title"><span><?php _e( 'Archives', 'cookingpress' ); ?></span></h3>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h3 class="widget-title"><span><?php _e( 'Meta', 'cookingpress' ); ?></span></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>
			<?php }
		} // end sidebar widget area ?>
	</div><!-- #secondary -->
</div>