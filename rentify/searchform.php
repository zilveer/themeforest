<form class="search-form"  method="get" id="searchform"  action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="search-input" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" placeholder="Search"/>
	<input type="submit" class="btn btn-default" id="searchsubmit" value="<?php esc_html_e( '', 'rentify' ); ?>" />
</form>

