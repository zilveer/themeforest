
<!-- Footer -->
<?php if( get_option('sense_show_footer') && get_option('sense_show_footer') == 'show' ) { ?>

			<footer id="footer">
				
				<!-- Upper Footer -->
				<?php if( get_option('sense_settings_fsidebar1') && get_option('sense_settings_fsidebar1') == 'show' ) { ?>

				<!-- Main Footer -->
				<div id="main-footer" style="background-color:<?php echo esc_attr(get_option('sense_footer_color1')); ?>">
					
					<div class="row" id="container-main-footer" >
					<?php 
					if( get_option('sense_fsidebar1_columns') ) { 

							$number_of_columns = 	(int)get_option('sense_fsidebar1_columns');
							$columns_array = 		array(
							array("col-lg-12 col-md-12 col-sm-12 animate-onscroll "), 
							array("col-lg-7 col-md-7 col-sm-7 animate-onscroll ", "col-lg-5 col-md-5 col-sm-5 animate-onscroll "), 
							array("col-lg-4 col-md-4 col-sm-6 animate-onscroll ", "col-lg-4 col-md-4 col-sm-6 animate-onscroll ", "col-lg-4 col-md-4 col-sm-6 animate-onscroll "), 
							array("col-lg-3 col-md-3 col-sm-6 animate-onscroll ", "col-lg-3 col-md-3 col-sm-6 animate-onscroll ", "col-lg-3 col-md-3 col-sm-6 animate-onscroll ", "col-lg-3 col-md-3 col-sm-6 animate-onscroll "));
	
							for ($i = 1; $i <= $number_of_columns; $i++) {
								echo '<div class="item '. esc_attr($columns_array[$number_of_columns-1][$i-1]) .'">';
									if ( !dynamic_sidebar('Footer row 1 - widget '.$i.'') ) : endif; 
								echo '</div>';
							}
		
					} ?>
					</div>
					
				</div>
				<?php } ?>
				<!-- /Main Footer -->

				
				
				<!-- Lower Footer -->
				<div id="lower-footer" style="background-color:<?php echo esc_attr(get_option('sense_footer_color1')); ?>" >
					
					<div class="row">
						
						<div class="col-lg-4 col-md-4 col-sm-4 animate-onscroll">
						
							<p class="copyright"><?php echo get_option('sense_footer_text'); ?></p>
							
						</div>
						
						<div class="col-lg-8 col-md-8 col-sm-8 animate-onscroll">
							<div class="social-media">
								<ul class="social-icons">
								
									<?php if(get_option('sense_footer_url1') != '' && get_option('sense_footer_url1') != '#' ) { ?>
									<li class="facebook"><a target="_blank" href="<?php echo esc_url(get_option('sense_footer_url1')); ?>" class="tooltip-ontop" title="Facebook"><i class="icons icon-facebook"></i></a></li>
									<?php } ?>	
								
									<?php if(get_option('sense_footer_url2') != '' && get_option('sense_footer_url2') != '#' ) { ?>
									<li class="twitter"><a target="_blank" href="<?php echo esc_url(get_option('sense_footer_url2')); ?>" class="tooltip-ontop" title="Twitter"><i class="icons icon-twitter"></i></a></li>
									<?php } ?>
									
									<?php if(get_option('sense_footer_url3') != '' && get_option('sense_footer_url3') != '#' ) { ?>
									<li class="google"><a target="_blank" href="<?php echo esc_url(get_option('sense_footer_url3')); ?>" class="tooltip-ontop" title="Google Plus"><i class="icons icon-gplus"></i></a></li>
									<?php } ?>
									
									<?php if(get_option('sense_footer_url4') != '' && get_option('sense_footer_url4') != '#' ) { ?>
									<li class="youtube"><a target="_blank" href="<?php echo esc_url(get_option('sense_footer_url4')); ?>" class="tooltip-ontop" title="Youtube"><i class="icons icon-youtube-1"></i></a></li>
									<?php } ?>
									
									<?php if(get_option('sense_footer_url5') != '' && get_option('sense_footer_url5') != '#' ) { ?>
									<li class="flickr"><a target="_blank" href="<?php echo esc_url(get_option('sense_footer_url5')); ?>" class="tooltip-ontop" title="Flickr"><i class="icons icon-flickr-4"></i></a></li>
									<?php } ?>
									
									<?php if(get_option('sense_footer_url6') != '' && get_option('sense_footer_url6') != '#' ) { ?>
									<li class="email"><a target="_self"  href="mailto:<?php echo sanitize_email(get_option('sense_footer_url6')); ?>" class="tooltip-ontop" title="Email"><i class="icons icon-mail"></i></a></li>
									<?php } ?>
									
									<?php if(get_option('sense_footer_url7') != '' && get_option('sense_footer_url7') != '#' ) { ?>
									<li class="linkedin"><a target="_blank" href="<?php echo esc_url(get_option('sense_footer_url7')); ?>" class="tooltip-ontop" title="LinkedIn"><i class="icons icon-linkedin"></i></a></li>
									<?php } ?>
									
									<?php if(get_option('sense_footer_url8') != '' && get_option('sense_footer_url8') != '#' ) { ?>
									<li class="instagram"><a target="_blank" href="<?php echo esc_url(get_option('sense_footer_url8')); ?>" class="tooltip-ontop" title="Instagram"><i class="icons icon-instagram"></i></a></li>
									<?php } ?>
									
									<?php if(get_option('sense_footer_url9') != '' && get_option('sense_footer_url9') != '#' ) { ?>
									<li class="reddit"><a target="_blank" href="<?php echo esc_url(get_option('sense_footer_url9')); ?>" class="tooltip-ontop" title="Reddit"><i class="icons icon-reddit"></i></a></li>
									<?php } ?>
									
								</ul>
								
							
							</div>

						</div>
						
					</div>
					
				</div>
				<!-- /Lower Footer -->
				
			</footer>
	<?php } ?>
	<!-- Footer -->
	


	<?php if( get_option('sense_show_button_to_top') && get_option('sense_show_button_to_top') != 'hide' ) { ?>
    <!-- Back To Top -->
	<a href="#" id="button-to-top"><i class="icons icon-up-dir"></i></a>
    <?php } ?>    

		
		
	<?php if( get_option('sense_settings_show') && get_option('sense_settings_show') == 'show' ) { ?>	
	<!-- Customize Box -->
	<div class="customize-box">
		
		<h5>Layout Settings</h5>
		
		<form id="customize-box">
			
			<label>Layout type:</label><br>
			<input type="radio" value="boxed" name="layout-type" id="boxed-layout-radio"><label for="boxed-layout-radio">Boxed</label>
			<input type="radio" value="wide" name="layout-type" checked="checked" id="wide-layout-radio"><label for="wide-layout-radio">Wide</label>
			
			<br>
			
			<label>Background:</label>
			<select id="background-option" class="chosen-select">
				<option value=".background-color">Color</option>
				<option selected value=".background-image">Background</option>
			</select>
			
			<div class="background-color">
				<div id="colorpicker"></div>
				<input type="hidden" id="colorpicker-value" value="#000">
			</div>
			
			<div class="background-image">
				<input type="radio" value="<?php echo get_template_directory_uri(); ?>/img/background/1.jpg" name="background-image-radio" id="background-img-radio-1" checked>
				<label for="background-img-radio-1"><img src="<?php echo get_template_directory_uri(); ?>/img/background/1-thumb.jpg" alt=""></label>
				
				<input type="radio" value="<?php echo get_template_directory_uri(); ?>/img/background/2.jpg" name="background-image-radio" id="background-img-radio-2">
				<label for="background-img-radio-2"><img src="<?php echo get_template_directory_uri(); ?>/img/background/2-thumb.jpg" alt=""></label>
				
				<input type="radio" value="<?php echo get_template_directory_uri(); ?>/img/background/3.jpg" name="background-image-radio" id="background-img-radio-3">
				<label for="background-img-radio-3"><img src="<?php echo get_template_directory_uri(); ?>/img/background/3-thumb.jpg" alt=""></label>
			</div>
			
			<input type="submit" value="Submit">
			<input type="reset" value="Reset">
			
		</form>
		
		<div class="customize-box-button">
			<i class="icons icon-cog-3"></i>
		</div>
		
	</div>
	<!-- /Customize Box -->
	<?php } ?>
	
	
	
	</div>
	<!-- /Container -->

		
	<?php echo str_replace("\\", "", stripslashes_deep(get_option('sense_google_analytics'))); ?> 
	<?php wp_footer(); ?> 
	
	
	
	
	
</body>
</html>
