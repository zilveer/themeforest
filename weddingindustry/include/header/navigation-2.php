<!--start header-->
<div class="nicdark_bg_<?php echo $redux_demo['header_navigation_type_2_bg']; ?> nicdark_section nicdark_sizing nicdark_relative nicdark_navigation_type_2">
    
    <!--start container-->
    <div class="nicdark_container nicdark_clearfix">

        <div class="grid grid_12 percentage">
                
            <div class="nicdark_space<?php echo $redux_demo['header_type_1_topspace']; ?>"></div>

            <!--logo responsive-->
            <div class="nicdark_logo_responsive nicdark_marginleft10">
                <a href="<?php echo home_url(); ?>"><img alt="" src="<?php echo esc_url( $redux_demo['logo_responsive']['url'] ); ?>"></a>                                   
            </div>
            <!--logo responsive-->

            <a href="#nicdark_window_popup_menu_responsive" class="nicdark_outline nicdark_mpopup_window nicdark_navigation_sticky_responsive nicdark_btn_icon nicdark_zoom nicdark_bg_<?php echo $redux_demo['btn_menu_responsive_color']; ?> extrasmall right white">
                <i class="icon-menu"></i>
            </a>

            <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>    

            <?php if ( $redux_demo['header_navigation_type_2_buttons'] = 1 ) { 

                if ( $redux_demo['header_navigation_type_2_button_1_icon'] != '' ) { ?> 
                    <a target="_blank" href="<?php echo $redux_demo['header_navigation_type_2_button_1_link']; ?>" class="nicdark_btn_icon nicdark_displaynone_responsive nicdark_zoom nicdark_bg_<?php echo $redux_demo['header_navigation_type_2_bg']; ?>_hover  nicdark_margin010 nicdark_bg_<?php echo $redux_demo['header_navigation_type_2_bg']; ?>dark extrasmall  white right"><i class="<?php echo $redux_demo['header_navigation_type_2_button_1_icon']; ?>"></i></a>
                <?php }

                if ( $redux_demo['header_navigation_type_2_button_2_icon'] != '' ) { ?> 
                    <a target="_blank" href="<?php echo $redux_demo['header_navigation_type_2_button_2_link']; ?>" class="nicdark_btn_icon nicdark_displaynone_responsive nicdark_zoom nicdark_bg_<?php echo $redux_demo['header_navigation_type_2_bg']; ?>_hover  nicdark_margin010 nicdark_bg_<?php echo $redux_demo['header_navigation_type_2_bg']; ?>dark extrasmall  white right"><i class="<?php echo $redux_demo['header_navigation_type_2_button_2_icon']; ?>"></i></a>
                <?php }

                if ( $redux_demo['header_navigation_type_2_button_3_icon'] != '' ) { ?> 
                    <a target="_blank" href="<?php echo $redux_demo['header_navigation_type_2_button_3_link']; ?>" class="nicdark_btn_icon nicdark_displaynone_responsive nicdark_zoom nicdark_bg_<?php echo $redux_demo['header_navigation_type_2_bg']; ?>_hover  nicdark_margin010 nicdark_bg_<?php echo $redux_demo['header_navigation_type_2_bg']; ?>dark extrasmall  white right"><i class="<?php echo $redux_demo['header_navigation_type_2_button_3_icon']; ?>"></i></a>
                <?php }

            } ?>
        
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
            <a href="#nicdark_window_popup_menu_responsive" class="nicdark_outline nicdark_mpopup_window nicdark_navigation_sticky_responsive nicdark_btn_icon nicdark_zoom  nicdark_bg_<?php echo $redux_demo['btn_menu_responsive_color']; ?> small white">
                <i class="icon-menu"></i>
            </a>
            <!--end menu responsive sticky-->

        
            <div class="nicdark_space20"></div>

        </div>

    </div>
    <!--end container-->

</div>
<!--end menu responsive-->


