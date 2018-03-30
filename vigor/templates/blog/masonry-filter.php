<?php
global $edgt_page_id;
global $edgt_options;
global $edgt_template_name;

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

$show_filter_title = "no";
if($edgt_template_name == "blog-masonry-gallery-full-width.php" || $edgt_template_name == "blog-masonry-gallery.php") {
	if(isset($edgt_options['blog_masonry_gallery_enable_filter_title'])){
		$show_filter_title = $edgt_options['blog_masonry_gallery_enable_filter_title'];
	}
}
else {
	if(isset($edgt_options['blog_masonry_enable_filter_title'])){
    	$show_filter_title = $edgt_options['blog_masonry_enable_filter_title'];
	}
}

$blog_masnory_filter_class = "";
if($edgt_template_name == "blog-masonry-gallery-full-width.php" || $edgt_template_name == "blog-masonry-gallery.php") {
	if (isset($edgt_options['blog_masonry_gallery_filter_disable_separator']) && !empty($edgt_options['blog_masonry_gallery_filter_disable_separator'])){
		if($edgt_options['blog_masonry_gallery_filter_disable_separator'] == "yes"){
			$blog_masnory_filter_class = "without_separator";
		} else {
			$blog_masnory_filter_class = "";
		}
	}
}
else {
	if (isset($edgt_options['blog_masonry_filter_disable_separator']) && !empty($edgt_options['blog_masonry_filter_disable_separator'])){
		if($edgt_options['blog_masonry_filter_disable_separator'] == "yes"){
			$blog_masnory_filter_class = "without_separator";
		} else {
			$blog_masnory_filter_class = "";
		}
	}
}

$page_category = get_post_meta($edgt_page_id, "edgt_choose-blog-category", true);
if(is_category()){
	$page_category = get_query_var( 'cat' );
}
if ($page_category == "" && !is_category()) {
                $args = array(
                    'parent' => 0
                );
                $categories = get_categories( $args );
            } else {
                $args = array(
                    'parent' => $page_category
                );
                $categories = get_categories( $args );
            }
if ($filter == "yes" && count($categories) > 0) {	?>

			<div class="filter_outer filter_blog">
				<div class="filter_holder <?php echo esc_attr($blog_masnory_filter_class); ?>">
					<ul>
                        <?php if($show_filter_title == "yes"){ ?>
                            <li class='filter_title'><span><?php _e('Sort Blog:', 'edgt'); ?></span></li>
                       <?php }?>
						<li class="filter" data-filter="*"><span><?php _e('All', 'edgt'); ?></span></li>
						<?php foreach ($categories as $category) { ?>
							 <li class="filter" data-filter="<?php echo ".category-" . esc_attr($category->slug); ?>"><span><?php echo esc_html($category->name); ?></span></li>
						<?php } ?>
					</ul>
				</div>
			</div>

      <?php  }
?>
