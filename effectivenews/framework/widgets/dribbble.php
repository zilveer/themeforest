<?php 

add_action('widgets_init','mom_dribbble');

function mom_dribbble() {
	register_widget('mom_dribbble');
	
	}

class mom_dribbble extends WP_Widget {
	function mom_dribbble() {
			
		$widget_ops = array('classname' => 'mom-dribbble','description' => __('Widget display Dribbble feed','framework'));
		parent::__construct('mom-dribbble-feed',__('Effective - Dribbble','framework'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
$title = apply_filters('widget_title', $instance['title'] );
	$dribbbleID = $instance['dribbbleID'];
	$count = $instance['count'];
	$box = $instance['box'];
	$rndn = rand(1,100);

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
	wp_enqueue_script('prettyPhoto');
?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$.jribbble.getShotsByPlayerId('<?php echo $dribbbleID; ?>', function (playerShots) {
    var html = [];
       $.each(playerShots.shots, function (i, shot) {
		var shot_link = shot.url;
		var rndn = '<?php echo $rndn; ?>';
		<?php if($box == 'on') { ?>
		shot_link = shot.image_url;
		<?php } ?>
        html.push('<div class="dribbble-widget-item">');
        html.push('<a rel="prettyphoto[dri-'+rndn+']" target="_blank" href="' + shot_link + '">');
        html.push('<img src="' + shot.image_teaser_url + '" ');
        html.push('alt="' + shot.title + '"></a></div>');
    });

    $('#dri-w-<?php echo $rndn; ?>').html(html.join(''));
	<?php if($box == 'on') { ?>
	$(".dribbble-widget-item a").prettyPhoto({animation_speed:'fast',slideshow:10000, deeplinking: false});
	<?php } ?>

}, {page: 1, per_page: <?php echo $count; ?>});
		});
	</script>
	<div class="dribbble-widget-wrap clearfix" id="dri-w-<?php echo $rndn; ?>"></div>

<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['dribbbleID'] = strip_tags( $new_instance['dribbbleID'] );
		$instance['count'] = $new_instance['count'];
		$instance['box'] = $new_instance['box'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Dribbble','framework'), 
		'dribbbleID' => 'Glennz',
		'count' => '9',
		'box' => 'on',
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'dribbbleID' ); ?>"><?php _e('Dribbble username or ID:', 'framework') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'dribbbleID' ); ?>" name="<?php echo $this->get_field_name( 'dribbbleID' ); ?>" value="<?php echo $instance['dribbbleID']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of Photos:', 'framework') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" />
	</p>
	
	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['box'], 'on' ); ?> id="<?php echo $this->get_field_id( 'box' ); ?>" name="<?php echo $this->get_field_name( 'box' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'box' ); ?>"><?php _e('Open in light box', 'framework'); ?></label>
	</p>
	
        
   <?php 
}
	} //end class