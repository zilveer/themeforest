<div id="sidebar">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Overall_Sidebar') ) : endif; ?>
	<?php if (is_page()) { ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Pages_Sidebar') ) : endif; ?>
	<?php } else { ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog_Sidebar') ) : endif; ?>
	<?php } ?>
</div>