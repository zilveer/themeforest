<form action="<?php echo esc_url(home_url( '/' )) ?>" method="get" class="search-a">
    <fieldset>
        <p>
            <label for="sa"><?php _e('Search','fw'); ?>...</label>
            <input type="text" id="sa" name="s" value="<?php get_search_query();?>" required>
            <button type="submit">
                <i class="icon-basic" data-icon="#"></i>
                <span class="hidden"><?php _e('Submit','fw');?></span>
            </button>
        </p>
    </fieldset>
</form>