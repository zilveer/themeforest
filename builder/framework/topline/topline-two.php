<?php global $oi_options;?>
<div class="oi_top_line_holder topline_wide_<?php echo esc_attr($oi_options['oi_top_line_wide']) ?>">
    <div class="container oi_topline_container">
         <div class="oi_top_line">
            <div class="row vertical-align">
                <div class="col-md-6 col-sm-6">
                    <?php if ( has_nav_menu( 'topline_menu' ) ) { wp_nav_menu( array('theme_location' => 'topline_menu', 'menu_class' => 'oi_topline_menu'));}; ?>
                	<?php if($oi_options['top_line_mail']==1){ ?>
                    <span class="oi_mail"><a href="#" data-remodal-target="modal"><i class="fa fa-envelope-o"></i></a></span>
                    <?php }; ?>
                </div>
                <div class="remodal" data-remodal-id="modal">
                  <button data-remodal-action="close" class="remodal-close"></button>
                  <?php echo do_shortcode(wp_kses( __($oi_options['oi_topline-modal'], 'orangeidea' ), $allowed_html_array )); ?>
                </div>
                <div class="col-md-6 col-sm-6 oi_top_soc">
                    <div class="oi_soc_icons">
                        <?php if ($oi_options['topline_social_tw'] != "") {?><a href="<?php echo stripslashes($oi_options['topline_social_tw']) ?>" title="Twitter" target="_blank"><i class="fa fa-twitter fa-fw"></i></a><?php }; ?>
                        <?php if ($oi_options['topline_social_fb'] != "") {?><a href="<?php echo stripslashes($oi_options['topline_social_fb']) ?>" title="Facebook" target="_blank"><i class="fa fa-facebook fa-fw"></i></a><?php }; ?>
                        <?php if ($oi_options['topline_social_go'] != "") {?><a href="<?php echo stripslashes($oi_options['topline_social_go']) ?>" title="Google+" target="_blank"><i class="fa fa-google-plus fa-fw"></i></a><?php }; ?>
                        <?php if ($oi_options['topline_social_pi'] != "") {?><a href="<?php echo stripslashes($oi_options['topline_social_pi']) ?>" title="Pinterest" target="_blank"><i class="fa fa-pinterest-p fa-fw"></i></a><?php }; ?>
                        <?php if ($oi_options['topline_social_li'] != "") {?><a href="<?php echo stripslashes($oi_options['topline_social_li']) ?>" title="LinkedIn" target="_blank"><i class="fa fa-linkedin fa-fw"></i></a><?php }; ?>
                        <?php if ($oi_options['topline_social_dr'] != "") {?><a href="<?php echo stripslashes($oi_options['topline_social_dr']) ?>" title="Dribbble" target="_blank"><i class="fa fa-dribbble fa-fw"></i></a><?php }; ?>
                        <?php if ($oi_options['topline_social_yt'] != "") {?><a href="<?php echo stripslashes($oi_options['topline_social_yt']) ?>" title="YouTube" target="_blank"><i class="fa fa-youtube fa-fw"></i></a><?php }; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>