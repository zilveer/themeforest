            <?php wp_reset_query() ?>                  
		
			<div id="sidebar-topbar">
				<?php do_action( 'yiw_before_sidebar' ) ?> 
				<?php do_action( 'yiw_before_sidebar_' . yiw_get_current_pagename() ) ?> 
				
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'qTranslate row' ) ) {} ?>
		
				<?php do_action( 'yiw_after_sidebar' ) ?>       
				<?php do_action( 'yiw_after_sidebar_' . yiw_get_current_pagename() ) ?> 
			</div>