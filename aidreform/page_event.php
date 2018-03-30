<?php

	global $cs_node,$post,$cs_theme_option,$cs_counter_node,$wpdb;
	date_default_timezone_set('UTC');
	$current_time = current_time('Y-m-d H:i', $gmt = 0 ); 
	if ( !isset($cs_node->cs_event_per_page) || empty($cs_node->cs_event_per_page) ) { $cs_node->cs_event_per_page = -1; }
	  $meta_compare = '';
        $filter_category = '';
        if ( $cs_node->cs_event_type == "Upcoming Events" ) $meta_compare = ">";
        else if ( $cs_node->cs_event_type == "Past Events" ) $meta_compare = "<";
        $row_cat = $wpdb->get_row("SELECT * from ".$wpdb->prefix."terms WHERE slug = '" . $cs_node->cs_event_category ."'" );
        if ( isset($_GET['filter_category']) ) {$filter_category = $_GET['filter_category'];}
        else {
            if(isset($row_cat->slug)){
            $filter_category = $row_cat->slug;
            }
        }
		$cs_counter_events = 0;
		if ( empty($_GET['page_id_all']) ) $_GET['page_id_all'] = 1;
            if ( $cs_node->cs_event_type == "All Events" ) {
                $args = array(
                    'posts_per_page'			=> "-1",
                    'post_type'					=> 'events',
                  //  'event-category'			=> "$filter_category",
                    'post_status'				=> 'publish',
                    'orderby'					=> 'meta_value',

                    'order'						=> 'ASC',

                );

            }

            else {

                $args = array(

                    'posts_per_page'			=> "-1",

                    'post_type'					=> 'events',

                  //  'event-category'			=> "$filter_category",

                    'post_status'				=> 'publish',

                    'meta_key'					=> 'cs_event_from_date_time',

                    'meta_value'				=> $current_time,

                    'meta_compare'				=> $meta_compare,

                    'orderby'					=> 'meta_value',

                    'order'						=> 'ASC',

                );

            }

			

			if(isset($filter_category) && $filter_category <> '' && $filter_category <> '0'){

					$event_category_array = array('event-category' => "$filter_category");

					$args = array_merge($args, $event_category_array);

				}

		

            $custom_query = new WP_Query($args);

            $count_post = 0;

			$counter = 1;

			$count_post = $custom_query->post_count;

			if ( $cs_node->cs_event_type == "Upcoming Events") {
 				$args = array(

					'posts_per_page'			=> "$cs_node->cs_event_per_page",

					'paged'						=> $_GET['page_id_all'],

					'post_type'					=> 'events',

					'event-category'			=> "$filter_category",

					'post_status'				=> 'publish',

					'meta_key'					=> 'cs_event_from_date_time',

					'meta_value'				=> $current_time,

					'meta_compare'				=> $meta_compare,

					'orderby'					=> 'meta_value',

					'order'						=> 'ASC',

				 );

			}else if ( $cs_node->cs_event_type == "All Events" ) {

				$args = array(

					'posts_per_page'			=> "$cs_node->cs_event_per_page",

					'paged'						=> $_GET['page_id_all'],

					'post_type'					=> 'events',

					//'event-category'			=> "$filter_category",

					'meta_key'					=> 'cs_event_from_date_time',

					'meta_value'				=> '',

					'post_status'				=> 'publish',

					'orderby'					=> 'meta_value',

					'order'						=> 'DESC',

				);

			}

			else {

				$args = array(

					'posts_per_page'			=> "$cs_node->cs_event_per_page",

					'paged'						=> $_GET['page_id_all'],

					'post_type'					=> 'events',

				//	'event-category'			=> "$filter_category",

					'post_status'				=> 'publish',

					'meta_key'					=> 'cs_event_from_date_time',

					'meta_value'				=> $current_time,

					'meta_compare'				=> $meta_compare,

					'orderby'					=> 'meta_value',

					'order'						=> 'ASC',

				 );

			}

			if(isset($filter_category) && $filter_category <> '' && $filter_category <> '0'){

			$event_category_array = array('event-category' => "$filter_category");

			$args = array_merge($args, $event_category_array);

		}

		$custom_query = new WP_Query($args);

	?>

    

    <div class="element_size_<?php echo $cs_node->event_element_size; ?>">

    <header class="cs-heading-title">

    	<?php if ($cs_node->cs_event_title <> '') { ?>

            <h2 class="cs-section-title float-left"><?php echo $cs_node->cs_event_title;?></h2>

         <?php }?>

         <?php if($cs_node->cs_event_filterables == "Yes"){

			$qrystr= "";

			if ( isset($_GET['page_id']) ) $qrystr = "&page_id=".$_GET['page_id'];

		?>  

        <!-- Sortby Start -->

        <div id="filter-list">

            <ul id="filters">

                

                 <?php

                    if( isset($cs_node->cs_event_category) && ($cs_node->cs_event_category <> "" && $cs_node->cs_event_category <> "0") && isset( $taxonomy->term_id )){

                    $categories = get_categories( array('child_of' => "$row_cat->term_id", 'taxonomy' => 'event-category', 'hide_empty' => 0) );

					?>

                    <li class="<?php if(($cs_node->cs_event_category==$filter_category)){echo 'bgcolr';}?>"><a href="?<?php echo $qrystr."&filter_category=".$row_cat->slug?>"><?php _e("All",'AidReform');?></a></li>

                    <?php

                    }else{

                    $categories = get_categories( array('taxonomy' => 'event-category', 'hide_empty' => 0) );

                    }

                    foreach ($categories as $category) {

                    ?>

               			<li <?php if($category->slug==$filter_category){echo 'class="bgcolr"';}?>><a href="?<?php echo $qrystr."&filter_category=".$category->slug?>"><?php echo $category->cat_name?></a></li>

               <?php }?>

            </ul>

        </div>

        <!-- Sortby End -->

        <?php }?>

    </header>

    <div class="event-listing fullwidth">

	<?php

		if ( $custom_query->have_posts() <> "" ) {

		while ( $custom_query->have_posts() ): $custom_query->the_post();	

			$event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);
 
				$year_event = date("Y", strtotime($event_from_date));

				$month_event = date("m", strtotime($event_from_date));

				$month_event_c = date("M", strtotime($event_from_date));							

				$date_event = date("d", strtotime($event_from_date));



			$cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);

				if ( $cs_event_meta <> "" ) {

					$cs_event_meta = new SimpleXMLElement($cs_event_meta);

					$inside_event_gallery = $cs_event_meta->inside_event_gallery;

					$event_start_time = $cs_event_meta->event_start_time;

					$event_end_time = $cs_event_meta->event_end_time;

					$event_all_day = $cs_event_meta->event_all_day;

					if($cs_event_meta->event_address <> ''){

						$address_map = get_the_title("$cs_event_meta->event_address");	

					}else{

						$address_map = '';

					}

				}

 
			

 		?>

        <article>

            <time datetime="<?php echo $event_from_date; ?>" class="date-event"><strong> <?php echo $date_event; ?> </strong> <?php echo $month_event_c; ?></time>

            <div class="desc">

                <div class="accessories-area gallery">

                    <ul class="lightbox">

                        <?php add_to_calender(); ?>

                        <li><a class="bgcolrhvr" href="<?php the_permalink();?>"> <em class="fa fa-map-marker"></em> <?php if(isset($cs_theme_option['trans_switcher'])){if($cs_theme_option['trans_switcher'] == "on"){ _e('Location','AidReform');} }else{ if(isset($cs_theme_option['trans_event_location'])){ echo $cs_theme_option['trans_event_location']; } } ?></a></li>

                        <?php

                        if($inside_event_gallery <> ""){

						$cs_meta_gallery_options = get_post_meta($inside_event_gallery, "cs_meta_gallery_options", true);

						?>

                       

                        	<?php

							if ( $cs_meta_gallery_options <> "" ) {

								$cs_event_gallery = new SimpleXMLElement($cs_meta_gallery_options);

								$cs_gallery_limit_start = 0;
	
								$cs_gallery_limit_end = count($cs_event_gallery);
							}
							
							$cs_gallery_limit_start = 0;
	
							$cs_gallery_limit_end = 0;
							?>

                           

                            <?php

							for ( $i = $cs_gallery_limit_start; $i < $cs_gallery_limit_end; $i++ ) {

								$path = $cs_event_gallery->gallery[$i]->path;

								$title = $cs_event_gallery->gallery[$i]->title;

								$social_network = $cs_event_gallery->gallery[$i]->social_network;

								$use_image_as = $cs_event_gallery->gallery[$i]->use_image_as;

								$video_code = $cs_event_gallery->gallery[$i]->video_code;

								$link_url = $cs_event_gallery->gallery[$i]->link_url;

								$image_url_full = cs_attachment_image_src($path, 0, 0);

								

							

							?>

                             <li <?php if($i!=0){?> style=" display:none" <?php }?>>
                             <?php 
							 	
								if(isset($cs_theme_option['trans_event_pics']) && $cs_theme_option['trans_event_pics']<>'')
								{
									$var_event_photo = $cs_theme_option['trans_event_pics'];
								}
								else
								{
									$var_event_photo =  __('Pics','AidReform');
								}
								?>
                               <a class="bgcolrhvr" data-title="<?php if ( $title <> "" ) { echo $title;}?>" href="<?php if($use_image_as==1)echo $video_code; elseif($use_image_as==2) echo $link_url; else echo $image_url_full;?>" target="<?php if($use_image_as==2) echo '_blank'; ?>" data-rel="prettyPhoto[gallery<?php echo $counter; ?>]" > <em class="fa fa-picture-o"></em><?php echo count($cs_event_gallery); ?> <?php if(isset($cs_theme_option['trans_switcher']) && $cs_theme_option['trans_switcher'] == "on"){ _e('Pics','AidReform');}else{ echo $var_event_photo; } ?></a>
                        </li>
                        <?php

						}

						}

						?>

                    </ul>

                </div>

            <div class="text">

                <h2 class="cs-post-title"><a href="<?php the_permalink();?>" class="colrhover"><?php echo substr(get_the_title(), 0, 40); if(strlen(get_the_title())>40) echo '...'; ?></a></h2>

                <div class="post-option">

                    <ul>

                    	<?php

						$before_cat ='<li>';

                        $categories_list = get_the_term_list ( get_the_id(), 'event-category', $before_cat, ' ', '</li>' );

                        if ( $categories_list ): printf( __( '%1$s', 'AidReform'),$categories_list ); endif;

						

						if($event_start_time <> "" and $cs_node->cs_event_time == "Yes"){

						?>

                        <li><time datetime="<?php echo $event_from_date; ?>"><em class="fa fa-clock-o"></em><?php echo $event_start_time; if($cs_event_meta->event_end_time <> ''){ echo "-";  echo $cs_event_meta->event_end_time; }?></time></li>

                        <?php

						}if($address_map <> ""){

						?>

                        <li><em class="fa fa-globe"></em><?php echo $address_map; ?></li>

                        <?php

						}

						?>

                    </ul>

                </div>

             </div>   

            </div>    

        </article>        

	<?php

	endwhile; 

	}

	wp_reset_query();

	?>

    </div>

    <?php 

		

	$qrystr = '';

	  if ( $cs_node->cs_event_pagination == "Show Pagination" and $count_post > $cs_node->cs_event_per_page and $cs_node->cs_event_per_page > 0 and $cs_node->cs_event_filterables != "On" ) {

		echo "<nav class='pagination'><ul>";

			if ( isset($_GET['page_id']) ) $qrystr = "&page_id=".$_GET['page_id'];

				echo cs_pagination($count_post, $cs_node->cs_event_per_page,$qrystr);

		echo "</ul></nav>";

	}

	?>

  

</div>

