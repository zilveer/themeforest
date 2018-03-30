<?php 
	$gt3page_settings = gt3_get_theme_pagebuilder(@get_the_ID());
	
?>
<!DOCTYPE html>
<html <?php language_attributes();?> class="fullscreen">
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <?php echo((gt3_get_theme_option("responsive") == "on") ? '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">' : ''); ?>
    <link rel="shortcut icon" href="<?php echo gt3_get_theme_option('favicon'); ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo gt3_get_theme_option('apple_touch_57'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo gt3_get_theme_option('apple_touch_72'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo gt3_get_theme_option('apple_touch_114'); ?>">
    <title><?php wp_title(); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <script type="text/javascript">
        var gt3_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    </script>
    <?php echo gt3_get_if_strlen(gt3_get_theme_option("custom_css"), "<style>", "</style>") . gt3_get_if_strlen(gt3_get_theme_option("code_before_head"));
	wp_enqueue_script('gt3_chart_js', get_template_directory_uri() . '/js/chart.js', array(), false, true);
    globalJsMessage::getInstance()->render();
    wp_head(); ?>
</head>

<body <?php body_class(array(gt3_the_pb_custom_bg_and_color(gt3_get_theme_pagebuilder(@get_the_ID()), array("classes_for_body" => true)))); ?>>
	<?php 
		if (gt3_get_theme_option('sticky') == 'on') {
			echo '<div class="psevdo_header"></div>';
			$header_class = 'fixed_header';
		} else {
			$header_class = '';
		}
	?>
    <header class="main_header <?php echo $header_class; ?>">
        <div class="header_wrapper">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><img src="<?php gt3_the_theme_option("logo"); ?>" alt=""  width="<?php gt3_the_theme_option("header_logo_standart_width"); ?>" height="<?php gt3_the_theme_option("header_logo_standart_height"); ?>" class="logo_def"><img src="<?php gt3_the_theme_option("logo_retina"); ?>" alt="" width="<?php gt3_the_theme_option("header_logo_standart_width"); ?>" height="<?php gt3_the_theme_option("header_logo_standart_height"); ?>" class="logo_retina"></a>
            <nav>
                <?php wp_nav_menu(array('theme_location' => 'main_menu', 'menu_class' => 'menu', 'depth' => '4', 'walker' => new gt3_menu_walker($showtitles = false))); ?>
            </nav>
            
            <div class="socials">
                <?php echo gt3_show_social_icons(array(
                    array(
                        "uniqid" => "social_facebook",
                        "class" => "ico_social_facebook",
                        "title" => "Facebook",
                        "target" => "_blank",
                    ),					
                    array(
                        "uniqid" => "social_pinterest",
                        "class" => "ico_social_pinterest",
                        "title" => "Pinterest",
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_twitter",
                        "class" => "ico_social_twitter",
                        "title" => "Twitter",
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_instagram",
                        "class" => "ico_social_instagram",
                        "title" => "Instagram",
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_tumblr",
                        "class" => "ico_social_tumblr",
                        "title" => "Tumblr",
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_flickr",
                        "class" => "ico_social_flickr",
                        "title" => "Flickr",
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_youtube",
                        "class" => "ico_social_youtube",
                        "title" => "Youtube",
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_dribbble",
                        "class" => "ico_social_dribbble",
                        "title" => "Dribbble",
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_gplus",
                        "class" => "ico_social_gplus",
                        "title" => "Google+",
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_vimeo",
                        "class" => "ico_social_vimeo",
                        "title" => "Vimeo",
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_delicious",
                        "class" => "ico_social_delicious",
                        "title" => "Delicious",
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_linked",
                        "class" => "ico_social_linked",
                        "title" => "Linked In",
                        "target" => "_blank",
                    )
                ));
                ?>
            </div>
            <div class="phone"><?php gt3_the_theme_option("phone"); ?></div>
            <!-- WPML Code Start -->
            <?php /*do_action('icl_language_selector');*/ ?>
            <!-- WPML Code End -->
            <div class="clear"></div>
		<div class="clear"></div>
        </div><!-- Header Wrapper -->        
	</header>
