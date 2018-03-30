<?php

class SG_OurTeam_Module extends SG_Module {

	const moduleName = 'OurTeam';

	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'type' => array(
				'name' => __('Type', SG_TDN),
				'type' => 'select',
				'options' => array(
					'profile' => __('Profile', SG_TDN),
					'information' => __('Information', SG_TDN),
				),
				'default' => 'profile',
				'change' => array(
					'team' => '["profile"]',
				),
				'help' => __('Choose the type of a post', SG_TDN),
			),
			'gender' => array(
				'name' => __('Gender', SG_TDN),
				'type' => 'select',
				'options' => array(
					'male' => __('Male', SG_TDN),
					'female' => __('Female', SG_TDN),
				),
				'default' => 'male',
				'group' => 'team',
				'help' => __('Choose the gender of a team member', SG_TDN),
			),
			'position' => array(
				'name' => __('Position', SG_TDN),
				'type' => 'input',
				'default' => '',
				'group' => 'team',
				'help' => __('Choose the position of a team member or leave this field blank', SG_TDN),
			),
			'photo' => array(
				'name' => __('Photo', SG_TDN),
				'type' => 'ot',
				'default' => '',
				'group' => 'team',
				'help' => __('Upload a photo of a team member', SG_TDN),
			),
			'soc_skype' => array(
				'name' => __('Social - Skype', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'group' => 'team',
				'help' => __('Enter the link to your Skype account (use skype:username?call) or leave this field blank', SG_TDN),
			),
			'soc_dribbble' => array(
				'name' => __('Social - Dribbble', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'group' => 'team',
				'help' => __('Enter the link to your Dribbble account or leave this field blank', SG_TDN),
			),
			'soc_twitter' => array(
				'name' => __('Social - Twiter', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'group' => 'team',
				'help' => __('Enter the link to your Twitter account or leave this field blank', SG_TDN),
			),
			'soc_facebook' => array(
				'name' => __('Social - Facebook', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'group' => 'team',
				'help' => __('Enter the link to your Facebook account or leave this field blank', SG_TDN),
			),
			'soc_flickr' => array(
				'name' => __('Social - Flickr', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'group' => 'team',
				'help' => __('Enter the link to your Flickr account or leave this field blank', SG_TDN),
			),
			'soc_linkedin' => array(
				'name' => __('Social - LinkedIn', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'group' => 'team',
				'help' => __('Enter the link to your LinkedIn or leave this field blank', SG_TDN),
			),
			'soc_deviantart' => array(
				'name' => __('Social - DeviantArt', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'group' => 'team',
				'help' => __('Enter the link to your DeviantArt or leave this field blank', SG_TDN),
			),
			'soc_pinterest' => array(
				'name' => __('Social - Pinterest', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'group' => 'team',
				'help' => __('Enter the link to your Pinterest or leave this field blank', SG_TDN),
			),
			'soc_vimeo' => array(
				'name' => __('Social - Vimeo', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'group' => 'team',
				'help' => __('Enter the link to your Vimeo or leave this field blank', SG_TDN),
			),
			'soc_tumblr' => array(
				'name' => __('Social - Tumblr', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'group' => 'team',
				'help' => __('Enter the link to your Tumblr or leave this field blank', SG_TDN),
			),
		);

		self::$_description = __('Enter the name of a team member in the post title and configure settings below', SG_TDN);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SG_OurTeam_Module;
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
		return __('Our Team', SG_TDN);
	}

	protected function _getOtField($uid, $params, $value, $default, $ug)
	{
		global $post_ID;
		$nonce = wp_create_nonce('set_post_thumbnail-' . $post_ID);
		$btn_name = __('Get Photo', SG_TDN);
		$img = wp_get_attachment_image(get_post_meta($post_ID, '_thumbnail_id', true), 'post-thumbnail');
		$clear = empty($img) ? ' style="display: none;"' : '';

		$c = '<span class="sg-upload-btns">';
		$c .= '<input type="submit" value="' . __('Load Photo', SG_TDN) . '" class="button" id="' . $uid . '_load" name="' . $uid . '_load">';
		$c .= '&nbsp;<input type="submit" value="' . __('Clear Photo', SG_TDN) . '" class="button sg-photo-clear" id="' . $uid . '_clear" name="' . $uid . '_clear"' . $clear . '><br /><br />';
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

	public function getAdminContent($uniq, $params, $defaults, $global = NULL, $post_id = NULL)
	{
		$c = self::_getAdminContent(self::moduleName, $uniq, self::$_params, self::$_fields, self::$_description, $params, $defaults, $global, $post_id);

		$c .= '<script type="text/javascript">';
		$c .= '
//<![CDATA[
jQuery(document).ready(function($){
	$("#postdivrich").addClass("extra-editorcontainer");
});
//]]>
			';
		$c .= '</script>';

		return $c;
	}

	public function getPerson($post_id, $uniq = 'otl') {
		$titles = array(
			'soc_skype' => __('Skype', SG_TDN),
			'soc_dribbble' => __('Dribbble', SG_TDN),
			'soc_twitter' => __('Twitter', SG_TDN),
			'soc_facebook' => __('Facebook', SG_TDN),
			'soc_flickr' => __('Flickr', SG_TDN),
			'soc_linkedin' => __('LinkedIn', SG_TDN),
			'soc_deviantart' => __('DeviantArt', SG_TDN),
			'soc_pinterest' => __('Pinterest', SG_TDN),
			'soc_vimeo' => __('Vimeo', SG_TDN),
			'soc_tumblr' => __('Tumblr', SG_TDN),
		);

		$vars = self::_getVars(self::moduleName, 'sg_' . $uniq, NULL, $post_id);

		if (!empty($vars) AND $vars['type'] != 'information') {
			$dphoto = ($vars['gender'] == 'male') ? '/images/content/ava-m.gif' : '/images/content/ava-f.gif';
			$dphoto = get_template_directory_uri() . $dphoto;
			$dphoto = '<img src="' . $dphoto . '" alt="" />';
			$photo = get_the_post_thumbnail($post_id, 'sg_our_team', array('class' => 'o-t'));
			$vars['photo'] = empty($photo) ? $dphoto : $photo;

			$vars['soc'] = '';
			foreach ($titles as $id => $name) {
				if (!empty($vars[$id])) {
					$vars['soc'] .= '<a target="_blank" href="' . $vars[$id] . '" title="' . $name . '" class="' . str_replace('soc_', 'ef-team-', $id) . '">';
						$vars['soc'] .= SG_HTML::image(get_template_directory_uri() . '/images/social/' . str_replace('soc_', 'team-', $id) . '.png') . $name;
					$vars['soc'] .= '</a><br />';
				}
			}
			if (!empty($vars['soc'])) $vars['soc'] = '<div class="ef-team-social">' . $vars['soc'] . '</div>';
		} else {
			$vars = array(
				'gender' => '',
				'photo' => '',
				'soc' => '',
			);
		}

		return (object) $vars;
	}

}