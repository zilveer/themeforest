<?php get_header(); ?>
		
<?php 

	$canon_options = get_option('canon_options');
	$canon_options_post = get_option('canon_options_post'); 

	// DEFAULTS
	if (!isset($canon_options_post['use_woocommerce_sidebar'])) { $canon_options_post['use_woocommerce_sidebar'] = "unchecked"; }

	// SET MAIN COLUMN CLASS
	$main_column_class = ($canon_options_post['use_woocommerce_sidebar'] == "checked") ? "col-3-4" : "col-1-1";

?>

    	<!-- Start Outter Wrapper -->
    	<div class="outter-wrapper body-wrapper">		
    		<div class="wrapper clearfix">

				<!-- Main Column -->
				<div class="<?php echo esc_attr($main_column_class); ?>">
				
					<?php woocommerce_content(); ?> 
				
				</div>
				<!-- End Main Column -->    
				
				<!-- SIDEBAR -->
				<?php if ($canon_options_post['use_woocommerce_sidebar'] == "checked") { get_sidebar('woocommerce'); } ?> 

    		</div>
    	</div>


<?php get_footer(); ?>