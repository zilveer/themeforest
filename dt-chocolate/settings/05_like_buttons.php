<?php

function theme_like_buttons()
{
   $options = dt_get_theme_options();
   theme_header();
?>
	
	<input type="hidden" name="save_like_buttons_checkboxes" value="1" />

    <fieldset>
		<legend><?php echo _x('Enable like buttons in ...', 'backend theme options', LANGUAGE_ZONE); ?></legend>

		<label><input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[enable_in_album]"<?php checked($options['enable_in_album'], 1); ?>/>&nbsp;<?php echo _x('Gallery-Album template', 'backend theme options', LANGUAGE_ZONE); ?></label><br />

		<label><input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[enable_in_photos]"<?php checked($options['enable_in_photos'], 1); ?>/>&nbsp;<?php echo _x('Gallery-Photos template', 'backend theme options', LANGUAGE_ZONE); ?></label><br />

		<label><input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[enable_in_blog]"<?php checked($options['enable_in_blog'], 1); ?>/>&nbsp;<?php echo _x('Blog template', 'backend theme options', LANGUAGE_ZONE); ?></label><br />

		<label><input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[enable_in_portfolio]"<?php checked($options['enable_in_portfolio'], 1); ?>/>&nbsp;<?php echo _x('Portfolio template', 'backend theme options', LANGUAGE_ZONE); ?></label><br />

    </fieldset>

    <fieldset>
		<legend><?php echo _x('Like buttons', 'backend theme options', LANGUAGE_ZONE); ?></legend>

		<label><input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[twitter_lb]"<?php checked($options['twitter_lb'], 1); ?>/>&nbsp;<?php echo _x('Twitter', 'backend theme options', LANGUAGE_ZONE); ?></label><br />

		<label><input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[faceboock_lb]"<?php checked($options['faceboock_lb'], 1); ?>/>&nbsp;<?php echo _x('Facebook', 'backend theme options', LANGUAGE_ZONE); ?></label><br />

		<label><input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[google_plus_lb]"<?php checked($options['google_plus_lb'], 1); ?>/>&nbsp;<?php echo _x('Google plus', 'backend theme options', LANGUAGE_ZONE); ?></label>

	</fieldset>

<?php
   theme_footer();
}

?>
