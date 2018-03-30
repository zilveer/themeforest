<?php 
/**
 * Initialize the options before anything else. 
 */
add_action( 'admin_init', 'custom_theme_options', 1 );

function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Create your own custom array that will be passes to the 
   * OptionTree Settings API Class.
   */
  $custom_settings = array(
    'contextual_help' => array(
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => 'General',
          'content'   => '<p>Help content goes here!</p>'
        )
      ),
      'sidebar'       => '<p>Sidebar content goes here!</p>',
    ),
    'sections'        => array(
	  array(
        'id'          => 'general',
        'title'       => 'General'
      ),
	  array(
        'id'          => 'gmaps',
        'title'       => 'Google Maps'
      ),
	  array(
        'id'          => 'home_page',
        'title'       => 'Home Page'
      ),
	  array(
        'id'          => 'home_sliders',
        'title'       => 'Home Sliders'
      ),
	  array(
        'id'          => 'footer',
        'title'       => 'Footer'
      )
    ),
    'settings'        => array(
	array(
        'id'          => 'logo_url',
        'label'       => 'Logo Url',
        'desc'        => 'Specify a path relative to the theme root folder',
        'std'         => 'images/heal_logo.png',
        'type'        => 'text',
        'section'     => 'general',
        'class'       => '',
      ),
       array(
        'id'          => 'email',
        'label'       => "Email",
        'desc'        => "",
        'std'         => 'example@mail.com',
        'type'        => 'text',
        'section'     => 'general',
        'class'       => '',
      ),
	  array(
        'id'          => 'telephone',
        'label'       => "Telephone",
        'desc'        => "",
        'std'         => '+474-7457-3749',
        'type'        => 'text',
        'section'     => 'general',
        'class'       => '',
      ),
	  array(
        'id'          => 'skype',
        'label'       => "Skype",
        'desc'        => "",
        'std'         => 'exampleskypeusername',
        'type'        => 'text',
        'section'     => 'general',
        'class'       => '',
      ),
	  array(
        'id'          => 'clinic_address',
        'label'       => "Clinic(s) Address",
        'desc'        => "If your clinic has branches in several locations simply list they addresses separated by (;) semicolon.",
        'std'         => '45 Silent River Street, New York; 3035 WalBoard Street, New York',
        'type'        => 'text',
        'section'     => 'general',
        'class'       => '',
      ),
	  array(
        'label'       => 'Slogan text',
        'id'          => 'slogan_text',
        'type'        => 'textarea',
        'desc'        => '',
        'std'         => 'Hello, this is <span class="blue-color">HEAL</span> - Premium ThemeForest Health Care Theme. After purchase you may change this text on whatever you want. ',
        'rows'        => '3',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	  array(
        'id'          => 'ga_id',
        'label'       => 'Google Analytics',
        'desc'        => "Enter here Google Analytics <b>Tracking ID</b>. <br />Don't know where to get Tracking ID? <a href='https://support.google.com/analytics/bin/answer.py?hl=en&topic=1006226&answer=1008080'>Click here</a>. Don't know what Google Analytics is? <a href='http://www.google.com/analytics/'>Click here</a>",
        'std'         => 'XXXXX-X',
        'type'        => 'text',
        'section'     => 'general',
        'class'       => '',
      ),
	  array(
        'id'          => 'post_number',
        'label'       => "Number of post in blog",
        'desc'        => 'Number of post that will be displayed on one page in blog.',
        'std'         => '4',
        'type'        => 'text',
        'section'     => 'general',
        'class'       => '',
      ),
	  array(
        'id'          => 'gallery_post_number',
        'label'       => "Number of image in gallery",
        'desc'        => 'Number of image that will be displayed on one page in gallery.',
        'std'         => '9',
        'type'        => 'text',
        'section'     => 'general',
        'class'       => '',
      ),
	  array(
        'label'       => '404 error text',
        'id'          => 'error_text',
        'type'        => 'textarea',
        'desc'        => '',
        'std'         => '<p>Sorry, but the page your are looking for has not been found. Try checking URL for error, then hit refresh button in your browser or return to <a href="index.php">home page</a></p>',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	  array(
        'id'          => 'gmaps_key',
        'label'       => 'Google Maps API Key',
        'desc'        => 'To learn more about obtaining you own key you should visit: <a href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key">Obtaining an API Key</a>',
        'std'         => ' ',
        'type'        => 'text',
        'section'     => 'gmaps',
        'class'       => '',
      ),
	  array(
        'id'          => 'map_center',
        'label'       => "Coordinates of map's center",
        'desc'        => 'Enter in following format: latitude,longitude.',
        'std'         => '40.709345,-73.99879',
        'type'        => 'text',
        'section'     => 'gmaps',
        'class'       => '',
      ),
	  array(
        'label'       => "Home map type",
        'id'          => 'home_map_type',
        'type'        => 'select',
        'desc'        => 'ROADMAP - displays the normal, default 2D tiles of Google Maps.<br />SATELLITE - displays photographic tiles.<br />HYBRID - displays a mix of photographic tiles and a tile layer for prominent features (roads, city names).<br />TERRAIN - displays physical relief tiles for displaying elevation and water features (mountains, rivers, etc.).',
        'choices'     => array(
          array(
            'label'       => 'HYBRID',
            'value'       => 'HYBRID'
          ),
          array(
            'label'       => 'SATELLITE',
            'value'       => 'SATELLITE'
          ),
          array(
            'label'       => 'ROADMAP',
            'value'       => 'ROADMAP'
          ),
		  array(
            'label'       => 'TERRAIN',
            'value'       => 'TERRAIN'
          )
        ),
        'std'         => 'HYBRID',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'gmaps'
      ),
	  array(
        'id'          => 'home_map_zoom',
        'label'       => "Home map zoom level",
        'desc'        => 'Zoom levels may be between 0 (the lowest zoom level, in which the entire world can be seen) to 21+ (individual buildings).',
        'std'         => '15',
        'type'        => 'text',
        'section'     => 'gmaps',
        'class'       => '',
      ),
	   array(
        'label'       => "Contact map type",
        'id'          => 'contact_map_type',
        'type'        => 'select',
        'desc'        => 'ROADMAP - displays the normal, default 2D tiles of Google Maps.<br />SATELLITE - displays photographic tiles.<br />HYBRID - displays a mix of photographic tiles and a tile layer for prominent features (roads, city names).<br />TERRAIN - displays physical relief tiles for displaying elevation and water features (mountains, rivers, etc.).',
        'choices'     => array(
          array(
            'label'       => 'HYBRID',
            'value'       => 'HYBRID'
          ),
          array(
            'label'       => 'SATELLITE',
            'value'       => 'SATELLITE'
          ),
          array(
            'label'       => 'ROADMAP',
            'value'       => 'ROADMAP'
          ),
		  array(
            'label'       => 'TERRAIN',
            'value'       => 'TERRAIN'
          )
        ),
        'std'         => 'ROADMAP',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'gmaps'
      ),
	  array(
        'id'          => 'contact_map_zoom',
        'label'       => "Contact map zoom level",
        'desc'        => 'Zoom levels may be between 0 (the lowest zoom level, in which the entire world can be seen) to 21+ (individual buildings).',
        'std'         => '15',
        'type'        => 'text',
        'section'     => 'gmaps',
        'class'       => '',
      ),
	   array(
        'id'          => 'clinic_name',
        'label'       => "Clinic(s) Name",
        'desc'        => "If your clinic has branches in several locations simply list they name separated by (;) semicolon.",
        'std'         => 'Heal Clinic 1; Heal Clinic 2',
        'type'        => 'text',
        'section'     => 'gmaps',
        'class'       => '',
      ),
	  array(
        'id'          => 'map_marker',
        'label'       => "Coordinates of map's marker",
        'desc'        => 'Enter in following format: latitude1, longitude1;latitude2, longitude2;latitudeN, longitudeN',
        'std'         => '40.710670, -73.999604; 40.716948, -73.997855',
        'type'        => 'text',
        'section'     => 'gmaps',
        'class'       => '',
      ),
	  array(
        'label'       => 'Site Section',
        'id'          => 'site_section',
        'type'        => 'checkbox',
        'desc'        => 'Specify does block with site section (or site feature) should shows at main page or not',
        'choices'     => array(
          array (
            'label'       => 'Off',
            'value'       => 'off'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home_page'
      ),
	  array(
        'label'       => 'From Blog Section',
        'id'          => 'from_blog',
        'type'        => 'checkbox',
        'desc'        => 'Specify does From Blog section should shows at main page or not',
        'choices'     => array(
          array (
            'label'       => 'Off',
            'value'       => 'off'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home_page'
      ),
	  array(
        'label'       => 'Info Section',
        'id'          => 'info',
        'type'        => 'checkbox',
        'desc'        => 'Specify does info section with latest news and google maps should shows at main page or not',
        'choices'     => array(
          array (
            'label'       => 'Off',
            'value'       => 'off'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home_page'
      ),
	  array(
        'label'       => 'Buy It Section',
        'id'          => 'buy_it',
        'type'        => 'checkbox',
        'desc'        => 'Specify does Buy It Section hould shows at main page or not',
        'choices'     => array(
          array (
            'label'       => 'Off',
            'value'       => 'off'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home_page'
      ),
	  array(
        'id'          => 'section_image1',
        'label'       => 'Site section image 1',
        'desc'        => "Specify a path relative to the theme's root folder",
        'std'         => 'images/news_img.png',
        'type'        => 'text',
        'section'     => 'home_page',
        'class'       => '',
      ),
	  array(
		'id'          => 'section_header1',
        'label'       => 'Site section header 1',
        'type'        => 'text',
        'desc'        => '',
        'std'         => 'Clinic News',
        'class'       => '',
        'section'     => 'home_page'
      ),
	  array(
        'label'       => 'Site section text 1',
        'id'          => 'section_text1',
        'type'        => 'textarea',
        'desc'        => '',
        'std'         => '<p>In this section you may find latest news of our clinic as well as information about other interesting thing.</p><a href="blog.html">Learn More &raquo;</a>',
        'rows'        => '7',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home_page'
      ),
	  array(
        'id'          => 'section_image2',
        'label'       => 'Site section image 2',
        'desc'        => "Specify a path relative to the theme's root folder",
        'std'         => 'images/care_img.png',
        'type'        => 'text',
        'section'     => 'home_page',
        'class'       => '',
      ),
	  array(
		'id'          => 'section_header2',
        'label'       => 'Site section header 2',
        'type'        => 'text',
        'desc'        => '',
        'std'         => 'Patient Care',
        'class'       => '',
        'section'     => 'home_page'
      ),
	  array(
        'label'       => 'Site section text 2',
        'id'          => 'section_text2',
        'type'        => 'textarea',
        'desc'        => '',
        'std'         => '<p>In this section you may find latest news of our clinic as well as information about other interesting thing.</p><a href="blog.html">Learn More &raquo;</a>',
        'rows'        => '7',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home_page'
      ),
	  array(
        'id'          => 'section_image3',
        'label'       => 'Site section image 3',
        'desc'        => "Specify a path relative to the theme's root folder",
        'std'         => 'images/contact_img.png',
        'type'        => 'text',
        'section'     => 'home_page',
        'class'       => '',
      ),
	  array(
		'id'          => 'section_header3',
        'label'       => 'Site section header 3',
        'type'        => 'text',
        'desc'        => '',
        'std'         => 'Contact Us',
        'class'       => '',
        'section'     => 'home_page'
      ),
	  array(
        'label'       => 'Site section text 3',
        'id'          => 'section_text3',
        'type'        => 'textarea',
        'desc'        => '',
        'std'         => '<p>In this section you may find latest news of our clinic as well as information about other interesting thing.</p><a href="blog.html">Learn More &raquo;</a>',
        'rows'        => '7',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home_page'
      ),
	  array(
		'id'          => 'from_blog_count',
        'label'       => 'Latest from blog count',
        'type'        => 'text',
        'desc'        => '',
        'std'         => '8',
        'class'       => '',
        'section'     => 'home_page'
      ),
	  array(
        'id'          => 'buy_it_text',
        'label'       => 'Buy it text',
        'desc'        => '',
        'std'         => 'Like this template? You may buy it on ThemeForest!',
        'type'        => 'text',
        'section'     => 'home_page',
        'class'       => '',
      ),
	  array(
        'id'          => 'buy_it_subtext',
        'label'       => 'Buy it subtext',
        'desc'        => '',
        'std'         => 'after purchased you may change this text on everything that you want',
        'type'        => 'text',
        'section'     => 'home_page',
        'class'       => '',
      ),
	  array(
        'id'          => 'buy_it_button_text',
        'label'       => 'Buy it button text',
        'desc'        => '',
        'std'         => 'Buy it',
        'type'        => 'text',
        'section'     => 'home_page',
        'class'       => '',
      ),
	  array(
        'id'          => 'buy_it_url',
        'label'       => 'Buy it url',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home_page',
        'class'       => '',
      ),
	  array(
        'label'       => 'Main slider effect',
        'id'          => 'effect',
        'type'        => 'select',
        'desc'        => "Set effect of slides change",
        'choices'     => array(
          array(
            'label'       => 'random',
            'value'       => 'random'
          ),
          array(
            'label'       => 'fade',
            'value'       => 'fade'
          ),
          array(
            'label'       => 'boxRandom',
            'value'       => 'boxRandom'
          ),
		  array(
            'label'       => 'sliceUp',
            'value'       => 'sliceUp'
          ),
		  array(
            'label'       => 'fold',
            'value'       => 'fold'
          ),
		  array(
            'label'       => 'boxRain',
            'value'       => 'boxRain'
          )
        ),
        'std'         => 'random',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home_sliders'
      ),
	  array(
        'id'          => 'pause_time',
        'label'       => 'Pause Time',
        'desc'        => 'Specify how long each slide will show',
        'std'         => '9000',
        'type'        => 'text',
        'section'     => 'home_sliders',
        'class'       => '',
      ),
	  array(
        'label'       => 'Pause on hover',
        'id'          => 'pause_hover',
        'type'        => 'checkbox',
        'desc'        => 'Specify does animation should stop while hovering or not',
        'choices'     => array(
          array (
            'label'       => 'Off',
            'value'       => 'off'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home_sliders'
      ),	
	  array(
        'id'          => 'footer_logo',
        'label'       => "Footer logo",
        'desc'        => "Specify a path relative to the theme root folder",
        'std'         => 'images/footer_logo.png',
        'type'        => 'text',
        'section'     => 'footer',
        'class'       => '',
      ),
	  array(
        'id'          => 'facebook_url',
        'label'       => 'Facebook Url',
        'desc'        => "If you leave this field blank icon will not be displayed",
        'std'         => 'http://www.facebook.com/enter_here_your_data',
        'type'        => 'text',
        'section'     => 'footer',
        'class'       => '',
      ),
	  array(
        'id'          => 'twitter_url',
        'label'       => 'Twitter Url',
        'desc'        => "If you leave this field blank icon will not be displayed",
        'std'         => 'https://twitter.com/enter_here_your_data',
        'type'        => 'text',
        'section'     => 'footer',
        'class'       => '',
      ),
	  array(
        'id'          => 'rss_url',
        'label'       => 'RSS Url',
        'desc'        => "If you leave this field blank icon will not be displayed",
        'std'         => 'enter_here_your_data',
        'type'        => 'text',
        'section'     => 'footer',
        'class'       => '',
      ),
	  array(
        'id'          => 'linkedin_url',
        'label'       => 'LinkedIn Url',
        'desc'        => "If you leave this field blank icon will not be displayed",
        'std'         => 'http://www.linkedin.com/enter_here_your_data',
        'type'        => 'text',
        'section'     => 'footer',
        'class'       => '',
      ),
	  array(
        'id'          => 'google_url',
        'label'       => 'Google+ Url',
        'desc'        => "If you leave this field blank icon will not be displayed",
        'std'         => 'https://plus.google.com/enter_here_your_data',
        'type'        => 'text',
        'section'     => 'footer',
        'class'       => '',
      ),
	array(
        'label'       => 'Copyright text',
        'id'          => 'copyright_text',
        'type'        => 'textarea',
        'desc'        => '',
        'std'         => 'Copyright &copy; 2012 <b>Heal</b> health and care theme. All right reserved.',
        'rows'        => '3',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer'
      )
    )
  );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}

?>