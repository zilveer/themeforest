<div id="tab-4" class="slideshow-tab">
    <div class="tab-title">
        <h2><span><?php _e('Slideshow','wpdance'); ?></span></h2>
    </div>
	<div class="tab-content">
		<form name="config-slideshow" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data" id="config-slideshow">
			<div class="main-slideshow area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Main Slideshow','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Main Slideshow",'wpdance'),__('Config delay time for main slideshow','wpdance')); ?>
						<div class="area-content">
							<ul>
								<li class="delaytime">
									<span class="label"><?php _e('Delay time','wpdance')?></span>
									<div class="bg-input"><div class="bg-input-inner"><input name="main_slideshow_delay" value="<?php echo get_option(THEME_SLUG.'main_slideshow_delay')?>"/></div></div>
								</li>
							</ul>
						</div><!-- .area-content -->
					</div>	
				</div>	
			</div><!-- .main-slideshow -->
			
			<div class="slideshow1 area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e("Slideshow at single page",'wpdance'); ?></h3>
						<?php $this->showTooltip(__("Slideshow at single page",'wpdance'),__("Config delay time for slideshow at single page",'wpdance')); ?>
						<div class="area-content">
							<ul>
								<li class="delaytime">
									<span class="label"><?php _e('Delay Time','wpdance')?></span>
									<div class="bg-input"><div class="bg-input-inner"><input name="single_slideshow_delay" value="<?php echo get_option(THEME_SLUG.'single_slideshow_delay')?>"/></div></div>
								</li>
							</ul>
						</div><!-- .area-content -->
					</div>	
				</div>	
			</div><!-- .slideshow1 -->
			
			<div class="bottom-actions">
				<div class="actions">
					<input type="hidden" name="edit-slideshow" value="1"/>
					<input type="hidden" name="action" value="slideshow_config" />
					<button type="button" id="reset_slideshow" class="button btn-reset"><span><span>Reset Default</span></span></button>
					<button type="submit" class="button btn-save"><span><span>Save Changes</span></span></button>
			   </div><!-- .actions -->
			</div><!-- .bottom-actions -->
		</form>
	</div><!-- .tab-content -->
</div>