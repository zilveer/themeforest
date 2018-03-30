<?php
/**
 * @package sellya
 * @subpackage sellya
 */
?>
	
	 <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">        

	<input type="text" onKeyDown="this.style.color = '#000000';"  class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'sellya' ); ?>" />
	<div class="button-search"><input type="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'sellya' ); ?>" /></div>	
	 </form>
