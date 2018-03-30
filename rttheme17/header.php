<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head> 
<meta charset="<?php bloginfo( 'charset' ); ?>" />  
<?php if(!get_option( THEMESLUG."_close_responsive")):?><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, text-size=normal"><?php endif;?>
	
<title><?php if (is_home() || is_front_page() ): bloginfo('name'); else: wp_title('');endif; ?></title>
<?php if (get_option( 'rttheme_favicon_url')):?><link rel="icon" type="image/png" href="<?php echo get_option( 'rttheme_favicon_url');?>"><?php endif;?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); //thread comments?>		

<?php echo get_option(THEMESLUG.'_space_for_head');?>

<?php 
#
# Add specific CSS class by filter
#
add_filter('body_class','rt_body_class_name');
?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
#
#	Variables for javascript
#
echo '
<script type="text/javascript">
/* <![CDATA[ */
	var rttheme_template_dir = "'.THEMEURI.'";  
/* ]]> */	
</script>
';
?>
	
<?php
#
# Static 100% & Randomized Backgrounds
#

// meta values for current post 
if( !is_archive() && !is_search() && !is_404() && !is_category() && isset($post->ID)){
$background_image= @get_post_meta( $post->ID, THEMESLUG . "_background_image_url", true );
$randomized_banckground_images =  trim(@get_post_meta( $post->ID, THEMESLUG . "_background_image_urls", true ));
$full_width_background =	@get_post_meta( $post->ID, THEMESLUG . "_full_width_background", true );
}

// default values
if( ( !isset($background_image) || empty($background_image) ) && ( !isset($randomized_banckground_images) || empty($background_image)) ){
	$background_image= get_option( THEMESLUG.'_background_image_url' );
	$randomized_banckground_images =  trim(get_option( THEMESLUG.'_background_image_urls'));
	$full_width_background = get_option( THEMESLUG.'_full_width_background' );
} 

if($full_width_background && ( $background_image || $randomized_banckground_images) ){
	
	//Static 100% Bakcround
	if($background_image && !$randomized_banckground_images){
		echo '<img src="'.$background_image.'" alt="" id="background" />';	
	}

	//Randomized 100% Backgrounds
	if($randomized_banckground_images){
	    $random_background = trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $randomized_banckground_images)); 
	    $images=explode("\n",  $random_background);    
	    $random_number = rand(0, count($images)-1);    
	    echo '<img src="'.$images[$random_number].'" alt="" id="background" />'; 
	}	
}
?>


<?php if(!get_option(THEMESLUG.'_hide_woo_cart') && class_exists( 'Woocommerce' )):?>
<?php global $woocommerce; ?>
    <div id="rt_woo_links">
	   <ul>
		  <li class="icon_cart_contents"><a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'rt_theme'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'rt_theme'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a></li>
		  <?php if ( is_user_logged_in() ) { ?>
		  <li class="user"><a href="<?php echo get_permalink( wpml_page_id(get_option('woocommerce_myaccount_page_id')) ); ?>" title="<?php _e('My Account','rt_theme'); ?>"><?php _e('My Account','rt_theme'); ?></a></li>
		  <li class="logout"><a href="<?php echo wp_logout_url(home_url('/')); ?>" title="<?php _e('Logout','rt_theme'); ?>"><?php _e('Logout','rt_theme'); ?></a></li>
	   <?php }
	    else { ?>
		  <li class="login"><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','rt_theme'); ?>"><?php _e('Login / Register','rt_theme'); ?></a></li>
	   <?php } ?>
	   </ul>
    </div>
<?php $theWPML = "true";?>
<?php endif;?>

<?php if(get_option(THEMESLUG.'_show_flags') && function_exists('icl_get_languages')):?>
	<!-- / flags -->	
	<div id="wpml_flags">
	    <?php languages_list();?>		  
 	</div>
	<!-- / flags -->
<?php $theWPML = "true";?>
<?php endif;?>

<?php if(get_option(THEMESLUG.'_social_media_top')):?>
<?php if(isset($theWPML)):?><div class="social_media_top with_wpml"><?php else:?><div class="social_media_top"><?php endif;?>
	<!-- social media icons -->				
	<?php 
		echo do_shortcode("[rt_social_media_icons]");
	?><!-- / end ul .social_media_icons -->
</div>
<?php $TopSocialIcons = "true";?>
<?php endif;?>

<!-- background wrapper -->
 
<?php if(isset($TopSocialIcons) && isset($theWPML)):?><div id="container" class="extrapadding"><?php elseif(isset($TopSocialIcons)):?><div id="container" class="extrapadding2"><?php else:?><div id="container"><?php endif;?>
	
	<!-- content wrapper -->
	<div class="transparent-line"></div><!-- transparent line -->


	<?php
	global $is_front_page;
	if( ! $is_front_page && !get_option(THEMESLUG.'_show_search') && !get_option(THEMESLUG.'_breadcrumb_menus')):?>
	<div class="content-wrapper box-shadow margin-b30">
	<?php else:?>
	<div class="content-wrapper">
	<?php endif;?>



		<!-- header -->
		<div id="header" class="clearfix"><header> 

			<?php
				global $logo_container;
				$logo_container = get_option(THEMESLUG.'_logo_container');
				$logo_url		= get_option('rttheme_logo_url');
			?>
			<!-- logo -->
			<div id="logo" class="clearfix <?php if(!$logo_container) echo "no-container";?>  <?php if(!$logo_container && !$logo_url) echo "no-logo-img";?>">
				<?php
				if($logo_container):
				?>
				<div class="shadow-left"></div><!-- shadow left-->
				<div class="logo-holder"><!-- logo holder-->
					<div class="transparent-line logo"></div><!-- transparent line -->
					<div class="logo-background"><!-- logo background-->
					<?php endif;?>					
						<?php if($logo_url):?>
							<a href="<?php echo BLOGURL; ?>" title="<?php echo bloginfo('name');?>"><img src="<?php echo $logo_url; ?>" alt="<?php echo bloginfo('name');?>" class="png" /></a>
						<?php else:?>
							<h1 class="cufon logo"><a href="<?php echo BLOGURL; ?>" title="<?php echo bloginfo('name');?>"><?php echo bloginfo('name');?></a></h1>
						<?php endif;?>					
				<?php if($logo_container):?>
					</div>
				</div>
				<div class="shadow-right"></div><!-- shadow right-->
				<?php endif;?>
			</div>
			<!-- / end div #logo -->

			<!-- navigation --> 
			<nav><div id="navigation_bar" class="navigation">
	 
	 		<?php if ( has_nav_menu( 'rt-theme-main-navigation' ) ): // check if user created a custom menu and assinged to the rt-theme's location ?>
					<!-- Standart Menu -->
					<?php            
					//call the main menu
					$menuVars = array(
						'menu_id'         => "navigation", 
						'echo'            => false,
						'container'       => '', 
						'container_class' => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'container_id'    => '', 
						'theme_location'  => 'rt-theme-main-navigation' 
					);
					
					$main_menu=wp_nav_menu($menuVars);
					echo ($main_menu);
					?>
					<!-- / Standart Menu --> 

					<!-- Mobile Menu --> 
					<?php            
					//call the main menu once again for mobile navigation
					$MobilemenuVars = array(
						'menu_id'         => "MobileMainNavigation", 
						'echo'            => false,
						'container'       => 'div', 
						'container_class' => '', 
						'container_id'    => 'MobileMainNavigation-Background', 
						'theme_location'  => 'rt-theme-main-navigation', 
						'dropdown_title'  => __('-- Main Menu --',"rt_theme"), 
						'indent_string'   => '- ', 
						'indent_after'    => '' 
					);
					
					$mobile_menu=dropdown_menu($MobilemenuVars);
					echo ($mobile_menu);
					?>
 					<!-- / Mobile Menu -->    
			<?php else:?>
					<!-- Standart Menu -->
					<?php            
					//call the main menu
					$menuVars = array(
						'menu'            => 'RT Theme Main Navigation Menu',  
						'menu_id'         => "navigation", 
						'echo'            => false,
						'container'       => '', 
						'container_class' => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'container_id'    => '', 
						'theme_location'  => 'rt-theme-main-navigation' 
					);
					
					$main_menu=wp_nav_menu($menuVars);
					echo ($main_menu);
					?>
					<!-- / Standart Menu --> 

					<!-- Mobile Menu --> 
					<?php            
					//call the main menu once again for mobile navigation
					$MobilemenuVars = array(
						'menu'            => 'RT Theme Main Navigation Menu',  
						'menu_id'         => "MobileMainNavigation", 
						'echo'            => false,
						'container'       => 'div', 
						'container_class' => '', 
						'container_id'    => 'MobileMainNavigation-Background', 
						'theme_location'  => 'rt-theme-main-navigation', 
						'dropdown_title'  => __('-- Main Menu --',"rt_theme"), 
						'indent_string'   => '- ', 
						'indent_after'    => '' 
					);
					
					$mobile_menu=dropdown_menu($MobilemenuVars);
					echo ($mobile_menu);
					?>
 					<!-- / Mobile Menu -->    
 			<?php endif;?>

			</div></nav>
			<!-- / navigation  -->
			
		</header></div><!-- end div #header -->		 
		
	</div><!-- / end div content-wrapper --> 