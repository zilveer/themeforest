<?php


class AitPostsWidget extends WP_Widget
{

	function __construct()
	{
		$widget_ops = array('classname' => 'widget_posts', 'description' => __( 'Customize displaying posts', 'ait-admin') );
		parent::__construct('ait-posts', __('Theme &rarr; Posts', 'ait-admin'), $widget_ops);
	}



	function widget($args, $instance)
	{
		extract( $args );
		$result = '';

		//global $wp_query;
		$query = array();
		if(!empty($instance['number_of_posts'])){
			$query['posts_per_page'] = intval($instance['number_of_posts']);
		} else {
			$query['posts_per_page'] = 1;
		}
		/*$formats = get_post_format_slugs();
		foreach ((array) $formats as $i => $format ) {
			$formats[$i] = 'post-format-' . $format;
		}
		$query['tax_query'] = array(array('taxonomy' => 'post_format', 'field' => 'slug', 'terms' => $formats, 'operator' => 'NOT IN'));*/

		/* WIDGET CONTENT :: START */
		$result .= $before_widget;
		$title = '';
		if(isset($instance['title'])){
			$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		}
		$result .= $before_title.$title.$after_title;
		$i = 1;
		$posts = get_posts( $query );
		$num_posts = sizeof( $posts );
		if(!empty($posts)){
			$result .= '<div class="postitems-wrapper">';
			foreach($posts as $post){
				if (!empty($instance['excerpt_length'])){
					if(function_exists('iconv')){
						$text = iconv_substr(strip_tags(strip_shortcodes($post->post_content)), 0, $instance['excerpt_length'], 'UTF-8');
					} else {
						$text = substr( strip_tags(strip_shortcodes($post->post_content)), 0, $instance['excerpt_length'] );
					}
				} else {
					$text = $post->excerpt;
				}
				$thumbnail_args = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
				switch ( $instance['thumbnail_position'] ) {
					case 'left': $thumbnail_class = 'fl'; $offset = 'margin-left: '.$instance['thumbnail_width'].'px;'; break;
					case 'right': $thumbnail_class = 'fr'; $offset = 'margin-right: '.$instance['thumbnail_width'].'px;'; break;
					default: $thumbnail_class = 'top'; $offset = '';
				}
				$post_class = 'no-thumbnail';
				if(has_post_thumbnail($post->ID) && $instance['show_thumbnails']){$post_class = 'with-thumbnail';}
				if($i == $num_posts){$post_class .= ' last';}

				$result .= '<div class="postitem thumb-'.$thumbnail_class.' '.$post_class.'">';
				$result .= '<a href="'.get_permalink($post->ID).'" class="thumb-link">';
				if(has_post_thumbnail($post->ID) && $instance['show_thumbnails']){
					$result .= '<div class="thumb-wrap" style="width: '.$instance['thumbnail_width'].'px;">';
					$result .= '<span class="thumb-icon"><img class="thumb" style="width: '.$instance['thumbnail_width'].'px;" src="'.aitResizeImage($thumbnail_args['0'], array('width' => $instance['thumbnail_width'], 'height' => $instance['thumbnail_height'], 'crop' => true)).'" alt="" /></span>';
					$result .= '</div>';
				}
				$result .= '<div class="post-title" style="'.$offset.'">';
				$result .= '<h4>'.esc_attr(strip_tags($post->post_title)).'</h4>';
				$result .= '<div class="date">'.mysql2date(get_option('date_format'), $post->post_date, true).'</div>';
				$result .= '</div>';
				$result .= '</a>';
				$result .= '<div class="post-content" style="'.$offset.'">';
				$result .= '<p>'.$text.'</p>';
				if(!empty($instance['show_read_more'])){
					$result .= '<div class="read-more">';
					$result .= '<a href="'.get_permalink($post->ID).'">'.__('read more', 'ait').'</a>';
					$result .= '</div>';
				}
				$result .= '</div>';
				$result .= '</div>';
				$i++;
			}
			$result .= '</div>';
		} else {
			$result .= '<div class="postitems-wrapper">';
			$result .= '<div class="no-content">'.__('No posts', 'ait').'</div>';
			$result .= '</div>';
		}

		$result .= $after_widget;
		/* WIDGET CONTENT :: END */
		//wp_reset_query();
		echo($result);
	}



	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number_of_posts'] = $new_instance['number_of_posts'];
		$instance['excerpt_length'] = $new_instance['excerpt_length'];
		$instance['show_read_more'] = $new_instance['show_read_more'];
		$instance['show_thumbnails'] = $new_instance['show_thumbnails'];
		$instance['thumbnail_width'] = $new_instance['thumbnail_width'];
		$instance['thumbnail_height'] = $new_instance['thumbnail_height'];
		$instance['thumbnail_position'] = $new_instance['thumbnail_position'];

		return $instance;
	}



	function form($instance)
	{
		$instance = wp_parse_args( (array) $instance, array(
            'title' => '',
            'number_of_posts' => 3,
            'excerpt_length' => 50,
			'show_read_more' => true,
            'show_thumbnails' => true,
            'thumbnail_width' => 50,
            'thumbnail_height' => 50,
            'thumbnail_position' => 'left',
        ) );
    ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title', 'ait-admin' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"class="widefat" style="width:100%;" />
        </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_of_posts' ); ?>"><?php echo __( 'Number of posts', 'ait-admin' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'number_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_of_posts' ); ?>" value="<?php echo $instance['number_of_posts']?>" size="2" />
        </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>"><?php echo __( 'Excerpt length', 'ait-admin' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" value="<?php echo $instance['excerpt_length']?>" size="2" />
        </p>

        <p>
            <?php $checked = ''; if ( $instance['show_read_more'] ) $checked = 'checked="checked"'; ?>
			<input type="checkbox" <?php echo $checked; ?> id="<?php echo $this->get_field_id( 'show_read_more' ); ?>" name="<?php echo $this->get_field_name( 'show_read_more' ); ?>" class="checkbox" />
			<label for="<?php echo $this->get_field_id( 'show_read_more' ); ?>"><?php echo __( 'Show read more', 'ait-admin' ); ?></label>
        </p>

        <p>
            <?php $checked = ''; if ( $instance['show_thumbnails'] ) $checked = 'checked="checked"'; else $checked = ''; ?>
			<input type="checkbox" <?php echo $checked; ?> id="<?php echo $this->get_field_id( 'show_thumbnails' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnails' ); ?>" class="checkbox" />
			<label for="<?php echo $this->get_field_id( 'show_thumbnails' ); ?>"><?php echo __( 'Show thumbnails', 'ait-admin' ); ?></label>
        </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'thumbnail_width' ); ?>"><?php echo __( 'Thumbnail width', 'ait-admin' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'thumbnail_width' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail_width' ); ?>" value="<?php echo $instance['thumbnail_width']; ?>" size="3" />px
        </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'thumbnail_height' ); ?>"><?php echo __( 'Thumbnail height', 'ait-admin' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'thumbnail_height' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail_height' ); ?>" value="<?php echo $instance['thumbnail_height']; ?>" size="3"/>px
        </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'thumbnail_position' ); ?>"><?php echo __( 'Thumbnail position', 'ait-admin' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'thumbnail_position' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail_position' ); ?>">
				<option <?php if ( 'left' == $instance['thumbnail_position'] ) echo 'selected="selected"'; ?> value="left">Left</option>
				<option <?php if ( 'right' == $instance['thumbnail_position'] ) echo 'selected="selected"'; ?> value="right">Right</option>
				<option <?php if ( 'top' == $instance['thumbnail_position'] ) echo 'selected="selected"'; ?> value="top">Top</option>
			</select>
		</p>
<?php
	}

}
