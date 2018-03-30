<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
    	<label class="screen-reader-text" for="s"><?php _e('Search for:', 'thb_text_domain') ?></label>
        <input type="text" value="" name="s" id="s" placeholder="<?php _e('Type your keywords and hit enter', 'thb_text_domain') ?>">
        <button type="submit" id="searchsubmit" value="Search"></button>
    </div>
</form>