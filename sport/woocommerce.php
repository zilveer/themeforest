<?php get_header(); ?>
		
<?php 

	$canon_options = get_option('canon_options');
	$canon_options_post = get_option('canon_options_post'); 

	// DEFAULTS
	if (!isset($canon_options_post['use_woocommerce_sidebar'])) { $canon_options_post['use_woocommerce_sidebar'] = "unchecked"; }

	// SET MAIN CONTENT CLASS
	$main_content_class = "main-content";
	if ($canon_options_post['use_woocommerce_sidebar'] == "checked") { 
		$main_content_class .= " three-fourths"; 
		if ($canon_options['sidebars_alignment'] == 'left') { $main_content_class .= " left-main-content"; }
	}

?>

		<!-- start outter-wrapper -->   
		<div class="outter-wrapper">
			<!-- start main-container -->
			<div class="main-container">
				<!-- start main wrapper -->
				<div class="main wrapper clearfix">
					<!-- start main-content -->
					<div class="<?php echo $main_content_class; ?>">

		
						<div class="clearfix">

							<?php woocommerce_content(); ?> 
																								   
						</div>  

					</div>
					<!-- end main-content -->
						
					<!-- SIDEBAR -->
					<?php if ($canon_options_post['use_woocommerce_sidebar'] == "checked") { get_sidebar('woocommerce'); } ?> 
										
				</div>
				<!-- end main wrapper -->
			</div>
			 <!-- end main-container -->
		</div>
		<!-- end outter-wrapper -->

<?php get_footer(); ?>