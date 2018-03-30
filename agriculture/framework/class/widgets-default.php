<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Rewrited Wordpress Default Widgets
 * Changed by CMSMasters
 * 
 */


/**
 * Pages widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Pages_Custom extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_pages', 'description' => __( 'Your site&#8217;s WordPress Pages') );
		parent::__construct('pages', __('Pages'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Pages' ) : $instance['title'], $instance, $this->id_base);
		$sortby = empty( $instance['sortby'] ) ? 'menu_order' : $instance['sortby'];
		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];
		
        $widget_width = isset($instance['widget_width']) ? $instance['widget_width'] : 'one_first';

		if ( $sortby == 'menu_order' )
			$sortby = 'menu_order, post_title';

		$out = wp_list_pages( apply_filters('widget_pages_args', array('title_li' => '', 'echo' => 0, 'sort_column' => $sortby, 'exclude' => $exclude) ) );

		if ( !empty( $out ) ) {
			echo '<div class="' . $widget_width . '">';
			
			echo $before_widget;
			
			if ( $title)
				echo $before_title . $title . $after_title;
		?>
		<ul>
			<?php echo $out; ?>
		</ul>
		<?php
			echo $after_widget;
			
			echo '</div>';
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
			$instance['sortby'] = $new_instance['sortby'];
		} else {
			$instance['sortby'] = 'menu_order';
		}

		$instance['exclude'] = strip_tags( $new_instance['exclude'] );
		
        $instance['widget_width'] = $new_instance['widget_width'];

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'sortby' => 'post_title', 'title' => '', 'exclude' => '') );
		$title = esc_attr( $instance['title'] );
		$exclude = esc_attr( $instance['exclude'] );
		
        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e( 'Sort by:' ); ?></label>
			<select name="<?php echo $this->get_field_name('sortby'); ?>" id="<?php echo $this->get_field_id('sortby'); ?>" class="widefat">
				<option value="post_title"<?php selected( $instance['sortby'], 'post_title' ); ?>><?php _e('Page title'); ?></option>
				<option value="menu_order"<?php selected( $instance['sortby'], 'menu_order' ); ?>><?php _e('Page order'); ?></option>
				<option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>><?php _e( 'Page ID' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e( 'Exclude:' ); ?></label> <input type="text" value="<?php echo $exclude; ?>" name="<?php echo $this->get_field_name('exclude'); ?>" id="<?php echo $this->get_field_id('exclude'); ?>" class="widefat" />
			<br />
			<small><?php _e( 'Page IDs, separated by commas.' ); ?></small>
		</p>
		<p class="w_col">
			<label for="<?php echo $this->get_field_id('widget_width'); ?>">
				<?php _e('Choose the width of widget', 'cmsmasters'); ?>:<br /><br />
                <small class="s_red"><?php _e('Only for horizontal sidebars', 'cmsmasters'); ?></small>
                <select id="<?php echo $this->get_field_id('widget_width'); ?>" name="<?php echo $this->get_field_name('widget_width'); ?>" class="fl">
                    <option <?php if ($widget_width == 'one_first') { echo 'selected="selected" '; } ?>value="one_first">-- 1/1 --&nbsp;</option>
                    <option <?php if ($widget_width == 'three_fourth') { echo 'selected="selected" '; } ?>value="three_fourth">-- 3/4 --&nbsp;</option>
                    <option <?php if ($widget_width == 'two_third') { echo 'selected="selected" '; } ?>value="two_third">-- 2/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_half') { echo 'selected="selected" '; } ?>value="one_half">-- 1/2 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_third') { echo 'selected="selected" '; } ?>value="one_third">-- 1/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_fourth') { echo 'selected="selected" '; } ?>value="one_fourth">-- 1/4 --&nbsp;</option>
                </select>
            </label>
		</p>
        <div class="cl"></div>
<?php
	}

}

/**
 * Search widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Search_Custom extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_search', 'description' => __( "A search form for your site") );
		parent::__construct('search', __('Search'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		
        $widget_width = isset($instance['widget_width']) ? $instance['widget_width'] : 'one_first';
		
		echo '<div class="' . $widget_width . '">';
		
		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;

		// Use current theme search form if it exists
		get_search_form();

		echo $after_widget;
		
		echo '</div>';
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = $instance['title'];
		
        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p class="w_col">
			<label for="<?php echo $this->get_field_id('widget_width'); ?>">
				<?php _e('Choose the width of widget', 'cmsmasters'); ?>:<br /><br />
                <small class="s_red"><?php _e('Only for horizontal sidebars', 'cmsmasters'); ?></small>
                <select id="<?php echo $this->get_field_id('widget_width'); ?>" name="<?php echo $this->get_field_name('widget_width'); ?>" class="fl">
                    <option <?php if ($widget_width == 'one_first') { echo 'selected="selected" '; } ?>value="one_first">-- 1/1 --&nbsp;</option>
                    <option <?php if ($widget_width == 'three_fourth') { echo 'selected="selected" '; } ?>value="three_fourth">-- 3/4 --&nbsp;</option>
                    <option <?php if ($widget_width == 'two_third') { echo 'selected="selected" '; } ?>value="two_third">-- 2/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_half') { echo 'selected="selected" '; } ?>value="one_half">-- 1/2 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_third') { echo 'selected="selected" '; } ?>value="one_third">-- 1/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_fourth') { echo 'selected="selected" '; } ?>value="one_fourth">-- 1/4 --&nbsp;</option>
                </select>
            </label>
		</p>
        <div class="cl"></div>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = strip_tags($new_instance['title']);
		
        $instance['widget_width'] = $new_instance['widget_width'];
		
		return $instance;
	}

}

/**
 * Archives widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Archives_Custom extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_archive', 'description' => __( 'A monthly archive of your site&#8217;s posts') );
		parent::__construct('archives', __('Archives'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Archives') : $instance['title'], $instance, $this->id_base);
		
        $widget_width = isset($instance['widget_width']) ? $instance['widget_width'] : 'one_first';

		echo '<div class="' . $widget_width . '">';
		
		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;

		if ( $d ) {
?>
		<select name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'> 
			<option value=""><?php echo esc_attr(__('Select Month')); ?></option> 
			<?php 
			wp_get_archives(
				apply_filters('widget_archives_dropdown_args', array(
					'type' => 'monthly', 
					'format' => 'option', 
					'show_post_count' => $c 
				))
			); 
			?> 
		</select>
<?php
		} else {
?>
		<ul>
		<?php 
		wp_get_archives(
			apply_filters('widget_archives_args', array(
				'type' => 'monthly', 
				'show_post_count' => $c 
			))
		); 
		?>
		</ul>
<?php
		}

		echo $after_widget;
		
		echo '</div>';
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = $new_instance['count'] ? 1 : 0;
		$instance['dropdown'] = $new_instance['dropdown'] ? 1 : 0;
		
        $instance['widget_width'] = $new_instance['widget_width'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$title = strip_tags($instance['title']);
		$count = $instance['count'] ? 'checked="checked"' : '';
		$dropdown = $instance['dropdown'] ? 'checked="checked"' : '';
		
        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $dropdown; ?> id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>" /> <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e('Display as dropdown'); ?></label>
			<br/>
			<input class="checkbox" type="checkbox" <?php echo $count; ?> id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" /> <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts'); ?></label>
		</p>
		<p class="w_col">
			<label for="<?php echo $this->get_field_id('widget_width'); ?>">
				<?php _e('Choose the width of widget', 'cmsmasters'); ?>:<br /><br />
                <small class="s_red"><?php _e('Only for horizontal sidebars', 'cmsmasters'); ?></small>
                <select id="<?php echo $this->get_field_id('widget_width'); ?>" name="<?php echo $this->get_field_name('widget_width'); ?>" class="fl">
                    <option <?php if ($widget_width == 'one_first') { echo 'selected="selected" '; } ?>value="one_first">-- 1/1 --&nbsp;</option>
                    <option <?php if ($widget_width == 'three_fourth') { echo 'selected="selected" '; } ?>value="three_fourth">-- 3/4 --&nbsp;</option>
                    <option <?php if ($widget_width == 'two_third') { echo 'selected="selected" '; } ?>value="two_third">-- 2/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_half') { echo 'selected="selected" '; } ?>value="one_half">-- 1/2 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_third') { echo 'selected="selected" '; } ?>value="one_third">-- 1/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_fourth') { echo 'selected="selected" '; } ?>value="one_fourth">-- 1/4 --&nbsp;</option>
                </select>
            </label>
		</p>
        <div class="cl"></div>
<?php
	}
}

/**
 * Meta widget class
 *
 * Displays log in/out, RSS feed links, etc.
 *
 * @since 2.8.0
 */
class WP_Widget_Meta_Custom extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_meta', 'description' => __( "Log in/out, admin, feed and WP links") );
		parent::__construct('meta', __('Meta'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Meta') : $instance['title'], $instance, $this->id_base);
		
        $widget_width = isset($instance['widget_width']) ? $instance['widget_width'] : 'one_first';

		echo '<div class="' . $widget_width . '">';

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
?>
			<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php echo esc_attr(__('Syndicate this site using RSS 2.0')); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
			<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php echo esc_attr(__('The latest comments to all posts in RSS')); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
			<li><a href="http://wordpress.org/" title="<?php echo esc_attr(__('Powered by WordPress, state-of-the-art semantic personal publishing platform.')); ?>">WordPress.org</a></li>
			<?php wp_meta(); ?>
			</ul>
<?php
		echo $after_widget;
		
		echo '</div>';
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
        $instance['widget_width'] = $new_instance['widget_width'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		
        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p class="w_col">
			<label for="<?php echo $this->get_field_id('widget_width'); ?>">
				<?php _e('Choose the width of widget', 'cmsmasters'); ?>:<br /><br />
                <small class="s_red"><?php _e('Only for horizontal sidebars', 'cmsmasters'); ?></small>
                <select id="<?php echo $this->get_field_id('widget_width'); ?>" name="<?php echo $this->get_field_name('widget_width'); ?>" class="fl">
                    <option <?php if ($widget_width == 'one_first') { echo 'selected="selected" '; } ?>value="one_first">-- 1/1 --&nbsp;</option>
                    <option <?php if ($widget_width == 'three_fourth') { echo 'selected="selected" '; } ?>value="three_fourth">-- 3/4 --&nbsp;</option>
                    <option <?php if ($widget_width == 'two_third') { echo 'selected="selected" '; } ?>value="two_third">-- 2/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_half') { echo 'selected="selected" '; } ?>value="one_half">-- 1/2 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_third') { echo 'selected="selected" '; } ?>value="one_third">-- 1/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_fourth') { echo 'selected="selected" '; } ?>value="one_fourth">-- 1/4 --&nbsp;</option>
                </select>
            </label>
		</p>
        <div class="cl"></div>
<?php
	}
}

/**
 * Calendar widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Calendar_Custom extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_calendar', 'description' => __( 'A calendar of your site&#8217;s posts') );
		parent::__construct('calendar', __('Calendar'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		
        $widget_width = isset($instance['widget_width']) ? $instance['widget_width'] : 'one_first';

		echo '<div class="' . $widget_width . '">';
		
		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;
		
		echo '<div id="calendar_wrap">';
		get_calendar();
		echo '</div>';
		
		echo $after_widget;
		
		echo '</div>';
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
        $instance['widget_width'] = $new_instance['widget_width'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		
        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p class="w_col">
			<label for="<?php echo $this->get_field_id('widget_width'); ?>">
				<?php _e('Choose the width of widget', 'cmsmasters'); ?>:<br /><br />
                <small class="s_red"><?php _e('Only for horizontal sidebars', 'cmsmasters'); ?></small>
                <select id="<?php echo $this->get_field_id('widget_width'); ?>" name="<?php echo $this->get_field_name('widget_width'); ?>" class="fl">
                    <option <?php if ($widget_width == 'one_first') { echo 'selected="selected" '; } ?>value="one_first">-- 1/1 --&nbsp;</option>
                    <option <?php if ($widget_width == 'three_fourth') { echo 'selected="selected" '; } ?>value="three_fourth">-- 3/4 --&nbsp;</option>
                    <option <?php if ($widget_width == 'two_third') { echo 'selected="selected" '; } ?>value="two_third">-- 2/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_half') { echo 'selected="selected" '; } ?>value="one_half">-- 1/2 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_third') { echo 'selected="selected" '; } ?>value="one_third">-- 1/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_fourth') { echo 'selected="selected" '; } ?>value="one_fourth">-- 1/4 --&nbsp;</option>
                </select>
            </label>
		</p>
        <div class="cl"></div>
<?php
	}
}

/**
 * Text widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Text_Custom extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_text', 'description' => __('Arbitrary text or HTML'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('text', __('Text'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		
        $widget_width = isset($instance['widget_width']) ? $instance['widget_width'] : 'one_first';

		echo '<div class="' . $widget_width . '">';
		
		echo $before_widget;
		
		if ( !empty( $title ) ) { 
			echo $before_title . $title . $after_title; 
		} 
		?>
			<div class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
		<?php
		echo $after_widget;
		
		echo '</div>';
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		
		$instance['filter'] = isset($new_instance['filter']);
		
        $instance['widget_width'] = $new_instance['widget_width'];
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);
		
        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs'); ?></label></p>
		<p class="w_col">
			<label for="<?php echo $this->get_field_id('widget_width'); ?>">
				<?php _e('Choose the width of widget', 'cmsmasters'); ?>:<br /><br />
                <small class="s_red"><?php _e('Only for horizontal sidebars', 'cmsmasters'); ?></small>
                <select id="<?php echo $this->get_field_id('widget_width'); ?>" name="<?php echo $this->get_field_name('widget_width'); ?>" class="fl">
                    <option <?php if ($widget_width == 'one_first') { echo 'selected="selected" '; } ?>value="one_first">-- 1/1 --&nbsp;</option>
                    <option <?php if ($widget_width == 'three_fourth') { echo 'selected="selected" '; } ?>value="three_fourth">-- 3/4 --&nbsp;</option>
                    <option <?php if ($widget_width == 'two_third') { echo 'selected="selected" '; } ?>value="two_third">-- 2/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_half') { echo 'selected="selected" '; } ?>value="one_half">-- 1/2 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_third') { echo 'selected="selected" '; } ?>value="one_third">-- 1/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_fourth') { echo 'selected="selected" '; } ?>value="one_fourth">-- 1/4 --&nbsp;</option>
                </select>
            </label>
		</p>
        <div class="cl"></div>
<?php
	}
}

/**
 * Categories widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Categories_Custom extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_categories', 'description' => __( "A list or dropdown of categories" ) );
		parent::__construct('categories', __('Categories'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base);
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';
		
        $widget_width = isset($instance['widget_width']) ? $instance['widget_width'] : 'one_first';

		echo '<div class="' . $widget_width . '">';

		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;

		$cat_args = array('orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h);

		if ( $d ) {
			$cat_args['show_option_none'] = __('Select Category');
			
			wp_dropdown_categories(apply_filters('widget_categories_dropdown_args', $cat_args));
?>

<script type='text/javascript'>
/* <![CDATA[ */
	var dropdown = document.getElementById('cat');
	
	function onCatChange() { 
		if (dropdown.options[dropdown.selectedIndex].value > 0) { 
			location.href = '<?php echo home_url(); ?>/?cat=' + dropdown.options[dropdown.selectedIndex].value;
		}
	}
	
	dropdown.onchange = onCatChange;
/* ]]> */
</script>

<?php
		} else {
?>
		<ul>
<?php
		$cat_args['title_li'] = '';
		wp_list_categories(apply_filters('widget_categories_args', $cat_args));
?>
		</ul>
<?php
		}

		echo $after_widget;
		
		echo'</div>';
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;
		
        $instance['widget_width'] = $new_instance['widget_width'];

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] );
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
		
        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Display as dropdown' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy' ); ?></label></p>
		<p class="w_col">
			<label for="<?php echo $this->get_field_id('widget_width'); ?>">
				<?php _e('Choose the width of widget', 'cmsmasters'); ?>:<br /><br />
                <small class="s_red"><?php _e('Only for horizontal sidebars', 'cmsmasters'); ?></small>
                <select id="<?php echo $this->get_field_id('widget_width'); ?>" name="<?php echo $this->get_field_name('widget_width'); ?>" class="fl">
                    <option <?php if ($widget_width == 'one_first') { echo 'selected="selected" '; } ?>value="one_first">-- 1/1 --&nbsp;</option>
                    <option <?php if ($widget_width == 'three_fourth') { echo 'selected="selected" '; } ?>value="three_fourth">-- 3/4 --&nbsp;</option>
                    <option <?php if ($widget_width == 'two_third') { echo 'selected="selected" '; } ?>value="two_third">-- 2/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_half') { echo 'selected="selected" '; } ?>value="one_half">-- 1/2 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_third') { echo 'selected="selected" '; } ?>value="one_third">-- 1/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_fourth') { echo 'selected="selected" '; } ?>value="one_fourth">-- 1/4 --&nbsp;</option>
                </select>
            </label>
		</p>
        <div class="cl"></div>
<?php
	}

}

/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Recent_Posts_Custom extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "The most recent posts on your site") );
		parent::__construct('recent-posts', __('Recent Posts'), $widget_ops);
		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
		
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10;
			
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
		
		$r = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true));
		
		if ($r->have_posts()) :
			echo '<div class="' . $widget_width . '">';
			
			echo $before_widget;
			
			if ( $title ) echo $before_title . $title . $after_title;
			
			echo '<ul>';
			
			while ($r->have_posts()) : $r->the_post(); 
			?>
			<li>
				<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
			<?php if ( $show_date ) : ?>
				<span class="post-date"><?php echo get_the_date(); ?></span>
			<?php endif; ?>
			</li>
			<?php 
			endwhile;
			
			echo '</ul>';
			
			echo $after_widget;
			
			echo '</div>';
			
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
		endif;
		
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = (bool) $new_instance['show_date'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');
		
        $instance['widget_width'] = $new_instance['widget_width'];

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		
        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
		
		<p class="w_col">
			<label for="<?php echo $this->get_field_id('widget_width'); ?>">
				<?php _e('Choose the width of widget', 'cmsmasters'); ?>:<br /><br />
                <small class="s_red"><?php _e('Only for horizontal sidebars', 'cmsmasters'); ?></small>
                <select id="<?php echo $this->get_field_id('widget_width'); ?>" name="<?php echo $this->get_field_name('widget_width'); ?>" class="fl">
                    <option <?php if ($widget_width == 'one_first') { echo 'selected="selected" '; } ?>value="one_first">-- 1/1 --&nbsp;</option>
                    <option <?php if ($widget_width == 'three_fourth') { echo 'selected="selected" '; } ?>value="three_fourth">-- 3/4 --&nbsp;</option>
                    <option <?php if ($widget_width == 'two_third') { echo 'selected="selected" '; } ?>value="two_third">-- 2/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_half') { echo 'selected="selected" '; } ?>value="one_half">-- 1/2 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_third') { echo 'selected="selected" '; } ?>value="one_third">-- 1/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_fourth') { echo 'selected="selected" '; } ?>value="one_fourth">-- 1/4 --&nbsp;</option>
                </select>
            </label>
		</p>
        <div class="cl"></div>
<?php
	}
}

/**
 * Recent_Comments widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Recent_Comments_Custom extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_comments', 'description' => __( 'The most recent comments' ) );
		parent::__construct('recent-comments', __('Recent Comments'), $widget_ops);
		$this->alt_option_name = 'widget_recent_comments';

		if ( is_active_widget(false, false, $this->id_base) )
			add_action( 'wp_head', array(&$this, 'recent_comments_style') );

		add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
	}

	function recent_comments_style() {
		if ( ! current_theme_supports( 'widgets' ) // Temp hack #14876
			|| ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) )
			return;
		?>
	<style type="text/css">
		.recentcomments a {
			background:none !important;
			display:inline !important;
			padding:0 !important;
			margin:0 !important;
		}
	</style>
<?php
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_comments', 'widget');
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get('widget_recent_comments', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

 		extract($args, EXTR_SKIP);
		
 		$output = '';
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Comments' ) : $instance['title'], $instance, $this->id_base );

		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 5;

		$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) );

        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
		
		$output .= '<div class="' . $widget_width . '">';
		
		$output .= $before_widget;
		
		if ( $title )
			$output .= $before_title . $title . $after_title;

		$output .= '<ul id="recentcomments">';
		
		if ( $comments ) {
			foreach ( (array) $comments as $comment) {
				$output .=  '<li class="recentcomments">' . /* translators: comments widget: 1: comment author, 2: post link */ sprintf(_x('%1$s on %2$s', 'widgets'), get_comment_author_link(), '<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
			}
 		}
		
		$output .= '</ul>';
		
		$output .= $after_widget;
		
		$output .= '</div>';

		echo $output;
		
		$cache[$args['widget_id']] = $output;
		wp_cache_set('widget_recent_comments', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = absint( $new_instance['number'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_comments']) )
			delete_option('widget_recent_comments');
		
        $instance['widget_width'] = $new_instance['widget_width'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		
        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show:'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		<p class="w_col">
			<label for="<?php echo $this->get_field_id('widget_width'); ?>">
				<?php _e('Choose the width of widget', 'cmsmasters'); ?>:<br /><br />
                <small class="s_red"><?php _e('Only for horizontal sidebars', 'cmsmasters'); ?></small>
                <select id="<?php echo $this->get_field_id('widget_width'); ?>" name="<?php echo $this->get_field_name('widget_width'); ?>" class="fl">
                    <option <?php if ($widget_width == 'one_first') { echo 'selected="selected" '; } ?>value="one_first">-- 1/1 --&nbsp;</option>
                    <option <?php if ($widget_width == 'three_fourth') { echo 'selected="selected" '; } ?>value="three_fourth">-- 3/4 --&nbsp;</option>
                    <option <?php if ($widget_width == 'two_third') { echo 'selected="selected" '; } ?>value="two_third">-- 2/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_half') { echo 'selected="selected" '; } ?>value="one_half">-- 1/2 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_third') { echo 'selected="selected" '; } ?>value="one_third">-- 1/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_fourth') { echo 'selected="selected" '; } ?>value="one_fourth">-- 1/4 --&nbsp;</option>
                </select>
            </label>
		</p>
        <div class="cl"></div>
<?php
	}
}

/**
 * RSS widget class
 *
 * @since 2.8.0
 */
class WP_Widget_RSS_Custom extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Entries from any RSS or Atom feed') );
		$control_ops = array( 'width' => 400, 'height' => 200 );
		parent::__construct( 'rss', __('RSS'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {

		if ( isset($instance['error']) && $instance['error'] )
			return;

		extract($args, EXTR_SKIP);

		$url = ! empty( $instance['url'] ) ? $instance['url'] : '';

        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
		
		while ( stristr($url, 'http') != $url )
			$url = substr($url, 1);

		if ( empty($url) )
			return;

		// self-url destruction sequence
		if ( in_array( untrailingslashit( $url ), array( site_url(), home_url() ) ) )
			return;

		$rss = fetch_feed($url);
		$title = $instance['title'];
		$desc = '';
		$link = '';

		if ( ! is_wp_error($rss) ) {
			$desc = esc_attr(strip_tags(@html_entity_decode($rss->get_description(), ENT_QUOTES, get_option('blog_charset'))));
			
			if ( empty($title) )
				$title = esc_html(strip_tags($rss->get_title()));
			
			$link = esc_url(strip_tags($rss->get_permalink()));
			
			while ( stristr($link, 'http') != $link )
				$link = substr($link, 1);
		}

		if ( empty($title) )
			$title = empty($desc) ? __('Unknown Feed') : $desc;

		$title = apply_filters('widget_title', $title, $instance, $this->id_base);
		$url = esc_url(strip_tags($url));
		$icon = includes_url('images/rss.png');
		
		if ( $title )
			$title = "<a class='rsswidget' href='$url' title='" . esc_attr__( 'Syndicate this content' ) ."'><img style='border:0' width='14' height='14' src='$icon' alt='RSS' /></a> <a class='rsswidget' href='$link' title='$desc'>$title</a>";
		
		echo '<div class="' . $widget_width . '">';

		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;
		
		wp_widget_rss_output( $rss, $instance );
		
		echo $after_widget;
		
		echo '</div>';

		if ( ! is_wp_error($rss) )
			$rss->__destruct();
		
		unset($rss);
	}

	function update($new_instance, $old_instance) {
		$testurl = ( isset( $new_instance['url'] ) && ( !isset( $old_instance['url'] ) || ( $new_instance['url'] != $old_instance['url'] ) ) );
		
        $instance['widget_width'] = $new_instance['widget_width'];

		return wp_widget_rss_process_custom( $new_instance, $testurl );
	}

	function form($instance) {
		if ( empty($instance) )
			$instance = array( 'title' => '', 'url' => '', 'items' => 10, 'error' => false, 'show_summary' => 0, 'show_author' => 0, 'show_date' => 0, 'widget_width' => 'one_first' );
		
		$instance['number'] = $this->number;

		wp_widget_rss_form_custom( $instance );
	}
}

/**
 * Display RSS widget options form.
 *
 * The options for what fields are displayed for the RSS form are all booleans
 * and are as follows: 'url', 'title', 'items', 'show_summary', 'show_author',
 * 'show_date'.
 *
 * @since 2.5.0
 *
 * @param array|string $args Values for input fields.
 * @param array $inputs Override default display options.
 */
function wp_widget_rss_form_custom( $args, $inputs = null ) {

	$default_inputs = array( 'url' => true, 'title' => true, 'items' => true, 'show_summary' => true, 'show_author' => true, 'show_date' => true, 'widget_width' => 'one_first' );
	$inputs = wp_parse_args( $inputs, $default_inputs );
	
	extract( $args );
	extract( $inputs, EXTR_SKIP);

	$number = esc_attr( $number );
	$title  = esc_attr( $title );
	$url    = esc_url( $url );
	$items  = (int) $items;
	
	if ( $items < 1 || 20 < $items )
		$items  = 10;
	
	$show_summary   = (int) $show_summary;
	$show_author    = (int) $show_author;
	$show_date      = (int) $show_date;
	
	$widget_width   = esc_attr( $widget_width );

	if ( !empty($error) )
		echo '<p class="widget-error"><strong>' . sprintf( __('RSS Error: %s'), $error) . '</strong></p>';

	if ( $inputs['url'] ) :
?>
	<p><label for="rss-url-<?php echo $number; ?>"><?php _e('Enter the RSS feed URL here:'); ?></label>
	<input class="widefat" id="rss-url-<?php echo $number; ?>" name="widget-rss[<?php echo $number; ?>][url]" type="text" value="<?php echo $url; ?>" /></p>
<?php endif; if ( $inputs['title'] ) : ?>
	<p><label for="rss-title-<?php echo $number; ?>"><?php _e('Give the feed a title (optional):'); ?></label>
	<input class="widefat" id="rss-title-<?php echo $number; ?>" name="widget-rss[<?php echo $number; ?>][title]" type="text" value="<?php echo $title; ?>" /></p>
<?php endif; if ( $inputs['items'] ) : ?>
	<p><label for="rss-items-<?php echo $number; ?>"><?php _e('How many items would you like to display?'); ?></label>
	<select id="rss-items-<?php echo $number; ?>" name="widget-rss[<?php echo $number; ?>][items]">
<?php
		for ( $i = 1; $i <= 20; ++$i )
			echo "<option value='$i' " . ( $items == $i ? "selected='selected'" : '' ) . ">$i</option>";
?>
	</select></p>
<?php endif; if ( $inputs['show_summary'] ) : ?>
	<p><input id="rss-show-summary-<?php echo $number; ?>" name="widget-rss[<?php echo $number; ?>][show_summary]" type="checkbox" value="1" <?php if ( $show_summary ) echo 'checked="checked"'; ?>/>
	<label for="rss-show-summary-<?php echo $number; ?>"><?php _e('Display item content?'); ?></label></p>
<?php endif; if ( $inputs['show_author'] ) : ?>
	<p><input id="rss-show-author-<?php echo $number; ?>" name="widget-rss[<?php echo $number; ?>][show_author]" type="checkbox" value="1" <?php if ( $show_author ) echo 'checked="checked"'; ?>/>
	<label for="rss-show-author-<?php echo $number; ?>"><?php _e('Display item author if available?'); ?></label></p>
<?php endif; if ( $inputs['show_date'] ) : ?>
	<p><input id="rss-show-date-<?php echo $number; ?>" name="widget-rss[<?php echo $number; ?>][show_date]" type="checkbox" value="1" <?php if ( $show_date ) echo 'checked="checked"'; ?>/>
	<label for="rss-show-date-<?php echo $number; ?>"><?php _e('Display item date?'); ?></label></p>
<?php
	endif;
	foreach ( array_keys($default_inputs) as $input ) :
		if ( 'hidden' === $inputs[$input] ) :
			$id = str_replace( '_', '-', $input );
?>
	<input type="hidden" id="rss-<?php echo $id; ?>-<?php echo $number; ?>" name="widget-rss[<?php echo $number; ?>][<?php echo $input; ?>]" value="<?php echo $$input; ?>" />
<?php
		endif;
	endforeach;
?>
		<p class="w_col">
			<label for="widget-rss[<?php echo $number; ?>][widget_width]">
				<?php _e('Choose the width of widget', 'cmsmasters'); ?>:<br /><br />
                <small class="s_red"><?php _e('Only for horizontal sidebars', 'cmsmasters'); ?></small>
                <select id="widget-rss[<?php echo $number; ?>][widget_width]" name="widget-rss[<?php echo $number; ?>][widget_width]" class="fl">
                    <option <?php if ($widget_width == 'one_first') { echo 'selected="selected" '; } ?>value="one_first">-- 1/1 --&nbsp;</option>
                    <option <?php if ($widget_width == 'three_fourth') { echo 'selected="selected" '; } ?>value="three_fourth">-- 3/4 --&nbsp;</option>
                    <option <?php if ($widget_width == 'two_third') { echo 'selected="selected" '; } ?>value="two_third">-- 2/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_half') { echo 'selected="selected" '; } ?>value="one_half">-- 1/2 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_third') { echo 'selected="selected" '; } ?>value="one_third">-- 1/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_fourth') { echo 'selected="selected" '; } ?>value="one_fourth">-- 1/4 --&nbsp;</option>
                </select>
            </label>
		</p>
        <div class="cl"></div>
<?php 
}

/**
 * Process RSS feed widget data and optionally retrieve feed items.
 *
 * The feed widget can not have more than 20 items or it will reset back to the
 * default, which is 10.
 *
 * The resulting array has the feed title, feed url, feed link (from channel),
 * feed items, error (if any), and whether to show summary, author, and date.
 * All respectively in the order of the array elements.
 *
 * @since 2.5.0
 *
 * @param array $widget_rss RSS widget feed data. Expects unescaped data.
 * @param bool $check_feed Optional, default is true. Whether to check feed for errors.
 * @return array
 */
function wp_widget_rss_process_custom( $widget_rss, $check_feed = true ) {
	$items = (int) $widget_rss['items'];
	
	if ( $items < 1 || 20 < $items )
		$items = 10;
	
	$url           = esc_url_raw(strip_tags( $widget_rss['url'] ));
	$title         = trim(strip_tags( $widget_rss['title'] ));
	$show_summary  = isset($widget_rss['show_summary']) ? (int) $widget_rss['show_summary'] : 0;
	$show_author   = isset($widget_rss['show_author']) ? (int) $widget_rss['show_author'] :0;
	$show_date     = isset($widget_rss['show_date']) ? (int) $widget_rss['show_date'] : 0;
	
	$widget_width  = isset($widget_rss['widget_width']) ? strip_tags( $widget_rss['widget_width'] ) : 'one_first';

	if ( $check_feed ) {
		$rss = fetch_feed($url);
		$error = false;
		$link = '';
		
		if ( is_wp_error($rss) ) {
			$error = $rss->get_error_message();
		} else {
			$link = esc_url(strip_tags($rss->get_permalink()));
			
			while ( stristr($link, 'http') != $link )
				$link = substr($link, 1);

			$rss->__destruct();
			
			unset($rss);
		}
	}

	return compact( 'title', 'url', 'link', 'items', 'error', 'show_summary', 'show_author', 'show_date', 'widget_width' );
}

/**
 * Tag cloud widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Tag_Cloud_Custom extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( "Your most used tags in cloud format") );
		parent::__construct('tag_cloud', __('Tag Cloud'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = __('Tags');
			} else {
				$tax = get_taxonomy($current_taxonomy);
				$title = $tax->labels->name;
			}
		}
		
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
		
		echo '<div class="' . $widget_width . '">';

		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;
		
		echo '<div class="tagcloud">';
		wp_tag_cloud( apply_filters('widget_tag_cloud_args', array('taxonomy' => $current_taxonomy) ) );
		echo "</div>\n";
		
		echo $after_widget;
		
		echo '</div>';
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
		
        $instance['widget_width'] = $new_instance['widget_width'];
		
		return $instance;
	}

	function form( $instance ) {
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		
        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:') ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
	<?php foreach ( get_object_taxonomies('post') as $taxonomy ) :
				$tax = get_taxonomy($taxonomy);
				if ( !$tax->show_tagcloud || empty($tax->labels->name) )
					continue;
	?>
		<option value="<?php echo esc_attr($taxonomy) ?>" <?php selected($taxonomy, $current_taxonomy) ?>><?php echo $tax->labels->name; ?></option>
	<?php endforeach; ?>
	</select></p>
		<p class="w_col">
			<label for="<?php echo $this->get_field_id('widget_width'); ?>">
				<?php _e('Choose the width of widget', 'cmsmasters'); ?>:<br /><br />
                <small class="s_red"><?php _e('Only for horizontal sidebars', 'cmsmasters'); ?></small>
                <select id="<?php echo $this->get_field_id('widget_width'); ?>" name="<?php echo $this->get_field_name('widget_width'); ?>" class="fl">
                    <option <?php if ($widget_width == 'one_first') { echo 'selected="selected" '; } ?>value="one_first">-- 1/1 --&nbsp;</option>
                    <option <?php if ($widget_width == 'three_fourth') { echo 'selected="selected" '; } ?>value="three_fourth">-- 3/4 --&nbsp;</option>
                    <option <?php if ($widget_width == 'two_third') { echo 'selected="selected" '; } ?>value="two_third">-- 2/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_half') { echo 'selected="selected" '; } ?>value="one_half">-- 1/2 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_third') { echo 'selected="selected" '; } ?>value="one_third">-- 1/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_fourth') { echo 'selected="selected" '; } ?>value="one_fourth">-- 1/4 --&nbsp;</option>
                </select>
            </label>
		</p>
        <div class="cl"></div>
<?php
	}

	function _get_current_taxonomy($instance) {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
			return $instance['taxonomy'];

		return 'post_tag';
	}
}

/**
 * Navigation Menu widget class
 *
 * @since 3.0.0
 */
 class WP_Nav_Menu_Widget_Custom extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('This widget show selected custom menu') );
		parent::__construct( 'nav_menu', __('Custom Menu'), $widget_ops );
	}

	function widget($args, $instance) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';

		echo '<div class="' . $widget_width . '">';
		
		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu ) );

		echo $args['after_widget'];
		
		echo '</div>';
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		
        $instance['widget_width'] = $new_instance['widget_width'];
		
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
		
        $widget_width = (isset($instance['widget_width']) && $instance['widget_width'] != '') ? $instance['widget_width'] : 'one_first';

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php
			foreach ( $menus as $menu ) {
				$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
			}
		?>
			</select>
		</p>
		<p class="w_col">
			<label for="<?php echo $this->get_field_id('widget_width'); ?>">
				<?php _e('Choose the width of widget', 'cmsmasters'); ?>:<br /><br />
                <small class="s_red"><?php _e('Only for horizontal sidebars', 'cmsmasters'); ?></small>
                <select id="<?php echo $this->get_field_id('widget_width'); ?>" name="<?php echo $this->get_field_name('widget_width'); ?>" class="fl">
                    <option <?php if ($widget_width == 'one_first') { echo 'selected="selected" '; } ?>value="one_first">-- 1/1 --&nbsp;</option>
                    <option <?php if ($widget_width == 'three_fourth') { echo 'selected="selected" '; } ?>value="three_fourth">-- 3/4 --&nbsp;</option>
                    <option <?php if ($widget_width == 'two_third') { echo 'selected="selected" '; } ?>value="two_third">-- 2/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_half') { echo 'selected="selected" '; } ?>value="one_half">-- 1/2 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_third') { echo 'selected="selected" '; } ?>value="one_third">-- 1/3 --&nbsp;</option>
                    <option <?php if ($widget_width == 'one_fourth') { echo 'selected="selected" '; } ?>value="one_fourth">-- 1/4 --&nbsp;</option>
                </select>
            </label>
		</p>
        <div class="cl"></div>
		<?php
	}
}

/**
 * Register all of the default WordPress widgets on startup.
 *
 * Calls 'widgets_init' action after all of the WordPress widgets have been
 * registered.
 *
 * @since 2.2.0
 */
function wp_custom_default_widgets_init() {
	if ( !is_blog_installed() )
		return;

	register_widget('WP_Widget_Pages_Custom');
	register_widget('WP_Widget_Calendar_Custom');
	register_widget('WP_Widget_Archives_Custom');
	register_widget('WP_Widget_Meta_Custom');
	register_widget('WP_Widget_Search_Custom');
	register_widget('WP_Widget_Text_Custom');
	register_widget('WP_Widget_Categories_Custom');
	register_widget('WP_Widget_Recent_Posts_Custom');
	register_widget('WP_Widget_Recent_Comments_Custom');
	register_widget('WP_Widget_RSS_Custom');
	register_widget('WP_Widget_Tag_Cloud_Custom');
	register_widget('WP_Nav_Menu_Widget_Custom');
	
	do_action('widgets_init');
}

add_action('init', 'wp_custom_default_widgets_init', 1);

