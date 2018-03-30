<?php

class SG_Slider_Module extends SG_Module {

	const moduleName = 'Slider';

	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'show' => array(
				'name' => __('Slider Visibility', SG_TDN),
				'type' => 'select',
				'options' => array(
					'main' => __('Regular', SG_TDN),
					'full' => __('Full', SG_TDN),
					'no' => __('Hide', SG_TDN),
				),
				'default' => 'no',
				'change' => array(
					'slider' => '["main"]',
					'slider2' => '["full"]',
				),
				'help' => __('Show or hide the slider on the page', SG_TDN),
			),
			'effect' => array(
				'name' => __('Effect', SG_TDN),
				'type' => 'select',
				'options' => array(
					'slide' => __('Slide', SG_TDN),
					'fade' => __('Fade', SG_TDN),
				),
				'default' => 'slider',
				'group' => 'slider',
				'help' => __('Animation effect', SG_TDN),
			),
			'animation_time' => array(
				'name' => __('Animation Time', SG_TDN),
				'type' => 'select',
				'options' => array(
					'300' => '300 mc',
					'400' => '400 mc',
					'500' => '500 mc',
					'600' => '600 mc',
					'700' => '700 mc',
					'800' => '800 mc',
					'900' => '900 mc',
				),
				'default' => '500',
				'group' => 'slider',
				'help' => __('Select the duration value of sliding animation (milliseconds)', SG_TDN),
			),
			'effect2' => array(
				'name' => __('Effect', SG_TDN),
				'type' => 'select',
				'options' => array(
					'fade' => __('Fade', SG_TDN),
					'slideTop' => __('Slide in from top', SG_TDN),
					'slideRight' => __('Slide in from right', SG_TDN),
					'slideBottom' => __('Slide in from bottom', SG_TDN),
					'slideLeft' => __('Slide in from left', SG_TDN),
					'carouselLeft' => __('Carousel from left to right', SG_TDN),
					'carouselRight' => __('Carousel from right to left', SG_TDN),
				),
				'default' => 'fade',
				'group' => 'slider2',
				'help' => __('Animation effect', SG_TDN),
			),
			'delay2' => array(
				'name' => __('Delay', SG_TDN),
				'type' => 'select',
				'options' => array(
					'3000' => '3000 mc',
					'4000' => '4000 mc',
					'5000' => '5000 mc',
					'6000' => '6000 mc',
					'7000' => '7000 mc',
					'8000' => '8000 mc',
					'9000' => '9000 mc',
				),
				'default' => '3000',
				'group' => 'slider2',
				'help' => __('Select the delay value before slide changing (milliseconds)', SG_TDN),
			),
			'animation_time2' => array(
				'name' => __('Animation Time', SG_TDN),
				'type' => 'select',
				'options' => array(
					'300' => '300 mc',
					'400' => '400 mc',
					'500' => '500 mc',
					'600' => '600 mc',
					'700' => '700 mc',
					'800' => '800 mc',
					'900' => '900 mc',
				),
				'default' => '700',
				'group' => 'slider2',
				'help' => __('Select the duration value of sliding animation (milliseconds)', SG_TDN),
			),
			'slides' => array(
				'name' => __('Slides', SG_TDN),
				'type' => 'slides',
				'class' => 'sg-metabox-field sg-metabox-slides',
				'default' => array(
					'slides' => array(),
					'value' => 0,
				),
				'help' => __('Add your images in the slider. Add link (no link if left "#"), button value and html caption for the slider (h1, p, img)', SG_TDN),
			),
		);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SG_Slider_Module;
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

		if (isset($post_data[$px . '_slides']['slides'])) {
			$slides = $post_data[$px . '_slides']['slides'];
			foreach ($slides as $id => $slide) {
				if (!isset($slide['img']) OR empty($slide['img']) OR $slide['img'] == -1) {
					unset($post_data[$px . '_slides']['slides'][$id]);
				} else {
					if (!isset($slide['color1']) OR $slide['color1'] == 'auto' OR !isset($slide['color2']) OR $slide['color2'] == 'auto') {
						$img = load_image_to_edit($slide['img'], get_post_mime_type($slide['img']), 'post-thumbnail');
						$w = imagesx($img);
						$h = imagesy($img);
						$h13 = round($h / 3);
						$h23 = round($h * 2 / 3) + 1;
						$ct = $cc = $cb = 0;
						for ($i = 0; $i < $h; $i++) {
							for ($j = 0; $j < $w; $j++) {
								$rgb = imagecolorat($img, $j, $i);
								$r = ($rgb >> 16) & 0xFF;
								$g = ($rgb >> 8) & 0xFF;
								$b = $rgb & 0xFF;
								if ($i < $h13) {
									$ct += round(($r + $g + $b) / 3);
								} elseif ($i < $h23) {
									$cc += round(($r + $g + $b) / 3);
								} else {
									$cb += round(($r + $g + $b) / 3);
								}
							}
						}
						imagedestroy($img);
						$ct = round($ct / ($w * $h13));
						$cc = round($cc / ($w * ($h23 - $h13)));
						$cb = round($cb / ($w * ($h - $h23)));
					} else {
						$cb = 0;
					}
					$ct = (isset($slide['color1']) AND $slide['color1'] == 'w') ? 1 : 255;
					$cc = (isset($slide['color2']) AND $slide['color2'] == 'w') ? 1 : 255;
					$post_data[$px . '_slides']['slides'][$id]['colors'] = $ct . ';' . $cc . ';' . $cb;
				}
			}
			if (empty($post_data[$px . '_slides']['slides'])) {
				$post_data[$px . '_slides']['value'] = 0;
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
		return __('Slider', SG_TDN);
	}

	protected function _getSlidesField($uid, $params, $value, $default, $ug)
	{
		global $post_ID;
		$nonce = wp_create_nonce('set_post_thumbnail-' . $post_ID);
		$btn_name = __('Get Image', SG_TDN);
		$ajax_url = get_template_directory_uri() . '/functions/modules/includes/image/ajax.php';

		$slides = (isset($value['slides'])) ? $value['slides'] : array();
		$last = (isset($value['value'])) ? $value['value'] : 0;

		$c = '';

		foreach ($slides as $id => $slide) {
			$c .= '<div class="sg-slide sg-color-slide">';
				$c .= '<div class="sg-slide-in" id="' . $uid . '-' . $id . '" rel="' . $uid . '[slides][' . $id . ']">';
					$c .= '<a class="button sg-slide-rm ' . $uid . '-rm" href="#">-</a>';
					$c .= '<a class="button sg-slide-tt ' . $uid . '-tt" href="#">&#8593;</a>';
					$c .= '<a class="button sg-slide-tb ' . $uid . '-tb" href="#">&#8595;</a>';
					$c .= '<div class="sg-slide-img ' . $uid . '">';
						$c .= wp_get_attachment_image($slide['img'], 'post-thumbnail');
						$c .= SG_Form::hidden($uid . '[slides][' . $id . '][img]', $slide['img']);
					$c .= '</div>';
					$c .= '<div class="sg-slide-txt">';
						$ip = array('onfocus' => 'if (this.value==\'#\') this.value=\'\';',
									'onblur' => 'if (this.value==\'\'){this.value=\'#\'}');
						$iv = (empty($slide['url']) OR $slide['url'] == '#') ? '#' : $slide['url'];
						$colors = array(
							'a' => __('Auto', SG_TDN),
							'w' => __('Light', SG_TDN),
							'b' => __('Dark', SG_TDN),
						);
						$color1 = isset($slide['color1']) ? $slide['color1'] : 'a';
						$color2 = isset($slide['color2']) ? $slide['color2'] : 'a';
						$c .= SG_Form::input($uid . '[slides][' . $id . '][url]', $iv, $ip);
						$c .= SG_Form::input($uid . '[slides][' . $id . '][title]', $slide['title']);
						$c .= SG_Form::textarea($uid . '[slides][' . $id . '][txt]', $slide['txt']);
						$c .= '<div class="select-block">';
						$c .= '<span>' . __('Header Skin', SG_TDN) . '</span>';
						$c .= SG_Form::select($uid . '[slides][' . $id . '][color1]', $colors, $color1);
						$c .= '</div>';
						$c .= '<div class="select-block">';
						$c .= '<span>' . __('Caption Skin', SG_TDN) . '</span>';
						$c .= SG_Form::select($uid . '[slides][' . $id . '][color2]', $colors, $color2);
						$c .= '</div>';
					$c .= '</div>';
				$c .= '</div>';
			$c .= '</div>';
		}

		$c .= '<div class="sg-slide">';
			$c .= '<div class="sg-slide-in-add">';
				$c .= '<a id="' . $uid . '-add" class="button sg-slide-add" href="#">+</a>';
				$c .= SG_Form::hidden($uid . '[value]', $last, array('id' => $uid . '-last'));
			$c .= '</div>';
		$c .= '</div>';

		$c .= '<script type="text/javascript">';
		$c .= '
//<![CDATA[
jQuery(document).ready(function($){
	function ' . $uid . 'sg_get_slide(cur){
		sg_post_nonce = "' . $nonce . '";
		sg_slider_btn_name = "' . $btn_name . '";
		sg_slider_ajaxurl = "' . $ajax_url . '";
		var pID = jQuery("#post_ID").val();
		window.sg_current_upload_slide = $(cur).parent().attr("id");
		tb_show("Insert", "media-upload.php?post_id=" + pID + "&custom-media-upload=SI&type=image&TB_iframe=true");
	}

	$("#' . $uid . '-add").click(function(e){
		var i = $("#' . $uid . '-last").val();
		$("<div class=\"sg-slide sg-color-slide\"><div class=\"sg-slide-in\" id=\"' . $uid . '-" + i + "\" rel=\"' . $uid . '[slides][" + i + "]\"><a href=\"#\" class=\"button sg-slide-rm ' . $uid . '-rm\">-</a><a class=\"button sg-slide-tt ' . $uid . '-tt\" href=\"#\">&#8593;</a><a class=\"button sg-slide-tb ' . $uid . '-tb\" href=\"#\">&#8595;</a><div class=\"sg-slide-img ' . $uid . '\"></div><div class=\"sg-slide-txt\"><input type=\"text\" onblur=\"if (this.value==\'\'){this.value=\'#\'}\" onfocus=\"if (this.value==\'#\') this.value=\'\';\" value=\"#\" name=\"' . $uid . '[slides][" + i + "][url]\"><input type=\"text\" value=\"\" name=\"' . $uid . '[slides][" + i + "][title]\"> <textarea name=\"' . $uid . '[slides][" + i + "][txt]\"></textarea><span>' . __('Header Skin', SG_TDN) . '</span><select name=\"sg_hplSlider_slides[slides][" + i + "][color1]\"><option value=\"a\">' . __('Auto', SG_TDN) . '</option><option value=\"w\">' . __('Light', SG_TDN) . '</option><option value=\"b\">' . __('Dark', SG_TDN) . '</option></select><span>' . __('Caption Skin', SG_TDN) . '</span><select name=\"sg_hplSlider_slides[slides][" + i + "][color2]\"><option value=\"a\">' . __('Auto', SG_TDN) . '</option><option value=\"w\">' . __('Light', SG_TDN) . '</option><option value=\"b\">' . __('Dark', SG_TDN) . '</option></select></div></div></div>").insertBefore($("#' . $uid . '-add").parent().parent());
		$("#' . $uid . '-last").val(++i);
		$(".' . $uid . ':last").click(function(){' . $uid . 'sg_get_slide(this);return false;});
		$(".' . $uid . '-rm:last").click(function(e){$(this).parent().parent().remove();' . $uid . '_change();return false;});
		$(".' . $uid . '-tt:last").click(function(e){' . $uid . '_tt_click(this);' . $uid . '_change();return false;});
		$(".' . $uid . '-tb:last").click(function(e){' . $uid . '_tb_click(this);' . $uid . '_change();return false;});
		' . $uid . '_change();
		return false;
	});

	$(".' . $uid . '").click(function(){
		' . $uid . 'sg_get_slide(this);
		return false;
	});

	$(".' . $uid . '-rm").click(function(e){
		$(this).parent().parent().remove();
		' . $uid . '_change();
		return false;
	});

	$(".' . $uid . '-tt").click(function(e){
		' . $uid . '_tt_click(this);
		' . $uid . '_change();
		return false;
	});

	$(".' . $uid . '-tb").click(function(e){
		' . $uid . '_tb_click(this);
		' . $uid . '_change();
		return false;
	});

	function ' . $uid . '_tt_click(a) {
		var slides = $(".sg-slide > .sg-slide-in", $("#' . $uid . '-add").parent().parent().parent()).parent();
		if ($(slides).length < 2) return false;
		var slide = $(a).parent().parent();
		var prev = $(slide).prev(".sg-slide");
		if (!$(prev).length) return false;

		var slidea = $(".sg-slide-in input, .sg-slide-in textarea", $(slide));
		var preva = $(".sg-slide-in input, .sg-slide-in textarea", $(prev));
		var cp = $(prev).clone();
		$(".' . $uid . ':last", $(cp)).click(function(){' . $uid . 'sg_get_slide(this);return false;});
		$(".' . $uid . '-rm", $(cp)).click(function(e){$(this).parent().parent().remove();' . $uid . '_change();return false;});
		$(".' . $uid . '-tt", $(cp)).click(function(e){' . $uid . '_tt_click(this);' . $uid . '_change();return false;});
		$(".' . $uid . '-tb", $(cp)).click(function(e){' . $uid . '_tb_click(this);' . $uid . '_change();return false;});

		$(".sg-slide-in", $(cp)).attr("id", $(".sg-slide-in", $(slide)).attr("id"));
		$(".sg-slide-in", $(cp)).attr("rel", $(".sg-slide-in", $(slide)).attr("rel"));
		$(".sg-slide-in input, .sg-slide-in textarea", $(cp)).each(function(i){
			$(this).attr("name", $(slidea[i]).attr("name"));
		});
		$(".sg-slide-in", $(slide)).attr("id", $(".sg-slide-in", $(prev)).attr("id"));
		$(".sg-slide-in", $(slide)).attr("rel", $(".sg-slide-in", $(prev)).attr("rel"));
		$(".sg-slide-in input, .sg-slide-in textarea", $(slide)).each(function(i){
			$(this).attr("name", $(preva[i]).attr("name"));
		});
		$(prev).remove();
		$(slide).after(cp);
		return false;
	}

	function ' . $uid . '_tb_click(a) {
		var slides = $(".sg-slide > .sg-slide-in", $("#' . $uid . '-add").parent().parent().parent()).parent();
		if ($(slides).length < 2) return false;
		var slide = $(a).parent().parent();
		var next = $(slide).next(".sg-slide");
		if ($("#' . $uid . '-add", $(next)).length) return false;

		var slidea = $(".sg-slide-in input, .sg-slide-in textarea", $(slide));
		var nexta = $(".sg-slide-in input, .sg-slide-in textarea", $(next));
		var cp = $(next).clone();
		$(".' . $uid . ':last", $(cp)).click(function(){' . $uid . 'sg_get_slide(this);return false;});
		$(".' . $uid . '-rm", $(cp)).click(function(e){$(this).parent().parent().remove();' . $uid . '_change();return false;});
		$(".' . $uid . '-tt", $(cp)).click(function(e){' . $uid . '_tt_click(this);' . $uid . '_change();return false;});
		$(".' . $uid . '-tb", $(cp)).click(function(e){' . $uid . '_tb_click(this);' . $uid . '_change();return false;});

		$(".sg-slide-in", $(cp)).attr("id", $(".sg-slide-in", $(slide)).attr("id"));
		$(".sg-slide-in", $(cp)).attr("rel", $(".sg-slide-in", $(slide)).attr("rel"));
		$(".sg-slide-in input, .sg-slide-in textarea", $(cp)).each(function(i){
			$(this).attr("name", $(slidea[i]).attr("name"));
		});
		$(".sg-slide-in", $(slide)).attr("id", $(".sg-slide-in", $(next)).attr("id"));
		$(".sg-slide-in", $(slide)).attr("rel", $(".sg-slide-in", $(next)).attr("rel"));
		$(".sg-slide-in input, .sg-slide-in textarea", $(slide)).each(function(i){
			$(this).attr("name", $(nexta[i]).attr("name"));
		});
		$(next).remove();
		$(slide).before(cp);
		return false;
	}

	function ' . $uid . '_change() {
		var slides = $(".sg-slide > .sg-slide-in", $("#' . $uid . '-add").parent().parent().parent()).parent();
		if ($(slides).length) {
			$("a.button", $("#' . $uid . '-add").parent().parent().parent()).removeClass("disabled");
			$("a.sg-slide-tt:first, a.sg-slide-tb:last", $("#' . $uid . '-add").parent().parent().parent()).addClass("disabled");
		}
		return false;
	}

	' . $uid . '_change();
});
//]]>
			';
		$c .= '</script>';

		return $c;
	}

	public function getAdminContent($uniq, $params, $defaults, $global = NULL, $post_id = NULL)
	{
		$c = self::_getAdminContent(self::moduleName, $uniq, self::$_params, self::$_fields, self::$_description, $params, $defaults, $global, $post_id);

		return $c;
	}

	public function getSlidesCount()
	{
		return isset(self::$_vars['slides']['slides']) ? count(self::$_vars['slides']['slides']) : 0;
	}

	public function showSlider()
	{
		return (self::$_vars['show'] != 'no');
	}

	public function getSliderType()
	{
		return self::$_vars['show'];
	}

	public function eSlider()
	{
		if (self::$_vars['show'] == 'main') {
			if ($this->getSlidesCount() > 0) {

				$js = '<script type="text/javascript">';
				$js .= '
//<![CDATA[
jQuery(window).load(function() {
	var $ = jQuery;
	jQuery("#main-slider").flexslider({
		animation: "' . self::$_vars['effect'] . '",
		animationSpeed: ' . self::$_vars['animation_time'] . ',
		controlsContainer: ".main-ctrl-container",
		easing: "swing",
		slideshow: false,
		controlNav: false,
		directionNav: true,
		start: function(slider) {
			$(".slider-preloader").remove();

			slider.fadeIn()
			.css({top: ( $(".main-ctrl-container").height() - $(".flex-viewport").height() ) / 2 })
			.parent().find("a.flex-prev").delay(500)
			.animate({marginLeft: "2em"});

			slider.parent().find("a.flex-next")
			.delay(500)
			.animate({marginRight: "2em"});

			var flexViewport = $(".flex-viewport").height();
			var slideContent = $(".ef-slide-content").parent();

			slideContent.each(function() {
				$(this).css({ marginTop: (flexViewport - $(this).height()) / 2, marginBottom: (flexViewport - $(this).height()) / 2 })
				.find(".flex-caption").each(function(){
					$(this).css({top: ($(this).parent().height() - $(this).height()) / 2})
				})
			});

			$(".flex-caption").delay(100).fadeIn(500)
        },
        before: function(slider) {
        	var flexViewport = $(".flex-viewport").height();
        	var $animatingTo = slider.slides.eq(slider.animatingTo);

        	$animatingTo.find(".ef-slide-content").parent().each(function() {
        		$(this)
        		.css({ marginTop: (flexViewport - $(this).height()) / 2, marginBottom: (flexViewport - $(this).height()) / 2 });
        		});

        	$(".flex-caption").delay(100).css({display: "none"})
        },
        after: function(slider) {
        	$(".flex-caption").delay(100).fadeIn(500)
        }
	});
});
//]]>
				';
				$js .= '</script>';

				echo '<div class="main-ctrl-container">';
					echo '<div id="main-slider" class="clearfix">';
						echo '<ul class="slides">';
						foreach (self::$_vars['slides']['slides'] as $id => $slide) {
							$slide['url'] = (empty($slide['url'])) ? '#' : $slide['url'];
							echo '<li>';
								echo '<div class="ef-slide-content">';
									echo (!empty($slide['url']) AND $slide['url'] != '#' AND empty($slide['title'])) ? '<a href="' . $slide['url'] . '">' : '';
										echo SG_HTML::image(wp_get_attachment_url($slide['img']));
									echo (!empty($slide['url']) AND $slide['url'] != '#' AND empty($slide['title'])) ? '</a>' : '';
									echo (!empty($slide['title']) OR !empty($slide['txt'])) ? '<div class="flex-caption">' : '';
										//echo (!empty($slide['title'])) ? '<div class="ef-big-text">' . strip_tags(__($slide['title'])) . '</div>' : '';
										echo (!empty($slide['txt'])) ? '<div class="extras-descrp">' . nl2br(strip_tags(__($slide['txt']))) . '</div>' : '';
										echo (!empty($slide['url']) AND $slide['url'] != '#' AND !empty($slide['title'])) ? '<a class="load-item ef-slide-link" href="' . $slide['url'] . '">' . strip_tags(__($slide['title'])) . '</a>' : '';
									echo (!empty($slide['title']) OR !empty($slide['txt'])) ? '</div>' : '';
								echo '</div>';
							echo '</li>';
						}
						echo '</ul>';
					echo '</div>';
				echo '</div>';
				echo $js;
			} else {
				echo '<div class="main-ctrl-container ef-breadcrumbs"><div style="width:50%;margin:0 auto;">' . sg_message(__('No Slides in Slider', SG_TDN)) . '</div></div>';
			}
		} elseif (self::$_vars['show'] == 'full') {
			if ($this->getSlidesCount() > 0) {

				$imgs = '';
				foreach (self::$_vars['slides']['slides'] as $id => $slide) {
					$slide['url'] = (empty($slide['url'])) ? '#' : $slide['url'];
					$imgs .= '{image : "' . wp_get_attachment_url($slide['img']) . '", colors : "' . $slide['colors'] . '"';
					$imgs .= (!empty($slide['txt']) OR $slide['url'] != '#') ? ', title : "' : '';
					$imgs .= (!empty($slide['txt'])) ? '<div class=\"slidecaption-iner\">' . strip_tags(str_replace('"', '\"', str_replace(array("\r\n", "\n"), '', trim(__($slide['txt'])))), '<h1><p><img><br>') . '</div>' : '';
					$imgs .= ($slide['url'] != '#') ? '<a class=\"load-item ef-slide-link' . ((empty($slide['title'])) ? ' ef-empty' : '') . '\" href=\"' . $slide['url'] . '\">' . strip_tags(__($slide['title'])) . '</a>' : '';
					$imgs .= (!empty($slide['txt']) OR $slide['url'] != '#') ? '"' : '';
					$imgs .= '},';
				}

				$js = '<script type="text/javascript">';
				$js .= '
//<![CDATA[
jQuery(document).ready(function($) {
	var wpadminbarHeight = 0;
	if ($("#wpadminbar").length) wpadminbarHeight = $("#wpadminbar").height();
	$("#ef-header").attr("style", "height:" + ($(window).height() - wpadminbarHeight) + "px !important;");
	$.supersized({
		slide_interval		:   ' . self::$_vars['delay2'] . ',
		transition			:   "' . self::$_vars['effect2'] . '",
		transition_speed	:	' . self::$_vars['animation_time2'] . ',
		slide_links			:	"blank",
		slides				:  	[
			' . trim($imgs, ',') . '
		],
	});
});
//]]>
				';
				$js .= '</script>';

				echo ($this->getSlidesCount() > 1) ? '<a id="prevslide" class="load-item"></a>' : '';
				echo ($this->getSlidesCount() > 1) ? '<a id="nextslide" class="load-item"></a>' : '';
				echo '<div id="slidecaption"></div>';
				echo '<div id="controls-wrapper" class="load-item">';
					echo '<div id="controls"><ul id="slide-list"></ul></div>';
				echo '</div>';
				echo $js;
			} else {
				echo '<div class="main-ctrl-container ef-breadcrumbs"><div style="width:50%;margin:0 auto;">' . sg_message(__('No Slides in Slider', SG_TDN)) . '</div></div>';
			}
		}
	}

}