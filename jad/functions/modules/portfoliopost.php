<?php

class SG_PortfolioPost_Module extends SG_Module {

	const moduleName = 'PortfolioPost';

	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'featured' => array(
				'name' => __('Project Featured', SG_TDN),
				'type' => 'select',
				'options' => array(
					'simple' => __('Simple', SG_TDN),
					'featured' => __('Featured', SG_TDN),
				),
				'default' => 'simple',
				'help' => __('Featured (2x size thumbnail) or Regular (1x size thumbnail) project type', SG_TDN),
			),
			'img' => array(
				'name' => __('Get thumbnail', SG_TDN),
				'type' => 'portfolio',
				'default' => '',
				'help' => __('Get thumbnail for the project (not less than 800px width is needed. 800px x 952px is preferable)', SG_TDN),
			),
			'type' => array(
				'name' => __('Project Type', SG_TDN),
				'type' => 'select',
				'options' => array(
					'img' => __('Image', SG_TDN),
					'video' => __('Video', SG_TDN),
				),
				'default' => 'img',
				'change' => array(
					'image' => '["img"]',
					'video' => '["video"]',
				),
				'help' => __('Type of project', SG_TDN),
			),
			'slider' => array(
				'name' => __('Portfolio Slider Images', SG_TDN),
				'type' => 'slides',
				'class' => 'sg-metabox-field sg-metabox-slides2',
				'default' => array(
					'value' => self::USE_NONE,
					'slides' => array(),
				),
				'group' => 'image',
				'help' => __('Add images in portfolio gallery (800px x 952px is preferable)', SG_TDN),
			),
			'video' => array(
				'name' => __('Video Link', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'group' => 'video',
				'help' => __('Vimeo or YouTube video link', SG_TDN),
			),
			'parent' => array(
				'name' => __('Parent', SG_TDN),
				'type' => 'select',
				'options' => array(),
				'default' => '#',
				'show' => self::SHOW_ALL,
				'help' => __('Select parent portfolio page to be displayed in breadcrumbs', SG_TDN),
			),
		);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SG_PortfolioPost_Module;
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

		if (isset($post_data[$px . '_slider']['slides'])) {
			$slides = $post_data[$px . '_slider']['slides'];
			foreach ($slides as $id => $slide) {
				if (!isset($slide['img']) OR empty($slide['img']) OR $slide['img'] == -1) {
					unset($post_data[$px . '_slider']['slides'][$id]);
				}
			}
		} else {
			$post_data[$px . '_slider']['slides'] = array();
		}
		if (empty($post_data[$px . '_slider']['slides'])) {
			$post_data[$px . '_slider']['value'] = self::USE_NONE;
			$post_data[$px . '_slider']['slides'] = array();
			$post_data[$px . '_slider']['last'] = 0;
		} else {
			$post_data[$px . '_slider']['value'] = self::USE_DEFAULT;
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

	protected function _getPortfolioField($uid, $params, $value, $default, $ug)
	{
		global $post_ID;
		$nonce = wp_create_nonce('set_post_thumbnail-' . $post_ID);
		$btn_name = __('Get Image', SG_TDN);
		$img = wp_get_attachment_image(get_post_meta($post_ID, '_thumbnail_id', true), 'post-thumbnail');
		$clear = empty($img) ? ' style="display: none;"' : '';

		$c = '<span class="sg-upload-btns">';
		$c .= '<input type="submit" value="' . __('Load Image', SG_TDN) . '" class="button" id="' . $uid . '_load" name="' . $uid . '_load">';
		$c .= '&nbsp;<input type="submit" value="' . __('Clear Image', SG_TDN) . '" class="button sg-photo-clear" id="' . $uid . '_clear" name="' . $uid . '_clear"' . $clear . '><br /><br />';
		$c .= '</span>';
		$c .= '<span id="' . $uid . '_img">' . $img . '</span>';

		$c .= SG_Form::hidden($uid, '');

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
		$fields = self::$_fields;

		$get_posts = new WP_Query;
		$posts = $get_posts->query('post_type=page&posts_per_page=-1');
		$ppages = array('#' => __('-Last Portfolio Page-', SG_TDN));

		foreach ($posts as $post) {
			$post_custom = get_post_custom($post->ID);
			if (isset($post_custom['_wp_page_template'])) {
				if ($post_custom['_wp_page_template'][0] == 'pg-portfolio.php') {
					$ppages[$post->ID] = trim(esc_html(strip_tags(get_the_title($post))));
				}
			}
		}

		$fields['parent']['options'] = $ppages;

		return self::_getAdminContent(self::moduleName, $uniq, self::$_params, $fields, self::$_description, $params, $defaults, $global, $post_id);
	}

	public function showSlider($post_id = FALSE)
	{
		if ($post_id === FALSE) return (self::$_vars['slider']['value'] == self::USE_DEFAULT);

		$vars = self::_getVars(self::moduleName, 'sg_pos', NULL, $post_id);
		if (!empty($vars) AND isset($vars['slider']['value'])) return ($vars['slider']['value'] == self::USE_DEFAULT);

		return FALSE;
	}

	public function eSlider($post_id = FALSE, $imgsize = 'sg_post')
	{
		if ($post_id === FALSE) {
			foreach (self::$_vars['slider']['slides'] as $id => $slide) {
				echo '<div class="proj-img"><a class="ef-view" href="' . wp_get_attachment_url($slide['img']) . '" rel="ef-group">' . wp_get_attachment_image($slide['img'], $imgsize, FALSE) . '</a></div>';
			}
		} else {
			$vars = self::_getVars(self::moduleName, 'sg_pos', NULL, $post_id);
			if (!empty($vars)) {
				foreach ($vars['slider']['slides'] as $id => $slide) {
					echo '<li>' . wp_get_attachment_image($slide['img'], $imgsize, FALSE) . '</li>';
				}
			}
		}
	}

	function isFeatured($post_id = FALSE)
	{
		if ($post_id === FALSE) {
			return (self::$_vars['featured'] == 'featured');
		} else {
			$vars = self::_getVars(self::moduleName, 'sg_pos', NULL, $post_id);
			return (empty($vars) OR !isset($vars['featured'])) ? FALSE : ($vars['featured'] == 'featured');
		}
	}

	function getType($post_id = FALSE)
	{
		if ($post_id === FALSE) {
			return self::$_vars['type'];
		} else {
			$vars = self::_getVars(self::moduleName, 'sg_pos', NULL, $post_id);
			return (empty($vars) OR !isset($vars['type'])) ? 'img' : $vars['type'];
		}
	}

	function eVideo($post_id = FALSE)
	{
		if ($post_id === FALSE) {
			$video = self::$_vars['video'];
		} else {
			$vars = self::_getVars(self::moduleName, 'sg_pos', NULL, $post_id);
			$video = $vars['video'];
		}

		if (strpos($video, 'youtube.com') OR strpos($video, 'youtu.be')) {
			if (strpos($video, 'youtu.be')) {
				$t = explode('/', $video);
				echo youtubeVideo(array('id' => $t[count($t) - 1]));
			} else {
				$t = parse_url($video);
				parse_str($t['query']);
				echo youtubeVideo(array('id' => $v));
			}
		} else {
			$t = explode('/', $video);
			echo vimeoVideo(array('id' => $t[count($t) - 1]));
		}
	}

	function getVideoUrl($post_id = FALSE)
	{
		if ($post_id === FALSE) {
			$video = self::$_vars['video'];
		} else {
			$vars = self::_getVars(self::moduleName, 'sg_pos', NULL, $post_id);
			$video = $vars['video'];
		}

		if (strpos($video, 'youtu.be')) {
			$t = explode('/', $video);
			return 'http://www.youtube.com/watch?v=' . $t[count($t) - 1];
		}

		return $video;
	}

	public function getParent()
	{
		return isset(self::$_vars['parent']) ? self::$_vars['parent'] : '#';
	}

}