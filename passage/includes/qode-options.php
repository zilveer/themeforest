<?php
include_once('google-fonts.php');

if (!function_exists ('add_action')) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}
global $qode_options_passage;
$qode_options_passage  = get_option('qode_options_passage');

class Qode_Theme_Options {

	//constructor of class, PHP4 compatible construction for backward compatibility
	function qode_Theme_Options() {
		add_action('admin_menu', array(&$this, 'qode_admin_menu'));
		add_action('admin_init', array(&$this, 'register_qode_theme_settings'));
	}


	function init_qode_theme_options() {
		global $qode_options_passage;
		if(isset($qode_options_passage['reset_to_defaults'])){ 
			if( $qode_options_passage['reset_to_defaults'] == 'yes' ) delete_option( "qode_options_passage");
		}
		if (! get_option("qode_options_passage")) {
			add_option( "qode_options_passage",
				array( // intitialize the 'qode_options_passage' array with the following key => value pairs:
					"reset_to_defaults" => '',
					"number_of_chars" => 45,
					"first_color" => '',
					"second_color" => '',
					"third_color" => '',
					"fourth_color" => '',
					"background_color" => '',
					"background_color_box" => '',
					"highlight_color" => '',
					"selection_color" => '',
					"sidebar_background_color" => '',
					"favicon_image" => QODE_ROOT."/img/favicon.ico",
					"background_image" => '',
					"patern_background_image" => '',
					"google_fonts" => '-1',
					"page_transitions" => '3',
					"grid" => 'large',
					"content_top" => '',
					"content_shadow" => 'shadow3',
					'content_animation' => 'yes',
					"smooth_scroll" => 'no',
					"responsiveness" => 'yes',
					"show_back_button" => 'no',
					"parallax_speed" => '1',
					"parallax_minheight" => '400',
					"parallax_onoff" => 'on',
					"internal_no_ajax_links" => '',
					"custom_css" => '',
					"custom_js" => '',
					"meta_keywords" => '',
					"meta_description" => '',
					"disable_qode_seo" => 'no',
					"h1_color" => '',
					"h1_google_fonts" => '-1',
					"h1_fontsize" => '',
					"h1_lineheight" => '',
					"h1_fontstyle" => '',
					"h1_fontweight" => '',
					"h2_color" => '',
					"h2_google_fonts" => '-1',
					"h2_fontsize" => '',
					"h2_lineheight" => '',
					"h2_fontstyle" => '',
					"h2_fontweight" => '',
					"h3_color" => '',
					"h3_google_fonts" => '-1',
					"h3_fontsize" => '',
					"h3_lineheight" => '',
					"h3_fontstyle" => '',
					"h3_fontweight" => '',
					"h4_color" => '',
					"h4_google_fonts" => '-1',
					"h4_fontsize" => '',
					"h4_lineheight" => '',
					"h4_fontstyle" => '',
					"h4_fontweight" => '',
					"h5_color" => '',
					"h5_google_fonts" => '-1',
					"h5_fontsize" => '',
					"h5_lineheight" => '',
					"h5_fontstyle" => '',
					"h5_fontweight" => '',
					"h6_color" => '',
					"h6_google_fonts" => '-1',
					"h6_fontsize" => '',
					"h6_lineheight" => '',
					"h6_fontstyle" => '',
					"h6_fontweight" => '',
					"text_color" => '',
					"text_google_fonts" => '-1',
					"text_fontsize" => '',
					"text_lineheight" => '',
					"text_fontstyle" => '',
					"text_fontweight" => '',
					"text_margin" => '',
					"link_color" => '',
					"link_hovercolor" => '',
					"link_fontstyle" => '',
					"link_fontweight" => '',
					"link_fontdecoration" => '',
					"page_title_color" => '',
					"page_title_google_fonts" => '-1',
					"page_title_fontsize" => '',
					"page_title_lineheight" => '',
					"page_title_fontstyle" => '',
					"page_title_fontweight" => '',
					"menu_color" => '',
					"menu_hovercolor" => '',
					"menu_hoverbackgroundcolor" => '',
					"menu_google_fonts" => '-1',
					"menu_fontsize" => '',
					"menu_lineheight" => '',
					"menu_fontstyle" => '',
					"menu_fontweight" => '',
					"menu_letter_spacing" => '',
					"header_in_grid" => 'yes',
					"header_widget_area" => 'yes',
					"header_fixed" => 'yes',
					"fixed_menu_resize" => 'yes',
					"header_background_color_initial" => '',
					"header_background_color_initial_transparency" => '',
					"header_background_color" => '',
					"header_background_color_transparency" => '',
					"header_background_color_mobile" => '',
					"logo_image" => QODE_ROOT."/img/logo.png",
					"center_logo_image" => 'no',
					"top_menu" => 'drop_down',
					"dropdown_background_color" => '',
					"dropdown_color" => '',
					"dropdown_hovercolor" => '',
					"dropdown_google_fonts" => '-1',
					"dropdown_fontsize" => '',
					"dropdown_lineheight" => '',
					"dropdown_fontstyle" => '',
					"dropdown_fontweight" => '',
					"dropdown_color_thirdlvl" => '',
					"dropdown_hovercolor_thirdlvl" => '',
					"dropdown_google_fonts_thirdlvl" => '-1',
					"dropdown_fontsize_thirdlvl" => '',
					"dropdown_lineheight_thirdlvl" => '',
					"dropdown_fontstyle_thirdlvl" => '',
					"dropdown_fontweight_thirdlvl" => '',
					"header_separator_thickness" => '',
					"responsive_title_image" => '',
					"fixed_title_image" => '',
					"title_image" => '',
					"title_height" => '',
					"page_title_position" => '0',
					"title_in_grid" => 'yes',
					"footer_widget_area" => 'yes',
					"footer_text" => 'yes',
					"footer_top_title_color" => '',
					"footer_top_text_color" => '',
					"footer_top_background_color" => '',
					"footer_bottom_text_color" => '',
					"footer_bottom_background_color" => '',
					"separator_thickness" => '',
					"separator_topmargin" => '',
					"separator_bottommargin" => '',
					"button_title_color" => '',
					"button_title_hovercolor" => '',
					"button_title_google_fonts" => '-1',
					"button_title_fontsize" => '',
					"button_title_lineheight" => '',
					"button_title_fontstyle" => '',
					"button_title_fontweight" => '',
					"button_size" => '',
					"button_backgroundcolor" => '',
					"button_backgroundhovercolor" => '',
					"message_title_color" => '',
					"message_title_google_fonts" => '-1',
					"message_title_fontsize" => '',
					"message_title_lineheight" => '',
					"message_title_fontstyle" => '',
					"message_title_fontweight" => '',
					"message_backgroundcolor" => '',
					"blockquote_font_color" => '',
					"social_icon_background_header" => '',
					"social_icon_background" => '',
					"box_hover_overlay" => '',
					"box_elements_border" => '',
					"smooth_background_color" => '',
					"smooth_bar_color" => '',
					"portfolio_style" => '1',
					"lightbox_single_project" => 'no',
					"portfolio_columns_number" => '2',
					"pagination" => '1',
					"blog_style" => '1',
					"category_blog_sidebar" => 'default',
					"blog_hide_comments" => 'no',
					"number_of_chars" => '45',
					"blog_single_sidebar" => 'default',
					"blog_single_sidebar_custom_display" => '',
					"receive_mail" => '',
					"enable_contact_form" => 'no',
					"hide_contact_form_website" => 'no',
					"email_from" => '',
					"email_subject" => '',
					"use_recaptcha" => 'no',
					"recaptcha_public_key" => '',
					"recaptcha_private_key" => '',
					"contact_heading_above" => '',
					"enable_google_map" => 'no',
					"google_maps_pin_image" => QODE_ROOT."/img/pin.png",
					"google_maps_address" => '',
					"google_maps_zoom" => '12',
					"google_maps_height" => '750',
					"google_maps_scroll_wheel" => 'no',
					"google_maps_iframe" => '',
					"404_title" => '',
					"404_text" => '',
					"404_backlabel" => '',
					"enable_social_share" => 'no',
					"enable_facebook_share" => 'no',
					"enable_twitter_share" => 'no',
					"enable_google_plus" => 'no',
					"facebook_icon" => '',
					"twitter_icon" => '',
					"google_plus_icon" => '',
					"twitter_via" => ''
				)
			);
		} 
	}

	function register_qode_theme_settings() {
	    register_setting( 'qode_options_passage_page', 'qode_options_passage', array(&$this, 'validate_options') );
	    // register_setting( 'qode_options_passage_page', array(&$this, 'another_of_my_options') );
	}
	//extend the admin menu
	function qode_admin_menu() {
		$this->init_qode_theme_options();
		//Add the Qode options page to the Themes' menu
		$this->pagehook = add_menu_page('Qode Theme', esc_html__('Qode', 'qode'), 'manage_options', 'qode_options_passage_page', array(&$this, 'qode_generate_options_page'));
		add_action('load-'.$this->pagehook, array(&$this, 'on_load_page'));
	}

	function on_load_page() {
		
		// load javascripts to allow drag/drop, expand/collapse and hide/show of boxes
		add_meta_box('qode-general-options-metabox', esc_html__('Options', 'qode'), array(&$this, 'general_options_contentbox'), $this->pagehook, 'normal', 'core');
	
	}

	function qode_generate_options_page() {

		// global screen column value to be able to have a sidebar in WordPress 2.8+
		global $screen_layout_columns, $qode_options_passage;

		/* Messages to display saved and reset */
		if ( isset($_REQUEST['settings-updated']) || isset($_REQUEST['updated'] )) {
                    echo '<div id="message" class="updated fade"><p><strong>'.esc_html__('Settings saved.', 'qode').'</strong></p></div>';
               
                }
                
		//if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.esc_html__('Settings reset.', 'qode').'</strong></p></div>'; ?>
		<div id="qode-metaboxes-general" class="wrap">
		    <div style="float:left; padding:10px 10px 10px 0;"></div>
		    <h2 style="padding-top:25px;"><?php printf( __('version %1$s', 'qode'), '1.9' ); ?></h2>

		    <form method="post" action="options.php">
<?php			settings_fields( 'qode_options_passage_page' ); // Checks that the user can update options and also redirect the user back to the correct admin page (this form).
			$options = get_option('qode_options_passage');
			// Allows the 'closed' state of metaboxes to be remembered
			wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false );
			// Allows the order of metaboxes to be remembered
			wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>

			<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
				<div id="post-body" class="has-sidebar">
					<div id="post-body-content" class="has-sidebar-content">
<?php					    do_meta_boxes($this->pagehook, 'normal', $options); ?>
<?php					    do_meta_boxes($this->pagehook, 'additional', $options); ?>
					    <fieldset style="margin:2px 0 0;"><legend class="screen-reader-text"><span><?php esc_attr_e('Reset to defaults', 'qode') ?></span></legend>
						<label for="reset_to_defaults">
						    <input name="qode_options_passage[reset_to_defaults]" type="checkbox" id="reset_to_defaults" value="yes" />
						    <?php esc_attr_e('Reset to defaults', 'qode') ?>
						</label>
					    </fieldset>
					    <p class="submit">
						<input type="hidden" id="qode_submit" value="1" name="qode_submit" />
						<input class="button-primary" type="submit" name="submit" value="<?php esc_attr_e('Save Changes', 'qode') ?>" />
					    </p>
					</div>
				</div>
				<br class="clear"/>
			</div>
		    </form>
<?php		    /* The reset button */; ?>
<!--		    <form method="post">
			<p class="submit">
			    <input name="reset" type="submit" value="Reset" />
			    <input type="hidden" name="action" value="reset" />
			</p>
		    </form> -->
		</div>
		<script type="text/javascript">
		    //<![CDATA[
		    jQuery(document).ready( function($) {
			    // close postboxes that should be closed
			    $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
			    // postboxes setup
			    postboxes.add_postbox_toggles('<?php echo $this->pagehook; ?>');
		    });
		    //]]>
		</script>
<?php	}

	/**
	 * Validate user input
	 *
	 * @param array $input, an array of user input
	 * @return array Return an input array of sanitized input
	 */
	function validate_options( $input ) {
	global $qode_options_passage;
		$input['number_of_chars'] = is_numeric( $input['number_of_chars'] ) ? absint($input['number_of_chars']) : $qode_options_passage['number_of_chars'];
		return $input;
	}
      


	/**************************************************************************************/
	/**** Below you will find the callback method for each of the registered metaboxes ****/
	/**************************************************************************************/

	function general_options_contentbox( $options ) {
		global $fontArrays;
	?>
		
		<div class="sections">
			<h3>Global options</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('First main color', 'qode'); ?></td>
							<td>
								<div class="colorSelector"><div style="<?php if ($options['first_color']){ echo 'background-color:'.esc_attr($options['first_color'], 'qode').';'; } ?>"></div></div>
								<input name="qode_options_passage[first_color]" type="text" value="<?php if ($options['first_color']) { echo esc_attr($options['first_color'], 'qode'); } ?>" size="30" maxlength="500" />
								<?php esc_html_e('Choose first main color', 'qode'); ?>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Second main color', 'qode'); ?></td>
							<td>
								<div class="colorSelector"><div style="<?php if ($options['second_color']){ echo 'background-color:'.esc_attr($options['second_color'], 'qode').';'; } ?>"></div></div>
								<input name="qode_options_passage[second_color]" type="text" value="<?php if ($options['second_color']) { echo esc_attr($options['second_color'], 'qode'); } ?>" size="30" maxlength="500" />
								<?php esc_html_e('Choose second main color', 'qode'); ?>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Third main color', 'qode'); ?></td>
							<td>
								<div class="colorSelector"><div style="<?php if ($options['third_color']){ echo 'background-color:'.esc_attr($options['third_color'], 'qode').';'; } ?>"></div></div>
								<input name="qode_options_passage[third_color]" type="text" value="<?php if(isset($options['third_color'])){ if ($options['third_color']) { echo esc_attr($options['third_color'], 'qode'); } } ?>" size="30" maxlength="500" />
								<?php esc_html_e('Choose third main color', 'qode'); ?>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Fourth main color', 'qode'); ?></td>
							<td>
								<div class="colorSelector"><div style="<?php if ($options['fourth_color']){ echo 'background-color:'.esc_attr($options['fourth_color'], 'qode').';'; } ?>"></div></div>
								<input name="qode_options_passage[fourth_color]" type="text" value="<?php if(isset($options['fourth_color'])){ if ($options['fourth_color']) { echo esc_attr($options['fourth_color'], 'qode'); } } ?>" size="30" maxlength="500" />
								<?php esc_html_e('Choose fourth main color', 'qode'); ?>
							</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Background color', 'qode'); ?></td>
								<td>
									<div class="colorSelector"><div style="<?php if ($options['background_color']){ echo 'background-color:'.esc_attr($options['background_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[background_color]" type="text" value="<?php if ($options['background_color']) { echo esc_attr($options['background_color'], 'qode'); } ?>" size="30" maxlength="500" />
									<?php esc_html_e('Choose background color', 'qode'); ?>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Content background color', 'qode'); ?></td>
								<td>
									<div class="colorSelector"><div style="<?php if ($options['background_color_box']){ echo 'background-color:'.esc_attr($options['background_color_box'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[background_color_box]" type="text" value="<?php if (isset($options['background_color_box'])) { echo esc_attr($options['background_color_box'], 'qode'); } ?>" size="30" maxlength="500" />
									<?php esc_html_e('Choose box background color', 'qode'); ?>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Highlight color', 'qode'); ?></td>
								<td>
									<div class="colorSelector"><div style="<?php if ($options['highlight_color']){ echo 'background-color:'.esc_attr($options['highlight_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[highlight_color]" type="text"  value="<?php if ($options['highlight_color']) { echo esc_attr($options['highlight_color'], 'qode'); } ?>" size="30" maxlength="500" />
									<?php esc_html_e('Choose highlight color', 'qode'); ?>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Selection color', 'qode'); ?></td>
								<td>
									<div class="colorSelector"><div style="<?php if ($options['selection_color']){ echo 'background-color:'.esc_attr($options['selection_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[selection_color]" type="text"  value="<?php if ($options['selection_color']) { echo esc_attr($options['selection_color'], 'qode'); } ?>" size="30" maxlength="500" />
									<?php esc_html_e('Choose selection color', 'qode'); ?>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Sidebar background color', 'qode'); ?></td>
								<td>
									<div class="colorSelector"><div style="<?php if ($options['sidebar_background_color']){ echo 'background-color:'.esc_attr($options['sidebar_background_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[sidebar_background_color]" type="text"  value="<?php if ($options['sidebar_background_color']) { echo esc_attr($options['sidebar_background_color'], 'qode'); } ?>" size="30" maxlength="500" />
								</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Background image', 'qode'); ?></td>
							<td>	
								<div class="inline" style="width: 600px;">
								<input type="text" id="background_image" name="qode_options_passage[background_image]" class="background_image" value="<?php if (isset($options['background_image'])) { echo esc_attr($options['background_image'], 'qode'); } ?>" size="70">
								<input class="upload_button" type="button" value="Upload file">
								</div>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Pattern background image', 'qode'); ?></td>
							<td>	
								<div class="inline" style="width: 600px;">
								<input type="text" id="pattern_background_image" name="qode_options_passage[pattern_background_image]" class="pattern_background_image" value="<?php if (isset($options['pattern_background_image'])) { echo esc_attr($options['pattern_background_image'], 'qode'); } ?>" size="70">
								<input class="upload_button" type="button" value="Upload file">
								</div>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Favicon image', 'qode'); ?></td>
							<td>	
								<div class="inline" style="width: 600px;">
								<input type="text" id="favicon_image" name="qode_options_passage[favicon_image]" class="favicon_image" value="<?php if ($options['favicon_image']) { echo esc_attr($options['favicon_image'], 'qode'); } else { echo QODE_ROOT."/img/favicon.ico"; } ?>" size="70">
								<input class="upload_button" type="button" value="Upload file">
								</div>
							</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Google fonts', 'qode'); ?></td>
								<td>
							<select name="qode_options_passage[google_fonts]">
							<option value="-1">Default</option>
							<?php foreach($fontArrays as $fontArray) { ?> 
								<option <?php if ($options['google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
							<?php } ?>
								
							</select>
							<?php esc_html_e('Choose Font', 'qode'); ?>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Page transition', 'qode'); ?></td>
								<td>
							<select name="qode_options_passage[page_transitions]">
								<option <?php if ($options['page_transitions'] == 0) { echo "selected='selected'"; } ?> value="0">No animation</option>
								<option <?php if ($options['page_transitions'] == 1) { echo "selected='selected'"; } ?> value="1">Up/Down</option>
								<option <?php if ($options['page_transitions'] == 2) { echo "selected='selected'"; } ?> value="2">Fade</option>
								<option <?php if ($options['page_transitions'] == 3) { echo "selected='selected'"; } ?> value="3">Up/Down (In) / Fade (Out)</option>
								<option <?php if ($options['page_transitions'] == 4) { echo "selected='selected'"; } ?> value="4">Left/Right</option>
							</select>
							<?php esc_html_e('In order for animation to work properly, you must choose "Post name" in permalinks settings', 'qode'); ?>
								</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Grid', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[grid]">
									<option <?php if(isset($options['grid'])){ $grid = $options['grid']; if ($grid == 'large') { echo "selected='selected'"; } }  ?> value="large">Large</option>
									<option <?php if(isset($options['grid'])){ $grid = $options['grid']; if ($grid == 'normal') { echo "selected='selected'"; } } ?> value="normal">Normal</option>
									<option <?php if(isset($options['grid'])){ $grid = $options['grid']; if ($grid == 'small') { echo "selected='selected'"; } } ?> value="small">Small</option>
								</select>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Move content up (px)', 'qode'); ?></td>
							<td>
								<input name="qode_options_passage[content_top]" type="text" value="<?php if (isset($options['content_top'])) { echo esc_attr($options['content_top'], 'qode'); } ?>" size="10" maxlength="10" />
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Content shadow', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[content_shadow]">
									<option <?php if(isset($options['content_shadow'])){ $content_shadow = $options['content_shadow']; if ($content_shadow == 'no') { echo "selected='selected'"; } }  ?> value="no">No</option>
									<option <?php if(isset($options['content_shadow'])){ $content_shadow = $options['content_shadow']; if ($content_shadow == 'shadow1') { echo "selected='selected'"; } } ?> value="shadow1">Shadow 1</option>
									<option <?php if(isset($options['content_shadow'])){ $content_shadow = $options['content_shadow']; if ($content_shadow == 'shadow2') { echo "selected='selected'"; } } ?> value="shadow2">Shadow 2</option>
									<option <?php if(isset($options['content_shadow'])){ $content_shadow = $options['content_shadow']; if ($content_shadow == 'shadow3') { echo "selected='selected'"; } } ?> value="shadow3">Shadow 3</option>
								</select>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Content entering animation', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[content_animation]">
									<option <?php if(isset($options['content_animation'])){ $content_animation = $options['content_animation']; if ($content_animation == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
									<option <?php if(isset($options['content_animation'])){ $content_animation = $options['content_animation']; if ($content_animation == 'no') { echo "selected='selected'"; } }  ?> value="no">No</option>
								</select>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Smooth scroll', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[smooth_scroll]">
									<option <?php if(isset($options['smooth_scroll'])){ $smooth_scroll = $options['smooth_scroll']; if ($smooth_scroll == 'no') { echo "selected='selected'"; } }  ?> value="no">No</option>
									<option <?php if(isset($options['smooth_scroll'])){ $smooth_scroll = $options['smooth_scroll']; if ($smooth_scroll == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Responsiveness', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[responsiveness]">
									<option <?php if(isset($options['responsiveness'])){ $responsiveness = $options['responsiveness']; if ($responsiveness == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
									<option <?php if(isset($options['responsiveness'])){ $responsiveness = $options['responsiveness']; if ($responsiveness == 'no') { echo "selected='selected'"; } }  ?> value="no">No</option>
								</select>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Show back button', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[show_back_button]">
									<option <?php if(isset($options['show_back_button'])){ $show_back_button = $options['show_back_button']; if ($show_back_button == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
									<option <?php if(isset($options['show_back_button'])){ $show_back_button = $options['show_back_button']; if ($show_back_button == 'yes') { echo "selected='selected'"; } }  ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Google Analytics Account ID', 'qode'); ?></td>
							<td>
								<input name="qode_options_passage[google_analytics_code]" type="text" value="<?php if (isset($options['google_analytics_code'])) { echo esc_attr($options['google_analytics_code'], 'qode'); } ?>" size="63" maxlength="500" />
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Google Maps Api Key', 'qode'); ?></td>
							<td>
								<input name="qode_options_passage[google_maps_api_key]" type="text" value="<?php if (isset($options['google_maps_api_key'])) { echo esc_attr($options['google_maps_api_key'], 'qode'); } ?>" size="63" maxlength="500" />
							</td>
						</tr>
						<tr valign="top">
							<td valign="top"><?php esc_html_e('List of internal URLs loaded without AJAX (separated with comma)', 'qode'); ?></td>
							<td>
								<div class="inline">
									<textarea id="internal_no_ajax_links" name="qode_options_passage[internal_no_ajax_links]" cols="60" rows="5"><?php if (isset($options['internal_no_ajax_links'])) { echo esc_attr($options['internal_no_ajax_links'], 'qode'); } ?></textarea>
								</div>
								
							</td>
						</tr>
						<tr valign="top">
							<td valign="top"><?php esc_html_e('Custom css', 'qode'); ?></td>
							<td>
								<div class="inline">
									<textarea id="custom_css" name="qode_options_passage[custom_css]" cols="60" rows="5"><?php if ($options['custom_css']) { echo esc_attr($options['custom_css'], 'qode'); } ?></textarea>
								</div>
								
							</td>
						</tr>
						<tr valign="top">
							<td valign="top"><?php esc_html_e('Custom js', 'qode'); ?></td>
							<td>
								<div class="inline">
									<textarea id="custom_js" name="qode_options_passage[custom_js]" cols="60" rows="5"><?php if ($options['custom_js']) { echo esc_attr($options['custom_js'], 'qode'); } ?></textarea>
								</div><br/>
								<?php esc_html_e('jQuery selector is "$j" because of the conflict mode', 'qode'); ?>
							</td>
						</tr>
						<tr valign="top">
							<td valign="top"><?php esc_html_e('Meta Keywords', 'qode'); ?></td>
							<td>
								<div class="inline">
									<textarea id="meta_keywords" name="qode_options_passage[meta_keywords]" cols="60" rows="5"><?php if ($options['meta_keywords']) { echo esc_attr($options['meta_keywords'], 'qode'); } ?></textarea>
								</div>
							</td>
						</tr>
						<tr valign="top">
							<td valign="top"><?php esc_html_e('Meta Description', 'qode'); ?></td>
							<td>
								<div class="inline">
									<textarea id="meta_description" name="qode_options_passage[meta_description]" cols="60" rows="5"><?php if ($options['meta_description']) { echo esc_attr($options['meta_description'], 'qode'); } ?></textarea>
								</div>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Disable Qode SEO', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[disable_qode_seo]">
									<option <?php if(isset($options['disable_qode_seo'])){ $disable_qode_seo = $options['disable_qode_seo']; if ($disable_qode_seo == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
									<option <?php if(isset($options['disable_qode_seo'])){ $disable_qode_seo = $options['disable_qode_seo']; if ($disable_qode_seo == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>General font options</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr><td colspan='2'><h2>Headings</h2></td></tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('H1 style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['h1_color']){ echo 'background-color:'.esc_attr($options['h1_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options_passage[h1_color]" type="text" value="<?php if ($options['h1_color']) { echo esc_attr($options['h1_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options_passage[h1_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['h1_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options_passage[h1_fontsize]" type="text" value="<?php if ($options['h1_fontsize']) { echo esc_attr($options['h1_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options_passage[h1_lineheight]" type="text" value="<?php if ($options['h1_lineheight']) { echo esc_attr($options['h1_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options_passage[h1_fontstyle]">
											<option <?php if ($options['h1_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h1_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['h1_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options_passage[h1_fontweight]">
											<option <?php if ($options['h1_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h1_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['h1_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['h1_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['h1_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['h1_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['h1_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['h1_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['h1_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										</select>
									</div>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('H2 style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['h2_color']){ echo 'background-color:'.esc_attr($options['h2_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options_passage[h2_color]" type="text" value="<?php if ($options['h2_color']) { echo esc_attr($options['h2_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options_passage[h2_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['h2_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options_passage[h2_fontsize]" type="text" value="<?php if ($options['h2_fontsize']) { echo esc_attr($options['h2_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options_passage[h2_lineheight]" type="text" value="<?php if ($options['h2_lineheight']) { echo esc_attr($options['h2_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options_passage[h2_fontstyle]">
											<option <?php if ($options['h2_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h2_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['h2_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options_passage[h2_fontweight]">
											<option <?php if ($options['h2_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h2_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['h2_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['h2_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['h2_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['h2_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['h2_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['h2_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['h2_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('H3 style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['h3_color']){ echo 'background-color:'.esc_attr($options['h3_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options_passage[h3_color]" type="text" value="<?php if ($options['h3_color']) { echo esc_attr($options['h3_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options_passage[h3_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['h3_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options_passage[h3_fontsize]" type="text" value="<?php if ($options['h3_fontsize']) { echo esc_attr($options['h3_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options_passage[h3_lineheight]" type="text" value="<?php if ($options['h3_lineheight']) { echo esc_attr($options['h3_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options_passage[h3_fontstyle]">
											<option <?php if ($options['h3_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h3_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['h3_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options_passage[h3_fontweight]">
											<option <?php if ($options['h3_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h3_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['h3_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['h3_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['h3_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['h3_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['h3_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['h3_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['h3_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('H4 style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['h4_color']){ echo 'background-color:'.esc_attr($options['h4_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options_passage[h4_color]" type="text" value="<?php if ($options['h4_color']) { echo esc_attr($options['h4_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options_passage[h4_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['h4_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options_passage[h4_fontsize]" type="text" value="<?php if ($options['h4_fontsize']) { echo esc_attr($options['h4_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options_passage[h4_lineheight]" type="text" value="<?php if ($options['h4_lineheight']) { echo esc_attr($options['h4_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options_passage[h4_fontstyle]">
											<option <?php if ($options['h4_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h4_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['h4_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options_passage[h4_fontweight]">
											<option <?php if ($options['h4_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h4_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['h4_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['h4_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['h4_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['h4_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['h4_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['h4_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['h4_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('H5 style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['h5_color']){ echo 'background-color:'.esc_attr($options['h5_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options_passage[h5_color]" type="text" value="<?php if ($options['h5_color']) { echo esc_attr($options['h5_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options_passage[h5_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['h5_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options_passage[h5_fontsize]" type="text" value="<?php if ($options['h5_fontsize']) { echo esc_attr($options['h5_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options_passage[h5_lineheight]" type="text" value="<?php if ($options['h5_lineheight']) { echo esc_attr($options['h5_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options_passage[h5_fontstyle]">
											<option <?php if ($options['h5_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h5_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['h5_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options_passage[h5_fontweight]">
											<option <?php if ($options['h5_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h5_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['h5_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['h5_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['h5_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['h5_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['h5_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['h5_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['h5_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('H6 style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['h6_color']){ echo 'background-color:'.esc_attr($options['h6_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options_passage[h6_color]" type="text" value="<?php if ($options['h6_color']) { echo esc_attr($options['h6_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options_passage[h6_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['h6_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options_passage[h6_fontsize]" type="text" value="<?php if ($options['h6_fontsize']) { echo esc_attr($options['h6_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options_passage[h6_lineheight]" type="text" value="<?php if ($options['h6_lineheight']) { echo esc_attr($options['h6_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options_passage[h6_fontstyle]">
											<option <?php if ($options['h6_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h6_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['h6_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options_passage[h6_fontweight]">
											<option <?php if ($options['h6_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h6_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['h6_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['h6_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['h6_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['h6_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['h6_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['h6_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['h6_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
								</td>
						</tr>
						<tr><td colspan='2'><h2>Text</h2></td></tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Text style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['text_color']){ echo 'background-color:'.esc_attr($options['text_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options_passage[text_color]" type="text" value="<?php if ($options['text_color']) { echo esc_attr($options['text_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options_passage[text_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['text_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options_passage[text_fontsize]" type="text" value="<?php if ($options['text_fontsize']) { echo esc_attr($options['text_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options_passage[text_lineheight]" type="text" value="<?php if ($options['text_lineheight']) { echo esc_attr($options['text_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options_passage[text_fontstyle]">
											<option <?php if ($options['text_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['text_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['text_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options_passage[text_fontweight]">
											<option <?php if ($options['text_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['text_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['text_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['text_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['text_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['text_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['text_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['text_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['text_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Top/Bottom margin (px)', 'qode'); ?>
										<input name="qode_options_passage[text_margin]" type="text" value="<?php if (isset($options['text_margin'])) { echo esc_attr($options['text_margin'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Link style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['link_color']){ echo 'background-color:'.esc_attr($options['link_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options_passage[link_color]" type="text" value="<?php if ($options['link_color']) { echo esc_attr($options['link_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Hover color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['link_hovercolor']){ echo 'background-color:'.esc_attr($options['link_hovercolor'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options_passage[link_hovercolor]" type="text" value="<?php if ($options['link_hovercolor']) { echo esc_attr($options['link_hovercolor'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options_passage[link_fontstyle]">
											<option <?php if ($options['link_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['link_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['link_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options_passage[link_fontweight]">
											<option <?php if ($options['link_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['link_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['link_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['link_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['link_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['link_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['link_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['link_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['link_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font decoration', 'qode'); ?>
										<select name="qode_options_passage[link_fontdecoration]">
											<option <?php if ($options['link_fontdecoration'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['link_fontdecoration'] == "none") { echo "selected='selected'"; } ?> value="none">none</option>
											<option <?php if ($options['link_fontdecoration'] == "bold") { echo "selected='selected'"; } ?> value="underline">underline</option>
											
										</select>
									</div>
								</td>
						</tr>
						<tr><td colspan='2'><h2>Page title</h2></td></tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Page title style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['page_title_color']){ echo 'background-color:'.esc_attr($options['page_title_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[page_title_color]" type="text" value="<?php if ($options['page_title_color']) { echo esc_attr($options['page_title_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options_passage[page_title_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['page_title_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options_passage[page_title_fontsize]" type="text" value="<?php if ($options['page_title_fontsize']) { echo esc_attr($options['page_title_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options_passage[page_title_lineheight]" type="text" value="<?php if ($options['page_title_lineheight']) { echo esc_attr($options['page_title_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options_passage[page_title_fontstyle]">
										<option <?php if ($options['page_title_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['page_title_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['page_title_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options_passage[page_title_fontweight]">
										<option <?php if ($options['page_title_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['page_title_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['page_title_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['page_title_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['page_title_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['page_title_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['page_title_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['page_title_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['page_title_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>Header and Footer</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr><td colspan='2'><h2>Header</h2></td></tr>
						<tr>
							<td valign="middle" width="150"><?php esc_html_e('Header and Footer in grid', 'qode'); ?></td>
							<td>
								<div class="inline">
									<select name="qode_options_passage[header_in_grid]">
										<option <?php if ($options['header_in_grid'] == "no") { echo "selected='selected'"; } ?> value="no">No</option>
										<option <?php if ($options['header_in_grid'] == "yes") { echo "selected='selected'"; } ?> value="yes">Yes</option>
										
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td valign="middle" width="150"><?php esc_html_e('Show header widget area', 'qode'); ?></td>
							<td>
								<div class="inline">
									<select name="qode_options_passage[header_widget_area]">
										<option <?php if ($options['header_widget_area'] == "no") { echo "selected='selected'"; } ?> value="no">No</option>
										<option <?php if ($options['header_widget_area'] == "yes") { echo "selected='selected'"; } ?> value="yes">Yes</option>	
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td valign="middle" width="150"><?php esc_html_e('Fixed header', 'qode'); ?></td>
							<td>
								<div class="inline">
									<select name="qode_options_passage[header_fixed]">
										<option <?php if(isset($options['header_fixed'])){ $header_fixed = $options['header_fixed']; if ($header_fixed == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
										<option <?php if(isset($options['header_fixed'])){ $header_fixed = $options['header_fixed']; if ($header_fixed == 'no') { echo "selected='selected'"; } }  ?> value="no">No</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td valign="middle" width="150"><?php esc_html_e('Fixed header resize', 'qode'); ?></td>
							<td>
								<div class="inline">
									<select name="qode_options_passage[fixed_menu_resize]">
										<option <?php if(isset($options['fixed_menu_resize'])){ $fixed_menu_resize = $options['fixed_menu_resize']; if ($fixed_menu_resize == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
										<option <?php if(isset($options['fixed_menu_resize'])){ $fixed_menu_resize = $options['fixed_menu_resize']; if ($fixed_menu_resize == 'no') { echo "selected='selected'"; } }  ?> value="no">No</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td scope="row" width="150"><?php esc_html_e('Background color (initial)', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['header_background_color_initial']){ echo 'background-color:'.esc_attr($options['header_background_color_initial'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[header_background_color_initial]" type="text" value="<?php if (isset($options['header_background_color_initial'])) { echo esc_attr($options['header_background_color_initial'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Transparency', 'qode'); ?>
									<input name="qode_options_passage[header_background_color_initial_transparency]" type="text" value="<?php if (isset($options['header_background_color_initial_transparency'])) { echo esc_attr($options['header_background_color_initial_transparency'], 'qode'); } ?>" size="10" maxlength="10" />
									<?php esc_html_e('From 0 to 1', 'qode'); ?>
								</div>
							</td>
						</tr>
						<tr>
							<td scope="row" width="150"><?php esc_html_e('Background color', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['header_background_color']){ echo 'background-color:'.esc_attr($options['header_background_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[header_background_color]" type="text" value="<?php if (isset($options['header_background_color'])) { echo esc_attr($options['header_background_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Transparency', 'qode'); ?>
									<input name="qode_options_passage[header_background_color_transparency]" type="text" value="<?php if (isset($options['header_background_color_transparency'])) { echo esc_attr($options['header_background_color_transparency'], 'qode'); } ?>" size="10" maxlength="10" />
									<?php esc_html_e('From 0 to 1', 'qode'); ?>
								</div>
							</td>
						</tr>
						<tr>
							<td scope="row" width="150"><?php esc_html_e('Background color for mobile menu', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['header_background_color_mobile']) && $options['header_background_color_mobile']){ echo 'background-color:'.esc_attr($options['header_background_color_mobile'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[header_background_color_mobile]" type="text" value="<?php if (isset($options['header_background_color_mobile']) &&  $options['header_background_color_mobile']) { echo esc_attr($options['header_background_color_mobile'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr>
							<td valign="top" width="150"><?php esc_html_e('Logo', 'qode'); ?></td>
							<td>
								<div class="inline" style="width: 600px;">
									<?php esc_html_e('Logo image', 'qode'); ?>
									<input type="text" id="logo_image" name="qode_options_passage[logo_image]" class="logo_image" value="<?php if ($options['logo_image']) { echo esc_attr($options['logo_image'], 'qode'); } else { echo QODE_ROOT."/img/logo.png"; } ?>" size="70">
									<input class="upload_button" type="button" value="Upload file">
								</div>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Center logo', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[center_logo_image]">
									<option <?php if(isset($options['center_logo_image'])){ $center_logo_image = $options['center_logo_image']; if ($center_logo_image == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
									<option <?php if(isset($options['center_logo_image'])){ $center_logo_image = $options['center_logo_image']; if ($center_logo_image == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="top">
								<td scope="row" width="150"><?php esc_html_e('Dropdown main menu', 'qode'); ?></td>
								<td>
									<div class="inline">
										<select name="qode_options_passage[top_menu]">
											<option <?php if ($options['top_menu'] == "drop_down") { echo "selected='selected'"; } ?> value="drop_down">Dropdown Default</option>
											<option <?php if ($options['top_menu'] == "drop_down2") { echo "selected='selected'"; } ?> value="drop_down2">Dropdown Wide</option>
										</select>
										<?php esc_html_e('Info: Dropdown Wide works properly only if header is in grid.', 'qode'); ?>
									</div>
									<div class="inline">
										<?php esc_html_e('Background color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if (isset($options['dropdown_background_color'])){ echo 'background-color:'.esc_attr($options['dropdown_background_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options_passage[dropdown_background_color]" type="text" value="<?php if (isset($options['dropdown_background_color'])) { echo esc_attr($options['dropdown_background_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
								</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('1st level menu style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['menu_color']){ echo 'background-color:'.esc_attr($options['menu_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[menu_color]" type="text" value="<?php if ($options['menu_color']) { echo esc_attr($options['menu_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Hover color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['menu_hovercolor'])){ echo 'background-color:'.esc_attr($options['menu_hovercolor'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[menu_hovercolor]" type="text" value="<?php if (isset($options['menu_hovercolor'])) { echo esc_attr($options['menu_hovercolor'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options_passage[menu_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['menu_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options_passage[menu_fontsize]" type="text" value="<?php if ($options['menu_fontsize']) { echo esc_attr($options['menu_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options_passage[menu_lineheight]" type="text" value="<?php if ($options['menu_lineheight']) { echo esc_attr($options['menu_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options_passage[menu_fontstyle]">
										<option <?php if ($options['menu_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['menu_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['menu_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options_passage[menu_fontweight]">
										<option <?php if ($options['menu_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['menu_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['menu_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['menu_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['menu_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['menu_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['menu_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['menu_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['menu_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
								<br/><br/>
								<div class="inline">
									<?php esc_html_e('Background hover color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['menu_hoverbackgroundcolor'])){ echo 'background-color:'.esc_attr($options['menu_hoverbackgroundcolor'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[menu_hoverbackgroundcolor]" type="text" value="<?php if (isset($options['menu_hoverbackgroundcolor'])) { echo esc_attr($options['menu_hoverbackgroundcolor'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Letter spacing (px)', 'qode'); ?>
									<input name="qode_options_passage[menu_letter_spacing]" type="text" value="<?php if (isset($options['menu_letter_spacing'])) { echo esc_attr($options['menu_letter_spacing'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('2nd level menu style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['dropdown_color'])){ echo 'background-color:'.esc_attr($options['dropdown_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[dropdown_color]" type="text" value="<?php if (isset($options['dropdown_color'])) { echo esc_attr($options['dropdown_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Hover color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['dropdown_hovercolor'])){ echo 'background-color:'.esc_attr($options['dropdown_hovercolor'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[dropdown_hovercolor]" type="text" value="<?php if (isset($options['dropdown_hovercolor'])) { echo esc_attr($options['dropdown_hovercolor'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options_passage[dropdown_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['dropdown_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options_passage[dropdown_fontsize]" type="text" value="<?php if ($options['dropdown_fontsize']) { echo esc_attr($options['dropdown_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options_passage[dropdown_lineheight]" type="text" value="<?php if ($options['dropdown_lineheight']) { echo esc_attr($options['dropdown_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options_passage[dropdown_fontstyle]">
											<option <?php if ($options['dropdown_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['dropdown_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['dropdown_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options_passage[dropdown_fontweight]">
											<option <?php if ($options['dropdown_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['dropdown_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['dropdown_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['dropdown_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['dropdown_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['dropdown_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['dropdown_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['dropdown_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['dropdown_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										</select>
									</div>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('3rd level menu style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['dropdown_color_thirdlvl'])){ echo 'background-color:'.esc_attr($options['dropdown_color_thirdlvl'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[dropdown_color_thirdlvl]" type="text" value="<?php if (isset($options['dropdown_color_thirdlvl'])) { echo esc_attr($options['dropdown_color_thirdlvl'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Hover color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['dropdown_hovercolor_thirdlvl'])){ echo 'background-color:'.esc_attr($options['dropdown_hovercolor_thirdlvl'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[dropdown_hovercolor_thirdlvl]" type="text" value="<?php if (isset($options['dropdown_hovercolor_thirdlvl'])) { echo esc_attr($options['dropdown_hovercolor_thirdlvl'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options_passage[dropdown_google_fonts_thirdlvl]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if(isset($options['dropdown_google_fonts_thirdlvl'])){ $dropdown_google_fonts_thirdlvl = $options['dropdown_google_fonts_thirdlvl']; if ($dropdown_google_fonts_thirdlvl == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options_passage[dropdown_fontsize_thirdlvl]" type="text" value="<?php if (isset($options['dropdown_fontsize_thirdlvl'])) { echo esc_attr($options['dropdown_fontsize_thirdlvl'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options_passage[dropdown_lineheight_thirdlvl]" type="text" value="<?php if (isset($options['dropdown_lineheight_thirdlvl'])) { echo esc_attr($options['dropdown_lineheight_thirdlvl'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options_passage[dropdown_fontstyle_thirdlvl]">
											<option <?php if(isset($options['dropdown_fontstyle_thirdlvl'])){ $dropdown_fontstyle_thirdlvl = $options['dropdown_fontstyle_thirdlvl']; if ($dropdown_fontstyle_thirdlvl == '') { echo "selected='selected'"; } } ?> value=""></option>
											<option <?php if(isset($options['dropdown_fontstyle_thirdlvl'])){ $dropdown_fontstyle_thirdlvl = $options['dropdown_fontstyle_thirdlvl']; if ($dropdown_fontstyle_thirdlvl == 'normal') { echo "selected='selected'"; } } ?> value="normal">normal</option>
											<option <?php if(isset($options['dropdown_fontstyle_thirdlvl'])){ $dropdown_fontstyle_thirdlvl = $options['dropdown_fontstyle_thirdlvl']; if ($dropdown_fontstyle_thirdlvl == 'italic') { echo "selected='selected'"; } } ?> value="italic">italic</option>	
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options_passage[dropdown_fontweight_thirdlvl]">
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '') { echo "selected='selected'"; } } ?> value=""></option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '200') { echo "selected='selected'"; } } ?> value="200">200</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '300') { echo "selected='selected'"; } } ?> value="300">300</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '400') { echo "selected='selected'"; } } ?> value="400">400</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '500') { echo "selected='selected'"; } } ?> value="500">500</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '600') { echo "selected='selected'"; } } ?> value="600">600</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '700') { echo "selected='selected'"; } } ?> value="700">700</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '800') { echo "selected='selected'"; } } ?> value="800">800</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '900') { echo "selected='selected'"; } } ?> value="900">900</option>
										</select>
									</div>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Title', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Responsive title image', 'qode'); ?>
									<select name="qode_options_passage[responsive_title_image]">
										<option <?php if(isset($options['responsive_title_image'])){ $responsive_title_image = $options['responsive_title_image']; if ($responsive_title_image == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
										<option <?php if(isset($options['responsive_title_image'])){ $responsive_title_image = $options['responsive_title_image']; if ($responsive_title_image == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
									</select>
								</div>
								<div class="inline" style="width: 600px;">
									<?php esc_html_e('Title image', 'qode'); ?>
									<input type="text" id="title_image" name="qode_options_passage[title_image]" class="title_image" value="<?php if (isset($options['title_image'])) { echo esc_attr($options['title_image'], 'qode'); } ?>" size="70">
									<input class="upload_button" type="button" value="Upload file">
								</div>
								<br/><br/>
								<div class="inline">
									<?php esc_html_e('Fixed title image', 'qode'); ?>
									<select name="qode_options_passage[fixed_title_image]">
										<option <?php if(isset($options['fixed_title_image'])){ $fixed_title_image = $options['fixed_title_image']; if ($fixed_title_image == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
										<option <?php if(isset($options['fixed_title_image'])){ $fixed_title_image = $options['fixed_title_image']; if ($fixed_title_image == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
									</select>
									<?php esc_html_e('Only if title image is not responsive', 'qode'); ?>
								</div>
								<div class="inline">
									<?php esc_html_e('Title height (px)', 'qode'); ?>
									<input name="qode_options_passage[title_height]" type="text" value="<?php if (isset($options['title_height'])) { echo esc_attr($options['title_height'], 'qode'); } ?>" size="10" maxlength="10" />
									<?php esc_html_e('Only if title image is not responsive', 'qode'); ?>
								</div>
								<br/><br/>
								<div class="inline">
									<?php esc_html_e('Title position', 'qode'); ?>
									<select name="qode_options_passage[page_title_position]">
										<option <?php if ($options['page_title_position'] == 0) { echo "selected='selected'"; } ?> value="0"></option>
										<option <?php if ($options['page_title_position'] == 1) { echo "selected='selected'"; } ?> value="1">Left</option>
										<option <?php if ($options['page_title_position'] == 2) { echo "selected='selected'"; } ?> value="2">Center</option>
										<option <?php if ($options['page_title_position'] == 3) { echo "selected='selected'"; } ?> value="3">Right</option>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Title in grid', 'qode'); ?>
									<select name="qode_options_passage[title_in_grid]">
										<option <?php if(isset($options['title_in_grid'])){ $title_in_grid = $options['title_in_grid']; if ($title_in_grid == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
										<option <?php if(isset($options['title_in_grid'])){ $title_in_grid = $options['title_in_grid']; if ($title_in_grid == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td valign="middle" width="150"><?php esc_html_e('Show footer top', 'qode'); ?></td>
							<td>
								<div class="inline">
									<select name="qode_options_passage[footer_widget_area]">
										<option <?php if ($options['footer_widget_area'] == "no") { echo "selected='selected'"; } ?> value="no">No</option>
										<option <?php if ($options['footer_widget_area'] == "yes") { echo "selected='selected'"; } ?> value="yes">Yes</option>
										
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td valign="middle" width="150"><?php esc_html_e('Show footer bootm', 'qode'); ?></td>
							<td>
								<div class="inline">
									<select name="qode_options_passage[footer_text]">
										<option <?php if ($options['footer_text'] == "no") { echo "selected='selected'"; } ?> value="no">No</option>
										<option <?php if ($options['footer_text'] == "yes") { echo "selected='selected'"; } ?> value="yes">Yes</option>
										
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td scope="row" width="150"><?php esc_html_e('Footer top colors', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Title color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['footer_top_title_color']){ echo 'background-color:'.esc_attr($options['footer_top_title_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[footer_top_title_color]" type="text" value="<?php if ($options['footer_top_title_color']) { echo esc_attr($options['footer_top_title_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Text color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['footer_top_text_color']){ echo 'background-color:'.esc_attr($options['footer_top_text_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[footer_top_text_color]" type="text" value="<?php if ($options['footer_top_text_color']) { echo esc_attr($options['footer_top_text_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Background color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['footer_top_background_color']){ echo 'background-color:'.esc_attr($options['footer_top_background_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[footer_top_background_color]" type="text" value="<?php if ($options['footer_top_background_color']) { echo esc_attr($options['footer_top_background_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr>
							<td scope="row" width="150"><?php esc_html_e('Footer bottom colors', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Text color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['footer_bottom_text_color']){ echo 'background-color:'.esc_attr($options['footer_bottom_text_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[footer_bottom_text_color]" type="text" value="<?php if ($options['footer_bottom_text_color']) { echo esc_attr($options['footer_bottom_text_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Background color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['footer_bottom_background_color']){ echo 'background-color:'.esc_attr($options['footer_bottom_background_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[footer_bottom_background_color]" type="text" value="<?php if (isset($options['footer_bottom_background_color'])) { echo esc_attr($options['footer_bottom_background_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>Elements</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr><td colspan='2'><h2>Separator</h2></td></tr>
						<tr valign="middle">
							<td valign="middle"><?php esc_html_e('Big separator', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['separator_color'])){ echo 'background-color:'.esc_attr($options['separator_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[separator_color]" type="text" value="<?php if (isset($options['separator_color'])) { echo esc_attr($options['separator_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Thickness (px)', 'qode'); ?>
									<input name="qode_options_passage[separator_thickness]" type="text" value="<?php if ($options['separator_thickness']) { echo esc_attr($options['separator_thickness'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Top margin (px)', 'qode'); ?>
									<input name="qode_options_passage[separator_topmargin]" type="text" value="<?php if ($options['separator_topmargin']) { echo esc_attr($options['separator_topmargin'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Bottom margin (px)', 'qode'); ?>
									<input name="qode_options_passage[separator_bottommargin]" type="text" value="<?php if ($options['separator_bottommargin']) { echo esc_attr($options['separator_bottommargin'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr><td colspan='2'><h2>Buttons</h2></td></tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Button style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['button_title_color']){ echo 'background-color:'.esc_attr($options['button_title_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[button_title_color]" type="text" value="<?php if ($options['button_title_color']) { echo esc_attr($options['button_title_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Hover color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['button_title_hovercolor']){ echo 'background-color:'.esc_attr($options['button_title_hovercolor'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[button_title_hovercolor]" type="text" value="<?php if ($options['button_title_hovercolor']) { echo esc_attr($options['button_title_hovercolor'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options_passage[button_title_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['button_title_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options_passage[button_title_fontsize]" type="text" value="<?php if ($options['button_title_fontsize']) { echo esc_attr($options['button_title_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options_passage[button_title_lineheight]" type="text" value="<?php if ($options['button_title_lineheight']) { echo esc_attr($options['button_title_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options_passage[button_title_fontstyle]">
										<option <?php if ($options['button_title_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['button_title_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['button_title_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options_passage[button_title_fontweight]">
										<option <?php if ($options['button_title_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['button_title_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
										<option <?php if ($options['button_title_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
										<option <?php if ($options['button_title_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
										<option <?php if ($options['button_title_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
										<option <?php if ($options['button_title_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
										<option <?php if ($options['button_title_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
										<option <?php if ($options['button_title_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
										<option <?php if ($options['button_title_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
								<br/><br/>
								<div class="inline">
									<?php esc_html_e('Background color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['button_backgroundcolor']){ echo 'background-color:'.esc_attr($options['button_backgroundcolor'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[button_backgroundcolor]" type="text" value="<?php if ($options['button_backgroundcolor']) { echo esc_attr($options['button_backgroundcolor'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr><td colspan='2'><h2>Message box</h2></td></tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Message box style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['message_title_color']){ echo 'background-color:'.esc_attr($options['message_title_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[message_title_color]" type="text" value="<?php if ($options['message_title_color']) { echo esc_attr($options['message_title_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options_passage[message_title_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['message_title_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options_passage[message_title_fontsize]" type="text" value="<?php if ($options['message_title_fontsize']) { echo esc_attr($options['message_title_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options_passage[message_title_lineheight]" type="text" value="<?php if ($options['message_title_lineheight']) { echo esc_attr($options['message_title_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options_passage[message_title_fontstyle]">
										<option <?php if ($options['message_title_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['message_title_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['message_title_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options_passage[message_title_fontweight]">
										<option <?php if ($options['message_title_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['message_title_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
										<option <?php if ($options['message_title_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
										<option <?php if ($options['message_title_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
										<option <?php if ($options['message_title_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
										<option <?php if ($options['message_title_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
										<option <?php if ($options['message_title_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
										<option <?php if ($options['message_title_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
										<option <?php if ($options['message_title_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
								<br/><br/>
								<div class="inline">
									<?php esc_html_e('Background color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['message_backgroundcolor']){ echo 'background-color:'.esc_attr($options['message_backgroundcolor'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[message_backgroundcolor]" type="text" class="colorpicker-input" value="<?php if ($options['message_backgroundcolor']) { echo esc_attr($options['message_backgroundcolor'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr><td colspan='2'><h2>Blockquote</h2></td></tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Text style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['blockquote_font_color']){ echo 'background-color:'.esc_attr($options['blockquote_font_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[blockquote_font_color]" type="text" value="<?php if ($options['blockquote_font_color']) { echo esc_attr($options['blockquote_font_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr><td colspan='2'><h2>Social Icon</h2></td></tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Background color in header', 'qode'); ?></td>
							<td>
								<div class="inline">
									<div class="colorSelector"><div style="<?php if ($options['social_icon_background_header']){ echo 'background-color:'.esc_attr($options['social_icon_background_header'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[social_icon_background_header]" type="text" value="<?php if(isset($options['social_icon_background_header'])){ if ($options['social_icon_background_header']) { echo esc_attr($options['social_icon_background_header'], 'qode'); } } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Background color', 'qode'); ?></td>
							<td>
								<div class="inline">
									<div class="colorSelector"><div style="<?php if ($options['social_icon_background']){ echo 'background-color:'.esc_attr($options['social_icon_background'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[social_icon_background]" type="text" value="<?php if(isset($options['social_icon_background'])){ if ($options['social_icon_background']) { echo esc_attr($options['social_icon_background'], 'qode'); } } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>	
						<tr><td colspan='2'><h2>Box Hover Overlay</h2></td></tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Background color', 'qode'); ?></td>
							<td>
								<div class="inline">
									<div class="colorSelector"><div style="<?php if ($options['box_hover_overlay']){ echo 'background-color:'.esc_attr($options['box_hover_overlay'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[box_hover_overlay]" type="text" value="<?php if(isset($options['box_hover_overlay'])){ if ($options['box_hover_overlay']) { echo esc_attr($options['box_hover_overlay'], 'qode'); } } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr><td colspan='2'><h2>Box Elements Border</h2></td></tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Background color', 'qode'); ?></td>
							<td>
								<div class="inline">
									<div class="colorSelector"><div style="<?php if ($options['box_elements_border']){ echo 'background-color:'.esc_attr($options['box_elements_border'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[box_elements_border]" type="text" value="<?php if(isset($options['box_elements_border'])){ if ($options['box_elements_border']) { echo esc_attr($options['box_elements_border'], 'qode'); } } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr><td colspan='2'><h2>Smooth Scroll</h2></td></tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Smooth scroll style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Background color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['smooth_background_color']){ echo 'background-color:'.esc_attr($options['smooth_background_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[smooth_background_color]" type="text" value="<?php if(isset($options['smooth_background_color'])){ if ($options['smooth_background_color']) { echo esc_attr($options['smooth_background_color'], 'qode'); } } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Bar color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['smooth_bar_color']){ echo 'background-color:'.esc_attr($options['smooth_bar_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options_passage[smooth_bar_color]" type="text" value="<?php if(isset($options['smooth_bar_color'])){ if ($options['smooth_bar_color']) { echo esc_attr($options['smooth_bar_color'], 'qode'); } } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>Parallax</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Parallax speed', 'qode'); ?></td>
							<td>
								<div class="inline">
									<input name="qode_options_passage[parallax_speed]" type="text" value="<?php if ($options['parallax_speed']) { echo esc_attr($options['parallax_speed'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Parallax on touch devices', 'qode'); ?></td>
							<td>
								<div class="inline">
									<select name="qode_options_passage[parallax_onoff]">
									<option <?php if ($options['parallax_onoff'] == "on") { echo "selected='selected'"; } ?> value="on">on</option>
									<option <?php if ($options['parallax_onoff'] == "off") { echo "selected='selected'"; } ?> value="off">off</option>
								</select>
								</div>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Parallax min height (px)', 'qode'); ?></td>
							<td>
								<div class="inline">
									<input name="qode_options_passage[parallax_minheight]" type="text" value="<?php if ($options['parallax_minheight']) { echo esc_attr($options['parallax_minheight'], 'qode'); } ?>" size="10" maxlength="10" />
									<?php esc_html_e('Set min-height for last two stages', 'qode'); ?>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<h3>Portfolio</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr><td colspan='2'><h2>Portfolio single</h2></td></tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Portfolio style', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[portfolio_style]">
									<option <?php if ($options['portfolio_style'] == 1) { echo "selected='selected'"; } ?> value="1">Portfolio style 1</option>
									<option <?php if ($options['portfolio_style'] == 2) { echo "selected='selected'"; } ?> value="2">Portfolio style 2</option>
									<option <?php if ($options['portfolio_style'] == 3) { echo "selected='selected'"; } ?> value="3">Portfolio style 3</option>
									<option <?php if ($options['portfolio_style'] == 4) { echo "selected='selected'"; } ?> value="4">Portfolio style 4</option>
									<option <?php if ($options['portfolio_style'] == 5) { echo "selected='selected'"; } ?> value="5">Portfolio style 5</option>
									<option <?php if ($options['portfolio_style'] == 6) { echo "selected='selected'"; } ?> value="6">Portfolio style 6</option>
								</select>
							</td>
						</tr>
						<tr>
							<td valign="middle" width="150"><?php esc_html_e('Lightbox for single project', 'qode'); ?></td>
							<td>
								<div class="inline">
									<select name="qode_options_passage[lightbox_single_project]">
										<option <?php if(isset($options['lightbox_single_project'])){ $lightbox_single_project = $options['lightbox_single_project']; if ($lightbox_single_project == 'no') { echo "selected='selected'"; } }  ?> value="no">No</option>
										<option <?php if(isset($options['lightbox_single_project'])){ $lightbox_single_project = $options['lightbox_single_project']; if ($lightbox_single_project == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td valign="middle" width="150"><?php esc_html_e('Number of columns for Portfolio Style 6', 'qode'); ?></td>
							<td>
								<div class="inline">
									<select name="qode_options_passage[portfolio_columns_number]">
										<option <?php if(isset($options['portfolio_columns_number'])){ $portfolio_columns_number = $options['portfolio_columns_number']; if ($options['portfolio_columns_number'] == 2) { echo "selected='selected'"; } } ?> value="2">2 columns</option>
										<option <?php if(isset($options['portfolio_columns_number'])){ $portfolio_columns_number = $options['portfolio_columns_number']; if ($options['portfolio_columns_number'] == 3) { echo "selected='selected'"; } } ?> value="3">3 columns</option>
										<option <?php if(isset($options['portfolio_columns_number'])){ $portfolio_columns_number = $options['portfolio_columns_number']; if ($options['portfolio_columns_number'] == 4) { echo "selected='selected'"; } } ?> value="4">4 columns</option>
									</select>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>Blog</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr><td colspan='2'><h2>Blog list</h2></td></tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Pagination', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[pagination]">
									<option <?php if ($options['pagination'] == 0) { echo "selected='selected'"; } ?> value="0">No</option>
									<option <?php if ($options['pagination'] == 1) { echo "selected='selected'"; } ?> value="1">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Choose sidebar layout', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[blog_style]">
									<option <?php if ($options['blog_style'] == 1) { echo "selected='selected'"; } ?> value="1"><?php esc_html_e('Blog style 1', 'qode'); ?></option>
									<option <?php if ($options['blog_style'] == 2) { echo "selected='selected'"; } ?> value="2"><?php esc_html_e('Blog style 2', 'qode'); ?></option>
									<option <?php if ($options['blog_style'] == 3) { echo "selected='selected'"; } ?> value="3"><?php esc_html_e('Blog style 3', 'qode'); ?></option>
									<option <?php if ($options['blog_style'] == 4) { echo "selected='selected'"; } ?> value="4"><?php esc_html_e('Blog style 4', 'qode'); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Blog sidebar', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[category_blog_sidebar]">
									<option <?php if ($options['category_blog_sidebar'] == "default") { echo "selected='selected'"; } ?> value="default">No Sidebar</option>
									<option <?php if ($options['category_blog_sidebar'] == 1) { echo "selected='selected'"; } ?> value="1">Sidebar 1/3 right</option>
									<option <?php if ($options['category_blog_sidebar'] == 2) { echo "selected='selected'"; } ?> value="2">Sidebar 1/4 right</option>
									<option <?php if ($options['category_blog_sidebar'] == 3) { echo "selected='selected'"; } ?> value="3">Sidebar 1/3 left</option>
									<option <?php if ($options['category_blog_sidebar'] == 4) { echo "selected='selected'"; } ?> value="4">Sidebar 1/4 left</option>
									
								</select>
								<?php esc_html_e('For category list', 'qode'); ?>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Hide comments', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[blog_hide_comments]">
									<option <?php if(isset($options['blog_hide_comments'])){ $blog_hide_comments = $options['blog_hide_comments']; if ($blog_hide_comments == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
									<option <?php if(isset($options['blog_hide_comments'])){ $blog_hide_comments = $options['blog_hide_comments']; if ($blog_hide_comments == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Number of characters', 'qode'); ?></td>
							<td>
								<input name="qode_options_passage[number_of_chars]" type="text" class="colorpicker-input" value="<?php if ($options['number_of_chars']) { echo esc_attr($options['number_of_chars'], 'qode'); } ?>" size="10" maxlength="10" />
								<?php esc_html_e('Number of characters in blog listing', 'qode'); ?>
							</td>
						</tr>
						<tr><td colspan='2'><h2>Blog single</h2></td></tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Sidebar layout', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[blog_single_sidebar]">
									<option <?php if(isset($options['blog_single_sidebar'])){$blog_single_sidebar = $options['blog_single_sidebar']; if ($blog_single_sidebar == "default") { echo "selected='selected'"; } } ?> value="default">No Sidebar</option>
									<option <?php if(isset($options['blog_single_sidebar'])){$blog_single_sidebar = $options['blog_single_sidebar']; if ($blog_single_sidebar == 1) { echo "selected='selected'"; } } ?> value="1">Sidebar 1/3 right</option>
									<option <?php if(isset($options['blog_single_sidebar'])){$blog_single_sidebar = $options['blog_single_sidebar']; if ($blog_single_sidebar == 2) { echo "selected='selected'"; } } ?> value="2">Sidebar 1/4 right</option>
									<option <?php if(isset($options['blog_single_sidebar'])){$blog_single_sidebar = $options['blog_single_sidebar']; if ($blog_single_sidebar == 3) { echo "selected='selected'"; } } ?> value="3">Sidebar 1/3 left</option>
									<option <?php if(isset($options['blog_single_sidebar'])){$blog_single_sidebar = $options['blog_single_sidebar']; if ($blog_single_sidebar == 4) { echo "selected='selected'"; } } ?> value="4">Sidebar 1/4 left</option>
									
								</select>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Sidebar to display', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[blog_single_sidebar_custom_display]">
									<option value="" <?php if(isset($options['blog_single_sidebar_custom_display'])){ $blog_single_sidebar_custom_display = $options['blog_single_sidebar_custom_display'];  if ($blog_single_sidebar_custom_display == "" ) { echo "selected='selected'";  } }?>></option>
									<?php
									foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
										if(isUserMadeSidebar(ucwords($sidebar['name']))){
									?>
										<option value="<?php echo ucwords( $sidebar['id'] ); ?>" <?php if(isset($options['blog_single_sidebar_custom_display'])){ $blog_single_sidebar_custom_display = $options['blog_single_sidebar_custom_display'];  if ($blog_single_sidebar_custom_display == ucwords( $sidebar['id'] ) ) { echo "selected='selected'";  } }?>>
											<?php echo ucwords( $sidebar['name'] ); ?>
										</option>
										<?php	
											}
										}
										?>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3><?php esc_html_e('Contact page', 'qode'); ?></h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Mail send to', 'qode'); ?></td>
							<td>
								<input name="qode_options_passage[receive_mail]" type="text" value="<?php if ($options['receive_mail']) { echo esc_attr($options['receive_mail'], 'qode'); } ?>"  />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Enable Contact Form', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[enable_contact_form]">
									<option <?php if ($options['enable_contact_form'] == "no") { echo "selected='selected'"; } ?> value="no">No</option>
									<option <?php if ($options['enable_contact_form'] == "yes") { echo "selected='selected'"; } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Hide Website Field', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[hide_contact_form_website]">
									<option <?php if(isset($options['hide_contact_form_website'])){ $hide_contact_form_website = $options['hide_contact_form_website']; if ($hide_contact_form_website == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
									<option <?php if(isset($options['hide_contact_form_website'])){ $hide_contact_form_website = $options['hide_contact_form_website']; if ($hide_contact_form_website == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Email From', 'qode'); ?></td>
							<td>
								<input name="qode_options_passage[email_from]" type="text" value="<?php if ($options['email_from']) { echo esc_attr($options['email_from'], 'qode'); } ?>"  />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Email Subject', 'qode'); ?></td>
							<td>
								<input name="qode_options_passage[email_subject]" type="text" value="<?php if ($options['email_subject']) { echo esc_attr($options['email_subject'], 'qode'); } ?>"  />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Use reCaptcha', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[use_recaptcha]">
									<option <?php if ($options['use_recaptcha'] == "no") { echo "selected='selected'"; } ?> value="no">No</option>
									<option <?php if ($options['use_recaptcha'] == "yes") { echo "selected='selected'"; } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('ReCaptcha public key', 'qode'); ?></td>
							<td>
								<input name="qode_options_passage[recaptcha_public_key]" type="text" value="<?php if ($options['recaptcha_public_key']) { echo esc_attr($options['recaptcha_public_key'], 'qode'); } ?>"  />
							
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('ReCaptcha private key', 'qode'); ?></td>
							<td>
								<input name="qode_options_passage[recaptcha_private_key]" type="text" value="<?php if ($options['recaptcha_private_key']) { echo esc_attr($options['recaptcha_private_key'], 'qode'); } ?>"  />
							</td>
						</tr>			
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Heading above contact form', 'qode'); ?></td>
							<td>
								<input name="qode_options_passage[contact_heading_above]" type="text" value="<?php if ($options['contact_heading_above']) { echo esc_attr($options['contact_heading_above'], 'qode'); } ?>"  />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Enable Google Map', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[enable_google_map]">
									<option <?php if ($options['enable_google_map'] == "no") { echo "selected='selected'"; } ?> value="no">No</option>
									<option <?php if ($options['enable_google_map'] == "yes") { echo "selected='selected'"; } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<?php if($options['enable_google_map'] == "yes") : ?>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Pin image', 'qode'); ?></td>
							<td>	
								<div class="inline" style="width: 600px;">
								<input type="text" id="google_maps_pin_image" name="qode_options_passage[google_maps_pin_image]" class="google_maps_pin_image" value="<?php if (isset($options['google_maps_pin_image'])) { echo esc_attr($options['google_maps_pin_image'], 'qode'); } else { echo QODE_ROOT."/img/pin.png"; } ?>" size="70">
								<input class="upload_button" type="button" value="Upload file">
								</div>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Google map address', 'qode'); ?></td>
							<td>
								<input id="google_maps_address" name="qode_options_passage[google_maps_address]" value="<?php if (isset($options['google_maps_address'])) { echo esc_attr($options['google_maps_address'], 'qode'); } ?>" size="130" />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Google map zoom', 'qode'); ?></td>
							<td>
								<input id="google_maps_zoom" name="qode_options_passage[google_maps_zoom]" value="<?php if (isset($options['google_maps_zoom'])) { echo esc_attr($options['google_maps_zoom'], 'qode'); } ?>" size="10" maxlength="10" />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Google map height (px)', 'qode'); ?></td>
							<td>
								<input id="google_maps_height" name="qode_options_passage[google_maps_height]" value="<?php if (isset($options['google_maps_height'])) { echo esc_attr($options['google_maps_height'], 'qode'); } ?>" size="10" maxlength="10" />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Google map scroll on mouse wheel', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[google_maps_scroll_wheel]">
									<option <?php if(isset($options['google_maps_scroll_wheel'])){ $google_maps_scroll_wheel = $options['google_maps_scroll_wheel']; if ($google_maps_scroll_wheel == 'no') { echo "selected='selected'"; } }  ?> value="no">No</option>
									<option <?php if(isset($options['google_maps_scroll_wheel'])){ $google_maps_scroll_wheel = $options['google_maps_scroll_wheel']; if ($google_maps_scroll_wheel == 'yes') { echo "selected='selected'"; } }  ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>404 page</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Title', 'qode'); ?></td>
							<td>
								<input name="qode_options_passage[404_title]" type="text" value="<?php if ($options['404_title']) { echo esc_attr($options['404_title'], 'qode'); } ?>"  />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Text', 'qode'); ?></td>
							<td>
								<input name="qode_options_passage[404_text]" type="text" value="<?php if ($options['404_text']) { echo esc_attr($options['404_text'], 'qode'); } ?>"  />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Back to home label', 'qode'); ?></td>
							<td>
								<input name="qode_options_passage[404_backlabel]" type="text" value="<?php if ($options['404_backlabel']) { echo esc_attr($options['404_backlabel'], 'qode'); } ?>"  />
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>Social</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Enable Social Share', 'qode'); ?></td>
							<td>
								<select name="qode_options_passage[enable_social_share]">
									<option <?php if(isset($options['enable_social_share'])){ $enable_social_share = $options['enable_social_share']; if ($enable_social_share == "no") { echo "selected='selected'"; } } ?> value="no">No</option>
									<option <?php if(isset($options['enable_social_share'])){ $enable_social_share = $options['enable_social_share']; if ($enable_social_share == "yes") { echo "selected='selected'"; } } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Facebook', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Enable Facebook', 'qode'); ?>
									<select name="qode_options_passage[enable_facebook_share]">
										<option <?php if(isset($options['enable_facebook_share'])){ $enable_facebook_share = $options['enable_facebook_share']; if ($enable_facebook_share == "no") { echo "selected='selected'"; } } ?> value="no">No</option>
										<option <?php if(isset($options['enable_facebook_share'])){ $enable_facebook_share = $options['enable_facebook_share']; if ($enable_facebook_share == "yes") { echo "selected='selected'"; } }?> value="yes">Yes</option>
									</select>
								</div>
								<div class="inline" style="width: 600px;">
									<?php esc_html_e('Share Icon', 'qode'); ?>
									<input type="text" id="facebook_icon" name="qode_options_passage[facebook_icon]" class="facebook_icon" value="<?php if (isset($options['facebook_icon'])) { echo esc_attr($options['facebook_icon'], 'qode'); } ?>" size="70">
									<input class="upload_button" type="button" value="Upload file">
								</div>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Twitter', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Enable Twitter', 'qode'); ?>
									<select name="qode_options_passage[enable_twitter_share]">
										<option <?php if(isset($options['enable_twitter_share'])){ $enable_twitter_share = $options['enable_twitter_share']; if ($enable_twitter_share == "no") { echo "selected='selected'"; } } ?> value="no">No</option>
										<option <?php if(isset($options['enable_twitter_share'])){ $enable_twitter_share = $options['enable_twitter_share']; if ($enable_twitter_share == "yes") { echo "selected='selected'"; } } ?> value="yes">Yes</option>
									</select>
								</div>
								<div class="inline" style="width: 600px;">
									<?php esc_html_e('Share Icon', 'qode'); ?>
									<input type="text" id="twitter_icon" name="qode_options_passage[twitter_icon]" class="twitter_icon" value="<?php if (isset($options['twitter_icon'])) { echo esc_attr($options['twitter_icon'], 'qode'); } ?>" size="70">
									<input class="upload_button" type="button" value="Upload file">
								</div>
								<div class="inline">
									<?php esc_html_e('Via', 'qode'); ?>
									<input name="qode_options_passage[twitter_via]" type="text" value="<?php if (isset($options['twitter_via'])) { echo esc_attr($options['twitter_via'], 'qode'); } ?>"  />
								</div>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Google +', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Enable Google +', 'qode'); ?>
									<select name="qode_options_passage[enable_google_plus]">
										<option <?php if(isset($options['enable_google_plus'])){ $enable_google_plus = $options['enable_google_plus']; if ($enable_google_plus == "no") { echo "selected='selected'"; } } ?> value="no">No</option>
										<option <?php if(isset($options['enable_google_plus'])){ $enable_google_plus = $options['enable_google_plus']; if ($enable_google_plus == "yes") { echo "selected='selected'"; } } ?> value="yes">Yes</option>
									</select>
								</div>
								<div class="inline" style="width: 600px;">
									<?php esc_html_e('Share Icon', 'qode'); ?>
									<input type="text" id="google_plus_icon" name="qode_options_passage[google_plus_icon]" class="google_plus_icon" value="<?php if (isset($options['google_plus_icon'])) { echo esc_attr($options['google_plus_icon'], 'qode'); } ?>" size="70">
									<input class="upload_button" type="button" value="Upload file">
								</div>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Show For', 'qode'); ?></td>
							<td>
							<?php 
								$post_types = get_post_types(); 
								foreach ($post_types as $post_type ) {
									if($post_type != "attachment" && $post_type != "revision" && $post_type != "nav_menu_item") {
									$post_type_object = get_post_type_object($post_type );
									?>
								 <input type="checkbox" value="<?php echo $post_type; ?>" <?php if (isset($options["post_types_names_$post_type"]) && ($options["post_types_names_$post_type"] == "$post_type")){ echo "checked='checked'"; }?> name="qode_options_passage[post_types_names_<?php echo $post_type; ?>]" /><?php echo " " . $post_type_object->labels->singular_name;  ?><br /><br />
								 
								<?php } } ?>
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
		</div>
<?php	}


} // end of qode_Theme_Options Class



function display_save_changes_button() {
	    echo ('
		    <table class="form-table">
			<tbody>
			    <tr valign="middle">
				<th scope="row" width="150">&nbsp;</th>
				<td>
				    <div class="submit" style="padding:10px 0 0 80px; float:right; clear:both;">
					<input type="hidden" id="qode_submit" value="1" name="qode_submit"/>
					<input class="button-primary" type="submit" name="submit" value="'.esc_attr__('Save Changes', 'qode').'" />
				    </div>
				</td>
			    </tr>
			</tbody>
		    </table>');
}




$my_Qode_Theme_Options = new Qode_Theme_Options();


