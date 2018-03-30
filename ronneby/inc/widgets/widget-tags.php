<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
class crum_tags_widget extends WP_Widget {


    public function __construct() {
        parent::__construct(
            'crum_tags_widget', // Base ID
            'Widget: Tags block', // Name
            array( 'description' => __( 'Displays tags list', 'dfd' ), ) // Args
        );
    }

	function widget( $args, $instance ) {

		//get theme options

        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'Tags', 'dfd' );
        }

        if ( isset( $instance[ 'number' ] ) ) {
            $number = $instance[ 'number' ];
        }

        if ( isset( $instance[ 'read_all' ] ) ) {
            $read_all = $instance[ 'read_all' ];
        }

		extract( $args );

		/* show the widget content without any headers or wrappers */
		
		$unique_id = uniqid('tags-widget-');
		
		$all_tags = get_tags();
		
		$output = '';
		foreach($all_tags as $tag) {
			$output .= '<a href="'.get_tag_link($tag->term_id).'" title="'.esc_attr($tag->name).'">'.esc_html($tag->name).'</a>';
		}

        echo $before_widget;

        if ($title) {

            echo $before_title;
            echo $title;
            echo $after_title;

        } ?>
		<div class="tags-widget clearfix" id="<?php echo esc_attr($unique_id); ?>">
			<?php wp_tag_cloud('smallest=10&largest=20&number='.$number); ?>
		</div>

		<?php if(isset($read_all) && $read_all) : ?>
			<div class="read-more-section">
				<a href="#" class="subtitle"><?php _e('All tags','dfd'); ?></a>
			</div>
		<?php endif; ?>

		<script type="text/javascript">
			(function($) {
				"use strict";
				$(document).ready(function() {
					var tags_block = $('#<?php echo esc_js($unique_id); ?>');
					var new_content = '<?php echo $output ?>';
					tags_block.next('.read-more-section')
							.find('> a')
							.click(function(e) {
								e.preventDefault();
								tags_block.fadeOut('slow', function() {
									tags_block.html(new_content);
									tags_block.fadeIn('slow');
								});
								$(this).hide();
							});
				});
			})(jQuery);
		</script>

    <?php echo $after_widget;
    }

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['number'] = strip_tags( $new_instance['number'] );
		
        $instance['read_all'] = strip_tags( $new_instance['read_all'] );

		return $instance;

	}

	function form( $instance ) {

        $title = apply_filters( 'widget_title', (!empty($instance['title']))?$instance['title']:'' );

        $number = (!empty($instance['number']))?$instance['number']:'';
		/* Set up some default widget settings. */

		$instance = wp_parse_args( (array) $instance, array('title' => '', 'number' => 20) );
	?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'dfd'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e('Number of tags:', 'dfd'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e('All tags button:', 'dfd'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('read_all')); ?>" name="<?php echo esc_attr($this->get_field_name('read_all')); ?>" type="checkbox" value="true" <?php if(isset($instance['read_all']) && $instance['read_all']) echo 'checked="checked"'; ?> />
		</p>

    <?php

	}

}
