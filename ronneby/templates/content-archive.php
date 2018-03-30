<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (!have_posts()) :

    get_template_part('templates/notresult','content');
    
endif;

global $dfd_ronneby;

$data_atts = $sort_panel_html = $media_content_file = $page_class = '';

$options = array(
	'archive_layout_style' => 'standard',
	'archive_items_offset' => 0,
	'archive_show_title' => 'on',
	'archive_show_meta' => 'on',
	'archive_heading_position' => 'bottom',
	'archive_show_description' => 'on',
	'archive_content_alignment' => 'text-left',
	'archive_show_read_more_share' => 'on',
	'archive_read_more_style' => 'simple',
	'archive_columns' => '1',
	'archive_share_style' => '',
	'blog_comments_likes_style' => '',
	'blog_show_comments' => '',
	'blog_show_likes' => '',
);

foreach($options as $option => $default) {
	if(isset($dfd_ronneby[$option]) && !empty($dfd_ronneby[$option])) {
		$options[$option] = $dfd_ronneby[$option];
	}
}

$item_css = $block_css = $before_content = $after_content = '';
if($options['archive_items_offset']) {
	$options['archive_items_offset'] = $options['archive_items_offset'] / 2;
	$block_css .= 'style="margin: -'.esc_attr($options['archive_items_offset']).'px;"';
	$item_css .= 'style="padding: '.esc_attr($options['archive_items_offset']).'px;"';
}

if(strcmp($options['archive_layout_style'], 'left-image') === 0 || strcmp($options['archive_layout_style'], 'right-image') === 0) {
	$media_content_file .= 'fitRows-';
	$before_content .= '<div class="dfd-content-wrap">';
	$after_content .= '</div>';
}
if(strcmp($options['archive_layout_style'], 'masonry') === 0 || strcmp($options['archive_layout_style'], 'fitRows') === 0) {
	wp_enqueue_script('isotope');
	$page_class .= ' dfd-new-isotope';

	$data_atts .= ' data-columns="'.esc_attr($options['archive_columns']).'"';
	$data_atts .= ' data-layout-style="'.esc_attr($options['archive_layout_style']).'"';
	$data_atts .= ' data-item="post"';
}

?>
<div class="dfd-blog-wrap" <?php echo $block_css ?>>
	
		<div class="dfd-blog dfd-blog-<?php echo esc_attr($options['archive_layout_style']) ?> <?php echo esc_attr($page_class) ?>" <?php echo $data_atts ?>>

		<?php while (have_posts()) : the_post(); ?>

			<?php
			$post_class_elems = get_post_class();

			$post_class = implode(' ', $post_class_elems);

			$post_class .= ' dfd-title-'.$options['archive_heading_position'];

			?>
			<div class="post <?php echo esc_attr($post_class) ?>">
				<div class="cover <?php echo esc_attr($options['archive_content_alignment']) ?>" <?php echo $item_css ?>>

					<?php
					if($options['archive_heading_position'] == 'bottom') {
						require(locate_template('templates/blog-'.$media_content_file.'media.php'));
					}
					?>

					<?php echo $before_content; ?>

					<?php if($options['archive_show_title'] == 'on') : ?>
						<div class="dfd-news-categories">
							<?php get_template_part('templates/entry-meta/mini', 'category-highlighted'); ?>
						</div>
						<div class="dfd-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					<?php endif; ?>

					<?php if($options['archive_show_meta'] == 'on') { ?>
						<div class="dfd-meta-wrap">
							<?php get_template_part('templates/entry-meta', 'post-bottom'); ?>
						</div>
					<?php } ?>

					<?php
					if($options['archive_heading_position'] == 'top') {
						require(locate_template('templates/blog-'.$media_content_file.'media.php'));
					}
					?>

					<?php if($options['archive_show_description'] == 'on') :
						$excerpt = get_the_excerpt();
						?>
						<?php if(has_post_format('quote') && ($options['archive_layout_style'] == 'masonry' || $options['archive_layout_style'] == 'standard')) { ?>
							<div class="entry-media">
								<?php get_template_part('templates/post', 'quote'); ?>
								<div class="post-comments-wrap">
									<?php get_template_part('templates/entry-meta/mini', 'comments-number'); ?>
								</div>
								<div class="post-like-wrap">
									<?php get_template_part('templates/entry-meta/mini', 'like'); ?>
								</div>
							</div>
						<?php } else { ?>
								<div class="entry-content">
									<?php echo !empty($excerpt) ? '<p>'.$excerpt.'</p>' : ''; ?>
								</div>
						<?php } ?>
					<?php endif; ?>
					<?php if($options['archive_show_read_more_share'] == 'on') : ?>
						<div class="dfd-read-share clearfix">
							<div class="read-more-wrap">
								<a href="<?php the_permalink(); ?>" class="more-button <?php echo esc_attr($options['archive_read_more_style']) ?>" title="<?php __('Read more','dfd') ?>" data-lang="en"><?php _e('More', 'dfd'); ?></a>
							</div>
							<div class="dfd-share-cover <?php echo !empty($options['archive_share_style']) ? 'dfd-share-'.esc_attr($options['archive_share_style']) : '';  ?>">
								<?php get_template_part('templates/entry-meta/mini','share-blog') ?>
							</div>
						</div>
					<?php endif; ?>
					<?php echo $after_content; ?>
				</div>
			</div>

		<?php endwhile; ?>
	</div>

</div>

<?php if ($wp_query->max_num_pages > 1) : ?>

<nav class="page-nav">

    <?php echo dfd_kadabra_pagination(); ?>

</nav>

<?php endif; ?>
