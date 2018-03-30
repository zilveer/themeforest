<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Crum_News_Cat extends WP_Widget
{


    function __construct()
    {
        parent::__construct(
            'crum_news_cat',
            __('Widget: Posts', 'dfd'), // Name
            array('description' => __('Posts from some category', 'dfd'),
            )
        );
    }

    function widget($args, $instance)
    {

        extract($args);

        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Latest articles', 'dfd');
        }

        $number = (isset($instance['number']))?$instance['number']:'';
        $post_order = (isset($instance['post_order']))?$instance['post_order']:'';
        $post_order_by = (isset($instance['post_order_by']))?$instance['post_order_by']:'';
        $cat_selected = (isset($instance['cat_sel']))?$instance['cat_sel']:'';

        echo $before_widget;

        if ($title) {
            echo $before_title;
            echo $title;
            echo $after_title;
        }

        $args = array(
            'category_name' => $cat_selected,
            'posts_per_page' => $number,
            'ignore_sticky_posts' => 'true',
            'orderby' => $post_order_by,
            'order' => $post_order
        );

		$the_query = new WP_Query($args);
			
        while ($the_query->have_posts()) : $the_query->the_post(); ?>

            <article class="hnews hentry featured-news vertical">

                <?php

                if (has_post_thumbnail()) {
                    $thumb = get_post_thumbnail_id();
                    $img_url = wp_get_attachment_url($thumb, 'medium'); //get img URL
                    $article_image = dfd_aq_resize($img_url, 380, 270, true, true, true);
					if(!$article_image) {
						$article_image = $img_url;
					}
                    ?>

                    <div class="entry-thumb ">
                        <img src="<?php echo esc_url($article_image); ?>" alt="<?php the_title(); ?>"/>
                        <?php get_template_part('templates/entry-meta/hover-link'); ?>
                    </div>

                <?php
                } ?>
				
				<div class="row">
					<div class="columns twelve">
						<div class="entry-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</div>
					</div>
				</div>
				
				<?php get_template_part('templates/entry-meta', 'post'); ?>

                <div class="entry-content">
                    <?php the_excerpt() ?>
                </div>

            </article>

        <?php  endwhile;
        wp_reset_postdata();

        echo $after_widget;

    }

    function update($new_instance, $old_instance)
    {

        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);

        $instance['number'] = $new_instance['number'];

        $instance['post_order'] = $new_instance['post_order'];

        $instance['post_order_by'] = $new_instance['post_order_by'];

        $instance['cat_sel'] = $new_instance['cat_sel'];

        return $instance;

    }

    function form($instance) {

        $title = apply_filters('widget_title', (!empty($instance['title']))?$instance['title']:'');
        $cat_selected = (!empty($instance['cat_sel']))?$instance['cat_sel']:'';
        $number = (!empty($instance['number']))?$instance['number']:'';
        $post_order = (!empty($instance['post_order']))?$instance['post_order']:'';
        $post_order_by = (!empty($instance['post_order_by']))?$instance['post_order_by']:'';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'dfd'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e('Number of posts', 'dfd'); ?>:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cat_sel')); ?>"><?php _e('Select category', 'dfd'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('cat_sel')); ?>" name="<?php echo esc_attr($this->get_field_name('cat_sel')); ?>">


                <option class="widefat" value=""><?php _e('All', 'dfd'); ?></option>

                <?php
                $cats = get_categories();

                foreach ($cats as $cat) {

                    $cat_sel = strcmp($cat->slug, $cat_selected) === 0 ? ' selected="selected"' : '';
                    echo '<option class="widefat" value="' . esc_attr($cat->slug) . '"' . $cat_sel . '>' . $cat->name . '</option>';
                }?>

            </select>

        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_order')); ?>"><?php _e('Order posts', 'dfd'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('post_order')); ?>" name="<?php echo esc_attr($this->get_field_name('post_order')); ?>">

                <option class="widefat" <?php if (esc_attr($post_order) == 'DESC') echo 'selected'; ?> value="DESC"><?php _e('Descending', 'dfd'); ?></option>
                <option class="widefat" <?php if (esc_attr($post_order) == 'ASC') echo 'selected'; ?> value="ASC"><?php _e('Ascending', 'dfd'); ?></option>

            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_order_by')); ?>"><?php _e('Order posts by', 'dfd'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('post_order_by')); ?>" name="<?php echo esc_attr($this->get_field_name('post_order_by')); ?>">

                <option class="widefat" value="none" <?php if ($post_order_by == 'none') echo 'selected'; ?>><?php _e('No order', 'dfd'); ?></option>
                <option class="widefat" value="ID" <?php if ($post_order_by == 'ID') echo 'selected'; ?>><?php _e('Order by post id', 'dfd'); ?></option>
                <option class="widefat" value="title" <?php if ($post_order_by == 'title') echo 'selected'; ?>><?php _e('Order by title', 'dfd'); ?></option>
                <option class="widefat" value="name" <?php if ($post_order_by == 'name') echo 'selected'; ?>><?php _e('Order by post name (post slug)', 'dfd'); ?></option>
                <option class="widefat" value="date" <?php if ($post_order_by == 'date') echo 'selected'; ?>><?php _e('Order by date', 'dfd'); ?></option>
                <option class="widefat" value="modified" <?php if ($post_order_by == 'modified') echo 'selected'; ?>><?php _e('Order by last modified date', 'dfd'); ?></option>
                <option class="widefat" value="rand" <?php if ($post_order_by == 'rand') echo 'selected'; ?>><?php _e('Random order', 'dfd'); ?></option>
                <option class="widefat" value="comment_count" <?php if ($post_order_by == 'comment_count') echo 'selected'; ?>><?php _e('Order by number of comments', 'dfd'); ?></option>

            </select>

        </p>

    <?php

    }

}

//add_action('widgets_init', create_function('', 'register_widget("Crum_News_Cat");'));