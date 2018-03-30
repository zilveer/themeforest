<?php


add_filter( 'wp_setup_nav_menu_item' , 'ubermenu_setup_nav_menu_item' );
function ubermenu_setup_nav_menu_item( $menu_item ){
	

	if( $menu_item->type == 'custom' ){

		//Check flag FIRST, only deal with URL if flag hasn't been set
		
		$custom_item_type = '';
		$items = ubermenu_get_custom_menu_item_types();
		$url = $menu_item->url;
		$uber_prefix = '#ubermenu-';

		//When item is added to menu, set flag
		if( $menu_item->post_status == 'draft' ){
			if( strpos( $url , $uber_prefix ) === 0 ){

				$custom_item_type = substr( $url , strlen( $uber_prefix ) );
				update_post_meta( $menu_item->ID , '_ubermenu_custom_item_type' , $custom_item_type );

			}
		}
		//Not new, check meta
		else{
			$custom_item_type = get_post_meta( $menu_item->ID , '_ubermenu_custom_item_type' , true );
		}


		if( $custom_item_type ){
			$menu_item->object = 'ubermenu-custom';	//perhaps if is_admin() only
			$label = $custom_item_type.' Undefined';
			if( isset( $items[$custom_item_type] ) ){
				$label = $items[$custom_item_type]['label'];
			}
			$menu_item->type_label = '[UberMenu ' . $label . ']';
		}

	}

	return $menu_item;
}

function ubermenu_get_custom_menu_item_types(){

	$items = array(		

		'row'	=> array(
			'label'	=>	__( 'Row' , 'ubermenu' ),
			'title' =>	'['.__( 'Row' , 'ubermenu' ) . ']',
			'panels'	=> array( 'row' , 'responsive' ),
			'desc'	=>	__( 'A row which can wrap any type of item.  Useful for creating divisions and centering submenu contents.' , 'ubermenu' ),
		),

		'column' => array(
			'label'	=>	__( 'Column' , 'ubermenu' ),
			'title' =>	'['.__( 'Column' , 'ubermenu' ) . ']',
			'panels'	=> array( 'column_layout' , 'responsive' ),
			'desc'	=>	__( 'A column, which can contain any type of item.  Useful for placing multiple blocks of items in a single column.' , 'ubermenu' ),
		),

		'divider'	=> array(
			'label'	=> 	__( 'Horizontal Divider' , 'ubermenu' ),
			'title'	=>	'['.__( 'Divider' , 'ubermenu' ).']',
			'panels'=> array( 'divider' ),
			'desc'	=>	__( 'A visual divider between submenu segments.' , 'ubermenu' )
		),		

	);
	return apply_filters( 'ubermenu_custom_menu_item_types' , $items );
}

function ubermenu_get_menu_item_panels_map(){
	$map = array(

		'default'	=> array(
			'general',
			'icon',
			'image',
			'layout',
			'responsive',
			'submenu',
			'custom_content',
			'widgets',
			'customize',
			'deprecated',
		)

	);
	$items = ubermenu_get_custom_menu_item_types();
	foreach( $items as $id => $item ){
		if( isset( $item['panels'] ) ){
			$map['[UberMenu ' . $item['label'] . ']' ] = $item['panels'];
		}
	}

	$map = apply_filters( 'ubermenu_menu_item_settings_panels_map' , $map );

	return $map;
}


add_action( 'admin_init' , 'ubermenu_add_custom_menu_items_meta_box' );
function ubermenu_add_custom_menu_items_meta_box(){
	add_meta_box( 'ubermenu_custom_nav_items', 'UberMenu Advanced Items', 'ubermenu_custom_menu_items_meta_box', 'nav-menus', 'side', 'low' );
}

function ubermenu_custom_menu_items_meta_box() { 
	global $_nav_menu_placeholder, $nav_menu_selected_id;

	$items = ubermenu_get_custom_menu_item_types();

	?>
	<div id="ubermenu-custom-menu-metabox" class="posttypediv">
		<div id="tabs-panel-ubermenu-custom" class="tabs-panel tabs-panel-active">
			<ul id ="ubermenu-custom-checklist" class="categorychecklist form-no-clear">

			<?php foreach( $items as $id => $item ): 
				$url = '#ubermenu-'.$id;
				if( isset( $item['url'] ) ){
					$url = $item['url'];
				}

				?>

				<li>
					<label class="menu-item-title um-tooltip-wrap">
						<input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-label]" value="0"> <?php echo $item['label']; ?>
						<span class="um-tooltip"><?php echo $item['desc']; ?></span>
					</label>
					<input type="hidden" class="menu-item-type" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-type]" value="custom">
					<input type="hidden" class="menu-item-ubermenu-custom" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-ubermenu-custom]" value="on">
					<input type="hidden" class="menu-item-title" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-title]" value="<?php echo $item['title']; ?>">
					<input type="hidden" class="menu-item-url" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-url]" value="<?php echo $url; ?>">
				</li>

			<?php endforeach; ?>

			</ul>
		</div>
		<p class="button-controls">
			
			<span class="add-to-menu">
				<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-ubermenu-custom-menu-item" id="submit-ubermenu-custom-menu-metabox">
				<span class="spinner"></span>
			</span>
		</p>
	</div>
	<?php
}
