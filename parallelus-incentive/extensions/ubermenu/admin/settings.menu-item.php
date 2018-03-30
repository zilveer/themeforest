<?php

add_action( 'admin_print_styles-nav-menus.php' , 'ubermenu_admin_menu_load_assets' );
   
function ubermenu_admin_menu_load_assets() {

	wp_enqueue_media();
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script('wp-color-picker');
	wp_enqueue_script( 'jquery' );


	$assets = UBERMENU_URL . 'admin/assets/';
	wp_enqueue_style( 'ubermenu-menu-admin', $assets.'admin.menu.css' );
	wp_enqueue_style( 'ubermenu-menu-admin-font-awesome', $assets.'fontawesome/css/font-awesome.min.css' );
	wp_enqueue_script( 'ubermenu-menu-admin', $assets.'admin.menu.js' , array( 'jquery' ) , UBERMENU_VERSION , true );

	$ubermenu_menu_data = ubermenu_get_menu_items_data();

	wp_localize_script( 'ubermenu-menu-admin' , 'ubermenu_menu_item_data' , $ubermenu_menu_data );

	wp_localize_script( 'ubermenu-menu-admin' , 'ubermenu_meta' , array( 
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce'		=> ubermenu_menu_item_settings_nonce(),
		'item_panels'	=> ubermenu_get_menu_item_panels_map(),
	) );
}

function ubermenu_menu_item_settings_panel(){

	$panels = ubermenu_menu_item_settings_panels();
	$settings = ubermenu_menu_item_settings();
	$defaults = ubermenu_menu_item_setting_defaults();

	$ordered_panels = array();
	$k = 1000;
	foreach( $panels as $panel_id => $panel ){
		$order = isset( $panel['order'] ) ? $panel['order'] : $k++;
		$ordered_panels[$order] = $panel_id;
	}
	ksort( $ordered_panels );

	?>
	<div class="ubermenu-js-check">
		<div class="ubermenu-js-check-peek"><i class="fa fa-truck"></i> Loading UberMenu...</div>
		<div class="ubermenu-js-check-details">
			<p>
			If this message does not disappear, it means that UberMenu has not been able to load.  
			This most commonly indicates that you have a javascript error on this page, which will need to be resolved in order to allow UberMenu to run.
			<a target="_blank" href="http://goo.gl/oS6L6C">How to check for javascript errors.</a>
			</p>
		</div>
	</div>
	<div class="ubermenu-menu-item-settings-wrapper">

		<div class="ubermenu-menu-item-settings-topper">
			<i class="fa fa-cogs"></i> UBERMENU SETTINGS 
			<?php /* if( !UBERMENU_PRO ): ?><a target="_blank" href="http://goo.gl/7jzDSQ" class="ubermenu-up-link"><i class="fa fa-rocket"></i> Go Pro</a><?php endif; */ ?>
		</div>

		<div class="ubermenu-menu-item-panel ubermenu-menu-item-panel-negative">

			<div class="ubermenu-menu-item-stats shift-clearfix">
				<div class="ubermenu-menu-item-title">Menu Item Unknown Template</div>
				<div class="ubermenu-menu-item-id">#menu-item-X</div>
				<div class="ubermenu-menu-item-type">Custom</div>		
			</div>

			<div class="ubermenu-menu-item-panel-info" >

				
				<ul class="ubermenu-menu-item-tabs">
					<?php foreach( $ordered_panels as $order => $panel_id ): 
						$panel = $panels[$panel_id];
						$icon = '';
						if( isset( $panel['icon'] ) ) $icon = '<i class="fa fa-'.$panel['icon'].'"></i> ';
						?>
					<li class="ubermenu-menu-item-tab"  data-ubermenu-tab="<?php echo $panel_id; ?>"><a href="#" data-ubermenu-tab="<?php echo $panel_id; ?>" ><?php echo $panel['title']; echo $icon; ?></a></li>
					<?php endforeach; ?>

				</ul>

			</div>

			<div class="ubermenu-menu-item-panel-settings shift-clearfix" >
				<form class="ubermenu-menu-item-settings-form" action="" method="post" enctype="multipart/form-data" >

					<div class="ubermenu-menu-item-save-button-wrapper">

						<a class="ubermenu-menu-item-settings-close" href="#"><i class="fa fa-times"></i> <span class="ubermenu-key">ESC</span></a>

						<input class="ubermenu-menu-item-save-button" type="submit" value="Save Menu Item" />
						<div class="ubermenu-menu-item-status ubermenu-menu-item-status-save">
							<i class="ubermenu-status-save fa fa-floppy-o"></i>
							<i class="ubermenu-status-success fa fa-check"></i>
							<i class="ubermenu-status-working fa fa-cog" title="Working..."></i> 
							<i class="ubermenu-status-warning fa fa-exclamation-triangle"></i>
							<i class="ubermenu-status-error fa fa-exclamation-circle"></i>

							<span class="ubermenu-status-message"></span>
						</div>

						<a class="ubermenu-clear-settings">
							<i class="fa fa-eraser"></i>
							<div class="ubermenu-menu-item-setting-tip"><i class="ubermenu-tip-icon fa fa-lightbulb-o"></i> <?php 
								_e( 'Clear the settings for this item.' , 'ubermenu' ); ?>
							</div>
						</a>

						<span class="ubermenu-menu-item-meta-ops-wrap">
							<i class="fa fa-gear ubermenu-menu-item-toggle-meta-ops"></i>
							<span class="ubermenu-menu-item-meta-ops">
								<span class="ubermenu-menu-item-setting">
									<label><input type="checkbox" name="ubermenu-meta-save-defaults" /> <?php _e( 'Set as defaults' , 'ubermenu' ); ?></label>
									<div class="ubermenu-menu-item-setting-tip"><i class="ubermenu-tip-icon fa fa-lightbulb-o"></i> <?php 
										_e( 'Set this item\'s current settings as the default menu item settings for all menu items (won\'t affect menu items whose settings have already been saved).  Be careful - if these aren\'t set intelligently, it can have undesirable effects.  After saving menu item, ave/refresh menu to enable new defaults.' , 'ubermenu' ); ?>
									</div>
								</span>
								<span class="ubermenu-menu-item-setting">
									<label><input type="checkbox" name="ubermenu-meta-reset-defaults" /> <?php _e( 'Reset defaults' , 'ubermenu' ); ?></label>
									<div class="ubermenu-menu-item-setting-tip"><i class="ubermenu-tip-icon fa fa-lightbulb-o"></i> <?php 
										_e( 'Clear the custom settings defaults and restore the standard defaults.  After saving menu item, save/refresh menu to reset defaults' , 'ubermenu' ); ?>
									</div>
								</span>
							</span>
						</span>
					</div>

					<?php foreach( $ordered_panels as $order => $panel_id ): 
							$panel = $panels[$panel_id];
							$panel_settings = $settings[$panel_id];	
							$icon = '';
							if( isset( $panel['icon'] ) ) $icon = '<i class="fa fa-'.$panel['icon'].'"></i>';
							?>
						<div class="ubermenu-menu-item-tab-content" data-ubermenu-tab-content="<?php echo $panel_id; ?>"<?php
								if( isset( $panel['apply_if'] ) ){
									?> data-ubermenu-apply-if="<?php echo $panel['apply_if']; ?>"<?php
								}
							?>>

							<div class="ubermenu-menu-item-tab-header">

								<h3><?php echo $icon; ?>
									<!--<i class="fa fa-sliders"></i>--> <?php echo $panel['title']; ?> Settings</h3>

								<?php if( isset( $panel['info'] ) ): ?>
								<div class="ubermenu-menu-item-tab-header-info">
									<i class="ubermenu-panel-info-icon fa fa-info-circle"></i>
									<?php echo $panel['info']; ?>
								</div>
								<?php endif; ?>

								<?php if( isset( $panel['tip'] ) ): ?>
								<div class="ubermenu-menu-item-tab-header-tip">
									<i class="ubermenu-panel-info-icon fa fa-lightbulb-o"></i>
									<?php echo $panel['tip']; ?>
								</div>
								<?php endif; ?>

								<?php if( isset( $panel['warning'] ) ): ?>
								<div class="ubermenu-menu-item-tab-header-warning">
									<i class="ubermenu-panel-info-icon fa fa-exclamation-triangle"></i>
									<?php echo $panel['warning']; ?>
								</div>
								<?php endif; ?>
							</div>

							<?php foreach( $panel_settings as $setting_id => $setting ): 

								$classes = array();
								$classes[] = 'ubermenu-menu-item-setting';
								$classes[] = 'ubermenu-menu-item-setting-'.$setting['type'];
								$classes[] = 'ubermenu-menu-item-setting-'.$setting['id'];
								if( isset( $setting['depth'] ) ){
									$classes[] = 'ubermenu-menu-item-setting-depth-'.$setting['depth'];
								}
								$class = implode( ' ' , $classes );

								//$tip = isset( $setting['tip'] ) ? '<div class="ubermenu-menu-item-setting-tip"><i class="ubermenu-tip-icon fa fa-lightbulb-o"></i> '.$setting['tip'].'</div>' : '';
								?>

								<div class="<?php echo $class; ?>">
									<label class="ubermenu-menu-item-setting-label"><?php 
										echo '<span class="ubermenu-item-setting-title">'.$setting['title'].'</span>'; 
										if( isset( $setting['scenario'] ) ){
											echo '<span class="ubermenu-item-setting-scenario"><i class="fa fa-info-circle"></i> '.$setting['scenario'].' <span class="ubermenu-item-setting-scenario-tip">This setting was designed specifically for this scenario.  Using this setting with a different scenario may have unpredictable results.</span></span>';
										}
										if( isset( $setting['cue'] ) ){
											echo '<span class="ubermenu-item-setting-cue">'.$setting['cue'].'</span>';
										}
										//echo $tip;
									?></label>
									<div class="ubermenu-menu-item-setting-input-wrap">
										<?php ubermenu_show_menu_item_setting( $setting , $defaults[$setting['id']] ); ?>
									</div>
									
								</div>

							<?php endforeach; ?>

						</div>
					

					<?php endforeach; ?>

					
				</form>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'admin_footer-nav-menus.php' , 'ubermenu_menu_item_settings_panel');


function ubermenu_show_menu_item_setting( $setting , $default ){

	if( isset( $setting['pro_only'] ) && $setting['pro_only'] ){
		echo '<a class="ubermenu-upgrade-link" target="_blank" href="">Upgrade to UberMenu Pro</a> to use this feature.';
		return;
	}


	$id = $setting['id'];
	$type = $setting['type'];
	//$default = $setting['default'];
	$desc = isset( $setting['desc'] ) ? '<span class="ubermenu-menu-item-setting-description">'.$setting['desc'].'</span>' : '';
	$tip = isset( $setting['tip'] ) ? '<div class="ubermenu-menu-item-setting-tip"><i class="ubermenu-tip-icon fa fa-lightbulb-o"></i> '.$setting['tip'].'</div>' : '';
	


	$name = 'name="'.$id.'"';
	$value = 'value="'. ( is_array( $default ) ? '' : $default ).'"';
	$data_setting = 'data-ubermenu-setting="'.$id.'"';

	$class_str = 'ubermenu-menu-item-setting-input';
	$class = 'class="'.$class_str.'"';

	$ops;
	if( isset( $setting['ops'] ) ){
		$ops = $setting['ops'];
		if( !is_array( $ops ) && function_exists( $ops ) ){
			if( isset( $setting['ops_args'] ) ){
				$ops = $ops( $setting['ops_args'] );
			}
			else $ops = $ops();
		}
	}

	switch( $type ){
		case 'checkbox': ?>
			<input <?php echo $class; ?> type="checkbox" <?php echo "$name $data_setting"; checked( $default , 'on' ); ?> />
			<?php break;

		case 'multicheck': 
			?>
			<div class="ubermenu-multicheck-wrap">

			<?php foreach( $ops as $_val => $_name ):
				$_name_att = 'name="'.$id.'[]"';
				$_value_att = 'value="'.$_val.'"';

				$checked = '';
				if( $default == '_all_on' ){
					$checked = 'checked="checked"';
				}
				if( is_array( $default ) ){
					if( in_array( $_val , $default ) ){
						$checked = 'checked="checked"';
					}
				}
				?>
				<label class="ubermenu-multicheck-label">
					<input type="checkbox" class="checkbox ubermenu-multicheckbox" id="" <?php echo "$data_setting $_name_att $_value_att "; echo $checked; ?>  />
					<?php echo $_name; ?>
				</label>
			<?php endforeach; ?>

			</div>

			<?php break;

		case 'text': ?>
			<input <?php echo $class; ?> type="text" <?php echo "$name $value $data_setting"; ?> />
			<?php break;

		case 'textarea': ?>
			<textarea <?php echo $class; ?> <?php echo "$name $data_setting"; ?> ></textarea>
			<?php break;

		case 'select': ?>
			<select <?php echo $class; ?> <?php echo "$name $data_setting"; ?> >
				<?php foreach( $ops as $_val => $_name ): ?>
				<option value="<?php echo $_val; ?>" <?php selected( $default , $_val ); ?> ><?php echo $_name; ?></option>
				<?php endforeach; ?>
			</select>
			<?php break;

		case 'radio': ?>
			<div class="ubermenu-radio-group <?php if( isset($setting['type_class'] ) ) echo $setting['type_class']; ?> <?php if( count( $ops ) > 1 ) echo 'ubermenu-radio-multiple-subgroups'; ?>">

				<?php foreach( $ops as $_group_id => $group ): ?>

					<div class="ubermenu-radio-subgroup ubermenu-radio-subgroup-<?php echo $_group_id; ?>">

						<?php if( isset( $group['group_title'] ) ): ?>
							<h4 class="ubermenu-radio-group-title"><?php echo $group['group_title']; ?></h4>
						<?php endif; ?>

						<?php foreach( $group as $_val => $_data ):

							if( $_val == 'group_title' ) continue;

							$_name = isset( $_data['name'] ) ? $_data['name'] : $_val;
							$selected = false;
							if( $default == $_val ) $selected = true;

							$img = '';
							if( isset( $_data['img'] ) ) $img = $_data['img'];

							$img_icon = '';
							if( isset( $_data['img_icon'] ) ) $img_icon = $_data['img_icon'];
							?>
						<div class="ubermenu-radio-option">
							<label class="ubermenu-radio-label shift-clearfix<?php if( $img || $img_icon ) echo ' ubermenu-radio-label-with-image'; ?><?php if( $selected ) echo ' ubermenu-radio-label-selected'; ?>">
								<input <?php echo $class; ?> type="radio" value="<?php echo $_val; ?>" <?php echo "$name $data_setting"; ?> <?php checked( $default , $_val ); ?>>
								
								<?php if( $img ): ?>
									<img src="<?php echo $img; ?>" />
								<?php endif; ?>

								<?php if( $img_icon ): ?>
									<span class="ubermenu-radio-img-icon">
										<i class="<?php echo $img_icon; ?>"></i>
									</span>
								<?php endif; ?>

								<?php echo $_name; ?>

								<?php if( isset( $_data['desc'] ) ): ?>
									<div class="ubermenu-radio-desc">
										<?php echo $_data['desc']; ?>
									</div>
								<?php endif; ?>
							</label>
							
							
						</div>
						<?php endforeach; ?>
					</div>

				<?php endforeach; ?>

			</div>

			<?php break;

		case 'icon': ?>
			<div class="ubermenu-icon-settings-wrap">
				<div class="ubermenu-icon-selected">
					<i class="<?php echo $default; ?>"></i>
					<span class="ubermenu-icon-set-icon">Set Icon</span>
				</div>
				<div class="ubermenu-icons shift-clearfix">
					<div class="ubermenu-icons-search-wrap">
						<input class="ubermenu-icons-search" placeholder="Type to search" />
					</div>

				<?php foreach( $ops as $_val => $data ): if( $_val == '' ) continue; ?>
					<span class="ubermenu-icon-wrap" title="<?php echo $data['title']; ?>" data-ubermenu-search-terms="<?php echo strtolower( $data['title'] ); ?>"><i class="ubermenu-icon <?php echo $_val; ?>" data-ubermenu-icon="<?php echo $_val; ?>" ></i></span>
				<?php endforeach; ?>
					<span class="ubermenu-icon-wrap ubermenu-remove-icon" title="Remove Icon"><i class="ubermenu-icon" data-ubermenu-icon="" >Remove Icon</i></span>
				</div>
				<select <?php echo $class; ?> <?php echo "$name $data_setting"; ?> >
					<?php foreach( $ops as $_val => $data ): ?>
					<option value="<?php echo $_val; ?>" <?php selected( $default , $_val ); ?> ><?php echo $data['title']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<?php break;


		case 'media': ?>
			<div class="ubermenu-media-wrapper">
				<div class="media-preview-wrap"></div>
				<input class="<?php echo $class_str; ?> ubermenu-media-id" type="text" <?php echo "$name $value $data_setting"; ?> />

				<div class="ubermenu-media-buttons">
					<a class="ubermenu-setting-button" data-uploader-title="Upload or Choose from Media Library" ><i class="fa fa-picture-o"></i> Select</a>
					<a class="ubermenu-remove-button">&times; Remove</a>
					<a class="ubermenu-edit-media-button" target="_blank"><i class="fa fa-pencil"></i> Edit</a>
				</div>
			</div>
			<?php break;

		case 'autocomplete': ?>

			<div class="ubermenu-autocomplete">

				
				<input class="ubermenu-autocomplete-input" data-auto-set="true" data-current-id="" data-current-name="" placeholder="Type to filter" type="text" />
				<input class="ubermenu-menu-item-setting-input ubermenu-autocomplete-setting" placeholder="ID" type="text" <?php echo "$name $value $data_setting"; ?> />

				<span class="ubermenu-autocomplete-toggle"><i class="fa fa-chevron-down"></i></span>
				<span class="ubermenu-autocomplete-clear"><i class="fa fa-ban"></i></span>

				<div class="ubermenu-autocomplete-ops">
					<?php foreach( $ops as $_val => $_name ): ?>
					<span class="ubermenu-autocomplete-op" data-opname="<?php echo strtolower( $_name ); ?>" data-val="<?php echo $_val; ?>" ><span class="ubermenu-autocomplete-op-name"><?php 
						echo $_name; ?></span><span class="ubermenu-autocomplete-op-val"><?php echo $_val; ?></span></span>
					<?php endforeach; ?>
				</div>

			</div>

			<?php break;

		case 'color': ?>
			<input type="text" class="ubermenu-colorpicker" <?php echo $name . ' '. $value . ' ' . $data_setting; ?> />
			
			<?php break;

		default: ?>
			What's a "<?php echo $type; ?>"?
			<?php
	}

	echo $desc;
	echo $tip;

}


function ubermenu_menu_item_settings_panels(){
	$panels = array();

	$panels['row'] = array(
		'title'	=> __( 'Row', 'ubermenu' ),
		'icon'	=> 'gear',
	);

	$panels['general'] = array(
		'title'	=> __( 'General', 'ubermenu' ),
		'icon'	=> 'link',
		'info'	=> __( 'Settings for the item link' , 'ubermenu' ),
		'order'	=> 100,
	
	);
	

	$panels['layout'] = array(
		'title'	=> __( 'Layout' , 'ubermenu' ),
		'icon'	=> 'columns',
		'info'	=> __( 'Control the layout of this item' , 'ubermenu' ),
		'order'	=> 130,
	);

	$panels['column_layout'] = array(
		'title'	=> __( 'Column Layout' , 'ubermenu' ),
		'icon'	=> 'columns',
		'info'	=> __( 'Control the layout of this Column Item' , 'ubermenu' ),
		'order'	=> 131,
	);

	$panels['submenu'] = array(
		'title'	=> __( 'Submenu' , 'ubermenu' ),
		'icon'	=> 'list-alt',
		'info'	=> __( 'These settings control how the submenu of this item is displayed.' , 'ubermenu' ),
		'order'	=> 150,
	);

	$panels['deprecated'] = array(
		'title'	=> __( 'Deprecated', 'ubermenu' ),
		'icon'	=> 'minus-circle',
		'warning' => __( 'These settings are deprecated and only included for backwards compatibility.  It is not recommended to use them as they may be removed in a future version.' , 'ubermenu' ),
		'order'	=> 220
	);

	$panels['divider'] = array(
		'title'	=> __( 'Divider', 'ubermenu' ),
		'icon'	=> 'minus-square',
		'info' => __( 'There are no custom settings for the Divider.' , 'ubermenu' ),
		'order'	=> 230
	);
	
	$panels = apply_filters( 'ubermenu_menu_item_settings_panels' , $panels );

	return $panels;
}

function ubermenu_menu_item_settings(){

	$admin_img_assets = UBERMENU_URL . 'admin/assets/images/';

	$settings = array();
	$panels = ubermenu_menu_item_settings_panels();
	foreach( $panels as $id => $panel ){
		$settings[$id] = array();
	}

	$column_ops = ubermenu_get_item_column_ops();


	/** ROW **/
	$settings['row'][60] = array(
		'id' 		=> 'submenu_column_default',
		'title'		=> __( 'Submenu Column Default' , 'ubermenu' ),
		'type'		=> 'radio',
		'default'	=> 'auto',
		'desc'		=> __( 'The number of columns per row that the submenu should be broken into by default.  Can be overridden on individual items', 'ubermenu' ),
		'ops'		=> $column_ops,
	);

	$settings['row'][65] = array(
		'id' 		=> 'submenu_column_autoclear',
		'title'		=> __( 'Auto Clear' , 'ubermenu' ),
		'type'		=> 'checkbox',
		'default' 	=> 'on',
		'desc'		=> __( 'Automatically start a new row of items every X items.  For example, if you choose a Submenu column default of 1/4, the 5th item will start a new column automatically.  Disable if you are adjusting item columns manually.' , 'ubermenu' ),
	);

	$settings['row'][80] = array(
		'id' 		=> 'row_padding',
		'title'		=> __( 'Row Padding' , 'ubermenu' ),
		'type'		=> 'text',
		'default'	=> '',
		'desc'		=> __( 'Padding on this specific row', 'ubermenu' ),
		'on_save'	=> 'row_padding',
	);

	$settings['row'][90] = array(
		'id' 		=> 'grid_row',
		'title'		=> __( 'Grid Row' , 'ubermenu' ),
		'type'		=> 'checkbox',
		'default'	=> 'off',
		'desc'		=> __( 'Space this row as a grid with equal padding. Useful for image grids.', 'ubermenu' ),
	);


	/** GENERAL **/


	$settings['general'][9] = array(
		'id' 		=> 'item_display',
		'title'		=> __( 'Item Display' , 'ubermenu' ),
		'type'		=> 'radio',
		'type_class'=> 'ubermenu-radio-blocks',
		//'depth'		=> '1-above',
		'scenario'	=> __( 'Submenu Items' , 'ubermenu' ),
		'default' 	=> 'auto',
		'desc'		=> __( 'No effect on Top Level Items.', 'ubermenu' ),
		'ops'		=> array(

			'group' => array(
				'auto'		=> array(
					'name'	=> __( 'Automatic' , 'ubermenu' ),
					'desc'	=> __( 'Automatically determine the appropriate display type', 'ubermenu' ),
				),
				'header'	=> array(
					'name'	=> __( 'Header' , 'ubermenu' ),
					'desc'	=> __( 'Display as a submenu column header' , 'ubermenu' ),
				),
				'normal'	=> array(
					'name'	=> __( 'Normal' , 'ubermenu' ),
					'desc'	=> __( 'Display as a normal submenu item' , 'ubermenu' ),
				),
			),

		),
	);

	$settings['general'][10] = array(
		'id' 		=> 'disable_link',
		'title'		=> __( 'Disable Link', 'ubermenu' ),
		'type'		=> 'checkbox',
		'default' 	=> 'off',
		'desc'		=> __( 'Check this box to remove the link from this item; clicking a disabled link will not result in any URL being followed.' , 'ubermenu' )
	);

	$settings['general'][15] = array(
		'id' 		=> 'disable_text',
		'title'		=> __( 'Disable Text', 'ubermenu' ),
		'desc'		=> __( 'Do not display the text for this item' , 'ubermenu' ),
		'type'		=> 'checkbox',
		'default' 	=> 'off',
		'desc'		=> __( '' , 'ubermenu' )
	);

	$settings['general'][20] = array(
		'id' 		=> 'highlight',
		'title'		=> __( 'Highlight Link', 'ubermenu' ),
		'type'		=> 'checkbox',
		'default' 	=> 'off',
		'desc'		=> __( 'Highlight this menu item' , 'ubermenu' )
	);

	


	


	





	






	







	/** LAYOUT **/


	$settings['layout'][10] = array(
		'id' 		=> 'columns',
		'title'		=> __( 'Columns Width', 'ubermenu' ),
		'type'		=> 'radio',
		'default' 	=> 'auto',
		'desc'		=> __( 'This is the fraction of the submenu width that the item/column will occupy.' , 'ubermenu' ),
		'tip'		=> __( 'Remember that if you set the columns to a fraction, the wrapper for this item must be either full width or have an explicit width set.  For submenu items, that means setting an explicit or full width submenu.  For top level items, that means setting an explicit width or full width menu bar.' , 'ubermenu' ),
		'ops'		=> $column_ops
	);

	$settings['layout'][20] = array(
		'id' 		=> 'item_layout',
		'title'		=> __( 'Item Layout', 'ubermenu' ),
		'type'		=> 'radio',
		'type_class'=> 'ubermenu-radio-blocks',
		'default' 	=> 'default',
		'desc'		=> __( '' , 'ubermenu' ),
		'ops'		=> 'ubermenu_get_item_layout_ops'
	);

	$settings['layout'][30] = array(
		'id' 		=> 'content_alignment',
		'title'		=> __( 'Item Content Alignment', 'ubermenu' ),
		'type'		=> 'radio',
		'scenario'	=> 'Vertically stacked layouts',
		'default' 	=> 'default',
		'desc'		=> __( 'Setting this to "Center" will allow you to have a centered image stacked above the title when used in conjunction with the "Image Above" layout' , 'ubermenu' ),
		'ops'		=> array(
			'group'	=> array(
				'default'	=> array(
					'name' 	=> __( 'Default' , 'ubermenu' ),
				),
				'left'		=> array(
					'name' 	=> __( 'Left' , 'ubermenu' ),
				),
				'center'		=> array(
					'name' 	=> __( 'Center' , 'ubermenu' ),
				),
				'right'		=> array(
					'name' 	=> __( 'Right' , 'ubermenu' ),
				),
			),
		),
	);


	$settings['layout'][40] = array(
		'id'		=> 'clear_row',
		'title'		=> __( 'New Row' , 'ubermenu' ),
		'desc'		=> __( 'Clear the previous row and start a new one with this item.' , 'ubermenu' ),
		'type'		=> 'checkbox',
		'default'	=> 'off',
		'scenario'	=> __( 'Submenu Columns' , 'ubermenu' ),
	);

	//up( $settings['layout'][20]['ops'] , 3 );







	/** COLUMN LAYOUT **/

	$settings['column_layout'][10] = array(
		'id' 		=> 'columns',
		'title'		=> __( 'Column Width', 'ubermenu' ),
		'type'		=> 'radio',
		'default' 	=> 'auto',
		'desc'		=> __( 'This is the fraction of the submenu width that the column will occupy.' , 'ubermenu' ),
		'tip'		=> __( 'Remember that if you set the columns to a fraction, the wrapper for this item must be either full width or have an explicit width set.  For submenu items, that means setting an explicit or full width submenu.  For top level items, that means setting an explicit width or full width menu bar.' , 'ubermenu' ),
		'ops'		=> $column_ops
	);

	$settings['column_layout'][20] = array(
		'id'		=> 'clear_row',
		'title'		=> __( 'New Row' , 'ubermenu' ),
		'desc'		=> __( 'Clear the previous row and start a new one with this item.' , 'ubermenu' ),
		'type'		=> 'checkbox',
		'default'	=> 'off',
		'scenario'	=> __( 'Submenu Columns' , 'ubermenu' ),
	);


	$settings['column_layout'][40] = array(
		'id' 		=> 'submenu_column_default',
		'title'		=> __( 'Submenu Column Default' , 'ubermenu' ),
		'type'		=> 'radio',
		'default'	=> 'auto',
		'desc'		=> __( 'The number of columns per row that the items within this column should be broken into by default.  Can be overridden on individual items', 'ubermenu' ),
		'ops'		=> $column_ops,
	);

	$settings['column_layout'][50] = array(
		'id' 		=> 'submenu_column_autoclear',
		'title'		=> __( 'Auto Row' , 'ubermenu' ),
		'type'		=> 'checkbox',
		'default' 	=> 'on',
		'desc'		=> __( 'Automatically start a new row every X items.  For example, if you choose a Submenu column default of 1/4, the 5th item will start a new column automatically.  Disable if you are adjusting item columns manually.' , 'ubermenu' ),
		'scenario'	=> __( 'Mega Submenus' , 'ubermenu' ),
	);



	








	/** SUBMENU **/

	$settings['submenu'][20] = array(
		'id' 		=> 'submenu_type',
		'title'		=> 'Submenu Type',
		'type'		=> 'radio',
		'type_class'=> 'ubermenu-radio-blocks',
		'default'	=> 'auto',
		'desc'		=> '',
		'ops'		=> array(
						'group1' => array(
							'auto'	=>	array(
								'name'	=> __( 'Automatic' , 'ubermenu' ),
								'desc'	=> __( 'UberMenu will attempt to automatically determine the best type of submenu for this item.' , 'ubermenu' ),
								'img_icon'	=> 'fa fa-bolt',
							),
							'mega'	=>	array( 
								'name'	=> __( 'Mega Submenu' , 'ubermenu' ),
								'desc'	=> __( 'A mega submenu' , 'ubermenu' ),
								'img'	=> $admin_img_assets.'SubmenuType_mega.png',
							),
							'flyout'=>	array(
								'name' 	=> __( 'Flyout Submenu' , 'ubermenu' ),
								'desc'	=> __( 'A standard Flyout submenu' , 'ubermenu' ),
								'img'	=> $admin_img_assets.'SubmenuType_flyout.png',
							),
							'stack'	=>	array(
								'name' 	=> __( 'Stack',	'ubermenu' ), //?
								'desc'	=> __( 'A stacked vertical submenu that is always visible' , 'ubermenu' ),
								'img'	=> $admin_img_assets.'SubmenuType_stack.png',
							),
							/*
							'accordion'	=> array(
								'name' 	=> __( 'Accordion? Reveal?',	'ubermenu' ), //?
								'desc'	=> __( 'A stacked vertical submenu that is revealed when activated' , 'ubermenu' ),
								//'img'	=> $admin_img_assets.'SubmenuType_stack.png',
							),
							*/
						),
					),
	);

	


	$settings['submenu'][40] = array(
		'id' 		=> 'submenu_position',
		'title'		=> __( 'Mega Submenu Position', 'ubermenu' ),
		'type'		=> 'radio',
		'type_class'=> 'ubermenu-radio-blocks',
		'default'	=> 'full_width',
		'desc'		=> __( 'Select how the submenu should be positioned relative to this item.' , 'ubermenu' ),
		'ops'		=> array(
						'group1' => array(
							'full_width'=>	array(
								'name'	=> __( 'Full Width' , 'ubermenu' ),
								'desc'	=> __( 'The submenu will be the full width of the menu bar (or wider, if not bound by the menu bar)' , 'ubermenu' ),
								'img'	=> $admin_img_assets.'SubmenuPosition_full.png',
							),
							'center'	=>	array(
								'name'	=> __( 'Center' , 'ubermenu' ),
								'desc'	=> __( 'Align mega submenu centered below the parent menu item.' , 'ubermenu' ),
								'img'	=> $admin_img_assets.'SubmenuPosition_center.png',
							),
							'left_edge_bar'	=>	array( 
								'name'	=> __( 'Left Edge of Menu Bar' , 'ubermenu' ),
								'desc'	=> __( 'Align submenu to the left edge of the menu bar (or to the next relative wrapper if the submenus are not bound by the menu bar)' , 'ubermenu' ),

								'img'	=> $admin_img_assets.'SubmenuPosition_left_edge_bar.png',
							),
							'right_edge_bar'=>	array(
								'name'	=> __( 'Right Edge of Menu Bar' , 'ubermenu' ),
								'desc'	=> __( 'Align submenu to the right edge of the menu bar (or to the next relative wrapper if the submenus are not bound by the menu bar)' , 'ubermenu' ),

								'img'	=> $admin_img_assets.'SubmenuPosition_right_edge_bar.png',
							),
							'left_edge_item' =>	array(
								'name'	=> __( 'Left Edge of Parent Item' , 'ubermenu' ),
								'desc'	=> __( 'Align submenu to the left edge of the parent menu item.' , 'ubermenu' ),
								'img'	=> $admin_img_assets.'SubmenuPosition_left_edge_item.png',
							),
							'right_edge_item' =>	array(
								'name'	=> __( 'Right Edge of Parent Item' , 'ubermenu' ),
								'desc'	=> __( 'Align submenu to the right edge of the parent menu item.  Forces direction:rtl.' , 'ubermenu' ),
								'img'	=> $admin_img_assets.'SubmenuPosition_right_edge_item.png',
							),
							'vertical_full_height' =>	array(
								'name'	=> __( 'Vertical - Full Height' , 'ubermenu' ),
								'desc'	=> __( 'The submenu will be the full height of the menu bar (at minimum), aligned to the top. [Vertically oriented menus only]' , 'ubermenu' ),
								'img'	=> $admin_img_assets.'SubmenuPosition_vertical_full.png',
							),
							'vertical_parent_item' =>	array(
								'name'	=> __( 'Vertical - Aligned to parent' , 'ubermenu' ),
								'desc'	=> __( 'The submenu will be a natural height and aligned to its parent item. [Vertically oriented menus only]' , 'ubermenu' ),
								'img'	=> $admin_img_assets.'SubmenuPosition_vertical_align.png',
							),
							
						),
					),
		'scenario'	=> __( 'Mega Submenus Only' , 'ubermenu' ),
	);


	$settings['submenu'][45] = array(
		'id' 		=> 'flyout_submenu_position',
		'title'		=> __( 'Flyout Submenu Position', 'ubermenu' ),
		'type'		=> 'radio',
		'type_class'=> 'ubermenu-radio-blocks',
		'default'	=> 'left_edge_item',
		'desc'		=> __( 'Select how the Flyout submenu should be positioned relative to this item.' , 'ubermenu' ),
		'ops'		=> array(
						'group1' => array(
							'left_edge_item' =>	array(
								'name'	=> __( 'Fly Right' , 'ubermenu' ),
								'desc'	=> __( 'For the first submenu, align to the left edge of the parent menu item. For deeper submenus, fly to the right of the previous level.' , 'ubermenu' ),
								'img'	=> $admin_img_assets.'SubmenuPosition_left_edge_item.png',
							),
							'right_edge_item' =>	array(
								'name'	=> __( 'Fly Left' , 'ubermenu' ),
								'desc'	=> __( 'For the first submenu, align to the right edge of the parent menu item. For deeper submenus, fly to the left of the previous level.  Forces direction:rtl.' , 'ubermenu' ),
								'img'	=> $admin_img_assets.'SubmenuPosition_right_edge_item.png',
							),
							'vertical_full_height' =>	array(
								'name'	=> __( 'Vertical - Full Height' , 'ubermenu' ),
								'desc'	=> __( 'The submenu will be the full height of the menu bar (at minimum), aligned to the top. [Vertically oriented menus only]' , 'ubermenu' ),
								'img'	=> $admin_img_assets.'SubmenuPosition_vertical_full.png',
							),
							'vertical_parent_item' =>	array(
								'name'	=> __( 'Vertical - Aligned to parent' , 'ubermenu' ),
								'desc'	=> __( 'The submenu will be a natural height and aligned to its parent item. [Vertically oriented menus only]' , 'ubermenu' ),
								'img'	=> $admin_img_assets.'SubmenuPosition_vertical_align.png',
							),
						),
					),

		'scenario'	=> __( 'Flyout Submenus Only' , 'ubermenu' ),
	);

	$settings['submenu'][50] = array(
		'id' 		=> 'submenu_width',
		'title'		=> 'Submenu Width',
		'type'		=> 'text',
		'default' 	=> __( '' , 'ubermenu' ),
		'desc'		=> __( 'Leave blank to size to contents.  If you are not using the Full Width submenu layout, some layouts will require an explicit width.  Include the units (px/em/%).' , 'ubermenu' ),
		'tip'		=> __( 'If you are using a mega submenu that is not full-width, and you want to structure your submenu with the Columns settings, you should set an explicit width here.', 'ubermenu' ),
		'on_save'	=> 'submenu_width',
	);

	$settings['submenu'][55] = array(
		'id' 		=> 'submenu_min_width',
		'title'		=> 'Submenu Minimum Width',
		'type'		=> 'text',
		'default' 	=> '',
		'desc'		=> __( 'By default, every mega submenu will be at least 50% width of the menu bar.  If you need to adjust this you can override it here.  Include the units (px/em/%).' , 'ubermenu' ),
		//'tip'		=> __( '', 'ubermenu' ),
		'on_save'	=> 'submenu_min_width',
	);


	$settings['submenu'][60] = array(
		'id' 		=> 'submenu_column_default',
		'title'		=> __( 'Submenu Column Default' , 'ubermenu' ),
		'type'		=> 'radio',
		'default'	=> 'auto',
		'desc'		=> __( 'The number of columns per row that the submenu should be broken into by default.  Can be overridden on individual items', 'ubermenu' ),
		'ops'		=> $column_ops,
	);


	$settings['submenu'][70] = array(
		'id' 		=> 'submenu_column_autoclear',
		'title'		=> __( 'Auto Row' , 'ubermenu' ),
		'type'		=> 'checkbox',
		'default' 	=> 'on',
		'desc'		=> __( 'Automatically start a new row every X items.  For example, if you choose a Submenu column default of 1/4, the 5th item will start a new column automatically.  Disable if you are adjusting item columns manually.' , 'ubermenu' ),
		'scenario'	=> __( 'Mega Submenus' , 'ubermenu' ),
	);

	$settings['submenu'][80] = array(
		'id' 		=> 'submenu_padded',
		'title'		=> __( 'Pad Submenu' , 'ubermenu' ),
		'type'		=> 'checkbox',
		'default' 	=> 'off',
		'desc'		=> __( 'Add padding to submenus (doubles the edge gutters).  Useful if you need to make the spacing at the edges of a row equal to that between the columns.' , 'ubermenu' ),
		'scenario'	=> __( 'Mega Submenus' , 'ubermenu' ),
	);

	$settings['submenu'][180] = array(
		'id' 		=> 'submenu_advanced',
		'title'		=> __( 'Advanced Submenus' , 'ubermenu' ),
		'type'		=> 'radio',
		'type_class'=> 'ubermenu-radio-blocks',
		'default'	=> 'auto',
		'desc'		=> __( 'Advanced submenus are useful for layouts such as full-screen-width submenus with centered submenu contents.  You can leave this on Automatic; setting Enabled or Disabled just increases efficiency slightly.', 'ubermenu' ),
		'ops'		=> array(
						'group1' => array(
							'auto'	=>	array(
								'name'	=> __( 'Automatic' , 'ubermenu' ),
								'desc'	=> __( 'UberMenu will attempt to automatically determine whether the item should have an advanced submenu.' , 'ubermenu' ),
							),
							'disabled'	=>	array( 
								'name'	=> __( 'Disabled' , 'ubermenu' ),
								'desc'	=> __( 'Disable the advanced submenu functionality.  The submenu cannot contain Rows.' , 'ubermenu' ),
							),
							'enabled'=>	array(
								'name' 	=> __( 'Enabled' , 'ubermenu' ),
								'desc'	=> __( 'Enable the advanced submenu functionality.  This allows you to add Row menu items to the submenu.  Note that all submenu items must be wrapped in Row Items (only Rows can be direct children of this item).  Or just use the Automatic setting.' , 'ubermenu' ),
							),
						),
					),
	);

	

	/** DEPRECATED **/

	$settings['deprecated'][10] = array(
		'id'		=> 'new_column',
		'title'		=> __( 'Start New Column' , 'ubermenu' ),
		'type'		=> 'checkbox',
		'default'	=> 'off',
		'desc'		=> __( 'Start a new column under the same header.  This setting is now deprecated.  Instead, either (1) use the "Column" menu item, or set the Header Layout to twice the normal width and set the Submenu Column Default to 1/2 (or 1/desired number of columns) .', 'ubermenu' ),
		'scenario'	=> '3rd Level Menu Items'
	);

	return apply_filters( 'ubermenu_menu_item_settings' , $settings );

}

function ubermenu_menu_item_setting_defaults(){
	$defaults = array();

	$settings = ubermenu_menu_item_settings();
	foreach( $settings as $panel => $panel_settings ){
		foreach( $panel_settings as $setting ){
			$defaults[$setting['id']] = $setting['default'];
		}
	}

	if( !ubermenu_is_pro() ){
		$pro_defaults = ubermenu_pro_defaults();
		$defaults = array_merge( $defaults , $pro_defaults );
	}

	$defaults = apply_filters( 'ubermenu_menu_item_settings_defaults' , $defaults );

	return $defaults;
}

function ubermenu_pro_defaults(){
	$defaults = array(
		'item_align'						=> 'auto',
		'mini_item'							=> 'off',
		'scrollto'							=> '',
		//'scrollto_offset'					=> 0,
		'no_wrap'							=> 'off',
		'item_trigger'						=> 'auto',
		'disable_submenu_indicator'			=> 'off',
		'target_class'						=> '',
		'target_id'							=> '',
		'icon'								=> '',
		'item_image'						=> '',
		'inherit_featured_image'			=> 'off',
		'image_size'						=> 'inherit',
		'image_dimensions'					=> 'inherit',
		'image_width_custom'				=> '',
		'image_height_custom'				=> '',
		'disable_padding'					=> 'off',
		'hide_on_mobile'					=> 'off',
		'hide_on_desktop'					=> 'off',
		'disable_on_mobile'					=> 'off',
		'disable_on_desktop'				=> 'off',
		'disable_submenu_on_mobile'			=> 'off',
		'show_current'						=> 'off',
		'show_default'						=> 'off',
		'submenu_background_image'			=> '',
		'submenu_background_image_repeat'	=> 'no-repeat',
		'submenu_background_position'		=> 'bottom right',
		'submenu_background_size'			=> 'auto',
		'submenu_padding'					=> '',
		'submenu_footer_content'			=> '',
		'submenu_grid'						=> 'off',
		
		'tab_layout'						=> 'left',
		'tab_block_columns'					=> 'full',
		'tabs_group_layout'					=> '1-4',
		'panels_group_layout'				=> '3-4',
		'panels_padding'					=> '',
		'show_default_panel'				=> 'on',
		'tabs_trigger'						=> 'mouseover',
		'menu_segment'						=> '',
		'custom_content'					=> '',
		'pad_custom_content'				=> 'on',
		'columns'							=> 'auto',
		'item_align'						=> 'auto',

		'auto_widget_area'					=> '',
		'widget_area'						=> '',
		'widget_area_columns'				=> 'auto',

	);
	return $defaults;
}


function ubermenu_get_menu_items_data( $menu_id = -1 ){

	if( $menu_id == -1 ){
		global $nav_menu_selected_id;
		$menu_id = $nav_menu_selected_id;
	}

	if( $menu_id == 0 ) return array();

	$ubermenu_menu_data = array();
	$menu_items = wp_get_nav_menu_items( $menu_id, array( 'post_status' => 'any' ) );

	foreach( $menu_items as $item ){
		$_item_settings = ubermenu_get_menu_item_data( $item->ID );
		if( $_item_settings != '' ){
			$ubermenu_menu_data[$item->ID] = $_item_settings;
		}
	}
	//shiftp( $ubermenu_menu_data );
	return $ubermenu_menu_data;
}

function ubermenu_get_menu_item_data( $item_id ){
	$meta = get_post_meta( $item_id , UBERMENU_MENU_ITEM_META_KEY , true );

	//Add URL for image
	if( !empty( $meta['item_image'] ) ){
		$src = wp_get_attachment_image_src( $meta['item_image'] );
		if( $src ){
			$meta['item_image_url'] = $src[0];
			$meta['item_image_edit'] = get_edit_post_link( $meta['item_image'], 'raw' );
		}
	}
	if( !empty( $meta['submenu_background_image'] ) ){
		$src = wp_get_attachment_image_src( $meta['submenu_background_image'] );
		if( $src ){
			$meta['submenu_background_image_url'] = $src[0];
			$meta['submenu_background_image_edit'] = get_edit_post_link( $meta['submenu_background_image'], 'raw' );
		}
	}

	return $meta;
}



function ubermenu_get_item_column_ops(){
	$ops = array(
		'group1'	=> array(
				'group_title'	=> 'Basic',
				'auto'	=>	array(
								'name'	=> 'Automatic',
							),
				/*'inherit' =>array(
								'name'	=> 'Inherit',
							),*/
				'natural' => array(
								'name'	=> 'Natural',
							),
				
				'full'	=>	array(
								'name'	=> 'Full Width',
							),
			),
		'col-group2' 	=> array(
				'group_title'	=> 'Halves',
				'1-2'	=>	array(
								'name'	=> '1/2',
							),
			),
		'group3'	=> array(
				'group_title'	=> 'Thirds',
				'1-3'	=>	array(
								'name'	=> '1/3',
							),
				'2-3'	=>	array(
								'name'	=> '2/3',
							),
			),
		'group4'	=> array(
				'group_title'	=> 'Quarters',
				'1-4'	=>	array(
								'name'	=> '1/4',
							),
				'3-4'	=>	array(
								'name'	=> '3/4',
							),
			),
		'group5'	=> array(
				'group_title'	=> 'Fifths',
				'1-5'	=>	array(
								'name'	=> '1/5',
							),
				'2-5'	=>	array(
								'name'	=> '2/5',
							),
				'3-5'	=>	array(
								'name'	=> '3/5',
							),
				'4-5'	=>	array(
								'name'	=> '4/5',
							),
			),
		'group6'	=> array(
				'group_title'	=> 'Sixths',
				'1-6'	=>	array(
								'name'	=> '1/6',
							),
				'5-6'	=>	array(
								'name'	=> '5/6',
							),
			),
		'group7'	=> array(
				'group_title'	=> 'Sevenths',
				'1-7'	=>	array(
								'name'	=> '1/7',
							),
				'2-7'	=>	array(
								'name'	=> '2/7',
							),
				'3-7'	=>	array(
								'name'	=> '3/7',
							),
				'4-7'	=>	array(
								'name'	=> '4/7'
							),
				'5-7'	=>	array(
								'name'	=> '5/7',
							),
				'6-7'	=>	array(
								'name'	=> '6/7',
							),
			),

		'group8'	=> array(
				'group_title'	=> 'Eighths',
				'1-8'	=> 	array(
								'name'	=> '1/8'
							),
				'3-8'	=>	array(
								'name'	=> '3/8',
							),
				'5-8'	=>	array(
								'name'	=> '5/8',
							),
				'7-8'	=>	array(
								'name'	=> '7/8',
							),

			),

		'group9'	=> array(
				'group_title'	=> 'Ninths',
				'1-9'	=>	array(
								'name'	=> '1/9',
							),
				'2-9'	=>	array(
								'name'	=> '2/9',
							),
				'4-9'	=>	array(
								'name'	=> '4/9',
							),
				'5-9'	=>	array(
								'name'	=> '5/9',
							),
				'7-9'	=>	array(
								'name'	=> '7/9',
							),
				'8-9'	=>	array(
								'name'	=> '8/9',
							),

			),

		'group10'	=> array(
				'group_title'	=> 'Tenths',
				'1-10'	=>	array(
								'name'	=> '1/10',
							),
				'3-10'	=>	array(
								'name'	=> '3/10',
							),
				'7-10'	=>	array(
								'name'	=> '7/10',
							),
				'9-10'	=>	array(
								'name'	=> '9/10',
							),
			),

		'group11'	=> array(
				'group_title'	=> 'Elevenths',
				'1-11'	=> 	array(
								'name'	=> '1/11',
							),
				'2-11'	=> 	array(
								'name'	=> '2/11',
							),
				'3-11'	=> 	array(
								'name'	=> '3/11',
							),
				'4-11'	=> 	array(
								'name'	=> '4/11',
							),
				'5-11'	=> 	array(
								'name'	=> '5/11',
							),
				'6-11'	=> 	array(
								'name'	=> '6/11',
							),
				'7-11'	=> 	array(
								'name'	=> '7/11',
							),
				'8-11'	=> 	array(
								'name'	=> '8/11',
							),
				'9-11'	=> 	array(
								'name'	=> '9/11',
							),
				'10-11'	=> 	array(
								'name'	=> '10/11',
							),
			),
		'group12'	=> array(
				'group_title'	=> 'Twelfths',
				'1-12'	=> 	array(
								'name'	=> '1/12',
							),
				'5-12'	=> 	array(
								'name'	=> '5/12',
							),
				'7-12'	=> 	array(
								'name'	=> '7/12',
							),
				'11-12'	=> 	array(
								'name'	=> '11/12',
							),
			),

		);


	//TODO: Filter
	return $ops;
}

function ubermenu_get_column_complement( $columns ){

	//3-5

	$m = explode( '-' , $columns );
	if( count( $m ) < 2 ) return $columns;

	// ( 5 - 3 ) - 5
	return ( $m[1] - $m[0] ) .'-'.$m[1];


	/*
	$map = array(

		'auto'		=> 'auto',
		'natural' 	=> 'natural',
		'full'		=> 'full',
		'1-2'		=>
		'1-3'	=>	
		'2-3'	=>	
		'1-4'	=>	
		'3-4'	=>	
		'1-5'	=>	
		'2-5'	=>	
		'3-5'	=>	
		'4-5'	=>	
		'1-6'	=>	
		'5-6'	=>	
		'1-7'	=>	
		'2-7'	=>	
		'3-7'	=>	
		'4-7'	=>	
		'5-7'	=>	
		'6-7'	=>	
		'1-8'	=> 	
		'3-8'	=>	
		'5-8'	=>	
		'7-8'	=>	
		'1-9'	=>	
		'2-9'	=>	
		'4-9'	=>	
		'5-9'	=>	
		'7-9'	=>	
		'8-9'	=>	
		'1-10'	=>	
		'3-10'	=>	
		'7-10'	=>	
		'9-10'	=>	
		'1-11'	=> 	
		'2-11'	=> 	
		'3-11'	=> 	
		'4-11'	=> 	
		'5-11'	=> 	
		'6-11'	=> 	
		'7-11'	=> 	
		'8-11'	=> 	
		'9-11'	=> 	
		'10-11'	=> 	
		'1-12'	=> 	
		'5-12'	=> 	
		'7-12'	=> 	
		'11-12'	=> 	
		); */

		
}

function ubermenu_get_item_layout_ops(){

	$admin_img_assets = UBERMENU_URL . 'admin/assets/images/';

	$ops = array();

	$ops['core'] = array(
		'default' => array(
			'name'	=> __( 'Default', 'ubermenu' ),
			'desc'	=> __( 'Layout will be automatically determined' , 'ubermenu' ),
		),
		'text_only'	=> array(
			'name'	=> __( 'Text Only', 'ubermenu' ),
			'desc'	=> __( 'No image or icon, just the text' , 'ubermenu' ),
		),
	);

	$ops['icons']	= array(
		'group_title'	=> __( 'Icon Layouts', 'ubermenu' ),

		'icon_left' => array(
			'name'	=> __( 'Icon Left', 'ubermenu' ),
		),
	);

	return apply_filters( 'ubermenu_item_layout_ops' , $ops );
}

function ubermenu_get_item_layouts( $layout_id = 0 ){

	$layouts = array();

	$layouts['text_only'] = array(

		'order'	=> array(
			'title',
			'description',
		),
	);

	$layouts['image_left'] = array(

		'order'	=> array(
			'image',
			'title',
			'description',
		),

	);

	$layouts['image_above'] = array(

		'order'	=> array(
			'image',
			'title',
			'description',
		),

	);

	$layouts['image_right'] = array(

		'order'	=> array(
			
			'image',			//because we float it right
			'title',
			'description',
			
		),

	);

	$layouts['image_below'] = array(

		'order'	=> array(			
			'title',
			'description',
			'image',
		),

	);

	$layouts['image_only'] = array(

		'order'	=> array(
			'image',			
		),

	);

	$layouts['icon_left'] = array(
		'order'	=> array(
			'icon',
			'title',
			'description',
		),
	);

	$layouts = apply_filters( 'ubermenu_item_layouts' , $layouts );

	if( $layout_id ){
		if( isset( $layouts[$layout_id] ) ){
			return $layouts[$layout_id];
		}

		return false;
	}

	return $layouts;

}


function ubermenu_get_item_button_ops(){

	$ops = array();

	$ops['core'] = array(

		'off'	=> array(
			'name'	=> 'Disabled'
		),
		'custom'	=> array(
			'name'	=> 'Custom',
		),
		'red'	=> array(
			'name'	=> 'Red',
		),
		'blue'	=> array(
			'name'	=> 'Blue',
		),

	);

	return apply_filters( 'ubermenu_item_button_ops' , $ops );

}

function ubermenu_get_image_size_ops_inherit(){
	return ubermenu_get_image_size_ops( array( 'inherit' ) );
}

function ubermenu_get_image_size_ops( $exclude = array() ){

		
		$o = array(
			'inherit'	=> array(
				'name'	=> __( 'Inherit' , 'ubermenu' ),
				'desc'	=> __( 'Inherit settings from the menu instance settings' , 'ubermenu' )
			),
			'full'	=> array(
				'name'	=> __( 'Full' , 'ubermenu' ),
				'desc'	=> __( 'Display image at natural dimensions' , 'ubermenu' )
			),

		);

		$available_sizes = get_intermediate_image_sizes();

		//$o = array_merge( $o , $available_sizes );
		foreach( $available_sizes as $s ){

			$name = ucfirst( $s );
			$desc = '<small>'.__( 'Registered image size ' , 'ubermenu' ) . '<code>'.$s.'</code></small>';

			global $_wp_additional_image_sizes;

			$w = false;
			if( in_array( $s, array( 'thumbnail', 'medium', 'large' ) ) ){
				$w = get_option( $s . '_size_w' );
				$h = get_option( $s . '_size_h' );
				$c = (bool) get_option( $s . '_crop' );
			}
			else if ( isset( $_wp_additional_image_sizes[ $s ] ) ) {
				
				$w = $_wp_additional_image_sizes[ $s ]['width'];
				$h = $_wp_additional_image_sizes[ $s ]['height'];
				$c = $_wp_additional_image_sizes[ $s ]['crop'];
			}
			if( $w ){
				 $desc = "($w &times; $h)" . ( $c ? ' [cropped]' : '' ).'<br/>' . $desc;
			}

			$o[$s] = array(
				'name'	=> $name,
				'desc'	=> $desc,
			);
		}

		foreach( $exclude as $ex ){
			unset( $o[$ex] );
		}

		$ops = array(
			'group'	=> $o,
		);

		return $ops;
}
//up( get_intermediate_image_sizes(); 
//full


/** AJAXY! **/

function ubermenu_menu_item_settings_nonce(){
	return wp_create_nonce( 'ubermenu-menu-item-settings' );
}

add_action( 'wp_ajax_ubermenu_save_menu_item', 'ubermenu_save_menu_item_callback' );

function ubermenu_save_menu_item_callback() {
	global $wpdb; // this is how you get access to the database

	//CHECK NONCE
	check_ajax_referer( 'ubermenu-menu-item-settings' , 'ubermenu_nonce' );

	$menu_item_id = $_POST['menu_item_id'];
	$menu_item_id = substr( $menu_item_id , 10 );

	$serialized_settings = $_POST['settings'];
	$dirty_settings = array();
	parse_str( $serialized_settings, $dirty_settings );


	//CHECKBOXES
	//Since unchecked checkboxes won't be submitted, detect them and set the 'off' value
	$_defined_settings = ubermenu_menu_item_settings();
	foreach( $_defined_settings as $panel => $panel_settings ){
		foreach( $panel_settings as $_priority => $_setting ){
			if( $_setting['type'] == 'checkbox' ){
				$_id = $_setting['id'];
				if( !isset( $dirty_settings[$_id] ) ){
					$dirty_settings[$_id] = 'off';
				}
			}
		}
	}
//up( $dirty_settings );
//die();

	//ONLY ALLOW SETTINGS WE'VE DEFINED	
	$settings = wp_parse_args( $dirty_settings, ubermenu_menu_item_setting_defaults() );
	
	//SAVE THE SETTINGS
	update_post_meta( $menu_item_id, UBERMENU_MENU_ITEM_META_KEY , $settings );

	//RUN CALLBACKS
	//Reset styles for this menu item here
	//ubermenu_reset_item_styles( $menu_item_id );

	foreach( $_defined_settings as $panel => $panel_settings ){
		foreach( $panel_settings as $_priority => $_setting ){
			if( isset( $_setting['on_save'] ) ){
				$callback = 'ubermenu_item_save_'.$_setting['on_save'];
				if( function_exists( $callback ) ){
					$callback( $menu_item_id , $_setting , $settings[$_setting['id']] , $settings );
				}
			}
		}
	}

	//Set Defaults	
	if( isset( $dirty_settings['ubermenu-meta-save-defaults'] ) &&
		$dirty_settings['ubermenu-meta-save-defaults'] == 'on' ){
		update_option( UBERMENU_MENU_ITEM_DEFAULTS_OPTION_KEY , $settings );
	}

	//Reset Defaults	
	if( isset( $dirty_settings['ubermenu-meta-reset-defaults'] ) &&
		$dirty_settings['ubermenu-meta-reset-defaults'] == 'on' ){
		delete_option( UBERMENU_MENU_ITEM_DEFAULTS_OPTION_KEY );
	}
	

	do_action( 'ubermenu_after_menu_item_save' );

	$response = array();

	$response['settings'] = $settings;
	$response['menu_item_id'] = $menu_item_id;

	//send back nonce
	$response['nonce'] = ubermenu_menu_item_settings_nonce();

	//print_r( $response );
	echo json_encode( $response );

	//echo $data;

	die(); // this is required to return a proper result
}


/** Helper Callbacks **/
function ubermenu_dp_category_ops(){
	return ubermenu_get_term_ops_by_tax( 'category' , array(
		'-1' 	=> 'Inherit Parent Category Item',
	));
}
function ubermenu_dp_tag_ops(){
	return ubermenu_get_term_ops_by_tax( 'post_tag' , array(
		'-1' 	=> 'Inherit Parent Tag Item',
	));
}
function ubermenu_dp_post_parent_ops(){
	return ubermenu_get_post_parent_ops( array(
		'-1' 	=> 'Inherit Parent Menu Item',
	));
}

function ubermenu_dp_custom_tax_ops( $args ){
	$tax = $args['tax'];
	return ubermenu_get_term_ops_by_tax( $args['tax_id'] , array(
		'-1' 	=> 'Inherit Parent '.$tax->label.' Item',
	));
}

function ubermenu_dt_parent_ops(){
	return ubermenu_get_term_ops( array(
		'-1' 	=> 'Automatic: Inherit Parent',
	));
}

function ubermenu_dt_child_of_ops(){
	return ubermenu_get_term_ops( array(
		'-1' 	=> 'Automatic: Inherit Parent',
	));
}






function ubermenu_custom_menu_item_defaults( $defaults ){
	$cdefs = get_option( UBERMENU_MENU_ITEM_DEFAULTS_OPTION_KEY );
	if( $cdefs ){
		if( is_array( $cdefs ) ){
			foreach( $cdefs as $key => $val ){
				$defaults[$key] = $val;
			}
		}
	}
	return $defaults;
}
add_filter( 'ubermenu_menu_item_settings_defaults' , 'ubermenu_custom_menu_item_defaults' );