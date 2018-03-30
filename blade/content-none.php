<?php
/*
*	Template Content None
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/
?>
<div class="grve-content-none">
	<div class="grve-post-content">
		<?php
			if ( 'custom' == blade_grve_option( 'search_page_not_found_mode', 'default' ) ) {		
				echo do_shortcode( blade_grve_option( 'search_page_not_found_text' ) );
			} else {
		?>
		<p class="grve-align-center grve-leader-text">
			<?php esc_html_e( "Hey there mate!", 'blade' ); ?>
			<br>
			<?php esc_html_e( "Your lost treasure is not found here...", 'blade' ); ?>
		</p>
		<p class="grve-align-center">
			<?php esc_html_e( "Check again your spelling and rewrite the content you are seeking for in the search field.", 'blade' ); ?>
		</p>
		<?php
			}
		?>
		<div class="grve-widget">
			<?php get_search_form(); ?>
		</div>
	</div>
</div>