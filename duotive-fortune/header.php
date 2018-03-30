<?php
	$dt_MainTheme = get_option('dt_MainTheme','main-theme-light');
	$dt_MainThemeLocal = get_post_meta($wp_query->post->ID, "main-theme", true); if ( isset($dt_MainThemeLocal) && $dt_MainThemeLocal != '' && $dt_MainThemeLocal != 'inherit' ) $dt_MainTheme = $dt_MainThemeLocal;
	$dt_mainThemeOverwrite = '';
	if ( isset($_GET['maintheme']) ) $dt_mainThemeOverwrite = $_GET['maintheme']; else $dt_mainThemeOverwrite = '';
	if ( $dt_mainThemeOverwrite != '' )  { $dt_MainTheme = $dt_mainThemeOverwrite; setcookie('dtMainThemeOverwrite',$dt_mainThemeOverwrite,time()+3600, '/'); } if(isset($_COOKIE['dtMainThemeOverwrite']) && !isset($_GET['maintheme'])) $dt_MainTheme = $_COOKIE['dtMainThemeOverwrite'];
?>
<!doctype html>
<!--[if IE 8 ]>    <html class="no-js ie8"  <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js"  <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php bloginfo('name'); ?> <?php wp_title("-",true); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php $template_url = get_template_directory_uri(); ?>
    <?php $dt_favicon = get_option('dt_favicon'); if ( $dt_favicon != '' ) echo ' <link rel="shortcut icon" href="'.$dt_favicon.'" />'; ?>
	    <?php 
			$dt_MainSlideshow = get_option('dt_Slider','slider-off');
			$dt_PageSlideshow = get_post_meta($wp_query->post->ID, "slideshow", true); if ( $dt_PageSlideshow == '' ) $dt_PageSlideshow = 'inherit';	
			$dt_CurrentSlideshow = $dt_MainSlideshow;
			if ( $dt_PageSlideshow != 'inherit' ) $dt_CurrentSlideshow = $dt_PageSlideshow;
			if ( $dt_CurrentSlideshow != 'slider-off' )
			{
				$dt_SlideshowInfo = slideshow_require($dt_CurrentSlideshow);
        		if ( $dt_SlideshowInfo ) get_slider_scripts($dt_SlideshowInfo[0]->SLIDESHOW_TYPE);
			}
		?>
    
    <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); if ( ! isset( $content_width ) ) $content_width = 900;?>  
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />    
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo $template_url; ?>/css/<?php echo $dt_MainTheme; ?>.css" />                 
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo $template_url; ?>/css/skin.php?postid=<?php echo $wp_query->post->ID; ?>" />
    <?php $customcss =  get_option('customcss'); ?>
    <?php if ( $customcss != '' ) : ?>
    <!-- GET CUSTOM CSS -->    
		<style>
            <?php echo $customcss; ?>
        </style>
	<?php endif; ?>
    <?php $google_analytics =  get_option('google_analytics'); ?>
    <?php if ( $google_analytics != '' ) : ?>
            <?php echo $google_analytics; ?>
	<?php endif; ?>
    <script type="text/javascript">(function(a){function g(){f.content="width=device-width,minimum-scale="+e[0]+",maximum-scale="+e[1];a.removeEventListener(c,g,true)}var b="addEventListener",c="gesturestart",d="querySelectorAll",e=[1,1],f=d in a?a[d]("meta[name=viewport]"):[];if((f=f[f.length-1])&&b in a){g();e=[.25,1.6];a[b](c,g,true)}})(document)</script>        
	<?php wp_head(); ?>
</head>        
<body <?php body_class(); ?>>
<?php $dt_ThemeSwitcher = get_option('dt_ThemeSwitcher','no'); ?>
<?php if ( $dt_ThemeSwitcher == 'yes' ): ?>
    <div id="dt_themeSwitcher">
        <?php if ( $dt_MainTheme == 'main-theme-light' ): ?>
            <a href="?maintheme=main-theme-dark" class="active-light">Switcher</a>
        <?php endif; ?>
        <?php if ( $dt_MainTheme == 'main-theme-dark' ): ?>
            <a href="?maintheme=main-theme-light" class="active-dark">Switcher</a>
        <?php endif; ?>    
    </div>         
<?php endif; ?>
<?php $dt_FullWidthLoader = get_option('dt_FullWidthLoader','no'); if ( $dt_FullWidthLoader == 'yes' ) echo '<div id="dt-loader"><div id="dt-loader-bar"><div class="inner"></div></div></div>'; ?>
<div id="background-container">
	<ul>
    	<li class="static-image"></li>
    </ul>
</div>
<noscript><section class="dt-message dt-message-error dt-message-centered dt-message-centered-no-js">This website is best viewed with JavaScript enabled.</section></noscript>
<header id="website-header" class="clearfix">
	<?php $dt_headerLogo = get_option('dt_headerLogo'); ?>
    <a id="header-logo" href="<?php echo home_url( '/' ); ?>">
        <?php if ( $dt_headerLogo != '' ) : ?>
            <?php $vertical = get_option('dt_headerLogoVertical'); ?>
            <?php $horizontal = get_option('dt_headerLogoHorizontal'); ?>
            <?php if ( $vertical != '' && $horizontal != '' ) $class = ' style="margin-top:'.$vertical.'px; margin-left:'.$horizontal.'px;"'; ?>
            <img<?php echo $class; ?> src="<?php echo $dt_headerLogo; ?>" alt="<?php echo get_bloginfo('name'); ?>" />
        <?php endif; ?>
    </a>
    <div id="header-toolbox">
		<?php $dt_headerSharing = get_option('dt_headerSharing','no'); ?>
        <?php $dt_headerSearch = get_option('dt_headerSearch','no'); ?> 
        <?php if ( $dt_headerSharing == 'yes' ): ?>
             <div id="header-sharing">
                <?php if ( get_option('dt_HeaderSharingDeviantart') != '' ): ?>
                    <a href="<?php echo get_option('dt_HeaderSharingDeviantart'); ?>" class="social-item deviantart" title="Deviantart" target="_blank"><span class="normal"></span><span class="hover"></span>Deviantart</a>
                <?php endif; ?>
                <?php if ( get_option('dt_HeaderSharingFacebook') != '' ): ?>                    
                    <a href="<?php echo get_option('dt_HeaderSharingFacebook'); ?>" class="social-item facebook" title="Facebook" target="_blank"><span class="normal"></span><span class="hover"></span>Facebook</a>	
                <?php endif; ?>	                    
                <?php if ( get_option('dt_HeaderSharingFlickr') != '' ): ?>                    
                    <a href="<?php echo get_option('dt_HeaderSharingFlickr'); ?>" class="social-item flickr" title="Flickr" target="_blank"><span class="normal"></span><span class="hover"></span>Flickr</a>
                <?php endif; ?>	                    
                <?php if ( get_option('dt_HeaderSharingMyspace') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingMyspace'); ?>" class="social-item myspace" title="Myspace" target="_blank"><span class="normal"></span><span class="hover"></span>Myspace</a>
                <?php endif; ?>	                    
                <?php if ( get_option('dt_HeaderSharingRss') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingRss'); ?>" class="social-item rss" title="RSS" target="_blank"><span class="normal"></span><span class="hover"></span>RSS</a>
                <?php endif; ?>	                    
                <?php if ( get_option('dt_HeaderSharingTwitter') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingTwitter'); ?>" class="social-item twitter" title="Twitter" target="_blank"><span class="normal"></span><span class="hover"></span>Twitter</a>
                <?php endif; ?>	                    
                <?php if ( get_option('dt_HeaderSharingVimeo') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingVimeo'); ?>" class="social-item vimeo" title="Vimeo" target="_blank"><span class="normal"></span><span class="hover"></span>Vimeo</a>
                <?php endif; ?>	                    
                <?php if ( get_option('dt_HeaderSharingYoutube') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingYoutube'); ?>" class="social-item youtube" title="Youtube" target="_blank"><span class="normal"></span><span class="hover"></span>Youtube</a>
                <?php endif; ?>
                <?php if ( get_option('dt_HeaderSharingReddit') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingReddit'); ?>" class="social-item reedit" title="Reedit" target="_blank"><span class="normal"></span><span class="hover"></span>Reedit</a>
                <?php endif; ?> 
                <?php if ( get_option('dt_HeaderSharingStumbleUpon') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingStumbleUpon'); ?>" class="social-item stumpleupon" title="StumpleUpon" target="_blank"><span class="normal"></span><span class="hover"></span>StumpleUpon</a>
                <?php endif; ?> 
                <?php if ( get_option('dt_HeaderSharingSoundCloud') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingSoundCloud'); ?>" class="social-item soundcloud" title="SoundCloud" target="_blank"><span class="normal"></span><span class="hover"></span>SoundCloud</a>
                <?php endif; ?> 
                <?php if ( get_option('dt_HeaderSharingGooglePlus') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingGooglePlus'); ?>" class="social-item googleplus" title="Google+" target="_blank"><span class="normal"></span><span class="hover"></span>Google+</a>
                <?php endif; ?>   
                <?php if ( get_option('dt_HeaderSharingLinkedIn') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingLinkedIn'); ?>" class="social-item linkedin" title="LinkedIn" target="_blank"><span class="normal"></span><span class="hover"></span>LinkedIn</a>
                <?php endif; ?> 
                <?php if ( get_option('dt_HeaderSharingDelicious') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingDelicious'); ?>" class="social-item delicious" title="Delicious" target="_blank"><span class="normal"></span><span class="hover"></span>Delicious</a>
                <?php endif; ?>   
                <?php if ( get_option('dt_HeaderSharingDigg') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingDigg'); ?>" class="social-item digg" title="Digg" target="_blank"><span class="normal"></span><span class="hover"></span>Digg</a>
                <?php endif; ?>   
                <?php if ( get_option('dt_HeaderSharingTechnorati') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingTechnorati'); ?>" class="social-item technorati" title="Technorati" target="_blank"><span class="normal"></span><span class="hover"></span>Technorati</a>
                <?php endif; ?>
                <?php if ( get_option('dt_HeaderSharingSkype') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingSkype'); ?>" class="social-item skype" title="Skype" target="_blank"><span class="normal"></span><span class="hover"></span>Skype</a>
                <?php endif; ?>                                                                                                            
                <?php if ( get_option('dt_HeaderSharingBlogger') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingBlogger'); ?>" class="social-item blogger" title="Blogger" target="_blank"><span class="normal"></span><span class="hover"></span>Blogger</a>
                <?php endif; ?> 
                <?php if ( get_option('dt_HeaderSharingPicasa') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingPicasa'); ?>" class="social-item picasa" title="Picasa" target="_blank"><span class="normal"></span><span class="hover"></span>Picasa</a>
                <?php endif; ?>
                <?php if ( get_option('dt_HeaderSharingDribble') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingDribble'); ?>" class="social-item dribble" title="Dribbble" target="_blank"><span class="normal"></span><span class="hover"></span>Dribbble</a>
                <?php endif; ?>
                <?php if ( get_option('dt_HeaderSharingModelMayhem') != '' ): ?>                
                    <a href="<?php echo get_option('dt_HeaderSharingModelMayhem'); ?>" class="social-item modelmayhem" title="ModelMayhem" target="_blank"><span class="normal"></span><span class="hover"></span>ModelMayhem</a>
                <?php endif; ?>                                                  
            <!-- end of header sharing -->                                       
            </div>
        <?php endif; ?>    
        <?php if ( $dt_headerSharing == 'yes' && $dt_headerSearch == 'yes'  ): ?>
            <div id="header-search-sep"></div>
        <?php endif; ?>
		<?php if ( is_active_sidebar( 'toolbar-language-area' ) ) : ?>
            <div id="language-box">
                <?php dynamic_sidebar( 'toolbar-language-area' ); ?>
            </div>
        <?php endif; ?>
        <?php if ( $dt_headerSearch == 'yes' ): ?>                
            <div id="header-search-wrapper">
                <div id="header-search-button" class="active"></div>
                <form method="get" id="headersearchform" action="<?php echo site_url(); ?>">
                    <input class="inputbox" type="text" name="s" onFocus="if(this.value=='<?php echo dt_SearchInputBox; ?>') this.value='';" onBlur="if(this.value=='') this.value='<?php echo dt_SearchInputBox; ?>';" value="<?php echo dt_SearchInputBox; ?>" size="20" maxlength="20">
                    <input class="search" type="submit" value="" />
                </form>            	    
            </div>  
        <?php endif; ?>               
    </div>
    <nav id="mainmenu"<?php if ( $dt_headerSharing == 'no' && $dt_headerSearch == 'no' ) echo ' class="mainmenu-no-toolbox"'; ?>>
    	<?php $dt_headerHome = get_option('dt_headerHome','yes'); ?>
    	<ul class="menu-items-parent<?php if ( $dt_headerHome == 'no'){ echo ' main-menu-no-home';}?>">
            <?php if ( $dt_headerHome == 'yes') : ?>
        	<li class="home-icon<?php if ( is_home() || is_front_page() ) echo ' home-active'; ?>">
				<a href="<?php echo home_url( '/' ); ?>">Home</a>
            </li>
            <?php endif; ?>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'items_wrap' => '%3$s','fallback_cb' => '' ) ); ?>    
        </ul>
        <div class="highlight"></div>
        <div class="shadow"></div>
    </nav>
<!-- end of website header -->    
</header>
<?php 
	$dt_MainSlideshow = get_option('dt_Slider','slider-off');
	$dt_PageSlideshow = get_post_meta($wp_query->post->ID, "slideshow", true); if ( $dt_PageSlideshow == '' ) $dt_PageSlideshow = 'inherit';	
	$dt_CurrentSlideshow = $dt_MainSlideshow;
	if ( $dt_PageSlideshow != 'inherit' ) $dt_CurrentSlideshow = $dt_PageSlideshow;
?>
<?php if ( $dt_CurrentSlideshow != 'slider-off') : ?>
	<section id="slideshow-wrapper">
		<?php $dt_SlideshowInfo = slideshow_require($dt_CurrentSlideshow); ?>
        <?php get_slider_code($dt_SlideshowInfo[0]->SLIDESHOW_TYPE,$dt_SlideshowInfo[0]->ID); ?>
	</section>
<?php endif; ?>
<?php $dt_ContentWrapperClass = ''; $dt_FrontPageIntroOnly = ''; ?>
<?php $dt_FooterSharing = get_option('dt_FooterSharing','no'); ?>
<?php $dt_Footer = get_option('dt_Footer','no'); ?>
<?php if ( $dt_FooterSharing == 'yes' || $dt_Footer == 'yes' ) $dt_ContentWrapperClass = 'no-bottom-borders'; ?>
<?php if ( $dt_FrontPageIntroOnly == 'yes' && $dt_Footer == 'yes' && is_front_page() ) $dt_ContentWrapperClass = ' footer-and-intro-only'; ?>
<section id="content-wrapper"<?php if ( $dt_ContentWrapperClass != '' ) echo ' class="'.$dt_ContentWrapperClass.'"'; ?>>
	<?php if(!is_page_template('frontpage-base.php')): ?>
        <header id="page-title" class="page-title <?php if(is_home()) echo ' page-title-home'; ?>">
            <?php if(function_exists('bcn_display')) : ?>
                <div class="breadcrumbs">
                    <?php                     
                        $breadcrumb_trail = new bcn_breadcrumb_trail();
                        $breadcrumb_trail->opt['Shome_title'] = 'Home';
						$breadcrumb_trail->opt['Hhome_template'] = '<a title="Go to %title%." href="%link%">Home</a>';
                        $breadcrumb_trail->opt['hseparator'] = '/';
						$breadcrumb_trail->opt['bcurrent_item_linked'] = 0;
						$breadcrumb_trail->opt['Hmainsite_template_no_anchor'] = '<span class="current">%title%</span>';
						$breadcrumb_trail->opt['Hhome_template_no_anchor'] = '<span class="current">%title%</span>';
						$breadcrumb_trail->opt['Hblog_template_no_anchor'] = '<span class="current">%title%</span>';
						$breadcrumb_trail->opt['Hcurrent_item_template_no_anchor'] = '<span class="current">%title%</span>';
						$breadcrumb_trail->opt['Hpost_page_template_no_anchor'] = '<span class="current">%title%</span>';
						$breadcrumb_trail->opt['Hpost_post_template_no_anchor'] = '<span class="current">%title%</span>';
						$breadcrumb_trail->opt['Hpost_project_template_no_anchor'] = '<span class="current">%title%</span>';						
						$breadcrumb_trail->opt['Hpost_attachment_template_no_anchor'] = '<span class="current">%title%</span>';
						$breadcrumb_trail->opt['Hsearch_template_no_anchor'] = '<span class="current">%title%</span>';
						$breadcrumb_trail->opt['Hpost_tag_template_no_anchor'] = '<span class="current">%title%</span>';
						$breadcrumb_trail->opt['Hauthor_template_no_anchor'] = '<span class="current">%title%</span>';
						$breadcrumb_trail->opt['Hcategory_template_no_anchor'] = '<span class="current">%title%</span>';
						$breadcrumb_trail->opt['Hportfolio_template_no_anchor'] = '<span class="current">%title%</span>';						
						$breadcrumb_trail->opt['Hdate_template_no_anchor'] = '<span class="current">%title%</span>';					
						$breadcrumb_trail->opt['S404_title'] = '';
                        $breadcrumb_trail->fill();
                        $breadcrumb_trail->display();        
                    ?>
                </div>    
            <?php endif; ?>
            <h1><?php echo get_title_outside_loop(); ?></h1>
        </header>
	<?php endif; ?>        