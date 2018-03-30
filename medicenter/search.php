<?php
/*
Template Name: Search
*/
get_header();
?>
<div class="theme_page relative">
	<div class="page_layout page_margin_top clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<h1 class="page_title"><?php _e("Search results", 'medicenter'); ?></h1>
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
						<?php _e("Results for phrase:", 'medicenter'); echo " " . esc_attr(get_query_var('s')); ?>
					</li>
				</ul>
			</div>
			<?php
			/*get page with single post template set*/
			$post_template_page_array = get_pages(array(
				'post_type' => 'page',
				'post_status' => 'publish',
				'number' => 1,
				'meta_key' => '_wp_page_template',
				'meta_value' => 'search.php'
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
			echo wpb_js_remove_wpautop(apply_filters('the_content', $post_template_page->post_content));
			global $post;
			$post = $post_template_page;
			setup_postdata($post);
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
?>
<div class="theme_page relative">
	<div class="page_layout clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<h1><?php _e("Search results", 'medicenter'); ?></h1>
				<h4><?php _e("The results for phrase:", 'medicenter'); echo " " . get_query_var('s'); ?></h4>
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
				<a href="<?php echo get_home_url(); ?>" title="<?php _e('Home', 'medicenter'); ?>">
					<?php _e('Home', 'medicenter'); ?>
				</a>
			</li>
			<li class="separator icon_small_arrow right_white">
				&nbsp;
			</li>
			<li>
				<?php _e("Search results", 'medicenter'); ?>
			</li>
		</ul>
		<div class="page_left">
			<ul class="blog clearfix">
				<?php
				query_posts(array( 
					'post_type' => 'post',
					'post_status' => 'publish',
					's' => get_query_var('s'),
					//'posts_per_page' => 3,
					'paged' => get_query_var('paged'),
					'order' => get_post_meta(get_the_ID(), $themename . "_blog_order", true)
				));
				if(have_posts()) : while (have_posts()) : the_post();
				?>
					<li <?php post_class('class'); ?>>
						<div class="comment_box">
							<div class="first_row">
								<?php the_time("d"); ?><span class="second_row"><?php the_time("M"); ?></span>
							</div>
							<a class="comments_number" href="<?php comments_link(); ?>" title="<?php comments_number('0 ' . __('Comments', 'medicenter')); ?>">
								<?php comments_number('0 ' . __('Comments', 'medicenter')); ?>
							</a>
						</div>
						<div class="post_content">
							<?php
							if(has_post_thumbnail()):
							?>
							<a class="post_image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
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
									<li class="posted_by"><?php _e('Posted by', 'medicenter'); ?> <a class="author" href="<?php the_author_link(); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a></li>
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
								<a class="more icon_small_arrow margin_right_white" href="<?php the_permalink(); ?>" title="<?php _e("More", 'medicenter'); ?>"><?php _e("More", 'medicenter'); ?></a>
							</div>
						</div>
					</li>
				<?php
				endwhile; 
				else:
					?>
					<li class="post">
					<?php
					_e("No results found.", 'medicenter');
					?>
					</li>
					<?php
				endif;
				?>
				<?php
				require_once("pagination.php");
				kriesi_pagination("", 2, true);
				//Reset Query
				wp_reset_query();
				?>
			</ul>
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