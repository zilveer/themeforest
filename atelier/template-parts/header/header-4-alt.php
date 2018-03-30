<?php

	/*
	*
	*	Header 10
	*	------------------------------------------------
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	Output for header-4-alt
	*
	*/
	
	$header_left_output  = sf_header_aux( 'left' );
	$header_right_output = sf_header_aux( 'right' );
?>

<header id="header" class="sticky-header fw-header clearfix">
	<div class="container"> 
		<div class="row"> 
			
			<div class="header-left">
				<?php echo $header_left_output; ?>
			</div>
			
			<?php echo sf_logo( 'col-sm-4 logo-left' ); ?>
			
			<div class="header-right">
				<?php echo $header_right_output; ?>
			</div>
			
			<?php echo sf_main_menu( 'main-navigation', 'float-2' ); ?>
			
		</div> <!-- CLOSE .row --> 
	</div> <!-- CLOSE .container --> 
</header> 
