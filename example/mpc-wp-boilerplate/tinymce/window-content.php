<?php

/*-----------------------------------------------------------------------------------*/
/*	MPC TinyMCE Window Structure - fields and option
/*-----------------------------------------------------------------------------------*/

/* Hook Up To WP*/
$wp_content_path = explode( 'wp-content', __FILE__);
$wp_path = $wp_content_path[0];

require_once( $wp_path . '/wp-load.php' );
/* End Hook */

/* Variables */
$title; 
$output;
$preview;
$advanced = false;
		
/*-----------------------------------------------------------------------------------*/
/*	Build window and field types
/*-----------------------------------------------------------------------------------*/

function display_shortcode() {

	global $title, $output, $preview, $advanced;
	$output = '';
	$attr = '';
	$shortcode = '';
	$type = trim($_GET['type']);
	
	// load setup file
	$options =  dirname(__FILE__).'/setup.php' ;
	require_once($options);
		
	if(isset($mpc_shortcodes) && is_array($mpc_shortcodes)){
			
			//get shortcode fields
			$attr = $mpc_shortcodes[$type]['fields'];
			$shortcode = $mpc_shortcodes[$type]['shortcode'];
			$title = $mpc_shortcodes[$type]['title'];
		
			// this is used by the js to output the shortcode to the preview window			
			$output .= '<div id="mpc_sh_structure" class="hidden">' . $shortcode . '</div>'."\n";
			
			if(isset($mpc_shortcodes[$type]['preview'])){
				$preview = $mpc_shortcodes[$type]['preview'];
				$output .= '<div id="mpc_preview_state" class="hidden">'.$preview.'</div>'."\n";
			}
			
			// filters and excutes params
			foreach($attr as $key => $value){
				// prefix the fields names and ids with mpc_
				$key = 'mpc_tinymce_' . $key;
				
				$output .= '<div class="mpc-tinymce-option">' . "\n";
				$output .= '<h3 class="tinymce-heading">' . $value['title'] . '</h3>' . "\n";
				$output .= '<div class="field">' . "\n";
				
				switch($value['type']) {
					case 'text' :
						$output .= '<input type="text" class="tinymce-text border mpc-input" name="' . $key . '" id="' . $key . '" value="' . $value['std'] . '" />' . "\n";						
						break;
						
					case 'textarea' :
						$output .= '<textarea rows="10" cols="30" name="' . $key . '" id="' . $key . '" class="tinymce-textarea border mpc-input">' . $value['std'] . '</textarea>' . "\n";
					break;

					case "color":
						$output .= '<div class="colorSelector"><div style="background-color:' . $value['std'] . '"></div></div>';
						$output .= '<input type="text" class="tinymce-text border mpc-input mpc-color-input" name="' . $key . '" id="' . $key . '" value="' . $value['std'] . '" />' . "\n";
					break;

					case 'select' :						
						$output .= '<select name="' . $key . '" id="' . $key . '" class="tinymce-dropdown mpc-input">' . "\n";
						foreach($value['options'] as $option => $ovalue ) {
							$output .= '<option value="' . $option . '">' . $ovalue . '</option>' . "\n";
						}
						
						$output .= '</select>' . "\n";
						break;
						
					case 'checkbox' :
						$output .= '<label for="' . $key . '" class="tinymce-checkbox">' . "\n";
						$output .= '<input type="checkbox" class="mpc-input" name="' . $key . '" id="' . $key . '" ' . ( $value['std'] == 'true' ? 'checked="checked"' : '' ) . ' />' . "\n";
						$output .= ' ' . $value['checkbox_text'] . '</label>' . "\n";
					break;
				}
				$output   .= '</div>' . "\n"; // end field div
				$output   .= '<span class="tinymce-description">' . $value['desc'] . '</span>' . "\n";
				$output   .= '</div>' . "\n"; // end option div
				
			}
			
			// checks if it has a child shortcode
			if(isset($mpc_shortcodes[$type]['inside'])){
				
				$advanced = true;
				$fields = $mpc_shortcodes[$type]['inside']['fields'];
				$sc = $mpc_shortcodes[$type]['inside']['shortcode'];
			
								
				$output .= '<div id="options-child-container">'."\n";
				$output .= '<div id="mpc_adv_sh_structure" class="hidden">' . $sc . '</div>' . "\n";
				$output .= '<div class="options-duplicate">'."\n";
				$fields_length = count($fields);
				$index = 0;
			
				foreach($fields as $key => $value) {
					$index++; 
					$key = 'mpc_tinymce_' . $key;
					
					$output .= '<div class="mpc-tinymce-option">' . "\n";
					$output .= '<h3 class="tinymce-heading">' . $value['title'] . '</h3>' . "\n";
					$output .= '<div class="field">' . "\n";
					
					switch($value['type']) {
						case 'text' :
							$output .= '<input type="text" class="tinymce-text border mpc-input" name="' . $key . '" id="' . $key . '" value="' . $value['std'] . '" />' . "\n";						
						break;
						
						case 'textarea' :
							$output .= '<textarea rows="10" cols="30" name="' . $key . '" id="' . $key . '" class="tinymce-textarea border mpc-input">' . $value['std'] . '</textarea>' . "\n";
						break;

						case "color":
							$output .= '<div class="colorSelector"><div style="background-color:' . $value['std'] . '"></div></div>';
							$output .= '<input type="text" class="tinymce-text border mpc-input mpc-color-input" name="' . $key . '" id="' . $key . '" value="' . $value['std'] . '" />' . "\n";
						break;
						
						case 'select' :						
							$output .= '<select name="' . $key . '" id="' . $key . '" class="tinymce-dropdown mpc-input">' . "\n";
							foreach($value['options'] as $option => $ovalue ) {
								$output .= '<option value="' . $option . '">' . $ovalue . '</option>' . "\n";
							}
						
							$output .= '</select>' . "\n";
							break;
						
						case 'checkbox' :
							$output .= '<label for="' . $key . '" class="tinymce-checkbox">' . "\n";
							$output .= '<input type="checkbox" class="mpc-input" name="' . $key . '" id="' . $key . '" ' . ( $value['std'] == 'true' ? 'checked="checked"' : '' ) . ' />' . "\n";
							$output .= ' ' . $value['checkbox_text'] . '</label>' . "\n";
						break;
					}
					
					$output   .= '</div>' . "\n"; // end field div
					if($fields_length == $index)
						$output   .= '<span class="tinymce-description last-description">' . $value['desc'] . '</span>' . "\n";
					else 
						$output   .= '<span class="tinymce-description">' . $value['desc'] . '</span>' . "\n";
					$output   .= '</div>' . "\n"; // end option div
					
				}
						
				$output .= '<a href="#" class="duplicate-remove" title="'.$mpc_shortcodes[$type]['inside']['remove_section'].'"></a>' . "\n";
				$output .= '</div>' . "\n";
				
				$output .= '</div>' . "\n";
				$output .= '<a href="#" id="duplicate-section" class="duplicate-button" title="'.$mpc_shortcodes[$type]['inside']['add_section'].'"></a>' . "\n";
			}			
		}
	}
	
// run display function
display_shortcode();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div id="mpc-tinymce-window">
	<div id="mpc-shortcode-wrap">
		<div id="mpc-sc-form-wrap">
			<div id="mpc-tinymce-header">
				<?php echo $title; ?>
			</div>
			
			<form method="post" id="mpc-tinymce-form-win">
				<div id="mpc-tinymce-form-wrap">
				
					<?php echo $output; 
					
					if($advanced) {?>
						<div class="tinymce-insert insert-inside"><a href="#" class="insert-shortcode mpc-insert"></a></div>		
					<?php } else { ?>					
						<div class="tinymce-insert"><a href="#" class="insert-shortcode mpc-insert"></a></div>
					<?php } ?>
				</div>
			</form>
			<script type="text/javascript">
			jQuery(document).ready(function($) {
				// Color Picker
				function addColorPickers() {
					$('.colorSelector').each(function(){
						var $this = this; //cache a copy of the this variable for use inside nested function
						var initialColor = $($this).next('input').attr('value');

						$(this).ColorPicker({
							color: initialColor,
							onShow: function (colpkr) {
								$(colpkr).fadeIn(500);
								return false;
							},
							onHide: function (colpkr) {
								$(colpkr).fadeOut(500);
								return false;
							},
							onChange: function (hsb, hex, rgb) {
								$($this).children('div').css('backgroundColor', '#' + hex);
								$($this).next('input')
									.attr('value','#' + hex)
									.trigger('change');
							}
						});
					});
				}

				addColorPickers();
				$(window).on('add-color-pickers', addColorPickers);

			})
			</script>
		</div>
		<div id="mpc-sc-preview-wrap">
			<div id="mpc-sc-preview-head">Shortcode Preview</div>
			<!-- /#mpc-sc-preview-head -->	
				<iframe src="<?php echo get_template_directory_uri(); ?>/mpc-wp-boilerplate/tinymce/preview.php?shortcode=?preview=" width="424" frameborder="0" id="mpc-sc-preview"></iframe>
		</div>
		<div class="clear"></div>
	</div>
</div> 
</body>
</html>

<!- END  Structure -->