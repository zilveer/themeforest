<?php

function theme_captcha_options()
{
   $options = dt_get_theme_options();
   theme_header();
?>

      	<input type="hidden" name="save_captcha_checkboxes" value="1" />
        <fieldset>
		 	<legend><?php echo _x('Enable CAPTCHA on the:', 'backend theme options', LANGUAGE_ZONE); ?></legend>
			<label><input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[captcha_hide_register]"<?php checked($options['captcha_hide_register']); ?>/>&nbsp;<?php echo _x('do not show CAPTCHA to registered users', 'backend theme options', LANGUAGE_ZONE); ?></label>
         </fieldset>

         <fieldset>
		 	<legend><?php echo _x('Arithmetic actions for CAPTCHA:', 'backend theme options', LANGUAGE_ZONE); ?></legend>
			<label><input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[captcha_math_action_minus]"<?php checked($options['captcha_math_action_minus']); ?>/>&nbsp;<?php echo _x('minus (-)', 'backend theme options', LANGUAGE_ZONE); ?></label><br />
			<label><input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[captcha_math_action_increase]"<?php checked($options['captcha_math_action_increase']); ?>/>&nbsp;<?php echo _x('multiply (x)', 'backend theme options', LANGUAGE_ZONE); ?></label>
         </fieldset>

         <fieldset>
		 	<legend><?php echo _x('Difficulty for CAPTCHA:', 'backend theme options', LANGUAGE_ZONE); ?></legend>
			<label><input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[captcha_difficulty_number]"<?php checked($options['captcha_difficulty_number']); ?>/>&nbsp;<?php echo _x('numbers', 'backend theme options', LANGUAGE_ZONE); ?></label><br />
			<label><input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[captcha_difficulty_word]"<?php checked($options['captcha_difficulty_word']); ?>/>&nbsp;<?php echo _x('words', 'backend theme options', LANGUAGE_ZONE); ?></label>
         </fieldset>
<?php
   theme_footer();
}

?>
