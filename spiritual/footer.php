		<div class="clear"></div>
		</div> <!-- #swm_main_container -->
		<div class="clear"></div>

		<?php if ( get_theme_mod('swm_large_footer',1) == 1 || get_theme_mod('swm_small_footer',1) == 1 ) { ?>

		<footer class="footer" id="footer">	
			<div class="swm_footer_border"></div>		
			<div class="swm_footer_bg">
				
				<div class="swm_container">

					<?php 
					if ( get_theme_mod('swm_small_footer',1) == 1 ) { ?>
						
							<div class="small_footer <?php if ( get_theme_mod('swm_large_footer',1) != 1 ) { echo 'swm_hide_large_footer'; } ?> ">

								<div class="small_footer_content">		

									<div class="swm_container">
										<div class="footer_left">
											<p><?php 

											if ( class_exists( 'WPML_String_Translation' ) ) {
												echo icl_translate('Theme Mod', 'swm_footer_copyright', get_theme_mod( 'swm_footer_copyright' ));
											} else {
												echo do_shortcode( get_theme_mod('swm_footer_copyright','Add copyright text from WordPress Admin > Customizer > Footer > Small Footer') ); 
											}

											?></p>
										</div>

										<div class="footer_right">
											<?php swm_display_footer_menu(); ?>
										</div>
										<div class="clear"></div>
									</div>
								</div>
								<div class="clear"></div>

							</div>	<!-- .small_footer -->	
							<?php
						} 
					?>

					<?php 
					if ( get_theme_mod('swm_large_footer',1) == 1 ) {
						swm_display_footer_column();
					}					
					?>

				</div>			

				<div class="clear"></div>
			</div> <!-- .swm_footer_bg -->
		</footer>
		
		<?php } ?>

		<a id="go_top_scroll"><i class="fa fa-angle-up"></i></a></div>	
</div> <!-- .swm_main_container -->

<?php 

// custom javascript from customizer "Custom css/javascripts" option
$swm_custom_js = get_theme_mod('swm_custom_js');		
if ($swm_custom_js != '') {				
	echo '<script type="text/javascript">/* <![CDATA[ */';
	echo $swm_custom_js;
	echo '/* ]]> */</script>';
	
}

if ( is_single() && comments_open() ) { wp_enqueue_script( 'comment-reply' ); }
wp_footer(); 

?>

</body>
</html>