<?php

class SG_Post_Module extends SG_Module {

	const moduleName = 'Post';

	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'type' => array(
				'name' => __('Thumbnail Type', SG_TDN),
				'type' => 'select',
				'options' => array(
					'img' => __('Image', SG_TDN),
					'slider' => __('Slider', SG_TDN),
					'video' => __('Video', SG_TDN),
				),
				'default' => 'img',
				'change' => array(
					'slider' => '["slider"]',
					'video' => '["video"]',
				),
				'help' => __('Type of thumbnail', SG_TDN),
			),
			'slider' => array(
				'name' => __('Slider Images', SG_TDN),
				'type' => 'slides',
				'class' => 'sg-metabox-field sg-metabox-slides2',
				'default' => array(
					'value' => self::USE_NONE,
					'slides' => array(),
				),
				'group' => 'slider',
				'help' => __('Add images in the slider', SG_TDN),
			),
			'video' => array(
				'name' => __('Video Link', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'group' => 'video',
				'help' => __('Vimeo or YouTube video link', SG_TDN),
			),
			'show_thumbnail' => array(
				'name' => __('Show or hide thumbnails', SG_TDN),
				'type' => 'select',
				'options' => array(
					'yes' => __('Show', SG_TDN),
					'no' => __('Hide', SG_TDN),
				),
				'default' => 'yes',
				'show' => self::SHOW_ALL,
				'help' => __('Show or hide post thumbnails', SG_TDN),
			),
			'show_comments' => array(
				'name' => __('Show or hide comments', SG_TDN),
				'type' => 'select',
				'options' => array(
					'yes' => __('Show', SG_TDN),
					'no' => __('Hide', SG_TDN),
				),
				'default' => 'yes',
				'show' => self::SHOW_ALL,
				'help' => __('Allow or disallow comments', SG_TDN),
			),
			'parent' => array(
				'name' => __('Parent', SG_TDN),
				'type' => 'select',
				'options' => array(),
				'default' => '#',
				'show' => self::SHOW_ALL,
				'help' => __('Select parent blog page to be displayed in Breadcrumbs', SG_TDN),
			),
		);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SG_Post_Module;
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
sg_post_nonce = "' . $nonce . '";
sg_slider_btn_name = "' . $btn_name . '";
sg_slider_ajaxurl = "' . $ajax_url . '";
jQuery(document).ready(function($){
	function ' . $uid . 'sg_get_slide(cur){
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
		$bpages = array('#' => __('-Last Blog Page-', SG_TDN));

		foreach ($posts as $post) {
			$post_custom = get_post_custom($post->ID);
			if (isset($post_custom['_wp_page_template'])) {
				if ($post_custom['_wp_page_template'][0] == 'pg-blog.php') {
					$bpages[$post->ID] = trim(esc_html(strip_tags(get_the_title($post))));
				}
			}
		}

		$fields['parent']['options'] = $bpages;

		return self::_getAdminContent(self::moduleName, $uniq, self::$_params, $fields, NULL, $params, $defaults, $global, $post_id);
	}

	public function showSlider($post_id = FALSE)
	{
		if ($post_id === FALSE) return (self::$_vars['slider']['value'] == self::USE_DEFAULT);

		$vars = self::_getVars(self::moduleName, 'sg_ptl', NULL, $post_id);
		if (!empty($vars) AND isset($vars['slider']['value'])) return ($vars['slider']['value'] == self::USE_DEFAULT);

		return FALSE;
	}

	public function eSlider($post_id = FALSE, $imgsize = 'sg_post')
	{
		if ($post_id === FALSE) {
			foreach (self::$_vars['slider']['slides'] as $id => $slide) {
				echo '<li><a class="ef-view" href="' . wp_get_attachment_url($slide['img']) . '" rel="ef-group">' . wp_get_attachment_image($slide['img'], $imgsize, FALSE) . '</a></li>';
			}
		} else {
			$vars = self::_getVars(self::moduleName, 'sg_ptl', NULL, $post_id);
			if (!empty($vars)) {
				foreach ($vars['slider']['slides'] as $id => $slide) {
					echo '<li>' . wp_get_attachment_image($slide['img'], $imgsize, FALSE) . '</li>';
				}
			}
		}
	}

	function getType($post_id = FALSE)
	{
		if ($post_id === FALSE) {
			return self::$_vars['type'];
		} else {
			$vars = self::_getVars(self::moduleName, 'sg_ptl', NULL, $post_id);
			return (empty($vars) OR !isset($vars['type'])) ? 'img' : $vars['type'];
		}
	}

	function eVideo($post_id = FALSE)
	{
		if ($post_id === FALSE) {
			$video = self::$_vars['video'];
		} else {
			$vars = self::_getVars(self::moduleName, 'sg_ptl', NULL, $post_id);
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
			$vars = self::_getVars(self::moduleName, 'sg_ptl', NULL, $post_id);
			$video = $vars['video'];
		}

		if (strpos($video, 'youtu.be')) {
			$t = explode('/', $video);
			return 'http://www.youtube.com/watch?v=' . $t[count($t) - 1];
		}

		return $video;
	}

	public function showThumbnail()
	{
		return (self::$_vars['show_thumbnail'] == 'yes');
	}

	public function showComments()
	{
		return (self::$_vars['show_comments'] == 'yes');
	}

	public function getParent()
	{
		return isset(self::$_vars['parent']) ? self::$_vars['parent'] : '#';
	}

}