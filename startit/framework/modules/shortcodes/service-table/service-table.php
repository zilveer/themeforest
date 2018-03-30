<?php
namespace QodeStartit\Modules\ServiceTable;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

class ServiceTable implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'qodef_service_table';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {

        $service_array = array();

        for ($y = 1; $y <= 8 ; $y++) {
            $service_array[] = array(
                'type' => 'textfield',
                'heading' => 'Feature ' . $y . ' Title',
                'param_name' => 'feature_' . $y . '_title',
                'value' => '',
                'group' => 'Features'
            );
        }


        for ($x = 1; $x <= 3; $x++) {

            $service_array[] = array(
                'type' => 'dropdown',
                'heading' => 'Service '.$x.' Enabled',
                'param_name' => 'service_'.$x.'_enabled',
                'value' => array(
                    '' => '',
                    'No' => 'no',
                    'Yes' => 'yes'
                )
            );

            $service_array[] = array(
                'type' => 'textfield',
                'heading' => 'Service '.$x.' Title',
                'param_name' => 'service_'.$x.'_title',
                'value' => '',
                'dependency' => array('element' => 'service_'.$x.'_enabled', 'value' => 'yes')
            );

            for ($y = 1; $y <= 8; $y++) {


                $service_array[] = array(
                    'type' => 'dropdown',
                    'heading' => 'Feature ' . $y . ' Enabled',
                    'param_name' => 'feature_' . $y . '_' . $x . '_enabled',
                    'value' => array(
                        '' => '',
                        'No' => 'no',
                        'Yes' => 'yes'
                    ),
                    'group' => 'Service ' . $x,
                    'dependency' => array('element' => 'feature_'.$y.'_title', 'not_empty' => true)
                );
            }

        }


		vc_map( array(
			'name' => 'Select Service Table',
			'base' => $this->base,
			'icon' => 'icon-wpb-service-table extended-custom-icon',
			'category' => 'by SELECT',
			'allowed_container_element' => 'vc_row',
			'params' => array_merge(
                array(
                    array(
                        'type' => 'textfield',
                        'heading' => 'Feature Column Title',
                        'param_name' => 'feature_column_title',
                        'admin_label' => true
                    )
                ),
                $service_array
            )
		));
	}

	public function render($atts, $content = null) {
	
		$args = array(
            'feature_column_title'  => ''
		);

        $service_count = 3;
        $features_count = 8;
        $feature_fields = array();
        $service_fields = array();
        $service_feature_fields = array();

        for($y = 1; $y <= $features_count; $y++) {
            $feature_fields['feature_' . $y . '_title'] = '';
        }

        for ($x = 1; $x <= $service_count; $x++) {
            for ($y = 1; $y <= $features_count; $y++) {
                $service_feature_fields['feature_' . $y . '_' . $x . '_enabled'] = '';
            }

            $service_fields['service_'.$x.'_enabled'] = '';
            $service_fields['service_'.$x.'_title'] = '';

        }

        $args = array_merge($args, $service_fields, $feature_fields, $service_feature_fields);
        $params = shortcode_atts($args, $atts);

        extract($params);

        $params['service_count'] = $service_count;
        $params['features_count'] = $features_count;

        $params['table_titles'] = $this->getTableTitles($params);
        $params['table_rows'] = $this->getTableRows($params);
        $cols = $this->getColNumber($params);

		$html = '';

        $html .= '<div class="qodef-service-table qodef-cols-' . $cols . '">';
        $html .= '<div class="qodef-service-table-inner">';
        $html .= '<table class="qodef-service-table-holder">';
		
		$html .= qode_startit_get_shortcode_module_template_part('templates/service-table-template','service-table', '', $params);

        $html .= '</table>';
        $html .= '</div>';
        $html .= '</div>';
		return $html;

	}

    private function getTableTitles($params) {

        extract($params);
        $titles = array();

        $titles[] = $params['feature_column_title'];

        for ( $i = 1; $i <= $service_count; $i++ ) {
            if($params['service_'.$i.'_enabled'] == 'yes') {
                $titles[] = ${'service_' . $i . '_title'};
            }
        }

        return $titles;

    }

    private function getColNumber($params) {

        extract($params);
        $cols = 0;

        for ( $i = 1; $i <= $service_count; $i++ ) {
            if($params['service_'.$i.'_enabled'] == 'yes') {
                $cols++;
            }
        }

        return $cols;

    }

    private function getTableRows($params) {

        extract($params);
        $features = array();

        for ( $i = 1; $i <= $features_count; $i++ ) {
            if($params['feature_' . $i . '_title'] != '') {
                $feature_title = ${'feature_' . $i . '_title'};
                $feature_enabled = array();
                for ( $j = 1; $j <= $service_count; $j++ ) {
                    if($params['service_'.$j.'_enabled'] == 'yes') {
                        $feature_enabled[] = $params['feature_' . $i . '_' . $j . '_enabled'];
                    }
                }

                $feature['title'] = $feature_title;
                $feature['features_enabled'] = $feature_enabled;

                $features[] = $feature;
            }
        }

        return $features;

    }

}
