<?php 
    
    if ( $redux_demo['metabox_pages_header_menu_transparent'] == 1 || $redux_demo['metabox_posts_header_menu_transparent'] == 1 || $redux_demo['metabox_products_header_menu_transparent'] == 1 || $redux_demo['archive_post_header_transparent_menu'] == 1|| $redux_demo['archive_products_header_transparent_menu'] == 1 ){ 
        $nicdark_navigation_type_3_transparent = "nicdark_menu_transparent"; 
    }else{ 
        $nicdark_navigation_type_3_transparent = ""; 
    }

?>

<!--start header-->
<div class="nicdark_bg_grey nicdark_section nicdark_border_grey nicdark_sizing nicdark_relative nicdark_navigation_type_3 <?php echo $nicdark_navigation_type_3_transparent; ?> ">
    
    <!--start container-->
    <div class="nicdark_container nicdark_clearfix">

        <div class="grid grid_12 percentage">
                
            <div class="nicdark_space<?php echo $redux_demo['header_type_1_topspace']; ?>"></div>

            <a href="#nicdark_window_popup_menu_responsive" class="nicdark_outline nicdark_mpopup_window nicdark_navigation_sticky_responsive nicdark_btn_icon nicdark_zoom nicdark_bg_<?php echo $redux_demo['btn_menu_responsive_color']; ?> extrasmall white">
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
<div class="nicdark_bg_grey nicdark_section nicdark_border_grey nicdark_sizing nicdark_navigation_sticky nicdark_navigation_sticky_3">
    
    <!--start container-->
    <div class="nicdark_container nicdark_clearfix">

        <div class="grid grid_12 percentage">
                
            <div class="nicdark_space20"></div>

            <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>  


            <!--start menu responsive sticky-->
            <a href="#nicdark_window_popup_menu_responsive" class="nicdark_outline nicdark_mpopup_window nicdark_navigation_sticky_responsive nicdark_btn_icon nicdark_zoom nicdark_bg_<?php echo $redux_demo['btn_menu_responsive_color']; ?> extrasmall white">
                <i class="icon-menu"></i>
            </a>
            <!--end menu responsive sticky-->

        
            <div class="nicdark_space20"></div>

        </div>

    </div>
    <!--end container-->

</div>
<!--end menu responsive-->


