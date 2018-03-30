<?php
/**
 *
 */
class mysiteCharts {
	
	private static $chart_id = 1;

	/**
	 *
	 */
	function _chart_id() {
	    return self::$chart_id++;
	}

	/**
	 *
	 */
	function chart( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Charts', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'chart',
				'options' => array(
					array(
						'name' => __( 'Type', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select which type of chart you would like to use.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'type',
						'options' => array(
							'area' => __('Area', MYSITE_ADMIN_TEXTDOMAIN ),
							'bar' => __('Bar', MYSITE_ADMIN_TEXTDOMAIN ),
							'candlestick' => __('Candlestick', MYSITE_ADMIN_TEXTDOMAIN ),
							'column' => __('Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'combo' => __('Combo', MYSITE_ADMIN_TEXTDOMAIN ),
							'line' => __('Line', MYSITE_ADMIN_TEXTDOMAIN ),
							'pie' => __('Pie', MYSITE_ADMIN_TEXTDOMAIN ),
							'scatter' => __('Scatter', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Title', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title of your chart.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Width', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the width of your chart.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'width',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Height', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the height of your chart.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'height',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Data', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the data of your chart.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Options', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out extra options you wish to use.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'extras',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		global $wp_query, $mysite;
		
		extract(shortcode_atts(array(
			'type'			=> 'pie',
			'title'			=> '',
			'width'			=> '400',
			'height'		=> '300',
			'extras' 		=> '',
		), $atts));
		
		$chart_id = 'chart_id_' . self::_chart_id();
		
		// Load Google core scripts
		$out = '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
		$out .= '<script type="text/javascript">';
		
		// Load Visualization API and whatever chart libraries are needed
		$out .= 'google.load("visualization", "1.0", {"packages":["corechart"]});';
		$out .= 'google.setOnLoadCallback(drawChart);';

		// Create the data table
		$out .= 'function drawChart() {';
		$out .= $content;

		// Set chart options
		if ($extras != '') { $extras = ', '.$extras; }
		$out .= 'var options = { "title" : "'.$title.'", "width" : '.$width.', "height" : '.$height.' '.$extras.' };';

		// Instantiate and draw our chart, passing in some options.
		$type = ucfirst($type);
		$out .= 'var chart = new google.visualization.'.$type.'Chart(document.getElementById("'.$chart_id.'"));';
		$out .= 'chart.draw(data, options);';
		$out .= '}';
		
		$out .= '</script>';
		
		$out .= '<div id="'.$chart_id.'"></div>';
		
		return $out;
	}


	/**
	 *
	 */
	function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			'name' => __( 'Charts', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'chart',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>