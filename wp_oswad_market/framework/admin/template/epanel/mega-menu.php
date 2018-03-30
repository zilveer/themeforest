<?php 
	global $_wd_mega_configs;
	$wd_mega_menu_config = get_option(THEME_SLUG.'wd_mega_menu_config','');
	$wd_mega_menu_config_arr = unserialize($wd_mega_menu_config);
	if( is_array($wd_mega_menu_config_arr) && count($wd_mega_menu_config_arr) > 0 ){
		if ( !array_key_exists('area_number', $wd_mega_menu_config_arr) ) {
			$wd_mega_menu_config_arr['area_number'] = 1;
		}
		if ( !array_key_exists('thumbnail_width', $wd_mega_menu_config_arr) ) {
			$wd_mega_menu_config_arr['thumbnail_width'] = 16;
		}
		if ( !array_key_exists('thumbnail_height', $wd_mega_menu_config_arr) ) {
			$wd_mega_menu_config_arr['thumbnail_height'] = 16;
		}
		if ( !array_key_exists('menu_text', $wd_mega_menu_config_arr) ) {
			$wd_mega_menu_config_arr['menu_text'] = 'Menu';
		}
		if ( !array_key_exists('disabled_on_phone', $wd_mega_menu_config_arr) ) {
			$wd_mega_menu_config_arr['disabled_on_phone'] = 0;
		}		
	}else{
		$wd_mega_menu_config_arr = array(
			'area_number' => 1
			,'thumbnail_width' => 16
			,'thumbnail_height' => 16
			,'menu_text' => 'Menu'
			,'disabled_on_phone' => 0
		);
	}
	$_wd_mega_configs = $wd_mega_menu_config_arr;
?>
<div id="tab-mega-menu" class="mega-menu-tab">
    <div class="tab-title">
        <h2><span><?php _e('Mega Menu Manager','wpdance'); ?></span></h2>
    </div>
	<div class="tab-content">
	
		<form name="config-mega-menu" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data" id="config-mega-menu">

			<div class="custom-menu-text area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Menu Text & Image','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Menu Text & Image",'wpdance'),__('Config Text Label For Mobile Menu','wpdance')); ?>
						<div class="area-content">
							<ul>
								<li class="first last">
									<span class="label"><?php _e('Menu Text','wpdance')?></span>
									<div class="bg-input">
										<div class="bg-input-inner"><input type="text" name="menu_text" value="<?php echo stripslashes(esc_html($wd_mega_menu_config_arr['menu_text']));?>"/></div>
									</div>
								</li>
							</ul>
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->	
				</div><!-- .area-inner -->	
			</div><!-- .create-custom-sidebar -->
		
			<div class="custom-thumbnail-size area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Menu thumbnail size','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Menu thumbnail size",'wpdance'),__('Menu thumbnail size','wpdance')); ?>
						<div class="area-content">
							<ul>
								<li class="first">
									<span class="label"><?php _e('Thumbnail Width','wpdance')?></span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="thumbnail_width" required="true" id="thumbnail_width"  value="<?php echo absint($wd_mega_menu_config_arr['thumbnail_width']); ?>"/></div></div>
								</li>
								<li class="last">
									<span class="label"><?php _e('Thumbnail Height','wpdance')?></span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="thumbnail_height" required="true" id="thumbnail_height" value="<?php echo absint($wd_mega_menu_config_arr['thumbnail_height']); ?>"/></div></div>
								</li>
							</ul>
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->	
				</div><!-- .area-inner -->	
			</div><!-- .create-custom-sidebar -->
			
			<div class="edit-custom-mega-area area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Available Widget Area','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Available Widget Area",'wpdance'),__('See and delete Available Widget Area','wpdance')); ?>
						<div class="area-content">
							<ul class="list-sidebar">
								<li class="first last">
									<span class="label"><?php _e('Number Area','wpdance')?></span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="area_number" required="true" id="area_number" value="<?php echo absint($wd_mega_menu_config_arr['area_number']); ?>"/></div></div>
								</li>
							</ul>
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->	
				</div><!-- .area-inner -->	
			</div><!-- .edit-custom-sidebar -->
			

			<div class="edit-custom-mega-area area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Disabled on mobile','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Disabled on mobile",'wpdance'),__('Disabled Mega Menu on mobile version','wpdance')); ?>
						<div class="area-content">
							<ul class="list-sidebar">
								<li class="first last">
									<label>Disabled
									<input  type="checkbox" value="1" name="disabled_on_phone" id="_disabled_on_phone" <?php if( absint($wd_mega_menu_config_arr["disabled_on_phone"]) == 1 ) echo "checked='checked'";?>/>
									</label>
								</li>
							</ul>
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->	
				</div><!-- .area-inner -->	
			</div><!-- .edit-custom-sidebar -->			
			
			
			<div class="bottom-actions">
			   <div class="actions">
				   <input type="hidden" name="edit-mega_menu" value="1"/>
				   <input type="hidden" name="action" value="mega_menu_config" />
				   <button type="button" id="reset_custom_sidebar" class="button btn-reset"><span><span><?php _e('Reset Default','wpdance')?></span></span></button>
				   <button type="submit" class="button btn-save"><span><span><?php _e('Save Changes','wpdance')?></span></span></button>
			   </div><!-- End .actions -->
			</div><!-- End .bottom-actions -->
			
		</form>

	</div><!-- .tab-content -->
</div><!-- .custom-interface-tab -->
