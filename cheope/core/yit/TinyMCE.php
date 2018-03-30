<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 


/**
 * Class to create new buttons above TinyMCE editor
 * 
 * @since 1.0.0
 */
class YIT_TinyMCE {

    /**
     * Init the class, adding style, scripts and actions for the button
     * 
     * @since 1.0          
     */         
    public function __construct() {
        add_action('init', array(&$this,'init'));
    }
    
    /**
     * Init the class, adding style, scripts and actions for the button
     * 
     * @since 1.0          
     */         
    public function init() {
        add_action('media_buttons_context', array(&$this,'media_buttons_context'));
		add_action('admin_init', array(&$this,'add_shortcodes_button'));
		add_action('admin_print_footer_scripts',  array(&$this, 'add_quicktags'));
    }
	
    /**
     * Add shortcode button to TinyMCE editor
     * 
     * @since 1.0          
     */         
    public function add_shortcodes_button() {
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
	       return;
	   if ( get_user_option('rich_editing') == 'true') {
	       add_filter('mce_external_plugins', array(&$this,'add_shortcodes_tinymce_plugin'));
	       add_filter('mce_buttons',          array(&$this,'register_shortcodes_button'));
	   }
	}
	public function register_shortcodes_button($buttons) {
	   array_push($buttons, "|", "yitshortcodes");
	   return $buttons;
	}
	
	public function add_shortcodes_tinymce_plugin($plugin_array) {
	   $plugin_array['yitshortcodes'] = YIT_CORE_URL.'/assets/js/tinymce.js';
	   return $plugin_array;
	}

	/**
	 * Add quicktags to visual editor
	 * 
	 * @since 1.0
	 */
	public function add_quicktags() {
?>
<script type="text/javascript">
if ( window.QTags !== undefined ) {
	QTags.addButton( 'shortcodes', 'add shortcodes', function(){ jQuery('#add_shortcode').click() } );
}
</script>
<?php
	}

    /**
     * The markup of shortcode
     * 
     * @since 1.0          
     */    
    public function media_buttons_context($context){      
    	global $post_ID, $temp_ID;
    	$iframe_ID = (int) (0 == $post_ID ? $temp_ID : $post_ID);
        $out = '<a id="add_shortcode" style="display:none" href="'.YIT_CORE_URL.'/templates/admin/tinymce/lightbox.php?post_id='.$iframe_ID.'&TB_iframe=1" class="hide-if-no-js thickbox" title="'. __("Add shortcode", 'yit').'"><img src="'.YIT_CORE_ASSETS_URL."/images/tinymce/icon_shortcodes.png".'" alt="'. __("Add Shortcode", 'yit') . '" /></a>';
        return $context . $out;
	}

}

if( !function_exists( 'yit_shortcode_icon' ) ) {
    /**
     * Return the shortcode icon
     * 
     * @return array
     * @since 1.0.0
     */
    function yit_shortcode_icon( $shortcode ) {
        if( file_exists( YIT_CORE_ASSETS . '/images/shortcodes/' . $shortcode . '.png' ) ) {
        	return YIT_CORE_ASSETS_URL . '/images/shortcodes/' . $shortcode . '.png';
        } elseif( file_exists( YIT_THEME_FUNC_DIR . '/assets/images/shortcodes/' . $shortcode . '.png' ) ) {
        	return YIT_THEME_FUNC_URL . '/assets/images/shortcodes/' . $shortcode . '.png';
        } else {
        	return YIT_CORE_ASSETS_URL . '/images/shortcodes/default-shortcode-icon.png';
        }
    }
}

if( !function_exists( 'yit_shortcode_print_code' ) ) {
    /**
     * Return the shortcode code
     * 
     * @return array
     * @since 1.0.0
     */
    function yit_shortcode_print_code( $shortcode ) {
        $shortcode_data = yit_get_model('shortcodes')->shortcodes[$shortcode];

		if( isset($shortcode_data['code']) && $shortcode_data['code'] != '' ) {
			return $shortcode_data['code'];
		} else {
			$return = '[' . $shortcode;
			if( !empty( $shortcode_data['attributes'] ) ) {
				foreach( $shortcode_data['attributes'] as $attribute=>$data ) {
					if( isset($data['std']) ) {
						$return .= ' ' . $attribute . '="' . $data['std'] . '"';
					} else {
						$return .= ' ' . $attribute . '=""';
					}
				}
			}
			
			$return .= ']';
			if( isset($shortcode_data['has_content']) && $shortcode_data['has_content'] ) {
				$return .= "Your content" . '[/' . $shortcode . ']';
			}
			
			return $return;			
		}

    }
}

if( !function_exists( 'yit_shortcode_print_form' ) ) {
    /**
     * Return the shortcode form
     * 
     * @return array
     * @since 1.0.0
     */
    function yit_shortcode_print_form( $shortcode ) {
        $shortcode_data = yit_get_model('shortcodes')->shortcodes[$shortcode];

		if( isset($shortcode_data['code']) && $shortcode_data['code'] != '' ) { // occhio su questo
			$return = '<div id="form-' . $shortcode . '" class="yit-shortcodes-form">';
			$return .= '<h3 class="media-title">' . $shortcode_data['title'] . '</h1>';
			$return .= '<p>' . $shortcode_data['description'] . '</p>';
			$return .= '<input name="sc_name" type="hidden" value="' . $shortcode . '" />';
			
			$return .= yit_get_template('admin/addshortcodes/code.php', array ($shortcode_data['code'], $shortcode), true);
			
			$return .= '<div class="fieldset-buttons">
			                <input type="button" class="button-primary" value="' . __('Insert shortcode', 'yit') . '">
			            </div>';
			$return .= '</div>';
			return $return;	
			
		} else {
			$return = '<div id="form-' . $shortcode . '" class="yit-shortcodes-form">';
			$return .= '<h3 class="media-title">' . $shortcode_data['title'] . '</h1>';
			$return .= '<p>' . $shortcode_data['description'] . '</p>';
			$return .= '<input name="sc_name" type="hidden" value="' . $shortcode . '" />';
			
			if( !empty( $shortcode_data['attributes'] ) ) {
				foreach( $shortcode_data['attributes'] as $attribute=>$data ) {
					$return .= yit_shortcode_print_type( $attribute, $data, $shortcode );					
				}
			}
			
			if( isset($shortcode_data['has_content']) && $shortcode_data['has_content'] ) {
				$return .= '<label>Your content</label>' . '<textarea name="shortcode-content"></textarea>';
			}
			
			if( isset($shortcode_data['multiple']) && $shortcode_data['multiple'] ) {
				$return .= '<div class="more-fields"><a class="add-more-fields" href="#">Add more fields</a></div>';
			}
			
			$return .= '<div class="fieldset-buttons">
			                <input type="button" class="button-primary" value="' . __('Insert shortcode', 'yit') . '">
			            </div>';
			$return .= '</div>';
			return $return;			
		}

    }
}

if( !function_exists( 'yit_shortcode_print_type' ) ) {
    /**
     * Return the shortcode form type
     * 
     * @return array
     * @since 1.0.0
     */
    function yit_shortcode_print_type( $attribute, $data, $shortcode ) {
        if (!isset($data['hide'])):
	        $var = array_merge(array($attribute), array($data), array($shortcode));
			if (!isset($data['multiple'])):
				return yit_get_template('admin/addshortcodes/' . $data['type'] . '.php', $var, true);
			else :
				return '<span class="multiple">' . yit_get_template('admin/addshortcodes/' . $data['type'] . '.php', $var, true) . '</span>';
			endif;
		endif;
    }
}
