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
                    <?php echo do_shortcode($oi_options['oi_topline-text'])?>
                </div>
            </div>
        </div>
    </div>
</div>