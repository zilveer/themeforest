<?php

    /*
    *
    *	Directory Functions
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	sf_directory()
    *
    */

    if ( ! function_exists( 'sf_directory' ) ) {
        function sf_directory() {

            $search_term     = "";
            $category_term   = "";
            $location_term   = "";
            $excerpt_length         = "";
            $directory_itens = array();
            $count           = 0;

            if ( ! empty( $_REQUEST['search_term'] ) ) {
                $search_term = $_REQUEST['search_term'];
            }

            if ( ! empty( $_REQUEST['item_excerpt'] ) ) {
                $excerpt_length = $_REQUEST['item_excerpt'];
            }

            $tax_query          = array();
            $tax_query_category = array();
            $tax_query_location = array();

            if ( isset( $_REQUEST['location_term'] ) && $_REQUEST['location_term'] != '' && $_REQUEST['location_term'] != 'All' ) {

                $location_term      = $_REQUEST['location_term'];
                $tax_query_location = array(
                    'taxonomy' => 'directory-location',
                    'field'    => 'slug',
                    'terms'    => array( $location_term )
                );

                array_push( $tax_query, $tax_query_location );

            }

            if ( isset( $_REQUEST['category_term'] ) && $_REQUEST['category_term'] != '' && $_REQUEST['category_term'] != 'All' ) {
				
				$category_term_array = array();
                $category_term_array = explode(",", $_REQUEST['category_term']);
                                
                $tax_query_category = array(
                    'taxonomy' => 'directory-category',
                    'field'    => 'slug',
                    'terms'    => $category_term_array
                );

                array_push( $tax_query, $tax_query_category );

            }

            $search_query_args = array(
                's'                => $search_term,
                'post_type'        => 'directory',
                'post_status'      => 'publish',
                'posts_per_page'     => -1,
                'suppress_filters' => false,
                'tax_query'        => $tax_query,
                'meta_query'             => array(
                'relation' => 'AND',
													array(
															'key'       => 'sf_directory_address',
															'value'     => '',
															'compare'   => '!=',
															)
												)

            );


            $search_query_args = http_build_query( $search_query_args );
            $search_results    = get_posts( $search_query_args );

            foreach ( $search_results as $result ) {

                $directory_item                = array();
                $directory_item["pin_title"]   = $result->post_title;
                $directory_item["pin_content"] = $result->post_content;
                $directory_excerpt = $result->sf_custom_excerpt;

                //Get the excerpt
                if ( $directory_excerpt != '' && $excerpt_length > 0 ) 
                   $content = $directory_excerpt;
                else
                   $content = $result->post_content;

                $words          = explode( ' ', $content, $excerpt_length + 1 );
                $categories     = wp_get_post_terms( $result->ID, "directory-category" );
                $locations      = wp_get_post_terms( $result->ID, "directory-location" );
                $category_list  = $location_list = "";
                $c              = $l = 0;
                if ( $categories ) {
                    foreach ( $categories as $category ) {
                        if ( $c == 0 ) {
                            $category_list .= $category->name;
                        } else {
                            $category_list .= ', ' . $category->name;
                        }
                    }
                }
                if ( $locations ) {
                    foreach ( $locations as $location ) {
                        if ( $l == 0 ) {
                            $location_list .= $location->name;
                        } else {
                            $location_list .= ', ' . $location->name;
                        }
                    }
                }

                if ( count( $words ) > $excerpt_length ) {
                    array_pop( $words );
                    array_push( $words, '...' );
                     $directory_item["pin_short_content"] = implode( ' ', $words );
                }else{
                     $directory_item["pin_short_content"] =  $content;
                }

                $pin_img_url                        = wp_get_attachment_image_src( sf_get_post_meta( $result->ID, 'sf_directory_map_pin', true ), 'full' );
                $img_src                            = wp_get_attachment_image_src( get_post_thumbnail_id( $result->ID ), 'thumb-image' );
                $directory_item["pin_logo_url"]     = $pin_img_url[0];
                $directory_item["pin_thumbnail"]    = $img_src[0];
                $directory_item["pin_address"]      = sf_get_post_meta( $result->ID, 'sf_directory_address', true );
                $directory_item["pin_link"]         = esc_url( sf_get_post_meta( $result->ID, 'sf_directory_pin_link', true ) );
                $directory_item["pin_button_text"]  = sf_get_post_meta( $result->ID, 'sf_directory_pin_button_text', true );
                $directory_item["pin_lat"]          = sf_get_post_meta( $result->ID, 'sf_directory_lat_coord', true );
                $directory_item["pin_lng"]          = sf_get_post_meta( $result->ID, 'sf_directory_lng_coord', true );
                $directory_item["categories"]       = $category_list;
                $directory_item["locations"]         = $location_list;
                $directory_itens['items'][ $count ] = $directory_item;


                $count ++;
            }
            $directory_itens['map_1st_text']   = __( "What are you looking for?", "swiftframework" );
            $directory_itens['results_text_1'] = __( "Found", "swiftframework" );
            $directory_itens['results_text_2'] = __( "result", "swiftframework" );
            $directory_itens['results_text_2plural'] = __( "results", "swiftframework" );
            $directory_itens['search_text']    = __( "Search", "swiftframework" );

            $directory_itens_result = new WP_Query( $search_query_args );

            //If we get no results, then return error message
            if ( $count == 0 ) {
                $directory_itens['errormsg'] = __( "No results found, please try again.", "swiftframework" );
            }

            $directory_itens['results']    = $count;
			$directory_itens['locations'] = sf_directory_location_filter();
			$directory_itens['categories'] = sf_directory_category_filter($category_term);

            echo json_encode( $directory_itens );
            die();

        }

        add_action( 'wp_ajax_sf_directory', 'sf_directory' );
        add_action( 'wp_ajax_nopriv_sf_directory', 'sf_directory' );
    }


    /* DIRECTORY CATEGORY FILTER
    ================================================== */
    if ( ! function_exists( 'sf_directory_category_filter' ) ) {
        function sf_directory_category_filter( $selected_category = "" ) {

            $filter_output = $tax_terms = "";
            $tax_terms     = get_terms( 'directory-category' );
            $filter_output .= '<select class="filter-wrap  directory-category-option clearfix" id="dir-category-id" name="dir-category-id">' . "\n";
            $filter_output .= '<option class="all" value="All">' . __( "All Categories", "swiftframework" ) . '</option>' . "\n";

 			if( isset($_POST['dir-category-id'])){
					$selected_category = $_POST['dir-category-id'];
			}

            foreach ( $tax_terms as $tax_term ) {
                if ( $selected_category == $tax_term->slug ) {
                    $filter_output .= '<option value=' . $tax_term->slug . ' selected>' . $tax_term->name . '</option>' . "\n";
                } else {
                    $filter_output .= '<option value=' . $tax_term->slug . '>' . $tax_term->name . '</option>' . "\n";
                }
            }

            $filter_output .= '</select>' . "\n";

            return $filter_output;
        }
    }


    /* DIRECTORY LOCATION FILTER
    ================================================== */
    if ( ! function_exists( 'sf_directory_location_filter' ) ) {
        function sf_directory_location_filter() {

            $filter_output = $tax_terms = "";
            $tax_terms     = get_terms( 'directory-location', 'hide_empty=0' );
            $filter_output .= '<select class="filter-wrap directory-location-option clearfix " id="dir-location-id" name="dir-location-id">' . "\n";
            $filter_output .= '<option class="all selected" value="">' . __( "All Locations", "swiftframework" ) . '</option>' . "\n";
			$dir_location_val = "";

 			if( isset($_POST['dir-location-id'])){
					$dir_location_val = $_POST['dir-location-id'];
			}

            foreach ( $tax_terms as $tax_term ) {
            	if($dir_location_val == $tax_term->slug){
					$filter_output .= '<option value=' . $tax_term->slug . ' selected>' . $tax_term->name . '</option>' . "\n";
				}else{
					$filter_output .= '<option value=' . $tax_term->slug . '>' . $tax_term->name . '</option>' . "\n";
				}

            }

            $filter_output .= '</select>' . "\n";

            return $filter_output;
        }
    }

	  /* DIRECTORY ITEMS
    ================================================== */
    if ( ! function_exists( 'sf_directory_items' ) ) {
        function sf_directory_items($excerpt_length, $pagination, $item_count, $directory_cat, $order = "standard") {

            /* OUTPUT VARIABLE
            ================================================== */
            $directory_items_output = $grid_size = "";
            $count                  = 0;

            /* DIRECTORY QUERY SETUP
            ================================================== */
            global $post, $wp_query;

            if ( get_query_var( 'paged' ) ) {
                $paged = get_query_var( 'paged' );
            } elseif ( get_query_var( 'page' ) ) {
                $paged = get_query_var( 'page' );
            } else {
                $paged = 1;
            }

            $order_mode = $order_by = "";


            if ( $order == "standard" ) {
                $order_mode = "DESC";
                $order_by   = "date";
            } else if ( $order == "date-asc" ) {
                $order_mode = "ASC";
                $order_by   = "date";
            } else if ( $order == "date-desc" ) {
                $order_mode = "DESC";
                $order_by   = "date";
            } else if ( $order == "title-desc" ) {
                $order_mode = "DESC";
                $order_by   = "title";
            } else if ( $order == "title-asc" ) {
                $order_mode = "ASC";
                $order_by   = "title";
            }

            $tax_query = array();
            $tax_query_category = array();
            $tax_query_location = array();
            

            
            if ( isset( $directory_cat) && $directory_cat != '' && $directory_cat != 'All' ) {
				$directory_cat_array = array();
                $directory_cat_array = explode(",", $directory_cat);
                
                $tax_query_category = array(
                    'taxonomy' => 'directory-category',
                    'field'    => 'slug',
                    'terms'    => $directory_cat_array
                );

                array_push( $tax_query, $tax_query_category );

            }

            if ( isset( $_POST['dir-category-id'] ) && $_POST['dir-category-id'] != '' && $_POST['dir-category-id'] != 'All' ) {

                $category_term      = $_POST['dir-category-id'];
                $tax_query_category = array(
                    'taxonomy' => 'directory-category',
                    'field'    => 'slug',
                    'terms'    => array( $category_term )
                );

                array_push( $tax_query, $tax_query_category );

            }

            if ( isset( $_POST['dir-location-id'] ) && $_POST['dir-location-id'] != '' && $_POST['dir-location-id'] != 'All' ) {

                $location_term      = $_POST['dir-location-id'];
                $tax_query_location = array(
                    'taxonomy' => 'directory-location',
                    'field'    => 'slug',
                    'terms'    => array( $location_term )
                );

                array_push( $tax_query, $tax_query_location );

            }

            $search_term = "";

            if( isset($_POST['dir-search-value']) ){
				$search_term = $_POST['dir-search-value'];
			}

            //Get all itens when there is no pagination
            if( $pagination != 'yes' ){
				$item_count = -1;
			}
			
            $directory_args = array(
                's'                => $search_term,
                'post_type'          => 'directory',
                'post_status'        => 'publish',
                'paged'              => $paged,
                'posts_per_page'     => $item_count,
                'order'              => $order_mode,
                'orderby'            => $order_by,
                'tax_query'        => $tax_query,
                'meta_query'             => array(
                'relation' => 'AND', array(
											'key'       => 'sf_directory_address',
											'value'     => '',
											'compare'   => '!=',
											)
								)

            );

            $directory_items = new WP_Query( $directory_args );

            /* ITEMS OUTPUT
            ================================================== */
            global $sf_options;

  			$directory_items_output .= '<div class="directory-list-results">';
            while ( $directory_items->have_posts() ) : $directory_items->the_post();

               $directory_items_output .= '<div class="directory-item clearfix">';

                /* META VARIABLES
                ================================================== */
                $item_title  = get_the_title();
                $img_src     = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb-image' );
                $pin_link    = esc_url( sf_get_post_meta( $post->ID, 'sf_directory_pin_link', true ) );
                $pin_button_text = sf_get_post_meta( $post->ID, 'sf_directory_pin_button_text', true );

                $custom_excerpt = sf_get_post_meta( $post->ID, 'sf_custom_excerpt', true );
                $post_excerpt   = '';

                if ( $custom_excerpt != '') {
					$post_excerpt = $custom_excerpt;
                } else {
                	$post_excerpt = sf_excerpt( $excerpt_length );
                }
                

                $post_excerpt .= ' <a class="read-more-directory" href="'. get_permalink( $post->ID ) . '">  ' . __('Read More', 'swiftframework') . '</a>';
                $post_terms = get_the_terms( $post->ID, 'directory-category' );
                $term_slug  = " ";
				$category_list_text = "";

                if ( ! empty( $post_terms ) ) {
                    foreach ( $post_terms as $post_term ) {
                        $term_slug = $term_slug . $post_term->slug . ' ';
                        $category_list_text .= $post_term->name. ' | ';
                    }
                }

                $category_list_text = rtrim($category_list_text, "| ");

                $location_terms = get_the_terms( $post->ID, 'directory-location' );
				$location_text = "";

                if ( ! empty( $location_terms ) ) {
                    foreach ( $location_terms as $location_term ) {
                        $location_text .= $location_term->name. ' | ';
                    }

                    $location_text = rtrim($location_text, "| ");

                    if ( $category_list_text != ''){
						$location_text = '| ' . $location_text;
					}

                }

                /* ITEM OUTPUT
                ================================================== */

                if ( isset($img_src[0]) ) {
                	$directory_items_output .= '<figure class="animated-overlay overlay-alt">';
					$directory_items_output .= '<img itemprop="image" src="' .$img_src[0].'" alt="' . $item_title .'">';
					$directory_items_output .= '<a href="' . get_permalink($post->ID) . '" class="link-to-post"></a><div class="figcaption-wrap"></div>';
              		$directory_items_output .= '<figcaption><div class="thumb-info"><h4>' .$item_title. '</h4></div></figcaption></figure>';
              		$item_left_margin = "";
				} else {
					$item_left_margin = "dir-item-no-margin";
				}


                $directory_items_output .= '<div class="directory-item-details ' . $item_left_margin . '"><h3>' . $item_title . '</h3>';
                $directory_items_output .= '<div class="item-meta">' . $category_list_text . ' ' . $location_text . '</div><div class="excerpt" itemprop="description">' . $post_excerpt . '</div>';

                if( $pin_button_text != '' && $pin_link != ''){
					$directory_items_output .= '<a class="read-more-button" href="' . $pin_link . '" target="_blank">' . $pin_button_text . '</a>';
				}

                $directory_items_output .= '</div></div>';
                $count ++;

            endwhile;

            wp_reset_query();
            wp_reset_postdata();

            /* PAGINATION OUTPUT
            ================================================== */
            if ( $pagination == "yes" ) {
                    $directory_items_output .= pagenavi( $directory_items, '<div class="pagination-wrap">', '</div>');
            }

			$directory_items_output .= '</div>';

            /* FUNCTION OUTPUT
            ================================================== */

            return $directory_items_output;
        }
    }
?>
