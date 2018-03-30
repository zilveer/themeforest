<?php

	global $category_prod_datas;
	$category_product_config = get_option(THEME_SLUG.'category_product_config','');
	$category_product_config = unserialize($category_product_config);
	
	$datas = wd_array_atts(
		array(
					'cat_columns' 				=> 2
					,'cat_layout' 				=> "1-1-0"
					,'cat_left_sidebar' 		=> "product-category-widget-area-left"
					,'cat_right_sidebar' 		=> "product-category-widget-area-right"
			)
		,$category_product_config);	
	
	$category_prod_datas = $datas;
?>
<div id="tab-product-category" class="custompost-tab">
    <div class="tab-title">
        <h2><span><?php _e('Custom for product page','wpdance'); ?></span></h2>
    </div><!-- .tab-title -->
	<div class="tab-content">		
		<form name="config-product-category" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data" id="config-product-category">
			<div class="code-head area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Config product category page','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Config product category page",'wpdance'),__("Config product category page",'wpdance')); ?>
						<div class="area-content">
							<div>
								<label>Category Products Columns</label>	
								<div class="bg-input select-box ">
									<div class="bg-input-inner config-product">
										<select name="cat_columns" id="_cat_columns">
											<option value="2" <?php if( strcmp($datas["cat_columns"],'2') == 0 ) echo "selected='selected'";?>>2 Columns</option>
											<option value="3" <?php if( strcmp($datas["cat_columns"],'3') == 0 ) echo "selected='selected'";?>>3 Columns</option>
											<option value="4" <?php if( strcmp($datas["cat_columns"],'4') == 0 ) echo "selected='selected'";?>>4 Columns</option>
											<option value="6" <?php if( strcmp($datas["cat_columns"],'6') == 0 ) echo "selected='selected'";?>>6 Columns</option>
										</select>
									</div>
								</div>
							</div>

							
							<div>
								<label>Category Page Layout</label>	
								<div class="bg-input select-box ">
									<div class="bg-input-inner config-product">
										<select name="cat_layout" id="_cat_layout">
											<option value="0-1-0" <?php if( strcmp($datas["cat_layout"],'0-1-0') == 0 ) echo "selected='selected'";?>>Fullwidth</option>
											<option value="0-1-1" <?php if( strcmp($datas["cat_layout"],'0-1-1') == 0 ) echo "selected='selected'";?>>Right Sidebar</option>
											<option value="1-1-0" <?php if( strcmp($datas["cat_layout"],'1-1-0') == 0 ) echo "selected='selected'";?>>Left Sidebar</option>
											<option value="1-1-1" <?php if( strcmp($datas["cat_layout"],'1-1-1') == 0 ) echo "selected='selected'";?>>Left & Right Sidebar</option>
										</select>
									</div>
								</div>
							</div>
							
							<div>
								<label>Left Sidebar</label>	
								<div class="bg-input select-box ">
									<div class="bg-input-inner config-product">
										<select name="cat_left_sidebar" id="_cat_left_sidebar">
											<?php
												global $default_sidebars;
												foreach( $default_sidebars as $key => $_sidebar ){
													$_selected_str = ( strcmp($datas["cat_left_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
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
										<select name="cat_right_sidebar" id="_cat_right_sidebar">
											<?php
												global $default_sidebars;
												foreach( $default_sidebars as $key => $_sidebar ){
													$_selected_str = ( strcmp($datas["cat_right_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
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
					<?php wp_nonce_field( "config_product_category", "config_product_category_nonce" ); ?>
					<input type="hidden" name="action" value="config_product_category"/>
					<button type="button" id="reset_config_product_category" class="button btn-reset"><span><span><?php _e('Reset Default','wpdance')?></span></span></button>
					<button type="submit" class="button btn-save"><span><span><?php _e('Save Changes','wpdance'); ?></span></span></button>
			   </div><!-- .actions -->
			</div><!-- .bottom-actions -->	
		</form>
	</div><!-- .tab-content -->
</div><!-- #tabs-9 -->