<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page' );
}

/*-----------------------------------------------------------------------------------*/
/* Subscribe / Connect */
/*-----------------------------------------------------------------------------------*/

if (!function_exists( 'woo_subscribe_connect')) {
	function woo_subscribe_connect($widget = 'false', $title = '', $form = '', $social = '' ) {
		$df_options = get_theme_mod( 'df_options' );

		//Setup default variables, overriding them if the "Theme Options" have been saved.
		$settings = array(
						'connect' => 'false',
						'connect_title' => __('Subscribe' , 'woothemes'),
						'connect_related' => 'true',
						'connect_content' => __( 'Subscribe to our e-mail newsletter to receive updates.', 'woothemes' ),
						'connect_newsletter_id' => '',
						'connect_mailchimp_list_url' => '',
						'feed_url' => ''
						);
		$settings = woo_get_dynamic_values( $settings );

		// Setup title
		if ( $widget != 'true' )
			$title = $settings[ 'connect_title' ];

		// Setup related post (not in widget)
		$related_posts = '';
		if ( $settings[ 'connect_related' ] == "true" AND $widget != "true" )
			$related_posts = do_shortcode( '[related_posts limit="5"]' );

?>
	<?php if ( $settings[ 'connect' ] == "true" OR $widget == 'true' ) : ?>
	<div id="connect" >
		<h3><?php if ( $title ) echo stripslashes( $title ); else _e('Subscribe','woothemes'); ?></h3>

		<div <?php if ( $related_posts != '' ) echo 'class="col-left"'; ?>>
			<p><?php if ( $settings['connect_content'] != '') echo stripslashes( $settings['connect_content'] ); else _e('Subscribe to our e-mail newsletter to receive updates.', 'woothemes'); ?></p>

			<?php if ( $settings[ 'connect_newsletter_id' ] != "" AND $form != 'on' ) : ?>
			<form class="newsletter-form<?php if ( $related_posts == '' ) echo ' fl'; ?>" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open( 'http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $settings[ 'connect_newsletter_id' ]; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520' );return true">
				<input class="email" type="text" name="email" value="<?php esc_attr_e( 'E-mail', 'woothemes' ); ?>" onfocus="if (this.value == '<?php _e( 'E-mail', 'woothemes' ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'E-mail', 'woothemes' ); ?>';}" />
				<input type="hidden" value="<?php echo $settings[ 'connect_newsletter_id' ]; ?>" name="uri"/>
				<input type="hidden" value="<?php bloginfo( 'name' ); ?>" name="title"/>
				<input type="hidden" name="loc" value="en_US"/>
				<input class="submit button" type="submit" name="submit" value="<?php _e( 'GO', 'woothemes' ); ?>" />
			</form>
			<?php endif; ?>

			<?php if ( $settings['connect_mailchimp_list_url'] != "" AND $form != 'on' AND $settings['connect_newsletter_id'] == "" ) : ?>
			<!-- Begin MailChimp Signup Form -->
			<div id="mc_embed_signup">
				<form class="newsletter-form<?php if ( $related_posts == '' ) echo ' fl'; ?>" action="<?php echo $settings['connect_mailchimp_list_url']; ?>" method="post" target="popupwindow" onsubmit="window.open('<?php echo $settings['connect_mailchimp_list_url']; ?>', 'popupwindow', 'scrollbars=yes,width=650,height=520');return true">
					<input type="text" name="EMAIL" class="required email" value="<?php _e('E-mail','woothemes'); ?>"  id="mce-EMAIL" onfocus="if (this.value == '<?php _e('E-mail','woothemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('E-mail','woothemes'); ?>';}">
					<input type="submit" value="<?php _e('GO', 'woothemes'); ?>" name="subscribe" id="mc-embedded-subscribe" class="btn submit button">
				</form>
			</div>
			<!--End mc_embed_signup-->
			<?php endif; ?>

			<?php if ( $social != 'on' ) : ?>
			<div class="social<?php if ( $related_posts == '' AND $settings['connect_newsletter_id' ] != "" ) echo ' fr'; ?>">
		   		<?php if ( $df_options['connect_rss' ] == "true" ) { ?>
		   		<a href="<?php if ( $settings['feed_url'] ) { echo esc_url( $settings['feed_url'] ); } else { echo get_bloginfo_rss('rss2_url'); } ?>" class="fa fa-rss" title="RSS"></a>

		   		<?php } if ( $df_options['connect_twitter' ] != "" ) { ?>
		   		<a href="<?php echo esc_url( $df_options['connect_twitter'] ); ?>" class="fa fa-twitter" title="Twitter"></a>

		   		<?php } if ( $df_options['connect_facebook' ] != "" ) { ?>
		   		<a href="<?php echo esc_url( $df_options['connect_facebook'] ); ?>" class="fa fa-facebook" title="Facebook"></a>

		   		<?php } if ( $df_options['connect_youtube' ] != "" ) { ?>
		   		 <a href="<?php echo esc_url( $df_options['connect_youtube'] ); ?>" class="fa fa-youtube" title="YouTube"></a>

		   		<?php } if ( $df_options['connect_flickr' ] != "" ) { ?>
		   		 <a href="<?php echo esc_url( $df_options['connect_flickr'] ); ?>" class="fa fa-flickr" title="Flickr"></a>

		   		<?php } if ( $df_options['connect_linkedin' ] != "" ) { ?>
		   		<a href="<?php echo esc_url( $df_options['connect_linkedin'] ); ?>" class="fa fa-linkedin" title="LinkedIn"></a>

		   		<?php } if ( $df_options['connect_pinterest' ] != "" ) { ?>
		   		<a href="<?php echo esc_url( $df_options['connect_pinterest'] ); ?>" class="fa fa-pinterest" title="Pinterest"></a>

		   		<?php } if ( $df_options['connect_googleplus' ] != "" ) { ?>
		   		<a href="<?php echo esc_url( $df_options['connect_googleplus'] ); ?>" class="fa fa-google-plus" title="Google+"></a>

		   		<?php } if ( $df_options['connect_instagram' ] != "" ) { ?>
		   		 <a href="<?php echo esc_url( $df_options['connect_instagram'] ); ?>" class="fa fa-instagram" title="Instagram"></a>

				<?php } ?>
			</div>
			<?php endif; ?>

		</div><!-- col-left -->

		<?php if ( $settings['connect_related' ] == "true" AND $related_posts != '' ) : ?>
		<div class="related-posts col-right">
			<h4><?php _e( 'Related Posts:', 'woothemes' ); ?></h4>
			<?php echo $related_posts; ?>
		</div><!-- col-right -->
		<?php wp_reset_query(); endif; ?>

    <div class="fix"></div>
	</div>
	<?php endif; ?>
<?php
	}
}


/*-----------------------------------------------------------------------------------*/
/* Add Google Maps to HEAD */
/*-----------------------------------------------------------------------------------*/

add_action( 'woo_head', 'woo_google_maps', 10 ); // Add custom styling to HEAD

if ( ! function_exists( 'woo_google_maps' ) ) {
	function woo_google_maps() {
		if ( is_page_template( 'template-contact.php' ) ) {
			$maps_url = 'http://maps.google.com/maps/api/js?sensor=false';
			if ( is_ssl() ) $maps_url = str_replace( 'http://', 'https://', $maps_url );
		?>
			<script type="text/javascript" src="<?php echo esc_url( $maps_url ); ?>"></script>
		<?php
		}
	} // End woo_google_maps()
}

/*-----------------------------------------------------------------------------------*/
/* Google Maps */
/*-----------------------------------------------------------------------------------*/

function woo_maps_contact_output($args){

	$key = get_option('woo_maps_apikey');

	// No More API Key needed

	if ( !is_array($args) )
		parse_str( $args, $args );

	extract($args);
	$mode = '';
	$streetview = 'off';
	$map_height = get_option('woo_maps_single_height');
	$featured_w = get_option('woo_home_featured_w');
	$featured_h = get_option('woo_home_featured_h');
	$zoom = get_option('woo_maps_default_mapzoom');
	$type = get_option('woo_maps_default_maptype');
	$marker_title = get_option('woo_contact_title');
	if ( $zoom == '' ) { $zoom = 6; }
	$lang = get_option('woo_maps_directions_locale');
	$locale = '';
	if(!empty($lang)){
		$locale = ',locale :"'.$lang.'"';
	}
	$extra_params = ',{travelMode:G_TRAVEL_MODE_WALKING,avoidHighways:true '.$locale.'}';

	if(empty($map_height)) { $map_height = 250;}

	if(is_home() && !empty($featured_h) && !empty($featured_w)){
	?>
    <div id="single_map_canvas" style="width:<?php echo intval( $featured_w ); ?>px; height: <?php echo intval( $featured_h ); ?>px"></div>
    <?php } else { ?>
    <div id="single_map_canvas" style="width:100%; height: <?php echo $map_height; ?>px"></div>
    <?php } ?>
    <script src="<?php echo esc_attr( esc_url( get_template_directory_uri() . '/includes/assets/js/markers.js' ) ); ?>" type="text/javascript"></script>
    <script type="text/javascript">
		jQuery(document).ready(function(){
			function initialize() {


			<?php if($streetview == 'on'){ ?>


			<?php } else { ?>

			  	<?php switch ($type) {
			  			case 'G_NORMAL_MAP':
			  				$type = 'ROADMAP';
			  				break;
			  			case 'G_SATELLITE_MAP':
			  				$type = 'SATELLITE';
			  				break;
			  			case 'G_HYBRID_MAP':
			  				$type = 'HYBRID';
			  				break;
			  			case 'G_PHYSICAL_MAP':
			  				$type = 'TERRAIN';
			  				break;
			  			default:
			  				$type = 'ROADMAP';
			  				break;
			  	} ?>

			  	var myLatlng = new google.maps.LatLng(<?php echo $geocoords; ?>);
				var myOptions = {
				  zoom: <?php echo $zoom; ?>,
				  center: myLatlng,
				<?php if(get_option('woo_maps_scroll') == 'true'){ ?>
				  scrollwheel: false,
			  	<?php } ?>
				  mapTypeId: google.maps.MapTypeId.<?php echo $type; ?>
				};
			  	var map = new google.maps.Map(document.getElementById( 'single_map_canvas' ),  myOptions);

				<?php if($mode == 'directions'){ ?>
			  	directionsPanel = document.getElementById("featured-route");
 				directions = new GDirections(map, directionsPanel);
  				directions.load("from: <?php echo esc_js( $from ); ?> to: <?php echo esc_js( $to ); ?>" <?php if($walking == 'on'){ echo $extra_params;} ?>);
			  	<?php
			 	} else { ?>

			  		var point = new google.maps.LatLng(<?php echo $geocoords; ?>);
	  				var root = "<?php echo esc_js( esc_url( get_template_directory_uri() ) ); ?>";
	  				var callout = '<?php echo preg_replace("/[\n\r]/","<br/>",get_option('woo_maps_callout_text')); ?>';
	  				var the_link = '<?php echo get_permalink(get_the_id()); ?>';
	  				<?php $title = str_replace(array('&#8220;','&#8221;'),'"', $marker_title); ?>
	  				<?php $title = str_replace('&#8211;','-',$title); ?>
	  				<?php $title = str_replace('&#8217;',"`",$title); ?>
	  				<?php $title = str_replace('&#038;','&',$title); ?>
	  				var the_title = '<?php echo html_entity_decode($title) ?>';

	  			<?php
			 	if(is_page()){
			 		$custom = get_option('woo_cat_custom_marker_pages');
					if(!empty($custom)){
						$color = $custom;
					}
					else {
						$color = get_option('woo_cat_colors_pages');
						if (empty($color)) {
							$color = 'red';
						}
					}
			 	?>
			 		var color = '<?php echo $color; ?>';
			 		createMarker(map,point,root,the_link,the_title,color,callout);
			 	<?php } else { ?>
			 		var color = '<?php echo get_option('woo_cat_colors_pages'); ?>';
	  				createMarker(map,point,root,the_link,the_title,color,callout);
				<?php
				}
					if(isset($_POST['woo_maps_directions_search'])){ ?>

					directionsPanel = document.getElementById("featured-route");
 					directions = new GDirections(map, directionsPanel);
  					directions.load("from: <?php echo htmlspecialchars($_POST['woo_maps_directions_search']); ?> to: <?php echo $address; ?>" <?php if($walking == 'on'){ echo $extra_params;} ?>);



					directionsDisplay = new google.maps.DirectionsRenderer();
					directionsDisplay.setMap(map);
    				directionsDisplay.setPanel(document.getElementById("featured-route"));

					<?php if($walking == 'on'){ ?>
					var travelmodesetting = google.maps.DirectionsTravelMode.WALKING;
					<?php } else { ?>
					var travelmodesetting = google.maps.DirectionsTravelMode.DRIVING;
					<?php } ?>
					var start = '<?php echo htmlspecialchars($_POST['woo_maps_directions_search']); ?>';
					var end = '<?php echo $address; ?>';
					var request = {
       					origin:start,
        				destination:end,
        				travelMode: travelmodesetting
    				};
    				directionsService.route(request, function(response, status) {
      					if (status == google.maps.DirectionsStatus.OK) {
        					directionsDisplay.setDirections(response);
      					}
      				});

  					<?php } ?>
				<?php } ?>
			<?php } ?>


			  }
			  function handleNoFlash(errorCode) {
				  if (errorCode == FLASH_UNAVAILABLE) {
					alert("Error: Flash doesn't appear to be supported by your browser");
					return;
				  }
				 }



		initialize();

		});
	jQuery(window).load(function(){

		var newHeight = jQuery('#featured-content').height();
		newHeight = newHeight - 5;
		if(newHeight > 300){
			jQuery('#single_map_canvas').height(newHeight);
		}

	});

	</script>

<?php
}



/*-----------------------------------------------------------------------------------*/
/*	Add Twitter, Facebook and Google URL links to User Profile.
/*-----------------------------------------------------------------------------------*/
	add_filter('user_contactmethods', 'woo_fnc_contact_methods');

	function woo_fnc_contact_methods($user_contactmethods)
	{
	  	$user_contactmethods['twitter'] = 'Twitter URL';
	  	$user_contactmethods['facebook'] = 'Facebook URL';
	  	$user_contactmethods['google'] = 'Google URL';
	  	$user_contactmethods['pin'] = 'Pinterest URL';
	  	$user_contactmethods['linkdn'] = 'Linkdn URL';

		// $user_contactmethods['photo'] = 'Photo URL';

		return $user_contactmethods;
	}
/*-----------------------------------------------------------------------------------*/
/* woo_feedburner_link() */
/*-----------------------------------------------------------------------------------*/
/**
 * woo_feedburner_link()
 *
 * Replace the default RSS feed link with the Feedburner URL, if one
 * has been provided by the user.
 *
 * @package WooFramework
 * @subpackage Filters
 */

add_filter( 'feed_link', 'woo_feedburner_link', 10 );

if ( ! function_exists( 'woo_feedburner_link' ) ) {
	function woo_feedburner_link ( $output, $feed = null ) {
		global $woo_options;

		$default = get_default_feed();

		if ( ! $feed ) $feed = $default;

		if ( isset( $woo_options['woo_feed_url'] ) && $woo_options['woo_feed_url'] && ( $feed == $default ) && ( ! stristr( $output, 'comments' ) ) ) $output = $woo_options['woo_feed_url'];

		return esc_url( $output );
	} // End woo_feedburner_link()
}

/*-----------------------------------------------------------------------------------*/
/* Subscribe & Connect  */
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_head', 'woo_subscribe_connect_action', 10 );			// Subscribe & Connect

if ( ! function_exists( 'woo_subscribe_connect_action' ) ) {
function woo_subscribe_connect_action() {
	if ( is_single() && get_option( 'woo_connect' ) == 'true' ) { add_action('woo_post_inside_after', 'woo_subscribe_connect'); }
} // End woo_subscribe_connect_action()
}

