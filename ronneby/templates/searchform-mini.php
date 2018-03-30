<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="form-search-container">
	<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">
		<label class="hide" for="s"><?php _e('Search for:', 'dfd'); ?></label>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" class="search-query" placeholder="<?php /*_e('Search', 'dfd');*/ ?>">
		<input type="submit" id="searchsubmit" value="" class="btn">
		<div class="searchsubmit-icon"><i class="dfd-icon-zoom"></i></div>
	</form>
</div>