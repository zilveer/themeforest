<?php
add_action( 'widgets_init', 'etheme_register_general_widgets' );
function etheme_register_general_widgets() {
	register_widget('Etheme_Twitter_Widget');
	register_widget('Etheme_Recent_Posts_Widget');
	register_widget('Etheme_Recent_Comments_Widget');
    register_widget('Etheme_Subcategories_Widget');
}

class Etheme_Subcategories_Widget extends WP_Widget {
    
    function Etheme_Subcategories_Widget() {
        $widget_ops = array( 'clasname' => 'etheme_subcats', 'description' => __('Display a list of subcategories on Category Page', ETHEME_DOMAIN));
        $control_ops = array('id_base' => 'etheme-subcategories');
        parent::__construct('etheme-subcategories', '8theme - '.__('Subcategories List', ETHEME_DOMAIN), $widget_ops, $control_ops);
    }
    
    function widget($args, $instance) {
        echo $before_widget;
		$title = apply_filters('widget_title', $instance['title'] );
        if(class_exists('WP_eCommerce')) {
            etheme_get_categories_menu($title);
        }
        if(class_exists('Woocommerce')){
            etheme_get_wc_categories_menu($title);
        }
        echo $after_widget;
    }
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}
	function form( $instance ) {
		$defaults = array( 'title' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		etheme_widget_input_text( __('Title:', ETHEME_DOMAIN), $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $instance['title'] );
	}
}

class Etheme_Twitter_Widget extends WP_Widget {
	function Etheme_Twitter_Widget() {
		$widget_ops = array( 'classname' => 'etheme_twitter', 'description' => __('Display most recent Twitter feed', ETHEME_DOMAIN) );
		$control_ops = array( 'id_base' => 'etheme-twitter' );
		parent::__construct( 'etheme-twitter', '8theme - '.__('Twitter Feed', ETHEME_DOMAIN), $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;
		$attr = array( 'usernames' => $instance['usernames'], 'limit' => $instance['limit'], 'interval' => $instance['interval'] );
		$attr['interval'] = $attr['interval'] * 10;
		//echo etheme_get_twitter( $attr );
        echo etheme_print_tweets($instance['consumer_key'],$instance['consumer_secret'],$instance['user_token'],$instance['user_secret'],$attr['usernames'], $attr['limit'], 50);
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['usernames'] = strip_tags( $new_instance['usernames'] );
		$instance['consumer_key'] = strip_tags( $new_instance['consumer_key'] );
		$instance['consumer_secret'] = strip_tags( $new_instance['consumer_secret'] );
		$instance['user_token'] = strip_tags( $new_instance['user_token'] );
		$instance['user_secret'] = strip_tags( $new_instance['user_secret'] );
		$instance['limit'] = strip_tags( $new_instance['limit'] );
		$instance['interval'] = strip_tags( $new_instance['interval'] );
		return $instance;
	}
	function form( $instance ) {
		$defaults = array( 'title' => '', 'usernames' => '8theme', 'limit' => '2', 'interval' => '5' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		etheme_widget_input_text( __('Title:', ETHEME_DOMAIN), $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $instance['title'] );
		etheme_widget_input_text( __('Username:', ETHEME_DOMAIN), $this->get_field_id( 'usernames' ), $this->get_field_name( 'usernames' ), $instance['usernames'] );
		etheme_widget_input_text( __('Customer Key:', ETHEME_DOMAIN), $this->get_field_id( 'consumer_key' ), $this->get_field_name( 'consumer_key' ), $instance['consumer_key'] );
		etheme_widget_input_text( __('Customer Secret:', ETHEME_DOMAIN), $this->get_field_id( 'consumer_secret' ), $this->get_field_name( 'consumer_secret' ), $instance['consumer_secret'] );
		etheme_widget_input_text( __('Access Token:', ETHEME_DOMAIN), $this->get_field_id( 'user_token' ), $this->get_field_name( 'user_token' ), $instance['user_token'] );
		etheme_widget_input_text( __('Access Token Secret:', ETHEME_DOMAIN), $this->get_field_id( 'user_secret' ), $this->get_field_name( 'user_secret' ), $instance['user_secret'] );
		etheme_widget_input_text( __('Number of tweets:', ETHEME_DOMAIN), $this->get_field_id( 'limit' ), $this->get_field_name( 'limit' ), $instance['limit'] );
	}
}

class Etheme_Recent_Posts_Widget extends WP_Widget {

    function Etheme_Recent_Posts_Widget() {
        $widget_ops = array('classname' => 'etheme_widget_recent_entries', 'description' => __( "The most recent posts on your blog (Etheme Edit)") );
        parent::__construct('etheme-recent-posts', '8theme - '.__('Recent Posts'), $widget_ops);
        $this->alt_option_name = 'etheme_widget_recent_entries';

        add_action( 'save_post', array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('etheme_widget_recent_entries', 'widget');

        if ( !is_array($cache) )
                $cache = array();

        if ( isset($cache[$args['widget_id']]) ) {
                echo $cache[$args['widget_id']];
                return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title']);
        if ( !$number = (int) $instance['number'] )
                $number = 10;
        else if ( $number < 1 )
                $number = 1;
        else if ( $number > 15 )
                $number = 15;

        $r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'caller_get_posts' => 1));
        if ($r->have_posts()) : ?>
        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
            <ul class="recent-posts-list">
                <?php  while ($r->have_posts()) : $r->the_post(); ?>
                    <li>
                        <?php 
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), array(60,60));
                            $url = $thumb[0];
                            if($url && $url != ''):
                        ?>
                            <a class="postimg" style="background-image: url( <?php echo $url ?> );" href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"></a>
                        <?php endif; ?>
                        <?php
                            if ( get_the_title() ) $title = get_the_title(); else $title = get_the_ID();
                            $word_nubmers = 20;
                            $title = explode(" ",$title);
                            if(count($title)>$word_nubmers) { $points = '...'; } else { $points = ''; }
                            $title = array_chunk($title,$word_nubmers); 
                            $title = implode(" ",$title[0]).$points;
                        ?>
                        <a href="<?php the_permalink() ?>" <?php if(!$url || $url == '') echo 'style="width:100%;"' ?> title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                            <?php echo $title; ?> 
                        </a>
                        <?php the_author(); ?> <?php the_date('F j, Y','/ '); ?>
                        <div class="clear"></div>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php echo $after_widget; ?>
<?php
                wp_reset_query();  // Restore global post data stomped by the_post().
        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_add('etheme_widget_recent_entries', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['etheme_widget_recent_entries']) )
                delete_option('etheme_widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('etheme_widget_recent_entries', 'widget');
    }

    function form( $instance ) {
        $title = esc_attr($instance['title']);
        if ( !$number = (int) $instance['number'] )
                $number = 5;
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
        <small><?php _e('(at most 15)'); ?></small></p>
<?php
    }
}

class Etheme_Recent_Comments_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'etheme_widget_recent_comments', 'description' => __( 'The most recent comments (Etheme edit)' ) );
		parent::__construct('etheme-recent-comments', '8theme - '.__('Recent Comments'), $widget_ops);
		$this->alt_option_name = 'etheme_widget_recent_comments';

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
	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<?php
	}

	function flush_widget_cache() {
		wp_cache_delete('etheme_widget_recent_comments', 'widget');
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get('etheme_widget_recent_comments', 'widget');

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
		$output .= $before_widget;
		if ( $title )
			$output .= $before_title . $title . $after_title;

		$output .= '<ul id="recentcomments">';
		if ( $comments ) {
			foreach ( (array) $comments as $comment) {
				$output .=  '<li class="recentcomments">' . sprintf(_x('<span class="comment_author">%1$s</span> <br> %2$s', 'widgets'), get_comment_author_link(), '<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
			}
 		}
		$output .= '</ul>';
		$output .= $after_widget;

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
		if ( isset($alloptions['etheme_widget_recent_comments']) )
			delete_option('etheme_widget_recent_comments');

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show:'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}



/* Forms
-------------------------------------------------------------- */
function etheme_widget_label( $label, $id ) {
	echo "<label for='{$id}'>{$label}</label>";
}
function etheme_widget_input_checkbox( $label, $id, $name, $checked ) {
	echo "\n\t\t\t<p>";
	echo "<label for='{$id}'>";
	echo "<input type='checkbox' id='{$id}' name='{$name}' {$checked} /> ";
	echo "{$label}</label>";
	echo '</p>';
}
function etheme_widget_textarea( $label, $id, $name, $value ) {
	echo "\n\t\t\t<p>";
	etheme_widget_label( $label, $id );
	echo "<textarea id='{$id}' name='{$name}' rows='3' cols='10' class='widefat'>" . strip_tags( $value ) . "</textarea>";
	echo '</p>';
}
function etheme_widget_input_text( $label, $id, $name, $value ) {
	echo "\n\t\t\t<p>";
	etheme_widget_label( $label, $id );
	echo "<input type='text' id='{$id}' name='{$name}' value='" . strip_tags( $value ) . "' class='widefat' />";
	echo '</p>';
}
function etheme_widget_input_text_small( $label, $id, $name, $value ) {
	echo "\n\t\t\t<p>";
	etheme_widget_label( $label, $id );
	echo "<input type='text' id='{$id}' name='{$name}' value='" . strip_tags( $value ) . "' size='6' class='code' />";
	echo '</p>';
}
function etheme_widget_select_multiple( $label, $id, $name, $value, $options, $blank_option ) {
	$value = (array) $value;
	if ( $blank_option && is_array( $options ) )
		$options = array_merge( array( '' ), $options );
	echo "\n\t\t\t<p>";
	etheme_widget_label( $label, $id );
	echo "<select id='{$id}' name='{$name}[]' multiple='multiple' size='4' class='widefat' style='height:5.0em;'>";
	foreach ( $options as $option_value => $option_label )
		echo "<option value='" . ( ( $option_value ) ? $option_value : $option_label ) . "'" . ( ( in_array( $option_value, $value ) || in_array( $option_label, $value ) ) ? " selected='selected'" : '' ) . ">{$option_label}</option>";
	echo '</select>';
	echo '</p>';
}
function etheme_widget_select_single( $label, $id, $name, $value, $options, $blank_option, $class = '' ) {
	$class = ( ( $class ) ? $class : 'widefat;' );
	if ( $blank_option )
		$options = array_merge( array( '' ), $options );
	echo "\n\t\t\t<p>";
	etheme_widget_label( $label, $id );
	echo "<select id='{$id}' name='{$name}' class='{$class}'>";
	foreach ( $options as $option_value => $option_label ) {
		$option_value = (string) $option_value;
		$option_label = (string) $option_label;
		echo "<option value='" . ( ( $option_value ) ? $option_value : $option_label ) . "'" . ( ( $value == $option_value || $value == $option_label ) ? " selected='selected'" : '' ) . ">{$option_label}</option>";
	}
	echo '</select>';
	echo '</p>';
}

