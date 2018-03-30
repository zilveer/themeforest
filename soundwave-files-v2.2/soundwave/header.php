<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- ### BEGIN HEAD ####  -->
<head>

<!-- Meta -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Title -->
<title><?php 
	$prefix = false;
		
		 if (function_exists('is_tag') && is_tag()) {
			single_tag_title('Tag Archive for &quot;'); 
			echo '&quot; - '; 
			
			$prefix = true;
		 } elseif (is_archive()) {
			
			wp_title(''); echo ' '.__('Archive').' - '; 
			$prefix = true;
			
		 } elseif (is_search()) {
			
			echo __('Search for', 'wizedesign').' &quot;'.wp_specialchars($s).'&quot; - '; 
			$prefix = true;
			
		 } elseif (!(is_404()) && (is_single()) || (is_page())) {
				wp_title(''); 
				echo '  ';
		 } elseif (is_404()) {
			echo __('Not Found', 'wizedesign').' - ';
		 }
		 
		 if (is_home()) {
			bloginfo('name'); echo ' - '; bloginfo('description');
		 } else {
		  bloginfo('name');
		 }
		 
		 if ($paged > 1) {
			echo ' - page '. $paged; 
		 }
	?></title>
	
<!-- Favicon -->
<?php 
		if (of_get_option('favicon_upload','true') == 'true'){					
		    }else{
                          if (of_get_option('favicon_upload',null) != null){
                             $favicon_url = of_get_option('favicon_upload');
                             }else{
                             $favicon_url = get_template_directory_uri().'/images/favicon.ico';
                          }
							
                 echo '<link rel="shortcut icon" href="'.$favicon_url.'" />';
                 }
?>


<!-- Wordpress functions -->	
<?php wp_head(); ?>
</head>


<!-- Begin Body -->
<body  <?php body_class(); ?>> 

<?php
$playerar = of_get_option('player_audio_radio');
if (of_get_option('active_player', '1') == '1') {
switch ($playerar) {
		 case "player_audio":
		 echo ' '. get_template_part( 'player' ) . '';
		 break;
		 
		 case "player_radio":
		 echo ' '. get_template_part( 'radio' ) . '';
		 break;
		 }
}		 
?>

<!-- Header -->
<div id="header"> 			
   <div class="header-row clearfix">		

      <div id="logo">					
<?php 
		if (of_get_option('logo_upload','true') == 'true'){					
		    }else{
                          if (of_get_option('logo_upload',null) != null){
                             $logo_url = of_get_option('logo_upload');
                             }else{
                             $logo_url = get_template_directory_uri().'/images/logo.png';
                          }
							
                 echo '
         <a href="'.get_bloginfo('url').'"><img src="'.$logo_url.'" alt="logo" /></a>';
                 }
?>
      </div><!-- end #logo --> 
  
<?php
$headerfeat = of_get_option('header_feat');	
switch ($headerfeat) {
		 case "header_event":
		 echo ' '. get_template_part( 'event-features' ) . '';	
		 break;
		 
		 case "header_banner":
		 echo ' '. get_template_part( 'banner-features' ) . '';	
		 break;
		 }
?>


   </div><!-- end .header-row clearfix -->   

   <div id="main">
      <div class="main-navigation">
<?php
wp_nav_menu(array(
    'menu' => 'Main Menu',
    'container_id' => 'wizemenu',
    'walker' => new CSS_Menu_Maker_Walker()
));
?>	

      </div><!-- end .main-navigation -->	
	  
<?php
if (of_get_option('social_header', '1') == '1') {
?>
      <div class="header-social">
         <ul id="footer-social">
        
<?php
if (of_get_option('facebook') != "") {
?>
            <li class="facebook footer-social"><a href="<?php
    echo of_get_option('facebook', 'no entry');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('twitter') != "") {
?>
            <li class="twitter footer-social"><a href="<?php
    echo of_get_option('twitter');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('digg') != "") {
?>
            <li class="digg footer-social"><a href="<?php
    echo of_get_option('digg');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('youtube') != "") {
?>
            <li class="youtube footer-social"><a href="<?php
    echo of_get_option('youtube');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('vimeo') != "") {
?>
            <li class="vimeo footer-social"><a href="<?php
    echo of_get_option('vimeo');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('rss') != "") {
?>
            <li class="rss footer-social"><a href="<?php
    echo of_get_option('rss');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('flickr') != "") {
?>
            <li class="flickr1 footer-social"><a href="<?php
    echo of_get_option('flickr');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('lastfm') != "") {
?>
            <li class="lastfm footer-social"><a href="<?php
    echo of_get_option('lastfm');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('pinterest') != "") {
?>
            <li class="pinterest footer-social"><a href="<?php
    echo of_get_option('pinterest');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('vk') != "") {
?>
            <li class="vk footer-social"><a href="<?php
    echo of_get_option('vk');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('google') != "") {
?>
            <li class="google footer-social"><a href="<?php
    echo of_get_option('google');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('amazon') != "") {
?>
            <li class="amazon footer-social"><a href="<?php
    echo of_get_option('amazon');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('beatport') != "") {
?>
            <li class="beatport footer-social"><a href="<?php
    echo of_get_option('beatport');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('myspace') != "") {
?>
            <li class="myspace footer-social"><a href="<?php
    echo of_get_option('myspace');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('instagram') != "") {
?>
            <li class="instagram footer-social"><a href="<?php
    echo of_get_option('instagram');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('mixcloud') != "") {
?>
            <li class="mixcloud footer-social"><a href="<?php
    echo of_get_option('mixcloud');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('soundcloud') != "") {
?>
            <li class="soundcloud footer-social"><a href="<?php
    echo of_get_option('soundcloud');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('resident') != "") {
?>
            <li class="resident footer-social"><a href="<?php
    echo of_get_option('resident');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('tumblr') != "") {
?>
            <li class="tumblr footer-social"><a href="<?php
    echo of_get_option('tumblr');
?>" target="_blank"></a></li><?php
}
?>

         </ul>
	  </div><!-- end .header-social -->
<?php
}
?>	
  
   </div><!-- end #main -->     
</div><!-- end #header -->

<!-- Wrap -->
<div class="wrap clearfix">
<div id="wrcon">