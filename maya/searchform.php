<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div><label class="screen-reader-text" for="s"><?php echo apply_filters( 'yiw_searchform_label', __( 'Search for:', 'yiw' ) ) ?></label>
        <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="<?php echo apply_filters( 'yiw_searchform_submit_label', __( 'Search', 'yiw' ) ) ?>" />
        <input type="hidden" name="post_type" value="<?php echo apply_filters( 'yiw_searchform_post_type', 'post' ) ?>" />
    </div>
</form>