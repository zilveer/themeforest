<form role="search" method="get" class="woocommerce-search-form" action="<?php print esc_url( home_url('/') );?>">
	<input type="search" class="search-field form-control" placeholder="<?php _e('Search and hit enter...','gazeta');?>" value="<?php print esc_attr( get_query_var( 's' ) );?>"  title="<?php _e('Search for:','gazeta')?>" name="s">
	<input type="hidden" name="post_type" value="product" />
</form>