<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package iEVENT
 */

?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<?php global $ievent_data;
	  global $mobile_detect;
	  global $ievent_alert_stat;
	  global $post;
	   ?>
      
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
   	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="author" content="">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
    <!-- Mobile Specific Metas
  ================================================== -->
    <?php if($ievent_data['check_responsive'] == 1) { ?><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"><?php } ?>    
    <?php if($ievent_data['favicon'] != "") { ?><link rel="shortcut icon" href="<?php echo esc_url($ievent_data['favicon']); ?>"><?php } ?>    
    <?php if($ievent_data['iphone_icon'] != "") { ?><link rel="apple-touch-icon" href="<?php echo esc_url($ievent_data['iphone_icon']); ?>"><?php } ?>    
    <?php if($ievent_data['iphone_icon_retina'] != "") { ?><link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url($ievent_data['iphone_icon_retina']); ?>"><?php } ?>   
    <?php if($ievent_data['ipad_icon'] != "") { ?><link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url($ievent_data['ipad_icon']); ?>"><?php } ?>    
    <?php if($ievent_data['ipad_icon_retina'] != "") { ?><link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url($ievent_data['ipad_icon_retina']); ?>"><?php } ?>
	<!-- CSS
  ================================================== -->
	
    <!-- Web Fonts  -->
    <!--Google Web Font Loader-->
    <?php if($ievent_data['google_body_font'] && $ievent_data['google_body_font'] != 'Select Font'): ?>
	<?php $google_fonts[urlencode(esc_attr($ievent_data['google_body_font']))]= '"'.urlencode(esc_attr($ievent_data['google_body_font'])). ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
	<?php endif; ?>
   
    <?php if($ievent_data['google_menu_font'] && $ievent_data['google_menu_font'] != 'Select Font' && $ievent_data['google_menu_font'] != $ievent_data['google_body_font']): ?>
	<?php $google_fonts[urlencode(esc_attr($ievent_data['google_menu_font']))]= '"'.urlencode(esc_attr($ievent_data['google_menu_font'])). ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
	<?php endif; ?>
    
     <?php if($ievent_data['google_headings_font'] && $ievent_data['google_headings_font'] != 'Select Font' && $ievent_data['google_headings_font'] != $ievent_data['google_body_font'] && $ievent_data['google_headings_font'] != $ievent_data['google_menu_font']): ?>
	<?php $google_fonts[urlencode(esc_attr($ievent_data['google_headings_font']))]= '"'.urlencode(esc_attr($ievent_data['google_headings_font'])). ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
	<?php endif; ?>
    
     <?php if($ievent_data['google_footer_headings_font'] && $ievent_data['google_footer_headings_font'] != 'Select Font' && $ievent_data['google_footer_headings_font'] != $ievent_data['google_body_font'] && $ievent_data['google_footer_headings_font'] != $ievent_data['google_menu_font'] && $ievent_data['google_footer_headings_font'] != $ievent_data['google_headings_font']): ?>
	<?php $google_fonts[urlencode(esc_attr($ievent_data['google_footer_headings_font']))]= '"'.urlencode(esc_attr($ievent_data['google_body_font'])). ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
	<?php endif; ?>
    
    <?php if($ievent_data['google_font_manual_load'] && $ievent_data['google_font_manual_load'] != 'Select Font'): ?>
	<?php $google_fonts[urlencode(esc_attr($ievent_data['google_font_manual_load']))]= '"'.urlencode(esc_attr($ievent_data['google_font_manual_load'])). ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
	<?php endif; ?>
    
    
   <?php if($google_fonts): ?>
	<?php
	if(is_array($google_fonts) && !empty($google_fonts)) {
		$google_fonts = implode($google_fonts, ', ');
	}
	?>
	<?php endif; ?>
    
    <script type="text/javascript">
	WebFontConfig = {
		<?php if(!empty($google_fonts)): ?>google: { 
		families:[ <?php echo $google_fonts; ?> ]},
		<?php endif; ?>
		
	};
	(function() {
		var wf = document.createElement('script');
		wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
		  '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(wf, s);
	})();
	</script>   
   
   
    <!--[if IE]>
        <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
    
    <!--[if lte IE 8]>
        <script src="vendor/respond.js"></script>
    <![endif]-->
    
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
    
	<?php wp_head(); ?>
    
    
    <style>
	<?php echo esc_attr($ievent_data['custom_css_style']); // Space for custom css code ?>
	</style>
	<?php echo esc_attr($ievent_data['head_code']); // Space for code before head tag ?>
    
</head>  

<?php 
	//Boxed Options
	if ($ievent_data['select_layout']=='boxed'): 
		$boxed_stat='boxed';
 	else: 
   		$boxed_stat='';
 	endif;
?>

<body <?php body_class($boxed_stat); ?>>
	
   
   <!-- BOF Loader -->
     
     <?php if($ievent_data['check_preloader']):?>
         <div class="loader">
             <div class="spinner spinner-double-bounce">
                  <div class="double-bounce1"></div>
                  <div class="double-bounce2"></div>
             </div>
        </div>
        <!-- EOF Loader -->
    <?php endif; ?>
    
    <div class="jx-time-zone" data-zone="<?php echo get_option('timezone_string'); ?>"></div>
    
    <!-- Alert Stat -->    
    <div class="jx-ievent-alert"></div>
    
    <?php 
			if(($ievent_data['select_header']=='header-10') || 
			   ($ievent_data['select_header']=='header-9')|| 
			   ($ievent_data['select_header']=='header-8')|| 
			   ($ievent_data['select_header']=='header-6')|| 
			   ($ievent_data['select_header']=='header-5')|| 
			   ($ievent_data['select_header']=='header-4')|| 
			   ($ievent_data['select_header']=='header-3')|| 
			   ($ievent_data['select_header']=='header-2')) 
			   {
			
				if(is_page('header-10')) {
					include_once get_template_directory().'/inc/header/header-10.php';
				} elseif(is_page('header-9')) {
					include_once get_template_directory().'/inc/header/header-9.php';
				} elseif(is_page('header-8')) {
					include_once get_template_directory().'/inc/header/header-8.php';
				} elseif(is_page('header-6')) {
					include_once get_template_directory().'/inc/header/header-6.php';
				} elseif(is_page('header-5')) {
					include_once get_template_directory().'/inc/header/header-5.php';
				} elseif(is_page('header-4')) {
					include_once get_template_directory().'/inc/header/header-4.php';
				} elseif(is_page('header-3')) {
					include_once get_template_directory().'/inc/header/header-3.php';
				} elseif(is_page('header-2')) {
					include_once get_template_directory().'/inc/header/header-2.php';
				}else{
					include_once get_template_directory().'/inc/header/'.$ievent_data['select_header'].'.php';
				}
				
			} else {
			
				if(is_page('header-10')) {
					include_once get_template_directory().'/inc/header/header-10.php';
				} elseif(is_page('header-9')) {
					include_once get_template_directory().'/inc/header/header-9.php';
				} elseif(is_page('header-8')) {
					include_once get_template_directory().'/inc/header/header-8.php';
				} elseif(is_page('header-6')) {
					include_once get_template_directory().'/inc/header/header-6.php';
				} elseif(is_page('header-5')) {
					include_once get_template_directory().'/inc/header/header-5.php';
				} elseif(is_page('header-4')) {
					include_once get_template_directory().'/inc/header/header-4.php';
				} elseif(is_page('header-3')) {
					include_once get_template_directory().'/inc/header/header-3.php';
				} elseif(is_page('header-2')) {
					include_once get_template_directory().'/inc/header/header-2.php';
				}
				
				
			}
		

		?>
   
    <!-- BOF Slider -->
    <div class="jx-ievent-slider <?php echo $ievent_data['select_header']; ?> <?php echo $post->post_name; ?>">
    	
    
        <!-- BOF Header -->
        <?php if(!is_page_template('blank.php')):?>    
        <div class="jx-ievent-top-black"></div>
        
        <?php 
			
			if(($ievent_data['select_header']=='header-1') or
				($ievent_data['select_header']=='header-7')) {
				if(is_page('header-1')) {
					include_once get_template_directory().'/inc/header/header-1.php';
				}elseif(is_page('header-7')) {
					include_once get_template_directory().'/inc/header/header-7.php';
				}else{
					
					if(!is_page('header-2') & !is_page('header-3') & !is_page('header-4') & !is_page('header-5') & !is_page('header-6') & !is_page('header-8') & !is_page('header-9') & !is_page('header-10')){
					include_once get_template_directory().'/inc/header/'.$ievent_data['select_header'].'.php';
					}
				}
			} else {
				if(is_page('header-1')) {
					include_once get_template_directory().'/inc/header/header-1.php';
				}elseif(is_page('header-7')) {
					include_once get_template_directory().'/inc/header/header-7.php';
				}
			}

		?>
        
        <?php get_template_part('inc/titlebar'); ?>
    	
		<?php endif; ?>
        
    </div>    
    <!-- BOF Slider -->
    
   