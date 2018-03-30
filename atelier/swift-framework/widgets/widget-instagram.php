<?php

    /*
    *
    *	Custom Instagram Widget
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    */

    class sf_instagram_widget extends WP_Widget {

        function __construct() {
            $widget_ops = array(
                'classname'   => 'instagram-widget',
                'description' => 'Show off your favorite Instagram photos'
            );
            parent::__construct( 'instagram-widget', 'Swift Framework Instagram Widget', $widget_ops );
        }

        function form( $instance ) {

            $instance   = wp_parse_args( (array) $instance, array(
                    'title'      => 'Instagram',
                    'number'     => 8,
                    'instagram_id' => '',
                    'instagram_token'  => ''
                ) );
            $title      = esc_attr( $instance['title'] );
            $instagram_id = $instance['instagram_id'];
            $instagram_token  = $instance['instagram_token'];
            $number     = absint( $instance['number'] );
            ?>
            <p>
            	<strong>NOTE: using this widget requires you to first set up authentication to your instagram account. This can be done by visiting <a href="<?php echo admin_url('admin.php?page=swift-framework-instagram'); ?>" target="_blank">this page</a>.</strong>
            </p>
            <p>
                <label
                    for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'swiftframework' ); ?>
                    :</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                       value="<?php echo $title; ?>"/>
            </p>
			
            <p>
                <label
                    for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of Photos', 'swiftframework' ); ?>
                    :</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>"
                       name="<?php echo $this->get_field_name( 'number' ); ?>" type="text"
                       value="<?php echo $number; ?>"/>
            </p>

        <?php
        }

        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;

            $instance['title']      = strip_tags( $new_instance['title'] );
            $instance['number']     = $new_instance['number'];

            return $instance;
        }

        function widget( $args, $instance ) {

            extract( $args );

            $title    	   		= apply_filters( 'widget_title', $instance['title'] );
            $instagram_token 	= get_option('sf_instagram_access_token');
            $instagram_id 		= get_option('sf_instagram_user_id');
            $instagram_client 	= '756db9880cc84c3dab85118df38f9b91';
            $count     	   		= $instance['number'];
            $widget_id 	   		= "sf-instagram-widget-" . rand();

            if ( $title ) {
                echo $before_title . $title . $after_title;
            }

            echo $before_widget;
            ?>

            <ul id="<?php echo $widget_id; ?>" class="instagram_images clearfix"></ul>

            <script type="text/javascript">
                jQuery( document ).ready(
                    function() {
                    	var instagrams = jQuery('#<?php echo $widget_id; ?>'),
                    		count = parseInt( <?php echo $count; ?>, 10 );
                    	
                    	jQuery.ajax({
                    		url: 'https://api.instagram.com/v1/users/<?php echo $instagram_id; ?>/media/recent?access_token=<?php echo $instagram_token; ?>', // specify the ID of the first found user
                    		dataType: 'jsonp',
                    		type: 'GET',
                    		data: {client_id: '<?php echo $instagram_client; ?>', count: count},
                    		success: function(data) {
                    			for (var i = 0; i < count; i++) {
	                				if (data.data[i]) {
	                					var caption = "";
	                					if (data.data[i].caption) {
	                						caption = data.data[i].caption.text;
	                					}
	                					instagrams.append("<li class='instagram-item' data-date='"+data.data[i].created_time+"'><figure class='animated-overlay'><a target='_blank' href='" + data.data[i].link +"'></a><div class='img-wrap'><img class='instagram-image' src='" + data.data[i].images.low_resolution.url +"' width='306px' height='306px' /></div><figcaption><div class='thumb-info'><i class='fa-instagram'></i></div></figcaption></figure></li>");  
	                				} 
	                			}
                    		},
                    		error: function(data2) {
                    			console.log(data2);
                    		}
                    	});
                    }
                );
            </script>
            <?php

            echo $after_widget;
        }

    }

    add_action( 'widgets_init', 'sf_load_instagram_widget' );

    function sf_load_instagram_widget() {
        register_widget( 'sf_instagram_widget' );
    }

?>