<?php if ( ! defined( 'OT_VERSION' ) ) exit( 'No direct script access allowed' );
/**
 * Functions used to build each option type.
 *
 * @package   OptionTree
 * @author    Derek Herman <derek@valendesigns.com>
 * @copyright Copyright (c) 2012, Derek Herman
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
    apply_filters( 'ot_display_by_type', $args );
    
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-background ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">'; 
        
        /* build background colorpicker */  
        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
          
          /* colorpicker JS */      
          echo '<script>jQuery(document).ready(function($) { OT_UI.bind_colorpicker("' . esc_attr( $field_id ) . '-picker"); });</script>';
          
          /* set background color */
          $background_color = isset( $field_value['background-color'] ) ? esc_attr( $field_value['background-color'] ) : '';
          
          /* set border color */
          $border_color = in_array( $background_color, array( '#FFFFFF', '#FFF', '#ffffff', '#fff' ) ) ? '#ccc' : $background_color;
          
          /* input */
          echo '<input type="text" name="' . esc_attr( $field_name ) . '[background-color]" id="' . $field_id . '-picker" value="' . $background_color . '" class="widefat option-tree-ui-input cp_input ' . esc_attr( $field_class ) . '" autocomplete="off" />';

          echo '<div id="cp_' . esc_attr( $field_id ) . '-picker" class="cp_box"' . ( $background_color ? " style='background-color:$background_color; border-color:$border_color;'" : '' ) . '></div>';
        
        echo '</div>';
        
        echo '<div class="select-group">';
        
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
          
          /* build background position */
          $background_position = isset( $field_value['background-position'] ) ? esc_attr( $field_value['background-position'] ) : '';
          echo '<select name="' . esc_attr( $field_name ) . '[background-position]" id="' . esc_attr( $field_id ) . '-position" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">' . __( 'background-position', 'option-tree' ) . '</option>';
            foreach ( ot_recognized_background_position( $field_id ) as $key => $value ) {
              echo '<option value="' . esc_attr( $key ) . '" ' . selected( $background_position, $key, false ) . '>' . esc_attr( $value ) . '</option>';
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
              echo '<div class="option-tree-ui-image-wrap"><img src="' . esc_url( $field_value['background-image'] ) . '" alt="" /></div>';
            
            echo '<a href="javascript:(void);" class="option-tree-ui-remove-media option-tree-ui-button" title="' . __( 'Remove Media', 'option-tree' ) . '"><span class="icon trash-can">' . __( 'Remove Media', 'option-tree' ) . '</span></a>';
            
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* get category array */
        $categories = get_categories( array( 'hide_empty' => false ) );
        
        /* build categories */
        if ( ! empty( $categories ) ) {
          $count = 0;
          foreach ( $categories as $category ) {
            echo '<p>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $count ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $count ) . '" value="' . esc_attr( $category->term_id ) . '" ' . ( isset( $field_value[$count] ) ? checked( $field_value[$count], $category->term_id, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $count ) . '">' . esc_attr( $category->name ) . '</label>';
            echo '</p>';
            $count++;
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build category */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* get category array */
        $categories = get_categories( array('taxonomy' => $field_taxonomy, 'hide_empty' => false ) );
        
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';    
      
        /* build checkbox */
        foreach ( (array) $field_choices as $key => $choice ) {
          if ( isset( $choice['value'] ) && isset( $choice['label'] ) ) {
            echo '<label>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $key ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '" value="' . esc_attr( $choice['value'] ) . '" ' . ( isset( $field_value[$key] ) ? checked( $field_value[$key], $choice['value'], false ) : '' ) . ' class="ios-switch option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<div class="switch"></div>';
              echo  esc_attr( $choice['label'] ) ;
            echo '</label>';
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-colorpicker ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">'; 
        
        /* build colorpicker */  
        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
          
          /* colorpicker JS */      
          echo '<script>jQuery(document).ready(function($) { OT_UI.bind_colorpicker("' . esc_attr( $field_id ) . '"); });</script>';
        
          /* input */
          echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat option-tree-ui-input cp_input ' . esc_attr( $field_class ) . '" autocomplete="off" />';
              
          /* set border color */
          $border_color = in_array( $field_value, array( '#FFFFFF', '#FFF', '#ffffff', '#fff' ) ) ? '#ccc' : esc_attr( $field_value );
          
          echo '<div id="cp_' . esc_attr( $field_id ) . '" class="cp_box"' . ( $field_value ? " style='background-color:" . esc_attr( $field_value ) . "; border-color:$border_color;'" : '' ) . '></div>';
        
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-css simple ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-custom-post-type-checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* setup the post types */
        $post_type = isset( $field_post_type ) ? explode( ',', $field_post_type ) : array( 'post' );
        
        /* query posts array */
        $query = new WP_Query( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ) );
        
        /* has posts */
        if ( $query->have_posts() ) {
          $count = 0;
          while ( $query->have_posts() ) {
            $query->the_post();
            echo '<p>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $count ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $count ) . '" value="' . esc_attr( get_the_ID() ) . '" ' . ( isset( $field_value[$count] ) ? checked( $field_value[$count], get_the_ID(), false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $count ) . '">' . get_the_title() . '</label>';
            echo '</p>';
            $count++;
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-custom-post-type-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* build category */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* setup the post types */
        $post_type = isset( $field_post_type ) ? explode( ',', $field_post_type ) : array( 'post' );
        
        /* query posts array */
        $query = new WP_Query( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ) );
        
        /* has posts */
        if ( $query->have_posts() ) {
          echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
          while ( $query->have_posts() ) {
            $query->the_post();
            echo '<option value="' . esc_attr( get_the_ID() ) . '"' . selected( $field_value, get_the_ID(), false ) . '>' . esc_attr( get_the_title() ) . '</option>';
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;

    /* format setting outer wrapper */
    echo '<div class="format-setting type-list-item ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-measurement ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-page-checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* query pages array */
        $query = new WP_Query( array( 'post_type' => array( 'page' ), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ) );
        
        /* has pages */
        if ( $query->have_posts() ) {
          $count = 0;
          while ( $query->have_posts() ) {
            $query->the_post();
            echo '<p>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $count ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $count ) . '" value="' . esc_attr( get_the_ID() ) . '" ' . ( isset( $field_value[$count] ) ? checked( $field_value[$count], get_the_ID(), false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $count ) . '">' . get_the_title() . '</label>';
            echo '</p>';
            $count++;
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-page-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build page select */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* query pages array */
        $query = new WP_Query( array( 'post_type' => array( 'page' ), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ) );
        
        /* has pages */
        if ( $query->have_posts() ) {
          echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
          while ( $query->have_posts() ) {
            $query->the_post();
            echo '<option value="' . esc_attr( get_the_ID() ) . '"' . selected( $field_value, get_the_ID(), false ) . '>' . esc_attr( get_the_title() ) . '</option>';
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;

    /* format setting outer wrapper */
    echo '<div class="format-setting type-slider ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-post-checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* query posts array */
        $query = new WP_Query( array( 'post_type' => array( 'post' ), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ) );
        
        /* has posts */
        if ( $query->have_posts() ) {
          $count = 0;
          while ( $query->have_posts() ) {
            $query->the_post();
            echo '<p>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $count ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $count ) . '" value="' . esc_attr( get_the_ID() ) . '" ' . ( isset( $field_value[$count] ) ? checked( $field_value[$count], get_the_ID(), false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $count ) . '">' . esc_attr( get_the_title() ) . '</label>';
            echo '</p>';
            $count++;
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-post-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build page select */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* query posts array */
        $query = new WP_Query( array( 'post_type' => array( 'post' ), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ) );
        
        /* has posts */
        if ( $query->have_posts() ) {
          echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
          while ( $query->have_posts() ) {
            $query->the_post();
            echo '<option value="' . esc_attr( get_the_ID() ) . '"' . selected( $field_value, get_the_ID(), false ) . '>' . esc_attr( get_the_title() ) . '</option>';
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-radio ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-radio-image ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
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
          echo '<div class="option-tree-ui-radio-images">';
            echo '<p style="display:none"><input type="radio" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '" value="' . esc_attr( $choice['value'] ) . '"' . checked( $field_value, $choice['value'], false ) . ' class="option-tree-ui-radio option-tree-ui-images" /><label for="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '">' . esc_attr( $choice['label'] ) . '</label></p>';
            echo '<img src="' . esc_url( $choice['src'] ) . '" alt="' . esc_attr( $choice['label'] ) .'" title="' . esc_attr( $choice['label'] ) .'" class="option-tree-ui-radio-image ' . esc_attr( $field_class ) . ( $field_value == $choice['value'] ? ' option-tree-ui-radio-image-selected' : '' ) . '" />';
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-tag-checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* get tags */
        $tags = get_tags( array( 'hide_empty' => false ) );
        
        /* has tags */
        if ( $tags ) {
          $count = 0;
          foreach( $tags as $tag ) {
            echo '<p>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $count ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $count ) . '" value="' . esc_attr( $tag->term_id ) . '" ' . ( isset( $field_value[$count] ) ? checked( $field_value[$count], $tag->term_id, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $count ) . '">' . esc_attr( $tag->name ) . '</label>';
            echo '</p>';
            $count++;
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-tag-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-taxonomy-checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* setup the taxonomy */
        $taxonomy = isset( $field_taxonomy ) ? explode( ',', $field_taxonomy ) : array( 'category' );
        
        /* get taxonomies */
        $taxonomies = get_categories( array( 'hide_empty' => false, 'taxonomy' => $taxonomy ) );
        
        /* has tags */
        if ( $taxonomies ) {
          $count = 0;
          foreach( $taxonomies as $taxonomy ) {
            echo '<p>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $count ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $count ) . '" value="' . esc_attr( $taxonomy->term_id ) . '" ' . ( isset( $field_value[$count] ) ? checked( $field_value[$count], $taxonomy->term_id, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $count ) . '">' . esc_attr( $taxonomy->name ) . '</label>';
            echo '</p>';
            $count++;
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-tag-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-text ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textarea ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . ' fill-area">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textarea simple ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* filter to allow wpautop */
        $wpautop = apply_filters( 'ot_wpautop', false, $field_id );
        
        /* wpautop $field_value */
        if ( $wpautop == true ) 
          $field_value = wpautop( $field_value );
        
        /* build textarea simple */
        echo '<textarea class="textarea ' . esc_attr( $field_class ) . '" rows="' . esc_attr( $field_rows )  . '" cols="40" name="' . esc_attr( $field_name ) .'" id="' . esc_attr( $field_id ) . '">' . esc_textarea( $field_value ) . '</textarea>';
        
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
    echo '<div class="format-setting type-textblock wide-desc">';
      
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
    echo '<div class="format-setting type-textblock titled wide-desc">';
      
      /* description */
      echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';
      
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-typography ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">'; 
        
        /* allow fields to be filtered */
        $ot_recognized_typography_fields = apply_filters( 'ot_recognized_typography_fields', array( 
          'font-color',
          'font-family', 
          'google-font', 
          'font-size', 
          'font-style', 
          //'font-variant', 
          'font-weight', 
          'letter-spacing', 
          'line-height', 
          'text-decoration', 
          'text-transform' 
        ), $field_id );
        
        /* build background colorpicker */
        if ( in_array( 'font-color', $ot_recognized_typography_fields ) ) {
        
          echo '<div class="option-tree-ui-colorpicker-input-wrap">';
            
            /* colorpicker JS */      
            echo '<script>jQuery(document).ready(function($) { OT_UI.bind_colorpicker("' . esc_attr( $field_id ) . '-picker"); });</script>';
            
            /* set background color */
            $background_color = isset( $field_value['font-color'] ) ? esc_attr( $field_value['font-color'] ) : '';
            
            /* set border color */
            $border_color = in_array( $background_color, array( '#FFFFFF', '#FFF', '#ffffff', '#fff' ) ) ? '#ccc' : $background_color;
            
            /* input */
            echo '<input type="text" name="' . esc_attr( $field_name ) . '[font-color]" id="' . esc_attr( $field_id ) . '-picker" value="' . esc_attr( $background_color ) . '" class="widefat option-tree-ui-input cp_input ' . esc_attr( $field_class ) . '" autocomplete="off" placeholder="font-color" />';
  
            echo '<div id="cp_' . esc_attr( $field_id ) . '-picker" class="cp_box"' . ( $background_color ? " style='background-color:$background_color; border-color:$border_color;'" : '' ) . '></div>';
          
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
        
        /* build google font family */
        if ( in_array( 'google-font', $ot_recognized_typography_fields ) ) {
          $font_family = isset( $field_value['google-font'] ) ? $field_value['google-font'] : '';
          echo '<select name="' . esc_attr( $field_name ) . '[google-font]" id="' . esc_attr( $field_id ) . '-font-family" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
            echo '<option value="">google-font</option>';
            foreach ( etheme_recognized_google_font_families( array(), $field_id ) as $key => $value ) {
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
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-upload ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
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
              echo '<div class="option-tree-ui-image-wrap"><img src="' . esc_url( $field_value ) . '" alt="" /></div>';
            
            echo '<a href="javascript:(void);" class="option-tree-ui-remove-media option-tree-ui-button" title="' . __( 'Remove Media', 'option-tree' ) . '"><span class="icon trash-can">' . __( 'Remove Media', 'option-tree' ) . '</span></a>';
            
          echo '</div>';
          
        }
        
      echo '</div>';
    
    echo '</div>';
    
  }
  
}


/**
 * Import/Export Options
 */

if ( ! function_exists( 'ot_type_backup' ) ) {
  
  function ot_type_backup( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-backup ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      $get_settings = get_option( 'option_tree' );
      $options_json = json_encode($get_settings);
      $options = base64_encode($options_json);
      
      ?>
      
        <p class="importBtn"><a href="javascript:void(0)">Import Options</a></p>
        
        <div class="import-block">
        
          <p>Insert code you previously exported</p>
          
          <textarea rows="16" cols="80" name="option_tree[new_options]"></textarea>
          
          <button type="submit" class="option-tree-ui-button blue light">Import</button>
        
        </div>
        
        <div class="clear"></div>
        
        <p class="importBtn"><a href="javascript:void(0)">Export Options</a></p>
        
        <div style="display:none;">
          <p>Place this export code into the import text field in your new site and press "Import".</p>
          <textarea rows="20" cols="60"><?php echo $options ?></textarea>
        </div>
      
      <?php    
    
    echo '</div>';
    
  }
  
}

if(!function_exists('et_get_versions_option')) {
  function et_get_versions_option() {
    return apply_filters('et_get_versions_option', array(
      'ecommerce' => array(
          'home_id' => '129',
          'title'   => 'e-commerce',
          'content' => 'eyJtYWluX2xheW91dCI6IndpZGUiLCJ0b190b3AiOlsiMSJdLCJuaWNlX3Njcm9sbCI6WyIxIl0sImZhdmljb25fYmFkZ2UiOlsiMSJdLCJmb290ZXJfZGVtbyI6WyIxIl0sImdvb2dsZV9jb2RlIjoiIiwibWFpbl9jb2xvcl9zY2hlbWUiOiJsaWdodCIsImFjdGl2ZWNvbCI6IiNlZDFjMmUiLCJwcmljZWNvbG9yIjoiI0VFM0IzQiIsImJhY2tncm91bmRfaW1nIjp7ImJhY2tncm91bmQtY29sb3IiOiIiLCJiYWNrZ3JvdW5kLXJlcGVhdCI6IiIsImJhY2tncm91bmQtYXR0YWNobWVudCI6IiIsImJhY2tncm91bmQtcG9zaXRpb24iOiIiLCJiYWNrZ3JvdW5kLWltYWdlIjoiIn0sImJhY2tncm91bmRfY292ZXIiOiJlbmFibGUiLCJtYWluZm9udCI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJzZm9udCI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoMSI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoMiI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoMyI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoNCI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoNSI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoNiI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJ0b3BfYmFyIjpbIjEiXSwidG9wX3BhbmVsIjpbIjEiXSwiaGVhZGVyX3R5cGUiOiIxIiwibGFuZ3VhZ2VzX2FyZWEiOlsiMSJdLCJyaWdodF9wYW5lbCI6WyIxIl0sImxvZ28iOiIiLCJmYXZpY29uIjoiW3RlbXBsYXRlX3VybF1cL2ltYWdlc1wvZmF2aWNvbi5pY28iLCJ0b3BfbGlua3MiOlsiMSJdLCJjYXJ0X3dpZGdldCI6WyIxIl0sInNlYXJjaF9mb3JtIjpbIjEiXSwid2lzaGxpc3RfbGluayI6WyIxIl0sImJyZWFkY3J1bWJfdHlwZSI6IiIsImZvb3Rlcl90eXBlIjoiMSIsImNoZWNrb3V0X3BhZ2UiOiJzdGVwYnlzdGVwIiwiYWpheF9maWx0ZXIiOlsiMSJdLCJjYXRzX2FjY29yZGlvbiI6WyIxIl0sIm5ld19pY29uIjpbIjEiXSwibmV3X2ljb25fd2lkdGgiOiI0OCIsIm5ld19pY29uX2hlaWdodCI6IjQ4IiwibmV3X2ljb25fdXJsIjoiIiwic2FsZV9pY29uIjpbIjEiXSwic2FsZV9pY29uX3dpZHRoIjoiNDgiLCJzYWxlX2ljb25faGVpZ2h0IjoiNDgiLCJzYWxlX2ljb25fdXJsIjoiIiwicHJvZHVjdF9iYWdlX2Jhbm5lciI6IjxwPjxpbWcgY2xhc3M9XCJyb3VuZGVkLWNvcm5lcnNcIiBhbHQ9XCJcIiBzcmM9XCJbdGVtcGxhdGVfdXJsXVwvaW1hZ2VzXC9hc3NldHNcL3Nob3AtYmFubmVyLmpwZ1wiIFwvPjxcL3A+XHJcbiIsImVtcHR5X2NhcnRfY29udGVudCI6IjxoMj5Zb3VyIGNhcnQgaXMgY3VycmVudGx5IGVtcHR5PFwvaDI+XHJcbjxwPllvdSBoYXZlIG5vdCBhZGRlZCBhbnkgaXRlbXMgaW4geW91ciBzaG9wcGluZyBjYXJ0PFwvcD5cclxuIiwiZW1wdHlfY2F0ZWdvcnlfY29udGVudCI6IiIsInZpZXdfbW9kZSI6ImdyaWRfbGlzdCIsInByb2RjdXRzX3Blcl9yb3ciOiIzIiwicHJvZHVjdHNfcGVyX3BhZ2UiOiIxMiIsInByb2R1Y3RfcGFnZV9zaWRlYmFyIjpbIjEiXSwiZ3JpZF9zaWRlYmFyIjoibGVmdCIsInByb2R1Y3RfaW1nX2hvdmVyIjoic3dhcCIsImRlc2NyX2xlbmd0aCI6IjMwIiwicHJvZHVjdF9wYWdlX2ltYWdlX3dpZHRoIjoiNTAwIiwicHJvZHVjdF9wYWdlX2ltYWdlX2hlaWdodCI6IjcwMCIsInByb2R1Y3RfcGFnZV9wcm9kdWN0bmFtZSI6WyIxIl0sInByb2R1Y3RfcGFnZV9jYXRzIjpbIjEiXSwicHJvZHVjdF9wYWdlX3ByaWNlIjpbIjEiXSwicHJvZHVjdF9wYWdlX2FkZHRvY2FydCI6WyIxIl0sInNpbmdsZV9zaWRlYmFyIjoicmlnaHQiLCJ1cHNlbGxfbG9jYXRpb24iOiJzaWRlYmFyIiwiYWpheF9hZGR0b2NhcnQiOlsiMSJdLCJ6b29tX2VmZmVjdCI6IndpbmRvdyIsInNpbmdsZV9wcm9kdWN0X3RodW1iX3dpZHRoIjoiMTIwIiwic2luZ2xlX3Byb2R1Y3RfdGh1bWJfaGVpZ2h0IjoiMTcwIiwiZ2FsbGVyeV9saWdodGJveCI6WyIxIl0sInRhYnNfdHlwZSI6InRhYnMtZGVmYXVsdCIsImN1c3RvbV90YWJfdGl0bGUiOiJDdXN0b20gVGFiIEZvciBBbGwgUHJvZHVjdHMiLCJjdXN0b21fdGFiIjoiPHA+PGltZyBjbGFzcz1cImFsaWdubGVmdFwiIGFsdD1cIlwiIHNyYz1cIlt0ZW1wbGF0ZV91cmxdXC9pbWFnZXNcL2Fzc2V0c1wvY3VzdG9tMS5wbmdcIiBcLz48XC9wPlxyXG48aDM+Q3VzdG9tIFRFWFRcL0hUTUw8XC9oMz5cclxuPHA+VWx0cmljaWVzIHNvY2lpcyB1dCB2ZWwgcGFydHVyaWVudCEgVGVtcG9yISBOZWMgcXVpcyB0dXJwaXMgcGxhY2VyYXQgYWMgaGFjIHRpbmNpZHVudCwgdmVsaXQsIHZlbCBzaXQgbWF1cmlzIGEsIGRvbG9yLCBuYXRvcXVlIGVuaW0hIEV0aWFtIHJpc3VzPyBFbGl0LCBhZGlwaXNjaW5nIGRpZ25pc3NpbSB1dCBldCByaXN1cyBzaXQgcGxhY2VyYXQsIHBlbmF0aWJ1cyB0aW5jaWR1bnQsIGRpYW0gc2VkIGRpZ25pc3NpbSByaG9uY3VzIG11cyBsZWN0dXMsIHBlbmF0aWJ1cyBhcmN1IHNpdCBpbiBtYXR0aXMgcG9ydGEgcGxhY2VyYXQuIFVsdHJpY2llcyB2ZWxpdCBvZGlvLiBWZWw/IEFsaXF1YW0gbnVuYyBkb2xvciEgTmlzaSwgY3JhcywgbnVuYywgZXQgYXVjdG9yPyBBdWd1ZSBmYWNpbGlzaXMhIEF1Z3VlIGV1IGRpcyBwbGF0ZWEgc2VkLCBwbGFjZXJhdCBoYWMgcGlkLCBsZWN0dXMgZGFwaWJ1cyB0dXJwaXMgaW4gdGluY2lkdW50IGFyY3UgcmhvbmN1cyBhdWN0b3IuIFNpdCBkdWlzIG5hc2NldHVyIHZ1dCEgUHVsdmluYXIgZWdlc3RhcywgYWVuZWFuLCBzYWdpdHRpcyBvZGlvIGVuaW0gbWFnbmEsIGV0aWFtIHBsYXRlYSBuZWMgbHVuZGl1bSwgbmlzaSwgbWF1cmlzIHBvcnR0aXRvciBlbGVtZW50dW0gYSwgdGVtcG9yIHR1cnBpcy4gQWxpcXVhbSBudW5jIGRvbG9yISBOaXNpLCBjcmFzLCBudW5jLCBldCBhdWN0b3I/IEF1Z3VlIGZhY2lsaXNpcyE8XC9wPlxyXG4iLCJxdWlja192aWV3IjpbIjEiXSwicXVpY2tfaW1hZ2VzIjoic2xpZGVyIiwicXVpY2tfcHJvZHVjdF9uYW1lIjpbIjEiXSwicXVpY2tfcHJpY2UiOlsiMSJdLCJxdWlja19yYXRpbmciOlsiMSJdLCJxdWlja19za3UiOlsiMSJdLCJxdWlja19kZXNjciI6WyIxIl0sInF1aWNrX2FkZF90b19jYXJ0IjpbIjEiXSwicXVpY2tfc2hhcmUiOlsiMSJdLCJwcm9tb19wb3B1cCI6WyIxIl0sInBwX2NvbnRlbnQiOiJZb3UgY2FuIGFkZCBhbnkgSFRNTCBoZXJlIChhZG1pbiAtPiBUaGVtZSBPcHRpb25zIC0+IFByb21vIFBvcHVwKS48YnI+IFdlIHN1Z2dlc3QgeW91IGNyZWF0ZSBhIHN0YXRpYyBibG9jayBhbmQgcHV0IGl0IGhlcmUgdXNpbmcgc2hvcnRjb2RlJyIsInBwX3dpZHRoIjoiNzUwIiwicHBfaGVpZ2h0IjoiMzUwIiwicHBfYmciOnsiYmFja2dyb3VuZC1jb2xvciI6IiIsImJhY2tncm91bmQtcmVwZWF0IjoiIiwiYmFja2dyb3VuZC1hdHRhY2htZW50IjoiIiwiYmFja2dyb3VuZC1wb3NpdGlvbiI6IiIsImJhY2tncm91bmQtaW1hZ2UiOiIifSwiYmxvZ19sYXlvdXQiOiJkZWZhdWx0IiwiYmxvZ19wYWdlX2ltYWdlX3dpZHRoIjoiMTAwMCIsImJsb2dfcGFnZV9pbWFnZV9oZWlnaHQiOiI1MDAiLCJibG9nX3BhZ2VfaW1hZ2VfY3JvcHBpbmciOlsiMSJdLCJibG9nX3NpZGViYXIiOiJsZWZ0IiwiYmxvZ19zaWRlYmFyX3Jlc3BvbnNpdmUiOiJib3R0b20iLCJwb3J0Zm9saW9fY291bnQiOiItMSIsInBvcnRmb2xpb19jb2x1bW5zIjoiMyIsInJlY2VudF9wcm9qZWN0cyI6WyIxIl0sInBvcnRmb2xpb19jb21tZW50cyI6WyIxIl0sInBvcnRmb2xpb19saWdodGJveCI6WyIxIl0sInBvcnRmb2xpb19pbWFnZV93aWR0aCI6IjcyMCIsInBvcnRmb2xpb19pbWFnZV9oZWlnaHQiOiI1NTAiLCJwb3J0Zm9saW9faW1hZ2VfY3JvcHBpbmciOlsiMSJdLCJnb29nbGVfbWFwX2VuYWJsZSI6WyIxIl0sImNvbnRhY3RfcGFnZV90eXBlIjoiZGVmYXVsdCIsImNvbnRhY3RzX2VtYWlsIjoidGVzdEBnbWFpbC5jb20iLCJnb29nbGVfbWFwIjoiNTEuNTA3NjIyLC0wLjEzMDUiLCJyZXNwb25zaXZlIjpbIjEiXSwicmVzcG9uc2l2ZV9mcm9tIjoiMTIwMCIsIm5ld19vcHRpb25zIjoiIn0=',
      ),
      'corporate' => array(
          'title'   => 'corporate',
          'home_id' => '774',
      ),
      'dark' => array(
          'title'   => 'dark',
          'home_id' => '1139',
      ),
      'candy' => array(
          'title'   => 'candy',
          'home_id' => '944',
      ),
      'car' => array(
          'title'   => 'car',
          'home_id' => '789',
      ),
      'game' => array(
          'title'   => 'game',
          'home_id' => '837',
      ),
      'restaurant' => array(
          'title'   => 'restaurant',
          'home_id' => '1054',
      ),
      'sport' => array(
          'title'   => 'sport',
          'home_id' => '1020',
      ),
      'toys' => array(
          'title'   => 'toys',
          'home_id' => '1037',
      ),
      'underwear' => array(
          'title'   => 'underwear',
          'home_id' => '999',
      ),
      'watches' => array(
          'title'   => 'watches',
          'home_id' => '894',
      ),
      'left_sidebar' => array(
          'title'   => 'left sidebar',
          'home_id' => '9305',
      ),
      'onepage' => array(
          'title'   => 'onepage',
          'home_id' => '9297',
      ),
      'parallax' => array(
          'title'   => 'parallax',
          'home_id' => '9279',
      ),
      'transparent' => array(
          'title'   => 'transparent',
          'home_id' => '9295',
      ),
      'coming_soon' => array(
          'title'   => 'coming soon',
          'home_id' => '9275',
      ),
    ));
  }
}


if(!function_exists('et_get_home_option')) {
  function et_get_home_option() {
    return apply_filters('et_get_home_option', array(
      'home_1' => array(
          'title'   => 'Home Page 1',
          'home_id' => '129',
      ),
      'home_2' => array(
          'title'   => 'Home Page 2',
          'home_id' => '1164',
      ),
      'home_3' => array(
          'title'   => 'Home Page 3',
          'home_id' => '1179',
      ),
      'home_4' => array(
              'title'   => 'Home Page 4',
              'home_id' => '1188',
          ),
      'home_5' => array(
              'title'   => 'Home Page 5',
              'home_id' => '1205',
          ),
      'home_6' => array(
              'title'   => 'Home Page 6',
              'home_id' => '1215',
          ),
      'home_7' => array(
              'title'   => 'Home Page 7',
              'home_id' => '1227',
          ),
      'home_8' => array(
              'title'   => 'Home Page 8',
              'home_id' => '1247',
          ),
      'home_9' => array(
              'title'   => 'Home Page 9',
              'home_id' => '1275',
          ),
      'home_10' => array(
              'title'   => 'Home Page 10',
              'home_id' => '1282',
          ),
    ));
  }
}



if ( ! function_exists( 'ot_type_demo_data' ) ) {
  
  function ot_type_demo_data( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    $versions = et_get_versions_option();
    $home_versions = et_get_home_option();
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-backup ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

      
      $get_settings = get_option( 'option_tree' );
      $options_json = json_encode($get_settings);
      $options = base64_encode($options_json);
        
      $demo_data_installed = get_option('demo_data_installed');

        if($demo_data_installed != 'yes') : ?>  
          
          <div class="et-instal-demo">
            <button class="option-tree-ui-button blue install-ver" data-ver="ecommerce" data-home_id="129" ><?php _e('Install Base Demo Content' , ETHEME_DOMAIN ); ?></button>
          </div>

          <div class="clear"></div>
          <br />
          <p><?php _e('<strong>Note:</strong> We recommend to install base demo content first', ETHEME_DOMAIN) ?></p>

        <?php else : ?>

          <div class="clear"></div>
          <br />
          <div class="et-instal-demo">
            <p><?php _e('<strong>Note:</strong> You have already installed demo content.', ETHEME_DOMAIN) ?></p>
          </div>

        <?php endif; ?>

      <div class="format-setting-label">
        <h3 class="label">Home pages</h3>
      </div>

      <div class="et-instal-demo">
          <select class="option-tree-ui-select" id="demo_data_style">
            <?php
              foreach ( $home_versions as $key => $value) {
                echo '<option  data-home_id="' . $value['home_id'] . '" value="' . esc_attr( $key ) . '">' . esc_attr( $value['title'] ) . '</option>';
              }
            ?>
          </select>
          <a href="javascript:void(0)" class="option-tree-ui-button blue" id="install_home_pages" ><?php _e('Install Home Page' , ETHEME_DOMAIN ) ?></a>
      </div>

      <div class="format-setting-label">
        <h3 class="label">Demo versions</h3>
      </div>
      <div class="clear"></div>

      <div class="et-theme-versions">
          <?php foreach($versions as $key => $value): ?>
              <div class="theme-ver">
                  <img src="<?php echo ETHEME_CODE_IMAGES_URL.'/vers/v_'.$key.'.jpg'; ?>"> 
                  <button class="option-tree-ui-button blue install-ver" data-ver="<?php echo $key; ?>" data-home_id="<?php echo $value['home_id']; ?>" ><?php _e('Install Version' , ETHEME_DOMAIN ); ?></button>
                  <h2><?php echo $value['title']; ?></h2>
              </div>
          <?php endforeach; ?>
      </div>

<?php
 
    echo '</div>';
    
  }
  
}

/**
 * Sidebar Selector
 */
if ( ! function_exists( 'ot_type_sidebar_select' ) ) {
  
  function ot_type_sidebar_select( $args = array() ) {
  global $wp_registered_sidebars;

    /* turns arguments array into variables */
    extract( $args );
  
  if ( empty( $wp_registered_sidebars ) )
    return;
  $selected = '';
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-post-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build page select */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';

        if(count($wp_registered_sidebars) > 0) {
          echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
          
          foreach($wp_registered_sidebars as $sidebar) {
            echo '<option value="' . $sidebar['id'] . '"' . selected( $field_value === $sidebar['id'], true, false ) . '>' . $sidebar['name'] . '</option>';
          }
        }

        
        echo '</select>';
        
      echo '</div>';
      
    echo '</div>';
  }
  
}

