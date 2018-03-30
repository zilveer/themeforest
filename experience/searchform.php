<?php
/**
 * The search form template
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/
?>
 <form method="get" class="searchform" action="<?php echo esc_url( home_url() .'/' ); ?>">
	<fieldset>
		<input class="s" type="text" placeholder="<?php esc_attr_e( "Search", 'experience' ); ?>" value="" name="s" />
		<div class="searchsubmit">
			<span class="funky-icon-search"></span>
			<input type="submit" value="Search" />
		</div>
	</fieldset>
</form>