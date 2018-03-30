    <?php
global $wp_query;
$image_width = get_option('product_image_width');
$product_sidebar = etheme_get_option('product_page_sidebar');
$blog_sidebar_mobile = etheme_get_option('blog_sidebar_mobile');
$product_per_row = etheme_get_option('prodcuts_per_row');
$product_img_hover = etheme_get_option('product_img_hover');
if($product_per_row == 5){
    $product_sidebar = false;
}
/*
 * Most functions called in this page can be found in the wpsc_query.php file
 */
?>
<?php etheme_wpsc_output_breadcrumbs(); ?>
<a class="back-to" href="javascript: history.go(-1)"><?php _e('&laquo; Return to Previous Page', ETHEME_DOMAIN); ?></a>
<div class="clear"></div>

<?php if($blog_sidebar_mobile=='top'): ?>
    <?php if($product_sidebar) : ?>
    	<div id="products-sidebar" class="main-products-sidebar above-content">
    		<?php if ( is_active_sidebar( 'product-widget-area' ) ) : ?>
    			<?php dynamic_sidebar( 'product-widget-area' ); ?>
            <?php else: ?>
                <?php etheme_get_categories_menu(); ?>
    		<?php endif; ?>
    	</div>
    <?php endif; ?>
<?php endif; ?>

<div id="default_products_page_container" class="wrap wpsc_container <?php if(!$product_sidebar) echo 'no-sidebar'; else echo 'with-sidebar'?>">

    <?php etheme_product_page_banner(); ?>

	<?php do_action('wpsc_top_of_products_page'); // Plugin hook for adding things to the top of the products page, like the live search ?>

    <?php if(wpsc_display_categories()): ?>
			<div class="wpsc_categories">

				<?php wpsc_start_category_query(array('category_group'=>get_option('wpsc_default_category'), 'show_thumbnails'=> get_option('show_category_thumbnails'))); ?>

                        <div class="wpsc_category">
							<a href="<?php wpsc_print_category_url();?>" class="wpsc_category_link <?php wpsc_print_category_classes_section(); ?>" title="<?php wpsc_print_category_name(); ?>"><?php wpsc_print_category_name(); ?></a>
							<?php if(wpsc_show_category_description()) :?>

                                <?php wpsc_print_category_description("<div class='wpsc_subcategory'>", "</div>"); ?>

                            <?php endif;?>


                            <?php wpsc_print_subcategory("<div class='wpsc_subcategories'>", "</div>"); ?>

                        </div>
				<?php wpsc_end_category_query(); ?>

			</div>

	<?php endif; ?>

<?php // */ ?>

	<?php if(wpsc_display_products()): ?>

		<?php if(wpsc_is_in_category()) : ?>

			<div class="wpsc_category_details">

				<?php if(wpsc_show_category_thumbnails()) : ?>

					<img src="<?php echo wpsc_category_image(); ?>" alt="<?php echo wpsc_category_name(); ?>" />

                <?php endif; ?>

				<?php if(wpsc_show_category_description() &&  wpsc_category_description()) : ?>

                    <?php echo wpsc_category_description(); ?>

                <?php endif; ?>

			</div><!--close wpsc_category_details-->

		<?php endif; ?>

	   <?php if(wpsc_product_count() != 0):?>
            <div class="toolbar">
        		<?php if(wpsc_has_pages_top()) : ?>
        			<div class="pagintaion">
                    	<?php if (is_search()): ?>
                    		<?php etheme_search_pagination(); ?>
                    	<?php else: ?>
                    		<?php etheme_pagination(); ?>
                    	<?php endif; ?>	
                    </div>
        		<?php endif; ?>
                <?php $view_mode = etheme_get_option('view_mode'); ?>
                <?php $view_mode_default = etheme_get_option('view_mode_default'); ?>
                <?php if($view_mode == 'grid_list'): ?>
                    <p class="view-mode">
                        <label><?php _e('View as:', ETHEME_DOMAIN); ?></label>
                            <span class="switcher switchToList <?php if($view_mode_default == 'list') echo 'default_mode' ?>"><?php _e('List', ETHEME_DOMAIN); ?></span>
                            <span class="switcher switchToGrid <?php if($view_mode_default == 'grid') echo 'default_mode' ?>"><?php _e('Grid', ETHEME_DOMAIN); ?></span>
                    </p>
                <?php endif ;?>
                <div class="clear"></div>
            </div>
        <?php endif; ?>
        <?php
            if(isset($view_mode) && $view_mode == 'grid_list'){
                if($view_mode_default == 'grid') $view_class = 'products_grid';
                if($view_mode_default == 'list') $view_class = 'products_list';
            } else {
                $view_class = (isset($view_mode) && $view_mode == 'list') ? 'products_list' : 'products_grid';
            }
        ?>
        <?php $columns = $product_per_row; $_i = 0; ?>
		<div id="products-grid" class="<?php echo $view_class;  ?> rows-count<?php echo $columns ?>">

		<?php /** start the product loop here */?>
		<?php while (wpsc_have_products()) :  wpsc_the_product(); ?>
			<?php $_i++; ?>
			<div class="<?php if($_i%$columns == 0) echo 'last' ?>  product-grid product_view_<?php echo wpsc_the_product_id(); ?> <?php if( !is_search() ){ echo wpsc_category_class(); }?> group">

				<?php if(wpsc_show_thumbnails()) :?>
					<div class="imagecol" id="imagecol_<?php echo wpsc_the_product_id(); ?>">

                        <?php etheme_product_labels(); ?>

						<?php if(wpsc_the_product_thumbnail()) :
							if ( (!isset($id) && empty($id)) || is_search() ) {
								$id = 0;
							}
						?>
                            <a id="<?php echo etheme_get_image( $id, 400, 400, false ) ?>" href="<?php echo wpsc_the_product_permalink(); ?>" class="product-image <?php if($product_img_hover == 'tooltip'): ?>imageTooltip<?php endif; ?>">
                                <?php if(etheme_get_custom_field('_etheme_hover') && $product_img_hover == 'swap'): ?><div class="img-wrapper"><img class="product_image" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo etheme_get_custom_field('_etheme_hover'); ?>"/></div> <?php endif; ?>
                                <div class="img-wrapper <?php if(etheme_get_custom_field('_etheme_hover') && $product_img_hover == 'swap'): ?> hideableHover <?php endif; ?>" style="opacity: 1;"><img class="product_image" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail(); ?>"/></div>
                            </a>

						<?php else: ?>
								<a class="product-image" href="<?php echo wpsc_the_product_permalink(); ?>">
								<div class="img-wrapper<?php if(etheme_get_custom_field('_etheme_hover') && $product_img_hover == 'swap') echo ' hideableHover' ?>"><img class="no-image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="No Image" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo WPSC_CORE_THEME_URL; ?>wpsc-images/noimage.png" width="<?php echo get_option('product_image_width'); ?>" height="<?php echo get_option('product_image_height'); ?>" /></div>
								</a>
						<?php endif; ?>
						<?php
						if(gold_cart_display_gallery()) :
							echo gold_shpcrt_display_gallery(wpsc_the_product_id(), true);
						endif;
						?>
					</div><!--close imagecol-->
				<?php endif; ?>
					<?php if(etheme_get_option('product_page_productname')): ?>
	                    <div class="product-name">
	        				<?php if(get_option('hide_name_link') == 1) : ?>
	        					<?php echo wpsc_the_product_title(); ?>
	        				<?php else: ?>
	        					<a class="wpsc_product_title" href="<?php echo wpsc_the_product_permalink(); ?>"><?php echo wpsc_the_product_title(); ?></a>
	        				<?php endif; ?>
	                    </div>
    				<?php endif; ?>
					<?php
						do_action('wpsc_product_before_description', wpsc_the_product_id(), $wp_query->post);
						do_action('wpsc_product_addons', wpsc_the_product_id());
					?>
					<div class="wpsc_description">
						<?php echo wpsc_the_product_description(); ?>
                    </div><!--close wpsc_description-->
						<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
							<?php $action =  wpsc_product_external_link(wpsc_the_product_id()); ?>
						<?php else: ?>
						<?php $action = htmlentities(wpsc_this_page_url(), ENT_QUOTES, 'UTF-8' ); ?>
						<?php endif; ?>
						<form class="product_form"  enctype="multipart/form-data" action="<?php echo $action; ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_<?php echo wpsc_the_product_id(); ?>" >
						<?php do_action ( 'wpsc_product_form_fields_begin' ); ?>


						<?php if(etheme_get_option('product_page_price')): ?>
							<div class="price">
								<?php if(wpsc_product_is_donation()) : ?>
									<label for="donation_price_<?php echo wpsc_the_product_id(); ?>"><?php _e('Donation', ETHEME_DOMAIN); ?>: </label>
									<input type="text" id="donation_price_<?php echo wpsc_the_product_id(); ?>" name="donation_price" value="<?php echo wpsc_calculate_price(wpsc_the_product_id()); ?>" size="6" />

								<?php else : ?>
									<?php if(wpsc_product_on_special()) : ?>
										<p class="oldprice-p pricedisplay product_<?php echo wpsc_the_product_id(); ?>"><span class="oldprice" id="old_product_price_<?php echo wpsc_the_product_id(); ?>"><?php echo wpsc_product_normal_price(); ?></span></p>
									<?php endif; ?>
									<p class="pricedisplay product_<?php echo wpsc_the_product_id(); ?>"><span id='product_price_<?php echo wpsc_the_product_id(); ?>' class="<?php if(wpsc_product_on_special()) echo 'currentprice'; ?> pricedisplay"><?php echo wpsc_the_product_price(); ?></span></p>
									<?php if(wpsc_product_on_special()) : ?>
										<!--p class="pricedisplay product_<?php echo wpsc_the_product_id(); ?>"><?php _e('You save', ETHEME_DOMAIN); ?>: <span class="yousave" id="yousave_<?php echo wpsc_the_product_id(); ?>"><?php echo wpsc_currency_display(wpsc_you_save('type=amount'), array('html' => false)); ?>! (<?php echo wpsc_you_save(); ?>%)</span></p-->
									<?php endif; ?>

									<!-- multi currency code -->
									<?php if(wpsc_product_has_multicurrency()) : ?>
	                                	<?php echo wpsc_display_product_multicurrency(); ?>
                                    <?php endif; ?>

									<?php if(wpsc_show_pnp()) : ?>
										<!--p class="pricedisplay"><?php _e('Shipping', ETHEME_DOMAIN); ?>:<span class="pp_price"><?php echo wpsc_product_postage_and_packaging(); ?></span></p-->
									<?php endif; ?>
								<?php endif; ?>
							</div><!--close wpsc_product_price-->
						<?php endif; ?>

							<?php if(etheme_get_option('product_page_addtocart')): ?>
								<input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
								<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id"/>

								<!-- END OF QUANTITY OPTION -->
								<?php if((get_option('hide_addtocart_button') == 0) &&  (get_option('addtocart_or_buynow') !='1')) : ?>
									<?php if(wpsc_product_has_stock()) : ?>
										<div class="btn-cont">
												<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
												<?php $action = wpsc_product_external_link( wpsc_the_product_id() ); ?>
	                                            <button class="button" type="submit" onclick="return gotoexternallink('<?php echo $action; ?>', '<?php echo wpsc_product_external_link_target( wpsc_the_product_id() ); ?>')"><span><?php echo wpsc_product_external_link_text( wpsc_the_product_id(), __( 'Buy Now', ETHEME_DOMAIN ) ); ?></span></button>

												<?php else: ?>
	                                                <?php if (wpsc_have_variation_groups()) { ?>
	                                                    <a href="<?php echo wpsc_the_product_permalink(); ?>" class="button"><span><?php _e('Read More', ETHEME_DOMAIN); ?></span></a>
	                        						<?php }else { ?>
	                        						  <button class="button" type="submit" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"><span><?php _e('Add To Cart', ETHEME_DOMAIN); ?></span></button>
	                        						<?php } ?>


												<?php endif; ?>

											<div class="wpsc_loading_animation">
												<img title="Loading" alt="Loading" src="<?php echo wpsc_loading_animation_url(); ?>" />
												<?php _e('Updating cart...', ETHEME_DOMAIN); ?>
											</div><!--close wpsc_loading_animation-->
										</div><!--close wpsc_buy_button_container-->
									<?php endif ; ?>
								<?php endif ; ?>
							<?php endif; ?>
                            <div class="clear"></div>
							<div class="entry-utility wpsc_product_utility">
								<?php edit_post_link( __( 'Edit', ETHEME_DOMAIN ), '<span class="edit-link">', '</span>' ); ?>
							</div>
							<?php do_action ( 'wpsc_product_form_fields_end' ); ?>
						</form><!--close product_form-->

						<?php if((get_option('hide_addtocart_button') == 0) && (get_option('addtocart_or_buynow')=='1')) : ?>
							<?php echo wpsc_buy_now_button(wpsc_the_product_id()); ?>
						<?php endif ; ?>

						<?php // echo wpsc_product_rater(); ?>


					<?php // */ ?>
			<?php if(wpsc_product_on_special()) : ?><!--span class="sale"><?php _e('Sale', ETHEME_DOMAIN); ?></span--><?php endif; ?>
		</div><!--close default_product_display-->


		<?php endwhile; ?>
		<?php /** end the product loop here */?>
		</div><?php /** END of products-grid */ ?>
        <div class="clear"></div>
		<?php if(wpsc_product_count() == 0):?>
			<h3><?php  _e('There are no products in this group.', ETHEME_DOMAIN); ?></h3>
        <?php else: ?>
            <div class="toolbar bottom" >
        		<?php if(wpsc_has_pages_bottom()) : ?>
                    <div class="pagintaion">
                    	<?php if (is_search()): ?>
                    		<?php etheme_search_pagination(); ?>
                    	<?php else: ?>
                    		<?php etheme_pagination(); ?>
                    	<?php endif; ?>	
                    </div>
        		<?php endif; ?>
                <?php if($view_mode == 'grid_list'): ?>
                    <p class="view-mode">
                        <label><?php _e('View as:', ETHEME_DOMAIN); ?></label>
                        <span class="switcher switchToList <?php if($view_mode_default == 'list') echo 'default_mode' ?>"><?php _e('List', ETHEME_DOMAIN); ?></span>
                        <span class="switcher switchToGrid <?php if($view_mode_default == 'grid') echo 'default_mode' ?>"><?php _e('Grid', ETHEME_DOMAIN); ?></span>
                    </p>
                <?php endif ;?>
                <div class="clear"></div>
            </div>
		<?php endif ; ?>
	    <?php do_action( 'wpsc_theme_footer' ); ?>

        <script type="text/javascript">
        if(jQuery.cookie('products_page') == 'grid') {
            jQuery('#products-grid').removeClass('products_list').addClass('products_grid');
            jQuery('.switchToGrid').addClass('active_switcher');
        }else if(jQuery.cookie('products_page') == 'list') {
            jQuery('#products-grid').removeClass('products_grid').addClass('products_list');
            jQuery('.switchToList').addClass('active_switcher');
        }else{
            jQuery('.<?php if($view_mode_default == 'grid') echo 'switchToGrid'; if($view_mode_default == 'list') echo 'switchToList'; ?>').addClass('active_switcher');
        }
        </script>
	<?php endif; ?>
</div><!--close default_products_page_container-->

<?php if($blog_sidebar_mobile=='bottom'): ?>
    <?php if($product_sidebar) : ?>
    	<div id="products-sidebar" class="main-products-sidebar">
    		<?php if ( is_active_sidebar( 'product-widget-area' ) ) : ?>
    			<?php dynamic_sidebar( 'product-widget-area' ); ?>
            <?php else: ?>
                <?php etheme_get_categories_menu(); ?>
    		<?php endif; ?>
    	</div>
    <?php endif; ?>
<?php endif; ?>
<div class="clear"></div>
<script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>
