<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title(); ?></title>

	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- CSS
  ================================================== -->
	<?php global $gdl_is_responsive; ?>
	<?php if( $gdl_is_responsive ){ ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<?php } ?>
	
	<!--[if IE 7]>
		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/ie7-style.css" /> 
		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/font-awesome/font-awesome-ie7.min.css" /> 
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
		if( !is_404() ){
			$thumbnail_id = get_post_thumbnail_id();
			if( !empty($thumbnail_id) ){
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '150x150' );
				echo '<meta property="og:image" content="' . $thumbnail[0] . '"/>';		
			}
		}
		
		// start calling header script
		wp_head();		

	?>
</head>
<body <?php echo body_class(); ?>>
<?php
	global $gdl_top_slider_xml, $gdl_top_slider_type;
	$full_slider = '';
	if( $gdl_top_slider_type == 'Title' || $gdl_top_slider_type == 'None' ||
		$gdl_top_slider_type == 'No Slider' || empty($gdl_top_slider_type) ){
			$full_slider = 'no-top-slider';
	}else{
			$full_slider = 'full-slider';
	}
	
	if( get_option(THEME_SHORT_NAME.'_boxed_style' ,'disable') == 'enable' ){
		$boxed_style = ' gdlr-boxed-style ';
	}
?>
<div class="body-outer-wrapper <?php echo $boxed_style; ?>" >
	<div class="body-wrapper">
		<div class="header-outer-wrapper <?php echo $full_slider; ?>">
			<div class="header-area-wrapper">
				<!-- top navigation -->
				<?php if( get_option(THEME_SHORT_NAME.'_enable_top_bar' ,true) == 'enable'){ ?>
					<div class="top-navigation-wrapper boxed-style">
						<div class="top-navigation-container container">
							<?php
								echo '<div class="top-social-wrapper">';
								
								// Get Social Icons
								$gdl_social_icon = array(
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
									'pinterest' => array('name'=>THEME_SHORT_NAME.'_pinterest', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/pinterest.png'),
									'instagram' => array('name'=>THEME_SHORT_NAME.'_instagram', 'url'=> GOODLAYERS_PATH.'/images/icon/social-icon/instagram.png')
								);				
								
								echo '<div id="gdl-social-icon" class="social-wrapper gdl-retina">';
								echo '<div class="social-icon-wrapper">';
								foreach( $gdl_social_icon as $social_name => $social_icon ){
									$social_link = get_option($social_icon['name']);
									
									if( !empty($social_link) ){
										echo '<div class="social-icon"><a target="_blank" href="' . $social_link . '">' ;
										echo '<img src="' . $social_icon['url'] . '" alt="' . $social_name . '" width="18" height="18" />';
										echo '</a></div>';
									}
								}
								echo '</div>'; // social icon wrapper
								echo '</div>'; // social wrapper								
								echo '</div>';
							
								$top_left_text = get_option(THEME_SHORT_NAME.'_top_navigation_left');
								if( !empty($top_left_text) ){
									echo '<div class="top-navigation-left-text">';
									echo do_shortcode( __( $top_left_text , 'gdl_front_end') );
									echo '</div>';
								}
								
								if( get_option(THEME_SHORT_NAME.'_enable_top_search', 'enable') == 'enable' ){
									echo '<div class="top-search-wrapper">'; 
									?>
									<div class="gdl-search-form">
										<form method="get" id="searchform" action="<?php  echo home_url(); ?>/">
											<input type="submit" id="searchsubmit" value="" />
											<div class="search-text" id="search-text">
												<input type="text" value="" name="s" id="s" autocomplete="off" data-default="<?php echo $search_val; ?>" />
											</div>
											<div class="clear"></div>
										</form>
									</div>
									<?php
									echo '</div>';
								}			

								$top_right_text = get_option(THEME_SHORT_NAME.'_top_navigation_right');
								if( !empty($top_right_text) ){
									echo '<div class="top-navigation-right-text">';
									echo do_shortcode( __( $top_right_text , 'gdl_front_end') );
									echo '</div>';
								}							
							?>
							<div class="clear"></div>
						</div>
					</div> <!-- top navigation wrapper -->
				<?php } ?>
				
				<div class="header-wrapper boxed-style">
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
									echo home_url();
									echo '"><img src="' . $logo_attachment . '" alt="' . $alt_text . '"/></a></h1>';	
								}else{
									echo '<a href="'; 
									echo home_url();
									echo '"><img src="' . $logo_attachment . '" alt="' . $alt_text . '"/></a>';				
								}
							?>
						</div>

						<!-- Navigation -->
						<div class="gdl-navigation-wrapper">
							<?php 
								// responsive menu
								if( $gdl_is_responsive && has_nav_menu('main_menu') ){
									dropdown_menu( array('dropdown_title' => '-- Main Menu --', 'indent_string' => '- ', 'indent_after' => '','container' => 'div', 'container_class' => 'responsive-menu-wrapper', 'theme_location'=>'main_menu') );	
									echo '<div class="clear"></div>';
								}
								
								// main menu
								$sliding_bar = (get_option(THEME_SHORT_NAME.'_enable_sliding_bar', 'enable') == 'enable')? 'sliding-bar': '';
								
								echo '<div class="navigation-wrapper ' . $sliding_bar . '">';
								if( has_nav_menu('main_menu') ){
									if( !empty($sliding_bar) ){
										echo '<div class="gdl-current-menu" ></div>'; 
									}
									
									echo '<div class="main-superfish-wrapper" id="main-superfish-wrapper" >';
									wp_nav_menu( array('container' => '', 'menu_class'=> 'sf-menu',  'theme_location' => 'main_menu' ) );
									echo '<div class="clear"></div>';
									echo '</div>';
								}
								echo '<div class="clear"></div>';
								echo '</div>'; // navigation-wrapper 
							?>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div> <!-- header container -->
				</div> <!-- header area -->		
			</div> <!-- header wrapper -->		
			<?php
				if( is_page() ){
					// Top Slider Part				
					if( $gdl_top_slider_type == 'Layer Slider' ){
						$layer_slider_id = get_post_meta( $post->ID, 'page-option-layer-slider-id', true);
						echo '<div class="gdl-top-slider">';
						echo '<div class="gdl-top-slider-wrapper ' . $full_slider . '">';
						echo do_shortcode('[layerslider id="' . $layer_slider_id . '"]');
						echo '<div class="clear"></div>';
						echo '</div>';
						echo '</div>';
					}else if( $gdl_top_slider_type == 'Master Slider' ){
						$master_slider_shortcode = get_post_meta( $post->ID, 'page-option-master-slider-id', true);
						echo '<div class="gdl-top-slider">';
						echo '<div class="gdl-top-slider-wrapper ' . $full_slider . '">';
						echo do_shortcode($master_slider_shortcode);
						echo '<div class="clear"></div>';
						echo '</div>';
						echo '</div>';
					}else if( empty($gdl_top_slider_type) || $gdl_top_slider_type == 'Title' || $gdl_top_slider_type == 'No Slider' ){
						$page_caption = get_post_meta($post->ID, 'page-option-caption', true);
						print_page_header(get_the_title(), $page_caption);					
					}else if ( $gdl_top_slider_type != "None"){
						echo '<div class="gdl-top-slider">';
						echo '<div class="gdl-top-slider-wrapper ' . $full_slider . '">';			
						$slider_xml = "<Slider>" . create_xml_tag('size', 'full-width');
						$slider_xml = $slider_xml . create_xml_tag('slider-type', $gdl_top_slider_type);
						$slider_xml = $slider_xml . $gdl_top_slider_xml;
						$slider_xml = $slider_xml . "</Slider>";
						$slider_xml_dom = new DOMDocument();
						$slider_xml_dom->loadXML($slider_xml);
						print_slider_item($slider_xml_dom->documentElement);
						echo '<div class="clear"></div>';
						echo '</div>';
						echo '</div>';
					}	
					
					// Under Slider Area
					if(get_post_meta( $post->ID, 'page-option-enable-bottom-slider', true) == 'Yes'){
						$stunning_title = get_post_meta( $post->ID, 'page-option-under-slider-title', true);
						$stunning_caption = get_post_meta( $post->ID, 'page-option-under-slider-caption', true);
						$stunning_button_text = get_post_meta( $post->ID, 'page-option-under-slider-button-text', true);
						$stunning_button_link = get_post_meta( $post->ID, 'page-option-under-slider-button-link', true);
						
						$button_class = (!empty($stunning_button_text) && !empty($stunning_button_link))? 'button-on': '';
						
						echo '<div class="under-slider-wrapper">';
						echo '<div class="under-slider-container container">';
						
						echo '<div class="under-slider-inner-wrapper ' . $button_class . '">';
						echo '<h2 class="under-slider-title">' . $stunning_title . '</h2>';
						echo '<div class="under-slider-caption">' . $stunning_caption . '</div>';
						if( !empty($stunning_button_text) && !empty($stunning_button_link) ){
							echo '<a href="' . $stunning_button_link . '" class="under-slider-button gdl-button large">';
							echo $stunning_button_text . '</a>';
						}
						echo '</div>';
						
						echo '</div>';
						echo '</div>';
					}
					
				}else if( is_single() ){
					if( $post->post_type == 'portfolio' ){
						$single_title = get_the_title();
						$single_caption = get_post_meta( $post->ID, "post-option-blog-header-caption", true);
						print_page_header($single_title, $single_caption);					
					}else if($post->post_type == 'package'){
						$single_title = get_the_title();
						$single_caption = get_post_meta( $post->ID, "post-option-blog-header-caption", true);
						print_page_header($single_title, $single_caption);
					}else{
						$single_title = get_post_meta( $post->ID, "post-option-blog-header-title", true);
						$single_caption = get_post_meta( $post->ID, "post-option-blog-header-caption", true);
						if(empty( $single_title )){
							$single_title = get_option(THEME_SHORT_NAME . '_default_post_header','Blog Post');
							$single_caption = get_option(THEME_SHORT_NAME . '_default_post_caption');
						}
						print_page_header($single_title, $single_caption);			
					}	
				}else if( is_404() ){
					global $gdl_admin_translator;
					if( $gdl_admin_translator == 'enable' ){
						$translator_404_title = get_option(THEME_SHORT_NAME.'_404_title', 'Page Not Found');
					}else{
						$translator_404_title = __('Page Not Found','gdl_front_end');		
					}			
					print_page_header($translator_404_title);
				}else if( is_search() ){
					global $gdl_admin_translator;
					if( $gdl_admin_translator == 'enable' ){
						$title = get_option(THEME_SHORT_NAME.'_search_header_title', 'Search Results');
					}else{
						$title = __('Search Results', 'gdl_front_end');
					}		
					
					$caption = get_search_query();
					print_page_header($title, $caption);
				}else if( is_archive() ){
					
					if( is_category() || is_tax('portfolio-category') || is_tax('product_cat') ||
						is_tax('package-category')){
						$title = __('Category','gdl_front_end');
						$caption = single_cat_title('', false);
					}else if( is_tag() || is_tax('portfolio-tag') || is_tax('product_tag') ||
						is_tax('package-tag') ){
						$title = __('Tag','gdl_front_end');
						$caption = single_cat_title('', false);
					}else if( is_day() ){
						$title = __('Day','gdl_front_end');
						$caption = get_the_date('F j, Y');
					}else if( is_month() ){
						$title = __('Month','gdl_front_end');
						$caption = get_the_date('F Y');
					}else if( is_year() ){
						$title = __('Year','gdl_front_end');
						$caption = get_the_date('Y');
					}else if( is_author() ){
						$title = __('By','gdl_front_end');
						
						$author_id = get_query_var('author');
						$author = get_user_by('id', $author_id);
						$caption = $author->display_name;					
					}else{
						$title = __('Shop','gdl_front_end');
					}
							
					print_page_header($title, $caption);				
				} 
			?>
		</div> <!-- header outer wrapper -->