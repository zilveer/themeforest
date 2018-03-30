<?php
/**
 * The template for displaying search forms 
 *
 * @package WordPress
 * @subpackage Mrphis
 *
 */
?>

	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<fieldset>
			<input type="text" name="s" id="s" class="field" value="<?php echo esc_attr( __( 'Type and hit enter', 'morphis' ) ); ?>" onfocus="if(this.value=='<?php echo esc_attr( __( 'Type and hit enter', 'morphis' ) ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo esc_attr( __( 'Type and hit enter', 'morphis' ) ); ?>';" />
		</fieldset>
	</form>
