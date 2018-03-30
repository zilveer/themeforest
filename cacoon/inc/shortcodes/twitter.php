<?php

function met_su_TWITTER_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_twitter'] = array(
		'name' => __( 'Twitter', 'su' ),
		'type' => 'single',
		'group' => 'met',
		'note' => 'Go "Appearance -> Twitter" to set api keys.',
		'atts' => array(
			'title' => array(
				'default' => 'LATEST TWEETS',
				'name' => __( 'Widget Title', 'su' ),
			),
			'username' => array(
				'default' => 'envato',
				'name' => __( 'Twitter Username', 'su' ),
			),
			'get_item_limit' => array(
				'type' => 'slider',
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 10,
				'name' => __( 'Item Fetch Limit', 'su' ),
			),
			'show_item_limit' => array(
				'type' => 'slider',
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 3,
				'name' => __( 'Item Show Limit', 'su' ),
			),
			'auto_play' => array(
				'type' => 'bool',
				'default' => 'yes',
				'name' => __( 'Auto Play', 'su' ),
			),
			'duration' => array(
				'type' => 'slider',
				'min' => 100,
				'max' => 10000,
				'step' => 10,
				'default' => 2000,
				'name' => __( 'Auto Play (Duration)', 'su' ),
			),
			'pauseduration' => array(
				'type' => 'slider',
				'min' => 100,
				'max' => 10000,
				'step' => 10,
				'default' => 0,
				'name' => __( 'Auto Play (Pause Duration)', 'su' ),
			),
			'circular' => array(
				'type' => 'bool',
				'default' => 'yes',
				'name' => __( 'Circular', 'su' ),
			),
			'infinite' => array(
				'type' => 'bool',
				'default' => 'yes',
				'name' => __( 'Infinite', 'su' ),
			),
		),
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_twitter_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_TWITTER_shortcode_data' );


function met_su_twitter_shortcode( $atts, $content = null ) {
	extract($atts);

	wp_enqueue_script('metcreative-caroufredsel');
	wp_enqueue_style('metcreative-caroufredsel');

	$widgetID = uniqid('met_twitter_ticker_');

	$widget_twitter_user_name = $username;

	///////////////////////////////////////

	$bool_search = array('yes','no');
	$bool_replace = array('true','false');

	$auto_play 		= str_replace($bool_search,$bool_replace,$auto_play);
	$circular 		= str_replace($bool_search,$bool_replace,$circular);
	$infinite 		= str_replace($bool_search,$bool_replace,$infinite);

	$output = '
	<div class="row-fluid">
		<div class="span12">
			<div class="met_twitter_widget met_color2 met_bgcolor clearfix">
				<h2 class="met_title_stack">'.$title.'</h2>

				<div id="'.$widgetID.'" class="met_twitter_wrapper">';

					$widget_tweets = mc_get_tweets($widget_twitter_user_name, $get_item_limit);

					if( $widget_tweets ){
						foreach( $widget_tweets as $widget_tweet ){
							$output .= '
								<div class="met_twitter_item clearfix">
									<i class="icon-twitter"></i>
									<p>'.$widget_tweet.'</p>
								</div>';
						}
					}

				$output .= '
				</div>

			</div>
		</div>
	</div><!-- Twitter Ticker Ends -->
	<script>
		jQuery(document).ready(function(){
			jQuery("#'.$widgetID.'").carouFredSel({
				responsive: true,
				circular: '.$circular.',
				infinite: '.$infinite.',
				auto: {
					play : '.$auto_play.',
					pauseDuration: '.$pauseduration.',
					duration: '.$duration.'
				},
				scroll: {
					duration: 400,
					wipe: true,
					pauseOnHover: true
				},
				items: {
					visible: {
						min: '.$show_item_limit.',
						max: '.$show_item_limit.'
						},
					height: \'auto\'
				},
				direction: \'up\',
				onCreate: function(){
					jQuery(window).trigger(\'resize\');
				}
			});
		})
	</script>
	';

	return $output;
}