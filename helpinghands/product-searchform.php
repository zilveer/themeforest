<?php
/* ------------------------------------------------------------------------ */
/* Product Search Form
/* @version 2.5.0
/* ------------------------------------------------------------------------ */
?>

<div class="sd-search sd-product-search">
	<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label class="screen-reader-text" for="s"></label>
		<input class="sd-search-input" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php esc_attr_e( 'Search Products', 'sd-framework' ); ?>" />
		<button class="sd-search-button"><i class="fa fa-search"></i></button>
		<input type="hidden" name="post_type" value="product" />
	</form>
</div>