<?php $sidebar_pos = isset($_GET['sidebar']) ? htmlspecialchars($_GET['sidebar']) : ot_get_option('shop_sidebar'); ?>

<aside class="sidebar woo<?php if ($sidebar_pos == 'left') { echo ' pull'; }?>" role="complementary">
	<?php 
	
		##############################################################################
		# Shop Page Sidebar
		##############################################################################
	
	 	?>
	<?php dynamic_sidebar('shop'); ?>
</aside>