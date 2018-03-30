<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

class UT_Metabox {
    
    /**
     * Metabox Array
     * @var array
     */
     
    private $unite_meta_box_settings;
    
    
    /**
     * Constructor
     * @since     1.0.0
     * @version   1.0.0
     */
    public function __construct( $unite_meta_box_settings ) {
        
        /* assign meta settings */
        $this->meta_box = $unite_meta_box_settings;            
        
        /* load metabox */
        $this->hooks();
        
        /* store metabox config */
        $this->store_config();
        
    }
    
    /**
     * Initiate our hooks
     * @since     1.0.0
     * @version   1.0.0
     */
    public function hooks() {
        
        global $pagenow;
        
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_box' ), 1, 2 );
        
        /* enqueue scripts for current meta box */
        foreach ( (array) $this->meta_box['config']['screen'] as $screen ) {
            
            if( isset($_GET['post_type']) && $_GET['post_type'] == $screen || isset($_GET['post']) && get_post_type( (int) $_GET['post'] ) == $screen || $screen == 'post' && $pagenow == 'post-new.php' ) {
                
                add_action( 'admin_enqueue_scripts', array( $this, 'register_metabox_admin_css' ) );                    
                add_action( 'admin_enqueue_scripts', array( $this, 'register_metabox_admin_js' ) ); 
            
            }                
        
        }
        
    }
    
    /**
     * Store Metabox Config
     * @since     1.0.0
     * @version   1.0.0
     */
    private function store_config() {
        
        if( empty( $this->meta_box['info']['function'] ) || empty( $this->meta_box['info']['file'] ) ) {
            
            return;
            
            /* @todo add notification if infos are missing - mandatory! */
            
        }
        
        if ( get_option( 'unite_recognized_metaboxes' ) !== false ) {
                                            
            /* get storeed option first */
            $meta_boxes = get_option( 'unite_recognized_metaboxes' );
                            
            $update_option = array();
                                         
            /* loop through already recognized metaboxes */
            foreach( $meta_boxes as $id => $meta_box ) {
                
                /* check if this metaboxes is still valid */
                if( function_exists( $meta_box['function'] ) && file_exists( $meta_box['file'] ) && $this->meta_box['info']['file'] != $meta_box['file'] && $this->meta_box['info']['function'] != $meta_box['function'] ) {
                    
                    $update_option[$id] = $meta_box;
                    
                }
            
            }
            
            /* now add the current metabox */
            $update_option[$this->meta_box['config']['id']] = $this->meta_box['info'];
                                                   
            /*update options table */
            update_option( 'unite_recognized_metaboxes' , $update_option );
        
        } else {
            
            /* assign metabox info to metabox id */
            $metabox_info = array( $this->meta_box['config']['id'] => $this->meta_box['info'] );

            /* create option the very first time */                
            add_option( 'unite_recognized_metaboxes' , $metabox_info );                
            
        }     
    
    }
    
    
    /**
     * Initiate our metabox
     * @since     1.0.0
     * @version   1.0.0
     */
    public function add_meta_boxes() {
        
        $post_id = isset( $_GET['post'] ) ? $_GET['post'] : '' ;
        $post_id = empty( $post_id ) && isset( $_POST['post_ID'] ) ? $_POST['post_ID'] : '';
                     
        foreach ( (array) $this->meta_box['config']['screen'] as $screen ) {
            
            /* check if this metabox belongs to a template and only enqueue if template is active */
            if( isset( $this->meta_box['config']['templates'] ) && is_array( $this->meta_box['config']['templates'] ) ) {
                
                $template_file = get_post_meta( $post_id, '_wp_page_template', true );
                                    
                if( $template_file && in_array( $template_file, $this->meta_box['config']['templates'] ) ) {
                    
                    add_meta_box( $this->meta_box['config']['id'], $this->meta_box['config']['title'], array( $this, 'render_meta_box' ), $screen, $this->meta_box['config']['context'], $this->meta_box['config']['priority'], $this->meta_box['settings'] );
                    
                }                    
                
            } else {
                
                add_meta_box( $this->meta_box['config']['id'], $this->meta_box['config']['title'], array( $this, 'render_meta_box' ), $screen, $this->meta_box['config']['context'], $this->meta_box['config']['priority'], $this->meta_box['settings'] );
                
            }
        
        }            
    
    }
    
    
    /**
     * Render our metabox
     * @since     1.0.0
     * @version   1.0.0
     */
    public function render_meta_box( $post, $metabox ) { ?>
    
        <?php echo '<input type="hidden" name="' , $this->meta_box['config']['id'] , '_nonce" value="' , wp_create_nonce( $this->meta_box['config']['id'] ) , '" />'; ?>
        
        <?php if( $this->meta_box['config']['context'] == 'side' ) : ?>
        
            <!-- Start UT-Backend-Wrap -->
            <div class="ut-admin-wrap ut-metabox-wrap ut-metabox-side clearfix" data-cookiekey="<?php echo $this->meta_box['config']['id']; ?>_nav">
                
                <!-- Start UT-Backend-Main -->
                <div class="ut-admin-main">
                    
                    <?php 
                        
                        foreach( (array) $this->meta_box['sections'] as $key => $section ) {
                            
                            echo '<div id="' , $section['id'] , '">';
                                
                                $this->do_add_settings_field( $section['id'] );
                            
                            echo '</div>';
                        
                        }
                   
                    ?>
                
                </div>
                
            </div>
            <!-- Close UT-Backend-Wrap -->
        
        <?php else : ?>
                    
        <!-- Start UT-Backend-Wrap -->
        <div class="ut-admin-wrap ut-metabox-wrap ut-metabox-normal clearfix" data-cookiekey="<?php echo $this->meta_box['config']['id']; ?>_nav">
            
                <!-- Start UT-Backend-Navigation -->
                <div class="grid-15 no-padding height-100 bg-color">
                    
                    <div class="ut-backend-navigation-wrap">
                        
                        <ul class="ut-backend-main-navigation">
                        
                        <?php 
                        
                        /* menu item count */
                        $menu_counter = 1; 
                        
                        /* store active section */
                        $active_section = isset( $_COOKIE[$this->meta_box['config']['id']. '_nav'] ) ? $_COOKIE[$this->meta_box['config']['id'] . '_nav'] : '';
                        
                        foreach( (array) $this->meta_box['sections'] as $key => $section ) { ?>
                            
                            <?php 
                            
                            $current  = ( $active_section == $section['id'] ) ? 'ut-current' : '' ;
                            $fallback = ( $menu_counter == 1 ) ? 'ut-menu-fallback-item' : ''; 
                            
                            ?>
                            
                            <li class="<?php echo $current; ?>">
                            
                                <a class="<?php echo $fallback; ?>" data-title="<?php echo $section['title']; ?>" data-panel="<?php echo $section['id']; ?>" href="#"><i class="fa <?php echo $section['icon']; ?>"></i><?php echo $section['title']; ?></a>
                                
                                <?php if ( isset( $section['subsections'] ) && is_array( $section['subsections'] ) && !empty( $section['subsections'] ) ) { ?>
                                            
                                    <ul class="ut-backend-main-navigation-submenu <?php echo $submenu_state; ?>">
                                    
                                        <?php foreach( $section['subsections'] as $subsection ) { 
                                            
                                            /* no section id - continue to next */
                                            if ( ! isset( $subsection['id'] ) || ! isset ( $subsection['title'] )  ) {
                                                continue;
                                            }
                                            
                                            /* check if setting is registered */
                                            echo '<li><a data-title="' , $subsection['title'] , '" data-panel="' , $subsection['id'] , '" href="#"><i class="fa fa-circle-o"></i>' , $subsection['title'] , '</a></li>';
                                            
                                        } ?>
                                    
                                    </ul>
                                        
                                 <?php } ?>
                                
                            </li>
                            
                        <?php $menu_counter++; } ?>
                        
                        </ul>
                        
                    </div>
                    <!-- Close UT-Backend-Navigation  -->
                    
                </div>
            
            <!-- Start UT-Backend-Main -->
            <div class="ut-admin-main">
               
                <!-- Start UT-Backend-Main-Content-Title -->
                <div class="grid-100">
                    
                    <!-- Start UT-Admin-Header
                    <header class="ut-admin-header clearfix">
                        
                        <h2 class="ut-admin-header-title">
                            Backend Topic Title
                            <span> Topic Title Description</span>
                        </h2>
                        
                    </header>
                    <!-- Cose UT-Admin-Header -->               
                    
                    <?php 
                    
                    $section_counter = 1;
                    
                    foreach( (array) $this->meta_box['sections'] as $key => $section ) {
                        
                        if( isset( $active_section ) && $active_section == $section['id'] ) {
            
                            $section_state_class = 'ut-show';
                        
                        } elseif( empty( $active_section ) && $section_counter == 1 ) {
                        
                            $section_state_class = 'loaded';
                            
                        } else {
                        
                            $section_state_class = 'ut-hide';
                        
                        }
                        
                        echo '<div class="ut-admin-panel-group ' , $section_state_class , '" id="' , $section['id'] , '">';
                            
                            $this->do_add_settings_field( $section['id'] );
                        
                        echo '</div>';
                        
                        $section_counter++;
                        
                    }
                   
                    ?>
                    
                </div>                    
                
            </div>
            <!-- Close UT-Admin-Main -->
            
            <div class="clear"></div>                
            
        </div>
        <!-- Close UT-Backend-Wrap -->
        
        <?php endif; ?> 
        
    <?php }  
    
    
    /**
     * Print out the settings fields for a particular settings section
     *
     *
     * @param     string    $section Slug title of the settings section who's fields you want to show.
     * @return    string
     *
     * @access    public
     * @since     1.0.0
     * @version   1.0.0
     */
    
    private function do_add_settings_field( $section ) {            
        
        global $post;
        
        foreach( (array) $this->meta_box['settings'] as $settings ) {
                        
            if( $section === $settings['section'] ) {
                
                $class = isset( $settings['class'] ) ? $settings['class'] : '';
                
                if( $settings['type'] == 'alert' ) {
                    
                    /* prepare options field settings */
                    $settings = ut_prepare_settings_field( $settings, 'meta_box', $this->meta_box['config']['id'] );
                    
                    /* call function to build option field */
                    $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                    
                    call_user_func( $function_by_type, $settings );
                        
                } else {
                    
                    echo '<section class="ut-admin-panel clearfix ' , esc_attr( $class ) , '">';
                                                
                        /* assign value */
                        $settings['value'] = get_post_meta( $post->ID, $settings['id'], true );
                         
                        /* prepare options field settings */
                        $settings = ut_prepare_settings_field( $settings, 'meta_box', $this->meta_box['config']['id'] );
                         
                        /* call function to build option field */
                        $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                        
                        if( function_exists( $function_by_type ) ) {
                            
                            $this->before_option_output( $settings );
                            
                                call_user_func( $function_by_type, $settings );
                            
                            $this->after_option_output( $settings );
                        
                        } else {
                        
                            esc_html_e( 'Function does not exist!', 'unite-admin' );
                            
                        }                        
                    
                    echo '</section>';
                
                }
                
            }
            
        }
                
    }
    
    private function before_option_output( $settings ) {
        
        echo '<header class="ut-admin-panel-header">';
            
            echo '<h3 class="ut-admin-panel-header-title">' , $settings['title'] , '</h3>';
            
            if( !empty( $settings['desc'] ) ) {
                
                echo '<span class="ut-admin-panel-description">' , $settings['desc'] , '</span>';
                                
            }
        
        echo '</header>';
    
    }        
    
    private function after_option_output( $settings ) {
           
            
    
    }
    
    /**
     * Save our metabox
     * @since     1.0.0
     * @version   1.0.0
     */
    public function save_meta_box( $post_id, $post_object ) {
        
        global $pagenow;
        
        /* check if nonce is set and correct */
        if ( isset( $_REQUEST[$this->meta_box['config']['id'] . '_nonce'] ) && ! wp_verify_nonce( $_REQUEST[$this->meta_box['config']['id'] . '_nonce'], $this->meta_box['config']['id'] ) ) {
            return $post_id;
        }
        
        /* check if viewing a revision */
        if ( $post_object->post_type == 'revision' || $pagenow == 'revision.php' ) {
            return $post_id;
        }        
        
        /* only proceed if current user has permissions */
        if ( $post_object->post_type == 'page' && current_user_can( 'edit_pages' ) || $post_object->post_type == 'post' && current_user_can( 'edit_posts' ) ) {
            
            if( isset( $_REQUEST[$this->meta_box['config']['id']] ) && is_array( $_REQUEST[$this->meta_box['config']['id']] ) ) {
                                                    
                /* sanitize metabox options */
                foreach( (array) $this->meta_box['settings'] as $settings_key => $setting ) {
                     
                    foreach( (array) $_REQUEST[$this->meta_box['config']['id']] as $request_key => $request_value ) {
                                                    
                        if( $setting['id'] == $request_key ) {
                            
                            /* sanitize field */
                            $sanitized_value = ut_sanitize_option( $request_value, $setting['type'], $request_key, 'meta_box', $this->meta_box['config']['id'] );
                            
                            /* handle meta data */
                            if( empty( $sanitized_value ) ) {
                                
                                /* delete post meta field */
                                delete_post_meta( $post_id, $setting['id'] );
                                
                            } else {
                                
                                if( get_post_meta( $post_id, $setting['id'] ) ) {
                                    
                                    /* update post meta field */
                                    update_post_meta( $post_id, $setting['id'], $sanitized_value );
                                
                                } else {
                                    
                                    /* add post meta field */
                                    add_post_meta( $post_id, $setting['id'], $sanitized_value );
                                
                                }
                            
                            }
                                
                        }
                    
                    } /* end request loop */
                
                } /* end settings loop */
            
            }
        
        }
    
    }        
    
    
    /**
     * Admin page CSS
     * @since     1.0.0
     * @version   1.0.0
     */
    public function register_metabox_admin_css() {
        
        /* admin ui css file */
        wp_register_style(
            'unite-metaboxes', 
            FW_WEB_ROOT . '/core/admin/assets/css/unite-metabox.css', 
            array('unite-admin'), 
            UT_VERSION
        );
        
        wp_enqueue_style('unite-metaboxes');
                       
    }
    
    /**
     * Admin page JS
     * @since     1.0.0
     * @version   1.0.0
     */
    public function register_metabox_admin_js() {
        
        /* unite metabox JavaScript */
        wp_register_script(
            'unite-metabox-js', 
            FW_WEB_ROOT . '/core/admin/assets/js/unite-metabox.js', 
            array('jquery'), 
            UT_VERSION
        );
        
        wp_enqueue_script('unite-metabox-js');
           
    }
    
        
} /* end class */

