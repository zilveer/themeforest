<?php
/*-----------------------------------------------------------------------------------*/
# Clean options before store it in DB
/*-----------------------------------------------------------------------------------*/

add_action('save_post', 'tie_save_builder');
function tie_save_builder( $post_id ){
	global $post;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
		
	if (isset( $_POST['tie_hidden_flag'] )) {

		$custom_meta_fields = array(
			'home_exc_length',
			'box_meta_score',
			'box_meta_author',
			'box_meta_date',
			'box_meta_cats',
			'box_meta_comments',
			'box_meta_views',
			'featured_posts',
			'featured_auto',
			'featured_posts_speed',
			'featured_posts_time',
			'featured_posts_number',
			'featured_posts_query',
			'featured_posts_tag',
			'featured_posts_posts',
			'featured_posts_pages',
			'featured_posts_custom',
			'slider',
			'slider_type',
			'elastic_slider_effect',
			'elastic_slider_autoplay',
			'elastic_slider_interval',
			'elastic_slider_speed',
			'flexi_slider_effect',
			'flexi_slider_speed',
			'flexi_slider_time',
			'slider_caption',
			'slider_caption_length',
			'slider_pos',
			'slider_number',
			'slider_query',
			'slider_tag',
			'slider_posts',
			'slider_pages',
			'slider_custom',
			'slider_cat',
			'featured_posts_cat',
		);
				
		foreach( $custom_meta_fields as $custom_meta_field ){
			if( isset( $_POST[$custom_meta_field] ) && !empty( $_POST[ $custom_meta_field] ) ){
				$custom_meta_field_data = $_POST[$custom_meta_field];
				if( is_array( $custom_meta_field_data ) ){
					$custom_meta_field_data		= array_filter( $custom_meta_field_data );
					if( !empty( $custom_meta_field_data ) ){
						update_post_meta( $post_id, $custom_meta_field, $custom_meta_field_data );
					}else{
						delete_post_meta( $post_id, $custom_meta_field );
					}
				}else{
					if( !empty( $custom_meta_field_data ) ){
						update_post_meta( $post_id, $custom_meta_field, htmlspecialchars(stripslashes( $custom_meta_field_data )) );
					}else{
						delete_post_meta( $post_id, $custom_meta_field );
					}
				}
			}else{
				delete_post_meta( $post_id, $custom_meta_field );
			}
		}
				
		//Builder	
		if ( isset( $_POST['tie_builder_active'] ) && !empty( $_POST['tie_builder_active'] ) && $_POST['tie_builder_active'] == 'yes' ) {
			update_post_meta( $post_id, 'tie_builder_active' , 'yes' );
		}else{
			delete_post_meta( $post_id, 'tie_builder_active' );
		}
	
		if( isset( $_POST['tie_home_cats'] ) && !empty( $_POST['tie_home_cats'] ) ){
		
			array_walk_recursive( $_POST['tie_home_cats'] , 'tie_clean_options');
			update_post_meta( $post_id, 'tie_builder' , $_POST[ 'tie_home_cats' ] );

			
			if(  function_exists('icl_register_string') ){
				foreach(  $_POST[ 'tie_home_cats' ] as $item ){
					if( !empty($item['boxid']) )
						icl_register_string( THEME_NAME , 'wpml-'.$page_id.'-'.$item['boxid'], $item['title'] );

					if( !empty($item['type']) && $item['type'] == 'ads' && !empty($item['boxid']) )
						icl_register_string( THEME_NAME , 'wpml-'.$page_id.'-'.$item['boxid'], $item['text'] );
				}
			}			
		}
		else{
			delete_post_meta($post_id, 'tie_builder' );
		}
	}
}


add_action('edit_form_after_title', 'tie_add_builder_pages');
function tie_add_builder_pages() {
	global $post;
	$builder_active = false;
	$screen = get_current_screen();
	
	if( get_post_type ( $post->ID ) != 'page' || $screen->post_type != 'page' )	{
		return;
	}
	
	$get_meta = get_post_custom($post->ID);
	
	if( isset( $get_meta[ 'tie_builder' ][0] ) ){
		$cats = false;
		if( !empty( $get_meta[ 'tie_builder' ][0] ) ){
			$cats = $get_meta[ 'tie_builder' ][0]; 
			if( is_serialized( $cats ) )
				$cats = unserialize ( $cats );
		}
	}
	
	//Categories
	$categories_obj = get_categories('hide_empty=0');
	$categories 	= array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}
	
	//WooCommerce
	if( function_exists( 'is_woocommerce' ) ){
		$products_obj 	= get_categories( array( 'hide_empty'	=>	0,	'taxonomy'     => 'product_cat' ) );
		$products_cats 	= array();
		foreach ($products_obj as $products) {
			$products_cats[$products->cat_ID] = $products->cat_name;
		}
	}
	
	//Sliders
	$original_post = $post;
	
	$sliders = array();
	$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
	while ( $custom_slider->have_posts() ) {
		$custom_slider->the_post();
		$sliders[get_the_ID()] = get_the_title();
	}

	$post = $original_post;
	wp_reset_query();

	$checked = 'checked="checked"';
	
	if(  !empty( $get_meta[ 'tie_builder_active' ][0] ) ) $builder_active = 'yes' ;
?>

	<a class="button button-large<?php if( !empty( $builder_active ) ) echo ' button-primary builder_active'?>" href="" id="tie_page_builder"><?php _e( 'Page Builder', 'tie' ) ?></a>
	<input type="hidden" id="tie_builder_active" name="tie_builder_active" value="<?php echo $builder_active ?>" />


	<script type="text/javascript">
		var emptyImg = '<?php echo get_template_directory_uri(); ?>/framework/admin/images/empty.png';	  
				
		jQuery(function() {
			jQuery( "#cat_sortable" ).sortable({placeholder: "ui-state-highlight"});
			jQuery( ".tabs_cats"    ).sortable({placeholder: "ui-state-highlight"});
		});
	</script>
	
		<div id="Home_Builder" <?php if( !empty( $builder_active ) ) echo ' style="display:block;"'?>>

			<div class="tiepanel-item">
				<h3><?php _e( 'Page Builder', 'tie' ) ?>
					<a id="collapse-all"><?php _e( '[-] Collapse All', 'tie' ) ?></a>
					<a id="expand-all"><?php _e( '[+] Expand All', 'tie' ) ?></a>
				</h3>
				<div class="option-item">

					<select style="display:none" id="cats_default">
						<?php foreach ($categories as $key => $option) { ?>
						<option value="<?php echo $key ?>"><?php echo $option; ?></option>
						<?php } ?>
					</select>
					
				<?php if( function_exists( 'is_woocommerce' ) && is_array( $products_cats ) ): ?>
					<select style="display:none" id="products_default">
						<?php foreach ($products_cats as $key => $option) { ?>
						<option value="<?php echo $key ?>"><?php echo $option; ?></option>
						<?php } ?>
					</select>
				<?php endif; ?>
				
					<div style="clear:both"></div>
					<div class="home-builder-buttons">
						<a class="add-cat tooltip" title="<?php _e( 'Category Block | Layout 1', 'tie' ) ?>" data-style="li"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/li.png" /></a>
						<a class="add-cat tooltip" title="<?php _e( 'Category Block | Layout 2', 'tie' ) ?>" data-style="1c"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/1c.png" /></a>
						<a class="add-cat tooltip" title="<?php _e( 'Category Block | Layout 3', 'tie' ) ?>" data-style="2c"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/2c.png" /></a>
						<a id="add-slider" class="tooltip" title="<?php _e( 'Scrolling Block', 'tie' ) ?>"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/scrolling.png" /></a>
						<a class="add-news-picture tooltip" title="<?php _e( 'News in Picture Block | Default Layout', 'tie' ) ?>" data-style="default"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/news-in-pic1.png" /></a>
						<a class="add-news-picture tooltip" title="<?php _e( 'News in Picture Block | Grid Layout', 'tie' ) ?>" data-style="row"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/news-in-pic2.png" /></a>
						<a id="add-news-videos" class="tooltip" title="<?php _e( 'Videos Block', 'tie' ) ?>"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/videos.png" /></a>
						<a class="add-recent tooltip" title="<?php _e( 'Recent Posts | Default Layout', 'tie' ) ?>" data-style="default"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/recent1.png" /></a>
						<a class="add-recent tooltip" title="<?php _e( 'Recent Posts | Big Thumbnail Layout', 'tie' ) ?>" data-style="full_thumb"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/recent2.png" /></a>
						<a class="add-recent tooltip" title="<?php _e( 'Recent Posts | Blog Layout', 'tie' ) ?>" data-style="blog"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/recent3.png" /></a>
						<a class="add-recent tooltip" title="<?php _e( 'Recent Posts | Post Content Layout', 'tie' ) ?>" data-style="content"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/recent4.png" /></a>
						<a class="add-recent tooltip" title="<?php _e( 'Recent Posts | Masonry Layout', 'tie' ) ?>" data-style="masonry"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/recent5.png" /></a>
						<a class="add-recent tooltip" title="<?php _e( 'Recent Posts | Timeline Layout', 'tie' ) ?>" data-style="timeline"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/recent6.png" /></a>
						<a id="add-tabs" class="tooltip" title="<?php _e( 'Categories Tabs', 'tie' ) ?>"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/tabs.png" /></a>
						<a id="add-ads" class="tooltip" title="<?php _e( 'Text or HTML Code', 'tie' ) ?>"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/text-html.png" /></a>
							
							<?php if( function_exists( 'is_woocommerce' ) ){ ?>
						<a id="add-products" class="tooltip" title="<?php _e( 'WooCommerce', 'tie' ) ?>"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/wooCommerce.png" /></a>
							<?php } ?>
							
					</div>
										
					<ul id="cat_sortable">
						<?php
							$i=0;
							if( !empty( $cats ) && is_array( $cats ) ){
								foreach ($cats as $cat) { 
									$i++;
									?>
									<li id="listItem_<?php echo $i ?>" class="ui-state-default">
			
								<?php 
									if( $cat['type'] == 'n' ) :	?>
										<div class="widget-head"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/<?php echo $cat['style']; ?>-small.png" /> <?php _e( 'Category Block:', 'tie' ) ?><?php if( !empty($cat['id']) ) echo get_the_category_by_ID( $cat['id'] ); ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span><?php _e( 'Category:', 'tie' ) ?></span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label><span><?php _e( 'Posts Order:', 'tie' ) ?></span><select name="tie_home_cats[<?php echo $i ?>][order]" id="tie_home_cats[<?php echo $i ?>][order]"><option value="latest" <?php if( $cat['order'] == 'latest' || $cat['order']=='' ) echo 'selected="selected"'; ?>><?php _e( 'Latest Posts', 'tie' ) ?></option><option  <?php if( $cat['order'] == 'rand' ) echo 'selected="selected"'; ?> value="rand"><?php _e( 'Random Posts', 'tie' ) ?></option></select></label>
											<label for="tie_home_cats[<?php echo $i ?>][number]"><span><?php _e( 'Number of posts to show:', 'tie' ) ?></span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php  if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span><?php _e( 'Offset - number of posts to pass over:', 'tie' ) ?></span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											
											<label for="tie_home_cats[<?php echo $i ?>][thumb_first]"><span><?php _e( 'Hide thumbnail for the First post', 'tie' ) ?></span>
												<input class="on-of" type="checkbox" name="tie_home_cats[<?php echo $i ?>][thumb_first]" value="true"  <?php if ( !empty( $cat['thumb_first'] ) ) { echo ' checked="checked"' ; } ?> />			
											</label>
											
											<label for="tie_home_cats[<?php echo $i ?>][thumb_small]"><span><?php _e( 'Hide all small thumbnails', 'tie' ) ?></span>
												<input class="on-of" type="checkbox" name="tie_home_cats[<?php echo $i ?>][thumb_small]" value="true"  <?php if ( !empty( $cat['thumb_small'] ) ) { echo ' checked="checked"' ; } ?> />			
											</label>
											
											<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="hidden" value="<?php echo $cat['style'] ?>" />

								<?php 
									elseif( $cat['type'] == 'recent' ) :	?>
										<div class="widget-head"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/recent-<?php echo $cat['display']; ?>-small.png" /><?php _e( 'Recent Posts', 'tie' ) ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span class="option-contents"><?php _e( 'Exclude These Categories:', 'tie' ) ?></span><select multiple="multiple" name="tie_home_cats[<?php echo $i ?>][exclude][]" id="tie_home_cats[<?php echo $i ?>][exclude][]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $cat['exclude'] ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span><?php _e( 'Title:', 'tie' ) ?></span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php   if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][number]"><span><?php _e( 'Number of posts to show:', 'tie' ) ?></span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php   if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span><?php _e( 'Offset - number of posts to pass over:', 'tie' ) ?></span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php   if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>

											<label for="tie_home_cats[<?php echo $i ?>][pagi]"><span><?php _e( 'Show Pagination', 'tie' ) ?></span>
												<input class="on-of" type="checkbox" name="tie_home_cats[<?php echo $i ?>][pagi]" value="true"  <?php if ( !empty( $cat['pagi'] ) ) { echo ' checked="checked"' ; } ?> />			
											</label>
											
										<?php if ( $cat['display'] != 'default' ): ?>
											<label for="tie_home_cats[<?php echo $i ?>][share]"><span><?php _e( 'Show Social Buttons', 'tie' ) ?></span>
												<input class="on-of" type="checkbox" name="tie_home_cats[<?php echo $i ?>][share]" value="true"  <?php if ( !empty( $cat['share'] ) ) { echo ' checked="checked"' ; } ?> />			
											</label>
										<?php endif; ?>
										
											<p class="tie_message_hint"><?php _e( 'WordPress WARNING: Setting the offset option breaks pagination, disable the pagination option if you want to use the offset option.', 'tie' ) ?></p>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
											<input id="tie_home_cats[<?php echo $i ?>][display]" name="tie_home_cats[<?php echo $i ?>][display]" type="hidden" value="<?php echo $cat['display'] ?>" />

								<?php 
									elseif( $cat['type'] == 'tabs' ) :	?>
										<div class="widget-head"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/tabs-small.png" /><?php _e( 'Categories Tabs Block', 'tie' ) ?> 
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
					
										<?php
											if( !empty ( $cat['cat'] ) )
												$tie_home_tabs = $cat['cat'] ;
											else 
												$tie_home_tabs = array();
											
											$tie_home_tabs_new = array();					
											
											foreach ($tie_home_tabs as $key1 => $option1) {
												if ( array_key_exists( $option1 , $categories) )
													$tie_home_tabs_new[$option1] = $categories[$option1];
											}
											foreach ($categories as $key2 => $option2) {
												if ( !in_array( $key2 , $tie_home_tabs) )
													$tie_home_tabs_new[$key2] = $option2;
											}
										?>
											
											<span class="label"><?php _e( 'Choose Categories:', 'tie' ) ?></span>
											<div class="clear"></div> <p></p>
											<ul class="tabs_cats">
												<?php foreach ($tie_home_tabs_new as $key => $option) { ?>
												<li><input name="tie_home_cats[<?php echo $i ?>][cat][]" type="checkbox" <?php if ( in_array( $key , $tie_home_tabs) ) { echo ' checked="checked"' ; } ?> value="<?php echo $key ?>">
												<span><?php echo $option; ?></span></li>
												<?php } ?>
											</ul>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
								
								<?php 
									elseif( $cat['type'] == 'woocommerce' && function_exists( 'is_woocommerce' ) ) :	?>
										<div class="widget-head"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/woo-small.png" /><?php _e( 'WooCommerce', 'tie' ) ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span class="option-contents"><?php _e( 'Products Categories:', 'tie' ) ?></span><select multiple="multiple" name="tie_home_cats[<?php echo $i ?>][cats][]" id="tie_home_cats[<?php echo $i ?>][cats][]">
												<?php
											if( is_array( $products_cats ) ){
												foreach ($products_cats as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $cat['cats'] ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php 
												}
											}?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span><?php _e( 'Title:', 'tie' ) ?></span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php   if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][number]"><span><?php _e( 'Number of Products to show:', 'tie' ) ?></span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php   if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span><?php _e( 'Offset - number of Products to pass over:', 'tie' ) ?></span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php   if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][display]"><span><?php _e( 'Display Mode:', 'tie' ) ?></span>
												<select id="tie_home_cats[<?php echo $i ?>][display]" name="tie_home_cats[<?php echo $i ?>][display]">
													<option value="default" <?php if ( $cat['display'] == 'default') { echo ' selected="selected"' ; } ?>><?php _e( 'Default', 'tie' ) ?></option>
													<option value="scrolling" <?php if ( $cat['display'] == 'scrolling') { echo ' selected="selected"' ; } ?>><?php _e( 'Scrolling', 'tie' ) ?></option>
												</select>
											</label>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
											
											<input id="tie_home_cats[<?php echo $i ?>][type]" name="tie_home_cats[<?php echo $i ?>][type]" value="<?php  echo $cat['type']  ?>" type="hidden" />
											<a class="del-cat"></a>
										</div>
										
									<?php elseif( $cat['type'] == 's' ) : ?>
										<div class="widget-head scrolling-box"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/scrolling-small.png" /><?php _e( 'Scrolling Block:', 'tie' ) ?><?php if( !empty($cat['id']) ) echo get_the_category_by_ID( $cat['id'] ); ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span><?php _e( 'Category:', 'tie' ) ?></span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span><?php _e( 'Title:', 'tie' ) ?></span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php   if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][number]"><span><?php _e( 'Number of posts to show:', 'tie' ) ?></span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php   if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span><?php _e( 'Offset - number of posts to pass over:', 'tie' ) ?></span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php   if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
									
									<?php elseif( $cat['type'] == 'ads' ) : ?>
										<div class="widget-head e3lan-box"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/code-small.png" /><?php _e( 'Text or HTML', 'tie' ) ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<textarea cols="36" rows="5" name="tie_home_cats[<?php echo $i ?>][text]" id="tie_home_cats[<?php echo $i ?>][text]"><?php  if( !empty($cat['text']) ) echo stripslashes($cat['text']) ; ?></textarea>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
											<small><?php _e( 'Supports: Text, HTML and Shortcodes.', 'tie' ) ?></small>

										
									<?php elseif( $cat['type'] == 'news-pic' ) : ?>
										<div class="widget-head news-pic-box"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/pic-<?php echo $cat['style']; ?>-small.png" /><?php _e( 'News in Picture', 'tie' ) ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span><?php _e( 'Category:', 'tie' ) ?></span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span><?php _e( 'Title:', 'tie' ) ?></span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span><?php _e( 'Offset - number of posts to pass over:', 'tie' ) ?></span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
											<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="hidden" value="<?php echo $cat['style'] ?>" />

								<?php elseif( $cat['type'] == 'videos' ) : ?>
										<div class="widget-head news-pic-box"><?php _e( 'Videos', 'tie' ) ?> <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/videos-small.png" /> 
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span><?php _e( 'Category:', 'tie' ) ?></span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span><?php _e( 'Title:', 'tie' ) ?></span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php if( !empty($cat['title']) )  echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span><?php _e( 'Offset - number of posts to pass over:', 'tie' ) ?></span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  if( !empty($cat['offset']) )  echo $cat['offset']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][lightbox]"><span><?php _e( 'Videos Lightbox', 'tie' ) ?></span>
												<input class="on-of" type="checkbox" name="tie_home_cats[<?php echo $i ?>][lightbox]" value="true"  <?php if ( !empty( $cat['lightbox'] ) ) { echo ' checked="checked"' ; } ?> />			
											</label>
											<p class="tie_message_hint"><?php _e( 'Videos Lightbox option working with YouTube and Vimeo videos only.', 'tie' ) ?></p>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
												
									<?php endif; ?>
									
										<?php if( $cat['type'] != 'divider' && $cat['type'] != 'woocommerce' ) : ?>
											<input id="tie_home_cats[<?php echo $i ?>][type]" name="tie_home_cats[<?php echo $i ?>][type]" value="<?php  echo $cat['type']  ?>" type="hidden" />
											<a class="del-cat"></a>
										</div>
										<?php endif; ?>
									</li>
							<?php } 
							} else{?>
							<?php } ?>
					</ul>

					<script>
						var nextCell = <?php echo $i+1 ?> ;
						var templatePath =' <?php echo get_template_directory_uri(); ?>';
						var categoriesTabs = {
						<?php foreach ($categories as $key => $option) { ?>
							"<?php echo $key ?>" : "<?php echo htmlspecialchars ( $option ) ?>",
						<?php } ?>
						};
					</script>
				</div>	
			</div>

			<div class="tiepanel-item">
				<h3><?php _e( 'Blocks Settings', 'tie' ) ?></h3>
				<?php
					tie_post_meta_box(
						array( 	"name"			=> __( 'First News Excerpt Length', 'tie' ),
								"id"			=> "home_exc_length",
								"default"		=> "15",
								"type"			=> "short-text"));	
								
					tie_post_meta_box(
						array(	"name"			=>  __( 'Review Score', 'tie' ),
								"id"			=> "box_meta_score",
								"type"			=> "checkbox" )); 	
								
					tie_post_meta_box(
						array(	"name"			=>  __( 'Author Meta', 'tie' ),
								"id"			=> "box_meta_author",
								"type"			=> "checkbox",
								"extra_text"	=>  __( 'This option not applied on Scrolling blocks and Recent posts Default Style .', 'tie' ))); 		
								
					tie_post_meta_box(
						array(	"name"			=>  __( 'Date Meta', 'tie' ),
								"id"			=> "box_meta_date",
								"type"			=> "checkbox"));
								
					tie_post_meta_box(
						array(	"name"			=>  __( 'Categories Meta', 'tie' ),
								"id"			=> "box_meta_cats",
								"type"			=> "checkbox",
								"extra_text"	=>  __( 'This option not applied on Scrolling blocks and Recent posts Default Style .', 'tie' ))); 		
								
					tie_post_meta_box(
						array(	"name"			=>  __( 'Comments Meta', 'tie' ),
								"id"			=> "box_meta_comments",
								"type"			=> "checkbox",
								"extra_text"	=>  __( 'This option not applied on Scrolling blocks and Recent posts Default Style .', 'tie' ))); 		
								
					tie_post_meta_box(
						array(	"name"			=>  __( 'Views Meta', 'tie' ),
								"id"			=> "box_meta_views",
								"type"			=> "checkbox",
								"extra_text"	=>  __( 'This option not applied on Scrolling blocks and Recent posts Default Style .', 'tie' ))); 		
				?>
			</div>	
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Grid Featured Posts', 'tie' ) ?></h3>
				<?php
					tie_post_meta_box(
						array(	"name"	=>  __( 'Enable', 'tie' ),
								"id"	=> "featured_posts",
								"type"	=> "checkbox"));

					tie_post_meta_box(
						array(	"name"	=>  __( 'Animate Automatically', 'tie' ),
								"id"	=> "featured_auto",
								"type"	=> "checkbox")); 
		
								
					tie_post_meta_box(
						array(	"name"		=>  __( 'Slideshow Speed', 'tie' ),
								"id"		=> "featured_posts_speed",
								"type"		=> "slider",
								"unit"		=> "ms",
								"default"	=> 7000,
								"max" 		=> 40000,
								"min" 		=> 100 ));

					tie_post_meta_box(
						array(	"name"		=>  __( 'Animation Speed', 'tie' ),
								"id"		=> "featured_posts_time",
								"type"		=> "slider",
								"unit"		=> "ms",
								"default"	=> 600,
								"max"		=> 40000,
								"min"		=> 100 ));

					tie_post_meta_box(
						array(	"name"		=>  __( 'Number of posts to show', 'tie' ),
								"id"		=> "featured_posts_number",
								"type"		=> "select",
								"options"	=> array(	5	=> 5 ,
														10	=> 10,
														15	=> 15,
														20	=> 20,
														25	=> 25,
														30	=> 30 )));
								
					tie_post_meta_box(
						array(	"name"		=>  __( 'Query Type', 'tie' ),
								"id"		=> "featured_posts_query",
								"type"		=> "radio",
								"options"	=> array(	"category"	=> __( 'Category', 'tie' ) ,
														"tag"		=> __( 'Tag', 'tie' ),
														"post"		=> __( 'Selective Posts', 'tie' ),
														"page"		=> __( 'Selective Pages', 'tie' ),
														"custom"	=> __( 'Custom Slider', 'tie' ) ))); 
								
					tie_post_meta_box(
						array(	"name"		=>  __( 'Tags', 'tie' ),
								"help"		=>  __( 'Enter a tag name, or names separated by comma.', 'tie' ),
								"id"		=> "featured_posts_tag",
								"type"		=> "text"));

	
					if( isset( $get_meta[ 'featured_posts_cat' ][0] ) ){
						$featured_posts_cat = false;
						if( !empty( $get_meta[ 'featured_posts_cat' ][0] ) ){
							$featured_posts_cat = $get_meta[ 'featured_posts_cat' ][0]; 
							if( is_serialized( $featured_posts_cat ) )
								$featured_posts_cat = unserialize ( $featured_posts_cat );
						}	
					} ?>
					<div class="option-item" id="featured_posts_cat-item">
						<span class="label"><?php _e( 'Category', 'tie' ) ?>
						<br /><small><?php _e( 'Hold CTRL while selecting to select multiple categories.', 'tie' ) ?></small>
						</span>
						<select multiple="multiple" name="featured_posts_cat[]" id="tie_slider_cat">
							<?php foreach ($categories as $key => $option) { ?>
								<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $featured_posts_cat ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
							<?php } ?>
						</select>
					</div>
					
			<?php
																
					tie_post_meta_box(
						array(	"name"	=>  __( 'Selective Posts IDs', 'tie' ),
								"help"	=>  __( 'Enter a post ID, or IDs separated by comma.', 'tie' ),
								"id"	=>	"featured_posts_posts",
								"type"	=> "text"));
								
					tie_post_meta_box(
						array(	"name"	=>  __( 'Selective Pages IDs', 'tie' ),
								"help"	=>  __( 'Enter a page ID, or IDs separated by comma.', 'tie' ),
								"id"	=> "featured_posts_pages",
								"type"	=> "text"));	
								
					tie_post_meta_box(
						array(	"name"		=>  __( 'Custom Slider', 'tie' ),
								"help"		=>  __( 'Choose your custom slider', 'tie' ),
								"id"		=> "featured_posts_custom",
								"type"		=> "select",
								"options"	=> $sliders));
			?>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Slider Settings', 'tie' ) ?></h3>
				<?php
					tie_post_meta_box(
						array(	"name"	=> __( 'Enable', 'tie' ),
								"id"	=> "slider",
								"type"	=> "checkbox")); 
		
					tie_post_meta_box(
						array(	"name"		=> __( 'Slider Type', 'tie' ),
								"id"		=> "slider_type",
								"type"		=> "radio",
								"options"	=> array(	"flexi"		=> __( 'FlexSlider', 'tie' ) ,
														"elastic"	=> __( 'Elastic Slideshow', 'tie' ) ))); 
				?>
				<div id="elastic">
					<?php
						tie_post_meta_box(
							array(	"name"		=> __( 'Animation Effect', 'tie' ),
									"id"		=> "elastic_slider_effect",
									"type"		=> "select",
									"options"	=> array(
													'center'	=> __( 'Center', 'tie' ),
													'sides'		=> __( 'Sides', 'tie' )	)));

						tie_post_meta_box(
							array(	"name"	=> __( 'Autoplay', 'tie' ),
									"id"	=> "elastic_slider_autoplay",
									"type"	=> "checkbox"));
						
						
						tie_post_meta_box(
							array(	"name"		=> __( 'Slideshow Speed', 'tie' ),
									"id"		=> "elastic_slider_interval",
									"type"		=> "slider",
									"unit"		=> "ms",
									"default"	=> 3000,
									"max"		=> 40000,
									"min"		=> 100 ));

						tie_post_meta_box(
							array(	"name"		=> __( 'Animation Speed', 'tie' ),
									"id"		=> "elastic_slider_speed",
									"type"		=> "slider",
									"unit"		=> "ms",
									"default"	=> 800,
									"max"		=> 40000,
									"min"		=> 100 ));
					?>
				</div>

				<div id="flexi">
					<?php
						tie_post_meta_box(
							array(	"name"		=> __( 'Animation Effect', 'tie' ),
									"id"		=> "flexi_slider_effect",
									"type"		=> "select",
									"options"	=> array(
														'fade'		=> __( 'Fade', 'tie' ),
														'slideV'	=> __( 'Slide Vertical', 'tie' ),
														'slideH'	=> __( 'Slide Horizontal', 'tie' ))));
						
						tie_post_meta_box(
							array(	"name"		=> __( 'Slideshow Speed', 'tie' ),
									"id"		=> "flexi_slider_speed",
									"type"		=> "slider",
									"unit"		=> "ms",
									"default"	=> 7000,
									"max"		=> 40000,
									"min"		=> 100 ));

						tie_post_meta_box(
							array(	"name"		=> __( 'Animation Speed', 'tie' ),
									"id"		=> "flexi_slider_time",
									"type"		=> "slider",
									"unit"		=> "ms",
									"default"	=> 600,
									"max"		=> 40000,
									"min"		=> 100 ));
					?>
				</div>
				<?php
					tie_post_meta_box(
						array(	"name"	=> __( 'Show Slides Caption', 'tie' ),
								"id"	=> "slider_caption",
								"type"	=> "checkbox")); 

					tie_post_meta_box(
						array(	"name"		=> __( 'Slides Caption Length', 'tie' ),
								"id"		=> "slider_caption_length",
								"default"	=> 100,
								"type"		=> "short-text"));
								
				?>
				<div class="option-item">
					<span class="label"><?php _e( 'Slider Position', 'tie' ); ?></span>
					<div class="option-contents">
						<?php
							$tie_slider_pos = '';
							if( !empty($get_meta[ 'slider_pos' ][0]) )
								$tie_slider_pos = $get_meta[ 'slider_pos' ][0];
						?>
						<ul id="slider-position-options" class="tie-options">
							<li>
								<input name="slider_pos" type="radio" value="small" <?php if( ( !empty( $tie_slider_pos ) && $tie_slider_pos == 'small' ) || empty( $tie_slider_pos ) ) echo $checked; ?> />
								<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/small-slider.png" /></a>
							</li>
							<li>
								<input name="slider_pos" type="radio" value="big" <?php if( !empty( $tie_slider_pos ) && $tie_slider_pos == 'big') echo $checked; ?> />
								<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/big-slider.png" /></a>
							</li>
						</ul>
					</div>
				</div>
				
			<?php
					tie_post_meta_box(
						array(	"name"		=> __( 'Number of posts to show', 'tie' ),
								"id"		=> "slider_number",
								"default"	=> 5,
								"type"		=> "short-text"));
								
					tie_post_meta_box(
						array(	"name"		=> __( 'Query Type', 'tie' ),
								"id"		=> "slider_query",
								"type"		=> "radio",
								"options"	=> array(	"category"	=> __( 'Category', 'tie' ) ,
														"tag"		=> __( 'Tag', 'tie' ),
														"post"		=> __( 'Selective Posts', 'tie' ),
														"page"		=> __( 'Selective Pages', 'tie' ),
														"custom"	=> __( 'Custom Slider', 'tie' ) ))); 
								
					tie_post_meta_box(
						array(	"name"	=> __( 'Tags', 'tie' ),
								"help"	=> __( 'Enter a tag name, or names separated by comma.', 'tie' ),
								"id"	=> "slider_tag",
								"type"	=> "text"));
			
				
					if( isset( $get_meta[ 'slider_cat' ][0] ) ){
						$slider_cat = false;
						if( !empty( $get_meta[ 'slider_cat' ][0] ) ){
							$slider_cat = $get_meta[ 'slider_cat' ][0]; 
							if( is_serialized( $slider_cat ) )
								$slider_cat = unserialize ( $slider_cat );
						}	
					} ?>
					
					<div class="option-item" id="slider_cat-item">
						<span class="label"><?php _e( 'Category', 'tie' ) ?>
							<br /><small><?php _e( 'Hold CTRL while selecting to select multiple categories.', 'tie' ) ?></small>
						</span>
							<select multiple="multiple" name="slider_cat[]" id="tie_slider_cat">
							<?php foreach ($categories as $key => $option) { ?>
								<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $slider_cat ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
							<?php } ?>
						</select>
					</div>
					
			<?php
																
					tie_post_meta_box(
						array(	"name"	=> __( 'Selective Posts IDs', 'tie' ),
								"help"	=> __( 'Enter a post ID, or IDs separated by comma.', 'tie' ),
								"id"	=> "slider_posts",
								"type"	=> "text"));
								
					tie_post_meta_box(
						array(	"name"	=> __( 'Selective Pages IDs', 'tie' ),
								"help"	=> __( 'Enter a page ID, or IDs separated by comma.', 'tie' ),
								"id"	=> "slider_pages",
								"type"	=> "text"));	
								
					tie_post_meta_box(
						array(	"name"		=> __( 'Custom Slider', 'tie' ),
								"help"		=> __( 'Choose your custom slider', 'tie' ),
								"id"		=> "slider_custom",
								"type"		=> "select",
								"options"	=> $sliders));
			?>
			
			</div>
			
		</div>
	<?php 
	}
?>