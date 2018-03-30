<?php if ( ! defined( 'OT_VERSION' ) ) exit( 'No direct script access allowed' );
/**
 * Functions used to build each option type.
 *
 * @package   OptionTree
 * @author    Derek Herman <derek@valendesigns.com>
 * @copyright Copyright (c) 2013, Derek Herman
 * @since     2.0
 */

/**
 * Builds the HTML for each of the available option types by calling those
 * function with call_user_func and passing the arguments to the second param.
 *
 * All fields are required!
 *
 * @param     array       $args The array of arguments are as follows:
 * @param     string      $type Type of option.
 * @param     string      $field_id The field ID.
 * @param     string      $field_name The field Name.
 * @param     mixed       $field_value The field value is a string or an array of values.
 * @param     string      $field_desc The field description.
 * @param     string      $field_std The standard value.
 * @param     string      $field_class Extra CSS classes.
 * @param     array       $field_choices The array of option choices.
 * @param     array       $field_settings The array of settings for a list item.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_display_by_type' ) ) {

  function ot_display_by_type( $args = array() ) {
    
    /* allow filters to be executed on the array */
    $args = apply_filters( 'ot_display_by_type', $args );
    
    /* build the function name */
    $function_name_by_type = str_replace( '-', '_', 'ot_type_' . $args['type'] );
    
    /* call the function & pass in arguments array */
    if ( function_exists( $function_name_by_type ) ) {
      call_user_func( $function_name_by_type, $args );
    } else {
      echo '<p>' . __( 'Sorry, this function does not exist', 'option-tree' ) . '</p>';
    }
    
  }
  
}

/**
 * Background option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_background' ) ) {
  
  function ot_type_background( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
	/* fallback if field was an upload field before */
	if( !is_array( $field_value ) && !empty( $field_value )  ) {
		
		/* store image url first */
		$background = $field_value;
		
		$field_value = array(
			'background-image' 		=> $background,
			'background-repeat' 	=> 'no-repeat',
			'background-attachment' => '',
			'background-position' 	=> '',
			'background-size'		=> 'cover'
		);
				
	}
	
    /* format setting outer wrapper */
    echo '<div class="format-setting type-background">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">'; 
        
        echo '<div class="select-group select-margin">';
        
          /* build background repeat */
          $background_repeat = isset( $field_value['background-repeat'] ) ? esc_attr( $field_value['background-repeat'] ) : '';
          echo '<select name="' . esc_attr( $field_name ) . '[background-repeat]" id="' . esc_attr( $field_id ) . '-repeat" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">' . __( 'background-repeat', 'option-tree' ) . '</option>';
            foreach ( ot_recognized_background_repeat( $field_id ) as $key => $value ) {
              echo '<option value="' . esc_attr( $key ) . '" ' . selected( $background_repeat, $key, false ) . '>' . esc_attr( $value ) . '</option>';
            }
          echo '</select>';
          
          /* build background attachment */
          $background_attachment = isset( $field_value['background-attachment'] ) ? esc_attr( $field_value['background-attachment'] ) : '';
          echo '<select name="' . esc_attr( $field_name ) . '[background-attachment]" id="' . esc_attr( $field_id ) . '-attachment" class="option-tree-ui-select ' . $field_class . '">';
            echo '<option value="">' . __( 'background-attachment', 'option-tree' ) . '</option>';
            foreach ( ot_recognized_background_attachment( $field_id ) as $key => $value ) {
              echo '<option value="' . esc_attr( $key ) . '" ' . selected( $background_attachment, $key, false ) . '>' . esc_attr( $value ) . '</option>';
            }
          echo '</select>';
          
          echo '<div class="clear"></div>';
          
          /* build background position */
          $background_position = isset( $field_value['background-position'] ) ? esc_attr( $field_value['background-position'] ) : '';
          echo '<select name="' . esc_attr( $field_name ) . '[background-position]" id="' . esc_attr( $field_id ) . '-position" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">' . __( 'background-position', 'option-tree' ) . '</option>';
            foreach ( ot_recognized_background_position( $field_id ) as $key => $value ) {
              echo '<option value="' . esc_attr( $key ) . '" ' . selected( $background_position, $key, false ) . '>' . esc_attr( $value ) . '</option>';
            }
          echo '</select>';
		  
		  /* build background size */
          $background_size = isset( $field_value['background-size'] ) ? esc_attr( $field_value['background-size'] ) : '';
          echo '<select name="' . esc_attr( $field_name ) . '[background-size]" id="' . esc_attr( $field_id ) . '-size" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">' . __( 'background-size', 'option-tree' ) . '</option>';
            foreach ( ot_recognized_background_size( $field_id ) as $key => $value ) {
              echo '<option value="' . esc_attr( $key ) . '" ' . selected( $background_size, $key, false ) . '>' . esc_attr( $value ) . '</option>';
            }
          echo '</select>';
		  
        
        echo '</div>';
        
        /* build background image */
        echo '<div class="option-tree-ui-upload-parent">';
          
          /* input */
          echo '<input type="text" name="' . esc_attr( $field_name ) . '[background-image]" id="' . esc_attr( $field_id ) . '" value="' . ( isset( $field_value['background-image'] ) ? esc_attr( $field_value['background-image'] ) : '' ) . '" class="widefat option-tree-ui-upload-input ' . esc_attr( $field_class ) . '" />';
          
          /* add media button */
          echo '<a href="javascript:void(0);" class="ot_upload_media option-tree-ui-button blue light" rel="' . $post_id . '" title="' . __( 'Add Media', 'option-tree' ) . '"><span class="icon upload">' . __( 'Add Media', 'option-tree' ) . '</span></a>';
        
        echo '</div>';
        
        /* media */
        if ( isset( $field_value['background-image'] ) && $field_value['background-image'] !== '' ) {
        
          echo '<div class="option-tree-ui-media-wrap" id="' . esc_attr( $field_id ) . '_media">';
          
            if ( preg_match( '/\.(?:jpe?g|png|gif|ico)$/i', $field_value['background-image'] ) )
              echo '<div class="option-tree-ui-image-wrap"><img src="' . esc_url( $field_value['background-image'] ) . '" alt="" /></div><div class="clear"></div>';
            
            echo '<a href="javascript:(void);" class="option-tree-ui-remove-media option-tree-ui-button red light" title="' . __( 'Remove Media', 'option-tree' ) . '"><span class="icon trash-can">' . __( 'Remove Media', 'option-tree' ) . '</span></a>';
            
          echo '</div>';
          
        }
      
      echo '</div>';

    echo '</div>';
    
  }
  
}

/**
 * Category Checkbox option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_category_checkbox' ) ) {
  
  function ot_type_category_checkbox( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-checkbox type-checkbox">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* get category array */
        $categories = get_categories( array( 'hide_empty' => false ) );
        
        /* build categories */
        if ( ! empty( $categories ) ) {
          foreach ( $categories as $category ) {
            echo '<div class="ut-checkbox">';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $category->term_id ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $category->term_id ) . '" value="' . esc_attr( $category->term_id ) . '" ' . ( isset( $field_value[$category->term_id] ) ? checked( $field_value[$category->term_id], $category->term_id, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $category->term_id ) . '">' . esc_attr( $category->name ) . '</label>';
            echo '</div><div class="clear"></div>';
          } 
        } else {
          echo '<p>' . __( 'No Categories Found', 'option-tree' ) . '</p>';
        }
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Category Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_category_select' ) ) {
  
  function ot_type_category_select( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-select">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build category */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* get category array */
        $categories = get_categories( array( 'hide_empty' => false ) );
        
        /* has cats */
        if ( ! empty( $categories ) ) {
          echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
          foreach ( $categories as $category ) {
            echo '<option value="' . esc_attr( $category->term_id ) . '"' . selected( $field_value, $category->term_id, false ) . '>' . esc_attr( $category->name ) . '</option>';
          }
        } else {
          echo '<option value="">' . __( 'No Categories Found', 'option-tree' ) . '</option>';
        }
        
        echo '</select>';
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Checkbox option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_checkbox' ) ) {
  
  function ot_type_checkbox( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );    
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-checkbox">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build checkbox */
        foreach ( (array) $field_choices as $key => $choice ) {
          if ( isset( $choice['value'] ) && isset( $choice['label'] ) ) {
            echo '<div class="ut-checkbox">';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $key ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '" value="' . esc_attr( $choice['value'] ) . '" ' . ( isset( $field_value[$key] ) ? checked( $field_value[$key], $choice['value'], false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '">' . esc_attr( $choice['label'] ) . '</label>';
            echo '</div><div class="clear"></div>';
          }
        }
      
      echo '</div>';

    echo '</div>';
    
  }
  
}

/**
 * Colorpicker option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_colorpicker' ) ) {
  
  function ot_type_colorpicker( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-colorpicker">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">'; 
        
        /* build colorpicker */  
        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
                  
          /* input */
          echo '<input data-mode="' . esc_attr( $field_mode ) . '" type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat ut-minicolors ut-color-mode-' . esc_attr( $field_mode ) . '  ption-tree-ui-input ' . esc_attr( $field_class ) . '" autocomplete="off" />';
                  
        echo '</div>';
      
      echo '</div>';

    echo '</div>';
    
  }
  
}

/**
 * Iconpicker option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     4.1
 */
if ( ! function_exists( 'ot_type_iconpicker' ) ) {
  
    function ot_type_iconpicker( $args = array() ) {
        
        /* turns arguments array into variables */
        extract( $args );
            
        /* format setting outer wrapper */
        echo '<div class="format-setting type-colorpicker">';
            
            /* format setting inner wrapper */
            echo '<div class="format-setting-inner">';
                
                /* build colorpicker */  
                echo '<div class="option-tree-ui-colorpicker-input-wrap">';
                
                    if( function_exists('ut_recognized_icons') ) {
                                                
                        echo '<select class="ut-icon-select" id="' , esc_attr( $field_id ) , '" name="' , esc_attr( $field_name ) , '">';
                            
                            echo '<option value="">' . esc_html__('Select Icon','unitedthemes') . '</option>';
                            
                            foreach( ut_recognized_icons() as $key => $icon ) {
                
                                 echo '<option value="fa ' , $icon , '" ' , selected( $field_value, 'fa ' . $icon, false ) , '>' , 'fa ' , $icon , '</option>';
                            
                            }
                        
                        echo '</select>';
                    
                    }
                
                 echo '</div>';
            
            echo '</div>';

        echo '</div>';             
        
    }

}


/**
 * Colorpicker option type. Connect to WordPress Customizer
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_colorpicker_customizer' ) ) {
  
  function ot_type_colorpicker_customizer( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* get value from WordPress Customizer */
    $field_value = get_option($field_id , '#F1C40F');    
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-colorpicker">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">'; 
        
        /* build colorpicker */  
        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
                 
          /* input */
          echo '<input maxlength="7" type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat ut-minicolors option-tree-ui-input ' . esc_attr( $field_class ) . '" autocomplete="off" />';
          
        echo '</div>';
      
      echo '</div>';

    echo '</div>';
    
  }
  
}

/**
 * Button Colorpicker option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_button_builder' ) ) {
  
  function ot_type_button_builder( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-button-builder">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">'; 
                
        /* build colorpicker for button color */  
        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
          
          /* input */
          echo '<label for="' . esc_attr( $field_id ) . '_color">' . __('Button Background Color' , 'unitedthemes') . '</label><br />';          
          echo '<input maxlength="7" type="text" name="' . esc_attr( $field_name ) . '[color]" id="' . esc_attr( $field_id ) . '_color" value="' . ( isset( $field_value['color'] ) ? esc_attr( $field_value['color'] ) : '' ) . '" class="widefat ut-minicolors option-tree-ui-input ' . esc_attr( $field_class ) . '" autocomplete="off" />';
          
        echo '</div>';
        
        
        /* build colorpicker for button hover color */  
        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
                    
          /* input */
          echo '<label for="' . esc_attr( $field_id ) . '_hover_color">' . __('Button Background Hover Color' , 'unitedthemes') . '</label><br />';
          echo '<input maxlength="7" type="text" name="' . esc_attr( $field_name ) . '[hover_color]" id="' . esc_attr( $field_id ) . '_hover_color" value="' . ( isset( $field_value['hover_color'] ) ? esc_attr( $field_value['hover_color'] ) : '' ) . '" class="widefat ut-minicolors option-tree-ui-input ' . esc_attr( $field_class ) . '" autocomplete="off" />';

        echo '</div>';
        
        echo '<hr />';        
        
        /* build colorpicker for button text color */  
        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
          
          /* input */
          echo '<label for="' . esc_attr( $field_id ) . '_text_color">' . __('Button Text Color' , 'unitedthemes') . '</label><br />';
          echo '<input maxlength="7" type="text" name="' . esc_attr( $field_name ) . '[text_color]" id="' . esc_attr( $field_id ) . '_text_color" value="' . ( isset( $field_value['text_color'] ) ? esc_attr( $field_value['text_color'] ) : '' ) . '" class="widefat ut-minicolors option-tree-ui-input ' . esc_attr( $field_class ) . '" autocomplete="off" />';
          
        echo '</div>';
        
        
        /* build colorpicker for button text hover color */  
        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
                    
          /* input */
          echo '<label for="' . esc_attr( $field_id ) . '_text_hover_color">' . __('Button Text Hover Color' , 'unitedthemes') . '</label><br />';
          echo '<input maxlength="7" type="text" name="' . esc_attr( $field_name ) . '[text_hover_color]" id="' . esc_attr( $field_id ) . '_text_hover_color" value="' . ( isset( $field_value['text_hover_color'] ) ? esc_attr( $field_value['text_hover_color'] ) : '' ) . '" class="widefat ut-minicolors option-tree-ui-input ' . esc_attr( $field_class ) . '" autocomplete="off" />';
          
        echo '</div>';
        
        echo '<hr />';
        
        echo '<div class="ot-numeric-slider-wrap">';
          
          echo '<label for="' . esc_attr( $field_id ) . '_border_radius">' . __('Button Border Radius' , 'unitedthemes') . '</label>';
          
          echo '<input type="hidden" name="' . esc_attr( $field_name ) . '[border_radius]" id="' . esc_attr( $field_id ) . '_border_radius" class="ot-numeric-slider-hidden-input" value="' . ( isset( $field_value['border_radius'] ) ? esc_attr( $field_value['border_radius'] ) : '' ) . '" data-min="0" data-max="50" data-step="1">';

          echo '<input type="text" class="ot-numeric-slider-helper-input widefat option-tree-ui-input" value="' . ( isset( $field_value['border_radius'] ) ? esc_attr( $field_value['border_radius'] ) : '' ) . '" readonly>';

          echo '<div id="ot_numeric_slider_' . esc_attr( $field_id ) . '_border_radius" class="ot-numeric-slider"></div>';

        echo '</div>';
        
        echo '<div class="clear"></div>';        
        
        echo '<hr />';
        
        /* build colorpicker for button border color */  
        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
                    
          /* input */
          echo '<label for="' . esc_attr( $field_id ) . '_border_color">' . __('Button Border Color' , 'unitedthemes') . '</label><br />';
          echo '<input maxlength="7" type="text" name="' . esc_attr( $field_name ) . '[border_color]" id="' . esc_attr( $field_id ) . '_border_color" value="' . ( isset( $field_value['border_color'] ) ? esc_attr( $field_value['border_color'] ) : '' ) . '" class="widefat ut-minicolors option-tree-ui-input ' . esc_attr( $field_class ) . '" autocomplete="off" />';

        echo '</div>';
        
        
        /* build colorpicker for button text hover color */  
        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
                    
          /* input */
          echo '<label for="' . esc_attr( $field_id ) . '_border_hover_color">' . __('Button Border Hover Color' , 'unitedthemes') . '</label><br />';
          echo '<input maxlength="7" type="text" name="' . esc_attr( $field_name ) . '[border_hover_color]" id="' . esc_attr( $field_id ) . '_border_hover_color" value="' . ( isset( $field_value['border_hover_color'] ) ? esc_attr( $field_value['border_hover_color'] ) : '' ) . '" class="widefat ut-minicolors option-tree-ui-input ' . esc_attr( $field_class ) . '" autocomplete="off" />';
          
        echo '</div>';        
        
        echo '<hr />';
        
        if( function_exists('ut_recognized_icons') ) :
        
            echo '<div class="ot-icon-chooser-wrap">';
                
                echo '<div class="ut-icon-preview"><i class="ut-preview-icon fa ' . ( isset( $field_value['icon'] ) ? esc_attr( $field_value['icon'] ) : '' ) . '"></i><a href="#" class="ut-delete-icon"><i class="fa fa-times-circle"></i></a></div>';
                echo '<input style="visibility:hidden;display:none;" type="text" name="' . esc_attr( $field_name ) . '[icon]" id="' . esc_attr( $field_id ) . '_icon" value="' . ( isset( $field_value['icon'] ) ? esc_attr( $field_value['icon'] ) : '' ) . '" class="widefat ut-minicolors option-tree-ui-input ' . esc_attr( $field_class ) . '" autocomplete="off" />';
                echo '<a class="ut-choose-icon option-tree-list-item-add option-tree-ui-button blue">Choose Icon</a>';
                    
            echo '</div>';        
        
        endif;
        
        echo '<div class="clear"></div>';
        
        echo '<hr />';
        
        $font_size = isset( $field_value['font-size'] ) ? esc_attr( $field_value['font-size'] ) : '';
        echo '<div class="ut-input-wrap">';
            echo '<label for="' . esc_attr( $field_id ) . '-font-size">' . __('Button Font Size' , 'unitedthemes') . '</label><br />';
            echo '<select name="' . esc_attr( $field_name ) . '[font-size]" id="' . esc_attr( $field_id ) . '-font-size" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
              echo '<option value="">font-size</option>';
              foreach( ot_recognized_font_sizes( $field_id ) as $option ) { 
                echo '<option value="' . esc_attr( $option ) . '" ' . selected( $font_size, $option, false ) . '>' . esc_attr( $option ) . '</option>';
              }
            echo '</select>';
        echo '</div>';   
        
        $text_transform = isset( $field_value['text-transform'] ) ? esc_attr( $field_value['text-transform'] ) : '';
        echo '<div class="ut-input-wrap">';
            echo '<label for="' . esc_attr( $field_id ) . '-text-transform">' . __('Button Text Transform' , 'unitedthemes') . '</label><br />';
            echo '<select name="' . esc_attr( $field_name ) . '[text-transform]" id="' . esc_attr( $field_id ) . '-text-transform" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
               echo '<option value="">text-transform</option>';
               foreach ( ot_recognized_text_transformations( $field_id ) as $key => $value ) {
                 echo '<option value="' . esc_attr( $key ) . '" ' . selected( $text_transform, $key, false ) . '>' . esc_attr( $value ) . '</option>';
               }
            echo '</select>';
        echo '</div>';
      
      echo '</div>';

    echo '</div>';
    
  }
  
}

/**
 * CSS option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_css' ) ) {
  
  function ot_type_css( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-css simple">';
           
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* build textarea for CSS */
        echo '<textarea class="textarea ' . esc_attr( $field_class ) . '" rows="' . esc_attr( $field_rows )  . '" cols="40" name="' . esc_attr( $field_name ) .'" id="' . esc_attr( $field_id ) . '">' . esc_textarea( $field_value ) . '</textarea>';
        
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Custom Post Type Checkbox option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_custom_post_type_checkbox' ) ) {
  
  function ot_type_custom_post_type_checkbox( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-custom-post-type-checkbox type-checkbox">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* setup the post types */
        $post_type = isset( $field_post_type ) ? explode( ',', $field_post_type ) : array( 'post' );

        /* query posts array */
        $my_posts = get_posts( apply_filters( 'ot_type_custom_post_type_checkbox_query', array( 'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ), $field_id ) );

        /* has posts */
        if ( is_array( $my_posts ) && ! empty( $my_posts ) ) {
          foreach( $my_posts as $my_post ){
            echo '<p>';
            echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $my_post->ID ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $my_post->ID ) . '" value="' . esc_attr( $my_post->ID ) . '" ' . ( isset( $field_value[$my_post->ID] ) ? checked( $field_value[$my_post->ID], $my_post->ID, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
            echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $my_post->ID ) . '">' . $my_post->post_title . '</label>';
            echo '</p>';
          }
        } else {
          echo '<p>' . __( 'No Posts Found', 'option-tree' ) . '</p>';
        }
        
      echo '</div>';

    echo '</div>';
    
  }
  
}

/**
 * Custom Post Type Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_custom_post_type_select' ) ) {
  
  function ot_type_custom_post_type_select( $args = array() ) {

    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-custom-post-type-select">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* build category */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* setup the post types */
        $post_type = isset( $field_post_type ) ? explode( ',', $field_post_type ) : array( 'post' );
        
        /* query posts array */
        $my_posts = get_posts( apply_filters( 'ot_type_custom_post_type_select_query', array( 'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ), $field_id ) );
        
        /* has posts */
        if ( is_array( $my_posts ) && ! empty( $my_posts ) ) {
          echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
          foreach( $my_posts as $my_post ){
            echo '<option value="' . esc_attr( $my_post->ID ) . '"' . selected( $field_value, $my_post->ID, false ) . '>' . esc_attr( $my_post->post_title ) . '</option>';
          }
        } else {
          echo '<option value="">' . __( 'No Posts Found', 'option-tree' ) . '</option>';
        }
        
        echo '</select>';
        
      echo '</div>';

    echo '</div>';
    
  }
  
}

/**
 * List Item option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_list_item' ) ) {
  
  function ot_type_list_item( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
	
    /* format setting outer wrapper */
    echo '<div class="format-setting type-list-item">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* pass the settings array arround */
        echo '<input type="hidden" name="' . esc_attr( $field_id ) . '_settings_array" id="' . esc_attr( $field_id ) . '_settings_array" value="' . ot_encode( serialize( $field_settings ) ) . '" />';
        
        /** 
         * settings pages have array wrappers like 'option_tree'.
         * So we need that value to create a proper array to save to.
         * This is only for NON metaboxes settings.
         */
        if ( ! isset( $get_option ) )
          $get_option = '';
          
        /* build list items */
        echo '<ul class="option-tree-setting-wrap option-tree-sortable" data-name="' . esc_attr( $field_id ) . '" data-id="' . esc_attr( $post_id ) . '" data-get-option="' . esc_attr( $get_option ) . '" data-type="' . esc_attr( $type ) . '">';
        
        if ( is_array( $field_value ) && ! empty( $field_value ) ) {
        
          foreach( $field_value as $key => $list_item ) {
            if( array_filter($list_item) ) {
            echo '<li class="ui-state-default list-list-item">';
              ot_list_item_view( $field_id, $key, $list_item, $post_id, $get_option, $field_settings, $type );
            echo '</li>';
            }
          }
          
        }
        
        echo '</ul>';
        
        /* button */
        echo '<a href="javascript:void(0);" class="option-tree-list-item-add option-tree-ui-button blue right hug-right" title="' . __( 'Add New', 'option-tree' ) . '">' . __( 'Add New', 'option-tree' ) . '</a>';
        
        /* description */
        echo '<div class="list-item-description">' . apply_filters( 'ot_list_item_description', __( 'You can re-order with drag & drop, the order will update after saving.', 'option-tree' ), $field_id ) . '</div>';
      
      echo '</div>';

    echo '</div>';
    
  }
  
}

/**
 * Measurement option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_measurement' ) ) {
  
  function ot_type_measurement( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-measurement">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        echo '<div class="option-tree-ui-measurement-input-wrap">';
        
          echo '<input type="text" name="' . esc_attr( $field_name ) . '[0]" id="' . esc_attr( $field_id ) . '-0" value="' . ( isset( $field_value[0] ) ? esc_attr( $field_value[0] ) : '' ) . '" class="widefat option-tree-ui-input ' . esc_attr( $field_class ) . '" />';
        
        echo '</div>';
        
        /* build measurement */
        echo '<select name="' . esc_attr( $field_name ) . '[1]" id="' . esc_attr( $field_id ) . '-1" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
          
          echo '<option value="">&nbsp;--&nbsp;</option>';
          
          foreach ( ot_measurement_unit_types( $field_id ) as $unit ) {
            echo '<option value="' . esc_attr( $unit ) . '"' . selected( $field_value[1], $unit, false ) . '>' . esc_attr( $unit ) . '</option>';
          }
          
        echo '</select>';
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Numeric Slider option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.1
 */
if( ! function_exists( 'ot_type_numeric_slider' ) ) {

  function ot_type_numeric_slider( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    $_options = explode( ',', $field_min_max_step );
    $min = isset( $_options[0] ) ? $_options[0] : 0;
    $max = isset( $_options[1] ) ? $_options[1] : 100;
    $step = isset( $_options[2] ) ? $_options[2] : 1;

    /* format setting outer wrapper */
    echo '<div class="format-setting type-numeric-slider">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';

        echo '<div class="ot-numeric-slider-wrap">';

          echo '<input type="hidden" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="ot-numeric-slider-hidden-input" value="' . esc_attr( $field_value ) . '" data-min="' . esc_attr( $min ) . '" data-max="' . esc_attr( $max ) . '" data-step="' . esc_attr( $step ) . '">';

          echo '<input type="text" class="ot-numeric-slider-helper-input widefat option-tree-ui-input" value="' . esc_attr( $field_value ) . '" readonly>';

          echo '<div id="ot_numeric_slider_' . esc_attr( $field_id ) . '" class="ot-numeric-slider"></div>';

        echo '</div>';
      
      echo '</div>';
      
    echo '</div>';
  }

}

/**
 * Page Checkbox option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_page_checkbox' ) ) {
  
  function ot_type_page_checkbox( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-page-checkbox type-checkbox">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';

      /* query pages array */
      $my_posts = get_posts( apply_filters( 'ot_type_page_checkbox_query', array( 'post_type' => array( 'page' ), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ), $field_id ) );

      /* has pages */
      if ( is_array( $my_posts ) && ! empty( $my_posts ) ) {
        foreach( $my_posts as $my_post ){
          echo '<p>';
            echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $my_post->ID ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $my_post->ID ) . '" value="' . esc_attr( $my_post->ID ) . '" ' . ( isset( $field_value[$my_post->ID] ) ? checked( $field_value[$my_post->ID], $my_post->ID, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
            echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $my_post->ID ) . '">' . $my_post->post_title . '</label>';
          echo '</p>';
        }
      } else {
        echo '<p>' . __( 'No Pages Found', 'option-tree' ) . '</p>';
      }
      
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Page Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_page_select' ) ) {
  
  function ot_type_page_select( $args = array() ) {

    /* turns arguments array into variables */
    extract( $args );
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-page-select">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build page select */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* query pages array */
        $my_posts = get_posts( apply_filters( 'ot_type_page_select_query', array( 'post_type' => array( 'page' ), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ), $field_id ) );
        
        /* has pages */
        if ( is_array( $my_posts ) && ! empty( $my_posts ) ) {
          echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
          foreach( $my_posts as $my_post ) {
            echo '<option value="' . esc_attr( $my_post->ID ) . '"' . selected( $field_value, $my_post->ID, false ) . '>' . esc_attr( $my_post->post_title ) . '</option>';
          }
        } else {
          echo '<option value="">' . __( 'No Pages Found', 'option-tree' ) . '</option>';
        }
        
        echo '</select>';
        
      echo '</div>';

    echo '</div>';
    
  }
  
}

/**
 * Section Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
 
if ( ! function_exists( 'ot_type_section_select' ) ) {
  
  function ot_type_section_select( $args = array() ) {

    /* turns arguments array into variables */
    extract( $args );
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-page-select">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      	
		/* only query pages which are sections */
		if ( has_nav_menu( 'primary' ) ) :
		
			$args = ut_prepare_front_query();
				  
			/* build page select */
			echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
			
			/* query pages array */
			$my_posts = get_posts( apply_filters( 'ot_type_page_select_query', $args , $field_id ) );
			
			/* has pages */
			if ( is_array( $my_posts ) && ! empty( $my_posts ) ) {
			  echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
			  foreach( $my_posts as $my_post ) {
				echo '<option value="' . esc_attr( $my_post->ID ) . '"' . selected( $field_value, $my_post->ID, false ) . '>' . esc_attr( $my_post->post_title ) . '</option>';
			  }
			} else {
			  echo '<option value="">' . __( 'No Pages Found', 'option-tree' ) . '</option>';
			}
        
		else : 
		
			echo _e( 'Information: There are no Pages are assigned to the menu yet or the assigned pages are not set to menutype "Section"! Please read the delivered documentation carefully. We recommend to start with the "Start from Scratch Setup" documentation part.' , 'unitedthemes' );
		
		endif;
		
		
        echo '</select>';
        
      echo '</div>';

    echo '</div>';
    
  }
  
}


/**
 * List Item option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_slider' ) ) {
  
  function ot_type_slider( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-slider">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* pass the settings array arround */
        echo '<input type="hidden" name="' . esc_attr( $field_id ) . '_settings_array" id="' . esc_attr( $field_id ) . '_settings_array" value="' . ot_encode( serialize( $field_settings ) ) . '" />';
        
        /** 
         * settings pages have array wrappers like 'option_tree'.
         * So we need that value to create a proper array to save to.
         * This is only for NON metaboxes settings.
         */
        if ( ! isset( $get_option ) )
          $get_option = '';
          
        /* build list items */
        echo '<ul class="option-tree-setting-wrap option-tree-sortable" data-name="' . esc_attr( $field_id ) . '" data-id="' . esc_attr( $post_id ) . '" data-get-option="' . esc_attr( $get_option ) . '" data-type="' . esc_attr( $type ) . '">';
        
        if ( is_array( $field_value ) && ! empty( $field_value ) ) {
        
          foreach( $field_value as $key => $list_item ) {
            
            echo '<li class="ui-state-default list-list-item">';
              ot_list_item_view( $field_id, $key, $list_item, $post_id, $get_option, $field_settings, $type );
            echo '</li>';
            
          }
          
        }
        
        echo '</ul>';
        
        /* button */
        echo '<a href="javascript:void(0);" class="option-tree-list-item-add option-tree-ui-button blue right hug-right" title="' . __( 'Add New', 'option-tree' ) . '">' . __( 'Add New', 'option-tree' ) . '</a>';
        
        /* description */
        echo '<div class="list-item-description">' . __( 'You can re-order with drag & drop, the order will update after saving.', 'option-tree' ) . '</div>';
      
      echo '</div>';

    echo '</div>';
    
  }
  
}

/**
 * Post Checkbox option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_post_checkbox' ) ) {
  
  function ot_type_post_checkbox( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-post-checkbox type-checkbox">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* query posts array */
        $my_posts = get_posts( apply_filters( 'ot_type_post_checkbox_query', array( 'post_type' => array( 'post' ), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ), $field_id ) );
        
        /* has posts */
        if ( is_array( $my_posts ) && ! empty( $my_posts ) ) {
          foreach( $my_posts as $my_post ){
            echo '<p>';
            echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $my_post->ID ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $my_post->ID ) . '" value="' . esc_attr( $my_post->ID ) . '" ' . ( isset( $field_value[$my_post->ID] ) ? checked( $field_value[$my_post->ID], $my_post->ID, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
            echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $my_post->ID ) . '">' . esc_attr( $my_post->post_title ) . '</label>';
            echo '</p>';
          } 
        } else {
          echo '<p>' . __( 'No Posts Found', 'option-tree' ) . '</p>';
        }
        
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Post Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_post_select' ) ) {
  
  function ot_type_post_select( $args = array() ) {

    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-post-select">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build page select */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* query posts array */
        $my_posts = get_posts( apply_filters( 'ot_type_post_select_query', array( 'post_type' => array( 'post' ), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ), $field_id ) );
        
        /* has posts */
        if ( is_array( $my_posts ) && ! empty( $my_posts ) ) {
          echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
          foreach( $my_posts as $my_post ){
            echo '<option value="' . esc_attr( $my_post->ID ) . '"' . selected( $field_value, $my_post->ID, false ) . '>' . esc_attr( $my_post->post_title ) . '</option>';
          }
        } else {
          echo '<option value="">' . __( 'No Posts Found', 'option-tree' ) . '</option>';
        }
        
        echo '</select>';
        
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Radio option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_radio' ) ) {
  
  function ot_type_radio( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-radio">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build radio */
        foreach ( (array) $field_choices as $key => $choice ) {
          echo '<p><input type="radio" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '" value="' . esc_attr( $choice['value'] ) . '"' . checked( $field_value, $choice['value'], false ) . ' class="radio option-tree-ui-radio ' . esc_attr( $field_class ) . '" /><label for="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '">' . esc_attr( $choice['label'] ) . '</label></p>';
        }
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Radio option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_radio_group' ) ) {
  
  function ot_type_radio_group( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-radio">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner ot-type-radio-group" data-group="' . esc_attr( $field_name ) . '">';
      
        /* build radio */
        foreach ( (array) $field_choices as $key => $choice ) {
          echo '<p><input data-for="' . esc_attr( implode(',' , $choice['for'] ) ) . '" type="radio" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '" value="' . esc_attr( $choice['value'] ) . '"' . checked( $field_value, $choice['value'], false ) . ' class="radio option-tree-ui-radio option-tree-ui-group-radio ' . esc_attr( $field_class ) . ' ' . ( isset($field_toplevel) && $field_toplevel ? 'ut-toplevel-radio-option' : '' ) . '" /><label for="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '">' . esc_attr( $choice['label'] ) . '</label></p>';
        }
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

if ( ! function_exists( 'ot_type_radio_group_button' ) ) {
  
  function ot_type_radio_group_button( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-radio">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner ot-type-radio-group" data-group="' . esc_attr( $field_name ) . '">';
        
        /* build buttons */
        echo '<div class="ut-radio-button-group">';
            
            foreach ( (array) $field_choices as $key => $choice ) {
                
                $custom_class = !empty( $choice['class'] ) ? $choice['class'] : '';
                
                $selected = ( $field_value == $choice['value'] ) ? 'selected' : '';
                echo '<a href="#" data-for="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '" title="' . esc_attr( $choice['label'] ) . '" class="ut-radio-button '.$selected.' '.$custom_class.'">' . esc_attr( $choice['label'] ) . '</a>';  
              
            }
                        
            if( !empty($field_desc) ) {
                echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';
            }  
              
        echo '</div>';
        
        /* build radio */
        foreach ( (array) $field_choices as $key => $choice ) {
          echo '<p style="display: none;"><input data-for="' . esc_attr( implode(',' , $choice['for'] ) ) . '" type="radio" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '" value="' . esc_attr( $choice['value'] ) . '"' . checked( $field_value, $choice['value'], false ) . ' class="radio option-tree-ui-radio option-tree-ui-group-radio ' . esc_attr( $field_class ) . '" /><label for="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '">' . esc_attr( $choice['label'] ) . '</label></p>';
        }
        
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Radio Images option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_radio_image' ) ) {
  
  function ot_type_radio_image( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-radio-image">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /**
         * load the default filterable images if nothing 
         * has been set in the choices array.
         */
        if ( empty( $field_choices ) )
          $field_choices = ot_radio_images( $field_id );
          
        /* build radio image */
        foreach ( (array) $field_choices as $key => $choice ) {
          
          $src = str_replace( 'OT_URL', OT_URL, $choice['src'] );
          $src = str_replace( 'OT_THEME_URL', OT_THEME_URL, $src );
          
          echo '<div class="option-tree-ui-radio-images">';
            echo '<p style="display:none"><input type="radio" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '" value="' . esc_attr( $choice['value'] ) . '"' . checked( $field_value, $choice['value'], false ) . ' class="option-tree-ui-radio option-tree-ui-images" /><label for="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '">' . esc_attr( $choice['label'] ) . '</label></p>';
            echo '<img src="' . esc_url( $src ) . '" alt="' . esc_attr( $choice['label'] ) .'" title="' . esc_attr( $choice['label'] ) .'" class="option-tree-ui-radio-image ' . esc_attr( $field_class ) . ( $field_value == $choice['value'] ? ' option-tree-ui-radio-image-selected' : '' ) . '" />';
          echo '</div>';
        }
        
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_select' ) ) {
  
  function ot_type_select( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-select">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* fallback for older version */
        if( is_array( $field_value ) ) {
            $field_value = implode("", $field_value);
        }        
        
        /* build select */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
        foreach ( (array) $field_choices as $choice ) {
          if ( isset( $choice['value'] ) && isset( $choice['label'] ) ) {
            echo '<option value="' . esc_attr( $choice['value'] ) . '"' . selected( $field_value, $choice['value'], false ) . '>' . esc_attr( $choice['label'] ) . '</option>';
          }
        }
        
        echo '</select>';
        
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Select option type for groups.
 */
if ( ! function_exists( 'ot_type_select_group' ) ) {
  
  function ot_type_select_group( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args ); 
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-select">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner" data-group="' . esc_attr( $field_name ) . '">';
        
        /* fallback for older version */
        if( is_array( $field_value ) ) {
            $field_value = implode("", $field_value);
        }
        
        /* build select */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select option-tree-ui-group-select ' . esc_attr( $field_class ) . ' ' . ( isset($field_toplevel) && $field_toplevel ? 'ut-toplevel-select-option' : '' ) . '">';
        foreach ( (array) $field_choices as $choice ) {
          if ( isset( $choice['value'] ) && isset( $choice['label'] ) ) {
            echo '<option class="select-group-option-' . esc_attr( $choice['value'] ) . '" data-orglabel="' . esc_attr( $choice['label'] ) . '" data-altlabel="' . ( isset($choice['alt_label']) ? esc_attr( $choice['alt_label'] ) : '' ) . '" data-for="' . ( isset($choice['for']) && is_array($choice['for']) ? esc_attr( implode(',' , $choice['for'] ) ) : '' ) . '" value="' . esc_attr( $choice['value'] ) . '"' . selected( $field_value, $choice['value'], false ) . '>' . esc_attr( $choice['label'] ) . '</option>';
          }
        }
        
        echo '</select>';
        
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Sidebar Select option type.
 *
 * This option type makes it possible for users to select a WordPress registered sidebar 
 * to use on a specific area. By using the two provided filters, 'ot_recognized_sidebars', 
 * and 'ot_recognized_sidebars_{$field_id}' we can be selective about which sidebars are 
 * available on a specific content area.
 *
 * For example, if we create a WordPress theme that provides the ability to change the 
 * Blog Sidebar and we don't want to have the footer sidebars available on this area, 
 * we can unset those sidebars either manually or by using a regular expression if we 
 * have a common name like footer-sidebar-$i.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.1
 */
if ( ! function_exists( 'ot_type_sidebar_select' ) ) {
  
  function ot_type_sidebar_select( $args = array() ) {
  
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-sidebar-select">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build page select */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';

        /* get the registered sidebars */
        global $wp_registered_sidebars;

        $sidebars = array();
        foreach( $wp_registered_sidebars as $id=>$sidebar ) {
          $sidebars[ $id ] = $sidebar[ 'name' ];
        }

        /* filters to restrict which sidebars are allowed to be selected, for example we can restrict footer sidebars to be selectable on a blog page */
        $sidebars = apply_filters( 'ot_recognized_sidebars', $sidebars );
        $sidebars = apply_filters( 'ot_recognized_sidebars_' . $field_id, $sidebars );

        /* has sidebars */
        if ( count( $sidebars ) ) {
          echo '<option value="">-- ' . __( 'Choose Sidebar', 'option-tree' ) . ' --</option>';
          foreach ( $sidebars as $id => $sidebar ) {
            echo '<option value="' . esc_attr( $id ) . '"' . selected( $field_value, $id, false ) . '>' . esc_attr( $sidebar ) . '</option>';
          }
        } else {
          echo '<option value="">' . __( 'No Sidebars', 'option-tree' ) . '</option>';
        }
        
        echo '</select>';
        
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Tag Checkbox option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_tag_checkbox' ) ) {
  
  function ot_type_tag_checkbox( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-tag-checkbox type-checkbox">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* get tags */
        $tags = get_tags( array( 'hide_empty' => false ) );
        
        /* has tags */
        if ( $tags ) {
          foreach( $tags as $tag ) {
            echo '<p>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $tag->term_id ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $tag->term_id ) . '" value="' . esc_attr( $tag->term_id ) . '" ' . ( isset( $field_value[$tag->term_id] ) ? checked( $field_value[$tag->term_id], $tag->term_id, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $tag->term_id ) . '">' . esc_attr( $tag->name ) . '</label>';
            echo '</p>';
          } 
        } else {
          echo '<p>' . __( 'No Tags Found', 'option-tree' ) . '</p>';
        }
        
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Tag Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_tag_select' ) ) {
  
  function ot_type_tag_select( $args = array() ) {

    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-tag-select">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build tag select */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* get tags */
        $tags = get_tags( array( 'hide_empty' => false ) );
        
        /* has tags */
        if ( $tags ) {
          echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
          foreach( $tags as $tag ) {
            echo '<option value="' . esc_attr( $tag->term_id ) . '"' . selected( $field_value, $tag->term_id, false ) . '>' . esc_attr( $tag->name ) . '</option>';
          }
        } else {
          echo '<option value="">' . __( 'No Tags Found', 'option-tree' ) . '</option>';
        }
        
        echo '</select>';
      
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Taxonomy Checkbox option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_taxonomy_checkbox' ) ) {
  
  function ot_type_taxonomy_checkbox( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-taxonomy-checkbox type-checkbox">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* setup the taxonomy */
        $taxonomy = isset( $field_taxonomy ) ? explode( ',', $field_taxonomy ) : array( 'category' );
        
        /* get taxonomies */
        $taxonomies = get_categories( array( 'hide_empty' => false, 'taxonomy' => $taxonomy ) );
        
        /* has tags */
        if ( $taxonomies ) {
          foreach( $taxonomies as $taxonomy ) {
            echo '<p>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $taxonomy->term_id ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $taxonomy->term_id ) . '" value="' . esc_attr( $taxonomy->term_id ) . '" ' . ( isset( $field_value[$taxonomy->term_id] ) ? checked( $field_value[$taxonomy->term_id], $taxonomy->term_id, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $taxonomy->term_id ) . '">' . esc_attr( $taxonomy->name ) . '</label>';
            echo '</p>';
          } 
        } else {
          echo '<p>' . __( 'No Taxonomies Found', 'option-tree' ) . '</p>';
        }
        
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Taxonomy Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_taxonomy_select' ) ) {
  
  function ot_type_taxonomy_select( $args = array() ) {

    /* turns arguments array into variables */
    extract( $args );
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-tag-select">';
           
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build tag select */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* setup the taxonomy */
        $taxonomy = isset( $field_taxonomy ) ? explode( ',', $field_taxonomy ) : array( 'category' );
        
        /* get taxonomies */
        $taxonomies = get_categories( array( 'hide_empty' => false, 'taxonomy' => $taxonomy ) );
        
        /* has tags */
        if ( $taxonomies ) {
          echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
          foreach( $taxonomies as $taxonomy ) {
            echo '<option value="' . esc_attr( $taxonomy->term_id ) . '"' . selected( $field_value, $taxonomy->term_id, false ) . '>' . esc_attr( $taxonomy->name ) . '</option>';
          }
        } else {
          echo '<option value="">' . __( 'No Taxonomies Found', 'option-tree' ) . '</option>';
        }
        
        echo '</select>';
      
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Text option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_text' ) ) {
  
  function ot_type_text( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-text">';
           
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build text input */
        echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat option-tree-ui-input ' . esc_attr( $field_class ) . '" />';
        
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Textarea option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_textarea' ) ) {
  
  function ot_type_textarea( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textarea fill-area">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* create a min height due to a minor bug since WP4.0*/
        echo '<style type="text/css">#'.$field_id.'_ifr {min-height:350px;}</style>';
        
        /* build textarea */
        wp_editor( 
          $field_value, 
          esc_attr( $field_id ), 
          array(
            'editor_class'  => esc_attr( $field_class ),
            'wpautop'       => apply_filters( 'ot_wpautop', false, $field_id ),
            'media_buttons' => apply_filters( 'ot_media_buttons', true, $field_id ),
            'textarea_name' => esc_attr( $field_name ),
            'textarea_rows' => esc_attr( $field_rows ),
            'tinymce'       => apply_filters( 'ot_tinymce', true, $field_id ),              
            'quicktags'     => apply_filters( 'ot_quicktags', array( 'buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,spell,close' ), $field_id )
          ) 
        );
        
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Textarea Simple option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_textarea_simple' ) ) {
  
  function ot_type_textarea_simple( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textarea simple">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* filter to allow wpautop */
        $wpautop = apply_filters( 'ot_wpautop', false, $field_id );
        
        /* wpautop $field_value */
        if ( $wpautop == true ) 
          $field_value = wpautop( $field_value );
        
        /* build textarea simple */
        echo '<textarea class="textarea ' . esc_attr( $field_class ) . '" rows="' . esc_attr( $field_rows )  . '" cols="40" name="' . esc_attr( $field_name ) .'" id="' . esc_attr( $field_id ) . '">' . esc_textarea( $field_value ) . '</textarea>';
        
        if(!empty($field_htmldesc)) {
            echo '<pre>' . $field_htmldesc . '</pre>';
        }
        
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Textblock option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_textblock' ) ) {
  
  function ot_type_textblock( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textblock wide-desc ' . esc_attr( $field_class ) . '">';
      
      /* description */
      echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Sectionheadline option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_section_headline' ) ) {
  
  function ot_type_section_headline( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textblock wide-desc ' . esc_attr( $field_class ) . '">';
      
      /* description */
      echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Subsectionheadline option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     4.1
 */
if ( ! function_exists( 'ot_type_sub_section_headline' ) ) {
  
  function ot_type_sub_section_headline( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textblock wide-desc ' . esc_attr( $field_class ) . '">';
      
      /* description */
      echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * sectionheadline info option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_section_headline_info' ) ) {
  
  function ot_type_section_headline_info( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textblock wide-desc ' . esc_attr( $field_class ) . '">';
      
      /* description */
      echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Textblock Titled option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_textblock_titled' ) ) {
  
  function ot_type_textblock_titled( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textblock titled wide-desc ' . esc_attr( $field_class ) . '">';
      
      /* description */
      echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';
      
    echo '</div>';
    
  }
  
}


/**
 * Easing Effect for different purposes
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_easing' ) ) {
  
  	function ot_type_easing( $args = array() ) {
		
		/* turns arguments array into variables */
		extract( $args );
		
		/* format setting outer wrapper */
	    echo '<div class="format-setting type-easing">';
			
			/* format setting inner wrapper */
			echo '<div class="format-setting-inner">';
				
				/* allow fields to be filtered */
				$ot_recognized_easing_fields = apply_filters( 'ot_recognized_easing_fields', array( 
				  'easing',
				), $field_id );
				
				/* build font easing dropdown */
				if ( in_array( 'easing', $ot_recognized_easing_fields ) ) {
					
				  $easing = isset( $field_value['easing'] ) ? esc_attr( $field_value['easing'] ) : '';
				  echo '<select name="' . esc_attr( $field_name ) . '[easing]" data-group="' . esc_attr( $field_id ) . '" id="' . esc_attr( $field_id ) . '-easing" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
					echo '<option value="">' . __('Default' , 'unitedthemes') . '</option>';
					foreach ( ot_recognized_easing_effects( $field_id ) as $key => $value ) {
					  echo '<option value="' . esc_attr( $key ) . '" ' . selected( $easing, $key, false ) . '>' . esc_attr( $value ) . '</option>';
					}
				  echo '</select>';
					
				}
				
			echo '</div>';
		
		echo '</div>';
		
	}

}


/**
 * Google font typography option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_googlefont' ) ) {
  
  	function ot_type_googlefont( $args = array() ) {
		
		/* turns arguments array into variables */
		extract( $args );
		
		/* format setting outer wrapper */
    	echo '<div class="format-setting type-typography">';
		
			/* format setting inner wrapper */
			echo '<div class="format-setting-inner">';
		
				/* allow fields to be filtered */
				$ot_recognized_typography_fields = apply_filters( 'ot_recognized_typography_fields', array( 
				  'font-color',
				  'font-family',
				  'font-id', 
				  'font-size', 
				  'font-style', 
				  'font-variant', 
				  'font-weight', 
				  'font-subset',
				  'letter-spacing', 
				  'line-height', 
				  'text-decoration', 
				  'text-transform'
				), $field_id );
				
				/* build font family */
				if ( in_array( 'font-family', $ot_recognized_typography_fields ) ) {
				    
                    /*echo '<select data-placeholder="' . esc_html__( 'Select Google Font', 'option-tree' ) . '" name="' . esc_attr( $field_name ) . '[font-family]" data-group="' . esc_attr( $field_id ) . '" id="' . esc_attr( $field_id ) . '-font-family" class="ut-google-font-select ' . esc_attr( $field_class ) . '" style="width: 100%;">';
                        
                        echo '<option value="">font-family</option>';
                        
                        if( !empty( $field_value['font-id'] ) ) {
                            
                            $google_fonts = ut_recognized_google_fonts( $field_id );
                            
                            $subsets  = implode(",", $google_fonts[$field_value['font-id']]['subsets']);
                            $variants = implode(",", $google_fonts[$field_value['font-id']]['variants']);
                            $value    = preg_replace( '/\s+/', '', strtolower($google_fonts[$field_value['font-id']]['family']) );
                                
                            echo '<option selected="selected" data-fontid="' . $field_value['font-id'] . '" data-subsets="' . $subsets . '" data-variants="' . $variants . '" data-font="' . esc_attr( $google_fonts[$field_value['font-id']]['family'] ) . '" data-family="' . esc_attr( $google_fonts[$field_value['font-id']]['family'] ) . '" value="' . esc_attr( $value ) . '">' . esc_attr( $google_fonts[$field_value['font-id']]['family'] ) . '</option>';
                            
                        }
                        
                    echo '</select>';  */
                  
                    echo '<div class="clear"></div>';
                  
                  $font_family = isset( $field_value['font-family'] ) ? $field_value['font-family'] : '';
				  echo '<select name="' . esc_attr( $field_name ) . '[font-family]" data-group="' . esc_attr( $field_id ) . '" id="' . esc_attr( $field_id ) . '-font-family" class="option-tree-ui-select ut-google-font-select' . esc_attr( $field_class ) . '">';
					echo '<option value="">font-family</option>';
					
					$current_font 	 = NULL;
					foreach ( ut_recognized_google_fonts( $field_id ) as $id => $font ) {
					  	
						$key = preg_replace( '/\s+/', '', strtolower($font['family']) );
						$variants = implode(",", $font['variants']);
						$subsets = implode(",", $font['subsets']);
						
						if( $font_family == esc_attr( $key ) ) {
					  		$current_font = $font['family'];
					  	}
											  
						echo '<option data-fontid="'.$id.'" data-subsets="'.$subsets.'" data-variants="'.$variants.'" data-font="' . esc_attr( $font['family'] ) . '" data-family="' . esc_attr( $font['family'] ) . '" value="' . esc_attr( $key ) . '" ' . selected( $font_family , $key , false ) . '>' . esc_attr( $font['family'] ) . '</option>';
					  
					}
					
				  echo '</select>';
                  
				}
				
				/* hidden font id */
				if ( in_array( 'font-id', $ot_recognized_typography_fields ) ) {
					$font_id = isset( $field_value['font-id'] ) ? esc_attr( $field_value['font-id'] ) : '';
					echo '<input type="hidden" name="' . esc_attr( $field_name ) . '[font-id]" id="' . esc_attr( $field_id ) . '-fontid" value="' . esc_attr( $font_id ) . '" autocomplete="off" />';
				}
				
				/* build font subsets */
				if ( in_array( 'font-subset', $ot_recognized_typography_fields ) ) {
				  $font_subset = isset( $field_value['font-subset'] ) ? esc_attr( $field_value['font-subset'] ) : '';
				  echo '<select name="' . esc_attr( $field_name ) . '[font-subset]" data-group="' . esc_attr( $field_id ) . '" id="' . esc_attr( $field_id ) . '-font-subset" class="option-tree-ui-select ut-google-font-subset ' . esc_attr( $field_class ) . '">';
					echo '<option value="">font-subset</option>';
					foreach ( ot_recognized_google_subsets( $field_id ) as $key => $value ) {
					  echo '<option value="' . esc_attr( $key ) . '" ' . selected( $font_subset, $key, false ) . '>' . esc_attr( $value ) . '</option>';
					}
				  echo '</select>';
				}
				
				/* build font size */
				if ( in_array( 'font-size', $ot_recognized_typography_fields ) ) {
				  $font_size = isset( $field_value['font-size'] ) ? esc_attr( $field_value['font-size'] ) : '';
				  echo '<select name="' . esc_attr( $field_name ) . '[font-size]" data-group="' . esc_attr( $field_id ) . '" id="' . esc_attr( $field_id ) . '-font-size" class="option-tree-ui-select ut-google-font-size ' . esc_attr( $field_class ) . '">';
					echo '<option value="">font-size</option>';
					
					$current_font_size = '16px';
					foreach( ot_recognized_font_sizes( $field_id ) as $option ) { 
					  
					  if( $font_size == $option ) {
							$current_font_size = esc_attr( $option );
					  }
					  
					  echo '<option value="' . esc_attr( $option ) . '" ' . selected( $font_size, $option, false ) . '>' . esc_attr( $option ) . '</option>';
					}
				  echo '</select>';
				}
				
				/* build font weight */
				if ( in_array( 'font-weight', $ot_recognized_typography_fields ) ) {
				  $font_weight = isset( $field_value['font-weight'] ) ? esc_attr( $field_value['font-weight'] ) : '';
				  echo '<select name="' . esc_attr( $field_name ) . '[font-weight]" data-group="' . esc_attr( $field_id ) . '" id="' . esc_attr( $field_id ) . '-font-weight" class="option-tree-ui-select ut-google-font-weight ' . esc_attr( $field_class ) . '">';
					echo '<option value="">font-weight</option>';
					
					$current_weight = NULL;
					foreach ( ot_recognized_google_font_weights( $field_id ) as $key => $value ) {
					  if( $font_weight == $key ) {
							$current_weight = esc_attr( $key );
					  }
					  echo '<option value="' . esc_attr( $key ) . '" ' . selected( $font_weight, $key, false ) . '>' . esc_attr( $value ) . '</option>';
					}
				  echo '</select>';
				}
				
				/* build line height */
				if ( in_array( 'line-height', $ot_recognized_typography_fields ) ) {
				  $line_height = isset( $field_value['line-height'] ) ? esc_attr( $field_value['line-height'] ) : '';
				  echo '<select name="' . esc_attr( $field_name ) . '[line-height]" id="' . esc_attr( $field_id ) . '-line-height" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
					echo '<option value="">line-height</option>';
					foreach( ot_recognized_line_heights( $field_id ) as $option ) { 
					  echo '<option value="' . esc_attr( $option ) . '" ' . selected( $line_height, $option, false ) . '>' . esc_attr( $option ) . '</option>';
					}
				  echo '</select>';
				}
				
				/* build font style */
				if ( in_array( 'font-style', $ot_recognized_typography_fields ) ) {
					$font_style = isset( $field_value['font-style'] ) ? esc_attr( $field_value['font-style'] ) : '';
					echo '<select name="' . esc_attr( $field_name ) . '[font-style]" data-group="' . esc_attr( $field_id ) . '" id="' . esc_attr( $field_id ) . '-font-style" class="option-tree-ui-select ut-google-font-style ' . esc_attr( $field_class ) . '">';
						echo '<option value="">font-style</option>';
						$current_style = NULL;
						foreach ( ot_recognized_google_font_styles( $field_id ) as $key => $value ) {
						  if( $font_style == $key ) {
								$current_style = esc_attr( $key );
						  }
						  echo '<option value="' . esc_attr( $key ) . '" ' . selected( $font_style, $key, false ) . '>' . esc_attr( $value ) . '</option>';
						}
					echo '</select>';
				}
				
				/* build text transform */
				if ( in_array( 'text-transform', $ot_recognized_typography_fields ) ) {
				  $text_transform = isset( $field_value['text-transform'] ) ? esc_attr( $field_value['text-transform'] ) : '';
				  echo '<select name="' . esc_attr( $field_name ) . '[text-transform]" data-group="' . esc_attr( $field_id ) . '" id="' . esc_attr( $field_id ) . '-text-transform" class="option-tree-ui-select ut-google-text-transform ' . esc_attr( $field_class ) . '">';
					echo '<option value="">text-transform</option>';
					foreach ( ot_recognized_text_transformations( $field_id ) as $key => $value ) {
					  echo '<option value="' . esc_attr( $key ) . '" ' . selected( $text_transform, $key, false ) . '>' . esc_attr( $value ) . '</option>';
					}
				  echo '</select>';
				}
				
				/* build preview window */
				if( !empty($current_font) ) {
					echo '<link id="ut-google-style-link-' . esc_attr( $field_id ) . '" rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family='.$current_font.':'.$current_weight.$current_style.'">';
				} else {
					echo '<link id="ut-google-style-link-' . esc_attr( $field_id ) . '" rel="stylesheet" type="text/css" href="">';
				}
				
				$font_preview_style = NULL;
				
				if( !empty($field_value['font-family']) ) {
					$font_preview_style = '#ut-google-preview-' . esc_attr( $field_id ) . ' { font-size: '.$current_font_size.'; font-family: "'.$field_value['font-family'].'" !important; }';
				}
				
				echo '<style id="ut-google-style-' . esc_attr( $field_id ) . '" type="text/css">'.$font_preview_style.'</style>';
				
				echo '<div id="ut-google-preview-' . esc_attr( $field_id ) . '" class="ut-google-font-preview">';
					
					_e('The quick brown fox jumps over the lazy dog.' , 'unitedthemes');	
				
				echo '</div>';
				
				
				
			echo '</div>';
		  
		echo '</div>';
		
	}
	
}


/**
 * Typography option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_typography' ) ) {
  
  function ot_type_typography( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-typography">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">'; 
        
        /* allow fields to be filtered */
        $ot_recognized_typography_fields = apply_filters( 'ot_recognized_typography_fields', array( 
          //'font-color',
          'font-family', 
          'font-size', 
          'font-style', 
          'font-variant', 
          'font-weight', 
          'letter-spacing', 
          'line-height', 
          'text-decoration', 
          'text-transform' 
        ), $field_id );
        
        /* build background colorpicker */
        if ( in_array( 'font-color', $ot_recognized_typography_fields ) ) {
        
          echo '<div class="option-tree-ui-colorpicker-input-wrap">';
                        
            /* set background color */
            $background_color = isset( $field_value['font-color'] ) ? esc_attr( $field_value['font-color'] ) : '';
            
            /* set border color */
            $border_color = in_array( $background_color, array( '#FFFFFF', '#FFF', '#ffffff', '#fff' ) ) ? '#ccc' : $background_color;
            
            /* input */
            echo '<input maxlength="7" type="text" name="' . esc_attr( $field_name ) . '[font-color]" id="' . esc_attr( $field_id ) . '-picker" value="' . esc_attr( $background_color ) . '" class="widefat ut-minicolors option-tree-ui-input ' . esc_attr( $field_class ) . '" autocomplete="off" placeholder="font-color" />';
            
          echo '</div>';
        
        }
        
        /* build font family */
        if ( in_array( 'font-family', $ot_recognized_typography_fields ) ) {
          $font_family = isset( $field_value['font-family'] ) ? $field_value['font-family'] : '';
          echo '<select name="' . esc_attr( $field_name ) . '[font-family]" id="' . esc_attr( $field_id ) . '-font-family" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">font-family</option>';
            foreach ( ot_recognized_font_families( $field_id ) as $key => $value ) {
              echo '<option value="' . esc_attr( $key ) . '" ' . selected( $font_family, $key, false ) . '>' . esc_attr( $value ) . '</option>';
            }
          echo '</select>';
        }
        
        /* build font size */
        if ( in_array( 'font-size', $ot_recognized_typography_fields ) ) {
          $font_size = isset( $field_value['font-size'] ) ? esc_attr( $field_value['font-size'] ) : '';
          echo '<select name="' . esc_attr( $field_name ) . '[font-size]" id="' . esc_attr( $field_id ) . '-font-size" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">font-size</option>';
            foreach( ot_recognized_font_sizes( $field_id ) as $option ) { 
              echo '<option value="' . esc_attr( $option ) . '" ' . selected( $font_size, $option, false ) . '>' . esc_attr( $option ) . '</option>';
            }
          echo '</select>';
        }
        
        /* build font style */
        if ( in_array( 'font-style', $ot_recognized_typography_fields ) ) {
          $font_style = isset( $field_value['font-style'] ) ? esc_attr( $field_value['font-style'] ) : '';
          echo '<select name="' . esc_attr( $field_name ) . '[font-style]" id="' . esc_attr( $field_id ) . '-font-style" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">font-style</option>';
            foreach ( ot_recognized_font_styles( $field_id ) as $key => $value ) {
              echo '<option value="' . esc_attr( $key ) . '" ' . selected( $font_style, $key, false ) . '>' . esc_attr( $value ) . '</option>';
            }
          echo '</select>';
        }
        
        /* build font variant */
        if ( in_array( 'font-variant', $ot_recognized_typography_fields ) ) {
          $font_variant = isset( $field_value['font-variant'] ) ? esc_attr( $field_value['font-variant'] ) : '';
          echo '<select name="' . esc_attr( $field_name ) . '[font-variant]" id="' . esc_attr( $field_id ) . '-font-variant" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">font-variant</option>';
            foreach ( ot_recognized_font_variants( $field_id ) as $key => $value ) {
              echo '<option value="' . esc_attr( $key ) . '" ' . selected( $font_variant, $key, false ) . '>' . esc_attr( $value ) . '</option>';
            }
          echo '</select>';
        }
        
        /* build font weight */
        if ( in_array( 'font-weight', $ot_recognized_typography_fields ) ) {
          $font_weight = isset( $field_value['font-weight'] ) ? esc_attr( $field_value['font-weight'] ) : '';
          echo '<select name="' . esc_attr( $field_name ) . '[font-weight]" id="' . esc_attr( $field_id ) . '-font-weight" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">font-weight</option>';
            foreach ( ot_recognized_font_weights( $field_id ) as $key => $value ) {
              echo '<option value="' . esc_attr( $key ) . '" ' . selected( $font_weight, $key, false ) . '>' . esc_attr( $value ) . '</option>';
            }
          echo '</select>';
        }
        
        /* build letter spacing */
        if ( in_array( 'letter-spacing', $ot_recognized_typography_fields ) ) {
          $letter_spacing = isset( $field_value['letter-spacing'] ) ? esc_attr( $field_value['letter-spacing'] ) : '';
          echo '<select name="' . esc_attr( $field_name ) . '[letter-spacing]" id="' . esc_attr( $field_id ) . '-letter-spacing" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">letter-spacing</option>';
            foreach( ot_recognized_letter_spacing( $field_id ) as $option ) { 
              echo '<option value="' . esc_attr( $option ) . '" ' . selected( $letter_spacing, $option, false ) . '>' . esc_attr( $option ) . '</option>';
            }
          echo '</select>';
        }
        
        /* build line height */
        if ( in_array( 'line-height', $ot_recognized_typography_fields ) ) {
          $line_height = isset( $field_value['line-height'] ) ? esc_attr( $field_value['line-height'] ) : '';
          echo '<select name="' . esc_attr( $field_name ) . '[line-height]" id="' . esc_attr( $field_id ) . '-line-height" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">line-height</option>';
            foreach( ot_recognized_line_heights( $field_id ) as $option ) { 
              echo '<option value="' . esc_attr( $option ) . '" ' . selected( $line_height, $option, false ) . '>' . esc_attr( $option ) . '</option>';
            }
          echo '</select>';
        }
        
        /* build text decoration */
        if ( in_array( 'text-decoration', $ot_recognized_typography_fields ) ) {
          $text_decoration = isset( $field_value['text-decoration'] ) ? esc_attr( $field_value['text-decoration'] ) : '';
          echo '<select name="' . esc_attr( $field_name ) . '[text-decoration]" id="' . esc_attr( $field_id ) . '-text-decoration" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">text-decoration</option>';
            foreach ( ot_recognized_text_decorations( $field_id ) as $key => $value ) {
              echo '<option value="' . esc_attr( $key ) . '" ' . selected( $text_decoration, $key, false ) . '>' . esc_attr( $value ) . '</option>';
            }
          echo '</select>';
        }
        
        /* build text transform */
        if ( in_array( 'text-transform', $ot_recognized_typography_fields ) ) {
          $text_transform = isset( $field_value['text-transform'] ) ? esc_attr( $field_value['text-transform'] ) : '';
          echo '<select name="' . esc_attr( $field_name ) . '[text-transform]" id="' . esc_attr( $field_id ) . '-text-transform" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">text-transform</option>';
            foreach ( ot_recognized_text_transformations( $field_id ) as $key => $value ) {
              echo '<option value="' . esc_attr( $key ) . '" ' . selected( $text_transform, $key, false ) . '>' . esc_attr( $value ) . '</option>';
            }
          echo '</select>';
        }
        
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Upload option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_upload' ) ) {
  
  function ot_type_upload( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-upload">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build upload */
        echo '<div class="option-tree-ui-upload-parent">';
          
          /* input */
          echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat option-tree-ui-upload-input ' . esc_attr( $field_class ) . '" />';
          
          /* add media button */
          echo '<a href="javascript:void(0);" class="ot_upload_media option-tree-ui-button blue light" rel="' . $post_id . '" title="' . __( 'Add Media', 'option-tree' ) . '"><span class="icon upload">' . __( 'Add Media', 'option-tree' ) . '</span></a>';
        
        echo '</div>';
        
        /* media */
        if ( $field_value ) {
        
          echo '<div class="option-tree-ui-media-wrap" id="' . esc_attr( $field_id ) . '_media">';
          
            if ( preg_match( '/\.(?:jpe?g|png|gif|ico)$/i', $field_value ) )
              echo '<div class="option-tree-ui-image-wrap"><img src="' . esc_url( $field_value ) . '" alt="" /></div><div class="clear"></div>';
            
            echo '<a href="javascript:(void);" class="option-tree-ui-remove-media option-tree-ui-button red light" title="' . __( 'Remove Media', 'option-tree' ) . '"><span class="icon trash-can">' . __( 'Remove Media', 'option-tree' ) . '</span></a>';
            
          echo '</div>';
          
        }
        
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Upload option type. Connect to WordPress Customizer
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_upload_customizer' ) ) {
  
  function ot_type_upload_customizer( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* get option from theme mod */
    $field_value = get_theme_mod($field_id);
        
    /* format setting outer wrapper */
    echo '<div class="format-setting type-upload">';
            
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build upload */
        echo '<div class="option-tree-ui-upload-parent">';
          
          /* input */
          echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat option-tree-ui-upload-input ' . esc_attr( $field_class ) . '" />';
          
          /* add media button */
          echo '<a href="javascript:void(0);" class="ot_upload_media option-tree-ui-button blue light" rel="' . $post_id . '" title="' . __( 'Add Media', 'option-tree' ) . '"><span class="icon upload">' . __( 'Add Media', 'option-tree' ) . '</span></a>';
        
        echo '</div>';
        
        /* media */
        if ( $field_value ) {
        
          echo '<div class="option-tree-ui-media-wrap" id="' . esc_attr( $field_id ) . '_media">';
          
            if ( preg_match( '/\.(?:jpe?g|png|gif|ico)$/i', $field_value ) )
              echo '<div class="option-tree-ui-image-wrap"><img src="' . esc_url( $field_value ) . '" alt="" /></div><div class="clear"></div>';
            
            echo '<a href="javascript:(void);" class="option-tree-ui-remove-media option-tree-ui-button red light" title="' . __( 'Remove Media', 'option-tree' ) . '"><span class="icon trash-can">' . __( 'Remove Media', 'option-tree' ) . '</span></a>';
            
          echo '</div>';
          
        }
        
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/* End of file ot-functions-option-types.php */
/* Location: ./includes/ot-functions-option-types.php */