<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Steps Box
 Description: Create and display a Steps Box element
 Class: TH_StepsBox
 Category: content
 Level: 3
 Keywords: icons, tour, process, services
*/
/**
 * Class TH_StepsBox
 *
 * Create and display a Steps Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StepsBox extends ZnElements
{
	public static function getName(){
		return __( "Steps Box", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];
		$boxes = $this->opt( 'steps_single', array() );

		// Box background
		foreach ($boxes as $key => $box) {
			if( ! empty( $box['stp_box_color'] ) ){
				// proper index, start from 1
				$index = $key + 1;
				// fix for intro process box
				$index = $index + 1;
				$bg_color = $box['stp_box_color'];
				$css .= ".process_steps--style1 .process_steps__step:nth-child({$index}) { background-color: {$bg_color}; }";
				$css .= ".process_steps--style1 .process_steps__step:nth-child({$index}):after { border-left-color: {$bg_color}; }";
			}
		}

		// Icon sizes
		$icon_size = $this->opt('stp_size','56');
		if( $icon_size != '56' ){
			$css .= ".{$uid} .process_steps__step-icon {font-size: {$icon_size}px }";
		}

		// Icon sizes
		$height = $this->opt('stp_height','235');
		if( $height != '235' && $this->opt('stepsbox_style','style1') == 'style2' ){
			$css .= ".{$uid} .process_steps__intro, .{$uid} .process_steps__inner { min-height: {$height}px }";
		}

		// Intro background color
		$intro_bg_color = $this->opt('intro_bg_color','');
		if( !empty($intro_bg_color) ){
			$css .= ".{$uid} .process_steps__intro{background-color:{$intro_bg_color}}";
			if($this->opt('stepsbox_style','style1') == 'style1'){
				$css .= ".{$uid} .process_steps__intro:after{border-left-color:{$intro_bg_color}}";
			}
		}
		// Intro Text color
		$intro_text_color = $this->opt('intro_text_color','');
		if( !empty($intro_text_color) ){
			$css .= ".{$uid} .process_steps__intro, .{$uid} .process_steps__intro-link{color:{$intro_text_color}}";
			if($this->opt('stepsbox_style','style1') == 'style2'){
				$css .= ".{$uid} .process_steps__intro-title::before{background-color:{$intro_text_color}}";
			}
		}

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$stepbox_style = $this->opt('stepsbox_style', 'style1');
		$stp_bgcolor = $this->opt('stp_bgcolor', 'light');

		$classes=array();
		$classes[] = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);
		$classes[] = 'process_steps--'.$stepbox_style;
		$classes[] = 'kl-bgc-'.$stp_bgcolor;

		$attributes = zn_get_element_attributes($options);

		?>
		<div class="process_steps <?php echo implode(' ', $classes); ?>" <?php echo $attributes; ?>>
			<div class="process_steps__step process_steps__intro process_steps__height">
				<div class="process_steps__intro-wrp">
				<?php
				if ( ! empty ( $options['stp_title'] ) || ! empty ( $options['stp_subtitle'] ) ) {

					echo '<h3 class="process_steps__intro-title" '.WpkPageHelper::zn_schema_markup('title').'>';
					// TITLE
					if ( ! empty ( $options['stp_title'] ) ) {
						echo $options['stp_title'];
					}
					// TITLE
					if ( ! empty ( $options['stp_subtitle'] ) ) {
						echo '<strong>' . $options['stp_subtitle'] . '</strong>';
					}
					echo '</h3>';
				}

				// CONTENT
				if ( ! empty ( $options['stp_desc'] ) ) {
					if ( preg_match( '%(<p[^>]*>.*?</p>)%i', $options['stp_desc'], $regs ) ) {
						echo $options['stp_desc'];
					}
					else {
						echo '<p class="process_steps__intro-desc">' . $options['stp_desc'] . '</p>';
					}
				}

				$stp_text_link = $this->opt('stp_text_link','');
				$stp_link = zn_extract_link( $this->opt('stp_link',''), 'process_steps__intro-link');

				if ( ! empty ( $stp_text_link ) && ! empty ( $stp_link['start'] ) ) {
					echo $stp_link['start'] . $stp_text_link . ' +' . $stp_link['end'];
				}
				?>
				</div>
			</div>
			<!-- end step -->

			<?php if($stepbox_style == 'style2'){ ?>
			<div class="process_steps__container">
				<div class="process_steps__inner process_steps__height">
			<?php } ?>

			<?php
			if ( ! empty ( $options['steps_single'] ) && is_array( $options['steps_single'] ) ) {
				foreach ( $options['steps_single'] as $step ) {
					echo '<div class="process_steps__step">';

					$animation = '';
					if($stepbox_style != 'style2' && $step['stp_single_anim'] != ''){
						$animation = 'data-animation="'.$step['stp_single_anim'].'"';
					}
					$iconColor = (isset($step['stp_icon_color']) && !empty($step['stp_icon_color']) ? 'color: '.$step['stp_icon_color'].';' : '');
						// ICON AND ANIMATION
					$stp_icontype = ( isset($step['stp_icontype']) && !empty($step['stp_icontype']) ) ? $step['stp_icontype'] : 'img' ;

					if ( $stp_icontype == 'img' && ! empty ( $step['stp_single_icon'] ) ) {
						echo '<div class="process_steps__step-icon process_steps__step-typeimg">';
						echo '<img ' . $animation . ' src="' . $step['stp_single_icon'] . '" '.ZngetImageSizesFromUrl($step['stp_single_icon'], true).' alt="'. ZngetImageAltFromUrl( $step['stp_single_icon'] ) .'" title="'.ZngetImageTitleFromUrl( $step['stp_single_icon'] ).'" class="process_steps__step-icon-src">';
						echo '</div>';
					}
					elseif ( $stp_icontype == 'fonticon' && is_array ( $step['stp_single_iconfont'] ) ){
						echo '<div class="process_steps__step-icon">';
						echo '<span ' . $animation . ' class="process_steps__step-icon-src " ' .
							 zn_generate_icon( $step['stp_single_iconfont'] ) . ' style="'.$iconColor.'"></span>';
						echo '</div>';
					}


					// STEP TITLE
					if ( ! empty ( $step['stp_single_title'] ) ) {
						echo '<h3 class="process_steps__step-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $step['stp_single_title'] . '</h3>';
					}

					// STEP CONTENT
					if ( ! empty ( $step['stp_single_desc'] ) ) {
						if ( preg_match( '%(<p[^>]*>.*?</p>)%i', $step['stp_single_desc'], $regs ) ) {
							echo $step['stp_single_desc'];
						}
						else {
							echo '<p class="process_steps__step-desc">' . $step['stp_single_desc'] . '</p>';
						}
					}
					echo '</div>';

				}
			}
			?>
			<?php if($stepbox_style == 'style2'){ ?>
				</div>
			</div><!-- /.steps-container -->
			<div class="clearfix"></div>
			<?php } ?>

		</div>

	<?php
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Steps", 'zn_framework' ),
			"description"    => __( "Here you can create your desired Steps.", 'zn_framework' ),
			"id"             => "steps_single",
			"std"            => "",
			"type"           => "group",
			// "max_items"     => 3,
			"add_text"       => __( "Step", 'zn_framework' ),
			"remove_text"    => __( "Step", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "stp_single_title",
			"subelements"    => array (
				array (
					"name"        => __( "Step Title", 'zn_framework' ),
					"description" => __( "Please enter a title for this step.", 'zn_framework' ),
					"id"          => "stp_single_title",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Box color", 'zn_framework' ),
					"description" => __( "Using this option you can define your own color for this step box. If left empty, the default colors will be used. Please note that this option only works in style 1.", 'zn_framework' ),
					"id"          => "stp_box_color",
					"std"         => "",
					"type"        => "colorpicker",
				),
				array (
					"name"        => __( "Step content", 'zn_framework' ),
					"description" => __( "Please enter a content for this step.", 'zn_framework' ),
					"id"          => "stp_single_desc",
					"std"         => "",
					"type"        => "textarea"
				),

				array (
					"name"        => __( "Icon type", 'zn_framework' ),
					"description" => __( "Select the icon type", 'zn_framework' ),
					"id"          => "stp_icontype",
					"type"        => "select",
					"std"         => "img",
					"options"     => array (
						'fonticon'   => __( 'Font Icon', 'zn_framework' ),
						'img'        => __( 'Image (Png, SVG etc.)', 'zn_framework' ),
					),
				),

				array (
					"name"        => __( "Icon color", 'zn_framework' ),
					"description" => __( "Please select the color for this icon.", 'zn_framework' ),
					"id"          => "stp_icon_color",
					"std"         => "",
					"type"        => "colorpicker",
					"dependency"  => array( 'element' => 'stp_icontype' , 'value'=> array('fonticon') )
				),

				array (
					"name"        => __( "Step icon", 'zn_framework' ),
					"description" => __( "Please enter an icon for this step.", 'zn_framework' ),
					"id"          => "stp_single_icon",
					"std"         => "",
					"type"        => "media",
					"dependency"  => array( 'element' => 'stp_icontype' , 'value'=> array('img') )
				),

				array (
					"name"        => __( "Social icon", 'zn_framework' ),
					"description" => __( "Select your desired social icon.", 'zn_framework' ),
					"id"          => "stp_single_iconfont",
					"std"         => "",
					"type"        => "icon_list",
					'class'       => 'zn_full',
					"dependency"  => array( 'element' => 'stp_icontype' , 'value'=> array('fonticon') )
				),

				array (
					"name"        => __( "Step Icon Animation", 'zn_framework' ),
					"description" => __( "Select the desired animation for this step. Disabled in Style 2!!", 'zn_framework' ),
					"id"          => "stp_single_anim",
					"type"        => "select",
					"std"         => "tada",
					"options"     => array (
						''            => __( 'No animation', 'zn_framework' ),
						'tada'            => __( 'Tada', 'zn_framework' ),
						'pulse'           => __( 'Pulse', 'zn_framework' ),
						'fadeOutRightBig' => __( 'Fade Out Right Big', 'zn_framework' )
					)
				)
			)
		);

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Please enter a title that will appear on the first box", 'zn_framework' ),
						"id"          => "stp_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Subtitle", 'zn_framework' ),
						"description" => __( "Please enter a subtitle that will appear on the first box", 'zn_framework' ),
						"id"          => "stp_subtitle",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Description", 'zn_framework' ),
						"description" => __( "Please enter a description that will appear on the first box", 'zn_framework' ),
						"id"          => "stp_desc",
						"std"         => "",
						"type"        => "textarea",
					),
					array (
						"name"        => __( "Link Text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear as link in
											the first box under the description.", 'zn_framework' ),
						"id"          => "stp_text_link",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Bottom Link", 'zn_framework' ),
						"description" => __( "Please choose the link you want to use.", 'zn_framework' ),
						"id"          => "stp_link",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),
					$extra_options,
				),
			),

			'styles' => array(
				'title' => 'Style Options',
				'options' => array(

					array (
						"name"        => __( "Select style", 'zn_framework' ),
						"description" => __( "Please choose a style you want to use.", 'zn_framework' ),
						"id"          => "stepsbox_style",
						"std"         => "style1",
						"type"        => "select",
						"options"     => array (
							'style1' => __( "Style 1", 'zn_framework' ),
							'style2'  => __( "Style 2 (since v4.0)", 'zn_framework' )
						)
					),

					array (
						"name"        => __( "Element Height", 'zn_framework' ),
						"description" => __( "Select the minimum height of the element.", 'zn_framework' ),
						"id"          => "stp_height",
						"std"         => "235",
						'type'        => 'slider',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '50',
							'max' => '800',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$this->data['uid'] .' .process_steps__height',
							'css_rule'  => 'min-height',
							'unit'      => 'px'
						),
						"dependency"  => array( 'element' => 'stepsbox_style' , 'value'=> array('style2') )
					),

					array (
						"name"        => __( "Right side background color", 'zn_framework' ),
						"description" => __( "Please select the right side background color.", 'zn_framework' ),
						"id"          => "stp_bgcolor",
						"std"         => "light",
						"type"        => "select",
						"options"     => array (
							'light' => __( "Light", 'zn_framework' ),
							'gray'  => __( "Gray", 'zn_framework' ),
							'dark'  => __( "Dark", 'zn_framework' )
						),
						"dependency"  => array( 'element' => 'stepsbox_style' , 'value'=> array('style2') )
					),

					array (
						"name"        => __( "Icons Size", 'zn_framework' ),
						"description" => __( "Select the size of the icon.", 'zn_framework' ),
						"id"          => "stp_size",
						"std"         => "56",
						'type'        => 'slider',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '10',
							'max' => '200',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$this->data['uid'] .' .process_steps__step-icon',
							'css_rule'  => 'font-size',
							'unit'      => 'px'
						),
					),

					array(
						'id'          => 'intro_bg_color',
						'name'        => 'Intro Column Background color',
						'description' => 'Here you can override the background color for the intro column.',
						'type'        => 'colorpicker',
						'std'         => '',
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .process_steps__intro',
									'css_rule'  => 'background-color',
									'unit'      => ''
								),
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .process_steps__intro:after',
									'css_rule'  => 'border-left-color',
									'unit'      => ''
								),
							),
						),
					),

					array(
						'id'          => 'intro_text_color',
						'name'        => 'Intro Column Text color',
						'description' => 'Here you can override the text color for the intro column.',
						'type'        => 'colorpicker',
						'std'         => '',
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .process_steps__intro',
									'css_rule'  => 'color',
									'unit'      => ''
								),
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .process_steps__intro-link',
									'css_rule'  => 'color',
									'unit'      => ''
								),
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .process_steps__intro-title::before',
									'css_rule'  => 'background-color',
									'unit'      => ''
								),
							),
						),
					),

				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#f4nKO-461X0',
				'docs'    => 'http://support.hogash.com/documentation/steps-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
