<?php
require_once('xmenu-settings.php');

// bind setting item
function xmenu_bind_setting_item($key, $item, $value) {
	switch ($item['type']) {
		case 'heading':
			?>
			<tr>
				<th colspan="2" class="heading"><?php echo esc_html($item['text']); ?></th>
			</tr>
			<?php
			break;
		case 'checkbox':
			?>
			<tr>
				<th class="row"><?php echo esc_html($item['text']); ?></th>
				<td class="">
					<fieldset>
						<label for="<?php echo XMENU_SETTING_OPTIONS . '[' . esc_attr($key) . ']'; ?>">
							<input name="<?php echo XMENU_SETTING_OPTIONS . '[' . esc_attr($key) . ']'; ?>" type="checkbox" id="<?php echo XMENU_SETTING_OPTIONS . '[' . esc_attr($key) . ']'; ?>" value="1" <?php checked( $value, 1 ); ?> />
							<?php echo esc_html($item['label']) ?>
						</label>
					</fieldset>
					<?php if (isset($item['des']) && !empty($item['des'])): ?>
						<div class="x-description color2"><?php echo wp_kses_post($item['des'])?></div>
					<?php endif; ?>
				</td>
			</tr>
			<?php
			break;
		case 'select':
			?>
			<tr>
				<th class="row">
					<label for="<?php echo XMENU_SETTING_OPTIONS . '[' . esc_attr($key) . ']'; ?>"><?php echo esc_html($item['text']); ?></label>
				</th>
				<td class="">
					<select name="<?php echo XMENU_SETTING_OPTIONS . '[' . esc_attr($key) . ']'; ?>" id="<?php echo XMENU_SETTING_OPTIONS . '[' . esc_attr($key) . ']'; ?>">
						<?php foreach($item['options'] as $op_key => $op_value): ?>
							<option <?php selected( $op_key, $value ); ?> value="<?php echo esc_attr($op_key)?>"><?php echo esc_attr($op_value)?></option>
						<?php endforeach; ?>
					</select>
					<?php if (isset($item['des']) && !empty($item['des'])): ?>
						<div class="x-description color2"><?php echo wp_kses_post($item['des'])?></div>
					<?php endif; ?>
				</td>
			</tr>
			<?php
			break;
		case 'text':
			?>
			<tr>
				<th class="row">
					<label for="<?php echo XMENU_SETTING_OPTIONS . '[' . esc_attr($key) . ']'; ?>"><?php echo esc_html($item['text']); ?></label>
				</th>
				<td class="">
					<input type="text" value="<?php echo esc_attr($value)?>"  name="<?php echo XMENU_SETTING_OPTIONS . '[' . esc_attr($key) . ']'; ?>" id="<?php echo XMENU_SETTING_OPTIONS . '[' . esc_attr($key) . ']'; ?>"/>
					<?php if (isset($item['des']) && !empty($item['des'])): ?>
						<div class="x-description color2"><?php echo wp_kses_post($item['des'])?></div>
					<?php endif; ?>
				</td>
			</tr>
			<?php
			break;
		case 'list-checkbox':
			?>
			<tr>
				<th class="row"><?php echo esc_html($item['text']); ?></th>
				<td class="">
					<?php foreach($item['options'] as $op_key => $op_value): ?>
						<?php
							$op_selected = '';
							if (isset($value[$op_key])) {
								$op_selected = $value[$op_key];
							}
						?>
						<fieldset>
							<label>
								<input name="<?php echo XMENU_SETTING_OPTIONS . '[' . esc_attr($key) . '][' . esc_attr($op_key) .']'; ?>" type="checkbox" value="1" <?php checked( $op_selected, 1 ); ?> />
								<?php echo esc_html($op_value) ?>
							</label>
						</fieldset>
					<?php endforeach; ?>
					<?php if (isset($item['des']) && !empty($item['des'])): ?>
						<div class="x-description color2"><?php echo wp_kses_post($item['des'])?></div>
					<?php endif; ?>
				</td>
			</tr>
			<?php
			break;
	}
}

function xmenu_admin_setting_assets($hook){
	if( $hook == 'appearance_page_xmenu-settings' ){
		wp_enqueue_style( 'xmenu-menu-admin', XMENU_URL. 'admin/assets/css/admin.css' );
		wp_enqueue_script( 'xmenu-menu-admin', XMENU_URL. 'admin/assets/js/setting.js' , array( 'jquery' ) , XMENU_VERSION , true );
		wp_localize_script( 'xmenu-menu-admin' , 'xmenu_meta' , array(
			'ajax_url' => admin_url( 'admin-ajax.php?activate-multi=true' ),
			'delete_setting_confirm' => esc_html__('Are you sure delete this Settings?','g5plus-handmade')
		) );

	}
}
add_action( 'admin_enqueue_scripts' , 'xmenu_admin_setting_assets' );

add_action( 'admin_print_styles-nav-menus.php' , 'xmenu_admin_menu_load_assets' );
function xmenu_admin_menu_load_assets() {

	wp_enqueue_media();
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script('wp-color-picker');

	wp_enqueue_style( 'xmenu-menu-admin', XMENU_URL. 'admin/assets/css/admin.css' );
	wp_enqueue_script( 'xmenu-menu-jquery-mouse-wheel', XMENU_URL. 'admin/assets/js/jquery.mousewheel.js' , array( 'jquery' ) , XMENU_VERSION , true );
	wp_enqueue_script( 'xmenu-menu-media-init', XMENU_URL. 'admin/assets/js/media-init.js' , array( 'jquery' ) , XMENU_VERSION , true );
	wp_enqueue_script( 'xmenu-menu-admin', XMENU_URL. 'admin/assets/js/admin.js' , array( 'jquery' ) , XMENU_VERSION , true );

	$xmenu_menu_data = xmenu_get_menu_items_data();
	global $xmenu_item_defaults;
	wp_localize_script( 'xmenu-menu-admin' , 'xmenu_menu_item_data' , $xmenu_menu_data );
	wp_localize_script( 'xmenu-menu-admin' , 'xmenu_menu_item_default' , $xmenu_item_defaults );
	wp_localize_script( 'xmenu-menu-admin' , 'xmenu_meta' , array(
		'ajax_url' => admin_url( 'admin-ajax.php?activate-multi=true' )
	) );
}

function xmenu_get_menu_items_data($post_status = 'any') {
	global $nav_menu_selected_id, $xmenu_item_defaults;
	$menu_items = wp_get_nav_menu_items( $nav_menu_selected_id, array( 'post_status' => $post_status ) );

	$xmenu_data = array();
	if (!$menu_items) return $xmenu_item_defaults;
	foreach ($menu_items as $key => $item) {
		$menu = array(
			'nosave-type_label' => $item->type_label,
			'nosave-type' => $item->type,
			'general-url' => $item->url,
			'general-title' => $item->title,
			'general-attr-title' => $item->attr_title,
			'general-target' => $item->target,
			'general-classes' => join(' ',$item->classes),
			'general-xfn' => $item->xfn,
			'general-description' => $item->description,
		);
		$menu_item_meta = get_post_meta( $item->ID, '_menu_item_xmenu_config', true );
		if ($menu_item_meta) {
			$menu_item_meta = json_decode($menu_item_meta, true);
			$menu = array_merge($menu_item_meta, $menu);
		}
		$xmenu_data [$item->ID] = array_merge($xmenu_item_defaults, $menu);
	}
	return $xmenu_data;
}