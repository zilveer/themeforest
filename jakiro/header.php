<?php 
	global $dh_show_scroll_nav_count;
	$header_style = dh_get_theme_option('header-style','classic');
	$menu_transparent = dh_get_theme_option('menu-transparent',0);
	$page_heading = dh_get_post_meta('page_heading',get_the_ID(),'default');
	$page_heading_background_image = dh_get_post_meta('page_heading_background_image');
	$page_heading_title = dh_get_post_meta('page_heading_title');
	$page_heading_sub_title = dh_get_post_meta('page_heading_sub_title');
	$page_heading_button_text  = dh_get_post_meta('page_heading_button_text');
	$page_heading_button_url  = dh_get_post_meta('page_heading_button_url');
	$page_heading_breadcrumb_flag = false;
	if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
		if(is_product_taxonomy()){
			$term_id = get_queried_object_id();
			$page_heading_background_image 	= get_woocommerce_term_meta( $term_id, 'product_cat_heading_thumbnail_id', true );
			$page_heading_title = get_woocommerce_term_meta( $term_id, 'product_cat_heading_title', true );
			$page_heading_sub_title = get_woocommerce_term_meta( $term_id, 'product_cat_heading_sub_title', true );
			if(empty($page_heading_title)){
				$page_heading_title = single_term_title('',false);
			}
			if(!empty($page_heading_background_image)){
				$page_heading = apply_filters('dh_product_taxonomy_menu_heading', 'heading',$term_id);'';
				$menu_transparent = apply_filters('dh_product_taxonomy_menu_transparent', false,$term_id);
			}
		}
	
	}
	$page_heading_background_image_url = wp_get_attachment_url($page_heading_background_image);
	
	if(dh_get_theme_option('blog-archive-heading',0) && is_home()){
		$page_heading = 'heading';
		$page_heading_background_image_url = dh_get_theme_option('blog-archive-heading-bg','');
		$page_heading_title = dh_get_theme_option('blog-archive-heading-title','Our Blog');
		$page_heading_sub_title = dh_get_theme_option('blog-archive-heading-sub-title','');
	}

	if(dh_get_theme_option('blog-heading',0) && is_singular('post')){
		if(has_post_thumbnail(get_the_ID())){
			$page_heading = 'heading';
			$page_heading_title = get_the_title();
			$page_heading_background_image = get_post_thumbnail_id(get_the_ID());
		}else{
			$page_heading = 'heading';
			$page_heading_background_image_url = dh_get_theme_option('blog-heading-bg','');
			$page_heading_title = dh_get_theme_option('blog-heading-title','Our Blog');
			$page_heading_sub_title = dh_get_theme_option('blog-heading-sub-title','');
		}
	}	
	
	if(defined( 'WOOCOMMERCE_VERSION' ) && is_singular('product') && dh_get_theme_option('woo-product-heading',0)){
		$page_heading = 'heading';
		$page_heading_background_image_url = dh_get_theme_option('woo-product-heading-bg','');
		$page_heading_title = dh_get_theme_option('woo-product-heading-title','Our Shop');
		$page_heading_sub_title = dh_get_theme_option('woo-product-heading-sub-title','');
	}
	
	
	if (empty($page_heading_background_image_url)){
		$page_heading_background_image_url = get_template_directory_uri().'/assets/images/header-bg.jpg';
	}
	
	if(empty($page_heading_title)){
		$page_heading_title = dh_page_title(false);
		if($page_heading == 'heading')
			$page_heading = 'default';
	}
	
	if(empty($page_heading_sub_title)){
		$page_heading_breadcrumb_flag = true;
	}
	
	$page_heading_button_flag = false;
	
	
	$logo_url = dh_get_theme_option('logo');
	$logo_fixed_url = dh_get_theme_option('logo-fixed','');
	$logo_transparent_url = dh_get_theme_option('logo-transparent','');
	$logo_mobile_url = dh_get_theme_option('logo-mobile','');
	if($page_logo = dh_get_post_meta('page_logo')){
		$page_logo_image_url = wp_get_attachment_url($page_logo);
		if(!empty($page_logo_image_url))
			$logo_url = $logo_transparent_url = $page_logo_image_url;
	}
	if(empty($logo_fixed_url))
		$logo_fixed_url = $logo_url;
	if(empty($logo_mobile_url))
		$logo_mobile_url = $logo_url;
	//
	//$menu_transparent = apply_filters('dh_allow_menu_transparent', false);
	if($menu_transparent)
		$logo_url = $logo_transparent_url;
?>
<!doctype html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<?php if (!function_exists( 'wp_site_icon' ) && ($favicon_url = dh_get_theme_option('favicon'))) { ?>
<link rel="shortcut icon" href="<?php echo esc_attr($favicon_url); ?>">
<meta name="msapplication-TileImage" content="<?php echo esc_attr($favicon_url); ?>">
<?php } ?>
<?php if ($apple57_url = dh_get_theme_option('apple57')) { ?>
<link rel="apple-touch-icon-precomposed" href="<?php echo esc_url($apple57_url); ?>"><?php } ?>   
<?php if ($apple72 = dh_get_theme_option('apple72')) { ?>
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url($apple72); ?>"><?php } ?>   
<?php if ($apple114 = dh_get_theme_option('apple114')) { ?>
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_url($apple114); ?>"><?php } ?> 
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if(defined('DHINC_ASSETS_URL')):?>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="<?php echo DHINC_ASSETS_URL ?>/vendor/html5shiv.min.js"></script>
<![endif]-->
<?php endif;?>
<?php wp_head(); ?>
</head> 
<body <?php body_class(); ?> <?php if(count($dh_show_scroll_nav_count) > 0): ?>data-spy="scroll" <?php endif;?>>
<?php do_action( 'dh_before_body' ); ?>
<a class="sr-only sr-only-focusable" href="#main"><?php echo esc_html__('Skip to main content','jakiro') ?></a>
<div class="offcanvas-overlay"></div>	
<div class="offcanvas open <?php  if($header_style == 'sidebar'){?>offcanvas-sidebar <?php }?>">
	<?php if($header_style == 'sidebar'){?>
	<button type="button" class="navbar-toggle">
		<span class="sr-only"><?php echo esc_html__('Toggle navigation','jakiro')?></span>
		<span class="icon-bar bar-top"></span> 
		<span class="icon-bar bar-middle"></span> 
		<span class="icon-bar bar-bottom"></span>
	</button>
	<?php }?>
	<div class="offcanvas-wrap">
		<div class="offcanvas-inner">
			<?php if($header_style == 'sidebar'){?>
			<div class="navbar-header">
				<a class="navbar-brand" itemprop="url" title="<?php esc_attr(bloginfo( 'name' )); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php if(!empty($logo_url)):?>
						<img class="logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($logo_url)?>">
					<?php else:?>
						<?php echo bloginfo( 'name' ) ?>
					<?php endif;?>
					<img class="logo-fixed" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($logo_fixed_url)?>">
					<img class="logo-mobile" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($logo_mobile_url)?>">
					<meta itemprop="name" content="<?php bloginfo('name')?>">
				</a>
			</div>
			<?php }?>
			<div class="offcanvas-mobile-wrap">
				<?php if($header_style != 'sidebar'){?>
				<div class="offcanvas-user clearfix">
					<?php if(defined('YITH_WCWL') && defined('WOOCOMMERCE_VERSION') && apply_filters('dh_show_wishlist_in_header', true)):?>
		            <a class="offcanvas-user-wishlist-link"  href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url());?>"><i class="fa fa-heart-o"></i> <?php esc_html_e('My Wishlist','jakiro')?></a>
		            <?php endif;?>
		            <?php if(dh_get_theme_option('user-icon',1)){?>
		            <?php 
					$login_url = wp_login_url();
					$logout_url = wp_logout_url();
					$register_url = wp_registration_url();
					if(defined('WOOCOMMERCE_VERSION')){
						$login_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
						$logout_url = wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) );
					}
					?>
		            <a class="offcanvas-user-account-link" href="<?php echo esc_url($login_url) ?>"><i class="fa fa-user"></i> <?php if(!is_user_logged_in()): ?><?php esc_html_e('Login','jakiro')?><?php else:?><?php esc_html_e('Account','jakiro')?><?php endif;?></a>
					<?php }?>
				</div>
				<?php } ?>
				<nav class="offcanvas-navbar" role="navigation">
					<?php
					if(has_nav_menu('mobile')):
						wp_nav_menu( array(
							'theme_location'    => 'mobile',
							'container'         => false,
							'depth'				=> 3,
							'menu_class'        => 'offcanvas-nav',
							'walker' 			=> new DH_Walker
						) );
					else:
						echo '<ul class="nav navbar-nav primary-nav"><li><a href="' . home_url( '/' ) . 'wp-admin/nav-menus.php">' . esc_html__( 'No menu assigned!', 'jakiro' ) . '</a></li></ul>';
					endif;
					?>
				</nav>
			</div>
			<?php if($header_style == 'sidebar'){?>
			<div class="offcanvas-sidebar-wrap">
				<nav class="offcanvas-navbar offcanvas-sidebar-navbar" itemtype="<?php echo dh_get_protocol() ?>://schema.org/SiteNavigationElement" itemscope="itemscope" role="navigation">
					<?php
					$page_menu = '' ;
					if(is_page() && ($selected_page_menu = dh_get_post_meta('main_menu'))){
						$page_menu = $selected_page_menu;
					}
					if(has_nav_menu('primary') || !empty($page_menu)):
						wp_nav_menu( array(
							'theme_location'    => 'primary',
							'container'         => false,
							'depth'				=> 3,
							'menu'				=> $page_menu,
							'menu_class'        => 'offcanvas-nav',
							'walker' 			=> new DH_Mega_Walker
						) );
					else:
						echo '<ul class="nav navbar-nav primary-nav"><li><a href="' . home_url( '/' ) . 'wp-admin/nav-menus.php">' . esc_html__( 'No menu assigned!', 'jakiro' ) . '</a></li></ul>';
					endif;
					?>
				</nav>
			</div>
			<form method="GET" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="form">
				<label for="s" class="sr-only"><?php esc_html_e( 'Search', 'jakiro' ); ?></label>
				<input type="search" id="s" name="s" class="form-control" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e( 'Search&hellip;', 'jakiro' ); ?>" />
				<input type="submit" id="searchsubmit" class="hidden" name="submit" value="<?php esc_attr_e( 'Search', 'jakiro' ); ?>" />
				<input type="hidden" name="post_type" value="<?php echo apply_filters('dh_ajax_search_form_post_type', 'product') ?>" />
			</form>
			<?php if(dh_get_theme_option('woo-cart-nav')){?>
			<div class="cart-wrap">
				<?php 
			        echo (class_exists('DH_Woocommerce') ? DH_Woocommerce::instance()->get_minicart_sidebar():'');
			    ?>
			</div>
			<?php }?>
			<div class="social-wrap">
				<?php dh_social(dh_get_theme_option('header-sidebar-social',array('twitter','facebook', 'instagram','behance','dribbble')),true);?>
			</div>
			<?php } ?>
			<?php if(is_active_sidebar('sidebar-offcanvas')):?>
			<div class="offcanvas-widget">
				<?php dynamic_sidebar('sidebar-offcanvas')?>
			</div>
			<?php endif;?>
		</div>
	</div>
</div>
<div id="wrapper" class="<?php echo dh_get_theme_option('site-layout','wide') ?>-wrap <?php echo (get_page_template_slug() ==='page-full-width.php' ? '' : dh_get_theme_option('wide-container','fullwidth').'-container-wrap')?> container-with-header-<?php echo esc_attr($header_style)?>">
	<?php 
	if($header_style !='sidebar'){
		dh_get_template('header/'.$header_style.'.php',array(
			'page_heading'					=> $page_heading,
			'header_style'					=>$header_style,
			'menu_transparent'				=>$menu_transparent,
			'logo_url'						=>$logo_url,
			'logo_fixed_url'				=>$logo_fixed_url,
			'logo_mobile_url'				=>$logo_mobile_url,
		));
	}
	?>
	<?php 
	$heading_menu_anchor = dh_get_post_meta('heading_menu_anchor');
	?>
	<?php if($page_heading === 'rev' && ($rev_alias = dh_get_post_meta('rev_alias'))):?>
	<div<?php echo (!empty($heading_menu_anchor) ? ' id ="'.esc_attr($heading_menu_anchor).'"': '')?> class="main-slider">
		<div class="main-slider-wrap">
			<?php echo do_shortcode('[rev_slider '.$rev_alias.']')?>
		</div>
	</div>
	<?php endif;?>
	<?php if($page_heading == 'heading' && !empty($page_heading_background_image_url) && !empty($page_heading_title)):?>
		<?php 
		wp_enqueue_script('vendor-parallax');
		wp_enqueue_script('vendor-imagesloaded');
		?>
		<div<?php echo (!empty($heading_menu_anchor) ? ' id ="'.esc_attr($heading_menu_anchor).'"': '')?> class="heading-container heading-resize<?php echo ($page_heading_button_flag ? ' heading-button':' heading-no-button');?>">
			<div class="heading-background heading-parallax" style="background-image: url('<?php echo esc_attr($page_heading_background_image_url) ?>');">			
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="heading-wrap">
								<div class="page-title">
									<h1><?php echo esc_html($page_heading_title) ?></h1>
									<?php if(!empty($page_heading_sub_title)):?>
									<span class="subtitle"><?php echo esc_html($page_heading_sub_title) ?></span>
									<?php endif;?>
									<?php  if($page_heading_breadcrumb_flag):?>
									<div class="page-breadcrumb" itemprop="breadcrumb">
										<?php dh_the_breadcrumb()?>
									</div>
									<?php endif;?>
									<?php if($page_heading_button_flag):?>
									<a class="btn btn-white-outline heading-button-btn" href="<?php echo esc_url_raw($page_heading_button_url)?>" title="<?php echo esc_attr($page_heading_button_text)?>"><?php echo esc_html($page_heading_button_text)?></a>
									<?php endif;?>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php elseif ($page_heading == 'default'):?>
	<div<?php echo (!empty($heading_menu_anchor) ? ' id ="'.esc_attr($heading_menu_anchor).'"': '')?> class="heading-container">
		<div class="<?php dh_container_class() ?> heading-standar">
			<?php if(dh_get_theme_option('breadcrumb',1)):?>
				<div class="page-breadcrumb" itemprop="breadcrumb">
					<?php dh_the_breadcrumb()?>
				</div>
			<?php endif;?>
		</div>
	</div>
	<?php endif;?>
	<?php do_action('dh_heading')?>