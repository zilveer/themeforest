<?php

    /*
    *
    *	Page Heading
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	sf_page_heading()
    *
    */


    /* PAGE HEADING
    ================================================== */
    if ( ! function_exists( 'sf_page_heading' ) ) {
        function sf_page_heading() {

            global $wp_query, $post, $sf_options;
            
            $shop_page  = false;
            $page_title = $page_subtitle = $page_title_style = $page_title_overlay_effect = $fancy_title_image = $fancy_title_image_url = $article_heading_bg = $article_heading_text = $page_heading_el_class = $page_heading_wrap_el_class = $page_design_style = $extra_styles = $page_title_text_align = $woo_category_desc = "";

            $show_page_title    = apply_filters( 'sf_page_heading_ns_pagetitle', 1 );
            $remove_breadcrumbs = apply_filters( 'sf_page_heading_ns_removebreadcrumbs', 0 );
            $breadcrumb_in_heading = 0;
            if ( isset( $sf_options['breadcrumb_in_heading'] ) ) {
            	$breadcrumb_in_heading = $sf_options['breadcrumb_in_heading'];
            }
            $portfolio_page 			= $sf_options['portfolio_page'];
            $hero_heading_fixed_height = false;
            if ( isset( $sf_options['hero_heading_fixed_height'] ) ) {
            	$hero_heading_fixed_height = $sf_options['hero_heading_fixed_height'];	
            }
            $page_title_height  = 300;
            $heading_img_width = 0;
            $heading_img_height = 0;
            $page_title_style   = "standard";
			$page_title_text_align = "center";
            $next_icon = apply_filters( 'sf_next_icon', '<i class="ss-navigateright"></i>' );
            $prev_icon = apply_filters( 'sf_prev_icon', '<i class="ss-navigateleft"></i>' );
			$index_icon = apply_filters( 'sf_index_icon', '<i class="fa-th"></i>' );
			
			// Shop page check
            if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
                $shop_page = true;
            }

            // Defaults
            $default_show_page_heading = $sf_options['default_show_page_heading'];
            $pagination_style          = "standard";
            if ( isset( $sf_options['pagination_style'] ) ) {
                $pagination_style = $sf_options['pagination_style'];
            }
            if ( isset( $sf_options['default_page_title_style'] ) ) {
                $page_title_style = $sf_options['default_page_title_style'];
            }
            if ( isset( $sf_options['default_page_heading_style'] ) ) {
            	$page_title_style      = $sf_options['default_page_heading_style'];
            }
            if ( isset( $sf_options['default_page_heading_text_style'] ) ) {
            	$page_title_text_style = $sf_options['default_page_heading_text_style'];
            }
            if ( isset( $sf_options['default_page_heading_text_align'] ) ) {
            	$page_title_text_align = $sf_options['default_page_heading_text_align'];
            }

            // Post meta
            if ( $post && is_singular() ) {
                $show_page_title       = sf_get_post_meta( $post->ID, 'sf_page_title', true );
                $remove_breadcrumbs    = sf_get_post_meta( $post->ID, 'sf_no_breadcrumbs', true );
                $page_title_style      = sf_get_post_meta( $post->ID, 'sf_page_title_style', true );
                $page_title            = sf_get_post_meta( $post->ID, 'sf_page_title_one', true );
                $page_subtitle         = sf_get_post_meta( $post->ID, 'sf_page_subtitle', true );
                $fancy_title_image     = rwmb_meta( 'sf_page_title_image', 'type=image&size=full' );
                $page_title_text_style = sf_get_post_meta( $post->ID, 'sf_page_title_text_style', true );
                $page_title_overlay_effect = sf_get_post_meta( $post->ID, 'sf_page_title_overlay_effect', true );
                $page_title_text_align = sf_get_post_meta( $post->ID, 'sf_page_title_text_align', true );
                $page_title_height     = sf_get_post_meta( $post->ID, 'sf_page_title_height', true );
                $page_heading_bg       = sf_get_post_meta( $post->ID, 'sf_page_title_bg_color', true );
                $page_heading_text     = sf_get_post_meta( $post->ID, 'sf_page_title_text_color', true );

                if ( $page_heading_bg != "" ) {
                    $article_heading_bg = 'style="background-color:' . $page_heading_bg . ';border-color:' . $page_heading_bg . ';"';
                }
                if ( $page_heading_text != "" ) {
                    $article_heading_text = 'style="color:' . $page_heading_text . ';"';
                }
            }

            if ( is_singular( 'post' ) ) {
                $fw_media_display = sf_get_post_meta( $post->ID, 'sf_fw_media_display', true );
                $page_design_style 	  = sf_get_post_meta( $post->ID, 'sf_page_design_style', true );
                if ( $fw_media_display == "fw-media-title" ) {
                    return;
                }
            }

            // Portfolio category navigation
            $enable_category_navigation = $sf_options['enable_category_navigation'];

            // Woo setup
            if ( $shop_page ) {
                $show_page_title       = $sf_options['woo_show_page_heading'];
                $page_title_style      = $sf_options['woo_page_heading_style'];
                $fancy_title_image     = $sf_options['woo_page_heading_image'];
                $page_title_text_style = $sf_options['woo_page_heading_text_style'];
                if ( isset( $sf_options['woo_page_heading_text_align'] ) ) {
                	$page_title_text_align = $sf_options['woo_page_heading_text_align'];
                }
                $woo_slider	   = $sf_options['woo_shop_slider'];
                $woo_shop_slider_main_only = false;
                if ( isset($sf_options['woo_shop_slider_main_only']) ) {
                	$woo_shop_slider_main_only = $sf_options['woo_shop_slider_main_only'];
                }
                
                if ( $woo_shop_slider_main_only && is_shop() ) {
                	$show_page_title = false;
                }

                if ( isset( $fancy_title_image ) && isset( $fancy_title_image['url'] ) ) {
                    $fancy_title_image_url = $fancy_title_image['url'];
                }

                if ( is_product_category() ) {
                	$category = $wp_query->get_queried_object();
                	$hero_id = get_woocommerce_term_meta( $category->term_id, 'hero_id', true  );
                	if ( $hero_id != "" && $hero_id != 0 ) {
                		$fancy_title_image_url = wp_get_attachment_url($hero_id, 'full');
                		$fancy_title_image_meta = wp_get_attachment_metadata( $hero_id );
                		$heading_img_width = isset($fancy_title_image_meta['width']) ? $fancy_title_image_meta['width'] : 0;
                		$heading_img_height = isset($fancy_title_image_meta['height']) ? $fancy_title_image_meta['height'] : 0;
                	}
                	if ( $fancy_title_image_url != '' ) {
                		//$page_title_style = "fancy";
                	}
                	if ( sf_theme_supports( 'page-heading-woo-description' ) ) {
                		if ( $page_title_height == 300 ) {
                			$page_title_height = 400;
                		}
                		$woo_category_desc = sf_woo_get_product_category_description( $category, true );
                	}
                }
            }
            if ( function_exists( 'is_product' ) && is_product() && sf_theme_opts_name( 'sf_uplift_options' ) ) {
                $product_layout = sf_get_post_meta( $post->ID, 'sf_product_layout', true );
                if ( $product_layout == "fw-split" ) {
                    return;
                }
            }
            
            // Page Title Style Filter
            $page_title_style = apply_filters( 'sf_page_title_style', $page_title_style );

            // Page Title
            if ( $show_page_title == "" ) {
                $show_page_title = $default_show_page_heading;
            }
            if ( $page_title == "" ) {
                $page_title = get_the_title();
            }
            if ( $page_title_height == "" ) {
                $page_title_height = apply_filters( 'sf_shop_fancy_page_height', 300 );
            }

            // Fancy heading image
            if ( ( $page_title_style == "fancy" || $page_title_style == "fancy-tabbed" ) && $fancy_title_image_url == "" && $fancy_title_image ) {
                foreach ( $fancy_title_image as $detail_image ) {
                    if ( isset( $detail_image['url'] ) ) {
                        $fancy_title_image_url = $detail_image['url'];
                        $heading_img_width = isset($detail_image['width']) ? $detail_image['width'] : 0;
                        $heading_img_height = isset($detail_image['height']) ? $detail_image['height'] : 0;
                        break;
                    }
                }
                if ( ! $fancy_title_image ) {
                    $fancy_title_image     = get_post_thumbnail_id();
                    $fancy_title_image_url = wp_get_attachment_url( $fancy_title_image, 'full' );
                    $fancy_title_image_meta = wp_get_attachment_metadata( $fancy_title_image );
                    $heading_img_width = isset($fancy_title_image_meta['width']) ? $fancy_title_image_meta['width'] : 0;
                    $heading_img_height = isset($fancy_title_image_meta['height']) ? $fancy_title_image_meta['height'] : 0;
                }
            }

            // Page Title Hidden
            if ( ! $show_page_title ) {
                $page_heading_el_class = "page-heading-hidden";
                $page_heading_wrap_el_class = "page-heading-wrap-hidden";
            }

            // Breadcrumb in heading
            if ( $breadcrumb_in_heading ) {
            	$page_heading_el_class .= " page-heading-breadcrumbs";
            }

            if ( $page_title_style == "fancy-tabbed" ) {
            	$page_title_text_align = "left";
            }
            
            // Hero styles output
            $hero_styles = array();
            $hero_styles[] = "background-image: url(" . esc_url($fancy_title_image_url) . ");";
            
            // Fixed height, no animation
            if ( $hero_heading_fixed_height ) {
                $page_heading_el_class .= " fixed-height";
                $page_title_height = $page_title_height != "" ? $page_title_height : "400";
            	$hero_styles[] = 'height: '.$page_title_height.'px;';
            }

            // Return if product & inner heading
            if ( function_exists( 'is_product' ) && is_product() && sf_theme_supports( 'product-inner-heading' ) && ( $page_title_style == "standard" || $page_title_style == "" ) ) {
            	return;
            }

            // Dont' allow fancy-tabbed on product pages
            if ( function_exists( 'is_product' ) && is_product() && sf_theme_supports( 'product-inner-heading' ) && $page_title_style == "fancy-tabbed" ) {
            	$page_title_style = "fancy";
            }

            if ( $page_title_style == "fancy" && sf_theme_opts_name() == "sf_atelier_options" && !(function_exists( 'is_product' ) && is_product()) ) {
	            $extra_styles = 'height: ' . $page_title_height . 'px;';
            }
            
			// Default hero image
			if ( isset( $sf_options['default_page_heading_image'] ) ) {
				$fancy_title_image     = $sf_options['default_page_heading_image'];
			}           
            if ( $fancy_title_image_url == "" && isset( $fancy_title_image ) && isset( $fancy_title_image['url'] ) ) {
                $fancy_title_image_url = $fancy_title_image['url'];
            }

            if ( isset($sf_options['minimal_checkout']) ) {
				if ( function_exists('is_checkout') && is_checkout() ) {
					global $woocommerce;
		        	if ( $sf_options['minimal_checkout'] ) { ?>

		            	<div class="minimal-checkout-return container"><a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><?php _e("Return to cart", "swiftframework"); ?></a></div>

		        	<?php }
            	}
        	}

            if ( ! is_home() ) {
                ?>
                <?php if ( $page_title_style == "fancy" || $page_title_style == "fancy-tabbed" ) { ?>

                    <div class="fancy-heading-wrap <?php echo $page_heading_wrap_el_class; ?> <?php echo esc_attr($page_title_style); ?>-style">

                    <?php if ( $fancy_title_image_url != ""  ) {
						
						$bg_color_title = $bg_opacity_title = "";
						if ($post) {
                    	$bg_color_title = sf_get_post_meta( $post->ID, 'sf_bg_color_title', true );
        	            $bg_opacity_title = sf_get_post_meta( $post->ID, 'sf_bg_opacity_title', true );
        	            }
        	            
        	            if ( !$bg_color_title ) {
        	                $bg_color_title = "transparent";
        	                $bg_opacity_title = 0;
        	            }
        	            
        	            $bg_opacity_title = ($bg_opacity_title < 100 ? '0.' . $bg_opacity_title : '1.0');

                    ?>
                        <div class="page-heading fancy-heading clearfix <?php echo esc_attr($page_title_text_style); ?>-style fancy-image <?php echo esc_attr($page_heading_el_class); ?>" style="<?php echo implode('', $hero_styles); ?>" data-height="<?php echo esc_attr($page_title_height); ?>" data-img-width="<?php echo $heading_img_width; ?>" data-img-height="<?php echo $heading_img_height; ?>">
                        	<span class="media-overlay" style="background-color:<?php echo $bg_color_title; ?>;opacity:<?php echo $bg_opacity_title; ?>;"></span>

                    <?php } else { ?>
                        <div class="page-heading fancy-heading <?php echo esc_attr($page_heading_el_class); ?> clearfix" data-height="<?php echo esc_attr($page_title_height); ?>" <?php echo $article_heading_bg; ?>>
                    <?php } ?>

                    <?php if ( $page_title_style == "fancy" && $page_design_style == "hero-content-split" ) {
                    	sf_post_split_heading_buttons();
                    } ?>

                    <?php if ( $page_title_style == "fancy-tabbed" ) { ?>
                    <div class="tabbed-heading-wrap">
                    <?php } ?>

                    <div class="heading-text container" data-textalign="<?php echo esc_attr($page_title_text_align); ?>">
                        <?php if ( sf_woocommerce_activated() && is_woocommerce() ) { ?>

                            <?php if ( is_product() ) { ?>

                                <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php echo $page_title; ?></h1>

                            <?php } else { ?>

                                <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php woocommerce_page_title(); ?></h1>

                            <?php } ?>
						
						<?php } else if ( is_search() ) { ?>
						
                            <?php
                            $s         = get_search_query();
                            $allsearch = new WP_Query( "s=$s&showposts=-1" );
                            $key       = esc_html( $s, 1 );
                            $count     = $allsearch->post_count;
                            wp_reset_query(); ?>
                            <?php if ( $count == 1 ) : ?>
                                <?php printf( __( '<h1 class="entry-title" %1$s>%2$s result for <span>%3$s</span></h1>', 'swiftframework' ), $article_heading_text, $count, get_search_query() ); ?>
                            <?php else : ?>
                                <?php printf( __( '<h1 class="entry-title" %1$s>%2$s results for <span>%3$s</span></h1>', 'swiftframework' ), $article_heading_text, $count, get_search_query() ); ?>
                            <?php endif; ?>
                        
                        <?php } else if ( is_category() ) { ?>
                        
                            <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php single_cat_title(); ?></h1>
						
						<?php } else if ( is_tax() ) {	
							global $wp_query;
							$term = $wp_query->get_queried_object();
						?>
							<h1 class="entry-title" <?php echo $article_heading_text; ?>><?php echo $term->name; ?></h1>
							
                        <?php } else if ( is_archive() ) { ?>

                            <?php /* If this is a tag archive */
                            if ( is_tag() ) { ?>
                                <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php _e( "Posts tagged with", "swiftframework" ); ?>
                                    &#8216;<?php single_tag_title(); ?>&#8217;</h1>
                                <?php /* If this is a daily archive */
                            } elseif ( is_day() ) { ?>
                                <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php _e( "Archive for", "swiftframework" ); ?> <?php the_time( 'F jS, Y' ); ?></h1>
                                <?php /* If this is a monthly archive */
                            } elseif ( is_month() ) { ?>
                                <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php _e( "Archive for", "swiftframework" ); ?> <?php the_time( 'F, Y' ); ?></h1>
                                <?php /* If this is a yearly archive */
                            } elseif ( is_year() ) { ?>
                                <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php _e( "Archive for", "swiftframework" ); ?> <?php the_time( 'Y' ); ?></h1>
                                <?php /* If this is an author archive */
                            } elseif ( is_author() ) { ?>
                                <?php $author = get_userdata( get_query_var( 'author' ) ); ?>
                                <?php if ( class_exists( 'ATCF_Campaigns' ) ) { ?>
                                    <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php _e( "Projects by", "swiftframework" ); ?> <?php echo esc_attr($author->display_name); ?></h1>
                                <?php } else { ?>
                                    <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php _e( "Author archive for", "swiftframework" ); ?> <?php echo esc_attr($author->display_name); ?></h1>
                                <?php } ?>
                                <?php /* If this is a paged archive */
                            } elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) { ?>
                                <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php _e( "Blog Archives", "swiftframework" ); ?></h1>
                            <?php } else { ?>
                                <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php post_type_archive_title(); ?></h1>
                            <?php } ?>

                        <?php } else if ( is_404() ) { ?>

                            <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php _e( "404", "swiftframework" ); ?></h1>
						
						<?php } else if ( is_home() && get_option('page_for_posts') ) { ?>
						
						     <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php echo apply_filters('the_title',get_page( get_option('page_for_posts') )->post_title); ?></h1>
                        							     
                        <?php } else { ?>

                            <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php echo $page_title; ?></h1>

                        <?php } ?>

                        <?php if ( $page_subtitle ) { ?>
                            <h3 <?php echo $article_heading_text; ?>><?php echo $page_subtitle; ?></h3>
                        <?php } ?>
                        
                        <?php if ( $woo_category_desc != "" ) { ?>
                        	<div class="category-desc" <?php echo $article_heading_text; ?>><?php echo $woo_category_desc; ?></div>
                        <?php } ?>
               

						<?php if ( !$remove_breadcrumbs && $breadcrumb_in_heading ) {
							echo sf_breadcrumbs( true );
						} ?>

                        <?php if ( is_singular( 'portfolio' ) && ! ( sf_theme_opts_name() == "sf_joyn_options" && $pagination_style == "fs-arrow" ) ) { ?>
                            <div
                                class="prev-item" <?php echo $article_heading_text; ?>><?php next_post_link( '%link', $prev_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>
                            <div
                                class="next-item" <?php echo $article_heading_text; ?>><?php previous_post_link( '%link', $next_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>
                        <?php } ?>

                        <?php if ( is_singular( 'galleries' ) && ! ( sf_theme_opts_name() == "sf_joyn_options" && $pagination_style == "fs-arrow" ) ) { ?>
                            <div
                                class="prev-item" <?php echo $article_heading_text; ?>><?php next_post_link( '%link', $prev_icon, false, '', 'gallery-category' ); ?></div>
                            <div
                                class="next-item" <?php echo $article_heading_text; ?>><?php previous_post_link( '%link', $next_icon, false, '', 'gallery-category' ); ?></div>
                        <?php } ?>

                    </div>

                    <?php if ( $page_title_style == "fancy-tabbed" ) { ?>
                    </div>
                    <?php } ?>

					<?php if ($page_title_overlay_effect != "" && $page_title_overlay_effect != "none") { ?>

						<div class="sf-canvas-effect" data-type="<?php echo esc_attr($page_title_overlay_effect); ?>">
							<canvas id="page-heading-canvas" data-canvas_id="page-heading-canvas"></canvas>
						</div>

					<?php } ?>

                    </div>

                    </div>

                <?php } else { ?>

                    <?php if ( $show_page_title == 2 ) { ?>
                        <div class="page-heading ph-sort clearfix" <?php echo $article_heading_bg; ?>>
                    <?php } else { ?>
                        <div class="page-heading <?php echo esc_attr($page_heading_el_class); ?> clearfix" <?php echo $article_heading_bg; ?>>
                    <?php } ?>
                    <div class="container">
                    	
                    	<?php if ( is_singular( 'portfolio' ) && sf_theme_opts_name() == "sf_uplift_options" ) {
                    			$portfolio_page = __($sf_options['portfolio_page'], 'swiftframework');
                    			$index_icon = apply_filters( 'sf_index_icon', '<i class="sf-icon-portfolio"></i>' );
                    		?>                    			
                			<div class="post-nav">
                				<?php if ( isset($portfolio_page) ) { ?>
                				<div class="view-all"><a href="<?php echo get_permalink($portfolio_page); ?>"><?php echo $index_icon; ?></a></div>
                				<div class="divide"></div>
                				<?php } ?>
                				<div class="prev-item" <?php echo $article_heading_text; ?>><?php next_post_link( '%link', $prev_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>
                				<div class="next-item" <?php echo $article_heading_text; ?>><?php previous_post_link( '%link', $next_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>		
                			</div>
                    	<?php } ?>
                    	
                        <div class="heading-text">

                            <?php if ( sf_woocommerce_activated() && is_woocommerce() ) { ?>

                                <?php if ( is_product() ) { ?>

                                    <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php echo $page_title; ?></h1>

                                <?php } else { ?>

                                    <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php woocommerce_page_title(); ?></h1>

                                <?php } ?>

                            <?php } else if ( is_search() ) { ?>

                                <?php
                                $s         = get_search_query();
                                $allsearch = new WP_Query( "s=$s&showposts=-1" );
                                $key       = esc_html( $s, 1 );
                                $count     = $allsearch->post_count;
                                wp_reset_query(); ?>
                                <?php if ( $count == 1 ) : ?>
                                    <?php printf( __( '<h1>%1$s result for <span>%2$s</span></h1>', 'swiftframework' ), $count, get_search_query() ); ?>
                                <?php else : ?>
                                    <?php printf( __( '<h1>%1$s results for <span>%2$s</span></h1>', 'swiftframework' ), $count, get_search_query() ); ?>
                                <?php endif; ?>

                            <?php } else if ( is_category() ) { ?>

                                <h1 <?php echo $article_heading_text; ?>><?php single_cat_title(); ?></h1>
							
							<?php } else if ( is_tax() ) {	
								global $wp_query;
								$term = $wp_query->get_queried_object();
							?>
								<h1 <?php echo $article_heading_text; ?>><?php echo $term->name; ?></h1>
								
                            <?php } else if ( is_archive() ) { ?>

                                <?php /* If this is a tag archive */
                                if ( is_tag() ) { ?>
                                    <h1 <?php echo $article_heading_text; ?>><?php _e( "Posts tagged with", "swiftframework" ); ?>
                                        &#8216;<?php single_tag_title(); ?>&#8217;</h1>
                                    <?php /* If this is a daily archive */
                                } elseif ( is_day() ) { ?>
                                    <h1 <?php echo $article_heading_text; ?>><?php _e( "Archive for", "swiftframework" ); ?> <?php the_time( 'F jS, Y' ); ?></h1>
                                    <?php /* If this is a monthly archive */
                                } elseif ( is_month() ) { ?>
                                    <h1 <?php echo $article_heading_text; ?>><?php _e( "Archive for", "swiftframework" ); ?> <?php the_time( 'F, Y' ); ?></h1>
                                    <?php /* If this is a yearly archive */
                                } elseif ( is_year() ) { ?>
                                    <h1 <?php echo $article_heading_text; ?>><?php _e( "Archive for", "swiftframework" ); ?> <?php the_time( 'Y' ); ?></h1>
                                    <?php /* If this is an author archive */
                                } elseif ( is_author() ) { ?>
                                    <?php $author = get_userdata( get_query_var( 'author' ) ); ?>
                                    <?php if ( class_exists( 'ATCF_Campaigns' ) ) { ?>
                                        <h1 <?php echo $article_heading_text; ?>><?php _e( "Projects by", "swiftframework" ); ?> <?php echo esc_attr($author->display_name); ?></h1>
                                    <?php } else { ?>
                                        <h1 <?php echo $article_heading_text; ?>><?php _e( "Author archive for", "swiftframework" ); ?> <?php echo esc_attr($author->display_name); ?></h1>
                                    <?php } ?>
                                    <?php /* If this is a paged archive */
                                } elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) { ?>
                                    <h1 <?php echo $article_heading_text; ?>><?php _e( "Blog Archives", "swiftframework" ); ?></h1>
                                <?php } else { ?>
                                    <h1 <?php echo $article_heading_text; ?>><?php post_type_archive_title(); ?></h1>
                                <?php } ?>

                            <?php } else if ( is_404() ) { ?>

                                <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php _e( "404", "swiftframework" ); ?></h1>
							
							<?php } else if ( is_home() && get_option('page_for_posts') ) { ?>
							
							     <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php echo apply_filters('the_title',get_page( get_option('page_for_posts') )->post_title); ?></h1>
				
                            <?php } else { ?>

                                <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php echo $page_title; ?></h1>

                            <?php } ?>

                        </div>

                        <?php if ( is_singular( 'portfolio' ) && ! ( sf_theme_opts_name() == "sf_joyn_options" && $pagination_style == "fs-arrow" ) && sf_theme_opts_name() != "sf_uplift_options" ) { ?>
	                    	<div class="next-item" <?php echo $article_heading_text; ?>><?php previous_post_link( '%link', $next_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>
	                    	<?php if (sf_theme_opts_name() == "sf_atelier_options" && isset($portfolio_page) ) { ?>
	                    		<div class="view-all" <?php echo $article_heading_text; ?>><a href="<?php echo get_permalink($portfolio_page); ?>"><?php echo $index_icon; ?></a></div>
	                    	<?php } ?>
	                        <div class="prev-item" <?php echo $article_heading_text; ?>><?php next_post_link( '%link', $prev_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>
                        <?php } ?>

                        <?php if ( is_singular( 'galleries' ) && ! ( sf_theme_opts_name() == "sf_joyn_options" && $pagination_style == "fs-arrow" ) ) { ?>
                            <div class="next-item" <?php echo $article_heading_text; ?>><?php previous_post_link( '%link', $next_icon, false, '', 'gallery-category' ); ?></div>
                            <div class="prev-item" <?php echo $article_heading_text; ?>><?php next_post_link( '%link', $prev_icon, false, '', 'gallery-category' ); ?></div>
                        <?php } ?>

						<?php if ( !$remove_breadcrumbs && $breadcrumb_in_heading ) {
							echo sf_breadcrumbs( true );
						} ?>

                        <?php if ( $shop_page && sf_theme_supports( 'page-heading-woocommerce' ) ) {
                            woocommerce_catalog_ordering();
                            woocommerce_result_count();
                        } ?>

                    </div>
                </div>
                <?php
                }
            }
        }

        add_action( 'sf_main_container_start', 'sf_page_heading', 20 );
    }


    /* POST SPLIT CONTENT HEADING BUTTONS
    ================================================== */
    if ( ! function_exists( 'sf_post_split_heading_buttons' ) ) {
        function sf_post_split_heading_buttons() {
        	global $sf_options, $sf_sidebar_config;

        	$blog_page   = __( $sf_options['blog_page'], 'swiftframework' );

    	    $prev_post = get_next_post();
    	    $next_post = get_previous_post();
    	    $has_both  = false;

    	    if ( ! empty( $next_post ) && ! empty( $prev_post ) ) {
    	        $has_both = true;
    	    }
    	    ?>

    	    <?php if ( $blog_page != "" ) { ?>
    	    	<div class="blog-button">
	    	        <a class="sf-button medium white rounded bordered" href="<?php echo get_permalink( $blog_page ); ?>">
	    	        	<i class="fa-long-arrow-left"></i>
	    	        	<span class="text"><?php _e( "View all posts", "swiftframework" ); ?></span>
	    	        </a>
	    	    </div>
    	    <?php } ?>

    	    <?php if ( ! empty( $next_post ) || ! empty( $prev_post )) { ?>
    	    <?php if ($has_both) { ?>
    	    <div class="post-pagination prev-next">
    	    <?php } else { ?>
    	    <div class="post-pagination">
    	        <?php } ?>

	            <?php if ( ! empty( $next_post ) ) {
	                $author_id       = $next_post->post_author;
	                $author_name     = get_the_author_meta( 'display_name', $author_id );
	                $author_url      = get_author_posts_url( $author_id );
	                $post_date       = get_the_date();
	                $post_date_str   = get_the_date('Y-m-d');
	                $post_categories = get_the_category_list( ', ', '', $next_post->ID );
	                ?>
	                <a class="next-article" href="<?php echo get_permalink( $next_post->ID ); ?>">
	                    <h4><?php _e( "Older", 'swiftframework' ); ?></h4>
	                    <h3><?php echo esc_attr($next_post->post_title); ?></h3>
	                </a>
	            <?php } ?>

	            <?php if ( ! empty( $prev_post ) ) {
	                $author_id       = $prev_post->post_author;
	                $author_name     = get_the_author_meta( 'display_name', $author_id );
	                $author_url      = get_author_posts_url( $author_id );
	                $post_date       = get_the_date();
	                $post_date_str   = get_the_date('Y-m-d');
	                $post_categories = get_the_category_list( ', ', '', $prev_post->ID );
	                ?>
	                <a class="prev-article" href="<?php echo get_permalink( $prev_post->ID ); ?>">
	                    <h4><?php _e( "Newer", 'swiftframework' ); ?></h4>
	                    <h3><?php echo esc_attr($prev_post->post_title); ?></h3>
	                </a>
	            <?php } ?>

    	    </div>

      	<?php }
        }
    }
?>