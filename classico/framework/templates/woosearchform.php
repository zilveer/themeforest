<?php
/**
 * The template for displaying search forms 
 *
 */
?>
    
<?php if(class_exists('Woocommerce')) : ?>
        
	<form action="<?php echo home_url( '/' ); ?>" id="searchform" class="hide-input" method="get"> 
		<input type="text" value="" placeholder="<?php _e( 'Type here...', ET_DOMAIN ); ?>" class="form-control" name="s" id="s" />
		<input type="hidden" name="post_type" value="product" />
		<button type="submit" class="btn filled"><?php esc_attr_e( 'Search', ET_DOMAIN ); ?><i class="fa fa-search"></i></button>
	</form>
	
<?php else: ?>
	<?php get_template_part('searchform'); ?>
<?php endif ?>