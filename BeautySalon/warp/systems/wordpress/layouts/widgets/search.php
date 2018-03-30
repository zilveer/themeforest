<form class="uk-search" id="<?php echo $widget->id; ?>" action="<?php echo home_url( '/' ); ?>" method="get" role="search"  <?php if($widget->position !== 'offcanvas'):?>data-uk-search="{'source': '<?php echo site_url('wp-admin'); ?>/admin-ajax.php?action=warp_search', 'param': 's', 'msgResultsHeader': '<?php _e("Search Results", "warp"); ?>', 'msgMoreResults': '<?php _e("More Results", "warp"); ?>', 'msgNoResults': '<?php _e("No results found", "warp"); ?>', flipDropdown: 1}"<?php endif;?>>
    <input class="uk-search-field" type="text" value="" name="s" placeholder="<?php _e('search...', 'warp'); ?>">
    <button class="uk-search-close" type="reset" value="Reset"></button>
</form>
