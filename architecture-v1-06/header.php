<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php bloginfo('name'); ?>  <?php wp_title(); ?></title>

	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	
	<?php global $gdl_is_responsive ?>
	<?php if( $gdl_is_responsive ){ ?>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/foundation-responsive.css">
	<?php }else{ ?>
		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/foundation.css">
	<?php } ?>
	
	<!--[if IE 7]>
		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/ie7-style.css" /> 
	<![endif]-->	
	
	<?php
	
		// include favicon in the header
		if(get_option( THEME_SHORT_NAME.'_enable_favicon','disable') == "enable"){
			$gdl_favicon = get_option(THEME_SHORT_NAME.'_favicon_image');
			if( $gdl_favicon ){
				$gdl_favicon = wp_get_attachment_image_src($gdl_favicon, 'full');
				echo '<link rel="shortcut icon" href="' . $gdl_favicon[0] . '" type="image/x-icon" />';
			}
		} 
		
		// add facebook thumbnail to this page
		$thumbnail_id = get_post_thumbnail_id();
		if( !empty($thumbnail_id) ){
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '150x150' );
			echo '<link rel="image_src" href="' . $thumbnail[0] . '" />';		
		}
		
		// start calling header script
		wp_head();		

	?>	
</head>
<body <?php echo body_class(); ?>>
<?php
	// main menu
	if( get_option(THEME_SHORT_NAME.'_enable_floating_menu', 'enable') == 'enable' ){
		echo '<div class="navigation-wrapper">';
		echo '<div class="navigation-container container">';
		echo '<div class="menu-wrapper" id="main-superfish-wrapper">';
		echo '<ul class="sf-menu">';
		if( has_nav_menu('main_menu') ){
			wp_nav_menu( array('container' => '', 'theme_location' => 'main_menu', 'items_wrap' => '%3$s' ) );
		}
		if( has_nav_menu('main_menu_2') ){
			wp_nav_menu( array('container' => '', 'theme_location' => 'main_menu_2', 'items_wrap' => '%3$s' ) );
		}
		echo '</ul>';
		echo '</div>';
		echo '<div class="clear"></div>';
		echo '</div>'; // navigation-container 
		echo '</div>'; // navigation-wrapper 
	}
?>
<div class="body-outer-wrapper">
	<div class="body-wrapper">
		<div class="header-wrapper">
			<div class="header-outer-container" >
				<div class="header-container container main">
					
					<div class="header-navigation-wrapper ">
					<?php
						$nav_class = '';
						if( has_nav_menu('main_menu_2') ){ $nav_class = 'with-border'; }
						if( has_nav_menu('main_menu') ){
							wp_nav_menu( array('container' => 'div', 'container_class'=> 'header-navigation first-header-navigation ' . $nav_class, 'theme_location' => 'main_menu' ) );
						}
						if( has_nav_menu('main_menu_2') ){
							wp_nav_menu( array('container' => 'div', 'container_class'=> 'header-navigation second-header-navigation', 'theme_location' => 'main_menu_2' ) );
						}
						echo '<div class="clear"></div>';
					?>
					</div>
					
					<?php 				
						// Get Social Icons
						$gdl_icon_type = get_option(THEME_SHORT_NAME.'_header_icon_type', 'light');
						$gdl_social_icon = array(
							'delicious'=> array('name'=>THEME_SHORT_NAME.'_delicious', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/delicious.png'),
							'deviantart'=> array('name'=>THEME_SHORT_NAME.'_deviantart', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/deviantart.png'),
							'digg'=> array('name'=>THEME_SHORT_NAME.'_digg', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/digg.png'),
							'facebook' => array('name'=>THEME_SHORT_NAME.'_facebook', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/facebook.png'),
							'flickr' => array('name'=>THEME_SHORT_NAME.'_flickr', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/flickr.png'),
							'lastfm'=> array('name'=>THEME_SHORT_NAME.'_lastfm', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/lastfm.png'),
							'linkedin' => array('name'=>THEME_SHORT_NAME.'_linkedin', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/linkedin.png'),
							'picasa'=> array('name'=>THEME_SHORT_NAME.'_picasa', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/picasa.png'),
							'rss'=> array('name'=>THEME_SHORT_NAME.'_rss', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/rss.png'),
							'stumble-upon'=> array('name'=>THEME_SHORT_NAME.'_stumble_upon', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/stumble-upon.png'),
							'skype'=> array('name'=>THEME_SHORT_NAME.'_skype', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/skype.png'),
							'tumblr'=> array('name'=>THEME_SHORT_NAME.'_tumblr', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/tumblr.png'),
							'twitter' => array('name'=>THEME_SHORT_NAME.'_twitter', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/twitter.png'),
							'vimeo' => array('name'=>THEME_SHORT_NAME.'_vimeo', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/vimeo.png'),
							'youtube' => array('name'=>THEME_SHORT_NAME.'_youtube', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/youtube.png'),
							'google_plus' => array('name'=>THEME_SHORT_NAME.'_google_plus', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/google-plus.png'),
							'email' => array('name'=>THEME_SHORT_NAME.'_email', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/email.png'),
							'pinterest' => array('name'=>THEME_SHORT_NAME.'_pinterest', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social-icon/pinterest.png')
						);				
						
						echo '<div id="gdl-social-icon" class="social-wrapper">';
						echo '<div class="social-icon-wrapper">';
						foreach( $gdl_social_icon as $social_name => $social_icon ){
							$social_link = get_option($social_icon['name']);
							
							if( !empty($social_link) ){
								echo '<div class="social-icon"><a target="_blank" href="' . $social_link . '">' ;
								echo '<img src="' . $social_icon['url'] . '" alt="' . $social_name . '"/>';
								echo '</a></div>';
							}
						}
						echo '</div>'; // social icon wrapper
						echo '</div>'; // social wrapper					
					?>			
					
					<!-- Get Logo -->
					<div class="logo-wrapper">
						<?php
							$logo_id = get_option(THEME_SHORT_NAME.'_logo');
							if( empty($logo_id) ){	
								$alt_text = 'default-logo';	
								$logo_attachment = GOODLAYERS_PATH . '/images/default-logo.png';
							}else{
								$alt_text = get_post_meta($logo_id , '_wp_attachment_image_alt', true);	
								$logo_attachment = wp_get_attachment_image_src($logo_id, 'full');
								$logo_attachment = $logo_attachment[0];
							}

							if( is_front_page() ){
								echo '<h1><a href="'; 
								echo home_url();
								echo '"><img src="' . $logo_attachment . '" alt="' . $alt_text . '"/></a></h1>';	
							}else{
								echo '<a href="'; 
								echo home_url();
								echo '"><img src="' . $logo_attachment . '" alt="' . $alt_text . '"/></a>';				
							}
						?>
					</div>
					<div class="clear"></div>
					<?php
						//responsive menu
						if( $gdl_is_responsive ){
							echo '<div class="responsive-menu-wrapper">';
							echo '<select class="menu dropdown-menu">';
							if( has_nav_menu('main_menu') ){
								dropdown_menu( array('dropdown_title' => '-- Main Menu --', 'indent_string' => '- ', 'indent_after' => '',
									'container' => '', 'container_class' => '', 'theme_location'=>'main_menu' ));	
							}
							if( has_nav_menu('main_menu_2') ){
								dropdown_menu( array('dropdown_title' => '', 'indent_string' => '- ', 'indent_after' => '',
									'container' => '', 'container_class' => '', 'theme_location'=>'main_menu_2' ));							
							}
							echo '</select>';
							echo '</div>';
						}				
					?>
				</div> <!-- header container -->
			</div> <!-- header outer container -->
			
			<?php
				$content_class = '';
				
				if( is_page() ){
					global $gdl_top_slider_type, $gdl_top_slider_xml;
					if ($gdl_top_slider_type == "Custom Slider"){
						echo '<div class="gdl-top-slider">';
						$slider_xml = "<Slider>" . create_xml_tag('size', 'full-width');
						$slider_xml = $slider_xml . create_xml_tag('height', get_post_meta( $post->ID, 'page-option-top-slider-height', true) );
						$slider_xml = $slider_xml . create_xml_tag('slider-type', $gdl_top_slider_type);
						$slider_xml = $slider_xml . $gdl_top_slider_xml;
						$slider_xml = $slider_xml . "</Slider>";
						$slider_xml_dom = new DOMDocument();
						$slider_xml_dom->loadXML($slider_xml);
						print_slider_item($slider_xml_dom->documentElement);
						echo '<div class="clear"></div>';
						echo '</div>';
						
						$content_class = 'top-slider-on';
					}else if ($gdl_top_slider_type != 'None'){
						$bgid = get_post_meta($post->ID, 'page-option-header-background', true); 
					
						print_page_header(get_the_title() , $bgid);				
					}
				}else if( is_single() ){
					$port_page_style = get_option(THEME_SHORT_NAME.'_use_portfolio_as', 'portfolio style');
					
					if( $port_page_style != 'portfolio style' || $post->post_type == 'post' ){
						$single_title = get_post_meta( $post->ID, "post-option-blog-header-title", true);
						if(empty( $single_title )){
							$single_title = get_option(THEME_SHORT_NAME . '_default_post_header','Blog Post');
						}
					}else{
						$single_title = get_the_title();
					}
					
					print_page_header($single_title);				
				}else if(is_search()){
					print_page_header(get_search_query());
				}else if(is_archive()){
					if(is_category() || is_tag() || is_tax('portfolio-category') || is_tax('portfolio-tag') ){
						$title = single_cat_title('', false);
					}else if( is_day() ){
						$title = get_the_date('F j, Y');
					}else if( is_month() ){
						$title = get_the_date('F Y');
					}else if( is_year() ){
						$title = get_the_date('Y');
					}	
					print_page_header($title);					
				}else if( is_404() ){
					print_page_header(__('404' ,'gdl_front_end'));
				}
			?>
		</div> <!-- header wrapper -->
		
		<div class="content-wrapper container main <?php echo $content_class; ?>">