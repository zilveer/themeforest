<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;

$options = array(
	'blog_layout_style' => 'standard',
	'blog_smart_grid' => '',
	'blog_items_offset' => 0,
	'blog_show_title' => false,
	'blog_show_meta' => false,
	'blog_heading_position' => 'bottom',
	'blog_show_description' => false,
	'blog_content_alignment' => false,
	'blog_show_read_more_share' => false,
	'blog_read_more_style' => false,
	'blog_share_style' => false,
	'blog_sort_panel' => false,
	'blog_sort_panel_align' => false,
	'blog_item_appear_effect' => false,
	'blog_comments_likes_style' => '',
	'blog_show_comments' => 'on',
	'blog_show_likes' => 'on',
);

foreach($options as $k => $v) {
	$options[$k] = DfdMetaBoxSettings::compared($k, $v);
}

$data_atts = $sort_panel_html = $media_content_file = $cover_class = $animation_data = $share_style = $additiional_class = $title_position = $show_read_more_share = $blog_css = '';

$title_position = $options['blog_heading_position'];

$show_read_more_share = $options['blog_show_read_more_share'];

$blog_number = get_post_meta($post->ID, 'blog_works_per_page', true);

$number_per_page = ($blog_number) ? $blog_number : '16';

if($options['blog_share_style']) $share_style = 'dfd-share-'.$options['blog_share_style'];

$blog_custom_categories = array();

$selected_custom_categories = wp_get_object_terms($post->ID, 'category');
if (!empty($selected_custom_categories) && !is_wp_error($selected_custom_categories)) {
	foreach ($selected_custom_categories as $term) {
		$blog_custom_categories[] = $term->term_id;
	}
}

$cover_class .= $options['blog_content_alignment'];

if(!empty($options['blog_item_appear_effect'])) {
	$cover_class .= ' cr-animate-gen';
	$animation_data .= 'data-animate-type="'.esc_attr($options['blog_item_appear_effect']).'"';
}

//if ($blog_custom_categories) {
//	$blog_custom_categories = implode(",", $blog_custom_categories);
//}

if (is_front_page()) {
	$page = get_query_var('page');
	$paged = ($page) ? $page : 1;
} else {
	$page = get_query_var('paged');
	$paged = ($page) ? $page : 1;
}

if ($blog_custom_categories) {
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => $number_per_page,
		'paged' => $paged,
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $blog_custom_categories,
			)
		)
	);
} else {
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => $number_per_page,
		'paged' => $paged
	);
}

$item_css = $block_css = $before_content = $after_content = $blog_items_offset = '';
if($options['blog_items_offset']) {
	$blog_items_offset = $options['blog_items_offset'] / 2;
	$blog_css .= '#layout.dfd-blog-loop .dfd-blog {margin: -'.esc_attr($blog_items_offset).'px;}';
	$blog_css .= '#layout.dfd-blog-loop .dfd-blog .post .cover {padding: '.esc_attr($blog_items_offset).'px;}';
}

if(strcmp($options['blog_layout_style'], 'left-image') === 0 || strcmp($options['blog_layout_style'], 'right-image') === 0) {
	//$media_content_file .= 'fitRows-';
	$before_content .= '<div class="dfd-content-wrap">';
	$after_content .= '</div>';
}
if(strcmp($options['blog_layout_style'], 'masonry') === 0 || strcmp($options['blog_layout_style'], 'fitRows') === 0) {
	wp_enqueue_script('isotope');
	//wp_enqueue_script('dfd-isotope-blog');
	$blog_page_columns = DfdMetaBoxSettings::compared('blog_columns', 1);
	
	$data_atts .= ' data-columns="'.esc_attr($blog_page_columns).'"';
	$data_atts .= ' data-layout-style="'.esc_attr($options['blog_layout_style']).'"';
	$data_atts .= ' data-item="post"';
	
	$additiional_class .= ' dfd-new-isotope';
	
	if(strcmp($options['blog_sort_panel'],'on') === 0) {
		$taxonomy = 'category';
		if ($blog_custom_categories) {
			$categories = get_terms($taxonomy, array('include' => $blog_custom_categories));
		} else {
			$categories = get_terms($taxonomy);
		}
		$sort_panel_html .= '<div class="clearfix">';
			$sort_panel_html .= '<div class="sort-panel '.esc_attr($options['blog_sort_panel_align']).'">';
				$sort_panel_html .= '<ul class="filter">';
					$sort_panel_html .= '<li class="active"><a data-filter=".post" href="#">'. __('All', 'dfd') .'</a></li>';
					foreach ($categories as $category) {
						$sort_panel_html .= '<li><a data-filter=".post[data-category~=\'' . strtolower(preg_replace('/\s+/', '-', $category->slug)) . '\']" href="#">' . $category->name . '</a></li>';
					}
				$sort_panel_html .= '</ul>';
			$sort_panel_html .= '</div>';
		$sort_panel_html .= '</div>';
	}
	$media_content_file .= $options['blog_layout_style'].'-';
	if(strcmp($options['blog_layout_style'], 'fitRows') === 0 && !empty($options['blog_smart_grid']) && $options['blog_smart_grid'] == 'on') {
		$additiional_class .= ' dfd-smart-grid';
		$title_position = 'top';
		$show_read_more_share = 'off';
		if($options['blog_items_offset']) {
			$blog_css .= '#layout.dfd-blog-loop .dfd-blog-wrap .dfd-blog-masonry.dfd-smart-grid .post .dfd-blog-heading-wrap, #layout.dfd-blog-loop .dfd-blog-wrap .dfd-blog-fitRows.dfd-smart-grid .post .dfd-blog-heading-wrap {top: '.esc_attr($blog_items_offset).'px;}';
			$blog_css .= '#layout.dfd-blog-loop .dfd-blog-wrap .dfd-blog-masonry.dfd-smart-grid .post .entry-content, #layout.dfd-blog-loop .dfd-blog-wrap .dfd-blog-fitRows.dfd-smart-grid .post .entry-content {bottom: '.esc_attr($blog_items_offset).'px;}';
			$blog_css .= '#layout.dfd-blog-loop .dfd-blog-wrap .dfd-blog-masonry.dfd-smart-grid .post .dfd-blog-heading-wrap, #layout.dfd-blog-loop .dfd-blog-wrap .dfd-blog-fitRows.dfd-smart-grid .post .dfd-blog-heading-wrap, #layout.dfd-blog-loop .dfd-blog-wrap .dfd-blog-masonry.dfd-smart-grid .post .entry-content, #layout.dfd-blog-loop .dfd-blog-wrap .dfd-blog-fitRows.dfd-smart-grid .post .entry-content {left: '.esc_attr($blog_items_offset).'px; right: '.esc_attr($blog_items_offset).'px;}';
		}
	}
}
if (!post_password_required(get_the_id())) :
?>
<div class="dfd-blog-wrap">
	<?php
	echo $sort_panel_html;
	?>
	<div id="dfd-blog-loop" class="dfd-blog dfd-blog-<?php echo esc_attr($options['blog_layout_style']) ?> <?php echo esc_attr($additiional_class) ?>" <?php echo $data_atts ?>>
		<?php
		$wp_query = new WP_Query($args);

		while ($wp_query->have_posts()) : $wp_query->the_post();

			$terms = get_the_terms(get_the_ID(), 'category');
			$article_tags_classes = '';

			if(strcmp($options['blog_sort_panel'],'on') === 0) {
				$article_tags_classes .= 'data-category="';
				if(is_array($terms)) {
					foreach ($terms as $term) {
						$article_tags_classes .= ' ' . strtolower(preg_replace('/\s+/'	, '-', $term->slug)) . ' ';
					}
				}
				$article_tags_classes .= '"';
			}

			$post_class_elems = get_post_class();

			$post_class = implode(' ', $post_class_elems);

			$post_class .= ' dfd-title-'.$title_position;

			?>
			<div class="<?php echo esc_attr($post_class) ?>" <?php echo $article_tags_classes; ?>>
				<div class="cover <?php echo esc_attr($cover_class) ?>" <?php echo $animation_data ?>>

					<?php
					if($title_position == 'bottom') {
						require(locate_template('templates/blog-'.$media_content_file.'media.php'));
					}
					if(has_post_format('quote') && ($options['blog_layout_style'] == 'left-image' || $options['blog_layout_style'] == 'right-image')) {
						require(locate_template('templates/post-quote-media.php'));
					}
					?>

					<?php echo $before_content; ?>

					<?php if($options['blog_show_title'] == 'on' || $options['blog_show_meta'] == 'on') : ?>
						<div class="dfd-blog-heading-wrap">
							<?php if($options['blog_show_title'] == 'on') : ?>
								<div class="dfd-news-categories">
									<?php get_template_part('templates/entry-meta/mini', 'category-highlighted'); ?>
								</div>
								<div class="dfd-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							<?php endif; ?>

							<?php if($options['blog_show_meta'] == 'on') : ?>
								<div class="dfd-meta-wrap">
									<?php get_template_part('templates/entry-meta', 'post-bottom'); ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php
					if($title_position == 'top') {
						require(locate_template('templates/blog-'.$media_content_file.'media.php'));
					}
					?>

					<?php if($options['blog_show_description'] == 'on') :
						$excerpt = get_the_excerpt();
						?>
						<?php if(has_post_format('quote') && ($options['blog_layout_style'] == 'masonry' || $options['blog_layout_style'] == 'standard')) { ?>
							<?php require(locate_template('templates/post-quote-media.php')); ?>
						<?php } else {
							if(!empty($excerpt)) :?>
								<div class="entry-content">
									<p><?php echo $excerpt ?></p>
								</div>
							<?php
							endif;
						} ?>
					<?php endif; ?>
					<?php if($show_read_more_share == 'on') : ?>
						<div class="dfd-read-share clearfix">
							<div class="read-more-wrap">
								<a href="<?php the_permalink(); ?>" class="more-button <?php echo esc_attr($options['blog_read_more_style']) ?>" title="<?php __('Read more','dfd') ?>" data-lang="en"><?php _e('More', 'dfd'); ?></a>
							</div>
							<div class="dfd-share-cover <?php echo esc_attr($share_style);  ?>">
								<?php get_template_part('templates/entry-meta/mini','share-blog') ?>
							</div>
						</div>
					<?php endif; ?>
					<?php echo $after_content; ?>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
	
	<?php comments_template(); ?>
		
	<?php if ($wp_query->max_num_pages > 1) : ?>

		<nav class="page-nav">
			
			<?php echo dfd_kadabra_pagination(); ?>

		</nav>

	<?php endif; ?>
	
	<?php if(!empty($blog_css)) : ?>
		<script type="text/javascript">
			(function($) {
				$('head').append('<style type="text/css"><?php echo esc_js($blog_css); ?></style>');
			})(jQuery);
		</script>
	<?php endif; ?>

	<?php wp_reset_postdata(); ?>
	<?php wp_reset_query(); ?>

</div>
<?php endif;