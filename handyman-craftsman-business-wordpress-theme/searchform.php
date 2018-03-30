<form method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <label>
        <span class="screen-reader-text"><?php _e( 'Search for:', TL_DOMAIN ); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', TL_DOMAIN ); ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', TL_DOMAIN ); ?>" />
    </label>
    <input type="submit" class="button search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', TL_DOMAIN ); ?>" />
</form>