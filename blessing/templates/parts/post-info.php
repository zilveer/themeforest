			<div class="post_info">
				<?php
				$info_parts = array_merge(array(
					'snippets' => false,	// For singular post/page/course/team etc.
					'date' => true,
					'author' => true,
					'terms' => true,
					'counters' => true,
					'shedule' => false,		// For single course
					'length' => false		// For single course
					), isset($info_parts) && is_array($info_parts) ? $info_parts : array());
									
					if ($info_parts['date']) {
						?>
						<span class="post_info_item post_info_posted"> <a href="<?php echo esc_url($post_data['post_link']); ?>" class="post_info_date<?php echo esc_attr($info_parts['snippets'] ? ' date updated' : ''); ?>"<?php echo ($info_parts['snippets'] ? ' itemprop="datePublished" content="'.get_the_date('Y-m-d').'"' : ''); ?>><?php echo esc_html($post_data['post_date']); ?></a></span>
						<?php
					}
					if ($info_parts['author']) {
						?>
						<span class="post_info_item post_info_posted_by<?php echo ($info_parts['snippets'] ? ' vcard' : ''); ?>"<?php echo ($info_parts['snippets'] ? ' itemprop="author"' : ''); ?>><?php _e('by', 'ancora'); ?> <a href="<?php echo esc_url($post_data['post_author_url']); ?>" class="post_info_author"><?php echo ($post_data['post_author']); ?></a></span>
					<?php 
					}

					if ($info_parts['terms'] && !empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_links)) {
						?>
						<span class="post_info_item post_info_tags"><?php _e('in', 'ancora'); ?> <?php echo join(', ', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_links); ?></span>
						<?php
					}

				if ($info_parts['counters']) {
					?>
					<span class="post_info_item post_info_counters"><?php require(ancora_get_file_dir('templates/parts/counters.php')); ?></span>
					<?php
				}
				if (is_single() && !ancora_get_global('blog_streampage') && ($post_data['post_edit_enable'] || $post_data['post_delete_enable'])) {
					?>
					<span class="frontend_editor_buttons">
						<?php if ($post_data['post_edit_enable']) { ?>
						<span class="post_info_item post_info_button post_info_button_edit"><a id="frontend_editor_icon_edit" class="icon-pencil" title="<?php _e('Edit post', 'ancora'); ?>" href="#"><?php _e('Edit', 'ancora'); ?></a></span>
						<?php } ?>
						<?php if ($post_data['post_delete_enable']) { ?>
						<span class="post_info_item post_info_button post_info_button_delete"><a id="frontend_editor_icon_delete" class="icon-trash" title="<?php _e('Delete post', 'ancora'); ?>" href="#"><?php _e('Delete', 'ancora'); ?></a></span>
						<?php } ?>
					</span>
					<?php
				}
				?>
			</div>
