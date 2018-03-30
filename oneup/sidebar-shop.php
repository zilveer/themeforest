<?php
/**
 * The sidebar containing the widget area (woocommerce)
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<div class="span4 sidebar">
	 <div class="inner-spacer-left-lrg">
		 <?php
			 $sb = apply_filters("pe_theme_woocommerce_sidebar","shop");
			 dynamic_sidebar(peTheme()->sidebar->exists($sb) ? $sb : "default"); 
		 ?>
	 </div>
</div>