<div class="mtheme-page mtheme-interface">
	<form name="mtheme_options" id="mtheme_options" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>">
		<div class="mtheme-header">
			<h1 class="mtheme-page-title"><?php _e('Theme Options','mtheme'); ?></h1>
			<input type="submit" name="<?php echo MTHEME_PREFIX; ?>save_options" value="<?php _e('Save Changes','mtheme'); ?>" class="mtheme-button disabled mtheme-save-button" />
		</div>
		<div class="mtheme-content">
			<div class="mtheme-menu">
				<?php MthemeInterface::renderMenu(); ?>
			</div>
			<div class="mtheme-sections">
				
				<?php self::renderSections(); ?>
				
			</div>
		</div>	
		<div class="mtheme-footer">
			<input type="submit" name="<?php echo MTHEME_PREFIX; ?>reset_options" value="<?php _e('Reset Options','mtheme'); ?>" class="mtheme-button mtheme-reset-button" />
			<input type="submit" name="<?php echo MTHEME_PREFIX; ?>save_options" value="<?php _e('Save Changes','mtheme'); ?>" class="mtheme-button disabled mtheme-save-button" />
		</div>
		<div class="mtheme-popup"></div>
	</form>
</div>