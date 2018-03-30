<div id="tab-custom-code-area" class="integration-tab">
    <div class="tab-title">
        <h2><span><?php _e('Custom Code Area','wpdance'); ?></span></h2>
    </div><!-- .tab-title -->
	<div class="tab-content">
		<form name="config-integration" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data" id="config-integration">
			<div class="code-head area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Add code to top of your post','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Add code to top of your post",'wpdance'),__("Add your custom code (html and javascript)",'wpdance')); ?>
						<div class="area-content">
							<textarea name="code_to_top_post" class="full-width"><?php echo stripslashes(htmlspecialchars_decode(get_option(THEME_SLUG.'code_to_top_post')));?></textarea>
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->
				</div><!-- .area-inner -->
			</div><!-- .code-head -->

			<div class="code-front-footer area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Add code to bottom of your post','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Add code to bottom of your post (Before comments)",'wpdance'),__("Add your custom code (html and javascript) to bottom of your post",'wpdance')); ?>
						<div class="area-content">
							<textarea name="code_to_bottom_post" class="full-width"><?php echo stripslashes(htmlspecialchars_decode(get_option(THEME_SLUG.'code_to_bottom_post')));?></textarea>
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->
				</div><!-- .area-inner -->
			</div><!-- .code-front-footer -->
			<div class="google_analytics area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Add code before < / body >','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Add code before < / body >",'wpdance'),__("Add code before < / body >",'wpdance')); ?>
						<div class="area-content">
							<textarea name="code_before_end_body" class="full-width"><?php echo stripslashes(htmlspecialchars_decode(get_option(THEME_SLUG.'code_before_end_body')));?></textarea>
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->
				</div><!-- .area-inner -->
			</div><!-- .google_analytics -->
			<div class="google_analytics area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Google Analytics','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Google Analytics",'wpdance'),__("Add your google analytics code",'wpdance')); ?>
						<div class="area-content">
							<textarea name="google_analytics" class="full-width"><?php echo stripslashes(htmlspecialchars_decode(get_option(THEME_SLUG.'google_analytics'))); ?></textarea>
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->
				</div><!-- .area-inner -->
			</div><!-- .google_analytics -->
			

			
			<div class="bottom-actions">
			   <div class="actions">
					<input type="hidden" name="action" value="custom_code_area_config"/>
					<button type="button" id="reset_integration" class="button btn-reset"><span><span><?php _e('Default','wpdance'); ?></span></span></button>
					<button type="submit" class="button btn-save"><span><span><?php _e('Save Changes','wpdance'); ?></span></span></button>
			   </div><!-- .actions -->
			</div><!-- .bottom-actions -->	
		</form>
	</div><!-- .tab-content -->
</div><!-- #tabs-9 -->	