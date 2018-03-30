<?php
/*
 * Admin Setup for Stylico Theme
 *
*/

//define capability for the admin
if ( !defined('STYLICO_ADMIN_CAPABILITY') )
    define( 'STYLICO_ADMIN_CAPABILITY', 'manage_options' );

global $stylico_theme_options;


//delete_option('stylico_theme_options');
if (isset($_GET['activated']) && is_admin()){
    //the theme has just been activated, set CHMOD of the timthumb cache and temp folder
	chmod(TEMPLATEPATH  .'/inc/cache/', 0777);
	chmod(TEMPLATEPATH  .'/inc/temp/', 0777);
	
	
	//when theme gets actiavted, check if options already exists, if not create them
	if( !get_option('stylico_theme_options') ) {
		
		$stylico_default_general = array( 'logo' => get_template_directory_uri(). '/images/logo.png',
		                                  'logo_top' => 25,
		                                  'facebook_url' => '#',
										  'twitter_url' => '#',
										  'mail_address' => get_bloginfo('admin_email'),
										  'footer_text' => 'Your footer text',
										  'page_404' => -1
		                                );
										
										
		$stylico_default_mainpage = array( 'widget_left_url' => '#',
		                                   'widget_center_url' => '#',
										   'widget_right_url' => '#',
										   'widget_left_button_text' => 'Left Button Text',
		                                   'widget_center_button_text' => 'Center Button Text',
									       'widget_right_button_text' => 'Right Button Text',
										   'bottom_page' => -1
		                                );
										
		$stylico_default_slider = array( 'animation' => 'fade',
		                                 'caption_animation' => 'fade',
										 'animation_speed' => 600,
										 'caption_animation_speed' => 600,
										 'advance_speed' => 4000,
										 'timer' => 0,
										 'pause_hover' => 1,
										 'clock_mouseout' => 1
		                                );
		
		$stylico_default_gigs = array( 'website_link_title' => 'Visit Event Website',
									   'image_link_title' => 'View Flyer',
									   'only_upcoming' => 1
		                             );
	    
		$stylico_default_releases = array( 'link_button_text' => 'Buy Now',
									       'play_button_text' => 'Play Now'
		                                 );
		
		$stylico_theme_options = array( 'general' => $stylico_default_general,
		                                'mainpage' => $stylico_default_mainpage,
										'slider' => $stylico_default_slider,
										'gigs' => $stylico_default_gigs,
										'releases' => $stylico_default_releases
		                                );
											
		add_option('stylico_theme_options', $stylico_theme_options );
	}
}

add_action( 'admin_init', 'stylico_admin_init' );
add_action( 'admin_menu', 'stylico_theme_options_page' );

add_action( 'add_meta_boxes', 'add_stylico_meta_boxes' );
add_action( 'save_post', 'update_stylico_custom_fields' );
add_action( 'manage_posts_custom_column', 'posts_custom_column', 10, 2 );

//custom column for gigs screen
add_filter( 'manage_gig_posts_columns', 'gigs_custom_columns' );
add_filter( 'manage_edit-gig_sortable_columns', 'gig_date_column_register_sortable' );
add_filter( 'request', 'gig_date_column_orderby' );

//custom column for releases screen
add_filter( 'manage_release_posts_columns', 'releases_custom_columns' );

//custom column for releases screen
add_filter( 'manage_stylico-slide_posts_columns', 'slider_custom_columns' );


function stylico_admin_init() {
	
	//get post type for enqueue some scripts and styles for the custom post type
	global $pagenow, $typenow;
	if (empty($typenow) && !empty($_GET['post'])) {
		$post = get_post($_GET['post']);
		$typenow = $post->post_type;
	}
	
	if ( is_admin() && ($pagenow=='post-new.php' OR $pagenow=='post.php') ) {
		
		if($typenow=='gig') {
			wp_enqueue_style( 'jquery-ui-datepicker' );
			wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_script('stylico-admin-gigs', get_template_directory_uri() . '/admin/js/gigs.js');
			
			add_filter( 'admin_post_thumbnail_html', 'change_gig_featured_thumbnail_title' );
			add_filter( 'manage_posts_columns', 'scompt_custom_columns' );
		}
		
		if($typenow=='release') {
			wp_enqueue_script('stylico-admin-releases', get_template_directory_uri() . '/admin/js/releases.js');
			
			add_filter( 'admin_post_thumbnail_html', 'change_release_featured_thumbnail_title' );
			add_filter( 'manage_posts_columns', 'scompt_custom_columns' );
		}
		
		if($typenow=='stylico-slide') {		
			add_filter( 'admin_post_thumbnail_html', 'change_slider_featured_thumbnail_title' );
		}
		
	}
}



function stylico_theme_options_page() {
	
    $options_page = add_theme_page( 'Stylico Theme Options', 'Theme Options', STYLICO_ADMIN_CAPABILITY, 'stylico-theme-options', 'create_stylico_theme_options_page' );
	add_action( "load-{$options_page}", 'stylico_load_options_page' );
	
	add_action('admin_print_styles-' . $options_page, 'enqueue_stylico_options_styles' );
    add_action('admin_print_scripts-' . $options_page, 'enqueue_stylico_options_scripts' );
	
}

function stylico_load_options_page() {
	
	if ( isset($_POST["save_stylico_options"]) ) {
		check_admin_referer( "stylico-options-page" );
		stylico_save_theme_options();
		$url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
		wp_redirect(admin_url('themes.php?page=stylico-theme-options&'.$url_parameters));
		exit;
	}
	
}

function stylico_save_theme_options() {
	
	global $pagenow;
	
	if ( $pagenow == 'themes.php' && $_GET['page'] == 'stylico-theme-options' ){ 
		if ( isset ( $_GET['tab'] ) )
	        $tab = $_GET['tab']; 
	    else
	        $tab = 'general'; 

	    switch ( $tab ){ 
	        case 'general' :
			    
				$tab_options = array( 'logo' => $_POST['general_logo'],
									  'logo_top' => $_POST['general_logo_top'],
									  'facebook_url' => $_POST['general_facebook'],
									  'twitter_url' => $_POST['general_twitter'],
									  'mail_address' => $_POST['general_mail_address'],
									  'footer_text' => $_POST['general_footer_text'],
									  'page_404' => $_POST['general_page_404']
									);
			break; 
	        case 'mainpage' : 
			    $tab_options = array( 'widget_left_url' => $_POST['mainpage_widget_left_url'],
									  'widget_center_url' => $_POST['mainpage_widget_center_url'],
									  'widget_right_url' => $_POST['mainpage_widget_right_url'],
									  'widget_left_button_text' => $_POST['mainpage_widget_left_button_text'],
									  'widget_center_button_text' => $_POST['mainpage_widget_center_button_text'],
									  'widget_right_button_text' => $_POST['mainpage_widget_right_button_text'],
									  'bottom_page' => $_POST['mainpage_bottom_page']
								    );
			break;
			case 'slider' :
				$tab_options = array( 'animation' => $_POST['orbit_slider_animation'],
									  'caption_animation' => $_POST['orbit_slider_caption_animation'],
									  'animation_speed' => $_POST['orbit_slider_animation_speed'],
									  'caption_animation_speed' => $_POST['orbit_slider_caption_animation_speed'],
									  'advance_speed' => $_POST['orbit_slider_advance_speed'],
									  'timer' => $_POST['orbit_slider_timer'],
									  'pause_hover' => $_POST['orbit_slider_pause_hover'],
									  'clock_mouseout' => $_POST['orbit_slider_clock_mouseout']
									);
			break;
			case 'gigs' : 
				$tab_options = array( 'website_link_title' => $_POST['gigs_website_link_title'],
									  'image_link_title' => $_POST['gigs_image_link_title'],
									  'only_upcoming' => $_POST['gigs_only_upcoming']
									);
			break;
			case 'releases' : 
				$tab_options = array( 'link_button_text' => $_POST['releases_link_button_text'],
									  'play_button_text' => $_POST['releases_play_button_text']
									);
			break;
	    }
	}
    
	//update options associated to the selected tab
	$options = get_option( "stylico_theme_options" );
	$options[$tab] = $tab_options;
	update_option( 'stylico_theme_options', $options );
	
}

function stylico_admin_tabs( $current = 'homepage' ) { 

    $tabs = array( 'general' => 'General', 'mainpage' => 'Mainpage', 'slider' => 'Slider', 'gigs' => 'Gigs', 'releases' => 'Releases', 'support' => 'Support' ); 
	
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=stylico-theme-options&tab=$tab'>$name</a>";
        
    }
    echo '</h2>';
	
}

function create_stylico_theme_options_page() {
	
	global $pagenow, $stylico_theme_options;
	
	$stylico_theme_options = get_option('stylico_theme_options');
	
	$stylico_general_options = $stylico_theme_options['general'];
	$stylico_mainpage_options = $stylico_theme_options['mainpage'];
	$stylico_slider_options = $stylico_theme_options['slider'];
	$stylico_gigs_options = $stylico_theme_options['gigs'];
	$stylico_releases_options = $stylico_theme_options['releases'];
	
	?>
	
	<div class="wrap">
		<h2>Stylico Theme Options</h2>
        <div><a href="http://radykal.de/themeforest/stylico_wp/getting-started/" target="_blank">&rarr; <?php _e('Documentation', 'stylico'); ?></a></div>
		
		<?php
		    //get tab
		    if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab']; 
					else $tab = 'general';
			
			stylico_admin_tabs($tab);		
					
		    
			if ( 'true' == esc_attr( $_GET['updated'] ) ) echo '<div class="updated" ><p>'.ucfirst($tab).' Options updated.</p></div>';
		?>

		<div id="tab-content">
			<form method="post" action="<?php admin_url( 'themes.php?page=stylico-theme-options' ); ?>">
				<?php
				 wp_nonce_field( "stylico-options-page" );
				if ( $pagenow == 'themes.php' && $_GET['page'] == 'stylico-theme-options' ){ 
					//include correspodning options page
					include_once(TEMPLATEPATH  .'/admin/'.$tab.'.php');
				}
				
				if($tab != 'support') :
				?>
                <p class="description"><?php _e('Always save before switching to another tab!', 'stylico'); ?></p>
				<p style="clear: both;"><input type="submit" name="save_stylico_options" class="button-primary" value="<?php _e('Save Changes', 'stylico'); ?>" <?php disabled( !current_user_can('manage_options') ); ?> /></p>
                <?php endif; ?>
                <br />
                <p><?php _e('Check out <a href="http://dj-templates.com" target="_blank">dj-templates.com</a> for more items for Djs and Producers.', 'stylico'); ?>
                Follow me at <a href="http://www.facebook.com/pages/dj-templatescom/163102803744768" target="_blank">Facebook</a> or <a href="http://twitter.com/#!/djtemplates" target="_blank">Twitter</a> for new products, updates and news!
                
                </p>
			</form>
		</div>
	</div>
<?php
	
}



function enqueue_stylico_options_styles() {
	
	wp_enqueue_style( 'jquery-uniform-aristo', STYLICO_ADMIN_URI . " /css/uniform.aristo.css" );
	wp_enqueue_style( 'stylico-theme-options', STYLICO_ADMIN_URI . " /css/theme-options.css", array('thickbox') );
	
}

function enqueue_stylico_options_scripts() {
	
	wp_enqueue_script( 'jquery-uniform', STYLICO_ADMIN_URI . " /js/jquery.uniform.min.js" );
	wp_enqueue_script( 'stylico-theme-options', STYLICO_ADMIN_URI . " /js/theme-options.js", array('media-upload', 'thickbox') );
}



function add_stylico_meta_boxes() {
			
	//create a meta boxes for gigs
	add_meta_box( 'stylico-gig-date-meta', __('Gig Date', 'stylico'), 'create_stylico_gig_date_meta_box', 'gig', 'side' );
	add_meta_box( 'stylico-gig-website-meta', __('Gig Website', 'stylico'), 'create_stylico_gig_website_meta_box', 'gig', 'side' );
	add_meta_box( 'stylico-gig-address-meta', __('Gig Address', 'stylico'), 'create_stylico_gig_address_meta_box', 'gig', 'side' );
	
	//create a meta boxes for releases
	add_meta_box( 'stylico-release-mp3-meta', __('Upload MP3', 'stylico'), 'create_stylico_release_mp3_meta_box', 'release', 'side' );
	add_meta_box( 'stylico-release-download-meta', __('Download Link', 'stylico'), 'create_stylico_release_download_meta_box', 'release', 'side' );
	
	//create a meta boxes for releases
	add_meta_box( 'stylico-slider-url-meta', __('Slide URL', 'stylico'), 'create_stylico_slider_url_meta_box', 'stylico-slide', 'side' );
	
}

function create_stylico_gig_date_meta_box() {
	
	global $post;
	$custom_fields = get_post_custom($post->ID);
	$gig_date = $custom_fields["gig_date"][0];
	?>
    <label for="gig_date" class="description"><?php _e('Select a date for your gig (Required)', 'stylico'); ?></label>
    <p><input type="text" id="gig-datepicker" name="gig_date" style="width: 100%" value="<?php echo $gig_date; ?>" /></p>
    <?php
	
}

function create_stylico_gig_website_meta_box() {
	
	global $post;
	$custom_fields = get_post_custom($post->ID);
	$gig_website = $custom_fields["gig_website"][0];
	?>
    <label for="gig_website" class="description"><?php _e('Set a gig website (Optional)', 'stylico'); ?></label>
    <p><input type="text" name="gig_website" style="width: 100%" value="<?php echo $gig_website; ?>" /></p>
    <?php
	
}

function create_stylico_gig_address_meta_box() {
	
	global $post;
	$custom_fields = get_post_custom($post->ID);
	$gig_address = $custom_fields["gig_address"][0];
	?>
    <label for="gig_address" class="description"><?php _e('Set the gig address (Optional)', 'stylico'); ?></label>
    <p><input type="text" name="gig_address" style="width: 100%" value="<?php echo $gig_address; ?>" /></p>
    <?php
	
}

function create_stylico_release_mp3_meta_box() {
	
	global $post;
	$custom_fields = get_post_custom($post->ID);
	$release_mp3 = $custom_fields["release_mp3"][0];
	?>
    <a href="#" id="mp3-upload"><?php _e('Set a MP3 for your release (Optional)', 'stylico'); ?></a>
    <p><input type="text" name="release_mp3" id="release_mp3_link" style="width: 100%" value="<?php echo $release_mp3; ?>" /></p>
    <?php
	
}

function create_stylico_release_download_meta_box() {
	
	global $post;
	$custom_fields = get_post_custom($post->ID);
	$release_download = $custom_fields["release_download"][0];
	?>
    <label for="release_download" class="description"><?php _e('Set the release download link (Optional)', 'stylico'); ?></label>
    <p><input type="text" name="release_download" style="width: 100%" value="<?php echo $release_download; ?>" /></p>
    <?php
	
}

function create_stylico_slider_url_meta_box() {
	
	global $post;
	$custom_fields = get_post_custom($post->ID);
	$slide_url = $custom_fields["slide_url"][0];
	?>
    <label for="slide_url" class="description"><?php _e('Set a URL for the slide (Optional)', 'stylico'); ?></label>
    <p><input type="text" name="slide_url" style="width: 100%" value="<?php echo $slide_url; ?>" /></p>
    <?php
	
}

function update_stylico_custom_fields(){
	
	//disable autosave,so custom fields will not be empty
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
        return $post_id;
	
	global $post;
	update_post_meta($post->ID, "gig_date", $_POST["gig_date"]);
	update_post_meta($post->ID, "gig_website", $_POST["gig_website"]);
	update_post_meta($post->ID, "gig_address", $_POST["gig_address"]);
	update_post_meta($post->ID, "release_mp3", $_POST["release_mp3"]);
	update_post_meta($post->ID, "release_download", $_POST["release_download"]);
	update_post_meta($post->ID, "slide_url", $_POST["slide_url"]);
	
}

//change Featured Image Title for the custom post types
function change_gig_featured_thumbnail_title( $content ) {
	return $content = str_replace( __( 'Set featured image', 'stylico' ), __( 'Set gig image (e.g. Flyer)', 'stylico' ), $content);
}

function change_release_featured_thumbnail_title( $content ) {
	return $content = str_replace( __( 'Set featured image', 'stylico' ), __( 'Set release image (e.g. LP Cover)', 'stylico' ), $content);
}

function change_slider_featured_thumbnail_title( $content ) {
	return $content = str_replace( __( 'Set featured image', 'stylico' ), __( 'Set slide image', 'stylico' ), $content);
}

//add gig date column in the middle
function gigs_custom_columns( $defaults ) {
	
	unset($defaults['date']);
    $defaults['gig_date'] = __('Gig Date', 'stylico');
	$defaults['date'] = __('Date', 'stylico');
    return $defaults;
	
}

//make gig date column sortable
function gig_date_column_register_sortable( $columns ) {
	
	$columns['gig_date'] = 'gig_date';
	return $columns;
	
}

//order gig date really by date
function gig_date_column_orderby( $vars ) {
	
	if ( isset( $vars['orderby'] ) && 'gig_date' == $vars['orderby'] ) {
		$vars = array_merge( $vars, array(
			'meta_key' => 'gig_date',
			'orderby' => 'meta_value'
		) );
	}
 
	return $vars;
}


//add genre column in the middle
function releases_custom_columns( $defaults ) {
	
	unset($defaults['date']);
    $defaults['genre'] = __('Genre', 'stylico');
	$defaults['date'] = __('Date', 'stylico');
    return $defaults;
	
}

//add genre column in the middle
function slider_custom_columns( $defaults ) {
	
	unset($defaults['date']);
    $defaults['image_slide'] = __('Image Slide', 'stylico');
	$defaults['date'] = __('Date', 'stylico');
    return $defaults;
	
}

//add associated data to column
function posts_custom_column( $column_name, $id ) {
	
	global $typenow;
    if ( $typenow=='gig' ) {
		
        echo get_post_meta( $id, 'gig_date', true );
		//check if gig already past
		if( get_post_meta( $id, 'gig_date', true ) < date('Y-m-d') )
		    echo '<br><em class="description">'.__('Past gig', 'stylico').'</em>';
    }
	else if( $typenow=='release' ) {
		$terms = wp_get_object_terms( $id, 'genre', array('fields' => 'names') );
		$count = 0;
		foreach($terms as $term ) {
			$count++;
			echo $term;
			if( $count != sizeof($terms) ) echo ', ';
		}
	}
	else if( $typenow=='stylico-slide' ) {
		echo get_the_post_thumbnail( $id , array(50, 50) );
	}
	
}

?>