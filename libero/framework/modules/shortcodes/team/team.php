<?php
namespace Libero\Modules\Team;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Team
 */
class Team implements ShortcodeInterface
{
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkd_team';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see mkd_core_get_carousel_slider_array_vc()
	 */
	public function vcMap()	{

		$team_social_icons_array = array();
		for ($x = 1; $x<6; $x++) {
			$teamIconCollection = libero_mikado_icon_collections()->getIconCollection('font_elegant');

			$team_social_icons_array[] = array(
				'type' => 'dropdown',
				'heading' => 'Social Icon '.$x,
				'param_name' => 'team_social_'.$teamIconCollection->param.'_'.$x,
				'value' => $teamIconCollection->getSocialIconsArrayVC(),
				'dependency' => array('element' => 'more_info', 'value' => 'yes')
			);

			$team_social_icons_array[] = array(
				'type' => 'textfield',
				'heading' => 'Social Icon '.$x.' Link',
				'param_name' => 'team_social_icon_'.$x.'_link',
				'dependency' => array('element' => 'more_info', 'value' => 'yes')
			);

			$team_social_icons_array[] = array(
				'type' => 'dropdown',
				'heading' => 'Social Icon '.$x.' Target',
				'param_name' => 'team_social_icon_'.$x.'_target',
				'value' => array(
					'' => '',
					'Self' => '_self',
					'Blank' => '_blank'
				),
				'dependency' => Array('element' => 'team_social_icon_'.$x.'_link', 'not_empty' => true)
			);

		}

		vc_map( array(
			'name' => 'Mikado Team',
			'base' => $this->base,
			'category' => 'by MIKADO',
			'icon' => 'icon-wpb-team extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array_merge(
				array(
					array(
						'type' => 'attach_image',
						'heading' => 'Image',
						'param_name' => 'team_image'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Name',
						'admin_label' => true,
						'param_name' => 'team_name'
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Name Tag',
						'param_name' => 'team_name_tag',
						'value' => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'dependency' => array('element' => 'team_name', 'not_empty' => true)
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Name Color',
						'param_name' => 'team_name_color',
						'dependency' => array('element' => 'team_name', 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Position',
						'admin_label' => true,
						'param_name' => 'team_position'
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Position Color',
						'param_name' => 'team_position_color',
						'dependency' => array('element' => 'team_position', 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Link',
						'param_name' => 'link',
						'description' => 'Enter a URL to link to.'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Link text',
						'param_name' => 'link_text',
						'value' => 'See Success Rates',
						'dependency' => array('element' => 'link', 'not_empty' => true)
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Show More Info',
						'param_name' => 'more_info',
						'value' => array(
							'No'   => 'no',
							'Yes'	=> 'yes'
						),
						'save_always' => 'true'
					),
					array(
						'type' => 'textarea',
						'heading' => 'Description Title',
						'admin_label' => true,
						'save_always' => true,
						'value' => 'Biography',
						'param_name' => 'team_description_title',
						'dependency' => array('element' => 'more_info', 'value' => 'yes')
					),
					array(
						'type' => 'textarea',
						'heading' => 'Description',
						'admin_label' => true,
						'param_name' => 'team_description',
						'dependency' => array('element' => 'more_info', 'value' => 'yes')
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Description Color',
						'param_name' => 'team_description_color',
						'dependency' => array('element' => 'team_description', 'not_empty' => true)
					),
				),
				$team_social_icons_array
			)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null)
	{

		$args = array(
			'team_image' => '',
			'team_name' => '',
			'team_name_tag' => 'h3',
			'team_name_color' => '',
			'team_position' => '',
			'team_position_color' => '',
			'more_info' => 'no',
			'link' => '',
			'link_text' => 'See Success Rates',
			'team_description_title' => 'Biography',
			'team_description' => '',
			'team_description_color' => ''
		);

		$team_social_icons_form_fields = array();
		$number_of_social_icons = 5;

		for ($x = 1; $x <= $number_of_social_icons; $x++) {

			foreach (libero_mikado_icon_collections()->iconCollections as $collection_key => $collection) {
				$team_social_icons_form_fields['team_social_' . $collection->param . '_' . $x] = '';
			}

			$team_social_icons_form_fields['team_social_icon_'.$x.'_link'] = '';
			$team_social_icons_form_fields['team_social_icon_'.$x.'_target'] = '_blank';

		}

		$args = array_merge($args, $team_social_icons_form_fields);

		$params = shortcode_atts($args, $atts);

		$params['number_of_social_icons'] = 5;
		$params['team_name_tag'] = $this->getTeamNameTag($params, $args);
		$params['team_name_style'] = $this->getTeamNameStyle($params);
		$params['team_pos_style'] = $this->getTeamPositionStyle($params);
		$params['team_social_icons'] = $this->getTeamSocialIcons($params);
		$params['team_desc_style'] = $this->getTeamDescStyle($params);
		$params['team_classes'] = $this->getTeamClasses($params);

		//Get HTML from template based on type of team
		$html = libero_mikado_get_shortcode_module_template_part('templates/team-template', 'team', '', $params);

		return $html;

	}

	/**
	 * Return correct heading value. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 * @return mixed
	 */
	private function getTeamNameTag($params, $args) {

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
		return (in_array($params['team_name_tag'], $headings_array)) ? $params['team_name_tag'] : $args['team_name_tag'];

	}

	private function getTeamSocialIcons($params) {

		extract($params);
		$social_icons = array();


		$icon_pack = libero_mikado_icon_collections()->getIconCollection('font_elegant');
		$team_social_icon_type_label = 'team_social_' . $icon_pack->param;
		$team_social_icon_param_label = $icon_pack->param;

		for ( $i = 1; $i <= $number_of_social_icons; $i++ ) {

			$team_social_icon = ${$team_social_icon_type_label . '_' . $i};
			$team_social_link = ${'team_social_icon_' . $i . '_link'};
			$team_social_target = ${'team_social_icon_' . $i . '_target'};

			if ($team_social_icon !== '') {

				$team_icon_params = array();
				$team_icon_params['icon_pack'] = 'font_elegant';
				$team_icon_params[$team_social_icon_param_label] =   $team_social_icon;
				$team_icon_params['link'] = ($team_social_link !== '') ? $team_social_link : '';
				$team_icon_params['target'] = ($team_social_target !== '') ? $team_social_target : '';
				$team_icon_params['type'] = 'square';
				$team_icon_params['size'] = 'mkd-icon-small';

				$social_icons[] = libero_mikado_execute_shortcode('mkd_icon', $team_icon_params);
			}

		}

		return $social_icons;

	}

	/**
	 * Return Team Name style
	 *
	 * @param $params
	 * @return string
	 */
	private function getTeamNameStyle($params){
		$name_style = array();

		if($params['team_name_color'] !== ''){
			$name_style[] = 'color: '.$params['team_name_color'];
		}

		return implode('; ', $name_style);
	}


	/**
	 * Return Team Position style
	 *
	 * @param $params
	 * @return string
	 */
	private function getTeamPositionStyle($params){
		$position_style = array();

		if($params['team_position_color'] !== ''){
			$position_style[] = 'color: '.$params['team_position_color'];
		}

		return implode('; ', $position_style);
	}


	/**
	 * Return Team Description style
	 *
	 * @param $params
	 * @return string
	 */
	private function getTeamDescStyle($params){
		$desc_style = array();

		if($params['team_description_color'] !== ''){
			$desc_style[] = 'color: '.$params['team_description_color'];
		}

		return implode('; ', $desc_style);
	}

	/**
	 * Return Team classes
	 *
	 * @param $params
	 * @return array
	 */
	private function getTeamClasses($params) {

		$team_classes = array();

		if ($params['link'] !== '') {
			$team_classes[] = 'linked';
		}

		if ($params['more_info'] != ''){
			$team_classes[] = 'more-info-shown';
		}

		return implode(' ', $team_classes);

	}

}