<?php
// thb Flickr Widget
class widget_flickr extends WP_Widget { 
	function __construct(){
		$widget_ops = array(
			'classname'   => 'widget_flickr',
			'description' => __('Display Your Flickr Images','north')
		);
	
		parent::__construct(
			'thb_flickr_widget',
			__( 'Fuel Themes - Flickr' , 'north' ),
			$widget_ops
		);
				
		$this->defaults = array( 'title' => 'Flickr', 'show' => '10', 'account' => 'eyetwist' );
	}
	
	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$account = $instance['account'];
		$show = $instance['show'];
		
		// Output
		echo $before_widget;
		echo $before_title . $title . $after_title;
			if($account && $show) {
				
				if (!get_transient('thb-flickr-account')) {
					@$person = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=0388a3691d9cbddb7969e1297b8424a5&username='.urlencode($account).'&format=json');
					@$person = trim($person['body'], 'jsonFlickrApi()');
					@$person = json_decode($person);
					set_transient('thb-flickr-account', $person->user->id, 0);
				}
				
				if(get_transient('thb-flickr-account')) {
					$id = get_transient('thb-flickr-account');
					$photos_url = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.urls.getUserPhotos&api_key=0388a3691d9cbddb7969e1297b8424a5&user_id='.$id.'&format=json');
					$photos_url = trim($photos_url['body'], 'jsonFlickrApi()');
					$photos_url = json_decode($photos_url);
					
					$photos = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key=0388a3691d9cbddb7969e1297b8424a5&user_id='.$id.'&per_page='.$show.'&format=json');
					$photos = trim($photos['body'], 'jsonFlickrApi()');
					$photos = json_decode($photos);
					
					set_transient('thb-flickr-url', $photos_url->user->url, 0);
					set_transient('thb-flickr-photos', $photos, 0);
					
				} else {
					return '<p>Could not retrieve flickr photos.</p>';
				}
			}
		$photolist = get_transient('thb-flickr-photos');
		$photourl = get_transient('thb-flickr-url');
		if ($photolist && $photourl) {
		?>
			<div class="flickrcontainer">
				<?php foreach($photolist->photos->photo as $photo): $photo = (array) $photo; ?>
				<div class="fresco">
					<a href="<?php echo esc_attr($photourl); ?><?php echo esc_attr($photo['id']); ?>" class="static" target='_blank'>
						<img src="<?php $url = "http://farm" . esc_attr($photo['farm']) . ".static.flickr.com/" . esc_attr($photo['server']) . "/" . esc_attr($photo['id']) . "_" . esc_attr($photo['secret']) . '_s' . ".jpg"; echo $url; ?>" alt="<?php echo esc_attr($photo['title']); ?>" />
					</a>
				</div>
				<?php endforeach; ?>
			</div>
		<?php
		} else {
			echo '<p>Invalid flickr username.</p>';
		}
		echo $after_widget;
	}
	public function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show'] = strip_tags( $new_instance['show'] );
		$instance['account'] = strip_tags( $new_instance['account'] );

		return $instance;
	}
	// Settings form
	public function form($instance) {
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'account' ); ?>">Flickr Username:</label>
			<input id="<?php echo $this->get_field_id( 'account' ); ?>" name="<?php echo $this->get_field_name( 'account' ); ?>" value="<?php echo $instance['account']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show' ); ?>">show of Images:</label>
			<input id="<?php echo $this->get_field_id( 'show' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>" value="<?php echo $instance['show']; ?>" style="width:100%;" />
		</p>
    <?php
	}
}
function widget_thbflickr_init()
{
	register_widget('widget_flickr');
}
add_action('widgets_init', 'widget_thbflickr_init');

?>