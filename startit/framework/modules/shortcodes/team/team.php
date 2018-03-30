<?php
namespace QodeStartit\Modules\Team;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;
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
		$this->base = 'qodef_team';

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
	 * @see qode_core_get_carousel_slider_array_vc()
	 */
	public function vcMap()	{
		vc_map( array(
			'name' => 'Select Team',
			'base' => $this->base,
			'category' => 'by SELECT',
			'icon' => 'icon-wpb-team extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array_merge(
				array(
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Type',
						'param_name' => 'team_type',
						'value' => array(
							'Main Info on Hover'     => 'main-info-on-hover',
							'Main Info Below Image'  => 'main-info-below-image'
						),
						'save_always' => true
					),
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
						'type' => 'textfield',
						'heading' => 'Position',
						'admin_label' => true,
						'param_name' => 'team_position'
					),
					array(
						'type' => 'textarea',
						'heading' => 'Description',
						'admin_label' => true,
						'param_name' => 'team_description'
					),
				),
				qode_startit_icon_collections()->getVCParamsArray()
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
	public function render($atts, $content = null){

		$args = array(
			'team_image' => '',
			'team_type' => 'main-info-on-hover',
			'team_name' => '',
			'team_name_tag' => 'h5',
			'team_position' => '',
			'team_description' => ''
		);


		$args = array_merge($args, qode_startit_icon_collections()->getShortcodeParams());

		$params = shortcode_atts($args, $atts);
		
		$params['icon_parameters'] = $this->getIconParameters($params);
		$params['team_name_tag'] = $this->getTeamNameTag($params, $args);
		$params['team_image_src'] = $this->getTeamImage($params);

		//Get HTML from template based on type of team
		$html = qode_startit_get_shortcode_module_template_part('templates/' . $params['team_type'], 'team', '', $params);

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
	
	private function getIconParameters($params) {
        $iconPackName = qode_startit_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        $params_array['icon_pack']   = $params['icon_pack'];
        $params_array['type']   = 'circle';
        $params_array[$iconPackName] = $params[$iconPackName];

        return $params_array;
    }

	/**
	 * Return Team image
	 *
	 * @param $params
	 * @return false|string
	 */
	private function getTeamImage($params) {

		if (is_numeric($params['team_image'])) {
			$team_image_src = wp_get_attachment_url($params['team_image']);
		} else {
			$team_image_src = $params['team_image'];
		}

		return $team_image_src;

	}


}