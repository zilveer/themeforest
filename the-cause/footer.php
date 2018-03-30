<?php

/*
	@package WordPress
	@subpackage The Cause
*/

?>

        </div></div>
        <!-- .Content -->
    
    </div>
    <!-- .MAIN -->

</div>
<!-- .CONTENT -->

<!-- FOOTER -->
<div id="footer" class="width100">
	<div class="width1000">
        
        <div class="container_12">
        
        <div class="grid_3">
		<?php dynamic_sidebar( 'Footer 1' ); ?>
        </div>
        
        <div class="grid_3">
		<?php dynamic_sidebar( 'Footer 2' ); ?>
        </div>
        
        <div class="grid_3">
		<?php dynamic_sidebar( 'Footer 3' ); ?>
        </div>
        
        <div class="grid_3">
		<?php dynamic_sidebar( 'Footer 4' ); ?>
        </div>
        
        </div>
        
	</div>
</div>
<!-- .FOOTER -->

<!-- BOTTOM LINE -->
<div id="bottomLine" class="width100">
	<div class="width1000">
        <div id="bottomNav">
		<?php
			if (has_nav_menu('Footer')) {
		        wp_nav_menu(
		            array(
		                'theme_location' => 'Footer', 
		                'container' => false, 
		                'menu_class' => '',
		                'fallback_cb' => 'tb_default_navigation'
		            )
		        );				
			}
	    ?>
        </div>
        
        <div id="credits"><?php echo tb_copyright(); ?></div>
	</div>
</div>
<!-- .BOTTOM LINE -->

<?php
$googleAnalytics = get_option('tb_gac');
if (!empty($googleAnalytics)) {
	echo stripslashes($googleAnalytics);
}
?>

<?php wp_footer(); ?>

</body>
</html>