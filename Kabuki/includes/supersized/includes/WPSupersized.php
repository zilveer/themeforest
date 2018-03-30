<?php
/*
* class WPSupersized
*
* Contains the functions for the plugin
* WP Supersized that
* adds Supersized 3.2.7 to WordPress 
*
*/

if ( !class_exists('WPSupersized') ):
class WPSupersized
{
	const plugin_name = 'WP Supersized';
        const plugin_version = '3.1.1';
	const min_php_version = '5.2';
	const min_wordpress_version = '3.1'; 
	const supersized_theme_name = 'shutter'; // should eventually be replaced by an option
	const supersized_version = '3.2.7';
	const supersized_core_version = '3.2.1';
	const supersized_flickr_version = '1.1.2.mod';
	const supersized_picasa_version = '1.0';
	const supersized_smugmug_version = '1.0';
        const supersized_date_version = '1.0.a1';
        const supersized_jquery_easing_version = '1.3';
        const supersized_jquery_easing_compatibility_version = '1.0';
        
        
   /*
   * 
   * initialize()
   * This is the initialisation of the plugin
   * The required scripts and css files are registered here for later use
   */
     public static function initialize() {
		WPSupersized_Test::min_php_version(self::min_php_version, self::plugin_name);
		WPSupersized_Test::min_wordpress_version(self::min_wordpress_version, self::plugin_name);
                self::load_translation_file();
		wp_register_style('supersized', get_template_directory_uri().'/includes/supersized/css/supersized.css');
		wp_register_style('supersized_core', get_template_directory_uri().'/includes/supersized/css/supersized.core.css');
                wp_register_style('supersized_flickr', get_template_directory_uri().'/supersized/css/supersized.flickr.css'); // for the flickr version 1.1.2, old css still needed
		wp_register_style('supersized_theme_css', get_template_directory_uri().'/includes/supersized/theme/supersized.'.self::supersized_theme_name.'.css');
                wp_register_style('supersized_admin_jquery_ui','http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css'); // jQuery UI theme
                wp_register_script('WPSupersized_standard', get_template_directory_uri().'/includes/supersized/js/supersized.'.self::supersized_version.'.min.js',array('jquery'),self::supersized_version);
		wp_register_script('WPSupersized_core', get_template_directory_uri().'/includes/supersized/js/supersized.core.'.self::supersized_core_version.'.min.js',array('jquery'),self::supersized_core_version);
		wp_register_script('WPSupersized_flickr', get_template_directory_uri().'/includes/supersized/js/supersized.flickr.'.self::supersized_flickr_version.'.js',array('jquery'),self::supersized_flickr_version);
		wp_register_script('WPSupersized_picasa', get_template_directory_uri().'/includes/supersized/js/supersized.picasa.'.self::supersized_picasa_version.'.js',array('jquery'),self::supersized_picasa_version);
		wp_register_script('WPSupersized_smugmug', get_template_directory_uri().'/includes/supersized/js/supersized.smugmug.'.self::supersized_smugmug_version.'.js',array('jquery'),self::supersized_smugmug_version);
		wp_register_script('WPSupersized_date', get_template_directory_uri().'/includes/supersized/js/date.'.self::supersized_date_version.'.js',array('jquery'),self::supersized_date_version);
		wp_register_script('WPSupersized_theme_js', get_template_directory_uri().'/includes/supersized/theme/supersized.'.self::supersized_theme_name.'.min.js',array('jquery'));
		wp_register_script('WPSupersized_theme_visible_tray_js', get_template_directory_uri().'/includes/supersized/theme/supersized.'.self::supersized_theme_name.'.visible_tray.min.js',array('jquery'));
		wp_register_script('jquery_easing', get_template_directory_uri().'/includes/supersized/js/jquery.easing.min.js',array('jquery'),self::supersized_jquery_easing_version);
		wp_register_script('jquery_easing_compatibility', get_template_directory_uri().'/includes/supersized/js/jquery.easing.compatibility.js',array('jquery'),self::supersized_jquery_easing_compatibility_version);
}

    /*
    * Controller that generates admin page
    */


    public static function generate_admin_page()
{
include('admin_page.php');
}

    /*
    * Adds a menu item inside the WordPress admin
    */

    public static function add_menu_item()
    {
    add_submenu_page(
	'themes.php', // parent slug
    'Background Configuration', // page title
    'Background Slider', // menu title
    'manage_options', // permissions
    'wp-supersized', // page-name (used in the URL)
    'WPSupersized::generate_admin_page' // clicking callback function
    );
    }

    /*
    *  is_chosen_page
    *
    * Check for chosen page for display
    * @return boolean   Simple true/false as to whether the current page is chosen or not.
    */
    public static function is_chosen_page() {
	$where = get_option('wp-supersized_options');
        
        global $wp_query;
	$postid = $wp_query->post->ID;
	$custom_field_exists = get_post_meta($postid, 'SupersizedDir', true); // gets custom field outside of the loop
        
        if ($custom_field_exists && $custom_field_exists != '' && (is_single() || is_page())) // use Supersized if the custom field SupersizedDir exists (only for pages or posts)
            return true; // This will then override other options
        
        if($where['show_on_page']['everywhere'] == true)
            return true;
        
        if($where['show_in_page_id']['0'] !== '')
        {
            foreach ($where['show_in_page_id'] as $pageindex => $pageid)
            {
                if (is_page($pageid))
                    return true;                    
            }
        }
        
        if($where['show_in_template'])
        {
        $condition= false;
        foreach ($where['show_in_template'] as $i => $template_is_set)
        {
            if($template_is_set == true)
            { 
                $condition = true;}
        }

            if ($condition)
            {
            $templates_array = $where['templates_list'];
            reset($where['show_in_template']);
            foreach ($templates_array as $template_name => $template_filename)
            {
                if (is_page_template($template_filename) && $where['show_in_template'][$template_name])
                {
                return true;     }               
            }
            }
        }
        
        if($where['show_in_post_id'][0] !== '')
        {
            foreach ($where['show_in_post_id'] as $postindex => $postid)
            {
                if (is_single($postid))
                    return true;                    
            }
        }
        
        if($where['show_in_category_id'][0] !== '')
        {
                if ((in_category($where['show_in_category_id']) || self::post_is_in_descendant_category($where['show_in_category_id'])) && is_single()) // checks for category or subcategory ID
                    return true;                    
        }

        if($where['show_in_tag_id'][0] !== '')
        {
                if (has_tag($where['show_in_tag_id']) && is_single())
                    return true;                    
        }

       	return(($where['show_on_page']['tag_archive'] && is_tag()) || ($where['show_on_page']['category_archive'] && is_category()) || ($where['show_on_page']['sticky_post'] && is_sticky()) || ($where['show_on_page']['allposts'] && is_single()) || ($where['show_on_page']['allpages'] && is_page()) || ($where['show_on_page']['homepage'] && is_home()) || ($where['show_on_page']['front_only'] && is_front_page()) || ($where['show_on_page']['404_page'] && is_404()) || ($where['show_on_page']['search_results'] && is_search()) || ($where['show_on_page']['date_archive'] && is_date()) || ($where['show_on_page']['any_archive'] && is_archive())) ; 

        
}

	/*
	*
	* _Supersized_scripts
	*
	*/
	public static function _Supersized_scripts() {
		  if (!is_admin() && self::is_chosen_page()) // conditional scripts enqueing - registering done in initialize
	{
            $options = self::get_custom_options();      

			switch($options['slideshow'])
			{
			case 1:
                                wp_enqueue_script('jquery');
                                wp_enqueue_script('jquery_easing');
                                wp_enqueue_script('jquery_easing_compatibility');
				wp_enqueue_script('WPSupersized_standard');
                                if($options['tray_visible']) wp_enqueue_script('WPSupersized_theme_visible_tray_js');
                                    else wp_enqueue_script('WPSupersized_theme_js');
				break;
			case 2:
				wp_enqueue_script('jquery');
				wp_enqueue_script('WPSupersized_core');
				break;
			case 3:
				wp_enqueue_script('jquery');
				wp_enqueue_script('WPSupersized_flickr');
				break;
			case 4:
				wp_enqueue_script('jquery');
				wp_enqueue_script('WPSupersized_picasa');
				break;
			case 5:
				wp_enqueue_script('jquery');
                                wp_enqueue_script('WPSupersized_date');
				wp_enqueue_script('WPSupersized_smugmug');
				break;
			
			} 
	}
        elseif (is_admin()) { // for tabs in post/page admin metabox
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-widget');
            wp_enqueue_script('jquery-ui-tabs');
        }
}
	/*
	*
	* _Supersized_styles
	*
	*/
	public static function _Supersized_styles() {
		  if (!is_admin() && self::is_chosen_page()) // conditional css enqueing - registering done in initialize
	{
            $options = self::get_custom_options();      

                        switch($options['slideshow'])
			{
			case 1:
				wp_enqueue_style('supersized');
                                wp_enqueue_style('supersized_theme_css');
				break;
			case 2:
				wp_enqueue_style('supersized_core');  

				break;
			case 3:
				wp_enqueue_style('supersized_flickr'); //uses the old css for flickr
                                break;
			case 4:
				wp_enqueue_style('supersized_flickr'); //uses the old css for flickr for Picasa also
                                break;
			case 5:
				wp_enqueue_style('supersized_flickr'); //uses the old css for flickr for Smugmug also
				break;
			
			} 
	}
}
   /*
   *
   * This is the Supersized Header part.
   * Outputs all scripts and options.
   */
      public static function addHeaderCode() {  

	if (!is_admin() && self::is_chosen_page())
        {
            $options = self::get_custom_options();
            $options = self::convert_empty_options_to_zero($options);
            $errorMsg = '';
        ?>
	<!--
	Supersized <?php echo self::supersized_version; ?> - Fullscreen Background jQuery Plugin
	www.buildinternet.com/project/supersized
	
	By Sam Dunn / One Mighty Roar (www.onemightyroar.com)
	Released under MIT License / GPL License
 
        Adapted for Wordpress (<?php echo self::plugin_name.' '.self::plugin_version; ?>) by Benoit De Boeck / World in my Eyes (www.worldinmyeyes.be)
	-->
        
		<script type="text/javascript">  
			jQuery(document).ready(function($) {
				$.supersized({
				<?php
				if ($options['slideshow'] !== 2) // Some options not needed for Single image mode
				{
				?>
					slideshow               : 1,
					autoplay		: <?php echo $options['autoplay']; ?>,
                                <?php
				}
                                ?>
					start_slide             : <?php echo $options['start_slide']; ?>,
                                <?php
                                if ($options['slideshow'] !== 2) // Some options not needed for Single image mode
                                {
				?>
					random			: <?php echo $options['random']; ?>,
					slide_interval          : <?php echo $options['slide_interval']; ?>,
					transition              : <?php echo $options['transition']; ?>,
					transition_speed	: <?php echo $options['transition_speed']; ?>,
					new_window		: <?php echo $options['new_window']; ?>,
					pause_hover             : <?php echo $options['pause_hover']; ?>,
                                        stop_loop               : <?php echo $options['stop_loop']; ?>,
					keyboard_nav            : <?php echo $options['keyboard_nav']; ?>,
					performance		: <?php echo $options['performance']; ?>,
                                        
                                <?php
				}
				?>
					image_protect		: <?php echo $options['image_protect']; ?>,
					image_path		: '<?php echo content_url()?>/themes/Kabuki/includes/supersized/<?php if($options['slideshow'] >= '3') echo 'flickr_';?>img/',
					min_width		: <?php echo $options['min_width']; ?>,
					min_height		: <?php echo $options['min_height']; ?>,
					vertical_center         : <?php echo $options['vertical_center']; ?>,
					horizontal_center       : <?php echo $options['horizontal_center']; ?>,
                                        fit_always         	: <?php echo $options['fit_always']; ?>,
					fit_portrait         	: <?php echo $options['fit_portrait']; ?>,
					fit_landscape		: <?php echo $options['fit_landscape']; ?>,
				<?php
                                if ($options['slideshow'] !== 2) // Some options not needed for Single image mode
				{
                                ?>
					thumbnail_navigation    : <?php echo $options['thumbnail_navigation']; ?>,
                                        thumb_links             : <?php echo $options['thumb_links']; ?>,
					slide_counter           : <?php echo $options['slide_counter']; ?>,
					slide_captions          : <?php echo $options['slide_captions']; ?>,  
                                <?php
				}
                                if ($options['slideshow'] == 3) // Options for Flickr mode
				{
                                ?>      source                  : <?php echo $options['flickr_source']; ?>,
                                        set                     : '<?php echo $options['flickr_set']; ?>',
                                        user                    : '<?php echo $options['flickr_user']; ?>',
                                        group                   : '<?php echo $options['flickr_group']; ?>',
                                        tags                    : '<?php echo $options['flickr_tags']; ?>',
                                        total_slides            : <?php echo $options['flickr_total_slides']; ?>,
                                        image_size              : '<?php echo $options['flickr_size']; ?>',
                                        sort_by                 : <?php echo $options['flickr_sort_by']; ?>,
                                        sort_direction          : <?php echo $options['flickr_sort_direction']; ?>,
                                        api_key                 : '<?php echo $options['flickr_api_key']; ?>'
				<?php
				}
                                if ($options['slideshow'] == 4) // Options for Picasa mode
				{
                                ?>      source                  : <?php echo $options['picasa_source']; ?>,
                                        album                   : '<?php echo $options['picasa_album']; ?>',
                                        user                    : '<?php echo $options['picasa_user']; ?>',
                                        tags                    : '<?php echo $options['picasa_tags']; ?>',
                                        total_slides            : <?php echo $options['picasa_total_slides']; ?>,
                                        image_size              : '<?php echo $options['picasa_image_size']; ?>',
                                        sort_by                 : <?php echo $options['picasa_sort_by']; ?>,
                                        sort_direction          : <?php echo $options['picasa_sort_direction']; ?>,
                                        auth_key                : '<?php echo $options['picasa_auth_key']; ?>'
				<?php
				}
                                if ($options['slideshow'] == 5) // Options for Smugmug mode
				{
                                ?>      source                  : <?php echo $options['smugmug_source']; ?>,
                                        keyword                 : '<?php echo $options['smugmug_keyword']; ?>',
                                        user                    : '<?php echo $options['smugmug_user']; ?>',
                                        gallery                 : '<?php echo $options['smugmug_gallery']; ?>',
                                        category                : '<?php echo $options['smugmug_category']; ?>',
                                        total_slides            : <?php echo $options['smugmug_total_slides']; ?>,
                                        image_size              : '<?php echo $options['smugmug_image_size']; ?>',
                                        sort_by                 : <?php echo $options['smugmug_sort_by']; ?>,
                                        sort_direction          : <?php echo $options['smugmug_sort_direction']; ?>,
				<?php
				}                                
                                if ($options['slideshow'] < 3) // Options not needed for Flickr, Picasa, or Smugmug modes
                                {
				?>
					slides                  :  [<?php $errorMsg = self::slides_list(); //outputs the list of slides in the correct format
                                ?>],
                                        slide_links             : '<?php echo $options['slide_links']; ?>',
                                        progress_bar		: <?php echo $options['progress_bar']; ?>,						
					mouse_scrub		: <?php echo $options['mouse_scrub']; }?>												
				}); 
		    });
		</script>
            <?php
        echo $errorMsg;
                                }
}		
   /*
   *
   * This is the Supersized Footer part.
   * Adds the Navigation.
   */
      public static function addFooterCode() {
	if (!is_admin() && self::is_chosen_page()) // only on the right pages
        {
            $options = self::get_custom_options();      
            $options = self::convert_empty_options_to_zero($options);
            
            if ($options['navigation'] && $options['slideshow'] >= 3) { // only for old flickr look (also for Picasa and Smugmug mode)
                        ?> 
                        	<!--Thumbnail Navigation-->
	<div id="prevthumb"></div> <div id="nextthumb"></div>

	<!--Control Bar-->
	<div id="controls-wrapper">
		<div id="controls">
			<?php
			if ($options['slide_counter']) // Needed to get rid of the slide counter if switched off
			{
			?>
			<!--Slide counter-->
			<div id="slidecounter">
				<span class="slidenumber"></span>/<span class="totalslides"></span>
			</div>
			<?php
			}
			?>
			<!--Slide captions displayed here-->
			<div id="slidecaption"></div>
			<?php
			if ($options['navigation_controls']) // If true, show navigation controls
			{
			?>
			
			<!--Navigation-->
			<div id="navigation">
                            <img id="prevslide" src="<?php echo get_template_directory_uri(); ?>/includes/supersized/flickr_img/back_dull.png"/><img id="pauseplay" src="<?php echo get_template_directory_uri(); ?>/includes/supersized/flickr_img/pause_dull.png"/><img id="nextslide" src="<?php echo get_template_directory_uri(); ?>/includes/supersized/flickr_img/forward_dull.png"/>
			</div>			

                        <?php 
                        }
                        ?>        </div>
                        </div> <?php // closing the controls-wrapper and controls
                        } // end of the old flickr part
                        
			else {
                            global $totalSlides; // total number of slides in the file, used for the display (or not) of the navigation
                            if ($options['navigation'] && $options['slideshow'] == '1' && $totalSlides > 1) // to get rid of all navigation if switched off or when in Single image mode
                            {
                        
                        }
                        if ($options['navigation'] && $options['slideshow'] == '1' && $totalSlides > 1) // to get rid of all navigation if switched off or when in Single image mode
			{
                        if ($options['progress_bar'])
                        {
                        }
                        ?>
                        <!--Control Bar-->
                        <div id="controls-wrapper" class="load-item">
                        <div id="controls">
                        
						<?php if ($options['navigation_controls'] && $options['slideshow'] == '1' && $totalSlides > 1) // If true, show navigation arrows
                        {
                        ?>
			<!-- Arrow Navigation -->
			<div id="sup-nav-top"><a id="prevslide" class="load-item"></a>
            <a id="nextslide" class="load-item"></a>
                        <?php
                        }
						?>
						
						<a id="play-button"><img id="pauseplay" src="<?php echo get_template_directory_uri(); ?>/includes/supersized/img/pause.png" alt="pause" /></a></div>
                        
			<?php
                                if ($options['slide_counter']) // If true, show slide counter
			{
			?>
			<!--Slide counter-->
			<?php
			}
                        }
                                if ($options['slide_captions'] && !$options['navigation'] && $options['slideshow'] == '1') // Show slide caption (when the navigation option is off)
                        { // if navigation is off and the caption is still shown, set controls-wrapper background to none: only the caption is shown. Useful for html.
                        ?>
                        <div id="controls-wrapper" style="background: none;"><div id="controls">
			<!--Slide captions displayed here-->
			<div id="slidecaption"></div><?php if(is_admin_bar_showing()) { ?> </div></div> <?php } ?>
                        <?php
                        }
                                elseif ($options['slide_captions'] && $options['navigation'] && $options['slideshow'] == '1') // Show captions when navigation is on
                        {
                        ?>
			<!--Slide captions displayed here-->
			<div id="slidecaption"></div><?php if(is_admin_bar_showing()) { ?> </div></div> <?php } ?>
                        <?php
                        }
                        if ($options['navigation'] && $options['slideshow'] == '1' && $totalSlides > 1) // to get rid of all navigation if switched off or when in Single image mode
			{                
                                if ($options['thumb_tray']) // If true, show thumb tray button
			{
			?>
            <!--Thumb Tray button-->
			
                        <?php
                        }
                         ?>
			
		</div>
	</div>
	<?php
}
}
}
}

	/*
	*
	* Reads and outputs the list of slides
	* Returns error message $errorMsg
        * 
	*/
	
        public static function slides_list()
	{
	$options = get_option('wp-supersized_options');
        
        if (substr($options['default_dir'],0,11) != 'ngg-gallery_') 
            $full_dir = self::get_custom_dir($options['default_dir']); // if no NextGEN gallery has been selected as default, then go through the normal routine
        else
            $full_dir = $options['default_dir']; // if a NextGEN gallery has been selected as default
        
        if ($full_dir == 'not_found_error') {
                self::output_error_image('not_found'); // if the directory does not exists, display error image (directory/file not found)
                return;
        }
        
        if ($full_dir == 'not_readable_error') {
            self::output_error_image('not_readable'); // if the directory cannot be read (permissions), display error image (check permissions)
            return;
        }

        if (self::is_xml_file($full_dir)) { // checks if custom dir is an xml file
            $xml_file = WP_CONTENT_DIR.'/'.$full_dir;
            $xml = simplexml_load_file($xml_file);
            global $xmlSlidesArray; // global to avoid parsing the xml file each time it is needed
            $xmlSlidesArray = $xml->xpath('//slide');
            if (is_array($xmlSlidesArray) && count($xmlSlidesArray) > 0) { // if there are slides defined in the xml file, display them, rtrim() is needed because the 'slide' array contains a few spaces even if there are no slides (bug of xmlLib ?)
                self::slides_list_from_xml();
                return;
            }
            else $full_dir = $options['default_dir']; // if there are no slides defined in the xml file, display the default ones
        }
        
         if ($full_dir == 'wp-gallery') { // does the user want to use the Wordpress Media gallery ?
            global $wp_query;
            $postid = $wp_query->post->ID;
			self::images_from_wpgallery($postid);
            return;
        }
        
         if ($full_dir == 'ngg-gallery' && method_exists('nggdb','get_gallery')) { // does the user want to use the NextGen gallery ? (only if NextGen is installed and the function get_gallery exists)
            global $wp_query;
            $postid = $wp_query->post->ID;
            $nggGallery_ID = get_post_meta($postid, 'SupersizedNextGenGallery', true); // gets custom field outside of the loop
            self::images_from_ngg_gallery($nggGallery_ID);
            return;
        }
        
        if (substr($full_dir,0,12) == 'ngg-gallery_' && substr($full_dir,12) != ''  && method_exists('nggdb','get_gallery')) { // use a NextGEN gallery if it was selected as default in the options.
            $nggGallery_ID = substr($full_dir, 12);
            self::images_from_ngg_gallery($nggGallery_ID);
            return;
        }
        
        if ($full_dir) {
            $dir = self::build_wpcontent_dir()."/".$full_dir."/";
            $thumbs_dir = $dir."thumbs/";
            $dirArray = glob($dir."*.{jpg,JPG,png,PNG,gif,GIF,jpeg,JPEG}",GLOB_BRACE);
            if(empty($dirArray)) $dirArray = array_merge((array)glob($dir."*.jpg"),(array)glob($dir."*.JPG"),(array)glob($dir."*.png"),(array)glob($dir."*.PNG"),(array)glob($dir."*.gif"),(array)glob($dir."*.GIF"),(array)glob($dir."*.jpeg"),(array)glob($dir."*.JPEG")); // if the BRACE option does not work, use array_merge
            asort($dirArray); //dirArray is sorted to make sure that it is in alphabetical order
        }
                
        else {
            $thumbsdirArray = $dirArray = $thumbs_dir = $dir = '';
        }
        
        if ($options['debugging_mode']) {
            $nl = "\n";
            $errorMsg = '<!-- WP Supersized debugging info'.$nl;
            $errorMsg .= 'site_url = '.site_url().$nl;
            $errorMsg .= 'home_url = '.home_url().$nl;
           $errorMsg .= 'full_dir = '.$full_dir.$nl;
           $errorMsg .= 'dir = '.$dir.$nl;
           $errorMsg .= 'thumbs_dir = '.$thumbs_dir.$nl;
           $errorMsg .= 'dirArray = '.serialize($dirArray).$nl;
           $errorMsg .= '-->'.$nl;
        }
        else $errorMsg ='';
        
        if (file_exists($thumbs_dir) && !self::is_empty_dir($thumbs_dir)) {
            $thumbsdirArray = array_merge((array)glob($thumbs_dir."*.jpg"),(array)glob($thumbs_dir."*.JPG"),(array)glob($thumbs_dir."*.png"),(array)glob($thumbs_dir."*.PNG"),(array)glob($thumbs_dir."*.gif"),(array)glob($thumbs_dir."*.GIF"),(array)glob($thumbs_dir."*.jpeg"),(array)glob($thumbs_dir."*.JPEG")); // $thumbsdirArray = glob($thumbs_dir."*.{jpg,JPG,png,PNG,gif,GIF,jpeg,JPEG}",GLOB_BRACE);
            if(empty($thumbsdirArray)) $thumbsdirArray = glob($thumbs_dir."*.{jpg,JPG,png,PNG,gif,GIF,jpeg,JPEG}",GLOB_BRACE); // if the array_merge method does not work, use the BRACE option
            asort($thumbsdirArray); //thumbsdirArray is sorted to make sure that it is in alphabetical order
            foreach ($thumbsdirArray as $key => $path) {
                $shortthumbsdirArray[$key] = str_ireplace(self::build_wpcontent_dir(), '', $path); // removes the wp-content part of the path to allow the use of content_url()
            }
        }
        else $shortthumbsdirArray = $thumbsdirArray = $thumbs_dir = '';
        
        foreach ($dirArray as $key => $path) {
            $short_dirArray[$key] = str_ireplace(self::build_wpcontent_dir(), '', $path);
	}
        
        $indexCount = count($dirArray);
        if ($options['background_url'])
            $full_background_url = "http://".$options['background_url'];
        else $full_background_url = '';

         // loops through the array of files and print them all
				
				if ($indexCount >= 1 && $dir) // only show the slides if there is at least 1 and there is a dir containing images
				{
                                        global $totalSlides;
                                        $totalSlides = $indexCount;
					for($index=0; $index < $indexCount-1; $index++) {
						$iptc_caption = self::_show_iptc_caption($dirArray[$index]);
						$converted_caption = self::asciitothmlcode($iptc_caption);
                                                if ($thumbs_dir && file_exists($thumbs_dir))
                                                    $thumbnail_link = content_url().$shortthumbsdirArray[$index];
                                                else $thumbnail_link = '';
                                                echo "\n{image : '" . content_url().$short_dirArray[$index] . "', title : '".$converted_caption."', thumb : '".$thumbnail_link."', url : '" . $full_background_url . "'},";
						}
					
					$iptc_caption = self::_show_iptc_caption($dirArray[$index]);
					$converted_caption = self::asciitothmlcode($iptc_caption);
                                        if ($thumbs_dir && file_exists($thumbs_dir))
                                            $thumbnail_link = content_url().$shortthumbsdirArray[$index];
                                        else $thumbnail_link = '';
                                        echo "\n{image : '" . content_url().$short_dirArray[$index] . "', title : '" . $converted_caption ."', thumb : '".$thumbnail_link . "', url : '" . $full_background_url . "'}"; // The last line MUST be without comma
				}
				else // otherwise show the original Supersized examples
					echo "\n{image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.1/slides/quietchaos-kitty.jpg', title : 'Quiet Chaos by Kitty Gallannaugh', url : 'http://www.nonsensesociety.com/2010/12/kitty-gallannaugh/'},\n{image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.1/slides/wanderers-kitty.jpg', title : 'Wanderers by Kitty Gallannaugh', url : 'http://www.nonsensesociety.com/2010/12/kitty-gallannaugh/'}";
	
        return $errorMsg; // returns a debugging message (if debugging mode selected, otherwise $errorMsg is empty)
        }
          
         /*
         *
         * output_error_image($errorType)
         * Shows an error image in case a problem was detected
         * The image shown depends on $errorType
         *  
         */
        
        public static function output_error_image($errorType) {
            switch ($errorType) {
                case 'not_found' :
                    echo "\n{image : '".get_template_directory_uri()."/includes/supersized/img/error_img/cannot_find_your_dir_or_file_please_check_that_it_exists.jpg', title : 'Cannot find your dir or file please check that it exists', url : ''}\n"; 
                    break;
                case 'not_readable' :
                    echo "\n{image : '".get_template_directory_uri()."/includes/supersized/img/error_img/cannot_read_your_dir_or_file_please_check_access_rights.jpg', title : 'Cannot read your dir or file please check access rights', url : ''}\n"; 
                    break;
                case 'wp-gallery_images_not_present' :
                    echo "\n{image : '".get_template_directory_uri()."/includes/supersized/img/error_img/cannot_find_wp_media_gallery_images.jpg', title : 'Cannot find WP Gallery images attached to this post/page', url : ''}\n"; 
                    break;
                case 'nextgen-gallery_images_not_present' :
                    echo "\n{image : '".get_template_directory_uri()."/includes/supersized/img/error_img/cannot_find_nextgen_gallery_images_requested.jpg', title : 'Cannot find WP Gallery images attached to this post/page', url : ''}\n"; 
                    break;
            }
        }
        
  	/*
	*
	* Reads and outputs the list of slides from an XML file from which the contents have been copied in the global array $xmlSlidesArray
	*
	*/              
        
        public static function slides_list_from_xml() {
        
	
        global $xmlSlidesArray; // global to avoid parsing the xml file each time it is needed
        $xmlArray = $xmlSlidesArray;
        $indexCount = count($xmlArray);
       
        // loops through the array of files and prints them all
                if ($indexCount >= 1) // only show the slides if there is at least 1
                {
                        global $totalSlides;
                        $totalSlides = $indexCount;
                        for($index=0; $index < $indexCount-1; $index++) {
                            echo "\n{image : '" . $xmlArray[$index]->slide_link . "', title : '".$xmlArray[$index]->title."', thumb : '".$xmlArray[$index]->thumb_link."', url : '" . $xmlArray[$index]->url . "'},";
                                }				
                            echo "\n{image : '" . $xmlArray[$index]->slide_link . "', title : '".$xmlArray[$index]->title."', thumb : '".$xmlArray[$index]->thumb_link."', url : '" . $xmlArray[$index]->url . "'}";
                                }
                else // otherwise show the original Supersized examples - this should never be reached as there is already a check earlier
                        echo "\n{image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.1/slides/quietchaos-kitty.jpg', title : 'Quiet Chaos by Kitty Gallannaugh', url : 'http://www.nonsensesociety.com/2010/12/kitty-gallannaugh/'},\n{image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.1/slides/wanderers-kitty.jpg', title : 'Wanderers by Kitty Gallannaugh', url : 'http://www.nonsensesociety.com/2010/12/kitty-gallannaugh/'}";
        }

         /*
         * 
         * custom_options_from_xml($customXml)
         * Gets the custom options from the xml file $customXml
         * Returns the array $customOptions
         */
        
        public static function custom_options_from_xml($customXml) {
            
//            $xml_file = content_url().'/'.$customXml;
            $xml_file = WP_CONTENT_DIR.'/'.$customXml;
            $xml = simplexml_load_file($xml_file);
            $optionsXml = $xml->xpath('//options');
            $optionsFromXml = array();
            foreach($optionsXml[0] as $key => $value) {
                $optionsFromXml[$key] = (int) $value; // converts the object $value into a integer
            }
            return $optionsFromXml;
        }
            
	/*
	*
	* get_custom_dir ($default_dir)
	* checks if default dir and custom dir exist
	* and returns the correct dir for display
	*
	*/
	
	public static function get_custom_dir($default_dir) {
            
		global $post; // $wp_query;
		$postid = $post->ID; //$wp_query->post->ID;
		$custom_dir = get_post_meta($postid, 'SupersizedDir', true); // gets custom field outside of the loop

                $full_custom_dir = self::build_wpcontent_dir().'/'.$custom_dir;
                $full_default_dir = self::build_wpcontent_dir().'/'.$default_dir;

                if (self::is_xml_file($custom_dir) && file_exists($full_custom_dir) && (is_single() || is_page())) // checks if custom dir is an xml file
                return $custom_dir;

                if ((strtolower($custom_dir) == 'wp-gallery' || strtolower($custom_dir) == 'wpgallery' || strtolower($custom_dir) == 'wp_gallery') && (is_single() || is_page())) {
                    $custom_dir = 'wp-gallery';
                    return $custom_dir; // checks if the user wants to use the Wordpress Media Gallery
                }
                
                if ((strtolower($custom_dir) == 'ngg-gallery' || strtolower($custom_dir) == 'ngggallery' || strtolower($custom_dir) == 'ngg_gallery') && (is_single() || is_page())) {
                    $custom_dir = 'ngg-gallery';
                    return $custom_dir; // checks if the user wants to use the NextGen Gallery
                }
                
                if (substr($custom_dir,0,12) == 'ngg-gallery_' && substr($custom_dir,12) != '' && (is_single() || is_page())) { // use a NextGEN gallery if it was selected as default in the options.
                    return $custom_dir;
                }
                
                if ($custom_dir == 'flickr' && (is_single() || is_page())) { // use Flickr if selected
                    $custom_dir = 'flickr';
                    return $custom_dir;
                }

                if ($custom_dir == 'picasa' && (is_single() || is_page())) { // use Flickr if selected
                    $custom_dir = 'picasa';
                    return $custom_dir;
                }

                if ($custom_dir == 'smugmug' && (is_single() || is_page())) { // use Flickr if selected
                    $custom_dir = 'smugmug';
                    return $custom_dir;
                }
                
                if ($custom_dir && (!is_dir($full_custom_dir) || !file_exists($full_custom_dir)) && (is_single() || is_page()))
                    return 'not_found_error'; // if the directory does not exist, return an error
                if ($custom_dir && (!is_readable($full_custom_dir)) && (is_single() || is_page()))
                    return 'not_readable_error'; // if the directory is not readable (due to access rights), return an error
                if ($default_dir && is_dir($full_default_dir) && (is_tag() || is_category() || is_archive() || is_date())) // to make sure that the Tag or category archive gets the right dir  
                        return $default_dir;
                if ($custom_dir && is_dir($full_custom_dir) && (is_single() || is_page())) // to make sure that the custom dir images only appear on single posts/pages and not in tag or category archives      
                        return $custom_dir;
                
                return $default_dir; // if no other choice, return default dir
	}

        /*
         * 
         * get_custom_options()
         * Gets the custom options for an XML file, Flickr, Picasa or Smugmug when they are defined on a page/post
         * Returns array $options
         * 
         */
        
        public static function get_custom_options() {
            $options = get_option('wp-supersized_options');
            $customDir = self::get_custom_dir($options['default_dir']);
            global $wp_query;
            $postid = $wp_query->post->ID;

            if ($customDir == '') return $options; // if there is no custom slideshow defined for this page/post, do not go further

            // if a non-default source of images has been defined in the post or page, then use the corresponding slideshow mode. To make sure that the custom field-defined source of image is used, even when the slideshow mode is not the default.
            if (self::is_xml_file($customDir)) { // checks if custom dir is an xml file
                global $customOptions; // $customOptions set to global to avoid parsing the xml file by calling custom_options_from_xml() each time it is needed
                if (is_array($customOptions) && count($customOptions) != 0) { // if custom options from xml file are present
                    foreach($customOptions as $key => $value) {
                    if ($options[$key] != $customOptions[$key])
                        $options[$key] = $customOptions[$key];  // replaces general option by corresponding custom option from xml file
                    }
                }
                $options['slideshow'] = 1;
                return $options;
            }
            if ($customDir == 'wp-gallery' || $customDir == 'ngg-gallery') {
                $options['slideshow'] = 1;
                return $options;
            }
            if ($customDir == 'flickr') {
                $flickrOptionsString = get_post_meta($postid, 'SupersizedFlickrOptions', true); // gets custom field outside of the loop
                $flickrOptions = explode('#SZ#',$flickrOptionsString);
                $options['flickr_source'] = $flickrOptions[0];
                $options['flickr_set'] = $flickrOptions[1];
                $options['flickr_user'] = $flickrOptions[2];
                $options['flickr_group'] = $flickrOptions[3];
                $options['flickr_tags'] = $flickrOptions[4];
                $options['flickr_total_slides'] = $flickrOptions[5];
                $options['flickr_size'] = $flickrOptions[6];
                $options['flickr_sort_by'] = $flickrOptions[7];
                $options['flickr_sort_direction'] = $flickrOptions[8];
                $options['flickr_api_key'] = $flickrOptions[9];
                $options['slideshow'] = 3;
                return $options;
            }
            if ($customDir == 'picasa') {
                $picasaOptionsString = get_post_meta($postid, 'SupersizedPicasaOptions', true); // gets custom field outside of the loop
                $picasaOptions = explode('#SZ#',$picasaOptionsString);
                $options['picasa_source'] = $picasaOptions[0];
                $options['picasa_album'] = $picasaOptions[1];
                $options['picasa_user'] = $picasaOptions[2];
                $options['picasa_tags'] = $picasaOptions[3];
                $options['picasa_total_slides'] = $picasaOptions[4];
                $options['picasa_image_size'] = $picasaOptions[5];
                $options['picasa_sort_by'] = $picasaOptions[6];
                $options['picasa_sort_direction'] = $picasaOptions[7];
                $options['picasa_auth_key'] = $picasaOptions[8];
                $options['slideshow'] = 4;
                return $options;
            }
            if ($customDir == 'smugmug') {
                $smugmugOptionsString = get_post_meta($postid, 'SupersizedSmugmugOptions', true); // gets custom field outside of the loop
                $smugmugOptions = explode('#SZ#',$smugmugOptionsString);
                $options['smugmug_source'] = $smugmugOptions[0];
                $options['smugmug_keyword'] = $smugmugOptions[1];
                $options['smugmug_user'] = $smugmugOptions[2];
                $options['smugmug_gallery'] = $smugmugOptions[3];
                $options['smugmug_category'] = $smugmugOptions[4];
                $options['smugmug_total_slides'] = $smugmugOptions[5];
                $options['smugmug_image_size'] = $smugmugOptions[6];
                $options['smugmug_sort_by'] = $smugmugOptions[7];
                $options['smugmug_sort_direction'] = $smugmugOptions[8];
                $options['slideshow'] = 5;
                return $options;
            }
            $options['slideshow'] = 1;
            return $options; // if none of the above options is selected, then it is a custom folder that needs to be used.
        }
        
        /*
         * 
         * build_wpcontent_dir()
         * Builds the correct wp-content directory path
         * Returns $wpContentDir
         * 
         */
        
        public static function build_wpcontent_dir(){
            $home_url = home_url();
            if (defined('ICL_SITEPRESS_VERSION')) // checks for the presence of WPML
                $home_url = self::clean_wpml_home_url();
            
            $wordpressDir = ltrim(str_replace($home_url,'',site_url()),"/"); // removes the root url and the leading slash if present
            if ($wordpressDir !== '') $slash="/";
                else $slash='';
            $wpContentDir = $wordpressDir.$slash.'wp-content';
            return $wpContentDir;
        }
        
         /*
         *
         * images_from_wpgallery($post_ID)
         * generates and outputs the list of slides from Wordpress Media Gallery images attached to the post $post_ID
         * @param type $post_ID 
         */
        
        public static function images_from_wpgallery($post_ID) {
        
        
        global $wp_query;
	$postid = $wp_query->post->ID;
        
        $options = get_option('wp-supersized_options');
        if ($options['background_url'])
        $full_background_url = "http://".$options['background_url'];
        else $full_background_url = '';
        
        $full_output ='';
        $images = get_children(array( // gets images attached to the post/page
		'post_parent'    => $postid,
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		'post_mime_type' => 'image',
                                ));
	if($images) {
                global $totalSlides;
                $totalSlides = count($images);
                $images = self::sort_wpgallery_array($images); // sorts the images according to the menu order defined in Wordpress Media Gallery
            
		foreach($images as $image) {
			$wpgallery_url   = wp_get_attachment_url($image->ID); // full link to the full size image
			$wpgallery_thumburl = wp_get_attachment_thumb_url($image->ID); // full link to the thumbnail
			$wpgallery_title = apply_filters('the_title',$image->post_title); // image title
			$wpgallery_caption = apply_filters('post_excerpt',$image->post_excerpt); // image caption
                        
                        if ($wpgallery_caption == '')
                            $wpgallery_caption = $wpgallery_title; // if there is no caption, use title instead

            $full_output = $full_output."\n{image : '" . $wpgallery_url . "', title : '".$wpgallery_caption."', thumb : '".$wpgallery_thumburl."', url : '" . $full_background_url . "'},";
		}
            $full_output = substr( $full_output, 0, -1 )."\n"; // removes the trailing comma to avoid trouble in IE
            echo $full_output;

	}
        else self::output_error_image('wp-gallery_images_not_present'); // if there are no WP Gallery images attached to the post/page, display error image

}        
        
         /*
         *
         * images_from_ngg_gallery($nggAlbum_ID)
         * generates and outputs the list of slides from NextGen Gallery album $nggAlbum_ID
         * @param type $nggAlbum_ID 
         */
        
        public static function images_from_ngg_gallery($nggGallery_ID) {
        
        if (method_exists('nggdb','get_gallery')) { // if NextGen is installed and the function get_gallery exists
            $options = get_option('wp-supersized_options');
            if ($options['background_url'])
            $full_background_url = "http://".$options['background_url'];
            else $full_background_url = '';
            $full_output ='';

            $imagesList = nggdb::get_gallery($nggGallery_ID, 'sortorder', 'ASC'); // calls the NextGen Gallery function to retrieve the content of the NextGen gallery with ID $nggGallery_ID. Images are sorted in ascending order of Sort Order.

            if($imagesList) {            // if there are images in the gallery
                global $totalSlides;
                $totalSlides = count($imagesList);
		foreach($imagesList as $image) {
			$ngggallery_url   = $image->imageURL; // full link to the full size image
			$ngggallery_thumburl = $image->thumbURL; // full link to the thumbnail
			$ngggallery_title = $image->alttext; // image title
			$ngggallery_caption = $image->description; // image caption
                        
                        if ($ngggallery_caption == '')
                            $ngggallery_caption = $ngggallery_title; // if there is no caption, use title instead

            $full_output = $full_output."\n{image : '" . $ngggallery_url . "', title : '".$ngggallery_caption."', thumb : '".$ngggallery_thumburl."', url : '" . $full_background_url . "'},";
		}
                
            $full_output = substr( $full_output, 0, -1 )."\n"; // removes the trailing comma to avoid trouble in IE
            echo $full_output;

	}
        else self::output_error_image('nextgen-gallery_images_not_present'); // if the requested NextGEN Gallery images are not present, display error image
        }
}           
        
         /*
         * 
         * is_xml_file($dir)
         * Checks if dir is an xml file
         * 
         */
        
        public static function is_xml_file($dir)
        {
        if (substr($dir, strlen($dir)-4,4) == '.xml') // very basic check for dir = xml file
            return true;
        else return false;
        }

        /*
         *
         * convert_empty_options_to_zero($options) 
         * Converts empty values of options to 0 and false to 1
         * Returns $options with correct 0 or 1 values
         * 
         */
        
        public static function convert_empty_options_to_zero($options) {
            
        foreach($options as $key => $value) {
            switch($value)
            {
               case 'true': // replaces true by 1
                  $options[$key] = 1;
                  break;
               case '': // and empty by 0
                  $options[$key] = 0;
                  if ($key == 'picasa_auth_key') $options[$key] = ''; // necessary to avoid trouble with the Picasa script
                  break;
            }
        }
        return $options;
        }
        
         /*
         * 
         * is_empty_dir($dir)
         * Checks if a folder is empty
         * 
         */
      
         public static function is_empty_dir($dir)
        {
        if (($files = @scandir($dir)) && count($files) <= 2) {
            return true;
            }
        return false;
        }

         /*
         *
         * clean_wpml_home_url()
         * Transforms the wpml home url into a correct home url
         * Returns $home_url
         *  
         */

        public static function clean_wpml_home_url()
                
        {
            $home_url = rtrim(icl_get_home_url(),'/');
	    $search_string = '/'.ICL_LANGUAGE_CODE;
	    $home_url = str_replace($search_string,'',$home_url); // gets rid of the language code at the end of the url generated by wpml
            $search_string = '?lang='.ICL_LANGUAGE_CODE;
            $home_url = str_replace($search_string,'',$home_url); // in case it was the other option of wpml, gets rid of the language code at the end of the url generated by wpml
            return $home_url;
        }

        /*
	*
	* _show_iptc_caption($filename)
	* gets IPTC caption and returns it
	*
	*/
        
	public static function _show_iptc_caption($filename) {
        $size = getimagesize($filename, $info);
		if(isset($info['APP13'])) {
			$iptc = iptcparse($info['APP13']);
        	if (is_array($iptc)) { 
				if ($iptc['2#120'][0] != '') {
        			$caption = $iptc['2#120'][0]; 
				} else {
					$caption = $iptc['2#105'][0];	
				}
			}
        } else {
			$caption = null;
		}
        return $caption;         }   
        
         /*
         * 
         * sort_wpgallery_array($images)
         * Sorts the array of images from the Wordpress Media Gallery according to the order defined in the gallery
         * Returns the sorted array
         * 
         */
        
        public static function sort_wpgallery_array($arrImages) {

        $arrKeys = array_keys($arrImages); // Get array keys representing attached image numbers
 
        // Put all image objects into new array with standard numeric keys (new array only needed while we sort the keys)
        foreach($arrImages as $oImage) {
            $arrNewImages[] = $oImage;
        }
 
        // Bubble sort image object array by menu_order
        for($i = 0; $i < sizeof($arrNewImages) - 1; $i++) {
            for($j = 0; $j < sizeof($arrNewImages) - 1; $j++) {
                if((int)$arrNewImages[$j]->menu_order > (int)$arrNewImages[$j + 1]->menu_order) {
                    $oTemp = $arrNewImages[$j];
                    $arrNewImages[$j] = $arrNewImages[$j + 1];
                    $arrNewImages[$j + 1] = $oTemp;
                }
            }
        }
        return $arrNewImages;
        }
		
	/*
	*
	* Installation - Sets the options defaults
    * Done only once at activation
	*
	*/
	public static function install () {
        $previous_options = get_option('wp-supersized_options');
        $newoptions = array();
        if ( (isset($previous_options['reset_options']) && $previous_options['reset_options']) || empty($previous_options)) { // if reset or fresh install
	// options for version 1.0
        $newoptions['slideshow'] = '1';
		$newoptions['autoplay'] = 'true';
        $newoptions['start_slide'] = '1';
		$newoptions['random'] = '';
		$newoptions['slide_interval'] = '3000';
		$newoptions['transition'] = '1';
		$newoptions['transition_speed'] = '500';
		$newoptions['new_window'] = 'true';
		$newoptions['pause_hover'] = '';
		$newoptions['keyboard_nav'] = 'true';
		$newoptions['performance'] = '1';
		$newoptions['image_protect'] = '';
		$newoptions['min_width'] = '0';
		$newoptions['min_height'] = '0';
		$newoptions['vertical_center'] = 'true';
		$newoptions['horizontal_center'] = 'true';
		$newoptions['fit_portrait'] = 'true';
		$newoptions['fit_landscape'] = '';
		$newoptions['navigation'] = 'true';
		$newoptions['thumbnail_navigation'] = '';
		$newoptions['navigation_controls'] = 'true';
		$newoptions['slide_counter'] = 'false';
		$newoptions['slide_captions'] = 'true';
		$newoptions['flickr_source'] = '3';
		$newoptions['flickr_set'] = '';
		$newoptions['flickr_user'] = '';
		$newoptions['flickr_group'] = '';
		$newoptions['flickr_total_slides'] = '100';
		$newoptions['flickr_size'] = 'z';
		$newoptions['flickr_api_key'] = '';
		$newoptions['show_in_page_id'] = array('0' => '');
		$newoptions['show_in_post_id'] = array('0' => '');       
		$newoptions['show_on_page'] = array('allposts' => '', 'homepage' => '', 'allpages' => '', 'front_only' => '', 'sticky_post' => '', '404_page' => '');
        if (function_exists ('get_page_templates') ) { $newoptions['templates_list'] = get_page_templates(); }
        foreach ($newoptions['templates_list'] as $templateID => $templatefilename)
            {
              $newoptions['show_in_template'][$templateID] = '';                      
            }
        }
        if ( (isset($previous_options['reset_options']) && $previous_options['reset_options']) || (is_array($previous_options) && !array_key_exists('default_dir', $previous_options)) || empty($previous_options)) { // if options already set for previous version, sets defaults for new options only    
        // new options for version 1.1
                $newoptions['show_on_page']['category_archive'] = '';
                $newoptions['show_on_page']['tag_archive'] = '';
                $newoptions['show_on_page']['only_custom'] = ''; // NOW DEPRECATED
                $newoptions['show_in_category_id'] = array('0' => '');
                $newoptions['show_in_tag_id'] = array('0' => '');
                $newoptions['stop_loop'] = '';
                $newoptions['fit_always'] = '';
                $newoptions['slide_links'] = 'blank';
                $newoptions['thumb_links'] = '';
                $newoptions['thumbnail_suffix'] = '-1';
                $newoptions['progress_bar'] = 'true';
                $newoptions['mouse_scrub'] = '';
                $newoptions['thumb_tray'] = 'false';
                $newoptions['default_dir'] = 'supersized-slides';
                $newoptions['reset_options'] = '';
        }
        if ( (isset($previous_options['reset_options']) && $previous_options['reset_options']) || (is_array($previous_options) && !array_key_exists('flickr_tags', $previous_options)) || empty($previous_options)) {
        // new option for version 1.1.1
                $newoptions['flickr_tags'] = '';             
        }
        if ( (isset($previous_options['reset_options']) && $previous_options['reset_options']) || (is_array($previous_options) && !array_key_exists('background_url', $previous_options)) || empty($previous_options)) {
	// new options for version 1.2
                $newoptions['show_on_page']['everywhere'] = '';
		$newoptions['show_on_page']['search_results'] = '';
		$newoptions['show_on_page']['any_archive'] = '';
		$newoptions['show_on_page']['date_archive'] = '';
		$newoptions['background_url'] = '';
        }        
        if ( (isset($previous_options['reset_options']) && $previous_options['reset_options']) || (is_array($previous_options) && !array_key_exists('debugging_mode', $previous_options)) || empty($previous_options)) {
        //new option for version 1.3
                $newoptions['debugging_mode'] = '';             
        }        
        if ( (isset($previous_options['reset_options']) && $previous_options['reset_options']) || (is_array($previous_options) && !array_key_exists('tray_visible', $previous_options)) || empty($previous_options)) {
        //new option for version 3.0.2
            $newoptions['tray_visible'] = ''; 
        }
        if ( (isset($previous_options['reset_options']) && $previous_options['reset_options']) || (is_array($previous_options) && !array_key_exists('picasa_source', $previous_options)) || empty($previous_options)) {
        //new options for version 3.1
                $newoptions['picasa_source'] = '1'; 
                $newoptions['picasa_album'] = ''; 
                $newoptions['picasa_user'] = ''; 
                $newoptions['picasa_tags'] = ''; 
                $newoptions['picasa_total_slides'] = '100'; 
                $newoptions['picasa_image_size'] = '1024'; 
                $newoptions['picasa_sort_by'] = '1'; 
                $newoptions['picasa_sort_direction'] = '0'; 
                $newoptions['picasa_auth_key'] = ''; 
                $newoptions['smugmug_source'] = '3'; 
                $newoptions['smugmug_keyword'] = ''; 
                $newoptions['smugmug_user'] = ''; 
                $newoptions['smugmug_gallery'] = ''; 
                $newoptions['smugmug_category'] = ''; 
                $newoptions['smugmug_total_slides'] = '100'; 
                $newoptions['smugmug_image_size'] = '3'; 
                $newoptions['smugmug_sort_by'] = '1'; 
                $newoptions['smugmug_sort_direction'] = '0'; 
                $newoptions['flickr_sort_by'] = '1'; 
                $newoptions['flickr_sort_direction'] = '0';
        }        
        else return; // do not modify the existing options

	update_option('wp-supersized_options', $newoptions); // Sets defaults for options
}
	//uninstall all options
	
         /*
         * 
         * Delete options when uninstalling the plugin
         * 
         */
        public static function uninstall () {
	delete_option('wp-supersized_options');
}

         /*
         * 
         * Adds the settings link for the plugin
         * 
         */

        public static function add_plugin_settings_link($links, $file)
        {
        $settings_link = sprintf('<a href="%s">%s</a>', admin_url( 'themes.php?page=wp-supersized' ), 'Settings');
        array_unshift( $links, $settings_link );
        return $links;
        }
       
/*
*
* asciitohtmlcode ($string)
* Replaces special characters by their html equivalents
* Returns $string
*
*/

public static function asciitothmlcode($string) {

    $asciiarray[] = 39; $htmlarray[] = "&#39;";
    $asciiarray[] = 192; $htmlarray[] = "&#192;";
    $asciiarray[] = 193; $htmlarray[] = "&#193;";
    $asciiarray[] = 194; $htmlarray[] = "&#194;";
    $asciiarray[] = 195; $htmlarray[] = "&#195;";
    $asciiarray[] = 196; $htmlarray[] = "&#196;";
    $asciiarray[] = 197; $htmlarray[] = "&#197;";
    $asciiarray[] = 198; $htmlarray[] = "&#198;";
    $asciiarray[] = 199; $htmlarray[] = "&#199;";
    $asciiarray[] = 200; $htmlarray[] = "&#200;";
    $asciiarray[] = 201; $htmlarray[] = "&#201;";
    $asciiarray[] = 202; $htmlarray[] = "&#202;";
    $asciiarray[] = 203; $htmlarray[] = "&#203;";
    $asciiarray[] = 204; $htmlarray[] = "&#204;";
    $asciiarray[] = 205; $htmlarray[] = "&#205;";
    $asciiarray[] = 206; $htmlarray[] = "&#206;";
    $asciiarray[] = 207; $htmlarray[] = "&#207;";
    $asciiarray[] = 208; $htmlarray[] = "&#208;";
    $asciiarray[] = 209; $htmlarray[] = "&#209;";
    $asciiarray[] = 210; $htmlarray[] = "&#210;";
    $asciiarray[] = 211; $htmlarray[] = "&#211;";
    $asciiarray[] = 212; $htmlarray[] = "&#212;";
    $asciiarray[] = 213; $htmlarray[] = "&#213;";
    $asciiarray[] = 214; $htmlarray[] = "&#214;";
    $asciiarray[] = 215; $htmlarray[] = "&#215;";
    $asciiarray[] = 216; $htmlarray[] = "&#216;";
    $asciiarray[] = 217; $htmlarray[] = "&#217;";
    $asciiarray[] = 218; $htmlarray[] = "&#218;";
    $asciiarray[] = 219; $htmlarray[] = "&#219;";
    $asciiarray[] = 220; $htmlarray[] = "&#220;";
    $asciiarray[] = 221; $htmlarray[] = "&#221;";
    $asciiarray[] = 222; $htmlarray[] = "&#222;";
    $asciiarray[] = 223; $htmlarray[] = "&#223;";
    $asciiarray[] = 224; $htmlarray[] = "&#224;";
    $asciiarray[] = 225; $htmlarray[] = "&#225;";
    $asciiarray[] = 226; $htmlarray[] = "&#226;";
    $asciiarray[] = 227; $htmlarray[] = "&#227;";
    $asciiarray[] = 228; $htmlarray[] = "&#228;";
    $asciiarray[] = 229; $htmlarray[] = "&#229;";
    $asciiarray[] = 230; $htmlarray[] = "&#230;";
    $asciiarray[] = 231; $htmlarray[] = "&#231;";
    $asciiarray[] = 232; $htmlarray[] = "&#232;";
    $asciiarray[] = 233; $htmlarray[] = "&#233;";
    $asciiarray[] = 234; $htmlarray[] = "&#234;";
    $asciiarray[] = 235; $htmlarray[] = "&#235;";
    $asciiarray[] = 236; $htmlarray[] = "&#236;";
    $asciiarray[] = 237; $htmlarray[] = "&#237;";
    $asciiarray[] = 238; $htmlarray[] = "&#238;";
    $asciiarray[] = 239; $htmlarray[] = "&#239;";
    $asciiarray[] = 240; $htmlarray[] = "&#240;";
    $asciiarray[] = 241; $htmlarray[] = "&#241;";
    $asciiarray[] = 242; $htmlarray[] = "&#242;";
    $asciiarray[] = 243; $htmlarray[] = "&#243;";
    $asciiarray[] = 244; $htmlarray[] = "&#244;";
    $asciiarray[] = 245; $htmlarray[] = "&#245;";
    $asciiarray[] = 246; $htmlarray[] = "&#246;";
    $asciiarray[] = 247; $htmlarray[] = "&#247;";
    $asciiarray[] = 248; $htmlarray[] = "&#248;";
    $asciiarray[] = 249; $htmlarray[] = "&#249;";
    $asciiarray[] = 250; $htmlarray[] = "&#250;";
    $asciiarray[] = 251; $htmlarray[] = "&#251;";
    $asciiarray[] = 252; $htmlarray[] = "&#252;";
    $asciiarray[] = 253; $htmlarray[] = "&#253;";
    $asciiarray[] = 254; $htmlarray[] = "&#254;";
    $asciiarray[] = 255; $htmlarray[] = "&#255;";

    $i = 0;
    while ($i < sizeof ($asciiarray)){
        $string = str_replace(chr($asciiarray[$i]), $htmlarray[$i], $string);
        $i++;
    }
    return $string;

}

/*
 * 
 * load_translation_file()
 * Loads the translation files during initialization
 * 
 */
public static function load_translation_file()
{
    if (is_admin()) {
$plugin_path = dirname(plugin_basename(__FILE__)).'/lang';
load_plugin_textdomain('WPSupersized',false,$plugin_path);
    }
}

/**
* Tests if any of a post's assigned categories are descendants of target categories
*
* @param int|array $cats The target categories. Integer ID or array of integer IDs
* @param int|object $_post The post. Omit to test the current post in the Loop or main query
* @return bool True if at least 1 of the post's categories is a descendant of any of the target
categories
* @see get_term_by() You can get a category by name or slug, then pass ID to this function
* @uses get_term_children() Passes $cats
* @uses in_category() Passes $_post (can be empty)
* @version 2.7
*/
public static function post_is_in_descendant_category( $cats, $_post = null )
{
    foreach ( (array) $cats as $cat ) {
        // get_term_children() accepts integer ID only
        $descendants = get_term_children( (int) $cat, 'category' );
        if ( $descendants && in_category( $descendants, $_post ) )
        return true;
    }
    return false;
}

}
endif;
/* EOF */