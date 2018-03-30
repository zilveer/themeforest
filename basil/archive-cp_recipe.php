<?php 

// This template is here to replace the Cooked default archive template
// It adds the Basil page wrappers so that the archive looks right

get_header();

if (get_post_type($post->ID) == 'cp_recipe'):

	?><section class="basilHPBlock basilFullContent"><div class="basilShell"><article class="basilPageContent"><?php
			
		global $archive_args;
		$tax = get_queried_object();
		
		switch($tax->taxonomy):
		
			case 'cp_recipe_cooking_method' : 
			
				$tax_title = __('Cooking Method','basil');
				$archive_args = cp_search_args(null,null,$tax->term_id,null);
				break;
			
			case 'cp_recipe_category' : 
				
				$tax_title = __('Category','basil');
				$archive_args = cp_search_args($tax->term_id,null,null,null);
				break;
				
			case 'cp_recipe_cuisine' : 
				
				$tax_title = __('Cuisine','basil');
				$archive_args = cp_search_args(null,$tax->term_id,null,null);
				break;
				
			case 'cp_recipe_tags' : 
				
				$tax_title = __('Recipe Tag','basil');
				$archive_args = cp_search_args(null,null,null,$tax->slug);
				break;
				
		endswitch;
		
		echo '<div class="cookedPageWrapper" style="padding-top:0;">';
		
			echo '<div class="archiveTitleDesc">';
				echo '<h1 style="font-size:35px"><span style="font-weight:300">'.$tax_title.':</span> '.$tax->name.'</h1>';
				if ($tax->description):
					echo '<p>'.$tax->description.'</p>';
				endif;
			echo '</div>';
			
			$list_view = get_option('cp_recipe_list_view');
			if(file_exists(CP_PLUGIN_VIEWS_DIR . $list_view . '.php')) {
				load_template(CP_PLUGIN_VIEWS_DIR . $list_view . '.php');
			}
		echo '</div>';
	
	?></article></div></section><?php

else :
	
	// Page defaults set here
	$postListStyle = ot_get_option('to_general_blog_style','List');
	$bg_color = '';
	if ($postListStyle == 'Panels' && !is_single()) { $content_position = 'full'; } else { $content_position = 'left'; }
	$sectionAnimation = false;
	$hide_title = false;
	$sidebar = false;

	?><section class="basilHPBlock <?php echo $bg_color; ?> basil<?php echo ucwords($content_position); ?>Content"><div class="basilShell">
		
		<article class="basilPageContent">
			<?php
			if (!$hide_title) { basil_page_title(); }
			get_template_part('loop'); # Loop
			?>
		</article>
		
		<?php
		
		// Sidebar
		if ($content_position != 'full') {
		
			?><aside class="basilSidebar"><?php
			
			if ( !$sidebar) {
				$sidebar = 'default-sidebar';
			}
				
			echo '<div class="sidebar ' . basil_get_sidebar_position() . '">';
				echo '<ul class="widgets">';
					dynamic_sidebar($sidebar);
				echo '</ul>';
			echo '</div>';
			
			?></aside><?php
		
		}
		
	?></div></section><?php

endif;

get_footer();