<?php

	/*
	*
	*	Header Split
	*	------------------------------------------------
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	Output for header-split
	*
	*/
	
	global $sf_options;
	$header_left_output  = sf_header_aux( 'left' );
	$header_right_output = sf_header_aux( 'right' );
	$fullwidth_header    = $sf_options['fullwidth_header'];
?>

<?php if ( $fullwidth_header ) { ?>
<header id="header" class="sticky-header fw-header clearfix">
<?php } else { ?>
<header id="header" class="sticky-header clearfix">
<?php } ?>
	<div class="container">
		<div class="row">
			
			<div class="header-left col-sm-4">
				<?php echo $header_left_output; ?>
			</div>
			
			<?php echo sf_logo( 'logo-center' ); ?>
			
			<?php echo sf_main_menu( 'main-navigation', 'float-2' ); ?>
			
			<div class="header-right col-sm-4">
				<?php echo $header_right_output; ?>
			</div>
			
		</div> <!-- CLOSE .row -->
	</div> <!-- CLOSE .container -->
</header>
