<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'morning_records_template_news_portfolio_theme_setup' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_template_news_portfolio_theme_setup', 1 );
	function morning_records_template_news_portfolio_theme_setup() {
		morning_records_add_template(array(
			'layout' => 'news-portfolio',
			'template' => 'news-portfolio',
			'mode'   => 'news',
			'title'  => esc_html__('Recent News /Style Portfolio/', 'morning-records'),
			'thumb_title'  => esc_html__('Medium image (crop)', 'morning-records'),
			'w'		 => 370,
			'h'		 => 275
		));
	}
}

// Template output
if ( !function_exists( 'morning_records_template_news_portfolio_output' ) ) {
	function morning_records_template_news_portfolio_output($post_options, $post_data) {
		$style = $post_options['layout'];
		$number = $post_options['number'];
		$count = $post_options['posts_on_page'];
		$columns = $post_options['columns_count'];
		$show_title = !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote'));
 
		if ($columns > 1) {
			?><div class="column-1_<?php echo esc_attr($columns); ?>"><?php
		}
		?><article id="post-<?php echo esc_html($post_data['post_id']); ?>" 
			<?php post_class( 'post_item post_layout_'.esc_attr($style)
					.' post_format_'.esc_attr($post_data['post_format']) ); ?>
			>
		
			<?php
			if ($post_data['post_flags']['sticky']) {
				?><span class="sticky_label"></span><?php
			}
			?>
			<div class="post_featured">
				<?php
				if ($post_data['post_video'] || $post_data['post_audio'] || $post_data['post_thumb'] ||  $post_data['post_gallery']) {
					//$post_data['post_video'] = $post_data['post_audio'] = $post_data['post_gallery'] = '';
					morning_records_template_set_args('post-featured', array(
						'post_options' => $post_options,
						'post_data' => $post_data
					));
					get_template_part(morning_records_get_file_slug('templates/_parts/post-featured.php'));
					if (!$post_data['post_video'] && !$post_data['post_audio'] && !$post_data['post_gallery']) {
						?>
						<div class="post_info">
							<span class="post_categories"><?php echo join(', ', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_links); ?></span>
							<?php
							if (!isset($post_options['links']) || $post_options['links']) {
								?>
								<h5 class="post_title entry-title"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo trim($post_data['post_title']); ?></a></h5>
								<?php
							} else {
								?>
								<h5 class="post_title entry-title"><?php echo trim($post_data['post_title']); ?></h5>
								<?php
							}
							if ( in_array( $post_data['post_type'], array( 'post', 'attachment' ) ) ) {
								?><div class="post_meta"><span class="post_meta_author"><?php echo trim($post_data['post_author_link']); ?></span><?php
								?><span class="post_meta_date"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo esc_html($post_data['post_date']); ?></a></span></div><?php
							}
							?>
						</div>
						<?php
					}
				}
				?>
			</div>
		</article><?php
		
		if ($columns > 1) {
			?></div><?php
		}
	}
}
?>