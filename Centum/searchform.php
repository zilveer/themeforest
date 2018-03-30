<?php
/**
 * The template for displaying search forms 
 *
 */
?>
<div class="search">
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input name="s" id="s" value="<?php echo get_search_query(); ?>" placeholder="<?php // esc_attr_e( 'To search type and hit enter', 'centum' ); ?>"  type="text" class="text"/>
	</form>
</div>