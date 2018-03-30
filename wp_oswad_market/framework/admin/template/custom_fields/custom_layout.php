<?php
	/* Add custom layout for post, portfolio */
	global $post,$single_prod_datas;
	$single_product_config = get_option(THEME_SLUG.'single_product_config','');
	$single_product_config = unserialize($single_product_config);
		
	
	$custom_sidebar_str = get_option(THEME_SLUG.'areas');
	if($custom_sidebar_str)
		$custom_sidebar_arr = json_decode($custom_sidebar_str);
	else
		$custom_sidebar_arr = array();	
	
	$datas = wd_array_atts(
		array(
					'show_image' 				=> 1
					,'show_label' 				=> 1
					,'show_title' 				=> 1
					,'show_sku' 				=> 1
					,'show_review'				=> 1
					,'show_availability' 		=> 1
					,'show_add_to_cart' 		=> 1
					,'show_price' 				=> 1
					,'show_short_desc' 			=> 1
					,'show_meta' 				=> 1
					,'show_related' 			=> 1
					,'related_title' 			=> __("Related Products","wpdance")
					,'show_sharing' 			=> 1
					,'sharing_title' 			=> "Share this"
					,'sharing_intro' 			=> "Love it?Share with your friend"
					,'sharing_custom_code' 		=> ""
					,'show_ship_return' 		=> 1				
					,'ship_return_title' 		=> 'FREE SHIPPING & RETURN'	
					,'ship_return_content' 		=>  htmlentities('<a href="#"><img src="http://demo.wpdance.com/imgs/woocommerce/return_shipping.png" alt="free shipping and return" title="free shipping and return"></a><div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry'."'".'s standard dummy text ever since the 1500s</div>')
					,'show_tabs' 				=> 1
					,'show_custom_tab' 			=> 1	
					,'custom_tab_title' 		=> "Custom Tabs Title"				
					,'custom_tab_content' 		=> "<div>Table content goes here</div>"				
					,'show_upsell' 				=> 1
					,'upsell_title'				=> __("YOU MAY ALSO BE INTERESTED IN THE FOLLOWING PRODUCT(S)",'wpdance')
					,'layout' 					=> '0-1-0'
					,'left_sidebar' 			=> 'product-widget-area-left'
					,'right_sidebar' 			=> 'product-widget-area-right'
			)
		,$single_product_config);	
	
	$_prod_config = get_post_meta($post->ID,THEME_SLUG.'custom_product_config',true);
	$_default_prod_config = array(
					'layout' 					=> '0'	/*$datas['layout']*/
					,'left_sidebar' 			=> '0'  /*$datas['left_sidebar']*/
					,'right_sidebar' 			=> '0'	/*$datas['right_sidebar'] */		
	);	
	
	if( strlen($_prod_config) > 0 ){
		$_prod_config = unserialize($_prod_config);
		if( is_array($_prod_config) && count($_prod_config) > 0 ){
			$_prod_config['layout'] = ( isset($_prod_config['layout']) && strlen($_prod_config['layout']) > 0 ) ? $_prod_config['layout'] : $_default_prod_config['layout'];
			$_prod_config['left_sidebar'] = ( isset($_prod_config['left_sidebar']) && strlen($_prod_config['left_sidebar']) > 0 ) ? $_prod_config['left_sidebar'] : $_default_prod_config['left_sidebar'];
			$_prod_config['right_sidebar'] = ( isset($_prod_config['right_sidebar']) && strlen($_prod_config['right_sidebar']) > 0 ) ? $_prod_config['right_sidebar'] : $_default_prod_config['right_sidebar'];
		}
	}else{
		$_prod_config = $_default_prod_config;
	}

?>

<div class="select-layout area-config area-config1">
	<div class="area-inner">
		<div class="area-inner1">
			<h3 class="area-title"><?php _e('Custom Layout','wpdance'); ?></h3>
			<?php $this->showTooltip(__("Custom Layout",'wpdance'),__('Select custom layout for product page.Using general product page config by default','wpdance')); ?>
			<div class="area-content">
			
							<div>
								<label>Page Layout</label>	
								<div class="bg-input select-box ">
									<div class="bg-input-inner config-product">
										<select name="single_layout" id="_single_prod_layout">
											<option value="0" <?php if( strcmp($_prod_config["layout"],'0') == 0 ) echo "selected='selected'";?>>Default</option>
											<option value="0-1-0" <?php if( strcmp($_prod_config["layout"],'0-1-0') == 0 ) echo "selected='selected'";?>>Fullwidth</option>
											<option value="0-1-1" <?php if( strcmp($_prod_config["layout"],'0-1-1') == 0 ) echo "selected='selected'";?>>Right Sidebar</option>
											<option value="1-1-0" <?php if( strcmp($_prod_config["layout"],'1-1-0') == 0 ) echo "selected='selected'";?>>Left Sidebar</option>
											<option value="1-1-1" <?php if( strcmp($_prod_config["layout"],'1-1-1') == 0 ) echo "selected='selected'";?>>Left & Right Sidebar</option>
										</select>
									</div>
								</div>
							</div>
							
							<div>
								<label>Left Sidebar</label>	
								<div class="bg-input select-box ">
									<div class="bg-input-inner config-product">
										<select name="single_left_sidebar" id="_single_prod_left_sidebar">
											<option value="0" <?php if( strcmp($_prod_config["left_sidebar"],'0') == 0 ) echo "selected='selected'";?>>Default</option>
											<?php
												global $default_sidebars;
												foreach( $default_sidebars as $key => $_sidebar ){
													$_selected_str = ( strcmp($_prod_config["left_sidebar"],$_sidebar['id']) == 0 ) ? "selected"  : "";
													echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
												}
											?>
										</select>
									</div>
								</div>
							</div>

							<div>
								<label>Right Sidebar</label>
								<div class="bg-input select-box ">
									<div class="bg-input-inner config-product">
										<select name="single_right_sidebar" id="_single_prod_right_sidebar">
											<option value="0" <?php if( strcmp($_prod_config["right_sidebar"],'0') == 0 ) echo "selected='selected'";?>>Default</option>
											<?php
												global $default_sidebars;
												foreach( $default_sidebars as $key => $_sidebar ){
													$_selected_str = ( strcmp($_prod_config["right_sidebar"],$_sidebar['id']) == 0 ) ? "selected"  : "";
													echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
												}
											?>
										</select>
									</div>
								</div>							
							</div>			
			
				<input type="hidden" name="custom_product_layout" class="change-layout" value="custom_single_prod_layout"/>
			</div><!-- .area-content -->
		</div>	
	</div>	
</div><!-- .select-layout -->