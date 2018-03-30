<div class="nicdark_displaynone_responsive nicdark_section nicdark_bg_white nicdark_border_top_grey">
    <div class="nicdark_container nicdark_clearfix">

        <div class="grid grid_12 percentage">
                
                <div class="nicdark_space10"></div>

                
                <div class="grid_4">
                    
                    <!--logo-->
                    <div class="nicdark_logo nicdark_marginleft10">
                        <a href="<?php echo home_url(); ?>"><img alt="" src="<?php echo esc_url( $redux_demo['logo']['url'] ); ?>"></a>                                   
                    </div>
                    <!--end logo-->
                    
                </div>


                <div class="grid_2 nicdark_sizing nicdark_border_right_grey">

                    <?php if ( $redux_demo['middleheader_focus_1_title'] != '' ) { ?> 
                        <p><i class="<?php echo $redux_demo['middleheader_focus_1_icon']; ?>"></i> <?php echo $redux_demo['middleheader_focus_1_title']; ?></p>
                        <div class="nicdark_space5"></div>
                        <p class="greydark"><?php echo $redux_demo['middleheader_focus_1_subtitle']; ?></p>
                    <?php } ?>

                </div>

                <div class="grid_2 nicdark_sizing nicdark_border_right_grey">

                    <?php if ( $redux_demo['middleheader_focus_2_title'] != '' ) { ?> 
                        <p><i class="<?php echo $redux_demo['middleheader_focus_2_icon']; ?>"></i> <?php echo $redux_demo['middleheader_focus_2_title']; ?></p>
                        <div class="nicdark_space5"></div>
                        <p class="greydark"><?php echo $redux_demo['middleheader_focus_2_subtitle']; ?></p>
                    <?php } ?>
                
                </div>

                <div class="grid_2">

                    <?php if ( $redux_demo['middleheader_focus_3_title'] != '' ) { ?> 
                        <p><i class="<?php echo $redux_demo['middleheader_focus_3_icon']; ?>"></i> <?php echo $redux_demo['middleheader_focus_3_title']; ?></p>
                        <div class="nicdark_space5"></div>
                        <p class="greydark"><?php echo $redux_demo['middleheader_focus_3_subtitle']; ?></p>
                    <?php } ?>
                
                </div>

                <div class="grid_2">
                    <div class="nicdark_space5"></div>
                    
                    <?php if ( $redux_demo['middleheader_button'] == 1 ) { ?> 
                        <a href="<?php echo $redux_demo['middleheader_button_link']; ?>" class="nicdark_btn nicdark_bg_<?php echo $redux_demo['middleheader_button_color']; ?> nicdark_bg_<?php echo $redux_demo['middleheader_button_color']; ?>dark_hover nicdark_transition  right medium white"><?php echo $redux_demo['middleheader_button_text']; ?></a>
                    <?php } ?>

                    <div class="nicdark_space5"></div>
                </div>
                
                <div class="nicdark_space10"></div>

        </div>

    </div>
    <!--end container-->

</div>





