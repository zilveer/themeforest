<?php
class XMenuWalker extends Walker_Nav_Menu {
	public $current_item = array();
	public $items_parent = array();
	public $is_print_custom_style = false;
	public $tab_current = 0;
	public $multi_col_current = 0;
	public $stack_current = 0;

	public $xmenu_custom_style = '';

	function __construct(){
	}
	function custom_style_menu_item($item_id, $menu_data, $setting_options, $args){
		$item_style = '';
		$submenu_style = '';
		$icon_style = '';

		$item_style_active = '';
		$submenu_style_active = '';

		$item_text_style = '';
		$item_text_style_active = '';

		$item_feature_text_style= '';
		$item_feature_text_style_after= '';

		//icon style
		if (isset($menu_data['icon-padding']) && $menu_data['icon-padding']) {
			if (isset($menu_data['icon-position']) && $menu_data['icon-position'] == 'left') {
				$icon_style .= 'padding-right:' . $menu_data['icon-padding'] . ';';
			}
			else {
				$icon_style .= 'padding-left:' . $menu_data['icon-padding'] . ';';
			}
		}

		//menu-item
		if (isset($menu_data['layout-padding']) && $menu_data['layout-padding']) {
			$item_style .= 'padding:' . $menu_data['layout-padding'] . ';';
		}
		if (isset($menu_data['layout-margin']) && $menu_data['layout-margin']) {
			$item_style .= 'margin:' . $menu_data['layout-margin'] . ';';
		}
		if (isset($menu_data['custom-style-menu-bg-color']) && $menu_data['custom-style-menu-bg-color']) {
			$item_style .= 'color:' . $menu_data['custom-style-menu-bg-color'] . ';';
		}

		if (isset($menu_data['custom-style-menu-text-color']) && $menu_data['custom-style-menu-text-color']) {
			$item_style .= 'color:' . $menu_data['custom-style-menu-text-color'] . ';';
			$item_text_style .= 'color:' . $menu_data['custom-style-menu-text-color'] . ';';
		}

		if (isset($menu_data['custom-style-menu-bg-image']) && $menu_data['custom-style-menu-bg-image']) {
			$bg_image = $menu_data['custom-style-menu-bg-image'];
			$bg_image_attr_attachment = (isset($menu_data['custom-style-menu-bg-image-attachment']) && !empty($menu_data['custom-style-menu-bg-image-attachment']))
				? $menu_data['custom-style-menu-bg-image-attachment'] : 'scroll';
			$bg_image_attr_position = (isset($menu_data['custom-style-menu-bg-image-position']) && !empty($menu_data['custom-style-menu-bg-image-position']))
				? $menu_data['custom-style-menu-bg-image-position'] : 'center';
			$bg_image_attr_repeat = (isset($menu_data['custom-style-menu-bg-image-repeat']) && !empty($menu_data['custom-style-menu-bg-image-repeat']))
				? $menu_data['custom-style-menu-bg-image-repeat'] : 'no-repeat';
			$bg_image_attr_size = (isset($menu_data['custom-style-menu-bg-image-size']) && !empty($menu_data['custom-style-menu-bg-image-size']))
				? $menu_data['custom-style-menu-bg-image-size'] : 'auto';

			$item_style .= "background-image:url('$bg_image');background-attachment:$bg_image_attr_attachment;background-position:$bg_image_attr_position;background-repeat:$bg_image_attr_repeat;background-size:$bg_image_attr_size;";
		}

		//menu-item style ACTIVE/HOVER
		if (isset($menu_data['custom-style-menu-bg-color-active']) && $menu_data['custom-style-menu-bg-color-active']) {
			$item_style_active .= 'background-color:' . $menu_data['custom-style-menu-bg-color-active'] . ';';
		}
		if (isset($menu_data['custom-style-menu-text-color-active']) && $menu_data['custom-style-menu-text-color-active']) {
			$item_style_active .= 'color:' . $menu_data['custom-style-menu-text-color-active'] . ';';
			$item_text_style_active .= 'color:' . $menu_data['custom-style-menu-text-color-active'] . ';';
		}

		//sub menu style
		if (isset($menu_data['submenu-width-custom']) && $menu_data['submenu-width-custom']) {
			$submenu_style .= 'width:' . $menu_data['submenu-width-custom'] . ';';
		}

		if (isset($menu_data['custom-style-col-min-width']) && $menu_data['custom-style-col-min-width']) {
			$submenu_style .= 'min-width:' . $menu_data['custom-style-col-min-width'] . ';';
		}

		if (isset($menu_data['custom-style-padding']) && $menu_data['custom-style-padding']) {
			$submenu_style .= 'padding:' . $menu_data['custom-style-padding'] . ';';
		}
		if (isset($menu_data['custom-style-sub-menu-bg-color']) && $menu_data['custom-style-sub-menu-bg-color']) {
			$submenu_style .= 'background-color:' . $menu_data['custom-style-sub-menu-bg-color'] . ';';
		}

		if (isset($menu_data['custom-style-sub-menu-text-color']) && $menu_data['custom-style-sub-menu-text-color']) {
			$submenu_style .= 'color:' . $menu_data['custom-style-sub-menu-text-color'] . ';';
		}
		if (isset($menu_data['custom-style-sub-menu-bg-image']) && $menu_data['custom-style-sub-menu-bg-image']) {
			$bg_image = $menu_data['custom-style-sub-menu-bg-image'];
			$bg_image_attr_attachment = (isset($menu_data['custom-style-sub-menu-bg-image-attachment']) && !empty($menu_data['custom-style-sub-menu-bg-image-attachment']))
				? $menu_data['custom-style-sub-menu-bg-image-attachment'] : 'scroll';
			$bg_image_attr_position = (isset($menu_data['custom-style-sub-menu-bg-image-position']) && !empty($menu_data['custom-style-sub-menu-bg-image-position']))
				? $menu_data['custom-style-sub-menu-bg-image-position'] : 'center';
			$bg_image_attr_repeat = (isset($menu_data['custom-style-sub-menu-bg-image-repeat']) && !empty($menu_data['custom-style-sub-menu-bg-image-repeat']))
				? $menu_data['custom-style-sub-menu-bg-image-repeat'] : 'no-repeat';
			$bg_image_attr_size = (isset($menu_data['custom-style-sub-menu-bg-image-size']) && !empty($menu_data['custom-style-sub-menu-bg-image-size']))
				? $menu_data['custom-style-sub-menu-bg-image-size'] : 'auto';

			$submenu_style .= "background-image:url('$bg_image');background-attachment:$bg_image_attr_attachment;background-position:$bg_image_attr_position;background-repeat:$bg_image_attr_repeat;background-size:$bg_image_attr_size;";
		}

		// Menu Item Feature
		if (isset($menu_data['other-feature-text']) && !empty($menu_data['other-feature-text'])) {
			if (isset($menu_data['custom-style-feature-menu-text-bg-color']) && !empty($menu_data['custom-style-feature-menu-text-bg-color'])) {
				$item_feature_text_style .= 'background:' . $menu_data['custom-style-feature-menu-text-bg-color'] . ';';
				$item_feature_text_style_after .= 'border-top-color:' . $menu_data['custom-style-feature-menu-text-bg-color'] . ';';
			}
			if (isset($menu_data['custom-style-feature-menu-text-color']) && !empty($menu_data['custom-style-feature-menu-text-color'])) {
				$item_feature_text_style .= 'color:' . $menu_data['custom-style-feature-menu-text-color'] . ';';
			}
			if (isset($menu_data['custom-style-feature-menu-text-top']) && !empty($menu_data['custom-style-feature-menu-text-top'])
				&& is_numeric($menu_data['custom-style-feature-menu-text-top'])) {
				$item_feature_text_style .= 'top:' . $menu_data['custom-style-feature-menu-text-top'] . 'px;';
			}
			if (isset($menu_data['custom-style-feature-menu-text-left']) && !empty($menu_data['custom-style-feature-menu-text-left'])
				&& is_numeric($menu_data['custom-style-feature-menu-text-left'])) {
				$item_feature_text_style .= 'left:' . $menu_data['custom-style-feature-menu-text-left'] . 'px;';
			}
		}

		$menu_id_prefix = '';
		if (property_exists( $args, 'is_mobile_menu' ) && $args->is_mobile_menu == true) {
			$menu_id_prefix = 'mobile-';
		}

		//add style
		if (!empty($item_style)) {
			$this->xmenu_custom_style .= '#menu-item-' . $menu_id_prefix . $item_id . '{' . $item_style . '}';
		}
		if (!empty($item_text_style)) {
			$this->xmenu_custom_style .= '#menu-item-' . $menu_id_prefix . $item_id . ' > a{' . $item_text_style . '}';
		}
		if (!empty($item_style)) {
			$this->xmenu_custom_style .= '#menu-item-' . $menu_id_prefix . $item_id . ':hover,'
				. '#menu-item-' . $menu_id_prefix . $item_id . '.current-menu-item,'
				. '#menu-item-' . $menu_id_prefix . $item_id . '.current-menu-ancestor' . '{' . $item_style_active . '}';
		}
		if (!empty($item_text_style_active)) {
			$this->xmenu_custom_style .= '#menu-item-' . $menu_id_prefix . $item_id . ' > a:hover,'
				. '#menu-item-' . $menu_id_prefix . $item_id . '.current-menu-item > a,'
				. '#menu-item-' . $menu_id_prefix . $item_id . '.current-menu-ancestor > a' . '{' . $item_text_style_active . '}';
		}
		if (!empty($icon_style)) {
			$this->xmenu_custom_style .= '#menu-item-' . $menu_id_prefix . $item_id . ' .x-menu-icon' .'{' . $icon_style . '}';
		}
		if (!empty($submenu_style)) {
			$this->xmenu_custom_style .= '#menu-item-' . $menu_id_prefix . $item_id . ' > ul.x-sub-menu' .'{' . $submenu_style . '}';
		}
		if (!empty($submenu_style_active)) {
			$this->xmenu_custom_style .= '#menu-item-' . $menu_id_prefix . $item_id . ':hover > ul.x-sub-menu,'
				. '#menu-item-' . $menu_id_prefix . $item_id . '.current-menu-item > ul.x-sub-menu,'
				. '#menu-item-' . $menu_id_prefix . $item_id . '.current-menu-ancestor > ul.x-sub-menu'
				.'{' . $submenu_style_active . '}';
		}
		if (!empty($item_feature_text_style)) {
			$this->xmenu_custom_style .= '#menu-item-' . $menu_id_prefix . $item_id . ' span.x-menu-feature' .'{' . $item_feature_text_style . '}';
		}
		if (!empty($item_feature_text_style_after)) {
			$this->xmenu_custom_style .= '#menu-item-' . $menu_id_prefix . $item_id . ' span.x-menu-feature:after' .'{' . $item_feature_text_style_after . '}';
		}

		if (isset($menu_data['submenu-col-spacing-default']) && !empty($menu_data['submenu-col-spacing-default'])) {
			$this->xmenu_custom_style .= '#menu-item-' . $menu_id_prefix . $item_id . ' > ul.x-sub-menu > li+li' .'{padding-left:'. $menu_data['submenu-col-spacing-default'] . 'px}';
		}
	}
	function add_custom_style ($args, $setting_options) {
		// Get the nav menu based on the requested menu
		$menu = wp_get_nav_menu_object( $args->menu );
		// Get the nav menu based on the theme_location
		if ( ! $menu && $args->theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) )
			$menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );

		// get the first menu that has items if we still can't find a menu
		if ( ! $menu && !$args->theme_location ) {
			$menus = wp_get_nav_menus();
			foreach ( $menus as $menu_maybe ) {
				if ( $menu_items = wp_get_nav_menu_items( $menu_maybe->term_id, array( 'update_post_term_cache' => false ) ) ) {
					$menu = $menu_maybe;
					break;
				}
			}
		}

		if ( $menu && ! is_wp_error($menu) && !isset($menu_items) ) {
			$menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );
			if ($menu_items) {
				//get responsive breakpoint
				$responsive_breakpoint = 991;
				/*if (isset($setting_options['setting-responsive-breakpoint']) && !empty($setting_options['setting-responsive-breakpoint']) && is_numeric($setting_options['setting-responsive-breakpoint'])) {
					$responsive_breakpoint = $setting_options['setting-responsive-breakpoint'];
				}*/

				$this->xmenu_custom_style = '@media screen and (min-width: '. ($responsive_breakpoint + 1) . 'px) {';

				foreach	($menu_items as $key => $menu_item) {
					$menu_data = get_post_meta( $menu_item->ID, '_menu_item_xmenu_config', true );
					if ($menu_data) {
						$menu_data = json_decode($menu_data, true);
						$this->custom_style_menu_item($menu_item->ID, $menu_data, $setting_options, $args);
					}
				}
				$this->xmenu_custom_style .= '}';
			}
			add_action('wp_footer', array( &$this, 'print_custom_style' ), 100);
		}
	}

	function print_custom_style() {
		echo sprintf('<script>jQuery("style#g5plus_custom_style").append("%s");</script>', $this->xmenu_custom_style);
	}

	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		// check whether this item has children, and set $item->hasChildren accordingly
		$element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
		// continue with normal behavior
		return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}

	// begin: ul
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		global $xmenu_item_defaults;

		$menu_parent = null;
		if (count($this->items_parent) > 0) {
			$menu_parent = end($this->items_parent);
		}
		array_push($this->items_parent, $this->current_item);
		$xmenu_meta = get_post_meta( $this->current_item->ID, '_menu_item_xmenu_config', true );
		if ($xmenu_meta) {
			$xmenu_meta = json_decode($xmenu_meta, true);
			$xmenu_meta = array_merge($xmenu_item_defaults, $xmenu_meta);
		}
		else {
			$xmenu_meta = $xmenu_item_defaults;
		}

		$xmenu_parent_meta = array();
		if ($menu_parent) {
			$xmenu_parent_meta = get_post_meta( $menu_parent->ID, '_menu_item_xmenu_config', true );
			if ($xmenu_parent_meta) {
				$xmenu_parent_meta = json_decode($xmenu_parent_meta, true);
				$xmenu_parent_meta = array_merge($xmenu_item_defaults, $xmenu_parent_meta);
			}
			else {
				$xmenu_parent_meta = $xmenu_item_defaults;
			}
		}

		$sub_menu_type = 'standard';

		if (isset($xmenu_meta['submenu-type']) && !empty($xmenu_meta['submenu-type'])) {
			$sub_menu_type = $xmenu_meta['submenu-type'];
		}

		if ($sub_menu_type == 'tab') {
			if ($depth == 0) {
				$sub_menu_type = 'standard';
			}
			else {
				if ($xmenu_parent_meta && isset($xmenu_parent_meta['submenu-type']) && ($xmenu_parent_meta['submenu-type'] != 'multi-column')) {
					$sub_menu_type = 'standard';
				}
			}
		}

		$sub_menu_class = array();
		$sub_menu_class [] = 'x-sub-menu';
		$sub_menu_class [] = 'x-sub-menu-' . $sub_menu_type;

		if (isset($xmenu_meta['responsive-hide-mobile-css-submenu']) && ($xmenu_meta['responsive-hide-mobile-css-submenu'] == '1')) {
			$sub_menu_class[] = 'x-hide-sub-menu-mobile';
		}
		if (isset($xmenu_meta['responsive-hide-desktop-css-submenu']) && ($xmenu_meta['responsive-hide-desktop-css-submenu'] == '1')) {
			$sub_menu_class[] = 'x-hide-sub-menu-desktop';
		}

		if (isset($xmenu_meta['submenu-position']) && !empty($xmenu_meta['submenu-position'])) {
			$sub_menu_class [] = 'x-' . $xmenu_meta['submenu-position'];
		}
		if (isset($xmenu_meta['submenu-list-style']) && $xmenu_meta['submenu-list-style']) {
			$sub_menu_class [] = 'x-list-style-' . $xmenu_meta['submenu-list-style'];
		}

		if (isset($xmenu_meta['submenu-type']) && ($xmenu_meta['submenu-type'] =='tab') && isset($xmenu_meta['submenu-tab-position']) && $xmenu_meta['submenu-tab-position']) {
			$sub_menu_class [] = 'x-tab-position-' . $xmenu_meta['submenu-tab-position'];
		}
		if (isset($xmenu_meta['submenu-animation']) && $xmenu_meta['submenu-animation'] && ($xmenu_meta['submenu-animation'] != 'none')) {
			$sub_menu_class [] = $xmenu_meta['submenu-animation'];
		}
		if (isset($xmenu_meta['custom-content-value']) && $xmenu_meta['custom-content-value']) {
			$sub_menu_class [] = 'x-custom-content-wrapper';
		}

		if (isset($xmenu_meta['widget-area']) && $xmenu_meta['widget-area']) {
			$sub_menu_class [] = 'x-widget-area-wrapper';
		}

		if (isset($xmenu_meta['responsive-hide-mobile-css-submenu']) && $xmenu_meta['responsive-hide-mobile-css-submenu'] == '1') {
			$sub_menu_class [] = 'x-responsive-submenu-hide-mobile';
		}
		ob_start();
		?>
			<ul class="<?php echo join(' ', $sub_menu_class)?>">
		<?php
		$output .= ob_get_clean();
	}

	// end: ul
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$item = array_pop($this->items_parent);
		$output .= "</ul>";
	}

	// begin: li
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		global $xmenu_item_defaults;
		$this->current_item = $item;
		if (is_array($args)) {
			$args = (object) $args;
		}

		$term_slug = 'xmenu-default';

		$setting_default = _XMENU_SETTING()->get_setting_defaults();

		$terms_current = wp_get_post_terms($item->ID, 'nav_menu');
		if (count($terms_current) > 0) {
			$terms_current = $terms_current[0];
		}
		$setting_options = false;
		if ($terms_current) {
			$setting_options = get_option(XMENU_SETTING_OPTIONS . '_' . $terms_current->slug);
			$term_slug = $terms_current->slug;
		}
		if ($setting_options === false) {
			$setting_options = get_option(XMENU_SETTING_OPTIONS);
			$term_slug = 'xmenu-default';
		}
		if ($setting_options) {
			$setting_options = array_merge($setting_default, $setting_options);
		}
		else {
			$setting_options = $setting_default;
		}


		if (!$this->is_print_custom_style) {
			$this->is_print_custom_style = true;
			$this->add_custom_style($args, $setting_options);

			global $xmenu_queue_css;
			if (!isset($xmenu_queue_css)) {
				$xmenu_queue_css = array();
			}

			$xmenu_queue_css[$term_slug] = ($term_slug == 'xmenu-default') ? 'style.css' : 'style_' . $term_slug . '.css';
			global $xmenu_queue_script_data;
			if (!isset($xmenu_queue_script_data)) {
				$xmenu_queue_script_data = array();
			}
			$xmenu_queue_script_data[$term_slug] = array(
				/*'use-affix' => $setting_options['menu-affix'] == '1',
				'affix-top' => $setting_options['menu-affix-offset'],
				'affix-style' => $setting_options['menu-affix-style'],*/
				//'setting-responsive-breakpoint' => $setting_options['setting-responsive-breakpoint'],
                'setting-responsive-breakpoint' => 991,
			);
		}
		$xmenu_meta = get_post_meta( $this->current_item->ID, '_menu_item_xmenu_config', true );
		if ($xmenu_meta) {
			$xmenu_meta = json_decode($xmenu_meta, true);
		}
		$xmenu_parent_meta = array();
		if (count($this->items_parent) > 0) {
			$item_parrent = end($this->items_parent);
			$xmenu_parent_meta = get_post_meta( $item_parrent->ID, '_menu_item_xmenu_config', true );
			if ($xmenu_parent_meta) {
				$xmenu_parent_meta = json_decode($xmenu_parent_meta, true);
			}
		}
		if ($xmenu_meta) {
			$xmenu_meta = array_merge($xmenu_item_defaults, $xmenu_meta);
		}
		else {
			$xmenu_meta = $xmenu_item_defaults;
		}

		// Add Class for li
		$item_classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$a_classes = array('x-menu-a-text');
		$span_classes = array('x-menu-text');
		$item_classes [] = 'x-menu-item';
		if (($xmenu_meta['submenu-type'] == 'tab') && ($depth > 0)) {
			$item_classes []= 'x-tabs';
		}

		if (isset($xmenu_meta['responsive-hide-mobile-css']) && ($xmenu_meta['responsive-hide-mobile-css'] == '1')) {
			$item_classes[] = 'x-hide-menu-item-mobile';
		}
		if (isset($xmenu_meta['responsive-hide-desktop-css']) && ($xmenu_meta['responsive-hide-desktop-css'] == '1')) {
			$item_classes[] = 'x-hide-menu-item-desktop';
		}
		if (isset($xmenu_meta['submenu-position']) && !empty($xmenu_meta['submenu-position'])) {
			$item_classes [] = 'x-' . $xmenu_meta['submenu-position'];
		}

		if (isset($xmenu_meta['other-disable-menu-item']) && $xmenu_meta['other-disable-menu-item'] == '1') {
			$a_classes [] = 'x-disable-menu-item';
		}

		if (isset($xmenu_meta['other-disable-link']) && $xmenu_meta['other-disable-link'] == '1') {
			$item_classes [] = 'x-disable-link';
		}

		if (isset($xmenu_meta['other-display-header-column']) && $xmenu_meta['other-display-header-column'] == '1') {
			$item_classes [] = 'x-header-column';
		}

		if ((isset($xmenu_meta['image-url']) && !empty($xmenu_meta['image-url'])) || (isset($xmenu_meta['image-feature']) && ($xmenu_meta['image-feature'] == '1'))) {
			$item_classes [] = 'x-item-image';
			if (isset($xmenu_meta['image-layout']) && $xmenu_meta['image-layout']) {
				$item_classes [] = 'x-image-layout';
				$item_classes [] = 'x-image-layout-' . $xmenu_meta['image-layout'];
			}
		}

		if (isset($xmenu_meta['layout-text-align']) && ($xmenu_meta['layout-text-align'] != 'none')) {
			$item_classes [] = 'x-text-align-' . $xmenu_meta['layout-text-align'];
		}
		if (isset($xmenu_meta['layout-new-row']) && $xmenu_meta['layout-new-row'] == '1') {
			$item_classes [] = 'x-new-row';
		}
		if (isset($xmenu_meta['custom-content-value']) && $xmenu_meta['custom-content-value']) {
			$item_classes [] = 'x-custom-content';
		}
		if (isset($xmenu_meta['widget-area']) && $xmenu_meta['widget-area']) {
			if (is_active_sidebar(XMENU_MENU_WIDGET_AREAS_ID . $item->post_name)) {
				$item_classes [] = 'x-widget-area';
			}
		}
		if (isset($xmenu_meta['responsive-hide-mobile-css']) && $xmenu_meta['responsive-hide-mobile-css'] == '1') {
			$item_classes [] = 'x-responsive-hide-mobile';
		}
		if (isset($xmenu_meta['responsive-hide-desktop-css']) && $xmenu_meta['responsive-hide-desktop-css'] == '1') {
			$item_classes [] = 'x-responsive-hide-desktop';
		}

		$sub_menu_type = 'standard';

		if (isset($xmenu_meta['submenu-type']) && !empty($xmenu_meta['submenu-type'])) {
			$sub_menu_type = $xmenu_meta['submenu-type'];
		}

		if ($sub_menu_type == 'tab') {
			if ($depth == 0) {
				$sub_menu_type = 'standard';
			}
			else {
				if ($xmenu_parent_meta && isset($xmenu_parent_meta['submenu-type']) && ($xmenu_parent_meta['submenu-type'] != 'multi-column')) {
					$sub_menu_type = 'standard';
				}
			}
		}

		$item_classes [] = 'x-sub-menu-' . $sub_menu_type;


		if (isset($xmenu_meta['layout-width']) && !empty($xmenu_meta['layout-width'])) {
			if (($xmenu_meta['layout-width'] == 'auto')){
				if ($xmenu_parent_meta && isset($xmenu_parent_meta['submenu-col-width-default'])
					&& !empty($xmenu_parent_meta['submenu-col-width-default'])
					&& ($xmenu_parent_meta['submenu-col-width-default'] != 'auto'))
				{
					$item_classes [] = $xmenu_parent_meta['submenu-col-width-default'] == 'full' ? 'x-col-12-12' : $xmenu_parent_meta['submenu-col-width-default'];
				}

			}
			else {
				$item_classes [] = $xmenu_meta['layout-width'] == 'full' ? 'x-col-12-12' : $xmenu_meta['layout-width'];
			}
		}


		if (!empty( $item->description )) {
			$item_classes [] = 'x-has-description';
		}

		// This is the stock Wordpress code that builds the <li> with all of its attributes
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $item_classes ), $item ) );

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' data-rel="'    . esc_attr( $item->xfn        ) .'"' : '';

		if (isset($xmenu_meta['other-disable-link']) && $xmenu_meta['other-disable-link'] == '1') {
			$attributes .= '';
		}
		else {
			$attributes .= ! empty( $item->url ) && ($xmenu_meta['other-disable-link'] != '1') ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		}
		$menu_id_prefix = '';
		if (property_exists( $args, 'is_mobile_menu' ) && $args->is_mobile_menu == true) {
			$menu_id_prefix = 'mobile-';
		}

		$output .= '<li id="menu-item-'. $menu_id_prefix . $item->ID . '" class="' . esc_attr($class_names) .'">';

		if (isset($xmenu_meta['other-disable-text']) && $xmenu_meta['other-disable-text'] == '1') {
			$span_classes [] = 'x-disable-text';
		}

		$icon_content = '';
		if (isset($xmenu_meta['icon-value']) && $xmenu_meta['icon-value']) {
			$icon_classes = array();
			$icon_classes[] = 'fa';
			$icon_classes[] = $xmenu_meta['icon-value'];
			if (isset($xmenu_meta['other-disable-text']) && $xmenu_meta['other-disable-text'] == '1') {
				$icon_classes [] = 'x-disable-text';
			}

			if (isset($xmenu_meta['icon-position']) && $xmenu_meta['icon-position']) {
				$icon_classes[] = 'x-icon-' . $xmenu_meta['icon-position'];
			}
			$icon_content = '<i class="x-menu-icon ' . join(' ', $icon_classes) .'"></i>';
		}
		$item_output = $args->before;

		if (isset($xmenu_meta['image-layout']) && ($xmenu_meta['image-layout'] != 'below')) {
			$item_output .= $this->get_menu_image($depth, $xmenu_meta, $setting_options, $item);
		}


		$item_output .= '<a'. $attributes .' class="' . join(' ', $a_classes) . '">';
		if (isset($xmenu_meta['icon-position']) && $xmenu_meta['icon-position'] == 'left') {
			$item_output .= $args->link_before . $icon_content . '<span class="' . join(' ', $span_classes) . '">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>';
		}
		else {
			$item_output .= $args->link_before . '<span class="' . join(' ', $span_classes) . '">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' . $icon_content;
		}

		$item_output .= $args->link_after;

		$menu_feature_class [] = 'x-menu-feature';
		if (isset($xmenu_meta['custom-style-feature-menu-text-type']) && !empty($xmenu_meta['custom-style-feature-menu-text-type'])) {
			$menu_feature_class [] = $xmenu_meta['custom-style-feature-menu-text-type'];
		}

		if (isset($xmenu_meta['icon-position']) && !empty($xmenu_meta['other-feature-text'])) {
			$item_output .= '<span class="' . join(' ',$menu_feature_class) .'">' . esc_html($xmenu_meta['other-feature-text']) .'</span>';
		}

		if ($item->hasChildren) {
			$item_output .= '<b class="x-caret"></b>';
		}

		$item_output .= '</a>';
		if (!empty( $item->description )) {
			$item_output .= '<p class="x-description">' . esc_html($item->description) . '</p>';
		}
		if ($depth > 0) {
			if (isset($xmenu_meta['image-layout']) && ($xmenu_meta['image-layout'] == 'below')) {
				$item_output .= $this->get_menu_image($depth, $xmenu_meta, $setting_options, $item);
			}

			if (isset($xmenu_meta['custom-content-value']) && $xmenu_meta['custom-content-value']) {
				$item_output .= '<div class="x-custom-content-wrapper">' .  apply_filters('xmenu_custom_content', $xmenu_meta['custom-content-value']) . '</div>';
			}

			if (isset($xmenu_meta['widget-area']) && $xmenu_meta['widget-area'] && ($xmenu_meta['widget-area'] != '-1')) {
				if (is_active_sidebar($xmenu_meta['widget-area'])) {
					ob_start();
					dynamic_sidebar( $xmenu_meta['widget-area'] );
					$item_output .= '<div class="x-widget-area-wrapper">' . ob_get_clean() . '</div>';
				}
			}
		}

		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		if (isset($xmenu_meta['submenu-type'])) {
			switch ($xmenu_meta['submenu-type']) {
				case 'multi-column':
					if ($this->multi_col_current == 0) {
						$this->multi_col_current = $item->ID;
					}
					break;
				case 'stack':
					if ($this->stack_current == 0) {
						$this->stack_current = $item->ID;
					}
					break;
				case 'tab':
					if ($this->tab_current == 0) {
						$this->tab_current = $item->ID;
					}

					break;
			}
		}
	}

	// end: li
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if (isset($xmenu_meta['submenu-type'])) {
			switch ($xmenu_meta['submenu-type']) {
				case 'multi-column':
					if ($this->multi_col_current == $item->ID) {
						$this->multi_col_current = 0;
					}
					break;
				case 'stack':
					if ($this->tab_current == $item->ID) {
						$this->stack_current = 0;
					}
					break;
				case 'tab':
					if ($this->tab_current == $item->ID) {
						$this->tab_current = 0;
					}
					break;
			}
		}
		$output .= '</li>';
	}

	function get_menu_image($depth, $xmenu_meta, $setting_options, $item) {
		$output = '';
		if (($depth > 0) && ((isset($xmenu_meta['image-url']) && !empty($xmenu_meta['image-url'])) || (isset($xmenu_meta['image-feature']) && ($xmenu_meta['image-feature'] == '1') && ($item->type != 'custom')))) {

			$image_url = $xmenu_meta['image-url'];
			$attachment_id = 0;
			if ($xmenu_meta['image-feature'] == '1') {
				$attachment_id = get_post_thumbnail_id( $item->object_id );
			}
			else if (!empty($image_url)){
				$attachment_id = xmenu_get_attachment_id_from_url($image_url);
			}


			if ($attachment_id) {
				$image_thumbnail_name = $xmenu_meta['image-size'];
				if ($image_thumbnail_name == 'inherit') {
					$image_thumbnail_name = $setting_options['image-size'];
				}
				$image_thumbnail = wp_get_attachment_image_src($attachment_id, $image_thumbnail_name);
				if ($image_thumbnail) {
					$image_url = $image_thumbnail['0'];
				}
			}

			$image_attr = '';
			if ($xmenu_meta['image-dimensions'] == 'inherit') {
				if (isset($setting_options['image-width']) && !empty($setting_options['image-width'])) {
					$image_attr .= ' width="' . esc_attr(str_replace('px','',$setting_options['image-width'])) . '"';
				}
				if (isset($setting_options['image-height']) && !empty($setting_options['image-height'])) {
					$image_attr .= ' height="' . esc_attr(str_replace('px','',$setting_options['image-height'])) . '"';
				}
			}
			else {
				if (isset($xmenu_meta['image-width']) && !empty($xmenu_meta['image-width'])) {
					$image_attr .= ' width="' . esc_attr(str_replace('px','',$xmenu_meta['image-width'])) . '"';
				}
				if (isset($xmenu_meta['image-height']) && !empty($xmenu_meta['image-height'])) {
					$image_attr .= ' height="' . esc_attr(str_replace('px','',$xmenu_meta['image-height'])) . '"';
				}
			}

			if (!empty($image_url)) {
				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				if (isset($xmenu_meta['other-disable-text']) && $xmenu_meta['other-disable-text'] == '1') {
					$attributes .= '';
				}
				else {
					$attributes .= ! empty( $item->url ) && ($xmenu_meta['other-disable-link'] != '1') ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				}
				$output .= '<a class="x-image" ' . $attributes . ' >';
				$output .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr( $item->attr_title ) . '"' . $image_attr . '/>';
				$output .= '</a>';
			}
		}
		return $output;
	}
}