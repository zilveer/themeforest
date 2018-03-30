<!DOCTYPE html>
<!--[if IE 8]> 	<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>  

	<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        
    <?php  $alc_options = get_option('alc_general_settings'); ?>
	
   	<?php if(!empty($alc_options['alc_favicon'])):?>
		<link rel="shortcut icon" href="<?php echo $alc_options['alc_favicon'] ?>" /> 
 	<?php endif?>
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri() ?>/js/html5.js"></script><![endif]-->
	<!--[if IE 8]><link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/ie8-grid-foundation-4.css" /><![endif]-->
	
    <?php 
   		$bodyFont = isset($alc_options['alc_body_font']) ? $alc_options['alc_body_font'] : 'off';
		$headingsFont =(isset($alc_options['alc_headings_font']) && $alc_options['alc_headings_font'] !== 'off') ? $alc_options['alc_headings_font'] : 'off';
		$menuFont = (isset($alc_options['alc_menu_font']) && $alc_options['alc_menu_font'] !== 'off') ? $alc_options['alc_menu_font'] : 'off';
	
		$fonts['body, p, .content_wrapper a, #menu-top-menu a, ol, .content_wrapper li #menu-top-menu li, label, #copyright'] = $bodyFont;
		$fonts['h1, h2, h3, h4, h5, h6'] = $headingsFont;
		$fonts['#menu-main a'] = $menuFont;
		
		foreach ($fonts as $value => $key)
		{
			if($key != 'off' && $key != ''){ 
				$api_font = str_replace(" ", '+', $key);
				$font_name = font_name($key);
				
				echo '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family='.$api_font.'" />';
				echo "<style type=\"text/css\">".$value."{ font-family: '".$key."' !important; }</style>";			
			}
		}
	?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="main-wrapper">
	<?php if (!is_page_template('under-construction.php')):?>
		<div class="row top-header">
			<div class="large-8 columns">
				 <?php echo isset ($alc_options['alc_top_header_left_info']) ? do_shortcode($alc_options['alc_top_header_left_info']) : '';?>
			</div>
			<div class="large-4 columns">
				<?php echo isset ($alc_options['alc_top_header_right_info']) ? do_shortcode($alc_options['alc_top_header_right_info']) : '';?>
			</div> 
		</div>
		<div class="row bottom-header">
			<div class="large-12 columns center">
				<a href="<?php echo home_url() ?>" id="logo">
					<?php if(!empty($alc_options['alc_logo'])):?>
						<img src="<?php echo $alc_options['alc_logo'] ?>" alt="<?php echo $alc_options['alc_logotext']?>" width="300" height="115" id="logo-image">
					<?php else:?>
						<?php echo isset($alc_options['alc_logotext']) ? $alc_options['alc_logotext'] : 'Evolution' ?>
					<?php endif?>
				</a>
				<!-- <h2>FGX F4</h2> -->
				<!-- <h3 class="subheader">A responsive HTML Frontend Framework based on Foundation 4 from Zurb</h3> -->
			</div>
		</div>
		<div class="row main-navigation">
			<div class="large-12 columns">			
				<nav class="top-bar">
					<ul class="title-area">
						<!-- Toggle Button Mobile -->
						<li class="name"></li>
						<li class="toggle-topbar menu-icon"><a href="#"><span><?php _e('Main Menu', 'Evolution')?></span></a></li>
						<!-- End Toggle Button Mobile -->
					</ul>
					<section class="top-bar-section">
					<?php 
					$walker = new My_Walker;
					if(function_exists('wp_nav_menu')):
						wp_nav_menu( 
							array( 
								'theme_location' => 'primary_nav',
								'menu' =>'primary_nav', 
								'container'=>'', 
								'depth' => 4, 
								'menu_class' => 'left',
								'walker' => $walker
							)  
						); 
					else:
						?><ul class="sf-menu top-level-menu"><?php wp_list_pages('title_li=&depth=4'); ?></ul><?php
					endif; 
					?>				 
					</section>
				</nav>
			</div>
		</div>
	<?php endif;?>