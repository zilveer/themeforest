<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(dirname(__FILE__).'/widget.php');

class dfd_recent_comments extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_recent_comments';
	protected $widget_name = 'Widget: Recent Comments';
	
	protected $options;
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
		$this->widget_params = array(
			'description' => __('Advanced recent comments widget.', 'dfd')
		);
		
		$this->options = array(
			array(
				'title', 'text', '', 
				'label' => __('Title', 'dfd'), 
				'input'=>'text', 
				'filters'=>'widget_title', 
				'on_update'=>'esc_attr',
			),
			array(
				'limit', 'int', 3, 
				'label' => __('Limit', 'dfd'), 
				'input'=>'select', 
				'values' => array('range', 'from'=>1, 'to'=>20),
			),
		);
		
		add_action( 'comment_post', array($this, 'flush_widget_cache') );
		add_action( 'edit_comment', array($this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array($this, 'flush_widget_cache') );
		
        parent::__construct();
    }

    function flush_widget_cache() {
	wp_cache_delete('dfd_widget_recent_comments', 'widget');
    }
    
    /**
     * Display widget
     */
    function widget( $args, $instance ) {
        extract( $args );
		$this->setInstances($instance, 'filter');
		
        $cache = wp_cache_get('dfd_widget_recent_comments', 'widget');

	if ( ! is_array( $cache ) )
		$cache = array();

	if ( ! isset( $args['widget_id'] ) )
		$args['widget_id'] = $this->id;

	if ( isset( $cache[ $args['widget_id'] ] ) ) {
		echo $cache[ $args['widget_id'] ];
		return;
	}

	$number = $this->getInstance('limit');
	
 	extract($args, EXTR_SKIP);

	$output = '';
	
	$output .= $before_widget;

	$title = $this->getInstance('title');
        if ( ! empty( $title ) ) {
            $output .= $before_title . $title . $after_title;
	}

        global $comments, $comment;
		
		$arg = array(
			'number' => $number,
			'status' => 'approve',
			'post_status' => 'publish'
		);

		$comments = get_comments( $arg );

        $output .= '<ul class="widget-recentcomments">';
	    
        if ( $comments ) {
		// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
	    $post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
	    _prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

	    foreach ( (array) $comments as $comment) {
			$comment_text = strlen(get_comment_text($comment->comment_ID)) < 100 ? get_comment_text($comment->comment_ID) : mb_substr(get_comment_text($comment->comment_ID), 0, 97) . '...';
		    $d = "F j, Y";
		    $output .=  '<li class="recentcomments">' . /* translators: comments widget: 1: comment author, 2: post link */ sprintf(_x('%1$s on %2$s', 'dfd'), '<p class="comment-text">'.$comment_text.'</p><p class="comment-text-meta"><span class="author">' . get_comment_author_link() . '</span>', '<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '" class="dfd-post-link" title=" " target="_blank">' . get_the_title($comment->comment_post_ID) . '</a></p>' . '<p class="entry-meta"><span class="comments-date">' . get_comment_date($d, $comment->comment_ID)) . '</span></p></li>';
	    }
        }
	    
	$output .= '</ul>';

        $output .= $after_widget;
	
	echo $output;
	$cache[$args['widget_id']] = $output;
	wp_cache_set('dfd_widget_recent_comments', $cache, 'widget');
    }
    
    function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['limit'] = absint( $new_instance['limit'] );
	$this->flush_widget_cache();

	$alloptions = wp_cache_get( 'alloptions', 'options' );
	if ( isset($alloptions['dfd_widget_recent_comments']) )
		delete_option('dfd_widget_recent_comments');

	return $instance;
    }

}
