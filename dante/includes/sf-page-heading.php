<?php

    /*
    *
    *	Page Heading
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
    *
    *	sf_page_heading()
    *
    */


    /* PAGE HEADING
    ================================================== */
    if ( ! function_exists( 'sf_page_heading' ) ) {
        function sf_page_heading() {

            global $wp_query, $post;
            
            $shop_page  = false;
            $page_title_bg = "";
            
            $page_title = $page_subtitle = $page_title_style = $page_title_overlay_effect = $fancy_title_image_url = $article_heading_bg = $article_heading_text = $page_heading_el_class = $page_design_style = $extra_styles = $page_title_text_align = "";
						
            $show_page_title    = apply_filters( 'sf_page_heading_ns_pagetitle', 1 );
            $remove_breadcrumbs = apply_filters( 'sf_page_heading_ns_removebreadcrumbs', 0 );
            $page_title_height  = 300;
            $page_title_style   = "standard";

			// Shop page check
            if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
                $shop_page = true;
            }

            // Defaults
            $options = get_option('sf_dante_options');
            $default_page_heading_bg_alt = $options['default_page_heading_bg_alt'];
            $default_show_page_heading = $options['default_show_page_heading'];
		
			
			$show_page_title = $default_show_page_heading;
			
            // Post meta
            if ( $post && is_singular() ) {
                $show_page_title       = sf_get_post_meta( $post->ID, 'sf_page_title', true );
                $remove_breadcrumbs    = sf_get_post_meta( $post->ID, 'sf_no_breadcrumbs', true );
                $page_title            = sf_get_post_meta( $post->ID, 'sf_page_title_one', true );
                $page_subtitle         = sf_get_post_meta( $post->ID, 'sf_page_subtitle', true );
                $remove_breadcrumbs    = sf_get_post_meta($post->ID, 'sf_no_breadcrumbs', true);
                                               
                $page_title_style 	   = sf_get_post_meta($post->ID, 'sf_page_title_style', true);
                $page_title_bg 		   = sf_get_post_meta($post->ID, 'sf_page_title_bg', true);
                $fancy_title_image 	   = rwmb_meta('sf_page_title_image', 'type=image&size=full');
                $page_title_text_style = sf_get_post_meta($post->ID, 'sf_page_title_text_style', true);
                $fancy_title_image_url = "";
                
                foreach ($fancy_title_image as $detail_image) {
                	$fancy_title_image_url = $detail_image['url'];
                	break;
                }
            } else {
            	$page_title_bg = $default_page_heading_bg_alt;
            }
            
            // Woo setup
            if ( $shop_page ) {                
                $show_page_title = $options['woo_show_page_heading'];
                $page_title_style = $options['woo_page_heading_style'];
                $page_title_bg = $options['woo_page_heading_bg_alt'];
                $fancy_title_image = $options['woo_page_heading_image'];
                $page_title_text_style = $options['woo_page_heading_text_style'];
				
				$fancy_title_image_url = $fancy_title_image;
				
                if ( is_product_category() ) {
                	$category = $wp_query->get_queried_object();
                	$hero_id = get_woocommerce_term_meta( $category->term_id, 'hero_id', true  );
                	if ( $hero_id != "" && $hero_id != 0 ) {
                		$fancy_title_image_url = wp_get_attachment_url($hero_id, 'full');
                	}
                }
            }

            // Page Title
            if ( $page_title == "" ) {
                $page_title = get_the_title();
            }
            if ( $page_title_height == "" ) {
                $page_title_height = apply_filters( 'sf_shop_fancy_page_height', 300 );
            }

            // Page Title Hidden
            if ( ! $show_page_title ) {
                $page_heading_el_class = "page-heading-hidden";
            }
            
            ?>
            
            <?php if ($page_title_style == "fancy") { ?>
			<div class="page-heading fancy-heading col-sm-12 clearfix asset-bg <?php echo $page_title_bg; ?> <?php echo $page_title_text_style; ?>-style fancy-image <?php echo esc_attr($page_heading_el_class); ?>" style="background-image: url(<?php echo $fancy_title_image_url; ?>);">
			<?php } else { ?>
			<div class="page-heading <?php echo esc_attr($page_heading_el_class); ?> clearfix asset-bg <?php echo $page_title_bg; ?>">
			<?php } ?>
                <div class="container">
                    <div class="heading-text">

                        <?php if ( sf_woocommerce_activated() && is_woocommerce() ) { ?>

                            <?php if ( is_product() ) { ?>

                                <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php echo esc_attr($page_title); ?></h1>

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
                                <h1 <?php echo $article_heading_text; ?>><?php single_term_title(); ?></h1>
                            <?php } ?>

                        <?php } else if ( is_404() ) { ?>

                            <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php _e( "404", "swiftframework" ); ?></h1>
						
						<?php } else if ( is_home() && get_option('page_for_posts') ) { ?>

                            <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php echo apply_filters('the_title',get_page( get_option('page_for_posts') )->post_title); ?></h1>
						
                        <?php } else { ?>

                            <h1 class="entry-title" <?php echo $article_heading_text; ?>><?php echo $page_title; ?></h1>

                        <?php } ?>
                        
                        <?php if ( $page_title_style == "fancy" && $page_subtitle != "" ) { ?>
                        	<h3><?php echo $page_subtitle; ?></h3>
                        <?php } ?>

                    </div>

					<?php if ( !$remove_breadcrumbs && $page_title_style != "fancy" ) {
						echo sf_breadcrumbs( true );
					} ?>

                </div>
            </div>
        <?php
        }
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