        <!-- BEGIN OF FOOTER -->
        <div id="bottom-container">
        	<div id="footer-content">
            
            	<!-- begin of footer-address --> 
            	<div id="footer-address">
                <?php 
                $info_address = get_option('vulcan_info_address');
                $info_phone = get_option('vulcan_info_phone');
                $info_fax = get_option('vulcan_info_fax');
                $info_email = get_option('vulcan_info_email');
                
                ?>
                <img src="<?php $footer_logo = get_option('vulcan_footer_logo'); if ($footer_logo) : echo $footer_logo;?> <?php else : ?> <?php echo get_template_directory_uri();?>/images/footer-logo.png<?php endif;?>"  alt="<?php bloginfo('blogname');?>" />
                <p><?php if ($info_address !="") { echo ($info_address); }?></p>
                <p>
                <?php if ($info_phone !="") { echo __('Phone ','vulcan') . $info_phone.','; }?> 
                <?php if ($info_fax !="") { echo __('Fax ','vulcan') . ($info_fax); }?><br/>
                <?php if ($info_email !="") { echo __('Email ','vulcan') . ($info_email); }?>
                </p>
                </div>
                <!-- end of footer-address -->
                
                <div id="footer-news">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom')) : ?>
                    <?php
                      $blog_cats_include = get_option('vulcan_blog_cats_include');
                      if(is_array($blog_cats_include)) {
                      $blog_include = implode(",",$blog_cats_include);
                      }
                      indonez_latestnews($blog_include,$number=4,"<h3>".__('Company News','vulcan')."</h3>",0);
                    ?>
                <?php endif;?>
                </div>                
                <!-- begin of footer-menu and copyright -->
                <div id="footer-last">
                	<div id="footer-menu">
                  <?php 
                    if (function_exists('wp_nav_menu')) { 
                      wp_nav_menu( array( 'menu_class' => 'navigation-footer', 'theme_location' => 'footernav','fallback_cb'=> 'vulcan_footermenu_pages','sort_column' => 'menu_order', ) );
                    } else {  
                      vulcan_footermenu_pages();
                    } ?>
                    </div>
                    <div id="footer-copyright">
                    <?php $footer_text  = get_option('vulcan_footer_text');?>
                    <?php echo ($footer_text) ? stripslashes($footer_text) : "Copyright &copy; 2010 Vulcan Company.  All rights reserved";?>
                    </div>
                </div>
                <!-- end of footer-menu and copyright -->
                            
            </div>
        </div>
        <!-- END OF FOOTER -->
    	
    </div>
    <?php 
      $ga_code = get_option('vulcan_ga_code');
      if ($ga_code) echo stripslashes($ga_code);
    ?>
    <?php wp_footer();?>
</body>
</html>