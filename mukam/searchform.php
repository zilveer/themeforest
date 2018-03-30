<div class="search">
        <form method="get" action="<?php echo home_url(); ?>">
            <input type="text" name="s" class="search-query" placeholder="<?php echo __('Search here...', 'mukam');?>" value="<?php the_search_query(); ?>">
            <button class="search-icon" type="submit"><a href="#"><i class="icon-search"></i></a></button>
        </form>
 </div>