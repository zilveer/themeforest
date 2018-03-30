<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="entry-meta">
	<?php
		get_template_part('templates/entry-meta/mini', 'author');
		get_template_part('templates/entry-meta/mini', 'delim-blank');
		get_template_part('templates/entry-meta/mini', 'date');
		get_template_part('templates/entry-meta/mini', 'delim-blank');
		get_template_part('templates/entry-meta/mini', 'like');
		get_template_part('templates/entry-meta/mini', 'delim-blank');
	?>
</div>