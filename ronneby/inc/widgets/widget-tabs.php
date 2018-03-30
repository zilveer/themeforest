<?php
/*-----------------------------------------------------------------------------------*/
/* Tabbed Widget
/*-----------------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Crum_Widget_Tabs extends WP_Widget {
    var $settings = array('number', 'pop', 'latest');

    public function __construct() {
        parent::__construct(
            'crum_widget_tabs', // Base ID
            'Widget: Tabbed Widget', // Name
            array('description' => __('Tabs: Popular posts, Recent Posts, Comments', 'dfd'),) // Args
        );
    }
    function form($instance) {
		
        $instance = $this->aq_enforce_defaults($instance);
        extract($instance, EXTR_SKIP);

        $thumb_sel = $instance['thumb_sel'];
        $header_format = $instance['header_format'];
		
		if (isset($instance['thumb_size'])) {
			$thumb_size = $instance['thumb_size'];
		} else {
			$thumb_size = 'thumb-big';
		}
		if (isset($instance['thumb_radius'])) {
			$thumb_radius = $instance['thumb_radius'];
		} else {
			$thumb_radius = '';
		}

        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'dfd'); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e('Number of posts:', 'dfd'); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" value="<?php echo esc_attr($instance['number']); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('header_format')); ?>"><?php _e('Select header format:', 'dfd'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('header_format')); ?>" name="<?php echo esc_attr($this->get_field_name('header_format')); ?>" value="<?php echo esc_attr($header_format); ?>">
				<option value='popular-recent' <?php if (esc_attr($header_format) == 'popular-recent') echo 'selected'; ?>><?php _e('Recent-Top', 'dfd'); ?></option>
				<option value='recent-popular' <?php if (esc_attr($header_format) == 'recent-popular') echo 'selected'; ?>><?php _e('Top-Recent', 'dfd'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('thumb_sel')); ?>"><?php _e('Display thumb:', 'dfd'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('thumb_sel')); ?>" name="<?php echo esc_attr($this->get_field_name('thumb_sel')); ?>"  value="<?php echo esc_attr($thumb_sel); ?>">
				<option  value='thumb' <?php if (esc_attr($thumb_sel) == 'thumb') echo 'selected'; ?>><?php _e('Thumbnail', 'dfd'); ?></option>
				<option  value='date' <?php if (esc_attr($thumb_sel) == 'date') echo 'selected'; ?>><?php _e('Post format', 'dfd'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('thumb_size')); ?>"><?php _e('Thumb size:', 'dfd'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('thumb_size')); ?>" name="<?php echo esc_attr($this->get_field_name('thumb_size')); ?>"  value="<?php echo esc_attr($thumb_size); ?>">
				<option  value='thumb-small' <?php if (esc_attr($thumb_size) == 'thumb-small') echo 'selected'; ?>><?php _e('Small thumb', 'dfd'); ?></option>
				<option  value='thumb-big' <?php if (esc_attr($thumb_size) == 'thumb-big') echo 'selected'; ?>><?php _e('Big thumb', 'dfd'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('thumb_radius')); ?>"><?php _e('Thumb border radius in px:', 'dfd'); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('thumb_radius')); ?>" name="<?php echo esc_attr($this->get_field_name('thumb_radius')); ?>" value="<?php echo esc_attr($instance['thumb_radius']); ?>"/>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('author')); ?>"><?php _e('Show author', 'dfd'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('author')); ?>" name="<?php echo esc_attr($this->get_field_name('author')); ?>" value="true" <?php if ($instance['author']) echo 'checked="checked"'; ?> type="checkbox"/>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('date')); ?>"><?php _e('Show date', 'dfd'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('date')); ?>" name="<?php echo esc_attr($this->get_field_name('date')); ?>" value="true" <?php if ($instance['date']) echo 'checked="checked"'; ?> type="checkbox"/>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('comments')); ?>"><?php _e('Show comments', 'dfd'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('comments')); ?>" name="<?php echo esc_attr($this->get_field_name('comments')); ?>" value="true" <?php if ($instance['comments']) echo 'checked="checked"'; ?> type="checkbox"/>
        </p>
    <?php
    } // End form()
	
    /*----------------------------------------
       update()
       ----------------------------------------

     * Function to update the settings from
     * the form() function.

     * Params:
     * - Array $new_instance
     * - Array $old_instance
     ----------------------------------------*/

    function update($new_instance, $old_instance) {
        $new_instance = $this->aq_enforce_defaults($new_instance);
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['thumb_sel'] = $new_instance['thumb_sel'];
        $instance['thumb_size'] = $new_instance['thumb_size'];
        $instance['thumb_radius'] = $new_instance['thumb_radius'];
        $instance['header_format'] = $new_instance['header_format'];
		$instance['author'] = (bool) $new_instance['author'];
		$instance['date'] = (bool) $new_instance['date'];
		$instance['comments'] = (bool) $new_instance['comments'];
        return $new_instance;
    } // End update()

    function aq_enforce_defaults($instance) {
        $defaults = $this->aq_get_settings();
        $instance = wp_parse_args($instance, $defaults);
        $instance['number'] = intval($instance['number']);
        if ($instance['number'] < 1)
            $instance['number'] = $defaults['number'];

        return $instance;
    }

    /**
     * Provides an array of the settings with the setting name as the key and the default value as the value
     * This cannot be called get_settings() or it will override WP_Widget::get_settings()
     */
    function aq_get_settings() {
        // Set the default to a blank string
        $settings = array_fill_keys($this->settings, '');
        // Now set the more specific defaults
        $settings['title'] = 'Tabbed Widget';
        $settings['number'] = 5;
        $settings['thumb_radius'] = '100';
        $settings['header_format'] = 'popular-recent';
		$settings['author'] = false;
		$settings['date'] = false;
		$settings['comments'] = false;
        return $settings;
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
		
		if(isset($instance['title'])) {
			$title = apply_filters('widget_title', $instance['title']);
		} else {
			$title = '';
		}
		
        $instance = $this->aq_enforce_defaults($instance);
        extract($instance, EXTR_SKIP);
        $header_format = $instance['header_format'];
        $number = $instance['number'];
        $thumb_radius = $instance['thumb_radius'];
		$author = $instance['author'];
		$date = $instance['date'];
		$comments = $instance['comments'];

        echo $before_widget;
        if ($title) {
            echo $before_title;
            echo $title;
            echo $after_title;
        } ?>

        <dl class="tabs contained horisontal">
            <?php if ($header_format == 'popular-recent'): ?>
				<dt></dt>
                <dd class="first"><a href="#recent-p-tab"><?php _e('Recent news', 'dfd') ?></a></dd>
				<dt></dt>
                <dd class="active second"><a href="#popular-p-tab"><?php _e('Top rated', 'dfd') ?></a></dd>
		<?php /*		<dt></dt>
                <dd><a href="#comments-p-tab"><?php _e('Comments', 'dfd') ?></a></dd>*/?>
            <?php else : ?>
				<dt></dt>
                <dd class="first"><a href="#popular-p-tab"><?php _e('Top rated', 'dfd') ?></a></dd>
				<dt></dt>
                <dd class="active second"><a href="#recent-p-tab"><?php _e('Recent news', 'dfd') ?></a></dd>
		<?php	/*	<dt></dt>
                <dd><a href="#comments-p-tab"><?php _e('Comments', 'dfd') ?></a></dd>*/?>
			<?php endif; ?>
		</dl>
		<ul class="tabs-content contained recent-posts-list clearfix <?php echo $comments ? 'comments-enabled' : '' ?>">
			<li id="popular-p-tabTab" <?php echo (($header_format == 'popular-recent')) ? 'class="active"' : ''; ?>>
				<?php $this->tab_content('comment_count', $number, $thumb_radius, $author, $date, $comments); ?>
			</li>
			<li id="recent-p-tabTab" <?php echo (($header_format != 'popular-recent')) ? 'class="active"' : ''; ?>>
				<?php $this->tab_content('date', $number, $thumb_radius, $author, $date, $comments); ?>
			</li>
			<?php /*<li id="comments-p-tabTab">
				<?php if (function_exists('aq_widget_tabs_comments')) aq_widget_tabs_comments($number); ?>
			</li> */?>
		</ul>

		<?php echo $after_widget;
	}
	
	protected function tab_content($order_by = '', $post_count = 5, $thumb_radius = 0, $author = false, $date = true, $comments = true) {
		$query = new WP_Query(array(
			'order' => 'DESC',
			'orderby' => $order_by,
			'posts_per_page' => $post_count,
		));
					
		if ($query->have_posts()) {
			while($query->have_posts()) {
				$query->the_post();
				$rounded_style = 'style="border-radius:'.esc_attr($thumb_radius).'px;"';
				?>

				<div class="post-list-item clearfix">
					<div class="entry-thumb" <?php echo $rounded_style; ?>>
						<?php get_template_part('templates/thumbnail/post', 'widget'); ?>
						<?php if ($comments) { ?>
							<div class="post-comments-wrap">
								<?php get_template_part('templates/entry-meta/mini', 'comments-number'); ?>
							</div>
						<?php } ?>
					</div>
					<div class="entry-content-wrap">
						<div class="box-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
						<?php if ($author || $date) { ?>
							<div class="entry-meta dopinfo">
								<?php
								if ($author) {
									get_template_part('templates/entry-meta/mini', 'author');
									get_template_part('templates/entry-meta/mini', 'delim-blank');
								}

								if ($date) {
									get_template_part('templates/entry-meta/mini', 'date');
								}
								?>
							</div>
						<?php } ?>
					</div>
				</div>
				<?php
			}
		}
		wp_reset_postdata();
	}
} // End Class

/*-----------------------------------------------------------------------------------*/
/*  Latest Comments */
/*-----------------------------------------------------------------------------------*/
/*
if (!function_exists('aq_widget_tabs_comments')) {
    function aq_widget_tabs_comments($posts = 5)
    {
        global $wpdb;

        $comments = get_comments(array('number' => $posts, 'status' => 'approve'));

        if ($comments) {
            foreach ((array)$comments as $comment) {

                $post = get_post($comment->comment_post_ID);
                ?>

                <article class="post-list-item clearfix">

                    <span class="icon-format icon-bubble-1"></span>


                    <div class="box-name">
                        <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php echo $post->post_title; ?></a>
                    </div>

                    <div class="entry-summary">
                        <p><?php echo wp_trim_words(($comment->comment_content), 10); ?></p>

                    </div>

                </article>


            <?php
            }
        }
    }

    wp_reset_postdata();
}
 */

add_action( 'widgets_init', create_function( '', 'register_widget("Crum_Widget_Tabs");' ) );

