<?php


class AitTextElement extends AitElement
{

	public function getText()
	{
		$content = $this->option('text');

		$note = '';

		if(empty($content)){
			ob_start();
			?>
			<div class="alert alert-info">
				<strong><?php _ex('Text', 'name of element', 'ait') ?></strong>
				&nbsp;|&nbsp;
				<?php _e('Info: Enter some content to the textarea in the Text element, please.', 'ait'); ?>
			</div>
			<?php

			return ob_get_clean();
		}

		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);

		return $content;
	}
}
