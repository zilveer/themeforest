<form method="get" role="form" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	<input id="search-query" type="text" class="form-control" placeholder="<?php esc_attr_e( __( 'To search type &amp; hit enter', 'shiroi' ) ) ?>" name="s" value="<?php the_search_query() ?>">
</form>