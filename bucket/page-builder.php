<?php
/**
 * Template Name: Custom Page Composer
 */

/*
*  Loop through a Flexible Content field and display it's content with different views for different layouts
*/

get_header();?>
<div class="container container--main">

	<?php 
	//let's remember what post ids we have outputed so we can avoid double posts
	$showed_posts_ids = array();
	
	//let's get to displaying the rows
	while(has_sub_field("blocks")):
		$row_layout = get_row_layout();
		switch ($row_layout) {
			case "billboard_slider":
				get_template_part('theme-partials/acf-layouts/billboard_slider');
				break;
			case "posts_grid_cards":
				get_template_part('theme-partials/acf-layouts/posts_grid_cards');
				break;
			case "hero_posts_module":
				get_template_part('theme-partials/acf-layouts/hero_posts_module');
				break;
			case "latest_posts":
				get_template_part('theme-partials/acf-layouts/latest_posts');
				break;
			case "content":
				get_template_part('theme-partials/acf-layouts/content');
				break;
			case "heading_title":
				get_template_part('theme-partials/acf-layouts/heading_title');
				break;
			default:
				
		}

	endwhile; ?>
</div>
<?php get_footer();

