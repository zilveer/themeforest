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
		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/skeleton.css">
		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/layout.css">
	
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

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	

	<!-- FB Thumbnail
   ================================================== -->
	<?php
	if( is_single() ){
		$thumbnail_id = get_post_meta($post->ID,'post-option-inside-thumbnial-image', true);
		if( !empty($thumbnail_id) ){
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '150x150' );
			echo '<link rel="image_src" href="' . $thumbnail[0] . '" />';
		}else{
			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			if( !empty($thumbnail_id) ){
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '150x150' );
				echo '<link rel="image_src" href="' . $thumbnail[0] . '" />';	
			}		
		}
	}else{
		$thumbnail_id = get_post_thumbnail_id( $post->ID );
		if( !empty($thumbnail_id) ){
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '150x150' );
			echo '<link rel="image_src" href="' . $thumbnail[0] . '" />';	
		}		
	}
	?>
	
	<!-- Start WP_HEAD
   ================================================== -->
	<?php wp_head(); ?>
	
</head>
<body <?php echo body_class(); ?>>
<?php
	$background_style = get_option(THEME_SHORT_NAME.'_background_style', 'Pattern');
	if($background_style == 'Custom Image'){
		$background_id = get_option(THEME_SHORT_NAME.'_background_custom');
		if(!empty($background_id)){
			$background_image = wp_get_attachment_image_src( $background_id, 'full' );
			echo '<div id="custom-full-background">';
			echo '<img src="' . $background_image[0] . '" alt="" />';
			echo '</div>';
		}
	}
?>
<div class="body-wrapper">	
	<?php $gdl_enable_top_navigation = get_option(THEME_SHORT_NAME.'_enable_top_navigation');
	if ( $gdl_enable_top_navigation == '' || $gdl_enable_top_navigation == 'enable' ){  ?>
	<div class="top-navigation-wrapper">
		<div class="top-navigation container">
			<div class="eight columns mb0">
				<div class="top-navigation-left">
					<?php wp_nav_menu( array( 'theme_location' => 'top_menu' ) ); ?>
				</div>
			</div>
			<div class="eight columns mb0">
				<div class="top-navigation-right">
					<!-- Get Search form -->
					<?php if(get_option(THEME_SHORT_NAME.'_enable_top_search','enable') == 'enable'){?>
					<div class="search-left-gimmick"></div>
					<div class="search-wrapper"><?php get_search_form(); ?></div> 
					<div class="search-right-gimmick"></div>
					<?php } ?>		
				</div>
			</div>
		</div>
		<div class="top-navigation-wrapper-gimmick">
		</div>
	</div>

	<?php } ?>

	<div class="container">
		<div class="header-wrapper">
			
			<!-- Get Logo -->
			<div class="eight columns mb0">
				<div class="logo-wrapper">
					<?php
						echo '<a href="' . home_url( '/' ) . '">';
						$logo_attachment = wp_get_attachment_image_src(get_option(THEME_SHORT_NAME.'_logo'), 'full');
						if( !empty($logo_attachment) ){
							$logo_attachment = $logo_attachment[0];
						}else{
							$logo_attachment = GOODLAYERS_PATH . '/images/default-logo.png';
						}
						echo '<img src="' . $logo_attachment . '" alt="logo"/>';
						echo '</a>';
					?>
				</div>
			</div>
			<!-- Get Social Icons -->
			<div class="eight columns wrapper mb0">
			<?php
				if( get_option( THEME_SHORT_NAME.'_enable_banner_social','enable' ) == 'enable' ){
					$thumbnail_id = get_option( THEME_SHORT_NAME.'_banner_image' );
					if( !empty( $thumbnail_id ) ){
						$banner_frame = get_option( THEME_SHORT_NAME.'_banner_frame_enable', 'enable' );
						
						$banner_link = get_option( THEME_SHORT_NAME.'_banner_link', '#' );
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'full' );
						$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);	
						echo '<div class="eight columns mb0 alignright">';
						echo '<div class="top-banner-wrapper">';
						
						if( $banner_frame == 'enable' ){
							echo '<div class="bkp-frame-wrapper">';
						}
						
						echo '<a href="' . $banner_link . '" target="_blank">';
						echo '<img src="' . $thumbnail[0] . '" alt="' . $alt_text . '" />';
						echo '</a>';

						if( $banner_frame == 'enable' ){					
							echo '</div>';
						}
						
						echo '</div>'; // top-banner-wrapper
						echo '</div>'; // columns
					}	
				}else{
			
			?>
				<div class="social-wrapper">
					<?php
						$gdl_social_wrapper_text = get_option(THEME_SHORT_NAME.'_social_wrapper_text');
						if( !empty($gdl_social_wrapper_text) ){
						
							echo '<div class="social-wrapper-text">' . $gdl_social_wrapper_text . '</div>';
							
						}
					?>	
					<div class="social-icon-wrapper">
						<?php
							global $gdl_icon_type;
							$gdl_social_icon = array(
								'delicious'=> array('name'=>THEME_SHORT_NAME.'_delicious', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/delicious.png'),
								'deviantart'=> array('name'=>THEME_SHORT_NAME.'_deviantart', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/deviantart.png'),
								'digg'=> array('name'=>THEME_SHORT_NAME.'_digg', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/digg.png'),
								'facebook' => array('name'=>THEME_SHORT_NAME.'_facebook', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/facebook.png'),
								'flickr' => array('name'=>THEME_SHORT_NAME.'_flickr', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/flickr.png'),
								'lastfm'=> array('name'=>THEME_SHORT_NAME.'_lastfm', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/lastfm.png'),
								'linkedin' => array('name'=>THEME_SHORT_NAME.'_linkedin', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/linkedin.png'),
								'picasa'=> array('name'=>THEME_SHORT_NAME.'_picasa', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/picasa.png'),
								'rss'=> array('name'=>THEME_SHORT_NAME.'_rss', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/rss.png'),
								'stumble-upon'=> array('name'=>THEME_SHORT_NAME.'_stumble_upon', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/stumble-upon.png'),
								'tumblr'=> array('name'=>THEME_SHORT_NAME.'_tumblr', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/tumblr.png'),
								'twitter' => array('name'=>THEME_SHORT_NAME.'_twitter', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/twitter.png'),
								'vimeo' => array('name'=>THEME_SHORT_NAME.'_vimeo', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/vimeo.png'),
								'youtube' => array('name'=>THEME_SHORT_NAME.'_youtube', 'url'=> GOODLAYERS_PATH.'/images/icon/' . $gdl_icon_type . '/social/youtube.png')
								);
							
							foreach( $gdl_social_icon as $social_name => $social_icon ){
							
								$social_link = get_option($social_icon['name']);
								if( !empty($social_link) ){
								
									echo '<div class="social-icon"><a href="' . $social_link . '">' ;
									echo '<img src="' . $social_icon['url'] . '" alt="' . $social_name . '"/>';
									echo '</a></div>';
								
								}
								
							}
						?>
					</div>
				</div>
			<?php } // end-if enable banner social ?> 
			</div>
			<br class="clear">
			<!-- Navigation and Search Form -->
			<div class="sixteen columns">
				<?php dropdown_menu( array('dropdown_title' => '-- Main Menu --', 'indent_string' => '- ', 'indent_after' => '','container' => 'div', 'container_class' => 'responsive-menu-wrapper', 'theme_location'=>'main_menu') ); ?>	
				<div class="navigation-top-gimmick"></div>
				<div class="navigation-wrapper">			
					<!-- Get Navigation -->
					<?php wp_nav_menu( array('container' => 'div', 'container_class' => 'menu-wrapper', 'container_id' => 'main-superfish-wrapper', 'menu_class'=> 'sf-menu',  'theme_location' => 'main_menu' ) ); ?>
					
					<br class="clear">
				</div>
			</div>
			<br class="clear">
		</div> <!-- header-wrapper -->
		