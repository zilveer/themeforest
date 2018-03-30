<?php
    global $use_live_search;
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div><label class="screen-reader-text" for="s">Search for:</label>
        <input class="<?php echo ($use_live_search) ? '' : ' no-livesearch'; ?>" type="text" value="" placeholder="<?php esc_html_e('Search', 'startit'); ?>" name="s" id="s" />
        <?php if($use_live_search) { ?>
            <i class="ion-ios-search-strong"></i>
        <?php } else { ?>
            <input type="submit" id="searchsubmit" value="&#xf002;" />
        <?php } ?>
    </div>
</form>