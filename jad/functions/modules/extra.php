<?php

class SG_Extra_Module extends SG_Module {

	const moduleName = 'Extra';

	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'icon' => array(
				'name' => __('Select Icon', SG_TDN),
				'type' => 'icon',
				'options' => array(
					'custom' => __('Custom', SG_TDN),
					'extras-icn1' => __('Bla Bla Bla', SG_TDN),
					'extras-icn2' => __('Bla Bla Bla', SG_TDN),
					'extras-icn3' => __('Bla Bla Bla', SG_TDN),
					'extras-icn4' => __('Bla Bla Bla', SG_TDN),
					'extras-icn5' => __('Bla Bla Bla', SG_TDN),
					'extras-icn6' => __('Bla Bla Bla', SG_TDN),
					'extras-icn7' => __('Bla Bla Bla', SG_TDN),
					'extras-icn8' => __('Bla Bla Bla', SG_TDN),
					'extras-icn9' => __('Bla Bla Bla', SG_TDN),
					'extras-icn10' => __('Bla Bla Bla', SG_TDN),
					'extras-icn11' => __('Bla Bla Bla', SG_TDN),
					'extras-icn12' => __('Bla Bla Bla', SG_TDN),
					'extras-icn13' => __('Bla Bla Bla', SG_TDN),
					'extras-icn14' => __('Bla Bla Bla', SG_TDN),
					'extras-icn15' => __('Bla Bla Bla', SG_TDN),
				),
				'default' => 'custom',
				'help' => __('Select an icon to be displayed before the page title', SG_TDN),
			),
			'cimg' => array(
				'name' => __('Get Custom Icon', SG_TDN),
				'type' => 'cicon',
				'default' => '',
				'help' => __('Get Custom Icon (36px x 36px is preferable)', SG_TDN),
			),
			'description' => array(
				'name' => __('Description', SG_TDN),
				'type' => 'input',
				'default' => '',
				'help' => __('Enter a little description (max 50)', SG_TDN),
			),
		);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SG_Extra_Module;
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
		return self::_setVars(self::moduleName, $uniq, self::$_fields, $post_data, $post_id);
	}

	public function resetVars($uniq, $post_id = NULL)
	{
		return self::_resetVars(self::moduleName, $uniq, $post_id);
	}

	public function getMenuItem()
	{
		return __('Extra', SG_TDN);
	}

	protected function _getCiconField($uid, $params, $value, $default, $ug)
	{
		global $post_ID;
		$nonce = wp_create_nonce('set_post_thumbnail-' . $post_ID);
		$btn_name = __('Get Icon', SG_TDN);
		$img = wp_get_attachment_image(get_post_meta($post_ID, '_thumbnail_id', true), 'post-thumbnail');
		$clear = empty($img) ? ' style="display: none;"' : '';

		$c = '<span class="sg-upload-btns">';
		$c .= '<input type="submit" value="' . __('Load Icon', SG_TDN) . '" class="button" id="' . $uid . '_load" name="' . $uid . '_load">';
		$c .= '&nbsp;<input type="submit" value="' . __('Clear Icon', SG_TDN) . '" class="button sg-photo-clear" id="' . $uid . '_clear" name="' . $uid . '_clear"' . $clear . '><br /><br />';
		$c .= '</span>';
		$c .= '<span id="' . $uid . '_img">' . $img . '</span>';

		$c .= SG_Form::hidden($uid, $value);

		$c .= '<script type="text/javascript">';
		$c .= '
//<![CDATA[
jQuery(document).ready(function($){
	if ($("input[name=' . $uid . ']").val() != "") {
		$("#' . $uid . '_clear").show();
	}
	$("#' . $uid . '_clear").click(function() {
		window.SGRemoveThumbnail();
		$("#' . $uid . '_clear").hide();
		return false;
	});
	$("#' . $uid . '_load").click(function() {
		sg_post_nonce = "' . $nonce . '";
		sg_current_uid = "' . $uid . '";
		sg_media_upload_btn_name = "' . $btn_name . '";
		var pID = jQuery("#post_ID").val();
		tb_show("Insert", "media-upload.php?post_id=" + pID + "&custom-media-upload=PI&type=image&TB_iframe=true");
		return false;
	});
});
//]]>
			';
		$c .= '</script>';

		return $c;
	}

	protected function _getIconField($uid, $params, $value, $default, $ug)
	{
		$c = '<div class="sg-icon-group" align="center">';
			foreach ($params['options'] as $oval => $oname) {
				$radio = SG_Form::radio($uid, $oval, $oval == $value);
				$img_href = get_template_directory_uri() . '/images/content/services/' . $oval . '.png';
				$img = ($oval == 'custom') ? '' : SG_HTML::image($img_href);
				$item = '<span class="sg-icon-' . $oval . '">' . $img  . '</span>' . $radio;
				$c .= SG_Form::label(NULL, $item, array('class' => 'sg-icon-item', 'title' => $oname));
			}
			$c .= '<div class="clear"></div>';
		$c .= '</div>';

		return $c;
	}

	public function getAdminContent($uniq, $params, $defaults, $global = NULL, $post_id = NULL)
	{
		$c = self::_getAdminContent(self::moduleName, $uniq, self::$_params, self::$_fields, self::$_description, $params, $defaults, $global, $post_id);

		$c .= '<script type="text/javascript">';
		$c .= '
//<![CDATA[
jQuery(document).ready(function($){
	$("#postdivrich").addClass("extra-editorcontainer");

	function ' . $uniq . '_set_icon_type(){
		var cd = $("input[name=' . $uniq . 'Extra_icon]:checked");
		if (cd.val() == "custom") {
			$("input[name=' . $uniq . 'Extra_cimg]").parent().parent().show();
		} else {
			$("input[name=' . $uniq . 'Extra_cimg]").parent().parent().hide();
		}
	}

	' . $uniq . '_set_icon_type();

	$("input[name=' . $uniq . 'Extra_icon]").change(' . $uniq . '_set_icon_type);
});
//]]>
			';
		$c .= '</script>';

		return $c;
	}

	public function eExtraIcon($post_id, $uniq = 'eal') {
		$vars = self::_getVars(self::moduleName, 'sg_' . $uniq, NULL, $post_id);
		$icon = get_the_post_thumbnail($post_id, 'sg_icons');
		if (!empty($vars)) {
			echo ($vars['icon'] == 'custom') ? $icon : SG_HTML::image(get_template_directory_uri() . '/images/content/services/' . $vars['icon'] . '.png', array('class' => 'alignleft'));
		}
	}

	public function eDescription($post_id, $uniq = 'eal') {
		$vars = self::_getVars(self::moduleName, 'sg_' . $uniq, NULL, $post_id);
		if (!empty($vars)) {
			echo sg_text_trim(__($vars['description']), 50);
		}
	}

}