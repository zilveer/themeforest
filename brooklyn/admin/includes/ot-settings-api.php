<?php if ( ! defined( 'OT_VERSION') ) exit( 'No direct script access allowed' );
/**
 * OptionTree Settings API
 *
 * This class loads all the methods and helpers specific to a Settings page.
 *
 * @package   OptionTree
 * @author    Derek Herman <derek@valendesigns.com>
 * @copyright Copyright (c) 2013, Derek Herman
 */
if ( ! class_exists( 'OT_Settings' ) ) {

  class OT_Settings {
    
    /* the options array */
    private $options;
    
    /* hooks for targeting admin pages */
    private $page_hook;
    
    /**
     * Constructor
     *
     * @param     array     An array of options
     * @return    void
     *
     * @access    public
     * @since     2.0
     */
    public function __construct( $args ) {
  
      $this->options = $args;
      
      /* return early if not viewing an admin page or no options */
      if ( ! is_admin() || ! is_array( $this->options ) )
        return false;
      
      /* load everything */
      $this->hooks();
      
    }
    
    /**
     * Execute the WordPress Hooks
     *
     * @return    void
     *
     * @access    public
     * @since     2.0
     */
    public function hooks() {
      
      /* add pages & menu items */
      add_action( 'admin_menu', array( $this, 'add_page' ) );
      
      /* register sections */
      add_action( 'admin_init', array( $this, 'add_sections' ) );
      
      /* register settings */
      add_action( 'admin_init', array( $this, 'add_settings' ) );
            
      /* initialize settings */
      add_action( 'admin_init', array( $this, 'initialize_settings' ), 11 );
      
    }
  
    /**
     * Loads each admin page
     *
     * @return    void
     *
     * @access    public
     * @since     2.0
     */
    public function add_page() {
      
      /* loop through options */
      foreach( (array) $this->options as $option ) {
         
        /* loop through pages */
        foreach( (array) $this->get_pages( $option ) as $page ) {
          
          /**
           * Theme Check... stop nagging me about this kind of stuff.
           * The damn admin pages are required for OT to function, duh!
           */
          $theme_check_bs   = 'add_menu_page';
          $theme_check_bs2  = 'add_submenu_page';
          
          /* load page in WP top level menu */
          if ( ! isset( $page['parent_slug'] ) || empty( $page['parent_slug'] ) ) {
            $page_hook = $theme_check_bs( 
              $page['page_title'], 
              $page['menu_title'], 
              $page['capability'], 
              $page['menu_slug'], 
              array( $this, 'display_page' ), 
              $page['icon_url'],
              $page['position'] 
            );
          /* load page in WP sub menu */
          } else {
            $page_hook = $theme_check_bs2( 
              $page['parent_slug'], 
              $page['page_title'], 
              $page['menu_title'], 
              $page['capability'], 
              $page['menu_slug'], 
              array( $this, 'display_page' ) 
            );
          }
          
          /* only load if not a hidden page */
          if ( ! isset( $page['hidden_page'] ) ) {
          
            /* associate $page_hook with page id */
            $this->page_hook[$page['id']] = $page_hook;
                        						
            /* add scripts */
            add_action( 'admin_print_scripts-' . $page_hook, array( $this, 'scripts' ) );
            
            /* add styles */
            add_action( 'admin_print_styles-' . $page_hook, array( $this, 'styles' ) );
          
          }
          
        }
      
      }
      
      return false;
    }
    
    /**
     * Loads the scripts
     *
     * @return    void
     *
     * @access    public
     * @since     2.0
     */
    public function scripts() {
        
        ot_admin_scripts();
        
    }
    
    /**
     * Loads the styles
     *
     * @return    void
     *
     * @access    public
     * @since     2.0
     */
    public function styles() {
        
        ot_admin_styles();
        
    }
    
    /**
     * Loads the content for each page
     *
     * @return    string
     *
     * @access    public
     * @since     2.0
     */
    public function display_page() {
      
      $screen = get_current_screen();
      
      /* loop through settings */
      foreach( (array) $this->options as $option ) {
  
        /* loop through pages */
        foreach( (array) $this->get_pages( $option ) as $page ) {
          
          /* verify page */
          if ( ! isset( $page['hidden_page'] ) && $screen->id == $this->page_hook[$page['id']] ) {
            
            $show_buttons = isset( $page['show_buttons'] ) && $page['show_buttons'] == false ? false : true;

            echo '<div class="wrap settings-wrap" id ="page-' . $page['id'] . '">';
  
                echo ot_alert_message( $page );
              
                settings_errors( 'option-tree' );
              
                /* remove forms on the custom settings pages */
                if ( $show_buttons ) {
                  
                  echo '<form action="options.php" method="post" id="option-tree-settings-api">';
      
                    settings_fields( $option['id'] );
                    
                } else {
                  
                  echo '<div id="option-tree-settings-api">';
                  
                }
                
                /* Sub Header */
                echo '<div id="option-tree-sub-header">';
                  
                if ( $show_buttons ) {
                  //echo '<a href="http://faq.unitedthemes.com/brooklyn/" target="_blank" class="option-tree-ui-button blue right">View Documentation</a>';
                  echo '<button class="option-tree-ui-button blue right save-settings">' . $page['button_text'] . '</button>';
                }
                echo '</div>';
				
                /* Navigation */
                echo '<div class="ui-tabs">';
                  
                /* check for sections */
                if ( isset( $page['sections'] ) && count( $page['sections'] ) > 0 ) {
                  
				  echo '<ul class="ui-tabs-nav">';
                  
                  echo '<li class="ut-admin-branding"><img src="'.THEME_WEB_ROOT.'/admin/assets/images/ut-emblem.png" alt="UnitedThemes"></li>';
				  
                  /* loop through page sections */
                  foreach( (array) $page['sections'] as $section ) {
                    
                    echo '<li id="tab_' . $section['id'] . '"><a href="#section_' . $section['id'] . '">';
					
                    if( !empty($section['icon']) ) {
						
                        if( strpos($section['icon'], '.png') ) {
                        
                            echo '<img class="ut-panel-png-icon" src="'.THEME_WEB_ROOT.'/admin/assets/images/panel_icons/'.$section['icon'].'">';
                        
                        } else {
                        
                            echo '<i class="fa '.$section['icon'].' fa-3x"></i>';
                        
                        }
                        
                        
					}
                    
					echo '<span class="icon-desc">' . $section['title'] . '</span>';
                    
					echo '</a>';
                    
                    echo '</li>';
                    
                  }
                  
                  echo '</ul>';
                  
                }
				 
                  /* sections */
                  echo '<div class="metabox-holder">';
                    
                    $this->do_settings_sections( $_GET['page'] );
                  
                  echo '</div>';
                  
                  echo '<div class="clear"></div>';
                  
                echo '</div>';
              
              echo $show_buttons ? '</form>' : '</div>';
			  
            echo '</div>';
            
            if( function_exists('ut_recognized_icons') ) : ?>
            
            <div class="ut-modal-option-tree">
                <div class="ut-modal-box-option-tree ut-admin">
                    
                    <div class="ut-modal-option-tree-header">
                        <div class="inner">
                            <h2><?php _e( 'Choose Icon' , 'unitedthemes' ); ?></h2>
                        </div>
                    </div>
                    
                    <div class="ut-modal-option-tree-body">
                        <div class="inner">
                            <ul class="ut-glyphicons">
                            
                            <?php foreach( ut_recognized_icons() as $key => $icon) {
                                                    
                                $icondisplay = ($icon == 'icon-noicon') ? 'no icon' : '<i class="fa '.$icon.'"></i>';
                                
                                echo '<li><span data-icon="'.$icon.'" class="ut-icon-option-tree">'.$icondisplay.'</span></li>';
                            
                            } ?>
                            
                            </ul>
                        </div>
                    </div>
                    
                    <div class="ut-modal-option-tree-footer">
                        <div class="inner">
                            <a href="#" class="close-ut-modal-option-tree"><?php _e( 'Close' , 'unitedthemes' ); ?></a>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <?php endif;
          
          }
        
        }
      
      }
      
      return false;
    }
    
    /**
     * Adds sections to the page
     *
     * @return    void
     *
     * @access    public
     * @since     2.0
     */
    public function add_sections() {
      
      /* loop through options */
      foreach( (array) $this->options as $option ) {
          
        /* loop through pages */
        foreach( (array) $this->get_pages( $option ) as $page ) {
          
          /* loop through page sections */
          foreach( (array) $this->get_sections( $page ) as $section ) {
            
            /* add each section */
            add_settings_section( 
              $section['id'], 
              $section['title'], 
              array( $this, 'display_section' ), 
              $page['menu_slug'] 
            );
            
          }
  
        }
        
      }
      
      return false;
    }
    
    /**
     * Callback for add_settings_section()
     *
     * @return    string
     *
     * @access    public
     * @since     2.0
     */
    public function display_section() {
      /* currently pointless */
    }
    
    /**
     * Add settings the the page
     *
     * @return    void
     *
     * @access    public
     * @since     2.0
     */
    public function add_settings() {
      
      /* loop through options */
      foreach( (array) $this->options as $option ) {
          
        register_setting( $option['id'], $option['id'], array ( $this, 'sanitize_callback' ) );
          
        /* loop through pages */
        foreach( (array) $this->get_pages( $option ) as $page ) {
          
          /* loop through page settings */
          foreach( (array) $this->get_the_settings( $page ) as $setting ) {
            
            /* skip if no setting ID */
            if ( ! isset( $setting['id'] ) )
              continue;
              
            /* add get_option param to the array */
            $setting['get_option']  = $option['id'];
            
            /* add each setting */
            add_settings_field( 
              $setting['id'], 
              $setting['label'], 
              array( $this, 'display_setting' ), 
              $page['menu_slug'],
              $setting['section'],
              $setting
            );
  
          }
  
        }
        
      }
      
      return false;
    }
    
    /**
     * Callback for add_settings_field() to build each setting by type
     *
     * @param     array     Setting object array
     * @return    string
     *
     * @access    public
     * @since     2.0
     */
    public function display_setting( $args = array() ) {
      extract( $args );
      
      /* get current saved data */
      $options = get_option( $get_option, false );
      
      // Set field value
      $field_value = isset( $options[$id] ) ? $options[$id] : '';
      
      /* set standard value */
      if ( isset( $std ) ) {  
        $field_value = ot_filter_std_value( $field_value, $std );
      }

      /* build the arguments array */
      $_args = array(
        'type'              => $type,
        'field_id'          => $id,
        'field_name'        => $get_option . '[' . $id . ']',
        'field_toplevel'    => isset( $toplevel ) && $toplevel ? $toplevel : '',
        'field_value'       => $field_value,
        'field_desc'        => isset( $desc ) ? $desc : '',
        'field_htmldesc'    => isset( $htmldesc ) ? $htmldesc : '',
        'field_std'         => isset( $std ) ? $std : '',
        'field_rows'        => isset( $rows ) && ! empty( $rows ) ? $rows : 15,
        'field_post_type'   => isset( $post_type ) && ! empty( $post_type ) ? $post_type : 'post',
        'field_taxonomy'    => isset( $taxonomy ) && ! empty( $taxonomy ) ? $taxonomy : 'category',
        'field_min_max_step'=> isset( $min_max_step ) && ! empty( $min_max_step ) ? $min_max_step : '0,100,1',
        'field_class'       => isset( $class ) ? $class : '',
        'field_choices'     => isset( $choices ) && ! empty( $choices ) ? $choices : array(),
        'field_settings'    => isset( $settings ) && ! empty( $settings ) ? $settings : array(),
        'field_mode'        => !empty( $mode ) ? $mode : 'hex',
        'post_id'           => ot_get_media_post_ID(),
        'get_option'        => $get_option,
      );
      
      /* get the option HTML */
      echo ot_display_by_type( $_args );
    }
    
    /**
     * Sets the option standards if nothing yet exists.
     *
     * @return    void
     *
     * @access    public
     * @since     2.0
     */
    public function initialize_settings() {
  
      /* loop through options */
      foreach( (array) $this->options as $option ) {
        
        /* skip if option is already set */
        if ( isset( $option['id'] ) && get_option( $option['id'], false ) ) {
          return false;
        }
        
        $defaults = array();
        
        /* loop through pages */
        foreach( (array) $this->get_pages( $option ) as $page ) {
            
          /* loop through page settings */
          foreach( (array) $this->get_the_settings( $page ) as $setting ) {
            
            if ( isset( $setting['std'] ) ) {
              
              $defaults[$setting['id']] = ot_validate_setting( $setting['std'], $setting['type'], $setting['id'] );

            }
  
          }
        
        }
          
        update_option( $option['id'], $defaults );        
        
      }
  
      return false;
    }
    
    /**
     * Sanitize callback for register_setting()
     *
     * @return    string
     *
     * @access    public
     * @since     2.0
     */
    public function sanitize_callback( $input ) {
              
      /* loop through options */
      foreach( (array) $this->options as $option ) {
          
        /* loop through pages */
        foreach( (array) $this->get_pages( $option ) as $page ) {
            
          /* loop through page settings */
          foreach( (array) $this->get_the_settings( $page ) as $setting ) {

            /* verify setting has a type & value */
            if ( isset( $setting['type'] ) && isset( $input[$setting['id']] ) ) {
              
              /* get the defaults */
              $current_settings = get_option( 'option_tree_settings' );
              $current_options = get_option( $option['id'] );
                
              /* validate setting */
              if ( is_array( $input[$setting['id']] ) && in_array( $setting['type'], array( 'list-item', 'slider' ) ) ) {

                /* required title setting */
                $required_setting = array(
                  array(
                    'id'        => 'title',
                    'label'     => __( 'Title', 'option-tree' ),
                    'desc'      => '',
                    'std'       => '',
                    'type'      => 'text',
                    'rows'      => '',
                    'class'     => 'option-tree-setting-title',
                    'post_type' => '',
                    'choices'   => array()
                  )
                );
                
                /* get the settings array */
                $settings = isset( $_POST[$setting['id'] . '_settings_array'] ) ? unserialize( ot_decode( $_POST[$setting['id'] . '_settings_array'] ) ) : array();
                
                /* settings are empty for some odd ass reason get the defaults */
                if ( empty( $settings ) ) {
                  $settings = 'slider' == $setting['type'] ? 
                  ot_slider_settings( $setting['id'] ) : 
                  ot_list_item_settings( $setting['id'] );
                }
                
                /* merge the two settings array */
                $settings = array_merge( $required_setting, $settings );
                
                /* create an empty WPML id array */
                $wpml_ids = array();
                
                foreach( $input[$setting['id']] as $k => $setting_array ) {

                  foreach( $settings as $sub_setting ) {
                    
                    /* setup the WPML ID */
                    $wpml_id = $setting['id'] . '_' . $sub_setting['id'] . '_' . $k;
                    
                    /* add id to array */
                    $wpml_ids[] = $wpml_id;
                      
                    /* verify sub setting has a type & value */
                    if ( isset( $sub_setting['type'] ) && isset( $input[$setting['id']][$k][$sub_setting['id']] ) ) {

                      /* validate setting */
                      $input[$setting['id']][$k][$sub_setting['id']] = ot_validate_setting( $input[$setting['id']][$k][$sub_setting['id']], $sub_setting['type'], $sub_setting['id'], $wpml_id );
                      
                    }
                    
                  }
                
                }

              } else {
                
                $input[$setting['id']] = ot_validate_setting( $input[$setting['id']], $setting['type'], $setting['id'], $setting['id'] );
                 
              }
            
            }
            
            /* unregister WPML strings that were deleted from lists and sliders */
            if ( isset( $current_settings['settings'] ) && isset( $setting['type'] ) && in_array( $setting['type'], array( 'list-item', 'slider' ) ) ) {
              
              if ( ! isset( $wpml_ids ) )
                $wpml_ids = array();
                
              foreach( $current_settings['settings'] as $check_setting ) {
              
                if ( $setting['id'] == $check_setting['id'] && ! empty( $current_options[$setting['id']] ) ) {
                
                  foreach( $current_options[$setting['id']] as $key => $value ) {
                
                    foreach( $value as $ckey => $cvalue ) {
                      
                      $id = $setting['id'] . '_' . $ckey . '_' . $key;
                      
                      if ( ! in_array( $id, $wpml_ids ) ) {
                      
                        ot_wpml_unregister_string( $id );
                        
                      }
                      
                    }
                  
                  }
                
                }
                
              }
              
            }
      
          }
        
        }
        
      }
      
      return $input;
      
    }
  
    /**
     * Helper function to get the pages array for an option
     *
     * @param     array     Option array
     * @return    mixed
     *
     * @access    public
     * @since     2.0
     */
    public function get_pages( $option = array() ) {
      
      if ( empty( $option ) )
        return false;
          
      /* check for pages */
      if ( isset( $option['pages'] ) && ! empty( $option['pages'] ) ) {
        
        /* return pages array */
        return $option['pages'];
        
      }
      
      return false;
    }
    
    /**
     * Helper function to get the sections array for a page
     *
     * @param     array     Page array
     * @return    mixed
     *
     * @access    public
     * @since     2.0
     */
    public function get_sections( $page = array() ) {
      
      if ( empty( $page ) )
        return false;
          
      /* check for sections */
      if ( isset( $page['sections'] ) && ! empty( $page['sections'] ) ) {
        
        /* return sections array */
        return $page['sections'];
        
      }
      
      return false;
    }
    
    /**
     * Helper function to get the settings array for a page
     *
     * @param     array     Page array
     * @return    mixed
     *
     * @access    public
     * @since     2.0
     */
    public function get_the_settings( $page = array() ) {
      
      if ( empty( $page ) )
        return false;
          
      /* check for settings */
      if ( isset( $page['settings'] ) && ! empty( $page['settings'] ) ) {
        
        /* return settings array */
        return $page['settings'];
        
      }
      
      return false;
    }
    
    /**
     * Prints out all settings sections added to a particular settings page
     *
     * @global    $wp_settings_sections   Storage array of all settings sections added to admin pages
     * @global    $wp_settings_fields     Storage array of settings fields and info about their pages/sections
     *
     * @param     string    The slug name of the page whos settings sections you want to output
     * @return    string
     *
     * @access    public
     * @since     2.0
     */
    public function do_settings_sections( $page ) {
      global $wp_settings_sections, $wp_settings_fields;
  
      if ( ! isset( $wp_settings_sections ) || ! isset( $wp_settings_sections[$page] ) ) {
        return false;
      }
  
      foreach ( (array) $wp_settings_sections[$page] as $section ) {
		
        if ( ! isset( $section['id'] ) )
          continue;
         
		if( $_GET['page'] != 'ot-settings' && $_GET['page'] != 'ot-documentation' ) :
		  				
			echo '<div id="section_' . $section['id'] . '" class="ui-tabs-panel">';
				
                echo '<div class="ui-tabs-inner-panel ui-tabs">';
			
				  call_user_func( $section['callback'], $section );
				
				  if ( ! isset( $wp_settings_fields ) || ! isset( $wp_settings_fields[$page] ) || ! isset( $wp_settings_fields[$page][$section['id']] ) )
					continue;
				  
				  
				  /* start sub navigation by united themes */
				  echo '<ul class="ui-tabs-nav ui-tabs-nav-sub">';
				  
				  foreach ( (array) $wp_settings_fields[$page][$section['id']] as $field ) {
															
					if( $field['args']['type'] == 'section_headline' && isset( $field['args']['subid'] ) ) {
						echo '<li id="tab_' . $field['args']['subid'] . '"><a href="#section_' . $field['args']['subid'] . '">' . $field['args']['label'] . '</a></li>';
					}
									 
				  }
				  
				  echo '</ul>';
				  /* end sub navigation by united themes */	
			  
			  
				  /* start sub panel by united themes */
				  foreach ( (array) $wp_settings_fields[$page][$section['id']] as $field ) {
															
					if( $field['args']['type'] == 'section_headline' && isset( $field['args']['subid'] ) ) {
						
						 echo '<div id="section_' . $field['args']['subid'] . '" class="ui-tabs-panel">';
							
							echo '<div class="inner">';
							
								$this->do_settings_fields( $page, $section['id'] , $field['args']['subid'] );
								
								echo '<div class="format-settings save-holder">';
								
									echo '<button class="option-tree-ui-button blue right save-settings">' . __( 'Save Changes', 'option-tree' ) . '</button>';
								
								echo '</div>';
															
							echo '</div>';
							
						 echo '</div>';
						
					}
									 
				  }
				  /* end sub panel by united themes */
				
				echo '</div>'; 
                          
			echo '</div>';
		
		else :
			 
			 echo '<div id="section_' . $section['id'] . '" class="ui-tabs-panel">';
			
			  call_user_func( $section['callback'], $section );
			
			  if ( ! isset( $wp_settings_fields ) || ! isset( $wp_settings_fields[$page] ) || ! isset( $wp_settings_fields[$page][$section['id']] ) )
				continue;
			  
			  echo '<div class="inside">';
			  
				$this->do_settings_fields_alt( $page, $section['id'] );
			  
			  echo '</div>';
			  
			echo '</div>';
		
		endif;
        
      }
      
    }
 	
    /**
     * Print out the settings fields for a particular settings section
     *
     * @global    $wp_settings_fields Storage array of settings fields and their pages/sections
     *
     * @param     string    $page Slug title of the admin page who's settings fields you want to show.
     * @param     string    $section Slug title of the settings section who's fields you want to show.
     * @return    string
     *
     * @access    public
     * @since     2.0
     */
    public function do_settings_fields( $page, $section, $subid ) {
      
	  global $wp_settings_fields;
    
      if ( !isset($wp_settings_fields) || !isset($wp_settings_fields[$page]) || !isset($wp_settings_fields[$page][$section]) )
        return;
		
      foreach ( (array) $wp_settings_fields[$page][$section] as $field ) {
        
		if( isset($field['args']['subsection']) && $field['args']['subsection'] == $subid ) {
				
			$section_headline_class = ( $field['args']['type'] == 'section_headline' ) ? 'format-settings-headline' : '';
            $section_headline_class = ( $field['args']['type'] == 'sub_section_headline' ) ? 'format-settings-subheadline' : $section_headline_class;
            $section_headline_class = ( $field['args']['type'] == 'section_headline_info' ) ? 'format-settings-headline-info' : $section_headline_class;
			
			echo '<section id="setting_' . $field['id'] . '" class="format-settings '.$section_headline_class.'">';
			  
				if ( $field['args']['type'] != 'section_headline' && $field['args']['type'] != 'sub_section_headline' && $field['args']['type'] != 'section_headline_info' && $field['args']['type'] != 'textblock' && ! empty( $field['title'] ) ) {
				
				  echo '<div class="format-setting-label">';
			  
					echo '<h3 class="label">' . $field['title'] . '</h3>';     
					
					/* verify a description */
					$has_desc = !empty($field['args']['desc']) ? true : false;
									
					/* description */
					echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field['args']['desc'] ) . '</div>' : '';
					
				  echo '</div>';
				
				}
		  
				call_user_func( $field['callback'], $field['args'] );
			  
			  echo '<div class="clear"></div>';
		
			echo '</section>';
		
		}
        
      }
      
    }
    
	public function do_settings_fields_alt( $page, $section ) {
    
        global $wp_settings_fields;
    
        if ( !isset($wp_settings_fields) || !isset($wp_settings_fields[$page]) || !isset($wp_settings_fields[$page][$section]) ) {
            return;        
        }
        
        foreach ( (array) $wp_settings_fields[$page][$section] as $field ) {
            
            echo '<div id="setting_' . $field['id'] . '" class="format-settings">';
              
              echo '<div class="format-setting-wrap">';
              
                if ( $field['args']['type'] != 'textblock' && ! empty( $field['title'] ) ) {
                
                  echo '<div class="format-setting-label">';
              
                    echo '<h3 class="label">' . $field['title'] . '</h3>';     
                
                  echo '</div>';
                
                }
          
                call_user_func( $field['callback'], $field['args'] );
              
              echo '</div>';
        
            echo '</div>';
            
        }
      
    }
    
  }

}

/**
 * This method instantiates the settings class & builds the UI.
 *
 * @uses     OT_Settings()
 *
 * @param    array    Array of arguments to create settings
 * @return   void
 *
 * @access   public
 * @since    2.0
 */
if ( ! function_exists( 'ot_register_settings' ) ) {

  function ot_register_settings( $args ) {
    if ( ! $args )
      return;
      
    $ot_settings = new OT_Settings( $args );
  }

}

/* End of file ot-settings-api.php */
/* Location: ./includes/ot-settings-api.php */