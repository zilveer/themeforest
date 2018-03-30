<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">    
    <label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'shopkeeper' ); ?></label>
    <input type="search" class="search-field" placeholder="<?php _e( 'Search &hellip;', 'shopkeeper' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
    <input type="submit" class="search-submit" value="<?php _e( 'Search', 'shopkeeper' ); ?>">
</form>