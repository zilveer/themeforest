<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $qode_options_magnet;
global $wp_query;
global $woocommerce;
$disable_qode_seo = "";
if (isset($qode_options_magnet['disable_qode_seo'])) $disable_qode_seo = $qode_options_magnet['disable_qode_seo'];
if ($disable_qode_seo != "yes") {
	$seo_title = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_title", true);
	$seo_description = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_description", true);
	$seo_keywords = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_keywords", true);
}
?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<?php
	$responsiveness = "yes";
	if (isset($qode_options_magnet['responsiveness'])) $responsiveness = $qode_options_magnet['responsiveness'];
	if($responsiveness != "no"):
	?>
	<meta name=viewport content="width=device-width,initial-scale=1">
	<?php 
	endif;
	?>
	<title><?php if($seo_title) { ?><?php bloginfo('name'); ?> | <?php echo $seo_title; ?><?php } else {?><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?><?php } ?></title>
	<?php if ($disable_qode_seo != "yes") { ?>
	<?php if($seo_description) { ?>
	<meta name="description" content="<?php echo $seo_description; ?>">
	<?php } else if($qode_options_magnet['meta_description']){ ?>
	<meta name="description" content="<?php echo $qode_options_magnet['meta_description'] ?>">
	<?php } ?>
	<?php if($seo_keywords) { ?>
	<meta name="keywords" content="<?php echo $seo_keywords; ?>">
	<?php } else if($qode_options_magnet['meta_keywords']){ ?>
	<meta name="keywords" content="<?php echo $qode_options_magnet['meta_keywords'] ?>">
	<?php } ?>
	<?php } ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $qode_options_magnet['favicon_image']; ?>">
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	<!-- Google Analytics start -->
	<?php if (isset($qode_options_magnet['google_analytics_code'])){
				if($qode_options_magnet['google_analytics_code'] != "") { 
	?>
		<script>
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '<?php echo $qode_options_magnet['google_analytics_code']; ?>']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
	<?php }
		}
	?>
	<!-- Google Analytics end -->

<div class="container_shadow_outer">
<div class="container_shadow_left">
<div class="container_shadow_right">
<div class="container_shadow_inner">
	<div class="container">	
		<div class="container_inner clearfix">
			<header>
				<div class="logo">
					
				<?php if (is_ssl()) {
			        $logo_url = str_replace("http://", "https://", $qode_options_magnet['logo_image']);
			    } else {
			        $logo_url = $qode_options_magnet['logo_image'];
			    } ?>	

				<?php
					if (!empty($_SESSION['qode_home'])) { 
						$home = $_SESSION['qode_home']; 
						
						$permalink = get_permalink($home);
						
					}else{
						$permalink = home_url();
					}
				?>
					<a href="<?php echo $permalink; ?>">
						<img src="<?php echo $logo_url; ?>" alt="Logo"/>
					</a>
					<p><?php echo $qode_options_magnet['logo_text']; ?></p>
				</div>
				<div class="header_right">
					<?php dynamic_sidebar( 'header_right' ); ?>
				</div>
				<div class="woocommerce_cart_items">
					<?php if (isset($woocommerce)) { ?>
					<?php if($woocommerce->cart->cart_contents_count > 0 ){ ?>
					<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/woocommerce_cart_image.png" /><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> , <?php echo $woocommerce->cart->get_cart_total(); ?>	</a>
					<?php }else{ ?><a class="cart-contents" href="" ></a><?php } ?>
					<?php } ?>	
				</div>
				<div class="clear"></div>

				<nav class="main_menu drop_down">
				<div class="rounded_background"><div class="rounded_background_inner"></div></div>
				<?php

						wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
																'container'  => '', 
																'container_class' => '', 
																'menu_class' => '', 
																'menu_id' => '',
																'link_before'     => '<span>',
																'link_after'      => '</span>',
																'fallback_cb' => 'top_navigation_fallback',
																'walker' => new qode_type2_walker_nav_menu()
						 ));
					
				?>
				
				
				<span id="magic"></span>
				<span id="magic2"></span>
				
				</nav>
				<nav class="selectnav">
					<div class="rounded_background"><div class="rounded_background_inner"></div></div>
				</nav>
			</header>
	</div>
</div>
		<div class="content">
		<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$animation = get_post_meta($id, "qode_show-animation", true);
if (!empty($_SESSION['qode_animation']) && $animation == "")
	$animation = $_SESSION['qode_animation'];
	
	
?>
 
			<?php if($qode_options_magnet['page_transitions'] == "1" || $qode_options_magnet['page_transitions'] == "2" || $qode_options_magnet['page_transitions'] == "3" || $qode_options_magnet['page_transitions'] == "4" || ($animation == "updown") || ($animation == "fade") || ($animation == "updown_fade") || ($animation == "curtain")){ ?>
				<div class="meta">				
					<?php if($seo_title){ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php echo $seo_title; ?></div>
					<?php } else{ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></div>
					<?php } ?>
					<?php if($seo_description){ ?>
						<div class="seo_description"><?php echo $seo_description; ?></div>
					<?php } else if($qode_options_magnet['meta_description']){?>
						<div class="seo_description"><?php echo $qode_options_magnet['meta_description']; ?></div>
					<?php } ?>
					<?php if($seo_keywords){ ?>
						<div class="seo_keywords"><?php echo $seo_keywords; ?></div>
					<?php }else if($qode_options_magnet['meta_keywords']){?>
						<div class="seo_keywords"><?php echo $qode_options_magnet['meta_keywords']; ?></div>
					<?php }?>
					<span id="qode_page_id"><?php echo $wp_query->get_queried_object_id(); ?></span>
				</div>
			<?php } ?>
			<div class="content_inner <?php echo $animation;?> ">
			