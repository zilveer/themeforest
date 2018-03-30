<?php if(! defined('ABSPATH')){ return; }
/*
Name: Newsletter Box
Description: Create and display a Newsletter Box element based on Mailchimp platform
Class: TH_NewsletterBox
Category: content
Keywords: mailing list, mailchimp
Level: 3
*/
/**
 * Class TH_NewsletterBox
 *
 * Create and display a Newsletter Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.8
 */
class TH_NewsletterBox extends ZnElements
{
	public static function getName(){
		return __( "Newsletter Box", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];
		$btn_css = '';

		// width of the button
		$width = (int) $this->opt('nb_btn_width', '130');
		if( $width != 130 ){
			$btn_css .= "width:". $width."px;";
			$css .= '.'.$uid.'.nlbox--layout-separate .elm-nlbox__input {width:calc(100% - '. ($width + 10).'px);}';
			$css .= '.'.$uid.'.nlbox--layout-single .elm-nlbox__input {width:calc(100% - '. $width.'px);}';
		}
		// height of the form
		$height = (int) $this->opt('nb_btn_height', '55');
		if( $height != 55 ) {
			$btn_css .= "height:". $height ."px;";
			$css .= ".$uid .elm-nlbox__input {height:". $height ."px}";
		}

		$btn_color = $this->opt('nb_btn_color','#cd2122');
		if( $btn_color != '#cd2122' ){
			$btn_css .= "background-color:". $btn_color.";";
		}

		$btn_color_hov = $this->opt('nb_btn_color_hov','#000000');
		if( $btn_color_hov != '#000000' ){
			$css .= ".$uid .elm-nlbox__submit:hover {background-color:". $btn_color_hov.";}";
		}
		if(!empty($btn_css)){
			$css .= ".$uid .elm-nlbox__submit{". $btn_css.";}";
		}

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$elm_classes=array();
		$elm_classes[] = $uid = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$elm_classes[] = 'nlbox--style-'.$this->opt('nb_style', 'normal');
		$elm_classes[] = 'nlbox--layout-'.$this->opt('nb_layout', 'single');

		$corner_radius = $this->opt('button_corners', 'btn--rounded');

		?>

		<div class="elm-nlbox <?php echo implode(' ', $elm_classes); ?>" <?php echo $attributes; ?>>

			<?php
			$nl_id = $this->opt('nb_mlid','');
			if ( !empty ( $nl_id ) ) {

			?>
				<form method="post" class="elm-nlbox__form clearfix" data-url="<?php echo trailingslashit(home_url()) ?>" name="newsletter_form">
					<input type="text" name="zn_mc_email" class="elm-nlbox__input nl-email form-control <?php echo $corner_radius; ?>" value="" placeholder="<?php echo $this->opt('nb_em_pl'); ?>" required="required" />
					<button type="submit" name="submit" class="elm-nlbox__submit nl-submit <?php echo $corner_radius; ?>">
						<?php
							if( $this->opt('nb_btn_type','text') == 'text' ){
								echo $this->opt('nb_sb_pl','JOIN US');
							} else {
								echo '<span class="elm-nlbox__icon" '. zn_generate_icon( $this->opt('nb_icon') ) .'></span>';
							}
						?>
					</button>
					<input type="hidden" name="zn_list_class" class="nl-lid" value="<?php echo $nl_id; ?>" />
				</form>
				<div class="elm-nlbox__result zn_mailchimp_result"></div>
			<?php
			}
			?>

		</div><!-- /.newsletter-box -->

		<?php
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{

		$uid = $this->data['uid'];

		$mail_lists = array ();
		$mailchimp_api = zget_option( 'mailchimp_api', 'general_options' );
		if ( ! empty( $mailchimp_api ) ) {
			if ( ! class_exists( 'MCAPI' ) ) {
				include_once( THEME_BASE . '/template_helpers/widgets/mailchimp/MCAPI.class.php' );
			}

			$api_key = $mailchimp_api;
			$mcapi   = new MCAPI( $api_key );

			if(zget_option( 'mailchimp_secure', 'general_options', false, 'no' ) == 'yes'){
				$mcapi->useSecure(true);
			}

			$lists   = $mcapi->lists();
			if ( ! empty( $lists['data'] ) ) {
				foreach ( $lists['data'] as $key => $value ) {
					$mail_lists[ $value['id'] ] = $value['name'];
				}
			}
		}

		return array (
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Mailchimp List ID", 'zn_framework' ),
						"description" => sprintf(__( 'Please enter your Mailchimp list id. In order to make Mailchimp work, you should also add your Mailchimp api key in the theme\'s admin page. <br><br><span class="dashicons dashicons-share-alt2 u-v-mid"></span> <a href="%s" target="_blank">Access Mailchimp options in Kallyas Options.</a>', 'zn_framework' ), admin_url('admin.php?page=zn_tp_general_options#mailchimp_options') ),
						"id"          => "nb_mlid",
						"std"         => "",
						"type"        => "select",
						'options'     => $mail_lists,
					),

					array (
						"name"        => __( "Form Style", 'zn_framework' ),
						"description" => __( "Choose a style", 'zn_framework' ),
						"id"          => "nb_style",
						"std"         => "normal",
						"type"        => "select",
						"options"     => array (
							'normal'  => __( 'White input and filled button', 'zn_framework' ),
							'normal2' => __( 'White input and transparent button', 'zn_framework' ),
							'transparent'  => __( 'Transparent input and filled button', 'zn_framework' ),
							'transparent2' => __( 'Transparent input and transparent button', 'zn_framework' ),
							'lined_light'  => __( 'White Lined Input + filled button', 'zn_framework' ),
							'lined_dark'  => __( 'Dark Lined Input + filled button', 'zn_framework' ),
						),
						'live' => array(
						   'type'        => 'class',
						   'css_class' => '.'.$uid,
						   'val_prepend'   => 'elm-nlbox nlbox--style-',
						)
					),

					array (
						"name"        => __( "Form Layout", 'zn_framework' ),
						"description" => __( "Choose a form field layout", 'zn_framework' ),
						"id"          => "nb_layout",
						"std"         => "single",
						"type"        => "select",
						"options"     => array (
							'single'  => __( 'Single Block', 'zn_framework' ),
							'separate' => __( 'Separatetely with a distance between them', 'zn_framework' ),
							'rows'  => __( 'On separate rows', 'zn_framework' ),
							'rows-full'  => __( 'On separate rows full ', 'zn_framework' ),
						),
						'live' => array(
						   'type'        => 'class',
						   'css_class' => '.'.$uid,
						   'val_prepend'   => 'elm-nlbox nlbox--layout-',
						)
					),

					array (
						"name"        => __( "Email field placeholder", 'zn_framework' ),
						"description" => __( "Please add the placeholder for the email field", 'zn_framework' ),
						"id"          => "nb_em_pl",
						"std"         => "your.address@email.com",
						"type"        => "text",
					),

					array (
						"name"        => __( "Form height", 'zn_framework' ),
						"description" => __( "Specify the form height", 'zn_framework' ),
						"id"          => "nb_btn_height",
						"std"         => "55",
						'type'        => 'slider',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '20',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'multiple' => array(
								array(
									'type'        => 'css',
									'css_class' => '.'.$uid.' .elm-nlbox__submit',
									'css_rule'  => 'height',
									'unit'      => 'px'
								),
								array(
									'type'        => 'css',
									'css_class' => '.'.$uid.' .elm-nlbox__input',
									'css_rule'  => 'height',
									'unit'      => 'px'
								),
							)

						)
					),

					array (
						"name"        => __( "Input & Button Corners", 'zn_framework' ),
						"description" => __( "Select the input and button corners type", 'zn_framework' ),
						"id"          => "button_corners",
						"std"         => "btn--rounded",
						"type"        => "select",
						"options"     => array (
							'btn--rounded'  => __( "Smooth rounded corner", 'zn_framework' ),
							'btn--round'    => __( "Round corners", 'zn_framework' ),
							'btn--square'   => __( "Square corners", 'zn_framework' ),
						),
						'live' => array(
						   'multiple' => array(
						   		array(
						   			'type'           => 'class',
									'css_class'      => '.'.$uid.' .elm-nlbox__submit',
					   			),
					   			array(
						   			'type'           => 'class',
									'css_class'      => '.'.$uid.' .elm-nlbox__input',
					   			)
						   	)
						),
					),
				),
			),

			'button' => array(
				'title' => 'Button options',
				'options' => array(

					array (
						"name"        => __( "Button text type", 'zn_framework' ),
						"description" => __( "Choose the button text or icon", 'zn_framework' ),
						"id"          => "nb_btn_type",
						"std"         => "text",
						"type"        => "select",
						"options"     => array (
							'icon'  => __( 'Icon', 'zn_framework' ),
							'text' => __( 'Custom text', 'zn_framework' )
						)
					),

					array (
						"name"        => __( "Button Color", 'zn_framework' ),
						"description" => __( "Choose the button's color", 'zn_framework' ),
						"id"          => "nb_btn_color",
						"std"         => "#cd2122",
						"type"        => "colorpicker",
						"dependency"  => array( 'element' => 'nb_style' , 'value'=> array('normal','transparent', 'lined_light', 'lined_dark') ),
						'live' => array(
							'type'        => 'css',
							'css_class' => '.'.$uid.' .elm-nlbox__submit',
							'css_rule'  => 'background-color',
							'unit'      => ''
						)
					),

					array (
						"name"        => __( "Button Hover Color", 'zn_framework' ),
						"description" => __( "Choose the button's hover color", 'zn_framework' ),
						"id"          => "nb_btn_color_hov",
						"std"         => "#000000",
						"type"        => "colorpicker",
						"dependency"  => array( 'element' => 'nb_style' , 'value'=> array('normal','transparent', 'lined_light', 'lined_dark') )
					),

					array (
						"name"        => __( "Submit field placeholder", 'zn_framework' ),
						"description" => __( "Please add the placeholder for the submit button", 'zn_framework' ),
						"id"          => "nb_sb_pl",
						"std"         => "JOIN US",
						"type"        => "text",
						"dependency"  => array( 'element' => 'nb_btn_type' , 'value'=> array('text') )
					),

					array (
						"name"        => __( "Select Icon for Submit button", 'zn_framework' ),
						"description" => __( "Select an icon to display.", 'zn_framework' ),
						"id"          => "nb_icon",
						"std"         => "",
						"type"        => "icon_list",
						'class'       => 'zn_full',
						"dependency"  => array( 'element' => 'nb_btn_type' , 'value'=> array('icon') ),
					),

					array (
						"name"        => __( "Font Size", 'zn_framework' ),
						"description" => __( "Select the size of the button text or icon.", 'zn_framework' ),
						"id"          => "nb_font_size",
						"std"         => "16",
						'type'        => 'slider',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '10',
							'max' => '48',
							'step' => '1'
						),
						'live' => array(
							'type'        => 'css',
							'css_class' => '.'.$uid.' .elm-nlbox__submit',
							'css_rule'  => 'font-size',
							'unit'      => 'px'
						)
					),

					array (
						"name"        => __( "Button width (px)", 'zn_framework' ),
						"description" => __( "Add a button width", 'zn_framework' ),
						"id"          => "nb_btn_width",
						"std"         => "130",
						"type"        => "slider",
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '20',
							'max' => '1000',
							'step' => '5'
						),
						'live' => array(
							'type'        => 'css',
							'css_class' => '.'.$uid.' .elm-nlbox__submit',
							'css_rule'  => 'width',
							'unit'      => 'px'
						)
					),

				)
			),

		);
	}
}
