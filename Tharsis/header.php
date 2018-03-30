<?php global $tharsis; ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html style="margin-top: 0 !important" class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html style="margin-top: 0 !important" class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html style="margin-top: 0 !important" class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <!--<![endif]-->
<html style="margin-top: 0 !important" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('-');?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <!-- Mobile Specific Metas
      ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--[if IE]>
        <link href="<?php echo get_stylesheet_directory_uri() . '/css/ie.css';?>" rel='stylesheet' type='text/css'>
    <![endif]-->
    <script type="text/javascript">
    var templateDir = "<?php echo get_template_directory_uri(); ?>";
    </script>

    <?php
    if(isset($tharsis['integration_header'])) echo $tharsis['integration_header'] . PHP_EOL;
    wp_head();?>
</head>
<body <?php body_class();?>>
<div class="top-bar"></div>

<!-- Primary Page Layout
    ================================================== -->
    
    <header>
    
        <div class="topbar" id="home">
            <div class="container">
                <div class="ten columns">
                    <p class="logo"><a href="<?php echo home_url();?>"><?php if(isset($tharsis['logo_text'])) echo $tharsis['logo_text'];?></a></p>
                </div>
                <div class="six columns">
                    <ul class="top-social">
                        <?php if(isset($tharsis['skype_url']) && $tharsis['skype_url'] != '') { ?><li><a href="<?php echo $tharsis['skype_url'];?>"><div class="icn-skype sprite"></div></a></li><?php } ?>
                        <?php if(isset($tharsis['facebook_url']) && $tharsis['facebook_url'] != '') { ?><li><a href="<?php echo $tharsis['facebook_url'];?>"><div class="icn-facebook sprite"></div></a></li><?php } ?>
                        <?php if(isset($tharsis['linkedin_url']) && $tharsis['linkedin_url'] != '') { ?><li><a href="<?php echo $tharsis['linkedin_url'];?>"><div class="icn-linkedin sprite"></div></a></li><?php } ?>
                        <?php if(isset($tharsis['gplus_url']) && $tharsis['gplus_url'] != '') { ?><li><a href="<?php echo $tharsis['gplus_url'];?>"><div class="icn-gplus sprite"></div></a></li><?php } ?>
                        <?php if(isset($tharsis['pinterest_url']) && $tharsis['pinterest_url'] != '') { ?><li><a href="<?php echo $tharsis['pinterest_url'];?>"><div class="icn-pinterest sprite"></div></a></li><?php } ?>
                        <?php if(isset($tharsis['dribble_url']) && $tharsis['dribble_url'] != '') { ?><li><a href="<?php echo $tharsis['dribble_url'];?>"><div class="icn-dribbble sprite"></div></a></li><?php } ?>
                        <?php if(isset($tharsis['twitter_username']) && $tharsis['twitter_username'] != '') { ?><li><a href="http://twitter.com/<?php echo $tharsis['twitter_username'];?>"><div class="icn-twitter sprite"></div></a></li><?php } ?>
                    </ul>
                </div>
            </div>
        </div> <!-- end topbar -->
    
        <div class="container">
            <div class="sixteen columns">
                <nav>
                    <div class="nine columns alpha">
                        <?php wp_nav_menu(array(
                                            'theme_location' => 'top-menu',
                                            'container' => '',
                                            'fallback_cb' => 'show_top_menu',
                                            'echo' => true,
                                            'walker' => new description_walker() ) ); 
                     ?>
                    </div> <!-- end nine columns -->
                    <div class="seven columns omega">
                        <ul class="contact-top">
                            <?php if(isset($tharsis['email']) && $tharsis['email'] != '') { ?>
                                <li><img src="<?php echo get_stylesheet_directory_uri();?>/images/icn-top-email.png" alt="" /> <?php echo encEmail($tharsis['email']);?></li>
                                <?php } ?>
                            <?php if(isset($tharsis['phone']) && $tharsis['phone'] != '') { ?>
                                <li><img src="<?php echo get_stylesheet_directory_uri();?>/images/icn-top-phone.png" alt="" /><?php echo $tharsis['phone'];?></li>
                            <?php } ?>
                        </ul>
                    </div> <!-- end seven columns -->
                </nav>
        
            </div> <!-- end sixteen columns -->
        </div> <!-- end container -->
        
    </header> <!-- end header -->
    
    
    <div id="intro">
        <div class="title">
            <?php if($tharsis['topheader_text']) { ?>
                <h1><?php echo $tharsis['topheader_text'];?></h1>
            <?php } ?>
            <?php if($tharsis['topheader_smalltext']) { ?>
                <h1 class="small"><?php echo $tharsis['topheader_smalltext'];?></h1>
            <?php } ?>
            <?php if($tharsis['topheader_smallertext']) { ?>
                <p><?php echo $tharsis['topheader_smallertext'];?></p>
            <?php } ?>
            <div class="intro-arrow">
                <img src="<?php echo get_stylesheet_directory_uri();?>/images/intro-arrow.png" alt="" />
            </div>
        </div> <!-- end title -->
    </div> <!-- end intro -->
    
    
    <div class="jagged"></div>
