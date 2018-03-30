<?php if(! defined('ABSPATH')){ return; }
/*
Name: Skill Bars
Description: This element will generate a skill bars element ?
Class: ZnSkillBars
Category: content
Keywords: progress, skills
Level: 3
Style: true
*/


class ZnSkillBars extends ZnElements {

	public static function getName(){
		return __( "Skills Bars", 'zn_framework' );
	}
	function options() {

		$uid = $this->data['uid'];

		$options = array(
			'css_selector' => '.',
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
						'id'            => 'skill_bars',
						'name'          => 'Skill bars',
						'description'   => 'Here you can add skill bars',
						'type'          => 'group',
						'sortable'      => true,
						'element_title' => 'Skill bar',
						'subelements'   => array(
							array(
								"id"          => "sb_title",
								"name"        => "Title",
								"description" => "Please enter the title that will appear above the skill bar.",
								"std"         => "",
								"type"        => "text"
							),
							array(
								"id"          => "sb_color",
								"name"        => "Override Bar color",
								"description" => "Please choose the bar color.",
								"std"         => "",
								"type"        => "colorpicker",
							),
							array(
								'id'          => 'sb_rounded',
								'name'        => 'Bars corners',
								'description' => 'Set the type of the bar corners. Square or rounded',
								'type'        => 'select',
								'std'         => 'yes',
								'options'     => array(
									'' => 'Square',
									'yes' => 'Rounded',
									'rounded' => 'Round',
								)
							),
							array(
								'id'          => 'sb_percentage',
								'name'        => 'Fill percentage',
								'description' => 'Set the fill percentage.',
								'type'        => 'slider',
								'std'         => '50',
								'class'       => 'zn_full',
								'helpers'     => array(
									'step' => '1',
									'min' => '0',
									'max' => '100',
								)
							),
						),
					),

					array(
						"id"          => "bgBarsColorDef",
						"name"        => "Bars Color",
						"description" => "Please choose the bars default color.",
						"std"         => "#cd2122",
						"alpha"       => "true",
						"type"        => "colorpicker",
					),
					array(
						"id"          => "bgBarsColor",
						"name"        => "Bars background color",
						"description" => "Please choose the bar background color.",
						"std"         => "rgba(0,0,0,0.1)",
						"alpha"       => "true",
						"type"        => "colorpicker",
					),

					array(
						"id"          => "bars_height",
						"name"        => "Bars height",
						"description" => "Please choose the bars height.",
						"std"         => "13",
						"type"        => "slider",
						'helpers'     => array(
							'step' => '1',
							'min' => '1',
							'max' => '50',
						),
						'live' => array(
							'multiple' => array(
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .skill-bar',
									'css_rule'  => 'height',
									'unit'      => 'px'
								),
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .skill-bar-inner',
									'css_rule'  => 'height',
									'unit'      => 'px'
								),
							)
						),
					),

					array (
						"name"        => __( "Titles settings", 'zn_framework' ),
						"description" => __( "Specify the typography properties for the titles.", 'zn_framework' ),
						"id"          => "title_typo",
						"std"         => '',
						'supports'   => array( 'size', 'font', 'style', 'line', 'color', 'weight', 'spacing', 'case', 'shadow' ),
						"type"        => "font",
						'live' => array(
							'type'      => 'font',
							'css_class' => '.'.$uid. ' .skill-title',
						),
					),

					array (
						"name"        => __( "Items Distance (Vertical)", 'zn_framework' ),
						"description" => __( "Select the distance between the bars.", 'zn_framework' ),
						"id"          => "distance_vert",
						"std"         => "7",
						"type"         => "slider",
						'helpers'     => array(
							'min' => '0',
							'max' => '300',
							'step' => '1'
						),
						'live' => array(
							'multiple' => array(
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.'>ul>li',
									'css_rule'  => 'margin-top',
									'unit'      => 'px'
								),
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.'>ul>li',
									'css_rule'  => 'margin-bottom',
									'unit'      => 'px'
								),
							)
						),
					),

				)
			),
			'tooltip' => array(
				'title' => 'Tooltip options',
				'options' => array(

					array(
						"id"          => "tooltip_color_scheme",
						"name"        => "Tooltip color scheme",
						"description" => "Please choose your desired color scheme for the tooltip.",
						"std"         => "",
						"type"        => "select",
						'options'     => array(
							''           => 'Dark',
							'tool_light' => 'Light',
							'tool_tr_light' => 'Transparent Light',
							'tool_tr_dark' => 'Transparent Dark',
						),
						'live'        => array(
							'type'      => 'class',
							'css_class' => '.' . $this->data['uid']
						),
					),

					array(
						"id"          => "tooltip_vis",
						"name"        => "Tooltip visibility",
						"description" => "Please choose the tooltip visibility.",
						"std"         => "hover",
						"type"        => "select",
						'options'     => array(
							'always'           => 'Always be displayed',
							'hover' => 'Display on hover'
						),
						'live'        => array(
							'type'      => 'class',
							'css_class' => '.' . $this->data['uid'],
							'val_prepend' => 'skillbar--'
						),
					),

					array(
						"id"          => "tooltip_symbol",
						"name"        => "Tooltip Numer Symbol",
						"description" => "Please choose what symbol should be displayed in the numbers in tooltips.",
						"std"         => "",
						"type"        => "text",
					),

				),
			),
		);

		return $options;
	}

	function element() {

		$options = $this->data['options'];

		$skilBars    = $this->opt( 'skill_bars' );
		$bgBarsColor =	$this->opt( 'bgBarsColor', 'rgba(0,0,0,0.1)' ) != '' ? 'background-color:'.$this->opt( 'bgBarsColor', 'rgba(0,0,0,0.1)' ).';' : '';
		$bars_height = $this->opt('bars_height', 13) != 13 ? 'height:'.$this->opt('bars_height', 13).'px;':'';

		//Class
		$classes = array();
		$classes[] = $uid = $this->data['uid'];
		$classes[] = $tooltip_color_scheme = $this->opt( 'tooltip_color_scheme', 'tool_dark' );

		$classes[] = zn_get_element_classes($options);
		$attributes = zn_get_element_attributes($options);

		$classes[] = 'skillbar--'.$this->opt('tooltip_vis','hover');

		?>

		<div class="skills_wgt <?php echo implode(' ', $classes); ?> " <?php echo $attributes; ?>>
			<ul>
				<?php
				if(is_array($skilBars) && !empty($skilBars)){
					foreach ( $skilBars as $entry ) {
						$title    = ! empty( $entry['sb_title'] ) ? '<h5 class="skill-title">'.$entry['sb_title'].'</h5>' : '';
						$barColor =	! empty( $entry['sb_color'] ) ? 'background-color:'.$entry['sb_color'].';' : '';
						$rounded  = 'stg-corners--'.( isset( $entry['sb_rounded'] ) ? $entry['sb_rounded'] : '' );
						$percentage = ( isset( $entry['sb_percentage'] ) && ! empty( $entry['sb_percentage'] ) ? $entry['sb_percentage'] : '' );

						?>
						<li class="<?php echo $rounded; ?>" >
							<?php echo $title; ?>
							<span class="skill-bar <?php echo $rounded; ?>" data-loaded="<?php echo $percentage; ?>" style="<?php echo $bgBarsColor; ?> <?php echo $bars_height; ?>">
								  <span class="skill-bar-inner kl-main-bgcolor zn-transition-down-before zn-transition-down-after" data-percentage="<?php echo $percentage; ?><?php echo $this->opt('tooltip_symbol',''); ?>" style="<?php echo $barColor; ?> <?php echo $bars_height; ?>"></span>
							  </span>
						</li>
					<?php
					} // end foreach
				}
				?>
			</ul>
			<div class="clearfix"></div>
		</div>
	<?php
	}

	function css(){

		$uid = $this->data['uid'];
		$css = '';

		$bgBarsColorDef = $this->opt('bgBarsColorDef', '#cd2122');
		if($bgBarsColorDef != '#cd2122'){
			$css = '.'.$uid.' .skill-bar-inner {background-color:'.$bgBarsColorDef.'}';
		}

		// Title Styles
		if( $this->opt('title_typo', '' ) ){
			$css .= zn_typography_css(array(
					'selector' => '.'.$uid.' .skill-title',
					'lg' =>  $this->opt('title_typo', '' ),
				)
			);
		}

		// Vertical distance
		$distance_vert = $this->opt('distance_vert', '7');
		if( $distance_vert != '7'){
			$css .= '.'.$uid.'>ul>li{margin-top: '.$distance_vert.'px;margin-bottom:'.$distance_vert.'px}';
		}

		return $css;


	}

	function js() {
	}

}
