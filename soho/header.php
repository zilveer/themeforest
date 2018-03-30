<?php 
	$gt3page_settings = gt3_get_theme_pagebuilder(@get_the_ID());
?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
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
            
            <?php
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				if (is_plugin_active('woocommerce/woocommerce.php')) {			
			?>
                <div class="header_cart_content">
                   <?php global $woocommerce; ?>
                   <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'theme_localization'); ?>"><span class="total_price"><span class="price_count"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'theme_localization'), $woocommerce->cart->cart_contents_count);?></span><?php echo $woocommerce->cart->get_cart_total(); ?></span></a>
                </div>
            <?php } ?>
                        
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
            <!-- WPML Code Start -->
            <?php /*do_action('icl_language_selector');*/ ?>
            <!-- WPML Code End -->			
            <div class="phone"><?php gt3_the_theme_option("phone"); ?></div>
        </div><!-- Header Wrapper -->
        <div class="clear"></div>
	</header>
    <?php 
	$postType = '';
	if (isset($post) && $post->post_type == 'post'){
		$gt3_theme_pb = gt3_get_theme_pagebuilder(get_the_ID());
		$postType = gt3_get_theme_option('default_post_style');
		if (isset($gt3_theme_pb['settings']['post_style'])) {	
			if ($gt3_theme_pb['settings']['post_style'] == 'fw-post') { 
				$postType = 'fw-post';
			}
			if ($gt3_theme_pb['settings']['post_style'] == 'simple-post') { 
				$postType = 'simple-post';
			}
		}
		if ($postType == 'fw-post') {
			echo get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pb, "width" => "1920", "height" => "565"));
		}
	}

	if (isset($post) && $post->post_type == 'port'){
		$gt3_theme_pb = gt3_get_theme_pagebuilder(get_the_ID());
		
		$portfolioType = gt3_get_theme_option('default_portfolio_style');
		if (isset($gt3_theme_pb['settings']['portfolio_style'])) {	
			if ($gt3_theme_pb['settings']['portfolio_style'] == 'simple-portfolio-post') { 
				$portfolioType = 'simple-portfolio-post';
			}
			if ($gt3_theme_pb['settings']['portfolio_style'] == 'flow-portfolio-post') { 
				$portfolioType = 'flow-portfolio-post';
			}
		}
		$postStyle = $gt3_theme_pb['settings']['sp-style'];
		if ($portfolioType == 'flow-portfolio-post') { 
			$port_pf = get_post_format();
			if ($port_pf == "image") {
				echo get_flow_type_output(array("gt3_theme_pagebuilder" => $gt3_theme_pb, "autoplay" => $gt3_theme_pb['sliders']['flow']['autoplay'], "interval" => $gt3_theme_pb['sliders']['flow']['interval']));
				wp_enqueue_script('owl_carousel_js', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), false, true);
			} else {
				echo get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pb, "width" => "1920", "height" => "565"));
			}
		} else if ($portfolioType == 'simple-portfolio-post') {
			if ($postStyle == 'fw-simple') {
				$postType = 'fw-post';
				echo get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pb, "width" => "1920", "height" => "565"));
			} else {
				$postType = 'simple-post';
			}		
		}
	}
	?>
    <div class="site_wrapper <?php echo $postType; ?>">
	    <div class="main_wrapper">