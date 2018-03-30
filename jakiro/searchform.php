<form method="GET" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="form">
	<label for="s" class="sr-only"><?php esc_html_e( 'Search', 'jakiro' ); ?></label>
	<input type="hidden" value="post" name="post_type">
	<input type="search" id="s" name="s" class="form-control" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e( 'Search something&hellip;', 'jakiro' ); ?>" />
	<input type="submit" id="searchsubmit" class="hidden" name="submit" value="<?php esc_attr_e( 'Search', 'jakiro' ); ?>" />
</form>