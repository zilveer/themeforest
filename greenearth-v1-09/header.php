<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8" />
	<title><?php bloginfo('name'); ?>  <?php wp_title(); ?></title>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	
	<?php global $gdl_is_responsive ?>
	<?php if( $gdl_is_responsive ){ ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/skeleton-responsive.css">
		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/layout-responsive.css">	
	<?php }else{ ?>
		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/skeleton.css">
		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/layout.css">	
	<?php } ?>
	
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/ie-style.php?path=<?php echo GOODLAYERS_PATH; ?>" type="text/css" media="screen, projection" /> 
	<![endif]-->
	<!--[if IE 7]>
		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/ie7-style.css" /> 
	<![endif]-->	
	
	<!-- Favicon
   ================================================== -->
	<?php 
		if(get_option( THEME_SHORT_NAME.'_enable_favicon','disable') == "enable"){
			$gdl_favicon = get_option(THEME_SHORT_NAME.'_favicon_image');
			if( $gdl_favicon ){
				$gdl_favicon = wp_get_attachment_image_src($gdl_favicon, 'full');
				echo '<link rel="shortcut icon" href="' . $gdl_favicon[0] . '" type="image/x-icon" />';
			}
		} 
	?>

	<!-- Start WP_HEAD
   ================================================== -->
		
	<?php wp_head(); ?>
	
	<!-- FB Thumbnail
   ================================================== -->
	<?php
	if( is_single() ){
		$thumbnail_id = get_post_meta($post->ID,'post-option-inside-thumbnial-image', true);
		if( !empty($thumbnail_id) ){
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '150x150' );
			echo '<link rel="image_src" href="' . $thumbnail[0] . '" />';
		}
	} else{
		$thumbnail_id = get_post_thumbnail_id();
		if( !empty($thumbnail_id) ){
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '150x150' );
			echo '<link rel="image_src" href="' . $thumbnail[0] . '" />';		
		}
	}
	?>	
</head>
<body <?php echo body_class(); ?>>
<div class="body-wrapper">
	<?php 
		// decide to fetch the header background
		if( is_page() ){
			$background_id = get_post_meta( $post->ID, 'page-option-header-background', true );
			if( empty( $background_id ) ){
				$background_id = get_option(THEME_SHORT_NAME.'_page_header');
			}
		}else if( is_single($post->ID) ){	
			if( $post->post_type == 'post' ){
				$background_id = get_option(THEME_SHORT_NAME.'_post_header');
			}else if( $post->post_type == 'portfolio' ){
				$background_id = get_option(THEME_SHORT_NAME.'_portfolio_header');
			}
		}else if( is_archive() || is_search() ){
			$background_id = get_option(THEME_SHORT_NAME.'_archive_header');
		}else if( is_404() ){
			$background_id = get_option(THEME_SHORT_NAME.'_404_header');
		}
		
		// assign the header background
		if( empty($background_id) ){
			$background_url = array(GOODLAYERS_PATH.'/images/default-header.jpg'); 
		}else{
			$background_url = wp_get_attachment_image_src( $background_id , 'full' );
		}
		$header_part_bg = "url('" . $background_url[0] . "') center 0px repeat-x";
		
		$header_min_height = get_post_meta( $post->ID, 'page-option-header-min-height', true );
		if( empty( $header_min_height ) ) { $header_min_height = '170'; }

	?>
	<div class="header-part-wrapper" style="background: <?php echo $header_part_bg; ?>; min-height: <?php echo $header_min_height; ?>px">
		<div class="container navigation-container">
			<div class="header-wrapper">
				
				<!-- Get Logo -->
				<div class="logo-wrapper">
					<?php
						echo '<a href="' . home_url( '/' ) . '">';
						$logo_id = get_option(THEME_SHORT_NAME.'_logo');
						if( !empty($logo_id) ){
							$logo_attachment = wp_get_attachment_image_src($logo_id, 'full');
							$alt_text = get_post_meta($logo_id , '_wp_attachment_image_alt', true);
							$logo_attachment = $logo_attachment[0];
						}else{
							$logo_attachment = GOODLAYERS_PATH . '/images/default-logo.png';
							$alt_text = 'default logo';
						}
						echo '<img src="' . $logo_attachment . '" alt="' . $alt_text . '"/>';
						echo '</a>';
					?>
				</div>
				
				<!-- Navigation -->
				<div class="navigation-wrapper">
					<div class="responsive-navigation-wrapper">
						<!-- Get Responsive Navigation -->
						<?php if( $gdl_is_responsive ){ dropdown_menu( array('dropdown_title' => '-- Main Menu --', 'indent_string' => '- ', 'indent_after' => '','container' => 'div', 'container_class' => 'responsive-menu-wrapper', 'theme_location'=>'main_menu') );	} ?>
					</div>
					<div class="main-navigation-wrapper">
						<!-- Get Navigation -->
						<?php wp_nav_menu( array('container' => 'div', 'container_class' => 'menu-wrapper', 'container_id' => 'main-superfish-wrapper', 'menu_class'=> 'sf-menu',  'theme_location' => 'main_menu' ) ); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				
			</div> <!-- header-wrapper -->
		</div> <!-- container -->
		
		<?php 
			// Print Top Slider
			
			global $gdl_top_slider_type, $gdl_top_slider_xml;
			
			$slider_off = 'slider-off';
			$bottom_slider_on = '';

			if( is_page() && get_post_meta( $post->ID, 'page-option-enable-bottom-slider', true) == 'Yes' &&
				$gdl_top_slider_type != "No Slider" && !empty( $gdl_top_slider_type ) ){
				$bottom_slider_on = 'bottom-slider-on';			
			}			
			
			if( is_page() ){
				
				if ( $gdl_top_slider_type != "No Slider" && !empty( $gdl_top_slider_type ) ){
					
					echo '<div class="top-slider-wrapper">';
					if( $gdl_top_slider_type == "Custom Slider" ){
						$slider_xml = "<Slider>" . create_xml_tag('size', 'full-width');
						$slider_xml = $slider_xml . create_xml_tag('height', get_post_meta( $post->ID, 'page-option-top-slider-height', true) );
						$slider_xml = $slider_xml . create_xml_tag('width', 960);
						$slider_xml = $slider_xml . create_xml_tag('slider-type', $gdl_top_slider_type);
						$slider_xml = $slider_xml . $gdl_top_slider_xml;
						$slider_xml = $slider_xml . "</Slider>";
						$slider_xml_dom = new DOMDocument();
						$slider_xml_dom->loadXML($slider_xml);
						$slider_xml_item = $slider_xml_dom->documentElement;
						print_custom_slider( find_xml_node($slider_xml_item, 'slider-item') ); 	
					}else{
						echo '<div class="container">';
						$slider_xml = "<Slider>" . create_xml_tag('size', 'full-width');
						$slider_xml = $slider_xml . create_xml_tag('height', get_post_meta( $post->ID, 'page-option-top-slider-height', true) );
						$slider_xml = $slider_xml . create_xml_tag('width', 960);
						$slider_xml = $slider_xml . create_xml_tag('slider-type', $gdl_top_slider_type);
						$slider_xml = $slider_xml . $gdl_top_slider_xml;
						$slider_xml = $slider_xml . "</Slider>";
						$slider_xml_dom = new DOMDocument();
						$slider_xml_dom->loadXML($slider_xml);
						print_slider_item($slider_xml_dom->documentElement);
						echo '</div>'; // container
					}
					echo '</div>'; // top slider wrapper
					
					$slider_off = '';
				}else{
					echo '<div class="container page-title-wrapper">';
					echo '<div class="sixteen columns mb0">';
					echo '<h1 class="gdl-page-title gdl-title">';
					the_title();
					echo '</h1>';
					echo '<div class="gdl-page-caption">';
					echo get_post_meta( $post->ID, 'page-option-page-caption', true);
					echo '</div>';
					
					echo '</div>'; // sixteen columns
					echo '</div>'; // container
				}
			
			}else{
				// Print title
				if( is_single($post->ID) ){
					$page_title = get_the_title();
					$page_caption = get_post_meta( $post->ID, 'post-option-page-caption', true);
				}else{
					if(is_category() || is_tax('portfolio-category')){
						$page_title = __('Category','gdl_front_end');
						$page_caption = single_cat_title('', false);
					}else if(is_tag() || is_tax('portfolio-tag') ){
						$page_title = __('Tag','gdl_front_end');
						$page_caption = single_cat_title('', false);
					}else if( is_day() ){
						$page_title = __('Day','gdl_front_end');
						$page_caption = get_the_date( 'F j, Y' );
					}else if( is_month() ){
						$page_title = __('Month','gdl_front_end');
						$page_caption = get_the_date( 'F Y' );
					}else if( is_year() ){
						$page_title = __('Year','gdl_front_end');
						$page_caption = get_the_date( 'Y' );
					}else if( is_search() ){
						$page_title = __('Search','gdl_front_end');
						$page_caption = get_search_query();
					}
				}
			
				echo '<div class="container page-title-wrapper">';
				echo '<div class="sixteen columns mb0">';
				echo '<h1 class="gdl-page-title gdl-title">';
				echo $page_title;
				echo '</h1>';
				echo '<div class="gdl-page-caption">';
				echo $page_caption;
				echo '</div>';
				
				echo '</div>'; // sixteen columns
				echo '</div>'; // container				
			}			
		?>
	
		<!-- Print Social Icon -->
		<?php if( get_option( THEME_SHORT_NAME.'_enable_social_network', 'enable' ) == 'enable' ){ ?>
		<div class="container social-icon-container">
			<div class="social-icon-wrapper <?php echo $bottom_slider_on; ?>">
				<?php
					$header_icon_type = 'dark';
					$gdl_social_icon = array(
						'delicious'=> array('name'=>THEME_SHORT_NAME.'_delicious', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/delicious.png'),
						'deviantart'=> array('name'=>THEME_SHORT_NAME.'_deviantart', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/deviantart.png'),
						'digg'=> array('name'=>THEME_SHORT_NAME.'_digg', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/digg.png'),
						'facebook' => array('name'=>THEME_SHORT_NAME.'_facebook', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/facebook.png'),
						'flickr' => array('name'=>THEME_SHORT_NAME.'_flickr', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/flickr.png'),
						'lastfm'=> array('name'=>THEME_SHORT_NAME.'_lastfm', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/lastfm.png'),
						'linkedin' => array('name'=>THEME_SHORT_NAME.'_linkedin', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/linkedin.png'),
						'picasa'=> array('name'=>THEME_SHORT_NAME.'_picasa', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/picasa.png'),
						'rss'=> array('name'=>THEME_SHORT_NAME.'_rss', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/rss.png'),
						'stumble-upon'=> array('name'=>THEME_SHORT_NAME.'_stumble_upon', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/stumble-upon.png'),
						'tumblr'=> array('name'=>THEME_SHORT_NAME.'_tumblr', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/tumblr.png'),
						'twitter' => array('name'=>THEME_SHORT_NAME.'_twitter', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/twitter.png'),
						'vimeo' => array('name'=>THEME_SHORT_NAME.'_vimeo', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/vimeo.png'),
						'youtube' => array('name'=>THEME_SHORT_NAME.'_youtube', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/youtube.png'),
						'google_plus' => array('name'=>THEME_SHORT_NAME.'_google_plus', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/google-plus.png'),
						'email' => array('name'=>THEME_SHORT_NAME.'_email', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $header_icon_type . '/social/email.png')
						);
					
					foreach( $gdl_social_icon as $social_name => $social_icon ){
					
						$social_link = get_option($social_icon['name']);
						if( !empty($social_link) ){
						
							echo '<div class="social-icon"><a href="' . $social_link . '" target="_blank">' ;
							echo '<img src="' . $social_icon['url'] . '" alt="' . $social_name . '"/>';
							echo '</a></div>';
						
						}
						
					}
				?>
			</div> <!-- Social Icon Wrapper -->	
		</div> <!-- Conatiner -->		
		<?php } ?>
		
	</div> <!-- header-part-wrapper -->
	<?php 
		// Print Under Slider		
		if( !empty( $bottom_slider_on ) ){

			echo '<div class="bottom-slider-top-bar"></div>';
			echo '<div class="bottom-slider-wrapper">';
			echo '<div class="container">';
			
			echo '<div class="one-third column mb40">';
			echo do_shortcode( __(get_post_meta( $post->ID, 'page-option-bottom-slider-1', true), 'gdl_front_end') );
			echo '</div>';
			
			echo '<div class="one-third column mb40">';
			echo do_shortcode( __(get_post_meta( $post->ID, 'page-option-bottom-slider-2', true), 'gdl_front_end') );
			echo '</div>';

			echo '<div class="one-third column mb40">';
			echo do_shortcode( __(get_post_meta( $post->ID, 'page-option-bottom-slider-3', true), 'gdl_front_end') );
			echo '</div>';
			
			echo '<div class="clear"></div>';
			echo '</div>';
			echo '</div>'; // bottom-slider-wrapper

		}
	?>			
	<div class="header-bottom-bar <?php echo $slider_off; ?>"></div>
	<div class="content-part-wrapper <?php echo $slider_off; ?>">
		<div class="container">
		