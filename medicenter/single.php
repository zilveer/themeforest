<?php
/*
Template Name: Single post
*/
get_header();
setPostViews(get_the_ID());
?>
<div class="theme_page relative">
	<div class="page_layout page_margin_top clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<h1 class="page_title"><?php the_title(); ?></h1>
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
						<?php the_title(); ?>
					</li>
				</ul>
			</div>
			<?php
			/*get page with single post template set*/
			$post_template_page_array = get_pages(array(
				'post_type' => 'page',
				'post_status' => 'publish',
				//'number' => 1,
				'meta_key' => '_wp_page_template',
				'meta_value' => 'single.php'
			));
			$post_template_page = $post_template_page_array[0];
			$sidebar = get_post(get_post_meta($post_template_page->ID, "page_sidebar_header", true));
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
			<?php
			if(count($post_template_page_array) && isset($post_template_page))
			{
				echo wpb_js_remove_wpautop(apply_filters('the_content', $post_template_page->post_content));
				global $post;
				$post = $post_template_page;
				setup_postdata($post);
			}
			else
				echo wpb_js_remove_wpautop(apply_filters('the_content', '[vc_row top_margin="none" el_position="first last"] [vc_column top_margin="none" width="2/3"] [single_post featured_image_size="default" columns="1" show_post_categories="1" show_post_author="1" comments="1" lightbox_icon_color="blue_light" el_position="first last"] [/vc_column] [vc_column top_margin="none" width="1/3"] [vc_widget_sidebar sidebar_id="sidebar-blog" top_margin="page_margin_top" el_position="first"] [box_header title="Photostream" type="h3" bottom_border="1" top_margin="page_margin_top_section"] [photostream id="photostream" images="21,15,16,17,18,19" featured_image_size="default" lightbox_icon_color="blue_light" images_loop="1" top_margin="none"] [vc_widget_sidebar sidebar_id="sidebar-blog-2" top_margin="page_margin_top_section" el_position="last"] [/vc_column] [/vc_row]'));
			?>
		</div>
	</div>
</div>
<?php
get_footer();
?>


<?php
/*
get_header();
setPostViews(get_the_ID());
?>
<div class="theme_page relative">
	<div class="page_layout clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<h1><?php the_title(); ?></h1>
				<h4><?php echo get_post_meta(get_the_ID(), $themename. "_subtitle", true); ?></h4>
			</div>
			<div class="page_header_right">
				<?php
				get_sidebar('header');
				?>
			</div>
		</div>
		<ul class="bread_crumb clearfix">
			<li>You are here:</li>
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
		
		<div class="page_left">
			<ul class="blog clearfix">
				<?php
				if(have_posts()) : while (have_posts()) : the_post();
				?>
					<li <?php post_class('class'); ?>>
						<div class="comment_box">
							<div class="first_row">
								<?php the_time("d"); ?><span class="second_row"><?php echo strtoupper(date_i18n("M", get_the_time())); ?></span>
							</div>
							<a class="comments_number" href="<?php comments_link(); ?>" title="<?php comments_number('0 ' . __('Comments', 'gymbase')); ?>">
								<?php comments_number('0 ' . __('Comments', 'gymbase')); ?>
							</a>
						</div>
						<div class="post_content">
							<?php
							if(has_post_thumbnail()):
								$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "large");
								$large_image_url = $attachment_image[0];
							?>
							<a class="post_image fancybox" href="<?php echo $large_image_url; ?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail("blog-post-thumb", array("alt" => get_the_title(), "title" => "")); ?>
							</a>
							<?php
							endif;
							?>
							<h2>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a>
							</h2>
							<div class="text">
								<?php the_content(); ?>
							</div>
							<div class="post_footer">
								<ul class="categories">
									<li class="posted_by"><?php _e('Posted by', 'gymbase'); echo " "; if(get_the_author_meta("user_url")!=""):?><a class="author" href="<?php the_author_meta("user_url"); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a><?php else: the_author(); endif; ?></li>
									<?php
									$categories = get_the_category();
									foreach($categories as $key=>$category)
									{
										?>
										<li>
											<a href="<?php echo get_category_link($category->term_id ); ?>" title="<?php echo (empty($category->description) ? sprintf(__('View all posts filed under %s', 'gymbase'), $category->name) : esc_attr(strip_tags(apply_filters('category_description', $category->description, $category)))); ?>">
												<?php echo $category->name; ?>
											</a>
										</li>
									<?php
									}
									?>
								</ul>
							</div>
						</div>
					</li>
				<?php
				endwhile; endif;
				?>
			</ul>
			<?php
			comments_template();
			require_once("comments-form.php");
			?>
		</div>
	    <div class="page_right">
			<?php
			if(is_active_sidebar('blog'))
				get_sidebar('blog');
			?>
		</div>
	</div>
</div>
<?php
get_footer();
*/
?>