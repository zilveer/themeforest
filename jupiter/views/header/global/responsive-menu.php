<?php

/**
 * template part for responsive search. views/header/global
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */

global $mk_options;

if(!is_header_show() && $view_params['is_shortcode'] != 'true') return false;

$menu_location = !empty($view_params['menu_location']) ? $view_params['menu_location'] : mk_main_nav_location();

$hide_header_nav = isset($mk_options['hide_header_nav']) ? $mk_options['hide_header_nav'] : 'true';

?>

<div class="mk-responsive-wrap">

	<?php if($hide_header_nav != 'false') { 
		echo wp_nav_menu(array(
		    'theme_location' => $menu_location,
		    'container' => 'nav',
		    'menu_class' => 'mk-responsive-nav',
		    'echo' => false,
		    'fallback_cb' => 'mk_link_to_menu_editor',
		    'walker' => new mk_main_menu_responsive_walker,
		));
	}
	?>

	<?php if ($mk_options['header_search_location'] != 'disable') { ?>
		<form class="responsive-searchform" method="get" action="<?php echo home_url('/'); ?>">
		    <input type="text" class="text-input" value="" name="s" id="s" placeholder="<?php _e('Search..', 'mk_framework'); ?>" />
		    <i><input value="" type="submit" /><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-icon-search'); ?></i>
		</form>
	<?php } ?>	

</div>
