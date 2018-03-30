<?php 
/*
Template Name: Blog
*/
get_header();
?>
<div class="theme_page relative">
	<div class="page_layout page_margin_top clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<?php
				if(is_archive())
				{
					if(is_day())
						$archive_header = __("Daily archives: ", 'medicenter') . get_the_date(); 
					else if(is_month())
						$archive_header = __("Monthly archives: ", 'medicenter') . get_the_date('F, Y');
					else if(is_year())
						$archive_header = __("Yearly archives: ", 'medicenter') . get_the_date('Y');
					else
						$archive_header = "Archives";
				}
				?>
				<h1 class="page_title"><?php echo (is_category() || is_archive() ? (is_category() ? single_cat_title("", false) : $archive_header) : get_the_title());?></h1>
				<ul class="bread_crumb">
					<li>
						<a href="<?php echo get_home_url(); ?>" title="<?php _e('Home', 'medicenter'); ?>">
							<?php _e('Home', 'medicenter'); ?>
						</a>
					</li>
					<li class="separator icon_small_arrow right_gray">
						&nbsp;
					</li>
					<li>
						<?php echo (is_category() || is_archive() ? (is_category() ? single_cat_title("", false) : $archive_header) : get_the_title());?>
					</li>
				</ul>
			</div>
			<?php
			if(is_category() || is_archive())
			{
				/*get page with blog template set*/
				$post_template_page_array = get_pages(array(
					'post_type' => 'page',
					'post_status' => 'publish',
					'number' => 1,
					'meta_key' => '_wp_page_template',
					'meta_value' => 'template-blog.php',
					'sort_order' => 'ASC',
					'sort_column' => 'menu_order',
				));
				$post_template_page = $post_template_page_array[0];
				$sidebar = get_post(get_post_meta($post_template_page->ID, "page_sidebar_header", true));
			}
			else
				$sidebar = get_post(get_post_meta(get_the_ID(), "page_sidebar_header", true));
			?>
			<div class="page_header_right">
				<?php
				if(!(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name))
					dynamic_sidebar($sidebar->post_name);
				?>
			</div>
		</div>
		<div class="clearfix">
			<?php
			if(is_category() || is_archive())
			{
				echo wpb_js_remove_wpautop(apply_filters('the_content', $post_template_page->post_content));
				global $post;
				$post = $post_template_page;
				setup_postdata($post);
			}
			else
			{
				if(have_posts()) : while (have_posts()) : the_post();
					the_content();
				endwhile; endif;
			}
			?>
		</div>		
	</div>
</div>
<?php
get_footer(); 
?>