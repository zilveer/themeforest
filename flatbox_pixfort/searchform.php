	<form role="search" class="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_attr_e( 'Enter search term...', 'modelish' ); ?>" />
		<input type="submit" value="<?php esc_attr_e( 'Search', 'modelish' ); ?>" />
		<div class="clear"></div>
	</form>