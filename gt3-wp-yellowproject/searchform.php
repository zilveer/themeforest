<form name="search_form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search_form">
    <input type="submit" name="submit_search" value="" title="" class="btn_search">
    <input type="text" name="s" value="<?php (get_theme_option("translator_status") == "enable") ? the_text("translator_search_value") : _e('Search the site...','theme_localization'); ?>" title="<?php (get_theme_option("translator_status") == "enable") ? the_text("translator_search_value") : _e('Search the site...','theme_localization'); ?>" class="field_search">
</form>