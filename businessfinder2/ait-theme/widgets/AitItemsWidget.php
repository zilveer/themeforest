<?php

/*
 * AIT WordPress Theme Framework
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


class AitItemsWidget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_items', 'description' => __( 'Display items', 'ait-admin') );
		parent::__construct('ait-items', __('Theme &rarr; Items', 'ait-admin'), $widget_ops);
	}



	function widget($args, $instance)
	{
		extract( $args );
		$result = '';

		/* WIDGET CONTENT :: START */
		$result .= $before_widget;
		$title = '';
		if(isset($instance['title'])){
			$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		}
		$result .= $before_title.$title.$after_title;

		$term = explode("_", $instance['category']);

		$items = query_posts(array(
			'post_type' => 'ait-item',
			'posts_per_page' => $instance['count'],
			'tax_query' => array(
				array(
					'taxonomy' => $term[0],
					'field' => 'id',
					'terms' => $term[1]
				),
			),
		));
		wp_reset_query();

		if(!empty($items)){
			$themeOptions = aitOptions()->getOptionsByType('theme');
			$defaultImage = $themeOptions['item']['noFeatured'];

			$result .= '<div class="items-container layout-'.$instance['layout'].'">';
				$result .= '<div class="content">';
				foreach ($items as $key => $post) {
					$rating_count = intval(get_post_meta($post->ID, 'rating_count', true));
					$rating_mean = get_post_meta($post->ID, 'rating_mean', true);

					$showCount = false;

					$dbFeatured = get_post_meta($post->ID, '_ait-item_item-featured', true);
					$isFeatured = $dbFeatured != "" ? filter_var($dbFeatured, FILTER_VALIDATE_BOOLEAN) : false;

					$featuredClass = $isFeatured ? "item-featured" : "";

					$result .= '<div class="item-container '.$featuredClass.'">';
						$result .= '<div class="content">';
							if($instance['layout'] == "grid"){
								$result .= '<a href="'.get_permalink($post->ID).'" title="'.$post->post_title.'">';
									$result .= '<h4>'.$post->post_title.'</h4>';
									$url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');
									if($url !== false){
										$result .= '<span class="thumb-icon"><img src="'.$url.'" alt="'.$post->post_title.'" /></span>';
									} else {
										$result .= '<span class="thumb-icon"><img src="'.$defaultImage.'" alt="'.$post->post_title.'" /></span>';
									}
								$result .= '</a>';

								if(defined('AIT_REVIEWS_ENABLED')){
									$result .= '<div class="review-stars-container"><div class="content">';
									if($rating_count > 0){
										$result .= '<span class="review-stars" data-score="'.$rating_mean.'"></span>';
									}
									$result .= '</div></div>';
								}

								$result .= '<span>'.substr($post->post_excerpt, 0, $instance['excerpt']).'</span>';
							} else {
								$result .= '<a href="'.get_permalink($post->ID).'" title="'.$post->post_title.'">';
									$url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');
									if($url !== false){
										$result .= '<span class="thumb-icon"><img src="'.$url.'" alt="'.$post->post_title.'" /></span>';
									} else {
										$result .= '<span class="thumb-icon"><img src="'.$defaultImage.'" alt="'.$post->post_title.'" /></span>';
									}
									$result .= '<h4>'.$post->post_title.'</h4>';
								$result .= '</a>';

								if(defined('AIT_REVIEWS_ENABLED')){
									$result .= '<div class="review-stars-container"><div class="content">';
									if($rating_count > 0){
										$result .= '<span class="review-stars" data-score="'.$rating_mean.'"></span>';
									}
									$result .= '</div></div>';
								}

								$result .= '<span>'.substr($post->post_excerpt, 0, $instance['excerpt']).'</span>';
							}
						$result .= '</div>';
					$result .= '</div>';
				}
				$result .= '</div>';
			$result .= '</div>';
		} else {
			$result .= '<div class="items-container layout-'.$instance['layout'].'">';
				$result .= '<div class="content">';
					$result .= __( 'No items found', 'ait-admin');
				$result .= '</div>';
			$result .= '</div>';
		}

		$result .= $after_widget;
		/* WIDGET CONTENT :: END */
		echo($result);
	}



	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['layout'] = strip_tags($new_instance['layout']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['excerpt'] = strip_tags($new_instance['excerpt']);

		return $instance;
	}



	function form($instance)
	{
		$instance = wp_parse_args( (array) $instance, array(
            'title' => '',
            'category' => '',
            'layout' => 'list',
            'count' => 3,
            'excerpt' => 100,
        ) );
    ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title', 'ait-admin' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" style="width:100%;" />
        </p>
        <p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php echo __( 'Category', 'ait-admin' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" class="widefat" style="width:100%;">
				<optgroup label="<?php echo __('Categories', 'ait-admin') ?>">
				<?php
				$categories = get_categories(array('taxonomy' => 'ait-items', 'hide_empty' => 0, 'parent' => 0));
				echo recursiveCategory($categories, $instance['category'], 'ait-items', "", true);
				?>
				</optgroup>
				<optgroup label="<?php echo __('Locations', 'ait-admin') ?>">
				<?php
				$categories = get_categories(array('taxonomy' => 'ait-locations', 'hide_empty' => 0, 'parent' => 0));
				echo recursiveCategory($categories, $instance['category'], 'ait-locations', "", true);
				?>
				</optgroup>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php echo __( 'Layout', 'ait-admin' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" class="widefat" style="width:100%;">
				<option value="list" <?php echo $instance['layout'] == "list" ? "selected" : ""; ?>>List</option>
				<option value="grid" <?php echo $instance['layout'] == "grid" ? "selected" : ""; ?>>Grid</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php echo __( 'Count', 'ait-admin' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" class="widefat" style="width:100%;" />
        </p>
        <p>
			<label for="<?php echo $this->get_field_id( 'excerpt' ); ?>"><?php echo __( 'Excerpt', 'ait-admin' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'excerpt' ); ?>" name="<?php echo $this->get_field_name( 'excerpt' ); ?>" value="<?php echo $instance['excerpt']; ?>" class="widefat" style="width:100%;" />
        </p>
	<?php
	}

}
