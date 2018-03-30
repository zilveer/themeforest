<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'morning_records_template_news_excerpt_theme_setup' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_template_news_excerpt_theme_setup', 1 );
	function morning_records_template_news_excerpt_theme_setup() {
		morning_records_add_template(array(
			'layout' => 'news-excerpt',
			'template' => 'news-excerpt',
			'mode'   => 'news',
			'title'  => esc_html__('Recent News /Style Excerpt/', 'morning-records'),
			'thumb_title'  => esc_html__('Medium image (crop)', 'morning-records'),
			'w'		 => 370,
			'h'		 => 275
		));
	}
}

// Template output
if ( !function_exists( 'morning_records_template_news_excerpt_output' ) ) {
	function morning_records_template_news_excerpt_output($post_options, $post_data) {
		$style = $post_options['layout'];
		$number = $post_options['number'];
		$count = $post_options['posts_on_page'];
		$columns = $post_options['columns_count'];
		$show_title = !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote'));

		?><article id="post-<?php echo esc_html($post_data['post_id']); ?>" 
			<?php post_class( 'post_item post_layout_'.esc_attr($style)
							.' post_format_'.esc_attr($post_data['post_format'])
							); ?>
			>
		
			<?php
			if ($post_data['post_flags']['sticky']) {
				?><span class="sticky_label"></span><?php
			}

			if ($post_data['post_video'] || $post_data['post_audio'] || $post_data['post_thumb'] ||  $post_data['post_gallery']) {
				?>
				<div class="post_featured">
					<?php
					morning_records_template_set_args('post-featured', array(
						'post_options' => $post_options,
						'post_data' => $post_data
					));
					get_template_part(morning_records_get_file_slug('templates/_parts/post-featured.php'));
					if (!$post_data['post_video'] && !$post_data['post_audio'] && !$post_data['post_gallery']) {
						?>
						<div class="post_info"><span class="post_categories"><?php echo join(', ', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_links); ?></span></div>
						<?php
					}
					?>
				</div>
				<?php		
			}
			?>

			<div class="post_body">
		
				<?php
				if ( !in_array($post_data['post_format'], array('link', 'aside', 'status', 'quote')) ) {
					?>
					<div class="post_header entry-header">
						<?php
					if ($show_title) {
						if (!isset($post_options['links']) || $post_options['links']) {
							?>
							<h3 class="post_title entry-title"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo trim($post_data['post_title']); ?></a></h3>
							<?php
						} else {
							?>
							<h3 class="post_title entry-title"><?php echo trim($post_data['post_title']); ?></h3>
							<?php
						}
					}

                    if ($post_data['post_type']=='courses' && !$post_data['post_protected'] && $post_options['info']) {
                        $post_options['info_parts'] = array('author'=>true, 'different_comments'=>true);
                        morning_records_template_set_args('post-info', array(
                            'post_options' => $post_options,
                            'post_data' => $post_data
                        ));
                        get_template_part(morning_records_get_file_slug('templates/_parts/post-info.php'));
                    }
					
					if ( in_array( $post_data['post_type'], array( 'post', 'attachment' ) ) ) {
						?><div class="post_meta"><span class="post_meta_author"><?php echo trim($post_data['post_author_link']); ?></span><?php
						?><span class="post_meta_date"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo esc_html($post_data['post_date']); ?></a></span></div><?php
					}
						?>
					</div><!-- .entry-header -->
					<?php
				}
				?>
				
				<div class="post_content entry-content">
					<?php
					if ($post_data['post_protected']) {
						echo trim($post_data['post_excerpt']); 
					} else {
						if ($post_data['post_excerpt']) {
							echo in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status')) 
									? $post_data['post_excerpt'] 
									: wpautop(morning_records_strshort($post_data['post_excerpt'], isset($post_options['descr']) 
																								? $post_options['descr'] 
																								: morning_records_get_custom_option('post_excerpt_maxlength')
																)
											);
						}
					}

                    if (empty($post_options['readmore'])) $post_options['readmore'] = esc_html__('Read more', 'morning-records');
                    if (!morning_records_param_is_off($post_options['readmore']) && !in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status'))) {
                        ?><a href="<?php echo esc_url($post_data['post_link']); ?>" class="post_readmore"><span class="post_readmore_label"><?php echo trim($post_options['readmore']); ?></span></a><?php
                    }
					?>
				</div><!-- .entry-content -->
			
				<div class="post_footer entry-footer">
					<div class="post_counters">
					<?php
					if ( in_array( $post_data['post_type'], array( 'post', 'attachment' ) ) ) {
						$post_options['counters'] = 'views,comments,edit,captions';		//morning_records_get_theme_option('blog_counters');
						morning_records_template_set_args('counters', array(
							'post_options' => $post_options,
							'post_data' => $post_data
						));
						get_template_part(morning_records_get_file_slug('templates/_parts/counters.php'));
					}
					?>
					</div>
				</div><!-- .entry-footer -->

			</div><!-- .post_body -->
		
		</article>
		<?php
	}
}
?>