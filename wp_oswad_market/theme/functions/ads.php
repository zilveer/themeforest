<?php
/* Print ads in header */
if(!function_exists ('printHeaderAds')){
	function printHeaderAds(){
		global $smof_data;
		if( absint($smof_data['wd_enable_advertisement']) == 1 ){
	?>	
		<div class="wd_advertisement <?php wd_page_layout_class(); ?>">
			<div class="content-adv">
				<?php echo do_shortcode(stripslashes($smof_data['wd_advertisement_code'])); ?>
			</div>
		</div>
	<?php		
		}
	}
}

?>