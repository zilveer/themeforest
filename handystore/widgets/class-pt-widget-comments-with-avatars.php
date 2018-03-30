<?php /* Handy Recent Comments With Avatars */

if ( ! defined( 'ABSPATH' ) ) exit;

function pt_recent_comments() {
    register_widget("PT_WP_Widget_Recent_Comments");
}
add_action("widgets_init", "pt_recent_comments");

class PT_WP_Widget_Recent_Comments extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_pt_recent_comments',
			'description' => __( 'Your site&#8217;s most recent comments with user avatars.', 'plumtree' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'pt-recent-comments', __( 'PT Recent Comments', 'plumtree' ), $widget_ops );
		$this->alt_option_name = 'widget_pt_recent_comments';

		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action( 'wp_head', array( $this, 'recent_comments_style' ) );
		}
	}


	public function recent_comments_style() {
		/**
		 * Filter the Recent Comments default widget styles.
		 *
		 * @since 3.1.0
		 *
		 * @param bool   $active  Whether the widget is active. Default true.
		 * @param string $id_base The widget ID.
		 */
		if ( ! current_theme_supports( 'widgets' ) // Temp hack #14876
			|| ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
		<?php
	}

    function widget( $args, $instance ) {
        global $comments, $comment;

        $cache = wp_cache_get('widget_pt_recent_comments', 'widget');

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
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Comments', 'plumtree' ) : $instance['title'], $instance, $this->id_base );

        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
             $number = 5;

        $comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'type' => 'comment' ) ) );
        $output .= $before_widget;
        if ( $title )
            $output .= $before_title . $title . $after_title;

        $output .= '<ul id="recentcomments">';
        if ( $comments ) {

            // Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
            $post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
            _prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

            foreach ( (array) $comments as $comment) {
              $title = $comment->post_title;
                $output .=  '<li class="recentcomments"><div class="thumb-wrapper">'. get_avatar($comment->comment_author_email, 80). '</div>';
                $output .=  '<div class="meta-wrapper">'.__('by ', 'plumtree') . '<strong>' . get_comment_author_link( $comment->comment_ID ) . '</strong><br/>'.__(' in ', 'plumtree').'<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . esc_attr($title) . '</a></div>';
                $output .=  '<div class="content-wrapper">'. trim(mb_substr(strip_tags($comment->comment_content), 0, 45)) . ' &hellip;</div>';
            }
         }
        $output .= '</ul>';
        $output .= $after_widget;

        echo $output;
        $cache[$args['widget_id']] = $output;
        wp_cache_set('widget_pt_recent_comments', $cache, 'widget');
    }

    public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = absint( $new_instance['number'] );
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Comments widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'plumtree' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of comments to show:', 'plumtree' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}

}
