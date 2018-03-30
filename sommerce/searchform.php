<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" class="group">
    <div><label class="screen-reader-text" for="s"><?php echo apply_filters( 'yiw_searchform_label', __( 'Search', 'yiw' ) ) ?></label>
        <input type="text" value="" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="<?php echo apply_filters( 'yiw_searchform_submitlabel', __( 'Search', 'yiw' ) ) ?>" />    
        <input type="hidden" name="post_type" value="<?php echo yiw_get_option( 'search_form_post_type', 'post' ) ?>" />
    </div>
</form>