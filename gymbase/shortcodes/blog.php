<?php
//blog
function theme_blog($atts, $content)
{
	extract(shortcode_atts(array(
		"categories" => "",
		"count" => "3",
		"order" => "desc",
		"orderby" => "date",
		"pagination" => 1
	), $atts));
	$output = "";
	ob_start();
	?>
		<ul class="blog clearfix">
			<?php
			query_posts(array( 
				'post_type' => 'post',
				'post_status' => 'publish',
				's' => get_query_var('s'),
				'posts_per_page' => $count,
				'paged' => get_query_var('paged'),
				'cat' => (get_query_var('cat')!="" ? get_query_var('cat') : $categories),
				'tag' => get_query_var('tag'),
				'monthnum' => get_query_var('monthnum'),
				'day' => get_query_var('day'),
				'year' => get_query_var('year'),
				'w' => get_query_var('week'),
				'order' => $order,
				'orderby' => $orderby
			));
			if(have_posts()) : while (have_posts()) : the_post();
			?>
				<li <?php post_class('class'); ?>>
					<div class="comment_box">
						<div class="first_row">
							<?php the_time("d"); ?><span class="second_row"><?php echo strtoupper(date_i18n("M", get_post_time())); ?></span>
						</div>
						<a class="comments_number" href="<?php comments_link(); ?>" title="<?php comments_number('0 ' . __('Comments', 'gymbase')); ?>">
							<?php comments_number('0 ' . __('Comments', 'gymbase')); ?>
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
							<?php the_excerpt(); ?>
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
							<a class="more icon_small_arrow margin_right_white" href="<?php the_permalink(); ?>" title="<?php _e("More", 'gymbase'); ?>"><?php _e("More", 'gymbase'); ?></a>
						</div>
					</div>
				</li>
			<?php
			endwhile; endif;
			?>
			<?php
			if($pagination)
			{
				gb_get_theme_file("/pagination.php");
				kriesi_pagination();
			}
			//Reset Query
			wp_reset_query();
			?>
		</ul>
	<?php
	$output .= ob_get_contents();
	ob_end_clean();
	
	return $output;  
}
add_shortcode("blog", "theme_blog");

//visual composer
function theme_blog_vc_init()
{
	$post_categories = get_terms("category");

	$categories = array("All" => "");
	foreach($post_categories as $c){
		$cat = get_category($c);
		$categories[$cat->name] = $cat->term_id;
	}
	vc_map(array(
		"name" => __("Blog", 'gymbase'),
		"base" => "blog",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-blog",
		"category" => __('GymBase', 'gymbase'),
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Pagination", 'gymbase'),
				"param_name" => "pagination",
				"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
			),
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Post categories", 'gymbase'),
				"param_name" => "categories",
				"value" => $categories
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Count", 'gymbase'),
				"param_name" => "count",
				"value" => "3"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order", 'gymbase'),
				"param_name" => "order",
				"value" => array(__("DESC", 'gymbase') => "desc", __("ASC", 'gymbase') => "asc")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order by", 'gymbase'),
				"param_name" => "orderby",
				"value" => array(__("Date", 'gymbase') => "date", __("Title", 'gymbase') => "title", __("Menu order", 'gymbase') => "menu_order")
			)
		)
	));
}
add_action("init", "theme_blog_vc_init");
