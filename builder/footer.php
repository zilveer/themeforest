<?php global $oi_options;?>
<div class="oi_footer_holder_main">
<?php
	$layout = $oi_options['oi_footer_layout_sorter']['Enabled'];
	if ($layout): foreach ($layout as $key=>$value) {
		switch($key) {
	 
			case 'footer-i' : get_template_part( 'framework/footer/footer-one');
			break;
			
			case 'footer-ii' : get_template_part( 'framework/footer/footer-two');
			break;
			
			case 'bottom_line' : get_template_part( 'framework/footer/bottom_line');
			break;
	 
		};
	 
	}; 
	endif;?>
</div>
	</div>
<?php wp_footer(); ?>
</body>
</html>