<?php

    /*
    *
    *	Swift Page Builder - Galleries Function Class
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	sf_galleries()
    *	sf_gallery_filter()
    *	sf_gallery_thumbnail()
    *	sf_gallery_item_link()
    *
    */

    /* GALLERIES
    ================================================== */
    if ( ! function_exists( 'sf_galleries' ) ) {
        function sf_galleries( $display_type, $link_type, $fullwidth, $gutters, $columns, $show_title, $show_subtitle, $show_excerpt, $excerpt_length, $item_count, $category, $pagination, $sidebars, $hover_style ) {

            /* OUTPUT VARIABLE
            ================================================== */
            $gallery_items_output = "";
            $count                = 0;


            /* CATEGORY SLUG MODIFICATION
            ================================================== */
            if ( $category == "All" ) {
                $category = "all";
            }
            if ( $category == "all" ) {
                $category = '';
            }
            $category_slug = str_replace( '_', '-', $category );


            /* GALLERIES QUERY SETUP
            ================================================== */
            global $post, $wp_query;

            if ( get_query_var( 'paged' ) ) {
                $paged = get_query_var( 'paged' );
            } elseif ( get_query_var( 'page' ) ) {
                $paged = get_query_var( 'page' );
            } else {
                $paged = 1;
            }

            $galleries_args = array(
                'post_type'        => 'galleries',
                'post_status'      => 'publish',
                'paged'            => $paged,
                'gallery-category' => $category_slug,
                'posts_per_page'   => $item_count,
            );

            $galleries_items = new WP_Query( $galleries_args );


            /* LIST CLASS CONFIG
            ================================================== */
            $list_class = '';
            if ( $display_type == "masonry" || $display_type == "masonry-gallery" ) {
                $list_class .= 'masonry-items filterable-items col-' . $columns . ' row clearfix';
            } else if ( $display_type == "gallery" ) {
                $list_class .= 'gallery-galleries filterable-items col-' . $columns . ' row clearfix';
            } else {
                $list_class .= 'standard-galleries filterable-items col-' . $columns . ' row clearfix';
            }

            // Full width
            if ( $fullwidth == "yes" ) {
                $list_class .= ' galleries-full-width';
            }

            // Gutters
            if ( $gutters == "no" ) {
                $list_class .= ' no-gutters';
            } else {
                $list_class .= ' gutters';
            }

            // Thumb Type
            if ( $hover_style == "default" && function_exists( 'sf_get_thumb_type' ) ) {
                $list_class .= ' ' . sf_get_thumb_type();
            } else {
                $list_class .= ' thumbnail-' . $hover_style;
            }


            /* ITEMS OUTPUT
            ================================================== */
            global $sf_options;

            $gallery_items_output .= '<ul class="gallery-items ' . $list_class . '">' . "\n";

            while ( $galleries_items->have_posts() ) : $galleries_items->the_post();


                /* META VARIABLES
                ================================================== */
                $thumb_type     = sf_get_post_meta( $post->ID, 'sf_thumbnail_type', true );
                $item_title     = get_the_title();
                $item_subtitle  = sf_get_post_meta( $post->ID, 'sf_gallery_subtitle', true );
                $permalink      = get_permalink();
                $custom_excerpt = sf_get_post_meta( $post->ID, 'sf_custom_excerpt', true );
                $post_excerpt   = '';
                if ( $custom_excerpt != '' ) {
                    $post_excerpt = sf_custom_excerpt( $custom_excerpt, $excerpt_length );
                } else {
                    $post_excerpt = sf_excerpt( $excerpt_length );
                }

                $post_terms = get_the_terms( $post->ID, 'gallery-category' );
                $term_slug  = " ";

                if ( ! empty( $post_terms ) ) {
                    foreach ( $post_terms as $post_term ) {
                        $term_slug = $term_slug . $post_term->slug . ' ';
                    }
                }


                /* COLUMN VARIABLE CONFIG
                ================================================== */
                $item_class = "";

                if ( $columns == "1" ) {
                    $item_class = "col-sm-12 ";
                } else if ( $columns == "2" ) {
                    $item_class = "col-sm-6 ";
                } else if ( $columns == "3" ) {
                    $item_class = "col-sm-4 ";
                } else if ( $columns == "4" ) {
                    $item_class = "col-sm-3 ";
                } else if ( $columns == "5" ) {
                    $item_class = "col-sm-sf-5 ";
                }


                /* DISPLAY TYPE CONFIG
                ================================================== */
                if ( $display_type == "masonry" || $display_type == "masonry-gallery" ) {
                    $item_class .= "masonry-item masonry-gallery-item gallery-item";
                } else if ( $display_type == "gallery" ) {
                    $item_class .= "gallery-item ";
                } else {
                    $item_class .= "standard ";
                }


                /* LINK TYPE CONFIG
                ================================================== */
                $gallery_id = rand( 0, 10000 );
                $item_link = sf_gallery_item_link( $link_type, $gallery_id );


                /* ITEM OUTPUT
                ================================================== */
                $gallery_items_output .= '<li itemscope itemtype="http://schema.org/CreativeWork" data-id="id-' . $count . '" class="clearfix gallery-item ' . $item_class . ' ' . $term_slug . '">' . "\n";


                /* THUMBNAIL CONFIG
                ================================================== */
                if ( $thumb_type != "none" ) {
                    $gallery_items_output .= sf_gallery_thumbnail( $display_type, $link_type, $columns, $gutters, $count, $gallery_id );
                }

                if ( $display_type != "gallery" && $display_type != "masonry-gallery" ) {

                    $gallery_items_output .= '<div class="gallery-item-details">' . "\n";

                    if ( $show_title == "yes" ) {

                        $gallery_items_output .= '<div class="comments-likes">';
                        if ( function_exists( 'lip_love_it_link' ) ) {
                            $gallery_items_output .= lip_love_it_link( get_the_ID(), false );
                        }
                        $gallery_items_output .= '</div>';

                        $gallery_items_output .= '<h3 class="gallery-item-title" itemprop="name headline"><a href="' . get_permalink() . '">' . $item_title . '</a></h3>' . "\n";
                    }
                    if ( $show_subtitle == "yes" && $item_subtitle ) {
                        $gallery_items_output .= '<h5 class="gallery-subtitle" itemprop="name alternativeHeadline">' . $item_subtitle . '</h5>' . "\n";
                    }
                    if ( $show_excerpt == "yes" ) {
                        $gallery_items_output .= '<div class="gallery-item-excerpt" itemprop="description">' . $post_excerpt . '</div>' . "\n";
                    }

                    $gallery_items_output .= '</div>' . "\n";

                }

                if ( $item_link["script"] != "" ) {
                    $gallery_items_output .= $item_link["script"];
                }

                $gallery_items_output .= '</li>' . "\n";

                $count ++;

            endwhile;

            wp_reset_query();
            wp_reset_postdata();

            $gallery_items_output .= '</ul>' . "\n";


            /* PAGINATION OUTPUT
            ================================================== */
            if ( $pagination == "yes" ) {
                if ( $display_type == "masonry" || $display_type == "masonry-gallery" ) {
                    $gallery_items_output .= '<div class="pagination-wrap masonry-pagination">';
                } else {
                    $gallery_items_output .= '<div class="pagination-wrap">';
                }
                $gallery_items_output .= pagenavi( $galleries_items );
                $gallery_items_output .= '</div>';
            }


            /* FUNCTION OUTPUT
            ================================================== */

            return $gallery_items_output;
        }
    }


    /* GALLERY FILTER
    ================================================== */
    if ( ! function_exists( 'sf_gallery_filter' ) ) {
        function sf_gallery_filter( $style = "basic", $parent_category = "" ) {

            $filter_output = $tax_terms = "";

            if ( $parent_category == "" || $parent_category == "All" ) {
                $tax_terms = sf_get_category_list( 'gallery-category', 1, '', true );
            } else {
                $tax_terms = sf_get_category_list( 'gallery-category', 1, $parent_category, true );
            }

            $filter_output .= '<div class="filter-wrap clearfix">' . "\n";
            $filter_output .= '<ul class="post-filter-tabs filtering clearfix">' . "\n";
            $filter_output .= '<li class="all selected"><a data-filter="*" href="#"><span class="item-name">' . __( "Show all", "swiftframework" ) . '</span></a></li>' . "\n";
            foreach ( $tax_terms as $tax_term ) {
                $term = get_term_by( 'name', $tax_term, 'gallery-category' );
                if ( $term ) {
                    $filter_output .= '<li><a href="#" title="View all ' . $term->name . ' items" class="' . $term->slug . '" data-filter=".' . $term->slug . '"><span class="item-name">' . $term->name . '</span></a></li>' . "\n";
                } else {
                    $filter_output .= '<li><a href="#" title="View all ' . $tax_term . ' items" class="' . $tax_term . '" data-filter=".' . $tax_term . '"><span class="item-name">' . $tax_term . '</span></a></li>' . "\n";
                }
            }
            $filter_output .= '</ul></div>' . "\n";

            return $filter_output;
        }
    }

    /* GALLERY THUMBNAIL
    ================================================== */
    if ( ! function_exists( 'sf_gallery_thumbnail' ) ) {
        function sf_gallery_thumbnail( $display_type = "gallery", $link_type = "lightbox", $columns = "2", $gutters = "yes", $count = 0, $gallery_id = 0 ) {

            global $post, $sf_options;

            $gallery_thumb = $item_class = $link_config = '';
            $thumb_width   = 600;
            $thumb_height  = 450;
            $video_height  = 450;

            if ( $columns == "1" ) {
                $thumb_width  = 1200;
                $thumb_height = 900;
                $video_height = 900;
            } else if ( $columns == "2" ) {
                $thumb_width  = 800;
                $thumb_height = 600;
                $video_height = 600;
            } else if ( $columns == "3" ) {
                $thumb_width  = 600;
                $thumb_height = 450;
                $video_height = 450;
            }

            if ( $display_type == "masonry" || $display_type == "masonry-gallery" ) {
                $thumb_height = null;
            }

            $thumb_image   = get_post_thumbnail_id();
            $thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );

            $item_title    = get_the_title();
            $item_subtitle = sf_get_post_meta( $post->ID, 'sf_gallery_subtitle', true );
            $permalink     = get_permalink();
            $item_link	   = sf_gallery_item_link( $link_type, $gallery_id );

            if ( $display_type == "gallery" || $display_type == "masonry-gallery" ) {
                $gallery_thumb .= '<figure class="animated-overlay overlay-style">' . "\n";
            } else {
                $gallery_thumb .= '<figure class="animated-overlay overlay-alt">' . "\n";
            }

            $image = sf_aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false );

            if ( $image ) {

                $gallery_thumb .= '<a ' . $item_link['config'] . '></a>';

                $gallery_thumb .= '<img itemprop="image" src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $item_title . '" />' . "\n";

                $gallery_thumb .= '<div class="figcaption-wrap"></div>';

                if ( $item_subtitle != "" && ( $display_type == "gallery" || $display_type == "masonry-gallery" ) ) {
                    $gallery_thumb .= '<figcaption><div class="thumb-info">';
                } else if ( $display_type == "standard" || $display_type == "masonry" ) {
                    $gallery_thumb .= '<figcaption><div class="thumb-info thumb-info-alt">';
                } else {
                    $gallery_thumb .= '<figcaption><div class="thumb-info">';
                }
                if ( $display_type == "gallery" || $display_type == "masonry-gallery" ) {
                    $gallery_thumb .= '<h4 itemprop="name headline">' . $item_title . '</h4>';
                    if ( $item_subtitle != "" ) {
                        $gallery_thumb .= '<div class="name-divide"></div>';
                    }
                    $gallery_thumb .= '<h5 itemprop="name alternativeHeadline">' . $item_subtitle . '</h5>';
                } else {
                	if ( $item_link['svg_icon'] != "" ) {
                		$gallery_thumb .= $item_link['svg_icon'];
                	} else {
                    	$gallery_thumb .= '<i class="' . $item_link['icon'] . '"></i>';
                	}
                }
                $gallery_thumb .= '</div></figcaption>';
            }

            $gallery_thumb .= '</figure>' . "\n";

            return $gallery_thumb;
        }
    }


    /* GALLERY LINK CONFIG
    ================================================== */
    if ( ! function_exists( 'sf_gallery_item_link' ) ) {
        function sf_gallery_item_link( $link_type, $id = 0 ) {

            $link_config = $link_script = $item_icon = $item_svg_icon = "";

            global $post, $sf_options;
            $lightbox_nav     = $sf_options['lightbox_nav'];
            $lightbox_thumbs  = $sf_options['lightbox_thumbs'];
            $lightbox_skin    = $sf_options['lightbox_skin'];
            $lightbox_sharing = $sf_options['lightbox_sharing'];

            if ( $link_type == "page" ) {
                $link_config = 'href="' . get_permalink() . '" class="link-to-url"';
                $item_icon   = apply_filters( 'sf_gallery_page_icon', "ss-navigateright" );
                $item_svg_icon   = apply_filters( 'sf_gallery_page_svg_icon', "" );
            } else if ( $link_type == "lightbox" ) {
                $gallery_images = rwmb_meta( 'sf_gallery_images', 'type=image&size=gallery-image' );
                $link_config    = 'id="gallery-' . $id . '" href="#" class="gallery-lightbox"';
                $item_icon      = apply_filters( 'sf_gallery_lightbox_icon', "ss-view" );
                $item_svg_icon      = apply_filters( 'sf_gallery_lightbox_svg_icon', "" );
                $link_script .= "<script type='text/javascript'>jQuery(document).ready(function(){jQuery('#gallery-" . $id . "').click(function(){
				var lightboxSocial = {
						facebook: {
							source: 'https://www.facebook.com/sharer/sharer.php?u={URL}',
							text: 'Share on Facebook'
						},
						twitter: true,
						googleplus: true,
						pinterest: {
							source: 'https://pinterest.com/pin/create/bookmarklet/?url={URL}',
							text: 'Share on Pinterest'
						}
					};
					jQuery.iLightBox(
						[";
                foreach ( $gallery_images as $image ) {
                	$caption = str_replace('"', '', $image['caption']);
                    $link_script .= '{
								URL: "' . $image['full_url'] . '",
								type: "image",
								title: "' . $image['title'] . '",
								caption: "' . $caption . '"
					},';
                }
                $link_script .= "],
						{";
                if ( $lightbox_skin == "dark" ) {
                    $link_script .= "skin: 'metro-black',";
                } else {
                    $link_script .= "skin: 'metro-white',";
                }
                $link_script .= "controls: {";
                if ( $lightbox_nav == "arrows" ) {
                    $link_script .= "arrows: true,";
                }
                if ( ! $lightbox_thumbs ) {
                    $link_script .= "thumbnail: false";
                }
                $link_script .= "},";
                if ( $lightbox_sharing ) {
                    $link_script .= "social: {
					buttons: lightboxSocial
				},";
                }
                $link_script .= "path: 'horizontal',
							thumbnails: {
								maxWidth: 120,
								maxHeight: 120
							},
						}
					);
					return false;
				});
				});";
                $link_script .= "</script>";
            }

            $item_link = array(
                "icon"   => $item_icon,
                "svg_icon"   => $item_svg_icon,
                "config" => $link_config,
                "script" => $link_script
            );

            return $item_link;
        }
    }
?>