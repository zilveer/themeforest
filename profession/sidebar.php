<?php
	function GetPageSidebar() {
		$sidebar = get_post_meta(get_the_ID(), 'sidebar', true);
		
		if($sidebar == '')
			return dynamic_sidebar('Blog Sidebar');
		else
			return dynamic_sidebar($sidebar);
	}
?>
<div class="span3">
	<div class="sidebar">
	 
		<?php 
		if(!is_page()) 
		{
		/* Widgetised Area */ 
		if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar() ) { ?>

		<?php 
		}
		}
		else
		{
		/* Widgetised Area */ 
		if ( !function_exists( 'dynamic_sidebar' ) || !GetPageSidebar() ) { ?>
			
		<?php
		}
		}
		?>
	</div>
</div>