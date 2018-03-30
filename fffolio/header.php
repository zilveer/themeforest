<?php global $fffolio; ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html style="margin-top: 0 !important" class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html style="margin-top: 0 !important" class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html style="margin-top: 0 !important" class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <!--<![endif]-->
<html style="margin-top: 0 !important" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('-');?></title>
    <!-- Mobile Specific Metas
      ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    
    <script type="text/javascript">
    var templateDir = "<?php echo get_template_directory_uri(); ?>";
    </script>


    <?php global $fffolio;  
    if(isset($fffolio['integration_header'])) echo $fffolio['integration_header'] . PHP_EOL;
    wp_head(); ?>
</head>
<body <?php body_class();?>>

<!-- Primary Page Layout
    ================================================== -->

    <div id="topbar"></div>

    <div id="intro">
        <nav>
            <?php show_top_menu();  ?>
        </nav>
    
        <div class="title">
            <?php if(isset($fffolio['topslogan_text']) && $fffolio['topslogan_text'] != '') { ?>
                <span class="title_line"></span>
                <span class="cursive"><?php echo esc_attr($fffolio['topslogan_text']);?></span>
                <span class="title_line"></span>
            <?php } ?>
            <h1>
                <?php if(isset($fffolio['topprimary_text']) && $fffolio['topprimary_text'] != '') { ?>
                    <span class="small"><?php echo esc_attr($fffolio['topprimary_text']);?></span><br />
                <?php } ?>

                <?php if(isset($fffolio['top_secondarytext']) && $fffolio['top_secondarytext'] != '') { 
                    echo esc_attr($fffolio['top_secondarytext']) . '<br />';
                } ?>
                
                <?php if(isset($fffolio['top_thirdtext']) && $fffolio['top_thirdtext'] != '') { ?>
                    <span class="small"><?php echo esc_attr($fffolio['top_thirdtext']);?></span>
                <?php } ?>

            </h1>
            
        </div> <!-- end title -->   
    </div> <!-- end intro -->
    
    
    <div class="jagged_bottom"></div>   
    <div id="cover_bar" class="cover_bar"></div>
    <div class="nav_bg" id="firstpage-menu"></div> <!-- nav bar anchor -->