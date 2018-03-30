<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div>
		<input type="text" placeholder="<?php _e('Start Typing and Hit Enter...', 'alison'); ?>" name="s" class="search" />
		<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
	 </div>
</form>