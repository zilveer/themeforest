<?php

	//footer logo
	$footerLogo = get_option(THEME_NAME."_footer_logo");	
	$footerText = get_option(THEME_NAME."_footer_text");	
	
	//social icons
	$social_footer = get_option(THEME_NAME."_social_footer");
	$digg = get_option(THEME_NAME."_digg");
	$twitter = get_option(THEME_NAME."_twitter");
	$facebook = get_option(THEME_NAME."_facebook");
	$flickr = get_option(THEME_NAME."_flickr");
	$dribbble = get_option(THEME_NAME."_dribbble");
	$googleplus = get_option(THEME_NAME."_googleplus");

	///page layout
	$layout = get_option(THEME_NAME."_layout");

		
	///contact info
	$contacInfo = get_option(THEME_NAME."_contac_info");
	$contacTitle = get_option(THEME_NAME."_contac_title");
	$contactPhone = get_option(THEME_NAME."_contac_phone");
	$contactMail = get_option(THEME_NAME."_contac_mail");
	$contactAddress = get_option(THEME_NAME."_contac_address");

	
	// pop up banner
	$banner_type = get_option ( THEME_NAME."_banner_type" );
	
	$banner_fly_in = get_option ( THEME_NAME."_banner_fly_in" );
	$banner_fly_out = get_option ( THEME_NAME."_banner_fly_out" );
	$banner_start = get_option ( THEME_NAME."_banner_start" );
	$banner_close = get_option ( THEME_NAME."_banner_close" );
	$banner_overlay = get_option ( THEME_NAME."_banner_overlay" );
	$banner_views = get_option ( THEME_NAME."_banner_views" );
	$banner_timeout = get_option ( THEME_NAME."_banner_timeout" );
	
	$banner_text_image_img = get_option ( THEME_NAME."_banner_text_image_img" ) ;
	$banner_image = get_option ( THEME_NAME."_banner_image" );
	$banner_text = stripslashes ( get_option ( THEME_NAME."_banner_text" ) );
	
	if ( $banner_type == "image" ) {
	//Image Banner
		$cookie_name = substr ( md5 ( $banner_image ), 1,6 );
	} else if ( $banner_type == "text" ) { 
	//Text Banner
		$cookie_name = substr ( md5 ( $banner_text ), 1,6 );
	} else if ( $banner_type == "text_image" ) { 
	//Image And Text Banner
		$cookie_name = substr ( md5 ( $banner_text_image_img ), 1,6 );
	} else {
		$cookie_name = "popup";
	}

	if ( !$banner_start) {
		$banner_start = 0;
	}
	
	if ( !$banner_close) {
		$banner_close = 0;
	}
	
	if ( $banner_overlay == "on") {
		$banner_overlay = "true";
	} else {
		$banner_overlay = "false";
	}
	
	
	
	// latest posts
	$args=array(
		'posts_per_page'=> 2
	);
	$the_query = new WP_Query($args);

	?>
<!-- Footer -->
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="four columns">
				<?php if($footerLogo) { ?>
					<p><img src="<?php echo $footerLogo;?>" alt="<?php bloginfo('name');?>"></p>
				<?php } ?>
				<?php if($footerText) { ?>
					<p><?php echo $footerText;?></p>
				<?php } ?>
            </div>
            <div class="four columns">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer') ) : ?>
				<?php endif; ?>
            </div>
			<?php			
				if ( function_exists( 'register_nav_menus' )) {
					$args = array(
						'container' => '',
						'theme_location' => 'df-menu-3',
						'items_wrap' => '<ul class="tags">%3$s</ul>',
						'depth' => 1,
						"echo" => false
					);
										
					if(has_nav_menu('df-menu-3')) {
									
			?>
            <!-- Tags -->
            <div class="four columns">
            	<h5><?php echo DF_et_theme_menu_name("df-menu-3");?></h5>
					<?php echo add_menu_arrows(wp_nav_menu($args));?>
            </div>
			<?php			
					} 
				}
			?>
			<?php if($contacInfo=="on") { ?>
				<div class="four columns get-in-touch">
					<?php if($contacTitle) { ?><h5><?php echo $contacTitle ?></h5><?php } ?>
					<ul class="awesome-icons">
						<?php if($contactPhone) { ?><li><i class="icon-phone"></i><?php echo stripslashes($contactPhone);?></li><?php } ?>
						<?php if($contactMail) { ?><li><i class="icon-envelope"></i><?php _e("Email:",THEME_NAME);?> <a href="mailto:<?php echo $contactMail;?>"><?php echo $contactMail;?></a></li><?php } ?>
						<?php if($contactAddress) { ?><li><i class="icon-globe"></i><?php echo stripslashes($contactAddress);?></li><?php } ?>
					</ul>                
				</div>
			<?php } ?>
        </div>
    </div>
</div>
<!-- End Footer -->

<!-- Copyright -->
<div id="copyright">
	<div class="container">
    	<div class="eight columns">Copyright &copy; <?php echo date("Y");?>. Pulchellus Theme by <a href="http://themeforest.net/user/CreativeKingdom?ref=CreativeKingdom" target="_blank">CreativeKingdom</a> & <a href="http://themeforest.net/user/different-themes?ref=different-themes" target="_blank">Different Themes</a>.</div>
		<?php if($social_footer=="on") { ?>
			<div class="eight columns">
				<ul class="footer-social-icons">
					<?php if($digg) { ?><li class="footer-digg"><a href="<?php echo $digg;?>" target="_blank"></a></li><?php } ?>
					<?php if($dribbble) { ?><li class="footer-dribbble"><a href="<?php echo $dribbble;?>" target="_blank"></a></li><?php } ?>
					<?php if($facebook) { ?><li class="footer-facebook"><a href="<?php echo $facebook;?>" target="_blank"></a></li><?php } ?>
					<?php if($flickr) { ?><li class="footer-flickr"><a href="<?php echo $flickr;?>" target="_blank"></a></li><?php } ?>
					<?php if($twitter) { ?><li class="footer-twitter"><a href="<?php echo $twitter;?>" target="_blank"></a></li><?php } ?>
					<?php if($googleplus) { ?><li class="footer-googleplus"><a href="<?php echo $googleplus;?>" target="_blank"></a></li><?php } ?>
				</ul>
			</div>
		<?php } ?>
	</div>
</div>
<!-- End Copyright -->

<!-- Closed layout -->
</div>
<?php
			//pop up banner
			if ( $banner_type != "off" ) {
		?>
		
		<script type="text/javascript">
		<!--
		
		jQuery(document).ready(function($){
			$('#popup_content').popup( {
				starttime 			 : <?php echo $banner_start; ?>,
				selfclose			 : <?php echo $banner_close; ?>,
				popup_div			 : 'popup',
				overlay_div	 		 : 'overlay',
				close_id			 : 'baner_close',
				overlay				 : <?php echo $banner_overlay; ?>,
				opacity_level		 : 0.7,
				overlay_cc			 : false,
				centered			 : true,
				top	 		   		 : 130,
				left	 			 : 130,
				setcookie 			 : true,
				cookie_name	 		 : '<?php echo $cookie_name;?>',
				cookie_timeout 	 	 : <?php echo $banner_timeout; ?>,
				cookie_views 		 : <?php echo $banner_views ; ?>,
				floating	 		 : true,
				floating_reaction	 : 700,
				floating_speed 		 : 12,
				<?php 
					if ( $banner_fly_in != "off") { 
						echo "fly_in : true,
						fly_from : '".$banner_fly_in."', "; 
					} else {
						echo "fly_in : false,";
					}
				?>
				<?php 
					if ( $banner_fly_out != "off") { 
						echo "fly_out : true,
						fly_to : '".$banner_fly_out."', "; 
					} else {
						echo "fly_out : false,";
					}
				?>
				popup_appear  		 : 'show',
				popup_appear_time 	 : 0,
				confirm_close	 	 : false,
				confirm_close_text 	 : 'Do you really want to close?'
			} );
		});
		-->
		</script>
		<?php } ?>
<?php wp_footer(); ?>
</body>
<!-- InstanceEnd -->
</html>
