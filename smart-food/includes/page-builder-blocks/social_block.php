<?php

class TD_Social_Block extends TD_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name'              => __('Big Social Icons', 'smartfood'),
			'size'              => 'span12',
			'block_icon'        => '<i class="fa fa-instagram fa-fw"></i>',
			'block_description' => __('Use to add a block of social icon links to the page.', 'smartfood'),
			'block_category'    => 'social',
			'resizable'         => false
		);
		
		//create the block
		parent::__construct('td_social_block', $block_options);
	}//end construct
	
	function form($instance) {
		
		$defaults = array(
			'twitter_text'    => 'Follow On Twitter',
			'facebook_text'   => 'Follow On Facebook',
			'instagram_text'  => 'Follow On Instagram',
			'foursquare_text' => 'Follow On Foursquare',
			'twitter_url'     => '',
			'facebook_url'    => '',
			'instagram_url'   => '',
			'foursquare_url'  => ''
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
		
		<p class="description"><?php _e('Twitter Text', 'smartfood');?></p>
		<?php echo td_field_input('twitter_text', $block_id, $twitter_text, $size = 'full') ?>
		
		<p class="description"><?php _e('Twitter URL', 'smartfood');?></p>
		<?php echo td_field_input('twitter_url', $block_id, $twitter_url, $size = 'full') ?>
		
		<hr />
		
		<p class="description"><?php _e('Facebook Text', 'smartfood');?></p>
		<?php echo td_field_input('facebook_text', $block_id, $facebook_text, $size = 'full') ?>
		
		<p class="description"><?php _e('Facebook URL', 'smartfood');?></p>
		<?php echo td_field_input('facebook_url', $block_id, $facebook_url, $size = 'full') ?>
		
		<hr />
		
		<p class="description"><?php _e('Instagram Text', 'smartfood');?></p>
		<?php echo td_field_input('instagram_text', $block_id, $instagram_text, $size = 'full') ?>
		
		<p class="description"><?php _e('Instagram URL', 'smartfood');?></p>
		<?php echo td_field_input('instagram_url', $block_id, $instagram_url, $size = 'full') ?>
		
		<hr />
		
		<p class="description"><?php _e('Foursquare Text', 'smartfood');?></p>
		<?php echo td_field_input('foursquare_text', $block_id, $foursquare_text, $size = 'full') ?>
		
		<p class="description"><?php _e('Foursquare URL', 'smartfood');?></p>
		<?php echo td_field_input('foursquare_url', $block_id, $foursquare_url, $size = 'full') ?>
		
		<hr />
		
	<?php
	}//end form
	
	function block($instance) {
		extract($instance);
		
		$text = array(
			'twitter'    => $twitter_text,
			'facebook'   => $facebook_text,
			'instagram'  => $instagram_text,
			'foursquare' => $foursquare_text,
		);
		
		$urls = array(
			'twitter'    => $twitter_url,
			'facebook'   => $facebook_url,
			'instagram'  => $instagram_url,
			'foursquare' => $foursquare_url,
		);
		
		$urls = array_filter(array_map(NULL, $urls));
		$amount = count($urls);
		
		if(!( 0 == $amount )) :
		$count = 12 / $amount;
	?>
		<div class="clearfix"></div>
		<div class="social-bar">
			<?php foreach( $urls as $key => $url ) : ?>
				<div class="col-sm-<?php echo $count; ?> no-pad">
					<a href="<?php echo esc_url($url); ?>" target="_blank">
						<div class="link bg-<?php echo esc_attr($key); ?>">
							<div class="initial">
								<i class="icon fa fa-<?php echo esc_attr($key); ?>"></i>
							</div>
						
							<div class="hover-state">
								<span><?php echo esc_attr($text[$key]); ?></span>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="clearfix"></div>
	
	<?php
		endif;		
	}//end block
	
}//end class