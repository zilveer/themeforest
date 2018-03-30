<?php

/**
 * Password Protected
 *
 * @package bbPress
 * @subpackage Dante
 */

?>

<div id="bbpress-forums" class="container">
	<fieldset class="bbp-form" id="bbp-protected">
		<Legend><?php _e( 'Protected', 'bbpress' ); ?></legend>

		<?php echo get_the_password_form(); ?>

	</fieldset>
</div>