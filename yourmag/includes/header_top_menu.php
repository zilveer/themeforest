
<div id="header_top_menu">
<div class="inner_10">

	<?php if ( function_exists( 'wp_nav_menu' ) ){
        wp_nav_menu( array('theme_location' => 'top-menu', 'container_id' => 'secondaryMenu', 'fallback_cb'=>'secondarymenu' )); 
        } else { secondarymenu();
	} ?>
	
	<?php if (get_option('op_header_login') == 'on') { ?>
	<?php add_modal_login_button( $login_text = 'Login', $logout_text = 'Logout', $logout_url = '', $show_admin = false )?>	
	<?php if ( is_user_logged_in() ) { ?><a class="user_profile" href="<?php echo get_edit_user_link(); ?>" title="Profile"></a> <?php } ?>
	<?php } ?>	
	
</div>
</div>



	
