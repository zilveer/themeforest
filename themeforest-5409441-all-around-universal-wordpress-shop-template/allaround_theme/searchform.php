<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */
?>
<div class="search-form">
<form action="<?php echo home_url( '/' ); ?>" method="get">
	<div class="input_wrapper">
		<span class="input_title"><?php _e('Search', 'allaround'); ?></span>
		<input class="input_field" name="s" type="text" value="<?php the_search_query(); ?>" placeholder="<?php _e('Search', 'allaround'); ?>" />
		<div class="clear"></div><!-- clear -->
		</div><!-- input_wrapper -->

<input type="submit" class="submit_button button_hover_effect" />
</form>
<div class="clear"></div>
</div>