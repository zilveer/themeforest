<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />

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
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
      

        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
        <meta name="format-detection" content="telephone=no" />
	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
          <?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>
            
        <!-- CSS
  ================================================== -->
     
        
        
              <?php if (ot_get_option('skin') == 'dark') {  ?>
        
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/stylesheets/colors/dark.css">
        
            <?php } ?>

       
        <!-- Google Fonts -->

        <link href='http://fonts.googleapis.com/css?family=Archivo+Narrow:400,400italic,700,700italic|Oswald:400,300,700' rel='stylesheet' type='text/css'>
        
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
        
        
        <!-- Atoms & Pingback
        ================================================== -->

        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
        <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
        <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <!-- Theme Hook -->
    
        <?php wp_head(); ?>

        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
        
   <!--[if IE 8]>
<style type="text/css">
   
   .button-big, .button-small, .portfolio_cats a, .pagination a, .pagination .current, .portfolio_previous a, .portfolio_next a  { color: #fff !important; }
   .main ul li a .description { font-size: 12px; }
   
</style>
<![endif]-->
   
    <!--[if IE 7]>
<style type="text/css">
   
	 .button-big, .button-small, .portfolio_cats a, .pagination a, .pagination .current, .portfolio_previous a, .portfolio_next a  { color: #fff !important; }
   .main ul li a .description { font-size: 12px; }
    
   }
   
</style>
<![endif]-->
    
     <!--[if IE 6]>
<style type="text/css">
   
	 .button-big, .button-small, .portfolio_cats a, .pagination a, .pagination .current, .portfolio_previous a, .portfolio_next a  { color: #fff !important; }
   .main ul li a .description { font-size: 12px; }
   }
   
</style>
<![endif]-->
    
     
    
     <style>
                  
         /* Accent color */

.pageContent a, .pageContent a:visited, #comments a, .homeHorizontalWidget a, .widgetModuleWrapper a, .widget a  {   color: <?php echo ot_get_option('linkscolor') ?>;     }
.pageContent a:hover, .pageContent a:focus, #comments a:hover, .homeHorizontalWidget a:hover, .widgetModuleWrapper a:hover, .widget a:hover { color: <?php echo ot_get_option('linkshovercolor') ?>;     }

         
/* Buttons Color */

   <?php if (ot_get_option('buttons')) { ?>

.button-small-theme, .form-submit input  { background: <?php echo ot_get_option('buttons') ?> !important; }

<?php } else { ?>

.button-small-theme { background: #444 !important; }

<?php } ?>

.footerModule h2, 
.mainNav .current-menu-item a, 
.mainNav .current_page_item a,
.mainNav li a:hover, 
.flex-active-slide .navDescription, 
.pageInfo, 
.special li,
.pricing .price,
.special .description,
.postThumbDate,
.dd_news_widget .viewall a:hover,
.dd_trainers_widget .viewall a:hover,
.dd_classes_widget .viewall a:hover,
.difficultyLevel
{
    background: <?php echo ot_get_option('accent') ?> !important;
}

.mainNav .current_page_item ul a:hover { background: <?php echo ot_get_option('accent') ?>; color: #fff; }


.footerModule h3, 
.slidesDescription, 
.pricing li,
.widget h3,
.classesInfo,
.contactForm

{
    border-left: 5px solid <?php echo ot_get_option('accent') ?>;
}
.pricingTable .special .title {
       background: url(<?php echo get_template_directory_uri(); ?>/images/pricingBg.png) <?php echo ot_get_option('accent') ?> top right no-repeat !important;
}
blockquote {
    border-left: 3px solid <?php echo ot_get_option('accent') ?>;
}
.topBarActive {
    background-color: <?php echo ot_get_option('accent') ?> !important;
    border-bottom: 1px solid <?php echo ot_get_option('accent') ?>;
}
.contact:hover {
     background: url(<?php echo get_template_directory_uri(); ?>/images/mailIconLight.png) no-repeat 19px 16px <?php echo ot_get_option('accent') ?>;
     border-bottom: 1px solid <?php echo ot_get_option('accent') ?>;
}
.openingHours:hover  {
    background: url(<?php echo get_template_directory_uri(); ?>/images/openingHoursIconLight.png) no-repeat 19px 15px <?php echo ot_get_option('accent') ?>;
    border-bottom: 1px solid <?php echo ot_get_option('accent') ?>;
}
.mainNav li a:hover {
    border-right: 1px solid <?php echo ot_get_option('accent') ?>;
}
.singleThumb img, .postThumb {
    border-bottom: 5px solid <?php echo ot_get_option('accent') ?>;
}
.special .title {  background: url(<?php echo get_template_directory_uri(); ?>/images/pricingBg.png) <?php echo ot_get_option('accent') ?> top right no-repeat;}

header {  background: <?php echo ot_get_option('header') ?> ;}

<?php if (ot_get_option('footercolor')) { ?>


footer {   background: url(<?php echo get_template_directory_uri(); ?>/images/footerBg.png) bottom right no-repeat <?php echo ot_get_option('footercolor') ?>; }


<?php } else { ?>

   footer {   background: url(<?php echo get_template_directory_uri(); ?>/images/footerBg.png) bottom right no-repeat #262729; }
    
    <?php } ?>

   <?php if (ot_get_option('page')) { ?>
   
   #carousel .flex-viewport,
.pageContentWrapper,
.widgetModuleWrapper,
.pageWidgetModule
{
    background: <?php echo ot_get_option('page') ?>;
}

    <?php } else { ?>

   #carousel .flex-viewport,
.pageContentWrapper,
.widgetModuleWrapper,
.pageWidgetModule
{
    background: #e4e8ee;
}
    <?php }  ?>

   <?php if (ot_get_option('smallfooter')) { ?>

.smallFooter {
    background:  <?php echo ot_get_option('smallfooter') ?>;
}
    <?php } else { ?>

.smallFooter {
    background: #151617;
}

    <?php }  ?>


     </style>
 
    
     
</head>

    <body data-spy="scroll" data-target=".subnav" data-offset="50" <?php body_class(); ?>>

      <?php if (ot_get_option('topbar') == 'yes') {  ?>
  
        <div class="topBar">

          <div class="container">

            <div class="sixteen columns">

              <ul class="topBarMenu clearfix">

                <?php if (ot_get_option('openinghours') == 'yes') {  ?>

                  <li class="openingHoursModule">

                    <a class="openingHours" href="#"><?php _e('Opening Hours', 'localization'); ?></a>

                    <div class="footerModule clearfix">

                      <?php if (ot_get_option('openinghourshtml')) {  ?>

                        <?php echo ot_get_option('openinghourshtml') ?>

                      <?php } else { ?>

                        <h3>Add content here by going in "theme options/top bar/Opening Hours HTML Content". The HTML code is provided in the help file if you haven't imported the dummy content from the demo.</h3>

                      <?php } ?>

                    </div>

                  </li>

                <?php } ?>

                <?php if (ot_get_option('phonenumber') == 'yes') {  ?>
                
                  <li><span class="phone"><?php echo ot_get_option('phonenumbercontent') ?></span></li>

                <?php } ?>

                <?php if (ot_get_option('contactform') == 'yes') {  ?>

                  <li class="contactModule">

                    <a class="contact" href="#"><?php _e('Contact', 'localization'); ?></a>

                    <div class="footerModule clearfix">

                      <h2><?php _e("Let's Keep In Touch!", 'localization'); ?><a href="#" class="contactClose">X</a></h2>

                      <?php if (ot_get_option('contactformadress') == 'yes') {  ?>

                        <h3 class="odd"><span class="moduleLabel"><?php _e('ADDRESS', 'localization'); ?></span><span class="moduleDescription"><?php echo ot_get_option('contactformadresscontent') ?></span></h3>

                      <?php } ?>

                      <h3 class="contactTitle"><span class="moduleLabel" style="width: 95%;"><?php _e('LEAVE A COMMENT', 'localization'); ?></span></h3>

                      <div class="contactForm clearfix">

                        <form id="contactForm"  class="clearfix" action="<?php echo get_template_directory_uri(); ?>/processForm.php" method="post">

                          <ul>

                            <li>
                              <label for="senderName"><?php _e('Your Name', 'localization'); ?></label>
                              <input type="text" name="senderName" id="senderName" placeholder="" required="required" maxlength="40" />
                            </li>

                            <li>
                              <label for="senderEmail"><?php _e('Your Email Address', 'localization'); ?></label>
                              <input type="email" name="senderEmail" id="senderEmail" placeholder="" required="required" maxlength="50" />
                            </li>

                            <li>
                              <label for="message" style="padding-top: .5em;"><?php _e('Your Message', 'localization'); ?></label>
                              <textarea name="message" id="message" placeholder="" required="required" cols="80" rows="10" maxlength="10000"></textarea>
                            </li>

                          </ul>

                          <input type="submit" class="button-small-theme rounded3" id="sendMessage" name="sendMessage" value="Send Email" />

                        </form>

                        <div id="sendingMessage" class="statusMessage"><p><?php _e('Sending your message. Please wait...', 'localization'); ?></p></div>
                        <div id="successMessage" class="statusMessage"><p><?php _e("Thanks for sending your message! We'll get back to you shortly.", 'localization'); ?></p></div>
                        <div id="failureMessage" class="statusMessage"><p><?php _e('There was a problem sending your message. Please try again.', 'localization'); ?></p></div>
                        <div id="incompleteMessage" class="statusMessage"><p><?php _e('Please complete all the fields in the form before sending.', 'localization'); ?></p></div>

                      </div>

                    </div>

                  </li>

                <?php } ?>

              </ul>

              <div class="topBarSocial">

                <ul class="topBarSocialList">

                  <?php if ( ot_get_option( 'top_bar_social_twitter', '' ) != '' ) : ?>
                    <li><a href="<?php echo ot_get_option( 'top_bar_social_twitter' ); ?>"><span class="social-icon-twitter"></span></a></li>
                  <?php endif; ?>

                  <?php if ( ot_get_option( 'top_bar_social_facebook', '' ) != '' ) : ?>
                    <li><a href="<?php echo ot_get_option( 'top_bar_social_facebook' ); ?>"><span class="social-icon-facebook"></span></a></li>
                  <?php endif; ?>

                  <?php if ( ot_get_option( 'top_bar_social_vimeo', '' ) != '' ) : ?>
                    <li><a href="<?php echo ot_get_option( 'top_bar_social_vimeo' ); ?>"><span class="social-icon-vimeo"></span></a></li>
                  <?php endif; ?>

                  <?php if ( ot_get_option( 'top_bar_social_googleplus', '' ) != '' ) : ?>
                    <li><a href="<?php echo ot_get_option( 'top_bar_social_googleplus' ); ?>"><span class="social-icon-gplus"></span></a></li>
                  <?php endif; ?>

                  <?php if ( ot_get_option( 'top_bar_social_pinterest', '' ) != '' ) : ?>
                    <li><a href="<?php echo ot_get_option( 'top_bar_social_pinterest' ); ?>"><span class="social-icon-pinterest"></span></a></li>
                  <?php endif; ?>

                  <?php if ( ot_get_option( 'top_bar_social_flickr', '' ) != '' ) : ?>
                    <li><a href="<?php echo ot_get_option( 'top_bar_social_flickr' ); ?>"><span class="social-icon-picture"></span></a></li>
                  <?php endif; ?>

                  <?php if ( ot_get_option( 'top_bar_social_linkedin', '' ) != '' ) : ?>
                    <li><a href="<?php echo ot_get_option( 'top_bar_social_linkedin' ); ?>"><span class="social-icon-linkedin"></span></a></li>
                  <?php endif; ?>

                  <?php if ( ot_get_option( 'top_bar_social_dribbble', '' ) != '' ) : ?>
                    <li><a href="<?php echo ot_get_option( 'top_bar_social_dribbble' ); ?>"><span class="social-icon-dribbble"></span></a></li>
                  <?php endif; ?>

                  <?php if ( ot_get_option( 'top_bar_social_instagram', '' ) != '' ) : ?>
                    <li><a href="<?php echo ot_get_option( 'top_bar_social_instagram' ); ?>"><span class="social-icon-instagram"></span></a></li>
                  <?php endif; ?>

                  <?php if ( ot_get_option( 'top_bar_social_behance', '' ) != '' ) : ?>
                    <li><a href="<?php echo ot_get_option( 'top_bar_social_behance' ); ?>"><span class="social-icon-behance"></span></a></li>
                  <?php endif; ?>

                  <?php if ( ot_get_option( 'top_bar_social_youtube', '' ) != '' ) : ?>
                    <li><a href="<?php echo ot_get_option( 'top_bar_social_youtube' ); ?>"><span class="social-icon-youtube"></span></a></li>
                  <?php endif; ?>

                </ul><!-- topBarSocialList -->

              </div><!-- .topBarSocial -->

              <?php if (ot_get_option('topbarsearch') == 'yes') {  ?>

                <div class="topBarSearch">
                  <?php get_search_form(); ?>
                </div>

              <?php } ?>

            </div>

          </div>

        </div>
  
      <?php }  ?>
     
         <header>
        
        <div class="container clearfix">
            
            <div class="sixteen columns">
                
                                 
                <div class="logo">
                
                   <a href="<?php echo home_url(); ?>"><img src="<?php echo ot_get_option('logo') ?>" />
                       
                        <?php if (ot_get_option('tagline')) {  ?>
                       
                       <span><?php echo ot_get_option('tagline') ?></span></a>
                    
                        <?php } else { ?>
                    
                    </a>
                    
                        <?php } ?>

            </div>
            
             <nav class="mainNav">

                    <?php
                    wp_nav_menu(array(
                        'container' => false,
                        'menu_class' => 'nav sf-menu sf-js-enabled sf-shadow',
                        'theme_location' => 'main_menu',
                        'echo' => true,
                        'before' => '',
                        'after' => '',
                        'link_before' => '',
                        'fallback_cb' => 'display_home2',
                        'link_after' => '',
                        'depth' => 0,
                        'walker' => new description_walker())
                    );
                    ?>
                 
                 <div class="container mobileNav">
                
                <div class="sixteen columns"></div>
                
            </div>

                </nav>
                
            </div>
            
        </div>
        
    </header>
        