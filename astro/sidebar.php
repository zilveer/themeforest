<?php
  //ENSURE CORRECT SIDEBAR IS DISPLAYED
  wp_reset_query();
	if (function_exists('dynamic_sidebar') && dynamic_sidebar( apply_filters( 'ups_sidebar', 'sidebar-primary' ) ) ) :
		else : 
		?>
		<!-- THIS CONTENT WILL BE DISPLAYED IF THERE ARE NO WIDGETS -->
		<div id="no-widgets">
            <p>
                <strong>NO WIDGETS YET</strong><br>
                Turn me off under Astro Options>General Tab
            </p>
		</div><!-- no-widgets -->
		<?php 
	endif; 
?>
<div id="half_helper" class="clearfix"></div>
