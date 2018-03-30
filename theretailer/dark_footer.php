<?php
global $theretailer_theme_options;
?>

<?php if ( (!$theretailer_theme_options['dark_footer_all_site']) || ($theretailer_theme_options['dark_footer_all_site'] == 0) ) { ?>

	<?php if ( is_active_sidebar( 'widgets_dark_footer' ) ) : ?>        
        
        <div class="gbtr_dark_footer_wrapper">        
            <div class="container_12">
                <?php dynamic_sidebar('widgets_dark_footer'); ?>
            </div>             
        </div>        
    
    <?php endif; ?>

<?php } ?>

</div><!-- .gbtr_widgets_footer_wrapper-->