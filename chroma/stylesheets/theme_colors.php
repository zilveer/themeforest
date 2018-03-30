<?php
function t2t_theme_colors() {

	if(get_theme_mod("t2t_customizer_page_header_background") != "") {
		$page_header = get_theme_mod("t2t_customizer_page_header_background_color", "#777777")." url('".get_theme_mod("t2t_customizer_page_header_background")."') ".get_theme_mod("t2t_customizer_page_header_background_repeat");
	} else {
		if(!is_page_template('template-fullscreen.php')) {
			$page_header = get_theme_mod("t2t_customizer_page_header_background_color", "#777777");
		} else {
			$page_header = "";
		}
	}

	$hover_rgba = "30,124,139";
	if(class_exists("T2T_Toolkit")) {
		$hover_rgba = T2T_Toolkit::hex_to_rgba(get_theme_mod("t2t_customizer_accent_color", "#278ea9"));
	}


	$rules = array(
		array(
			"rule" => "div.album div .hover, div.albums div .hover",
			"atts" => array(
				"background" => "rgba($hover_rgba, 0.9)"
			)
		),
		array(
			"rule" => "header#vertical .logo a",
			"atts" => array(
				"height" => get_theme_mod("t2t_customizer_logo_height")."px",
				"line-height" => get_theme_mod("t2t_customizer_logo_height")."px"
			)
		),
		array(
			"rule" => "header .logo a",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_logo_color")
			)
		),
		array(
			"rule" => "body",
			"atts" => array(
				"background" => get_theme_mod("t2t_customizer_body_background_color", "#f3f3f3")." url('".get_theme_mod("t2t_customizer_body_background")."') ".get_theme_mod("t2t_customizer_body_background_repeat"),
			)
		),
		array(
			"rule" => ".menu, header#horizontal.stuck .wrapper, .menu, header#horizontal.stuck",
			"atts" => array(
				"background" => get_theme_mod("t2t_customizer_menu_background_color")
			)
		),
		array(
			"rule" => ".menu a, header#horizontal nav ul.main-menu li a",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_menu_link_color")
			)
		),
		array(
			"rule" => ".menu a:hover, header#horizontal nav ul.main-menu li a:hover",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_menu_link_hover_color")
			)
		),
		array(
			"rule" => "#menuToggle",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_header_menu_link_color"),
				"border-color" => get_theme_mod("t2t_customizer_header_menu_link_color")
			)
		),
		array(
			"rule" => "#menuToggle:hover",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_header_menu_link_hover_color"),
				"border-color" => get_theme_mod("t2t_customizer_header_menu_link_hover_color")
			)
		),
		array(
			"rule" => ".page_title, header",
			"atts" => array(
				"background" => $page_header
			)
		),
		array(
			"rule" => ".page_wrap",
			"atts" => array(
				"background" => get_theme_mod("t2t_customizer_page_background_color", "#ffffff")." url('".get_theme_mod("t2t_customizer_page_background")."') ".get_theme_mod("t2t_customizer_page_background_repeat"),
			)
		),
		array(
			"rule" => "footer",
			"atts" => array(
				"background" => get_theme_mod("t2t_customizer_footer_background_color", "#ffffff")." url('".get_theme_mod("t2t_customizer_footer_background")."') ".get_theme_mod("t2t_customizer_footer_background_repeat"),
			)
		),
		array(
			"rule" => "div.page_title h1",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_page_title_text_color")
			)
		),
		array(
			"rule" => "body",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_body_text_color")
			)
		),
		array(
			"rule" => "p",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_paragraph_color")
			)
		),
		array(
			"rule" => ".page_content a",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_content_link_color")
			)
		),
		array(
			"rule" => ".page_content a:hover",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_content_link_hover_color")
			)
		),
		array(
			"rule" => "article",
			"atts" => array(
				"background" => get_theme_mod("t2t_customizer_content_box_background_color"),
				"border-color" => get_theme_mod("t2t_customizer_content_box_border_color")
			)
		),
		array(
			"rule" => "div.widget h5",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_sidebar_text_color")
			)
		),
		array(
			"rule" => "div.widget a",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_sidebar_link_color")
			)
		),
		array(
			"rule" => "div.widget a:hover",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_sidebar_link_hover_color")
			)
		),
		array(
			"rule" => "footer #footer-sidebar h5",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_footer_title_color")
			)
		),
		array(
			"rule" => "footer p, footer .textwidget",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_footer_text_color")
			)
		),
		array(
			"rule" => "footer a, footer div.widget a",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_footer_link_color")
			)
		),
		array(
			"rule" => "footer a:hover, footer div.widget a:hover",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_footer_link_hover_color")
			)
		),
		array(
			"rule" => "p.form-submit input#submit, .comment-reply-link, #searchform #searchsubmit, .sl-slide-inner a, .ei-title a, input.wpcf7-submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #review_form #submit, .woocommerce span.onsale, .woocommerce-page span.onsale",
			"atts" => array(
				"background" => get_theme_mod("t2t_customizer_accent_color")
			)
		),
		array(
			"rule" => ".blockquote",
			"atts" => array(
				"border-color" => get_theme_mod("t2t_customizer_accent_color")
			)
		),
		array(
			"rule" => ".dropcap",
			"atts" => array(
				"background" => get_theme_mod("t2t_customizer_accent_color")
			)
		),
		array(
			"rule" => ".woocommerce .price",
			"atts" => array(
				"color" => get_theme_mod("t2t_customizer_accent_color")
			)
		),
		array(
			"rule" => ".pace .pace-progress",
			"atts" => array(
				"background" => get_theme_mod("t2t_customizer_accent_color")
			)
		),
		array(
			"rule" => ".slide-content .link",
			"atts" => array(
				"color" => "#ffffff"
			)
		),
		array(
			"rule" => ".post_pagination span",
			"atts" => array(
				"background" => get_theme_mod("t2t_customizer_accent_color"),
				"color" => "#ffffff"
			)
		),
		array(
			"rule" => ".post_pagination a span",
			"atts" => array(
				"background" => "#eaeaea",
				"color" => "#999999"
			)
		)
	);
	 
	echo "<style type=\"text/css\">";

	foreach($rules as $rule) {

		$attributes = array();

		foreach($rule["atts"] as $property => $value) {
			if(!empty($property)) {
				$attributes[$property] = $value;
			}
		}
		
		if(!empty($attributes)) {

			echo $rule["rule"] . "{\n";
		
			foreach($attributes as $property => $value) {
				echo "  " . $property . ": " . $value . " !important;\n";
			}
		
			echo "}\n";
		}

	}

	echo "</style>";

}
add_action('wp_head', 't2t_theme_colors');

?>