<form class="grve-search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<button type="submit" class="grve-search-btn grve-custom-btn"><i class="grve-icon-search"></i></button>
	<input type="text" class="grve-search-textfield" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php echo esc_attr__( 'Search for ...', 'blade' ); ?>" />
</form>