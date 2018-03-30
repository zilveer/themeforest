<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="entry-meta">
	<?php
		get_template_part('templates/entry-meta/mini', 'author');
		get_template_part('templates/entry-meta/mini', 'delim-blank');
		get_template_part('templates/entry-meta/mini', 'comments');
		get_template_part('templates/entry-meta/mini', 'delim-blank');
		get_template_part('templates/entry-meta/mini', 'share');
	?>
</div>