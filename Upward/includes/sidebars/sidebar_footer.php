<?php if ( !defined( 'ABSPATH' ) ) exit;

	global
		$st_Options,
		$st_Settings;

		$st_ = array();

		$st_['scheme'] = !empty( $st_Settings['footer_sidebars'] ) ? $st_Settings['footer_sidebars'] : $st_Options['panel']['layout']['footer']['scheme']['default']; ?>
	
	
		<div id="footer-box" class="footer-box-v<?php echo $st_['scheme']; ?>"><?php
	
	
			if (
	
			   !$st_['scheme'] ||
				$st_['scheme'] == 'none' ):	// None
	
					echo '<div class="clear"><!-- --></div>';
	
			
			elseif (
	
				$st_['scheme'] == 1 ||	// 1/3 + 1/3 + 1/3
				$st_['scheme'] == 2 ||	// 1/4 + 1/4 + 2/4
				$st_['scheme'] == 3 ||	// 1/4 + 2/4 + 1/4
				$st_['scheme'] == 4 ):	// 2/4 + 1/4 + 1/4
	
					echo '<div class="sidebar-footer"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 1' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 1' );
					echo '</div></div>';
		
					echo '<div class="sidebar-footer"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 2' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 2' );
					echo '</div></div>';
		
					echo '<div class="sidebar-footer last"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 3' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 3' );
					echo '</div></div>';
					
					echo '<div class="clear"><!-- --></div>';
	
	
			elseif (
	
				$st_['scheme'] == 5 ):	// 1/4 + 1/4 + 1/4 + 1/4
	
					echo '<div class="sidebar-footer"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 1' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 1' );
					echo '</div></div>';
		
					echo '<div class="sidebar-footer"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 2' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 2' );
					echo '</div></div>';
		
					echo '<div class="sidebar-footer"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 3' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 3' );
					echo '</div></div>';
		
					echo '<div class="sidebar-footer last"><div>';
						if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 4' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 4' );
					echo '</div></div>';
					
					echo '<div class="clear"><!-- --></div>';
	
	
			elseif (
	
				$st_['scheme'] == 6 ):	// 2/3 + 1/3
	
				echo '<div class="sidebar-footer"><div>';
					if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 1' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 1' );
				echo '</div></div>';
	
				echo '<div class="sidebar-footer last"><div>';
					if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( 'Footer Sidebar 2' ) ); else st_sidebar_dummy( 'h5', 'Footer Sidebar 2' );
				echo '</div></div>';
				
				echo '<div class="clear"><!-- --></div>';
	
	
			endif; ?>
	
		</div><!-- end footer-box -->