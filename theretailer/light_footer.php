<?php
global $theretailer_theme_options;
?>

<?php if ( 	(!$theretailer_theme_options['dark_footer_all_site']) ||
			($theretailer_theme_options['dark_footer_all_site'] == 0) ||
			(!$theretailer_theme_options['light_footer_all_site']) ||
			($theretailer_theme_options['light_footer_all_site'] == 0) ) : ?>
				<div class="trigger-footer-widget-area">
					<i class="getbowtied-icon-more-retailer"></i>
				</div>
<?php endif; ?>

<div class="gbtr_widgets_footer_wrapper">
	
<?php if ( (!$theretailer_theme_options['light_footer_all_site']) || ($theretailer_theme_options['light_footer_all_site'] == 0) ) { ?>

	<?php if ( is_active_sidebar( 'widgets_light_footer' ) ) : ?>
        
        <div class="gbtr_light_footer_wrapper">        
            <div class="container_12">
                <?php dynamic_sidebar('widgets_light_footer'); ?>
            </div>             
        </div>
    
    <?php endif; ?>

<?php } ?>