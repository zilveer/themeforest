<?php

// event start

	//adding columns start

    add_filter('manage_events_posts_columns', 'event_columns_add' );

		function event_columns_add($columns) {

			$columns['category'] = 'Categories';

			$columns['author'] = 'Author';

			$columns['tag'] = 'Tags';

			return $columns;

	    }

    add_action('manage_events_posts_custom_column', 'event_columns');

		function event_columns($name) {

			global $post;

			switch ($name) {

				case 'category':

					$categories = get_the_terms( $post->ID, 'event-category' );

						if($categories <> ""){

							$couter_comma = 0;

							foreach ( $categories as $category ) {

								echo $category->name;

								$couter_comma++;

								if ( $couter_comma < count($categories) ) {

									echo ", ";

								}

							}

						}

					break;

				case 'author':

					echo get_the_author();

					break;

				case 'tag':

					$categories = get_the_terms( $post->ID, 'event-tag' );

						if($categories <> ""){

							$couter_comma = 0;

							foreach ( $categories as $category ) {

								echo $category->name;

								$couter_comma++;

								if ( $couter_comma < count($categories) ) {

									echo ", ";

								}

							}

						}

					break;

			}

		}

	//adding columns end

	

	function cs_event_register() {  

		$labels = array(

			'name' =>__('Events','AidReform'),

			'add_new_item' =>__('Add New Event','AidReform'),

			'edit_item' =>__('Edit Event','AidReform'),

			'new_item' =>__('New Event Item','AidReform'),

			'add_new' =>__('Add New Event','AidReform'),

			'view_item' =>__('View Event Item','AidReform'),

			'search_items' =>__('Search Event','AidReform'),

			'not_found' =>__('Nothing found','AidReform'),

			'not_found_in_trash' =>__('Nothing found in Trash','AidReform'),

			'parent_item_colon' => ''

		);

		$args = array(

			'labels' => $labels,

			'public' => true,

			'publicly_queryable' => true,

			'show_ui' => true,

			'query_var' => true,

			'menu_icon' => get_template_directory_uri() . '/images/admin/events-icon.png',

			'rewrite' => true,

			'capability_type' => 'post',

			'hierarchical' => false,

			'menu_position' => null,

			'has_archive' => true,

			'supports' => array('title','editor','thumbnail', 'excerpt', 'comments')

		); 

        register_post_type( 'events' , $args );  



			// adding Manage Location start

				$labels = array(

					'name' =>__('Locations','AidReform'),

					'add_new_item' =>__('Add New Location (Venue Title)','AidReform'),

					'edit_item' =>__('Edit Location','AidReform'),

					'new_item' =>__('New Location Item','AidReform'),

					'add_new' =>__('Add New Location','AidReform'),

					'view_item' =>__('View Location Item','AidReform'),

					'search_items' =>__('Search Location','AidReform'),

					'not_found' =>__('Nothing found','AidReform'),

					'not_found_in_trash' =>__('Nothing found in Trash','AidReform'),

					'parent_item_colon' => ''

				);

				$args = array(

					'labels' => $labels,

					'public' => true,

					'publicly_queryable' => true,

					'show_ui' => true,

					'query_var' => true,

					'menu_icon' => get_template_directory_uri() . '/images/calendar.png',

					'show_in_menu' => 'edit.php?post_type=events',

					'show_in_nav_menus'=>true,

					'rewrite' => true,

					'capability_type' => 'post',

					'hierarchical' => false,

					'menu_position' => null,

					'supports' => array('title')

				); 

				register_post_type( 'event-location' , $args );  

			// adding Manage Location end

    }

	add_action('init', 'cs_event_register');



	function cs_event_categories() 

	{

		  $labels = array(

			'name' => 'Event Categories',

			'search_items' => 'Search Event Categories',

			'edit_item' => 'Edit Event Category',

			'update_item' => 'Update Event Category',

			'add_new_item' => 'Add New Category',

			'menu_name' => 'Event Categories',

		  ); 	

		  register_taxonomy('event-category',array('events'), array(

			'hierarchical' => true,

			'labels' => $labels,

			'show_ui' => true,

			'query_var' => true,

			'rewrite' => array( 'slug' => 'event-category' ),

		  ));

	}

	add_action( 'init', 'cs_event_categories');



	function cs_event_tag() {

		  $labels = array(

			'name' => 'Event Tags',

			'singular_name' => 'event-tag',

			'search_items' => 'Search Tags',

			'popular_items' => 'Popular Tags',

			'all_items' => 'All Tags',

			'parent_item' => null,

			'parent_item_colon' => null,

			'edit_item' => 'Edit Tag',

			'update_item' => 'Update Tag',

			'add_new_item' => 'Add New Tag',

			'new_item_name' => 'New Tag Name',

			'separate_items_with_commas' => 'Separate writers with commas',

			'add_or_remove_items' => 'Add or remove tags',

			'choose_from_most_used' => 'Choose from the most used tags',

			'menu_name' => 'Event Tags',

		  ); 

		  register_taxonomy('event-tag','events',array(

			'hierarchical' => false,

			'labels' => $labels,

			'show_ui' => true,

			'update_count_callback' => '_update_post_term_count',

			'query_var' => true,

			'rewrite' => array( 'slug' => 'event-tag' ),

		  ));

	}

	add_action( 'init', 'cs_event_tag');



	// event-location custom fields start

		add_action( 'add_meta_boxes', 'event_loc_meta' );  

		function event_loc_meta()

		{

			add_meta_box( 'event_loc_meta', __('Add Location With Map','AidReform'), 'event_loc_meta_data', 'event-location', 'normal', 'high' );

		}

		function event_loc_meta_data($post) {

			$event_loc_meta = get_post_meta($post->ID, "cs_event_loc_meta", true);

			if ( $event_loc_meta <> "" ) {

				$cs_xmlObject = new SimpleXMLElement($event_loc_meta);

					$event_loc_lat = $cs_xmlObject->event_loc_lat;

					$event_loc_long = $cs_xmlObject->event_loc_long;

					$event_loc_zoom = $cs_xmlObject->event_loc_zoom;

					$loc_address = $cs_xmlObject->loc_address;

					$loc_city = $cs_xmlObject->loc_city;

					$loc_postcode = $cs_xmlObject->loc_postcode;

					$loc_region = $cs_xmlObject->loc_region;

					$loc_country = $cs_xmlObject->loc_country;

			}

			else {

				$event_loc_lat = '';

				$event_loc_long = '';

				$event_loc_zoom = '';

				$loc_address = '';

				$loc_city = '';

				$loc_postcode = '';

				$loc_region = '';

				$loc_country = '';

			}

			?>

				<fieldset class="gllpLatlonPicker">

                <div class="page-wrap page-opts left" style="overflow:hidden; position:relative;">

                	<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

                    <script src="<?php echo get_template_directory_uri()?>/scripts/admin/jquery-gmaps-latlon-picker.js"></script>

            		<div class="option-sec" style="margin-bottom:0;">

                        <div class="opt-conts">

                            <ul class="form-elements noborder">

                                <li class="to-label"><label><?php _e('Address','AidReform')?></label></li>

                                <li class="to-field"><input name="loc_address" id="loc_address" type="text" value="<?php echo htmlspecialchars($loc_address)?>" class="gllpSearchButton" onblur="gll_search_map()" /></li>

                            </ul>

                            <ul class="form-elements noborder">

                                <li class="to-label"><label><?php _e('City / Town','AidReform')?></label></li>

                                <li class="to-field"><input name="loc_city" id="loc_city" type="text" value="<?php echo htmlspecialchars($loc_city)?>" class="gllpSearchButton" onblur="gll_search_map()" /></li>

                            </ul>

                            <ul class="form-elements noborder">

                                <li class="to-label"><label><?php _e('Post Code','AidReform')?></label></li>

                                <li class="to-field"><input name="loc_postcode" id="loc_postcode" type="text" value="<?php echo htmlspecialchars($loc_postcode)?>" class="gllpSearchButton" onblur="gll_search_map()" /></li>

                            </ul>

                            <ul class="form-elements noborder">

                                <li class="to-label"><label><?php _e('Region','AidReform')?></label></li>

                                <li class="to-field"><input name="loc_region" id="loc_region" type="text" value="<?php echo htmlspecialchars($loc_region)?>" class="gllpSearchButton" onblur="gll_search_map()" /></li>

                            </ul>

                            <ul class="form-elements noborder">

                                <li class="to-label"><label><?php _e('Country','AidReform')?></label></li>

                                <li class="to-field">

                                    <select name="loc_country" id="loc_country" class="gllpSearchButton" onblur="gll_search_map()" >

										<?php foreach( cs_get_countries() as $key => $val ):?>

                                        	<option <?php if($loc_country==$val)echo "selected"?> ><?php echo $val;?></option>

										<?php endforeach; ?>  

                                    </select>

                                </li>

                            </ul>

                            <ul class="form-elements noborder">

                                <li class="to-label"><label></label></li>

                                <li class="to-field"><input type="button" class="gllpSearchButton" value="<?php _e('Search This Location on Map','AidReform')?>" onclick="gll_search_map()"></li>

                            </ul>

                            <ul class="form-elements">

                                <input type="hidden" name="add_new_loc" class="gllpSearchField" style="margin-bottom:10px;" >

                                <div class="gllpMap"><?php _e('Google Maps','AidReform')?></div>

                                <input type="hidden" name="event_loc_lat" value="<?php echo $event_loc_lat?>" class="gllpLatitude" />

                                <input type="hidden" name="event_loc_long" value="<?php echo $event_loc_long?>" class="gllpLongitude" />

                                <input type="hidden" name="event_loc_zoom" value="<?php echo $event_loc_zoom?>" class="gllpZoom" />

                                <input type="button" class="gllpUpdateButton" value="update map" style="display:none">

							</ul>

                        </div>

                        <div class="clear"></div>

                    </div>

                </div>

				</fieldset>

				<input type="hidden" name="event_loc_meta_form" value="1" />

			<?php

		}

	// event-location custom fields end

	



	// event custom fields start

	add_action( 'add_meta_boxes', 'cs_event_meta' );  

    function cs_event_meta()

    {

        add_meta_box( 'event_meta', __('Event Options','AidReform'), 'cs_event_meta_data', 'events', 'normal', 'high' );

    }

	function cs_event_meta_data($post) {

		$cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);

		global $cs_xmlObject;

		if ( $cs_event_meta <> "" ) {

			$cs_xmlObject = new SimpleXMLElement($cs_event_meta);

				$sub_title = $cs_xmlObject->sub_title;

				

				$inside_event_gallery = $cs_xmlObject->inside_event_gallery;

				$inside_event_thumb_view = $cs_xmlObject->inside_event_thumb_view;

				//$inside_event_thumb_image = $cs_xmlObject->inside_event_thumb_image;

				$inside_event_featured_image_as_thumbnail = $cs_xmlObject->inside_event_featured_image_as_thumbnail;

				$inside_event_thumb_audio = $cs_xmlObject->inside_event_thumb_audio;

				$inside_event_thumb_video = $cs_xmlObject->inside_event_thumb_video;

				$inside_event_thumb_slider = $cs_xmlObject->inside_event_thumb_slider;

				$inside_event_thumb_slider_type = $cs_xmlObject->inside_event_thumb_slider_type;

				$inside_event_thumb_map_lat = $cs_xmlObject->inside_event_thumb_map_lat;

				$inside_event_thumb_map_lon = $cs_xmlObject->inside_event_thumb_map_lon;

				$inside_event_thumb_map_zoom = $cs_xmlObject->inside_event_thumb_map_zoom;

				$inside_event_thumb_map_address = $cs_xmlObject->inside_event_thumb_map_address;

				$inside_event_thumb_map_controls = $cs_xmlObject->inside_event_thumb_map_controls;

				

				

				$event_social_sharing = $cs_xmlObject->event_social_sharing;

				

				$event_start_time = $cs_xmlObject->event_start_time;

				$event_end_time = $cs_xmlObject->event_end_time;

				$event_all_day = $cs_xmlObject->event_all_day;

				$event_address = $cs_xmlObject->event_address;

				$event_loc_lat = $cs_xmlObject->event_loc_lat;

				$event_loc_long = $cs_xmlObject->event_loc_long;

				$event_loc_zoom = $cs_xmlObject->event_loc_zoom;
  
				$event_buy_now = $cs_xmlObject->event_buy_now;

				$event_phone_no = $cs_xmlObject->event_phone_no;

				$event_map = $cs_xmlObject->event_map;
				$event_featured_box = $cs_xmlObject->event_featured_box;
				

				

		}

		else {

			$sub_title = '';

 			$slider_id = '';

			

			$inside_event_thumb_view = '';

			//$inside_event_thumb_image = '';

			$inside_event_featured_image_as_thumbnail = '';

			$inside_event_thumb_audio = '';

			$inside_event_thumb_video = '';

			$inside_event_thumb_slider = '';

			$inside_event_thumb_slider_type = '';

			$inside_event_thumb_map_lat = '';

			$inside_event_thumb_map_lon = '';

			$inside_event_thumb_map_zoom = '';

			$inside_event_thumb_map_address = '';

			$inside_event_thumb_map_controls = '';

			

			$inside_event_gallery = '';

			$event_social_sharing = '';

			$event_related = '';

			$event_start_time = '';

			$event_end_time = '';

			$event_all_day = '';

			$event_address = '';

			$event_loc_lat = '';

			$event_loc_long = '';

			$event_loc_zoom = '';

 			$inside_event_related_post_title = '';

			$event_map = '';

			$event_phone_no = '';

			$event_buy_now = '';
			$event_featured_box  = '';

 		}

		$cs_event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);

		$cs_event_to_date = get_post_meta($post->ID, "cs_event_to_date", true);

	?>

		<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/select.js"></script>

        <script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/prettyCheckable.js"></script>

		<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/jquery.timepicker.js"></script>

        <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/admin/jquery.ui.datepicker.css">

        <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/admin/jquery.ui.datepicker.theme.css">

        <script>

            jQuery(function($) {

                $('#event_start_time').timepicker();

                $('#event_end_time').timepicker();

            });

            jQuery(function($) {

                $( "#from_date" ).datepicker({

                    defaultDate: "+1w",

					dateFormat: "yy-mm-dd",

                    changeMonth: true,

                    numberOfMonths: 1,

                    onSelect: function( selectedDate ) {

                        $( "#to_date" ).datepicker( "option", "minDate", selectedDate );

                    }

                });

                $( "#to_date" ).datepicker({

                    defaultDate: "+1w",

					dateFormat: "yy-mm-dd",

                    changeMonth: true,

                    numberOfMonths: 1,

                    onSelect: function( selectedDate ) {

                        $( "#from_date" ).datepicker( "option", "maxDate", selectedDate );

                    }

                });

            });

        </script>



    	<div class="page-wrap">

            <div class="option-sec" style="margin-bottom:0;">

                <div class="opt-conts">

                    <ul class="form-elements">

                        <li class="to-label"><label><?php _e('Sub Title','AidReform')?></label></li>

                        <li class="to-field">

                            <input type="text" name="sub_title" value="<?php echo $sub_title ?>" />

                            <p><?php _e('Put the sub title','AidReform')?></p>

                        </li>

                    </ul>

                    <ul class="form-elements">

                    	<li class="to-label"><label><?php _e('Select Gallery','AidReform')?></label></li>

                            <li class="to-field">

                                <select name="inside_event_gallery" class="dropdown">

                                    <option value="0"><?php _e('-- Select Gallery --','AidReform')?></option>

                                    <?php

                                        $query = array( 'posts_per_page' => '-1', 'post_type' => 'cs_gallery', 'orderby'=>'ID', 'post_status' => 'publish' );

                                        $wp_query = new WP_Query($query);

                                        while ($wp_query->have_posts()) : $wp_query->the_post();

                                    ?>

                                        <option <?php if(get_the_ID()==$inside_event_gallery)echo "selected";?> value="<?php the_ID()?>"><?php the_title()?></option>

                                    <?php

                                        endwhile;

                                    ?>

                                </select>

                            </li>

                    </ul>

                      <ul class="form-elements">

                        <li class="to-label"><label><?php _e('Social Sharing','AidReform')?></label></li>

                        <li class="to-field">

                        	<div class="on-off"><input type="checkbox" name="event_social_sharing" value="on" class="myClass" <?php if($event_social_sharing=='on')echo "checked"?> /></div>

                            <p><?php _e('Enable/Disable social sharing','AidReform')?></p>

                        </li>

                    </ul>
					<ul class="form-elements">

                        <li class="to-label"><label><?php _e('Feature Box','AidReform')?></label></li>

                        <li class="to-field">

                        	<div class="on-off"><input type="checkbox" name="event_featured_box" value="on" class="myClass" <?php if($event_featured_box=='on')echo "checked"?> /></div>

                            <p><?php _e('Enable/Disable Featured Box','AidReform')?></p>

                        </li>

                    </ul>
 
                    <ul class="form-elements">

                        <li class="to-label"><label><?php _e('Event Start Date','AidReform')?></label></li>

                        <li class="to-field">

                            <input type="text" id="from_date" name="event_from_date" value="<?php if($cs_event_from_date=='') echo gmdate("Y-m-d"); else echo $cs_event_from_date?>" />

                            <p><?php _e('Put event start date','AidReform')?></p>

                        </li>

                    </ul>

                    <ul class="form-elements">

                        <li class="to-label"><label><?php _e('Event End Date','AidReform')?></label></li>

                        <li class="to-field">

                            <input type="text" id="to_date" name="event_to_date" value="<?php if($cs_event_to_date=='') echo gmdate("Y-m-d"); else echo $cs_event_to_date?>" />

                            <p><?php _e('Put event end date','AidReform')?></p>

                        </li>

                    </ul>

                    <?php if ( empty( $_GET['post']) ) {?>

                        <ul class="form-elements">

                            <li class="to-label"><label><?php _e('Repeat','AidReform')?></label></li>

                            <li class="to-field">

                                <select name="repeat" class="dropdown" onchange="toggle_with_value('num_repeat', this.value)">

									<option value="0"><?php _e('-- Never Repeat --','AidReform')?></option>

									<option value="+1 day"><?php _e('Every Day','AidReform')?></option>

									<option value="+1 week"><?php _e('Every Week','AidReform')?></option>

									<option value="+1 month"><?php _e('Every Month','AidReform')?></option>

                                </select>

                            </li>

                        </ul>

                        <ul class="form-elements" id="num_repeat" style="display:none">

                            <li class="to-label"><label><?php _e('Repeat how many time','AidReform')?></label></li>

                            <li class="to-field">

                                <select name="num_repeat" class="dropdown">

                                    <?php for ( $i = 1; $i <= 25; $i++ ) {?>

                                        <option><?php echo $i?></option>

                                    <?php }?>

                                </select>

                            </li>

                        </ul>

                    <?php }?>

                    <ul class="form-elements">

                        <li class="to-label"><label><?php _e('Events start time from','AidReform')?></label></li>

                        <li class="to-field">

                            <div id="event_time" <?php if($event_all_day=='on')echo 'style="display:none"'?>>

                                <input id="event_start_time" name="event_start_time" value="<?php echo $event_start_time?>" type="text" readonly="readonly" class="vsmall" />

                                <span class="short"><?php _e('To','AidReform')?></span>

                                <input id="event_end_time" name="event_end_time" value="<?php echo $event_end_time?>" type="text" readonly="readonly" class="vsmall"  />

                            </div>

                            <p><?php _e('Start and ending time','AidReform')?></p>

                            <div class="clear"></div>

                            <div class="checkbox-list" style="padding-top:15px;">

                                <div class="checkbox-item">

                                    <input type="checkbox" name="event_all_day" value="on" <?php if($event_all_day=='on')echo "checked"?> onclick="cs_toggle('event_time')" class="styled" />

                                    <label><?php _e('All Day','AidReform')?></label>

                                </div>

                            </div>

                        </li>

                    </ul>

                    <ul class="form-elements">

                        <li class="to-label"><label><?php _e('Phone No','AidReform')?></label></li>

                        <li class="to-field">

                            <input type="text" id="event_phone_no" name="event_phone_no" value="<?php echo $event_phone_no;?>" />

                        </li>

                    </ul>

                    <ul class="form-elements">

                        <li class="to-label"><label><?php _e('Buy Now','AidReform')?></label></li>

                        <li class="to-field">

                            <input type="text" id="event_buy_now" name="event_buy_now" value="<?php echo $event_buy_now;?>" />

                        </li>

                    </ul>

                    <ul class="form-elements noborder">

                        <li class="to-label"><label><?php _e('Location / Address','AidReform')?></label></li>

                        <li class="to-field">

                        	<?php

                            //echo $event_address."<br />";

								query_posts( array('post_type' => 'event-location') );

									while ( have_posts()) : the_post();

										//echo get_the_ID();

									endwhile;

							?>

                        	<select name="event_address" class="dropdown" onchange="javascript:inside_event_map_showhide(this)">

                            	<option value="0"></option>

                                <?php

									query_posts( array('posts_per_page' => "-1", 'post_status' => 'publish', 'post_type' => 'event-location') );

										while ( have_posts()) : the_post();

										?>

	                                        <option <?php if($event_address==get_the_ID())echo "selected"?> value="<?php the_ID()?>"><?php the_title()?></option>

                                        <?php

										endwhile;

                                ?>

                            </select>

                            <p><?php _e('Put the address','AidReform')?></p>

                        </li>

                    </ul>

                    <ul class="form-elements" id="event_map">

                        <li class="to-label"><label><?php _e('Show Map','AidReform')?></label></li>

                        <li class="to-field">

                        	<div class="on-off"><input type="checkbox"  name="event_map" class="myClass" <?php if(empty($event_map) || $event_map == "on"){ echo "checked"; }?> /></div>

                            <p><?php _e('Events Map On / Off','AidReform')?> </p>

                        </li>

                    </ul>

                </div>

            </div>

            <?php meta_layout()?>

            <input type="hidden" name="event_meta_form" value="1" />

			<div class="clear"></div>

		</div>

    

    <?php

	}

	// event custom fields end

	// event-location custom fields save start

		if ( isset($_POST['event_loc_meta_form']) and $_POST['event_loc_meta_form'] == 1 ) {

			add_action( 'save_post', 'event_loc_meta_save' );

			function event_loc_meta_save( $post_id ) {

				if (empty($_POST["event_loc_lat"])){ $_POST["event_loc_lat"] = "";}

				if (empty($_POST["event_loc_long"])){ $_POST["event_loc_long"] = "";}

				if (empty($_POST["event_loc_zoom"])){ $_POST["event_loc_zoom"] = "";}

				if (empty($_POST["loc_address"])){ $_POST["loc_address"] = "";}

				if (empty($_POST["loc_city"])){ $_POST["loc_city"] = "";}

				if (empty($_POST["loc_postcode"])){ $_POST["loc_postcode"] = "";}

				if (empty($_POST["loc_region"])){ $_POST["loc_region"] = "";}

				if (empty($_POST["loc_country"])){ $_POST["loc_country"] = "";}

				

				$sxe = new SimpleXMLElement("<event_loc></event_loc>");

					$sxe->addChild('event_loc_lat',$_POST['event_loc_lat']);

					$sxe->addChild('event_loc_long',$_POST['event_loc_long']);

					$sxe->addChild('event_loc_zoom',$_POST['event_loc_zoom']);

					$sxe->addChild('loc_address',htmlspecialchars($_POST['loc_address']) );

					$sxe->addChild('loc_city',htmlspecialchars($_POST['loc_city']) );

					$sxe->addChild('loc_postcode',htmlspecialchars($_POST['loc_postcode']) );

					$sxe->addChild('loc_region',htmlspecialchars($_POST['loc_region']) );

					$sxe->addChild('loc_country',$_POST['loc_country']);

						update_post_meta( $post_id, 'cs_event_loc_meta', $sxe->asXML() );

			}

		}

	// event-location custom fields save end

	// event custom fields save start

		if ( isset($_POST['event_meta_form']) and $_POST['event_meta_form'] == 1 ) {

			add_action( 'save_post', 'cs_event_meta_save' );

			function cs_event_meta_save( $post_id ) {

				// repeating events start

				if ( isset($_POST['num_repeat'] ) ) {

					global $wpdb;

					$post_thumbnail_id = get_post_thumbnail_id( $post_id );

					$post = get_post($post_id);

					$from_date = $_POST["event_from_date"];

					$to_date = $_POST["event_to_date"];

						for ( $i = 1; $i < $_POST['num_repeat']; $i++ ) {

							$wpdb->insert( $wpdb->prefix.'posts',

									array(

										'post_author'		=> $post->post_author,

										'post_date'			=> $post->post_date,

										'post_date_gmt'		=> $post->post_date_gmt,

										'post_content'		=> $post->post_content,

										'post_title'		=> $post->post_title,

										'post_excerpt'		=> $post->post_excerpt,

										'post_status'		=> $post->post_status,

										'comment_status'	=> $post->comment_status,

										'ping_status'		=> $post->ping_status,

										'post_name'			=> $post->post_name."-".$i,

										'post_modified'		=> $post->post_modified,

										'post_modified_gmt'	=> $post->post_modified_gmt,

										'post_type'			=> $post->post_type

									)

							);

							$inserted_id = (int) $wpdb->insert_id;

							// adding categories start

								$terms = wp_get_post_terms($post->ID, "event-category");

								foreach ( $terms as $val ) {

									$wpdb->insert( $wpdb->prefix.'term_relationships',

											array(

												'object_id'	=> $inserted_id,

												'term_taxonomy_id'	=> $val->term_id,

												'term_order'	=> 0

											)

									);

								}

							// adding categories end

							// adding tag start

								$terms = wp_get_post_terms($post->ID, "event-tag");

								foreach ( $terms as $val ) {

									$wpdb->insert( $wpdb->prefix.'term_relationships',

											array(

												'object_id'	=> $inserted_id,

												'term_taxonomy_id'	=> $val->term_id,

												'term_order'	=> 0

											)

									);

								}

							// adding tag end

							// adding feature image start

								if ( $post_thumbnail_id ) update_post_meta( $inserted_id, '_thumbnail_id', $post_thumbnail_id );

							// adding feature image end

							events_meta_save($inserted_id);

							if ( $_POST['repeat'] <> 0 ) {

								$from_date = strtotime(date("Y-m-d", strtotime($from_date)) . $_POST['repeat'] );

									$from_date = date('Y-m-d', $from_date);

								$to_date = strtotime(date("Y-m-d", strtotime($to_date)) . $_POST['repeat'] );

								$to_date = date('Y-m-d', $to_date);


								update_post_meta( $inserted_id, 'cs_event_from_date', $from_date );

								update_post_meta( $inserted_id, 'cs_event_to_date', $to_date );
								$cs_event_datetime=$_POST["event_from_date"].' '.$_POST["event_start_time"];
			  					update_post_meta( $post_id, 'cs_event_from_date_time', $cs_event_datetime );

							}

						}

				}

				// repeating events end

				events_meta_save($post_id);

					update_post_meta( $post_id, 'cs_event_from_date', $_POST["event_from_date"] );
					update_post_meta( $post_id, 'cs_event_to_date', $_POST["event_to_date"] );
					$cs_event_datetime=$_POST["event_from_date"].' '.$_POST["event_start_time"];
  					update_post_meta( $post_id, 'cs_event_from_date_time', $cs_event_datetime );

			}

		}

	// event custom fields save end


// event end

?>