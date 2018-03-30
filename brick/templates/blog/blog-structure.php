<?php
	global $wp_query;
	global $qode_options;
    global $qode_template_name;
	$id = $wp_query->get_queried_object_id();

	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }

	$sidebar = $qode_options['category_blog_sidebar'];

	if(isset($qode_options['blog_page_range']) && $qode_options['blog_page_range'] != ""){
		$blog_page_range = esc_attr($qode_options['blog_page_range']);
	} else{
		$blog_page_range = $wp_query->max_num_pages;
	}
	
	$masonry_ql_icon_class = 'show_ql_icons';
	if(isset($qode_options['blog_masonry_show_ql_mark']) && $qode_options['blog_masonry_show_ql_mark'] == "no"){
		$masonry_ql_icon_class = '';
	} 
	
	$blog_style = "1";
	if(isset($qode_options['blog_style'])){
		$blog_style = $qode_options['blog_style'];
	}

	$filter = "no";
	if($qode_template_name == "blog-masonry-gallery-full-width.php" || $qode_template_name == "blog-masonry-gallery.php" || $blog_style==14 || $blog_style== 15) {
		if(isset($qode_options['blog_masonry_gallery_filter'])){
			$filter = $qode_options['blog_masonry_gallery_filter'];
		}
	}
	else {
		if(isset($qode_options['blog_masonry_filter'])){
			$filter = $qode_options['blog_masonry_filter'];
		}
	}
	
	
	$blog_masonry_type = "blog_masonry_standard";
	if(isset($qode_options['blog_masonry_choose_type'])){
		$blog_masonry_type = $qode_options['blog_masonry_choose_type'];
	} 

	$blog_list = "";
	if($qode_template_name != "") {
		if($qode_template_name == "blog-masonry.php"){
			$blog_list = "blog_masonry";
			$blog_list_class = "masonry";
		}elseif($qode_template_name == "blog-split-column.php"){
			$blog_list = "blog_split_column";
			$blog_list_class = "blog_split_column";
		}elseif($qode_template_name == "blog-masonry-full-width.php"){
			$blog_list = "blog_masonry";
			$blog_list_class = "masonry_full_width " .$masonry_ql_icon_class;
		}elseif($qode_template_name == "blog-standard.php"){
            $blog_list = "blog_standard";
            $blog_list_class = "blog_standard_type";
        }elseif($qode_template_name == "blog-standard-whole-post.php"){
			$blog_list = "blog_standard_whole_post";
			$blog_list_class = "blog_standard_type";
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
			$blog_list_class = "masonry_full_width " .$masonry_ql_icon_class;
        }elseif($blog_style=="5"){
			$blog_list = "blog_standard_whole_post";
			$blog_list_class = "blog_standard_type";
		}else {
			$blog_list = "blog_standard";
			$blog_list_class = "blog_standard_type";
		}
	}

    $pagination_masonry = "pagination";
    if(isset($qode_options['pagination_masonry'])){
       $pagination_masonry = $qode_options['pagination_masonry'];
	   $blog_list_class .= " masonry_" . $pagination_masonry;
    }
?>
<?php

	if($blog_list == "blog_masonry" && $filter == "yes") {
		get_template_part('templates/blog/masonry', 'filter');

	}

	$blog_masonry_columns = 'three_columns';
	if (isset($qode_options['blog_masonry_columns']) && $qode_options['blog_masonry_columns'] !== '') {
		$blog_masonry_columns = $qode_options['blog_masonry_columns'];
	}

	$blog_masonry_full_width_columns = 'five_columns';
	if (isset($qode_options['blog_masonry_full_width_columns']) && $qode_options['blog_masonry_full_width_columns'] !== '') {
		$blog_masonry_full_width_columns = $qode_options['blog_masonry_full_width_columns'];
	}
	
	if($qode_template_name == "blog-masonry.php" || $blog_style == 3 ){
		$blog_list_class .= " " .$blog_masonry_columns;
	}
	
	if($qode_template_name == "blog-masonry-full-width.php" || $blog_style == 4){
		$blog_list_class .= " " .$blog_masonry_full_width_columns;
	}
	
	$icon_left_html =  "<i class='pagination_arrow arrow_carrot-left'></i>";
	if (isset($qode_options['pagination_arrows_type']) && $qode_options['pagination_arrows_type'] != '') {
		$icon_navigation_class = $qode_options['pagination_arrows_type'];
		$direction_nav_classes = qode_horizontal_slider_icon_classes($icon_navigation_class);
		$icon_left_html = '<span class="pagination_arrow ' . $direction_nav_classes['left_icon_class']. '"></span>';
	}
	
	$icon_left_html .= '<span class="pagination_label">';
	if (isset($qode_options['blog_pagination_next_label']) && $qode_options['blog_pagination_next_label'] != '') {
		$icon_left_html.= $qode_options['blog_pagination_next_label'];
	}
	else{
		$icon_left_html .= "Next";
	}
	$icon_left_html .= '</span>';


	$icon_right_html = '<span class="pagination_label">';
	if (isset($qode_options['blog_pagination_previous_label']) && $qode_options['blog_pagination_previous_label'] != '') {
		$icon_right_html .= $qode_options['blog_pagination_previous_label'];
	}
	else {
		$icon_right_html .= "Previous";
	}
	$icon_right_html .= '</span>';

	if (isset($qode_options['pagination_arrows_type']) && $qode_options['pagination_arrows_type'] != '') {
		$icon_navigation_class = $qode_options['pagination_arrows_type'];
		$direction_nav_classes = qode_horizontal_slider_icon_classes($icon_navigation_class);
		$icon_right_html .= '<span class="pagination_arrow ' . $direction_nav_classes['right_icon_class']. '"></span>';
	}
	else{
		$icon_right_html .=  "<i class='pagination_arrow arrow_carrot-right'></i>";
	}

	?>

	<div class="blog_holder <?php echo esc_attr($blog_list_class); ?>">
		
	<?php if($blog_list == "blog_masonry") { ?>
		<div class="blog_holder_grid_sizer"></div>
		<div class="blog_holder_grid_gutter"></div>
	<?php } ?>
	<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
		<?php
			get_template_part('templates/blog/'.$blog_list, 'loop');
		?>
	<?php endwhile; ?>
	<?php if($blog_list != "blog_masonry") {
		if ($qode_options['blog_pagination_type'] == 'standard'){
				qode_pagination($wp_query->max_num_pages, $blog_page_range, $paged);
			}
		elseif ($qode_options['blog_pagination_type'] == 'prev_and_next'){?>
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
			<p><?php _e('No posts were found.', 'qode'); ?></p>
	</div>
	<?php endif; ?>
</div>
<?php if($blog_list == "blog_masonry" || $blog_style == 3 || $blog_style == 4) {
    if($pagination_masonry == "load_more") {
		if (get_next_posts_link()) { ?>
			<div class="blog_load_more_button_holder">
				<div class="blog_load_more_button"><span data-rel="<?php echo esc_attr($wp_query->max_num_pages); ?>"><?php echo wp_kses_post(get_next_posts_link(__('Show more', 'qode'))); ?></span></div>
			</div>
		<?php } ?>
	 <?php } elseif($pagination_masonry == "infinite_scroll") { ?>
		<div class="blog_infinite_scroll_button"><span data-rel="<?php echo esc_attr($wp_query->max_num_pages); ?>"><?php echo wp_kses_post(get_next_posts_link(__('Show more', 'qode'))); ?></span></div>
    <?php }else { ?>
        <?php if($qode_options['blog_pagination_type'] == 'standard' && $qode_options['pagination'] != "0") {
				qode_pagination($wp_query->max_num_pages, $blog_page_range, $paged);
            }
        	elseif ($qode_options['blog_pagination_type'] == 'prev_and_next'){ ?>
				<div class="pagination_prev_and_next_only">
					<ul>
						<li class='prev'><?php echo wp_kses_post(get_previous_posts_link($icon_left_html)); ?></li>
						<li class='next'><?php echo wp_kses_post(get_next_posts_link($icon_right_html)); ?></li>
					</ul>
				</div>
		<?php } ?>
    <?php } ?>
<?php } ?>

