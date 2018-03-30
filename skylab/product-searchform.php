<?php
?>
<form role="search" method="get" id="searchform" action="<?php esc_url( home_url( '/'  ) ) ?>">
			<div>
				<label class="screen-reader-text" for="s"></label>
				<input type="text" value="<?php get_search_query() ?>" name="s" id="s" placeholder="<?php _e( 'Search for products', 'mega' ) ?>" />
				<input type="submit" id="searchsubmit" value="<?php esc_attr__( 'Search', 'mega' ) ?>" />
				<input type="hidden" name="post_type" value="product" />
			</div>
		</form>