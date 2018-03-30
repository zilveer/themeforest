<?php
/**
 * The buttons for the shortcodes
 * 
 * @package YI Framework
 * @since 1.0
 */ 
 
$yiw_shortcodes = array(
    'one_fourth' => array(
        'name' => __( 'Column 1/4', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),
    'one_fourth_last' => array(
        'name' => __( 'Column 1/4 last', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),
    'one_third' => array(
        'name' => __( 'Column 1/3', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),    
    'one_third_last' => array(
        'name' => __( 'Column 1/3 last', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),    
    'two_third' => array(
        'name' => __( 'Column 2/3', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),    
    'two_third_last' => array(
        'name' => __( 'Column 2/3 last', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),    
    'two_fourth' => array(
        'name' => __( 'Column 2/4', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),
    'two_fourth_last' => array(
        'name' => __( 'Column 2/4 last', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),
//     'section' => array(
//         'name' => __( 'Section', 'yiw' ), 
//         'content' => true,  
//         'parameters' => array(      // la lista dei parametri da poter utilizzare nello shortcode
//             array(
//                 'name' => __( 'Icon', 'yiw' ),
//                 'id' => 'icon',
//                 'type' => 'select',
//                 'options' => array(),        
//                 'desc' => __( 'The icon shown near the title', 'yiw' ),  
//                 'std' => ''
//             ),
//             array(
//                 'name' => __( 'Size', 'yiw' ),  
//                 'id' => 'size',
//                 'type' => 'text',
//                 'std' => ''
//             ),
//             array(
//                 'name' => __( 'Title', 'yiw' ),  
//                 'id' => 'title',
//                 'type' => 'text',
//                 'desc' => __( '', 'yiw' ),
//                 'std' => ''
//             ),
//         )
//     ),
);

$yiw_shortcodes = apply_filters( 'yiw_shortcodes', $yiw_shortcodes );
 
class YIW_Tinymce {
    
    /**
     * Init the class, adding style, scripts and actions for the button
     * 
     * @since 1.0          
     */         
    function __construct() {
        add_action('init', array(&$this,'init'));
    }
    
    /**
     * Init the class, adding style, scripts and actions for the button
     * 
     * @since 1.0          
     */         
    function init() {
        add_action('media_buttons_context', array(&$this,'media_buttons_context'));
        add_action('admin_init', array(&$this,'styles_and_scripts'));   
        add_filter('mce_external_plugins', array(&$this,'add_shortcode_tinymce_plugin'));
    }
    
    /**
     * Add styles and scripts
     * 
     * @since 1.0          
     */         
    function styles_and_scripts() {
        //wp_enqueue_style('yiw-tinymce-insert-tool', YIW_FRAMEWORK_URL.'tinymce/css/toggle.css');  
    }
                
    /**
     * The markup of shortcode
     * 
     * @since 1.0          
     */    
    function media_buttons_context($context){      
    	global $post_ID, $temp_ID;
    	$iframe_ID = (int) (0 == $post_ID ? $temp_ID : $post_ID);
        $out = '<a id="add_shortcode" href="'.YIW_FRAMEWORK_URL.'tinymce/lightbox.php?post_id='.$iframe_ID.'&TB_iframe=1" class="hide-if-no-js thickbox" title="'. __("Add shortcodes", 'yiw').'"><img src="'.YIW_FRAMEWORK_URL."tinymce/images/icon_shortcodes.png".'" alt="'. __("Add Styles with Shortcodes", 'wpcss') . '" /></a>';
        return $context . $out;
	}
	
	/**
	 * Add style to the shortcode inside the visual editor
	 * 
	 * @since 1.0
	 */
    function add_shortcode_tinymce_plugin($plugin_array) {
        $plugin_array['one_fourth']         = YIW_FRAMEWORK_URL . '/tinymce/js/editor_plugin.dev.js';
        $plugin_array['one_third']          = YIW_FRAMEWORK_URL . '/tinymce/js/editor_plugin.dev.js';
        $plugin_array['two_third']          = YIW_FRAMEWORK_URL . '/tinymce/js/editor_plugin.dev.js';
        $plugin_array['two_fourth']         = YIW_FRAMEWORK_URL . '/tinymce/js/editor_plugin.dev.js';
        $plugin_array['one_fourth_last']    = YIW_FRAMEWORK_URL . '/tinymce/js/editor_plugin.dev.js';
        $plugin_array['one_third_last']     = YIW_FRAMEWORK_URL . '/tinymce/js/editor_plugin.dev.js';
        $plugin_array['two_third_last']     = YIW_FRAMEWORK_URL . '/tinymce/js/editor_plugin.dev.js';
        $plugin_array['two_fourth_last']    = YIW_FRAMEWORK_URL . '/tinymce/js/editor_plugin.dev.js';
        return $plugin_array;
    }               	
    
}   

// instance the class
new YIW_Tinymce();

/**
 * Generate the markup html to choose the shortcode to add in to the editor
 *
 * @since 1.0
 */
function yiw_dropdown_shortcodes() {
    global $yiw_shortcodes;
    
    // array with all only shortcodes name
    $html = '<select id="choose-shortcode-trigger">';          
    $html .= '<option value=""></option>';
    
    foreach ( $yiw_shortcodes as $shortcode => $args )
        $html .= '<option value="'.$shortcode.'">'.$args['name'].'</option>';
    
    $html .= '</select>';
    
    echo $html;
}   

/**
 * Markup for the fields of the shortcode
 *
 * @since 1.0
 */
function yiw_fields_shortcode( $shortcode_id ) {
    global $yiw_shortcodes;
    
    $the_ = $yiw_shortcodes[$shortcode_id];
    $html = '<input type="hidden" value="'.$shortcode_id.'" class="mce-item mce-scopentag" />';
    
    // description
    if ( isset( $the_['desc'] ) && ! empty( $the_['desc'] ) )
        $html .= '<p>'.$the_['desc'].'</p>';
    
    // the parameters
    if ( isset( $the_['parameters'] ) && is_array( $the_['parameters'] ) && ! empty( $the_['parameters'] ) ) :
    
        foreach ( $the_['parameters'] as $param ) {
            $html .= '<div class="fieldset">';                      
            
            // description
            if ( isset( $param['desc'] ) && ! empty( $param['desc'] ) )
                $html .= '<div class="description">'.$param['desc'].'</div>';
                
            $html .= '<label class="css-mce-label">'.$param['name'].'</label>';
            $html .= '<div class="css-mce-input">';
            
            switch ( $param['type'] ) {
            
                case 'text' :
                    $html .= '<input type="text" name="'.$param['id'].'" class="mce-item mce-property" />';
                    break;
            
                case 'select' :     
                    $html .= '<select name="'.$param['id'].'" class="mce-item mce-property" />'; 
                    $html .= '<option value=""></option>'; 
                    if ( isset( $the_['options'] ) && is_array( $the_['options'] ) && ! empty( $the_['options'] ) ) : 
                        foreach ( $the_['options'] as $option_id => $option_value )
                            $html .= '<option value="'.$option_id.'">'.$option_value.'</option>';     
                    endif;
                    $html .= '</select>';
                    break; 
            
                case 'checkbox' :            
                    $html .= '<input type="checkbox" name="'.$param['id'].'" class="mce-item mce-property" value="1" />';
                    break;          
            
                case 'textarea' :
                    $html .= '<textarea name="'.$param['id'].'" class="mce-item mce-property"></textarea>';
                    break;
            
                default :            
                    $html .= apply_filters( 'yiw_shortcode_parameter_type_' . $param['type'], $html, $param );
                    break;
            
            }         
            
            $html .= '<div class="clearer"></div></div><div class="clearer"></div></div>';  
        }
        
    endif; 
    
    // add the shortcode of the content of shortcode
    if ( $the_['content'] )
        $html .= '
    	    <div class="fieldset">
    			<label class="css-mce-label">Content</label>
    			<div class="css-mce-input">
    				<textarea rel="" class="mce-item mce-content" name="sws_content" id="mce-textarea-1"> </textarea>			
                </div>
    			<div class="clearer"></div>
    		</div>  
            <input type="hidden" value="'.$shortcode_id.'" class="mce-item mce-scclosetag" />
    		<input type="hidden" value="'.$shortcode_id.'" name="sc_shortcode" id="sc_shortcode" />
            ';
    
    $html .= '<div class="fieldset-buttons">
                <input type="button" value="'.__( 'Insert shortcode', 'yiw' ) . '" class="button-primary" onclick="javascript:insert_csshortcode();">
            </div>';
    
    echo $html;
}   