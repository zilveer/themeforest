<?php
/*
Template Name: 404 page
*/
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
get_header();
?>
<div class="theme_page relative">
	<div class="page_layout page_margin_top clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
			<?php
			/*get page with 404 page template set*/
			$not_found_template_page_array = get_pages(array(
				'post_type' => 'page',
				'post_status' => 'publish',
				'number' => 1,
				'meta_key' => '_wp_page_template',
				'meta_value' => '404.php'
			));
			$not_found_template_page = $not_found_template_page_array[0];
			?>
				<h1 class="page_title"><?php echo $not_found_template_page->post_title; ?></h1>
				<ul class="bread_crumb">
					<li>
						<a href="<?php echo get_home_url(); ?>" title="<?php _e('Home', 'medicenter'); ?>">
							<?php _e('Home', 'medicenter'); ?>
						</a>
					</li>
				</ul>
			</div>
			<?php
			$sidebar = get_post(get_post_meta($not_found_template_page->ID, "page_sidebar_header", true));
			if(!(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name)):
			?>
			<div class="page_header_right">
				<?php
				dynamic_sidebar($sidebar->post_name);
				?>
			</div>
			<?php
			endif;
			?>
		</div>
		<div class="clearfix">
			<h1 class="not_found page_margin_top_section"><?php _e("404", 'medicenter'); ?></h1>
			<h1 class="page_margin_top_section"><?php _e("Error 404", 'medicenter'); ?></h1>
			<?php
			echo wpb_js_remove_wpautop(apply_filters('the_content', $not_found_template_page->post_content));
			global $post;
			$post = $not_found_template_page;
			setup_postdata($post);
			/*?>
			<?php _e("Looks like the page you are looking for does not exists.<br />
			If you came here from a bookmark, please remember to update your bookmark", 'medicenter'); ?></p>
			<a title="<?php _esc_attr_e('Go Back To Homepage', 'medicenter'); ?>" href="<?php echo get_home_url(); ?>" class="more blue medium page_margin_top_section"><?php _e("Go Back To Homepage", 'medicenter'); ?></a>
			*/?>
		</div>
	</div>
</div>
<?php
get_footer(); 
?>
