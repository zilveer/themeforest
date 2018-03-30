<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Text
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_upload' ) ) {
  
    function ut_render_option_upload( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="colorpicker" data-panel-for="' , esc_attr( $id ) , '">';
            
            $mime = !empty( $mime ) && is_array( $mime ) ? implode(',', $mime) : '';
            
            echo '<input autocomplete="off" type="text" name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" value="' , esc_attr( $value ) , '" class="widefat ut-option-element" />';
                        
            if( !empty( $value ) ) {
            
                /* create preview */            
                if ( preg_match( '/\.(?:jpe?g|png|gif|tiff|ico)$/i', $value ) ) {
                    
                    /* preview is an image */    
                    echo '<img id="' , esc_attr( $id ) , '_preview" class="ut-image-preview" src="' . esc_url( $value ) . '" alt="' , esc_attr( $title ) , '" />';
                        
                } else {
                    
                    $file_icons = array(
                        'default'   => 'fa-file',
                        'mp3'       => 'fa-file-audio-o',
                        'mp4'       => 'fa-file-video-o',
                        'mov'       => 'fa-file-video-o',
                        'ogg'       => 'fa-file-video-o',
                        'webm'      => 'fa-file-video-o',
                        'pdf'       => 'fa-file-pdf-o',
                        'ppt'       => 'fa-file-powerpoint-o',
                        'zip'       => 'fa-file-archive-o',
                        'rar'       => 'fa-file-archive-o',
                    );
                    
                    
                    /* get file info of uploaded file */
                    $file_info = pathinfo( $value );
                    
                    /* display an appropiate icon */
                    if( !empty($value) ) {
                    
                        if( isset( $file_info['extension'] ) && array_key_exists( strtolower($file_info['extension']), $file_icons ) ) {
                            
                            $icon = $file_icons[strtolower($file_info['extension'])];
                        
                        } else {
                            
                            $icon = $file_icons['default'];
                        
                        }                
                        
                        /* create icon */                
                        echo '<i id="' , esc_attr( $id ) , '_preview_icon" id="" class="fa ' . $icon . '"></i>';
                    
                    }
                
                }
            
            }
            
            echo '<div class="clear"></div>';
            
            echo '<div class="ut-option-group">';
                echo '<button data-mime="' , $mime , '" type="button" data-field="' , esc_attr( $id ) , '" data-title="' , esc_html__( 'Choose File', 'unite-admin' ) , '" data-preview="true" class="ut-upload-media ut-option-element ut-backend-button ut-blue-button"><i class="fa fa-upload"></i>' , esc_html__('Upload' , 'unite-admin') , '</button>';
                echo '<button type="button" data-field="' , esc_attr( $id ) , '" class="ut-delete-media ut-option-element ut-backend-button ut-red-button"><i class="fa fa-trash"></i>' , esc_html__('Delete' , 'unite-admin') , '</button>';
            echo '</div>';
            
        echo '</div>';   
        
    }

}