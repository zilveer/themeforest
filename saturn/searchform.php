<form role="search" method="get" class="search-form" action="<?php print esc_url( home_url('/') );?>">
	<input type="search" class="search-field" placeholder="<?php _e('Search and hit enter...','saturn');?>" value="<?php print esc_attr( get_query_var( 's' ) );?>" name="s" title="<?php _e('Search for:','saturn')?>">
</form>
