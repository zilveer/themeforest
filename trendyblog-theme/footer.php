<?php
	//Back to top
	$backToTop = df_get_option(THEME_NAME."_backToTop");

	//copyright
	$copyRight = df_get_option(THEME_NAME."_copyright");

	// pop up banner
	$banner_type = df_get_option ( THEME_NAME."_banner_type" );
	
	$banner_fly_in = df_get_option ( THEME_NAME."_banner_fly_in" );
	$banner_fly_out = df_get_option ( THEME_NAME."_banner_fly_out" );
	$banner_start = df_get_option ( THEME_NAME."_banner_start" );
	$banner_close = df_get_option ( THEME_NAME."_banner_close" );
	$banner_overlay = df_get_option ( THEME_NAME."_banner_overlay" );
	$banner_views = df_get_option ( THEME_NAME."_banner_views" );
	$banner_timeout = df_get_option ( THEME_NAME."_banner_timeout" );
	
	$banner_text_image_img = df_get_option ( THEME_NAME."_banner_text_image_img" ) ;
	$banner_image = df_get_option ( THEME_NAME."_banner_image" );
	$banner_text = stripslashes ( df_get_option ( THEME_NAME."_banner_text" ) );
	
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
		<?php if ( is_active_sidebar( 'df_footer_1' ) || is_active_sidebar( 'df_footer_2' ) || is_active_sidebar( 'df_footer_3' ) || is_active_sidebar( 'df_footer_4' ) ) { ?>
        <!-- Footer -->
        <footer id="footer">
            <div class="container">
                <div class="row">
					<?php if ( is_active_sidebar( 'df_footer_1' ) ) { ?>
						<div class="col col_3_of_12">
							<?php dynamic_sidebar( 'df_footer_1' ); ?>
						</div>
					<?php } ?>
					<?php if ( is_active_sidebar( 'df_footer_2' ) ) { ?>
						<div class="col col_3_of_12">
							<?php dynamic_sidebar( 'df_footer_2' ); ?>
						</div>
					<?php } ?>
					<?php if ( is_active_sidebar( 'df_footer_3' ) ) { ?>
						<div class="col col_3_of_12">
							<?php dynamic_sidebar( 'df_footer_3' ); ?>
						</div>
					<?php } ?>
					<?php if ( is_active_sidebar( 'df_footer_4' ) ) { ?>
						<div class="col col_3_of_12">
							<?php dynamic_sidebar( 'df_footer_4' ); ?>
						</div>
					<?php } ?>

                </div>
            </div>
        </footer>
        <?php } ?>
        <!-- End Footer -->
        <!-- Copyright -->
        <div id="copyright" role="contentinfo">
            <div class="container">
                <p><?php echo stripslashes($copyRight);?></p>
            </div>
        </div><!-- End Copyright -->
    </div><!-- End Wrapper -->
    <?php if($backToTop=="on") { ?>
		<!-- Back to top -->
		<p id="back_to_top"><a href="#top"><i class="fa fa-angle-up"></i></a></p>
	<?php } ?>
<?php
			//pop up banner
			if ($banner_type && $banner_type != "off" ) {
		?>
		

		<script type="text/javascript">
		<!--
		
		jQuery(document).ready(function($){
			$('#popup_content').popup( {
				starttime 			 : <?php echo esc_js($banner_start); ?>,
				selfclose			 : <?php echo esc_js($banner_close); ?>,
				popup_div			 : 'popup',
				overlay_div	 		 : 'overlay',
				close_id			 : 'baner_close',
				overlay				 : <?php echo esc_js($banner_overlay); ?>,
				opacity_level		 : 0.7,
				overlay_cc			 : false,
				centered			 : true,
				top	 		   		 : 130,
				left	 			 : 130,
				setcookie 			 : true,
				cookie_name	 		 : '<?php echo esc_js($cookie_name);?>',
				cookie_timeout 	 	 : <?php echo esc_js($banner_timeout); ?>,
				cookie_views 		 : <?php echo esc_js($banner_views); ?>,
				floating	 		 : true,
				floating_reaction	 : 700,
				floating_speed 		 : 12,
				<?php 
					if ( $banner_fly_in != "off") { 
						echo "fly_in : true,
						fly_from : '".esc_js($banner_fly_in)."', "; 
					} else {
						echo "fly_in : false,";
					}
				?>
				<?php 
					if ( $banner_fly_out != "off") { 
						echo "fly_out : true,
						fly_to : '".esc_js($banner_fly_out)."', "; 
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