<div id="sidebar" class="four columns">
<div class="sidebar-content">
    <?php 
	global $rnr_sidebar_name;
	
	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Woocommerce Sidebar') );
	?>

</div>
</div>