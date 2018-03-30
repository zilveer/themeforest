<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<!-- Meta Tags -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Title & Desc. -->
<title><?php wp_title('&raquo;','true','right'); ?><?php if ( is_single() ) { ?> Blog Archive &raquo; <?php } ?><?php bloginfo('name'); ?></title>
<?php if ( (is_home()) || (is_front_page()) ) { ?>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<?php } elseif (!empty($post->post_excerpt)) { ?>
<meta name="description" content="<?php echo strip_tags(get_the_excerpt()); ?>"/>
<?php } ?>

<!-- Link Tags -->
<?php if(of_get_option('favicon') != "") { ?><link rel="shortcut icon" href="<?php echo of_get_option('favicon'); ?>" type="image/x-icon" /><?php } ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript">	var mysiteurl = "<?php echo THEME_DIR ?>"; </script>

<!-- JS and CSS -->
<?php wp_head(); ?>
</head>
<?php flush(); ?>
<body <?php body_class(); ?>>
<?php global $woocommerce; $my_site_url = get_home_url(); ?>
<div id="container">
	<div id="content">
		
		<div id="header">
			<header>
			<div class="store-logo">
				<a title="<?php echo get_bloginfo('name') ?>" href="<?php echo $my_site_url; ?>"><img src="<?php echo (!of_get_option('logo') == "")? of_get_option('logo'): THEME_DIR . '/images/green/logo.png'; ?>"/></a>
			</div>
			
			<!-- Search Begin -->
			<div class="search-container">
				<form action="<?php echo $my_site_url; ?>" method="get">
					<input type="text" name="s" class="search-field" value="<?php _e('Search...', 'circolare'); ?>" onfocus="if(this.value=='<?php _e('Search...', 'circolare'); ?>'){this.value=''};" onblur="if(this.value==''){this.value='<?php _e('Search...', 'circolare'); ?>'};">
					<input type="hidden" name="post_type" value="<?php echo of_get_option('top_search', 'post') ?>" />
					<input type="submit" class="search-btn" value="" id="s_submit">
				</form>
			</div>
			<!-- Search End -->
			
			<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
			<div class="login-block">
				<span class="icon-cart"><a title="Cart" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="cart regular">(<span id="top_item_count"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'circolare'), $woocommerce->cart->cart_contents_count);?></span>) <?php _e('Items','circolare') ?></a></span>
				
				<span class="icon-account"><a title="Account" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="account regular">
					<?php if ( is_user_logged_in() ) _e('My Account','circolare'); 
					else _e('Login','circolare'); ?>
				</a></span>
			</div><?php } ?>
			</header>
		</div>
		
		<!-- Navigation Begin -->
		<div class="navigation-outer">
			<div class="navigation">
				<nav>
				<?php wp_nav_menu( array('theme_location' => 'main_nav', 'container' => 'false', 'menu_class' => 'sf-menu', 'menu_id' => 'main-menu' ) ); ?>
				</nav>
			</div>
			<div class="navigation-shadow"></div>
		</div>
		<!-- Navigation End -->

		<div class="clear"></div>