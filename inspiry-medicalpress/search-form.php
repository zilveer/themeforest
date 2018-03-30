<div id="search" class="widget clearfix">
    <form method="get" id="search-form" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
        <div>
            <input type="text" value="<?php the_search_query(); ?>" name="s" id="search-text" placeholder="<?php _e('Search', 'framework'); ?>"/>
            <input type="submit" id="search-submit" value=""/>
        </div>
    </form>
</div>