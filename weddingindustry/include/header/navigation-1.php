<!--start header-->
<div class="nicdark_bg_white nicdark_section nicdark_border_grey nicdark_sizing nicdark_relative nicdark_navigation_type_1">
    
    <!--start container-->
    <div class="nicdark_container nicdark_clearfix">

        <div class="grid grid_12 percentage">
                
            <div class="nicdark_space<?php echo $redux_demo['header_type_1_topspace']; ?>"></div>

            <!--logo-->
            <div class="nicdark_logo nicdark_marginleft10">
                <a href="<?php echo home_url(); ?>"><img alt="" src="<?php echo esc_url( $redux_demo['logo']['url'] ); ?>"></a>                                   
            </div>
            <!--end logo-->

            <!--logo responsive-->
            <div class="nicdark_logo_responsive nicdark_marginleft10">
                <a href="<?php echo home_url(); ?>"><img alt="" src="<?php echo esc_url( $redux_demo['logo_responsive']['url'] ); ?>"></a>                                   
            </div>
            <!--logo responsive-->

            <!--start btn left/right sidebar open-->
            <?php if ($redux_demo['header_right_sidebar'] == 1) { ?> <a class="nicdark_displaynone_responsive nicdark_btn_icon nicdark_zoom nicdark_bg_<?php echo $redux_demo['header_background_btn_right_sidebar']; ?>_hover nicdark_right_sidebar_btn_open nicdark_marginright10 nicdark_bg_<?php echo $redux_demo['header_background_btn_right_sidebar']; ?> extrasmall  white right"><i class="<?php echo $redux_demo['header_icon_btn_right_sidebar']; ?>"></i></a> <?php } else {}; ?>
            <?php if ($redux_demo['header_left_sidebar'] == 1) { ?> <a class="nicdark_displaynone_responsive nicdark_btn_icon nicdark_zoom nicdark_bg_<?php echo $redux_demo['header_background_btn_left_sidebar']; ?>_hover nicdark_left_sidebar_btn_open nicdark_marginright20 nicdark_marginleft10 nicdark_bg_<?php echo $redux_demo['header_background_btn_left_sidebar']; ?> extrasmall  white right"><i class="<?php echo $redux_demo['header_icon_btn_left_sidebar']; ?>"></i></a> <?php } else {}; ?>
            
            <a href="#nicdark_window_popup_menu_responsive" class="nicdark_outline nicdark_mpopup_window nicdark_navigation_sticky_responsive nicdark_btn_icon nicdark_zoom nicdark_bg_<?php echo $redux_demo['btn_menu_responsive_color']; ?> extrasmall right white">
                <i class="icon-menu"></i>
            </a>

            <!--end btn left/right sidebar open-->

            <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>    
        
            <div class="nicdark_space<?php echo $redux_demo['header_type_1_bottomspace']; ?>"></div>

        </div>

    </div>
    <!--end container-->

</div>
<!--end header-->




<!--start menu responsive-->
<div class="nicdark_bg_white nicdark_section nicdark_border_grey nicdark_sizing nicdark_navigation_sticky">
    
    <!--start container-->
    <div class="nicdark_container nicdark_clearfix">

        <div class="grid grid_12 percentage">
                
            <div class="nicdark_space20"></div>

            <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>  


            <!--start menu responsive sticky-->
            <a href="#nicdark_window_popup_menu_responsive" class="nicdark_outline nicdark_mpopup_window nicdark_navigation_sticky_responsive nicdark_btn_icon nicdark_zoom nicdark_bg_<?php echo $redux_demo['btn_menu_responsive_color']; ?> small white">
                <i class="icon-menu"></i>
            </a>
            <!--end menu responsive sticky-->

        
            <div class="nicdark_space20"></div>

        </div>

    </div>
    <!--end container-->

</div>
<!--end menu responsive-->


