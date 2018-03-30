<?php
	global $wp_query;
	global $edgt_options;
    global $edgt_template_name;
	$id = $wp_query->get_queried_object_id();

	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }

	$sidebar = $edgt_options['category_blog_sidebar'];

	if(isset($edgt_options['blog_page_range']) && $edgt_options['blog_page_range'] != ""){
		$blog_page_range = esc_attr($edgt_options['blog_page_range']);
	} else{
		$blog_page_range = $wp_query->max_num_pages;
	}
	
	$blog_style = "1";
	if(isset($edgt_options['blog_style'])){
		$blog_style = $edgt_options['blog_style'];
	}

	$filter = "no";
	
	if($edgt_template_name == "blog-masonry-gallery-full-width.php" || $edgt_template_name == "blog-masonry-gallery.php") {
		if(isset($edgt_options['blog_masonry_gallery_filter'])){
			$filter = $edgt_options['blog_masonry_gallery_filter'];
		}
	}
	else {
		if(isset($edgt_options['blog_masonry_filter'])){
			$filter = $edgt_options['blog_masonry_filter'];
		}
	}
	
	
	$blog_list = "";
	if($edgt_template_name != "") {
		if($edgt_template_name == "blog-masonry.php"){
				$blog_list = "blog_masonry";
				$blog_list_class = "masonry";
		}elseif($edgt_template_name == "blog-masonry-full-width.php"){
				$blog_list = "blog_masonry";
				$blog_list_class = "masonry_full_width";			
		}elseif($edgt_template_name == "blog-split-column.php"){
			$blog_list = "blog_split_column";
			$blog_list_class = "blog_split_column";
		}elseif($edgt_template_name == "blog-standard.php"){
            $blog_list = "blog_standard";
            $blog_list_class = "blog_standard_type";
        }elseif($edgt_template_name == "blog-standard-whole-post.php"){
			$blog_list = "blog_standard_whole_post";
			$blog_list_class = "blog_standard_type";
		}elseif($edgt_template_name == "blog-title-author-centered.php"){
            $blog_list = "blog_title_author_centered";
            $blog_list_class = "blog_title_author_centered";
        }elseif($edgt_template_name == "blog-masonry-gallery.php"){
            $blog_list = "blog_masonry_gallery";
            $blog_list_class = "blog_masonry_gallery";
        }elseif($edgt_template_name == "blog-masonry-gallery-full-width.php"){
            $blog_list = "blog_masonry_gallery";
            $blog_list_class = "blog_masonry_gallery masonry_gallery_full_width";
        }else{
			$blog_list = "blog_standard";
			$blog_list_class = "blog_standard_type";
		}
	} else{
		if($blog_style=="1"){
			$blog_list = "blog_standard";
			$blog_list_class = "blog_standard_type";
		}elseif($blog_style=="2"){
			$blog_list = "blog_split_column";
			$blog_list_class = "blog_split_column";
        }elseif($blog_style=="3"){
				$blog_list = "blog_masonry";
				$blog_list_class = "masonry";
        }elseif($blog_style=="4"){
				$blog_list = "blog_masonry";
				$blog_list_class = "masonry_full_width";
        }elseif($blog_style=="5"){
			$blog_list = "blog_title_author_centered";
			$blog_list_class = "blog_title_author_centered";
		}elseif($blog_style=="6"){
			$blog_list = "blog_standard_whole_post";
			$blog_list_class = "blog_standard_type";
		}elseif($blog_style=="7"){
			$blog_list = "blog_masonry_gallery";
			$blog_list_class = "blog_masonry_gallery";
		}elseif($blog_style=="8"){
			$blog_list = "blog_masonry_gallery";
			$blog_list_class = "blog_masonry_gallery masonry_gallery_full_width";
		}else {
			$blog_list = "blog_standard";
			$blog_list_class = "blog_standard_type";
		}
	}

    $pagination_masonry = "pagination";
    if(isset($edgt_options['pagination_masonry'])){
       $pagination_masonry = $edgt_options['pagination_masonry'];
		if($blog_list == "blog_masonry" || $blog_list == "blog_masonry_gallery") {
			$blog_list_class .= " masonry_" . $pagination_masonry;
		}
    }
?>
<?php

	if(($blog_list == "blog_masonry" || $blog_list == "blog_masonry_gallery") && $filter == "yes") {
		get_template_part('templates/blog/masonry', 'filter');

	}

	$blog_masonry_columns = 'three_columns';
	if (isset($edgt_options['blog_masonry_columns']) && $edgt_options['blog_masonry_columns'] !== '') {
		$blog_masonry_columns = $edgt_options['blog_masonry_columns'];
	}

	$blog_masonry_full_width_columns = 'five_columns';
	if (isset($edgt_options['blog_masonry_full_width_columns']) && $edgt_options['blog_masonry_full_width_columns'] !== '') {
		$blog_masonry_full_width_columns = $edgt_options['blog_masonry_full_width_columns'];
	}	
	
	$blog_masonry_gallery_column = 'two_columns';
	if (isset($edgt_options['blog_masonry_gallery_columns']) && $edgt_options['blog_masonry_gallery_columns'] !== '') {
		$blog_masonry_gallery_column = $edgt_options['blog_masonry_gallery_columns'];
	}

	$blog_masonry_gallery_full_width_columns = 'three_columns';
	if (isset($edgt_options['blog_masonry_gallery_full_width_columns']) && $edgt_options['blog_masonry_gallery_full_width_columns'] !== '') {
		$blog_masonry_gallery_full_width_columns = $edgt_options['blog_masonry_gallery_full_width_columns'];
	}
	
	if($edgt_template_name == "blog-masonry.php" || $blog_style == 3 ){
		$blog_list_class .= " " .$blog_masonry_columns;
	}
	
	if($edgt_template_name == "blog-masonry-full-width.php" || $blog_style == 4){
		$blog_list_class .= " " .$blog_masonry_full_width_columns;
	}
	
	if($edgt_template_name == "blog-masonry-gallery.php" || $blog_style == 7 ){
		$blog_list_class .= " " .$blog_masonry_gallery_column;
	}
	
	if($edgt_template_name == "blog-masonry-gallery-full-width.php" || $blog_style == 8){
		$blog_list_class .= " " .$blog_masonry_gallery_full_width_columns;
	}

	
	$icon_left_html =  "<i class='pagination_arrow arrow_carrot-left'></i>";
	if (isset($edgt_options['pagination_arrows_type']) && $edgt_options['pagination_arrows_type'] != '') {
		$icon_navigation_class = $edgt_options['pagination_arrows_type'];
		$direction_nav_classes = edgt_horizontal_slider_icon_classes($icon_navigation_class);
		$icon_left_html = '<span class="pagination_arrow ' . $direction_nav_classes['left_icon_class']. '"></span>';
	}
	
	$icon_left_html .= '<span class="pagination_label">';
	if (isset($edgt_options['blog_pagination_next_label']) && $edgt_options['blog_pagination_next_label'] != '') {
		$icon_left_html.= $edgt_options['blog_pagination_next_label'];
	}
	else{
		$icon_left_html .= "Next";
	}
	$icon_left_html .= '</span>';


	$icon_right_html = '<span class="pagination_label">';
	if (isset($edgt_options['blog_pagination_previous_label']) && $edgt_options['blog_pagination_previous_label'] != '') {
		$icon_right_html .= $edgt_options['blog_pagination_previous_label'];
	}
	else {
		$icon_right_html .= "Previous";
	}
	$icon_right_html .= '</span>';

	if (isset($edgt_options['pagination_arrows_type']) && $edgt_options['pagination_arrows_type'] != '') {
		$icon_navigation_class = $edgt_options['pagination_arrows_type'];
		$direction_nav_classes = edgt_horizontal_slider_icon_classes($icon_navigation_class);
		$icon_right_html .= '<span class="pagination_arrow ' . $direction_nav_classes['right_icon_class']. '"></span>';
	}
	else{
		$icon_right_html .=  "<i class='pagination_arrow arrow_carrot-right'></i>";
	}

	?>

	<div class="blog_holder <?php echo esc_attr($blog_list_class); ?>">
		
	<?php if($blog_list == "blog_masonry" || $blog_list == "blog_masonry_gallery" ) { ?>
		<div class="blog_holder_grid_sizer"></div>
		<div class="blog_holder_grid_gutter"></div>
	<?php } ?>
	<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
		<?php
			get_template_part('templates/blog/'.$blog_list, 'loop');
		?>
	<?php endwhile; ?>
	<?php if($blog_list != "blog_masonry" && $blog_list != "blog_masonry_gallery") {
		if ($edgt_options['blog_pagination_type'] == 'standard'){
				edgt_pagination($wp_query->max_num_pages, $blog_page_range, $paged);
			}
		elseif ($edgt_options['blog_pagination_type'] == 'prev_and_next'){?>
			<div class="pagination_prev_and_next_only">
				<ul>
					<li class='prev'><?php echo wp_kses_post(get_previous_posts_link($icon_left_html)); ?></li>
					<li class='next'><?php echo wp_kses_post(get_next_posts_link($icon_right_html)); ?></li>
				</ul>
			</div>
		<?php } ?>
	<?php } ?>
	<?php else: //If no posts are present ?>
	<div class="entry">
			<p><?php _e('No posts were found.', 'edgt'); ?></p>
	</div>
	<?php endif; ?>
</div>
<?php if($blog_list == "blog_masonry" || $blog_list == "blog_masonry_gallery") {
    if($pagination_masonry == "load_more") {
		if (get_next_posts_link()) { ?>
			<div class="blog_load_more_button_holder">
				<div class="blog_load_more_button"><span data-rel="<?php echo esc_attr($wp_query->max_num_pages); ?>"><?php echo wp_kses_post(get_next_posts_link(__('Show more', 'edgt'))); ?></span></div>
			</div>
		<?php } ?>
	 <?php } elseif($pagination_masonry == "infinite_scroll") { ?>
		<div class="blog_infinite_scroll_button"><span data-rel="<?php echo esc_attr($wp_query->max_num_pages); ?>"><?php echo wp_kses_post(get_next_posts_link(__('Show more', 'edgt'))); ?></span></div>
    <?php }else { ?>
        <?php if($edgt_options['blog_pagination_type'] == 'standard' && $edgt_options['pagination'] != "0") {
				edgt_pagination($wp_query->max_num_pages, $blog_page_range, $paged);
            }
        	elseif ($edgt_options['blog_pagination_type'] == 'prev_and_next'){ ?>
				<div class="pagination_prev_and_next_only">
					<ul>
						<li class='prev'><?php echo wp_kses_post(get_previous_posts_link($icon_left_html)); ?></li>
						<li class='next'><?php echo wp_kses_post(get_next_posts_link($icon_right_html)); ?></li>
					</ul>
				</div>
		<?php } ?>
    <?php } ?>
<?php } ?>