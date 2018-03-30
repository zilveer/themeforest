<?php
/** Elderberry Widgets
  *
  * Add code for your widgets here
  *
  * @package Elderberry
  * @subpackage The Vacation Rental Admin
  *
  */


/** Contact Widget
  *
  * This widget enables the user to create a nice contact information
  * display containing links and vital info.
  *
  */
class eb_widget_contact extends WP_Widget {

	/** Contact Widget Constructor
	  *
	  * The widget is built using options defined in the
	  * defaults.php file. Take a look at defaults.php or
	  * defaults.sample.php in the samples directory for
	  * more information.
	  *
	  * @uses EB_Widget::get_widget_options()
	  * @uses EB_Widget::get_control_options()
	  *
	  */
	function eb_widget_contact() {
		global $eb_widgets, $framework;
		$widget_options = $eb_widgets->get_widget_options( 'contact' );
		$control_options = $eb_widgets->get_control_options( 'contact' );
		$this->WP_Widget( $eb_widgets->widgets['groups']['contact']['tabs']['main_settings']['id'], $eb_widgets->widgets['groups']['contact']['tabs']['main_settings']['name'], $widget_options, $control_options );
	}

	/** Contact Widget Frontend
	  *
	  * Using the data from the widget instance we build the frontend
	  * to show the required data. It is styled using CSS which should
	  * be defined by the theme
	  *
	  * @param array $args The sidebar arguments
	  * @param array $instance The instance data for the widget
	  *
	  * @return string $output The HTML code for the widget
	  *
	  */
	function widget( $args, $instance ) {

		$hasSocial = (
			( isset( $instance['rss'] )      AND !empty( $instance['rss'] ) )      OR
			( isset( $instance['twitter'] )  AND !empty( $instance['twitter'] ) )  OR
			( isset( $instance['flickr'] )   AND !empty( $instance['flickr'] ) )   OR
			( isset( $instance['facebook'] ) AND !empty( $instance['facebook'] ) ) OR
			( isset( $instance['linkedin'] ) AND !empty( $instance['linkedin'] ) )
		) ? true : false;

		$phone_icon = $instance['phone_icon'];
		if( !empty( $phone_icon ) ) {
			$phone_icon = ( is_numeric( $phone_icon ) ) ? wp_get_attachment_image_src( $phone_icon ) : array( $phone_icon );
		}

		$email_icon = $instance['email_icon'];
		if( !empty( $email_icon ) ) {
			$email_icon = ( is_numeric( $email_icon ) ) ? wp_get_attachment_image_src( $email_icon ) : array( $email_icon );
		}

		$location_icon = $instance['location_icon'];
		if( !empty( $location_icon ) ) {
			$location_icon = ( is_numeric( $location_icon ) ) ? wp_get_attachment_image_src( $location_icon ) : array( $location_icon );
		}


		ob_start();
		?>


			<?php echo $args['before_widget'] ?>
		<div class='widget-container eb_widget_contact' id='<?php echo $args['widget_id'] ?>'>
			<?php if( !empty( $instance['title'] ) ) : ?><?php echo $args['before_title'] . $instance['title'] .  $args['after_title'] ?><?php endif ?>
			<div class='widget-content'>
				<?php
				if(isset( $hasSocial ) AND $hasSocial === true ) {
					echo '<div class="social-buttons">';

						if( isset( $instance['rss'] ) AND $instance['rss'] != 'no' ) {
							echo '<a href="' . get_bloginfo( 'rss2_url' ).'" target="_blank" class="contact-icon social-icon icon-rss"></a>';
						}
						if( isset( $instance['twitter'] ) AND !empty( $instance['twitter'] ) ) {
							echo '<a href="http://www.twitter.com/' . $instance['twitter'] . '" target="_blank" class="contact-icon social-icon icon-twitter"></a>';
						}
						if( isset( $instance['facebook'] ) AND !empty( $instance['facebook'] ) ) {
							echo '<a href="' . $instance['facebook'] . '" target="_blank" class="contact-icon social-icon icon-facebook"></a>';
						}
						if( isset( $instance['flickr'] ) AND !empty( $instance['flickr'] ) ) {
							echo '<a href="' . $instance['flickr'] . '" target="_blank" class="contact-icon social-icon icon-flickr"></a>';
						}
						if( isset( $instance['linkedin'] ) AND !empty( $instance['linkedin'] ) ) {
							echo '<a href="' . $instance['linkedin'] . '" target="_blank" class="contact-icon social-icon icon-linkedin"></a>';
						}

						echo '</div>';
				}

				if ( isset( $instance['phone'] ) AND !empty( $instance['phone'] ) ) {
					echo '<p><span class="contact-icon icon-phone"><img src="' . $phone_icon[0] . '"></span>' . $instance['phone'] . '</p>';
				}
				if ( isset( $instance['email'] ) AND !empty( $instance['email'] ) ) {
					echo '<p><span class="contact-icon icon-email"><img src="' . $email_icon[0] . '"></span>' . $instance['email'] . '</p>';
				}
				if ( isset( $instance['location'] ) AND !empty( $instance['location'] ) ) {
					echo '<p><span class="contact-icon icon-location"><img src="' . $location_icon[0] . '"></span>' . $instance['location'] . '</p>';
				}


				?>
			</div>
		</div>
			<?php echo $args['after_widget'] ?>

		<?php
		$output = ob_get_clean();

		echo $output;

	}

	/** Contact Widget Update
	  *
	  * Using the data from the new and old instance we save
	  * the widget data, modifying it before it is saved if needed.
	  *
	  * @param array $new_instance The new instance data
	  * @param array $old_instance The old instance data
	  *
	  * @uses EB_Widgets::check_widget_data()
	  *
	  * @return array $new_instance The modified new instance to save
	  *
	  */
	function update( $new_instance, $old_instance ) {
		global $eb_widgets;
		$new_instance = $eb_widgets->check_widget_data( $new_instance, 'contact' );
		if( empty( $new_instance['rss'] ) OR $new_instance['rss'] != 'yes' ) {
			$new_instance['rss'] = 'no';
		}

		return $new_instance;
	}

	/** Contact Widget Backend
	  *
	  * Using the instance data we build the form for
	  * the widget.
	  *
	  * @param array $instance The instance data
	  *
	  * @uses get_field_name()
	  * @uses EB_Controls::show_controls()
	  *
	  * @return array $new_instance The modified new instance to save
	  *
	  */
	function form( $instance ) {
		global $eb_widgets;


		$eb_widgets->widgets['groups']['contact']['tabs']['main_settings']['instance'] = $instance;

		foreach ( $eb_widgets->widgets['groups']['contact']['tabs']['main_settings']['items'] as $key => $item ) {
			$eb_widgets->widgets['groups']['contact']['tabs']['main_settings']['items'][$key]['guid'] = $this->get_field_name( $key );
		}

		$eb_widgets->controls->show_controls( $eb_widgets->widgets, array( 'title' => 'Contact Options', 'group' => 'contact' ) );

	}
}

/** Twitter Widget
  *
  * This widget can show the twitter feed of a user
  *
  */
class eb_widget_twitter extends WP_Widget {

	/** Twitter Widget Constructor
	  *
	  * The widget is built using options defined in the
	  * defaults.php file. Take a look at defaults.php or
	  * defaults.sample.php in the samples directory for
	  * more information.
	  *
	  * @uses EB_Widget::get_widget_options()
	  * @uses EB_Widget::get_control_options()
	  *
	  */
	function eb_widget_twitter() {
		global $eb_widgets;
		$widget_options = $eb_widgets->get_widget_options( 'twitter' );
		$control_options = $eb_widgets->get_control_options( 'twitter' );
		$this->WP_Widget( $eb_widgets->widgets['groups']['twitter']['tabs']['main_settings']['id'], $eb_widgets->widgets['groups']['twitter']['tabs']['main_settings']['name'], $widget_options, $control_options );
	}

	/** Get Twitter Feed
	  *
	  * Gets a twitter feed using the Twitter timeline RSS
	  *
	  * @param string $username The username to get the feed for
	  * @param integer $count The number of tweets to get
	  *
	  * return object $feed A SimpleXML Object of the feed
	  *
	  */
	function get_twitter_feed( $username, $count ) {
		$feed = @simplexml_load_file( "http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=" . $username . "&count=" . $count );
		return $feed;
	}

	/** Get Tweets From Feed Object
	  *
	  * Parses the SimpleXML object returned after parsing
	  * the Twitter API RSS feed and returns and saves the
	  * relevant info
	  *
	  * @param string $username The username to get the feed for
	  * @param integer $count The number of tweets to get
	  * @param string $widget_id A unique ID for the widget
	  *
	  * @uses get_twitter_feed()
	  *
	  * return array $eb_widget_twitter An array of feed items
	  *
	  */
	function get_user_tweets( $username, $count, $widget_id ) {

		$eb_widget_twitter = get_option( 'eb_widget_twitter' );
		if( empty( $eb_widget_twitter ) OR empty( $eb_widget_twitter[$widget_id] ) OR empty( $eb_widget_twitter[$widget_id]['tweets'] ) OR $eb_widget_twitter[$widget_id]['time'] < time() ) {

			$twitter_data = $this->get_twitter_feed( $username, $count );
			$tweets = array();
			foreach( $twitter_data->channel->item as $tweet ) {
				$tweets[] = (array) $tweet;
			}

			$eb_widget_twitter[$widget_id] = array(
				'time' => time() + 3600,
				'tweets' => $tweets,
			);
			update_option( 'eb_widget_twitter', $eb_widget_twitter );
		}

		return $eb_widget_twitter[$widget_id]['tweets'];
	}

	/** Twitter Widget Frontend
	  *
	  * Using the data from the widget instance we build the frontend
	  * to show the required data. It is styled using CSS which should
	  * be defined by the theme
	  *
	  * @param array $args The sidebar arguments
	  * @param array $instance The instance data for the widget
	  *
	  * @return string $output The HTML code for the widget
	  *
	  */
	function widget( $args, $instance ) {

		$tweets = $this->get_user_tweets( $instance['username'], $instance['count'], $args['widget_id'] );


		ob_start();
		?>


			<?php echo $args['before_widget'] ?>
		<div class='widget-container eb_widget_twitter' id='<?php echo $args['widget_id'] ?>'>
			<?php if( !empty( $instance['title'] ) ) : ?><?php echo $args['before_title'] . $instance['title'] .  $args['after_title'] ?><?php endif ?>
			<div class='widget-content'>
				<ul>
				<?php
					foreach( $tweets as $tweet ) {
						$output = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $tweet['title'] );
						$output = str_replace( $instance['username'] . ':', '<span class="username">' . $instance['username'] . ':</span>', $output );

							echo '<li>' . $output . '</li>';
					}
				?>
				</ul>
				<?php if( !empty( $instance['followme'] ) ) : ?>
					<a class='follow primary' href='http://twitter.com/<?php echo $instance['username'] ?>'><span class='icon twitter-bird'></span> <?php echo $instance['followme'] ?> </a>
				<?php endif ?>
			</div>
		</div>
			<?php echo $args['after_widget'] ?>

		<?php
		$output = ob_get_clean();

		echo $output;

	}

	/** Twitter Widget Update
	  *
	  * Using the data from the new and old instance we save
	  * the widget data, modifying it before it is saved if needed.
	  *
	  * @param array $new_instance The new instance data
	  * @param array $old_instance The old instance data
	  *
	  * @uses EB_Widgets::check_widget_data()
	  *
	  * @return array $new_instance The modified new instance to save
	  *
	  */
	function update( $new_instance, $old_instance ) {
		global $eb_widgets;
		$new_instance = $eb_widgets->check_widget_data( $new_instance, 'twitter' );

		$twitter_data = $this->get_twitter_feed( $username, $count );
		$tweets = array();
		foreach( $twitter_data->channel->item as $tweet ) {
			$tweets[] = (array) $tweet;
		}

		$eb_widget_twitter[$widget_id] = array(
			'time' => time() + 1800,
			'tweets' => $tweets,
		);
		update_option( 'eb_widget_twitter', $eb_widget_twitter );


		return $new_instance;
	}

	/** Twitter Widget Backend
	  *
	  * Using the instance data we build the form for
	  * the widget.
	  *
	  * @param array $instance The instance data
	  *
	  * @uses get_field_name()
	  * @uses EB_Controls::show_controls()
	  *
	  * @return array $new_instance The modified new instance to save
	  *
	  */
	function form( $instance ) {
		global $eb_widgets;

		$eb_widgets->widgets['groups']['twitter']['tabs']['main_settings']['instance'] = $instance;

		foreach ( $eb_widgets->widgets['groups']['twitter']['tabs']['main_settings']['items'] as $key => $item ) {
			$eb_widgets->widgets['groups']['twitter']['tabs']['main_settings']['items'][$key]['guid'] = $this->get_field_name( $key );
		}

		$eb_widgets->controls->show_controls( $eb_widgets->widgets, array( 'title' => 'Twitter Options', 'group' => 'twitter' ) );

	}
}



/** Featured Widget
  *
  * This widget shows a featured item. A featured item
  * consists of an image, text and a link.
  *
  */
class eb_widget_featured extends WP_Widget {

	/** Featured Widget Constructor
	  *
	  * The widget is built using options defined in the
	  * defaults.php file. Take a look at defaults.php or
	  * defaults.sample.php in the samples directory for
	  * more information.
	  *
	  * @uses EB_Widget::get_widget_options()
	  * @uses EB_Widget::get_control_options()
	  *
	  */
	function eb_widget_featured() {
		global $eb_widgets;
		$widget_options = $eb_widgets->get_widget_options( 'featured' );
		$control_options = $eb_widgets->get_control_options( 'featured' );
		$this->WP_Widget( $eb_widgets->widgets['groups']['featured']['tabs']['main_settings']['id'], $eb_widgets->widgets['groups']['featured']['tabs']['main_settings']['name'], $widget_options, $control_options );
	}

	/** Featured Widget Frontend
	  *
	  * Using the data from the widget instance we build the frontend
	  * to show the required data. It is styled using CSS which should
	  * be defined by the theme
	  *
	  * @param array $args The sidebar arguments
	  * @param array $instance The instance data for the widget
	  *
	  * @return string $output The HTML code for the widget
	  *
	  */
	function widget( $args, $instance ) {
		$image = wp_get_attachment_image_src( $instance['image'], 'eb_col_3' );

		ob_start();
		?>


			<?php echo $args['before_widget'] ?>
		<div class='widget-container eb_widget_featured' id='<?php echo $args['widget_id'] ?>'>
			<?php if( !empty( $instance['title'] ) ) : ?><?php echo $args['before_title'] . $instance['title'] .  $args['after_title'] ?><?php endif ?>
			<div class='widget-content'>
				<div class='image'><img src='<?php echo $image[0] ?>'></div>
				<div class='content'><?php echo wpautop( $instance['text'] ) ?></div>
				<a class='link primary'  href='<?php echo $instance['link_url'] ?>'><?php echo $instance['link_text'] ?></a>
			</div>
		</div>
			<?php echo $args['after_widget'] ?>

		<?php
		$output = ob_get_clean();

		echo $output;

	}

	/** Featured Widget Update
	  *
	  * Using the data from the new and old instance we save
	  * the widget data, modifying it before it is saved if needed.
	  *
	  * @param array $new_instance The new instance data
	  * @param array $old_instance The old instance data
	  *
	  * @uses EB_Widgets::check_widget_data()
	  *
	  * @return array $new_instance The modified new instance to save
	  *
	  */
	function update( $new_instance, $old_instance ) {
		global $eb_widgets;
		$new_instance = $eb_widgets->check_widget_data( $new_instance, 'featured' );
		return $new_instance;
	}


	/** Featured Widget Backend
	  *
	  * Using the instance data we build the form for
	  * the widget.
	  *
	  * @param array $instance The instance data
	  *
	  * @uses get_field_name()
	  * @uses EB_Controls::show_controls()
	  *
	  * @return array $new_instance The modified new instance to save
	  *
	  */
	function form( $instance ) {
		global $eb_widgets;

		$eb_widgets->widgets['groups']['featured']['tabs']['main_settings']['instance'] = $instance;

		foreach ( $eb_widgets->widgets['groups']['featured']['tabs']['main_settings']['items'] as $key => $item ) {
			$eb_widgets->widgets['groups']['featured']['tabs']['main_settings']['items'][$key]['guid'] = $this->get_field_name( $key );
		}

		$eb_widgets->controls->show_controls( $eb_widgets->widgets, array( 'title' => 'Featured Options', 'group' => 'featured' ) );

	}
}


/** Map Widget
  *
  * Shows a customizable map widget
  *
  */
class eb_widget_map extends WP_Widget {

	/** Map Widget Constructor
	  *
	  * The widget is built using options defined in the
	  * defaults.php file. Take a look at defaults.php or
	  * defaults.sample.php in the samples directory for
	  * more information.
	  *
	  * @uses EB_Widget::get_widget_options()
	  * @uses EB_Widget::get_control_options()
	  *
	  */
	function eb_widget_map() {
		global $eb_widgets;
		$widget_options = $eb_widgets->get_widget_options( 'map' );
		$control_options = $eb_widgets->get_control_options( 'map' );
		$this->WP_Widget( $eb_widgets->widgets['groups']['map']['tabs']['main_settings']['id'], $eb_widgets->widgets['groups']['map']['tabs']['main_settings']['name'], $widget_options, $control_options );
	}

	/** Map Widget Frontend
	  *
	  * Using the data from the widget instance we build the frontend
	  * to show the required data. It is styled using CSS which should
	  * be defined by the theme
	  *
	  * @param array $args The sidebar arguments
	  * @param array $instance The instance data for the widget
	  *
	  * @return string $output The HTML code for the widget
	  *
	  */
	function widget( $args, $instance ) {
		ob_start();
		$geocode = explode( ',', $instance['geocode'] );
		?>


			<?php echo $args['before_widget'] ?>
		<div class='widget-container eb_widget_map' id='<?php echo $args['widget_id'] ?>'>
			<?php if( !empty( $instance['title'] ) ) : ?><?php echo $args['before_title'] . $instance['title'] .  $args['after_title'] ?><?php endif ?>
			<div class='widget-content'>

			<?php if( !empty( $instance['text_above'] ) ) : ?>
				<div class='content above'>
					<?php echo wpautop( $instance['text_above'] ) ?>
				</div>
			<?php endif ?>

			<?php
				$id = rand(12345,99999);
				$instance['marker_text'] = ( empty( $instance['marker_text'] ) ) ? 'My Location' : $instance['marker_text'];
				echo '

			    <script>
				    	var coordinates_' . $id . ' = new google.maps.LatLng(' . $geocode[0] . ', ' . $geocode[1] . ');

				    	var mapOptions_' . $id . ' = {
				    		scrollwheel: false,
				        	zoom: ' . $instance['zoom'] . ',
				        	center: coordinates_' . $id . ',
				        	mapTypeId: google.maps.MapTypeId.' . strtoupper( $instance['maptype'] ) . '
				    	}
				';
				if( $instance['marker'] == "yes" ) {
					echo '
						var marker_' . $id . ' = new google.maps.Marker({
							position: coordinates_' . $id . ',
							title:"' . $instance['marker_text'] . '"
						});
					';
				}


				echo '

				    	jQuery(window).load( function() {
				    		map_' . $id . ' = new google.maps.Map(document.getElementById("map-'.$id.'"), mapOptions_' . $id . ')
				    		if( typeof marker_' . $id . ' != "undefined" && marker_' . $id . ' != "" ) {
				    			marker_' . $id . '.setMap(map_' . $id . ');
				    		}

				    	})

				';

				echo '</script>';

				echo '<div class="map" style="">';

				echo '<div class="map_canvas" style="height:' . $instance['height'] . 'px" id="map-'.$id.'"></div>';

				echo '</div>';

				?>

				<?php if( !empty( $instance['text_below'] ) ) : ?>
					<div class='content below'>
						<?php echo wpautop( $instance['text_below'] ) ?>
					</div>
				<?php endif ?>

			</div>
		</div>
			<?php echo $args['after_widget'] ?>

		<?php
		$output = ob_get_clean();

		echo $output;

	}

	/** Map Widget Update
	  *
	  * Using the data from the new and old instance we save
	  * the widget data, modifying it before it is saved if needed.
	  *
	  * @param array $new_instance The new instance data
	  * @param array $old_instance The old instance data
	  *
	  * @uses EB_Widgets::check_widget_data()
	  *
	  * @return array $new_instance The modified new instance to save
	  *
	  */
	function update( $new_instance, $old_instance ) {
		global $eb_widgets;
		if( empty( $new_instance['marker'] ) ) {
			$new_instance['marker'] = 'no';
		}
		$new_instance = $eb_widgets->check_widget_data( $new_instance, 'map' );

		$location = urlencode( $new_instance['location'] );
		$geocode = simplexml_load_file('http://maps.google.com/maps/api/geocode/xml?address=' . $location . '&sensor=false');
		$lat = floatval($geocode->result->geometry->location->lat);
		$lng = floatval($geocode->result->geometry->location->lng);

		if ($lat AND $lng) {
			$data['geocode'] = $lat . ',' . $lng;
		} else {
			$data['geocode'] = 'Location was NOT found! Remember: Google limits the search for geocodes, so you could try again in a couple of minutes.';
		}

		$new_instance['geocode'] = $data['geocode'];

		return $new_instance;
	}


	/** Map Widget Backend
	  *
	  * Using the instance data we build the form for
	  * the widget.
	  *
	  * @param array $instance The instance data
	  *
	  * @uses get_field_name()
	  * @uses EB_Controls::show_controls()
	  *
	  * @return array $new_instance The modified new instance to save
	  *
	  */
	function form( $instance ) {
		global $eb_widgets;

		$eb_widgets->widgets['groups']['map']['tabs']['main_settings']['instance'] = $instance;

		foreach ( $eb_widgets->widgets['groups']['map']['tabs']['main_settings']['items'] as $key => $item ) {
			$eb_widgets->widgets['groups']['map']['tabs']['main_settings']['items'][$key]['guid'] = $this->get_field_name( $key );
		}

		$eb_widgets->controls->show_controls( $eb_widgets->widgets, array( 'title' => 'Map Options', 'group' => 'map' ) );

	}
}


/** Search Widget
  *
  * Modifies the default search widget so we can
  * add a number of options to it.
  *
  */
class eb_widget_search extends WP_Widget {

	/** Search Widget Constructor
	  *
	  * The widget is built using options defined in the
	  * defaults.php file. Take a look at defaults.php or
	  * defaults.sample.php in the samples directory for
	  * more information.
	  *
	  * @uses EB_Widget::get_widget_options()
	  * @uses EB_Widget::get_control_options()
	  *
	  */
	function eb_widget_search() {
		global $eb_widgets;
		$widget_options = $eb_widgets->get_widget_options( 'search' );
		$control_options = $eb_widgets->get_control_options( 'search' );
		$this->WP_Widget( $eb_widgets->widgets['groups']['search']['tabs']['main_settings']['id'], $eb_widgets->widgets['groups']['search']['tabs']['main_settings']['name'], $widget_options, $control_options );
	}

	/** Search Widget Frontend
	  *
	  * Using the data from the widget instance we build the frontend
	  * to show the required data. It is styled using CSS which should
	  * be defined by the theme
	  *
	  * @param array $args The sidebar arguments
	  * @param array $instance The instance data for the widget
	  *
	  * @return string $output The HTML code for the widget
	  *
	  */
	function widget( $args, $instance ) {
		ob_start();
		if (isset($instance['background_color'])) $style['background_color'] = 'background-color: ' . $instance['background_color'];
		if (isset($instance['border_color'])) $style['border_color'] = 'border-color: ' . $instance['border_color'];
		$style = implode( ';', $style );

		if (isset($instance['icon'])) $icon = $instance['icon'];
		if( !empty( $icon ) ) {
			$icon = ( is_numeric( $icon ) ) ? wp_get_attachment_image_src( $icon ) : array( $icon );
		}


		?>

		<?php echo $args['before_widget'] ?>
		<div class='widget-container eb_widget_search' id='<?php echo $args['widget_id'] ?>'>
			<?php if( !empty( $instance['title'] ) ) : ?><?php echo $args['before_title'] . $instance['title'] .  $args['after_title'] ?><?php endif ?>
			<div class='widget-content'>
				<form style='<?php echo $style ?>' method="get" action="<?php echo home_url() ?>" _lpchecked="1">
					<div style='background: url(<?php echo $icon[0] ?>) no-repeat right center'>
					<input placeholder='<?php if (isset($instance['placeholder'])) echo $instance['placeholder'] ?>' type="text" name="s">
					<input type="submit" class="submit" value="Search">
					</div>
				</form>
			</div>
		</div>
			<?php echo $args['after_widget'] ?>

		<?php
		$output = ob_get_clean();

		echo $output;

	}

	/** Search Widget Update
	  *
	  * Using the data from the new and old instance we save
	  * the widget data, modifying it before it is saved if needed.
	  *
	  * @param array $new_instance The new instance data
	  * @param array $old_instance The old instance data
	  *
	  * @uses EB_Widgets::check_widget_data()
	  *
	  * @return array $new_instance The modified new instance to save
	  *
	  */
	function update( $new_instance, $old_instance ) {
		global $eb_widgets;
		$new_instance = $eb_widgets->check_widget_data( $new_instance, 'search' );
		return $new_instance;
	}


	/** Search Widget Backend
	  *
	  * Using the instance data we build the form for
	  * the widget.
	  *
	  * @param array $instance The instance data
	  *
	  * @uses get_field_name()
	  * @uses EB_Controls::show_controls()
	  *
	  * @return array $new_instance The modified new instance to save
	  *
	  */
	function form( $instance ) {
		global $eb_widgets;

		$eb_widgets->widgets['groups']['search']['tabs']['main_settings']['instance'] = $instance;

		foreach ( $eb_widgets->widgets['groups']['search']['tabs']['main_settings']['items'] as $key => $item ) {
			$eb_widgets->widgets['groups']['search']['tabs']['main_settings']['items'][$key]['guid'] = $this->get_field_name( $key );
		}

		$eb_widgets->controls->show_controls( $eb_widgets->widgets, array( 'title' => 'Search Options', 'group' => 'search' ) );

	}
}



?>