<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
    <div class="row collapse">
        <div class="small-8 columns">
            <input type="text" value="" name="s" id="s" placeholder=""/>
        </div>
        <div class="small-4 columns">
            <input type="submit" id="searchsubmit" value="<?php _e('Search', 'peekaboo') ?>"
                   class="button secondary prefix"/>
        </div>
    </div>
</form>



