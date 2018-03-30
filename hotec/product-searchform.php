<form role="search" method="get" id="searchform" class="searchform search-product" action="<?php echo home_url( '/' ); ?>">
    <div>
        <input type="text" value="" name="s" id="s" class="s" placeholder="<?php _e('Search for products','smooththemes'); ?>" />
        <input type="submit" id="searchsubmit" value="<?php _e('Search','smooththemes'); ?>" />
        <input type="hidden" value="product" name="post_type">
    </div>
</form>