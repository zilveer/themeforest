<?php

	/*
	*
	*	Header 9
	*	------------------------------------------------
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	Output for header-2
	*
	*/
	
	$header_right_output = sf_header_aux( 'right' );
?>

<header id="header" class="clearfix">
	<div class="container">
		<div class="row">
		
		<?php echo sf_logo( 'col-sm-4 logo-left' ); ?>
		
		<div class="header-right col-sm-8">
			<?php echo $header_right_output; ?>
		</div>
		
		</div> <!-- CLOSE .row -->
	</div> <!-- CLOSE .container -->
</header>

<div id="main-nav" class="sticky-header">
	<?php echo sf_main_menu( 'main-navigation', 'full' ); ?>
</div>