<!-- Previous / More Entries -->		
<div class="article_nav">
	<br />
	<hr />
		<?php if (ot_get_option('pagination') == 'Numbered') { 			
			if(function_exists('wp_paginate')) {
			    wp_paginate();
		    }
		} else { ?>
		<div class="p"><?php next_posts_link(__('Previous Posts', 'skeleton')); ?></div>
		<div class="m"><?php previous_posts_link(__('Next Posts', 'skeleton')); ?></div>
		<?php } ?>
</div>
<!-- </Previous / More Entries -->