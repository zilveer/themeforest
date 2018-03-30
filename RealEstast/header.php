<?php
/**
 * @var PGL_Options $pgl_options
 * @var WP_Query $wp_query
 */
global $pgl_options;
global $wp_query;
$headerLayout = $pgl_options->option( 'header_type' ) ? $pgl_options->option( 'header_type' ) : 'static';
$themeLayout = $pgl_options->option( 'theme_layout' ) ? $pgl_options->option( 'theme_layout' ) : 'fluid';
$isFront = is_front_page();
$isShowSearch = false;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<title><?php bloginfo( 'name' ); ?> <?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	?>
	<?php wp_head(); ?>
	<?php do_action('before_end_header')?>
</head>
<body <?php body_class()?>>
<div class="layout-wrapper layout-<?php echo $themeLayout?>">
<header class="header <?php echo $headerLayout?>">
	<?php if(is_active_sidebar('header-top-left') || is_active_sidebar('header-top-right')):?>
	<div class="header-bar">
		<div class="container">
			<div class="row">
			<?php if(is_active_sidebar('header-top-left')):?>
				<div class="col-md-6 col-sm-6">
					<?php dynamic_sidebar('header-top-left');?>
				</div>
			<?php endif?>
			<?php if(is_active_sidebar('header-top-right')):?>
				<div class="col-md-6 col-sm-6">
					<?php dynamic_sidebar('header-top-right');?>
				</div>
			<?php endif?>
			</div>
		</div>
	</div>
	<?php endif;?>
    <div class="navbar navbar-static-top">
        <div class="container">
            <div class="top-header">
                <div id="mobile-menu">
                    <a id="responsive-menu-button" class="menu-btn" href="javascript:void(0)"><i class="fa fa-bars fa-2x"></i></a>
                </div>
                <div class="realestate-logo">
                    <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <img alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" src="<?php echo( $pgl_options->option( 'site_logo' ) ? $pgl_options->option( 'site_logo' ) : PGL_URI_IMG . 'logo.png' ); ?>" class="logo-img">
                    </a>
                </div>
                <div class="menu-navbar hidden-xs">
                    <nav class="navbar" id="navigation" role="navigation">
                        <?php
                        if ( has_nav_menu( 'primary_navigation' ) ) :
	                        wp_nav_menu(
	                            array(
	                                'theme_location' => 'primary_navigation',
	                                'menu_class'     => 'nav navbar-nav',
	                                'menu_id'        => 'navmenu-'.$headerLayout,
		                            'walker'        => new PGL_Walker_Nav_Menu()
	                            )
	                        );
                        endif;

                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<?php
if(is_search()){
	if(isset($_GET["post_type"])&&$_GET["post_type"]=='estate'&&$pgl_options->option('estate_search_result')){
		$isShowSearch = true;
	}
}else{
	if(($pgl_options->option( 'estate_search_home' )&&$isFront)
		||((is_tax('estate-type')||is_tax('estate-location')||(is_post_type_archive('estate')&&!is_search()))&&$pgl_options->option( 'estate_search_archive' ))){
		$isShowSearch = true;
	}
}
if($isFront){?>
	<?php if(is_active_sidebar('home-header-widgets')){ ?>
<div class="under-header-widgets">
<?php dynamic_sidebar( 'home-header-widgets' );?>
</div>
	<?php } ?>
	<?php
	if((bool) $pgl_options->option( 'enable_slider' )){
		PGL_Template_Tag::slider();
	}
}elseif(!is_404() && !is_search()){
	if((bool) $pgl_options->option( 'show_headimg' )) {?>
		<div class="under-header-widgets">
			<?php dynamic_sidebar( 'page-header-widgets' );?>
		</div>
		<div class="header-image">
			<div class="hidden-xs">
				<section class="pic-cat">
					<img src="<?php echo ($pgl_options->option( 'header_image' ) ? $pgl_options->option( 'header_image' ) : PGL_URI_IMG . 'imgdemo/1900x200.gif') ; ?>" alt="" />
				</section>
			</div>
		</div>
	<?php
	}
}
?>
<div class="main-content<?php if(!(bool) $pgl_options->option( 'show_headimg' )){ ?> header-image-off<?php }else{ ?> header-image-on<?php }?><?php if($isShowSearch):?> search-form-on<?php else:?> search-form-off<?php endif;?><?php if($isFront):?><?php if((bool) $pgl_options->option( 'enable_slider' )||is_active_sidebar('home-header-widgets')):?> front-have-slider<?php else:?> front-no-slider<?php endif; endif;?>">
<?php if($isShowSearch):?>
    <?php echo do_shortcode("[estate_search]"); ?>
<?php endif;?>