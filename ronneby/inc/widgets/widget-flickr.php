<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
//FLICKR FEED
class crum_widget_flickr extends WP_Widget {
	/*function crum_widget_flickr() {
		// Widget settings.
		$widget_ops = array( 'classname' => 'instagram-widget', 'description' => __( 'Displays your Flickr feed', 'dfd') );
		// Widget control settings.
		$control_ops = array( 'id_base' => 'crum_widget_flickr' );
		// Create the widget.
		$this->WP_Widget( 'crum_widget_flickr', 'Widget: Flickr Feed', $widget_ops, $control_ops );
	}*/
	function __construct() {
		parent::__construct(
            'crum_widget_flickr', // Base ID
            'Widget: Flickr Feed', // Name
            array(
				'classname' => 'instagram-widget',
                'description' => __( 'Displays your Flickr feed', 'dfd')
            ) // Args
        );
	}
	
	function widget( $args, $instance ) {

		extract( $args );

		/* User-selected settings. */
		 $title = $instance['title'] ;
		 $id = $instance['id'];
		 $num = $instance['num'];


		 wp_register_script('flikr_feed', get_template_directory_uri() . '/assets/js/jflickrfeed.min.js', false, null, true);
		 wp_enqueue_script('flikr_feed');


	  /* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
        if ($title) {

            echo $before_title;
            echo $title;
            echo $after_title;

        }
		
		$unique_id = uniqid('flickr_');

		/* Display Latest Tweets */
		if ( $num ) { ?>
        <div id="<?php echo esc_attr($unique_id); ?>" class="flickr-widget"></div>
		
		<?php
		
		$column_class = '';
		if(function_exists('column_class_maker')) {
			$column_class .= column_class_maker($num);
		}
		
		
		?>

        <script type="text/javascript">
            <!--
            jQuery(document).ready(function() {
                jQuery('#<?php echo esc_js($unique_id); ?>').jflickrfeed({
                    limit: <?php echo esc_js($num); ?>,
                    qstrings: {
                        id: '<?php echo esc_js($id); ?>'
                    },
                    itemTemplate:
                            '<a class="zoom <?php echo $column_class; ?>" data-rel="prettyPhoto[flikr_gal]" href="{{image}}" title="{{title}}">' +
                                '<span class="overflow-box"><img src="{{image_q}}"  /></span>' +
                                '<span class="hover-box"></span></span>' +
                            '</a>'

                }, function(data) {
					var deeplinkVal = jQuery('body').hasClass('dfd-pp-deeplinks') ? true : false,
					url = window.location.href,
					directiry = jQuery('body').data('directory');
                    jQuery('#<?php echo esc_js($unique_id); ?> a').prettyPhoto({
						hook: 'data-rel',
						show_title: true,
						deeplinking:deeplinkVal,
						markup: '<div class="pp_pic_holder"> \
									<div class="ppt">&nbsp;</div> \
									<a class="pp_close" href="#">×</a> \
									<div class="pp_top"> \
										<div class="pp_left"></div> \
										<div class="pp_middle"></div> \
										<div class="pp_right"></div> \
									</div> \
									<div class="pp_content_container"> \
										<div class="pp_left"> \
										<div class="pp_right"> \
											<div class="pp_content"> \
												<div class="pp_loaderIcon"></div> \
												<div class="pp_fade"> \
													<a href="#" class="pp_expand" title="Expand the image">Expand</a> \
													<div class="pp_hoverContainer"> \
														<a class="pp_next" href="#"><span><span>next</span></span></a> \
														<a class="pp_previous" href="#"><span><span>prev</span></span></a> \
													</div> \
													<div id="pp_full_res"></div> \
													<div class="pp_details"> \
														<div class="pp_nav"> \
															<a href="#" class="pp_arrow_previous">Previous</a> \
															<p class="currentTextHolder">0/0</p> \
															<a href="#" class="pp_arrow_next">Next</a> \
														</div> \
														<div class="pp_social">{pp_social}</div> \
														<p class="pp_description"></p> \
													</div> \
												</div> \
											</div> \
										</div> \
										</div> \
									</div> \
									<div class="pp_bottom"> \
										<div class="pp_left"></div> \
										<div class="pp_middle"></div> \
										<div class="pp_right"></div> \
									</div> \
								</div> \
								<div class="pp_overlay"></div>',
						gallery_markup: '<div class="pp_gallery mobile-hide"> \
											<a href="#" class="pp_arrow_previous">Previous</a> \
											<div> \
												<ul> \
													{gallery} \
												</ul> \
											</div> \
											<a href="#" class="pp_arrow_next">Next</a> \
										</div>',
						changepicturecallback: function() {
							},
						social_tools: '' /* html or false to disable */
					});
                });
            });
            // -->
        </script>


		<?php }

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = $new_instance['title'];

		$instance['num'] = strip_tags( $new_instance['num'] );
		$instance['id'] = strip_tags( $new_instance['id'] );

		return $instance;
	}
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Flickr Photos',  'id'=>'31472375@N06', 'num' => '4' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'dfd'); ?></label>
        <input class="widefat"  type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
    </p>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('id')); ?>"><?php _e('ID:', 'dfd'); ?></label>
        <input class="widefat"  type="text" id="<?php echo esc_attr($this->get_field_id('id')); ?>" name="<?php echo esc_attr($this->get_field_name('id')); ?>" value="<?php echo esc_attr($instance['id']); ?>"/>
    </p>

    <p>
        <label for="<?php echo esc_attr($this->get_field_id('num')); ?>"><?php _e('Number of photos:', 'dfd'); ?></label>
        <input class="widefat"  type="text" id="<?php echo esc_attr($this->get_field_id('num')); ?>" name="<?php echo esc_attr($this->get_field_name('num')); ?>" value="<?php echo esc_attr($instance['num']); ?>"/>
    </p>

        <?php
	}
}
?>