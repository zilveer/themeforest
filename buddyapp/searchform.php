<form method="get" class="search-form" action="<?php echo home_url();?>">
    <label>
        <span class="screen-reader-text"><?php esc_html_e( "Search for:", 'buddyapp' );?></span>
        <input type="search" class="search-field" placeholder="<?php esc_html_e( "Search...",'buddyapp' );?>" value="" name="s">
    </label>
    <button type="submit" class="search-submit"><i class="icon-search"></i></button>
</form>