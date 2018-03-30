<?php

    /*
    *
    *	SF MEGA MENU FRAMEWORK
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    */

    class sf_mega_menu {

        /*--------------------------------------------*
         * Constructor
         *--------------------------------------------*/

        /**
         * Initializes the plugin by setting localization, filters, and administration functions.
         */
        function __construct() {
			
			// add new fields via hook
			add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'sf_mega_menu_add_custom_fields' ), 10, 5 );
			
            // add custom menu fields to menu
            add_filter( 'wp_setup_nav_menu_item', array( $this, 'sf_mega_menu_add_custom_nav_fields' ) );

            // save menu custom fields
            add_action( 'wp_update_nav_menu_item', array( $this, 'sf_mega_menu_update_custom_nav_fields' ), 10, 3 );

            // edit menu walker
            add_filter( 'wp_edit_nav_menu_walker', array( $this, 'sf_mega_menu_edit_walker' ), 10, 2 );

        } // end constructor
        
        /**
         * Add custom fields to edit menu page
         *
         * @access      public
         * @since       1.0
         * @return      void
         */
        function sf_mega_menu_add_custom_fields( $item_id, $item, $depth, $args ) {
        	
        	$built_in_mega = true;
        	
        	if ( sf_theme_supports( 'max-mega-menu' ) ) {
        		$built_in_mega = false;
        	}
        	
        	$button_colours = array(
    	        'accent' => __('Accent', 'swiftframework'),
    	        'black' => __('Black', 'swiftframework'),
    	        'white' => __('White', 'swiftframework'),
    	        'blue'  => __('Blue', 'swiftframework'),
    	        'grey'  => __('Grey', 'swiftframework'),
    	        'lightgrey' => __('Light Grey', 'swiftframework'),
    	        'orange'    => __('Orange', 'swiftframework'),
    	        'green' => __('Green', 'swiftframework'),
    	        'pink'  => __('Pink', 'swiftframework'),
    	        'gold'  => __('Gold', 'swiftframework'),
    	        'purple'  => __('Purple', 'swiftframework'),
    	        'midnight'  => __('Midnight', 'swiftframework'),
    	        'transparent-light' => __('Transparent - Light', 'swiftframework'),
    	        'transparent-dark'  => __('Transparent - Dark', 'swiftframework'),
    	    );
    	    
        	$button_types = array(
        		"standard" => __("Standard", "swiftframework"),
        		"bordered"	 => __("Bordered", "swiftframework"),
        		"rounded"  => __("Rounded", "swiftframework"),
        		"rounded-bordered"  => __("Rounded Bordered", "swiftframework"),
        	);
        	
        	$button_colours = apply_filters( 'sf_menu_button_colours', $button_colours );
        	$button_types = apply_filters( 'sf_menu_button_types', $button_types );
        	
        ?>
        	<div class="sf-menu-options">

                <?php if ( $depth == 0 ) { ?>
					
                    <h4>Mega Menu Options</h4>
					
					<?php if ( $built_in_mega ) { ?>
					
                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-megamenu-<?php echo esc_attr($item_id); ?>"><?php _e( 'Enable Mega Menu', 'swiftframework' ); ?>
                            <input type="checkbox" id="edit-menu-megamenu-<?php echo esc_attr($item_id); ?>"
                                   class="edit-menu-item-custom" id="menu-megamenu[<?php echo esc_attr($item_id); ?>]"
                                   name="menu-megamenu[<?php echo esc_attr($item_id); ?>]"
                                   value="1" <?php echo checked( ! empty( $item->megamenu ), 1, false ); ?> />
                        </label>
                    </p>
                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-megamenucols-<?php echo esc_attr($item_id); ?>"><?php _e( 'Mega Menu Columns', 'swiftframework' ); ?></label>
                        <select class="fat" id="edit-menu-megamenucols-<?php echo esc_attr($item_id); ?>"
                                name="menu-megamenucols[<?php echo esc_attr($item_id); ?>]">
                            <?php for ( $i = 1; $i <= 6; $i ++ ) {
                                if ( $i == $item->megamenucols ) {
                                    echo '<option selected="selected">' . $i . '</option>';
                                } else {
                                    echo '<option>' . $i . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </p>
                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-is-naturalwidth-<?php echo esc_attr($item_id); ?>"><?php _e( 'Natural Width Mega Menu', 'swiftframework' ); ?>
                            <input type="checkbox" id="edit-menu-is-naturalwidth-<?php echo esc_attr($item_id); ?>"
                                   class="edit-menu-item-custom" id="menu-is-naturalwidth[<?php echo esc_attr($item_id); ?>]"
                                   name="menu-is-naturalwidth[<?php echo esc_attr($item_id); ?>]"
                                   value="1" <?php echo checked( ! empty( $item->isnaturalwidth ), 1, false ); ?> />
                        </label>
                    </p>
                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-is-altstyle-<?php echo esc_attr($item_id); ?>"><?php _e( 'Alternative Style Mega Menu', 'swiftframework' ); ?>
                            <input type="checkbox" id="edit-menu-is-altstyle-<?php echo esc_attr($item_id); ?>"
                                   class="edit-menu-item-custom" id="menu-is-altstyle[<?php echo esc_attr($item_id); ?>]"
                                   name="menu-is-altstyle[<?php echo esc_attr($item_id); ?>]"
                                   value="1" <?php echo checked( ! empty( $item->altstyle ), 1, false ); ?> />
                        </label>
                    </p>
                    
                    <?php } ?>
                    
                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-hideheadings-<?php echo esc_attr($item_id); ?>"><?php _e( 'Hide Mega Menu Headings', 'swiftframework' ); ?>
                            <input type="checkbox" id="edit-menu-hideheadings-<?php echo esc_attr($item_id); ?>"
                                   class="edit-menu-item-custom" id="menu-hideheadings[<?php echo esc_attr($item_id); ?>]"
                                   name="menu-hideheadings[<?php echo esc_attr($item_id); ?>]"
                                   value="1" <?php echo checked( ! empty( $item->hideheadings ), 1, false ); ?> />
                        </label>
                    </p>

                    <p class="field-custom description description-wide" style="height: 10px;"></p>

                <?php } ?>

                <h4>Custom Menu Options</h4>

                <p class="field-custom description description-wide">
                    <label
                        for="edit-menu-loggedinvis-<?php echo esc_attr($item_id); ?>"><?php _e( 'Visible only when logged in', 'swiftframework' ); ?>
                        <input type="checkbox" id="edit-menu-loggedinvis-<?php echo esc_attr($item_id); ?>"
                               class="edit-menu-item-custom" id="menu-loggedinvis[<?php echo esc_attr($item_id); ?>]"
                               name="menu-loggedinvis[<?php echo esc_attr($item_id); ?>]"
                               value="1" <?php echo checked( ! empty( $item->loggedinvis ), 1, false ); ?> />
                    </label>
                </p>

                <p class="field-custom description description-wide">
                    <label
                        for="edit-menu-loggedoutvis-<?php echo esc_attr($item_id); ?>"><?php _e( 'Visible only when logged out', 'swiftframework' ); ?>
                        <input type="checkbox" id="edit-menu-loggedoutvis-<?php echo esc_attr($item_id); ?>"
                               class="edit-menu-item-custom" id="menu-loggedoutvis[<?php echo esc_attr($item_id); ?>]"
                               name="menu-loggedoutvis[<?php echo esc_attr($item_id); ?>]"
                               value="1" <?php echo checked( ! empty( $item->loggedoutvis ), 1, false ); ?> />
                    </label>
                </p>

                <?php if ( $depth == 0 ) { ?>
                	
                	<?php if ( sf_theme_supports('menu-new-badge') ) { ?>
                	
                	<p class="field-custom description description-wide">
                	    <label
                	        for="edit-menu-newbadge-<?php echo esc_attr($item_id); ?>"><?php _e( 'New Badge', 'swiftframework' ); ?>
                	        <input type="checkbox" id="edit-menu-newbadge-<?php echo esc_attr($item_id); ?>"
                	               class="edit-menu-item-custom" id="menu-newbadge[<?php echo esc_attr($item_id); ?>]"
                	               name="menu-newbadge[<?php echo esc_attr($item_id); ?>]"
                	               value="1" <?php echo checked( ! empty( $item->newbadge ), 1, false ); ?> />
                	    </label>
                	</p>
                	
                	<?php } ?>

                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-menuitembtn-<?php echo esc_attr($item_id); ?>"><?php _e( 'Button Style Menu Item', 'swiftframework' ); ?>
                            <input type="checkbox" id="edit-menu-menuitembtn-<?php echo esc_attr($item_id); ?>"
                                   class="edit-menu-item-custom" id="menu-menuitembtn[<?php echo esc_attr($item_id); ?>]"
                                   name="menu-menuitembtn[<?php echo esc_attr($item_id); ?>]"
                                   value="1" <?php echo checked( ! empty( $item->menuitembtn ), 1, false ); ?> />
                        </label>
                    </p>
					
					<?php if ( sf_theme_supports('menu-button-advanced') ) { ?>
					
					<p class="field-custom description description-wide">
					    <label
					        for="edit-menu-buttontype-<?php echo esc_attr($item_id); ?>"><?php _e( 'Button Type', 'swiftframework' ); ?></label>
					    <select class="fat" id="edit-menu-buttontype-<?php echo esc_attr($item_id); ?>"
					            name="menu-buttontype[<?php echo esc_attr($item_id); ?>]">
					        <?php foreach ( $button_types as $button_type => $button_type_name ) {
					            if ( $button_type == $item->buttontype ) {
					                echo '<option selected="selected" value="'.$button_type.'">'.$button_type_name.'</option>';
					            } else {
					                echo '<option value="'.$button_type.'">'.$button_type_name.'</option>';
					            }
					        }
					        ?>
					    </select>
					</p>
						
					<p class="field-custom description description-wide">
					    <label
					        for="edit-menu-buttoncolour-<?php echo esc_attr($item_id); ?>"><?php _e( 'Button Colour', 'swiftframework' ); ?></label>
					    <select class="fat" id="edit-menu-buttoncolour-<?php echo esc_attr($item_id); ?>"
					            name="menu-buttoncolour[<?php echo esc_attr($item_id); ?>]">
					        <?php foreach ( $button_colours as $button_colour => $button_colour_name ) {
					            if ( $button_colour == $item->buttoncolour ) {
					                echo '<option selected="selected" value="'.$button_colour.'">'.$button_colour_name.'</option>';
					            } else {
					                echo '<option value="'.$button_colour.'">'.$button_colour_name.'</option>';
					            }
					        }
					        ?>
					    </select>
					</p>
					
					<?php } ?>
					
                <?php } ?>
                
                <?php if ( $built_in_mega ) { ?>
              	
                <p class="field-custom description description-thin"
                   style="height: auto;overflow: hidden;width: 50%;float: none;">
                    <label
                        for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>"><?php _e( 'Menu Icon (Icon Mind / Font Awesome)', 'swiftframework' ); ?>
                        <input type="text" id="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>"
                               class="widefat edit-menu-item-custom" name="menu-item-icon[<?php echo esc_attr($item_id); ?>]"
                               placeholder="ss-star" value="<?php echo esc_attr( $item->menuicon ); ?>"/>
                    </label>
                </p>
                
                <?php } ?>

                <?php if ( $depth == 1 && $built_in_mega ) { ?>

                    <h4>Mega Menu Column Options</h4>

                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-megatitle-<?php echo esc_attr($item_id); ?>"><?php _e( 'Mega Menu No Link Title', 'swiftframework' ); ?>
                            <input type="checkbox" id="edit-menu-megatitle-<?php echo esc_attr($item_id); ?>"
                                   class="edit-menu-item-custom" id="menu-megatitle[<?php echo esc_attr($item_id); ?>]"
                                   name="menu-megatitle[<?php echo esc_attr($item_id); ?>]"
                                   value="1" <?php echo checked( ! empty( $item->megatitle ), 1, false ); ?> />
                        </label>
                    </p>

                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-nocolumnspacing-<?php echo esc_attr($item_id); ?>"><?php _e( 'No Menu Column Spacing (for custom html column)', 'swiftframework' ); ?>
                            <input type="checkbox" id="edit-menu-nocolumnspacing-<?php echo esc_attr($item_id); ?>"
                                   class="edit-menu-item-custom" id="menu-nocolumnspacing[<?php echo esc_attr($item_id); ?>]"
                                   name="menu-nocolumnspacing[<?php echo esc_attr($item_id); ?>]"
                                   value="1" <?php echo checked( ! empty( $item->nocolumnspacing ), 1, false ); ?> />
                        </label>
                    </p>
                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>"><?php _e( 'Custom HTML Column Width (optional)', 'swiftframework' ); ?>
                            <input type="text" id="edit-menu-item-width-<?php echo esc_attr($item_id); ?>"
                                   class="widefat edit-menu-item-custom" name="menu-item-width[<?php echo esc_attr($item_id); ?>]"
                                   value="<?php echo esc_attr( $item->menuwidth ); ?>"/>
                        </label>
                    <p><?php _e( 'Optionally set a width here for the menu column, ideal if you want to make it wider. Numeric value (no px).', 'swiftframework' ); ?></p>
                    </p>

                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-item-htmlcontent-<?php echo esc_attr($item_id); ?>"><?php _e( 'Custom HTML Column (within Mega Menu)', 'swiftframework' ); ?>
                            <textarea id="edit-menu-item-htmlcontent-<?php echo esc_attr($item_id); ?>"
                                      name="menu-item-htmlcontent[<?php echo esc_attr($item_id); ?>]" cols="30"
                                      rows="4"><?php echo esc_attr( $item->htmlcontent ); ?></textarea>
                        </label>
                    </p>

                <?php } ?>
            </div>
        	<?php
        }

        /**
         * Add custom fields to $item nav object
         * in order to be used in custom Walker
         *
         * @access      public
         * @since       1.0
         * @return      void
         */
        function sf_mega_menu_add_custom_nav_fields( $menu_item ) {

            $menu_item->subtitle        = get_post_meta( $menu_item->ID, '_menu_item_subtitle', true );
            $menu_item->htmlcontent     = get_post_meta( $menu_item->ID, '_menu_item_htmlcontent', true );
            $menu_item->nocolumnspacing = get_post_meta( $menu_item->ID, '_menu_nocolumnspacing', true );
            $menu_item->megamenu        = get_post_meta( $menu_item->ID, '_menu_megamenu', true );
            $menu_item->megamenucols    = get_post_meta( $menu_item->ID, '_menu_megamenucols', true );
            $menu_item->isnaturalwidth  = get_post_meta( $menu_item->ID, '_menu_is_naturalwidth', true );
            $menu_item->altstyle        = get_post_meta( $menu_item->ID, '_menu_is_altstyle', true );
            $menu_item->hideheadings    = get_post_meta( $menu_item->ID, '_menu_hideheadings', true );
            $menu_item->loggedinvis     = get_post_meta( $menu_item->ID, '_menu_loggedinvis', true );
            $menu_item->loggedoutvis    = get_post_meta( $menu_item->ID, '_menu_loggedoutvis', true );
            $menu_item->newbadge   		= get_post_meta( $menu_item->ID, '_menu_newbadge', true );
            $menu_item->menuitembtn     = get_post_meta( $menu_item->ID, '_menu_menuitembtn', true );
            $menu_item->buttontype      = get_post_meta( $menu_item->ID, '_menu_buttontype', true );
            $menu_item->buttoncolour    = get_post_meta( $menu_item->ID, '_menu_buttoncolour', true );
            $menu_item->megatitle       = get_post_meta( $menu_item->ID, '_menu_megatitle', true );
            $menu_item->menuicon        = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
            $menu_item->menuwidth       = get_post_meta( $menu_item->ID, '_menu_item_width', true );

            return $menu_item;

        }

        /**
         * Save menu custom fields
         *
         * @access      public
         * @since       1.0
         * @return      void
         */
        function sf_mega_menu_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

            // Check if element is properly sent
            if ( isset( $_REQUEST['menu-item-subtitle'] ) ) {
                $subtitle_value = $_REQUEST['menu-item-subtitle'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_subtitle', $subtitle_value );
            }

            if ( isset( $_REQUEST['menu-item-icon'] ) ) {
                $menu_icon_value = $_REQUEST['menu-item-icon'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_icon', $menu_icon_value );
            }

            if ( isset( $_REQUEST['menu-item-htmlcontent'][ $menu_item_db_id ] ) ) {
                $menu_htmlcontent_value = $_REQUEST['menu-item-htmlcontent'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_htmlcontent', $menu_htmlcontent_value );
            }

            if ( isset( $_REQUEST['menu-megamenu'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_megamenu', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_megamenu', 0 );
            }

            if ( isset( $_REQUEST['menu-megamenucols'][ $menu_item_db_id ] ) ) {
                $megamenucols_value = $_REQUEST['menu-megamenucols'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_megamenucols', $megamenucols_value );
            }

            if ( isset( $_REQUEST['menu-is-naturalwidth'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_is_naturalwidth', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_is_naturalwidth', 0 );
            }

            if ( isset( $_REQUEST['menu-menuitembtn'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_menuitembtn', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_menuitembtn', 0 );
            }

			if ( isset( $_REQUEST['menu-buttontype'][ $menu_item_db_id ] ) ) {
			    $buttontype_value = $_REQUEST['menu-buttontype'][ $menu_item_db_id ];
			    update_post_meta( $menu_item_db_id, '_menu_buttontype', $buttontype_value );
			}
			
			if ( isset( $_REQUEST['menu-buttoncolour'][ $menu_item_db_id ] ) ) {
			    $buttoncolour_value = $_REQUEST['menu-buttoncolour'][ $menu_item_db_id ];
			    update_post_meta( $menu_item_db_id, '_menu_buttoncolour', $buttoncolour_value );
			}

            if ( isset( $_REQUEST['menu-loggedinvis'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_loggedinvis', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_loggedinvis', 0 );
            }

            if ( isset( $_REQUEST['menu-loggedoutvis'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_loggedoutvis', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_loggedoutvis', 0 );
            }

            if ( isset( $_REQUEST['menu-newbadge'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_newbadge', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_newbadge', 0 );
            }

            if ( isset( $_REQUEST['menu-is-altstyle'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_is_altstyle', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_is_altstyle', 0 );
            }

            if ( isset( $_REQUEST['menu-hideheadings'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_hideheadings', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_hideheadings', 0 );
            }

            if ( isset( $_REQUEST['menu-megatitle'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_megatitle', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_megatitle', 0 );
            }

            if ( isset( $_REQUEST['menu-nocolumnspacing'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_nocolumnspacing', 1 );
            } else {
                update_post_meta( $menu_item_db_id, '_menu_nocolumnspacing', 0 );
            }

            if ( isset( $_REQUEST['menu-item-width'][ $menu_item_db_id ] ) ) {
                $menu_width_value = $_REQUEST['menu-item-width'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_width', $menu_width_value );
            }

        }

        /**
         * Define new Walker edit
         *
         * @access      public
         * @since       1.0
         * @return      void
         */
        function sf_mega_menu_edit_walker( $walker, $menu_id ) {

            return 'Walker_Nav_Menu_Edit_Custom';

        }

    }

    // instantiate plugin's class
    $GLOBALS['sf_mega_menu'] = new sf_mega_menu();


    include_once( 'edit_custom_walker.php' );
    include_once( 'mega_menu_custom_walker.php' );
    include_once( 'alt_menu_custom_walker.php' );

?>