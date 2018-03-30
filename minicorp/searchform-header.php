<form role="search" method="get" id="headersearchform" action="<?php echo esc_url( apply_filters( 'ishyoboy_searchform_url', home_url( '/' ) ) ); ?>">
    <input type="submit" id="headersearchsubmit" value="">

    <label>
        <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search...', 'ishyoboy' ); ?>">
    </label>
</form>
