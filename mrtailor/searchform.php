<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">    
    <div>
        <label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'mr_tailor' ); ?></label>
        <input type="search" class="search-field" id="s" placeholder="<?php _e( 'Search...', 'mr_tailor' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
        <input type="submit" class="search-submit" value="<?php _e( 'Search', 'mr_tailor' ); ?>">
    </div>
</form>