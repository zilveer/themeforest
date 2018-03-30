<?php
/**
 * The template for displaying search forms 
 *
 */
?>
    
<?php if(class_exists('WooCommerce')) : ?>
        
	<form action="<?php echo home_url( '/' ); ?>" id="searchform" class="hide-input" method="get"> 
	    <input type="text" value="<?php if(get_search_query() == ''){  _e('Search for products', ETHEME_DOMAIN);} else { the_search_query(); } ?>"  onblur="if(this.value=='')this.value='<?php _e('Search for products', ETHEME_DOMAIN); ?>'" onfocus="if(this.value=='<?php _e('Search for products', ETHEME_DOMAIN); ?>')this.value=''" name="s" id="s" />
	    <input type="hidden" name="post_type" value="product" />
	    <input type="submit" value="<?php esc_attr_e( 'Go', ETHEME_DOMAIN ); ?>" class="button active filled"  /> 
	    <div class="clear"></div>
	</form>
<?php else: ?>
	<?php get_template_part('searchform'); ?>
<?php endif ?>