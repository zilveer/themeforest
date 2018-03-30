<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
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
	
		// start calling header script
		wp_head();

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

	?>	
</head>
<body <?php echo body_class(); ?>>
<div class="body-wrapper">
	<?php $gdl_enable_top_navigation = get_option(THEME_SHORT_NAME.'_enable_top_navigation'); ?>
	<?php if ( $gdl_enable_top_navigation == '' || $gdl_enable_top_navigation == 'enable' ){  ?>
		<div class="top-navigation-wrapper">
			<div class="top-navigation wrapper container">
				<?php
					// get top navigation menu
					echo '<div class="top-navigation-left">';
					wp_nav_menu( array( 'theme_location' => 'top_menu' ) );
					echo '<div class="clear"></div>';
					echo '</div>';						
				?>
				
				<div class="top-navigation-right">
					<!-- Get Social Icons -->
					<div id="gdl-social-icon" class="social-wrapper">
						<div class="social-icon-wrapper">
							<?php
								global $gdl_icon_type;
								$gdl_social_icon = array(
									'delicious'=> array('name'=>THEME_SHORT_NAME.'_delicious', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/delicious.png'),
									'deviantart'=> array('name'=>THEME_SHORT_NAME.'_deviantart', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/deviantart.png'),
									'digg'=> array('name'=>THEME_SHORT_NAME.'_digg', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/digg.png'),
									'facebook' => array('name'=>THEME_SHORT_NAME.'_facebook', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/facebook.png'),
									'flickr' => array('name'=>THEME_SHORT_NAME.'_flickr', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/flickr.png'),
									'lastfm'=> array('name'=>THEME_SHORT_NAME.'_lastfm', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/lastfm.png'),
									'linkedin' => array('name'=>THEME_SHORT_NAME.'_linkedin', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/linkedin.png'),
									'picasa'=> array('name'=>THEME_SHORT_NAME.'_picasa', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/picasa.png'),
									'rss'=> array('name'=>THEME_SHORT_NAME.'_rss', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/rss.png'),
									'stumble-upon'=> array('name'=>THEME_SHORT_NAME.'_stumble_upon', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/stumble-upon.png'),
									'tumblr'=> array('name'=>THEME_SHORT_NAME.'_tumblr', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/tumblr.png'),
									'twitter' => array('name'=>THEME_SHORT_NAME.'_twitter', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/twitter.png'),
									'vimeo' => array('name'=>THEME_SHORT_NAME.'_vimeo', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/vimeo.png'),
									'youtube' => array('name'=>THEME_SHORT_NAME.'_youtube', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/youtube.png'),
									'google_plus' => array('name'=>THEME_SHORT_NAME.'_google_plus', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/google-plus.png'),
									'email' => array('name'=>THEME_SHORT_NAME.'_email', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/email.png'),
									'pinterest' => array('name'=>THEME_SHORT_NAME.'_pinterest', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/pinterest.png')
								);
								
								foreach( $gdl_social_icon as $social_name => $social_icon ){
									$social_link = get_option($social_icon['name']);
									
									if( !empty($social_link) ){
										echo '<div class="social-icon"><a target="_blank" href="' . $social_link . '">' ;
										echo '<img src="' . $social_icon['url'] . '" alt="' . $social_name . '"/>';
										echo '</a></div>';
									}
								}
							?>
						</div> <!-- social icon wrapper -->
					</div> <!-- social wrapper -->	

				</div> <!-- top navigation right -->
				
				<div class="clear"></div>
			</div> <!-- top navigation container -->
		</div> <!-- top navigation wrapper -->
	<?php } ?> 
	<div class="header-wrapper">
		<div class="header-container container">
				
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
						echo bloginfo('url');
						echo '"><img src="' . $logo_attachment . '" alt="' . $alt_text . '"/></a></h1>';	
					}else{
						echo '<a href="'; 
						echo bloginfo('url');
						echo '"><img src="' . $logo_attachment . '" alt="' . $alt_text . '"/></a>';				
					}
				?>
			</div>
			<?php
				// Logo right text
				if( get_option(THEME_SHORT_NAME . '_logo_position') != 'Center' ){
					echo '<div class="logo-right-text">';
					echo do_shortcode( __(get_option(THEME_SHORT_NAME . '_logo_right_text'), 'gdl_front_end') );
					echo '</div>';
				}
			?>
			<div class="clear"></div>
		</div> <!-- header container -->
		<div class="content-top-shadow"></div>
	</div> <!-- header wrapper -->
	
	<div class="content-wrapper container wrapper main">
	
		<!-- Navigation -->
		<div class="gdl-navigation-gimmick"></div>
		<div class="gdl-navigation-wrapper">
			<?php 
				// responsive menu
				if( $gdl_is_responsive ){
					dropdown_menu( array('dropdown_title' => '-- Main Menu --', 'indent_string' => '- ', 'indent_after' => '','container' => 'div', 'container_class' => 'responsive-menu-wrapper', 'theme_location'=>'main_menu') );	
				}
				
				// main menu
				echo '<div class="navigation-wrapper">';
				wp_nav_menu( array('container' => 'div', 'container_class' => 'menu-wrapper', 'container_id' => 'main-superfish-wrapper', 'menu_class'=> 'sf-menu',  'theme_location' => 'main_menu' ) );
				echo '<div class="clear"></div>';
				echo '<div class="navigation-bottom-shadow"></div>';
				echo '</div>';
			?>
			
			<!-- search form -->
			<?php if( get_option(THEME_SHORT_NAME . '_enable_top_search', 'enable') == 'enable' ){ ?>
			<div class="top-search-form">
				<div class="gdl-search-button" id="gdl-search-button"></div> 
				<div class="search-wrapper">
					<div class="gdl-search-form">
						<form method="get" id="searchform" action="<?php  echo home_url(); ?>/">
							<?php
								$search_val = get_search_query();
								if( empty($search_val) ){
									$search_val = __("Search..." , "gdl_front_end");
								}
							?>
							<div class="search-text">
								<input type="text" value="<?php echo $search_val; ?>" name="s" id="s" autocomplete="off" data-default="<?php echo $search_val; ?>" />
							</div>
							<input type="submit" id="searchsubmit" value="<?php _e("Go!", "gdl_front_end") ?>" />
							<div class="clear"></div>
						</form>
					</div>
				</div>		
			</div>		
			<?php } ?>
			<div class="clear"></div>
		</div>	
		
		<?php
			global $gdl_admin_translator;
		
			// print title
			if( is_search() ){
				if( $gdl_admin_translator == 'enable' ){
					$title = get_option(THEME_SHORT_NAME.'_translator_search_header', 'Search');
				}else{
					$title = __('Search', 'gdl_front_end');
				}
				$caption = get_search_query();
				print_page_header($title, $caption);			
			}else if( is_archive() ){
				if(is_category() || is_tag() || is_tax('portfolio-category') || is_tax('portfolio-tag') ){
					$title = __('Category', 'gdl_front_end');
					$caption = single_cat_title('', false);
				}else if( is_day() ){
					$title = __('Day', 'gdl_front_end');
					$caption = get_the_date('F j, Y');
				}else if( is_month() ){
					$title = __('Month', 'gdl_front_end');
					$caption = get_the_date('F Y');
				}else if( is_year() ){
					$title = __('Year', 'gdl_front_end');
					$caption = get_the_date('Y');
				}				
				print_page_header($title, $caption);		
			}else if( is_404() ){
				$title = __('404','gdl_front_end');		
				$caption = __('Page not found','gdl_front_end');	
				print_page_header($title, $caption);		
			}else if( $post->post_type == 'page' ){
				if( get_post_meta($post->ID, 'page-option-show-title', true) != 'No' ){
					$title = get_the_title();
					$caption = get_post_meta($post->ID, 'page-option-caption', true);
					print_page_header($title, $caption);
				}				
			}else if( $post->post_type == 'post' || $post->post_type == 'portfolio' ){
				$title = get_the_title();
				$caption = get_post_meta($post->ID, 'post-option-caption', true);
				print_page_header($title, $caption);							
			}
			
		?>
	
		<div class="page-container container">
	
		