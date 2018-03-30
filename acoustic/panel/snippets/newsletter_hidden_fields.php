<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

	if( !function_exists('ci_newsletter_hidden_fields') ):
	function ci_newsletter_hidden_fields()
	{
		$fields = ci_setting('newsletter_hidden_fields');
		$out = '';
		if(is_array($fields) and count($fields) > 0)
		{
			for( $i = 0; $i < count($fields); $i+=2 )
			{
				if(empty($fields[$i]))
					continue;
				$out .= '<input type="hidden" name="'.esc_attr($fields[$i]).'" value="'.esc_attr($fields[$i+1]).'" />';
			}
		}
		return $out;
	}
	endif;


	$ci_defaults['newsletter_hidden_fields'] = apply_filters('ci_newsletter_hidden_fields_defaults', array(
		'hidden1', 'value1',
		'hidden2', 'value2',
	));
?>
<?php else: ?>

	<fieldset class="set">
		<legend><?php _e('Hidden Fields', 'ci_theme'); ?></legend>
		<p class="guide"><?php _e('You can pass additional data to your newsletter system, by means of hidden fields (e.g. Mailchimp requires them).' , 'ci_theme'); ?></p>
		<fieldset id="newsletter_hidden_fields">
			<a href="#" id="newsletter-add-field"><?php _e('Add hidden field', 'ci_theme'); ?></a>
			<div class="inside">
				<?php
					$fields = $ci['newsletter_hidden_fields'];
					if (!empty($fields))
					{
						for( $i = 0; $i < count($fields); $i+=2 )
						{
							echo '<p class="newsletter-field"><label>'.__('Hidden field name', 'ci_theme').'<input type="text" name="'.THEME_OPTIONS.'[newsletter_hidden_fields][]" value="'. $fields[$i] .'" /></label><label>'.__('Hidden field value', 'ci_theme').'<input type="text" name="'.THEME_OPTIONS.'[newsletter_hidden_fields][]" value="'. $fields[$i+1] .'" /></label> <a href="#" class="newsletter-remove">' . __('Remove me', 'ci_theme') . '</a></p>';
						}
					}
				?>
			</div>
		</fieldset>
		<?php
			$name_field = '<label>'.__('Hidden field name', 'ci_theme').'<input type="text" name="'.THEME_OPTIONS.'[newsletter_hidden_fields][]" /></label>';
			$value_field = '<label>'.__('Hidden field value', 'ci_theme').'<input type="text" name="'.THEME_OPTIONS.'[newsletter_hidden_fields][]" /></label>';
			$append = '<p class="newsletter-field">' . $name_field . $value_field . ' <a href="#" class="newsletter-remove">'.__('Remove me', 'ci_theme').'</a></p>';
			$script = "
				$('#newsletter-add-field').click( function() {
					$('#newsletter_hidden_fields .inside').append('".$append."');
					return false;
				});

				$('#newsletter_hidden_fields').on('click', '.newsletter-remove', function() {
					$(this).parent('p').remove();
					return false;
				});
			";

			ci_add_inline_js($script, 'newsletter_hidden_fields_script');
		?>
	</fieldset>

<?php endif; ?>