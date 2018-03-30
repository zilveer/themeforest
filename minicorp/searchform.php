<form role="search" method="get" id="searchform" action="<?php echo esc_url( apply_filters( 'ishyoboy_searchform_url', home_url( '/' ) ) ); ?>">
	<div>
        <label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'ishyoboy'); ?></label>
        <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search...', 'ishyoboy' ); ?>">
        <input type="submit" id="searchsubmit" value="">
	</div>
</form>
