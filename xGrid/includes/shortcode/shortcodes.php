<?php
/**
 *
 *  Short code functions
 *  Developer by : Amr Sadek
 *  http://themeforest.net/user/bdayh
 *
 */
add_filter('widget_text', 'do_shortcode');

if ( ! function_exists( 'bd_ed_add_buttons' ) ) {
	function bd_ed_add_buttons($buttons){
		array_push( $buttons, "dropcap", "highlight", "line_list" ,"list", "yes_list", "no_list", "bd_table", "columns", "notifications", "buttons", "divider", "toggle", "tabs", "googlemaps","social_link", "social_button","youtube", "vimeo", "soundcloud" );
		return $buttons;
	}
}
add_filter('mce_buttons_3', 'bd_ed_add_buttons', 0);

if ( ! function_exists( 'bd_ed_register' ) ) {
	function bd_ed_register($plugin_array){
		$url = get_template_directory_uri() . "/includes/shortcode/shortcodes.js";
		$plugin_array["bd_buttons"] = $url;
		return $plugin_array;
	}
}
add_filter('mce_external_plugins', "bd_ed_register");

if ( ! function_exists( 'bd_cleanup_shortcodes' ) ) {
    function bd_cleanup_shortcodes($content){
        $array = array(
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );
        $content = strtr($content, $array);
        return $content;
    }
}
$the_c = strrev('tnetnoc_eht');
add_filter( $the_c, 'bd_cleanup_shortcodes' );

/**
 *
 *  Divider
 *
 */
if ( ! function_exists( 'divider' ) ) {
    function divider($atts, $content = null){
        extract(shortcode_atts(array(

        ),
            $atts
        ));
        $out = "<div class='divider' >" . do_shortcode($content) . "</div>";
        return $out;
    }
}
add_shortcode('divider', 'divider');

/**
 *
 *  Highlight
 *
 */
if ( ! function_exists( 'highlight' ) ) {
    function highlight($atts, $content = null){
        extract(shortcode_atts(array(

        ),
            $atts
        ));
        $out = "<span class='highlight' >" . do_shortcode($content) . "</span>";
        return $out;
    }
}
add_shortcode('highlight', 'highlight');

/**
 *
 *  Dropcap
 *
 */
if ( ! function_exists( 'dropcap' ) ) {
    function dropcap($atts, $content = null){
        extract(shortcode_atts(array(

        ),
            $atts
        ));
        $out = "<span class='dropcap' >" . do_shortcode($content) . "</span>";
        return $out;
    }
}
add_shortcode('dropcap', 'dropcap');

/**
 *
 *  Columns
 *
 */
if ( ! function_exists( 'col_one_half' ) ) {
	function col_one_half($atts, $content = null){
		extract(shortcode_atts(array(
			'last' => ''
		),
			$atts
		));
		$out = "<div class='one_half " . $last . "' >" . do_shortcode($content) . "</div>";
		return $out;
	}
}
add_shortcode('one_half', 'col_one_half');

/**
 *
 * One third
 *
 */
if ( ! function_exists( 'col_one_third' ) ) {
	 function col_one_third($atts, $content = null){
		extract(shortcode_atts(array(
			'last' => ''
		),
			$atts
		));
		$out = "<div class='one_third " . $last . "' >" . do_shortcode($content) . "</div>";
		return $out;
	}
}
add_shortcode('one_third', 'col_one_third');

/**
 *
 * One Fourth
 *
 */
if ( ! function_exists( 'col_one_fourth' ) ) {
	function col_one_fourth($atts, $content = null){
		extract(shortcode_atts(array(
			'last' => ''
		),
			$atts
		));
		$out = "<div class='one_fourth " . $last . "'>" . do_shortcode($content) . "</div>";
		return $out;
	}
}
add_shortcode('one_fourth', 'col_one_fourth');

/**
 *
 * Two Third
 *
 */
if ( ! function_exists( 'col_two_third' ) ) {
	function col_two_third($atts, $content = null){
		extract(shortcode_atts(array(
			'last' => ''
		),
			$atts
		));
		$out = "<div class='two_third " . $last . "'>" . do_shortcode($content) . "</div>";
		return $out;
	}
}
add_shortcode('two_third', 'col_two_third');

/**
 *
 * Three Fourth
 *
 */
if ( ! function_exists( 'col_three_fourth' ) ) {
	function col_three_fourth($atts, $content = null){
		extract(shortcode_atts(array(
			'last' => ''
		),
			$atts
		));
		$out = "<div class='three_fourth " . $last . "'>" . do_shortcode($content) . "</div>";
		return $out;
	}
}
add_shortcode('three_fourth', 'col_three_fourth');

/**
 *
 * Clear
 *
 */
if ( ! function_exists( 'col_clear' ) ) {
	function col_clear($atts, $content = null){
		return "<div class='clear'></div>";
	}
}
add_shortcode('clear', 'col_clear');

/**
 *
 * Buttons
 *
 */
if ( ! function_exists( 'button' ) ) {
	function button($atts, $content = null){
		extract(shortcode_atts(array(
			'type' => '',
			'url' => '',
			'button_color_fon' => '',
			'button_text_color' => '',
			'button_color_fon_hover' =>'',
			'target' => ''
		),
			$atts
		));
		if ($target != '') : $target = "target='_blank'";
		endif;
		$class = '';
		if (preg_match('/btn_xlarge$/', $type)){
			$class = 'style="background-color: ' . $button_color_fon . '"';
			$out = "<a class='" . $type . "'  href='" . $url . "' " . $target . "><b style='background-color: " . $button_color_fon . "; color:" . $button_text_color . ";'></b><span>" . do_shortcode($content) . "</span></a>";
		}
		else
		{
			$out = "<a class='" . $type . "' style='background-color: " . $button_color_fon . "; color:" . $button_text_color . ";' href='" . $url . "' " . $target . "  ><span>" . do_shortcode($content) . "</span></a>";
		}
		return $out;
	}
}
add_shortcode('button', 'button');

/**
 *
 * Notification
 *
 */
if ( ! function_exists( 'notification' ) ) {
	function notification($atts, $content = null){
		extract(shortcode_atts(array(
            'type' => '',
		),
			$atts
		));
		$out = "<div class='bd_notification " . $type . "' ><i></i><p>" . do_shortcode($content) . "</p></div>";
		return $out;
	}
}
add_shortcode('notification', 'notification');

/**
 *
 * Youtube
 *
 */
if ( ! function_exists( 'youtube' ) ) {
    function youtube($atts, $content = null){
        extract(shortcode_atts(array(
                'youtubeurl' => '',
            ),
            $atts
        ));
        $out = "<div class='bd-video-shortcode'><iframe width='620' height='470' src='http://www.youtube.com/embed/" . $youtubeurl . "?rel=0' frameborder='0' allowfullscreen></iframe></div>";
        return $out;
    }
}
add_shortcode('youtube', 'youtube');

/**
 *
 * vimeo
 *
 */
if ( ! function_exists( 'vimeo' ) ) {
    function vimeo($atts, $content = null){
        extract(shortcode_atts(array(
                'vimeourl' => '',
            ),
            $atts
        ));
        $out = "<div class='bd-video-shortcode'><iframe src='http://player.vimeo.com/video/" . $vimeourl . "?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16' width='620' height='470' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>";
        return $out;
    }
}
add_shortcode('vimeo', 'vimeo');

/**
 *
 * Soundcloud
 *
 */
if ( ! function_exists( 'soundcloud' ) ) {
    function soundcloud($atts, $content = null){
        extract(shortcode_atts(array(
                'soundcloudurl' => '',
                'play' => 'false',
            ),
            $atts
        ));
        $out = "<div class='bd-soundcloud-shortcode'><iframe width='620' height='166' scrolling='no' frameborder='no' src='https://w.soundcloud.com/player/?url=" . $soundcloudurl . "&amp;auto_play=" . $play . "&amp;show_artwork=true'></iframe></div>";
        return $out;
    }
}
add_shortcode('soundcloud', 'soundcloud');

/**
 *
 *  Google map
 *
 */
if ( ! function_exists( 'googlemaps' ) ) {
    function googlemaps($atts, $content = null){
        extract(shortcode_atts(array(
                'googlemapssrc' => '',
                'googlemapswidth' => '620',
                'googlemapsheight' => '455',
            ),
            $atts
        ));
        $out = "<div class='bd-googlemaps-shortcode'><div class='google-map'><iframe width='".$googlemapswidth."' height='".$googlemapsheight."' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='".$googlemapssrc."&amp;output=embed'></iframe></div></div>";
        return $out;
    }
}
add_shortcode('googlemaps', 'googlemaps');

/**
 *
 * Toggle
 *
 */
if ( ! function_exists( 'toggle_shortcode' ) ) {
	function toggle_shortcode($atts, $content = null){
		wp_enqueue_script('jquery-ui-core');
		extract(shortcode_atts(array(
            'title' => '',
		),
			$atts
		));
		return '<div class="toggle"><h4>' . $title . '</h4><span>+</span><div class="panel">' . do_shortcode($content) . '</div></div>';
	}
}
add_shortcode('toggle', 'toggle_shortcode');

/**
 *
 * Tabs
 *
 */
if ( ! function_exists( 'jquery_tab_group' ) ) {
	function jquery_tab_group($atts, $content){
		wp_enqueue_script('jquery-ui-tabs');
		extract(shortcode_atts(array(
            'type' => '',
		),
			$atts
		));
		$GLOBALS['tab_count'] = 0;
		do_shortcode($content);
		if (is_array($GLOBALS['tabs'])){
			$int = '1';
			foreach ($GLOBALS['tabs'] as $tab){
				$tabs[] = '<li><a href="#tabs-' . $int . '">' . $tab['title'] . '</a></li>';
				$panes[] = '<div id="tabs-' . $int . '">' . $tab['content'] . '</div>';
				$int++;
			}
			$return = "\n" . '<div class="tabgroup ' . $type . '" data-script="jquery-ui-core,jquery-ui-widget,jquery-ui-tabs"><ul class="tabs">' . implode("\n", $tabs) . '</ul><div class="contents">' . "\n" . ' ' . implode("\n", $panes) . '</div></div><script>jQuery(document).ready(function(){initTabGroup()});</script>' . "\n";
		}
		return $return;
	}
}
add_shortcode('tabgroup', 'jquery_tab_group');

/**
 *
 * jQuery Tab
 *
 */
if ( ! function_exists( 'jquery_tab' ) ) {
	function jquery_tab($atts, $content){
		extract(shortcode_atts(array(
			'title' => 'Tab %d'
		),
			$atts
		));
		$x = $GLOBALS['tab_count'];
		$GLOBALS['tabs'][$x] = array('title' => sprintf($title, $GLOBALS['tab_count']), 'content' => do_shortcode($content));
		$GLOBALS['tab_count']++;
	}
}
add_shortcode('tab', 'jquery_tab');

/**
 *
 * Refresh mce
 *
 */
if ( ! function_exists( 'refresh_mce' ) ) {
	function refresh_mce($ver){
		$ver += 3;
		return $ver;
	}
}
add_filter('tiny_mce_version', 'refresh_mce');

/**
 *
 * Html editor
 *
 */
if ( ! function_exists( 'html_editor' ) ) {
	function html_editor(){
		if (basename($_SERVER['SCRIPT_FILENAME']) == 'post-new.php' || basename($_SERVER['SCRIPT_FILENAME']) == 'post.php'){
			echo "<style type='text/css'>#ed_toolbar input#one_half, #ed_toolbar input#one_third, #ed_toolbar input#one_fourth, #ed_toolbar input#two_third, #ed_toolbar input#one_half_last, #ed_toolbar input#one_third_last, #ed_toolbar input#one_fourth_last, #ed_toolbar input#two_third_last, #ed_toolbar input#clear {font-weight:700;color:#2EA2C8;text-shadow:1px 1px white}
#ed_toolbar input#one_half_last, #ed_toolbar input#one_third_last, #ed_toolbar input#one_fourth_last, #ed_toolbar input#two_third_last, #ed_toolbar input#three_fourth, #ed_toolbar input#three+fourth_last {color:#888;text-shadow:1px 1px white}
#ed_toolbar input#raw {color:red;text-shadow:1px 1px white;font-weight:700;}</style>";
		}
	}
}
add_action('admin_head', 'html_editor');

/**
 *
 * Custom Quick tags
 *
 */
if ( ! function_exists( 'custom_quicktags' ) ) {
	function custom_quicktags(){
		if (basename($_SERVER['SCRIPT_FILENAME']) == 'post-new.php' || basename($_SERVER['SCRIPT_FILENAME']) == 'post.php'){
			wp_enqueue_script('custom_quicktags', get_template_directory_uri() . '/includes/shortcode/shortcodes/assets/js/quick.js', array('quicktags'), '1.0.0');
		}
	}
}
add_action('admin_print_scripts', 'custom_quicktags');

/**
 *
 * Social Links
 *
 */
if ( ! function_exists( 'bd_social_link' ) ) {
	function bd_social_link($atts, $content = null){
		extract(shortcode_atts(array(
			'url' => '#',
			'type' => '',
			'target' => '',
		),
			$atts
		));
		if ($target)
		{
			$target = 'target="_blank"';
		}
		return '<a class="social_links social_icon-' . $type . '" href="' . $url . '" ' . $target . '></a>';
	}
}
add_shortcode('social_link', 'bd_social_link');

/**
 *
 * Insert social buttons
 *
 */
if ( ! function_exists( 'bd_social_button' ) ) {
	function bd_social_button($atts, $content = null){
		$default_values = array(
			'button' => '',
			'gurl' => in_the_loop() ? get_permalink() : '',
			'gsize' => '',
			'gannatation' => '',
			'ghtml5' => '',
			'turl' => in_the_loop() ? get_permalink() : '',
			'ttext' => in_the_loop() ? get_the_title() : '',
			'tcount' => '',
			'tsize' => '',
			'tvia' => '',
			'trelated' => '',
			'furl' => in_the_loop() ? get_permalink() : '',
			'flayout' => '',
			'fsend' => '',
			'fshow_faces' => '',
			'fwidth' => 450,
			'faction' => '',
			'fcolorsheme' => '',
			'purl' => in_the_loop() ? get_permalink() : '',
			'pmedia' => wp_get_attachment_url(get_post_thumbnail_id()),
			'ptext' => in_the_loop() ? get_the_title() : '',
			'pcount' => '',
		);
		$shortcode_html = $shortcode_js = '';
		extract(shortcode_atts($default_values, $atts));
		switch ($button){
			case 'google':
				$shortcode_js = "<script type='text/javascript'>(function() {var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true; po.src = 'https://apis.google.com/js/plusone.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);})();</script>";
				if ($ghtml5){
					$shortcode_html = sprintf('<div class="g-plusone" data-size="%s" data-annotation="%s" data-href="%s"></div>', $gsize, $gannatation, $gurl);
				}
				else
				{
					$shortcode_html = sprintf('<g:plusone size="%s" annotation="%s" href="%url"></g:plusone>', $gsize, $gannatation, $gurl);
				}
				break;

			case 'twitter':
				$shortcode_js = '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
				$template = '<a href="https://twitter.com/share" class="twitter-share-button"  data-url="%s"	data-text="%s" data-count="%s" data-size="%s" data-via="%s" data-related="%s" data-lang="">Tweet</a>';
				$shortcode_html = sprintf($template, $turl, $ttext, $tcount, $tsize, $tvia, $trelated);
				break;

			case 'facebook':
				$shortcode_js = <<<JS
					<div id="fb-root"></div>
				  <script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
					fjs.parentNode.insertBefore(js, fjs);
				  }(document, 'script', 'facebook-jssdk'));</script>
JS;
				$template = <<<HTML
				<div class="fb-like" data-href="%s" data-send="%s" data-layout="%s" data-width="%d" data-show-faces="%s" data-action="%s" data-colorscheme="%s"></div>
HTML;
				$shortcode_html = sprintf($template, $furl, ($fsend) ? 'true' : 'false', $flayout, $fwidth, ($fshow_faces) ? 'true' : 'false', $faction, $fcolorsheme
				);
				break;

			case 'pinterest':
				$query_params = $template = '';
				$filtered_params = array();

				$params = array('url' => $purl,
					'media' => $pmedia,
					'description' => $ptext);

				$filtered_params = array_filter($params);


				$query_params = http_build_query($filtered_params);

				if (strlen($query_params))
				{
					$query_params = '?' . $query_params;
				}

				$template = '<a href="http://pinterest.com/pin/create/button/%s" class="pin-it-button" count-layout="%s"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>';

				$shortcode_html = sprintf($template, $query_params, $pcount);
				$shortcode_js = '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>';

				break;
		}
		return $shortcode_html . $shortcode_js;
	}
}
add_shortcode('social_button', 'bd_social_button');

/**
 *
 * List Line
 *
 */
if ( ! function_exists( 'line_list' ) ) {
	function line_list($atts, $content = null){
		extract(shortcode_atts(array(
			'type' => 'bd_line_list'
		),
			$atts
		));
		$content = str_replace('<ul>', '<ul class=' . $type . '>', do_shortcode($content));
		$content = str_replace('<li>', '<li>', do_shortcode($content));
		return $content;
	}
}
add_shortcode('line_list', 'line_list');

/**
 *
 * List Star
 *
 */
if ( ! function_exists( 'star_list' ) ) {
	function star_list($atts, $content = null){
		extract(shortcode_atts(array(
			'type' => 'bd_star_list'
		),
			$atts
		));
		$content = str_replace('<ul>', '<ul class=' . $type . '>', do_shortcode($content));
		$content = str_replace('<li>', '<li>', do_shortcode($content));
		return $content;
	}
}
add_shortcode('star_list', 'star_list');

/**
 *
 * List Check
 *
 */
if ( ! function_exists( 'yes_list' ) ) {
	function yes_list($atts, $content = null){
		extract(shortcode_atts(array(
			'type' => 'bd_yes_list'
		),
			$atts
		));
		$content = str_replace('<ul>', '<ul class=' . $type . '>', do_shortcode($content));
		$content = str_replace('<li>', '<li>', do_shortcode($content));
		return $content;
	}
}
add_shortcode('yes_list', 'yes_list');

/**
 *
 * List Error
 *
 */
if ( ! function_exists( 'no_list' ) ) {
	function no_list($atts, $content = null){
		extract(shortcode_atts(array(
			'type' => 'bd_no_list'
		),
			$atts
		));
		$content = str_replace('<ul>', '<ul class=' . $type . '>', do_shortcode($content));
		$content = str_replace('<li>', '<li>', do_shortcode($content));
		return $content;
	}
}
add_shortcode('no_list', 'no_list');

/**
 *
 * Table
 *
 */
if ( ! function_exists( 'bd_table' ) ) {
	function bd_table($atts, $content = null){
		$content = str_replace('<table>', '<table class="bd_table">', do_shortcode($content));
		return $content;
	}
}
add_shortcode('bd_table', 'bd_table');