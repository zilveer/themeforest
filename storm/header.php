<?php
/**
 * The Header for the theme.
 *
 */
?>
<?php 
    $schema_org = '';
if (is_single()) {
	$schema_org .= 'itemscope itemtype="http://schema.org/Article"';
} else {
	$schema_org .= 'itemscope itemtype="http://schema.org/WebPage"';
}
?>
<?php global $bk_option;
    $favicon = array(); $logo = array();
    if (isset($bk_option)):
        $site_layout = $bk_option['bk-site-layout'];
        $backtop = $bk_option['bk-backtop-switch'];
        if ((isset($bk_option['bk-favicon'])) && (($bk_option['bk-favicon']) != NULL)){ 
            $favicon = $bk_option['bk-favicon'];
        };
        if ((isset($bk_option['bk-logo'])) && (($bk_option['bk-logo']) != NULL)){ 
            $logo = $bk_option['bk-logo'];
        };
        $header_layout = $bk_option['bk-header-layout'];
        $module_header_layout = $bk_option['bk-module-header-layout'];
        $header_scheme = $bk_option['bk-header-scheme'];
        if ($bk_option['bk-sidebar-location'] != NULL){ $sidebar_location = $bk_option['bk-sidebar-location'];};
        $cr_text = $bk_option['cr-text'];
        $header_banner = $bk_option['bk-header-banner-switch'];
        $ga_script = $bk_option['bk-banner-script'];
        if ($header_banner){ 
                $imgurl = $bk_option['bk-header-banner']['imgurl'];
                $linkurl = $bk_option['bk-header-banner']['linkurl'];
        }; 
        $rtl = $bk_option['bk-rtl-sw'];
    endif;
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<?php if (is_single()) { $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'bk330_220' ); $thumb_url = $thumb['0'];?>
    <meta property="og:image" content="<?php echo $thumb_url; ?>"/>
<?php } ?>

<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo (' | '.$site_description);

	// Add a page number:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'bkninja' ), max( $paged, $page ) );

	?>
</title>

<?php if (($favicon != null) && (array_key_exists('url',$favicon))) {
        if ($favicon['url'] != '') {
        echo '<link rel="shortcut icon" href="'.  $favicon['url']  .'"/>';
        }
     }?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php
	wp_head();
?>
    
</head>

<body <?php body_class(); ?> <?php echo $schema_org ?> >
    <div class="site-container <?php if ($site_layout == 1) echo 'wide'; else echo 'boxed';?>">
    	<!-- page-wrap open-->
    	<div class="page-wrap module-header-<?php if ($module_header_layout == 'left') echo 'left'; else echo 'center';?> clear-fix">
    
    		<!-- header-wrap open -->
    		<div class="header-wrap header-<?php echo $header_layout;?> header-<?php echo $header_scheme;?>">
            
                <?php if (( has_nav_menu('menu-top')) || ( $bk_option ['bk-header-social-switch'] == 1 )) {?> 
                <div class="top-bar clear-fix">
                    <div class="header-inner clear-fix">
    				
        					<?php if ( has_nav_menu('menu-top') ) {?> 
                        <nav class="top-nav">
                            <div class="mobile">
                                <i class="fa fa-bars"></i>
                            </div>
                            <?php wp_nav_menu(array('theme_location' => 'menu-top','container_id' => 'top-menu'));?> 
                                   
                        </nav><!--top-nav--> <?php }?>
                        
        				<?php if ( $bk_option ['bk-header-social-switch'] == 1 ){ ?>		
        				
        					<div class="header-social clear-fix">
        						<ul>
        							<?php if ($bk_option['bk-social-header']['fb']){ ?>
        								<li class="fb"><a href="<?php echo $bk_option['bk-social-header']['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
        							<?php } ?>
        							
        							<?php if ($bk_option['bk-social-header']['twitter']){ ?>
        								<li class="twitter"><a href="<?php echo $bk_option['bk-social-header']['twitter']; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
        							<?php } ?>
        							
        							<?php if ($bk_option['bk-social-header']['gplus']){ ?>
        								<li class="gplus"><a href="<?php echo $bk_option['bk-social-header']['gplus']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
        							<?php } ?>
        							
        							<?php if ($bk_option['bk-social-header']['linkedin']){ ?>
        								<li class="linkedin"><a href="<?php echo $bk_option['bk-social-header']['linkedin']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        							<?php } ?>
        							
        							<?php if ($bk_option['bk-social-header']['pinterest']){ ?>
        								<li class="pinterest"><a href="<?php echo $bk_option['bk-social-header']['pinterest']; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
        							<?php } ?>
        							
        							<?php if ($bk_option['bk-social-header']['instagram']){ ?>
        								<li class="instagram"><a href="<?php echo $bk_option['bk-social-header']['instagram']; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
        							<?php } ?>
        							
        							<?php if ($bk_option['bk-social-header']['dribbble']){ ?>
        								<li class="dribbble"><a href="<?php echo $bk_option['bk-social-header']['dribbble']; ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li>
        							<?php } ?>
        							
        							<?php if ($bk_option['bk-social-header']['youtube']){ ?>
        								<li class="youtube"><a href="<?php echo $bk_option['bk-social-header']['youtube']; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
        							<?php } ?>      							
        							                                    
                                    <?php if ($bk_option['bk-social-header']['vimeo']){ ?>
        								<li class="vimeo"><a href="<?php echo $bk_option['bk-social-header']['vimeo']; ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
        							<?php } ?>
                                    
                                    <?php if ($bk_option['bk-social-header']['vk']){ ?>
        								<li class="vk"><a href="<?php echo $bk_option['bk-social-header']['vk']; ?>" target="_blank"><i class="fa fa-vk"></i></a></li>
        							<?php } ?>
                                    
                                    <?php if ($bk_option['bk-social-header']['rss']){ ?>
        								<li class="rss"><a href="<?php echo $bk_option['bk-social-header']['rss']; ?>" target="_blank"><i class="fa fa-rss"></i></a></li>
        							<?php } ?>
        							
        						</ul>
        					</div>
        				<?php } ?>
                    </div>
                </div><!--top-bar-->
                <?php } ?>
                <!-- header open -->
                <div class="header">
                    <div class="header-inner">
            			<!-- logo open -->
                        <?php if (($logo != null) && (array_key_exists('url',$logo))) {
                                if ($logo['url'] != '') {
                            ?>
            			<div class="logo">
                            <h1>
                                <a href="<?php echo get_home_url();?>">
                                    <img src="<?php echo $logo['url'];?>" alt="logo"/>
                                </a>
                            </h1>
            			</div>
            			<!-- logo close -->
                        <?php } else {?> 
                        <div class="logo logo-text">
                            <h1>
                                <a href="<?php echo get_home_url();?>">
                                    <?php echo bloginfo( 'name' );?>
                                </a>
                            </h1>
            			</div>
                        <?php }
                        } else {?> 
                        <div class="logo logo-text">
                            <h1>
                                <a href="<?php echo get_home_url();?>">
                                    <?php echo bloginfo( 'name' );?>
                                </a>
                            </h1>
            			</div>
                        <?php } ?>
                        <?php if ( $header_banner ) : ?>
                            <!-- header-banner open -->                             
                			<div class="header-banner">
                            <?php
                                if ($ga_script != ''){
                                    echo $ga_script;
                                } else { ?>
                                    <a class="ads-banner-link" target="_blank" href="<?php echo esc_attr( $linkurl ); ?>">
                    				    <img class="ads-banner" src="<?php echo esc_attr( $imgurl ); ?>" alt="Header Banner"/>
                                    </a>
                                <?php }
                            ?> 
                			</div>                            
                			<!-- header-banner close -->
                        <?php endif; ?>
                    </div>   			
                </div>
                <!-- header close -->
                
    			<!-- nav open -->
    			<nav class="main-nav">
                    <div class="header-inner clear-fix">
                        <div class="mobile">
                            <i class="fa fa-bars"></i>
                        </div>
                        <?php if ( has_nav_menu( 'menu-main' ) ) { 
                            wp_nav_menu( array( 
                                'theme_location' => 'menu-main',
                                'container_id' => 'main-menu',
                                'walker' => new BK_Walker,
                                'depth' => '3' ) );
                            wp_nav_menu( array( 
                                'theme_location' => 'menu-main',
                                'depth' => '2',
                                'container_id' => 'main-mobile-menu' ) );
                            } ?>
                        
                        
                        
                        <div id="main-search" <?php if ($rtl) echo 'class="search-rtl"'; else echo 'class="search-ltr"';?>>
    
    				        <?php get_search_form(); ?>
    
                        </div><!--main-search-->
                        
                    </div><!-- main-nav-inner -->
                
    			</nav>
    			<!-- nav close -->

            </div>
            <!-- header-wrap close -->
    		
    		<!-- backtop open -->
    		<?php if ($backtop) { ?>
                <div id="back-top"><i class="fa fa-angle-up"></i></div>
            <?php } ?>
    		<!-- backtop close -->
    		
    		<!-- MAIN BODY OPEN -->
    		<div class="main-body clear-fix sb-<?php echo($sidebar_location);?>">