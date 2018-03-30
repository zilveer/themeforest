<?php

global $cs_theme_option;

add_action( 'add_meta_boxes', 'cs_page_bulider_add' );

function cs_page_bulider_add() {

	add_meta_box( 'id_page_builder', __('Page Options','AidReform'), 'cs_page_bulider', 'page', 'normal', 'high' );  

}  

function cs_page_bulider( $post ) {

?>

    <div class="page-wrap page-opts" style="overflow:hidden; position:relative; height: 705px;">

        <div class="page-builder">

            <div class="page-head">

                <h5><?php _e('Layout Sections','AidReform')?></h5>

                <div class="add-widget">

                    <span class="addwidget"><?php _e('+ Add Page Elements','AidReform')?></span>

                    <div class="widgets-list">

                        <a href="javascript:ajaxSubmit('cs_pb_blog')"><?php _e('Blog','AidReform')?></a>

                        <a href="javascript:ajaxSubmit('cs_pb_cause')"><?php _e('Cause','AidReform')?></a>

                        <a href="javascript:ajaxSubmit('cs_pb_column')"><?php _e('Column','AidReform')?></a>

                        <a href="javascript:ajaxSubmit('cs_pb_contact')"><?php _e('Contact','AidReform')?></a>

                        <a href="javascript:ajaxSubmit('cs_pb_event')"><?php _e('Events','AidReform')?></a>

                        <a href="javascript:ajaxSubmit('cs_pb_gallery')"><?php _e('Gallery','AidReform')?></a>

                        <a href="javascript:ajaxSubmit('cs_pb_map')"><?php _e('Map','AidReform')?></a>

                        <a href="javascript:ajaxSubmit('cs_pb_services')"><?php _e('Services','AidReform')?></a>

                        <a href="javascript:ajaxSubmit('cs_pb_slider')"><?php _e('Slider','AidReform')?></a>

                     </div>

                </div>

            </div>

        </div>

        <div class="clear"></div>

        <div id="add_page_builder_item">

            <?php

				global $cs_node, $cs_count_node, $cs_xmlObject,$cs_theme_option;

                $cs_count_node = 0;

				$count_widget = 0;

				$page_title = '';

				$page_content = '';

				$page_sub_title = '';

 				$slider_id = '';

				$header_styles = '';

                 $cs_page_bulider = get_post_meta($post->ID, "cs_page_builder", true);

				if ( $cs_page_bulider <> "" ) {

                   	$cs_xmlObject = new stdClass();

					$cs_xmlObject = new SimpleXMLElement($cs_page_bulider);

						$count_widget = count($cs_xmlObject->children())-10;

                        foreach ( $cs_xmlObject->children() as $cs_node ){

							if ( $cs_node->getName() == "gallery" ) { cs_pb_gallery(1); }

							else if ( $cs_node->getName() == "slider" ) { cs_pb_slider(1); }

							else if ( $cs_node->getName() == "blog" ) { cs_pb_blog(1); }

							else if ( $cs_node->getName() == "cause" ) { cs_pb_cause(1); }

 							else if ( $cs_node->getName() == "event" ) { cs_pb_event(1); }

 							else if ( $cs_node->getName() == "contact" ) { cs_pb_contact(1); }

							else if ( $cs_node->getName() == "column" ) { cs_pb_column(1); }

							else if ( $cs_node->getName() == "services" ) { cs_pb_services(1); }

							else if ( $cs_node->getName() == "map" ) { cs_pb_map(1); }

                         }

                }

 				if ( $cs_page_bulider <> "" ) {

					if ( isset($cs_xmlObject->page_content) ) $page_content = $cs_xmlObject->page_content;

					if ( isset($cs_xmlObject->page_sub_title) ) $page_sub_title = $cs_xmlObject->page_sub_title;

 					if ( isset($cs_xmlObject->slider_id) ) $slider_id = htmlspecialchars($cs_xmlObject->slider_id);

  				}else{

					//$header_styles = $cs_theme_option['default_header'];	

				}

			?>

            <div id="no_widget" class="placehoder"><?php _e('Page Builder in Empty, Please Select Page Element','AidReform')?> <img src="<?php echo get_template_directory_uri()?>/images/admin/bg-arrowup.png" alt="" /></div>

        </div>

		<div id="loading" class="builderload"></div>

         <div class="clear"></div>

           <script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/prettyCheckable.js"></script>

            <div class="elementhidden">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Show Page Description','AidReform')?></label></li>

                    <li class="to-field">

                        <select name="page_content" class="dropdown">

                            <option value="Yes" <?php if($page_content=="Yes")echo "selected";?> ><?php _e('Yes','AidReform')?></option>

                            <option value="No" <?php if($page_content=="No")echo "selected";?> ><?php _e('No','AidReform')?></option>

                        </select>

                        <p><?php _e('Show the description of the page','AidReform')?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Page Sub Title','AidReform')?></label></li>

                    <li class="to-field">

                    	<input type="text" name="page_sub_title" value="<?php echo $page_sub_title ?>" />

                        <p><?php _e('Put the sub title of the page','AidReform')?></p>

                    </li>

                </ul>

            </div>

		<?php meta_layout() ?>

        <input type="hidden" name="page_builder_form" value="1" />

        <div class="clear"></div>

    </div>

<div class="clear"></div>

	

    <script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/jquery.scrollTo-min.js"></script>

    <script>

		jQuery(function() {

			jQuery( "#add_page_builder_item" ).sortable({

				cancel : 'div div.poped-up'

			});

			//jQuery( "#add_page_builder_item" ).disableSelection();

		});

    </script>

	<script type="text/javascript">

		var count_widget = <?php echo $count_widget ; ?>;

        function ajaxSubmit(action){

 			counter++;

			count_widget++;

            var newCustomerForm = "action=" + action + '&counter=' + counter;

            jQuery.ajax({

                type:"POST",

               url: "<?php echo admin_url('admin-ajax.php')?>",

                data: newCustomerForm,

                success:function(data){

                    jQuery("#add_page_builder_item").append(data);

					if (count_widget > 0) jQuery("#add_page_builder_item").addClass('hasclass');

					//alert(count_widget);

                }

            });

            //return false;

        }

    </script>



<?php  

}

	if ( isset($_POST['page_builder_form']) and $_POST['page_builder_form'] == 1 ) {

		add_action( 'save_post', 'save_page_builder' );

		function save_page_builder( $post_id ) {

			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

				if ( isset($_POST['cs_orderby']) ) {

					//creating xml page builder start

					$sxe = new SimpleXMLElement("<pagebuilder></pagebuilder>");

						$sxe->addChild('page_content', $_POST['page_content']);

						$sxe->addChild('page_sub_title', $_POST['page_sub_title']);

 						$sxe = save_layout_xml($sxe);

							if ( isset($_POST['cs_orderby']) ) {

								$cs_counter = 0;

								$cs_counter_gal = 0;

								$cs_counter_port = 0;

								$cs_counter_event = 0;

								$cs_counter_slider = 0;

								$cs_counter_blog = 0;

								$cs_counter_cause = 0;

								$cs_counter_news = 0;

								$cs_counter_contact = 0;

								$cs_counter_testimonial = 0;

 								$cs_counter_column = 0;

								$cs_counter_mb = 0;

								$cs_counter_image = 0;

								$cs_counter_map = 0;

								$cs_counter_services_node = 0;

								$cs_counter_services = 0;

								$cs_counter_tabs_node = 0;

								$cs_counter_accordion_node = 0;

								$cs_counter_testimonial = 0;

								$cs_counter_testimonial_node = 0;

								$cs_counter_team = 0;

								$cs_counter_team_node = 0;

 								foreach ( $_POST['cs_orderby'] as $count ){

									if ( $_POST['cs_orderby'][$cs_counter] == "gallery" ) {

										$gallery = $sxe->addChild('gallery');

											$gallery->addChild('header_title', $_POST['cs_gal_header_title'][$cs_counter_gal] );

											$gallery->addChild('layout', $_POST['cs_gal_layout'][$cs_counter_gal] );

											$gallery->addChild('album', $_POST['cs_gal_album'][$cs_counter_gal] );

											$gallery->addChild('pagination', $_POST['cs_gal_pagination'][$cs_counter_gal] );

											$gallery->addChild('media_per_page', $_POST['cs_gal_media_per_page'][$cs_counter_gal] );

											$gallery->addChild('gallery_element_size', $_POST['gallery_element_size'][$cs_counter_gal] );

										$cs_counter_gal++;

									}

									else if ( $_POST['cs_orderby'][$cs_counter] == "slider" ) {

										$slider = $sxe->addChild('slider');

											$slider->addChild('slider_header_title', $_POST['cs_slider_header_title'][$cs_counter_slider] );

											$slider->addChild('slider_type', $_POST['cs_slider_type'][$cs_counter_slider] );

											$slider->addChild('slider', $_POST['cs_slider'][$cs_counter_slider] );

											$slider->addChild('slider_view', $_POST['slider_view'][$cs_counter_slider] );

											$slider->addChild('slider_id', htmlspecialchars($_POST['cs_slider_id'][$cs_counter_slider]) );

											//$slider->addChild('width', $_POST['cs_slider_width'][$cs_counter_slider] );

											//$slider->addChild('height', $_POST['cs_slider_height'][$cs_counter_slider] );

											$slider->addChild('slider_element_size', $_POST['slider_element_size'][$cs_counter_slider] );

										$cs_counter_slider++;

									}

									else if ( $_POST['cs_orderby'][$cs_counter] == "blog" ) {

										$blog = $sxe->addChild('blog');

											$blog->addChild('cs_blog_title', htmlspecialchars($_POST['cs_blog_title'][$cs_counter_blog]) );

											$blog->addChild('cs_blog_view', $_POST['cs_blog_view'][$cs_counter_blog] );

											$blog->addChild('cs_blog_cat', $_POST['cs_blog_cat'][$cs_counter_blog] );
											
											$blog->addChild('cs_blog_orderby', $_POST['cs_blog_orderby'][$cs_counter_blog] );
 
											$blog->addChild('cs_blog_excerpt', $_POST['cs_blog_excerpt'][$cs_counter_blog] );

											$blog->addChild('cs_blog_num_post', $_POST['cs_blog_num_post'][$cs_counter_blog] );

											$blog->addChild('cs_blog_pagination', $_POST['cs_blog_pagination'][$cs_counter_blog] );

											$blog->addChild('cs_blog_description', $_POST['cs_blog_description'][$cs_counter_blog] );

											$blog->addChild('cs_blog_link_title', $_POST['cs_blog_link_title'][$cs_counter_blog] );

											$blog->addChild('cs_blog_link_url', $_POST['cs_blog_link_url'][$cs_counter_blog] );

											$blog->addChild('blog_element_size', $_POST['blog_element_size'][$cs_counter_blog] );

										$cs_counter_blog++;

									}

									else if ( $_POST['cs_orderby'][$cs_counter] == "cause" ) {

										$cause_menus = $sxe->addChild('cause');

											$cause_menus->addChild('cause_element_size', htmlspecialchars($_POST['cause_element_size'][$cs_counter_cause]) );

											$cause_menus->addChild('cause_title', htmlspecialchars($_POST['cause_title'][$cs_counter_cause]) );

											$cause_menus->addChild('cause_cat', $_POST['cause_cat'][$cs_counter_cause] );

											$cause_menus->addChild('cs_cause_link_title', $_POST['cs_cause_link_title'][$cs_counter_cause] );

											$cause_menus->addChild('cs_cause_link_url', $_POST['cs_cause_link_url'][$cs_counter_cause] );

											$cause_menus->addChild('cause_type', $_POST['cause_type'][$cs_counter_cause] );
											
											$cause_menus->addChild('cause_filterable', $_POST['cause_filterable'][$cs_counter_cause] );

											$cause_menus->addChild('cause_pagination', $_POST['cause_pagination'][$cs_counter_cause] );

											$cause_menus->addChild('cause_per_page', $_POST['cause_per_page'][$cs_counter_cause] );

											$cause_menus->addChild('cs_cause_excerpt', $_POST['cs_cause_excerpt'][$cs_counter_cause] );

										$cs_counter_cause++;

									}

 									else if ( $_POST['cs_orderby'][$cs_counter] == "event" ) {

										$event = $sxe->addChild('event');

											$event->addChild('cs_event_title', htmlspecialchars($_POST['cs_event_title'][$cs_counter_event]) );

											$event->addChild('cs_event_type', $_POST['cs_event_type'][$cs_counter_event] );

											$event->addChild('cs_event_category', $_POST['cs_event_category'][$cs_counter_event] );

											$event->addChild('cs_event_time', $_POST['cs_event_time'][$cs_counter_event] );

											$event->addChild('cs_event_organizer', $_POST['cs_event_organizer'][$cs_counter_event] );

 											$event->addChild('cs_event_filterables', $_POST['cs_event_filterables'][$cs_counter_event] );

											$event->addChild('cs_event_pagination', $_POST['cs_event_pagination'][$cs_counter_event] );

											$event->addChild('cs_event_per_page', $_POST['cs_event_per_page'][$cs_counter_event] );

											$event->addChild('event_element_size', $_POST['event_element_size'][$cs_counter_event] );

										$cs_counter_event++;

									}

									else if ( $_POST['cs_orderby'][$cs_counter] == "contact" ) {

										$contact = $sxe->addChild('contact');

 											$contact->addChild('cs_contact_email', $_POST['cs_contact_email'][$cs_counter_contact] );

											$contact->addChild('cs_contact_succ_msg', $_POST['cs_contact_succ_msg'][$cs_counter_contact] );

											$contact->addChild('contact_element_size', $_POST['contact_element_size'][$cs_counter_contact] );

											$cs_counter_contact++;

									}

									else if ( $_POST['cs_orderby'][$cs_counter] == "column" ) {

											$column = $sxe->addChild('column');

											$column->addChild('column_element_size', htmlspecialchars($_POST['column_element_size'][$cs_counter_column]) );

											$column->addChild('column_text', htmlspecialchars($_POST['column_text'][$cs_counter_column]) );

										$cs_counter_column++;

									}

									else if ( $_POST['cs_orderby'][$cs_counter] == "services" ) {

										$services = $sxe->addChild('services');

											$services->addChild('services_element_size', htmlspecialchars($_POST['services_element_size'][$cs_counter_services]) );

											for ( $i = 1; $i <= $_POST['services_num'][$cs_counter_services]; $i++ ){

												$service = $services->addChild('service');

												$service->addChild('service_title', htmlspecialchars( $_POST['service_title'][$cs_counter_services_node] ) );

												$service->addChild('service_icon', htmlspecialchars( $_POST['service_icon'][$cs_counter_services_node] ) );

												$service->addChild('service_bg_image', htmlspecialchars( $_POST['service_bg_image'][$cs_counter_services_node] ) );

												$service->addChild('service_link_url', htmlspecialchars( $_POST['service_link_url'][$cs_counter_services_node] ) );

												$service->addChild('service_text', htmlspecialchars( $_POST['service_text'][$cs_counter_services_node] ) );

												$cs_counter_services_node++;

											}

										$cs_counter_services++;

									}

									else if ( $_POST['cs_orderby'][$cs_counter] == "map" ) {

										$divider = $sxe->addChild('map');

											$divider->addChild('map_element_size', htmlspecialchars($_POST['map_element_size'][$cs_counter_map]) );

											$divider->addChild('map_title', htmlspecialchars($_POST['map_title'][$cs_counter_map]) );

											$divider->addChild('map_height', htmlspecialchars($_POST['map_height'][$cs_counter_map]) );

											$divider->addChild('map_lat', htmlspecialchars($_POST['map_lat'][$cs_counter_map]) );

											$divider->addChild('map_lon', htmlspecialchars($_POST['map_lon'][$cs_counter_map]) );

											$divider->addChild('map_zoom', htmlspecialchars($_POST['map_zoom'][$cs_counter_map]) );

											$divider->addChild('map_type', htmlspecialchars($_POST['map_type'][$cs_counter_map]) );

											$divider->addChild('map_info', $_POST['map_info'][$cs_counter_map] );

											$divider->addChild('map_info_width', $_POST['map_info_width'][$cs_counter_map] );

											$divider->addChild('map_info_height', $_POST['map_info_height'][$cs_counter_map] );

											$divider->addChild('map_marker_icon', $_POST['map_marker_icon'][$cs_counter_map] );

											$divider->addChild('map_show_marker', $_POST['map_show_marker'][$cs_counter_map] );

											$divider->addChild('map_controls', $_POST['map_controls'][$cs_counter_map] );

											$divider->addChild('map_draggable', htmlspecialchars($_POST['map_draggable'][$cs_counter_map]) );

											$divider->addChild('map_scrollwheel', htmlspecialchars($_POST['map_scrollwheel'][$cs_counter_map]) );

											$divider->addChild('map_view', htmlspecialchars($_POST['map_view'][$cs_counter_map]) );

										$cs_counter_map++;

									}

									$cs_counter++;

								}

							}

							update_post_meta( $post_id, 'cs_page_builder', $sxe->asXML() );

					//creating xml page builder end

				}

		}

	}

?>