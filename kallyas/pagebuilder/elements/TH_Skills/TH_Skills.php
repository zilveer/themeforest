<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Skills
 Description: Create and display a Skills element
 Class: TH_Skills
 Category: content
 Level: 3
 Keywords: diagram
*/
/**
 * @since    4.0.0
 */
class TH_Skills extends ZnElements
{
	public static function getName(){
		return __( "Skills", 'zn_framework' );
	}

   /**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'raphael', '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js', array ( 'jquery' ), ZN_FW_VERSION, true );
		wp_enqueue_script( 'raphael_diagram', THEME_BASE_URI . '/pagebuilder/elements/TH_Skills/diagram_el.js', array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	function css(){
		$css = '';
		$uid = $this->data['uid'];

		$sizetype = $this->opt('sk_sizetype','fixed');

		if($sizetype == 'fixed') {
			$width = (int)$this->opt('sk_width',600);

			if($width != '600'){
				$scale = $width * 0.07;
				$css .= '.'.$uid.'.diagram-size--fixed {width:'.($width + $scale).'px;}';
			}
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

		$classes=array();
		$classes[] = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);
		$classes[] = 'diagram-size--'.$this->opt('sk_sizetype','fixed');

		$attributes = zn_get_element_attributes($options);

		?>

		<div id="skills_diagram_el" class="kl-skills-diagram <?php echo implode(' ', $classes); ?>" <?php echo $attributes; ?>>

			<div class="kl-skills-legend <?php echo $this->opt('sk_enablelegend',1) != 1 ? 'hidden':'' ?> legend-<?php echo $this->opt('sk_legend_align', 'topright') ?>">

				<?php if($legend_text = $this->opt('sk_legend_text')): ?>
					<h4 class="kl-skills-title" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>><?php echo $legend_text; ?></h4>
				<?php endif; ?>

				<?php
					$skills = $this->opt('skills_single');
					if( is_array($skills) && !empty($skills) ){

					echo '<ul class="kl-skills-list">';

						foreach ($skills as $skill) {
							$percentage = !empty( $skill['skill_level'] ) ? $skill['skill_level'] : 95;
							$main_color = !empty( $skill['skill_color'] ) ? $skill['skill_color'] : '#97BE0D';
							echo '<li class="kl-skills-item" data-percent="' . $percentage . '" style="background-color:' . $main_color . ';">'.$skill['skill_text'].'</li>';
						}

					echo '</ul>';
					}
				?>

			</div>

			<div class="skills-responsive-diagram">
				<div id="thediagram_el" class="kl-diagram" data-width="<?php echo (int)$this->opt('sk_width',600) ?>" data-maincolor="<?php echo $this->opt('sk_maincolor','#193340') ?>" data-maintext="<?php echo $this->opt('sk_main_text','skills') ?>" data-fontsize="<?php echo (int)$this->opt('sk_fontsize','20') ?>px Open Sans" data-textcolor="<?php echo $this->opt('sk_maintextcolor','#ffffff') ?>" data-distance="<?php echo $this->opt('sk_distance','5') ?>"></div>
			</div>
		</div><!-- end skills diagram -->


		<?php

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Skill", 'zn_framework' ),
			"description"    => __( "Here you can add skills.", 'zn_framework' ),
			"id"             => "skills_single",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Skill", 'zn_framework' ),
			"remove_text"    => __( "Skill", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "skill_text",
			"subelements"    => array (
				array (
					"name"        => __( "Skill Text", 'zn_framework' ),
					"description" => __( "Please enter the skill text.", 'zn_framework' ),
					"id"          => "skill_text",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Skill Color", 'zn_framework' ),
					"description" => __( "Please enter the skill color.", 'zn_framework' ),
					"id"          => "skill_color",
					"std"         => "#97BE0D",
					"type"        => "colorpicker"
				),
				array (
					"name"        => __( "Skill Level", 'zn_framework' ),
					"description" => __( "Please select the skill level.", 'zn_framework' ),
					"id"          => "skill_level",
					"std"         => "95",
					"type"        => "slider",
					'class'       => 'zn_full',
					'helpers'     => array(
						'min' => '0',
						'max' => '100',
						'step' => '1'
					),
				),
			)
		);

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Main center text", 'zn_framework' ),
						"description" => __( "Add a text that's going to be placed inside the center", 'zn_framework' ),
						"id"          => "sk_main_text",
						"std"         => "skills",
						"type"        => "text",
					),

					array (
						"name"        => __( "Diagram Size", 'zn_framework' ),
						"description" => __( "Select the size type you'd want the diagram to show itself", 'zn_framework' ),
						"id"          => "sk_sizetype",
						"std"         => "fixed",
						"type"        => "zn_radio",
						'options'     => array(
							'fixed' => 'Fixed',
							'resp' => 'Responsive',
						),
					),

					array (
						"name"        => __( "Diagram Width & Height", 'zn_framework' ),
						"description" => __( "Select the diagram width and height", 'zn_framework' ),
						"id"          => "sk_width",
						"std"         => "600",
						"type"        => "text",
					),

					array (
						"name"        => __( "Diagram font-size", 'zn_framework' ),
						"description" => __( "Select the diagram text font-size", 'zn_framework' ),
						"id"          => "sk_fontsize",
						"std"         => "20",
						"type"        => "text",
					),

					array (
						"name"        => __( "Center main color", 'zn_framework' ),
						"description" => __( "Select the center color of the diagram", 'zn_framework' ),
						"id"          => "sk_maincolor",
						"std"         => "#193340",
						"type"        => "colorpicker",
					),

					array (
						"name"        => __( "Center text color", 'zn_framework' ),
						"description" => __( "Select the center text color of the diagram.", 'zn_framework' ),
						"id"          => "sk_maintextcolor",
						"std"         => "#ffffff",
						"type"        => "colorpicker",
					),

					array (
						"name"        => __( "Distance between circles", 'zn_framework' ),
						"description" => __( "Select the distance between circles.", 'zn_framework' ),
						"id"          => "sk_distance",
						"std"         => "5",
						"type"        => "slider",
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '0',
							'max' => '50',
							'step' => '1'
						),
					),

					array (
						"name"        => __( "Enable Legend", 'zn_framework' ),
						"description" => __( "Enable legend?", 'zn_framework' ),
						"id"          => "sk_enablelegend",
						"std"         => "1",
						"value"       => "1",
						"type"        => "toggle2",
					),

					array (
						"name"        => __( "Legend title", 'zn_framework' ),
						"description" => __( "Add a text that's going to be placed into the legend box", 'zn_framework' ),
						"id"          => "sk_legend_text",
						"std"         => "LEGEND",
						"type"        => "text",
						"dependency"  => array( 'element' => 'sk_enablelegend' , 'value'=> array('1') )
					),

					array (
						"name"        => __( "Legend Alignment", 'zn_framework' ),
						"description" => __( "Select the alignment of the legend", 'zn_framework' ),
						"id"          => "sk_legend_align",
						"std"         => "topright",
						"type"        => "select",
						"options"     => array(
							"topright" => "Top-Right",
							"topleft" => "Top-Left",
							"bottomright" => "Bottom-Right",
							"bottomleft" => "Bottom-Left"
						),
						"dependency"  => array( 'element' => 'sk_enablelegend' , 'value'=> array('1') )
					),

					$extra_options,
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#Nxh__JmEPX8',
				'docs'    => 'http://support.hogash.com/documentation/skills/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
