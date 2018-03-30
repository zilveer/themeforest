<?php global $ievent_data;?>
    <!-- BOF Footer -->
	<!-- EOF Main -->    
    
    <?php 
	
		if (!is_page_template('template-blank.php')):
	
			if($ievent_data['select_footer']) {
				if(is_page('footer-1')) {
					include_once get_template_directory().'/inc/footer/footer-1.php';
				}elseif(is_page('footer-2')) {
					include_once get_template_directory().'/inc/footer/footer-2.php';
				}else{
					include_once get_template_directory().'/inc/footer/'.$ievent_data['select_footer'].'.php';
				}
			} else {
				if(is_page('footer-1')) {
					include_once get_template_directory().'/inc/footer/footer-1.php';
				}elseif(is_page('footer-2')) {
					include_once get_template_directory().'/inc/footer/footer-2.php';
				}else{
					include_once get_template_directory().'/inc/footer/footer-1.php';
				}
			}
	
		endif;
	
	?> 
    <!-- EOF Footer -->
    <?php echo $ievent_data['body_code']; // Space for code before body tag ?>
    <?php wp_footer(); ?>
    
</body>
</html>