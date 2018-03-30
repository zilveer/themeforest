<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

/* check for menu support */
if( !apply_filters( 'ut_megamenu', true ) ) {
    return false;
}

/**
 * Widget JavaScript Translation Strings
 *
 * @since     1.0.0
 * @version   1.0.0
 */
if ( ! function_exists( '_ut_megamenu_widgets_js_translation' ) ) :
    
    function _ut_megamenu_widgets_js_translation( $strings ) {
        
        $strings['widget_message'] = esc_html__( 'Navigation Sidebar does not support this widget!', 'unite' );
        
        return $strings;
        
    }

    add_filter( 'ut_recognized_js_translation_strings', '_ut_megamenu_widgets_js_translation' );

endif;

/**
 * Megamenu JavaScript Translation Strings
 *
 * @since     1.0.0
 * @version   1.0.0
 */
if ( ! function_exists( '_ut_megamenu_js_translation' ) ) :
    
    function _ut_megamenu_js_translation( $strings ) {

        $strings['megamenu_level_message']          = sprintf( esc_html__( '%1$s needs to be root level item!', 'unite' ), '<span class="ut-is-megamenu">' . esc_html__( 'Megamenu', 'unite' ) . '</span>');
        $strings['megamenu_column_level_message']   = sprintf( esc_html__( '%1$s needs to be level 1 item!', 'unite' ), '<span class="ut-is-megamenu-column">' . esc_html__( 'Column', 'unite' ) . '</span>');
        $strings['megamenu_column_parent_message']  = sprintf( esc_html__( '%1$s needs to child of %2$s', 'unite' ), '<span class="ut-is-megamenu-column">' . esc_html__( 'Column', 'unite' ) . '</span>', '<span class="ut-is-megamenu">' . esc_html__( 'Megamenu', 'unite' ) . '</span>');
        $strings['megamenu_column_added_message']   = sprintf( esc_html__( 'Do not forget to make %1$s a child of %2$s', 'unite' ), '<span class="ut-is-megamenu-column">' . esc_html__( 'Column', 'unite' ) . '</span>', '<span class="ut-is-megamenu">' . esc_html__( 'Megamenu', 'unite' ) . '</span>');
        $strings['megamenu_widget_level_message']   = sprintf( esc_html__( '%1$s needs to child of %2$s', 'unite' ), '<span class="ut-is-megamenu-widget">' . esc_html__( 'Widget', 'unite' ) . '</span>', '<span class="ut-is-megamenu-column">' . esc_html__( 'Column', 'unite' ) . '</span>');
        $strings['megamenu_widget_amount_message']  = sprintf( esc_html__( 'Please use only %1$s %2$s inside a %3$s Using more widgets may result in layout issues.', 'unite' ), '<strong>' . esc_html__( 'one', 'unite' ) . '</strong>', '<span class="ut-is-megamenu-widget">' . esc_html__( 'Widget', 'unite' ) . '</span>', '<span class="ut-is-megamenu-column">' . esc_html__( 'Column', 'unite' ) . '</span>');

        return $strings;
                
    }

    add_filter( 'ut_recognized_js_translation_strings', '_ut_megamenu_js_translation' );

endif;


/**
 * Mega Menu Admin Scripts
 *
 * @since     1.0.0
 * @version   1.0.0
 */
if ( ! function_exists( '_ut_megamenu_scripts' ) ) :
    
    function _ut_megamenu_scripts() {
        
        $min = NULL;
            
        if( !WP_DEBUG ){
            $min = '.min';
        }
         
        wp_enqueue_media();
         
        /* register widget script */
         wp_register_script(
            'unite-megamenu-admin', 
            THEME_WEB_ROOT . '/unite-custom/admin/assets/js/unite-megamenu' . $min . '.js', 
            array('jquery', 'jquery-ui-tabs', 'jquery-ui-accordion'), 
            UT_VERSION
        );
         
        /* enqueue widget script */
        wp_enqueue_script( 'unite-megamenu-admin' );
        
        
        wp_enqueue_style(
            'unite-megamenu-admin', 
            THEME_WEB_ROOT . '/unite-custom/admin/assets/css/unite-megamenu' . $min . '.css', 
            false, 
            UT_VERSION
        );        
             
    }
    
    add_action('admin_print_scripts-nav-menus.php', '_ut_megamenu_scripts');

endif;


/**
 * Mega Menu Admin Widgets Scripts
 *
 * @since     1.0.0
 * @version   1.0.0
 */
if ( ! function_exists( '_ut_megamenu_widget_scripts' ) ) :
    
    function _ut_megamenu_widget_scripts() {
        
        $min = NULL;
            
        if( !WP_DEBUG ){
            $min = '.min';
        }
        
        /* register widget script */
         wp_register_script(
            'unite-megamenu-widgets-admin', 
            THEME_WEB_ROOT . '/unite-custom/admin/assets/js/unite-megamenu-widgets' . $min . '.js', 
            array('jquery'), 
            UT_VERSION
        );    
        
        /* enqueue widget script */
        wp_enqueue_script( 'unite-megamenu-widgets-admin' );
        
        /* add localization for widget */
        wp_localize_script( 'unite-megamenu-widgets-admin', 'unite_menu_widgets' , array( 
            'widgets' => apply_filters( 'ut_recognized_menu_widgets', array(
                'ut-video-widget',
                'ut-social-profiles',
                'ut-facebook-widget',
                'text'                
             ) ),
        ) );                
    
    }
    
    add_action('admin_print_scripts-widgets.php', '_ut_megamenu_widget_scripts');

endif;



if ( !class_exists( 'UT_Menu_Extensions' ) ) {

    class UT_Menu_Extensions {
        
        public $version = "1.0";
        
        /**
         * Widget Key
         * @var string
         */
        private $mm_widget_key = 'navigation-widget-area';
        
        
        /**
         * Megamenu Key
         * @var string
         */
        private $mm_parent_key = 'megamenu-parent';
        
        
        /**
         * Megamenu Column Key
         * @var string
         */
        private $mm_column_key = 'megamenu-column';
               
              
        /**
         * Constructor
         * @since     1.0.0
         * @version   1.0.0
         */
        public function __construct() {
            
            /* run hooks */
            $this->hooks();
                
        }
        
        /**
         * Initiate our hooks
         * @since     1.0.0
         * @version   1.0.0
         */
        public function hooks() {
            
            /* add meta box to menu */
            add_action( 'admin_init', array( $this, 'menu_setup' ) );
            
            /* filter the menu item */
            add_filter( 'wp_setup_nav_menu_item', array( $this, 'label' ), 10, 1 );
                    
        }
        
        /**
         * Add Metabox to Menu Management
         * @since     1.0.0
         * @version   1.0.0
         */
        public function menu_setup() {
            
             add_meta_box( 
                'add-megamenu-section', 
                esc_html__( 'Megamenu Settings', 'unite' ), 
                array( $this, 'megamenu_meta_box' ), 
                'nav-menus', 
                'side', 
                'low'
            );
            
        }               
        
        
        /**
         * Widget Metabox for Menu Management
         * @since     1.0.0
         * @version   1.0.0
         */        
        public function megamenu_meta_box() {
            
            global $_nav_menu_placeholder, $nav_menu_selected_id, $wp_registered_widgets, $wp_registered_sidebars;
                        
            /* start output for megamenu parent  */
            echo '<div id="ut-mm-parent-for-menu" class="ut-mega-menu-setting">';
                
                echo '<h4>' , esc_html( 'Mega Menu', 'unite' ) , '</h4>';
                                        
                    echo '<div class="ut-megamenu-panel-setting">';
                        
                        echo '<p>';
                        
                            echo '<label for="mm-menu-parent-title' , $_nav_menu_placeholder , '">';
                                
                                echo '<span>', esc_html__( 'Title' ) , '</span>';
                                echo '<input autocomplete="off" placeholder="' , esc_attr__( 'Enter Mega Menu Title', 'unite' ), '" id="mm-menu-parent-title' , $_nav_menu_placeholder , '" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-title]" type="text" class="regular-text menu-item-textbox input-with-default-title" title="' , esc_attr__( 'Mega Menu Title', 'unite' ), '" />';
                                                                
                                /* field settings */
                                echo '<input type="hidden" class="menu-item-object" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-object]" value="' , $this->mm_parent_key , '" />';
                                echo '<input type="hidden" class="menu-item-object-id" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-object-id]" value="' , $_nav_menu_placeholder , '" />';
                                echo '<input type="hidden" class="menu-item-parent-id" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-parent-id]" value="0" />';
                                echo '<input type="hidden" class="menu-item-type" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-type]" value="" />';
                                
                                /* additional fields */
                                echo '<input type="hidden" class="menu-item-url" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-url]" value="#" />';
                                echo '<input type="hidden" class="menu-item-target" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-target]" value="" />';
                                echo '<input type="hidden" class="menu-item-attr_title" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-attr_title]" value="" />';
                                echo '<input type="hidden" class="menu-item-classes" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-classes]" value="" />';
                                echo '<input type="hidden" class="menu-item-xfn" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-xfn]" value="" />';
                                                            
                            echo '</label>';
                        
                        echo '</p>';
                        
                    echo '</div>';
                    
                    echo '<p class="button-controls">';
                        echo '<button data-menu-id="' , $_nav_menu_placeholder , '" type="button" name="add-mm-menu-item" id="add-mm-to-menu" class="ut-backend-button ut-megamenu-button ut-button-full">' , esc_attr_e('Add Mega Menu') , '</button>';
                    echo '</p>';                
            
            echo '</div>';
            
            /* start output for megamenu column  */
            echo '<div id="ut-mm-column-for-menu" class="ut-mega-menu-setting">';
                
                echo '<h4>' , esc_html( 'Mega Menu Column', 'unite' ) , '</h4>';
                
                echo '<div class="ut-megamenu-panel-setting">';
                    
                    echo '<p>';
                    
                        echo '<label for="mm-menu-column-title' , $_nav_menu_placeholder , '">';
                                
                            echo '<span>', esc_html__( 'Title' ) , '</span>';
                            echo '<input autocomplete="off" placeholder="' , esc_attr__( 'Enter Column Title', 'unite' ), '" id="mm-menu-column-title' , $_nav_menu_placeholder , '" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-title]" type="text" class="regular-text menu-item-textbox input-with-default-title" title="' , esc_attr__( 'Column Title', 'unite' ), '" />';
                            
                            /* field settings */
                            echo '<input type="hidden" class="menu-item-object" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-object]" value="' , $this->mm_column_key , '" />';
                            echo '<input type="hidden" class="menu-item-object-id" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-object-id]" value="' , $_nav_menu_placeholder , '" />';
                            echo '<input type="hidden" class="menu-item-parent-id" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-parent-id]" value="0" />';
                            echo '<input type="hidden" class="menu-item-type" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-type]" value="" />';
                            
                            /* additional fields */
                            echo '<input type="hidden" class="menu-item-url" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-url]" value="#" />';
                            echo '<input type="hidden" class="menu-item-target" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-target]" value="" />';
                            echo '<input type="hidden" class="menu-item-attr_title" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-attr_title]" value="" />';
                            echo '<input type="hidden" class="menu-item-classes" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-classes]" value="" />';
                            echo '<input type="hidden" class="menu-item-xfn" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-xfn]" value="" />';
                                                        
                        echo '</label>';
                    
                    echo '</p>';
                
                echo '</div>';
                
                echo '<p class="button-controls">';
                    echo '<button data-menu-id="' , $_nav_menu_placeholder , '" type="button" name="add-mm-menu-item" id="add-mm-column-to-menu" class="ut-backend-button ut-megamenu-column-button ut-button-full">' , esc_attr_e('Add Column') , '</button>';
                echo '</p>';                     
            
            echo '</div>';
            
            /* start output for widgets  */
            echo '<div id="ut-widget-for-menu" class="ut-mega-menu-setting">';
                
                echo '<h4>' , esc_html( 'Mega Menu Widgets', 'unite' ) , '</h4>';
                    
                /* get all the sidebar widgets */
                $sidebar_widgets = wp_get_sidebars_widgets();
                
                echo '<div class="ut-megamenu-panel-setting">';
                
                /* check if widgets are available */
                if ( empty( $wp_registered_sidebars[$this->mm_widget_key] ) || empty( $sidebar_widgets[$this->mm_widget_key] ) || !is_array( $sidebar_widgets[$this->mm_widget_key]) ) {

                    echo esc_html__( 'No Widgets found for sidebar "Navigation Widgets"', 'unite' ) . ' <br /><a href="' . admin_url( 'widgets.php' ) . '">' . esc_html__( 'Please add a widget first.', 'unite' ) . '</a>';

                } else {

                    echo '<ul>';

                    foreach ( (array) $sidebar_widgets[$this->mm_widget_key] as $sidebar_id ) {

                        /* skip if not set */
                        if ( !isset( $wp_registered_widgets[$sidebar_id] ) ) {
                            continue;
                        }

                        $_nav_menu_placeholder = 0 > $_nav_menu_placeholder ? $_nav_menu_placeholder - 1 : -1;

                        /* widget data */
                        $widget         = $wp_registered_widgets[$sidebar_id];
                        $widget_number  = $widget['params'][0]['number'];
                        $widget_slug    = rtrim( preg_replace( '|[0-9]+|i', '', $sidebar_id ), '-' );
                        $widget_config  = get_option( 'widget_' . $widget_slug, array() );
                        $widget_title   = !empty( $widget_config[$widget_number]['title'] ) ? $widget_config[$widget_number]['title'] : '';
                        $widget_name    = !empty( $widget['name'] ) ? $widget['name'] : '';
                        
                        $title = !empty( $widget_title ) ? $widget_title : $widget_name;
                        
                        /* create list element */
                        echo '<li>';

                            echo '<label for="' . $sidebar_id . '">';

                                echo '<input name="menu-item['. $_nav_menu_placeholder . '][menu-item-object-id]" type="checkbox" value="' . $widget_number . '" id="' . $sidebar_id . '" class="menu-item-checkbox ' . $sidebar_id . '">';
                                echo $title;
                                
                                /* field settings */
                                echo '<input type="hidden" class="menu-item-object" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-object]" value="' , $this->mm_widget_key , '" />';
                                echo '<input type="hidden" class="menu-item-parent-id" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-parent-id]" value="0" />';
                                echo '<input type="hidden" class="menu-item-type" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-type]" value="" />';
                                echo '<input type="hidden" class="menu-item-title" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-title]" value="' , $title , '" />';                                
                                
                                /* additional fields */
                                echo '<input type="hidden" class="menu-item-url" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-url]" value="" />';
                                echo '<input type="hidden" class="menu-item-target" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-target]" value="" />';
                                echo '<input type="hidden" class="menu-item-attr_title" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-attr_title]" value="" />';
                                echo '<input type="hidden" class="menu-item-classes" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-classes]" value="" />';
                                echo '<input type="hidden" class="menu-item-xfn" name="menu-item[' , $_nav_menu_placeholder , '][menu-item-xfn]" value="' , $sidebar_id , '" />';
                                
                            echo '</label>';

                        echo '</li>';                    

                    }                

                    echo '</ul>';
                                        
                }
                
                echo '</div>';
                
                echo '<p class="button-controls">';
                    echo '<button type="button" name="add-mm-menu-item" id="add-widget-to-menu" class="ut-backend-button ut-megamenu-widget-button ut-button-full">' , esc_attr_e('Add Widget') , '</button>';
                echo '</p>';
                
            echo '</div>';
            
            
        }      
        
        
        /**
         * Create Label for Menu Edit Page
         * @since     1.0.0
         * @version   1.0.0
         */         
        public function label( $item ) {
            
            if ( is_object( $item ) && isset( $item->object ) ) {
            
                switch( $item->object ) {
                    
                    case $this->mm_widget_key;
                    $item->type_label = esc_html__( 'Widget', 'unite' );
                    break;
                    
                    case $this->mm_parent_key;
                    $item->type_label = esc_html__( 'Megamenu', 'unite' );
                    break;
                    
                    case $this->mm_column_key;
                    $item->type_label = esc_html__( 'Column', 'unite' );
                    break;
                    
                }
            
            }
            
            if( isset( $item->classes ) && is_array( $item->classes ) && in_array( 'ut-mm-highlight-link', $item->classes ) ) {
                
                $item->type_label = esc_html__( 'Highlight Link', 'unite' );
            
            }
            
            return $item;
            
        }        
        
        
    }
    
    new UT_Menu_Extensions();    
    
}


/**
 * Recognized Custom Nav Fields
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_custom_nav_fields' ) ) {

    function _ut_recognized_custom_nav_fields() {
        
        return apply_filters( '_ut_recognized_custom_nav_fields', array(
            'megamenu',     
            'megamenu_skin',
            'megamenu_bottom_link',
            'megamenu_bottom_link_title',    
            'megamenu_column_bottom_link',
            'megamenu_column_bottom_link_title',
            'megamenu_hide_column_title',
        ) );
        
    }

}


/**
 * Add Navigation Custom Field
 *
 * @since     1.0.0 
 * @version   1.0.0
 */
if ( !function_exists( '_ut_add_custom_nav_fields' ) ) {

    function _ut_add_custom_nav_fields( $menu_item ) {
        
        if( !isset( $menu_item->ID ) ) {
            return;
        }
                
        foreach( _ut_recognized_custom_nav_fields() as $field ) {
                            
            if( get_post_meta( $menu_item->ID, '_menu_item_' . $field , true ) ) {
                
                $menu_item->$field = get_post_meta( $menu_item->ID, '_menu_item_' . $field, true );
                
            }
        
        }
        
        return $menu_item;
        
    }
    
    /* add custom menu fields to menu */
    add_filter( 'wp_setup_nav_menu_item', '_ut_add_custom_nav_fields' );

}


/**
 * Update Navigation Custom Field
 *
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_update_custom_nav_fields' ) ) {
    
    function _ut_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
                
        foreach( _ut_recognized_custom_nav_fields() as $field ) {
            
            $request_field = str_replace('_' , '-', $field );
            
            if ( isset($_REQUEST['menu-item-' . $request_field][$menu_item_db_id]) ) {
            
                update_post_meta( $menu_item_db_id, '_menu_item_' . $field, $_REQUEST['menu-item-' . $request_field][$menu_item_db_id] );
                
            } else {
                
                delete_post_meta( $menu_item_db_id, '_menu_item_' . $field );
                
            }        
        
        }
        
    }
    
    /* save menu custom fields */
    add_action( 'wp_update_nav_menu_item', '_ut_update_custom_nav_fields' , 10 , 3 ); 

}


/**
 * Edit Menutype Custom Field
 *
 * @since     1.0.0
 * @version   1.0.0
 */
 
 if ( !function_exists( '_ut_edit_walker' ) ) {

    function _ut_edit_walker( $walker , $menu_id ) {
        
        return 'WP_UT_Nav_Menu_Edit';
        
    }
    
    /* edit menu walker */
     add_filter( 'wp_edit_nav_menu_walker', '_ut_edit_walker' , 10 , 2 ); // @todo

}


/**
 * Enhance "Appearance" => "Menus"
 *
 * @since     1.0.0
 * @version   1.0.0
 */
if( !class_exists('WP_UT_Nav_Menu_Edit_Custom') ) :

    class WP_UT_Nav_Menu_Edit extends Walker_Nav_Menu  {
        
        /**
         * Starts the list before the elements are added.
         *
         * @see Walker_Nav_Menu::start_lvl()
         *
         * @since 3.0.0
         *
         * @param string $output Passed by reference.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   Not used.
         */
        public function start_lvl( &$output, $depth = 0, $args = array() ) {
        
        }        
        
        
        /**
         * Ends the list of after the elements are added.
         *
         * @see Walker_Nav_Menu::end_lvl()
         *
         * @since 3.0.0
         *
         * @param string $output Passed by reference.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   Not used.
         */
        public function end_lvl( &$output, $depth = 0, $args = array() ) {
            
        }
        
                
        function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
            
            // check, whether there are children for the given ID and append it to the element with a (new) ID
            $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
    
            return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
            
        }
        
              
        
        /**
         * Start the element output.
         *
         * @see Walker_Nav_Menu::start_el()
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item   Menu item data object.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   Not used.
         * @param int    $id     Not used.
         */
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            
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
                $title = sprintf( esc_html__( '%s (Invalid)' , 'unite' ), $item->title );
            } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
                $classes[] = 'pending';
                /* translators: %s: title of menu item in draft status */
                $title = sprintf( esc_html__('%s (Pending)', 'unite'), $item->title );
            }
    
            $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;
    
            $submenu_text = '';
            if ( 0 == $depth )
                $submenu_text = 'style="display: none;"';
            
            ?>
            <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>" data-menuid="<?php echo $item_id; ?>" <?php echo ( 'megamenu-parent' == $item->object ) ? 'data-megamenu="1"' : ''; ?> <?php echo ( 'megamenu-column' == $item->object ) ? 'data-megamenu-column="1"' : ''; ?> <?php echo ( 'navigation-widget-area' == $item->object ) ? 'data-megamenu-widget="1"' : ''; ?>>
                <dl class="menu-item-bar">
                    <dt class="menu-item-handle">
                        
                        <span class="item-title">
                            
                            <span class="menu-item-title"><?php echo esc_html( wp_strip_all_tags( $title ) ); ?></span>
                            
                            <?php if( 'navigation-widget-area' == $item->object ) : ?>
                                
                                <span id="mega-menu-widget-<?php echo $item_id; ?>" class="ut-is-megamenu-widget"><?php esc_html_e( 'Widget', 'unite' ); ?></span>
                            
                            <?php elseif( 'megamenu-parent' == $item->object ) : ?>
                                
                                <span id="mega-menu-badge-<?php echo $item_id; ?>" class="ut-is-megamenu"><?php esc_html_e( 'Megamenu', 'unite' ); ?></span>
                            
                            <?php elseif( 'megamenu-column' == $item->object ) : ?>
                                
                                <span id="mega-menu-column-<?php echo $item_id; ?>" class="ut-is-megamenu-column"><?php esc_html_e( 'Column', 'unite' ); ?></span> 
                                
                            <?php elseif( isset( $item->classes ) && is_array( $item->classes ) && in_array( 'ut-mm-highlight-link', $item->classes ) ) : ?>
                                                        
                                <span id="mega-menu-link-<?php echo $item_id; ?>" class="ut-is-megamenu-link"><?php esc_html_e( 'Highlight Link', 'unite' ); ?></span> 
                            
                            <?php else : ?>
                                
                                <span class="is-submenu" <?php echo $submenu_text; ?>><?php esc_html_e( 'sub item', 'unite' ); ?></span>
                                
                            <?php endif; ?>                            
                            
                        </span>
                        
                        <span class="item-controls">
                            
                            <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                            <span class="item-order hide-if-js">
                                <a href="<?php
                                    echo wp_nonce_url(
                                        esc_url( add_query_arg(
                                            array(
                                                'action' => 'move-up-menu-item',
                                                'menu-item' => $item_id,
                                            ),
                                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                        ) ),
                                        'move-menu_item'
                                    );
                                ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>
                                |
                                <a href="<?php
                                    echo wp_nonce_url(
                                         esc_url( add_query_arg(
                                            array(
                                                'action' => 'move-down-menu-item',
                                                'menu-item' => $item_id,
                                            ),
                                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                        ) ),
                                        'move-menu_item'
                                    );
                                ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>
                            </span>
                            <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php
                                echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) :  esc_url( add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) );
                            ?>"><?php esc_html_e( 'Edit Menu Item' , 'unite' ); ?></a>
                        </span>
                    </dt>
                </dl>
    
                <div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo $item_id; ?>">
                    <?php if( 'custom' == $item->type ) : ?>
                        <p class="field-url description description-wide">
                            <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                                <?php esc_html_e( 'URL', 'unite' ); ?><br />
                                <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                            </label>
                        </p>
                    <?php endif; ?>
                    
                    <?php $hide_extra_settings = ('navigation-widget-area' == $item->object ) ? 'ut-hide' : ''; ?>
                        
                    <p class="description description-thin <?php echo $hide_extra_settings; ?>">
                        <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                            <?php esc_html_e( 'Navigation Label', 'unite' ); ?><br />
                            <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                        </label>
                    </p>
                    
                    <p class="description description-thin <?php echo $hide_extra_settings; ?>">
                        <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                            <?php esc_html_e( 'Title Attribute', 'unite' ); ?><br />
                            <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                        </label>
                    </p>
                    
                    <p class="field-link-target description <?php echo $hide_extra_settings; ?>">
                        <label for="edit-menu-item-target-<?php echo $item_id; ?>">
                            <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
                            <?php esc_html_e( 'Open link in a new window/tab', 'unite' ); ?>
                        </label>
                    </p>
                    
                    <p class="field-css-classes description description-thin">
                        <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                            <?php esc_html_e( 'CSS Classes (optional)', 'unite' ); ?><br />
                            <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                        </label>
                    </p>
                    
                    <p class="field-xfn description description-thin <?php echo $hide_extra_settings; ?>">
                        <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                            <?php esc_html_e( 'Link Relationship (XFN)', 'unite' ); ?><br />
                            <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                        </label>
                    </p>
                    
                    <p class="field-description description description-wide <?php echo $hide_extra_settings; ?>">
                        <label for="edit-menu-item-description-<?php echo $item_id; ?>">
                            <?php esc_html_e( 'Description', 'unite' ); ?><br />
                            <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                            <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'unite' ); ?></span>
                        </label>
                    </p>
                                                            
                    <?php /* New fields insertion starts here */ ?>
                    
                    <div class="clear"></div>
                    
                    <?php if( 'megamenu-parent' == $item->object ) : ?>
                        
                        <div class="ut-megamenu-settings">
                            
                            <h4><?php esc_html_e( 'Megamenu Settings', 'unite' ); ?></h4>
                            
                            <div id="ut-megamenu-settings-<?php echo $item_id; ?>" class="ut-megamenu-settings-inner has-tabs">
                            
                                <div class="ut-tabs">
                                    
                                    <ul>
                                        <li>
                                            <a href="#"><?php esc_html_e( 'General', 'unite' ); ?></a>
                                        </li>
                                        <li>
                                            <a href="#"><?php esc_html_e( 'Styling', 'unite' ); ?></a>
                                        </li>
                                    </ul>
                                    
                                    <!-- General Settings -->
                                    <div>
                                        
                                        <div class="ut-accordion">
                                        
                                            <h4><?php esc_html_e( 'MegaMenu Bottom Link', 'unite' ); ?></h4>
                                        
                                            <div>
                                            
                                                <h5><?php esc_html_e( 'Link', 'unite' ); ?></h5>
                                            
                                                <?php 
                                                                                    
                                                    /* megamenu bottom link */
                                                    $field_settings = array(
                                                        'id'           => 'edit-menu-item-megamenu-bottom-link-' . $item_id,
                                                        'name'         => $item_id,
                                                        'type'         => 'text',
                                                        'desc'         => '',
                                                        'value'        => isset( $item->megamenu_bottom_link ) ? $item->megamenu_bottom_link : ''
                                                    );                                 
                                                    
                                                    $settings = ut_prepare_settings_field( $field_settings, 'meta_box', 'menu-item-megamenu-bottom-link' );
                                                    $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                                                    
                                                    call_user_func( $function_by_type, $settings );
                
                                                ?>
                                                    
                                                <h5><?php esc_html_e( 'Link Title', 'unite' ); ?></h5>
                                                                                                                        
                                                <?php 
                                                                                    
                                                    /* megamenu bottom link title */
                                                    $field_settings = array(
                                                        'id'           => 'edit-menu-item-megamenu-bottom-link-title-' . $item_id,
                                                        'name'         => $item_id,
                                                        'type'         => 'text',
                                                        'desc'         => '',
                                                        'value'        => isset( $item->megamenu_bottom_link_title ) ? $item->megamenu_bottom_link_title : ''
                                                    );                                 
                                                    
                                                    $settings = ut_prepare_settings_field( $field_settings, 'meta_box', 'menu-item-megamenu-bottom-link-title' );
                                                    $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                                                    
                                                    call_user_func( $function_by_type, $settings );
                
                                                ?>
                                            
                                            </div>
                                            
                                       </div>
                                        
                                    </div>
                                    
                                    <!-- Styling Settings -->
                                    <div>
                                        
                                        <div class="ut-accordion">    
                                            
                                            <h4><?php esc_html_e( 'MegaMenu Skin', 'unite' ); ?></h4>    
                                            
                                            <div>
                                                
                                                <h5><?php esc_html_e( 'Skin', 'unite' ); ?></h5>    
                                                
                                                <?php 
                                                
                                                $megamenu_skins = ut_get_option( 'megamenu_skins' );
                                
                                                    
                                                $available_skins = array( 'default' => esc_html__( 'Default Skin', 'unite' ) );
                                                
                                                foreach( $megamenu_skins as $skin ) {
                                                    
                                                    $available_skins[strtolower( ut_remove_trash( $skin['skin_name'] ) )] = $skin['skin_name'];
                                                    
                                                }
                                                
                                                $skin_name = ut_remove_trash( $skin['skin_name'] );
                                                $skin_name = 'ut_megamenu_skin_' . strtolower( $skin_name );
                                                
                                                
                                                $field_settings = array(
                                                    'id'           => 'edit-menu-item-megamenu-skin-' . $item_id,
                                                    'name'         => $item_id,
                                                    'type'         => 'select',
                                                    'choices'      => $available_skins,
                                                    'desc'         => '',
                                                    'value'        => isset( $item->megamenu_skin ) ? $item->megamenu_skin : '',
                                                    'default'      => 'default'
                                                );                                 
                                                
                                                $settings = ut_prepare_settings_field( $field_settings, 'meta_box', 'menu-item-megamenu-skin' );
                                                $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                                                
                                                call_user_func( $function_by_type, $settings );                                                    
                                                
                                                
                                                
                                                
                                                
                                                ?>
                                            
                                            </div>                                            
                                        
                                        </div>
                                        
                                    </div>
                                                                            
                                </div>
                            
                            </div>
                             
                        </div>
                                                
                    <?php endif; ?>
                    
                    <?php if( 'megamenu-column' == $item->object ) : ?>
                        
                        <div class="ut-megamenu-settings">
                            
                            <h4><?php esc_html_e( 'Megamenu Column Settings', 'unite' ); ?></h4>
                                                       
                            <div id="ut-megamenu-settings-<?php echo $item_id; ?>" class="ut-megamenu-settings-inner has-tabs">
                                
                                <div class="ut-tabs">
                                    
                                    <ul>
                                        <li>
                                            <a href="#"><?php esc_html_e( 'General', 'unite' ); ?></a>
                                        </li>
                                        <li>
                                            <a href="#"><?php esc_html_e( 'Styling', 'unite' ); ?></a>
                                        </li>
                                    </ul>
                                    
                                    <div>
                                        
                                        <div class="ut-accordion">
                                        
                                            <h4><?php esc_html_e( 'Column Title Settings', 'unite' ); ?></h4>
                                            
                                            <div>
                                            
                                                <h5><?php esc_html_e( 'Hide Column Title', 'unite' ); ?></h5>
                                                                           
                                                <?php
                                                                                    
                                                    /* hide column title */
                                                    $field_settings = array(
                                                        'id'           => 'edit-menu-item-megamenu-hide-column-title-' . $item_id,
                                                        'name'         => $item_id,
                                                        'type'         => 'switch',
                                                        'labels'       => array(
                                                            'on'    => esc_html__( 'yes', 'unite' ), 
                                                            'off'   => esc_html__( 'no', 'unite' ), 
                                                        ),
                                                        'desc'         => '',
                                                        'value'        => isset( $item->megamenu_hide_column_title ) ? $item->megamenu_hide_column_title : ''
                                                    );                                 
                                                    
                                                    $settings = ut_prepare_settings_field( $field_settings, 'meta_box', 'menu-item-megamenu-hide-column-title' );
                                                    $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                                                    
                                                    call_user_func( $function_by_type, $settings );
                
                                                ?>
                                            
                                            </div>
                                            
                                            <h4><?php esc_html_e( 'Column Bottom Link', 'unite' ); ?></h4>
                                            
                                            <div>
                                            
                                                <h5><?php esc_html_e( 'Link', 'unite' ); ?></h5>
                                                                                   
                                                <?php
                                                                                    
                                                    /* megamenu bottom link */
                                                    $field_settings = array(
                                                        'id'           => 'edit-menu-item-megamenu-column-bottom-link-' . $item_id,
                                                        'name'         => $item_id,
                                                        'type'         => 'text',
                                                        'desc'         => '',
                                                        'value'        => isset( $item->megamenu_column_bottom_link ) ? $item->megamenu_column_bottom_link : ''
                                                    );                                 
                                                    
                                                    $settings = ut_prepare_settings_field( $field_settings, 'meta_box', 'menu-item-megamenu-column-bottom-link' );
                                                    $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                                                    
                                                    call_user_func( $function_by_type, $settings );
                
                                                ?>
                                                
                                                <h5><?php esc_html_e( 'Link Title', 'unite' ); ?></h5>
                                                                                                                        
                                                <?php 
                                                                                    
                                                    /* megamenu bottom link title */
                                                    $field_settings = array(
                                                        'id'           => 'edit-menu-item-megamenu-column-bottom-link-title-' . $item_id,
                                                        'name'         => $item_id,
                                                        'type'         => 'text',
                                                        'desc'         => '',
                                                        'value'        => isset( $item->megamenu_column_bottom_link_title ) ? $item->megamenu_column_bottom_link_title : ''
                                                    );                                 
                                                    
                                                    $settings = ut_prepare_settings_field( $field_settings, 'meta_box', 'menu-item-megamenu-column-bottom-link-title' );
                                                    $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                                                    
                                                    call_user_func( $function_by_type, $settings );
                
                                                ?>
                                            </div>
                                        
                                        </div>
                                        
                                    </div>
                                    
                                    <div>
                                        
                                        <div class="ut-accordion">
                                        
                                            <h4><?php esc_html_e( 'Bottom Link Styling', 'unite' ); ?></h4>
                                            
                                            <div>
                                                                                    
                                                <h5><?php esc_html_e( 'Background Color', 'unite' ); ?></h5>
                                                
                                                <?php
                                                    
                                                    $field_settings = array(
                                                        'id'           => 'edit-menu-item-megamenu-column-bottom-link-background-color' . $item_id,
                                                        'name'         => $item_id,
                                                        'type'         => 'colorpicker',
                                                        'desc'         => '',
                                                        'value'        => isset( $item->megamenu_column_bottom_link_background_color ) ? $item->megamenu_column_bottom_link_background_color : ''
                                                    );
                                                    
                                                    $settings = ut_prepare_settings_field( $field_settings, 'meta_box', 'menu-item-megamenu-column-bottom-link-background-color' );
                                                    $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                                                    
                                                    call_user_func( $function_by_type, $settings );
                                                
                                                ?>
                                                
                                                <h5><?php esc_html_e( 'Border Color', 'unite' ); ?></h5>
                                                
                                                <?php
                                                
                                                    $field_settings = array(
                                                        'id'           => 'edit-menu-item-megamenu-column-bottom-link-border-color' . $item_id,
                                                        'name'         => $item_id,
                                                        'type'         => 'colorpicker',
                                                        'mode'         => 'rgb',
                                                        'desc'         => '',
                                                        'value'        => isset( $item->megamenu_column_bottom_link_border_color ) ? $item->megamenu_column_bottom_link_border_color : ''
                                                    );
                                                    
                                                    $settings = ut_prepare_settings_field( $field_settings, 'meta_box', 'menu-item-megamenu-column-bottom-link-border-color' );
                                                    $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                                                    
                                                    call_user_func( $function_by_type, $settings );
                                                
                                                ?>
                                                
                                                <h5><?php esc_html_e( 'Text Color', 'unite' ); ?></h5>
                                                
                                                <?php                                            
        
                                                    $field_settings = array(
                                                        'id'           => 'edit-menu-item-megamenu-column-bottom-link-text-color' . $item_id,
                                                        'name'         => $item_id,
                                                        'type'         => 'colorpicker',
                                                        'desc'         => '',
                                                        'value'        => isset( $item->megamenu_column_bottom_link_text_color ) ? $item->megamenu_column_bottom_link_text_color : ''
                                                    );
                                                    
                                                    $settings = ut_prepare_settings_field( $field_settings, 'meta_box', 'menu-item-megamenu-column-bottom-link-text-color' );
                                                    $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                                                    
                                                    call_user_func( $function_by_type, $settings );
                                                
                                                ?>
                                                
                                                
                                                <h5><?php esc_html_e( 'Background Hover Color', 'unite' ); ?></h5>
                                                
                                                <?php
                                                    
                                                    $field_settings = array(
                                                        'id'           => 'edit-menu-item-megamenu-column-bottom-link-background-hover-color' . $item_id,
                                                        'name'         => $item_id,
                                                        'type'         => 'colorpicker',
                                                        'desc'         => '',
                                                        'value'        => isset( $item->megamenu_column_bottom_link_background_hover_color ) ? $item->megamenu_column_bottom_link_background_hover_color : ''
                                                    );
                                                    
                                                    $settings = ut_prepare_settings_field( $field_settings, 'meta_box', 'menu-item-megamenu-column-bottom-link-background-hover-color' );
                                                    $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                                                    
                                                    call_user_func( $function_by_type, $settings );
                                                
                                                ?>
                                                
                                                <h5><?php esc_html_e( 'Border Hover Color', 'unite' ); ?></h5>
                                                
                                                <?php
                                                
                                                    $field_settings = array(
                                                        'id'           => 'edit-menu-item-megamenu-column-bottom-link-border-hover-color' . $item_id,
                                                        'name'         => $item_id,
                                                        'type'         => 'colorpicker',
                                                        'mode'         => 'rgb',
                                                        'desc'         => '',
                                                        'value'        => isset( $item->megamenu_column_bottom_link_border_hover_color ) ? $item->megamenu_column_bottom_link_border_hover_color : ''
                                                    );
                                                    
                                                    $settings = ut_prepare_settings_field( $field_settings, 'meta_box', 'menu-item-megamenu-column-bottom-link-border-hover-color' );
                                                    $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                                                    
                                                    call_user_func( $function_by_type, $settings );
                                                
                                                ?>
                                                
                                                <h5><?php esc_html_e( 'Text Hover Color', 'unite' ); ?></h5>
                                                
                                                <?php                                            
        
                                                    $field_settings = array(
                                                        'id'           => 'edit-menu-item-megamenu-column-bottom-link-text-hover-color' . $item_id,
                                                        'name'         => $item_id,
                                                        'type'         => 'colorpicker',
                                                        'desc'         => '',
                                                        'value'        => isset( $item->megamenu_column_bottom_link_text_hover_color ) ? $item->megamenu_column_bottom_link_text_hover_color : ''
                                                    );
                                                    
                                                    $settings = ut_prepare_settings_field( $field_settings, 'meta_box', 'menu-item-megamenu-column-bottom-link-text-hover-color' );
                                                    $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                                                    
                                                    call_user_func( $function_by_type, $settings );
                                                
                                                ?>
                                            
                                            </div>
                                            
                                        </div>    
                                        
                                    </div>                                        
                                    
                                </div>
                                                          
                            </div>
                                                 
                        </div>                    
                    
                    <?php endif; ?>
                    
                    <?php /* New fields insertion ends here */ ?>                    
                    
                    <p class="field-move hide-if-no-js description description-wide">
                        <label>
                            <span><?php esc_html_e( 'Move', 'unite' ); ?></span>
                            <a href="#" class="menus-move menus-move-up" data-dir="up"><?php _e( 'Up one' ); ?></a>
                            <a href="#" class="menus-move menus-move-down" data-dir="down"><?php _e( 'Down one' ); ?></a>
                            <a href="#" class="menus-move menus-move-left" data-dir="left"></a>
                            <a href="#" class="menus-move menus-move-right" data-dir="right"></a>
                            <a href="#" class="menus-move menus-move-top" data-dir="top"><?php _e( 'To the top' ); ?></a>
                        </label>
                    </p>
    
                    <div class="menu-item-actions description-wide submitbox">
                        <?php if( 'navigation-widget-area' != $item->type && 'custom' != $item->type && $original_title !== false ) : ?>
                            <p class="link-to-original">
                                <?php printf( __('Original: %s', 'unite'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                            </p>
                        <?php endif; ?>
                        <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
                        echo wp_nonce_url(
                             esc_url( add_query_arg(
                                array(
                                    'action' => 'delete-menu-item',
                                    'menu-item' => $item_id,
                                ),
                                admin_url( 'nav-menus.php' )
                            ) ),
                            'delete-menu_item_' . $item_id
                        ); ?>"><?php esc_html_e( 'Remove', 'unite' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
                            ?>#menu-item-settings-<?php echo $item_id; ?>"><?php esc_html_e('Cancel', 'unite'); ?></a>
                    </div>
                                        
                    <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
                    <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
                    <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
                    <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
                    <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
                    <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
                    
                    
                </div><!-- .menu-item-settings-->
                <ul class="menu-item-transport"></ul>
            <?php
            $output .= ob_get_clean();
        }
        
    }

endif;


if( !class_exists('WP_UT_Menu_Walker') ) :

    class WP_UT_Menu_Walker extends Walker_Nav_Menu {
       
        private $item;
        
        private $section_grid;
        private $sections_count;
        private $sections_global_count;
        private $sections_total_count;
        
        private $mega_menu_open    = false;
        private $mega_section_open = false;
        private $mega_section_skin = false;
        private $inner_list_open   = array();        
        private $menu_backlink     = false;
        
        private $column_bottom_link = NULL;
        
        public function start_mega_menu( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            
            $this->mega_menu_open = true;
            
            /* get menu locations */
            $locations          = get_nav_menu_locations();                    
            $primary_menu       = wp_get_nav_menu_object( $locations['primary'] );
            $primary_menu_items = wp_get_nav_menu_items( $primary_menu->term_id );

            /* create counter */
            $this->sections_global_count = 0;
            $this->sections_count = 1;
            
            /* variables */
            $extra_class = $skin_name= NULL;            
                        
            foreach( $primary_menu_items as $menu_item ){

                if( $menu_item->menu_item_parent == $item->ID ){
                    
                    $this->sections_global_count++;           
                    
                }
                
            }
            
            if( $this->sections_global_count <= 4 ) {
                
                $this->section_grid = $this->sections_global_count;
            
            } else {
                
                /* default grid size - will be changed if remain is smaller */
                $this->section_grid = 4;
                $this->sections_total_count = $this->sections_global_count;
                
            }
            
            /* bottom link extra class */
            if( !empty( $this->item->megamenu_bottom_link ) && !empty( $this->item->megamenu_bottom_link_title ) ) {
                
                $extra_class = 'ut-has-bottom-link';    
                
            }
            
            if( !empty( $this->item->megamenu_skin ) && $this->item->megamenu_skin ) {
                
                $skin_name = strtolower( ut_remove_trash( $this->item->megamenu_skin ) );
                $skin_name = 'ut-megamenu-skin-' . $skin_name;
                
                /* store skin */
                $this->mega_section_skin = $this->item->megamenu_skin;
                
            }
            
            /* final output */
            $output  .= '<div id="ut-secondary-nav-' . $item->ID . '" class="ut-secondary-nav ' . $skin_name . ' is-parent is-hidden ' . $extra_class . '">' . "\n";
                $output  .= '<div class="ut-megamenu-overlay-wrap"><div id="ut-megamenu-overlay-' . $item->ID . '" class="ut-megamenu-overlay">';
                    $output  .= '<div class="grid-container">' . "\n";
                        $output  .= '<div class="grid-offset">' . "\n";
            
               
        }
        
        public function end_mega_menu( &$output, $item, $depth = 0, $args = array() ) {
            
            $indent  = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            
                            /* html markup */
                            $output .= $indent . '</div>' . "\n";                            
                        $output .= $indent . '</div>' . "\n";
                        
                        /* bottom link */                
                        if( !empty( $item->megamenu_bottom_link ) && !empty( $item->megamenu_bottom_link_title ) ) {
                            
                            $output .= $indent . '<div class="clear"></div>' . "\n";    
                            $output .= $indent . '<div id="ut-megamenu-bottom-link-' . $item->ID . '" class="ut-megamenu-bottom-link"><a href="' . esc_url( $item->megamenu_bottom_link ) . '">' . $item->megamenu_bottom_link_title . ' </a></div>'. "\n";
                        
                        } 
                        
                    $output .= $indent . '</div>' . "\n";                    
                $output .= $indent . '</div>' . "\n";                
            $output .= $indent . '</div>' . "\n";
            
            $this->mega_menu_open = false;
            $this->mega_section_skin = false;
            
        }
        
        public function start_mega_menu_section( &$output, $depth = 0, $args = array() ) {
            
            $this->mega_section_open = true;
            
            $indent  = ( $depth ) ? str_repeat( "\t", $depth ) : '';  
            
            $grid = array(
                1 => 'grid-100',
                2 => 'grid-50',
                3 => 'grid-33',
                4 => 'grid-25'
            );
            
            if( $this->sections_global_count == $this->sections_total_count % 4 ) {
                
                $this->section_grid = $this->sections_total_count % 4; 
                
            }
            
            /* css classes */
            $classes = empty( $this->item->classes ) ? array() : (array) $this->item->classes;
            
            /* add grid size */
            $classes[] = $grid[$this->section_grid];
            $classes[] = 'ut-navigation-column';            
            
            /* delete unwanted */ 
            $classes = array_diff( $classes, array('menu-item-type-') );
            $classes = array_diff( $classes, array('menu-item-has-children') );
            $classes = array_diff( $classes, array('current-menu-ancestor') );            
            
            /* bottom link extra class */
            if( !empty( $this->item->megamenu_column_bottom_link ) && !empty( $this->item->megamenu_column_bottom_link_title ) ) {
                
                $classes[] = 'ut-column-has-bottom-link';    
                
            }            
                        
            /* merge class names */
            $class_names = join( ' ', array_filter( $classes ) );
            $class_names = $class_names ? esc_attr( $class_names ) : '';
                        
            /* html markup */
            $output .= '<div class="' . $class_names . '">';
                $output .= '<ul>';
                
            if( isset( $this->item->megamenu_hide_column_title ) && $this->item->megamenu_hide_column_title == 'on' ) {
            
                // nothing to do here    
            
            } else {
                
                /* get column title style */
                $column_title_style = ut_get_option( 'megamenu_column_title_style', 'ut-title-style1' );
                
                /* check for custom style */
                $custom_menu_skins = ut_get_option('megamenu_skins');
                
                if( $this->mega_section_skin && !empty( $custom_menu_skins ) && is_array( $custom_menu_skins ) ) {
                    
                    foreach( $custom_menu_skins as $key => $skin ) {
                                                                        
                        if( isset( $skin['skin_name'] ) && strtolower( ut_remove_trash( $skin['skin_name'] ) ) == $this->mega_section_skin ) {
                        
                            $column_title_style = $skin['column_title_style'];
                        
                        }
                    
                    }       
                
                }
                
                $output .= '<li class="ut-nav-header"><h3 class="' . $column_title_style . '"><span>' . apply_filters( 'the_title', $this->item->title ) . '</span></h3></li>';
            
            }
            
            if( !empty( $this->item->megamenu_column_bottom_link ) && !empty( $this->item->megamenu_column_bottom_link_title ) ) {
                
                /* store bottom link */               
                $this->column_bottom_link = '<li id="ut-megamenu-column-bottom-link-' . $this->item->ID . '" class="ut-megamenu-column-bottom-link"><a href="' . esc_url( $this->item->megamenu_column_bottom_link ) . '">' . $this->item->megamenu_column_bottom_link_title . ' </a></li>';
                
            }
            
        }
        
        public function end_mega_menu_section( &$output, $depth = 0, $args = array() ) {
                
            $indent  = ( $depth ) ? str_repeat( "\t", $depth ) : '';  
                
                /* check if column has bottom link */
                if( !empty( $this->column_bottom_link ) ) {
                    
                    $output .= $this->column_bottom_link . "\n";
                    $this->column_bottom_link = NULL;
                    
                }
                 
                /* html markup */
                $output .= $indent . '</ul>' . "\n";
            $output .= $indent . '</div>'. '<!-- ' . $this->sections_count . ' -->' . "\n";
            
            if( $this->sections_count == 4 ) {
                
                /* clear row */
                $output .= $indent . '<div class="clear"></diV>';
                
                /* reset count for next row */
                $this->sections_count = 0;
                
            }
            
            $this->sections_count++;
            $this->sections_global_count--;
            
            $this->mega_section_open = false;
            
        }
        
        public function start_lvl( &$output, $depth = 0, $args = array() ) {           
            
            /* html formatting */
            $indent  = ( $depth ) ? str_repeat( "\t", $depth ) : '';            
                        
            /* default dropdown */
            if( $depth == 0 && $this->item->classes != '' && in_array( 'menu-item-has-children', $this->item->classes ) && !$this->mega_menu_open ) {
                
                $output .= $indent . '<div class="ut-secondary-nav is-single is-parent is-hidden">' . "\n";
                $output .= $indent . '<div class="ut-navigation-column">';
                $output .= $indent . '<ul>' . "\n";                                    
                $output .= $indent . '<li class="ut-go-back hide-on-desktop"><a href="#">' . esc_html__( 'back', 'unite' )  . '</a></li>' . "\n";
                
            /* inner dropdown */    
            } elseif( $depth == 1 && !$this->mega_menu_open ) {
                                    
                $output .= $indent . '<ul class="is-hidden is-parent">' . "\n";
                
                if( $depth >= 1 ) {
                    
                    $this->menu_backlink = true;                    
                
                }
                
            /* inner dropdown nested lists */    
            } elseif( $depth >= 2 ) {
                
                $this->inner_list_open = array(
                    'depth' => $depth,
                );
                
                $output .= $indent . '<ul class="is-hidden is-parent">' . "\n";
                
                if( $depth >= 2 ) {
                    
                    $this->menu_backlink = true;
                
                }
                
            } 
            
        }        
        
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {            
            
            /* assign current item */
            $this->item = $item;
            
            if( $this->menu_backlink  ) {
                
                $title = get_the_title( $this->item->menu_item_parent ) ? get_the_title( $this->item->menu_item_parent ) : esc_html__( 'back', 'unite' );
                $output .= '<li data-level="' . $depth . '" data-parent="' . $this->item->menu_item_parent . '" class="ut-go-back"><a href="#"><h3>' . $title  . '</h3></a></li>' . "\n";
                
                $this->menu_backlink = false;
                
            }
            
            /* needed variables */
            $dropdown = NULL;
                        
            /* html formatting */
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            
            /* css classes */
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;
            $classes[] = 'ut-menu-item-lvl-' . $depth;
            
            /* category css class */
            if( 'category' == $item->object ){
                $category  = get_category( $item->object_id );
                $classes[] = 'menu-category-' . $category->slug;
            }
            
            /* extra class for parent elements */
            if ( $this->has_children ) {
                $classes[] = 'ut-parent';
            }
            
            if ( $this->has_children ) {
                $classes[] = 'ut-has-children';
            }
                        
            /* extra class for megamenu */
            if( $depth == 0 && $item->object == 'megamenu-parent' ) {
                $classes[] = 'ut-is-megamenu';
            }
            
            /* merge class names */
            $class_names = join( ' ', array_filter( $classes ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
            
            /* menu item id */
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
            
            /* menu link attributes */
            $atts = array();
            
            $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
            $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
            $atts['href']   = ! empty( $item->url )        ? $item->url        : '#';
            
            /* extra a class */
            if ( $this->has_children && $depth >= 1 ) {
                $atts['class'] = 'ut-go-forward';
            }
            
            /* loop trough menu link attributes */
            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
            
            if( $item->object == 'navigation-widget-area' ) {
                
                $link_output = $this->create_menu_widget( $item->xfn );
                
            } else {
                
                $link_output = NULL;
                   
                /* create menu link */
                $link_output .= $args->before;
                $link_output .= '<a'. $attributes .'>';
                $link_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                $link_output .= '</a>';
                $link_output .= $args->after;
            
            }
           
            if( $item->object == 'megamenu-column' ) {
                
                $this->start_mega_menu_section( $output, $depth, $args );
                
            } else {            
            
                /* create list opener */
                $output .= $indent . '<li' . $id . $class_names . $dropdown . '>' . "\n";
                $output .= $indent . $link_output . "\n";                                
                
                if( $depth == 0 && $item->object == 'megamenu-parent' ) {

                    $this->start_mega_menu( $output, $item, $depth, $args, $id );

                }
            
            }    
            
            
        }        
        
        public function end_el( &$output, $item, $depth = 0, $args = array() ) {
            
            /* html formatting */
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';            
            
            if( $depth == 0 && $this->mega_menu_open ) {
                
                $this->end_mega_menu( $output, $item, $depth, $args );
                
            }
            
            if( $item->object == 'megamenu-column' ) {
                
                $this->end_mega_menu_section( $output, $depth, $args );
                
            }  elseif( isset( $this->inner_list_open['depth'] ) && $this->inner_list_open['depth'] == $depth ) {
                
                $output .= $indent . '</ul>' . "\n";
                $this->inner_list_open = array();
                
            }  else {
            
                $output .= $indent . '</li>' . "\n";
                
            }                
            
        }
        
        public function end_lvl( &$output, $depth = 0, $args = array() ) {
            
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            
            if( $depth == 0 && !$this->mega_menu_open ) {
                
                $output .= $indent . '</ul>' . "\n";
                $output .= $indent . '</div>' . "\n";
                $output .= $indent . '</div>' . "\n";
           
            } elseif( $depth >= 1 && !$this->mega_menu_open ) {
            
                $output .= $indent . '</ul>' . "\n";
                
            }          
            
           
        }
        
        public function create_menu_widget( $widget_id ) {
            
            global $wp_registered_widgets, $wp_registered_sidebars;
                        
            if ( !isset( $wp_registered_widgets[$widget_id]) ) {
                return;
            }
            
            $item_output = NULL;
            
            /* setup sidebar */
            $sidebar = array_merge(
                    
                    $wp_registered_sidebars['navigation-widget-area'],

                    array(
                        'widget_id'   => $widget_id,
                        'widget_name' => $wp_registered_widgets[$widget_id]['name']
                    )
                    
            );
            
            /* setup widget config */
            $params = array_merge(
                array($sidebar),
                (array) $wp_registered_widgets[$widget_id]['params']
            );
            
            
            /* callback */
            $callback = $wp_registered_widgets[$widget_id]['callback'];
            
            
            if ( is_callable( $callback ) ) {
                
                ob_start(); 

                call_user_func_array($callback, $params); 
                
                $item_output .= '<div class="widget-area navigation-widget-area">';
                
                $item_output .= ob_get_contents();
                
                $item_output .= '</div>';

                ob_end_clean();
                    
            }
            
            return $item_output;
            
            
        } 
        
        
    }
    
endif;