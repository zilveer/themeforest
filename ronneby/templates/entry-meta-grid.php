<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="entry-meta">
	<div class="grid-aut-cat">
	<?php
		get_template_part('templates/entry-meta/mini', 'author');
		get_template_part('templates/entry-meta/mini', 'category');
	?>
	</div>
	<div class="grid-like-com">
	<?php
		get_template_part('templates/entry-meta/mini', 'like');
		get_template_part('templates/entry-meta/mini', 'delim-blank');
		get_template_part('templates/entry-meta/mini', 'comments');
	?>
	</div>
</div>