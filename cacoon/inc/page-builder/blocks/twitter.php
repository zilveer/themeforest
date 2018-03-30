<?php
class MET_Twitter_Ticker extends AQ_Block {

	function __construct() {
		$block_options = array(
			'name' => 'Twitter',
			'size' => 'span6'
		);

		parent::__construct('MET_Twitter_Ticker', $block_options);
	}

	function form($instance) {

		$defaults = array(
			'username' 			=> 'met_creative',
			'auto_play'				=> 'true',
			'circular'				=> 'true',
			'infinite'				=> 'true',
			'pauseduration'			=> '0',
			'duration'				=> '2000',
			'widget_title_1'				=> 'LATEST',
			'widget_title_2'				=> 'TWEETS',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$bool_options = array('false' => 'FALSE' , 'true' => 'TRUE');

		?>

		<p class="description half">
			<label for="<?php echo $this->get_field_id('widget_title_1') ?>">
				Widget Title 1
				<?php echo aq_field_input('widget_title_1', $block_id, $widget_title_1) ?>
			</label>
		</p>

		<p class="description half">
			<label for="<?php echo $this->get_field_id('widget_title_2') ?>">
				Widget Title 2
				<?php echo aq_field_input('widget_title_2', $block_id, $widget_title_2) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('username') ?>">
				Twitter Username
				<?php echo aq_field_input('username', $block_id, $username) ?>
			</label>
		</p>

		<p class="description">
			Go Appearance -> Live Customizer -> Twitter to set api keys.
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('auto_play') ?>">
				Auto Play<br/>
				<?php echo aq_field_select('auto_play', $block_id, $bool_options, $auto_play) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('duration') ?>">
				Auto Play (Duration)<br/>
				<?php echo aq_field_input('duration', $block_id, $duration) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('pauseduration') ?>">
				Auto Play (Pause Duration)<br/>
				<?php echo aq_field_input('pauseduration', $block_id, $pauseduration) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('circular') ?>">
				Circular<br/>
				<?php echo aq_field_select('circular', $block_id, $bool_options, $circular) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('infinite') ?>">
				Infinite<br/>
				<?php echo aq_field_select('infinite', $block_id, $bool_options, $infinite) ?>
			</label>
		</p>

	<?php
	}

	function block($instance) {
		extract($instance);

		wp_enqueue_script('metcreative-caroufredsel');
		wp_enqueue_style('metcreative-caroufredsel');

		$widgetID = uniqid('met_twitter_ticker_');

		$widget_title_1 = empty($widget_title_1) ? 'LATEST' : $widget_title_1;
		$widget_title_2 = empty($widget_title_2) ? 'TWEETS' : $widget_title_2;

		//Remove old twitter options if Cacoon older than v3.0.2
		if( get_option('pb_twitter_plugin_tweets') ){
			delete_option('pb_twitter_plugin_tweets');
			delete_option('pb_twitter_plugin_last_cache_time');
			delete_option('pb_twitter_plugin_username');
		}

		$widget_twitter_user_name = !isset($instance['username']) ? '' : $instance['username'];
?>

		<div class="row-fluid">
			<div class="span12">
				<div class="met_twitter_widget met_color2 met_bgcolor clearfix">
					<h2 class="met_title_stack"><?php echo $widget_title_1 ?></h2>
					<h3 class="met_title_stack met_bold_one"><?php echo $widget_title_2 ?></h3>

					<div id="<?php echo $widgetID ?>" class="met_twitter_wrapper">
						<?php
							$widget_tweets = $widget_tweets = mc_get_tweets($widget_twitter_user_name, $get_item_limit);
							if( $widget_tweets ){
								foreach( $widget_tweets as $widget_tweet ){
									echo '<div class="met_twitter_item clearfix">
											<i class="icon-twitter"></i>
											<p>'.$widget_tweet.'</p>
										</div>';
								}
							}
						?>
					</div>
				</div>
			</div>
		</div><!-- Twitter Ticker Ends -->
		<script>
			jQuery(document).ready(function(){
				jQuery("#<?php echo $widgetID ?>").carouFredSel({
					responsive: true,
					circular: <?php echo $circular ?>,
					infinite: <?php echo $infinite ?>,
					auto: {
						play : <?php echo $auto_play ?>,
						pauseDuration: <?php echo $pauseduration ?>,
						duration: <?php echo $duration ?>
					},
					scroll: {
						duration: 400,
						wipe: true,
						pauseOnHover: true
					},
					items: {
						visible: {
							min: 2,
							max: 3
						},
						height: 'auto'
					},
					direction: 'up',
					onCreate: function(){
						jQuery(window).trigger('resize');
					}
				});
			})
		</script>
<?php
	}

}