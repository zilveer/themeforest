<?php
/**
 * The Header for our theme.
 *
 * @package shift_cv
 */
global $theme_custom_settings;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	$fonts = getFontsList(false);
	$font = get_theme_option('theme_font');
	$fonts = getFontsList(false);
	if (isset($fonts[$font])) {
		$font_link = $fonts[$font]['link'];
	} else {
		$font_link = "Lato:700,400italic,400,300italic,300,900";
	}
	?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href='http<?php echo is_ssl() ? 's' : ''?>://fonts.googleapis.com/css?family=<?php echo $font_link; ?>&subset=latin,cyrillic-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
    <?php if (($favicon = get_theme_option('favicon'))) { ?>
    	<link href="<?php echo $favicon; ?>" rel="shortcut icon" type="image/x-icon" />
    <?php
	}
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	
	<?php
	// Theme customizer settings
	$theme_custom_settings = array(
		'theme_style' => getValueGPC('theme_style', get_theme_option('theme_style'))
	);
	$theme_custom_settings['theme_style'] = !isset($_GET['prn']) && my_strtolower($theme_custom_settings['theme_style']) == 'dark' ? 'dark' : 'light';
	
	// AJAX Queries setiings
	global $ajax_nonce, $ajax_url;
	$ajax_nonce = wp_create_nonce('ajax_nonce');
	$ajax_url = admin_url('admin-ajax.php');
	?>
	<?php wp_head(); ?>
	<?php echo get_theme_option('tracking_code'); ?>
</head>

<body <?php body_class($theme_custom_settings['theme_style']); ?>>
	<!--[if lt IE 8]>
	<?php echo do_shortcode("[infobox style='error']It looks like you're using an old version of Internet Explorer. For the best WordPress experience, please <a href=\"http://microsoft.com\">update your browser</a> or learn how to <a href=\"http://browsehappy.com\">browse happy</a>![/infobox]"); ?>
	<![endif]-->
	<table class="colored">
		<tr>
			<td class="cl1"></td>
			<td class="cl2"></td>
			<td class="cl3"></td>
			<td class="cl4"></td>
			<td class="cl5"></td>
		</tr>
	</table>
	<?php if (get_theme_option('theme_style_switcher')==1) { ?>
	<div id="swither_block">
		<a href="#" id="theme_switcher"><span class="switch_icon icon-cog"></span><span class="switch_wrap"><?php echo $theme_custom_settings['theme_style'] == 'dark' ? __('Light', 'wpspace') : __('Dark', 'wpspace'); ?> <?php _e('version', 'wpspace'); ?></span></a>
	</div>
	<?php } ?>
    <div id="page" class="hfeed site">
        <?php do_action( 'before' ); ?>
        <header id="header" class="site_header" role="banner">
			<?php
			if (get_theme_option("social_links_in_header") == "true" ) { 
				$twitter = get_theme_option("social_links_twitter");
				$facebook = get_theme_option("social_links_facebook");
				$rss = get_theme_option("social_links_rss");
				$gplus = get_theme_option("social_links_gplus");
				$vimeo = get_theme_option("social_links_vimeo");
				$youtube = get_theme_option("social_links_youtube");
				$dribble = get_theme_option("social_links_dribble");
				$linkedin = get_theme_option("social_links_linkedin");
				$skype = get_theme_option("social_links_skype");
				$pinterest = get_theme_option("social_links_pinterest");
				$xing = get_theme_option("social_links_xing");
				$slide_share = get_theme_option("social_links_slideshare");
				
				$custom_1_url = get_theme_option("additional_account_url_1");
				$custom_2_url = get_theme_option("additional_account_url_2");
				$custom_3_url = get_theme_option("additional_account_url_3");
				$custom_1_icon = get_theme_option("additional_network_icon_1");
				$custom_2_icon = get_theme_option("additional_network_icon_2");
				$custom_3_icon = get_theme_option("additional_network_icon_3");
			?>
				<div class="social_links">
					<ul>
						<?php if ($rss) { ?><li class="rss"><a target="_blank" href="<?php echo $rss; ?>"><?php _e('RSS', 'wpspace'); ?></a></li><?php } ?>
						<?php if ($facebook) { ?><li class="fb"><a target="_blank" href="<?php echo $facebook; ?>"><?php _e('Facebook', 'wpspace'); ?></a></li><?php } ?>
						<?php if ($twitter) { ?><li class="tw"><a target="_blank" href="<?php echo $twitter; ?>"><?php _e('Twitter', 'wpspace'); ?></a></li><?php } ?>
						<?php if ($gplus) { ?><li class="gplus"><a target="_blank" href="<?php echo $gplus; ?>"><?php _e('Google+', 'wpspace'); ?></a></li><?php } ?>
						<?php if ($linkedin) { ?><li class="lnkd"><a target="_blank" href="<?php echo $linkedin; ?>"><?php _e('Linkedin', 'wpspace'); ?></a></li><?php } ?>
						<?php if ($dribble) { ?><li class="drb"><a target="_blank" href="<?php echo $dribble; ?>"><?php _e('Dribbble', 'wpspace'); ?></a></li><?php } ?>
						<?php if ($vimeo) { ?><li class="vim"><a target="_blank" href="<?php echo $vimeo; ?>" class="vim"><?php _e('Vimeo', 'wpspace'); ?></a></li><?php } ?>
						<?php if ($skype) { ?><li class="skp"><a target="_blank" href="skype:<?php echo $skype; ?>" class="skp"><?php _e('Skype', 'wpspace'); ?></a></li><?php } ?>
						<?php if ($pinterest) { ?><li class="pin"><a target="_blank" href="<?php echo $pinterest; ?>" class="pin"><?php _e('Pinterst', 'wpspace'); ?></a></li><?php } ?>
						<?php if ($xing) { ?><li class="xing"><a target="_blank" href="<?php echo $xing; ?>" class="xing"><?php _e('Xing', 'wpspace'); ?></a></li><?php } ?>
						<?php if ($slide_share) { ?><li class="slide_share"><a target="_blank" href="<?php echo $slide_share; ?>" class="slide_share"><?php _e('Slide Share', 'wpspace'); ?></a></li><?php } ?>
						
						<?php if(!empty($custom_1_url) && !empty($custom_1_icon)) { ?>
						<li class="custom"><a target="_blank" href="<?php echo $custom_1_url; ?>"><img src="<?php echo $custom_1_icon; ?>" alt=""></a></li>
						<?php } ?>
						
						<?php if(!empty($custom_2_url) && !empty($custom_2_icon)) { ?>
						<li class="custom"><a target="_blank" href="<?php echo $custom_2_url; ?>"><img src="<?php echo $custom_2_icon; ?>" alt=""></a></li>
						<?php } ?>
						
						<?php if(!empty($custom_3_url) && !empty($custom_3_icon)) { ?>
						<li class="custom"><a target="_blank" href="<?php echo $custom_3_url; ?>"><img src="<?php echo $custom_3_icon; ?>" alt=""></a></li>
						<?php } ?>
						
					</ul>
				</div>
			<?php } ?>
        </header>
	
		<?php
			global $sidebar_position, $sidebar_class, $sidebar_id, $is_resume_page;
			$type = getBlogType();
			$is_stream = in_array($type, array('video', 'gallery', 'blog', 'author', 'category', 'tag', 'resume', 'portfolio')) || my_strpos($type, 'archives')!==false;

			$cat_term = $type == 'resume' ? 'category_resume' : ($type == 'portfolio' ? 'category_portfolio' : 'category');
			$cat_id = get_query_var( $cat_term=='category' ? 'cat' : $cat_term );
			$post_options = $cat_options = array();
			if (is_single() || is_page()) {
				// Current post custom options
				$post_options = get_post_custom(get_the_ID());
				$cats = getCategoriesByPostId( get_the_ID() );
				if ($cats) {
					foreach ($cats as $cat) {
						$new_options = getCategoryInheritedProperties($cat['term_id'], $cat_term);
						foreach ($new_options as $k=>$v) {
							if (!empty($v) && $v!='default' && (!isset($cat_options[$k]) || empty($cat_options[$k]) || $cat_options[$k]=='default'))
								$cat_options[$k] = $v;
						}
					}
				}
			} else if (!empty($cat_id)) {
				$cat_options = getCategoryInheritedProperties($cat_id, $cat_term);
			}
			$sidebar_position = 'right';
			$sidebar_position_prm = "sidebar_position".(!$is_stream ? "_single" : '');
			$sidebar_current_prm = "sidebar_current".(!$is_stream ? "_single" : '');
			if (is_404()) {
				$sidebar_position = 'fullwidth';
			} else if (is_single() || is_page()) {
				$sidebar_position = my_strtolower(get_theme_option($sidebar_position_prm));
				if (isset($cat_options[$sidebar_position_prm]) && $cat_options[$sidebar_position_prm]!='' && $cat_options[$sidebar_position_prm]!='default') 
					$sidebar_position = $cat_options[$sidebar_position_prm];
				$post_position = my_strtolower(get_post_meta(get_the_ID(), 'sidebar_position', true));
				if ($post_position!='' && $post_position!='default') $sidebar_position = $post_position;
			} else {
				$sidebar_position = my_strtolower(get_theme_option($sidebar_position_prm));
				if (isset($cat_options[$sidebar_position_prm]) && $cat_options[$sidebar_position_prm]!='' && $cat_options[$sidebar_position_prm]!='default') 
					$sidebar_position = $cat_options[$sidebar_position_prm];
			}
			if ($sidebar_position == 'fullwidth')	$sidebar_class = 'without_sidebar';
			else									$sidebar_class = 'right_sidebar';
			$sidebar_id = 'sidebar-blog';
			$page_id = is_page() || is_single() || is_home() ? get_the_ID() : getTemplatePageId($type);
			$post_sidebar = my_strtolower(get_theme_option("sidebar_current".(!$is_stream ? "_single" : '_blog')));
			if ($post_sidebar != '')
				$sidebar_id = $post_sidebar;
			$post_sidebar = my_strtolower(get_post_meta($page_id, 'sidebar_current', true));
			if (!is_single() && $page_id > 0) {
				if ($post_sidebar !='' && $post_sidebar!='default')
					$sidebar_id = $post_sidebar;
			}
			if (isset($cat_options[$sidebar_current_prm]) && $cat_options[$sidebar_current_prm]!='' && $cat_options[$sidebar_current_prm]!='default') 
				$sidebar_id = $cat_options[$sidebar_current_prm];
			if (is_single() && $page_id > 0) {
				if ($post_sidebar !='' && $post_sidebar!='default')
					$sidebar_id = $post_sidebar;
			}
		?>
        
	    <div id="main" <?php echo $is_resume_page ? '' : ' class="' . $sidebar_class . '"'; ?>>
