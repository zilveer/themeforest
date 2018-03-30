<?php global $qode_options_magnet; ?>
<?php
$qode_animation="";
if (isset($_SESSION['qode_animation'])) $qode_animation = $_SESSION['qode_animation'];
$qode_menu="";
if (isset($_SESSION['qode_menu'])) $qode_menu = $_SESSION['qode_menu'];
$qode_footer="";
if (isset($_SESSION['qode_footer'])) $qode_footer = $_SESSION['qode_footer'];
$hide_footer_logo_image = "";
if (isset($qode_options_magnet['hide_footer_logo_image'])) 
	$hide_footer_logo_image = $qode_options_magnet['hide_footer_logo_image'];
?>
				
		<div class="container">					
			<div class="container_inner clearfix">
				<footer>
					<?php	
						$display_footer_widget = false;
						if (!empty($qode_footer)) $display_footer_widget = true;
						elseif ($qode_options_magnet['footer_widget_area'] == "yes") $display_footer_widget = true;
						if($display_footer_widget): ?> 
						<div class="footer_top">
							<div class="four_columns clearfix">
								<div class="column1">
									<div class="column_inner">
											<?php dynamic_sidebar( 'footer_column_1' ); ?>
									</div>
								</div>
								<div class="column2">
									<div class="column_inner">
										<?php dynamic_sidebar( 'footer_column_2' ); ?>
									</div>
								</div>
								<div class="column3">
									<div class="column_inner">
										<?php dynamic_sidebar( 'footer_column_3' ); ?>
									</div>
								</div>
								<div class="column4">
									<div class="column_inner">
										<?php dynamic_sidebar( 'footer_column_4' ); ?>
									</div>
								</div>
							</div>
						</div>
						<?php endif; ?>
						<div class="footer_bottom">
							<div class="left">
								<?php if($hide_footer_logo_image != "yes"): ?>
									<?php
										if (!empty($_SESSION['qode_home'])) { 
											$home = $_SESSION['qode_home']; 
											
											$permalink = get_permalink($home);
											
										}else{
											$permalink = home_url();
										}
									?>
									<div class="footer_logo"><a href="<?php echo $permalink; ?>"><img alt="Logo" src="<?php echo $qode_options_magnet['footer_logo_image']; ?>" /></a></div>
								<?php endif; ?>
								<?php dynamic_sidebar( 'footer_left' ); ?>
							</div>
							<div class="right">
								<?php dynamic_sidebar( 'footer_right' ); ?>
							</div>
						</div>
				</footer>
			</div>
		</div>
	</div>
</div>

</div>
</div>
</div>
</div>

<?php
if($qode_options_magnet['show_toolbar'] == "yes"){
?>
<div id="panel" style="margin-left: -318px;">
        
    <div id="panel-admin">
        <h5>Theme options</h5>
        <select id="tootlbar_ajax">
					<option value="">Choose page transition</option>
          <option <?php if ($qode_animation == "no") { echo "selected='selected'"; } ?> value="no">No ajax, regular loading</option>
          <option <?php if ($qode_animation == "updown") { echo "selected='selected'"; } ?> value="updown">Page up/down</option>
					<option <?php if ($qode_animation == "fade") { echo "selected='selected'"; } ?> value="fade">Page fade in/fade out</option>
					<option <?php if ($qode_animation == "updown_fade") { echo "selected='selected'"; } ?> value="updown_fade">Page up/down (in) / fade (out)</option>
					<option <?php if ($qode_animation == "curtain") { echo "selected='selected'"; } ?> value="curtain">Curtain Down (In) / Curtain Up (Out)</option>
        </select>
        
				<select id="tootlbar_pattern">
					<option value="">Choose pattern type</option>
          <option value="pattern1">Transparent 1</option>
          <option value="pattern2">Transparent 2</option>
					<option value="pattern3">Cubes</option>
					<option value="pattern4">Diamond</option>
					<option value="pattern5">Escheresque</option>
          <option value="pattern6">Gradient Squares</option>
					<option value="pattern7">Graphy</option>
					<option value="pattern8">Struckaxiom</option>
					<option value="pattern9">Wavecut</option>
					<option value="pattern10">Whitediamond</option>
					<option value="pattern11">Retina Wood</option>
					<option value="pattern12">Retina Wood Grey</option>
        </select>
        <select id="tootlbar_layout">
					<option value="">Choose layout type</option>
          <option value="wide">Wide</option>
					<option value="boxed">Boxed</option>
					<option value="boxed background_boxed">Background image</option>
        </select>
				<h5>Rounded corners (<span class="round_value">8</span>px)</h5>
				<div>
					<div id="slider_corners"></div>
					<div class="clearfix">
						<p style="float: left;">Sharp</p>
						<p style="float: right;">Round</p>
					</div>
				</div>				
				<h5>Colors</h5>
				<div class="width50">
					<div class="topGradient_ColorSelector colorSelector"><div style=""></div></div>
					<div class="topGradientColorSelector colorPanel"></div>
					<label>Top Gradient</label>
				</div>
				<div class="width50">
					<div class="bottomGradient_colorSelector colorSelector"><div style=""></div></div>
					<div class="bottomGradientColorSelector colorPanel"></div>
					<label>Bottom Gradient</label>
				</div>
				<div class="width50">
					<div class="background_colorSelector colorSelector"><div style=""></div></div>
					<div class="backgroundColorSelector colorPanel"></div>
					<label>Background</label>
				</div>
				<div class="width50">
					<div class="backgroundBoxed_colorSelector colorSelector"><div style=""></div></div>
					<div class="backgroundBoxedColorSelector colorPanel"></div>
					<label>Boxed Background</label>
				</div>
				<div class="width50">
					<div class="first_ColorSelector colorSelector"><div style=""></div></div>
					<div class="firstColorSelector colorPanel"></div>
					<label>First</label>
				</div>
				<div class="width50">
					<div class="second_colorSelector colorSelector"><div style=""></div></div>
					<div class="secondColorSelector colorPanel"></div>
					<label>Second</label>
				</div>
				<span class="small">* Change size, color and style on ANY section, element and font with an easy-to-use backend!</span>
    </div>
    
    <a class="open" href="#"></a>

</div><!--PANEL-->
<?php
}
?>


<script>
	var no_ajax_pages = [];
	var root = '<?php echo home_url(); ?>/';
	<?php if($qode_options_magnet['parallax_speed'] != ''){ ?>
	var parallax_speed = <?php echo $qode_options_magnet['parallax_speed']; ?>;
	<?php }else{ ?>
	var parallax_speed = 1;
	<?php } ?>
</script>
<script>
<?php
	$woo_pages = qode_get_woocommerce_pages();
	foreach ($woo_pages as $woo_page) { ?>

		no_ajax_pages.push('<?php echo $woo_page ?>');

	<?php }
	$pages = get_pages(); 
	foreach ($pages as $page) {
		if(get_post_meta($page->ID, "qode_show-animation", true) == "no_animation") :
?>
			no_ajax_pages.push('<?php echo get_permalink($page->ID) ?>');
<?php
		endif;
	}
	if (isset($qode_options_magnet['internal_no_ajax_links'])) {
		foreach (explode(',', $qode_options_magnet['internal_no_ajax_links']) as $no_ajax_link) {
?>
			no_ajax_pages.push('<?php echo trim($no_ajax_link); ?>');
<?php
		}
	}
?>
</script>
<?php wp_footer(); ?>

</body>
</html>