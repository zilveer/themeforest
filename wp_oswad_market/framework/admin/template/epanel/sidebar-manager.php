<?php 
	$custom_sidebar_str = get_option(THEME_SLUG.'areas');
	if($custom_sidebar_str)
		$custom_sidebar_arr = json_decode($custom_sidebar_str);
	else
		$custom_sidebar_arr = array();

?>
<div id="tab-sidebar-manager" class="custom-sidebar-tab">
    <div class="tab-title">
        <h2><span><?php _e('Sidebar Manager','wpdance'); ?></span></h2>
    </div>
	<div class="tab-content">
	
		<form name="config-custom-sidebar-1" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data" id="config-custom-sidebar-1">
			
			<div class="create-custom-sidebar area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Create New  Sidebar','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Create New  Sidebar",'wpdance'),__('Create a new sidebar','wpdance')); ?>
						<div class="area-content">
							<div class="bg-input"><div class="bg-input-inner"><input type="text" name="name_sidebar" id="name_sidebar"/></div></div>
							<a class="button1 btn-add-sidebar" href="javascript:void(0);" id="btn-add-sidebar"><span><span><?php _e('Add New Sidebar','wpdance')?></span></span></a>
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->	
				</div><!-- .area-inner -->	
			</div><!-- .create-custom-sidebar -->
			
			<div class="edit-custom-sidebar area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Available Sidebars','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Available Sidebars",'wpdance'),__('See and delete Available sidebar','wpdance')); ?>
						<div class="area-content">
							<ul class="list-sidebar">
							<?php if(!empty($custom_sidebar_arr)):?>
								<?php $j = 0;foreach($custom_sidebar_arr as $sidebar):?>
								<li class="<?php if(++$j == 1) echo 'first';elseif($j == count($custom_sidebar_arr)) echo 'last';?>">
									<div class="bg-input"><div class="bg-input-inner"><span class="name-sidebar"><?php echo stripslashes(esc_html($sidebar)); ?></span></div></div>
									<a class="button1 delete_sidebar" title="<?php echo stripslashes($sidebar); ?>"><span><span><?php _e('Delete','wpdance'); ?></span></span></a>
									<input name="areas[]" type="hidden" value="<?php echo stripslashes($sidebar); ?>"/>
								</li>
								<?php endforeach;?>
							
							<?php endif;?>
							</ul>
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->	
				</div><!-- .area-inner -->	
			</div><!-- .edit-custom-sidebar -->
			

			
			<div class="bottom-actions">
			   <div class="actions">
				   <input type="hidden" name="edit-custom_sidebar" value="1"/>
				   <input type="hidden" name="action" value="sidebar_manager_config" />
				   <button type="button" id="reset_custom_sidebar" class="button btn-reset"><span><span><?php _e('Reset Default','wpdance')?></span></span></button>
				   <button type="submit" class="button btn-save"><span><span><?php _e('Save Changes','wpdance')?></span></span></button>
			   </div><!-- End .actions -->
			</div><!-- End .bottom-actions -->
			
		</form>

	</div><!-- .tab-content -->
</div><!-- .custom-interface-tab -->
