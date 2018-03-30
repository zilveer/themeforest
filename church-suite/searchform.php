<?php
	$webnus_options = webnus_options();
	$webnus_options['webnus_enable_livesearch'] = isset( $webnus_options['webnus_enable_livesearch'] ) ? $webnus_options['webnus_enable_livesearch'] : '';
	$live_search = ($webnus_options['webnus_enable_livesearch'] == 1)?'live-search':'';
?>

<form role="search" action="<?php echo esc_url(home_url( '/' )); ?>" method="get" >
 <div>
   <input name="s" type="text" placeholder="<?php esc_html_e('Enter Keywords...','webnus_framework'); ?>" class="search-side <?php echo esc_attr($live_search) ?>" >
   <input type="submit" id="searchsubmit" value="Search" class="btn" />
</div>
</form>