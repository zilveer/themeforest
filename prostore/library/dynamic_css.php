<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/dynamic_css.php
 * @file	 	1.1
 *
 *	1. Global Settings
 *	2. Custom favicon
 *	3. Generator functions
 *	4. Custom typography
 *	5. Custom backgrounds
 *	6. Custom styles
 *
 */
?>
<?php
/**
 * ------------------------------------------------------------------------
 * 1.	Global Settings
 * ------------------------------------------------------------------------
 */
	function custom_head_before() {
		echo '<style>';
	}
	function custom_head_after() {
		echo '</style>';
	}
	add_action('custom_head_styles', 'custom_head_before' ,10);
	add_action('custom_head_styles', 'custom_head_after' ,30);
	if($data[$prefix.'optimize_styling']!="1") {
		add_action('custom_head_styles', 'custom_typography',15);
		add_action('custom_head_styles', 'custom_backgrounds',20);
		add_action('custom_head_styles', 'custom_add_styles',25);
	} else {
		$options = get_option('prostore_options');
		if($options['logo_image']!="") {
		add_action('custom_head_styles', 'custom_logo_spacing',25);
		if ( ! function_exists( 'custom_logo_spacing' ) ) {
			function custom_logo_spacing() {
				$options = get_option('prostore_options');
				$padding = $options["logo_spacing"];
				echo "header#top-header #branding .siteinfo #logo img {padding:".$padding."px 0;}";
				}
			}
		}
	}

/**
 * ------------------------------------------------------------------------
 * 2.	Custom favicon
 * ------------------------------------------------------------------------
 */


/**
 * ------------------------------------------------------------------------
 * 3.	Generator functions
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'generate_bg_seq' ) ) {
		function generate_bg_seq($element,$selector) {
			global $data, $prefix;
			$options = get_option('prostore_options');

			$bg_seq = "";
			$bg_col = $options["bg_".$element."_color"] != "" ? $options["bg_".$element."_color"]." " : "";
			$bg_url = $options["bg_".$element];
			if($bg_url!="") {
				$bg_rep = $options["bg_".$element."_repeat"];
				$bg_pos = $options["bg_".$element."_position"];
				$bg_att = $options["bg_".$element."_attachment"] == "Fixed" ? "fixed" : "scroll";
				$bg_url = "url(".$bg_url.") ".$bg_rep." ".$bg_pos." ".$bg_att;
			}
			if(!empty($bg_col) || !empty($bg_url)) {
				$bg_seq .= $selector . " {";
				$bg_seq .= "background:" . $bg_col . $bg_url;
				$bg_seq .= "}";
			}
			return $bg_seq;
		}
	}

	if ( ! function_exists( 'generate_typo_seq' ) ) {
		function generate_typo_seq($element,$selector) {
			global $data, $prefix, $used_gf;
			$typo_style  = $data[$prefix.'typo_'.$element]['style'];
			if($element!="link") {
				$typo_size = $data[$prefix.'typo_'.$element]['size'];
			}

			$typo_face = "";
			global $google_fonts;
			foreach ($google_fonts as $font) {
				if ( $data[$prefix.'typo_'.$element]['face'] == $font['name'] )
					$typo_face = $font['name'].$font['variant'];
			}
			if($typo_face=="") {
				$typo_face = $data[$prefix.'typo_'.$element]['face'];
			} else {
				$safe_font = str_replace( " ","+",$typo_face);
				$safe_font = str_replace( '|"','"',$safe_font);
				if(!in_array($safe_font,$used_gf)) {
					$used_gf[]=$safe_font;
					//echo ' @import url(http://fonts.googleapis.com/css?family='.$safe_font.'); ';
				}
				$typo_face = "'".$typo_face."'";
			}

			$typo_seq = $selector . " {";
			$typo_seq .= "font:".$typo_style." ".$typo_size." ".$typo_face.";";
			$typo_seq .= "color:".$data[$prefix.'typo_'.$element]['color'] .";";
			$typo_seq .= "}";
			return array($used_gf,$typo_seq);
		}
	}

	if ( ! function_exists( 'generate_format_seq' ) ) {
		function generate_format_seq($element,$element_add) {
			global $data, $prefix;
			$options = get_option('prostore_options');
			$color = $data[$prefix."format_".$element."_bg"];
			switch ($color) {
				case "white" :
					$var_bg = "#ffffff";
					$var_color = "313131";
					break;
				case "primary" :
					$var_bg = $options["accent_primary"];
					$var_color = "ffffff";
					break;
				case "secondary" :
					$var_bg = $options["accent_secondary"];
					$var_color = "313131";
					break;
				case "tertiary" :
					$var_bg = $options["accent_tertiary"];
					$var_color = "ffffff";
					break;
				case "alert" :
					$var_bg = $options["accent_alert"];
					$var_color = "ffffff";
					break;
				case "success" :
					$var_bg = $options["accent_success"];
					$var_color = "ffffff";
					break;
				case "warning" :
					$var_bg = $options["accent_warning"];
					$var_color = "ffffff";
					break;
				case "info" :
					$var_bg = $options["accent_info"];
					$var_color = "313131";
					break;
				case "inverse" :
					$var_bg = $options["accent_inverse"];
					$var_color = "ffffff";
					break;
			}
			if($element == "standart") {
				$element = "";
			} else {
				$element = ".format-".$element;
			}
			echo ".blog-post".$element." header ".$element_add." {background-color: ".$var_bg.";}";
			echo ".blog-post".$element." header,.blog-post".$element." header a ".$element_add." {color: #".$var_color."}";
		}
	}

/**
 * ------------------------------------------------------------------------
 * 4.	Custom Typography
 * ------------------------------------------------------------------------
 */

	$used_gf = array();
	if ( ! function_exists( 'custom_typography' ) ) {
		function custom_typography() {
			global $data, $prefix;

			$body_seq = generate_typo_seq('body','body');
			$h1_seq = generate_typo_seq('h1','h1');
			$h2_seq = generate_typo_seq('h2','h1');
			$h3_seq = generate_typo_seq('h3','h3');
			$h4_seq = generate_typo_seq('h4','h4');
			$h5_seq = generate_typo_seq('h5','h5');
			$h6_seq = generate_typo_seq('h6','h6');

			$gf_fonts = $h6_seq[0];
			foreach($gf_fonts as $key => $id) {
				if($id!="") {
				echo ' @import url(http://fonts.googleapis.com/css?family='.$id.'); ';
				}
			}

			echo $body_seq[1]."\n";
			echo $h1_seq[1]."\n";
			echo $h2_seq[1]."\n";
			echo $h3_seq[1]."\n";
			echo $h4_seq[1]."\n";
			echo $h5_seq[1]."\n";
			echo $h6_seq[1]."\n";
			echo 'a, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .alert-box.info,.label.info, .alert-box.secondary , .button.secondary{color:'.$data[$prefix."typo_link"].'}';
			echo 'a:hover, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {color:'.$data[$prefix."typo_link_hover"].'}';
			echo '.subheader, .subheader a {color:'.$data[$prefix."typo_body"]["color"].'}';
		}
	}

/**
 * ------------------------------------------------------------------------
 * 5.	Custom Backgrounds
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'custom_backgrounds' ) ) {
		function custom_backgrounds() {
			global $data, $prefix;
			$options = get_option('prostore_options');

			echo generate_bg_seq('helper','header#top-header #helper, header#top-header #helper .top-bar')."\n";
				if($options['helper_bar_content_color']!="") {
					echo "header#top-header #helper *:not(a) {color:".$options['helper_bar_content_color']."}";
				}
				if($options['helper_bar_content_color_link']!="") {
					echo "header#top-header #helper a {color:".$options['helper_bar_content_color_link']."}";
				}
				echo ".top-bar ul > li a:not(.button),header#top-header #helper .top-bar ul > li:hover a, header#top-header #helper .top-bar ul > li.active a .top-bar ul li.search a, .alert-box.inverse .close {color:".$data[$prefix.'helper_bar_content_color_link']."}";
			echo generate_bg_seq('header','header#top-header')."\n";
				if($options['header_content_color']!="") {
					echo "header#top-header #branding,header#top-header #branding p,header#top-header #branding h1, header#top-header #branding h2, header#top-header #branding h3, header#top-header #branding h4, header#top-header #branding h5, header#top-header #branding h6 {color:".$options['header_content_color']."}";
				}
				if($options['header_content_color_link']!="") {
					echo "header#top-header #branding, header#top-header #branding ul.top-nav.nav-bar > li a, header#top-header #branding ul.top-nav.nav-bar > li ul.flyout li a, #pageslide #responsiveMenu li a, header#top-header #branding a  {color:".$options['header_content_color_link']."}";
				}
			echo generate_bg_seq('body','body')."\n";
			echo generate_bg_seq('body_alt_one','.single-item .post_comments, .woocommerce_tabs')."\n";
			echo generate_bg_seq('body_alt_two','.post_utility, .related_products_wrapper,#contact_panel #contactBox')."\n";
				if($options['body_alt_two_content_color']!="") {
					echo ".post_utility *:not(a), .related_products_wrapper,.related_products_wrapper h1,.related_products_wrapper h2,.related_products_wrapper h3,.related_products_wrapper h4,.related_products_wrapper h5,.related_products_wrapper h6 {color:".$data[$prefix.'body_alt_two_content_color']."}";
				}
				if($options['body_alt_two_content_color_link']!="") {
					echo "* .post_utility a, .related_products_wrapper div:not(.overlay) * aa,.related_products_wrapper h1 a,.related_products_wrapper h2 a,.related_products_wrapper h3 a,.related_products_wrapper h4 a,.related_products_wrapper h5 a,.related_products_wrapper h6 a {color:".$data[$prefix.'body_alt_two_content_color_link']."}";
				}
			echo generate_bg_seq('body_alt_three','h5.product-cat-title,.single-item .post_meta,.blog-post .post_meta')."\n";
			echo generate_bg_seq('footer','.footer.widget-area')."\n";
				if($options['footer_content_color']!="") {
					echo ".footer.widget-area *:not(a) {color:".$options['footer_content_color']."}";
				}
				if($options['footer_content_color_link']!="") {
					echo ".footer.widget-area * a:not(.label) {color:".$data[$prefix.'footer_content_color_link']."}";
				}
			if(!isset($data[$prefix."home_slider_bg"])) $data[$prefix."home_slider_bg"]='';
			if(strstr($data[$prefix."home_slider_bg"],"custom_bg")!="") {
				echo generate_bg_seq('home_slider_custom','#home_slider')."\n";
			}
		}
	}

/**
 * ------------------------------------------------------------------------
 * 6.	Custom Styles
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'custom_add_styles' ) ) {
		function custom_add_styles() {
				global $data, $prefix;
				$options = get_option('prostore_options');

				echo 'ul.portfolio-filter .dropdown li a.active,ul.portfolio-filter li a.prefix.active, ul.portfolio-filter li div.child-active,a:focus,.primary-color,.tracking_alert.alert-box {color:'.$options["accent_primary"].'}';
				echo '.author-stats span.stat-posts,.tracking_alert.alert-box .icon-box,.alert-box,dl.sub-nav dd.active a,input[type="submit"],
.button,button,.button.primary,.button.disabled, .button[disabled],.button.dropdown.split:hover,.button.dropdown.split > span,dl.tabs.pill dd.active a,  .tabs.mobile dd a.active,.nav-bar > li.active:hover,div.product p.available-on-backorder,
#content div.product p.available-on-backorder,.label,.primary-bg,#contact_panel #contactBox .icon-placeholder {background-color:'.$options["accent_primary"].'}';
				echo '.secondary-color {color:'.$data[$prefix."accent_secondary"].'}';
				echo '.button.secondary,.alert-box.secondary,.label.secondary,.button.dropdown.split.secondary:hover,.button.dropdown.split.secondary > span,.secondary-bg {background-color:'.$data[$prefix."accent_secondary"].'}';
				echo '.tracking_alert.alert-box.processing,.tertiary-color {color:'.$options["accent_tertiary"].'}';
				echo '.alert-box.tertiary, .label.tertiary,.button.tertiary,.widget_layered_nav ul li.chosen a,.widget_layered_nav ul li.chosen .count,.tracking_alert.alert-box.processing .icon-box,.tertiary-bg {background-color:'.$options["accent_tertiary"].'}';
				echo '.single-item .post_comments #reviews #comments ol.commentlist li #respond #cancel-comment-reply-link ,#cancel-comment-reply a,.tracking_alert.alert-box.failed,
.tracking_alert.alert-box.cancelled,.error label, label.error,.error small, small.error,.alert-color {color:'.$options["accent_alert"].'}';
				echo '.error small, small.error,div.product p.out-of-stock,
#content div.product p.out-of-stock,div.product td.price .out-of-stock,
#content div.product td.price .out-of-stock,.tracking_alert.alert-box.failed .icon-box,
.tracking_alert.alert-box.cancelled .icon-box,.alert-box.alert,form.iwacontact span.ajax-result.error,.label.alert,.button.alert,.button.dropdown.split.alert:hover,.button.dropdown.split.alert > span,.alert-bg {background-color:'.$options["accent_alert"].'}';
				echo '.tracking_alert.alert-box.completed,
.tracking_alert.alert-box.refunded,.cart-collaterals .cart_totals .discount td,a.button.added:before,button.button.added:before,input.button.added:before,#respond input#submit.added:before,#content input.button.added:before,.success-color {color:'.$options["accent_success"].'}';
				echo '.tracking_alert.alert-box.completed .icon-box,
.tracking_alert.alert-box.refunded .icon-box,div.product .stock,
#content div.product .stock,.button.dropdown.split.success:hover ,.button.dropdown.split.success > span,.alert-box.success,form.iwacontact span.ajax-result,.label.success,.button.success,.success-bg {background-color:'.$options["accent_success"].'}';
				echo '.tracking_alert.alert-box.on-hold ,.warning-color {color:'.$options["accent_warning"].'}';
				echo '.alert-box.warning, .label.warning,.button.warning,.tracking_alert.alert-box.on-hold .icon-box,.warning-bg {background-color:'.$options["accent_warning"].'}';
				echo '.info-color {color:'.$options["accent_info"].'}';
				echo '.label.info,.alert-box.info, .info-bg {background-color:'.$options["accent_info"].'}';
				echo '.blog-post.format-quote header,.blog-post.format-quote header,.blog-post.format-quote header a,.blog-post.format-quote header blockquote p, .inverse-color {color:'.$options["accent_inverse"].'}';
				echo '.alert-box.inverse, .button.inverse, .inverse-bg {background-color:'.$options["accent_inverse"].'}';

				//,.blog-post.mini.format-quote footer,
//.blog-post.mini.format-quote footer em,
//.blog-post.mini.format-quote footer a,


				generate_format_seq('standart','');
				generate_format_seq('gallery','');
				generate_format_seq('link',', .single-item .post_content.format-link');
				generate_format_seq('image','');
				generate_format_seq('quote',', .single-item .post_content.format-quote');
				generate_format_seq('status',', .single-item .post_content.format-status');
				generate_format_seq('video','');
				generate_format_seq('audio','');

				if($data[$prefix.'custom_css']) {
					print_r($data[$prefix.'custom_css']);
				}
				/* Logo */
				if($options['logo_image']!="") {
					$padding = $options["logo_spacing"];
					echo "header#top-header #branding .siteinfo #logo img {padding:".$padding."px 0;}";
				}
		}
	}