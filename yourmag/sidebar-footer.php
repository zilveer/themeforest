
<div id="sidebar-footer" class="mosaicflow" data-item-selector=".footer-widget" data-min-item-width="300">
 
    <?php if (get_option('op_banner_footer') == 'on') { ?>

		<div id="banner_footer_728">
		<?php $footer_banner = get_option("op_banner_footer_code"); ?>
		<?php echo stripslashes($footer_banner); ?>
		</div>

	<?php } ?>	
 
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-sidebar') ) : ?>
<?php endif; ?> 	

</div>
