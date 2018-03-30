    <?php if (mom_option('topbar') == 1) { ?>
 <div class="topbar">
  <div class="inner">
        <?php if (mom_option('top_date') == true){ ?>
	       <?php $mom_date_format = mom_option('mom_data_format'); ?>
	      <div class="today_date">
		  <span class="topb_date"><?php  echo date_i18n( $mom_date_format , strtotime("11/15-1976") ); ?></span>
	      </div>
	<?php } ?>
        <div class="top-left-content">
            <?php if(mom_option('tn_left_content') == 'custom') {
                echo do_shortcode(mom_option('tn_custom_text'));
             } elseif (mom_option('tn_left_content') == 'social') { ?>
		<?php get_template_part('elements/social', 'icons'); ?>
		<?php } elseif (mom_option('tn_left_content') == 'search') { ?>
                        <div class="search-form">
                            <form method="get" action="<?php echo home_url(); ?>">
                                <input type="text" name="s" placeholder="<?php _e('Search ...', 'theme'); ?>">
                                <button class="button"><i class="fa-icon-search"></i></button>
                            </form>
                        </div>
		<?php } else { ?>
     <?php if ( has_nav_menu( 'topnav' ) ) { ?>
			     <?php  wp_nav_menu ( array( 'menu_class' => 'top-nav mom_visibility_desktop','container'=> 'ul', 'theme_location' => 'topnav' )); ?>
			     <div class="mom_visibility_device device-top-menu-wrap">
			      <div class="top-menu-holder"><i class="fa-icon-reorder mh-icon"></i></div>
			      <?php  wp_nav_menu ( array( 'menu_class' => 'device-top-nav','container'=> 'ul', 'theme_location' => 'topnav', 'walker' => new mom_topmenu_custom_walker() )); ?>
			     </div>

    <?php } ?>
             <?php }?>
       </div> <!--tb left-->
        <div class="top-right-content">
            <?php if(mom_option('tn_right_content') == 'search') { ?>
                        <div class="search-form">
                            <form method="get" action="<?php echo home_url(); ?>">
                                <input type="text" name="s" placeholder="<?php _e('Search ...', 'theme'); ?>">
                                <button class="button"><i class="fa-icon-search"></i></button>
                            </form>
                        </div>
<?php } elseif(mom_option('tn_right_content') == 'custom') {
                echo do_shortcode(mom_option('tn_right_custom_text'));
    } elseif (mom_option('tn_right_content') == 'menu') { ?> 
     <?php if ( has_nav_menu( 'topnav' ) ) { ?>
			     <?php  wp_nav_menu ( array( 'menu_class' => 'top-nav mom_visibility_desktop','container'=> 'ul', 'theme_location' => 'topnav' )); ?>
			     <div class="mom_visibility_device device-top-menu-wrap">
			      <div class="top-menu-holder"><i class="fa-icon-reorder mh-icon"></i></div>
			      <?php  wp_nav_menu ( array( 'menu_class' => 'device-top-nav','container'=> 'ul', 'theme_location' => 'topnav', 'walker' => new mom_topmenu_custom_walker() )); ?>
			     </div>

    <?php } ?>
                
	<?php } else { ?>
		<?php get_template_part('elements/social', 'icons'); ?>

            <?php } ?>
        </div> <!--tb right-->
</div>
 </div> <!--topbar-->
 <?php } ?>