<?php
/**
 * The template for displaying search forms in CookingPress
 *
 * @package CookingPress
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'cookingpress' ); ?></span>
        <button class="search-btn" type="submit"><i class="icon icon-search"></i></button>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'cookingpress' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'cookingpress' ); ?>">
</form>
 <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'cookingpress' ); ?>">