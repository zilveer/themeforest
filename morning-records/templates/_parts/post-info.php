<?php
// Get template args
extract(morning_records_template_get_args('post-info'));

$info_parts = array_merge(array(
	'snippets' => false,	// For singular post/page/team/client/service etc.
	'date' => true,
	'author' => true,
	'terms' => true,
	'counters' => true,
	'different_comments' => false,
	'tag' => 'div'			// 'p' for portfolio hovers
	), isset($post_options['info_parts']) && is_array($post_options['info_parts']) ? $post_options['info_parts'] : array());

?>
<<?php echo esc_attr($info_parts['tag']); ?> class="post_info">
	<?php
	if ($info_parts['date'] && !in_array($post_data['post_type'], array('players', 'team'))) {
		$post_date = apply_filters('morning_records_filter_post_date', $post_data['post_date_sql'], $post_data['post_id'], $post_data['post_type']);
		$post_date_diff = morning_records_get_date_or_difference($post_date);
		?>
		<span class="post_info_item post_info_posted"><?php 
			echo (in_array($post_data['post_type'], array('post', 'page', 'product')) 
					? ''
					: ($post_date <= date('Y-m-d') 
						? esc_html__('Started', 'morning-records') 
						: esc_html__('Will start', 'morning-records'))); 
			?> <a href="<?php echo esc_url($post_data['post_link']); ?>" class="post_info_date<?php echo esc_attr($info_parts['snippets'] ? ' date updated' : ''); ?>"<?php echo !empty($info_parts['snippets']) ? ' itemprop="datePublished" content="'.esc_attr($post_date).'"' : ''; ?>><?php echo esc_html($post_date_diff); ?></a></span>
		<?php
	}
	if ($info_parts['author'] && ($post_data['post_type']=='post' || $post_data['post_type']=='courses' )) {
		?>
		<span class="post_info_item post_info_posted_by<?php echo !empty($info_parts['snippets']) ? ' vcard' : ''; ?>"<?php echo !empty($info_parts['snippets']) ? ' itemprop="author"' : ''; ?>><?php esc_html_e('by', 'morning-records'); ?> <a href="<?php echo esc_url($post_data['post_author_url']); ?>" class="post_info_author"><?php echo trim($post_data['post_author']); ?></a></span>
	<?php 
	}
	if ($info_parts['terms'] && !empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_links)) {
		?>
		<span class="post_info_item post_info_tags"><?php esc_html_e('in', 'morning-records'); ?> <?php echo join(', ', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_links); ?></span>
		<?php
	}
	if ($info_parts['counters']) {
        ?>
        <?php if ($info_parts['different_comments'] == true){
            ?>
            <span class="post_info_item post_info_counters"><?php
            morning_records_template_set_args('counters', array(
                'post_options' => $post_options,
                'post_data' => $post_data
            ));
            get_template_part(morning_records_get_file_slug('templates/_parts/counters-different.php'));
            ?></span>
            <?php
        } else {
            ?>
            <span class="post_info_item post_info_counters"><?php
                morning_records_template_set_args('counters', array(
                    'post_options' => $post_options,
                    'post_data' => $post_data
                ));
                get_template_part(morning_records_get_file_slug('templates/_parts/counters.php'));
            ?></span>
        <?php }?>
		<?php
	}
	if (is_single() && !morning_records_storage_get('blog_streampage') && ($post_data['post_edit_enable'] || $post_data['post_delete_enable'])) {
		?>
		<span class="frontend_editor_buttons">
			<?php if ($post_data['post_edit_enable']) { ?>
			<span class="post_info_item post_info_button post_info_button_edit"><a id="frontend_editor_icon_edit" class="icon-pencil" title="<?php esc_attr_e('Edit post', 'morning-records'); ?>" href="#"><?php esc_html_e('Edit', 'morning-records'); ?></a></span>
			<?php } ?>
			<?php if ($post_data['post_delete_enable']) { ?>
			<span class="post_info_item post_info_button post_info_button_delete"><a id="frontend_editor_icon_delete" class="icon-trash" title="<?php esc_attr_e('Delete post', 'morning-records'); ?>" href="#"><?php esc_html_e('Delete', 'morning-records'); ?></a></span>
			<?php } ?>
		</span>
		<?php
	}
	?>
</<?php echo esc_attr($info_parts['tag']); ?>>