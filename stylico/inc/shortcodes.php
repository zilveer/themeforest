<?php

/*
 * Handy Shortcodes Class for managing all shortcodes easily
 *
*/

if(!class_exists('RadykalShortcodes')) {
	
	class RadykalShortcodes {
		
		//store shortcodes in an multidimensional array
		private $radykal_shortcodes = array( array('slug' => 'radykal_tag', 'name' => 'Tag', 'content' => 1),
		                                     array('slug' => 'radykal_dropcap', 'name' => 'Dropcap', 'content' => 1),
											 array('slug' => 'radykal_error_box', 'name' => 'Box: Error', 'content' => 1),
											 array('slug' => 'radykal_success_box', 'name' => 'Box: Success', 'content' => 1),
											 array('slug' => 'radykal_warning_box', 'name' => 'Box: Warning', 'content' => 1),
											 array('slug' => 'radykal_one_half', 'name' => 'Column: One Half', 'content' => 1),
											 array('slug' => 'radykal_one_half_last', 'name' => 'Column: One Half Last', 'content' => 1),
											 array('slug' => 'radykal_one_third', 'name' => 'Column: One Third', 'content' => 1),
											 array('slug' => 'radykal_one_third_last', 'name' => 'Column: One Third Last', 'content' => 1),
											 array('slug' => 'radykal_one_fourth', 'name' => 'Column: One Fourth', 'content' => 1),
											 array('slug' => 'radykal_one_fourth_last', 'name' => 'Column: One Fourth Last', 'content' => 1),
											 array('slug' => 'radykal_arrow_list', 'name' => 'List: Arrow', 'content' => 1),
											 array('slug' => 'radykal_button_blue', 'name' => 'Button: Blue Rounded', 'content' => 1),
											 array('slug' => 'radykal_button_red', 'name' => 'Button: Red Rounded', 'content' => 1),
											 array('slug' => 'radykal_button_green', 'name' => 'Button: Green Rounded', 'content' => 1),
											 array('slug' => 'radykal_button_big', 'name' => 'Button: Big Fullwidth', 'content' => 1),
											 array('slug' => 'radykal_table_zebra', 'name' => 'Table: Zebra', 'content' => 1),
											 array('slug' => 'radykal_table_box', 'name' => 'Table: Box', 'content' => 1),
											 array('slug' => 'radykal_ribbon_blue', 'name' => 'Ribbon: Blue', 'content' => 1),
											 array('slug' => 'radykal_ribbon_lila', 'name' => 'Ribbon: Lila', 'content' => 1),
											 array('slug' => 'radykal_ribbon_green', 'name' => 'Ribbon: Green', 'content' => 1),
											 array('slug' => 'radykal_framed_image', 'name' => 'Framed Image', 'content' => 1),
											 array('slug' => 'fancy_countdown', 'name' => 'Countdown', 'content' => 0),
											 array('slug' => 'radykal_gig', 'name' => 'Gig', 'content' => 1),
											 array('slug' => 'radykal_release', 'name' => 'Release', 'content' => 1),
											 array('slug' => 'radykal_next_gig', 'name' => 'Next Gig', 'content' => 0),
											 array('slug' => 'radykal_recent_release', 'name' => 'Recent Release', 'content' => 0)
											);								 
		
		public function __construct() {
									
			//sort array by name
			$this->aasort($this->radykal_shortcodes, 'name');
			
			//register shortcodes
			foreach( $this->radykal_shortcodes as $sc ) {
				add_shortcode( $sc['slug'], array( &$this, $sc['slug'].'_handler' ) );
			}		
			
			//add meta box
			add_action( 'add_meta_boxes',  array( &$this, 'add_radykal_shortcode_meta_box' ) );
			
			//some shortcodes needs maybe js or css file
			add_action( 'wp_print_styles', array( &$this,'add_styles' ) );
			add_action( 'wp_print_scripts', array( &$this,'add_scripts' ) );

		}
		
		public function add_radykal_shortcode_meta_box() {
			
			wp_enqueue_style( 'radykal-colorpicker' );
	        wp_enqueue_script( 'radykal-colorpicker' );
			wp_enqueue_style( 'jquery-ui-datepicker' );
	        wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_script('radykal-sc-metabox',  get_template_directory_uri().'/inc/shortcodes.js');
			
			add_meta_box( 'radykal-sc-meta', 'Theme Shortcodes', array( &$this, 'create_radykal_shortcode_meta_box' ), 'post' );
			add_meta_box( 'radykal-sc-meta', 'Theme Shortcodes', array( &$this, 'create_radykal_shortcode_meta_box' ), 'page' );
			add_meta_box( 'radykal-sc-meta', 'Theme Shortcodes', array( &$this, 'create_radykal_shortcode_meta_box' ), 'stylico-slide' );
			
		}
		
		//create meta box fpr addong the shortcode to a post or page
		public function create_radykal_shortcode_meta_box() {
	        
			?>
            <div style="float: left;">
                <p class="description">Select a shortcode</p>
                <select id="radykal-shortcodes" >
                <?php foreach( $this->radykal_shortcodes as $sc ) {
                     echo '<option value="'.$sc['slug'].'" data-content="'.$sc['content'].'">'.$sc['name'].'</option>';
                } 
                ?>
			</select>
            </div>
            <div id="radykal-sc-options" style="float: left; margin-left: 40px; width: 70%;">
                <div id="fancy_countdown">
                    <p class="description">Fancy Countdown Options</p>
                    <label for="year">Year:</label><input type="text" name="year" size="3" value="2012">
                    <label for="month">Month:</label><input type="text" name="month" size="3" value="12">
                    <label for="day">Day:</label><input type="text" name="day" size="3" value="31">
                    <label for="hour">Hour:</label><input type="text" name="hour" size="3" value="0">
                    <label for="minute">Minute:</label><input type="text" name="minute" size="3" value="0">
                    <label for="second">Second:</label><input type="text" name="second" size="3" value="0">
                    <label for="timezone">Timezone:</label><input type="text" name="timezone" size="3" value="0">
                    <label for="digitUnitWidth">Digit Unit Width:</label><input type="text" name="digitUnitWidth" size="3" value="40">
                    <label for="digitUnitHeight">Digit Unit Height:</label><input type="text" name="digitUnitHeight" size="3" value="60">
                    <label for="fillColor">Fill Color:</label><input type="text" name="fillColor" size="7" class="radykal-colorpicker" value="#1C1C27">
                </div>
                <div id="radykal_gig">
                    <p class="description">Gig Options</p>
                    <label for="date">Date:</label><input type="text" name="date" size="10" value="" class="radykal-datepicker">
                    <label for="venue">Venue:</label><input type="text" name="venue" size="10" value="">
                    <label for="website">Website:</label><input type="text" name="website" size="20" value="">
                    <label for="address">Address:</label><input type="text" name="address" size="20" value=""><br /><br />
                    <label for="image">Image Url:</label><input type="text" name="image" size="70" value="" class="radykal-image-upload">
                </div>
                <div id="radykal_release">
                    <p class="description">Release Options</p>
                    <label for="image">Image Url:</label><input type="text" name="image" size="70" value="" class="radykal-image-upload"><br /><br />
                    <label for="mp3">MP3 Url:</label><input type="text" name="mp3" size="70" value="" class="radykal-mp3-upload"><br /><br />
                    <label for="download">Download/Buy URL:</label><input type="text" name="download" size="70" value="">
                </div>
                <div id="radykal_framed_image">
                    <p class="description">Framed Image Options</p>
                    <label for="lightbox">Open in lightbox:</label><input type="checkbox" name="lightbox" value="1">
                </div>
            </div>
            <div class="clear"></div>
            <br /><br />
			<input type="submit" class="button-secondary" id="radykal-add-shortcode" value="Add Shortcode" />
			<?php
			
		}
		
		//includes styles for the shortcodes
		public function add_styles() {		
			if(!is_singular())
			  return;
			
			global $post;
			//search for the shortcode and if one is found, include the necessary styles
			if(strpos($post->post_content,'[fancy_countdown') !== false) {
				wp_enqueue_style('radykal-fancy-countdown', get_template_directory_uri().'/css/jquery.fancyCountdown-1.0.css');
			}
		}
		
		//includes scripts for the shortcodes
		public function add_scripts() {
			if(!is_singular())
			  return;
			
			global $post;
			//search for the shortcode and if one is found, include the necessary scripts		
			if(strpos($post->post_content,'[fancy_countdown') !== false) {
				wp_enqueue_script('cufon', get_template_directory_uri().'/js/cufon-yui.js');
				wp_enqueue_script('harabara-font', get_template_directory_uri().'/js/Harabara_700.font.js');
				wp_enqueue_script('radykal-fancy-countdown', get_template_directory_uri().'/js/jquery.fancyCountdown-1.0.min.js');
			}
		}
		
		//shortcode handlers
		public function radykal_tag_handler( $atts, $content = null ) {
			return '<span class="tagcloud">'.$content.'</span><span class="clear"></span>';
		}
		
		public function radykal_dropcap_handler( $atts, $content = null ) {
			return '<span class="dropcap">'.$content.'</span>';
		}
		
		public function radykal_error_box_handler( $atts, $content = null ) {
			return '<div class="error-box"><h5>Error</h5><span>'.$content.'</span></div>';
		}
		
		public function radykal_success_box_handler( $atts, $content = null ) {
			return '<div class="success-box"><h5>Success</h5><span>'.$content.'</span></div>';
		}
		
		public function radykal_warning_box_handler( $atts, $content = null ) {
			return '<div class="warning-box"><h5>Warning</h5><span>'.$content.'</span></div>';
		}
		
		public function radykal_one_half_handler( $atts, $content = null ) {
			return '<div class="one-half">'.do_shortcode($content).'</div>';
		}
		
		public function radykal_one_half_last_handler( $atts, $content = null ) {
			return '<div class="one-half last-column">'.do_shortcode($content).'</div><div class="clear"></div>';
		}
		
		public function radykal_one_third_handler( $atts, $content = null ) {
			return '<div class="one-third">'.do_shortcode($content).'</div>';
		}
		
		public function radykal_one_third_last_handler( $atts, $content = null ) {
			return '<div class="one-third last-column">'.do_shortcode($content).'</div><div class="clear"></div>';
		}
		
		public function radykal_one_fourth_handler( $atts, $content = null ) {
			return '<div class="one-fourth">'.do_shortcode($content).'</div>';
		}
		
		public function radykal_one_fourth_last_handler( $atts, $content = null ) {
			return '<div class="one-fourth last-column">'.do_shortcode($content).'</div><div class="clear"></div>';
		}
		
		public function radykal_arrow_list_handler( $atts, $content = null ) {
			return '<div class="arrow-list">'.do_shortcode($content).'</div><div class="clear"></div>';
		}
		
		public function radykal_button_blue_handler( $atts, $content = null ) {
			return '<span class="blue-button">'.$content.'</span>';
		}
		
		public function radykal_button_red_handler( $atts, $content = null ) {
			return '<span class="red-button">'.$content.'</span>';
		}
		
		public function radykal_button_green_handler( $atts, $content = null ) {
			return '<span class="green-button">'.$content.'</span>';
		}
		
		public function radykal_button_big_handler( $atts, $content = null ) {
			return '<span class="big-button">'.$content.'</span>';
		}
		
		public function radykal_table_zebra_handler( $atts, $content = null ) {
			return '<div class="zebra-table">'.$content.'</div>';
		}
		
		public function radykal_table_box_handler( $atts, $content = null ) {
			return '<div class="box-table">'.$content.'</div>';
		}
		
		public function radykal_ribbon_blue_handler( $atts, $content = null ) {
			return '<div class="ribbon ribbon-blue">'.$content.'</div>';
		}
		
		public function radykal_ribbon_lila_handler( $atts, $content = null ) {
			return '<div class="ribbon ribbon-lila">'.$content.'</div>';
		}
		
		public function radykal_ribbon_green_handler( $atts, $content = null ) {
			return '<div class="ribbon ribbon-green">'.$content.'</div>';
		}
		
		public function radykal_framed_image_handler( $atts, $content = null ) {
			
			extract( shortcode_atts( array(
					'lightbox' => 'true'
			), $atts ) );
						
			$lightbox = $lightbox == 'true' ? 'open-in-prettyphoto' : '';
						
			return '<span class="framed-image '.$lightbox. '">'.$content.'</span>';
		}
		
		public function radykal_next_gig_handler( $atts ) {
			global $stylico_theme_options;
			
			add_filter( 'posts_where', 'show_upcoming_gigs' );
			$query = new WP_Query( 'posts_per_page=1&post_type=gig&orderby=meta_value&meta_key=gig_date&order=ASC' );
			remove_filter( 'posts_where', 'show_upcoming_gigs' );
			
			if ($query->have_posts()) {
				 while ($query->have_posts()) {
					  $query->the_post();
					  
					  //get custom fields
                      $custom_fields = get_post_custom( get_the_ID() );
                      $gig_date = new DateTime( $custom_fields["gig_date"][0]);
                      $gig_website = $custom_fields["gig_website"][0];
					  $gig_address = $custom_fields["gig_address"][0];
					  
					  $image = '';
					  if ( has_post_thumbnail() ) {
						   $image_attributes = wp_get_attachment_image_src ( get_post_thumbnail_id ( get_the_ID() ), 'large');
						   $image = '<a href="'.$image_attributes[0].'" title="'.$stylico_theme_options['gigs']['image_link_title'].'" rel="prettyphoto">'.$stylico_theme_options['gigs']['image_link_title'].'</a>';
					  }
					  
					  $website = !empty($gig_website) ? '<a href="'.$gig_website.'" title="'.$stylico_theme_options['gigs']['website_link_title'].'" target="_blank">'.$stylico_theme_options['gigs']['website_link_title'].'</a>' : '';
					  $address = !empty($gig_address) ? '<a href="http://maps.google.com/?q='.urlencode($gig_address).'" title="Google Maps: '.$gig_address.'" target="_blank">'.$gig_address.'</a>' : '';
					  
					  $output = '<div class="clearfix">
					            <div class="gig-date"><div class="gig-day">'. $gig_date->format('d') .'</div ><div class="gig-month">'. $gig_date->format('M') .'</div ></div>
								<div class="gig-content">
								    <h4 class="gig-venue">'.get_the_title().'</h4>
									<span class="gig-text">'.get_the_content().'</span>
								    <div class="gig-sub-menu">
										'.$image.'
										'.$website.'
										'.$address.'
									</div>
								</div>
								</div>';
				 }
			     wp_reset_query();
			}
			else {
				$output = '<p>Sorry. There are no gigs in the future!</p>';
			}
			
			return $output;
		}
		
		public function radykal_recent_release_handler( $atts ) {
			
			global $stylico_theme_options;
			
			$query = new WP_Query( 'posts_per_page=1&post_type=release&orderby=date&order=ASC' );
			
			if ($query->have_posts()) {
				 while ($query->have_posts()) {
					  $query->the_post();
					  
					  //get custom fields
                      $custom_fields = get_post_custom( get_the_ID() );
                      $release_mp3 = $custom_fields["release_mp3"][0];
                      $release_download = $custom_fields["release_download"][0];
					  
					  $image = '';
					  if ( has_post_thumbnail() ) {
						   $image_attributes = wp_get_attachment_image_src ( get_post_thumbnail_id ( get_the_ID() ), 'large');
						   $image = '<a href="'.$image_attributes[0].'" title="'.get_the_title().'" rel="prettyphoto">'.get_the_post_thumbnail( get_the_ID(), array(90, 90), array('class' => 'record-image') ).'</a>';
					  }
					  
					  $mp3 = !empty($release_mp3) ? '<a href="'.$release_mp3.'" title="'.get_the_title().'" class="play-now fmp-my-track">'.$stylico_theme_options['releases']['play_button_text'].' <span class="record-play"></span></a>' : '';
					  $download = !empty($release_download) ? '<a href="'.$release_download.'" title="'.$stylico_theme_options['releases']['link_button_text'].'" target="_blank" class="buy-now">'.$stylico_theme_options['releases']['link_button_text'].' <span class="record-buy"></span></a>' : '';
					  
					  $output = '<div class="record clearfix">
								  '.$image.'
								  <div class="record-content">
									  <div class="record-text">'.get_the_content().'</div>
									  <div class="record-buttons">
										  '.$mp3.'
										  '.$download.'
									  </div>
								  </div>
								</div><div class="clear"></div>';
				 }
				 wp_reset_query();
			}
			else {
				$output = '<p>Sorry. There are no gigs in the future!</p>';
			}
			
			return $output;
		}
		
		public function radykal_gig_handler( $atts, $content = null ) {
			
			extract( shortcode_atts( array(
			        'date' => '',
					'venue' => '',
					'image' => '',
					'website' => '',
					'address' => ''
			), $atts ) );
			
			$date = new DateTime( $date );
			
			global $stylico_theme_options;
			$image = !empty($image) ? '<a href="'.$image.'" title="'.$stylico_theme_options['gigs']['image_link_title'].'" rel="prettyphoto">'.$stylico_theme_options['gigs']['image_link_title'].'</a>' : '';
			$website = !empty($website) ? '<a href="'.$website.'" title="'.$stylico_theme_options['gigs']['website_link_title'].'" target="_blank">'.$stylico_theme_options['gigs']['website_link_title'].'</a>' : '';
			$address = !empty($address) ? '<a href="http://maps.google.com/?q='.urlencode($address).'" title="Google Maps: '.$address.'" target="_blank">'.$address.'</a>' : '';
			
			$output = '<div class="clearfix">
						<div class="gig-date"><div class="gig-day">'. $date->format('d') .'</div ><div class="gig-month">'. $date->format('M') .'</div ></div>
						<div class="gig-content">
							<h4 class="gig-venue">'.$venue.'</h4>
							<span class="gig-text">'.$content.'</span>
							<div class="gig-sub-menu">
								'.$image.'
								'.$website.'
								'.$address.'
							</div>
						</div>
					  </div>';
			
			return $output;
		}
		
		public function radykal_release_handler( $atts, $content = null ) {
			
			extract( shortcode_atts( array(
			        'mp3' => '',
					'download' => '',
					'image' => ''
			), $atts ) );
			
			global $stylico_theme_options;
			$image = !empty($image) ? '<a href="'.$image.'" rel="prettyphoto"><img src="'.get_template_directory_uri().'/inc/timthumb.php?src='.$image.'&w=90&h=90&zc=1&q=100" class="record-image" /></a>' : '';		
			$mp3 = !empty($mp3) ? '<a href="'.$mp3.'" title="'.$content.'" class="play-now fmp-my-track">'.$stylico_theme_options['releases']['play_button_text'].' <span class="record-play"></span></a>' : '';
			$download = !empty($download) ? '<a href="'.$download.'" target="_blank" class="buy-now">'.$stylico_theme_options['releases']['link_button_text'].' <span class="record-buy"></span></a>' : '';
			
			$output = '<div class="record clearfix">
						'.$image.'
						<div class="record-content">
							<div class="record-text">'.$content.'</div>
							<div class="record-buttons">
								'.$mp3.'
								'.$download.'
							</div>
						</div>
					  </div>';
			
			return $output;
		}
		
		public function fancy_countdown_handler( $atts ) {
			
			extract( shortcode_atts( array(
			        'year' => 2012,
					'month' => 12,
					'day' => 31,
					'hour' => 0,
					'minute' => 0,
					'second' => 0,
					'timezone' => 0,
					'digitunitwidth' => 10,
					'digitunitheight' => 60,
					'fillcolor' => '#1C1C27'
			), $atts ) );
            
			$timestamp = time();
			$output = '<div id="fancyCountdown-'.$year.$month.$day.$hour.$minute.$second.'"></div><script type="text/javascript">
    
              $(document).ready(function(){
			      $("#fancyCountdown-'.$year.$month.$day.$hour.$minute.$second.'").fancyCountdown({year:'.$year.', month:'.$month.', day:'.$day.', hour:'.$hour.', minute:'.$minute.', second:'.$second.', timezone:'.$timezone.', digitUnitWidth: '.$digitunitwidth.', digitUnitHeight: '.$digitunitheight.', fillColor: "'.$fillcolor.'", captions: false, digits:{days:true,hours:true,minutes:true,seconds:true}});
			  })
			  
			</script>';
			
			return $output;
		}
		
		//sort an multidimensional array
		private function aasort ( &$array, $key ) {
			
			$sorter = array();
			$ret = array();
			reset( $array );
			
			foreach ( $array as $ii => $va ) {
				$sorter[$ii] = $va[$key];
			}
			
			asort($sorter);
			
			foreach ( $sorter as $ii => $va ) {
				$ret[$ii] = $array[$ii];
			}
			
			$array=$ret;
			
		}		
	}
}



//init Shortcodes
if(class_exists('RadykalShortcodes')) {
	$rs = new RadykalShortcodes();
}

?>