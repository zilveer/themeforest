<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Tweet Box
 Description: Twitter feed with the ability to carousel
 Class: ZnTweetBox
 Category: content
 Level: 3
 Keywords: twitter, feed
*/

class ZnTweetBox extends ZnElements
{
	public static function getName(){
		return __( "Tweet Box", 'zn_framework' );
	}

	function scripts() {

		if(wp_script_is('caroufredsel', 'registered')) {
			wp_enqueue_script( 'caroufredsel' );
		}
		else {
			wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
		}

	}

	// Loads the required JS
	function js() {
		return array ( 'twitter_script' => Zn_Twitter_Helper::get_twitter_script());
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$uid = $this->data['uid'];
		$css = '';

		// Text Styles
		$text_styles = '';
		$tweet_typo = $this->opt('tweet_typo');
		if( is_array($tweet_typo) && !empty($tweet_typo) ){
			foreach ($tweet_typo as $key => $value) {
				if($value != '') {
					if( $key == 'font-family' ){
						$text_styles .= $key .':'. zn_convert_font($value).';';
					} else {
						$text_styles .= $key .':'. $value.';';
					}
				}
			}
			if(!empty($text_styles)){
				$css .= '.'.$uid.', .'.$uid.' a{'.$text_styles.'}';
			}
		}
		// Override Styles for Username and Date
		$ovrd_styles = '';
		$ovrd_typo = $this->opt('dateuser_typo');
		if( is_array($ovrd_typo) && !empty($ovrd_typo) ){
			foreach ($ovrd_typo as $key => $value) {
				if($value != '') {
					if( $key == 'font-family' ){
						$ovrd_styles .= $key .':'. zn_convert_font($value).';';
					} else {
						$ovrd_styles .= $key .':'. $value.';';
					}
				}
			}
			if(!empty($ovrd_styles)){
				$css .= '.'.$uid.' .znTweetBoxItems-itemDate, .'.$uid.' .znTweetBoxItems-username a{'.$ovrd_styles.'}';
			}
		}

		// Margin
		if( $this->opt('cc_margin_lg', '' ) || $this->opt('cc_margin_md', '' ) || $this->opt('cc_margin_sm', '' ) || $this->opt('cc_margin_xs', '' ) ){
			$css .= zn_push_boxmodel_styles(array(
					'selector' => '.'.$uid,
					'type' => 'margin',
					'lg' =>  $this->opt('cc_margin_lg', '' ),
					'md' =>  $this->opt('cc_margin_md', '' ),
					'sm' =>  $this->opt('cc_margin_sm', '' ),
					'xs' =>  $this->opt('cc_margin_xs', '' ),
				)
			);
		}
		// Padding
		if( $this->opt('cc_padding_lg', '' ) || $this->opt('cc_padding_md', '' ) || $this->opt('cc_padding_sm', '' ) || $this->opt('cc_padding_xs', '' ) ){
			$css .= zn_push_boxmodel_styles(array(
					'selector' => '.'.$uid,
					'type' => 'padding',
					'lg' =>  $this->opt('cc_padding_lg', '' ),
					'md' =>  $this->opt('cc_padding_md', '' ),
					'sm' =>  $this->opt('cc_padding_sm', '' ),
					'xs' =>  $this->opt('cc_padding_xs', '' ),
				)
			);
		}

		$css .= $this->opt('background_color','') ? '.'.$uid.'{background-color:'.$this->opt('background_color','').'}' : '';

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{

		// Check if Curl is installed on the server and show an error message if it is not
		if( ! function_exists('curl_init') ){
			echo __('It seems that the curl is not activated on your hosting. This widget requires this function in order to work. Please contact your server administrator and ask them to enable curl for your account.', 'zn_framework');
			return;
		}


		$options = $this->data['options'];

		if( empty( $options ) ){
			return;
		}

		$classes = array();
		$classes[] = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);
		$classes[] = 'znTweetBox-alg--'.$this->opt('el_alignment','left');

		$attributes = zn_get_element_attributes($options);

		echo '<div class="znTweetBox '.implode(' ', $classes).'" '.$attributes.'>';
			$username = $this->opt('tb_username');
			// GET THE TWEETS
			// Use twitter helper class to get tweets
			$tweet_config = array(
				'cachetime' => $this->opt( '' ),
				'consumerkey' => $this->opt('tb_consumerkey'),
				'consumersecret' => $this->opt('tb_consumersecret'),
				'accesstoken' => $this->opt('tb_accesstoken'),
				'accesstokensecret' => $this->opt('tb_accesstokensecret'),
				'username' => $username,
			);
			$tweet_items = Zn_Twitter_Helper::get_tweets( $tweet_config );

			if( is_wp_error( $tweet_items ) ){
				echo $tweet_items->get_error_message();
				return;
			}

			if($this->opt('tb_showuser', 1) == 1){
				echo '<div class="znTweetBoxItems-username"><a href="//twitter.com/' . $username . '">@'.$username.'</a></div>';
			}

			$numTweets = $this->opt('tb_tweetstoshow',1);
			$tweetbox_class = $numTweets > 1 ? "zn_general_carousel" : "";

			if( is_array($tweet_items) && !empty( $tweet_items ) ){
				$fctr = '1';
				echo '<ul class="znTweetBoxItems '.$tweetbox_class.'">';
					foreach ( $tweet_items as $k => $tweet ) {
						echo '<li class="znTweetBoxItems-item">';

							echo '<div class="znTweetBoxItems-itemTweet">'.Zn_Twitter_Helper::convert_links( $tweet['text'] ).'</div>';
							if($this->opt('tb_showdate', 1) == 1){
								echo '<a class="znTweetBoxItems-itemDate" target="_blank" href="//twitter.com/' . $username . '/statuses/' . $tweet['status_id'] . '"><span>' . Zn_Twitter_Helper::relative_time($tweet['created_at'] ) . '</span></a>';
							}

						echo '</li>';
						if ( $fctr == $numTweets ) {
							break;
						}
						$fctr ++;
					}
				echo '</ul>';
			}
		echo '</div>';

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$doc_url = ' <a href="http://support.hogash.com/documentation/twitter-widget/" target="_blank">See here how to get one</a>';

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'Setup Options',
				'options' => array(

					array (
						"name"        => __( "Twitter Username", 'zn_framework' ),
						"description" => __( "Add your Twitter Username.", 'zn_framework' ),
						"id"          => "tb_username",
						"std"         => "",
						"type"        => "text",
						"class"       => "zn_input_md",
					),

					array (
						"name"        => __( "Consumer Key", 'zn_framework' ),
						"description" => __( "Add the Consumer Key.".$doc_url, 'zn_framework' ),
						"id"          => "tb_consumerkey",
						"std"         => "",
						"type"        => "text",
						"class"       => "zn_input_xl",
					),

					array (
						"name"        => __( "Consumer Secret", 'zn_framework' ),
						"description" => __( "Add the Consumer Secret.".$doc_url, 'zn_framework' ),
						"id"          => "tb_consumersecret",
						"std"         => "",
						"type"        => "text",
						"class"       => "zn_input_xl",
					),

					array (
						"name"        => __( "Access Token", 'zn_framework' ),
						"description" => __( "Add the Access Token.".$doc_url, 'zn_framework' ),
						"id"          => "tb_accesstoken",
						"std"         => "",
						"type"        => "text",
						"class"       => "zn_input_xl",
					),

					array (
						"name"        => __( "Access Token Secret", 'zn_framework' ),
						"description" => __( "Add the Access Token Secret.".$doc_url, 'zn_framework' ),
						"id"          => "tb_accesstokensecret",
						"std"         => "",
						"type"        => "text",
						"class"       => "zn_input_xl",
					),

					array (
						"name"        => __( "Hours to cache", 'zn_framework' ),
						"description" => __( "For how many hours the feed should be cached. ", 'zn_framework' ),
						"id"          => "tb_cachetime",
						"std"         => "24",
						"type"        => "text",
						"class"       => "zn_input_xs",
						"numeric"     => true,
						'helpers'     => array(
							'min' => '1',
							'step' => '1'
						),
					),
				),
			),

			'styles' => array(
				'title' => 'Style Options',
				'options' => array(
					array (
						"name"        => __( "Alignment", 'zn_framework' ),
						"description" => __( "Select the alignment", 'zn_framework' ),
						"id"          => "el_alignment",
						"std"         => "left",
						"type"        => "select",
						"options"     => array(
							"left" => "Left",
							"center" => "Center",
							"right" => "Right"
						),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'znTweetBox-alg--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'text-',
								),
							)
						)
					),

					array (
						"name"        => __( "Typography settings", 'zn_framework' ),
						"description" => __( "Specify the typography properties for the tweets.", 'zn_framework' ),
						"id"          => "tweet_typo",
						"std"         => '',
						'supports'   => array( 'size', 'font', 'style', 'line', 'color', 'weight', 'case' ),
						"type"        => "font",
						'live' => array(
							'multiple' => array(
								array(
									'type'      => 'font',
									'css_class' => '.'.$uid,
								),
								array(
									'type'      => 'font',
									'css_class' => '.'.$uid. ' a ',
								)
							)
						),
					),


					array(
						'id'          => 'background_color',
						'name'        => 'Background color',
						'description' => 'Here you can override the background color for this element.',
						'type'        => 'colorpicker',
						'std'         => '',
						'live'        => array(
							'type'		=> 'css',
							'css_class' => '.'.$uid,
							'css_rule'	=> 'background-color',
							'unit'		=> ''
						)
					),


					array (
						"name"        => __( "Date & Username - Override Typography", 'zn_framework' ),
						"description" => __( "Specify the typography properties for the date and username (it'll override the default ones).", 'zn_framework' ),
						"id"          => "dateuser_typo",
						"std"         => '',
						'supports'   => array( 'size', 'font', 'style', 'line', 'color', 'weight', 'case' ),
						"type"        => "font",
						// 'live' => array(
						// 	'multiple' => array(
						// 		array(
						// 			'type'      => 'font',
						// 			'css_class' => '.'.$uid. ' .znTweetBoxItems-itemDate ',
						// 		),
						// 		array(
						// 			'type'      => 'font',
						// 			'css_class' => '.'.$uid. ' .znTweetBoxItems-username a ',
						// 		)
						// 	)
						// ),
					),

					/**
					 * Margins and padding
					 */
					array (
						"name"        => __( "Edit element padding & margins for each device breakpoint. ", 'zn_framework' ),
						"description" => __( "This will enable you to have more control over the padding of the container on each device. Click to see <a href='http://hogash.d.pr/1f0nW' target='_blank'>how box-model works</a>.", 'zn_framework' ),
						"id"          => "cc_spacing_breakpoints",
						"std"         => "lg",
						"tabs"        => true,
						"type"        => "zn_radio",
						"options"     => array (
							"lg"        => __( "LARGE", 'zn_framework' ),
							"md"        => __( "MEDIUM", 'zn_framework' ),
							"sm"        => __( "SMALL", 'zn_framework' ),
							"xs"        => __( "EXTRA SMALL", 'zn_framework' ),
						),
						"class"       => "zn_full zn_breakpoints"
					),
					// MARGINS
					array(
						'id'          => 'cc_margin_lg',
						'name'        => 'Margin (Large Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container. Accepts negative margin.',
						'type'        => 'boxmodel',
						'std'	  => '',
						'placeholder' => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('lg') ),
						'live' => array(
							'type'		=> 'boxmodel',
							'css_class' => '.'.$uid,
							'css_rule'	=> 'margin',
						),
					),
					array(
						'id'          => 'cc_margin_md',
						'name'        => 'Margin (Medium Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('md') ),
					),
					array(
						'id'          => 'cc_margin_sm',
						'name'        => 'Margin (Small Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('sm') ),
					),
					array(
						'id'          => 'cc_margin_xs',
						'name'        => 'Margin (Extra Small Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('xs') ),
					),
					// PADDINGS
					array(
						'id'          => 'cc_padding_lg',
						'name'        => 'Padding (Large Breakpoints)',
						'description' => 'Select the padding (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						"allow-negative" => false,
						'std'	  => '',
						'placeholder' => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('lg') ),
						'live' => array(
							'type'		=> 'boxmodel',
							'css_class' => '.'.$uid,
							'css_rule'	=> 'padding',
						),
					),
					array(
						'id'          => 'cc_padding_md',
						'name'        => 'Padding (Medium Breakpoints)',
						'description' => 'Select the padding (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						"allow-negative" => false,
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('md') ),
					),
					array(
						'id'          => 'cc_padding_sm',
						'name'        => 'Padding (Small Breakpoints)',
						'description' => 'Select the padding (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						"allow-negative" => false,
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('sm') ),
					),
					array(
						'id'          => 'cc_padding_xs',
						'name'        => 'Padding (Extra Small Breakpoints)',
						'description' => 'Select the padding (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						"allow-negative" => false,
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('xs') ),
					),


				),
			),

			'display' => array(
				'title' => 'Display Options',
				'options' => array(

					array (
						"name"        => __( "Tweets to display", 'zn_framework' ),
						"description" => __( "How many tweets to display. Adding more than one will result into a carousel and only one will be shown.", 'zn_framework' ),
						"id"          => "tb_tweetstoshow",
						"std"         => "1",
						"type"        => "text",
						"class"       => "zn_input_xs",
						"numeric"     => true,
						'helpers'     => array(
							'min' => '1',
							'max' => '10',
							'step' => '1'
						),
					),

					array (
						"name"        => __( "Show Username?", 'zn_framework' ),
						"description" => __( "Enable if you want to show the username.", 'zn_framework' ),
						"id"          => "tb_showuser",
						"std"         => "1",
						"value"         => "1",
						"type"        => "toggle2",
					),
					array (
						"name"        => __( "Show tweet's date?", 'zn_framework' ),
						"description" => __( "Enable if you want to show the tweets dates.", 'zn_framework' ),
						"id"          => "tb_showdate",
						"std"         => "1",
						"value"         => "1",
						"type"        => "toggle2",
					),
				),
			),


		);
		return $options;
	}
}
