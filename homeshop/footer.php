




</div>
<!-- /Content -->


<!-- Banner -->
<section class="banner">

<?php 
if(!is_archive() && !is_404() && get_meta_option('custom_sidebar_bottom')) {
$bottom_sidebar_id = get_meta_option('custom_sidebar_bottom');
mm_sidebar('blog',$bottom_sidebar_id);
}
 ?>

</section>
<!-- /Banner -->


<!-- Footer -->
<?php if( get_option('sense_show_footer') && get_option('sense_show_footer') == 'show' ) { ?>

			<footer id="footer" class="row">
				
				<!-- Upper Footer -->
				<?php if( get_option('sense_settings_fsidebar1') && get_option('sense_settings_fsidebar1') == 'show' ) { ?>

				<div class="col-lg-12 col-md-12 col-sm-12">
					
					<div id="upper-footer" style="background-color:<?php echo get_option('sense_footer_color1'); ?>">
					<?php if( get_option('sense_fsidebar1_columns') ) { 
							echo '<div class="row">';
						
							$number_of_columns = 	(int)get_option('sense_fsidebar1_columns');
							$columns_array = 		array(
							array("col-lg-12 col-md-12 col-sm-12 "), 
							array("col-lg-7 col-md-7 col-sm-12 ", "col-lg-5 col-md-5 col-sm-12 "), 
							array("col-lg-4 col-md-4 col-sm-6 ", "col-lg-4 col-md-4 col-sm-6 ", "col-lg-4 col-md-4 col-sm-6 "), 
							array("col-lg-3 col-md-3 col-sm-6 ", "col-lg-3 col-md-3 col-sm-6 ", "col-lg-3 col-md-3 col-sm-6 ", "col-lg-3 col-md-3 col-sm-6 "));
						
						
						
							for ($i = 1; $i <= $number_of_columns; $i++) {
								echo '<div class="'.$columns_array[$number_of_columns-1][$i-1].'">';
									if ( !dynamic_sidebar('Footer row 1 - widget '.$i.'') ) : endif; 
								echo '</div>';
							}
							
							echo '</div><!-- end row -->';
					
					} ?>
					</div>
					
				</div>
				<?php } ?>
				<!-- /Upper Footer -->
				
				
				
				<!-- Main Footer -->
				<?php if( get_option('sense_settings_fsidebar2') && get_option('sense_settings_fsidebar2') == 'show' ) { ?>
				<div class="col-lg-12 col-md-12 col-sm-12">
					
					<div id="main-footer" style="background-color:<?php echo get_option('sense_footer_color1'); ?>" >
					
						<?php if( get_option('sense_fsidebar2_columns') ) { 
							echo '<div class="row">';
						
							$number_of_columns2 = 	(int)get_option('sense_fsidebar2_columns');
							$columns_array2 = 		array(
							array("col-lg-12 col-md-12 col-sm-12 "), 
							array("col-lg-7 col-md-7 col-sm-12 ", "col-lg-5 col-md-5 col-sm-12 "), 
							array("col-lg-4 col-md-4 col-sm-12 ", "col-lg-4 col-md-4 col-sm-12 ", "col-lg-4 col-md-4 col-sm-12 "), 
							array("col-lg-3 col-md-3 col-sm-6 ", "col-lg-3 col-md-3 col-sm-6 ", "col-lg-3 col-md-3 col-sm-6 ", "col-lg-3 col-md-3 col-sm-6 "));
						
						
						
							for ($i = 1; $i <= $number_of_columns2; $i++) {
								echo '<div class="'.$columns_array2[$number_of_columns2-1][$i-1].'">';
									if ( !dynamic_sidebar('Footer row 2 - widget '.$i.'') ) : endif; 
								echo '</div>';
							}
							
							echo '</div><!-- end row -->';
					
						} ?>

					</div>
					
				</div>
				<?php } ?>
				<!-- /Main Footer -->
				
				
				
				<!-- Lower Footer -->
				<div class="col-lg-12 col-md-12 col-sm-12">
					
					<div id="lower-footer">
					
						<div class="row">
							
							<div class="col-lg-6 col-md-6 col-sm-6 copyright-text">
							<?php echo get_option('sense_footer_text'); ?>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 payment-image">
							<img class="payment_img pull-right" alt="payment" src="<?php echo get_option('sense_footer_payment'); ?>"/>
							
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				<!-- /Lower Footer -->
				
			</footer>
	<?php } ?>
			<!-- Footer -->
			
            
            <div id="back-to-top">
            	<i class="icon-up-dir"></i>
            </div>
            
		</div>
    	<!-- Container -->
		
		<?php echo str_replace("\\", "", stripslashes_deep(get_option('sense_google_analytics'))); ?> 
		<?php wp_footer(); ?> 
</body>
</html>
