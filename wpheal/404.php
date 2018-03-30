<?php 

get_header(); 

/*
Template Name: 404
*/

//Extracting the values that user defined in OptionTree Plugin 
$errorText = ot_get_option('error_text');

?>
	<!-- BEGIN MAIN CONTENT -->
	<div id="error-title-wrap"></div>
	<div class="container">
		<div class="twelve columns left-content page content-fullwidth">
			<div id="error-wrap">
				<div id="error-title">404</div>
				<div id="error-after-title">page not found</div>
				<div id="error-text"><?php echo $errorText ?></div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
<?php get_footer(); ?>
