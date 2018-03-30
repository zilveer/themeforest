<?php

	global $single_prod_datas;
	$single_product_config = get_option(THEME_SLUG.'single_product_config','');
	$single_product_config = unserialize($single_product_config);
	
	$_settings = array(
		'teeny' => true,
		'textarea_rows' => 15,
		'tabindex' => 1
	);	
	
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
					,'show_email' 				=> 1
					,'show_sku' 				=> 1
					,'show_rating' 				=> 1
					,'show_view' 				=> 1
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
	
	$single_prod_datas	= $datas;
	

?>
<div id="tab-product-details" class="custompost-tab">
    <div class="tab-title">
        <h2><span><?php _e('Custom for product page','wpdance'); ?></span></h2>
    </div><!-- .tab-title -->
	<div class="tab-content">
	
		
		
		<form name="config-product-single" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data" id="config-product-single">
			<div class="code-head area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Config product detailed page','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Config product detailed page",'wpdance'),__("Config product detailed page",'wpdance')); ?>
						<div class="area-content">
							<div>
								<label>Show Product Images 
									<input  type="checkbox" value="1" name="show_image" id="_single_prod_show_image" <?php if( $datas["show_image"] == 1 ) echo "checked='checked'";?>/>
								</label>
							</div>
							<div>
								<label>Show Product Labels 
									<input  type="checkbox" value="1" name="show_label" id="_single_prod_show_label" <?php if( $datas["show_label"] == 1 ) echo "checked='checked'";?>/>
								</label>
							</div>							
							<div>							
								<label>Show Product Title
									<input  type="checkbox" value="1" name="show_title" id="_single_prod_show_title" <?php if($datas["show_title"] == 1) echo "checked='checked'";?>/>
								</label>
							</div>
							<div>							
								<label>Show Email to Friend
									<input  type="checkbox" value="1" name="show_email" id="_single_prod_show_email" <?php if($datas["show_email"] == 1) echo "checked='checked'";?>/>
								</label>
							</div>
							<div>		
								<label>Show Product Sku 
									<input  type="checkbox" value="1" name="show_sku" id="_single_prod_show_sku" <?php if($datas["show_sku"] == 1) echo "checked='checked'";?>/>
								</label>	
							</div>
							<div>		
								<label>Show Product Rating
									<input  type="checkbox" value="1" name="show_rating" id="_single_prod_show_rating" <?php if($datas["show_rating"] == 1) echo "checked='checked'";?>/>
								</label>	
							</div>
							<div>		
								<label>Show Product Views 
									<input  type="checkbox" value="1" name="show_view" id="_single_prod_show_view" <?php if($datas["show_view"] == 1) echo "checked='checked'";?>/>
								</label>	
							</div>
							<div>
								<label>Show Product Review
									<input  type="checkbox" value="1" name="show_review" id="_single_prod_show_review" <?php if( $datas["show_review"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</div>
							<div>
								<label>Show Product Availability
									<input  type="checkbox" value="1" name="show_availability" id="_single_prod_show_availability" <?php if( $datas["show_availability"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</div>
							
							<div>
								<label>Show AddToCart Button
									<input  type="checkbox" value="1" name="show_add_to_cart" id="_single_prod_show_add_to_cart" <?php if( $datas["show_add_to_cart"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</div>
							
							<div>
								<label>Show Product Price
									<input  type="checkbox" value="1" name="show_price" id="_single_prod_show_price" <?php if( $datas["show_price"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</div>

							<div>
								<label>Show Short Desc
									<input  type="checkbox" value="1" name="show_short_desc" id="_single_prod_show_short_desc" <?php if( $datas["show_short_desc"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</div>							
	
							<div>
								<label>Show Meta Datas(Tags,Categories)
									<input  type="checkbox" value="1" name="show_meta" id="_single_prod_show_meta" <?php if( $datas["show_meta"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</div>
							<div>
								<label>Show Related Products 
									<input  type="checkbox" value="1" name="show_related" id="_single_prod_show_related" <?php if( $datas["show_related"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</div>
							<div>
								<label>Related Title </label>	
								<div class="bg-input"><div class="bg-input-inner"><input  id="_single_prod_related_title" type="text" value="<?php echo stripslashes(esc_html($datas["related_title"]));?>" name="related_title" /></div></div>
							</div>													
							<div>
								<label>Show Social Sharing ( * Require Product Image)
									<input  type="checkbox" value="1" name="show_sharing" id="_single_prod_show_sharing" <?php if( $datas["show_sharing"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</div>
							<div>
								<label>Sharing Title </label>
								<div class="bg-input"><div class="bg-input-inner"><input id="_single_prod_sharing_title" type="text" value="<?php echo stripslashes(esc_html($datas["sharing_title"]));?>" name="sharing_title" /></div></div>
							</div>	
							<!--
							<div>
								<label>Sharing Intro Text </label>
								<textarea name="sharing_intro" id="sharing_intro" class="full-width"><?php echo stripslashes(htmlspecialchars_decode($datas["sharing_intro"]));?></textarea>
							</div>
							
							<div>
								<label>Sharing Custom Code </label>
								<?php //wp_editor( stripslashes(htmlspecialchars_decode($single_prod_datas['sharing_custom_code'])), 'sharing_custom_code',$_settings ); ?>
							</div>							
							-->
							
							<div>
								<label>Show Ship & Return Box ( * Require Product Image)
									<input  type="checkbox" value="1" id="_single_prod_show_ship_return" name="show_ship_return" <?php if( $datas["show_ship_return"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</div>
							<div>
								<label>Ship & Return Title </label>
								<div class="bg-input"><div class="bg-input-inner"><input id="_single_prod_ship_return_title" type="text" value="<?php echo stripslashes(esc_html($datas["ship_return_title"]));?>" name="ship_return_title"/></div></div>
							</div>
							
							<div>
								<label>Ship & Return Content </label>
									<?php 
										wp_editor( stripslashes(htmlspecialchars_decode($single_prod_datas['ship_return_content'])), 'ship_return_content',$_settings );
									?>								
							</div>								
							
							<div>
								<label>Show Product Tabs
									<input id="_single_prod_show_tabs" type="checkbox" value="1" name="show_tabs" <?php if( $datas["show_tabs"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</div>
							<div>
								<label>Add Custom Tab
									<input id="_single_prod_show_custom_tab" type="checkbox" value="1" name="show_custom_tab" <?php if( $datas["show_custom_tab"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</div>
							<div>
								<label>Custom Tab Title </label>
								<div class="bg-input"><div class="bg-input-inner"><input id="_single_prod_custom_tab_title" type="text" value="<?php echo stripslashes(esc_html($datas["custom_tab_title"]));?>" name="custom_tab_title"/></div></div>
							</div>	
							
							<div>
								<label class="custom-tab-label">Custom Tab Content </label>
								<?php	wp_editor( stripslashes(htmlspecialchars_decode($single_prod_datas['custom_tab_content'])), 'custom_tab_content',$_settings );	?>			
							</div>							
							
							<div>
								<label>Show UpSell Product 
									<input id="_single_prod_show_upsell" type="checkbox" value="1" name="show_upsell" <?php if( $datas["show_upsell"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</div>							
							
							<div>
								<label>UpSell Title </label>
								<div class="bg-input"><div class="bg-input-inner"><input id="_single_prod_upsell_title" type="text" value="<?php echo stripslashes(esc_html($datas["upsell_title"])); ?>" name="upsell_title"/></div></div>
							</div>
							
							<div>
								<label>Product Page Layout</label>	
								<div class="bg-input select-box ">
									<div class="bg-input-inner config-product">
										<select name="layout" id="_single_prod_layout">
											<option value="0-1-0" <?php if( strcmp($datas["layout"],'0-1-0') == 0 ) echo "selected='selected'";?>>Fullwidth</option>
											<option value="0-1-1" <?php if( strcmp($datas["layout"],'0-1-1') == 0 ) echo "selected='selected'";?>>Right Sidebar</option>
											<option value="1-1-0" <?php if( strcmp($datas["layout"],'1-1-0') == 0 ) echo "selected='selected'";?>>Left Sidebar</option>
											<!--<option value="1-1-1" <?php //if( strcmp($datas["layout"],'1-1-1') == 0 ) echo "selected='selected'";?>>Left & Right Sidebar</option> -->
										</select>
									</div>
								</div>
							</div>
							
							<div>
								<label>Left Sidebar</label>	
								<div class="bg-input select-box ">
									<div class="bg-input-inner config-product">
										<select name="left_sidebar" id="_single_prod_left_sidebar">
											<?php
												global $default_sidebars;
												foreach( $default_sidebars as $key => $_sidebar ){
													$_selected_str = ( strcmp($datas["left_sidebar"],$_sidebar['id']) == 0 ) ? "selected"  : "";
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
										<select name="right_sidebar" id="_single_prod_right_sidebar">
											<?php
												global $default_sidebars;
												foreach( $default_sidebars as $key => $_sidebar ){
													$_selected_str = ( strcmp($datas["right_sidebar"],$_sidebar['id']) == 0 ) ? "selected"  : "";
													echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
												}
											?>
										</select>
									</div>
								</div>							
							</div>

							
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->
				</div><!-- .area-inner -->
			</div><!-- .code-head -->		


			
			
			<div class="bottom-actions">
			   <div class="actions">
					<?php wp_nonce_field( "config_product_single", "config_product_single_nonce" ); ?>
					<input type="hidden" name="action" value="config_product_single"/>
					<button type="button" id="reset_config_product_single" class="button btn-reset"><span><span><?php _e('Reset Default','wpdance')?></span></span></button>
					<button type="submit" class="button btn-save"><span><span><?php _e('Save Changes','wpdance'); ?></span></span></button>
			   </div><!-- .actions -->
			</div><!-- .bottom-actions -->	
		</form>
	</div><!-- .tab-content -->
</div><!-- #tabs-9 -->