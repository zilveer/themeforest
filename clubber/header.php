<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- ### BEGIN HEAD ####  -->
<head>

<!-- Meta -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

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
			
			echo __('Search for', 'clubber').' &quot;'.wp_specialchars($s).'&quot; - '; 
			$prefix = true;
			
		 } elseif (!(is_404()) && (is_single()) || (is_page())) {
				wp_title(''); 
				echo '  ';
		 } elseif (is_404()) {
			echo __('Not Found', 'clubber').' - ';
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
                             $favicon_url = get_template_directory_uri().'/favicon.ico';
                          }
							
                 echo '<link rel="shortcut icon" href="'.$favicon_url.'" />';
                 }
?>


<!-- Stylesheets -->
<?php
$font = of_get_option('font_pred');

echo '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family='. urlencode( $font ) .'" type="text/css" media="screen" />';

?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/css_options.php" type="text/css" media="screen" />
<?php
$style_type = of_get_option('style_pred');
switch ($style_type ) {
       case "dark_style": 
	   echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/dark.css" type="text/css" media="screen" />';
}
switch ($style_type ) {
       case "light_style": 
	   echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/light.css" type="text/css" media="screen" />';
}
?>


<!-- Wordpress functions -->	
<?php wp_head(); ?>


<?php if(of_get_option('analytics_code')!="") {?>
<!-- Google analytics -->
<script type="text/javascript">
<?php echo of_get_option('analytics_code'); ?>
</script>
<?php } ?>
     
</head>

<!-- Begin Body -->
<body  <?php body_class(); ?>> 

<?php
$type = of_get_option('type_background');
$image = of_get_option('background_upload');

switch ($type ) {
		 case "image": 
		 echo '<!-- Background Image -->
<script>
jQuery(document).ready(function($){
    $.backstretch("'.$image.'");
});
</script>';
break;
}
?>


<!-- Header -->
<div id="header"> 			
  <div class="header-row fixed">		
    <div id="logo">					
<?php 
		if (of_get_option('logo_upload','true') == 'true'){					
		    }else{
                          if (of_get_option('logo_upload',null) != null){
                             $logo_url = of_get_option('logo_upload');
                             }else{
                             $logo_url = get_template_directory_uri().'/_layout/images/logo.png';
                          }
							
                 echo '
      <a href="'.home_url().'"><img src="'.$logo_url.'" alt="logo" /></a>';
                 }
?>
    </div><!-- end #logo -->
	
    <div id="main">
      <div class="main-navigation">
				<?php 
                                       wp_nav_menu(array(
                                       'menu' => 'Main Menu', 
                                       'container_id' => 'clubbmenu', 
                                       'walker' => new CSS_Menu_Maker_Walker()
                                       )); 
                                       ?>	

      </div><!-- end .main-navigation -->			
    </div><!-- end #main -->
  </div><!-- end .header-row fixed -->           
</div><!-- end #header -->

<!-- Wrap -->
<div id="wrap">