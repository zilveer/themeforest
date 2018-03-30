<?php


/**
 * Blog Authors Widget Class
 */
class AitBlogAuthorsWidget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(false, __('Theme &rarr; Blog Authors', 'ait-admin'));
    }



    function widget($widgetArgs, $instance)
    {
		$widgetArgs = (object) $widgetArgs;

		$title = apply_filters('widget_title',  empty($instance['title']) ? '' : $instance['title']);
		$gravatar = $instance['gravatar'];
		$count = $instance['count'];

		echo $widgetArgs->before_widget;

		if($title) echo $widgetArgs->before_title . $title . $widgetArgs->after_title;

		?>
		<ul class="blog-authors <?php if($gravatar) echo 'blog-author-has-avatar'; else echo 'blog-author-no-has-avatar'; ?>">
		<?php

		$authors = get_users(array('who' => 'authors', 'number' => 9999));

		foreach($authors as $author) {

			$postCount = count_user_posts($author->ID);

			if($postCount >= 1) {

				$authorInfo = get_userdata($author->ID);

				?><li class="blog-author"><?php

				if($gravatar){
					?><div class="blog-author-avatar"><?php
					echo get_avatar($author->ID, 40);
					?></div><?php
				}

				?>
				<div class="blog-author-link">
					<a href="<?php echo get_author_posts_url($author->ID) ?>" title="<?php _e('View author archive', 'ait-admin') ?>">
					<?php
						echo $authorInfo->display_name;
						if($count) echo '(' . $postCount . ')';
					?>
					</a>
				</div>
				</li>
			<?php
			}
		}
		?>
		</ul>
		<?php
		echo $widgetArgs->after_widget;
    }



    function update($new, $old)
    {
		$instance = $old;
		$instance['title']    = strip_tags($new['title']);
		$instance['gravatar'] = strip_tags($new['gravatar']);
		$instance['count']    = strip_tags($new['count']);
        return $instance;
    }



    function form($instance)
    {
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => '', 'gravatar' => '0', 'count' => '0'
			)
		);

		$title = esc_attr($instance['title']);
		$gravatar = esc_attr($instance['gravatar']);
		$count = esc_attr($instance['count']);

        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ait-admin'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

		<p>
          <input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="checkbox" value="1" <?php checked( '1', $count ); ?>/>
          <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Display Post Count?', 'ait-admin'); ?></label>
        </p>

		<p>
          <input id="<?php echo $this->get_field_id('gravatar'); ?>" name="<?php echo $this->get_field_name('gravatar'); ?>" type="checkbox" value="1" <?php checked( '1', $gravatar ); ?>/>
          <label for="<?php echo $this->get_field_id('gravatar'); ?>"><?php _e('Display Author Gravatar?', 'ait-admin'); ?></label>
        </p>
        <?php
    }
}
