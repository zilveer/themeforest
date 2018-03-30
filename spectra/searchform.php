<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' )); ?>">
	<div>
		<input type="text" placeholder="<?php echo esc_attr( __( 'Search and hit enter...', SPECTRA_THEME ) ) ?>" value="<?php get_search_query(); ?>" name="s" id="s" />
	</div>
</form>