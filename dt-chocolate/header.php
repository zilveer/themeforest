<?php
/**
 * @package WordPress
 * @subpackage Chocolate
 */ 
global $post;

$options = dt_get_theme_options();
$jwplayer_flag = dt_jwplayer_exists();
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> style="<?php
	if ( get_demo_option( 'bg1' ) ) {
		$img = 'url(' . get_template_directory_uri() . get_demo_option( 'bg1' ) . ')';
	} else {
		$img = 'none';
	}

	if ( !DEMO && !empty($options['custom_bg1']) ) {
		//$img = '/cache/'.$options['custom_bg1'];
		$up_dir = wp_upload_dir();
		$dir = $up_dir['baseurl'].'/dt_uploads/';
		$img = 'url(' . $dir . $options['custom_bg1'] . ')';
	}

	echo 'background-color: ' . get_demo_option('bgcolor1') . '; ';
	echo 'background-image: ' . $img . '; ';
	
	if ( 'none' != $img ) {
		if (get_demo_option('bg1_repeat_x') && get_demo_option('bg1_repeat_y')) 
			echo 'background-repeat: repeat; ';
		elseif (get_demo_option('bg1_repeat_x')) 
			echo 'background-repeat: repeat-x; ';
		elseif (get_demo_option('bg1_repeat_y')) 
			echo 'background-repeat: repeat-y; ';
		else
			echo 'background-repeat: no-repeat; ';
		
		if (get_demo_option('bg1_fixed')) 
			echo 'background-attachment: fixed; ';
		if (get_demo_option('bg1_center')) 
			echo 'background-position: center 0; ';
	}
?>">
<head>

<?php if ( ! dt_get_theme_options( 'turn_off_responsivness' ) ) : ?>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php endif; ?>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php bloginfo('name'); ?> <?php wp_title( '|', true, 'left' ); ?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php get_template_part( 'header' , 'dt' ); ?>
<?php wp_head(); ?>
</head>
<?php
$class = '';
if( is_page_template('home-slider.php') || is_page_template('home-3d.php') ) {
	$class = 'home';
}
?>
<body <?php body_class($class); ?> style="<?php
	// new
	if ( get_demo_option('bg2') ) {
		$img = 'url(' . get_template_directory_uri().get_demo_option('bg2') . ');';
	} else {
		$img = 'none';
	}

	if ( !DEMO && !empty($options['custom_bg2']) ) {
		//$img = get_template_directory_uri().'/cache/'.$options['custom_bg2'];
		$up_dir = wp_upload_dir();
		$dir = $up_dir['baseurl'].'/dt_uploads/';
		$img = 'url(' . $dir.$options['custom_bg2'] . ');';
	}
	
	echo 'background-image: ' . $img;
	
	if ( 'none' != $img ) {
		if (get_demo_option('bg2_repeat_x') && get_demo_option('bg2_repeat_y')) 
			echo 'background-repeat: repeat; ';
		elseif (get_demo_option('bg2_repeat_x')) 
			echo 'background-repeat: repeat-x; ';
		elseif (get_demo_option('bg2_repeat_y')) 
			echo 'background-repeat: repeat-y; ';
		else
			echo 'background-repeat: no-repeat; ';
		
		if (get_demo_option('bg2_fixed')) 
			echo 'background-attachment: fixed; ';
		
		if (get_demo_option('bg2_center')) 
			echo 'background-position: center 0; '; 
	}
?>">

<?php do_action('dt_after_body_begin'); ?>

<?php /* if(!is_page_template('home-static.php')) : */ ?>
	<div id="bg">
	
		<div id="header-mobile">
		<!-- DT: mobile logo goes here: begin -->
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" id="logo-mobile">
			  <?php if (isset($options['mobile_logo']) && $options['mobile_logo']): ?>
				 <img src="<?php
					$up_dir = wp_upload_dir();
					$dir = $up_dir['baseurl'].'/dt_uploads/';
					$url = $dir.$options['mobile_logo'];
					echo esc_url($url);
				 ?>" alt="<?php wp_title(); ?>" />
			  <?php else: ?>
				 <img src="<?php echo get_template_directory_uri(); ?>/images/logo-mobile.png" alt="<?php wp_title(); ?>" />
			  <?php endif; ?>
			</a>
		<!-- DT: mobile logo goes here: end -->
			<?php
			dt_menu( array(
				'menu_wraper' 		=> '<select>%MENU_ITEMS%</select>',
				'menu_items'		=> '<option data-level="%DEPTH%" value="%ITEM_HREF%"%ACT_CLASS%>%ITEM_TITLE%</option>%SUBMENU%',
				'submenu' 			=> '%ITEM%',
				'location'			=> 'primary',
				'act_class'			=> ' selected',
				'depth'				=> 3 
			) );
			?>
		</div>

<?php /* endif; */ ?>
<?php get_template_part( 'top' ); ?>
<?php
$class = '';
if ( is_page_template('home-video.php') ) {
	
	if ( $jwplayer_flag ) {
		$class = ' class="video jw"';
	} else {
		$class = ' class="video"';
	}
} elseif( is_page_template('home-slider.php') ) {

	$class = ' class="slide"';
} elseif( is_page_template('home-static.php') ) {

	$class = ' class="static"';
} elseif( is_page_template('home-3d.php') ) {

	$class = ' class="slide slider-3d"';
}
?>
<div id="holder"<?php echo $class; ?>>