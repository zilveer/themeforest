<div id="default-widget-area" class="widget-area">
	<ul class="xoxo">
		<?php if ( is_active_sidebar( 'search-widget-area' ) ) {
			dynamic_sidebar( 'search-widget-area' );
		} else {
			dynamic_sidebar( 'blog-widget-area' );
		} ?>
	</ul>
</div>