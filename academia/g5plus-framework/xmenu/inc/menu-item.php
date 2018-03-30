<?php
add_action( 'admin_footer-nav-menus.php' , 'xmenu_menu_item_config_panel_render');
function xmenu_menu_item_config_panel_render() {
	global $xmenu_item_settings;
	$academia_font_awesome = G5Plus_Global::font_awesome();
	?>
	<div class="xmenu-config-panel-wrapper">
		<div class="xmenu-header">
			<h2>
				<i class="fa fa-cogs"></i><span>Menu Name</span>
				<button class="x-button xmenu-config-panel-save" type="button"><i class="fa fa-save"></i> <?php echo esc_html__('Save Changes','g5plus-academia') ?></button>
				<button class="x-button xmenu-config-panel-close" type="button"><i class="fa fa-close"></i></button>
			</h2>
		</div>
		<div class="xmenu-config-panel-left">
			<ul>
				<?php foreach ($xmenu_item_settings as $item_key => $item_value): ?>
				<li <?php echo ($item_key == 'general' ? 'class="active"' :'') ?> rel-section="<?php echo esc_attr('section-' . $item_key) ?>"><i class="fa <?php echo esc_attr($item_value['icon']) ?>"></i><span><?php echo esc_html($item_value['text']) ?></span></li>
				<?php endforeach; ?>
				<li class="x-reset">
					<i class="fa fa-refresh"></i> <?php esc_html_e('Reset','g5plus-academia') ?>
				</li>
			</ul>
		</div>
		<form class="xmenu-config-panel-right">
			<div class="xmenu-config-panel-right-inner">
				<?php foreach ($xmenu_item_settings as $item_key => $item_value): ?>
					<section <?php echo ($item_key == 'general' ? 'class="active"' :'') ?> id="<?php echo esc_attr('section-' . $item_key) ?>">
						<?php foreach ($item_value['config'] as $config_key => $config): ?>
							<?php xmenu_menu_item_config_panel_render_item($config_key, $config);?>
						<?php endforeach; ?>
					</section>
				<?php endforeach; ?>
			</div>
			<div class="xmenu-panel-scroll-wrapper">
				<div class="xmenu-panel-scroll">
					<div class="xmenu-panel-drag"></div>
				</div>
			</div>
		</form>
		<div class="xmenu-icon-popup">
			<div class="xmenu-icon-popup-header">
				<input type="text" placeholder="<?php esc_html_e('Type to search...','g5plus-academia') ?>"/>
				<div class="xmenu-icon-remove">
					<button class="x-button">Remove Icon</button>
				</div>
				<i class="fa fa-remove"></i>
			</div>
			<div class="xmenu-icon-popup-content">
				<h3>Font Awesome</h3>
				<ul>
					<?php foreach ($academia_font_awesome as $icon):
						$arrkey=array_keys($icon);
						?>
						<li title="<?php echo esc_attr($arrkey[0]); ?>"><i class="<?php echo esc_attr($arrkey[0]); ?>"></i></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<?php
}
function xmenu_menu_item_config_panel_render_item($config_key, $config) {
	switch($config['type']) {
		case 'heading':
			?>
				<h3 class="x-section-title"><?php echo esc_html($config['text']); ?></h3>
			<?php
			break;
		case 'checkbox':
			$chekbox_value = '1';
			if (isset($config['value']) && !empty($config['value'])) {
				$chekbox_value = $config['value'];
			}
			?>
			<div class="x-col">
				<label class="x-position-relative" for="xmenu_config_<?php echo esc_attr($config_key); ?>"><input class="x-input x-checkbox" name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" type="checkbox" value="<?php echo esc_attr($chekbox_value) ?>" <?php checked( $config['std'], $chekbox_value ); ?>/> <span><?php echo esc_html($config['text']); ?></span> </label>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'text':
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input"><input name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-textbox" type="text" value="<?php echo esc_attr($config['std']); ?>"/></div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'array':
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input"><input name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-textbox x-array" type="text" value="<?php echo esc_attr($config['std']); ?>"/></div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'select':
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input">
					<label class="x-input-label" for="xmenu_config_<?php echo esc_attr($config_key); ?>">
						<select name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-select">
							<?php foreach ($config['options'] as $key => $value):?>
								<option <?php selected( $config['std'], $key ); ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($value) ?></option>
							<?php endforeach;?>
						</select>
						<div class="x-select-arrow"><i class="fa fa-caret-down"></i></div>
					</label>
				</div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'textarea':
			$element_style = '';
			if (isset($config['height']) && $config['height']) {
				$element_style = 'height:' . $config['height'];
			}
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input"><textarea name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-textarea" style="<?php echo esc_attr($element_style) ?>"><?php echo esc_html($config['std']); ?></textarea></div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'select-group':
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input">
					<label class="x-input-label" for="xmenu_config_<?php echo esc_attr($config_key); ?>">
						<select name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-select x-select-group">
							<?php foreach ($config['options'] as $op_key => $op_value):?>
								<optgroup label="<?php echo esc_attr($op_value['text']) ?>">
									<?php foreach ($op_value['options'] as $key => $value):?>
										<option <?php selected( $config['std'], $key ); ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($value) ?></option>
									<?php endforeach;?>
								</optgroup>
							<?php endforeach;?>
						</select>
						<div class="x-select-arrow"><i class="fa fa-caret-down"></i></div>
					</label>
				</div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'image':
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input x-col-media-image">
					<input name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-textbox x-media-image" type="text" value="<?php echo esc_attr($config['std']); ?>"/>
					<button type="button" id="browser_xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-button x-media-button"><i class="fa fa-image"></i></button>
				</div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'icon':
			?>
			<div class="x-col">
				<div class="x-col-input">
					<div class="x-icon-wrapper" data-rel="xmenu_config_<?php echo esc_attr($config_key); ?>">
						<input name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-textbox x-icon" type="hidden" value="<?php echo esc_attr($config['std']); ?>"/>
						<i></i>
						<span><?php echo esc_html($config['text']); ?></span>
						<div class="x-icon-remove"><i class="fa fa-remove"></i></div>
					</div>
				</div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'color':
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input">
					<input name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-color-picker" type="text" value="<?php echo esc_attr($config['std']); ?>"/>
				</div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
		case 'sidebar':
			$m_sidebars = array();
			$m_sidebars['-1'] = esc_html__('--None--','g5plus-academia');
			foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
				$m_sidebars[$sidebar['id']] = ucwords( $sidebar['name'] );
			}
			?>
			<div class="x-col">
				<div class="x-col-title"><?php echo esc_html($config['text']); ?></div>
				<div class="x-col-input">
					<label class="x-input-label" for="xmenu_config_<?php echo esc_attr($config_key); ?>">
						<select name="<?php echo esc_attr($config_key); ?>" id="xmenu_config_<?php echo esc_attr($config_key); ?>" class="x-input x-select">
							<?php foreach ($m_sidebars as $key => $value):?>
								<option <?php selected( $config['std'], $key ); ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($value) ?></option>
							<?php endforeach;?>
						</select>
						<div class="x-select-arrow"><i class="fa fa-caret-down"></i></div>
					</label>
				</div>
				<?php xmenu_menu_item_render_description($config); ?>
			</div>
			<?php
			break;
	}
}
function xmenu_menu_item_render_description($config) {
	?>
	<?php if (isset($config['des']) && (!empty($config['des']))):?>
		<div class="x-description"><?php echo wp_kses_post($config['des']); ?></div>
	<?php endif;?>
	<?php
}

function xmenu_save_config_callback() {
	$error_result = array(
		'code' => '-1',
		'message' => esc_html__('Save menu config fail','g5plus-academia'),
	);

	$config = $_POST['config'];
	$menu_id = $_POST['id'];

	$term = wp_get_object_terms($menu_id, 'nav_menu');
	if (!$term) {
		echo json_encode($error_result);
		die();
	}
	$term = $term[0];

	$menu_list = wp_get_nav_menu_items( $term->term_id, array( 'post_status' => 'any' ) );
	$menu_obj = null;
	foreach ($menu_list as $key => $menu_value) {
		if ($menu_value->ID == $menu_id) {
			$menu_obj = $menu_list[$key];
			break;
		}
	}
	if (!$menu_obj) {
		echo json_encode($error_result);
		die();
	}

	$args = array(
		'menu-item-db-id' => $menu_id,
		'menu-item-object-id' => $menu_obj->object_id,
		'menu-item-object' => $menu_obj->object,
		'menu-item-parent-id' => $menu_obj->menu_item_parent,
		'menu-item-position' => $menu_obj->menu_order,
		'menu-item-type' => $menu_obj->type,
		'menu-item-title' => $config['general-title'],
		'menu-item-url' => $menu_obj->type == 'custom' ? $config['general-url'] : $menu_obj->url,
		'menu-item-description' => $config['general-description'],
		'menu-item-attr-title' => $config['general-attr-title'],
		'menu-item-target' => $config['general-target'],
		'menu-item-classes' => $config['general-classes'],
		'menu-item-xfn' => $config['general-xfn'],
		'menu-item-status' => $menu_obj->post_status,
	);

	$id = wp_update_nav_menu_item( $term->term_id, $menu_id, $args );
	if ( $id && ! is_wp_error( $id ) ) {
		foreach($config as $key => $value) {
			if ((strpos($key, 'nosave-') === 0) || (strpos($key, 'general-') === 0)) {
				unset($config[$key]);
			}
		}

		update_post_meta( (int) $menu_id, '_menu_item_xmenu_config', json_encode( $config ) );
		echo json_encode(array(
			'code' => '1',
			'message' => '',
		));
		die();
	}
	echo json_encode($error_result);
	die();
}
add_action( 'wp_ajax_xmenu_save_config', 'xmenu_save_config_callback' );