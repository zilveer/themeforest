<?php get_header(); ?>
<div class="theme_page relative">
	<div class="page_layout page_margin_top clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<h1 class="page_title"><?php echo __("Latest Posts", 'medicenter'); ?></h1>
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
						<?php echo __("Latest Posts", 'medicenter');?>
					</li>
				</ul>
			</div>
		</div>
		<div class="clearfix">
			<?php
			if(function_exists("vc_map"))
				echo do_shortcode(apply_filters('the_content', '[vc_row top_margin="page_margin_top" el_position="first last"][vc_column width="2/3"][box_header title="Latest News" bottom_border="1" animation="1" el_position="first"][blog mc_pagination="0" items_per_page="4" layout_type="2" ids="-" category="-" order_by="date" show_post_title="1" read_more="0" show_post_categories="1" show_post_author="0" show_post_date_box="1" show_post_comments_box="1" show_post_comments_label="0" show_post_date_footer="0" show_post_comments_footer="0"][show_all_button title="Show all →" el_position="last"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="sidebar-home-right" el_position="first last"][/vc_column][/vc_row]'));	
			else
			{
				require_once(get_template_directory() . "/shortcodes/blog.php");
				echo do_shortcode('<div class="vc_row wpb_row vc_row-fluid page_margin_top"><div class="wpb_column vc_column_container vc_col-sm-8"><div class="wpb_wrapper">[box_header title="Latest News" bottom_border="1" animation="1" el_position="first"][blog mc_pagination="0" items_per_page="4" layout_type="2" ids="-" category="-" order_by="date" show_post_title="1" read_more="0" show_post_categories="1" show_post_author="0" show_post_date_box="1" show_post_comments_box="1" show_post_comments_label="0" show_post_date_footer="0" show_post_comments_footer="0"][show_all_button title="Show all →" el_position="last"]</div></div></div>');
			}
			paginate_links();
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>