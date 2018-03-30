<?php
/**
 * The template for displaying search forms
 */
?>
	<div class="searchform-wrapper">
		<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input onfocus="this.value=''" onblur="this.value='<?php _e( 'TYPE AND HIT ENTER ...', 'care' );?>'" type="text" value="<?php _e( 'TYPE AND HIT ENTER ...', 'care' );?>" name="s" class="search-input" />
		</form>
	</div>