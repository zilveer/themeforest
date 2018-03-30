<?php
/**
 * The template for displaying search forms 
 *
 */
?>
    
<?php if(class_exists('Woocommerce')) : ?>
        
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform" class="hide-input" method="get"> 
		<div class="form-horizontal modal-form">
			<div class="form-group has-border">
				<div class="col-xs-10">
					<input type="text" value="<?php if(get_search_query() == ''){  esc_attr_e('Search for...', ETHEME_DOMAIN);} else { the_search_query(); } ?>" class="form-control" onblur="if(this.value=='')this.value='<?php _e('Search for...', ETHEME_DOMAIN); ?>'" onfocus="if(this.value=='<?php _e('Search for...', ETHEME_DOMAIN); ?>')this.value=''" name="s" id="s" />
					<input type="hidden" name="post_type" value="<?php esc_attr_e( etheme_get_option('search_post_type') ); ?>" />
				</div>
			</div>
			<div class="form-group form-button">
				<button type="submit" class="btn medium-btn btn-black"><?php esc_attr_e( 'Search', ETHEME_DOMAIN ); ?></button>
			</div>
		</div>
	</form>
	
<?php else: ?>
	<?php get_template_part('searchform'); ?>
<?php endif ?>