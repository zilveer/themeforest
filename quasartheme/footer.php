<?php do_action('quasar_before_footer'); ?>
        </div>
    </div>

<div class="clear"></div>
<div id="footer" class="footer">
	<?php if(xr_get_option('footer_large_top_shadow', true)): ?>
    <div class="relative-container">
        <?php echo quasar_image_shadow_up(); ?>
    </div>
    <?php endif; ?>
    
    <?php

	$rockthemes_advanced_details = array();
	if(isset($post)){
		$rockthemes_advanced_details = get_post_meta($post->ID,'advanced_post_details',true);	
	}
		
	$display_footer_large = true;
	if(isset($rockthemes_advanced_details['display_footer_large_area']) && !empty($rockthemes_advanced_details['display_footer_large_area'])){
		$display_footer_large = $rockthemes_advanced_details['display_footer_large_area'] === 'true' ? true : false;
	}elseif(xr_get_option('display_footer_large_area', false)){
		$display_footer_large = xr_get_option('display_footer_large_area', false) === 'true' ? true : false;	
	}
	
	
	if($display_footer_large):
	?>
	<div class="footer-large">
    	<div class="row">
        	<div class="large-12 columns">
                <ul class="large-block-grid-<?php echo xr_get_option('large_footer_blocks', 3); ?> small-block-grid-1">
                    <?php
                        $footer_large_blocks = ((int) xr_get_option('large_footer_blocks', 3));
                        $i = 0;
                        for($i; $i< $footer_large_blocks; $i++){
                            echo '<li>';
                            if(dynamic_sidebar('Footer Large '.($i+1)));
                            echo '</li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
	</div>
    <?php endif; ?>
    
    <?php 
	$display_bottom_large = true;
	if(isset($rockthemes_advanced_details['display_footer_bottom_area']) && !empty($rockthemes_advanced_details['display_footer_bottom_area'])){
		$display_bottom_large = $rockthemes_advanced_details['display_footer_bottom_area'] === 'true' ? true : false;
	}elseif(xr_get_option('display_footer_bottom_area', false)){
		$display_bottom_large = xr_get_option('display_footer_bottom_area', false) === 'true' ? true : false;	
	}
	
	
	if($display_bottom_large):
	?>
    <div class="footer-bottom">
    	<div class="row">
        	<div class="large-6 medium-6 columns footer-bottom-left centered-text-responsive-small">
            	<?php echo xr_get_option('footer_copyright'); ?>
            </div>
            <div class="large-6 medium-6 columns right-text centered-text-responsive-small">
            	<?php if(dynamic_sidebar('Footer Bottom')); ?></div>
            </div>
        </div>
    </div>
    <?php
	endif;
	?>
</div><!-- footer class-->

</div><!-- #main-canvas, .main-container -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>