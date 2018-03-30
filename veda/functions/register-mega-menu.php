<?php
add_filter( 'wp_edit_nav_menu_walker', 'veda_modify_backend_walker' , 2000 );
function veda_modify_backend_walker() {
	return 'Veda_ModifyBackendMenuWalker';
}
/* ---------------------------------------------------------------------------
 * Admin Menu Walker
 * This is copy of wp-admin/includes/nav-menu.php
 * --------------------------------------------------------------------------- */
class Veda_ModifyBackendMenuWalker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {}
	function end_lvl( &$output, $depth = 0, $args = array() ) {}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = get_the_title( $original_object->ID );
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( esc_html__( '%s (Invalid)', 'veda' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( esc_html__('%s (Pending)', 'veda'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';
		?>
		<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo esc_attr(implode(' ', $classes )); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php esc_html_e( 'sub item', 'veda' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'veda'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'veda'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item', 'veda'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php esc_html_e( 'Edit Menu Item', 'veda' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'URL', 'veda' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Navigation Label', 'veda' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Title Attribute', 'veda' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php esc_html_e( 'Open link in a new window/tab', 'veda' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'CSS Classes (optional)', 'veda' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Link Relationship (XFN)', 'veda' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Description', 'veda' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'veda'); ?></span>
					</label>
				</p>

				<!-- DesignThemes Custom Code Begins Here-->
				<?php $value = get_post_meta( $item->ID, '_dt-use-as-megamenu', true);?>
                <p class="field-dt-use-as-megamenu description description-thin">
                    <label for="edit-menu-item-dt-use-as-megamenu-<?php echo esc_attr($item_id); ?>">
                        <input type="checkbox" id="edit-menu-item-dt-use-as-megamenu-<?php echo esc_attr($item_id); ?>" value="1" name="dt-use-as-megamenu[<?php echo esc_attr($item_id); ?>]"<?php checked( $value, 1 ); ?> />
                        <?php esc_html_e( 'Use As Mega Menu' ,  'veda' ); ?>
                    </label>
                </p>

                <?php $value = get_post_meta( $item->ID, '_dt-disable-text', true);?>
                <p class="field-dt-disable-text description description-thin">
                    <label for="edit-menu-item-dt-disable-text-<?php echo esc_attr($item_id); ?>">
                        <input type="checkbox" id="edit-menu-item-dt-disable-text-<?php echo esc_attr($item_id); ?>" value="1" name="dt-disable-text[<?php echo esc_attr($item_id); ?>]"<?php checked( $value, 1 ); ?> />
                        <?php esc_html_e( 'Disable Text' ,  'veda'); ?>
                    </label>
                </p>

                <?php $value = get_post_meta( $item->ID, '_dt-disable-link', true);?>
                <p class="field-dt-disable-link description description-thin">
                    <label for="edit-menu-item-dt-disable-link-<?php echo esc_attr($item_id); ?>">
                        <input type="checkbox" id="edit-menu-item-dt-disable-link-<?php echo esc_attr($item_id); ?>" value="1" name="dt-disable-link[<?php echo esc_attr($item_id); ?>]"<?php checked( $value, 1 ); ?> />
                        <?php esc_html_e( 'Disable Link' ,  'veda' ); ?>
                    </label>
                </p>

                <?php $value = get_post_meta( $item->ID, '_dt-fullwidth', true);?>
                <p class="field-dt-fullwidth description description-thin">
                    <label for="edit-menu-item-dt-fullwidth<?php echo esc_attr($item_id); ?>">
                        <input type="checkbox" id="edit-menu-item-dt-fullwidth<?php echo esc_attr($item_id); ?>" value="1" name="dt-fullwidth[<?php echo esc_attr($item_id); ?>]"<?php checked( $value, 1 ); ?> />
                        <?php esc_html_e( 'Enable Full width' ,  'veda' ); ?>
                    </label>
                </p>

                <?php $value = get_post_meta( $item->ID, '_dt-columns', true);?>
                <p class="field-dt-submenu-column description description-wide">
                    <label for="edit-menu-item-dt-submenu-column-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e( 'Sub Menu Column Layout' ,  'veda' ); ?><br />
                        <select id="edit-menu-item-dt-submenu-column-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-dt-submenu-column" name="dt-submenu-column[<?php echo esc_attr($item_id); ?>]">
                        <?php for( $i = 2; $i <= 4; $i++): ?>
                          <option value="<?php echo esc_attr($i);?>" <?php selected( $value,$i);?>><?php echo $i; ?></option>
                        <?php endfor;?>
                        </select>
                    <span class="description"><?php esc_html_e('Select where to align the submenu.',  'veda'); ?></span>
                    </label>
                </p>

                <?php $value = get_post_meta( $item->ID, "_dt-menu-icon",true); ?>
                <p class="field-dt-menuicon description description-wide">
                    <label for="edit-menu-item-dt-menu-icon-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e( 'Menu Icon' ,'veda');?><br/>
                    <input id="edit-menu-item-dt-menu-icon-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-dt-menu-icon" type="text" name="dt-menu-icon[<?php echo esc_attr($item_id);?>]" value="<?php echo esc_attr($value);?>">
                    <span class="description"><?php esc_html_e('Please use font awesome icon ',  'veda'); ?></span>
                    </label>
                </p>

                <?php $value = get_post_meta( $item->ID, "_dt-menu-bg",true); ?>
                <p class="field-dt-menu-bg description description-wide">
                    <label for="edit-menu-item-dt-menu-bg-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e( 'Menu Background' ,'veda');?><br/>
                    <input id="edit-menu-item-dt-menu-bg-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-dt-menu-bg" type="text" name="dt-menu-bg[<?php echo esc_attr($item_id);?>]" value="<?php echo esc_attr($value);?>">
                    <span class="description"><?php esc_html_e('Please use image url',  'veda'); ?></span>
                    </label>
                </p>

                <?php $selected = get_post_meta( $item->ID, '_dt-menu-widget', true);?>
                <p class="field-dt-submenu-widget description description-wide">
                    <label for="edit-menu-item-dt-submenu-widget-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e( 'Display Widget Area' ,  'veda' ); ?><br />
                        <select id="edit-menu-item-dt-submenu-widget-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-dt-submenu-widget" name="dt-submenu-widget[<?php echo esc_attr($item_id); ?>]">
                            <option value=""><?php esc_html_e('Select', 'veda');?></option><?php
                            $widgets = veda_option('widgetarea','custom');
                            $widgets = is_array($widgets) ? array_unique($widgets) : array();
                            $widgets = array_filter($widgets);
                            foreach( $widgets as $widget) {
                                $id = mb_convert_case($widget, MB_CASE_LOWER, "UTF-8");
                                $id = str_replace(" ", "-", $id);
                                echo "<option value='{$id}' " . selected ( $selected, $id, false ) . ">{$widget}</option>";
                            }?>
                        </select>
                    <span class="description"><?php esc_html_e('Select widget area to show.',  'veda'); ?></span>
                    </label>
                </p>

                <?php $value = get_post_meta( $item->ID, '_dt-fill-columns', true);?>
                <p class="field-dt-widgetarea-column description description-wide">
                        <label for="edit-menu-item-dt-submenu-column-<?php echo esc_attr($item_id); ?>">
                        <?php esc_html_e( 'Fill Widget Area Layout' ,  'veda' ); ?><br />
                            <select id="edit-menu-item-dt-widgetarea-column-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-dt-submenu-column" name="dt-widgetarea-column[<?php echo esc_attr($item_id); ?>]">
                                <option value=""><?php esc_html_e('select','veda');?></option>
                            <?php for( $i = 2; $i <= 4; $i++): ?>
                              <option value="<?php echo esc_attr($i);?>" <?php selected( $value,$i);?>><?php echo $i; ?></option>
                            <?php endfor;?>
                            </select>
                        <span class="description"><?php esc_html_e('Only works if you choose widget area',  'veda'); ?></span>
                        </label>
                </p>
				<!-- DesignThemes Custom Code Ends Here-->

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php esc_html_e( 'Move', 'veda' ); ?></span>
						<a href="#" class="menus-move-up"><?php esc_html_e( 'Up one', 'veda' ); ?></a>
						<a href="#" class="menus-move-down"><?php esc_html_e( 'Down one', 'veda' ); ?></a>
						<a href="#" class="menus-move-left"></a>
						<a href="#" class="menus-move-right"></a>
						<a href="#" class="menus-move-top"><?php esc_html_e( 'To the top', 'veda' ); ?></a>
					</label>
				</p>
				
				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( esc_html__('Original: %s', 'veda'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php esc_html_e( 'Remove', 'veda' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel', 'veda'); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}
}

/* ---------------------------------------------------------------------------
 * To Save Menu Items
 * --------------------------------------------------------------------------- */
add_action( 'wp_update_nav_menu_item', 'veda_update_menu_item', 10, 3 );
function veda_update_menu_item( $menu_id, $menu_item_db, $args ) {

	$value = isset( $_POST['dt-use-as-megamenu'][$menu_item_db] ) ? $_POST['dt-use-as-megamenu'][$menu_item_db] : "";
	update_post_meta( $menu_item_db,'_dt-use-as-megamenu',$value );

	$value = isset( $_POST['dt-disable-text'][$menu_item_db] ) ? $_POST['dt-disable-text'][$menu_item_db] : "";
	update_post_meta( $menu_item_db,'_dt-disable-text',$value );

	$value = isset( $_POST['dt-disable-link'][$menu_item_db] ) ? $_POST['dt-disable-link'][$menu_item_db] : "";
	update_post_meta( $menu_item_db,'_dt-disable-link',$value );

	$value = isset( $_POST['dt-fullwidth'][$menu_item_db] ) ? $_POST['dt-fullwidth'][$menu_item_db] : "";
	update_post_meta( $menu_item_db,'_dt-fullwidth',$value );

	$value = isset( $_POST['dt-submenu-column'][$menu_item_db] ) ? $_POST['dt-submenu-column'][$menu_item_db] : "";
	update_post_meta( $menu_item_db,'_dt-columns',$value );


	$value = isset( $_POST['dt-widgetarea-column'][$menu_item_db] ) ? $_POST['dt-widgetarea-column'][$menu_item_db] : "";
	update_post_meta( $menu_item_db,'_dt-fill-columns',$value );

	$value = isset( $_POST['dt-menu-icon'][$menu_item_db] ) ? $_POST['dt-menu-icon'][$menu_item_db] : "";
	update_post_meta( $menu_item_db,'_dt-menu-icon',$value );
	
	$value = isset( $_POST['dt-menu-bg'][$menu_item_db] ) ? $_POST['dt-menu-bg'][$menu_item_db] : "";
	update_post_meta( $menu_item_db, "_dt-menu-bg",$value);

	$value = isset( $_POST['dt-submenu-widget'][$menu_item_db] ) ? $_POST['dt-submenu-widget'][$menu_item_db] : "";
	update_post_meta( $menu_item_db,'_dt-menu-widget',$value );
}
/* ---------------------------------------------------------------------------
 * Front End Walker
 * Walker - located at wp-includes/class-wp-walker.php
 * --------------------------------------------------------------------------- */
class Veda_FrontEndMenuWalker extends Walker {
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	var $mega_active;
	var $dt_menuicon;
	var $dt_menubg = '';

	function start_lvl( &$output, $depth = 0, $args = array()) {
		
		$animation = '';
		$indent = str_repeat("\t", $depth);
		
		if($depth === 0) $output .= "\n{replace_one}\n";
		
		if( !($this->mega_active) && ( $depth === 0 ) ){
			$animation = veda_option('layout','menu-hover-style');
			if( !empty( $animation ) ) {
				$animation = "animate ".$animation;
			}
		}
		
		#$boxshadow = ( "true" ==  veda_option('layout','menu-boxshadow') ) ? 'with-box-shadow' : '';
		$output .= "\n$indent<ul class=\"sub-menu {$animation}\">\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		
		$animation = '';
		
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
		$output .= '<a class="dt-menu-expand" href="#">+</a>';		
		
		if($depth === 0) {
			if($this->mega_active){

				$animation = veda_option('layout','menu-hover-style');
				if( !empty( $animation ) ) {
					$animation = "animate ".$animation;
				}
				
				$output .= "\n</div>\n";
				$output .= '<a class="dt-menu-expand" href="#">+</a>';
				if($this->dt_menubg) {
					$output = str_replace("{replace_one}", "<div class='megamenu-child-container menu-hasbg {$animation}' style='background-image: url(\"{$this->dt_menubg}\");'>", $output);
				} else {
					$output = str_replace("{replace_one}", "<div class='megamenu-child-container {$animation}'>", $output);
				}
			}else{
				$output = str_replace("{replace_one}", "", $output);
			}
		}
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		global $wp_query;
		$item_output = $attributes = "";
		
		if($depth === 0) {	
			$this->mega_active = get_post_meta( $item->ID, '_dt-use-as-megamenu', true);
			$this->dt_menubg = get_post_meta( $item->ID, '_dt-menu-bg', true);
		}else {
			if(is_page_template('tpl-onepage.php')) {
				$attributes .= ' class="external" ';
			}
		}

		$this->dt_menuicon = get_post_meta( $item->ID, '_dt-menu-icon', true);
		
		$nolink = get_post_meta( $item->ID, '_dt-disable-link', true);
		$notext = get_post_meta( $item->ID, '_dt-disable-text', true);
		$custom_content = get_post_meta( $item->ID, '_dt-custom-content', true);
		
		$attributes .= ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$description  = ! empty( $item->description ) ? '<span class="menu-item-description">'.esc_attr( $item->description ).'</span>' : '';

		
		$item_output .= $args->before;
		
		if( empty($nolink) && empty($notext) ){
			$item_output .= '<a'. $attributes .'>';
			
			if( !empty( $this->dt_menuicon) ){
				$item_output .= "<i class='fa {$this->dt_menuicon}'></i>";
			}
			
			$item_output .= $args->link_before;
			$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
			$item_output .= $description;
			$item_output .= $args->link_after;
			$item_output .= '</a>';
		}elseif( empty($nolink) && !empty($notext) ){
		}elseif( !empty($nolink) && empty($notext) ){
			$item_output .= '<span class="nolink-menu">';
			
			if( !empty( $this->dt_menuicon) ){
				$item_output .= "<i class='fa {$this->dt_menuicon}'></i>";
			}
			
			$item_output .= $args->link_before;
			$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
			$item_output .= $description;
			$item_output .= $args->link_after;
			$item_output .= '</span>';
		}

		$item_output .= $args->after;
		
		$class_names = $value = '';
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names .= " menu-item-depth-{$depth}";
		
		if($depth === 0 ) {
			if( $this->mega_active ) {
				
				$class_names .= ( "true" == veda_option('layout','menu-boxshadow') ) ? ' with-box-shadow ' : '';
				$class_names .= ( "true" == veda_option('layout','menu-title-bg') ) ? ' menu-title-with-bg ' : '';			
				$class_names .= ( "true" == veda_option('layout','menu-links-bg') ) ? ' menu-links-with-bg ' : '';
				$class_names .= ( "true" == veda_option('layout','menu-links-border') ) ? ' menu-links-with-border ' : '';
				$class_names .= ( "true" ==  veda_option('layout','menu-link-arrow') ) ? ' menu-links-with-arrow  '.veda_option('layout','menu-link-arrow-style').' ':'';
				$class_names .= " menu-item-megamenu-parent ";
				
				//Columns
				$columns = get_post_meta( $item->ID, '_dt-columns', true);
				$class_names .= " megamenu-{$columns}-columns-group";
				
			} else {
				$class_names .= ( "true" == veda_option('layout','menu-boxshadow') ) ? ' with-box-shadow ' : '';				
				$class_names .= ( "true" == veda_option('layout','menu-links-bg') ) ? ' menu-links-with-bg ' : '';
				$class_names .= ( "true" == veda_option('layout','menu-links-border') ) ? ' menu-links-with-border ' : '';
				$class_names .= ( "true" ==  veda_option('layout','menu-link-arrow') ) ? ' menu-links-with-arrow  '.veda_option('layout','menu-link-arrow-style').' ':'';
				$class_names .= " menu-item-simple-parent ";
			}
			
		}
		
		if( $depth === 1 ){
			$fullwidth = get_post_meta( $item->ID, '_dt-fullwidth', true);
			if( $fullwidth ) {
				$class_names .= " menu-item-fullwidth ";
			}

			$sidebar = get_post_meta( $item->ID, '_dt-menu-widget', true);
			$fill = get_post_meta( $item->ID, '_dt-fill-columns', true);
			$extra_class = "";
			switch( $fill ){
				case '2': $extra_class = " fill-two-columns "; break;
				case '3': $extra_class = " fill-three-columns "; break;
				case '4': $extra_class = " fill-four-columns "; break;
			}
			$class_names .= !empty( $sidebar ) ? " menu-item-with-widget-area ".$extra_class : "";
		}
	
		$class_names = ' class="'.esc_attr( $class_names ).'"';
	
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		if( $depth === 1 ) {
			$sidebar = get_post_meta( $item->ID, '_dt-menu-widget', true);

			if( !empty($sidebar) ){
				$item_output .= '<div class="menu-item-widget-area-container">';
				if(function_exists('dynamic_sidebar')){
					$item_output .= '<ul>';
					ob_start();
					dynamic_sidebar($sidebar);
					$sb = ob_get_clean();
					$sb = str_replace('aside','li',$sb);
					#$sb = str_replace('<aside','<li><aside',$sb);
					#$sb = str_replace('</aside>','</aside></li>',$sb);					
					$item_output .= $sb;	
					$item_output .= '</ul>';
				}
				$item_output .= '</div>';
			}
		}
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	function end_el(&$output, $object, $depth = 0, $args = array()) {
		$output .= "</li>\n";
	}
}?>