<?php if(! defined('ABSPATH')){ return; } ?>
<div class="wrap zn-about-container zn-u-pleft zn-u-pright">
	<header class="zn-about-header clearfix" id="dashboard-top">
		<h2><?php echo ZN()->theme_data['name'] .' '. __( 'THEME ', 'zn_framework' );
		 //echo '<span>'. ZN()->theme_data['name'].'</span>';
		 ?></h2>
		<div class="zn-theme-version-number">Version <?php echo ZN()->version; ?></div>
	</header>
