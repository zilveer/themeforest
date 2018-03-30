<?php

class feedback_form {

	public function register_shortcode($shortcodeName) {
		if (!function_exists("shortcode_feedback_form")) {
			function shortcode_feedback_form($atts, $content = null)
			{
				global $gt3_pbconfig;
				if (!isset($compile)) {
					$compile = '';
				}
				extract(shortcode_atts(array(
					'heading_size' => $gt3_pbconfig['default_heading_in_module'],
					'heading_color' => '',
					'heading_text' => '',
				), $atts));

				#heading
				if (strlen($heading_color) > 0) {
					$custom_color = "color:#{$heading_color};";
				}
				if (strlen($heading_text) > 0) {
					$compile .= "<" . $heading_size . " style='" . (isset($custom_color) ? $custom_color : '') . "' class='headInModule'>{$heading_text}</" . $heading_size . ">";
				}

				$compile .= "
			<div class='module_content'>
			    <form class='feedback_form' action='' method='post' name='feedback_form'>
                    <input type='text' class='field-name form_field' title='" . ((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_name") : __('Name *', 'theme_localization')) . "' value='" . ((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_name") : __('Name *', 'theme_localization')) . "' name='field-name'>
                    <input type='text' class='field-email form_field' title='" . ((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_email") : __('Email *', 'theme_localization')) . "' value='" . ((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_email") : __('Email *', 'theme_localization')) . "' name='field-email'>
                    <input type='text' class='field-subject form_field' title='" . ((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_subject") : __('Subject', 'theme_localization')) . "' value='" . ((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_subject") : __('Subject', 'theme_localization')) . "' name='field-subject'>
                    <textarea class='field-message form_field' title='" . ((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_message") : __('Message *', 'theme_localization')) . "' rows='5' cols='45' name='field-message'>" . ((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_message") : __('Message *', 'theme_localization')) . "</textarea>";

				if (get_theme_option("captcha_status") == "enabled") {
					$theme_captcha = get_theme_captcha();
					$compile .= '<input type="text" name="field-captcha-q" value="' . $theme_captcha['first'] . '+' . $theme_captcha['second'] . '=" title="" class="field-captcha-q form_field" disabled="disabled" style="width:30px;text-align: center;">
                                <input type="text" name="field-captcha-a" value="" title="" class="field-captcha-a form_field" style="width:159px;text-align: center;">';
				}

				$compile .= "    <input type='reset' class='feedback_reset' value='" . ((get_theme_option("translator_status") == "enable") ? get_text("tranlator_clear") : __('Clear form', 'theme_localization')) . "' id='reset2' name='reset'>
                    <input type='button' value='" . ((get_theme_option("translator_status") == "enable") ? get_text("tranlator_send_message") : __('Send comment', 'theme_localization')) . "' id='submit2' class='feedback_go' name='submit'>
                </form>
                <div class='ajaxanswer'></div>
			</div>";

				return $compile;
			}
		}
		add_shortcode($shortcodeName, 'shortcode_feedback_form');
	}
}




#Shortcode name
$shortcodeName="feedback_form";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "
<div style='float:left;clear:both;line-height:27px;width: 60px;'>Header: </div>
<select style='' name='".$shortcodeName."_heading_size' class='".$shortcodeName."_heading_size'>
	<option value='h1'>H1</option>
	<option value='h2'>H2</option>
	<option value='h3'>H3</option>
	<option value='h4'>H4</option>
	<option value='h5'>H5</option>
</select>

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		var heading_size = jQuery('.".$shortcodeName."_heading_size').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName." heading_size=\"'+heading_size+'\"][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";






#Register shortcode & set parameters
$shortcode_feedback_form = new feedback_form();
$shortcode_feedback_form->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['feedback_form'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>