<?php

/**** WIDGETS AREA ****/


/* ***************************************************** 
 * Plugin Name: Evolution Flickr
 * Description: Retrieve and display photos from Flickr.
 * Version: 1.0
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */
class alc_flickr_widget extends WP_Widget {

	// Widget setup.
	function alc_flickr_widget() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'widget_alc_flickr',
			'description' => __('Display images from flickr', 'Evolution')
		);

		// Widget control settings.
		$control_ops = array(
			'id_base' => 'alc-flickr-widget'
		);

		// Create the widget.
		$this->WP_Widget('alc-flickr-widget', __('Evolution - Flickr images', 'Evolution') , $widget_ops, $control_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$id = $instance['flickr_id'];
		$nr = ($instance['flickr_nr'] != '') ? $nr = $instance['flickr_nr'] : $nr = 16;
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		echo "
		<script type=\"text/javascript\">
			jQuery(document).ready(function(){
				jQuery('ul#basicuse').jflickrfeed({
					limit: ".$nr.",
					qstrings: {
						id: '".$id."'
					},
					itemTemplate: '<li><a href=\"http://www.flickr.com/photos/".$id."\"><img src=\"{{image_s}}\" alt=\"{{title}}\" /></a></li>'
				});
			});
		</script>";
		echo '<ul id="basicuse" class="thumbs"></ul>'.$after_widget;
		
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['flickr_nr'] = strip_tags($new_instance['flickr_nr']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
		'title' => 'Latest From Flickr',
		'flickr_nr' => '16',
		'flickr_id' => '47445714@N03'
		);
		
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'Evolution'); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID:', 'Evolution'); ?></label> 
			<input id="<?php echo $this->get_field_id('flickr_id'); ?>" type="text" name="<?php echo $this->get_field_name('flickr_id'); ?>" value="<?php echo $instance['flickr_id']; ?>" class="widefat" />
            <small style="line-height:12px;"><a href="http://www.idgettr.com">Find your Flickr user or group id</a></small>
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('flickr_nr'); ?>"><?php _e('Number of photos:', 'Evolution'); ?></label> 
			<input id="<?php echo $this->get_field_id('flickr_nr'); ?>" type="text" name="<?php echo $this->get_field_name('flickr_nr'); ?>" value="<?php echo $instance['flickr_nr']; ?>" class="widefat" />
		</p>
	<?php
	}
}

register_widget('alc_flickr_widget');


/* ***************************************************** 
 * Plugin Name: Last Tweets
 * Description: Displays Latest Tweets.
 * Version: 1.1
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */

add_action( 'widgets_init', 'latest_tweet_widget' );
function latest_tweet_widget() {
	register_widget( 'Latest_Tweets' );
}
class Latest_Tweets extends WP_Widget {

	function Latest_Tweets() {
		$widget_ops = array( 'classname' => 'twitter-widget'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'latest-tweets-widget' );
		$this->WP_Widget( 'latest-tweets-widget','Evolution - Latest Tweets', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_tweets = $instance['no_of_tweets'];
		$transName = 'list_tweets';
	    $cacheTime = 20;
		$twitter_username 		= $instance['twitter_username'];
		$consumer_key 			= $instance['consumer_key'];
		$consumer_secret		= $instance['consumer_secret'];
		$access_token 			= $instance['access_token'];
		$access_token_secret 	= $instance['access_token_secret'];
		
	if( !empty($twitter_username) && !empty($consumer_key) && !empty($consumer_secret) && !empty($access_token) && !empty($access_token_secret)  ){
	    if(false === ($twitterData = get_transient($transName) ) ){
		
			$twitterConnection = new TwitterOAuth( $consumer_key , $consumer_secret , $access_token , $access_token_secret	);
			$twitterData = $twitterConnection->get(
					  'statuses/user_timeline',
					  array(
					    'screen_name'     => $twitter_username ,
					    'count'           => $no_of_tweets
						)
					);
			if($twitterConnection->http_code != 200)
			{
				$twitterData = get_transient($transName);
			}
	        // Save our new transient.
	        set_transient($transName, $twitterData, 60 * $cacheTime);
	    }
		/* Before widget (defined by themes). */
		echo $before_widget;
	
	
			echo $before_title; ?>
			<a href="http://twitter.com/<?php echo $twitter_username  ?>"><?php echo $title ; ?></a>
		<?php echo $after_title; 

            	if( !empty($twitterData) && is_array($twitterData)  && !isset($twitterData['error'])){
            		$i=0;
					$hyperlinks = true;
					$encode_utf8 = true;
					$twitter_users = true;
					$update = true;
					echo '
<div id="twitter-widget">
<ul class="twitter_update_list">';
		            foreach($twitterData as $item){
		                    $msg = $item->text;
		                    $permalink = 'http://twitter.com/#!/'. $twitter_username .'/status/'. $item->id_str;
		                    if($encode_utf8) $msg = utf8_encode($msg);
		                    $link = $permalink;
		                     echo '
<li class="twitter-item"><i class="icon-twitter"></i>';
		                      if ($hyperlinks) {    $msg = $this->hyperlinks($msg); }
		                      if ($twitter_users)  { $msg = $this->twitter_users($msg); }
		                      echo $msg;
		                    if($update) {
		                      $time = strtotime($item->created_at);
		                      if ( ( abs( time() - $time) ) < 86400 )
		                        $h_time = sprintf( __('%s ago', 'Evolution'), human_time_diff( $time ) );
		                      else
		                        $h_time = date(__('Y/m/d', 'Evolution'), $time);
		                      echo sprintf( __('%s', 'twitter-for-wordpress', 'Evolution'),' <span class="twitter-timestamp"><abbr title="' . date(__('Y/m/d H:i:s', 'Evolution'), $time) . '">' . $h_time . '</abbr></span>' );
		                     }
		                    echo '</li>
';
		                    $i++;
		                    if ( $i >= $no_of_tweets ) break;
		            }
					echo '</ul> </div>
';
            	}
				else
				{ 
					echo _e('Sorry , Twitter seems down or responds slowly.', 'Evolution'); 
				}
            ?>
		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	else{
		echo $before_widget;
		echo $before_title; ?>
			<a href="http://twitter.com/<?php echo $twitter_username  ?>"><?php echo $title ; ?></a>
		<?php echo $after_title._e('You need to Setup Twitter API OAuth settings first', 'Evolution');
		echo $after_widget;
	}
}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['no_of_tweets'] = strip_tags( $new_instance['no_of_tweets'] );
		
		$instance['twitter_username'] = strip_tags( $new_instance['twitter_username'] );
		$instance['consumer_key'] = strip_tags( $new_instance['consumer_key'] );
		$instance['consumer_secret'] = strip_tags( $new_instance['consumer_secret'] );
		$instance['access_token'] = strip_tags( $new_instance['access_token'] );
		$instance['access_token_secret'] = strip_tags( $new_instance['access_token_secret'] );
		//$instance['accounts'] = strip_tags( $new_instance['accounts'] );
		//$instance['replies'] = strip_tags( $new_instance['replies'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('@Follow Me' , 'Evolution') , 'no_of_tweets' => '5', 'twitter_username'=>'weblusive', 'consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>"><?php _e('Username', 'Evolution')?> : </label>
			<input id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" value="<?php echo $instance['twitter_username']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>"><?php _e('Consumer Key', 'Evolution')?> : </label>
			<input id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" value="<?php echo $instance['consumer_key']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>"><?php _e('Consumer Secret', 'Evolution')?> : </label>
			<input id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" value="<?php echo $instance['consumer_secret']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'access_token' ); ?>"><?php _e('Access Token', 'Evolution')?> : </label>
			<input id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" value="<?php echo $instance['access_token']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'access_token_secret' ); ?>"><?php _e('Access Token Secret', 'Evolution')?> : </label>
			<input id="<?php echo $this->get_field_id( 'access_token_secret' ); ?>" name="<?php echo $this->get_field_name( 'access_token_secret' ); ?>" value="<?php echo $instance['access_token_secret']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'Evolution')?> : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>"><?php _e('Number of Tweets to show', 'Evolution')?> : </label>
			<input id="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>" name="<?php echo $this->get_field_name( 'no_of_tweets' ); ?>" value="<?php echo $instance['no_of_tweets']; ?>" type="text" size="3" />
		</p>
	<?php
	}
	
		/**
	 * Find links and create the hyperlinks
	 */
	private function hyperlinks($text) {
	    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
	    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
	    // match name@address
	    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
	        //mach #trendingtopics. Props to Michael Voigt
	    $text = preg_replace('/([\.|\,|\:|\?|\?|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
	    return $text;
	}
	/**
	 * Find twitter usernames and link to them
	 */
	private function twitter_users($text) {
	       $text = preg_replace('/([\.|\,|\:|\?|\?|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
	       return $text;
	}
	
}

/* ***************************************************** 
 * Plugin Name: Evolution Last Works
 * Description: Retrieve and display latest works (Portfolio).
 * Version: 1.0
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */
class alc_works_widget extends WP_Widget {

	// Widget setup.
	function alc_works_widget() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'widget_alc_works',
			'description' => __('Display latest works (Portoflio)', 'Evolution')
		);

		// Create the widget.
		$this->WP_Widget('alc-works-widget', __('Evolution - Latest Works', 'Evolution') , $widget_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['post_title']);
		
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		$post_count = $instance['post_count'];
		$featured = isset($instance['featured']) ? $instance['featured'] : 0;
		
		$args = array('post_type' => 'portfolio', 'taxonomy'=> 'portfolio_category', 'posts_per_page' => $post_count);
		if ($featured)
		{
			$args['meta_key'] = '_portfolio_featured'; 
			$args['meta_value'] = '1';
		}
		$loop = new WP_Query($args);
		?>
		<ul class="widget-popular-list"><?php 
			while ( $loop->have_posts() ) : $loop->the_post();?>
				<li>
					<div class="row collapse">
					   <div class="small-3 columns">
							<a href="<?php the_permalink()?>">
								<?php if(has_post_thumbnail()):?>
									<?php the_post_thumbnail('blog-thumb2', array('class'=>'cover') ); ?>
								<?php else:?>
									<img src = "<?php echo get_template_directory_uri()?>/images/picture_small.png" alt="No Image" />
								<?php endif?>
							</a>
						</div>      
						<div class="small-9 columns">
					  
							<a href="<?php the_permalink()?>"><?php the_title() ?></a>
							<br />
							<?php echo limit_words(get_the_excerpt(), '12')?>
						</div>
						<div class="clear"></div>
					</div>
				</li>
			<?php endwhile;?>
		</ul> 
		<?php echo $after_widget; 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['post_title'] = strip_tags($new_instance['post_title']);
		$instance['post_count'] = strip_tags($new_instance['post_count']);
		$instance['featured'] = strip_tags($new_instance['featured']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'post_title' => 'Recent works',
			'post_count' => '3',
			'featured' => '0',
		);
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('post_title'); ?>"><?php _e('Title', 'Evolution'); ?></label>
			<input id="<?php echo $this->get_field_id('post_title'); ?>" type="text" name="<?php echo $this->get_field_name('post_title'); ?>" value="<?php echo $instance['post_title']; ?>" class="widefat" />
		</p>
        
         <p>
			<label for="<?php echo $this->get_field_id('featured'); ?>"><?php _e('Show only featured posts', 'Evolution'); ?></label> 
			<select id="<?php echo $this->get_field_id('featured'); ?>" name="<?php echo $this->get_field_name('featured'); ?>" class="widefat">
				<option value="0" <?php if( $instance['featured'] == 0):?>selected="selected"<?php endif?>>No</option> 
				<option value="1" <?php if( $instance['featured'] == 1):?>selected="selected"<?php endif?>>Yes</option> 
			</select>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('Number of Posts to show', 'Evolution'); ?></label> 
			<input id="<?php echo $this->get_field_id('post_count'); ?>" type="text" name="<?php echo $this->get_field_name('post_count'); ?>" value="<?php echo $instance['post_count']; ?>" class="widefat" />
		</p>
	<?php
	}
}

register_widget('alc_works_widget');



/* ***************************************************** 
 * Plugin Name: Evolution Blog Posts
 * Description: Retrieve and display latest blog posts.
 * Version: 1.0
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */
class alc_blogposts_widget extends WP_Widget {

	// Widget setup.
	function alc_blogposts_widget() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'widget_alc_blogposts',
			'description' => __('Display latest blog posts on footer', 'Evolution')
		);

		// Create the widget.
		$this->WP_Widget('alc-blogposts-widget', __('Evolution Footer Blog Posts', 'Evolution') , $widget_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['post_title']);
		
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		$post_count = $instance['post_count'];
		$post_category = $instance['post_category'];
		$post_thumbs = $instance['post_thumbs'];
		global $post;
		$args = array( 'numberposts' => $post_count);
		if (!empty($post_category))
		$args['category'] = $post_category;
		$myposts = get_posts( $args );
		?>
		<ul class="footer-list">
			<?php if ($myposts):
                foreach( $myposts as $post ) :	setup_postdata($post);  ?>                 
                    <li>
                        <i class="icon-angle-right"></i>
                        <a href="<?php the_permalink()?>" class="footer-post-link"><?php the_title()?></a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <?php echo $after_widget; 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['post_title'] = strip_tags($new_instance['post_title']);
		$instance['post_count'] = strip_tags($new_instance['post_count']);
		$instance['post_thumbs'] = strip_tags($new_instance['post_thumbs']);
		$instance['post_category'] = strip_tags($new_instance['post_category']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'post_title' => 'Latest from the blog',
			'post_count' => '4',
			'post_category' => '',
			'post_thumbs' => ''
		);
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('post_title'); ?>"><?php _e('Title', 'Evolution'); ?></label>
			<input id="<?php echo $this->get_field_id('post_title'); ?>" type="text" name="<?php echo $this->get_field_name('post_title'); ?>" value="<?php echo $instance['post_title']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('Number of Posts to show', 'Evolution'); ?></label> 
			<input id="<?php echo $this->get_field_id('post_count'); ?>" type="text" name="<?php echo $this->get_field_name('post_count'); ?>" value="<?php echo $instance['post_count']; ?>" class="widefat" />
		</p>
        
         <p>
			<label for="<?php echo $this->get_field_id('post_category'); ?>"><?php _e('Category (Leave Blank to show from all categories)', 'Evolution'); ?></label> 
			<input id="<?php echo $this->get_field_id('post_category'); ?>" type="text" name="<?php echo $this->get_field_name('post_category'); ?>" value="<?php echo $instance['post_category']; ?>" class="widefat" />
		</p>
		
		
	<?php
	}
}

register_widget('alc_blogposts_widget');



/* ***************************************************** 
 * Plugin Name: 3-in-1 Posts
 * Description: Retrieve and display popular/latest posts/latest comments.
 * Version: 1.0
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */
class alc_totalposts_widget extends WP_Widget {

	// Widget setup.
	function alc_totalposts_widget() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'widget_alc_totalposts',
			'description' => __('Retrieve and display popular/latest posts/latest comments.', 'Evolution')
		);

		// Create the widget.
		$this->WP_Widget('alc-totalposts-widget', __('Evolution Popular/Latest posts/Last comments', 'Evolution') , $widget_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['post_title']);
		
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		$post_count = $instance['post_count'];
		$post_category = $instance['post_category'];
		
		global $post;
		$args = array( 'numberposts' => $post_count);
		if (!empty($post_category))
		$args['category'] = $post_category;
		?>
		<div class="section-container tabs" data-section="tabs">
		   <section class="section">
			   <p class="title"><a href="#"><?php _e('Popular', 'Evolution')?></a></p>
			   <div class="content">
				   <ul class="widget-popular-list">
					   <?php $myposts = get_posts( $args ); if ($myposts):
						   foreach( $myposts as $post ) :	setup_postdata($post);  ?>                 
							   <li>
									<div class="row collapse">
										<div class="small-3 columns">
											<a href="<?php the_permalink()?>">
												<?php if(has_post_thumbnail()):?>
													<?php the_post_thumbnail('blog-thumb2', array('class'=>'cover') ); ?>
												<?php else:?>
													<img src = "http://placehold.it/50x50" alt="<?php _e('No Image', 'Evolution')?>" />
												<?php endif?>
											</a>
										</div>
										<div class="small-9 columns">
											<p class="date">
												<a href="<?php the_permalink()?>"><?php the_title()?></a>
												<a href="<?php get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d'))?>"><time datetime="<?php echo get_the_time('Y-m-d'); ?>"><span class="date"><i class="icon-calendar"></i><?php echo get_the_time('F d, Y'); ?></span></time></a>
											</p>
											<p><?php echo limit_words(get_the_excerpt(), 7); ?></p>
										</div>   
										<div class="clear"></div>
									</div>
							   </li>
						   <?php endforeach; ?>
					   <?php endif; ?>
					</ul>
				</div>
			</section>
			<section class="section">
				<p class="title"><a href="#"><?php _e('Recent', 'Evolution')?></a></p>
				<div class="content">
					<ul class="widget-popular-list">
					   <?php $args ['orderby'] = 'comment_count';
						$myposts = get_posts( $args ); 
						if ($myposts):
							foreach( $myposts as $post ) :	setup_postdata($post);  ?>                 
								<li>
									<div class="row collapse">
										<div class="small-3 columns">
											<a href="<?php the_permalink()?>">
												<?php if(has_post_thumbnail()):?>
													<?php the_post_thumbnail('blog-thumb2', array('class'=>'cover') ); ?>
												<?php else:?>
													<img src = "http://placehold.it/50x50" alt="<?php _e('No Image', 'Evolution')?>" />
												<?php endif?>
											</a>
										</div>
										<div class="small-9 columns">
											<p class="date">
												<a href="<?php the_permalink()?>"><?php the_title()?></a>
												<a href="<?php get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d'))?>"><time datetime="<?php echo get_the_time('Y-m-d'); ?>"><span class="date"><i class="icon-calendar"></i><?php echo get_the_time('F d, Y'); ?></span></time></a>
											</p>
											<p><?php echo limit_words(get_the_excerpt(), 7); ?></p>
										</div>   
										<div class="clear"></div>
									</div>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
			</section>
			<section class="section">
				<p class="title"><a href="#"><?php _e('Comments', 'Evolution')?></a></p>
				<div class="content">
					<ul class="widget-popular-list widget-comment-list">
						<?php 
						global $wpdb;	
						$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_content, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,70) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $post_count";
						$comments = $wpdb->get_results($sql);
						foreach ($comments as $comment) :?>
							<li>
								<div class="row collapse" style="margin-bottom:5px;">
									<div class="small-3 columns">
										<a href="<?php echo get_permalink($comment->ID).'#comment-'.$comment->comment_ID?>" title="<?php echo strip_tags($comment->comment_author).' '.__('on ', 'Evolution').' '.$comment->post_title?>">
											<?php echo get_avatar($comment, '45')?>
										</a>
									</div>
									<div class="small-9 columns">
										<p class="date"><a href="<?php get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d'))?>"><time datetime="<?php echo get_the_time('Y-m-d'); ?>"><i class="icon-calendar"></i><?php echo get_the_time('F d, Y'); ?></time></a></p>
										<a href="<?php echo get_permalink($comment->ID).'#comment-'.$comment->comment_ID?>" title="<?php echo strip_tags($comment->comment_author).' '.__('on', 'Evolution').' '.$comment->post_title?>">
											<?php echo strip_tags($comment->comment_author)?>
										</a>
										<p><?php echo limit_words($comment->comment_content, 5); ?></p>
									</div>
									<div class="clear"></div>
								</div>
							</li>
						<?php endforeach; wp_reset_query();?>			
					</ul>
				</div> 
			</section>
		</div>     
		<div class="clear"></div>
        <?php echo $after_widget; 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['post_title'] = strip_tags($new_instance['post_title']);
		$instance['post_count'] = strip_tags($new_instance['post_count']);
		$instance['post_category'] = strip_tags($new_instance['post_category']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'post_title' => 'Blog posts',
			'post_count' => '3',
			'post_category' => ''
		);
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('post_title'); ?>"><?php _e('Title', 'Evolution'); ?></label>
			<input id="<?php echo $this->get_field_id('post_title'); ?>" type="text" name="<?php echo $this->get_field_name('post_title'); ?>" value="<?php echo $instance['post_title']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('Number of Posts to show', 'Evolution'); ?></label> 
			<input id="<?php echo $this->get_field_id('post_count'); ?>" type="text" name="<?php echo $this->get_field_name('post_count'); ?>" value="<?php echo $instance['post_count']; ?>" class="widefat" />
		</p>
        
         <p>
			<label for="<?php echo $this->get_field_id('post_category'); ?>"><?php _e('Category (Leave Blank to show from all categories)', 'Evolution'); ?></label> 
			<input id="<?php echo $this->get_field_id('post_category'); ?>" type="text" name="<?php echo $this->get_field_name('post_category'); ?>" value="<?php echo $instance['post_category']; ?>" class="widefat" />
		</p>
	<?php
	}
}

register_widget('alc_totalposts_widget');


/* ***************************************************** 
 * Plugin Name: Evolution Contact Widget
 * Description: Display contact widget on footer.
 * Version: 1.0
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */
/**
 * Contact Form Widget Class
 */
class alc_Contact_Form extends WP_Widget {
	
	function alc_Contact_Form() {
		$widget_ops = array('classname' => 'alc_contact_form_entries', 'description' => __("Contact widget", 'Evolution') );
		$this->WP_Widget('alc_Contact_Form', __('Evolution - Contact Form', 'Evolution'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Contact Us', 'Evolution') : $instance['title'], $instance);
		$email = apply_filters('widget_title', empty($instance['email']) ? __('', 'Evolution') : $instance['email'], $instance);
		$success = apply_filters('widget_title', empty($instance['success']) ? __('Thank you, e-mail sent.', 'Evolution') : $instance['success'], $instance);
		
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
                        
			echo '<form action="#" method="post" id="contactFormWidget">';
                        echo '<div class="row">';
			echo '<div class="small-6 columns"><input type="text" name="wname" id="wname" value="" size="22" placeholder="Name"/></div>';
			echo '<div class="small-6 columns"><input type="text" name="wemail" id="wemail" value="" size="22" placeholder="Email" /></div>';
			echo '<div class="small-12 columns"><textarea name="wmessage" id="wmessage" cols="60" rows="10" placeholder="Message"></textarea></div>';
			echo '<div class="loading"></div>';
			echo '<div><input type="hidden" name="wcontactemail" id="wcontactemail" value="'.$email.'" /></div>';
			echo '<div><input type="hidden" value="'.home_url().'" id="wcontactwebsite" name="wcontactwebsite" /></div>';
			echo '<div><input type="hidden" name="wcontacturl" id="wcontacturl" value="'.get_template_directory_uri().'/library/sendmail.php" /></div>';
			echo '<div class="large-12 columns text-right"><input type="submit" id="wformsend" value="'.__('Send', 'Evolution').'" class="button" name="wsend"  /></div>';
			echo '<div class="clear"></div>';
			echo '<div class="widgeterror"></div>';
			echo '<div class="widgetinfo">'.$success.'</div>';
                        echo '</div>';
			echo '</form>';
	
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['success'] = strip_tags($new_instance['success']);
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : '';
		$success = isset($instance['success']) ? esc_attr($instance['success']) : '';
	?>
	
		<div>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:<br />', 'Evolution'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		</div>
        <div>
        	<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email Address:<br />', 'Evolution'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></label></p>
		</div>
        <div>
        	<label for="<?php echo $this->get_field_id('success'); ?>"><?php _e('Success Message:<br />', 'Evolution'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('success'); ?>" name="<?php echo $this->get_field_name('success'); ?>" type="text" value="<?php echo $success; ?>" /></label></p>
		</div>
		<div style="clear:both"></div>
<?php
	}
}

register_widget('alc_Contact_Form');
?>