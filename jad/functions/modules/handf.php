<?php

class SG_HandF_Module extends SG_Module {

	const moduleName = 'HandF';

	protected static $instance;
	protected static $_vars = NULL;

	protected static $_params = array(
		'default_icon' => 'custom',
		'show_description' => TRUE,
		'home_mode' => FALSE,
	);

	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'header_images' => array(
				'name' => __('Header Image', SG_TDN),
				'type' => 'slides',
				'class' => 'sg-metabox-field sg-metabox-slides2',
				'default' => array(
					'value' => self::USE_GLOBAL,
					'slides' => array(),
				),
				'show' => self::SHOW_ALL,
				'help' => __('Add your images in the header. If some images was uploaded then they will change after each page loading', SG_TDN),
			),
			'header_title' => array(
				'name' => __('Header Title', SG_TDN),
				'type' => 'radio2',
				'options' => array(
					'title' => __('Post Title', SG_TDN),
				),
				'default' => array(
					'value' => 'title',
					'custom' => '',
				),
				'show' => self::SHOW_ENTITY,
				'help' => __('Title in the header', SG_TDN),
			),
			'icon' => array(
				'name' => __('Select Icon', SG_TDN),
				'type' => 'icon',
				'options' => array(
					'custom' => __('Custom', SG_TDN),
					'blog' => __('Blog', SG_TDN),
					'contact' => __('Contact', SG_TDN),
					'features' => __('Features', SG_TDN),
					'portfolio' => __('Portfolio', SG_TDN),
					'profile' => __('Profile', SG_TDN),
				),
				'default' => 'custom',
				'help' => __('Select an icon to be displayed before the page title', SG_TDN),
			),
			'cimg' => array(
				'name' => __('Get Custom Icon', SG_TDN),
				'type' => 'cicon',
				'default' => '',
				'help' => __('Get Custom Icon. 35px x 70px is required (dark and light icons in the same png)', SG_TDN),
			),
			'near_posts' => array(
				'name' => __('Prev and Next Pages/Posts link', SG_TDN),
				'type' => 'select',
				'options' => array(
					'yes' => __('Show', SG_TDN),
					'title' => __('Show Titles', SG_TDN),
					'no' => __('Hide', SG_TDN),
				),
				'default' => 'yes',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Show or hide previous and next post navigation', SG_TDN),
			),
			'logo_title' => array(
				'name' => __('Title below the Logo', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Text below the logotype', SG_TDN),
			),
			'soc_twitter' => array(
				'name' => __('Social Twiter', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '#',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Enter the link to your Twitter account or leave this field blank', SG_TDN),
			),
			'soc_facebook' => array(
				'name' => __('Social Facebook', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '#',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Enter the link to your Facebook account or leave this field blank', SG_TDN),
			),
			'soc_pinterest' => array(
				'name' => __('Social Pinterest', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '#',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Enter the link to your Pinterest account or leave this field blank', SG_TDN),
			),
			'soc_dribbble' => array(
				'name' => __('Social Dribbble', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '#',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Enter the link to your Dribbble account or leave this field blank', SG_TDN),
			),
			'soc_linkedin' => array(
				'name' => __('Social LinkedIn', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Enter the link to your LinkedIn or leave this field blank', SG_TDN),
			),
			'soc_vimeo' => array(
				'name' => __('Social Vimeo', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Enter the link to your Vimeo account or leave this field blank', SG_TDN),
			),
			'soc_youtube' => array(
				'name' => __('Social YouTube', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Enter the link to your YouTube account or leave this field blank', SG_TDN),
			),
			'soc_flickr' => array(
				'name' => __('Social Flickr', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Enter the link to your Flickr account or leave this field blank', SG_TDN),
			),
			'footer_state' => array(
				'name' => __('Footer Mode', SG_TDN),
				'type' => 'select',
				'options' => array(
					'o' => 'Opened',
					'c' => 'Closed',
				),
				'default' => 'c',
				'show' => self::SHOW_GLOBAL,
				'help' => __('"Opened" Mode provides static Footer without ability to hide it. "Closed" Footer is closed by default but may be opened by user pressing "+"', SG_TDN),
			),
			'copyright' => array(
				'name' => __('Copyright in the Footer', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '&#169; copyright 2012, JAD by <a href="http://themeforest.net/user/fireform?ref=fireform">fireform</a> for <a href="http://themeforest.net?ref=fireform">Themeforest</a>',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Paste your copyrights text here. You can use HTML tags and attributes', SG_TDN),
			),
			'twiter_profile' => array(
				'name' => __('Last Twitt Module profile', SG_TDN),
				'type' => 'input',
				'default' => 'evgenyfireform',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Enter your Twitter account name', SG_TDN),
			),
			'flickr_id' => array(
				'name' => __('Flickr Id', SG_TDN),
				'type' => 'input',
				'default' => '51035555243@N01',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Enter your Flickr ID or get it by <a href="http://idgettr.com">idgettr.com</a>', SG_TDN),
			),
			'flickr_tags' => array(
				'name' => __('Flickr Tags', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => 'fav10',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Enter a comma separated words to be used to select images by tags', SG_TDN),
			),
			'flickr_pictures' => array(
				'name' => __('Pictures count', SG_TDN),
				'type' => 'select',
				'options' => array(
					'4' => '4',
					'8' => '8',
					'12' => '12',
					'16' => '16',
				),
				'default' => '8',
				'show' => self::SHOW_GLOBAL,
				'help' => __('Select the number of images that you want to display in the Flickr widget as default', SG_TDN),
			),
		);

		self::$_description = __('Copyrights and social networks data', SG_TDN);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SG_HandF_Module;
		}
		return self::$instance;
	}

	public function inited()
	{
		return !is_null(self::$_vars);
	}

	public function initVars($uniq, $params, $defaults, $global, $post_id)
	{
		$p = self::_getParams($params, self::$_params);
		$fields = self::$_fields;
		$fields['icon']['default'] = $p['default_icon'];

		self::$_vars = self::_initVars(self::moduleName, $uniq, self::$_params, $fields, $params, $defaults, $global, $post_id);
		return TRUE;
	}

	public function setVars($uniq, $post_data, $post_id = NULL)
	{
		$px = self::_getPx($uniq, self::moduleName);

		if (isset($post_data[$px . '_header_images']['slides'])) {
			$slides = $post_data[$px . '_header_images']['slides'];
			foreach ($slides as $id => $slide) {
				if (!isset($slide['img']) OR empty($slide['img']) OR $slide['img'] == -1) {
					unset($post_data[$px . '_header_images']['slides'][$id]);
				} else {
					$img = load_image_to_edit($slide['img'], get_post_mime_type($slide['img']));
					$w = imagesx($img);
					$h = imagesy($img);
					$h = ($h > 280) ? 280 : $h;
					$wl = ($w <= 1200) ? 0 : round(($w - 1200) / 2);
					$wr = ($w <= 1200) ? $w : $wl + 1200;
					$c = 0;
					for ($i = 0; $i < $h; $i++) {
						for ($j = $wl; $j < $wr; $j++) {
							$rgb = imagecolorat($img, $j, $i);
							$r = ($rgb >> 16) & 0xFF;
							$g = ($rgb >> 8) & 0xFF;
							$b = $rgb & 0xFF;
							$c += round(($r + $g + $b) / 3);
						}
					}
					imagedestroy($img);
					$c = round($c / (($wr - $wl) * $h));
					$post_data[$px . '_header_images']['slides'][$id]['colors'] = $c;
				}
			}
		} else {
			$post_data[$px . '_header_images']['slides'] = array();
		}
		if (empty($post_data[$px . '_header_images']['slides'])) {
			$post_data[$px . '_header_images']['value'] = self::USE_GLOBAL;
			$post_data[$px . '_header_images']['slides'] = array();
			$post_data[$px . '_header_images']['last'] = 0;
		} else {
			$post_data[$px . '_header_images']['value'] = self::USE_DEFAULT;
		}

		return self::_setVars(self::moduleName, $uniq, self::$_fields, $post_data, $post_id);
	}

	public function resetVars($uniq, $post_id = NULL)
	{
		return self::_resetVars(self::moduleName, $uniq, $post_id);
	}

	public function getMenuItem()
	{
		return __('Header & Footer', SG_TDN);
	}

	protected function _getCiconField($uid, $params, $value, $default, $ug)
	{
		global $post_ID;
		$nonce = wp_create_nonce('set_post_thumbnail-' . $post_ID);
		$btn_name = __('Get Icon', SG_TDN);
		$ajax_url = get_template_directory_uri() . '/functions/modules/includes/image/ajax.php';
		$img = wp_get_attachment_image($value, 'sg_page_icons');
		$clear = empty($img) ? ' style="display: none;"' : '';

		$c = '<span class="sg-upload-btns">';
		$c .= '<input type="submit" value="' . __('Load Icon', SG_TDN) . '" class="button" id="' . $uid . '_load" name="' . $uid . '_load">&nbsp;';
		$c .= '<input type="submit" value="' . __('Clear Icon', SG_TDN) . '" class="button sg-photo-clear" id="' . $uid . '_clear" name="' . $uid . '_clear"' . $clear . '><br /><br />';
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
		$("input[name=' . $uid . ']").val("");
		$("#' . $uid . '_img").html("");
		$("#' . $uid . '_clear").hide();
		return false;
	});
	$("#' . $uid . '_load").click(function() {
		sg_post_nonce = "' . $nonce . '";
		sg_image_btn_name = "' . $btn_name . '";
		sg_image_ajaxurl = "' . $ajax_url . '";
		var pID = jQuery("#post_ID").val();
		window.sg_current_upload_image = "' . $uid . '";
		tb_show("Insert", "media-upload.php?post_id=" + pID + "&custom-media-upload=I&type=image&TB_iframe=true");
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
				$img_href = get_template_directory_uri() . '/images/content/pages/' . $oval . '-a.png';
				$img = ($oval == 'custom') ? '' : SG_HTML::image($img_href);
				$item = '<span class="sg-icon-' . $oval . '">' . $img  . '</span>' . $radio;
				$c .= SG_Form::label(NULL, $item, array('class' => 'sg-icon-item', 'title' => $oname));
			}
			$c .= '<div class="clear"></div>';
		$c .= '</div>';

		return $c;
	}

	protected function _getSlidesField($uid, $params, $value, $default, $ug)
	{
		global $post_ID;
		$nonce = wp_create_nonce('set_post_thumbnail-' . (empty($post_ID) ? 0 : $post_ID));
		$btn_name = __('Get Image', SG_TDN);
		$ajax_url = get_template_directory_uri() . '/functions/modules/includes/image/ajax.php';

		$slides = (isset($value['slides'])) ? $value['slides'] : array();
		$last = (isset($value['last'])) ? $value['last'] : 0;

		$c = '';

		foreach ($slides as $id => $slide) {
			$c .= '<div class="sg-slide-top">';
				$c .= '<div class="sg-slide">';
					$c .= '<div class="sg-slide-in" id="' . $uid . '-' . $id . '" rel="' . $uid . '[slides][' . $id . ']">';
						$c .= '<a class="button sg-slide-rm ' . $uid . '-rm" href="#">-</a>';
						$c .= '<div class="sg-slide-img ' . $uid . '">';
							$c .= wp_get_attachment_image($slide['img'], 'post-thumbnail');
							$c .= SG_Form::hidden($uid . '[slides][' . $id . '][img]', $slide['img']);
						$c .= '</div>';
					$c .= '</div>';
				$c .= '</div>';
			$c .= '</div>';
		}

		$c .= '<div class="sg-slide-top">';
			$c .= '<div class="sg-slide">';
				$c .= '<div class="sg-slide-in-add">';
					$c .= '<a id="' . $uid . '-add" class="button sg-slide-add" href="#">+</a>';
					$c .= SG_Form::hidden($uid . '[last]', $last, array('id' => $uid . '-last'));
				$c .= '</div>';
			$c .= '</div>';
		$c .= '</div>';

		$c .= '<div class="clear"></div>';

		$c .= '<script type="text/javascript">';
		$c .= '
//<![CDATA[
jQuery(document).ready(function($){
	function ' . $uid . 'sg_get_slide(cur){
		sg_post_nonce = "' . $nonce . '";
		sg_slider_btn_name = "' . $btn_name . '";
		sg_slider_ajaxurl = "' . $ajax_url . '";
		var pID = jQuery("#post_ID").val() || 0;
		window.sg_current_upload_slide = $(cur).parent().attr("id");
		tb_show("Insert", "media-upload.php?post_id=" + pID + "&custom-media-upload=SI&type=image&TB_iframe=true");
	}

	$("#' . $uid . '-add").click(function(e){
		var i = $("#' . $uid . '-last").val();
		$("<div class=\"sg-slide-top\"><div class=\"sg-slide\"><div class=\"sg-slide-in\" id=\"' . $uid . '-" + i + "\" rel=\"' . $uid . '[slides][" + i + "]\"><a href=\"#\" class=\"button sg-slide-rm ' . $uid . '-rm\">-</a><div class=\"sg-slide-img ' . $uid . '\"></div></div></div>").insertBefore($("#' . $uid . '-add").parent().parent().parent());
		$("#' . $uid . '-last").val(++i);
		$(".' . $uid . '-rm").click(function(e){$(this).parent().parent().remove();return false;});
		$(".' . $uid . ':last").click(function(){' . $uid . 'sg_get_slide(this);return false;});
		return false;
	});

	$(".' . $uid . '-rm").click(function(e){
		$(this).parent().parent().parent().remove();
		return false;
	});

	$(".' . $uid . '").click(function(){
		' . $uid . 'sg_get_slide(this);
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
		$p = self::_getParams($params, self::$_params);
		$description = ($p['show_description']) ? self::$_description : NULL;
		$fields = self::$_fields;
		$fields['icon']['default'] = $p['default_icon'];

		if ($p['home_mode']) {
			unset($fields['header_title']);
			unset($fields['icon']);
			unset($fields['cimg']);
		}

		$c = self::_getAdminContent(self::moduleName, $uniq, self::$_params, $fields, $description, $params, $defaults, $global, $post_id);

		$c .= '<script type="text/javascript">';
		$c .= '
//<![CDATA[
jQuery(document).ready(function($){
	function ' . $uniq . '_set_icon_type(){
		var cd = $("input[name=' . $uniq . 'HandF_icon]:checked");
		if (cd.val() == "custom") {
			$("input[name=' . $uniq . 'HandF_cimg]").parent().parent().show();
		} else {
			$("input[name=' . $uniq . 'HandF_cimg]").parent().parent().hide();
		}
	}

	' . $uniq . '_set_icon_type();

	$("input[name=' . $uniq . 'HandF_icon]").change(' . $uniq . '_set_icon_type);
});
//]]>
			';
		$c .= '</script>';

		return $c;
	}

	public function eCopyright()
	{
		if (!empty(self::$_vars['copyright'])) {
			echo __(self::$_vars['copyright']);
		} else {
			echo ' ';
		}
	}

	protected function isSocial()
	{
		$titles = array(
			'soc_twitter',
			'soc_facebook',
			'soc_pinterest',
			'soc_dribbble',
			'soc_linkedin',
			'soc_vimeo',
			'soc_youtube',
			'soc_flickr',
		);

		foreach ($titles as $id) {
			if (!empty(self::$_vars[$id])) {
				return TRUE;
			}
		}
		return FALSE;
	}

	public function eSocial()
	{
		if (!$this->isSocial())	return;

		$titles = array(
			'soc_twitter' => __('Twitter', SG_TDN),
			'soc_facebook' => __('Facebook', SG_TDN),
			'soc_pinterest' => __('Pinterest', SG_TDN),
			'soc_dribbble' => __('Dribbble', SG_TDN),
			'soc_linkedin' => __('LinkedIn', SG_TDN),
			'soc_vimeo' => __('Vimeo', SG_TDN),
			'soc_youtube' => __('YouTube', SG_TDN),
			'soc_flickr' => __('Flickr', SG_TDN),
		);

		$imgs = array(
			'soc_twitter' => 'twt.png',
			'soc_facebook' => 'faceb.png',
			'soc_pinterest' => 'pinterest.png',
			'soc_dribbble' => 'drbbbl.png',
			'soc_linkedin' => 'linkd.png',
			'soc_vimeo' => 'vim.png',
			'soc_youtube' => 'ytb.png',
			'soc_flickr' => 'flckr.png',
		);

		$c = '';
			foreach ($titles as $id => $name) {
				if (!empty(self::$_vars[$id])) {
					$c .= '<a target="_blank" href="' . self::$_vars[$id] . '" title="' . $name . '" class="' . str_replace('soc_', 'soc-', $id) . '"><span></span></a>';
				}
			}

		echo $c;
	}

	public function showNear()
	{
		return (self::$_vars['near_posts'] != 'no');
	}

	public function nearType()
	{
		return self::$_vars['near_posts'];
	}

	public function footerState()
	{
		return self::$_vars['footer_state'];
	}

	public function eHeaderCTitle()
	{
		echo '<p>' . ((empty(self::$_vars['logo_title'])) ? '&nbsp;' : __(self::$_vars['logo_title'])) . '</p>';
	}

	public function showTwitter()
	{
		return !empty(self::$_vars['twiter_profile']);
	}

	public function eTwitterProfile()
	{
		echo self::$_vars['twiter_profile'];
	}

	public function getFlickrSettings()
	{
		return array(
			'flickr_id' => self::$_vars['flickr_id'],
			'tags' => self::$_vars['flickr_tags'],
			'pictures' => self::$_vars['flickr_pictures'],
		);
	}

	public function eHeaderTitle($title = NULL)
	{
		$e = '<p>';
		if (self::$_vars['icon'] == 'custom') {
			if (!empty(self::$_vars['cimg'])) $e .= '<span class="ef-ti">' . wp_get_attachment_image(self::$_vars['cimg'], 'sg_page_icons') . '</span>';
		} else {
			$e .= '<span class="ef-ti">' . SG_HTML::image(get_template_directory_uri() . '/images/content/pages/' . self::$_vars['icon'] . '.png') . '</span>';
		}
		$e .= (self::$_vars['header_title']['value'] == self::USE_CUSTOM) ? (!empty(self::$_vars['header_title']['custom']) ? self::$_vars['header_title']['custom'] : '&nbsp;') : (!empty($title) ? $title : '&nbsp;');
		$e .= '</p>';
		echo $e;
	}

	public function eHeaderImg()
	{
		if (count(self::$_vars['header_images']['slides']) > 0) {
			$slides = array();
			foreach (self::$_vars['header_images']['slides'] as $slide) {
				$slides[] = array(
					$slide['img'],
					$slide['colors'],
				);
			}
			$rnd = rand(0, count($slides) - 1);
			$img = wp_get_attachment_url($slides[$rnd][0]);
			$col = $slides[$rnd][1];
			echo '<style type="text/css">';
				echo '#ef-header {background-image: url("' . $img . '");}' . "\n";
			echo '</style>';
			return ($col < 170) ? ' dark-cond-top' : '';
		} elseif (_sg('Modules')->enabled('Theme') AND !_sg('Theme')->showHeaderPattern()) {
			return 'ef-noheaderimg';
		}

		return '';
	}

}