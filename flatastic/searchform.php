<form method="get" role="search" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<p>
		<label for="s"><?php esc_html_e('Search for:', 'flatastic'); ?></label>
		<input type="text" autocomplete="off" name="s" id="s" placeholder="<?php esc_attr_e( 'Type text and hit enter', 'flatastic' ) ?>"  value="<?php echo get_search_query(); ?>" />
		<button type="submit" class="submit-search" id="searchsubmit"><?php esc_attr_e( 'Search', 'flatastic' ); ?></button>
	</p>
</form>