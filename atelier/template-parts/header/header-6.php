<?php

	/*
	*
	*	Header 4
	*	------------------------------------------------
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	Output for header-6
	*
	*/
	
	$header_left_output  = sf_header_aux( 'left' );
	$header_right_output = sf_header_aux( 'right' );
?>

<header id="header" class="clearfix">
	<div class="container">
		<div class="row">
	
			<div class="header-left col-sm-4">
				<?php echo $header_left_output; ?>
			</div>
	
			<?php echo sf_logo( 'col-sm-4 logo-center' ); ?>
	
			<div class="header-right col-sm-4">
				<?php echo $header_right_output; ?>
			</div>
	
		</div> <!-- CLOSE .row -->
	</div> <!-- CLOSE .container -->
</header>

<div id="main-nav" class="sticky-header center-menu">
	<?php echo sf_main_menu( 'main-navigation', 'full' ); ?>
</div>