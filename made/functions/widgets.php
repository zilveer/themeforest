<?php
//get theme options
global $oswcPostTypes;
		
//need to know which custom post type sidebars to enable
$typecount=0;//find out if we have more than 1 review type active
foreach($oswcPostTypes->postTypes as $postType){	
	if($postType->enabled){
		$typecount++;
	}
}
		
//REGISTERING SIDEBARS
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Frontpage Sidebar',
		'id'   => 'frontpage-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of only the front page (if you set this option in the theme options)', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Frontpage Main',
		'id'   => 'frontpage-main',
		'description'   => __( 'These widgets appear in the main content area of the front page', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Top Widget',
		'id'   => 'top-widget',
		'description'   => __( 'These widgets replace the three social links to the left of the search bar in the top menu area.', 'made' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => ''
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Signup Widget',
		'id'   => 'signup-widget',
		'description'   => __( 'These widgets replace the Get Our Newsletter signup form in the Dont Miss bar.', 'made' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Demo Panel',
		'id'   => 'demo-panel',
		'description'   => __( 'These widgets appear in the slide-out "Demo" panel and replace all the demo content. There is no styling here, just an area for you to put in your custom HTML via a text widget.', 'made' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => ''
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Single Post Sidebar',
		'id'   => 'single-post-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of all regular single posts (depending on settings in the theme options)', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Default Sidebar',
		'id'   => 'default-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of all pages (depending on settings in the theme options)', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'id'   => 'page-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of all regular pages (depending on settings in the theme options)', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Archive Sidebar',
		'id'   => 'archive-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of all category/archive/tag listing pages (but not review listings)', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Search Sidebar',
		'id'   => 'search-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of all search listing pages', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Author Sidebar',
		'id'   => 'author-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of the author listing template page', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Footer Panel 1',
		'id'   => 'footer-panel-1',
		'description'   => __( 'These widgets appear in the first footer panel', 'made' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Footer Panel 2',
		'id'   => 'footer-panel-2',
		'description'   => __( 'These widgets appear in the second footer panel', 'made' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Footer Panel 3',
		'id'   => 'footer-panel-3',
		'description'   => __( 'These widgets appear in the third footer panel', 'made' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Footer Panel 4',
		'id'   => 'footer-panel-4',
		'description'   => __( 'These widgets appear in the fourth footer panel', 'made' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Footer Credits',
		'id'   => 'footer-credits',
		'description'   => __( 'The small credit text area at the very bottom right-hand side of the footer', 'made' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => ''
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'BuddyPress Default Sidebar',
		'id'   => 'buddypress-default-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of all BuddyPress pages (depending on settings in the theme options)', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'BuddyPress Activity Sidebar',
		'id'   => 'buddypress-activity-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of BuddyPress Activity page (depending on settings in the theme options)', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'BuddyPress Forums Sidebar',
		'id'   => 'buddypress-forums-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of BuddyPress Forum pages (depending on settings in the theme options)', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'BuddyPress Groups Sidebar',
		'id'   => 'buddypress-groups-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of BuddyPress Group pages (depending on settings in the theme options)', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'BuddyPress Members Sidebar',
		'id'   => 'buddypress-members-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of BuddyPress Members pages (depending on settings in the theme options)', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'BuddyPress Blogs Sidebar',
		'id'   => 'buddypress-blogs-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of BuddyPress Blogs pages (depending on settings in the theme options)', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'BuddyPress Registration Sidebar',
		'id'   => 'buddypress-registration-sidebar',
		'description'   => __( 'These widgets appear in the sidebar of BuddyPress Registration pages (depending on settings in the theme options)', 'made' ),
		'before_widget' => '<div class="widget-wrapper"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="section-wrapper"><div class="section">',
		'after_title'   => '</div></div>'
	));
}

//CUSTOM WIDGETS
add_action("widgets_init", "oswc_load_widgets");
function oswc_load_widgets()
{
	//need to know which custom post type sidebars to enable
	//get theme options
	global $oswc_front, $oswc_single, $oswc_other, $oswc_ads, $oswc_misc, $oswcPostTypes;
					
	//need to know which custom post type sidebars to enable
	$typecount=0;//find out if we have more than 1 review type active
	foreach($oswcPostTypes->postTypes as $postType){
		if($postType->enabled){
			$typecount++;
		}
	}
	
	register_widget('oswc_latest_tweets');
	register_widget('oswc_flickr');
	register_widget('oswc_tabbed_posts');
	register_widget('oswc_tabbed_archives');
	if($typecount>0) register_widget('oswc_tabbed_reviews');
	if($typecount>0) register_widget('oswc_tabbed_latest_reviews');	
	if($typecount>0) register_widget('oswc_tabbed_latest_reviews_compact');	
	if($typecount>0) register_widget('oswc_latest_reviews');
	register_widget('oswc_unwrapped');
	register_widget('oswc_ad_125');
	register_widget('oswc_email_subscribe');
	register_widget('oswc_login_form');
}

//LATEST TWEETS
class oswc_latest_tweets extends WP_Widget {
	function oswc_latest_tweets() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Extended: Latest Tweets', 'description' => __( 'Displays your latest Tweets','made') );
		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'oswc_latest_tweets' );
		/* Create the widget. */
		$this->WP_Widget( 'oswc_latest_tweets', 'Extended: Latest Tweets', $widget_ops, $control_ops );
	}	
	function widget( $args, $instance ) {
		//get theme options
		global $oswc_front, $oswc_single, $oswc_other, $oswc_ads, $oswc_misc, $oswcPostTypes;
			
		//set theme options
		$oswc_twitter_name = $oswc_misc['twitter_name'];		
		
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$num = $instance['num'];
		$text_default = apply_filters('widget_title', $instance['text_default'] );
		$text_ed = apply_filters('widget_title', $instance['text_ed'] );
		$text_ing = apply_filters('widget_title', $instance['text_ing'] );
		$text_reply = apply_filters('widget_title', $instance['text_reply'] );
		$text_url = apply_filters('widget_title', $instance['text_url'] );
		$refresh = $instance['refresh'];		

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title ) { ?>
			<?php echo $before_title; ?>
                <?php echo $title; ?>
            <?php echo $after_title; ?>
        <?php } 			

		/* Display Latest Tweets */
		if ( $num ) { ?>
        	<script type="text/javascript">
				jQuery(window).load(function() {
					jQuery(function($){
						/*jQuery(".tweet").tweet({
						  modpath: '<?php echo get_template_directory_uri(); ?>/functions/twitter/',
						  join_text: "auto",
						  username: "<?php echo $oswc_twitter_name; ?>",
						  avatar_size: 32,
						  count: <?php echo $num; ?>,
						  auto_join_text_default: "<?php echo $text_default; ?>",
						  auto_join_text_ed: "<?php echo $text_ed; ?>",
						  auto_join_text_ing: "<?php echo $text_ing; ?>",
						  auto_join_text_reply: "<?php echo $text_reply; ?>",
						  auto_join_text_url: "<?php echo $text_url; ?>",
						  loading_text: "loading tweets...",
						  refresh_interval: <?php echo $refresh; ?>					  	
						});
					  });*/
				});
			</script>
            
			<div class='tweet query complex-list'></div>
            
            <div class="footer-fix">&nbsp;</div>
            
		<?php }

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num'] = strip_tags( $new_instance['num'] );
		$instance['text_default'] = strip_tags( $new_instance['text_default'] );
		$instance['text_ed'] = strip_tags( $new_instance['text_ed'] );
		$instance['text_ing'] = strip_tags( $new_instance['text_ing'] );
		$instance['text_reply'] = strip_tags( $new_instance['text_reply'] );
		$instance['text_url'] = strip_tags( $new_instance['text_url'] );
		$instance['refresh'] = strip_tags( $new_instance['refresh'] );		

		return $instance;
	}
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Latest Tweets', 'num' => '3', 'text_default' => 'we said,', 'text_ed' => 'we', 'text_ing' => 'we were', 'text_reply' => 'we replied', 'text_url' => 'we were checking out', 'refresh' => '60' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','made'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:160px" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e( 'Number of Tweets:','made'); ?></label>
			<input id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo $instance['num']; ?>" style="width:40px" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'refresh' ); ?>"><?php _e( 'Refresh every','made'); ?></label>
			<input id="<?php echo $this->get_field_id( 'refresh' ); ?>" name="<?php echo $this->get_field_name( 'refresh' ); ?>" value="<?php echo $instance['refresh']; ?>" style="width:40px" />
            <?php _e( 'seconds','made'); ?>
            <p><em><?php _e( 'Only refreshes your tweets, not the page.','made'); ?></em></p>            
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'text_default' ); ?>"><?php _e( 'Regular Tweet Prefix:','made'); ?></label>
			<input id="<?php echo $this->get_field_id( 'text_default' ); ?>" name="<?php echo $this->get_field_name( 'text_default' ); ?>" value="<?php echo $instance['text_default']; ?>" style="width:90px" />
            <p><em><?php _e( 'Example: about 2 hours ago','made'); ?>&nbsp;<b><?php _e( 'we said,','made'); ?></b>&nbsp;<?php _e( 'what is your favorite comedy duo on Youtube?','made'); ?></em></p>  
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'text_ed' ); ?>"><?php _e( 'Past Tense Prefix:','made'); ?></label>
			<input id="<?php echo $this->get_field_id( 'text_ed' ); ?>" name="<?php echo $this->get_field_name( 'text_ed' ); ?>" value="<?php echo $instance['text_ed']; ?>" style="width:110px" />
            <p><em><?php _e( 'Example: about 4 hours ago','made'); ?>&nbsp;<b><?php _e( 'we','made'); ?></b>&nbsp;<?php _e( 'bought Modern Warfare 3 at the nearest Best Buy.','made'); ?></em></p>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'text_ing' ); ?>"><?php _e( 'Present Tense Prefix:','made'); ?></label>
			<input id="<?php echo $this->get_field_id( 'text_ing' ); ?>" name="<?php echo $this->get_field_name( 'text_ing' ); ?>" value="<?php echo $instance['text_ing']; ?>" style="width:90px" />
            <p><em><?php _e( 'Example: about 7 minutes ago','made'); ?>&nbsp;<b><?php _e( 'we were','made'); ?></b>&nbsp;<?php _e( 'drinking a pint of Bells Consecrator Doppelbock.','made'); ?></em></p>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'text_reply' ); ?>"><?php _e( 'Reply Prefix:','made'); ?></label>
			<input id="<?php echo $this->get_field_id( 'text_reply' ); ?>" name="<?php echo $this->get_field_name( 'text_reply' ); ?>" value="<?php echo $instance['text_reply']; ?>" style="width:140px" />
            <p><em><?php _e( 'Example: about 2 hours ago','made'); ?>&nbsp;<b><?php _e( 'we replied','made'); ?></b>&nbsp;<?php _e( '@wordpress thank you for your magnanimosity.','made'); ?></em></p>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'text_url' ); ?>"><?php _e( 'URL Prefix:','made'); ?></label>
			<input id="<?php echo $this->get_field_id( 'text_url' ); ?>" name="<?php echo $this->get_field_name( 'text_url' ); ?>" value="<?php echo $instance['text_url']; ?>" style="width:145px" />
            <p><em><?php _e( 'Example: about 45 minutes ago','made'); ?>&nbsp;<b><?php _e( 'we were checking out','made'); ?></b>&nbsp;<?php _e( 'Dubstep meets guns: http://youtu.be/hDlif8Km4S4','made'); ?></em></p>
		</p>
        
        <p><em><?php _e( 'See the Made documentation for further information.','made'); ?></em></p>
        
        <?php
	}
}

//FLICKR FEED
class oswc_flickr extends WP_Widget {
	function oswc_flickr() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Extended: Flickr Feed', 'description' => __( 'Displays your Flickr feed','made') );
		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'oswc_flickr' );
		/* Create the widget. */
		$this->WP_Widget( 'oswc_flickr', 'Extended: Flickr Feed', $widget_ops, $control_ops );
	}	
	function widget( $args, $instance ) {
		//get theme options
		global $oswc_front, $oswc_layout, $oswc_feed, $oswc_reviews, $oswc_ads, $oswc_misc, $oswcPostTypes;
		
		//set theme options
		$oswc_flickr_name = $oswc_misc['flickr_name'];	
		$oswc_colorbox = $oswc_misc['colorbox'];	
		
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$num = $instance['num'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title ) { ?>
        	<?php echo str_replace('<h2>','<h2 class="flickr">',$before_title); ?>
                <?php echo $title; ?>
            <?php echo $after_title; ?>           
        <?php } 			

		/* Display Latest Tweets */
		if ( $num ) { ?>
        	
        	<script type="text/javascript">
				<!--
				jQuery(document).ready(function() {                
					jQuery('#flickr').jflickrfeed({
						limit: <?php echo $num; ?>,
						qstrings: {
							id: '<?php echo $oswc_flickr_name; ?>'
						},
						itemTemplate: '<li>'+
										'<a rel="colorbox" class="darken small" href="{{image}}" title="{{title}}">' +
											'<img src="{{image_s}}" alt="{{title}}" width="75" height="75" />' +
										'</a>' +
									  '</li>'
					}, function(data) {
						<?php if($oswc_colorbox) { ?>
						jQuery('#flickr a').colorbox();	
						<?php } ?>		
					});
				});
				// -->
			</script>
            
			<div class="flickr"> 
                
                <ul id="flickr" class="flickr-thumbs"><li class="first"></li></ul>
                
                <br class="clearer" />
                
                <a class="more" href="http://www.flickr.com/photos/<?php echo $oswc_flickr_name; ?>" target="_blank"><?php _e( 'View more photos', 'made' ); ?> &raquo;</a>
                
            </div>
		<?php }

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num'] = strip_tags( $new_instance['num'] );

		return $instance;
	}
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Flickr Photos', 'num' => '6' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','made'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:160px" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e( 'Number of photos:','made'); ?></label>
			<input id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo $instance['num']; ?>" style="width:40px" />
		</p>
        
        <?php
	}
}
//TABBED POSTS
class oswc_tabbed_posts extends WP_Widget {
	function oswc_tabbed_posts() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Extended: Post Tabs', 'description' => __( 'Displays posts, comments, and tags in a jQuery tabbed format','made') );
		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'oswc_tabbed_posts' );
		/* Create the widget. */
		$this->WP_Widget( 'oswc_tabbed_posts', 'Extended: Post Tabs', $widget_ops, $control_ops );
	}	
	function widget( $args, $instance ) {
		global $oswc_front, $oswc_misc, $oswcPostTypes;
		$oswc_skin = $oswc_misc['skin'];
			
		//check to see if we are on a review type page
		$reviewPage = false;
		$post_id = $GLOBALS['post']->ID;
		$postTypeName = oswc_get_review_meta($post_id);
		$postTypeId = get_post_type($post_id); //setup the posttypeid object, which is used below to determine which post type we're on
		//review listing page
		if(!empty($postTypeName) && ($oswcPostTypes->has_type($postTypeName) || $oswcPostTypes->has_type(strtolower($postTypeName)))){
			$reviewPage = true;
			$reviewType = $oswcPostTypes->get_type_by_name($postTypeName); //get the review type object
			$reviewSkin = $reviewType->skin; //get the review skin
			if($reviewSkin=="dark") $oswc_skin="dark";
			if($reviewSkin=="light") $oswc_skin="";
		}
		//review taxonomy page
		if(is_tax()) {
			$reviewPage = true;
			$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);
			$reviewSkin = $reviewType->skin; //get the review skin
			if($reviewSkin=="dark") $oswc_skin="dark";
			if($reviewSkin=="light") $oswc_skin="";
		}
		//single review page
		if (is_single() && $oswcPostTypes->has_type($postTypeId, true)) {
			$reviewPage = true;
			$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);
			$reviewSkin = $reviewType->skin; //get the review skin
			if($reviewSkin=="dark") $oswc_skin="dark";
			if($reviewSkin=="light") $oswc_skin="";
		}
		
		//get all template tags (need to be excluded below)
		$oswc_featured_tag = $oswc_front['featured_tag'];
		$oswc_spotlight_tags = $oswc_front['spotlight_tags'];
		$oswc_trending_tag = $oswc_front['trending_tags'];
		$oswc_latest_tag = $oswc_misc['latest_tag'];
		$oswc_dontmiss_tags = $oswc_front['dontmiss_tags'];
	
		extract( $args );

		/* User-selected settings. */
		$thumbsize = $instance['thumbsize'];
		$showpopular = $instance['showpopular'];
		$showrecent = $instance['showrecent'];
		$showcomments = $instance['showcomments'];
		$showtags = $instance['showtags'];
		$numpopular = $instance['numpopular'];
		$numrecent = $instance['numrecent'];
		$numcomments = $instance['numcomments'];
		$numtags = $instance['numtags'];
		$ordertags = $instance['ordertags'];

		/* HTML output */
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		?>
        	
        <div id="tabbed-posts" class="complex-list<?php if($thumbsize=="footer-thumbnail") { ?> small<?php } ?>">
            <ul class="tabnav">
				<?php if($showpopular) { ?><li><a class="first" href="#tabs-popular"><?php _e('Popular','made'); ?></a></li><?php } ?>
                <?php if($showrecent) { ?><li><a href="#tabs-recent"><?php _e('Recent','made'); ?></a></li><?php } ?>
                <?php if($showcomments) { ?><li><a href="#tabs-comments"><?php _e('Comments','made'); ?></a></li><?php } ?>
                <?php if($showtags) { ?><li><a href="#tabs-tags"><?php _e('Tags','made'); ?></a></li><?php } ?>
            </ul>
            <br class="clearer" />
            <div class="tabdiv-wrapper">
        
        		<?php if($showpopular) { ?>
                    
                    <div id="tabs-popular" class="tabdiv">
                        <ul>
                            <?php // create popular query
                            $postcount=0;
							// get array of review types
							$arrTypes = array();
							foreach($oswcPostTypes->postTypes as $postType){
								if($postType->enabled) {
									 array_push($arrTypes, $postType->id);						             
								}
							}
							array_push($arrTypes, 'post');							
							// setup the query							
							$args=array('suppress_filters' => true, 'posts_per_page' => $numpopular, 'order' => 'DESC', 'orderby' => 'comment_count', 'post_type' => $arrTypes);	
                            $pop_loop = new WP_Query($args);
                            if ($pop_loop->have_posts()) : while ($pop_loop->have_posts()) : $pop_loop->the_post(); $postcount++;
								$postType = get_post_type(); //get post type
								$reviewType = $oswcPostTypes->get_type_by_id($postType); //get review type object
								$isreview=false;
                    			if($postType!='post' && $postType!='page') $isreview=true; //set review variable		
								$icon = $reviewType->icon;
								$icon_light = $reviewType->icon_light;	
								if($oswc_skin=="dark") $icon=$icon_light;	
								if(!isset($icon)){
									$icon = get_template_directory_uri() . '/images/more-grey.png';
								} 
								//show rating?
								$rating_hide = get_post_meta(get_the_ID(), "Hide Rating", $single = true); 
								//check if this is a video post
								$isvideo=false;
								$video = get_post_meta(get_the_ID(), "Video", $single = true);
								if($video!="") $isvideo=true;
								?>
                                
								<li>
                                    
                                    <div class="floatleft">
                                
                                    	<a href="<?php the_permalink(); ?>" class="thumbnail darken<?php if($isvideo) { ?> video<?php } ?> small" title="<?php the_title(); ?>"><?php the_post_thumbnail($thumbsize, array( 'title'=> '' )); ?></a>				 
                                    </div>
                                    
                                    <div class="floatleft">
                                    
                                    	<a class="post-title<?php if(!$isreview) { ?> wide<?php } ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                        
                                        <?php if($isreview) { ?>
                                        
                                        	<br class="clearer" />
                                            
                                            <div class="icon">
                                        
                                                <img alt="icon" src="<?php echo $icon; ?>" width="16" height="16" />
                                            
                                            </div>
                                        <?php } ?>
                                    
										<?php if($isreview && $rating_hide!="true") { ?>
                                            <div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($reviewType); // show the rating ?></div>
                                        <?php } ?>
                                    
                                    </div>
                                    
                                    <br class="clearer" />
									
								</li>
                                
                            <?php endwhile; 
                            endif; ?> 
                            <?php wp_reset_query(); ?>

                            <li class="last">&nbsp;</li>  
                        </ul>
                    </div>
                    
                <?php } ?>
                
                <?php if($showrecent) { ?>
            
                    <div id="tabs-recent" class="tabdiv">
                        <ul>
                        <?php // create recent query
                            $postcount=0;
							$arrTypes = array();
							foreach($oswcPostTypes->postTypes as $postType){
								if($postType->enabled) {
									 array_push($arrTypes, $postType->id);						             
								}
							}
							array_push($arrTypes, 'post');					
							// setup the query							
							$args=array('suppress_filters' => true, 'posts_per_page' => $numrecent, 'order' => 'DESC', 'orderby' => 'date', 'post_type' => $arrTypes);	
                            $pop_loop = new WP_Query($args);
                            if ($pop_loop->have_posts()) : while ($pop_loop->have_posts()) : $pop_loop->the_post(); $postcount++;
								$postType = get_post_type(); //get post type
								$reviewType = $oswcPostTypes->get_type_by_id($postType); //get review type object
								$isreview=false;
                    			if($postType!='post' && $postType!='page') $isreview=true; //set review variable		
								$icon = $reviewType->icon;
								$icon_light = $reviewType->icon_light;	
								if($oswc_skin=="dark") $icon=$icon_light;
								if(!isset($icon)){
									$icon = get_template_directory_uri() . '/images/more-grey.png';
								} 
								//show rating?
								$rating_hide = get_post_meta(get_the_ID(), "Hide Rating", $single = true); 
								//check if this is a video post
								$isvideo=false;
								$video = get_post_meta(get_the_ID(), "Video", $single = true);
								if($video!="") $isvideo=true;
								?>
                                
								<li>
                                    
                                    <div class="floatleft">
                                
                                    	<a href="<?php the_permalink(); ?>" class="thumbnail darken<?php if($isvideo) { ?> video<?php } ?> small" title="<?php the_title(); ?>"><?php the_post_thumbnail($thumbsize, array( 'title'=> '' )); ?></a>				 
                                    </div>
                                    
                                    <div class="floatleft">
                                    
                                    	<a class="post-title<?php if(!$isreview) { ?> wide<?php } ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>                      
                                        
                                        <?php if($isreview) { ?>
                                        
                                        	<br class="clearer" />
                                        
                                            <div class="icon">
                                        
                                                <img alt="icon" src="<?php echo $icon; ?>" width="16" height="16" />
                                            
                                            </div>
                                        <?php } ?>
                                    
										<?php if($isreview && $rating_hide!="true") { ?>
                                            <div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($reviewType); // show the rating ?></div>
                                        <?php } ?>
                                    
                                    </div>
                                    
                                    <br class="clearer" />
									
								</li>
                            <?php endwhile; 
                            endif; ?> 
                            <?php wp_reset_query(); ?>
                            <li class="last">&nbsp;</li>  
                        </ul>
                    </div>
                    
                <?php } ?>
                
                <?php if($showcomments) { ?>
            
                    <div id="tabs-comments" class="tabdiv">
                        <ul>
                        <?php //get recent comments
                        $args = array(
                            'status' => 'approve',
                            'number' => $numcomments
                        );	
						$postcount=0;
                        $comments = get_comments($args);
                        foreach($comments as $comment) :
							$postcount++;								
                            $commentcontent = strip_tags($comment->comment_content);			
                            if (mb_strlen($commentcontent)>110) {
                                $commentcontent = mb_substr($commentcontent, 0, 107) . "...";
                            }
                            $commentauthor = $comment->comment_author;
                            if (mb_strlen($commentauthor)>50) {
                                $commentauthor = mb_substr($commentauthor, 0, 47) . "...";			
                            }
                            $commentid = $comment->comment_ID;
                            $commenturl = get_comment_link($commentid); ?>
                            <li><a<?php if($postcount==1) { ?> class="first"<?php } ?> href="<?php echo $commenturl; ?>">"<?php echo $commentcontent; ?>"<span> -&nbsp;<?php echo $commentauthor; ?></span></a></li>
                        <?php endforeach; ?>
                        <li class="last">&nbsp;</li>  
                        </ul>
                    </div> 
                    
                <?php } ?>
                
                <?php if($showtags) { ?>
                
                    <div id="tabs-tags" class="tabdiv">
                    
                    	<?php //setup and display tag cloud
						$featuredid = get_tag_id($oswc_featured_tag);
						if($featuredid=='') $featuredid=0;
						$spotlightid = get_tag_id($oswc_spotlight_tags);
						if($spotlightid=='') $spotlightid=0;
						$trendingid = get_tag_id($oswc_trending_tag);
						if($trendingid=='') $trendingid=0;
						$latestid = get_tag_id($oswc_latest_tag);
						if($latestid=='') $latestid=0;
						$dontmissid = get_tag_id($oswc_dontmiss_tags);
						if($dontmissid=='') $dontmissid=0;
						$excludes=$featuredid.','.$spotlightid.','.$trendingid.','.$latestid.','.$dontmissid;
						//echo "excludes=".$excludes;
						if($ordertags=='count') { $order="DESC"; }
						$tagargs = array('smallest' => 8, 'largest' => 22, 'orderby' => $ordertags, 'order' => $order, 'number' => $numtags, 'exclude' => array($excludes));
						//as of 5/2012 the exclude parameter does not work
						wp_tag_cloud($tagargs); ?>
                        
                    </div>
                
                <?php } ?>
            
            </div>
                                     
        </div>
        
        <?php /* After widget (defined by themes). */
		echo $after_widget; ?>
        
    <?php
    }
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['thumbsize'] = strip_tags( $new_instance['thumbsize'] );
		$instance['showpopular'] = isset( $new_instance['showpopular'] );
		$instance['showrecent'] = isset( $new_instance['showrecent'] );
		$instance['showcomments'] = isset( $new_instance['showcomments'] );
		$instance['showtags'] = isset( $new_instance['showtags'] );
		$instance['numpopular'] = strip_tags( $new_instance['numpopular'] );
		$instance['numrecent'] = strip_tags( $new_instance['numrecent'] );
		$instance['numcomments'] = strip_tags( $new_instance['numcomments'] );
		$instance['numtags'] = strip_tags( $new_instance['numtags'] );
		$instance['ordertags'] = strip_tags( $new_instance['ordertags'] );

		return $instance;
	}
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'thumbsize' => 'widget-thumbnail', 'showpopular' => true, 'showrecent' => true, 'showcomments' => true, 'showtags' => true, 'numpopular' => 10, 'numrecent' => 10, 'numcomments' => 7, 'numtags' => 20, 'ordertags' => 'name' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <?php _e( 'Thumbnail Size:','made'); ?>&nbsp;&nbsp;&nbsp;&nbsp;             
            <input class="radio" type="radio" <?php if($instance['thumbsize']=='widget-thumbnail') { ?>checked <?php } ?>name="<?php echo $this->get_field_name( 'thumbsize' ); ?>" value="widget-thumbnail" />                
            <?php _e( 'Large','made'); ?>
            <input class="radio" type="radio" <?php if($instance['thumbsize']!='widget-thumbnail') { ?>checked <?php } ?>name="<?php echo $this->get_field_name( 'thumbsize' ); ?>" value="footer-thumbnail" />
            <?php _e( 'Small','made'); ?>              
        </p>
        
        <p>
			<input class="checkbox" type="checkbox" <?php checked(isset( $instance['showpopular']) ? $instance['showpopular'] : 0  ); ?> id="<?php echo $this->get_field_id( 'showpopular' ); ?>" name="<?php echo $this->get_field_name( 'showpopular' ); ?>" />
			<?php _e( 'Display','made'); ?>
            <input id="<?php echo $this->get_field_id( 'numpopular' ); ?>" name="<?php echo $this->get_field_name( 'numpopular' ); ?>" value="<?php echo $instance['numpopular']; ?>" style="width:30px" />
            <?php _e( 'popular posts','made'); ?>
		</p>
        
        <p>
			<input class="checkbox" type="checkbox" <?php checked(isset( $instance['showrecent']) ? $instance['showrecent'] : 0  ); ?> id="<?php echo $this->get_field_id( 'showrecent' ); ?>" name="<?php echo $this->get_field_name( 'showrecent' ); ?>" />
			<?php _e( 'Display','made'); ?>
            <input id="<?php echo $this->get_field_id( 'numrecent' ); ?>" name="<?php echo $this->get_field_name( 'numrecent' ); ?>" value="<?php echo $instance['numrecent']; ?>" style="width:30px" />
            <?php _e( 'recent posts','made'); ?>
		</p>
        
        <p>
			<input class="checkbox" type="checkbox" <?php checked(isset( $instance['showcomments']) ? $instance['showcomments'] : 0  ); ?> id="<?php echo $this->get_field_id( 'showcomments' ); ?>" name="<?php echo $this->get_field_name( 'showcomments' ); ?>" />
			<?php _e( 'Display','made'); ?>
            <input id="<?php echo $this->get_field_id( 'numcomments' ); ?>" name="<?php echo $this->get_field_name( 'numcomments' ); ?>" value="<?php echo $instance['numcomments']; ?>" style="width:30px" />
            <?php _e( 'comments','made'); ?>
		</p>
        
        <p>
			<input class="checkbox" type="checkbox" <?php checked(isset( $instance['showtags']) ? $instance['showtags'] : 0  ); ?> id="<?php echo $this->get_field_id( 'showtags' ); ?>" name="<?php echo $this->get_field_name( 'showtags' ); ?>" />
			<?php _e( 'Display','made'); ?>
            <input id="<?php echo $this->get_field_id( 'numtags' ); ?>" name="<?php echo $this->get_field_name( 'numtags' ); ?>" value="<?php echo $instance['numtags']; ?>" style="width:30px" />
            <?php _e( 'tags','made'); ?>
		</p>
        
        <p>
			<input class="radio" type="radio" <?php if($instance['ordertags']=='name') { ?>checked <?php } ?>name="<?php echo $this->get_field_name( 'ordertags' ); ?>" value="name" />
			<?php _e( 'Order tags by name','made'); ?><br />
            <input class="radio" type="radio" <?php if($instance['ordertags']=='count') { ?>checked <?php } ?>name="<?php echo $this->get_field_name( 'ordertags' ); ?>" value="count" />
			<?php _e( 'Order tags by post count','made'); ?>
		</p>
        
        <?php
	}
}
//TABBED ARCHIVES
class oswc_tabbed_archives extends WP_Widget {
	function oswc_tabbed_archives() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Extended: Page & Archive Tabs', 'description' => __( 'Displays pages, categories, and archives in a jQuery tabbed format','made') );
		/* Widget control settings. */
		$control_ops = array( 'width' => 320, 'height' => 350, 'id_base' => 'oswc_tabbed_archives' );
		/* Create the widget. */
		$this->WP_Widget( 'oswc_tabbed_archives', 'Extended: Page & Archive Tabs', $widget_ops, $control_ops );
	}	
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$showcategories = $instance['showcategories'];		
		$showpages = $instance['showpages'];
		$showarchives = $instance['showarchives'];
		$numarchives = $instance['numarchives'];
		$categorylevel = $instance['categorylevel'];
		$pagelevel = $instance['pagelevel'];
		$archivetype = $instance['archivetype'];

		/* HTML output */
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		?>
        	
        <div id="tabbed-archives" class="simple-list">
            <ul class="tabnav">
				<?php if($showcategories) { ?><li><a class="first" href="#tabs-categories"><?php _e('Categories','made'); ?></a></li><?php } ?>
                <?php if($showpages) { ?><li><a href="#tabs-pages"><?php _e('Pages','made'); ?></a></li><?php } ?>
                <?php if($showarchives) { ?><li><a href="#tabs-archives"><?php _e('Archives','made'); ?></a></li><?php } ?>
            </ul>
            <br class="clearer" />
            <div class="tabdiv-wrapper">
        
        		<?php if($showcategories) { ?>
                    
                    <div id="tabs-categories" class="tabdiv">
                        <ul>
                        	<?php if($categorylevel=="3") { ?>
                        		<?php wp_list_categories("title_li=&depth=0") ?>
                            <?php } elseif($categorylevel=="2") { ?>
                            	<?php wp_list_categories("title_li=&depth=2") ?>
                            <?php } else { ?>
                            	<?php wp_list_categories("title_li=&depth=1") ?>
                            <?php }	?>
                            <li class="last">&nbsp;</li>  
                        </ul>
                    </div>
                    
                <?php } ?>
                
                <?php if($showpages) { ?>
            
                    <div id="tabs-pages" class="tabdiv">
                        <ul>
                        	<?php if($pagelevel=="3") { ?>
                        		<?php wp_list_pages("title_li=&depth=0") ?>
                            <?php } elseif($categorylevel=="2") { ?>
                            	<?php wp_list_pages("title_li=&depth=2") ?>
                            <?php } else { ?>
                            	<?php wp_list_pages("title_li=&depth=1") ?>
                            <?php }	?>
                            <li class="last">&nbsp;</li>  
                        </ul>
                    </div>
                    
                <?php } ?>
                
                <?php if($showarchives) { ?>
            
                    <div id="tabs-archives" class="tabdiv">
                        <ul>
                        	<?php wp_get_archives("type=".$archivetype."&limit=".$numarchives); ?>
                            <li class="last">&nbsp;</li>  
                        </ul>
                    </div> 
                    
                <?php } ?>
            
            </div>
                                     
        </div>
        
        <?php /* After widget (defined by themes). */
		echo $after_widget; ?>
        
    <?php
    }
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['showcategories'] = isset( $new_instance['showcategories'] );
		$instance['showpages'] = isset( $new_instance['showpages'] );
		$instance['showarchives'] = isset( $new_instance['showarchives'] );
		$instance['numarchives'] = strip_tags( $new_instance['numarchives'] );
		$instance['categorylevel'] = strip_tags( $new_instance['categorylevel'] );
		$instance['pagelevel'] = strip_tags( $new_instance['pagelevel'] );
		$instance['archivetype'] = strip_tags( $new_instance['archivetype'] );

		return $instance;
	}
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'showcategories' => true, 'showpages' => true, 'showarchives' => true, 'numarchives' => 20, 'categorylevel' => 3, 'pagelevel' => 3, 'archivetype' => 'monthly' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
			<input class="checkbox" type="checkbox" <?php checked(isset( $instance['showcategories']) ? $instance['showcategories'] : 0  ); ?> id="<?php echo $this->get_field_id( 'showcategories' ); ?>" name="<?php echo $this->get_field_name( 'showcategories' ); ?>" />
			<?php _e( 'Display categories','made'); ?>
            <input id="<?php echo $this->get_field_id( 'categorylevel' ); ?>" name="<?php echo $this->get_field_name( 'categorylevel' ); ?>" value="<?php echo $instance['categorylevel']; ?>" style="width:20px" />
            <?php _e( 'levels deep','made'); ?>
		</p>
        
        <p>
			<input class="checkbox" type="checkbox" <?php checked(isset( $instance['showpages']) ? $instance['showpages'] : 0  ); ?> id="<?php echo $this->get_field_id( 'showpages' ); ?>" name="<?php echo $this->get_field_name( 'showpages' ); ?>" />
			<?php _e( 'Display pages','made'); ?>
            <input id="<?php echo $this->get_field_id( 'pagelevel' ); ?>" name="<?php echo $this->get_field_name( 'pagelevel' ); ?>" value="<?php echo $instance['pagelevel']; ?>" style="width:20px" />
            <?php _e( 'levels deep','made'); ?>
		</p>
        
        <p>
			<input class="checkbox" type="checkbox" <?php checked(isset( $instance['showarchives']) ? $instance['showarchives'] : 0  ); ?> id="<?php echo $this->get_field_id( 'showarchives' ); ?>" name="<?php echo $this->get_field_name( 'showarchives' ); ?>" />
			<?php _e( 'Display','made'); ?>
            <input id="<?php echo $this->get_field_id( 'numarchives' ); ?>" name="<?php echo $this->get_field_name( 'numarchives' ); ?>" value="<?php echo $instance['numarchives']; ?>" style="width:30px" />
            <?php _e( 'archives in','made'); ?>
            <select name="<?php echo $this->get_field_name( 'archivetype' ); ?>">
            	<option<?php if($instance['archivetype']=='yearly') { ?> selected<?php } ?>>yearly</option>
                <option<?php if($instance['archivetype']=='monthly') { ?> selected<?php } ?>>monthly</option>
                <option<?php if($instance['archivetype']=='weekly') { ?> selected<?php } ?>>weekly</option>
                <option<?php if($instance['archivetype']=='daily') { ?> selected<?php } ?>>daily</option>
            </select>
            <?php _e( 'format','made'); ?>
		</p>
        
        <p><em><?php _e( "Note: category and page lists are only styled up to 3 levels deep. You can display more than 3 levels of categories and pages if you want to, but anything deeper than the 3rd level will look as though it's part of the 3rd level itself. If you really do have more than 3 levels of categories, I salute you!","made"); ?></em></p>
        
        <?php
	}
}
//TABBED REVIEWS
if($typecount>0) {
	class oswc_tabbed_reviews extends WP_Widget {
		function oswc_tabbed_reviews() {
			/* Widget settings. */
			$widget_ops = array( 'classname' => 'Extended: Review Category Tabs', 'description' => __( 'Displays review categories in a jQuery tabbed format','made') );
			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'oswc_tabbed_reviews' );
			/* Create the widget. */
			$this->WP_Widget( 'oswc_tabbed_reviews', 'Extended: Review Category Tabs', $widget_ops, $control_ops );
		}	
		function widget( $args, $instance ) {
			global $oswcPostTypes;
			
			extract( $args );
	
			/* User-selected settings. */
			$reviewtype = $instance['reviewtype'];
			$showcategory1 = $instance['showcategory1'];
			$showcategory2 = $instance['showcategory2'];
			$showcategory3 = $instance['showcategory3'];
			$showcategory4 = $instance['showcategory4'];
			$numcategory1 = $instance['numcategory1'];		
			$numcategory2 = $instance['numcategory2'];
			$numcategory3 = $instance['numcategory3'];
			$numcategory4 = $instance['numcategory4'];
			$lvlcategory1 = $instance['lvlcategory1'];
			$lvlcategory2 = $instance['lvlcategory2'];
			$lvlcategory3 = $instance['lvlcategory3'];
			$lvlcategory4 = $instance['lvlcategory4'];
			
			$postType = $oswcPostTypes->get_type_by_name($reviewtype);
			//die("reviewtype=".$reviewtype);
			$posttypename=ucwords($postType->name);
			$reviewHideReviewVerbiage=$postType->hide_review_verbiage;	
			if(!$reviewHideReviewVerbiage) {
				$posttypename.= " Reviews";
			}
		
			$excerptTaxonomies = $postType->get_excerpt_taxonomies();
			$category1slug=$excerptTaxonomies[0]->id;
			$category1name=ucwords($excerptTaxonomies[0]->name);
			$category2slug=$excerptTaxonomies[1]->id;
			$category2name=ucwords($excerptTaxonomies[1]->name);
			$category3slug=$excerptTaxonomies[2]->id;
			$category3name=ucwords($excerptTaxonomies[2]->name);
			$category4slug=$excerptTaxonomies[3]->id;
			$category4name=ucwords($excerptTaxonomies[3]->name);
	
			/* HTML output */
			
			/* Before widget (defined by themes). */
			echo $before_widget;
			?>
            
            <div class="review-header"><?php echo $posttypename; ?><?php _e( ' by category', 'made' ); ?></div>
				
			<div id="tabbed-<?php echo $postType->id; ?>-reviews" class="simple-list review-cats">
                
				<ul class="tabnav">
					<?php if($showcategory1) { ?><li><a class="first" href="#tabs-<?php echo $category1slug; ?>"><?php echo $category1name; ?></a></li><?php } ?>
					<?php if($showcategory2) { ?><li><a href="#tabs-<?php echo $category2slug; ?>"><?php echo $category2name; ?></a></li><?php } ?>
					<?php if($showcategory3) { ?><li><a href="#tabs-<?php echo $category3slug; ?>"><?php echo $category3name; ?></a></li><?php } ?>
                    <?php if($showcategory4) { ?><li><a href="#tabs-<?php echo $category4slug; ?>"><?php echo $category4name; ?></a></li><?php } ?>
				</ul>
                <br class="clearer" />				
				<div class="tabdiv-wrapper">
			
					<?php if($showcategory1) { ?>
						
						<div id="tabs-<?php echo $category1slug; ?>" class="tabdiv">
							<ul>                            	
								<?php if($lvlcategory1=="3") { ?>
									<?php wp_list_categories("taxonomy=".$category1slug."&title_li=&depth=0&number=".$numcategory1) ?>
								<?php } elseif($lvlcategory1=="2") { ?>
									<?php wp_list_categories("taxonomy=".$category1slug."&title_li=&depth=2&number=".$numcategory1) ?>
								<?php } else { ?>
									<?php wp_list_categories("taxonomy=".$category1slug."&title_li=&depth=1&number=".$numcategory1) ?>
								<?php }	?> 
                                <li class="last">&nbsp;</li>                           
							</ul>
						</div>
						
					<?php } ?>
					
					<?php if($showcategory2) { ?>
				
						<div id="tabs-<?php echo $category2slug; ?>" class="tabdiv">
							<ul>
								<?php if($lvlcategory2=="3") { ?>
									<?php wp_list_categories("taxonomy=".$category2slug."&title_li=&depth=0&orderby=term_group&number=".$numcategory2) ?>
								<?php } elseif($lvlcategory2=="2") { ?>
									<?php wp_list_categories("taxonomy=".$category2slug."&title_li=&depth=2&orderby=term_group&number=".$numcategory2) ?>
								<?php } else { ?>
									<?php wp_list_categories("taxonomy=".$category2slug."&title_li=&depth=1&orderby=term_group&number=".$numcategory2) ?>
								<?php }	?> 
                                <li class="last">&nbsp;</li> 
							</ul>
						</div>
						
					<?php } ?>
					
					<?php if($showcategory3) { ?>
				
						<div id="tabs-<?php echo $category3slug; ?>" class="tabdiv">
							<ul>
								<?php if($lvlcategory3=="3") { ?>
									<?php wp_list_categories("taxonomy=".$category3slug."&title_li=&depth=0&number=".$numcategory3) ?>
								<?php } elseif($lvlcategory3=="2") { ?>
									<?php wp_list_categories("taxonomy=".$category3slug."&title_li=&depth=2&number=".$numcategory3) ?>
								<?php } else { ?>
									<?php wp_list_categories("taxonomy=".$category3slug."&title_li=&depth=1&number=".$numcategory3) ?>
								<?php }	?>
                                <li class="last">&nbsp;</li>  
							</ul>
						</div> 
						
					<?php } ?>
                    
                    <?php if($showcategory4) { ?>
				
						<div id="tabs-<?php echo $category4slug; ?>" class="tabdiv">
							<ul>
								<?php if($lvlcategory4=="3") { ?>
									<?php wp_list_categories("taxonomy=".$category4slug."&title_li=&depth=0&number=".$numcategory4) ?>
								<?php } elseif($lvlcategory4=="2") { ?>
									<?php wp_list_categories("taxonomy=".$category4slug."&title_li=&depth=2&number=".$numcategory4) ?>
								<?php } else { ?>
									<?php wp_list_categories("taxonomy=".$category4slug."&title_li=&depth=1&number=".$numcategory4) ?>
								<?php }	?>
                                <li class="last">&nbsp;</li>  
							</ul>
						</div> 
						
					<?php } ?>
				
				</div>
										 
			</div>
            
        	<?php /* After widget (defined by themes). */
			echo $after_widget; ?>
			
		<?php
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			
			$reviewtype = $instance['reviewtype'];
			$showcategory1 = $instance['showcategory1'];
			$showcategory2 = $instance['showcategory2'];
			$showcategory3 = $instance['showcategory3'];
			$showcategory4 = $instance['showcategory4'];
			$numcategory1 = $instance['numcategory1'];		
			$numcategory2 = $instance['numcategory2'];
			$numcategory3 = $instance['numcategory3'];
			$numcategory4 = $instance['numcategory4'];
			$lvlcategory1 = $instance['lvlcategory1'];
			$lvlcategory2 = $instance['lvlcategory2'];
			$lvlcategory3 = $instance['lvlcategory3'];
			$lvlcategory4 = $instance['lvlcategory4'];
	
			/* Strip tags (if needed) and update the widget settings. */
			$instance['reviewtype'] = strip_tags( $new_instance['reviewtype'] );
			$instance['showcategory1'] = isset( $new_instance['showcategory1'] );
			$instance['showcategory2'] = isset( $new_instance['showcategory2'] );
			$instance['showcategory3'] = isset( $new_instance['showcategory3'] );
			$instance['showcategory4'] = isset( $new_instance['showcategory4'] );
			$instance['numcategory1'] = strip_tags( $new_instance['numcategory1'] );		
			$instance['numcategory2'] = strip_tags( $new_instance['numcategory2'] );
			$instance['numcategory3'] = strip_tags( $new_instance['numcategory3'] );
			$instance['numcategory4'] = strip_tags( $new_instance['numcategory4'] );
			$instance['lvlcategory1'] = strip_tags( $new_instance['lvlcategory1'] );
			$instance['lvlcategory2'] = strip_tags( $new_instance['lvlcategory2'] );
			$instance['lvlcategory3'] = strip_tags( $new_instance['lvlcategory3'] );
			$instance['lvlcategory4'] = strip_tags( $new_instance['lvlcategory4'] );
	
			return $instance;
		}
		function form( $instance ) {
			
			//get theme options
			global $oswc_front, $oswc_layout, $oswc_feed, $oswc_reviews, $oswc_ads, $oswc_misc, $oswcPostTypes;
	
			/* Set up some default widget settings. */
			$defaults = array( 'reviewtype' => 'product', 'showcategory1' => true, 'showcategory2' => true, 'showcategory3' => true, 'showcategory4' => true, 'numcategory1' => 10, 'numcategory2' => 10, 'numcategory3' => 10, 'numcategory4' => 10, 'lvlcategory1' => 3, 'lvlcategory2' => 3, 'lvlcategory3' => 3, 'lvlcategory4' => 3 );
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			
			<p>
				<?php _e( 'Review Type:','made'); ?>
				<select name="<?php echo $this->get_field_name( 'reviewtype' ); ?>">
					<?php foreach($oswcPostTypes->postTypes as $postType){
						if($postType->enabled){?>
							<option<?php if($instance['reviewtype']==$postType->name) { ?> selected<?php } ?> value="<?php echo $postType->name; ?>"><?php echo ucwords($postType->name); ?></option>
						<?php }
					}?>
				</select>
			</p>
		
			<p>
				<input class="checkbox" type="checkbox" <?php checked(isset( $instance['showcategory1']) ? $instance['showcategory1'] : 0  ); ?> id="<?php echo $this->get_field_id( 'showcategory1' ); ?>" name="<?php echo $this->get_field_name( 'showcategory1' ); ?>" />
				<?php _e( 'Display','made'); ?>
				<input id="<?php echo $this->get_field_id( 'numcategory1' ); ?>" name="<?php echo $this->get_field_name( 'numcategory1' ); ?>" value="<?php echo $instance['numcategory1']; ?>" style="width:30px" />
				<?php _e( 'tab 1 items','made'); ?>
				<input id="<?php echo $this->get_field_id( 'lvlcategory1' ); ?>" name="<?php echo $this->get_field_name( 'lvlcategory1' ); ?>" value="<?php echo $instance['lvlcategory1']; ?>" style="width:20px" />
				<?php _e( 'levels deep','made'); ?>				
			</p>
			
			<p>
				<input class="checkbox" type="checkbox" <?php checked(isset( $instance['showcategory2']) ? $instance['showcategory2'] : 0  ); ?> id="<?php echo $this->get_field_id( 'showcategory2' ); ?>" name="<?php echo $this->get_field_name( 'showcategory2' ); ?>" />
				<?php _e( 'Display','made'); ?> 
				<input id="<?php echo $this->get_field_id( 'numcategory2' ); ?>" name="<?php echo $this->get_field_name( 'numcategory2' ); ?>" value="<?php echo $instance['numcategory2']; ?>" style="width:30px" />
				<?php _e( 'tab 2 items','made'); ?>
				<input id="<?php echo $this->get_field_id( 'lvlcategory2' ); ?>" name="<?php echo $this->get_field_name( 'lvlcategory2' ); ?>" value="<?php echo $instance['lvlcategory2']; ?>" style="width:20px" />
				<?php _e( 'levels deep','made'); ?>
			</p>
			
			<p>
				<input class="checkbox" type="checkbox" <?php checked(isset( $instance['showcategory3']) ? $instance['showcategory3'] : 0  ); ?> id="<?php echo $this->get_field_id( 'showcategory3' ); ?>" name="<?php echo $this->get_field_name( 'showcategory3' ); ?>" />
				<?php _e( 'Display','made'); ?>
				<input id="<?php echo $this->get_field_id( 'numcategory3' ); ?>" name="<?php echo $this->get_field_name( 'numcategory3' ); ?>" value="<?php echo $instance['numcategory3']; ?>" style="width:30px" />
				<?php _e( 'tab 3 items','made'); ?>
				<input id="<?php echo $this->get_field_id( 'lvlcategory3' ); ?>" name="<?php echo $this->get_field_name( 'lvlcategory3' ); ?>" value="<?php echo $instance['lvlcategory3']; ?>" style="width:20px" />
				<?php _e( 'levels deep','made'); ?>
			</p>
            
            <p>
				<input class="checkbox" type="checkbox" <?php checked(isset( $instance['showcategory4']) ? $instance['showcategory4'] : 0  ); ?> id="<?php echo $this->get_field_id( 'showcategory4' ); ?>" name="<?php echo $this->get_field_name( 'showcategory4' ); ?>" />
				<?php _e( 'Display','made'); ?>
				<input id="<?php echo $this->get_field_id( 'numcategory4' ); ?>" name="<?php echo $this->get_field_name( 'numcategory4' ); ?>" value="<?php echo $instance['numcategory4']; ?>" style="width:30px" />
				<?php _e( 'tab 4 items','made'); ?>
				<input id="<?php echo $this->get_field_id( 'lvlcategory4' ); ?>" name="<?php echo $this->get_field_name( 'lvlcategory4' ); ?>" value="<?php echo $instance['lvlcategory4']; ?>" style="width:20px" />
				<?php _e( 'levels deep','made'); ?>
			</p>
			
			<?php
		}
	}
}
//TABBED LATEST REVIEWS
if($typecount>0) {
	class oswc_tabbed_latest_reviews extends WP_Widget {
		function oswc_tabbed_latest_reviews() {
			/* Widget settings. */
			$widget_ops = array( 'classname' => 'Extended: Latest Review Tabs', 'description' => __( 'Displays recent reviews in a jQuery tabbed format with either large or small thumbnails','made') );
			/* Widget control settings. */
			$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'oswc_tabbed_latest_reviews' );
			/* Create the widget. */
			$this->WP_Widget( 'oswc_tabbed_latest_reviews', 'Extended: Latest Review Tabs', $widget_ops, $control_ops );
		}	
		function widget( $args, $instance ) {
			global $oswc_misc, $oswcPostTypes;
			$oswc_skin = $oswc_misc['skin'];
			
			//check to see if we are on a review type page
			$reviewPage = false;
			$post_id = $GLOBALS['post']->ID;
			$postTypeName = oswc_get_review_meta($post_id);
			$postTypeId = get_post_type($post_id); //setup the posttypeid object, which is used below to determine which post type we're on
			//review listing page
			if(!empty($postTypeName) && ($oswcPostTypes->has_type($postTypeName) || $oswcPostTypes->has_type(strtolower($postTypeName)))){
				$reviewPage = true;
				$reviewType = $oswcPostTypes->get_type_by_name($postTypeName); //get the review type object
				$reviewSkin = $reviewType->skin; //get the review skin
				if($reviewSkin=="dark") $oswc_skin="dark";
				if($reviewSkin=="light") $oswc_skin="";
			}
			//review taxonomy page
			if(is_tax()) {
				$reviewPage = true;
				$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);
				$reviewSkin = $reviewType->skin; //get the review skin
				if($reviewSkin=="dark") $oswc_skin="dark";
				if($reviewSkin=="light") $oswc_skin="";
			}
			//single review page
			if (is_single() && $oswcPostTypes->has_type($postTypeId, true)) {
				$reviewPage = true;
				$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);
				$reviewSkin = $reviewType->skin; //get the review skin
				if($reviewSkin=="dark") $oswc_skin="dark";
				if($reviewSkin=="light") $oswc_skin="";
			}
			
			extract( $args );
	
			/* User-selected settings. */
			$thumbsize = $instance['thumbsize'];
			$show = array();
			$num = array();
			foreach($oswcPostTypes->postTypes as $postType){
				$show[$postType->id] = $instance['show' . $postType->id];
				$num[$postType->id] = $instance['num' . $postType->id];
			}
				
			/* HTML output */
			
			/* Before widget (defined by themes). */
			echo $before_widget;
			?>
				
			<div id="tabbed-reviews" class="complex-list<?php if($thumbsize=="footer-thumbnail") { ?> small<?php } ?>">
				<ul class="tabnav">
					<?php $count=0;
					foreach($oswcPostTypes->postTypes as $postType){
						$count++;
						if($show[$postType->id]){?>
							<li><a<?php if($count==1) { ?> class="first"<?php } ?> href="#tabs-<?php echo $postType->id; ?>-<?php echo $sort; ?>"><?php echo ucwords($postType->name); ?></a></li>
						<?php }
					}?>
				</ul>
                <br class="clearer" />
				<div class="tabdiv-wrapper">
				<?php foreach($oswcPostTypes->postTypes as $postType){ 
					if($show[$postType->id]){ ?>
					<div id="tabs-<?php echo $postType->id; ?>-<?php echo $sort; ?>" class="tabdiv">
						<ul>
	                    	<?php // setup the query
							$args='&suppress_filters=true&posts_per_page='.$num[$postType->id].'&post_type=' . $postType->id . '&order=DESC&orderby=date';								
							//echo "<!-- args=$args -->";
							$cust_loop = new WP_Query($args); 
							$postcount=0;
							if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
								// if we're sorting by rating and this item does not have a rating, hide it
								$rating = get_post_meta(get_the_ID(), "Rating", $single = true); 
								$postType = get_post_type(); //get post type
								$reviewType = $oswcPostTypes->get_type_by_id($postType); //get review type object		
								$icon = $reviewType->icon;
								$icon_light = $reviewType->icon_light;
								if($oswc_skin=="dark") $icon=$icon_light;	
								if(!isset($icon)){
									$icon = get_template_directory_uri() . '/images/more-grey.png';
								}
								//show rating?
								$rating_hide = get_post_meta(get_the_ID(), "Hide Rating", $single = true); 
								//check if this is a video post
								$isvideo=false;
								$video = get_post_meta(get_the_ID(), "Video", $single = true);
								if($video!="") $isvideo=true;
								?>
								<li>									
									
									<div class="floatleft">
								
										<a href="<?php the_permalink(); ?>" class="thumbnail darken<?php if($isvideo) { ?> video<?php } ?> small" title="<?php the_title(); ?>"><?php the_post_thumbnail($thumbsize, array( 'title'=> '' )); ?></a>				 
									</div>
									
									<div class="floatleft">
									
										<a class="post-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> 
                                        
                                        <br class="clearer" />
                                        
                                        <div class="icon">
						
                                            <img alt="icon" src="<?php echo $icon; ?>" width="16" height="16" />
                                        
                                        </div>
                                      
                                        <?php if($rating_hide!="true") { ?>
											<div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($reviewType); // show the rating ?></div>
                                        <?php } ?>
									
									</div>
									
									<br class="clearer" /> 
									
								</li>
	                            
	                        <?php endwhile; 
	    					endif; 
							wp_reset_query(); ?> 
	                        
	                        <li class="more" title="<?php _e('View all from','made'); ?>&nbsp;<?php echo $reviewType->name; ?>"><a href="<?php echo $reviewType->more_link; ?>"><?php _e( 'More','made'); ?></a></li>
                            <li class="last">&nbsp;</li>
	   
						</ul>
					</div>
				<?php }//end if show
					}//end foreach ?>
				</div>
			</div>
            
            <?php /* After widget (defined by themes). */
			echo $after_widget; ?>
			
		<?php
		}
		function update( $new_instance, $old_instance ) {
			global $oswcPostTypes;
			$instance = $old_instance;
			
			$thumbsize = $instance['thumbsize'];
			$show = array();
			$num = array();
			foreach($oswcPostTypes->postTypes as $postType){
				$show[$postType->id] = $instance['show' . $postType->id];
				$num[$postType->id] = $instance['num' . $postType->id];
			}
	
			/* Strip tags (if needed) and update the widget settings. */
			$instance['thumbsize'] = strip_tags( $new_instance['thumbsize'] );
			foreach($oswcPostTypes->postTypes as $postType){
				$instance['show' . $postType->id] = isset( $new_instance['show' . $postType->id]);
				$instance['num' . $postType->id] =  strip_tags( $new_instance['num' . $postType->id]);
			}

			return $instance;
		}
		function form( $instance ) {
			//get theme options
			global $oswc_front, $oswc_layout, $oswc_feed, $oswc_reviews, $oswc_ads, $oswc_misc, $oswcPostTypes;
		
			/* Set up some default widget settings. */
			$typecount = 0;
			$defaults = array( 'thumbsize' => 'widget-thumbnail' );
			foreach($oswcPostTypes->postTypes as $postType){
				if($postType->enabled){
					$typecount++;

					if($typecount < 5){
						$defaults['show' . $postType->id] = true;
						$defaults['num' . $postType->id] = 10;
					}
				}else{
					$defaults['show' . $postType->id] = false;
				}
			}

			$instance = wp_parse_args( (array) $instance, $defaults ); ?>
            
            <p>
            	<?php _e( 'Thumbnail Size:','made'); ?>&nbsp;&nbsp;&nbsp;&nbsp;             
                <input class="radio" type="radio" <?php if($instance['thumbsize']=='widget-thumbnail') { ?>checked <?php } ?>name="<?php echo $this->get_field_name( 'thumbsize' ); ?>" value="widget-thumbnail" />                
                <?php _e( 'Large','made'); ?>
                <input class="radio" type="radio" <?php if($instance['thumbsize']!='widget-thumbnail') { ?>checked <?php } ?>name="<?php echo $this->get_field_name( 'thumbsize' ); ?>" value="footer-thumbnail" />
                <?php _e( 'Small','made'); ?>               
            </p>

            <?php
            foreach($oswcPostTypes->postTypes as $postType){
            	if($postType->enabled) { ?>
	                <p>
	                    <input class="checkbox" type="checkbox" <?php checked(isset( $instance['show' . $postType->id]) ? $instance['show' . $postType->id] : 0  ); ?> id="<?php echo $this->get_field_id( 'show' . $postType->id ); ?>" name="<?php echo $this->get_field_name( 'show' . $postType->id ); ?>" />
	                    <?php _e( 'Display','made'); ?>
	                    <input id="<?php echo $this->get_field_id( 'num' . $postType->id ); ?>" name="<?php echo $this->get_field_name( 'num' . $postType->id ); ?>" value="<?php echo $instance['num' . $postType->id]; ?>" style="width:30px" />
	                    <?php echo $postType->name ?> <?php _e( 'reviews','made'); ?>                   
	                    
	                </p>
            <?php
            	}
            }?>
            
			
			<?php
		}
	}
}
//TABBED LATEST REVIEWS - COMPACT
if($typecount>0) {
	class oswc_tabbed_latest_reviews_compact extends WP_Widget {
		function oswc_tabbed_latest_reviews_compact() {
			/* Widget settings. */
			$widget_ops = array( 'classname' => 'Extended: Latest Review Tabs Compact', 'description' => __( 'Displays recent reviews in a jQuery tabbed format without thumbnails in a more compact fashion so you can fit more on the page at once.','made') );
			/* Widget control settings. */
			$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'oswc_tabbed_latest_reviews_compact' );
			/* Create the widget. */
			$this->WP_Widget( 'oswc_tabbed_latest_reviews_compact', 'Extended: Latest Review Tabs Compact', $widget_ops, $control_ops );
		}	
		function widget( $args, $instance ) {
			global $oswcPostTypes;
			extract( $args );
	
			/* User-selected settings. */
			$show = array();
			$num = array();
			foreach($oswcPostTypes->postTypes as $postType){
				$show[$postType->id] = $instance['show' . $postType->id];
				$num[$postType->id] = $instance['num' . $postType->id];
			}
				
			/* HTML output */
			
			/* Before widget (defined by themes). */
			echo $before_widget;
			?>
				
			<div id="tabbed-reviews-compact" class="complex-list compact">
				<ul class="tabnav">
					<?php $count=0;
					foreach($oswcPostTypes->postTypes as $postType){
						$count++;
						if($show[$postType->id]){?>
							<li><a<?php if($count==1) { ?> class="first"<?php } ?> href="#tabs-compact-<?php echo $postType->id; ?>-<?php echo $sort; ?>"><?php echo ucwords($postType->name); ?></a></li>
						<?php }
					}?>
				</ul>
                <br class="clearer" />
				<div class="tabdiv-wrapper">
				<?php foreach($oswcPostTypes->postTypes as $postType){ 
					if($show[$postType->id]){ ?>
					<div id="tabs-compact-<?php echo $postType->id; ?>-<?php echo $sort; ?>" class="tabdiv">
						<ul>
	                    	<?php // setup the query
							$args='&suppress_filters=true&posts_per_page='.$num[$postType->id].'&post_type=' . $postType->id . '&order=DESC&orderby=date';								
							//echo "<!-- args=$args -->";
							$cust_loop = new WP_Query($args); 
							$postcount=0;
							if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
								// if we're sorting by rating and this item does not have a rating, hide it
								$rating = get_post_meta(get_the_ID(), "Rating", $single = true); 
								$postType = get_post_type(); //get post type
								$reviewType = $oswcPostTypes->get_type_by_id($postType); //get review type object		
								//show rating?
								$rating_hide = get_post_meta(get_the_ID(), "Hide Rating", $single = true); 
								//check if this is a video post
								$isvideo=false;
								$video = get_post_meta(get_the_ID(), "Video", $single = true);
								if($video!="") $isvideo=true;
								?>
								<li>
                                    
									<?php if($rating_hide!="true") { ?>
                                        <div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($reviewType); // show the rating ?></div>
                                    <?php } ?>
                                
                                    <a class="post-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> 
                                       
									<br class="clearer" /> 
									
								</li>
	                            
	                        <?php endwhile; 
	    					endif; 
							wp_reset_query(); ?> 
	                        
	                        <li class="more" title="<?php _e('View all from','made'); ?>&nbsp;<?php echo $reviewType->name; ?>"><a href="<?php echo $reviewType->more_link; ?>"><?php _e( 'More','made'); ?></a></li>
                            <li class="last">&nbsp;</li>
	   
						</ul>
					</div>
				<?php }//end if show
					}//end foreach ?>
				</div>
			</div>
            
            <?php /* After widget (defined by themes). */
			echo $after_widget; ?>
			
		<?php
		}
		function update( $new_instance, $old_instance ) {
			global $oswcPostTypes;
			$instance = $old_instance;
	
			$show = array();
			$num = array();
			foreach($oswcPostTypes->postTypes as $postType){
				$show[$postType->id] = $instance['show' . $postType->id];
				$num[$postType->id] = $instance['num' . $postType->id];
			}
	
			/* Strip tags (if needed) and update the widget settings. */
			foreach($oswcPostTypes->postTypes as $postType){
				$instance['show' . $postType->id] = isset( $new_instance['show' . $postType->id]);
				$instance['num' . $postType->id] =  strip_tags( $new_instance['num' . $postType->id]);
			}

			return $instance;
		}
		function form( $instance ) {
			//get theme options
			global $oswc_front, $oswc_layout, $oswc_feed, $oswc_reviews, $oswc_ads, $oswc_misc, $oswcPostTypes;
		
			/* Set up some default widget settings. */
			$typecount = 0;
			$defaults = array( );
			foreach($oswcPostTypes->postTypes as $postType){
				if($postType->enabled){
					$typecount++;

					if($typecount < 5){
						$defaults['show' . $postType->id] = true;
						$defaults['num' . $postType->id] = 10;
					}
				}else{
					$defaults['show' . $postType->id] = false;
				}
			}

			$instance = wp_parse_args( (array) $instance, $defaults ); ?>

            <?php
            foreach($oswcPostTypes->postTypes as $postType){
            	if($postType->enabled) { ?>
	                <p>
	                    <input class="checkbox" type="checkbox" <?php checked(isset( $instance['show' . $postType->id]) ? $instance['show' . $postType->id] : 0  ); ?> id="<?php echo $this->get_field_id( 'show' . $postType->id ); ?>" name="<?php echo $this->get_field_name( 'show' . $postType->id ); ?>" />
	                    <?php _e( 'Display','made'); ?>
	                    <input id="<?php echo $this->get_field_id( 'num' . $postType->id ); ?>" name="<?php echo $this->get_field_name( 'num' . $postType->id ); ?>" value="<?php echo $instance['num' . $postType->id]; ?>" style="width:30px" />
	                    <?php echo $postType->name ?> <?php _e( 'reviews','made'); ?>                   
	                    
	                </p>
            <?php
            	}
            }?>
            
			
			<?php
		}
	}
}
//NON-TABBED LATEST REVIEWS
if($typecount>0) {
	class oswc_latest_reviews extends WP_Widget {
		function oswc_latest_reviews() {
			/* Widget settings. */
			$widget_ops = array( 'classname' => 'Extended: Latest Reviews', 'description' => __( 'Displays recent reviews from a single review type. Add multiple widgets for each review type','made') );
			/* Widget control settings. */
			$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'oswc_latest_reviews' );
			/* Create the widget. */
			$this->WP_Widget( 'oswc_latest_reviews', 'Extended: Latest Reviews', $widget_ops, $control_ops );
		}	
		function widget( $args, $instance ) {
			global $oswc_front, $oswc_layout, $oswc_feed, $oswc_reviews, $oswc_ads, $oswc_misc, $oswcPostTypes;
			$oswc_skin = $oswc_misc['skin'];
			
			//check to see if we are on a review type page
			$reviewPage = false;
			$post_id = $GLOBALS['post']->ID;
			$postTypeName = oswc_get_review_meta($post_id);
			$postTypeId = get_post_type($post_id); //setup the posttypeid object, which is used below to determine which post type we're on
			//review listing page
			if(!empty($postTypeName) && ($oswcPostTypes->has_type($postTypeName) || $oswcPostTypes->has_type(strtolower($postTypeName)))){
				$reviewPage = true;
				$reviewType = $oswcPostTypes->get_type_by_name($postTypeName); //get the review type object
				$reviewSkin = $reviewType->skin; //get the review skin
				if($reviewSkin=="dark") $oswc_skin="dark";
				if($reviewSkin=="light") $oswc_skin="";
			}
			//review taxonomy page
			if(is_tax()) {
				$reviewPage = true;
				$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);
				$reviewSkin = $reviewType->skin; //get the review skin
				if($reviewSkin=="dark") $oswc_skin="dark";
				if($reviewSkin=="light") $oswc_skin="";
			}
			//single review page
			if (is_single() && $oswcPostTypes->has_type($postTypeId, true)) {
				$reviewPage = true;
				$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);
				$reviewSkin = $reviewType->skin; //get the review skin
				if($reviewSkin=="dark") $oswc_skin="dark";
				if($reviewSkin=="light") $oswc_skin="";
			}

			extract( $args );
	
			/* User-selected settings. */
			$title = apply_filters('widget_title', $instance['title'] );	
			$thumbsize = $instance['thumbsize'];
			$reviewtype = $instance['reviewtype'];
			$numreviews = $instance['numreviews'];
			?>
            
            <?php $postType = $oswcPostTypes->get_type_by_id($reviewtype); 
			if($reviewtype=="All Reviews") { 
				$cssclass="all_reviews"; 
			} else {
				$cssclass=$reviewtype;
			}
			?>
            
            <div class="complex-list <?php echo $cssclass; ?><?php if($thumbsize=="footer-thumbnail") { ?> small<?php } ?>">
            
            	<?php
			
				/* Before widget (defined by themes). */
				echo $before_widget;
		
				/* Title of widget (before and after defined by themes). */
				if ( $title ) { ?>                	
					<?php echo $before_title; ?>

						<?php echo $title; ?>
                        
					<?php echo $after_title; ?>
				<?php } 
				
				/* HTML output */
				?>
	
				<ul>
                                    
					<?php 
					// get array of review types
					$arrTypes = array();
		            foreach($oswcPostTypes->postTypes as $postType){
		            	if($postType->enabled) {
			                 array_push($arrTypes, $postType->id);						             
		            	}
		            }
					
					// setup the query
					if($reviewtype=="All Reviews") {
						$args=array('suppress_filters' => true, 'posts_per_page' => $numreviews, 'order' => 'DESC', 'order_by' => 'date', 'post_type' => $arrTypes);
					} else {
						$args=array('suppress_filters' => true, 'posts_per_page' => $numreviews, 'order' => 'DESC', 'order_by' => 'date', 'post_type' => $reviewtype);
					}
					$cust_loop = new WP_Query($args); 
					if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
						$postType = get_post_type(); //get post type
						$reviewType = $oswcPostTypes->get_type_by_id($postType); //get review type object
						$icon = $reviewType->icon;
						$icon_light = $reviewType->icon_light;	
						if($oswc_skin=="dark") $icon=$icon_light;	
						if(!isset($icon)){
							$icon = get_template_directory_uri() . '/images/more-grey.png';
						}
						//show rating?
						$rating_hide = get_post_meta(get_the_ID(), "Hide Rating", $single = true); 
						//check if this is a video post
						$isvideo=false;
						$video = get_post_meta(get_the_ID(), "Video", $single = true);
						if($video!="") $isvideo=true;	
						?>
						<li<?php if($postcount==1) { ?> class="first"<?php } ?>>
							
							<div class="floatleft">
						
								<a href="<?php the_permalink(); ?>" class="thumbnail darken<?php if($isvideo) { ?> video<?php } ?> small" title="<?php the_title(); ?>"><?php the_post_thumbnail($thumbsize, array( 'title'=> '' )); ?></a>				 
							</div>
							
							<div class="floatleft">
							
								<a class="post-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> 
                                
                                <br class="clearer" />
                                
                                <div class="icon">
						
                                    <img alt="icon" src="<?php echo $icon; ?>" width="16" height="16" />
                                
                                </div>
								
								<?php if($rating_hide!="true") { ?>
                                	<div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($reviewType); // show the rating ?></div>
                                <?php } ?>
							
							</div>
							
							<br class="clearer" /> 												
							
						</li>
						
					<?php endwhile; 
					endif; 
					wp_reset_query(); ?> 
                    
                    <li class="last">&nbsp;</li> <!-- easiest way to hide the last border - i know, it's hacky -->
		
				</ul> 
				
				<?php /* After widget (defined by themes). */
				echo $after_widget; ?>
            
            </div>
			
		<?php
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			
			$title = apply_filters('widget_title', $instance['title'] );
			$thumbsize = $instance['thumbsize'];
			$reviewtype = $instance['reviewtype'];
			$numreviews = $instance['numreviews'];	
	
			/* Strip tags (if needed) and update the widget settings. */
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['thumbsize'] = strip_tags( $new_instance['thumbsize'] );
			$instance['reviewtype'] = strip_tags( $new_instance['reviewtype'] );
			$instance['numreviews'] = strip_tags( $new_instance['numreviews'] );
	
			return $instance;
		}
		function form( $instance ) {
			
			//get theme options
			global $oswc_front, $oswc_layout, $oswc_feed, $oswc_reviews, $oswc_ads, $oswc_misc, $oswcPostTypes;

			/* Set up some default widget settings. */
			$typecount = 0;
			$defaults = array();
			foreach($oswcPostTypes->postTypes as $postType){
				if($postType->enabled){
					$typecount++;

					if($typecount < 5){
						$defaults['show' . $postType->id] = true;
						$defaults['num' . $postType->id] = 4;
					}
				}else{
					$defaults['show' . $postType->id] = false;
				}
			}

			/* Set up some default widget settings. */
			$defaults = array( 'thumbsize' => 'widget-thumbnail', 'title' => 'Latest Reviews', 'reviewtype' => 'product', 'numreviews' => 4 );
			$instance = wp_parse_args( (array) $instance, $defaults ); ?>
            
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','made'); ?></label>
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:160px" />
            </p>
            
            <p>
				<?php _e( 'Review Type:','made'); ?>
				<select name="<?php echo $this->get_field_name( 'reviewtype' ); ?>">
                	<option<?php if($instance['reviewtype']=='All Reviews') { ?> selected<?php } ?> value="<?php _e( 'All Reviews', 'made' ); ?>"><?php _e( 'All Reviews', 'made' ); ?></option>
		            <?php 
		            foreach($oswcPostTypes->postTypes as $postType){
		            	if($postType->enabled) { ?>
			                <option<?php if($instance['reviewtype']==$postType->id) { ?> selected<?php } ?> value="<?php echo $postType->id ?>"><?php echo $postType->name; ?></option>
		            <?php
		            	}
		            }?>
				</select>
			</p>
            
            <p>
            	<?php _e( 'Thumbnail Size:','made'); ?>&nbsp;&nbsp;&nbsp;&nbsp;             
                <input class="radio" type="radio" <?php if($instance['thumbsize']=='widget-thumbnail') { ?>checked <?php } ?>name="<?php echo $this->get_field_name( 'thumbsize' ); ?>" value="widget-thumbnail" />                
                <?php _e( 'Large','made'); ?>
                <input class="radio" type="radio" <?php if($instance['thumbsize']!='widget-thumbnail') { ?>checked <?php } ?>name="<?php echo $this->get_field_name( 'thumbsize' ); ?>" value="footer-thumbnail" />
                <?php _e( 'Small','made'); ?>               
            </p>	
		
            <p>                
                <?php _e( 'Display','made'); ?>
                <input id="<?php echo $this->get_field_id( 'numreviews' ); ?>" name="<?php echo $this->get_field_name( 'numreviews' ); ?>" value="<?php echo $instance['numreviews']; ?>" style="width:30px" />  
                <?php _e( 'reviews','made'); ?>
            </p>
			
			<?php
		}
	}
}
//UNWRAPPED TEXT
class oswc_unwrapped extends WP_Widget {
	function oswc_unwrapped() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Extended: Unwrapped Text', 'description' => __( 'Displays arbritrary text of HTML just like the standard Text widget, but this one does not include the header bar and wrapper style - just a blank canvas for content','made') );
		/* Widget control settings. */
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'oswc_unwrapped' );
		/* Create the widget. */
		$this->WP_Widget( 'oswc_unwrapped', 'Extended: Unwrapped Text', $widget_ops, $control_ops );
	}	
	function widget( $args, $instance ) {
		//get theme options
		global $oswc_front, $oswc_layout, $oswc_feed, $oswc_reviews, $oswc_ads, $oswc_misc, $oswcPostTypes;
		
		extract( $args );
		
		$text = $instance['text'];	
		
		/* show the widget content without any headers or wrappers */
		echo '<div class="unwrapped">'.do_shortcode($text).'</div>';	
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['text'] = $new_instance['text'];

		return $instance;
	}
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'text' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','made'); ?></label><br />
            <textarea rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
		</p>
        
        <?php
	}
}

//AD 125
class oswc_ad_125 extends WP_Widget {
	function oswc_ad_125() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Extended: Ad Block', 'description' => __( 'Insert your adsense or HTML code for four 125px-wide ads that will display in a 2 x 2 panel (if this widget is put into a footer panel, the maximum width of the ads is 90px instead of 125px)','made') );
		/* Widget control settings. */
		$control_ops = array( 'width' => 450, 'height' => 350, 'id_base' => 'oswc_ad_125' );
		/* Create the widget. */
		$this->WP_Widget( 'oswc_ad_125', 'Extended: Ad Block', $widget_ops, $control_ops );
	}	
	function widget( $args, $instance ) {
		//get theme options
		global $oswc_front, $oswc_layout, $oswc_feed, $oswc_reviews, $oswc_ads, $oswc_misc, $oswcPostTypes;
		
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$ad1 = $instance['ad1'];	
		$ad2 = $instance['ad2'];
		$ad3 = $instance['ad3'];	
		$ad4 = $instance['ad4'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		
		/* Title of widget (before and after defined by themes). */
		if ( $title ) { ?>                	
			<?php echo $before_title; ?>
				<?php echo $title; ?>
			<?php echo $after_title; ?>
		<?php } 
		
		echo '<div class="ad">'.$ad1.'</div>';	
		echo '<div class="ad right">'.$ad2.'</div><br class="clearer" />';	
		echo '<div class="ad">'.$ad3.'</div>';	
		echo '<div class="ad right">'.$ad4.'</div><br class="clearer" /><br />';	

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ad1'] = $new_instance['ad1'];
		$instance['ad2'] = $new_instance['ad2'];
		$instance['ad3'] = $new_instance['ad3'];
		$instance['ad4'] = $new_instance['ad4'];
		
		return $instance;
	}
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'ad1' => '', 'ad2' => '', 'ad3' => '', 'ad4' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','made'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:160px" />
            <p><em><?php _e( 'Leave the title blank to hide the entire title bar.','made'); ?></em></p>
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'ad1' ); ?>"><?php _e( 'Ad 1 HTML:','made'); ?></label><br />
            <textarea rows="5" cols="80" id="<?php echo $this->get_field_id( 'ad1' ); ?>" name="<?php echo $this->get_field_name( 'ad1' ); ?>"><?php echo $instance['ad1']; ?></textarea>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'ad2' ); ?>"><?php _e( 'Ad 2 HTML:','made'); ?></label><br />
            <textarea rows="5" cols="80" id="<?php echo $this->get_field_id( 'ad2' ); ?>" name="<?php echo $this->get_field_name( 'ad2' ); ?>"><?php echo $instance['ad2']; ?></textarea>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'ad3' ); ?>"><?php _e( 'Ad 3 HTML:','made'); ?></label><br />
            <textarea rows="5" cols="80" id="<?php echo $this->get_field_id( 'ad3' ); ?>" name="<?php echo $this->get_field_name( 'ad3' ); ?>"><?php echo $instance['ad3']; ?></textarea>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'ad4' ); ?>"><?php _e( 'Ad 4 HTML:','made'); ?></label><br />
            <textarea rows="5" cols="80" id="<?php echo $this->get_field_id( 'ad4' ); ?>" name="<?php echo $this->get_field_name( 'ad4' ); ?>"><?php echo $instance['ad4']; ?></textarea>
		</p>
        
        <p><em><?php _e( 'Tip: you can add as many of these widgets as you want in order to create multiple ad panels on top of each other. Also, the width crops at 125px but the height does not crop, so you can use images of any height.','made'); ?></em></p>        
        <?php
	}
}

//EMAIL SUBSCRIBE
class oswc_email_subscribe extends WP_Widget {
	function oswc_email_subscribe() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Extended: Email Subscribe', 'description' => __( 'Displays a form for users to subscribe to your Feedburner feed via email','made') );
		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'oswc_email_subscribe' );
		/* Create the widget. */
		$this->WP_Widget( 'oswc_email_subscribe', 'Extended: Email Subscribe', $widget_ops, $control_ops );
	}	
	function widget( $args, $instance ) {
		//get theme options
		global $oswc_front, $oswc_layout, $oswc_feed, $oswc_reviews, $oswc_ads, $oswc_misc, $oswcPostTypes;		
		$oswc_feedburner = $oswc_misc['feedburner'];
					
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$label = $instance['label'];
			
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title ) { ?>
			<?php echo $before_title; ?>
                <?php echo $title; ?><span class="feedburner">&nbsp;</span>
            <?php echo $after_title; ?>
        <?php } ?>
        
        <div class="signup">

			<?php echo $label; ?>
                        
            <form id="feedburner_subscribe" class="subscribe" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $oswc_feedburner; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
                
                <div class="email-wrapper">
                    <input type="text" name="email"/>
                    <input type="hidden" value="<?php echo $oswc_feedburner; ?>" name="uri"/>
                    <input type="hidden" name="loc" value="en_US"/>
                </div>
                    
                <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/signup.png" class="btn" title="<?php _e('You will receive a daily email with new content from our website.','made'); ?>" onclick="document.feedburner_subscribe.submit();" />
                
        	</form>
            
            <br class="clearer" />
            
        </div>
        
		<?php /* After widget (defined by themes). */
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['label'] = strip_tags( $new_instance['label'] );
	
		return $instance;
	}
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Subscribe Via Email', 'feedburner' => '', 'label' => 'Enter your email address' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','made'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:200px" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'label' ); ?>"><?php _e( 'Textbox Label:','made'); ?></label>
			<input id="<?php echo $this->get_field_id( 'label' ); ?>" name="<?php echo $this->get_field_name( 'label' ); ?>" value="<?php echo $instance['label']; ?>" style="width:200px" />
		</p>
        
        <?php
	}
}

//LOGIN FORM
class oswc_login_form extends WP_Widget {
	function oswc_login_form() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Extended: Login Form', 'description' => __( 'Displays a login form so your users can login directly from a widget panel','made') );
		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'oswc_login_form' );
		/* Create the widget. */
		$this->WP_Widget( 'oswc_login_form', 'Extended: Login Form', $widget_ops, $control_ops );
	}	
	function widget( $args, $instance ) {
						
		extract( $args );
		
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
			
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title ) { ?>
			<?php echo $before_title; ?>
                <?php echo $title; ?>
            <?php echo $after_title; ?>
        <?php } ?>
        
        <div class="login-form">

            <?php if (is_user_logged_in() ) {
				
				wp_loginout();
				
			} else {
				
				wp_login_form( $args ); 
				
			} ?>
            
        </div>
        
		<?php /* After widget (defined by themes). */
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
	
		return $instance;
	}
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Login' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','made'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:200px" />
		</p>
        
        <?php
	}
}

?>