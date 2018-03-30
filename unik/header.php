<?php
/**
 * The template for displaying Header section. It will be applied to all the templates as header section.
 *
 */

?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<?php global $unik_data; ?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title>
		<?php if ( defined('WPSEO_VERSION') ) {
			wp_title('');
		} else {
			bloginfo('name'); ?> <?php wp_title(' - ', true, 'left');
		} ?>
	</title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" href="<?php echo $unik_data['favicon']; ?>" type="image/x-icon" />
		
	<!--[if IE 9]>
	<link href="<?php echo get_template_directory_uri(); ?>/css/ie.css" type="text/css" rel="stylesheet" />
	<![endif]-->

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="wrap">
	
	<!-- Page background -->
	<?php if(is_page()): ?><div class="page_bg" style="background-image:url(<?php echo wp_get_attachment_url(get_post_meta($post->ID,THEMENAME.'_page_bg',true)); ?>)">&nbsp;</div><?php endif; ?>
	
	<div class="pattern_overlay"></div><!--Pattern-->
	<header class="main-top default clearfix">
		<div class="container">
		
			<?php
				$defaults = array(
								'theme_location'  => 'primary',
								'menu'            => '',
								'container'       => 'div',
								'container_class' => '',
								'menu_class'      => 'sf-menu navbar-right navbar-nav',
								'menu_id'         => 'menu',
								'fallback_cb'     => 'wp_page_menu',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'           => 3,
							);				
			?>

			<div class="header-elem clearfix <?php echo $unik_data['responsive_nav_type']; ?>">
				<div class="navbar-header">
					<div class="logo">
						<a href="<?php echo home_url(); ?>" id="logo_1"><img src="<?php echo $unik_data['logo']; ?>" alt="<?php bloginfo('name'); ?>"></a>
						
						<?php 
							if(class_exists('SitePress')){
								echo "<!-- lang -->";
								do_action('icl_language_selector');
							}
						?>
					</div><!-- Logo -->	
				</div>
				<nav id="menu" class="menu collapse navbar-collapse">
					<?php wp_nav_menu( $defaults ); ?>
					
				</nav><!-- Navigation menu -->	
				<div class="clear"></div>
			</div>	
		</div>			
	</header><!--Top header end-->
	
	<div id="ajax-content">
		<?php
			if(is_page()){
				$slider_shortcode = get_post_meta($post->ID,THEMENAME.'_slider_shortcode',true);
				
				if(isset($slider_shortcode) && !empty($slider_shortcode)){
					echo '<div class="main-slider clearfix">'.do_shortcode($slider_shortcode).'</div>';
				}
			}
		?>
		
		<div class="top-content">
			<div class="container">
		