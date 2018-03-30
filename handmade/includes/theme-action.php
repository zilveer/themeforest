<?php
/*---------------------------------------------------
/* THEME ADD ACTION
/*---------------------------------------------------*/

/*================================================
COMMENT FORM BEFORE
================================================== */
if (!function_exists('g5plus_comment_form_before_fields')) {
    function g5plus_comment_form_before_fields() {
        ?>
        <div class="comment-fields-wrap">
            <div class="entry-comments-form-avatar">
                <?php echo get_avatar(get_current_user_id(), '70'); ?>
            </div>
            <div class="comment-fields-inner clearfix">
                <div class="row">
        <?php
    }
    add_action('comment_form_before_fields','g5plus_comment_form_before_fields');
    add_action('comment_form_logged_in_after','g5plus_comment_form_before_fields');
}

/*================================================
COMMENT BOTTOM FORM
================================================== */
if (!function_exists('g5plus_bottom_comment_form')) {
    function g5plus_bottom_comment_form() {
        echo '</div></div></div>';
    }
    add_action('comment_form','g5plus_bottom_comment_form');
}

/*---------------------------------------------------
/* CUSTOM HEADER CSS
/*---------------------------------------------------*/
if (!function_exists('g5plus_custom_header_css')) {
	function g5plus_custom_header_css() {
		$page_id = '0';
		if (isset($_REQUEST['current_page_id'])) {
			$page_id = $_REQUEST['current_page_id'];
		}

		$css_variable = g5plus_custom_css_variable($page_id);

		if (!class_exists('Less_Parser')) {
			require_once THEME_DIR . 'g5plus-framework/less/Autoloader.php';
			Less_Autoloader::register();
		}
		$parser = new Less_Parser(array( 'compress'=>true ));

		$parser->parse($css_variable, THEME_URL);
		$parser->parseFile( THEME_DIR . 'assets/css/less/variable.less', THEME_URL );
		$parser->parseFile( THEME_DIR . 'assets/css/less/header-customize.less', THEME_URL );
		$parser->parseFile( THEME_DIR . 'assets/css/less/footer-customize.less', THEME_URL );

		$prefix = 'g5plus_';
		$enable_page_color = rwmb_meta($prefix . 'enable_page_color', array(), $page_id);
		if ($enable_page_color == '1') {
			$parser->parseFile( THEME_DIR . 'assets/css/less/color.less' );
		}

		$css = $parser->getCss();
		header("Content-type: text/css; charset: UTF-8");
		echo sprintf('%s', $css);
	}
	add_action('custom-page/header-custom-css', 'g5plus_custom_header_css');
}





