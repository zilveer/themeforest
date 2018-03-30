<?php
/************************************************************************
* Search Form
*************************************************************************/
?>


<div class="widget search-widget">

	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="search-form">

		<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search Site..', 'ninezeroseven' ); ?>" />
	
	</form>

</div>