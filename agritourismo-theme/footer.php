<?php
	$logoFooter = get_option(THEME_NAME."_logo_footer");
	$textFooter = get_option(THEME_NAME."_footer_text");

	//breaking slider
	$breakingSlider = get_option(THEME_NAME."_breacking_footer");

	//copyright
	$copyRight = get_option(THEME_NAME."_copyright");

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

	?>
			</div>
			<!-- BEGIN .footer -->
			<div class="footer">
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					
					<div class="paragraph-row">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('default_footer') ) : ?>
						<?php endif; ?>
						<div class="clear-float"></div>

					</div>
					
				<!-- END .wrapper -->
				</div>
				
			<!-- END .footer -->
			</div>

			<!-- BEGIN .footer-copyright -->
			<div class="footer-copyright">
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					
					<p class="right"><?php _e("Designed by", THEME_NAME);?> <a href="http://orange-themes.com" target="_blank"><b>Orange-Themes.com</b></a></p>
					<p><?php echo stripslashes($copyRight);?></p>
					
				<!-- END .wrapper -->
				</div>
				
			<!-- END .footer-copyright -->
			</div>

			<div class="lightbox">
				<div class="lightcontent-loading">
					<h2 class="light-title"><?php _e("Loading..", THEME_NAME);?></h2>
					<a href="#" onclick="javascript:lightboxclose();" class="light-close"><span>&#10062;</span><?php _e("Close Window", THEME_NAME);?></a>
					<div class="loading-box">
						<h3><?php _e("Loading, Please Wait!", THEME_NAME);?></h3>
						<span><?php _e("This may take a second or two.", THEME_NAME);?></span>
						<span class="loading-image"><img src="<?php echo THEME_IMAGE_URL;?>loading.gif" title="" alt="" /></span>
					</div>
				</div>
				<div class="lightcontent"></div>
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
	<!-- END body -->
	</body>
<!-- END html -->
</html>