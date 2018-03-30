<?php 

global $smof_data; 

if(function_exists('vntd_print_extra_content')) {
	vntd_print_extra_content();
}

$footer_color_class = 'white-bg';
$footer_color = 'white';
$footer_style = 'footer-centered';
$footer_widgets_class = 'footer-widgets-white';

if(array_key_exists('vntd_footer_color', $smof_data)) {
	$footer_color = $smof_data["vntd_footer_color"];
}
if(get_post_meta(vntd_get_id(),'footer_color',TRUE) && get_post_meta(vntd_get_id(),'footer_color',TRUE) != 'default') {
	$footer_color = get_post_meta(vntd_get_id(),'footer_color',TRUE);
}
if($footer_color == 'dark' || get_post_meta(vntd_get_id(),'footer_color',TRUE) == 'default' && $smof_data['vntd_footer_skin'] == 'dark') {
	$footer_color_class = 'dark-footer';
}
if(array_key_exists('vntd_footer_style', $smof_data)) {
if($smof_data["vntd_footer_style"] == 'classic') {
	$footer_style = 'footer-classic';
}
}


?>

	</div>

	<?php 
	
	if($smof_data['vntd_footer_widgets'] == 'enabled' && is_active_sidebar('footer1') || get_post_meta(vntd_get_id(),'footer_widgets',TRUE) == 'enabled' && is_active_sidebar('footer1')) { 
	
	if($smof_data["vntd_footer_widgets_skin"] == "dark" || $smof_data["vntd_footer_widgets_skin"] == "white") {
		$footer_widgets_class = 'footer-widgets-'.$smof_data["vntd_footer_widgets_skin"];
	} elseif($footer_color_class == 'dark-footer') {
		$footer_widgets_class = 'footer-widgets-dark';
	}
	
	?>
	<div id="footer-widgets" class="<?php echo $footer_widgets_class; ?>">
		<div class="container">
			<div class="inner">
				<?php 

				for($i=1;$i<=vntd_get_footer_cols();$i++) {
					if($i == $footer_cols) $last_class = ' vntd-span-last';				
					echo '<div class="'.vntd_get_footer_cols_class().'">';
					    if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer'.$i) );
					echo '</div>';
				}
				
				?>
			</div>
		</div>
		
	</div>
	<?php } ?>
	
	<!-- Footer -->
	<footer class="footer <?php echo $footer_color_class.' '.$footer_style; ?> t-center">
		<div class="container">
			<div class="inner">
			<?php
			
			if($footer_style != 'footer-classic') {
			
				if($smof_data['vntd_footer_img_url']) {
					$img_url = $smof_data['vntd_footer_img_url'];
					if($footer_color == 'dark' && $smof_data['vntd_footer_img_dark_url']) {
						$img_url = $smof_data['vntd_footer_img_dark_url'];
					}			
				}elseif($smof_data['vntd_logo_url']) {
					$img_url = $smof_data['vntd_logo_url'];
				}
	
				if($img_url) {
					echo '<img class="site_logo" src="'.$img_url.'" alt="'.get_bloginfo().'">';
				}
			
			}
			
			?>
			<!-- Text -->
			<p class="uppercase semibold">
				<?php echo $smof_data['vntd_copyright']; ?>
			</p>
			<?php
			if($footer_style == 'footer-classic' && function_exists('vntd_print_social_icons')) {
				vntd_print_social_icons();
			}	
			?>
			</div>
		</div>
	</footer>
	<!-- End Footer -->

	<!-- Back To Top Button -->

	<?php if($smof_data['vntd_stt']) echo '<section id="back-top"><a href="#home" class="scroll t-center white"><i class="fa fa-angle-double-up"></i></a></section>'; ?>	
	
	<!-- End Back To Top Button -->

<?php wp_footer(); ?>

</body>
</html>