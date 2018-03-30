<?php

/**
 * The template for displaying search forms
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */
 
 $search = __('Looking for something?', 'mpcth');
 
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="field mpcth-search" name="s" id="s" value="<?php echo $search;?>" onfocus="if(this.value=='<?php echo $search; ?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo $search; ?>';"/>
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'mpcth' ); ?>"/>
</form>
