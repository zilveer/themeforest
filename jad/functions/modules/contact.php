<?php

class SG_Contact_Module extends SG_Module {

	const moduleName = 'Contact';

	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'show_map' => array(
				'name' => __('Show Map', SG_TDN),
				'type' => 'select',
				'options' => array(
					'top' => __('Show at Top', SG_TDN),
					'bottom' => __('Show at Bottom', SG_TDN),
					'no' => __('Hide', SG_TDN),
				),
				'default' => 'no',
				'change' => array(
					'map' => '["top", "bottom"]',
				),
				'help' => __('Hide or show map', SG_TDN),
			),
			'map_title' => array(
				'name' => __('Map Title', SG_TDN),
				'type' => 'input',
				'default' => 'See Our Location On The Map',
				'group' => 'map',
				'help' => __('Enter your map title', SG_TDN),
			),
			'map' => array(
				'name' => __('Map', SG_TDN),
				'type' => 'map',
				'class' => 'sg-metabox-field sg-metabox-map',
				'default' => array(
					'locations' => array(),
					'value' => 0,
				),
				'group' => 'map',
				'help' => __('You can set multiple places on the map. The ability to find Longitude and Latitude of your place is <a target="_blank" href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm">here</a>', SG_TDN),
			),
			'map_zoom' => array(
				'name' => __('Map Zoom', SG_TDN),
				'type' => 'select',
				'options' => array(
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12',
					'13' => '13',
					'14' => '14',
					'15' => '15',
					'16' => '16',
					'17' => '17',
					'18' => '18',
				),
				'default' => '3',
				'group' => 'map',
				'help' => __('Select Zoom level for the map', SG_TDN),
			),
			'show_form' => array(
				'name' => __('Show Contact Form', SG_TDN),
				'type' => 'select',
				'options' => array(
					'left' => __('Show at Left', SG_TDN),
					'right' => __('Show at Right', SG_TDN),
					'no' => __('Hide', SG_TDN),
				),
				'default' => 'left',
				'change' => array(
					'form' => '["left", "right"]',
				),
				'help' => __('Hide or show the feedback form', SG_TDN),
			),
			'form_title' => array(
				'name' => __('Contact Form Title', SG_TDN),
				'type' => 'input',
				'default' => 'Feel free to contact Us',
				'group' => 'form',
				'help' => __('Enter your feedback form title', SG_TDN),
			),
			'email' => array(
				'name' => __('Your Email', SG_TDN),
				'type' => 'input',
				'default' => '',
				'group' => 'form',
				'help' => __('Enter your email address to receive messages from the feedback form. If it is empty then messages will be sent to the default address which was set in the main WordPress options', SG_TDN),
			),
		);

		self::$_description = __('Enter your contact information below to set up thecontact page. If left blank information will not be displayed', SG_TDN);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SG_Contact_Module;
		}
		return self::$instance;
	}

	public function inited()
	{
		return !is_null(self::$_vars);
	}

	public function initVars($uniq, $params, $defaults, $global, $post_id)
	{
		self::$_vars = self::_initVars(self::moduleName, $uniq, self::$_params, self::$_fields, $params, $defaults, $global, $post_id);
		return TRUE;
	}

	public function setVars($uniq, $post_data, $post_id = NULL)
	{
		$px = self::_getPx($uniq, self::moduleName);

		if (isset($post_data[$px . '_map']['locations'])) {
			$locations = $post_data[$px . '_map']['locations'];
			foreach ($locations as $id => $location) {
				if (!isset($location['lng']) OR empty($location['lng']) OR !isset($location['lat']) OR empty($location['lat'])) {
					unset($post_data[$px . '_map']['locations'][$id]);
				}
			}
			if (empty($post_data[$px . '_map']['locations'])) {
				$post_data[$px . '_map']['value'] = 0;
			}
		}

		return self::_setVars(self::moduleName, $uniq, self::$_fields, $post_data, $post_id);
	}

	public function resetVars($uniq, $post_id = NULL)
	{
		return self::_resetVars(self::moduleName, $uniq, $post_id);
	}

	public function getMenuItem()
	{
		return __('Content', SG_TDN);
	}

	protected function _getMapField($uid, $params, $value, $default, $ug)
	{
		$locations = (isset($value['locations'])) ? $value['locations'] : array();
		$last = (isset($value['value'])) ? $value['value'] : 0;

		$c = '';

		foreach ($locations as $id => $location) {
			$c .= '<div class="sg-location">';
				$c .= '<div class="sg-location-in" id="' . $uid . '-' . $id . '" rel="' . $uid . '[locations][' . $id . ']">';
					$c .= '<a class="button sg-location-rm" href="#">-</a>';
					$c .= '<div class="sg-location-info">';
						$c .= '<table>';
							$c .= '<tr>';
								$c .= '<td>' . SG_Form::label($uid . '[locations][' . $id . '][lat]', __('Latitude:', SG_TDN)) . '</td>';
								$c .= '<td>' . SG_Form::input($uid . '[locations][' . $id . '][lat]', $location['lat']) . '</td>';
							$c .= '</tr>';
							$c .= '<tr>';
								$c .= '<td class="sg-location-lable">' . SG_Form::label($uid . '[locations][' . $id . '][lng]', __('Longitude:', SG_TDN)) . '</td>';
								$c .= '<td>' . SG_Form::input($uid . '[locations][' . $id . '][lng]', $location['lng']) . '</td>';
							$c .= '</tr>';
							$c .= '<tr>';
								$c .= '<td>' . SG_Form::label($uid . '[locations][' . $id . '][title]', __('Title:', SG_TDN)) . '</td>';
								$c .= '<td>' . SG_Form::input($uid . '[locations][' . $id . '][title]', $location['title']) . '</td>';
							$c .= '</tr>';
							$c .= '<tr>';
								$c .= '<td>' . SG_Form::label($uid . '[locations][' . $id . '][txt]', __('Bubble Text:', SG_TDN)) . '</td>';
								$c .= '<td>' . SG_Form::textarea($uid . '[locations][' . $id . '][txt]', $location['txt']) . '</td>';
							$c .= '</tr>';
						$c .= '</table>';
					$c .= '</div>';
				$c .= '</div>';
			$c .= '</div>';
		}

		$c .= '<div class="sg-location">';
			$c .= '<div class="sg-location-in-add">';
				$c .= '<a id="' . $uid . '-add" class="button sg-location-add" href="#">+</a>';
				$c .= SG_Form::hidden($uid . '[value]', $last, array('id' => $uid . '-last'));
			$c .= '</div>';
		$c .= '</div>';

		$c .= '<script type="text/javascript">';
		$c .= '
//<![CDATA[
jQuery(document).ready(function($){
	$("#' . $uid . '-add").click(function(e){
		var i = $("#' . $uid . '-last").val();
		$("<div class=\"sg-location\"><div rel=\"' . $uid . '[locations][" + i + "]\" id=\"' . $uid . '-" + i + "\" class=\"sg-location-in\"><a href=\"#\" class=\"button sg-location-rm\">-</a><div class=\"sg-location-info\"><table><tbody><tr><td><label for=\"' . $uid . '[locations][" + i + "][lat]\">' . __('Latitude:', SG_TDN) . '</label></td><td><input type=\"text\" name=\"' . $uid . '[locations][" + i + "][lat]\"></td></tr><tr><td class=\"sg-location-lable\"><label for=\"' . $uid . '[locations][" + i + "][lng]\">' . __('Longitude:', SG_TDN) . '</label></td><td><input type=\"text\" name=\"' . $uid . '[locations][" + i + "][lng]\"></td></tr><tr><td><label for=\"' . $uid . '[locations][" + i + "][title]\">' . __('Title:', SG_TDN) . '</label></td><td><input type=\"text\" value=\"\" name=\"' . $uid . '[locations][" + i + "][title]\"></td></tr><tr><td><label for=\"' . $uid . '[locations][" + i + "][txt]\">' . __('Bubble Text:', SG_TDN) . '</label></td><td><textarea rows=\"" + i + "0\" cols=\"50\" name=\"' . $uid . '[locations][" + i + "][txt]\"></textarea></td></tr></tbody></table></div></div></div>").insertBefore($("#' . $uid . '-add").parent().parent());
		$("#' . $uid . '-last").val(++i);
		$(".sg-location-rm").click(function(e){$(this).parent().parent().remove();return false;});
		return false;
	});

	$(".sg-location-rm").click(function(e){
		$(this).parent().parent().remove();
		return false;
	});
});
//]]>
			';
		$c .= '</script>';

		return $c;
	}

	public function getAdminContent($uniq, $params, $defaults, $global = NULL, $post_id = NULL)
	{
		return self::_getAdminContent(self::moduleName, $uniq, self::$_params, self::$_fields, self::$_description, $params, $defaults, $global, $post_id);
	}

	public function showForm()
	{
		return (self::$_vars['show_form'] != 'no');
	}

	public function getFormPosition()
	{
		return self::$_vars['show_form'];
	}

	public function eFormTitle()
	{
		echo __(self::$_vars['form_title']);
	}

	public function getEmail()
	{
		return self::$_vars['email'];
	}

	public function showMap()
	{
		return (isset(self::$_vars['map']['locations']) AND self::$_vars['map']['locations'] != 0) ? self::$_vars['show_map'] : FALSE;
	}

	public function eMap()
	{
		if (isset(self::$_vars['map']['locations']) AND count(self::$_vars['map']['locations']) > 0) {
			if (!empty(self::$_vars['map_title'])) echo '<h4>' . __(self::$_vars['map_title']) . '</h4>';

			echo '<div class="ef-map"></div>';

			$markers = '';
			$latitude = 0;
			$longitude = 0;
			$count = 0;

			foreach (self::$_vars['map']['locations'] as $id => $loc) {
				$count++;
				$latitude += $loc['lat'];
				$longitude += $loc['lng'];
				$c = !empty($loc['title']) ? '<h4>' . $loc['title'] . '</h4>' : '';
				$c .= !empty($loc['txt']) ? '<p style=\"margin:0;\">' . str_replace('"', '\"', str_replace(array("\r\n", "\n"), '', nl2br(strip_tags(__($loc['txt']))))) . '</p>' : '';
				$markers .= ($count > 1) ? ',' : '';
				$markers .= '{latitude: ' . $loc['lat'] . ', longitude: ' . $loc['lng'];
				$markers .= !empty($c) ? ', html: {content: "' . $c . '", popup: false}}' : '}';
			}

			$latitude = $latitude / $count;
			$longitude = $longitude / $count;

			$s = '<script type="text/javascript">';
			$s .= '
//<![CDATA[
jQuery(".ef-map").goMap({
	maptype: "ROADMAP",
	address: "' . $latitude . ', ' . $longitude . '",
	zoom: ' . self::$_vars['map_zoom'] .',
	scaleControl: true,
	navigationControl: true,
	scrollwheel: false,
	mapTypeControl: true,
	mapTypeControlOptions: {
		position: "RIGHT",
		style: "DROPDOWN_MENU"
	},
	markers: [' . $markers . '],
	hideByClick: true,
	icon: sg_template_url + "/images/home.png",
	addMarker: false
});
//]]>
			';
			$s .= '</script>';

			echo $s;
		}
	}

}