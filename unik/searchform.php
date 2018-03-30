<?php
/**
 * It display search input form
 *
 */
?>
<form id ="searchform" role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>" >
    <input placeholder="<?php _e('Search ..',THEMENAME); ?>" type="text" class="srctext form-control" id="s" name="s">	
    <button type="submit" class="searchsubmit hidden" ><?php _e('Search',THEMENAME); ?></button>
</form>