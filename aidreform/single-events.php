<?php

get_header();

	global $cs_node, $cs_theme_option;

	$cs_layout = '';

	$cs_counter_events=1;

 	$post_xml = get_post_meta($post->ID, "cs_event_meta", true);	

	if ( $post_xml <> "" ) {

		$cs_xmlObject = new SimpleXMLElement($post_xml);

  		$cs_layout = $cs_xmlObject->sidebar_layout->cs_layout;

		$cs_sidebar_left = $cs_xmlObject->sidebar_layout->cs_sidebar_left;

		$cs_sidebar_right = $cs_xmlObject->sidebar_layout->cs_sidebar_right;

		$event_social_sharing = $cs_xmlObject->event_social_sharing;

		$event_start_time = $cs_xmlObject->event_start_time;

		$event_end_time = $cs_xmlObject->event_end_time;

 		$event_all_day = $cs_xmlObject->event_all_day;

		$event_booking_url = $cs_xmlObject->event_booking_url;

		$event_phone_no = $cs_xmlObject->event_phone_no;

		$event_address = $cs_xmlObject->event_address;

		$cs_sidebar_left = $cs_xmlObject->sidebar_layout->cs_sidebar_left;

		$cs_sidebar_right = $cs_xmlObject->sidebar_layout->cs_sidebar_right;

 		$inside_event_map = $cs_xmlObject->event_map;
		$event_featured_box = $cs_xmlObject->event_featured_box;
		$event_buy_now = $cs_xmlObject->event_buy_now;
		$inside_event_gallery= $cs_xmlObject->inside_event_gallery;

		//print_r($cs_xmlObject);

		$width = 262;

		$height = 262;

		$image_id = cs_get_post_img($post->ID, $width,$height);

		

		if ( $cs_layout == "left") {

			$cs_layout = "content-right col-md-9";

			$custom_height = 300;

 		}

		else if ( $cs_layout == "right" ) {

			$cs_layout = "content-left col-md-9";

			$custom_height = 300;

 		}

		else {

			$cs_layout = "col-md-12";

			$custom_height = 403;

		}

  	}else{

		$event_social_sharing = '';

 		$inside_event_thumb_view = '';

   		$inside_event_thumb_map_lat = '';

		$inside_event_thumb_map_lon = '';

		$inside_event_thumb_map_zoom = '';

		$inside_event_thumb_map_address = '';

		$inside_event_thumb_map_controls = '';
		$event_featured_box = '';
		$event_buy_now = '';
		$inside_event_gallery = '';

 	}

	$cs_event_loc = get_post_meta("$cs_xmlObject->event_address", "cs_event_loc_meta", true);

	if ( $cs_event_loc <> "" ) {

		$cs_event_loc = new SimpleXMLElement($cs_event_loc);

 			$event_loc_lat = $cs_event_loc->event_loc_lat;

			$event_loc_long = $cs_event_loc->event_loc_long;

			$event_loc_zoom = $cs_event_loc->event_loc_zoom;

			$loc_address = $cs_event_loc->loc_address;

			$loc_city = $cs_event_loc->loc_city;

			$loc_postcode = $cs_event_loc->loc_postcode;

			$loc_region = $cs_event_loc->loc_region;

			$loc_country = $cs_event_loc->loc_country;

	}

	else {

		$event_loc_lat = '';

		$event_loc_long = '';

		$event_loc_zoom = '7';

		$loc_address = '';

		$loc_city = '';

		$loc_postcode = '';

		$loc_region = '';

		$loc_country = '';

	}

	$cs_event_to_date = get_post_meta($post->ID, "cs_event_to_date", true); 

	$cs_event_from_date = get_post_meta($post->ID, "cs_event_from_date", true); 

	$year_event = date("Y", strtotime($cs_event_from_date));

	$month_event = date("m", strtotime($cs_event_from_date));

	$month_event_c = date("M", strtotime($cs_event_from_date));							

	$date_event = date("d", strtotime($cs_event_from_date));

	$cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);

	$date_format = get_option( 'date_format' );

	$time_format = get_option( 'time_format' );							

	if ( $cs_event_meta <> "" ) {

		$cs_event_meta = new SimpleXMLElement($cs_event_meta);

	}	

	$address_map = '';

	$address_map = get_the_title("$cs_xmlObject->event_address");		

	$time_left = date("H,i,s", strtotime("$cs_event_meta->event_start_time"));

	$current_date = date('Y-m-d');

    if ( have_posts() ) while ( have_posts() ) : the_post();

		$cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);

		if ( $cs_event_meta <> "" ) $cs_event_meta = new SimpleXMLElement($cs_event_meta);

		

		if($inside_event_map != "on"){

			$class = 'eventdetail-parallax-full';

		}else{

			$class ='';

		}

		

	?>

	 

<!-- Event Outer Image Strat -->

 <div id="main" role="main"> 

  <!-- Container Start -->

  <div class="container"> 

        <!-- Row Start -->

        <div class="row"> 

			<!--Left Sidebar Starts-->

			<?php if ($cs_layout == 'content-right col-md-9'){ ?>

                <aside class="sidebar-left col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left) ) : ?><?php endif; ?></aside>

            <?php } ?>

			<!--Left Sidebar End-->

			<div class="<?php echo $cs_layout; ?>">

           		<div class="event_detail  fullwidth">

                    <article>

                         <?php 

							if($inside_event_map == "on"){

								if($address_map <> "" && $event_loc_lat <> "" && $event_loc_long <>"" && $event_loc_zoom <> ''){ ?>

									<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script> 

									<script type="text/javascript">

									jQuery(document).ready(function(){

										event_map("<?php echo $loc_address.'<br>'.$loc_city.'<br>'.$loc_postcode.'<br>'.$loc_country  ?>",<?php echo $event_loc_lat ?>,			<?php echo $event_loc_long ?>,<?php echo $event_loc_zoom ?>,<?php echo $cs_counter_events; ?>);

									});

									</script>

										<div id="map_canvas<?php echo $cs_counter_events; ?>" class="event-map" style="height:300px; width:100%;"></div>

								<?php }

							}

						?>

                         

                        <div class="text-group fullwidth <?php if($event_featured_box == "on"){ echo 'cs-boxon'; } ?>" >
							<?php if($event_featured_box == "on"){?>
                        		<div class="side-post desc-area-box">
		                        	<?php
										if($image_id <> ""){
									?>

                                <figure><?php echo $image_id; ?></figure>

                             	<?php 

								}

								?>

                                <div class="event-desc">

                                <ul> 

                               <li><em class="fa fa-clock-o"></em> <span><time><?php echo date("l, d F Y", strtotime($cs_event_from_date)) ?>,  

                                <?php

								if($event_all_day <> ""){

									echo "All day";

								}else{

									echo $event_start_time . " - " . $event_end_time;

								}

								?>

								</time></span> </li> 

                                <li><em class="fa fa-map-marker"></em><span>

                                <?php echo get_the_title((int)$event_address); ?></span></li>
								<?php 
									if($event_phone_no <> ''){
										echo '<li><em class="fa fa-phone"></em><span>'.$event_phone_no.'</span></li>';
									} 
								

										if($event_buy_now <> ''){
											
											echo '<a href="'.$event_buy_now.'" target="_blank" class="btn cs-buy bgcolr">'; 
											if(isset($cs_theme_option['trans_buy_now'])){ 
												$buy_now = $cs_theme_option['trans_buy_now']; 
											}else{ 
												$buy_now  =  __('Buy Now','AidReform');
											}
											if(isset($cs_theme_option['trans_switcher'])){ if($cs_theme_option['trans_switcher'] == "on"){ __('Buy Now','AidReform');} }else{ echo $buy_now; }
											echo '</a>';
										}	
									?>

                                </ul>

                                </div>

                            </div>
                            
                            <?php } ?>
							<div class="post-options">
                                	<ul>
										<?php 

                                            /* translators: used between list items, there is a space after the comma */

                                            $before_cat = "<li><em class='fa fa-tags'></em>";

                                            $categories_list = get_the_term_list ( get_the_id(), 'event-tag', $before_cat, ', ', '</span></li>' );

                                            if ( $categories_list ){

                                                printf( __( '%1$s', 'AidReform'),$categories_list );

                                            } // End if categories 
											$before_cat = "<li><em class='fa fa-list'></em>";

											$categories_list = get_the_term_list ( get_the_id(), 'event-category', $before_cat, ', ', '</li>' );

											if ( $categories_list ){

												printf( __( '%1$s', 'AidReform'),$categories_list );  

											} // End if categories 
										?>
                                    </ul>
                                </div>	
                            <div class="text-inner">
								
                                <div class="detail_text rich_editor_text">

                                    <?php the_content(); ?>

                                </div>

                            </div>

                            <?php 
								if($inside_event_gallery <> '0' and $inside_event_gallery <> ''){
									cs_enqueue_gallery_style_script();
									$cs_meta_gallery_options = get_post_meta("$inside_event_gallery", "cs_meta_gallery_options", true);
									
									if ( $cs_meta_gallery_options <> "" ) {
										$cs_xmlObject = new SimpleXMLElement($cs_meta_gallery_options);
										$limit_start = 0;
										$limit_end = 9;
										$count_post = count($cs_xmlObject);
										if ( $limit_end > count($cs_xmlObject) ) {
											$limit_end = count($cs_xmlObject);
										}
 									
									?>
									<div class="gallerysec gallery">
                                    	<header class="heading">
                                             <h3 class="section-title heading-color"><?php echo get_the_title((int)$inside_event_gallery); ?></h3>
                                         </header>
                                   		<ul class="gallery-three-col lightbox clearfix">
 											<?php
                                                for ( $i = $limit_start; $i < $limit_end; $i++ ) {
                            
                                                    $path = $cs_xmlObject->gallery[$i]->path;
                            
                                                    $title = $cs_xmlObject->gallery[$i]->title;
                            
                                                    $social_network = $cs_xmlObject->gallery[$i]->social_network;
                            
                                                    $use_image_as = $cs_xmlObject->gallery[$i]->use_image_as;
                            
                                                    $video_code = $cs_xmlObject->gallery[$i]->video_code;
                            
                                                    $link_url = $cs_xmlObject->gallery[$i]->link_url;
													$image_url = cs_attachment_image_src($path, 585, 440);
                            
                                                    $image_url_full = cs_attachment_image_src($path, 0, 0);
                            
                                                    ?>
                            
                                                    <li class="box photo">
                            
                                                        <!-- Gallery Listing Item Start -->
                            
                                                        <div class="ms-box">
                            
                                                            <a data-title="<?php if ( $title <> "" ) { echo $title;}?>"  href="<?php if($use_image_as==1)echo $video_code; elseif($use_image_as==2) echo $link_url; else echo $image_url_full;?>" target="<?php if($use_image_as==2) echo '_blank'; ?>" data-rel="<?php if($use_image_as==1)echo "prettyPhoto";  elseif($use_image_as==2) echo ""; else echo "prettyPhoto[gallery1]"?>">
                            
                                                                <figure>
                            
                                                                <?php echo "<img src='".$image_url."' data-alt='".$title."' alt='' />"; ?>
                            
                                                                <figcaption>
                            
                                                                  <div class="text">
                            
                                                                   <?php 
                                                                          if($use_image_as==1){
                            
                                                                              echo '<i class="fa fa-play fa-3x"></i>';
                            
                                                                          }elseif($use_image_as==2){
                            
                                                                              echo '<i class="fa fa-link fa-3x"></i>';	
                            
                                                                          }else{
                            
                                                                              echo '<i class="fa fa-picture-o fa-3x"></i>';
                            
                                                                          }
                                                                      ?>
                            
                                                                </div>
                                                                
                                                                </figcaption>
                             									<?php if($title <> ''){ echo '<span class="bgclor">'.$title.'</span>'; } ?>
                                                                </figure>
                            
                                                           </a>
                            
                                                            
                            
                                                        </div>
                            
                                                    </li>
                            
                                                    <?php
                            
                                                }
                            
                             
                                        ?>
                            
                                        </ul>
                            
                                        </div>
							<?php
							}	
								}
							?>

                        </div>

                    </article>

                    

                    <div class="share-post fullwidth">

                        <?php

 						if ($event_social_sharing == "on"){

							cs_social_share();

						} 

					 cs_next_prev_custom_links('events'); 

					?>

                    </div>

                    <?php comments_template('', true); ?>

                </div>

                </div>

<!-- main End -->

				<?php if ( $cs_layout  == 'content-left col-md-9'){ ?>

                    <aside class="sidebar-right col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right) ) : ?><?php endif; ?></aside>

                <?php } ?>

<?php

    endwhile;

    $cs_counter_events++;

  get_footer(); ?>