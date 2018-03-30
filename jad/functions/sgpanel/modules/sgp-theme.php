<?php

class SGP_Theme_Module extends SGP_Module {

	const moduleName = 'Theme';

	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'first_color' => array(
				'name' => __('Primary Color', SG_TDN),
				'type' => 'color',
				'default' => '#df6565',
				'help' => __('Main theme color', SG_TDN),
			),
			'second_color' => array(
				'name' => __('Secondary Color', SG_TDN),
				'type' => 'color',
				'default' => '#f27864',
				'help' => __('Second theme color', SG_TDN),
			),
			'third_color' => array(
				'name' => __('Third Color', SG_TDN),
				'type' => 'color',
				'default' => '#ffb6b6',
				'help' => __('You need to set this color which will be applied to different
				elements locate on dark sections of the page (Footer, Dropdown Menu, etc.)', SG_TDN),
			),
			'fourth_color' => array(
				'name' => __('Fourth Color', SG_TDN),
				'type' => 'color',
				'default' => '#ffb3a6',
				'help' => __('You need to set this color which will be applied to different
				elements locate on dark sections of the page (Footer, Dropdown Menu, etc.)', SG_TDN),
			),
			'body_color' => array(
				'name' => __('Body color', SG_TDN),
				'type' => 'color',
				'default' => '#ffffff',
				'help' => __('Body background color', SG_TDN),
			),
			'header_color' => array(
				'name' => __('Header color', SG_TDN),
				'type' => 'color',
				'default' => '#f2f2f2',
				'help' => __('Body background color', SG_TDN),
			),
			'header_pattern' => array(
				'name' => __('Header Image', SG_TDN),
				'type' => 'select',
				'options' => array(
					'yes' => __('Show', SG_TDN),
					'no' => __('Hide', SG_TDN),
				),
				'default' => 'yes',
				'help' => __('Show or hide default pattern in the header', SG_TDN),
			),
			'pattern' => array(
				'name' => __('Creative Mode', SG_TDN),
				'type' => 'select',
				'options' => array(
					'yes' => __('Enable', SG_TDN),
					'no' => __('Disable', SG_TDN),
				),
				'default' => 'no',
				'help' => __('Add stripes to Body and Footer background', SG_TDN),
			),
			'bg_images' => array(
				'name' => __('Body background', SG_TDN),
				'type' => 'bgs',
				'class' => 'sg-metabox-field sg-metabox-slides2',
				'default' => array(
					'value' => self::USE_NONE,
					'slides' => array(),
				),
				'help' => __('Upload your images, set the position and image properties. You are able to use many images here', SG_TDN),
			),
			'font_type' => array(
				'name' => __('Font Type', SG_TDN),
				'type' => 'checkbox',
				'options' => array(
					'latin' => __('Latin', SG_TDN),
					'latin-ext' => __('Latin Ext', SG_TDN),
					'cyrillic' => __('Cyrillic', SG_TDN),
					'cyrillic-ext' => __('Cyrillic Ext', SG_TDN),
					'greek' => __('Greek', SG_TDN),
					'greek-ext' => __('Greek Ext', SG_TDN),
					'vietnamese' => __('Vietnamese', SG_TDN),
				),
				'default' => 'latin',
				'help' => __('Select language support to exclude unnecessary fonts from the selection
				list', SG_TDN),
			),
			'hfont' => array(
				'name' => __('Heading Font', SG_TDN),
				'type' => 'select',
				'options' => array(
					'Podkova' => 'Podkova',
					'Signika' => 'Signika',
					'PT+Sans+Narrow' => 'PT Sans Narrow',
					'Economica' => 'Economica',
					'Oswald' => 'Oswald',
					'Yanone+Kaffeesatz' => 'Yanone Kaffeesatz',
					'Merriweather' => 'Merriweather',
					'Cuprum' => 'Cuprum',
					'Advent+Pro' => 'Advent Pro',
					'Ubuntu+Condensed' => 'Ubuntu Condensed',
					'Open+Sans+Condensed' => 'Open Sans Condensed',
					'Helvetica' => 'Helvetica',
					'Arial' => 'Arial',
				),
				'default' => 'Signika',
				'help' => __('Heading Font', SG_TDN),
			),
			'dfont' => array(
				'name' => __('Descriptions Font', SG_TDN),
				'type' => 'select',
				'options' => array(
					'TeXGyreCursorRegular' => 'TeXGyreCursor',
					'Signika' => 'Signika',
					'PT+Sans+Narrow' => 'PT Sans Narrow',
					'Economica' => 'Economica',
					'Oswald' => 'Oswald',
					'Yanone+Kaffeesatz' => 'Yanone Kaffeesatz',
					'Merriweather' => 'Merriweather',
					'Cuprum' => 'Cuprum',
					'Advent+Pro' => 'Advent Pro',
					'Ubuntu+Condensed' => 'Ubuntu Condensed',
					'Open+Sans+Condensed' => 'Open Sans Condensed',
					'Helvetica' => 'Helvetica',
					'Arial' => 'Arial',
				),
				'default' => 'Signika',
				'help' => __('Descriptions Font', SG_TDN),
			),
			'cfont' => array(
				'name' => __('Content Font', SG_TDN),
				'type' => 'select',
				'options' => array(
					'Ubuntu' => 'Ubuntu',
					'Helvetica' => 'Helvetica',
					'Merriweather' => 'Merriweather',
					'PT+Sans' => 'PT Sans',
					'Open+Sans' => 'Open Sans',
					'Istok+Web' => 'Istok Web',
					'Arial' => 'Arial',
					'Georgia' => 'Georgia',
				),
				'default' => 'Ubuntu',
				'help' => __('Content Font', SG_TDN),
			),
		);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SGP_Theme_Module;
		}
		return self::$instance;
	}

	public function inited()
	{
		return !is_null(self::$_vars);
	}

	public function initVars($params, $defaults)
	{
		self::$_vars = self::_initVars(self::moduleName, self::$_params, self::$_fields, $params, $defaults);
		return TRUE;
	}

	public function setVars($post_data)
	{
		$px = self::_getPx('sgp_', self::moduleName);

		if (isset($post_data[$px . '_bg_images']['slides'])) {
			$slides = $post_data[$px . '_bg_images']['slides'];
			foreach ($slides as $id => $slide) {
				if (!isset($slide['img']) OR empty($slide['img']) OR $slide['img'] == -1) {
					unset($post_data[$px . '_bg_images']['slides'][$id]);
				}
			}
		} else {
			$post_data[$px . '_bg_images']['slides'] = array();
		}
		if (empty($post_data[$px . '_bg_images']['slides'])) {
			$post_data[$px . '_bg_images']['value'] = self::USE_NONE;
			$post_data[$px . '_bg_images']['slides'] = array();
			$post_data[$px . '_bg_images']['last'] = 0;
		} else {
			$post_data[$px . '_bg_images']['value'] = self::USE_DEFAULT;
		}

		return self::_setVars(self::moduleName, self::$_fields, $post_data);
	}

	public function resetVars()
	{
		return self::_resetVars(self::moduleName);
	}

	protected function _getColorField($uid, $params, $value, $default, $ug)
	{
		$c = SG_Form::input($uid, $value, array('id' => 'link-color-' . $uid));
		$c .= '<a href="#" class="sg-pickcolor hide-if-no-js" id="link-color-example-' . $uid . '"></a>';
		$c .= '<div id="colorPickerDiv-' . $uid . '" class="sg-colorPickerDiv"></div>';

		$c .= '<script type="text/javascript">';
		$c .= '
//<![CDATA[
jQuery(document).ready(function($){
	var farbtastic_' . $uid . ';
	(function($){
		var pickColor_' . $uid . ' = function(a) {
			farbtastic_' . $uid . '.setColor(a);
			$("#link-color-' . $uid . '").val(a.toUpperCase());
			$("#link-color-example-' . $uid . '").css("background-color", a);
			' . ($uid == 'sgp_Theme_body_color' ? 'sg_sgp_bg_color = a;' : '') .
				($uid == 'sgp_Theme_body_color' ? '$(".sg-slide-img-p").css("background-color", a);' : '') .
		'};

		$(document).ready( function() {
			if ($("#colorPickerDiv-' . $uid . '").size() > 0) {
				farbtastic_' . $uid . ' = $.farbtastic("#colorPickerDiv-' . $uid . '", pickColor_' . $uid . ');
				pickColor_' . $uid . '( $("#link-color-' . $uid . '").val() );

				$("#link-color-example-' . $uid . '").click( function(e) {
					$("#colorPickerDiv-' . $uid . '").show();
					e.preventDefault();
				});

				$("#link-color-' . $uid . '").keyup( function() {
					var a = $("#link-color-' . $uid . '").val(),
						b = a;
					a = a.replace(/[^a-fA-F0-9]/, "");
					if ( "#" + a !== b )
						$("#link-color-' . $uid . '").val(a);
					if ( a.length === 3 || a.length === 6 )
						pickColor_' . $uid . '( "#" + a );
				});

				$(document).mousedown( function() {
					$(".sg-colorPickerDiv").hide();
				});
			}
		});
	})(jQuery);
});
//]]>
			';
		$c .= '</script>';

		return $c;
	}

	protected function _getBGsField($uid, $params, $value, $default, $ug)
	{
		global $post_ID;
		$nonce = wp_create_nonce('set_post_thumbnail-' . (empty($post_ID) ? 0 : $post_ID));
		$btn_name = __('Get Image', SG_TDN);
		$ajax_url = get_template_directory_uri() . '/functions/modules/includes/image/ajax.php';

		$slides = (isset($value['slides'])) ? $value['slides'] : array();
		$last = (isset($value['last'])) ? $value['last'] : 0;

		$c = '';

		$ropt = array(
			'no-repeat' => 'no repeat',
			'repeat' => 'repeat',
			'repeat-x' => 'repeat x',
			'repeat-y' => 'repeat y',
		);

		$fopt = array(
			'' => 'scroll',
			'fixed' => 'fixed',
		);

		foreach ($slides as $id => $slide) {
			$c .= '<div class="sg-slide-top">';
				$c .= '<div class="sg-slide">';
					$c .= '<div class="sg-slide-in" id="' . $uid . '-' . $id . '" rel="' . $uid . '[slides][' . $id . ']">';
						$c .= '<a class="button sg-slide-rm ' . $uid . '-rm" href="#">-</a>';
						$c .= '<div class="sg-slide-img-b">';
							$c .= wp_get_attachment_image($slide['img'], 'post-thumbnail');
							$c .= SG_Form::radio($uid . '[slides][' . $id . '][value]', 'left top', 'left top' == $slide['value'], array('class' => 'sg-fbg-lt'));
							$c .= SG_Form::radio($uid . '[slides][' . $id . '][value]', 'left center', 'left center' == $slide['value'], array('class' => 'sg-fbg-lc'));
							$c .= SG_Form::radio($uid . '[slides][' . $id . '][value]', 'left bottom', 'left bottom' == $slide['value'], array('class' => 'sg-fbg-lb'));
							$c .= SG_Form::radio($uid . '[slides][' . $id . '][value]', 'center top', 'center top' == $slide['value'], array('class' => 'sg-fbg-ct'));
							$c .= SG_Form::radio($uid . '[slides][' . $id . '][value]', 'center center', 'center center' == $slide['value'], array('class' => 'sg-fbg-cc'));
							$c .= SG_Form::radio($uid . '[slides][' . $id . '][value]', 'center bottom', 'center bottom' == $slide['value'], array('class' => 'sg-fbg-cb'));
							$c .= SG_Form::radio($uid . '[slides][' . $id . '][value]', 'right top', 'right top' == $slide['value'], array('class' => 'sg-fbg-rt'));
							$c .= SG_Form::radio($uid . '[slides][' . $id . '][value]', 'right center', 'right center' == $slide['value'], array('class' => 'sg-fbg-rc'));
							$c .= SG_Form::radio($uid . '[slides][' . $id . '][value]', 'right bottom', 'right bottom' == $slide['value'], array('class' => 'sg-fbg-rb'));
							$c .= SG_Form::select($uid . '[slides][' . $id . '][value1]', $fopt, $slide['value1'], array('class' => 'sg-fbg-fep'));
							$c .= SG_Form::select($uid . '[slides][' . $id . '][value2]', $ropt, $slide['value2'], array('class' => 'sg-fbg-rep'));
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
		sg_pbgs_btn_name = "' . $btn_name . '";
		sg_slider_ajaxurl = "' . $ajax_url . '";
		var pID = jQuery("#post_ID").val() || 0;
		window.sg_current_upload_slide = $(cur).parent().attr("id");
		tb_show("Insert", "media-upload.php?post_id=" + pID + "&custom-media-upload=PBG&type=image&TB_iframe=true");
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

	public function getAdminContent($params, $defaults)
	{
		$c = self::_getAdminContent(self::moduleName, self::$_params, self::$_fields, self::$_description, $params, $defaults);

		$c .= '<script type="text/javascript">';
		$c .= '
//<![CDATA[
jQuery(document).ready(function($){
	function sgp_set_fonts_type(){
		var cft = [];

		$("input[name=\'sgp_Theme_font_type[]\']:checked").each(function(){
			cft.push($(this).val());
		});

		var ft = {
			"Signika" : ["latin","latin-ext"],
			"Economica" : ["latin","latin-ext"],
			"Oswald" : ["latin","latin-ext"],
			"Yanone+Kaffeesatz" : ["latin"],
			"TeXGyreCursorRegular" : ["latin"],
			"Podkova" : ["latin"],
			"Merriweather" : ["latin"],
			"PT+Sans+Narrow" : ["latin","cyrillic","latin-ext"],
			"Cuprum" : ["latin","cyrillic"],
			"Advent+Pro" : ["latin","greek","latin-ext"],
			"Ubuntu+Condensed" : ["latin","cyrillic-ext","greek-ext","greek","latin-ext","cyrillic"],
			"Open+Sans+Condensed" : ["latin","cyrillic-ext","greek-ext","greek","latin-ext","vietnamese","cyrillic"],
			"Open+Sans" : ["latin","cyrillic-ext","greek-ext","greek","latin-ext","vietnamese","cyrillic"],
			"PT+Sans" : ["latin","latin-ext","cyrillic","cyrillic-ext"],
			"Istok+Web" : ["latin","latin-ext","cyrillic","cyrillic-ext"],
			"Ubuntu" : ["latin","cyrillic-ext","greek-ext","greek","latin-ext","cyrillic"],
			"Georgia" : ["latin","cyrillic-ext","greek-ext","greek","latin-ext","vietnamese","cyrillic"],
			"Helvetica" : ["latin","cyrillic-ext","greek-ext","greek","latin-ext","vietnamese","cyrillic"],
			"Arial" : ["latin","cyrillic-ext","greek-ext","greek","latin-ext","vietnamese","cyrillic"]
		};

		$("select[name=sgp_Theme_hfont] option").each(function(){
			var found = false;
			$(this).attr("disabled", false);
			for (key1 in cft) {
				found = false;
				for (key2 in ft[$(this).val()]) {
					if (cft[key1] == ft[$(this).val()][key2]) {
						found = true;
						break;
					}
				}
				if (!found) {
					$(this).attr("disabled", true);
					break;
				}
			}
		});

		$("select[name=sgp_Theme_cfont] option").each(function(){
			var found = false;
			$(this).attr("disabled", false);
			for (key1 in cft) {
				found = false;
				for (key2 in ft[$(this).val()]) {
					if (cft[key1] == ft[$(this).val()][key2]) {
						found = true;
						break;
					}
				}
				if (!found) {
					$(this).attr("disabled", true);
					break;
				}
			}
		});

		$("select[name=sgp_Theme_dfont] option").each(function(){
			var found = false;
			$(this).attr("disabled", false);
			for (key1 in cft) {
				found = false;
				for (key2 in ft[$(this).val()]) {
					if (cft[key1] == ft[$(this).val()][key2]) {
						found = true;
						break;
					}
				}
				if (!found) {
					$(this).attr("disabled", true);
					break;
				}
			}
		});
	}

	function sgp_set_fonts_type_c(){
		sgp_set_fonts_type();
		$("select[name=sgp_Theme_hfont] option:enabled:first").attr("selected", true);
		$("select[name=sgp_Theme_cfont] option:enabled:first").attr("selected", true);
		$("select[name=sgp_Theme_dfont] option:enabled:first").attr("selected", true);
	}

	$("input[name=\'sgp_Theme_font_type[]\']:first").attr("checked", "checked").attr("disabled", "true");
	sgp_set_fonts_type(true);

	$("input[name=\'sgp_Theme_font_type[]\']").click(sgp_set_fonts_type_c);
});
//]]>
			';
		$c .= '</script>';

		return $c;
	}

	public function eCSS()
	{
		if (!_sg('Modules')->enabled('Theme'))	return;

		$acolor = self::$_vars['first_color'];
		$scolor = self::$_vars['second_color'];
		$tcolor = self::$_vars['third_color'];
		$fcolor = self::$_vars['fourth_color'];
		$bcolor = self::$_vars['body_color'];
		$hcolor = self::$_vars['header_color'];

		$pn = (self::$_vars['pattern'] == 'yes') ? 'url("' . get_template_directory_uri() . '/images/body-bg.gif") fixed ' : '';
		$pn2 = (self::$_vars['pattern'] == 'yes') ? '' : '.expandable-inner {background-image: none;}' . "\n";

		$cfont = '"' . str_replace('+', ' ', self::$_vars['cfont']) . '"' . (self::$_vars['cfont'] != 'Arial' ? ', Arial' : '');
		$hfont = '"' . str_replace('+', ' ', self::$_vars['hfont']) . '"' . (self::$_vars['cfont'] != 'San-Serif' ? ', "sans-serif"' : '');
		$dfont = '"' . str_replace('+', ' ', self::$_vars['dfont']) . '"' . (self::$_vars['dfont'] != 'San-Serif' ? ', "sans-serif"' : '');

		$fonts = array(
			'Signika' => ':400,300,600,700',
			'PT+Sans+Narrow' => ':400,700',
			'Economica' => ':400,700,400italic,700italic',
			'Oswald' => ':400,300',
			'Yanone+Kaffeesatz' => ':400,300,200',
			'Podkova' => ':400,700',
			'Merriweather' => ':400,700',
			'Cuprum' => '',
			'Advent+Pro' => ':400,100,200,300,500,600,700',
			'Ubuntu+Condensed' => '',
			'Open+Sans+Condensed' => ':700,300,300italic',
			'Open+Sans' => ':400,300,300italic,400italic,600,600italic,700,700italic,800,800italic',
			'PT+Sans' => ':400,700,400italic,700italic',
			'Istok+Web' => ':400,400italic,700,700italic',
			'Ubuntu' => ':400,300,300italic,400italic,500,500italic,700,700italic',
			'Georgia' => 'Georgia',
			'Helvetica' => 'Helvetica',
			'Arial' => 'Arial',
			'TeXGyreCursorRegular' => 'TeXGyreCursorRegular',
		);

		$fontscex = array(
			'Signika' => '',
			'PT+Sans+Narrow' => '',
			'Economica' => '',
			'Oswald' => '',
			'Yanone+Kaffeesatz' => '',
			'Podkova' => '',
			'Merriweather' => '',
			'Cuprum' => '',
			'Advent+Pro' => '',
			'Ubuntu+Condensed' => '',
			'Open+Sans+Condensed' => '',
			'Open+Sans' => '',
			'PT+Sans' => '',
			'Istok+Web' => '',
			'Ubuntu' => '',
			'Georgia' => '',
			'Helvetica' => '',
			'Arial' => '',
			'TeXGyreCursorRegular' => '',
		);

		echo '<style type="text/css">';
			echo 'body, .ef-fullscreen #ef-content-wrap {background: ' . $pn . $bcolor . ';}' . "\n";
			echo '#ef-header {background-color: ' . $hcolor . ';}' . "\n";
			echo $pn2;
			echo "\n";
			echo 'h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .sf-menu li.current a, #main-slider ul.slides li .ef-big-text span, .ef-big-text a, .ef-button.ef-link, .ef-button.ef-link.ef-theme:hover, .ef-footer a:hover, .ef-blog-post:hover .ef-date-comments div:first-child, .ef-breadcrumbs li a, p a, a.comment-reply-link, .recentcomments a:first-child, .widget_calendar a, .dark-cond-top .sf-menu li.current a, .dark-cond-top ul.sf-menu li a:hover, .ef-button.ef-link.ef-gray:hover, .ef-read-more, .sf-menu li.current_page_ancestor a, .sf-menu li.current-menu-ancestor a {color:' . $acolor . ';}' . "\n";
			echo '.ef-pagination a.page-active {border-color:' . $acolor . ';}' . "\n";
			echo '.ef-button:hover, .ef-button.ef-theme, a.pp_close, .totop, span.ef-first.ef-first-col, .ef-twitter-module, .ef-open-close.ef-close:hover, .ef-open-close, .ef-fixed .bold-divider, .ef-form div.send-wrap div input, .ef-fullscreen .ef-slide-link, .ef-button.ef-gray:hover, span.highlight-hl-theme, div.bold-divider div:nth-child(2n), div.bold-divider div:first-child + *, div.bold-divider div:first-child + * + * + * {background-color:' . $acolor . ';}' . "\n";
			echo "\n";
			echo '.ef-extras .ef-col1-4:hover .extras-descrp, .ef-button.ef-link:hover, .ef-button.ef-link.ef-theme, .ef-big-text a:hover, .ef-blog-post:hover h4 a, .ef-team-social a:hover, a.p-current, li.p-current, li.p-current a, .ef-sidebar a:hover, .ef-default .sf-menu a:hover, a.comment-reply-link:hover, .ef-read-more:hover, p a:hover, li a:hover, .widget_nav_menu .current-menu-item a {color:' . $scolor . ';}' . "\n";
			echo 'blockquote.blockquote-right, .testimonials.ef-xxl, .ef-tabs ul.tabs-nav li.ui-tabs-selected a, #ef-main a.inactive, .main-ctrl-container ul.flex-direction-nav li a:hover {border-color:' . $scolor . ';}' . "\n";
			echo '.ef-button, .ef-button.ef-theme:hover, a.pp_close:hover, .ef-progress-bar span span, .ef-button.ef-dark-btn:hover, .ef-tabs ul.tabs-nav li.ui-tabs-selected a, .price-item.recomended .price-tag span, .ef-menu-wrapper.ef-fixed, .ef-form div.send-wrap div input:hover, table#wp-calendar caption, .ef-fullscreen .ef-slide-link:hover {background-color:' . $scolor . ';}' . "\n";
			echo "\n";
			echo '.proj-img div.proj-description p a:hover, .viewer li .caption, .ef-tweet-module .tweet_text {color:' . $tcolor . ';}' . "\n";
			echo '.sf-menu li li.current_page_item > a, .sf-menu li li.current-menu-item > a, .sf-menu li.current_page_ancestor > a, .sf-menu li.current-menu-ancestor > a {border-color:' . $tcolor . ';}' . "\n";
			echo "\n";
			echo '.proj-img div.proj-description h4 a, .ef-footer a:hover, .ef-tweet-module a:hover, .ef-fixed .sf-menu li a:hover, .ef-fixed .sf-menu li.current a, .ef-fixed .sf-menu li:hover > a, .dark-cond-top .ef-fixed .sf-menu li:hover > a, .ef-fixed .sf-menu li.current_page_ancestor a, .ef-fixed .sf-menu li.current-menu-ancestor a, .ef-fixed .sf-menu li.current-menu-ancestor.current a {color:' . $fcolor . ';}' . "\n";
			echo '.sf-menu li li a:hover, .sf-menu li:hover > a, .proj-img div.proj-description h4 a:hover, .tagcloud a:hover {border-color:' . $fcolor . ';}' . "\n";
			echo '.tagcloud a:hover, .ef-post-slider .flex-control-nav li a.flex-active {background-color:' . $fcolor . ';}' . "\n";
			echo "\n";
			echo 'div.bold-divider {';
			echo 'background: -moz-linear-gradient(left, ' . $scolor . ' 0%, ' . $scolor . ' 25%, ' . $acolor . ' 25%, ' . $acolor . ' 50%, ' . $scolor . ' 50%, ' . $scolor . ' 75%, ' . $acolor . ' 75%, ' . $acolor . ' 100%);';
			echo 'background: -webkit-gradient(linear, left top, right top, color-stop(0%,' . $scolor . '), color-stop(25%,' . $scolor . '), color-stop(25%,' . $acolor . '), color-stop(50%,' . $acolor . '), color-stop(50%,' . $scolor . '), color-stop(75%,' . $scolor . '), color-stop(75%,' . $acolor . '), color-stop(100%,' . $acolor . '));';
			echo 'background: -webkit-linear-gradient(left, ' . $scolor . ' 0%,' . $scolor . ' 25%,' . $acolor . ' 25%,' . $acolor . ' 50%,' . $scolor . ' 50%,' . $scolor . ' 75%,' . $acolor . ' 75%,' . $acolor . ' 100%);';
			echo 'background: -o-linear-gradient(left, ' . $scolor . ' 0%,' . $scolor . ' 25%,' . $acolor . ' 25%,' . $acolor . ' 50%,' . $scolor . ' 50%,' . $scolor . ' 75%,' . $acolor . ' 75%,' . $acolor . ' 100%);';
			echo 'background: -ms-linear-gradient(left, ' . $scolor . ' 0%,' . $scolor . ' 25%,' . $acolor . ' 25%,' . $acolor . ' 50%,' . $scolor . ' 50%,' . $scolor . ' 75%,' . $acolor . ' 75%,' . $acolor . ' 100%);';
			echo 'background: linear-gradient(to right, ' . $scolor . ' 0%,' . $scolor . ' 25%,' . $acolor . ' 25%,' . $acolor . ' 50%,' . $scolor . ' 50%,' . $scolor . ' 75%,' . $acolor . ' 75%,' . $acolor . ' 100%);';
			echo 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="' . $scolor . '", endColorstr="' . $acolor . '",GradientType=1 );';
			echo '}';
			echo "\n";
			echo "\n";
			echo 'body, .ef-form, .ef-form input, .ef-form textarea, .ef-tweet-module .tweet_text, .ef-fullscreen #slidecaption h1, .ef-fullscreen #slidecaption h2, .ef-fullscreen #slidecaption h3, .ef-fullscreen #slidecaption h4, .ef-fullscreen #slidecaption h5, .ef-fullscreen #slidecaption h6, .ef-fullscreen .ef-slide-link {font-family:' . $cfont . '}' . "\n";
			echo 'h1, h2, h3, h4, #main-slider ul.slides li .ef-big-text, .ef-breadcrumbs p, p.first-paragraph, table th, .price-table .price-title, .testimonials .ef-author span, .viewer li .caption, blockquote, .ef-fullscreen #slidecaption {font-family:' . $hfont . '}' . "\n";
			echo 'h5, .extras-descrp, .proj-description p a, .divider-title, .ef-progress-bar, .testimonials .ef-author, .ef-date-comments div span, .ef-tabs ul.tabs-nav li a, .ef-tweet-module .tweet_time, .comments-list .post-comm div.auth span {font-family:' . $dfont . '}' . "\n";
			echo "\n";
			if ($fontscex[self::$_vars['cfont']] != '') echo $fontscex[self::$_vars['cfont']];
		echo '</style>';

		echo '<script type="text/javascript">sg_template_color = "' . $acolor . '";</script>';

		if ($fonts[self::$_vars['cfont']] != self::$_vars['cfont']) {
			$subset = is_array(self::$_vars['font_type']) ? self::$_vars['font_type'] : array(self::$_vars['font_type']);
			$subset = implode(',', $subset);
			$subset = ($subset != 'latin') ? '&amp;subset=' . $subset : '';
			echo '<link href="http://fonts.googleapis.com/css?family=' . self::$_vars['cfont'] . $fonts[self::$_vars['cfont']] . $subset . '" rel="stylesheet" type="text/css" />';
		}

		if ($fonts[self::$_vars['dfont']] != self::$_vars['dfont']) {
			$subset = is_array(self::$_vars['font_type']) ? self::$_vars['font_type'] : array(self::$_vars['font_type']);
			$subset = implode(',', $subset);
			$subset = ($subset != 'latin') ? '&amp;subset=' . $subset : '';
			echo '<link href="http://fonts.googleapis.com/css?family=' . self::$_vars['dfont'] . $fonts[self::$_vars['dfont']] . $subset . '" rel="stylesheet" type="text/css" />';
		}

		if ($fonts[self::$_vars['hfont']] != self::$_vars['hfont']) {
			$subset = is_array(self::$_vars['font_type']) ? self::$_vars['font_type'] : array(self::$_vars['font_type']);
			$subset = implode(',', $subset);
			$subset = ($subset != 'latin') ? '&amp;subset=' . $subset : '';
			echo '<link href="http://fonts.googleapis.com/css?family=' . self::$_vars['hfont'] . $fonts[self::$_vars['hfont']] . $subset . '" rel="stylesheet" type="text/css" />';
		}
	}

	public function eBGsh()
	{
		if (self::$_vars['bg_images']['value'] == self::USE_DEFAULT) {
			foreach (self::$_vars['bg_images']['slides'] as $id => $slide) {
				echo '<div class="sg-top-bg" style="background: url(\'' . wp_get_attachment_url($slide['img']) . '\') ' . $slide['value'] . ' ' . $slide['value2'] . ' ' . $slide['value1'] . ';">';
			}
		}
	}

	public function eBGsf()
	{
		if (self::$_vars['bg_images']['value'] == self::USE_DEFAULT) {
			foreach (self::$_vars['bg_images']['slides'] as $id => $slide) {
				echo '</div>';
			}
		}
	}

	public function isFontface()
	{
		return (self::$_vars['dfont'] == 'TeXGyreCursorRegular');
	}

	public function showHeaderPattern()
	{
		return (self::$_vars['header_pattern'] == 'yes');
	}

}