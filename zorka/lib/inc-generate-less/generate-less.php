<?php
/**
 * Created by PhpStorm.
 * User: duonglh
 * Date: 8/23/14
 * Time: 3:01 PM
 */

function zorka_generate_less()
{
	require_once ('Less.php');

    $zorka_data = of_get_options();

	try {
		define('FS_METHOD', 'direct');

        $primary_color = $zorka_data['primary-color'];
        $text_color = $zorka_data['text-color'];
        $text_bold_color = $zorka_data['text-bold-color'];
        $font_family_heading = $zorka_data['heading-font']['face'];
        if ($font_family_heading == 'none') {
            $font_family_heading = $zorka_data['body-font']['face'];
        }



		$site_logo_url = $zorka_data['site-logo'];

		$site_logo_url = str_replace(THEME_URL, '', $site_logo_url);

		$css = '@primary_color:'.$primary_color.';';
        $css .= '@text_color:'.$text_color.';';
        $css .= '@text_bold_color:'.$text_bold_color.';';
        $css .= '@font_family_secondary:'.$font_family_heading.';';


        $css .= "@logo_url : '". $site_logo_url ."';";
		$css .= '@theme_url:"' . THEME_URL . '";';


        $style = $css;


        require_once ( THEME_DIR . "lib/inc-generate-less/custom-css.php" );
        $custom_css = zorka_custom_css();

		require_once(ABSPATH . 'wp-admin/includes/file.php');
		WP_Filesystem();
		global $wp_filesystem;

        $options = array( 'compress'=>true );
        $parser = new Less_Parser($options);
        $parser->parse($css);
        $parser->parseFile(THEME_DIR.'assets/css/less/style.less');
        $parser->parse($custom_css);
        $css = $parser->getCss();


        if (!$wp_filesystem->put_contents( THEME_DIR.   "style.min.css", $css, FS_CHMOD_FILE)) {
            esc_html_e('Could not save file','zorka');
            return '0';
        }

        $theme_info = file_get_contents( THEME_DIR . "theme-info.txt" );
        $parser = new Less_Parser();
        $parser->parse($style);
        $parser->parseFile(THEME_DIR . 'assets/css/less/style.less',THEME_URL);
        $parser->parse($custom_css);
        $style = $parser->getCss();
        $style = $theme_info . "\n" . $style;
        $style = str_replace("\r\n","\n", $style);
        if (!$wp_filesystem->put_contents( THEME_DIR.   "style.css", $style, FS_CHMOD_FILE)) {
            esc_html_e('Could not save file','zorka');
            return '0';
        }
		return '1';
	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
		return '0';
	}
}
