<?php
/**
 * The template for displaying search forms in Nevia
 *
 * @package Nevia
 * @since Nevia 1.0
 */
?><div class="top-search widget">

	<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
        <input class="search-field" type="text" name="s" placeholder="<?php _e('Search','trizzy') ?>" value=""/>

	</form>
    </div>
<div class="clearfix"></div>



