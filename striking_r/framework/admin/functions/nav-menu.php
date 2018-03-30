<?php

class Theme_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
        
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $item_id = esc_attr( $item->ID );

        $custom = $this->icon_settings($item_id);
        $custom.= $this->mobile_show_settings($item_id);  
		ob_start();
		do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args ); 		
		$custom .= ob_get_clean();	

        $desc_snipp = '<div class="menu-item-actions description-wide submitbox">';
        parent::start_el($output, $item, $depth, $args);

        $pos = strrpos( $output, $desc_snipp );
        if( $pos !== false ) {
            $output = substr_replace($output, $custom . $desc_snipp, $pos, strlen( $desc_snipp ) );
        }

        $output = str_replace(array('Title Attribute<br />', 'Description<br />', 'The description will be displayed in the menu if the current theme supports it.'), array('Hover Text Field<br />', 'Description-SubTitle Field<br />','Use this field for the Striking MultiFlex Sub-Title text function.'), $output);
   }

    public function icon_settings($item_id){
        $icon_val = esc_attr( get_post_meta( $item_id, 'menu-item-icon', TRUE ) );
        $icon_color_val = esc_attr( get_post_meta( $item_id, 'menu-item-icon-color', TRUE ) );

        if($icon_val) {
            if($icon_color_val){
                $icon_color_style = ' style="color:'.$icon_color_val.'"';
            } else {
                $icon_color_style = '';
            }
            $icon = '<i class="icon-'.$icon_val.'"'.$icon_color_style.'></i>';
        }else {
            $icon = '';
        }
        if($icon){
            $options = '<span id="edit-menu-item-icon-'.$item_id .'-preview" style="margin-right: 0.3em">'.$icon.'</span> '.
            '<a class="theme-nav-icon-chosen" href="#" data-target="'.$item_id.'">Change Icon</a> '.
            '<a class="theme-nav-icon-remove" href="#" data-target="'.$item_id.'">Remove Icon</a>';
        } else{
            $options = '<span id="edit-menu-item-icon-'.$item_id .'-preview" style="margin-right: 0.3em"></span> '.
            '<a class="theme-nav-icon-chosen" href="#" data-target="'.$item_id.'">Insert Icon</a> '.
            '<a class="theme-nav-icon-remove" style="display:none" href="#" data-target="'.$item_id.'">Remove Icon</a>';
        } 
        $output = '<p class="description description-thin">'.
            '<label for="edit-menu-item-icon-'.$item_id .'">'.
                __( 'Icon (optional)','theme_admin').'<br />'.
                $options.
                '<input type="hidden" id="edit-menu-item-icon-'.$item_id .'" class="widefat edit-menu-item-icon" name="menu-item-icon['.$item_id.']" value="'.esc_attr( $icon_val ).'" />'.
                '<input type="hidden" id="edit-menu-item-icon-color-'.$item_id .'" class="widefat edit-menu-item-icon-color" name="menu-item-icon-color['.$item_id.']" value="'.esc_attr( $icon_color_val ).'" />'.
            '</label>'.
        '</p>';

        return $output;
    }

    public function mobile_show_settings($item_id){
        $not_show_in_moble = esc_attr( get_post_meta( $item_id, 'not-show-in-mobile', TRUE ) );
            
        $output = '<p class="field-not-show-in-mobile description-wide">'.
            '<label for="edit-menu-item-not-show-in-mobile-'.$item_id.'">'.
                '<input type="checkbox" id="edit-menu-item-not-show-in-mobile-'.$item_id.'" value="true" name="menu-item-not-show-in-mobile['.$item_id.']"'.checked( $not_show_in_moble, 'true' , false).' />'.
                __( 'Do not show this menu item in the mobile menu' , 'theme_admin').
            '</label>'.
        '</p>';
        return $output;
    }

}