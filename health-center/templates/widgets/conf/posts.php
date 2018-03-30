<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'health-center'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Display:', 'health-center'); ?></label>
	<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>[]" multiple="multiple">
		<option value="comment_count" <?php selected(in_array('comment_count', $orderby), true); ?>><?php _e('Popular Posts', 'health-center') ?></option>
		<option value="date" <?php selected(in_array('date', $orderby), true); ?>><?php _e('Recent Posts', 'health-center') ?></option>
		<option value="comments" <?php selected(in_array('comments', $orderby), true); ?>><?php _e('Recent Comments', 'health-center') ?></option>
		<option value="tags" <?php selected(in_array('tags', $orderby), true); ?>><?php _e('Tags', 'health-center') ?></option>
	</select>
</p>

<h4><?php _e('Posts / Comments', 'health-center') ?></h4>

<p>
	<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of items:', 'health-center'); ?></label>
	<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
</p>

<p>
	<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('disable_thumbnail'); ?>" name="<?php echo $this->get_field_name('disable_thumbnail'); ?>"<?php checked($disable_thumbnail); ?> />
	<label for="<?php echo $this->get_field_id('disable_thumbnail'); ?>"><?php _e('Disable Thumbnails?', 'health-center'); ?></label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e('Categories:', 'health-center'); ?></label>
	<select style="height:5.5em" name="<?php echo $this->get_field_name('cat'); ?>[]" id="<?php echo $this->get_field_id('cat'); ?>" class="widefat" multiple="multiple">
		<?php foreach ($categories as $category): ?>
			<option value="<?php echo $category->term_id; ?>"<?php echo in_array($category->term_id, $cat) ? ' selected="selected"' : ''; ?>><?php echo $category->name; ?></option>
		<?php endforeach; ?>
	</select>
</p>

<h4><?php _e('Tags', 'health-center') ?></h4>

<p>
	<label for="<?php echo $this->get_field_id('tag_taxonomy'); ?>"><?php _e('Taxonomy:', 'health-center') ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id('tag_taxonomy'); ?>" name="<?php echo $this->get_field_name('tag_taxonomy'); ?>">
		<?php foreach ( get_object_taxonomies('post') as $taxonomy ) :
					$tax = get_taxonomy($taxonomy);
					if ( !$tax->show_tagcloud || empty($tax->labels->name) )
						continue;
		?>
			<option value="<?php echo esc_attr($taxonomy) ?>" <?php selected($taxonomy, $tag_taxonomy) ?>><?php echo $tax->labels->name; ?></option>
		<?php endforeach; ?>
	</select>
</p>
