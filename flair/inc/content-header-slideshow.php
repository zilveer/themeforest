<?php  
	/**
	 * All variables in here are being brought from /page_builder_blocks/header_block.php
	 * This is a separate file so that you can override it easily from your child theme.
	 */
?>
		
<section id="home" class="slider">

	<?php include( locate_template('inc/content-header-titles.php') ); ?>
	
	<?php
		if( is_array($tabs) ){
			echo '<div class="top-slider"><ul class="slides">';
			foreach( $tabs as $tab ){
				echo '<li style="background:url('. esc_url($tab['title']) .');"></li>';
			}
			echo '</ul></div>';
		}
	?>
	
	<div id="overlay"></div>

</section>