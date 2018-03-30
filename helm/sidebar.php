<?php
/**
*  Sidebar
 */
?>
<?php
global $sidebar_choice;
if ( is_category() || is_archive() || is_search() || is_tag() || is_author() ) {
	unset($sidebar_choice);
}
?>
<div class="sidebar-wrap<?php if ( is_single() || is_page() ) { echo "-single"; } ?> float-right">
	<div class="sidebar">
		<div class="regular-sidebar clearfix">
			<!-- begin sidebar -->
			<!-- begin Dynamic Sidebar -->
			<?php
			if ( !isset($sidebar_choice) || empty($sidebar_choice) ) {
				$sidebar_choice="Default Sidebar";
			}
			//echo "sidebar is: " . $sidebar_choice;
			?>
			<?php if ( !function_exists('dynamic_sidebar') 
			
				|| !dynamic_sidebar($sidebar_choice) ) : ?>
			
			<?php endif; ?>
		</div>
	</div>
	<div class="sidebar-bottom"></div>
</div>