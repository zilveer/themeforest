<?php 
/*
Template Name: Blog
*/
get_header();
?>
<div class="theme_page relative">
	<div class="page_layout clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<?php
				if(is_archive())
				{
					if(is_day())
						$archive_header = __("Daily archives: ", 'gymbase') . get_the_date(); 
					else if(is_month())
						$archive_header = __("Monthly archives: ", 'gymbase') . get_the_date('F, Y');
					else if(is_year())
						$archive_header = __("Yearly archives: ", 'gymbase') . get_the_date('Y');
					else
						$archive_header = "Archives";
				}
				?>
				<h1><?php echo (is_category() || is_archive() ? (is_category() ? single_cat_title("", false) : $archive_header) : get_the_title());?></h1>
				<h4><?php echo (is_category() || is_archive() ? "" : get_post_meta(get_the_ID(), $themename. "_subtitle", true)); ?></h4>
			</div>
			<div class="page_header_right">
				<?php
				get_sidebar('header');
				?>
			</div>
		</div>
		<ul class="bread_crumb clearfix">
			<li><?php _e('You are here:', 'gymbase'); ?></li>
			<li>
				<a href="<?php echo get_home_url(); ?>" title="<?php _e('Home', 'gymbase'); ?>">
					<?php _e('Home', 'gymbase'); ?>
				</a>
			</li>
			<li class="separator icon_small_arrow right_white">
				&nbsp;
			</li>
			<li>
				<?php the_title(); ?>
			</li>
		</ul>
		<div class="clearfix horizontal">
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
				
				echo wpb_js_remove_wpautop(apply_filters('the_content', $post_template_page->post_content));
				global $post;
				$post = $post_template_page;
				setup_postdata($post);
			} else {
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