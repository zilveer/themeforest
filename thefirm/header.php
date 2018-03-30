<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
    <title><?php wp_title(' | ', 1, 'right'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen,projection" />
    <meta charset="UTF-8"> 
    <?php wp_head(); ?>
    <?php $eet_option = eet_get_global_options(); ?>
    <link href='http://fonts.googleapis.com/css?family=Metrophobic' rel='stylesheet' type='text/css'>
</head>
<body <?php body_class(); ?>>
<div id="bgtimer"></div>
<?php firm_slider(); ?>
<div id="logowrap"><a href="<?php echo get_home_url();?>"><img src="<?php echo $eet_option['eetcnt_lolo'] ?>" id="logo" alt="<?php echo get_bloginfo('name'); ?>" /></a></div>
<div class="scrolls">
    <img src="<?php echo get_template_directory_uri(); ?>/images/arrowleft.png" alt="Left" class="scrollleft" />
    <img src="<?php echo get_template_directory_uri(); ?>/images/arrowright.png" alt="Right" class="scrollright" />
</div>
<div class="replymes" style="display: none;"></div>
<div id="wrapper">
