<?php
/**
*
* Admin options page
*
*/
	$options = $newoptions = get_option('wp-supersized_options');
	$msg = ''; // used to display a success message on updates
	if ( isset($_POST['wp-supersized_submit_functionality'] )) { // if submitted, process results for each tab
	$newoptions['slideshow'] = strip_tags(stripslashes($_POST["slideshow"]));
	$newoptions['autoplay'] = strip_tags(stripslashes($_POST["autoplay"]));
	$newoptions['start_slide'] = strip_tags(stripslashes($_POST["start_slide"]));
	$newoptions['random'] = strip_tags(stripslashes($_POST["random"]));
	$newoptions['slide_interval'] = strip_tags(stripslashes($_POST["slide_interval"]));
	$newoptions['transition'] = strip_tags(stripslashes($_POST["transition"]));
	$newoptions['transition_speed'] = strip_tags(stripslashes($_POST["transition_speed"]));
	$newoptions['new_window'] = strip_tags(stripslashes($_POST["new_window"]));
	$newoptions['pause_hover'] = strip_tags(stripslashes($_POST["pause_hover"]));
        $newoptions['stop_loop'] = strip_tags(stripslashes($_POST["stop_loop"]));
	$newoptions['keyboard_nav'] = strip_tags(stripslashes($_POST["keyboard_nav"]));
	$newoptions['performance'] = strip_tags(stripslashes($_POST["performance"]));
	$newoptions['image_protect'] = strip_tags(stripslashes($_POST["image_protect"]));
        $newoptions['background_url'] = strip_tags(stripslashes($_POST["background_url"]));
        }
        if ( isset($_POST['wp-supersized_submit_size_and_position'] )) {
        $newoptions['min_width'] = strip_tags(stripslashes($_POST["min_width"]));
	$newoptions['min_height'] = strip_tags(stripslashes($_POST["min_height"]));
	$newoptions['vertical_center'] = strip_tags(stripslashes($_POST["vertical_center"]));
	$newoptions['horizontal_center'] = strip_tags(stripslashes($_POST["horizontal_center"]));
        $newoptions['fit_always'] = strip_tags(stripslashes($_POST["fit_always"]));
	$newoptions['fit_portrait'] = strip_tags(stripslashes($_POST["fit_portrait"]));
	$newoptions['fit_landscape'] = strip_tags(stripslashes($_POST["fit_landscape"]));
        }
	if ( isset($_POST['wp-supersized_submit_components'] )) {
        $newoptions['navigation'] = strip_tags(stripslashes($_POST["navigation"]));
	$newoptions['thumbnail_navigation'] = strip_tags(stripslashes($_POST["thumbnail_navigation"]));
        $newoptions['thumb_links'] = strip_tags(stripslashes($_POST["thumb_links"]));
        $newoptions['thumbnail_suffix'] = strip_tags(stripslashes($_POST["thumbnail_suffix"]));
	$newoptions['navigation_controls'] = strip_tags(stripslashes($_POST["navigation_controls"]));
	$newoptions['slide_counter'] = strip_tags(stripslashes($_POST["slide_counter"]));
	$newoptions['slide_captions'] = strip_tags(stripslashes($_POST["slide_captions"]));
        $newoptions['slide_links'] = strip_tags(stripslashes($_POST["slide_links"]));
        $newoptions['progress_bar'] =  strip_tags(stripslashes($_POST["progress_bar"]));
        $newoptions['mouse_scrub'] = strip_tags(stripslashes($_POST["mouse_scrub"]));
        $newoptions['thumb_tray'] = strip_tags(stripslashes($_POST["thumb_tray"]));
        $newoptions['tray_visible'] = strip_tags(stripslashes($_POST["tray_visible"]));
       }
	if (isset($_POST['wp-supersized_submit_flickr'] )) {
        $newoptions['flickr_source'] = strip_tags(stripslashes($_POST["flickr_source"]));
	$newoptions['flickr_set'] = strip_tags(stripslashes($_POST["flickr_set"]));
	$newoptions['flickr_user'] = strip_tags(stripslashes($_POST["flickr_user"]));
	$newoptions['flickr_group'] = strip_tags(stripslashes($_POST["flickr_group"]));
        $newoptions['flickr_tags'] = strip_tags(stripslashes($_POST["flickr_tags"]));
	$newoptions['flickr_total_slides'] = strip_tags(stripslashes($_POST["flickr_total_slides"]));
	$newoptions['flickr_size'] = strip_tags(stripslashes($_POST["flickr_size"]));
	$newoptions['flickr_sort_by'] = strip_tags(stripslashes($_POST["flickr_sort_by"]));
        $newoptions['flickr_sort_direction'] = strip_tags(stripslashes($_POST["flickr_sort_direction"]));
	$newoptions['flickr_api_key'] = strip_tags(stripslashes($_POST["flickr_api_key"]));
        }
	if ( isset($_POST['wp-supersized_submit_picasa'] )) {
        $newoptions['picasa_source'] = strip_tags(stripslashes($_POST["picasa_source"]));
	$newoptions['picasa_album'] = strip_tags(stripslashes($_POST["picasa_album"]));
	$newoptions['picasa_user'] = strip_tags(stripslashes($_POST["picasa_user"]));
        $newoptions['picasa_tags'] = strip_tags(stripslashes($_POST["picasa_tags"]));
	$newoptions['picasa_total_slides'] = strip_tags(stripslashes($_POST["picasa_total_slides"]));
	$newoptions['picasa_image_size'] = strip_tags(stripslashes($_POST["picasa_image_size"]));
	$newoptions['picasa_sort_by'] = strip_tags(stripslashes($_POST["picasa_sort_by"]));
	$newoptions['picasa_sort_direction'] = strip_tags(stripslashes($_POST["picasa_sort_direction"]));
	$newoptions['picasa_auth_key'] = strip_tags(stripslashes($_POST["picasa_auth_key"]));
        }
	if ( isset($_POST['wp-supersized_submit_smugmug'] )) {
        $newoptions['smugmug_source'] = strip_tags(stripslashes($_POST["smugmug_source"]));
	$newoptions['smugmug_keyword'] = strip_tags(stripslashes($_POST["smugmug_keyword"]));
	$newoptions['smugmug_user'] = strip_tags(stripslashes($_POST["smugmug_user"]));
	$newoptions['smugmug_gallery'] = strip_tags(stripslashes($_POST["smugmug_gallery"]));
        $newoptions['smugmug_category'] = strip_tags(stripslashes($_POST["smugmug_category"]));
	$newoptions['smugmug_total_slides'] = strip_tags(stripslashes($_POST["smugmug_total_slides"]));
	$newoptions['smugmug_image_size'] = strip_tags(stripslashes($_POST["smugmug_image_size"]));
	$newoptions['smugmug_sort_by'] = strip_tags(stripslashes($_POST["smugmug_sort_by"]));
	$newoptions['smugmug_sort_direction'] = strip_tags(stripslashes($_POST["smugmug_sort_direction"]));
        }
	if ( isset($_POST['wp-supersized_submit_origin'] )) {
        if ($_POST["origin"] == 'default')
        $newoptions['default_dir'] = trim(strip_tags(stripslashes($_POST["SupersizedCustomDir"])),'/'); // removes the slash at the beginning and end of the default dir if the user has typed one
        if ($_POST["origin"] == 'ngg-gallery' && method_exists('nggdb','get_gallery')) {
        $ngg_gallery_selection = strip_tags(stripslashes($_POST["ngg_gallery_selection"]));
        if ($ngg_gallery_selection != 'none') $newoptions['default_dir'] = $ngg_gallery_selection;
        else $newoptions['default_dir'] = trim(strip_tags(stripslashes($_POST["default_dir"])),'/');
        }
        if ( isset ($_POST["debugging_mode"])) { $newoptions['debugging_mode'] = strip_tags(stripslashes($_POST["debugging_mode"])); }
        }
	if ( isset($_POST['wp-supersized_submit_display'] )) {
    if ( isset ($_POST["everywhere"])) { $newoptions['show_on_page']['everywhere'] = strip_tags(stripslashes($_POST["everywhere"])); } //NEW
	if ( isset ($_POST["allposts"])) { $newoptions['show_on_page']['allposts'] = strip_tags(stripslashes($_POST["allposts"])); }
	if ( isset ($_POST["homepage"])) { $newoptions['show_on_page']['homepage'] = strip_tags(stripslashes($_POST["homepage"])); }
	if ( isset ($_POST["allpages"])) { $newoptions['show_on_page']['allpages'] = strip_tags(stripslashes($_POST["allpages"])); }
	if ( isset ($_POST["404_page"])) { $newoptions['show_on_page']['404_page'] = strip_tags(stripslashes($_POST["404_page"])); }
	if ( isset ($_POST["search_results"])) { $newoptions['show_on_page']['search_results'] = strip_tags(stripslashes($_POST["search_results"])); }
	if ( isset ($_POST["front_only"])) { $newoptions['show_on_page']['front_only'] = strip_tags(stripslashes($_POST["front_only"])); }
	if ( isset ($_POST["sticky_post"])) { $newoptions['show_on_page']['sticky_post'] = strip_tags(stripslashes($_POST["sticky_post"])); }
	if ( isset ($_POST["category_archive"])) { $newoptions['show_on_page']['category_archive'] = strip_tags(stripslashes($_POST["category_archive"])); }
	if ( isset ($_POST["tag_archive"])) { $newoptions['show_on_page']['tag_archive'] = strip_tags(stripslashes($_POST["tag_archive"])); }
    if ( isset ($_POST["date_archive"])) {  $newoptions['show_on_page']['date_archive'] = strip_tags(stripslashes($_POST["date_archive"])); }
    if ( isset ($_POST["any_archive"])) { $newoptions['show_on_page']['any_archive'] = strip_tags(stripslashes($_POST["any_archive"])); }
	$newoptions['show_in_post_id'] = explode(',',trim(str_replace(' ', '', strip_tags(stripslashes($_POST["show_in_post_id"]))),',')); //removes commas, spaces and convert to array
	$newoptions['show_in_page_id'] = explode(',',trim(str_replace(' ', '', strip_tags(stripslashes($_POST["show_in_page_id"]))),',')); //removes commas, spaces and convert to array
	$newoptions['show_in_category_id'] = explode(',',trim(str_replace(' ', '', strip_tags(stripslashes($_POST["show_in_category_id"]))),',')); //removes commas, spaces and convert to array
	$newoptions['show_in_tag_id'] = explode(',',trim(str_replace(' ', '', strip_tags(stripslashes($_POST["show_in_tag_id"]))),',')); //removes commas, spaces and convert to array
	
        $templates = get_page_templates();        
	foreach (array_keys( $templates ) as $template )
	{
	if ( isset ($_POST["show_in_template"])) {$newoptions['show_in_template'][$template] = strip_tags(stripslashes($_POST['show_in_template'][$template])); }
	}
        }
	// Save if there were any changes
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('wp-supersized_options', $options);
		$msg = '<div class="updated"><p><strong>'.__('Your settings have been updated','WPSupersized').'</strong></p></div>';
	}
    
        if ( isset($_POST['reset_options'] )) {
                $newoptions['reset_options'] = true;
                update_option('wp-supersized_options', $newoptions);
                WPSupersized::install();
                $msg = '<div class="updated"><p><strong>'.__('Background slider options are back to default!','WPSupersized').'</strong></p></div>';
	}

        $options = get_option('wp-supersized_options'); // makes sure we use the latest options (from update or reset)

        echo '<div class="wrap">';
        
        echo screen_icon().'<h2>';
        _e('Background Image/Slider Options','WPSupersized');
        echo '</h2>';
        
		echo '<br>';

        if (isset($_GET['tab'])) $tab = $_GET['tab']; 
        else $tab = 'functionality';
        
        display_tabs($tab);
        
        // options form
	print $msg;
	echo '<form method="post">';
        
        switch($tab) : 
            case 'functionality' : 
                functionality_options($options); 
                break; 
            case 'display' : 
                display_options($options); 
                break; 
            case 'origin' : 
                origin_options($options); 
                break; 
            case 'size_and_position' : 
                size_and_position_options($options); 
                break; 
            case 'components' : 
                components_options($options); 
                break; 
            case 'flickr' : 
                flickr_options($options); 
                break; 
            case 'picasa' : 
                picasa_options($options); 
                break; 
            case 'smugmug' : 
                smugmug_options($options); 
                break; 
        endswitch; 
        echo '</form>';
               
        function functionality_options($options) {	

	// slideshow (1 is slideshow, 2 is single image background, 3 is Flickr slideshow, 4 is Picasa slideshow, 5 is Smugmug slideshow)
        echo '<table class="form-table">';
	echo '<tr valign="top"><th scope="row">';
        _e('Type of background','WPSupersized');
        echo '</th>';
	echo '<td><input type="radio" name="slideshow" value="1"';
	if( $options['slideshow'] == '1' ){ echo ' checked="checked" '; }
	echo '></input> ';
        _e('Slideshow (default)','WPSupersized');
        echo '<br /><input type="radio" name="slideshow" value="2"';
	if( $options['slideshow'] == '2' ){ echo ' checked="checked" '; }
	echo '></input> ';
        _e('Single image (the first image found in the slides folder will be shown, or a random image when <em>Start slide</em> is 0 - see below)','WPSupersized');
        echo '<br /><input type="radio" name="slideshow" value="3"';
	if( $options['slideshow'] == '3' ){ echo ' checked="checked" '; }
	echo '></input> ';
        _e('Flickr slideshow','WPSupersized');
        echo '<br /><input type="radio" name="slideshow" value="4"';
	if( $options['slideshow'] == '4' ){ echo ' checked="checked" '; }
	echo '></input> ';
        _e('Picasa slideshow','WPSupersized');
        echo '<br /><input type="radio" name="slideshow" value="5"';
	if( $options['slideshow'] == '5' ){ echo ' checked="checked" '; }
	echo '></input> ';
        _e('Smugmug slideshow','WPSupersized');
        echo '<br /><br />';
        _e('For Slideshow and Single image, you may select images from the Wordpress Media Gallery, the NextGen Gallery (both in the <em>Slides source</em> tab), or place images in a folder','WPSupersized');
        echo ' <em>'.content_url().'/supersized-slides/ </em> ';
        _e('or an alternative custom folder (see the <em>Slides source</em> tab).','WPSupersized');
        echo '<br />';
        _e('If you choose Flickr, Picasa, or Smugmug, you need to fill in the details of your account or your desired images in the corresponding tabs.', 'WPSupersized');
        echo '</td></tr>';
	
	// autoplay
	echo '<tr valign="top"><th scope="row">';
        _e('Autoplay on/off','WPSupersized');
        echo '</th>';
	echo '<td><input type="checkbox" name="autoplay" value="true"';
	if( $options['autoplay'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Slideshow starts playing automatically','WPSupersized');
        echo ' (';
        _e('default is on','WPSupersized');
        echo ')</td></tr>';
	
	// start_slide
	echo '<tr valign="top"><th scope="row">';
        _e('Start on slide #','WPSupersized');
        echo '</th>';
	echo '<td><input type="text" name="start_slide" value="'.$options['start_slide'].'" size="4"></input> (';
        _e('0 is random, default is 1','WPSupersized');
        echo ')<br /><p>';
        _e('When set to 0 while in Single image mode, a random image from the slides folder will be displayed.','WPSupersized');
        echo '</p></td></tr>';
	
	// random
	echo '<tr valign="top"><th scope="row">';
        _e('Random slides','WPSupersized');
        echo '</th>';
	echo '<td><input type="checkbox" name="random" value="true"';
	if( $options['random'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Randomize slide order (Ignores start slide, default is off)','WPSupersized');
        echo '</td></tr>';
	
	// slide_interval
	echo '<tr valign="top"><th scope="row">';
        _e('Slide interval','WPSupersized');
        echo '</th>';
	echo '<td><input type="text" name="slide_interval" value="'.$options['slide_interval'].'" size="6"></input> ';
        _e('Length between transitions, in milliseconds (default is 3000)','WPSupersized');
        echo '</td></tr>';
	
	// transition
	echo '<tr valign="top"><th scope="row">';
        _e('Transition','WPSupersized');
        echo '</th>';
	echo '<td><select id="transition" name="transition"';
	$selected = ($options['transition'] == '0') ? 'selected="selected"' : '';
	echo "><option value='0' $selected>";
        _e('None','WPSupersized');
        echo '</option>';
	$selected = ($options['transition'] == '1') ? 'selected="selected"' : '';
	echo "<option value='1' $selected>";
        _e('Fade','WPSupersized');
        echo '</option>';
	$selected = ($options['transition'] == '2') ? 'selected="selected"' : '';
	echo "<option value='2' $selected>";
        _e('Slide Top','WPSupersized');
        echo '</option>';
	$selected = ($options['transition'] == '3') ? 'selected="selected"' : '';
	echo "<option value='3' $selected>";
        _e('Slide Right','WPSupersized');
        echo '</option>';
	$selected = ($options['transition'] == '4') ? 'selected="selected"' : '';
	echo "<option value='4' $selected>";
        _e('Slide Bottom','WPSupersized');
        echo '</option>';
	$selected = ($options['transition'] == '5') ? 'selected="selected"' : '';
	echo "<option value='5' $selected>";
        _e('Slide Left','WPSupersized');
        echo '</option>';
	$selected = ($options['transition'] == '6') ? 'selected="selected"' : '';
	echo "<option value='6' $selected>";
        _e('Carousel Right','WPSupersized');
        echo '</option>';
	$selected = ($options['transition'] == '7') ? 'selected="selected"' : '';
	echo "<option value='7' $selected>";
        _e('Carousel Left','WPSupersized');
        echo '</option>';
	echo '</select> (';
        _e('default is Fade','WPSupersized');
        echo')</td></tr>';

	// transition_speed
	echo '<tr valign="top"><th scope="row">';
        _e('Speed of transition','WPSupersized');
        echo '</th>';
	echo '<td><input type="text" name="transition_speed" value="'.$options['transition_speed'].'" size="6"></input> (';
        _e('in milliseconds, default is 500','WPSupersized');
        echo ')</td></tr>';
	
	// new_window
	echo '<tr valign="top"><th scope="row">';
        _e('New window','WPSupersized');
        echo '</th>';
	echo '<td><input type="checkbox" name="new_window" value="true"';
	if( $options['new_window'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Image links open in new window/tab','WPSupersized');
        echo ' (';
        _e('default is on','WPSupersized');
        echo ')</td></tr>';
	
	// pause_hover
	echo '<tr valign="top"><th scope="row">';
        _e('Pause on hover','WPSupersized');
	echo '</th><td><input type="checkbox" name="pause_hover" value="true"';
	if( $options['pause_hover'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Pause slideshow on hover','WPSupersized');
        echo ' (';
        _e('default is off','WPSupersized');
        echo ')</td></tr>';
	
	// stop_loop
	echo '<tr valign="top"><th scope="row">';
        _e('Stop loop','WPSupersized');
	echo '</th><td><input type="checkbox" name="stop_loop" value="true"';
	if( $options['stop_loop'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Pauses slideshow upon reaching the last slide','WPSupersized');
        echo ' (';
        _e('default is off','WPSupersized');
        echo ')</td></tr>';
	
	// keyboard_nav
	echo '<tr valign="top"><th scope="row">';
        _e('Keyboard navigation','WPSupersized');
	echo '</th><td><input type="checkbox" name="keyboard_nav" value="true"';
	if( $options['keyboard_nav'] == true ){ echo ' checked="checked"'; }
	echo '></input> (';
        _e('default is on','WPSupersized');
        echo ')</td></tr>';
		
        // performance
	echo '<tr valign="top"><th scope="row">';
        _e('Performance','WPSupersized');
	echo '</th><td><select id="performance" name="performance"';
	$selected = ($options['performance'] == '0') ? 'selected="selected"' : '';
	echo "><option value='0' $selected>";
        _e('Normal','WPSupersized');
        echo '</option>';
	$selected = ($options['performance'] == '1') ? 'selected="selected"' : '';
	echo "<option value='1' $selected>";
        _e('Hybrid Speed/Quality','WPSupersized');
        echo '</option>';
	$selected = ($options['performance'] == '2') ? 'selected="selected"' : '';
	echo "<option value='2' $selected>";
        _e('Optimizes image quality','WPSupersized');
        echo '</option>';
	$selected = ($options['performance'] == '3') ? 'selected="selected"' : '';
	echo "<option value='3' $selected>";
        _e('Optimizes transition speed','WPSupersized');
        echo '</option>';
	echo '</select> (';
        _e('default is Hybrid Speed/Quality','WPSupersized');
	echo ')<br /><strong>';
        _e('Only works for Firefox/IE, not Webkit','WPSupersized');
        echo '</strong></td></tr>';
		
	// image_protect
	echo '<tr valign="top"><th scope="row">';
        _e('Image protection','WPSupersized');
	echo '</th><td><input type="checkbox" name="image_protect" value="true"';
	if( $options['image_protect'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Disables image dragging and right click with Javascript','WPSupersized');
        echo ' (';
        _e('default is off','WPSupersized');
        echo ')</td></tr>';
        
        // background_url
	echo '<tr valign="top"><th scope="row">';
        _e('Background URL','WPSupersized');
	echo '</th><td>http://<input type="text" name="background_url" value="'.$options['background_url'].'" size="50"></input><br />';
        _e('Type here the URL of the link you want to access when clicking on the background image (www.example.com). Leave this field empty if your do not want any link to be used. Default is empty.','WPSupersized');
        echo '</td></tr>';

        // close stuff and submit data
	echo '<input type="hidden" name="wp-supersized_submit_functionality" value="true"></input>';
	echo '</table><br /><br />';
	echo '<p><input class="button-primary" type="submit" name="wp-supersized_submit_functionality" value="';
        _e('Update Options &raquo;','WPSupersized');
        echo '"><input style="margin-left: 250px;" class="button-secondary" type="submit" name="reset_options" onclick="return confirm(&#39;';
        _e('Do you really want to restore the default options?','WPSupersized');
        echo '&#39;)" value="';
        _e('Reset Options &raquo;','WPSupersized');
        echo '"></p>';
         
        wp_nonce_field('wp-supersized_admin_options_update','wp-supersized_admin_nonce');
	
	echo '</form>';
	echo "</div>"; // end wrap
        	}
        function display_options($options) {

	// show_on_page
	echo '<table class="form-table">';
	echo '<tr valign="top"><th scope="row">';
        _e('Select the page(s)/post(s) where the background slider should be used','WPSupersized');
	echo '</th><td><input type="checkbox" name="everywhere" value="true"';
	if( $options['show_on_page']['everywhere'] == true ){ echo ' checked="checked"'; } 
	echo '></input> ';
        _e('Everywhere (except Admin pages)','WPSupersized');
	echo '<br /><input type="checkbox" name="allpages" value="true"';
	if( $options['show_on_page']['allpages'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('All pages (except homepage)','WPSupersized');
	echo '<br /><input type="checkbox" name="homepage" value="true"';
	if( $options['show_on_page']['homepage'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Homepage (of your blog)','WPSupersized');
	echo '<br /><input type="checkbox" name="front_only" value="true"';
	if( $options['show_on_page']['front_only'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Front page (landing page)','WPSupersized');
	echo '<br /><input type="checkbox" name="404_page" value="true"';
	if( $options['show_on_page']['404_page'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Error page (404)','WPSupersized');
        echo '<br /><input type="checkbox" name="search_results" value="true"';
	if( $options['show_on_page']['search_results'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Search results page','WPSupersized');
	echo '<br /><input type="checkbox" name="allposts" value="true"';
	if( $options['show_on_page']['allposts'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('All posts (not pages)','WPSupersized');
        echo '<br />';
        _e('If you select <em>All posts</em>, <em>All pages</em>, or <em>Everywhere</em>, posts/pages with a <em>SupersizedDir</em> custom field will show images from the selected folder while all others will show the default directory images.','WPSupersized');
	echo '<br /><input type="checkbox" name="sticky_post" value="true"';
	if( $options['show_on_page']['sticky_post'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Sticky post','WPSupersized');
	echo '<br /><input type="checkbox" name="category_archive" value="true"';
	if( $options['show_on_page']['category_archive'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Category archive','WPSupersized');
        echo '<br /><input type="checkbox" name="tag_archive" value="true"';
	if( $options['show_on_page']['tag_archive'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Tag archive','WPSupersized');
        echo '<br /><input type="checkbox" name="date_archive" value="true"';
        if( $options['show_on_page']['date_archive'] == true ){ echo ' checked="checked"'; }
        echo '></input> ';
        _e('Date archive','WPSupersized');
        echo '<br /><input type="checkbox" name="any_archive" value="true"';
        if( $options['show_on_page']['any_archive'] == true ){ echo ' checked="checked"'; }
        echo '></input> ';
        _e('Any archive','WPSupersized');

        echo '</td></tr><p>';
        _e('In each of these options, unless a custom field was defined in the page/post, the default slides directory will be used.','WPSupersized');
        echo '</p>';
   
	// show_in_template
	echo '<tr valign="top"><th scope="row">';
        _e('Select the page template(s) where the background slider should be used','WPSupersized');
        echo '</th>';
	$templates = get_page_templates();
        echo '<td>';
        if ($templates) {
	foreach (array_keys( $templates ) as $template )
            {
            echo '<input type="checkbox" name="show_in_template['.$template.']" value="true"';
            if( $options['show_in_template'][$template] == true ){ echo ' checked="checked"'; }
            echo '></input> '.$template.'<br />';
            }
        } else {echo'<p>';
        _e('Sorry, no template found. Your theme is not using any non-standard page template','WPSupersized');
        echo '</p>';
        }
        echo '</td></tr>';
        
        // show_in_post_id
	echo '<tr valign="top"><th scope="row">';
        _e('Post ID where the background slider will be used','WPSupersized');
	echo '</th><td><input type="text" name="show_in_post_id" value="'.implode(',', isset($options['show_in_post_id']) ? $options['show_in_post_id'] : array()).'" size="100"></input><br />'; // implode() converts the array back into a string
        _e('Separate IDs by a comma, e.g. 5,6,32,456','WPSupersized');
        echo '<br />';
        _e('You can find your post IDs in the Posts admin menu by hovering on the name of the post. The ID will be displayed at the bottom of your browser.','WPSupersized');
        echo '</td></tr>';
        
        // show_in_page_id
	echo '<tr valign="top"><th scope="row">';
        _e('Page ID where the background slider will be used','WPSupersized');
	echo '</th><td><input type="text" name="show_in_page_id" value="'.implode(',',isset($options['show_in_page_id']) ? $options['show_in_page_id'] : array()).'" size="100"></input><br />';
        _e('Separate IDs by a comma, e.g. 5,6,32,456','WPSupersized');
        echo '<br />';
        _e('You can find your page IDs in the Pages admin menu by hovering on the name of the page. The ID will be displayed at the bottom of your browser.','WPSupersized');
        echo '</td></tr>';
        
        // show_in_category_id
	echo '<tr valign="top"><th scope="row">';
        _e('Category ID for the posts/pages where the background slider will be used','WPSupersized');
	echo '</th><td><input type="text" name="show_in_category_id" value="'.implode(',',isset($options['show_in_category_id']) ? $options['show_in_category_id'] : array()).'" size="100"></input><br />';
        _e('Separate IDs by a comma, e.g. 5,6,32,456','WPSupersized');
        echo '<br />';
        _e('You can find your category IDs in the Posts > Categories admin menu by hovering on the name of the category. The ID will be displayed at the bottom of your browser.','WPSupersized');
        echo '</td></tr>';
        
        // show_in_tag_id
	echo '<tr valign="top"><th scope="row">';
        _e('Tag ID for the posts/pages where the background slider will be used','WPSupersized');
	echo '</th><td><input type="text" name="show_in_tag_id" value="'.implode(',',isset($options['show_in_tag_id']) ? $options['show_in_tag_id'] : array()).'" size="100"></input><br />';
        _e('Separate IDs by a comma, e.g. 5,6,32,456','WPSupersized');
        echo '<br />';
        _e('You can find your tag IDs in the Posts > Post Tags admin menu by hovering on the name of the tag. The ID will be displayed at the bottom of your browser.','WPSupersized');
        echo '</td></tr>';
                
        // close stuff and submit data
	echo '<input type="hidden" name="wp-supersized_submit_display" value="true"></input>';
	echo '</table><br /><br />';
	echo '<p><input class="button-primary" type="submit" name="wp-supersized_submit_display" value="';
        _e('Update Options &raquo;','WPSupersized');
        echo '"><input style="margin-left: 250px;" class="button-secondary" type="submit" name="reset_options" onclick="return confirm(&#39;';
        _e('Do you really want to restore the default options?','WPSupersized');
        echo '&#39;)" value="';
        _e('Reset Options &raquo;','WPSupersized');
        echo '"></p>';
         
        wp_nonce_field('wp-supersized_admin_options_update','wp-supersized_admin_nonce');
	
	echo '</form>';
	echo "</div>";
        	}
        function origin_options($options) {

        echo '<table class="form-table">';
	echo '<tr valign="top"><th scope="row">';

        // select default_dir
        echo '<label for="SupersizedSource">Default origin of slider images</label></th><td>';
        echo '<input type="radio" name="origin" id="origin" value="default" ',substr($options['default_dir'],0,11) != 'ngg-gallery' ? ' checked="checked"' : '',' /> <label for"origin">Default directory (select it below).</label><br />';
        if (is_plugin_active('nextgen-gallery/nggallery.php') && method_exists('nggdb','find_all_galleries')) {
                echo '<input type="radio" name="origin" id="origin" value="ngg-gallery" ',substr($options['default_dir'],0,11) == 'ngg-gallery' ? ' checked="checked"' : '',' /> <label for"origin">NextGEN Gallery (Select which gallery to use below)</label><br />';  
        }
        else echo 'If <a href="http://wordpress.org/extend/plugins/nextgen-gallery/">NextGEN Gallery</a> had been installed, you would have been able to select one of its galleries as default origin for the images.<br />';
        echo '</td></tr>';
        echo '<tr valign="top"><th scope="row"><label for="SupersizedNextGenGallery">Default NextGEN gallery</label></th><td>';
        if (is_plugin_active('nextgen-gallery/nggallery.php') && method_exists('nggdb','find_all_galleries')) {
            echo '<select name="ngg_gallery_selection" id="ngg_gallery_selection">';
            global $nggdb;
            $nggGalleries = $nggdb->find_all_galleries();
            if(substr($options['default_dir'],0,11) != 'ngg-gallery') {
                echo '<option selected="selected" value="">none</option>';
            }
            foreach ($nggGalleries as $gallery )
            {
                echo '<option', substr($options['default_dir'], 12) == $gallery->gid ? ' selected="selected"' : '', ' value="ngg-gallery_'.$gallery->gid.'">'.$gallery->name.'</option>';
            }
            echo '</select><br /><span class="description">Select here the NextGEN gallery that you want to use on all pages/posts that you selected in the Display options.</span>';
        }
        else echo '<span class="description">NextGEN Gallery is not installed/activated.</span>';
        echo '</td></tr>';
            
        // default_dir
	echo '<tr valign="top"><th scope="row">';
        _e('Default slides directory','WPSupersized');
            echo '</th><td>';
            $wpContentFolder = WP_CONTENT_DIR;
            if(substr($options['default_dir'],0,11) != 'ngg-gallery')
                echo '<span class="description">'._e('Your currently selected default directory is: ','WPSupersized').content_url().'/'.$options['default_dir'].'</span>';
            $listFolders = WPSupersized_Metabox::directory_list($wpContentFolder,false,true,'.|..|.svn|cache|plugins|upgrade|themes|languages',true);
            echo '<ul>';
            WPSupersized_Metabox::display_array($listFolders, $options['default_dir']);
            echo '</ul>';
            WPSupersized_Metabox::output_folder_list_script();
        
        _e('The images from this directory will be displayed by the background slider unless you use a custom directory in each post/page. Default is:','WPSupersized');
        echo ' '.content_url().'/supersized-slides<br /><p>';
        _e('Please put your images folders (default and custom) for the background slider in your directory','WPSupersized');
        echo ' '.content_url().'. ';
        _e('You may create folders within folders, e.g. /wp-content/supersized-slides/slidesforpost###/. In this case, you would enter the corresponding directory (supersized-slides/slidesforpost### , please note: no trailing slash) as Default slides directory.','WPSupersized');
        echo '<br /><strong>';
        _e('Use the same format for the <em>SupersizedDir</em> custom field in Posts and Pages.','WPSupersized');
        echo '</strong></p><p>';
        _e('The slider will look first for a custom directory from the custom field <em>SupersizedDir</em>. If not found, it will then use the default directory selected here (<strong>do not forget to create it and fill it with images!</strong>). If none of these can be found, the default images will be shown.','WPSupersized');
        echo '</p></td></tr>';
        
        // debugging_mode
	echo '<tr valign="top"><th scope="row">';
        _e('Debugging mode on/off','WPSupersized');
        echo '</th>';
	echo '<td><input type="checkbox" name="debugging_mode" value="true"';
	if( $options['debugging_mode'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('When on, the slider will generate comments in the source of the web page with some variables values, useful to find out the origin of file path problems. If you have problems with displaying your images, send me these comments from the source of the page and I will be able to help you more easily.<br /><strong>This is not necessary for normal operation. Use only if you have trouble with displaying your images.</strong>','WPSupersized');
        echo '<br />(';
        _e('default is off','WPSupersized');
        echo ')</td></tr>';
        
        // close stuff and submit data
	echo '<input type="hidden" name="wp-supersized_submit_origin" value="true"></input>';
	echo '</table><br /><br />';
	echo '<p><input class="button-primary" type="submit" name="wp-supersized_submit_origin" value="';
        _e('Update Options &raquo;','WPSupersized');
        echo '"><input style="margin-left: 250px;" class="button-secondary" type="submit" name="reset_options" onclick="return confirm(&#39;';
        _e('Do you really want to restore the default options?','WPSupersized');
        echo '&#39;)" value="';
        _e('Reset Options &raquo;','WPSupersized');
        echo '"></p>';
         
        wp_nonce_field('wp-supersized_admin_options_update','wp-supersized_admin_nonce');
	
	echo '</form>';
	echo "</div>";
	}
        function size_and_position_options($options) {
       
        // min_width
        echo '<table class="form-table">';
	echo '<tr valign="top"><th scope="row">';
        _e('Minimum width allowed','WPSupersized');
	echo '</th><td><input type="text" name="min_width" value="'.$options['min_width'].'" size="5"></input> (';
        _e('in pixels, default is 0','WPSupersized');
        echo ')</td></tr>';

	// min_height
	echo '<tr valign="top"><th scope="row">';
        _e('Minimum height allowed','WPSupersized');
	echo '</th><td><input type="text" name="min_height" value="'.$options['min_height'].'" size="5"></input> (';
        _e('in pixels, default is 0','WPSupersized');
        echo ')</td></tr>';
	
	// vertical_center
	echo '<tr valign="top"><th scope="row">';
        _e('Center the background vertically','WPSupersized');
	echo '</th><td><input type="checkbox" name="vertical_center" value="true"';
	if( $options['vertical_center'] == true ){ echo ' checked="checked"'; }
	echo '></input> (';
        _e('default is on','WPSupersized');
        echo ')</td></tr>';
	
	// horizontal_center
	echo '<tr valign="top"><th scope="row">';
        _e('Center the background horizontally','WPSupersized');
	echo '</th><td><input type="checkbox" name="horizontal_center" value="true"';
	if( $options['horizontal_center'] == true ){ echo ' checked="checked"'; }
	echo '></input> (';
        _e('default is on','WPSupersized');
        echo ')</td></tr>';

        // fit_always
	echo '<tr valign="top"><th scope="row">';
        _e('Always fit','WPSupersized');
	echo '</th><td><input type="checkbox" name="fit_always" value="true"';
	if( $options['fit_always'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Prevents the image from ever being cropped. Ignores minimum width and height.','WPSupersized');
        echo' (';
        _e('default is off','WPSupersized');
        echo ')</td></tr>';

	// fit_portrait
	echo '<tr valign="top"><th scope="row">';
        _e('Fit portrait','WPSupersized');
	echo '</th><td><input type="checkbox" name="fit_portrait" value="true"';
	if( $options['fit_portrait'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Portrait images will not exceed browser height','WPSupersized');
        echo ' (';
        _e('default is on','WPSupersized');
        echo ')</td></tr>';
	
	// fit_landscape
	echo '<tr valign="top"><th scope="row">';
        _e('Fit landscape','WPSupersized');
	echo '</th><td><input type="checkbox" name="fit_landscape" value="true"';
	if( $options['fit_landscape'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Landscape images will not exceed browser width','WPSupersized');
        echo ' (';
        _e('default is off','WPSupersized');
        echo ')</td></tr>';

        // close stuff and submit data
	echo '<input type="hidden" name="wp-supersized_submit_size_and_position" value="true"></input>';
	echo '</table><br /><br />';
	echo '<p><input class="button-primary" type="submit" name="wp-supersized_submit_size_and_position" value="';
        _e('Update Options &raquo;','WPSupersized');
        echo '"><input style="margin-left: 250px;" class="button-secondary" type="submit" name="reset_options" onclick="return confirm(&#39;';
        _e('Do you really want to restore the default options?','WPSupersized');
        echo '&#39;)" value="';
        _e('Reset Options &raquo;','WPSupersized');
        echo '"></p>';
         
        wp_nonce_field('wp-supersized_admin_options_update','wp-supersized_admin_nonce');
	
	echo '</form>';
	echo "</div>";
	}
        function components_options($options) {
	echo '<table class="form-table">';
	echo '<tr valign="top"><p>(';
        _e('These options are not taken into account when in Single image mode','WPSupersized');
        echo ')</p></tr>';

	// navigation_controls
	echo '<tr valign="top"><th scope="row">';
        _e('Navigation arrows','WPSupersized');
	echo '</th><td><input type="checkbox" name="navigation_controls" value="true"';
	if( $options['navigation_controls'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('Displays arrows for navigation','WPSupersized');
        echo ' (';
        _e('default is on','WPSupersized');
        echo ')</td></tr>';

	// navigation
	echo '<tr valign="top"><th scope="row">';
        _e('Slideshow controls','WPSupersized');
	echo '</th><td><input type="checkbox" name="navigation" value="true"';
	if( $options['navigation'] == true ){ echo ' checked="checked"'; }
	echo '></input> ';
        _e('If you switch this off, the entire navigation will be hidden. The captions will still be displayed if the options <em>Slide caption</em> is on.','WPSupersized');
        echo ' (';
        _e('default is on','WPSupersized');
        echo ')</td></tr>';
	
       		
	// slide_captions
	echo '<tr valign="top"><th scope="row">';
        _e('Slide caption','WPSupersized');
	echo '</th><td><input type="checkbox" name="slide_captions" value="true"';
	if( $options['slide_captions'] == true ){ echo ' checked="checked"'; }
	echo '></input> (';
        _e('default is on','WPSupersized');
        echo ')<br />';
        _e('Captions for images from your default or custom directories are extracted from the IPTC caption field of each image.','WPSupersized');
        echo '<br />';
        _e('Captions for NextGEN Gallery images are taken from the <em>Description</em> field. If not filled in, the <em>Alt&Title</em> field will be used.','WPSupersized');
        echo '<br />';
        _e('Captions for Wordpress Media Gallery images are taken from the <em>Caption</em> field. If not filled in, the image title (filename) will be used.','WPSupersized');
        echo '</td></tr>';

        // close stuff and submit data
	echo '<input type="hidden" name="wp-supersized_submit_components" value="true"></input>';
	echo '</table><br /><br />';
	echo '<p><input class="button-primary" type="submit" name="wp-supersized_submit_components" value="';
        _e('Update Options &raquo;','WPSupersized');
        echo '"><input style="margin-left: 250px;" class="button-secondary" type="submit" name="reset_options" onclick="return confirm(&#39;';
        _e('Do you really want to restore the default options?','WPSupersized');
        echo '&#39;)" value="';
        _e('Reset Options &raquo;','WPSupersized');
        echo '"></p>';
         	
	echo '</form>';
	echo "</div>";
	}
        function flickr_options($options) { 
	echo '<table class="form-table">';
	
	// flickr_source
	echo '<tr valign="top"><th scope="row">';
        _e('Flickr Source','WPSupersized');
	echo '</th><td><select id="flickr_source" name="flickr_source"';
	$selected = ($options['flickr_source'] == '1') ? 'selected="selected"' : '';
	echo "><option value='1' $selected>";
        _e('Set','WPSupersized');
        echo '</option>';
	$selected = ($options['flickr_source'] == '2') ? 'selected="selected"' : '';
	echo "<option value='2' $selected>";
        _e('User','WPSupersized');
        echo '</option>';
	$selected = ($options['flickr_source'] == '3') ? 'selected="selected"' : '';
	echo "<option value='3' $selected>";
        _e('Group','WPSupersized');
        echo '</option>';
	$selected = ($options['flickr_source'] == '4') ? 'selected="selected"' : '';
	echo "<option value='4' $selected>";
        _e('Tags','WPSupersized');
	echo '</option></select> (';
        _e('default is Group','WPSupersized');
        echo ')</tr>';

        // flickr_set
	echo '<tr valign="top"><th scope="row">';
        _e('Flickr set ID','WPSupersized');
	echo '</th><td><input type="text" name="flickr_set" value="'.$options['flickr_set'].'" size="30"></input> (';
        _e('found in URL','WPSupersized');
        echo ')</td></tr>';

        // flickr_user
	echo '<tr valign="top"><th scope="row">';
        _e('Flickr user ID','WPSupersized');
	echo '</th><td><input type="text" name="flickr_user" value="'.$options['flickr_user'].'" size="30"></input> (<a href="http://idgettr.com/">http://idgettr.com/</a>)</td></tr>';

        // flickr_group
	echo '<tr valign="top"><th scope="row">';
        _e('Flickr group ID','WPSupersized');
	echo '</th><td><input type="text" name="flickr_group" value="'.$options['flickr_group'].'" size="30"></input> (<a href="http://idgettr.com/">http://idgettr.com/</a>)</td></tr>';

        // flickr_tags
	echo '<tr valign="top"><th scope="row">';
        _e('Flickr tags ID','WPSupersized');
	echo '</th><td><input type="text" name="flickr_tags" value="'.$options['flickr_tags'].'" size="150"></input> (separate them by a comma)</td></tr>';

        // flickr_total_slides
	echo '<tr valign="top"><th scope="row">';
        _e('How many pictures to pull','WPSupersized');
	echo '</th><td><input type="text" name="flickr_total_slides" value="'.$options['flickr_total_slides'].'" size="5"></input> ';
        _e('Between 1-500 (default is 100)','WPSupersized');
        echo '</td></tr>';
	
        // flickr_size
	echo '<tr valign="top"><th scope="row">';
        _e('Flickr Size','WPSupersized');
	echo '</th><td><select id="flickr_size" name="flickr_size">';
	$selected = ($options['flickr_size'] == 't') ? 'selected="selected"' : '';
	echo "<option value='t' $selected>t</option>";
	$selected = ($options['flickr_size'] == 's') ? 'selected="selected"' : '';
	echo "<option value='s' $selected>s</option>";
	$selected = ($options['flickr_size'] == 'm') ? 'selected="selected"' : '';
	echo "<option value='m' $selected>m</option>";
	$selected = ($options['flickr_size'] == 'z') ? 'selected="selected"' : '';
	echo "<option value='z' $selected>z</option>";
	$selected = ($options['flickr_size'] == 'b') ? 'selected="selected"' : '';
	echo "<option value='b' $selected>b</option>";
	echo '</select> (';
        _e('default is z','WPSupersized');
	echo ')<br />';
        _e('Details:','WPSupersized');
        echo '<a href="http://www.flickr.com/services/api/misc.urls.html">http://www.flickr.com/services/api/misc.urls.html</a>';
        echo '</td></tr>';

        // flickr_sort_by
	echo '<tr valign="top"><th scope="row">';
        _e('Sort images by','WPSupersized');
	echo '</th><td><select id="flickr_sort_by" name="flickr_sort_by">';
	$selected = ($options['flickr_sort_by'] == '1') ? 'selected="selected"' : '';
	echo "<option value='1' $selected>";
        _e('Date posted','WPSupersized');
        echo '</option>';
	$selected = ($options['flickr_sort_by'] == '2') ? 'selected="selected"' : '';
	echo "<option value='2' $selected>";
        _e('Date taken','WPSupersized');
        echo '</option>';
	$selected = ($options['flickr_sort_by'] == '3') ? 'selected="selected"' : '';
	echo "<option value='3' $selected>";
        _e('Interestingness','WPSupersized');
        echo '</option></select> (';
        _e('Default is Date posted','WPSupersized');
        echo ')</td></tr>';

        // flickr_sort_direction
	echo '<tr valign="top"><th scope="row">';
        _e('Sort direction','WPSupersized');
	echo '</th><td><select id="flickr_sort_direction" name="flickr_sort_direction">';
	$selected = ($options['flickr_sort_direction'] == '0') ? 'selected="selected"' : '';
	echo "<option value='0' $selected>";
        _e('Descending','WPSupersized');
        echo '</option>';
	$selected = ($options['flickr_sort_direction'] == '1') ? 'selected="selected"' : '';
	echo "<option value='1' $selected>";
        _e('Ascending','WPSupersized');
        echo '</option></select> (';
        _e('Default is Descending','WPSupersized');
        echo ')</td></tr>';
        
	// flickr_api_key
	echo '<tr valign="top"><th scope="row">';
        _e('Flickr API key','WPSupersized');
	echo '</th><td><input type="text" name="flickr_api_key" value="'.$options['flickr_api_key'].'" size="40"></input><br />';
        _e('You need to get your own','WPSupersized');
        echo ' -- <a href="http://www.flickr.com/services/apps/create/">http://www.flickr.com/services/apps/create/</a></td></tr>';

        
        // close stuff and submit data
	echo '<input type="hidden" name="wp-supersized_submit_flickr" value="true"></input>';
	echo '</table><br /><br />';
	echo '<p><input class="button-primary" type="submit" name="wp-supersized_submit_flickr" value="';
        _e('Update Options &raquo;','WPSupersized');
        echo '"><input style="margin-left: 250px;" class="button-secondary" type="submit" name="reset_options" onclick="return confirm(&#39;';
        _e('Do you really want to restore the default options?','WPSupersized');
        echo '&#39;)" value="';
        _e('Reset Options &raquo;','WPSupersized');
        echo '"></p>';
         
        wp_nonce_field('wp-supersized_admin_options_update','wp-supersized_admin_nonce');
	
	echo '</form>';
	echo "</div>";
        }
        
        function picasa_options($options) { 
	echo '<table class="form-table">';
	
	// picasa_source
	echo '<tr valign="top"><th scope="row">';
        _e('Picasa Source','WPSupersized');
	echo '</th><td><select id="picasa_source" name="picasa_source"';
	$selected = ($options['picasa_source'] == '1') ? 'selected="selected"' : '';
	echo "><option value='1' $selected>";
        _e('Album','WPSupersized');
        echo '</option>';
	$selected = ($options['picasa_source'] == '2') ? 'selected="selected"' : '';
	echo "<option value='2' $selected>";
        _e('User','WPSupersized');
        echo '</option>';
	$selected = ($options['picasa_source'] == '3') ? 'selected="selected"' : '';
	echo "<option value='3' $selected>";
        _e('Tags','WPSupersized');
        echo '</option></select> (';
        _e('default is Album','WPSupersized');
        echo ')</tr>';

        // picasa_album
	echo '<tr valign="top"><th scope="row">';
        _e('Picasa Album name','WPSupersized');
	echo '</th><td><input type="text" name="picasa_album" value="'.$options['picasa_album'].'" size="120"></input><br />';
        echo '(';
        _e('found in the URL of the link to this album','WPSupersized');
        echo ')</td></tr>';

        // picasa_user
	echo '<tr valign="top"><th scope="row">';
        _e('Picasa user name','WPSupersized');
	echo '</th><td><input type="text" name="picasa_user" value="'.$options['picasa_user'].'" size="30"></input><br />';
        echo '(';
        _e('either you Picasa user name or the long number in the URL to your profile','WPSupersized');
        echo ')</td></tr>';

        // picasa_tags
	echo '<tr valign="top"><th scope="row">';
        _e('Picasa tags','WPSupersized');
	echo '</th><td><input type="text" name="picasa_tags" value="'.$options['picasa_tags'].'" size="120"></input><br />';
        echo '(';
        _e('comma- or "+"-separated = AND, "|"-separated = OR', 'WPSupersized');
        echo ')</td></tr>';

        // picasa_total_slides
	echo '<tr valign="top"><th scope="row">';
        _e('How many pictures to pull','WPSupersized');
	echo '</th><td><input type="text" name="picasa_total_slides" value="'.$options['picasa_total_slides'].'" size="5"></input> ';
        _e('Between 1-500 (default is 100)','WPSupersized');
        echo '</td></tr>';
	
        // picasa_image_size
	echo '<tr valign="top"><th scope="row">';
        _e('Picasa image size','WPSupersized');
	echo '</th><td><select id="picasa_image_size" name="picasa_image_size"';
	$selected = ($options['picasa_image_size'] == '512') ? 'selected="selected"' : '';
	echo "><option value='512' $selected>512</option>";
	$selected = ($options['picasa_image_size'] == '640') ? 'selected="selected"' : '';
	echo "<option value='640' $selected>640</option>";
	$selected = ($options['picasa_image_size'] == '720') ? 'selected="selected"' : '';
	echo "<option value='720' $selected>720</option>";
	$selected = ($options['picasa_image_size'] == '800') ? 'selected="selected"' : '';
	echo "<option value='800' $selected>800</option>";
	$selected = ($options['picasa_image_size'] == '1024') ? 'selected="selected"' : '';
	echo "<option value='1024' $selected>1024</option>";
	$selected = ($options['picasa_image_size'] == '1280') ? 'selected="selected"' : '';
	echo "<option value='1280' $selected>1280</option>";
	$selected = ($options['picasa_image_size'] == '1440') ? 'selected="selected"' : '';
	echo "<option value='1440' $selected>1440</option>";
	$selected = ($options['picasa_image_size'] == '1600') ? 'selected="selected"' : '';
	echo "<option value='1600' $selected>1600</option>";
	$selected = ($options['picasa_image_size'] == 'd') ? 'selected="selected"' : '';
	echo "<option value='d' $selected>";
        _e('Original size','WPSupersized');
        echo '</option>"';
	echo '</select> (';
        _e('default is 1024','WPSupersized');
	echo ')<br />';
        _e('Picasa API will return the largest size available if your selection is larger than the original','WPSupersized');
        echo '</td></tr>';

        // picasa_sort_by
	echo '<tr valign="top"><th scope="row">';
        _e('Sort images by','WPSupersized');
	echo '</th><td><select id="picasa_sort_by" name="picasa_sort_by"';
	$selected = ($options['picasa_sort_by'] == '0') ? 'selected="selected"' : '';
	echo "><option value='0' $selected>";
        _e('None','WPSupersized');
        echo '</option>';
	$selected = ($options['picasa_sort_by'] == '1') ? 'selected="selected"' : '';
	echo "<option value='1' $selected>";
        _e('Date published','WPSupersized');
        echo '</option>';
	$selected = ($options['picasa_sort_by'] == '2') ? 'selected="selected"' : '';
	echo "<option value='2' $selected>";
        _e('Date updated','WPSupersized');
        echo '</option></select> (';
        _e('Default is Date published','WPSupersized');
        echo ')</tr>';

        // picasa_sort_direction
	echo '<tr valign="top"><th scope="row">';
        _e('Sort direction','WPSupersized');
	echo '</th><td><select id="picasa_sort_direction" name="picasa_sort_direction"';
	$selected = ($options['picasa_sort_direction'] == '0') ? 'selected="selected"' : '';
	echo "><option value='0' $selected>";
        _e('Descending','WPSupersized');
        echo '</option>';
	$selected = ($options['picasa_sort_direction'] == '1') ? 'selected="selected"' : '';
	echo "<option value='1' $selected>";
        _e('Ascending','WPSupersized');
        echo '</option></select> (';
        _e('Default is Descending','WPSupersized');
        echo ')</tr>';

	// picasa_auth_key
	echo '<tr valign="top"><th scope="row">';
        _e('Picasa Author key','WPSupersized');
	echo '</th><td><input type="text" name="picasa_auth_key" value="'.$options['picasa_auth_key'].'" size="60"></input><br />';
        echo '(';
        _e('required for private albums, found in the URL of the link to an album (each album has a different author key)','WPSupersized');
        echo ')</td></tr>';

        
        // close stuff and submit data
	echo '<input type="hidden" name="wp-supersized_submit_picasa" value="true"></input>';
	echo '</table><br /><br />';
	echo '<p><input class="button-primary" type="submit" name="wp-supersized_submit_picasa" value="';
        _e('Update Options &raquo;','WPSupersized');
        echo '"><input style="margin-left: 250px;" class="button-secondary" type="submit" name="reset_options" onclick="return confirm(&#39;';
        _e('Do you really want to restore the default options?','WPSupersized');
        echo '&#39;)" value="';
        _e('Reset Options &raquo;','WPSupersized');
        echo '"></p>';
         
        wp_nonce_field('wp-supersized_admin_options_update','wp-supersized_admin_nonce');
	
	echo '</form>';
	echo "</div>";
        }
        
        function smugmug_options($options) { 
	echo '<table class="form-table">';
	
	// smugmug_source
	echo '<tr valign="top"><th scope="row">';
        _e('Smugmug Source','WPSupersized');
	echo '</th><td><select id="smugmug_source" name="smugmug_source"';
	$selected = ($options['smugmug_source'] == '1') ? 'selected="selected"' : '';
	echo "><option value='1' $selected>";
        _e('Keyword','WPSupersized');
        echo '</option>';
	$selected = ($options['smugmug_source'] == '2') ? 'selected="selected"' : '';
	echo "<option value='2' $selected>";
        _e('User (+keyword)','WPSupersized');
        echo '</option>';
	$selected = ($options['smugmug_source'] == '3') ? 'selected="selected"' : '';
	echo "<option value='3' $selected>";
        _e('Gallery','WPSupersized');
        echo '</option>';
	$selected = ($options['smugmug_source'] == '4') ? 'selected="selected"' : '';
	echo "<option value='4' $selected>";
        _e('Category','WPSupersized');
	echo '</option></select> (';
        _e('default is Gallery','WPSupersized');
        echo ')</tr>';

        // smugmug_keyword
	echo '<tr valign="top"><th scope="row">';
        _e('Smugmug keyword','WPSupersized');
	echo '</th><td><input type="text" name="smugmug_keyword" value="'.$options['smugmug_keyword'].'" size="100"></input><br />(';
        _e('Comma-separated Smugmug keywords (they are combined) !!no space!!','WPSupersized');
        echo ')</td></tr>';

        // smugmug_user
	echo '<tr valign="top"><th scope="row">';
        _e('Smugmug user nickname','WPSupersized');
	echo '</th><td><input type="text" name="smugmug_user" value="'.$options['smugmug_user'].'" size="30"></input></td></tr>';

        // smugmug_gallery
	echo '<tr valign="top"><th scope="row">';
        _e('Smugmug gallery ID','WPSupersized');
	echo '</th><td><input type="text" name="smugmug_gallery" value="'.$options['smugmug_gallery'].'" size="50"></input></td></tr>';

        // smugmug_category
	echo '<tr valign="top"><th scope="row">';
        _e('Smugmug category','WPSupersized');
	echo '</th><td><input type="text" name="smugmug_category" value="'.$options['smugmug_category'].'" size="50"></input></td></tr>';

        // smugmug_total_slides
	echo '<tr valign="top"><th scope="row">';
        _e('How many pictures to pull','WPSupersized');
	echo '</th><td><input type="text" name="smugmug_total_slides" value="'.$options['smugmug_total_slides'].'" size="5"></input><br />';
        _e('Between 1-100 (default is 100). This is currently the maximum allowed by the Google Feed API used by the plugin to get the images','WPSupersized');
        echo '</td></tr>';
	
        // smugmug_image_size
	echo '<tr valign="top"><th scope="row">';
        _e('Smugmug Size','WPSupersized');
	echo '</th><td><select id="smugmug_image_size" name="smugmug_image_size"';
	$selected = ($options['smugmug_image_size'] == '0') ? 'selected="selected"' : '';
	echo "><option value='0' $selected>Tiny</option>";
	$selected = ($options['smugmug_image_size'] == '1') ? 'selected="selected"' : '';
	echo "<option value='1' $selected>Thumb</option>";
	$selected = ($options['smugmug_image_size'] == '2') ? 'selected="selected"' : '';
	echo "<option value='2' $selected>Small</option>";
	$selected = ($options['smugmug_image_size'] == '3') ? 'selected="selected"' : '';
	echo "<option value='3' $selected>Medium</option>";
	$selected = ($options['smugmug_image_size'] == '4') ? 'selected="selected"' : '';
	echo "<option value='4' $selected>Large</option>";
	$selected = ($options['smugmug_image_size'] == '5') ? 'selected="selected"' : '';
	echo "<option value='5' $selected>XLarge</option>";
	$selected = ($options['smugmug_image_size'] == '6') ? 'selected="selected"' : '';
	echo "<option value='6' $selected>X2Large</option>";
        $selected = ($options['smugmug_image_size'] == '7') ? 'selected="selected"' : '';
	echo "<option value='7' $selected>X3Large</option>";
	$selected = ($options['smugmug_image_size'] == '8') ? 'selected="selected"' : '';
	echo "<option value='8' $selected>Original</option>";
	echo '</select> (';
        _e('default is Medium','WPSupersized');
	echo ')<br />';
        _e('Details ','WPSupersized');
        echo '<a href="http://help.smugmug.com/customer/portal/articles/93250">';
        _e('here', 'WPSupersized');
        echo'</a>';
        echo '</td></tr>';

        // smugmug_sort_by
	echo '<tr valign="top"><th scope="row">';
        _e('Sort images by','WPSupersized');
	echo '</th><td><select id="smugmug_sort_by" name="smugmug_sort_by"';
	$selected = ($options['smugmug_sort_by'] == '0') ? 'selected="selected"' : '';
	echo "><option value='0' $selected>";
        _e('None (original order)','WPSupersized');
        echo '</option>';
	$selected = ($options['smugmug_sort_by'] == '1') ? 'selected="selected"' : '';
	echo "<option value='1' $selected>";
        _e('Date posted','WPSupersized');
        echo '</option></select> (';
        _e('Default is Date posted','WPSupersized');
        echo ')</tr>';

        // smugmug_sort_direction
	echo '<tr valign="top"><th scope="row">';
        _e('Sort direction','WPSupersized');
	echo '</th><td><select id="smugmug_sort_direction" name="smugmug_sort_direction"';
	$selected = ($options['smugmug_sort_direction'] == '0') ? 'selected="selected"' : '';
	echo "><option value='0' $selected>";
        _e('Descending','WPSupersized');
        echo '</option>';
	$selected = ($options['smugmug_sort_direction'] == '1') ? 'selected="selected"' : '';
	echo "<option value='1' $selected>";
        _e('Ascending','WPSupersized');
        echo '</option></select> (';
        _e('Default is Descending','WPSupersized');
        echo ')</tr>';
        
        // close stuff and submit data
	echo '<input type="hidden" name="wp-supersized_submit_smugmug" value="true"></input>';
	echo '</table><br /><br />';
	echo '<p><input class="button-primary" type="submit" name="wp-supersized_submit_smugmug" value="';
        _e('Update Options &raquo;','WPSupersized');
        echo '"><input style="margin-left: 250px;" class="button-secondary" type="submit" name="reset_options" onclick="return confirm(&#39;';
        _e('Do you really want to restore the default options?','WPSupersized');
        echo '&#39;)" value="';
        _e('Reset Options &raquo;','WPSupersized');
        echo '"></p>';
         
        wp_nonce_field('wp-supersized_admin_options_update','wp-supersized_admin_nonce');
	
	echo '</form>';
	echo "</div>";
        }
        
    function display_tabs($current = 'functionality') {
    $tabs = array( 'functionality' => 'Functionality', 'display' => 'Display', 'origin' => 'Slides source', 'size_and_position' => 'Size and position', 'components' => 'Components', 'flickr' => 'Flickr', 'picasa' => 'Picasa', 'smugmug' => 'Smugmug' ); 
    $links = array();
    foreach($tabs as $tab => $name) {
        if ($tab == $current) $links[] = '<a class="nav-tab nav-tab-active" href="?page=wp-supersized&tab='.$tab.'">'.$name.'</a>';
        else $links[] = '<a class="nav-tab" href="?page=wp-supersized&tab='.$tab.'">'.$name.'</a>'; 
    } 
    echo '<h2>'; 
    foreach ( $links as $link ) 
        echo $link; 
    echo '</h2>'; 
	}        
        ?>