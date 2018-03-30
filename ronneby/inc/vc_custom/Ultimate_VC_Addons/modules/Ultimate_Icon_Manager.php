<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Icon Manager
* Add-on URI: https://www.brainstormforce.com
*/
if(!class_exists('AIO_Icon_Manager'))
{
	class AIO_Icon_Manager
	{
		var $paths = array();
		var $svg_file;
		var $json_file;
		var $vc_fonts;
		var $vc_fonts_dir;
		var $font_name = 'unknown';
		var $unicode = '';
		var $svg_config = array();
		var $json_config = array();
		static $charlist = array(); 
		static $charlist_fallback = array(); 
		static $iconlist = array(); 
		var $assets_js;
		var $assets_css;
		var $admin_js;
		var $admin_css;
		function __construct()
		{
			$this->assets_js = get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/js/';
			$this->assets_css = get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/css/';
			$this->admin_js = get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/js/';
			$this->admin_css = get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/css/';
			$this->paths = wp_upload_dir();
			$this->paths['fonts'] 	= 'dfd_ronneby_fonts';
			$this->paths['temp']  	= trailingslashit($this->paths['fonts']).'smile_temp';
			$this->paths['fontdir'] = trailingslashit($this->paths['basedir']).$this->paths['fonts'];
			$this->paths['tempdir'] = trailingslashit($this->paths['basedir']).$this->paths['temp'];
			$this->paths['fonturl'] = set_url_scheme(trailingslashit($this->paths['baseurl']).$this->paths['fonts']);
			$this->paths['tempurl'] = trailingslashit($this->paths['baseurl']).trailingslashit($this->paths['temp']);
			$this->paths['config']	= 'charmap.php';
			$this->vc_fonts = trailingslashit($this->paths['basedir']).$this->paths['fonts'].'/'.DFD_THEME_SETTINGS_NAME;
			$this->vc_fonts_dir = get_stylesheet_directory().'/inc/vc_custom/Ultimate_VC_Addons/assets/fonts/';
			//font file extract by ajax function
			add_action('wp_ajax_smile_ajax_add_zipped_font', array($this, 'add_zipped_font'));
			add_action('wp_ajax_smile_ajax_remove_zipped_font', array($this, 'remove_zipped_font'));
			add_action('admin_menu',array($this,'icon_manager_menu'));
			$defaults = get_option('dfd_ronneby_fonts');
			if(!$defaults){
				add_action('init',array($this,'AIO_move_fonts'));
			}
			// Generate param type "icon_manager"
			if(function_exists('vc_add_shortcode_param'))
			{
				vc_add_shortcode_param('icon_manager', array($this,'icon_manager'));
				vc_add_shortcode_param('number' , array(&$this, 'number_settings_field' ));
				vc_add_shortcode_param('heading' , array($this, 'heading_settings_field' ));
				vc_add_shortcode_param('colorpicker_alpha' , array($this, 'colorpicker_alpha_gen'));
				vc_add_shortcode_param('datetimepicker' , array($this, 'datetimepicker'));
				vc_add_shortcode_param('animator' , array($this, 'animator_param'));
				vc_add_shortcode_param('ult_select2' , array($this, 'select2_param'));
				vc_add_shortcode_param('ult_button' , array($this, 'button_prev_param'));
				vc_add_shortcode_param('chk-switch' , array($this, 'checkboxes_param'));
				vc_add_shortcode_param('ult_switch' , array($this, 'checkbox_param'));
				vc_add_shortcode_param('ult_param_heading' , array($this, 'ult_param_heading_callback'));
			}
		}
		function ult_param_heading_callback($settings, $value)
		{
			//$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$text = isset($settings['text']) ? $settings['text'] : '';
			$output = '<h4 class="wpb_vc_param_value '.$class.'">'.$text.'</h4>';
			return $output;
		}
		function button_prev_param($settings, $value){
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$json = isset($settings['json']) ? $settings['json'] : '';
			$jsonIterator = json_decode($json,true);
			$selector = '<select name="'.esc_attr($param_name).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '">';
			foreach ($jsonIterator as $key => $val) {
				if(is_array($val)) {
					$labels = str_replace('_',' ', $key);
					$selector .= '<optgroup label="'.ucwords($labels).'">';
					foreach($val as $label => $style){
						$label = str_replace('_',' ', $label);
						if($style == $value)
							$selector .= '<option selected value="'.esc_attr($style).'">'.$label.'</option>';
						else
							$selector .= '<option value="'.esc_attr($style).'">'.$label.'</option>';
					}
				} else {
					if($val == $value)
						$selector .= "<option selected value=".esc_attr($val).">".$key."</option>";
					else
						$selector .= "<option value=".esc_attr($val).">".$key."</option>";
				}
			}
			$selector .= '<select>';
			
			$output = '';
			$output .= '<div class="select2_option" style="width: 45%; float: left;">';
			$output .= $selector;
			$output .= '</div>';
			$output .= '<div class="anim_prev" style="width: 45%; float: left; text-align: center; margin-left: 15px; margin-top: -15px;">';
			$output .= '<button class="ubtn ubtn-normal ubtn-sep-icon ubtn-center ubtn-sep-icon-left-rev" data-animation="ubtn-sep-icon-left-push" style="border-radius:3px; border-width:1px; border-color:#ffffff; border-style:solid; background: #2786ce;color: #ffffff;"><span class="ubtn-data ubtn-icon"><i class="Defaults-star" style="font-size:20px;color:;"></i></span><span class="ubtn-hover" style="background: rgb(30, 115, 190);"></span><span class="ubtn-data ubtn-text">Button</span></button>';
			$output .= '</div>';
			$output .= '<script type="text/javascript">
					jQuery(document).ready(function(){
						var animator = jQuery(".'.esc_js($param_name).'");
						var anim_target = jQuery(".ubtn");
						animator.on("change",function(){
							var anim = jQuery(this).val();
							var prev_anim = anim_target.data("animation");
							anim_target.removeClass().addClass("ubtn ubtn-normal ubtn-sep-icon ubtn-center ubtn-sep-icon-left-rev " + anim);
						});
					});
				</script>';
			return $output;
		}
		function select2_param($settings, $value){
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$json = isset($settings['json']) ? $settings['json'] : '';
			$jsonIterator = json_decode($json,true);
			$selector = '<select name="'.esc_attr($param_name).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '">';
			foreach ($jsonIterator as $key => $val) {
				if(is_array($val)) {
					$labels = str_replace('_',' ', $key);
					$selector .= '<optgroup label="'.ucwords($labels).'">';
					foreach($val as $label => $style){
						$label = str_replace('_',' ', $label);
						if($style == $value)
							$selector .= '<option selected value="'.esc_attr($style).'">'.$label.'</option>';
						else
							$selector .= '<option value="'.esc_attr($style).'">'.$label.'</option>';
					}
				} else {
					if($val == $value)
						$selector .= "<option selected value=".esc_attr($val).">".$key."</option>";
					else
						$selector .= "<option value=".esc_attr($val).">".$key."</option>";
				}
			}
			$selector .= '<select>';
			
			$output = '';
			$output .= '<div class="select2_option" style="width: 45%; float: left;">';
			$output .= $selector;
			$output .= '</div>';
			return $output;
		}
		function checkboxes_param($settings, $value){
			//$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$options = isset($settings['options']) ? $settings['options'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = $checked = '';
			$values = explode(",",$value);
			$un = uniqid('chkparam-'.rand());
			if(is_array($options) && !empty($options)){
				foreach($options as $key => $opts){
					if(is_array($values) && !empty($values)){
						if(in_array($key,$values)){
							$checked = "checked";
						} else {
							$checked = "";
						}
					}
					$uid = uniqid('chkparaminside-'.esc_attr(rand()));
					$output .= '<div class="onoffswitch">
							<input type="checkbox" name="'.esc_attr($param_name).'[]" value="'.esc_attr($key).'" class="onoffswitch-checkbox chk-switch-'.esc_attr($un).'" id="switch'.esc_attr($uid).'" '.$checked.'>
							<label class="onoffswitch-label" for="switch'.esc_attr($uid).'">
								<div class="onoffswitch-inner">
									<div class="onoffswitch-active">
										<div class="onoffswitch-switch">'.$opts['on'].'</div>
									</div>
									<div class="onoffswitch-inactive">
										<div class="onoffswitch-switch">'.$opts['off'].'</div>
									</div>
								</div>
							</label>
						</div>';
					$output .= '<div class="chk-label">'.$opts['label'].'</div><br/>';
				}
			}
			$output .= '<input type="hidden" id="chk-switch-'.esc_attr($un).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="' . esc_attr($param_name) . '" value="'.esc_attr($value).'" />';
			$output .= '<script type="text/javascript">
				jQuery(".chk-switch-'.esc_attr($un).'").change(function(){
					 var val = "";
					 var l = jQuery(".chk-switch-'.esc_attr($un).':checked").length;
					 var c = 1;
					 jQuery(".chk-switch-'.esc_attr($un).'").each(function(index, element) {
						if(jQuery(this).is(":checked")){
							val += jQuery(this).val();
							if(l>1 && c!=l)
								val += ",";
							c++;
						}
					});
					jQuery("#chk-switch-'.esc_attr($un).'").val(val);
				});
			</script>';
			
			return $output;
		}
		function animator_param($settings, $value){
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$json = ultimate_get_animation_json();
			$jsonIterator = json_decode($json,true);
			
			$animators = '<select name="'.esc_attr($param_name).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '">';
			/*
			foreach ($jsonIterator as $key => $val) {
				if(is_array($val)) {
					$labels = str_replace('_',' ', $key);
					$animators .= '<optgroup label="'.ucwords($labels).'">';
				} else {
					if($key == $value)
						$animators .= "<option selected value=".$key.">".$key."</option>";
					else
						$animators .= "<option value=".$key.">".$key."</option>";
				}
			}
			*/
			foreach ($jsonIterator as $key => $val) {
				if(is_array($val)) {
					$labels = str_replace('_',' ', $key);
					$animators .= '<optgroup label="'.ucwords($labels).'">';
					foreach($val as $label => $style){
						$label = str_replace('_',' ', $label);
						if($label == $value)
							$animators .= '<option selected value="'.esc_attr($label).'">'.$label.'</option>';
						else
							$animators .= '<option value="'.esc_attr($label).'">'.$label.'</option>';
					}
				} else {
					if($key == $value)
						$animators .= "<option selected value=".esc_attr($key).">".$key."</option>";
					else
						$animators .= "<option value=".esc_attr($key).">".$key."</option>";
				}
			}
			$animators .= '<select>';
			
			$output = '';
			$output .= '<div class="select_anim" style="width: 45%; float: left;">';
			$output .= $animators;
			$output .= '</div>';
			$output .= '<div class="anim_prev" style=" padding: 8px; width: 45%; float: left; text-align: center; margin-left: 15px;"> <span id="animate-me" style="padding: 15px; background: #1C8FCF; color: #FFF;">Animation Preview</span></div>';
			$output .= '<script type="text/javascript">
					jQuery(document).ready(function(){
						var animator = jQuery(".'.esc_attr($param_name).'");
						var anim_target = jQuery("#animate-me");
						animator.on("change",function(){
							var anim = jQuery(this).val();
							anim_target.removeClass().addClass(anim + " animated").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function(){jQuery(this).removeClass();
							});
						});
					});
				</script>';
			return $output;
		}
		function colorpicker_alpha_gen($settings, $value)
		{
			$base = $opacity = $output = '';
			//$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$uni = uniqid('colorpicker-'.rand());
			if($value != ''){
				$arr_v = explode(',', $value);
				if(is_array($arr_v)){
					if(isset($arr_v[1])){
						$opacity = $arr_v[1];
					}
					if(isset($arr_v[0])){
						$base = $arr_v[0];
					}
				}
			}
			else{
				//$opacity=1;
				//$base='#fff';
			}
			$output = '
                <input id="alpha_val'.esc_attr($uni).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . ' vc_column_alpha" value="'.esc_attr($value).'" data-uniqid="'.esc_attr($uni).'" data-opacity="'.esc_attr($opacity).'" data-hex-code="'.esc_attr($base).'"/>
';
			$output .= '
<input class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="'.esc_attr($param_name).'" value="'.esc_attr($value).'" style="display:none"/>
<button class="alpha_clear" type="button">clear</button>
';
			?> 
			<script type="text/javascript">				
				jQuery(document).ready(function(){
					function colorpicker_alpha(selector,id_prefix){
						jQuery(selector).each(function(){							
							var aid = jQuery(this).data('uniqid');
							jQuery(id_prefix+aid).minicolors({
								change: function(hex, opacity) {
									console.log(hex+','+opacity);
									jQuery(this).parent().next().val(hex+','+opacity);
									console.log(jQuery(this).parent().next().attr('class'))
								},
								opacity: true,
								defaultValue: jQuery(this).data('hex-code'),								
								position: 'default',
							});
							jQuery('.alpha_clear').click(function(){								
								jQuery(this).parent().find('input').val('');
								jQuery(this).parent().find('.minicolors-swatch-color').css('background-color','');
								//$select.val('');
								//jQuery(id_prefix+aid).val('');
								//jQuery(id_prefix+aid).next().find('.minicolors-swatch-color').css('background-color','');
							})
						});
					}
					colorpicker_alpha('.vc_column_alpha','#alpha_val');
				})
				</script>
            <?php
			return $output;
		}
		function datetimepicker($settings, $value)
		{
			//$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$uni = uniqid('datetimepicker-'.esc_attr(rand()));
			$output = '<div id="ult-date-time'.esc_attr($uni).'" class="ult-datetime"><input data-format="yyyy/MM/dd hh:mm:ss" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="' . esc_attr($param_name) . '" style="width:258px;" value="'.esc_attr($value).'" /><div class="add-on" >  <i data-time-icon="Defaults-time" data-date-icon="Defaults-time"></i></div></div>';
			$output .= '<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("#ult-date-time'.esc_attr($uni).'").datetimepicker({
						language: "pt-BR"
					});
				})
				</script>';
			return $output;
		}
		function heading_settings_field($settings, $value)
		{
			$output = '<div class="vc_type_heading"><p>'.$settings['sub_heading'].'</p></div>';
			return $output;
		}
		// Function generate param type "number"
		function number_settings_field($settings, $value)
		{
			//$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$min = isset($settings['min']) ? $settings['min'] : '';
			$max = isset($settings['max']) ? $settings['max'] : '';
			$step = isset($settings['step']) ? $settings['step'] : '';
			$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = '<input type="number" min="'.esc_attr($min).'" max="'.esc_attr($max).'" step="'.esc_attr($step).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="' . esc_attr($param_name) . '" value="'.esc_attr($value).'" style="max-width:100px; margin-right: 10px;" />'.$suffix;
			return $output;
		}
		function icon_manager($settings, $value)
		{
			$font_manager = AIO_Icon_Manager::get_font_manager();
			//$dependency = vc_generate_dependencies_attributes($settings);
			$output = '<div class="my_param_block">'
					 .'<input name="'.esc_attr($settings['param_name']).'"
					  class="wpb_vc_param_value wpb-textinput '.esc_attr($settings['param_name']).' 
					  '.esc_attr($settings['type']).'_field" type="hidden" 
					  value="'.esc_attr($value).'" />'
					 .'</div>';
			$output .= '<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".preview-icon").html("<i class=\''.esc_js($value).'\'></i>");
					jQuery("li[data-icons=\''.esc_js($value).'\']").addClass("selected");
				});
				jQuery(".icons-list li").click(function() {
                    jQuery(this).attr("class","selected").siblings().removeAttr("class");
                    var icon = jQuery(this).attr("data-icons");
                    jQuery("input[name=\''.esc_js($settings['param_name']).'\']").val(icon);
                    jQuery(".preview-icon").html("<i class=\'"+icon+"\'></i>");
                });
				</script>';
			$output .= $font_manager;
			return $output;
		}
		// Icon font manager
		public function get_icon_manager($input_name, $icon)
		{
			$font_manager = self::get_font_manager();
			$output = '<div class="my_param_block">';
			$output .= '<input name="'.esc_attr($input_name).'" class="textinput '.esc_attr($input_name).' text_field" type="hidden" value="'.esc_attr($icon).'"/>';
			$output .= '</div>';
			$output .= '<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".preview-icon").html("<i class=\''.esc_js($icon).'\'></i>");
					jQuery("li[data-icons=\''.esc_js($icon).'\']").addClass("selected");
				});
				jQuery(".icons-list li").click(function() {
					jQuery(this).attr("class","selected").siblings().removeAttr("class");
					var icon = jQuery(this).attr("data-icons");
					jQuery("input[name=\''.esc_js($input_name).'\']").val(icon);
					jQuery(".preview-icon").html("<i class=\'"+icon+"\'></i>");
				});
				</script>';
			$output .= $font_manager;
			return $output;
		}
		// ult_switch param
		function checkbox_param($settings, $value){
			//$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$options = isset($settings['options']) ? $settings['options'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = $checked = '';
			$un = uniqid('ultswitch-'.rand());
			if(is_array($options) && !empty($options)){
				foreach($options as $key => $opts){
					if($value == $key){
						$checked = "checked";
					} else {
						$checked = "";
					}
					$uid = uniqid('ultswitchparam-'.rand());
					$output .= '<div class="onoffswitch">
							<input type="checkbox" name="'.esc_attr($param_name).'" value="'.esc_attr($value).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . ' onoffswitch-checkbox chk-switch-'.esc_attr($un).'" id="switch'.esc_attr($uid).'" '.$checked.'>
							<label class="onoffswitch-label" for="switch'.esc_attr($uid).'">
								<div class="onoffswitch-inner">
									<div class="onoffswitch-active">
										<div class="onoffswitch-switch">'.$opts['on'].'</div>
									</div>
									<div class="onoffswitch-inactive">
										<div class="onoffswitch-switch">'.$opts['off'].'</div>
									</div>
								</div>
							</label>
						</div>';
						if(isset($opts['label']))
							$lbl = $opts['label'];
						else
							$lbl = '';
					$output .= '<div class="chk-label">'.$lbl.'</div><br/>';
				}
			}
			
			//$output .= '<input type="hidden" id="chk-switch-'.$un.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
			$output .= '<script type="text/javascript">
				jQuery("#switch'.esc_js($uid).'").change(function(){
					 
					 if(jQuery("#switch'.esc_js($uid).'").is(":checked")){
						jQuery("#switch'.esc_js($uid).'").val("'.esc_js($key).'");
						jQuery("#switch'.esc_js($uid).'").attr("checked","checked");
					 } else {
						jQuery("#switch'.esc_js($uid).'").val("off");
						jQuery("#switch'.esc_js($uid).'").removeAttr("checked");
					 }
					
				});
			</script>';
			
			return $output;
		}
		function icon_manager_menu()
		{
			$page = add_submenu_page(
				"bsf-dashboard",
				__("Icon Manager",'dfd'),
				__("Icon Manager",'dfd'),
				"administrator",
				"font-icon-Manager",
				array($this,'icon_manager_dashboard')
			);
			add_action( 'admin_print_scripts-' . $page, array($this,'admin_scripts'));
		}
		function admin_scripts()
		{
			// enqueue js files on backend
			wp_enqueue_script('aio-admin-media',$this->admin_js.'admin-media.js',array('jquery'));
			wp_enqueue_script('media-upload');
			wp_enqueue_media();
			wp_enqueue_style('aio-icon-manager-admin',$this->admin_css.'icon-manager-admin.css');
			
			$fonts = get_option('dfd_ronneby_fonts');
			if(is_array($fonts))
			{
				foreach($fonts as $font => $info)
				{
					if(strpos($info['style'], 'http://' ) !== false) {
						wp_enqueue_style('bsf-'.$font,$info['style']);
					} else {
						wp_enqueue_style('bsf-'.$font,trailingslashit($this->paths['fonturl']).$info['style']);
					}
				}
			}
		}// end AIO_admin_scripts
		function icon_manager_dashboard()
		{
		?>
            <div class="wrap">
            <h2>
            <?php _e('Icon Fonts Manager','dfd'); ?>
            <a href="#smile_upload_icon" class="add-new-h2 smile_upload_icon" data-target="iconfont_upload" data-title="Upload/Select Fontello Font Zip" data-type="application/octet-stream, application/zip" data-button="Insert Fonts Zip File" data-trigger="smile_insert_zip" data-class="media-frame ">
            <?php _e('Upload New Icons','dfd'); ?>
            </a> &nbsp;<span class="spinner"></span></h2>
            <div id="msg"></div>
            <?php
                        $fonts = get_option('dfd_ronneby_fonts');
                        if(is_array($fonts)) :
                        ?>
            <div class="metabox-holder meta-search">
              <div class="postbox">
                <h3>
            <input class="search-icon" type="text" placeholder="Search" />
            <span class="search-count"></span> </h3>
            </div>
            </div>
            <?php	self::get_font_set();	?>
            </div>
                        <?php else: ?>
                        <div class="error">
                          <p>
                            <?php _e('No font icons uploaded. Upload some font icons to display here.','dfd');?>
            </p>
            </div>
            <?php
			endif;
        }
		public static function get_font_manager()
		{
			$fonts =  get_option('dfd_ronneby_fonts');
			$output = '<p><div class="preview-icon"><i class=""></i></div><input class="search-icon" type="text" placeholder="Search for a suitable icon.." /></p>';
			$output .= '<div id="smile_icon_search">';
			$output .= '<ul class="icons-list smile_icon">';
			foreach($fonts as $font => $info)
			{
				$icon_set = array();
				$icons = array();
				$upload_dir = wp_upload_dir();
				$path		= trailingslashit($upload_dir['basedir']);
				$file = $path.$info['include'].'/'.$info['config'];
				include($file);
				if(!empty($icons))
				{
					$icon_set = array_merge($icon_set,$icons);
				}
				if($font == "smt")
					$set_name = 'Default Icons';
				else
					$set_name = ucfirst($font);
				if(!empty($icon_set))
				{
					$output .= '<p><strong>'.$set_name.'</strong></p>';
					$output .= '<li title="no-icon" data-icons="none" data-icons-tag="none,blank" style="cursor: pointer;"></li>';
					foreach($icon_set as $icons)
					{
						foreach($icons as $icon)
						{
							if($font == "smt" || $font == 'Defaults') {
								$output .= '<li title="'.esc_attr($icon['class']).'" data-icons="'.esc_attr($icon['class']).'" data-icons-tag="'.esc_attr($icon['tags']).'">';
								$output .= '<i class="'.esc_attr($icon['class']).'"></i><label class="icon">'.$icon['class'].'</label></li>';
							} else {
								$output .= '<li title="'.esc_attr($icon['class']).'" data-icons="'.esc_attr($font).'-'.esc_attr($icon['class']).'" data-icons-tag="'.esc_attr($icon['tags']).'">';
								$output .= '<i class="'.esc_attr($font).'-'.esc_attr($icon['class']).'"></i><label class="icon">'.$icon['class'].'</label></li>';
							}
						}
					}
				}
			}
			$output .'</ul>';
			$output .= '<script type="text/javascript">
					jQuery(document).ready(function(){
						setTimeout(function() {
							jQuery(".search-icon").focus();
						}, 1000);
						jQuery(".search-icon").keyup(function(){
							// Retrieve the input field text and reset the count to zero
							var filter = jQuery(this).val(), count = 0;
							// Loop through the icon list
							jQuery(".icons-list li").each(function(){
								// If the list item does not contain the text phrase fade it out
								if (jQuery(this).attr("data-icons-tag").search(new RegExp(filter, "i")) < 0) {
									jQuery(this).fadeOut();
								} else {
									jQuery(this).show();
									count++;
								}
							});
						});
					});
			</script>';
			$output .= '</div>';
			return $output;
		}
		// Generate Icon Set Preview and settings page
		static function get_font_set()
		{
			$fonts =  get_option('dfd_ronneby_fonts');
			$n = count($fonts);
			foreach($fonts as $font => $info)
			{
				$icon_set = array();
				$icons = array();
				$upload_dir = wp_upload_dir();
				$path		= trailingslashit($upload_dir['basedir']);
				$file = $path.$info['include'].'/'.$info['config'];
				$output = '<div class="icon_set-'.esc_attr($font).' metabox-holder">';
				$output .= '<div class="postbox">';
				include($file);
				if(!empty($icons))
				{
					$icon_set = array_merge($icon_set,$icons);
				}
				if(!empty($icon_set))
				{
					foreach($icon_set as $icons)
					{
						$count = count($icons);
					}
					if($font == 'smt' || $font == 'Defaults')
						$output .= '<h3 class="icon_font_name"><strong>'.__("Theme Default Icons",'dfd').'</strong>';
					else
						$output .= '<h3 class="icon_font_name"><strong>'.ucfirst($font).'</strong>';
					$output .= '<span class="fonts-count count-'.esc_attr($font).'">'.$count.'</span>';
					if($n != 1)
						$output .= '<button class="button button-secondary button-small smile_del_icon" data-delete='.esc_attr($font).' data-title="Delete This Icon Set">Delete Icon Set</button>';
					$output .= '</h3>';
					$output .= '<div class="inside"><div class="icon_actions">';
					$output .= '</div>';
					$output .= '<div class="icon_search"><ul class="icons-list fi_icon">';
					foreach($icon_set as $icons)
					{
						foreach($icons as $icon)
						{
							$output .= '<li title="'.esc_attr($icon['class']).'" data-icons="'.esc_attr($icon['class']).'" data-icons-tag="'.esc_attr($icon['tags']).'">';
							if($font == 'smt' || $font == 'Defaults')
								$output .= '<i class="'.esc_attr($icon['class']).'"></i><label class="icon">'.$icon['class'].'</label></li>';
							else
								$output .= '<i class="'.esc_attr($font).'-'.esc_attr($icon['class']).'"></i><label class="icon">'.$icon['class'].'</label></li>';
						}
					}
					$output .'</ul>';
					$output .= '</div><!-- .icon_search-->';
					$output .= '</div><!-- .inside-->';
					$output .= '</div><!-- .postbox-->';
					$output .= '</div><!-- .icon_set-'.esc_attr($font).' -->';
					echo $output;
				}
			}
			$script = '<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".search-icon").keyup(function(){
						jQuery(".fonts-count").hide();
						// Retrieve the input field text and reset the count to zero
						var filter = jQuery(this).val(), count = 0;
						// Loop through the icon list
						jQuery(".icons-list li").each(function(){
							// If the list item does not contain the text phrase fade it out
							if (jQuery(this).attr("data-icons-tag").search(new RegExp(filter, "i")) < 0) {
								jQuery(this).fadeOut();
							} else {
								jQuery(this).show();
								count++;
							}
							if(count == 0)
								jQuery(".search-count").html(" Can\'t find the icon? <a href=\'#smile_upload_icon\' class=\'add-new-h2 smile_upload_icon\' data-target=\'iconfont_upload\' data-title=\'Upload/Select Fontello Font Zip\' data-type=\'application/octet-stream, application/zip\' data-button=\'Insert Fonts Zip File\' data-trigger=\'smile_insert_zip\' data-class=\'media-frame\'>Click here to upload</a>");
							else
								jQuery(".search-count").html(count+" Icons found.");
							if(filter == "")
								jQuery(".fonts-count").show();
						});
					});
				});
			</script>';
			echo $script;
		}
		function add_zipped_font()
		{
			//check if referer is ok
			//if(function_exists('check_ajax_referer')) { check_ajax_referer('smile_nonce_save_backend'); }
				//check if capability is ok
			$cap = apply_filters('avf_file_upload_capability', 'update_plugins');
			if(!current_user_can($cap)) 
			{
				die( "Using this feature is reserved for Super Admins. You unfortunately don't have the necessary permissions." );
			}
			//get the file path of the zip file
			$attachment = $_POST['values'];
			$path 		= realpath(get_attached_file($attachment['id']));
			$unzipped 	= $this->zip_flatten( $path , array('\.eot','\.svg','\.ttf','\.woff','\.json','\.css'));
				// if we were able to unzip the file and save it to our temp folder extract the svg file
			if($unzipped)
			{
				$this->create_config();
			}
			//if we got no name for the font dont add it and delete the temp folder
			if($this->font_name == 'unknown')
			{
				$this->delete_folder($this->paths['tempdir']);
				die('Was not able to retrieve the Font name from your Uploaded Folder');
			}
			die('smile_font_added:'.$this->font_name);
		}
		function remove_zipped_font()
		{
			//get the file path of the zip file
			$font 		= $_POST['del_font'];
			$list 		= self::load_iconfont_list();
			$delete		= isset($list[$font]) ? $list[$font] : false;
			if($delete)
			{
				$this->delete_folder($delete['include']);
				$this->remove_font($font);
					die('smile_font_removed');
			}
			die('Was not able to remove Font');
		}
		//extract the zip file to a flat folder and remove the files that are not needed
		function zip_flatten ( $zipfile , $filter) 
		{ 	
			@ini_set( 'memory_limit', apply_filters( 'admin_memory_limit', WP_MAX_MEMORY_LIMIT ) );
			if(is_dir($this->paths['tempdir'])){
				$this->delete_folder($this->paths['tempdir']);
				$tempdir = smile_backend_create_folder($this->paths['tempdir'], false);
			} else {
				$tempdir = smile_backend_create_folder($this->paths['tempdir'], false);
			}
			//$fontdir = smile_backend_create_folder($this->paths['fontdir'], false);
			if(!$tempdir) die('Wasn\'t able to create temp folder');
				$zip = new ZipArchive; 
			if ( $zip->open( $zipfile ) ) 
			{ 
				for ( $i=0; $i < $zip->numFiles; $i++ ) 
				{ 
					$entry = $zip->getNameIndex($i); 
					if(!empty($filter))
					{
						$delete 	= true;
						$matches 	= array();
						foreach($filter as $regex)
						{
							preg_match("!".$regex."!", $entry , $matches);
							if(!empty($matches))
							{
								$delete = false;
								break;
							}
						}
					}
					if ( substr( $entry, -1 ) == '/' || !empty($delete)) continue; // skip directories and non matching files
						$fp 	= $zip->getStream( $entry ); 
					$ofp 	= fopen( $this->paths['tempdir'].'/'.basename($entry), 'w' ); 
					if ( ! $fp ) 
						die('Unable to extract the file.'); 
					while ( ! feof( $fp ) ) 
						fwrite( $ofp, fread($fp, 8192) ); 
					fclose($fp); 
					fclose($ofp); 
				} 
			 $zip->close(); 
			}
			else
			{
				die('Wasn\'t able to work with Zip Archive');
			}
			return true; 
		} 
		//iterate over xml file and extract the glyphs for the font
		function create_config()
		{
			$this->json_file = $this->find_json();
			$this->svg_file = $this->find_svg();
			if(empty($this->json_file) || empty($this->svg_file))
			{
				$this->delete_folder($this->paths['tempdir']);
				die('selection.json or SVG file not found. Was not able to create the necessary config files');
			}
			//$response 	= wp_remote_get( $this->paths['tempurl'].$this->svg_file );
			$response   	= wp_remote_fopen(trailingslashit($this->paths['tempurl']).$this->svg_file );
			//if wordpress wasnt able to get the file which is unlikely try to fetch it old school
			$json = file_get_contents(trailingslashit($this->paths['tempdir']).$this->json_file );
			if(empty($response)) $response = file_get_contents(trailingslashit($this->paths['tempdir']).$this->svg_file );
			if (!is_wp_error($json) && !empty($json))
			{
				$xml = simplexml_load_string($response);
				$font_attr = $xml->defs->font->attributes();
				$glyphs = $xml->defs->font->children();
				$this->font_name = (string) $font_attr['id'];
				$unicodes = array();
				foreach($glyphs as $item => $glyph)
				{
					if($item == 'glyph')
					{
						$attributes = $glyph->attributes();
						$unicode	=  (string) $attributes['unicode'];
						array_push($unicodes,$unicode);
					}
				}
				$font_folder = trailingslashit($this->paths['fontdir']).$this->font_name;
				if(is_dir($font_folder))
				{
					$this->delete_folder($this->paths['tempdir']);
					die("It seems that the font with the same name is already exists! Please upload the font with different name.");
				}
				$file_contents = json_decode($json);
				if(!isset($file_contents->IcoMoonType)){
					$this->delete_folder($this->paths['tempdir']);
					die('Uploaded font is not from IcoMoon. Please upload fonts created with the IcoMoon App Only.');
				}
				$icons = $file_contents->icons;
				unset($unicodes[0]);
				$n = 1;
				foreach($icons as $icon)
				{
					$icon_name = $icon->properties->name;
					$tags = implode(",",$icon->icon->tags);
					$this->json_config[$this->font_name][$icon_name] = array(
							"class" => str_replace(' ', '', $icon_name),
							"tags" => $tags,
							"unicode" => $unicodes[$n]
					);
					$n++;
				}
				if(!empty($this->json_config) && $this->font_name != 'unknown')
				{
					$this->write_config();
					$this->re_write_css();
					$this->rename_files();
					$this->rename_folder();
					$this->add_font();
				}
			}
			return false;
		}
		//writes the php config file for the font
		function write_config()
		{
			$charmap 	= $this->paths['tempdir'].'/'.$this->paths['config'];
			$handle 	= @fopen( $charmap, 'w' );
			if ($handle)
			{
				fwrite( $handle, '<?php $icons = array();');
				foreach($this->json_config[$this->font_name] as $icon => $info)
				{
					if(!empty($info))
					{
						$delimiter = "'";
						fwrite( $handle, "\r\n".'$icons[\''.$this->font_name.'\']['.$delimiter.$icon.$delimiter.'] = array("class"=>'.$delimiter.$info["class"].$delimiter.',"tags"=>'.$delimiter.$info["tags"].$delimiter.',"unicode"=>'.$delimiter.$info["unicode"].$delimiter.');' );
					}
					else
					{
						$this->delete_folder($this->paths['tempdir']);
						die('Was not able to write a config file');
					}
				} 	        
				fclose( $handle );
			}
			else
			{
				$this->delete_folder($this->paths['tempdir']);
				die('Was not able to write a config file');
			}
		}
		//re-writes the php config file for the font
		function re_write_css()
		{
			$style 	= $this->paths['tempdir'].'/style.css';
			$file = @file_get_contents($style);
			if($file) {
				$str = str_replace('fonts/', '', $file);
				$str = str_replace('icon-', $this->font_name.'-', $str);
				$str = str_replace('.icon {', '[class^="'.$this->font_name.'-"], [class*=" '.$this->font_name.'-"] {', $str);
				
				/* remove comments */
				$str = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $str );
		
				/* remove tabs, spaces, newlines, etc. */
				$str = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $str );

				@file_put_contents($style,$str);
			}
			else
			{
				die('Unable to write css. Upload icons downloaded only from icomoon');
			}
		}
		function rename_files()
		{
			$extensions = array('eot','svg','ttf','woff','css');
			$folder = trailingslashit($this->paths['tempdir']);
			foreach(glob($folder.'*') as $file)   
			{  
				$path_parts = pathinfo($file);
				if(strpos($path_parts['filename'], '.dev') === false && in_array($path_parts['extension'], $extensions) )
				{
					if($path_parts['filename'] !== $this->font_name)
						rename($file, trailingslashit($path_parts['dirname']).$this->font_name.'.'.$path_parts['extension']);
				}
			} 
		}
		//rename the temp folder and all its font files
		function rename_folder()
		{
			$new_name = trailingslashit($this->paths['fontdir']).$this->font_name;
			//delete folder and contents if they already exist
			$this->delete_folder($new_name);
			if(rename($this->paths['tempdir'], $new_name)){
				return true;
			} else {
				$this->delete_folder($this->paths['tempdir']);
				die("Unable to add this font. Please try again.");
			}
		}
		//delete a folder
		function delete_folder($new_name)
		{
			//delete folder and contents if they already exist
			if(is_dir($new_name))
			{
				$objects = scandir($new_name);
				 foreach ($objects as $object) {
				   if ($object != "." && $object != "..") {
					 unlink($new_name."/".$object);
				   }
				 }
				 reset($objects);
				 rmdir($new_name);
			}
		}
		function add_font()
		{
			$fonts = get_option('dfd_ronneby_fonts');
			if(empty($fonts)) $fonts = array();
			$fonts[$this->font_name] = array( 
				'include'   => trailingslashit($this->paths['fonts']).$this->font_name, 
				'folder' 	=> trailingslashit($this->paths['fonts']).$this->font_name,
				'style'	 => $this->font_name.'/'.$this->font_name.'.css',
				'config' 	=> $this->paths['config']
			);
			update_option('dfd_ronneby_fonts', $fonts);
		}
		function remove_font($font)
		{
			$fonts = get_option('dfd_ronneby_fonts');
			if(isset($fonts[$font]))
			{
				unset($fonts[$font]);
				update_option('dfd_ronneby_fonts', $fonts);
			}
		}
		//finds the json file we need to create the config
		function find_json()
		{
			$files = scandir($this->paths['tempdir']);
			foreach($files as $file)
			{ 
				if(strpos(strtolower($file), '.json')  !== false && $file[0] != '.')
				{
					return $file;
				}
			}
		}
		//finds the svg file we need to create the config
		function find_svg()
		{
			$files = scandir($this->paths['tempdir']);
			foreach($files as $file)
			{ 
				if(strpos(strtolower($file), '.svg')  !== false && $file[0] != '.')
				{
					return $file;
				}
			}
		}
		static function load_iconfont_list()
		{
			if(!empty(self::$iconlist)) return self::$iconlist;
			$extra_fonts = get_option('dfd_ronneby_fonts');
			if(empty($extra_fonts)) $extra_fonts = array();
				$font_configs = $extra_fonts;//array_merge(SmileBuilder::$default_iconfont, $extra_fonts);
			//if we got any include the charmaps and add the chars to an array
			$upload_dir = wp_upload_dir();
			$path		= trailingslashit($upload_dir['basedir']);
			$url		= trailingslashit($upload_dir['baseurl']);
			foreach($font_configs as $key => $config)
			{	
				if(empty($config['full_path']))
				{
					$font_configs[$key]['include'] = $path.$font_configs[$key]['include'];
					$font_configs[$key]['folder'] = $url.$font_configs[$key]['folder'];
				}
			}
			//cache the result
			self::$iconlist = $font_configs;
				return $font_configs;
		}
		function AIO_move_fonts()
		{
			/* TODO: possibly add switch_theme hooked action/change admin_init to make sure all fonts were enqueued after theme activation */
			// Make destination directory 
			if (!is_dir($this->vc_fonts)) { 
				wp_mkdir_p($this->vc_fonts);
			}
			@chmod($this->vc_fonts,0777);
			foreach(glob($this->vc_fonts_dir.'*') as $file)
			{
				$new_file = basename($file);
				@copy($file,$this->vc_fonts.'/'.$new_file);
			}
			$fonts['Defaults'] = array( 
				'include'   => trailingslashit($this->paths['fonts']).DFD_THEME_SETTINGS_NAME, 
				'folder' 	=> trailingslashit($this->paths['fonts']).DFD_THEME_SETTINGS_NAME,
				'style'	 => DFD_THEME_SETTINGS_NAME.'/Defaults.css',
				'config' 	=> $this->paths['config']
			);
			$defaults = get_option('dfd_ronneby_fonts');
			if(!$defaults){
				update_option('dfd_ronneby_fonts',$fonts);
			}
		}// end AIO_move_fonts
	}// End class
	/*
	* creates a folder for the theme framework
	*/
	if(!function_exists('smile_backend_create_folder'))
	{
		function smile_backend_create_folder(&$folder, $addindex = true)
		{
			if(is_dir($folder) && $addindex == false)
				return true;
			$created = wp_mkdir_p( trailingslashit( $folder ) );
			@chmod( $folder, 0777 );
			if($addindex == false) return $created;
			$index_file = trailingslashit( $folder ) . 'index.php';
			if ( file_exists( $index_file ) )
				return $created;
			$handle = @fopen( $index_file, 'w' );
			if ($handle)
			{
				fwrite( $handle, "<?php\r\necho 'Sorry, browsing the directory is not allowed!';\r\n?>
" );
				fclose( $handle );
			}
			return $created;
		}
	}
	// Instantiate the Icon Manager
	new AIO_Icon_Manager;
}