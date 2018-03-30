<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    
    <?php 
        
        $display_post_format_content = true; 
        
        $post_format = uxbarn_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_portfolio_item_format'), 0);
        $show_meta = uxbarn_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_portfolio_meta_info_display'), 0);
		//echo var_dump($show_meta);
        if ( $show_meta == '' || $show_meta == 'false' ) {
			$show_meta = false;
		} else {
			$show_meta = true;
		}
		//echo var_dump($show_meta);
		
        // These meta info are used to display in the meta box, and for querying related items
        $meta_date = uxbarn_get_portfolio_meta_text(
                        uxbarn_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_portfolio_meta_info_date'), 0));
                    
        $meta_client = uxbarn_get_portfolio_meta_text(
                        uxbarn_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_portfolio_meta_info_client'), 0));
                        
        $meta_website = uxbarn_get_portfolio_meta_text(
                            uxbarn_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_portfolio_meta_info_website'), 0));
                            
        $meta_website_link = '';
        
        if(trim($meta_website) == '' || trim($meta_website) == '-' || trim($meta_website) == 'http://') {
            $meta_website_link = '#';
        } else {
            if(strpos($meta_website,'http://') === false) {
                $meta_website_link .= 'http://' . $meta_website;
            }
        }
        
        $content_column = 'large-12';
        
        if($show_meta) {
            $content_column = 'large-9 height-280';
        }
        
    ?>
    
    <?php if($display_post_format_content) : ?>
    
        <?php if($post_format == 'image-slideshow') : ?>
            
            <?php
                
                $images = uxbarn_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_portfolio_image_slideshow'), 0);
                
            ?>
    
            <?php if(!empty($images)) : ?>
                
            <?php
                
                // Enqueue required scripts (moved to functions.php)
                //wp_enqueue_script('uxbarn-carouFredSel');
                //wp_enqueue_style('uxbarn-fancybox');
                //wp_enqueue_script('uxbarn-fancybox');
				
				$images_url_count = 0;
				foreach($images as $image) {
					if($image['uxbarn_portfolio_image_slideshow_upload'] != '') {
						$images_url_count += 1;
					}
				}
                        
            ?>
                
            <!-- Portfolio Images -->
            <div class="row">
                <div class="uxb-col large-12 columns no-padding">
                    <div id="portfolio-item-images">
                        
                        <?php foreach($images as $image) : ?>
                        	
                    		<?php
                        	
                        		$image_url = $image['uxbarn_portfolio_image_slideshow_upload'];
								$attachment_id = uxbarn_get_attachment_id_from_src($image_url);
								$caption = '';
								$alt = '';
								$title = '';
								$image_width = '1020';
								$image_height = '500';
								
                                $image_size = 'single-portfolio';
                                $img_srcset_attr = '';
                                $img_sizes_attr = '';
                                
								// Whether the entered URL is from external site or not
								if(isset($attachment_id)) { // From its own attachement archive
									$attachment = uxbarn_get_attachment($attachment_id);
								//echo var_dump($attachment);
									$caption = $attachment['caption'];
									$alt = $attachment['alt'];
									$title = $attachment['title'];
									
									// Got an array [0] => url, [1] => width, [2] => height
									$image_array = wp_get_attachment_image_src($attachment_id, $image_size);
									$image_final_url = $image_array[0];
									$image_width = $image_array[1];
									$image_height = $image_array[2];
							
                                    // srcset and sizes attributes
                                    $img_srcset_attr = wp_get_attachment_image_srcset( $attachment_id, $image_size );
                                    $img_sizes_attr = wp_get_attachment_image_sizes( $attachment_id, $image_size );
                                    
								} else { // From external site
									$image_final_url = $image_url;
								}
								
                        	?>
                            
                            <?php if($image_url) : ?>
	                            
	                            <div class="single-portfolio-item">
	                                <a href="<?php echo $image_url; ?>" class="image-box" title="<?php echo $title; ?>" rel="portfolio-image-group">
                                        
                                        <img 
                                            src="<?php echo esc_url( $image_final_url ); ?>" 
                                            alt="<?php echo esc_attr( $alt ); ?>" 
                                            width="<?php echo intval( $image_width ); ?>" 
                                            height="<?php echo intval( $image_height ); ?>" 
                                            srcset="<?php echo esc_attr( $img_srcset_attr ); ?>" 
                                            sizes="<?php echo esc_attr( $img_sizes_attr ); ?>" 
                                        />
                                    
                                    </a>
	                                
	                                <?php if($caption != '') : ?>
	                                	<div class="image-caption"><?php echo $caption; ?></div>
	                                <?php endif; ?>
	                            </div>
	                            
                            <?php endif; ?>
                            
                        <?php endforeach; ?>
                    
                    </div>
                    <?php if($images_url_count > 0) : ?>
	                    <div id="portfolio-item-images-controller">
	                        <a href="#" id="portfolio-item-images-prev"><i class="fa fa-angle-left"></i></a>
	                        <a href="#" id="portfolio-item-images-next"><i class="fa fa-angle-right"></i></a>
	                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php endif; // if(!empty($images)) ?>
            
        <?php elseif($post_format == 'video') : ?>
            
            <?php
            
                $source = uxbarn_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_portfolio_video_source'), 0);
                $video_id = trim(uxbarn_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_portfolio_video_id'), 0));
            
            ?>
            
            <?php if($video_id) : ?>
            
                <div class="embed no-margin">
                    <?php if($source == 'vimeo') : ?>
                        
                        <iframe src="http://player.vimeo.com/video/<?php echo $video_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;badge=0"  frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                        
                    <?php else : ?>
                        
                        <iframe src="http://www.youtube.com/embed/<?php echo $video_id; ?>?wmode=opaque" frameborder="0" allowfullscreen></iframe>
                        
                    <?php endif; ?>
                </div>
                
            <?php else : ?>
                
                <div class="info box"><?php _e('You have not yet specified the video ID.', 'uxbarn'); ?></div>
                
            <?php endif; // END: if($video_id) ?>
                
        <?php endif; // END: if($post_format == 'image-slideshow') ?>
        
    <?php endif; // END: if($display_post_format_content) ?>
        
    <div id="portfolio-item-info-wrapper" class="row grey-bg">
        
        <?php if($show_meta) : ?>
            
            <div id="portfolio-item-info" class="uxb-col large-3 columns no-padding">
                <ul id="portfolio-item-meta">
                    <li>
                        <i class="fa fa-calendar"></i><strong><?php _e('Date', 'uxbarn'); ?></strong>
                        <p>
                            <?php echo $meta_date; ?>
                        </p>
                    </li>
                    <li>
                        <i class="fa fa-user"></i><strong><?php _e('Client', 'uxbarn'); ?></strong>
                        <p>
                            <?php echo $meta_client; ?>
                        </p>
                    </li>
                    <li>
                        <i class="fa fa-tags"></i><strong><?php _e('Categories', 'uxbarn'); ?></strong>
                        <?php
                            
                            $output = '';
                            $terms = get_the_terms(get_the_ID(), 'portfolio-category');
                            
                            if ($terms && ! is_wp_error($terms))  {
                            $output .= '<ul id="portfolio-item-categories">';
                            foreach ($terms as $term) {
                                $output .= '<li><a href="' . get_term_link(intval($term->term_id), $term->taxonomy) . '">' . $term->name . '</a></li>';
                            }
                            $output .= '</ul>';
                        }
                            
                        echo $output;
                        
                        ?>
                    </li>
                    <li>
                        <i class="fa fa-globe"></i><strong><?php _e('Website', 'uxbarn'); ?></strong>
                        <p>
                            <a href="<?php echo $meta_website_link; ?>" target="_blank"><?php echo $meta_website; ?></a>
                        </p>
                    </li>
                </ul>
            </div>
        
        <?php endif; // if($show_meta) ?>
        
        <div class="uxb-col <?php echo $content_column; ?> white-bg for-nested columns">
            <?php echo uxbarn_get_final_post_content(); ?>
        </div>
        
    </div>
    
    <?php
    	
		$display_related_items = true;
		if ( function_exists( 'ot_get_option' ) ) {
			
        	$display_related_items = ot_get_option('uxbarn_to_setting_display_related_items_section');
			if ( $display_related_items == '' || $display_related_items == 'false' ) {
				$display_related_items = false;
			} else {
				$display_related_items = true;
			}
			
		}
    
    ?>
    
    <?php if($display_related_items) : ?>
        
        <?php
        	
			// Load required scripts (Moved to functions.php)
			//wp_enqueue_script('uxbarn-hoverdir');
	        //wp_enqueue_style('uxbarn-isotope');
	        //wp_enqueue_script('uxbarn-isotope');
        	
        	$scope = '';
			if ( function_exists( 'ot_get_option' ) ) {
            	$scope = ot_get_option('uxbarn_to_setting_related_items_scope');
			}
            
            if($scope != '') {
                $scope = array_values($scope);
            } else {
                $scope = array();
            }
            
            
            // Default category filter
            $category_id_list = array(-1);
            $terms = get_the_terms(get_the_ID(), 'portfolio-category');
        	
			if($terms) {
	            foreach ($terms as $term) {
	                $category_id_list[] = $term->term_id;
	            }
			}
            
            $category_array = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'portfolio-category',
                        'field' => 'id',
                        'terms' => $category_id_list,
                    ),
                ),
            );
            
            
            // Custom fields filter
            $raw_client_field = array();
            if(in_array('client', $scope)) {
                $raw_client_field = array(
                    'key' => 'uxbarn_portfolio_meta_info_client',
                    'value' => $meta_client,
                    'compare' => '=',
                );
            }
            
            $raw_website_field = array();
            if(in_array('website', $scope)) {
                $raw_website_field = array(
                    'key' => 'uxbarn_portfolio_meta_info_website',
                    'value' => $meta_website,
                    'compare' => '=',
                );
            }
            
            $raw_date_field = array();
            if(in_array('date', $scope)) {
                $raw_date_field = array(
                    'key' => 'uxbarn_portfolio_meta_info_date',
                    'value' => $meta_date,
                    'compare' => '=',
                );
            }
            
            $raw_custom_fields_array = array(
                'relation' => 'OR',
                $raw_client_field,
                $raw_website_field,
                $raw_date_field,
            );
            
            $custom_fields_array = array(
                'relation' => 'OR',
                'meta_query' => $raw_custom_fields_array,
            );
            
            // Final result for all filters
            $result_filtering_array = array_merge($category_array, $custom_fields_array);
			
            $args = array(
                'post_type' => 'portfolio',
                'nopaging' => true,
                'post__not_in' => array(get_the_ID()), // Not retrieve itself
            );
            
            $related_items = new WP_Query(array_merge($args, $result_filtering_array));
			
            if($related_items->have_posts()) {
                
                echo 
                '<!-- Related Items -->
                <div class="row top-margin">
                    <div class="uxb-col large-12 columns bottom-line">
                        <h3 class="no-margin">' . __('Related Projects', 'uxbarn') . '</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="uxb-col large-12 columns no-padding">
                        <div class="portfolio-root-wrapper related-items col4">
                            <div class="portfolio-wrapper grey-bg">';
                
                while($related_items->have_posts()) {
                    $related_items->the_post();
                    
                    $thumbnail = '';
                    if(has_post_thumbnail(get_the_ID())) {
                        $thumbnail = get_the_post_thumbnail(get_the_ID(), 'large-square', array('alt'=>get_the_title()));
                    } else {
                        $thumbnail = '<img src="' . IMAGE_PATH . '/placeholders/large-square.gif" alt="' . __('No Thumbnail', 'uxbarn') . '" />';
                    }
                    
                    $related_item_terms = get_the_terms(get_the_ID(), 'portfolio-category');
                    $related_item_terms_code = '';
                    if ($related_item_terms && ! is_wp_error($related_item_terms))  {
                        $related_item_terms_code .= '<ul>';
                        foreach ($related_item_terms as $term) {
                            $related_item_terms_code .= '<li><a href="' . get_term_link(intval($term->term_id), $term->taxonomy) . '">' . $term->name . '</a></li>';
                        }
                        $related_item_terms_code .= '</ul>';
                    }
                    
                    echo 
                    '<div class="portfolio-item">
                        <div class="portfolio-item-hover">
                            <h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>
                            ' . $related_item_terms_code . '
                        </div>
                        ' . $thumbnail . '
                    </div>';
                    
                }

                echo '</div></div>'; // close "portfolio-wrapper", "portfolio-root-wrapper"
                echo '</div></div>'; // close "columns", "row"

            }
            
            wp_reset_postdata();
        ?>
        
    <?php endif; // if($display_related_items) ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>