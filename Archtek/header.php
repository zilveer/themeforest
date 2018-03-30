<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
        <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
        <?php endif; ?>
        
        <?php if ( function_exists( 'ot_get_option' ) ) : if ( ot_get_option( 'uxbarn_to_setting_upload_favicon' ) ) : ?>
            <link rel="icon" type="image/png" href="<?php echo ot_get_option( 'uxbarn_to_setting_upload_favicon' ); ?>">
        <?php endif; endif; ?>
        
        <?php wp_head(); ?>
    </head>

    <body id="theme-body" <?php body_class(); ?>>
        
        <div id="root-container">
    	
    	<?php 
    	
			$header_style_class = '';
			
			if ( function_exists( 'ot_get_option' ) ) {
					
				if(ot_get_option('uxbarn_to_setting_header_style') == 'center') {
					$header_style_class = ' center ';
				}
				
			}
			
    	?>
        
        <div id="header-container" class="content-width <?php echo $header_style_class; ?>">
            <!-- Logo -->
            <div id="logo-wrapper">
                <div id="logo">
                    <a href="<?php echo home_url( '/' ); ?>">
                        
                        <?php
                        
                            $logo_url = get_option('uxbarn_sc_header_site_logo');
                            
                            if($logo_url) {
                                echo '<img src="' . $logo_url . '" alt="' . get_bloginfo('name') . '" />';
                            } else {
                                echo '<h1>' . get_bloginfo('name') . '</h1>';
                            }
                        
                        ?>
                        
                    </a>
                    <p>
                        <?php bloginfo('description'); ?>
                    </p>
                </div>
            </div>
            
            <!-- Menu -->
            <div id="menu-wrapper">
                
                <?php $args = array(
                    'theme_location'=>'header-menu',
                    'menu_class'=>'sf-menu',
                    'menu_id'=>'root-menu',
                    'fallback_cb'=>false
                    );
                    
                    wp_nav_menu($args);
                ?>
                
                <nav id="mobile-menu" class="top-bar">
                    <ul class="title-area">
                        <!-- Do not remove this list item -->
                        <li class="name"></li>
                        
                        <!-- Menu toggle button -->
                        <li class="toggle-topbar menu-icon">
                            <a href="#"><span><?php _e('Menu', 'uxbarn'); ?></span></a>
                        </li>
                    </ul>
                    
                    <!-- Mobile menu's container -->
                    <section class="top-bar-section"></section>
                </nav>
            </div>
            
            <?php
            	
            	if ( function_exists( 'ot_get_option' ) ) {
	            		
	            	$display_wpml_selector = ot_get_option('uxbarn_to_setting_display_theme_wpml_lang_selector');
	            	if ( $display_wpml_selector == '' || $display_wpml_selector == 'false' ) {
						$display_wpml_selector = false;
					} else {
						$display_wpml_selector = true;
					}
				
				} else {
					$display_wpml_selector = false;
				}
            
            ?>
            
            <?php if(function_exists('icl_get_languages') && $display_wpml_selector) : // If WPML plugin is active, display lang selector. ?>
	            <div id="wpml-language-selector">
	            	<?php do_action('icl_language_selector'); ?>
	            </div>
            <?php endif; ?>
            
            <!-- Search -->
            <div id="header-search">
                <a id="header-search-button" href="javascript:;"><i class="fa fa-search"></i></a>
            </div>
            <div id="header-search-input-wrapper">
                <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input id="header-search-input" name="s" type="text" placeholder="<?php echo esc_attr(__('Type and hit enter to search ...', 'uxbarn')); ?>" value="<?php echo trim( get_search_query() ); ?>" />
                </form>
            </div>
            
        </div> <!-- End id="header-container" -->
        
        <?php 
        
            $no_header_image_class = '';
            $slider_header_footer_style = uxbarn_get_slider_header_footer_style();
            
        ?>
        
        <?php if(is_front_page() || uxbarn_is_frontpage_child() && !is_search() && !is_single() && !is_page() ) : // Use home slider on front page ?>
            
                <?php
                	
					if ( function_exists( 'ot_get_option' ) ) {
							
	                    $slider_type = ot_get_option('uxbarn_to_setting_select_slider');
	                    
	                    if($slider_type == '') {
	                        $slider_type = 'basic-slider';
	                    }
					
					} else {
						$slider_type = 'basic-slider';
					}
                    
                ?>
                
                <?php if($slider_type == 'basic-slider') : ?>
                
                    <!-- Home Slider Container -->
                    <div id="home-slider-container"<?php echo $slider_header_footer_style; ?>>
                            
                        <div id="home-slider">
                            
                            <?php
                            
                            	$args = array(
									'post_type' => 'homeslider',
									'nopaging' => true,
									'meta_key' => 'uxbarn_homeslider_slide_order',
									'orderby' => 'meta_value_num',
									'order' => 'ASC',
								);
                            	
                                $slides = new WP_Query($args);
								
                            ?>
                            
                            <?php if($slides->have_posts()) : ?>
                                
                                <?php $i = 1; while($slides->have_posts()) : $slides->the_post(); ?>
                                    
                                    <?php 
                                    	
                                        // Define slide ID
                                        $slide_id = 'slide_' . $i;
                                    ?>
                                    
                                    <div id="<?php echo $slide_id; ?>" class="home-slider-item">
                                        
                                        <?php
                                        
                                            // Display slide image
                                            if(has_post_thumbnail()) {
                                                echo get_the_post_thumbnail($post->ID, 'home-slider-image');
                                            } else {
                                                echo '<img src="' . IMAGE_PATH . '/placeholders/2000x624.gif" alt="' . __('No Image', 'uxbarn') . '" width="2000" height="624" />';
                                            }
                                            
                                            $show_caption = uxbarn_get_array_value( get_post_meta( $post->ID,'uxbarn_homeslider_caption_display' ), 0 );
                                            if ( $show_caption == '' || $show_caption == 'false' ) {
												$show_caption = false;
											} else {
												$show_caption = true;
											}
											
											 
                                            // Define caption ID
                                            $slide_caption_id = 'slide-caption_' . $i;
                                            
                                        ?>
                                        
                                        <?php if($show_caption) :    ?>
                                            <div id="<?php echo $slide_caption_id; ?>" class="slider-caption">
	                                            <h2 class="caption-title"><?php the_title(); ?></h2>
	                                            <p class="caption-body">
	                                                <?php echo uxbarn_get_array_value(get_post_meta($post->ID,
	                                                                     'uxbarn_homeslider_caption_body'), 0); ?>
	                                            </p>
	                                        </div>
                                        <?php endif; ?>
                                        
                                    </div>
                                    
                                <?php $i++; endwhile; ?>
                                
                            <?php else : // If there is no slide ?>
                                
                                <div class="home-slider-item no-slide">
                                    <div class="slider-caption">
	                                    <h2 class="caption-title"><?php _e('No Slide', 'uxbarn'); ?></h2>
	                                    <p class="caption-body">
	                                        <?php _e('You have not yet added any slide. Please go to "Home Slider > Add New Slide" menu to add ones.', 'uxbarn'); ?>
	                                    </p>
                                    </div>
                                </div>
                                
                            <?php endif; wp_reset_postdata(); ?>
                            
                        </div>
                        <div id="slider-controller" class="content-width">
                            <a href="#" id="slider-prev"><i class="fa fa-angle-left"></i></a>
                            <a href="#" id="slider-next"><i class="fa fa-angle-right"></i></a>
                        </div>
                        <div id="header-image-shadow" class="content-width"></div>
                        
            	</div>
                <!-- END: id="home-slider-container" -->
                
            <?php else : // else if $slider_type == 'layerslider' ?>
                
                <?php
                    
                    // Get the selected slider
                    
                    // NOTE: This "$layerslider_id" variable will store the LayerSlider shortcode instead of the ID since the theme v1.7.0
                    $layerslider_id = '';
					if ( function_exists( 'ot_get_option' ) ) {
                    	$layerslider_id = ot_get_option('uxbarn_to_setting_select_layerslider');
					}
					
                    $no_slider_class = '';
                    if($layerslider_id == '' || $layerslider_id == '-1') { // For never-saved or non-selected
                        $no_slider_class = ' class="no-slider" ';
                    }
                    
                    echo '<div id="uxb-layerslider-container" ' . $slider_header_footer_style . ' >';
                    echo '<div id="uxb-layerslider"' . $no_slider_class . '>';
                    
                    // If the user hasn't selected any active slider yet
                    if($layerslider_id == '' || $layerslider_id == '-1') {
                        
                        echo '<div class="info box no-layerslider-box">' . __('You have not yet specified which LayerSlider to be used here. Please go to: "Theme Options > Home Slider > LayerSlider for Homepage".', 'uxbarn') . '</div>';
                        
                    } else { // else if it's selected/specified, display on screen.
                        
                        // NOTE: This "$layerslider_id" variable will store the LayerSlider shortcode instead of the ID since the theme v1.7.0
                        // So if it is numeric, it means that it is the slider ID from older version of the theme.
                        if ( is_numeric( $layerslider_id ) ) {
	                        	
	                        echo do_shortcode( '[layerslider id="' . $layerslider_id . '"]' );
						
                        } else { // But if it is not numeric, it means that it should be the slider shortcode.
                        	
                        	$layerslider_shortcode = $layerslider_id;
                        	echo do_shortcode( $layerslider_shortcode );
							
                        }
                        
                    }
                    
                    echo '</div>'; // close id="uxb-layerslider"
                    echo '</div>'; // close id="uxb-layerslider-container"
                    
                ?>
                
            <?php endif; // END: if($slider_type == 'basic-slider') ?>
            
        <?php else : // For other pages, use header image ?>
            
            <?php
            
                $header_image_img = '';
                $no_header_image_class = ' no-header-image ';
                $custom_header_image_url = '';
                
                // Posts page and archive
                if((is_home() || is_archive()) && !is_tax()) {
                    
                    $post_id = get_option('page_for_posts');
                    $custom_header_image_url = uxbarn_get_array_value(get_post_meta($post_id, 'uxbarn_page_header_image_upload'), 0);
					
					if(is_category()) {
						// Get current category ID on archive page
                    	$cat_id = get_queried_object()->term_id;
						// If the "Categories Images" plugin is active
	                    if(function_exists('z_taxonomy_image_url')) {
	                        $cat_image = z_taxonomy_image_url($cat_id); // return "false" if not assigned
	                        if($cat_image) {
	                            $custom_header_image_url = $cat_image;
	                        }
	                    }
					}
                    
                } else if(is_single()) {  // Any single page
                    
                    $header_image_upload_id = '';
                    
                    if(is_singular('post')) { // Blog single
                        
                        $header_image_upload_id = 'uxbarn_post_header_image_upload';
                        
                    } else if(is_singular('team')) { // Team single
                        
                        $header_image_upload_id = 'uxbarn_team_header_image_upload';
                        
                    } else if(is_singular('portfolio')) { // Portfolio single
                        
                        $header_image_upload_id = 'uxbarn_portfolio_header_image_upload';
                        
                    }
                    
                    $custom_header_image_url = uxbarn_get_array_value(get_post_meta($post->ID, $header_image_upload_id), 0);
                    
                    // If it's blog single page and custom field is empty, use header of posts page instead
                    if(is_singular('post') && $custom_header_image_url == '') {
                        $post_id = get_option('page_for_posts');
                        $custom_header_image_url = uxbarn_get_array_value(get_post_meta($post_id, 'uxbarn_page_header_image_upload'), 0);
                    }
                    
                } else if(is_tax()) { // Taxonomy archive page
                    
                    // Get current term ID on archive page
                    $term_id = get_queried_object()->term_id;
                    
                    if(is_tax('portfolio-category')) {
                            
                        // If the "Categories Images" plugin is active
                        if(function_exists('z_taxonomy_image_url')) {
                            
                            $tax_image = z_taxonomy_image_url($term_id);
                            
                            if($tax_image) {
                                $custom_header_image_url = $tax_image;
                                //$attachment = uxbarn_get_attachment(uxbarn_get_attachment_id_from_src($tax_image));
                                //$header_image_img = '<img src="' . $tax_image . '" alt="' . $attachment['alt'] . '" class="stretch-image" />';
                            }
                        }
                    }
                    
                } else if(is_404()) {
                    
					$custom_header_image_url = '';
					if ( function_exists( 'ot_get_option' ) ) {
                    	$custom_header_image_url = ot_get_option('uxbarn_to_setting_upload_404_header_image');
					}
                    
                } else if(is_search()) {
                    
					$custom_header_image_url = '';
					if ( function_exists( 'ot_get_option' ) ) {
                    	$custom_header_image_url = ot_get_option('uxbarn_to_setting_upload_search_header_image');
					}
                    
                } else { // Normal page 
                
                    $custom_header_image_url = uxbarn_get_array_value(get_post_meta($post->ID, 'uxbarn_page_header_image_upload'), 0);
                    
                }

                $attachment = uxbarn_get_attachment(uxbarn_get_attachment_id_from_src($custom_header_image_url));
				
				$header_width = '2000';
				$header_height = '330';
				$final_image_url = $custom_header_image_url;
				
				// [0] = requested size, [1] = width, [2] = height
				$image_array = wp_get_attachment_image_src(uxbarn_get_attachment_id_from_src($custom_header_image_url), 'header-image');
				if($image_array) {
					$final_image_url = $image_array[0];
					$header_width = $image_array[1];
					$header_height = $image_array[2];
				}
                
                // Final result for header image tag. This condition is for every case except custom taxonomy
                if(trim($custom_header_image_url) != '') {
                    $header_image_img = '<img src="' . $final_image_url . '" alt="' . $attachment['alt'] . '" class="stretch-image" width="' . $header_width . '" height="' . $header_height . '" />';
                }
            
            ?>
            
            <?php if ($header_image_img != '') : $no_header_image_class = ''; ?>
                
                <!-- Header Image -->
                <div id="header-image-container"<?php echo $slider_header_footer_style; ?>>
                    <div id="header-image">
                        <?php echo $header_image_img; ?>
                    </div>
                </div>
                
            <?php else : ?>
                
                <div id="no-header-image-wrapper"></div>
                
            <?php endif; // END: if ($header_image_img != '') ?>
        
        <?php endif; // END: header image case ?>

        <div id="content-container" class="content-width <?php echo $no_header_image_class; ?>">
            
            <?php if(!is_front_page() && !uxbarn_is_frontpage_child()) : ?>
                
                <?php
                	
					$display_breadcrumb = true;
					if ( function_exists( 'ot_get_option' ) ) {
						
						$display_breadcrumb = ot_get_option('uxbarn_to_setting_display_breadcrumb');
						if ( $display_breadcrumb == '' || $display_breadcrumb == 'false' ) {
							$display_breadcrumb = false;
						} else {
							$display_breadcrumb = true;
						}
						
					}
				
				?>
                
                <?php if($display_breadcrumb) : ?>
                    
                    <!-- Breadcrumbs -->
                    <div class="row">
                        <div class="breadcrumbs-wrapper uxb-col large-12 columns for-nested">
                            <span class="text"><?php _e('You are here:', 'uxbarn'); ?></span>
                            <?php uxbarn_render_breadcrumbs(); ?>
                        </div>
                    </div>
                
                <?php endif; ?>
                
            <?php endif; ?>
            
            <!-- Page Intro -->
            <?php get_template_part('template-intro'); ?>
            
            <div id="inner-content-container">
