<?php

/*
|--------------------------------------------------------------------------
| Gallery Post
|--------------------------------------------------------------------------
*/
if( !function_exists('the_post_format_gallery_content') ) {

    function the_post_format_gallery_content() {
        
		global $post;
				
        /* check if user wants to display the ut gallery */
        if( ot_get_option( 'blog_use_ut_gallery', 'on' ) == 'on' ) {

            echo ut_flex_slider( get_the_ID() );           
        
        } else {
            
            $content = get_the_content();
            $pattern = get_shortcode_regex();
            preg_match( "/$pattern/s", $content, $match );
                    
            $shortcode = ( isset( $match[0] ) && !empty( $match[0] ) ) ? $match[0] : '';
            echo do_shortcode( $shortcode );
        
        }
    
    }

}


if( !function_exists('ut_flex_slider') ) {

    function ut_flex_slider( $postID , $shortcode = false ) {
        
        $flex_slider = NULL;
                                                        
        /* get all necessary image ID's */
        $ut_gallery_images = ut_extract_gallery_images_ids();
        
        /* start output */
        if ( isset( $ut_gallery_images ) && is_array( $ut_gallery_images )  ) : 
                
        $flex_slider = '
		
		<script type="text/javascript">
        /* <![CDATA[ */
        
		(function($){
			
			"use strict";
	
			$(window).load(function(){
				
				$("#gallery-slider-' . $postID . '").flexslider({
					
					controlNav: false,
                    animationLoop: true,
                   	slideshow: true,
					smoothHeight: true,
					start: function(){
						$("#gallery-slider-' . $postID . '").addClass("loaded");
					}
					
				});
				
			});
		
		})(jQuery);
        
        /* ]]> */
        </script>
		
		<div class="ut-gallery-wrap">
            <div class="ut-gallery-slider flexslider" id="gallery-slider-' . $postID .'">
                <ul class="slides">';
                    
                    	foreach ( $ut_gallery_images as $ID => $imagedata ) : 
                
                        	if( isset( $imagedata->guid ) && !empty($imagedata->guid) ) {
                                    
                            	$image = $imagedata->guid; // fallback to older wp versions
                            
                        	} else {
                            	
								if( $shortcode ) { 
                            		
									$image = wp_get_attachment_image_src($imagedata , 'medium');
									
								} else {
									
									$image = wp_get_attachment_image_src($imagedata , 'single-post-thumbnail');
									
								}
								
								$image = $image[0];
                            
                        	} 
						
							if( !empty($image[0]) ) : 
                            
								$flex_slider .= '<li>';
									
									if( $shortcode ) { 
									
										$thumbnail = $image;
										
									} else {
										
										$thumbnail = ut_resize( $image , '855' , '425', true , true, true );
										
									}
									
									$flex_slider .= '<img alt="' . get_the_title( $postID ) . '" src="' . $thumbnail .'" />';
								
								$flex_slider .= '</li>';
                            
                        	endif;
                                        
                    endforeach;
        
                $flex_slider .= '
				</ul>
            </div>
        </div>';
        
        endif;
		
		return $flex_slider;
		
    }
}

/*
|--------------------------------------------------------------------------
| Helper Function : Extract Attachment ID's from gallery shortcode
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'ut_extract_gallery_images_ids' ) ) {
    
    function ut_extract_gallery_images_ids() {
        
        global $post;
        
        $content = get_the_content();
        $pattern = get_shortcode_regex();
        
        preg_match( "/$pattern/s", $content, $match );
        
        if( isset( $match[2] ) && ( "gallery" == $match[2] ) ) {
            
            $atts = $match[3];
            $atts = shortcode_parse_atts( $match[3] );
            $ut_gallery_images = isset( $atts['ids'] ) ? explode( ',', $atts['ids'] ) : get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . $post->ID .'&order=ASC&orderby=menu_order ID' );
            
            return $ut_gallery_images;
            
        }         
    
    }

}



/*
|--------------------------------------------------------------------------
| Link Post
|--------------------------------------------------------------------------
*/
if( !function_exists('post_format_link_content') ) {

    function post_format_link_content() {
        
		echo get_post_format_link_content();
			        
    }

}

if( !function_exists('get_post_format_link_content') ) {

    function get_post_format_link_content() {
        
        /* needed variables */
        $urlfound = false;
        $url = '';
        $content = get_the_content();
        
        /* retrieve meta data */        
        $value  =   ut_return_meta('postformat');
        
        /* check if there is an url inside the meta */
        if( !empty($value['_format_link_url']) ) {
            
            $url = $value['_format_link_url'];
            
            /* set url found */
            $urlfound = true;
            
        }
        
        /* there is no url inside the meta , lets check the content*/
        if( !$urlfound ) {
            
            /* try to fetch a link */  
            $url = post_format_url_grabber($content);
        
        }
		
		return ( !empty($url) ) ? ut_add_http($url) : '#' ;
           
        
    }

}


/*
|--------------------------------------------------------------------------
| Video Post
|--------------------------------------------------------------------------
*/

if( !function_exists('post_format_video_content') ) {

    function post_format_video_content() {
    
        echo get_post_format_video_content();
        
    }

}

if( !function_exists('get_post_format_video_content') ) {

    function get_post_format_video_content( $args = array() ) {
        
        /* needed variables */
        $videofound = false;
        $embed = false; 
                
        /* retrieve meta data */    
        $value = ut_return_meta('postformat');
        
        /* check if there is a video shortcode inside the meta */
        if( !empty($value['_format_video_embed']) ) {
            
            $value = $value['_format_video_embed'];
            
            /* set video found */
            $videofound = true;
            
        }
                
        /* we have a meta value , lets check its syntax and return it */
        if( $videofound ) {
        
            if ( is_numeric( $value ) ) {
                
                $video = wp_get_attachment_url( $value );
                return do_shortcode( sprintf( '[video src="%s"]', $video ) );
                
            } elseif ( preg_match( '/' . get_shortcode_regex() . '/s', $value ) ) {
                
                return do_shortcode( $value );
                
            } elseif ( ! preg_match( '#<[^>]+>#', $value ) ) {
                            
                return do_shortcode("[video $value]");
                    
            } else {
                
                return $value;
                
            }
        }
    }
}



/*
|--------------------------------------------------------------------------
| Audio Post
|--------------------------------------------------------------------------
*/

if( !function_exists('post_format_audio_content') ) {

    function post_format_audio_content() {
    
        echo get_post_format_audio_content(); 
    
    }

}

if( !function_exists('get_post_format_audio_content') ) {

    function get_post_format_audio_content() {
        
        /* needed variables */
        $audiofound = false;
        $shortcode = false;
        
        /* retrieve meta data */
        $value = ut_return_meta('postformat');        
        
        /* check if there is an audio shortcode inside the meta */
        if( !empty($value['_format_audio_embed']) ) {
            
            $value = $value['_format_audio_embed'];
            
            /* set audio found */
            $audiofound = true;
            
        }
        
        /* there is no audio shortcode inside the meta, so lets check the regular content */
        if( !$audiofound ) {
            
            $content = get_the_content();
            $audio = preg_match_all( '#\[audio\s*.*?\]#s', $content, $matches );            
            
            /* check if we have found an audio shortcode */
            if( !empty($matches[0][0]) ) {
                
                $value = $matches[0][0];
                $shortcode = true;
                
            }
            
        }
		
        if ( is_numeric( $value ) ) {
            
            $audio = wp_get_attachment_url( $value );
            return do_shortcode( sprintf( '[audio src="%s"]', $audio ) );
            
        } elseif ( preg_match( '/' . get_shortcode_regex() . '/s', $value ) ) {
            
            return do_shortcode( $value );
            
        } elseif ( ! preg_match( '#<[^>]+>#', $value ) && !$shortcode ) {
                        
            return do_shortcode("[audio $value]");
                
        } else {
            
            return $value;
            
        }
    
    }

}


/*
|--------------------------------------------------------------------------
| helper function for image post
|--------------------------------------------------------------------------
*/
if( !function_exists('get_post_format_image_url') ) {

    function get_post_format_image_url() {
        
        /* needed variables */
        $imagefound =  false;
        $image      = '';
        
        /* retrieve meta data */
        $value      =  ut_return_meta('postformat');
        
        /* check if we have a image inside the default wordpress meta */
        if( !empty($value['_format_image']) ) {
            
           return $value['_format_image'];
            
        }
        
        /* there is no image inside the meta, so lets check the post has image childs */
        if( !$imagefound ) {
            
            /* get an array of images */
            $images = get_children( array( 'post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => -1 ) );
            
            /* run trough images and send back the first image we have found */
            foreach( $images as $image ) {
                
                /* we check if we are an image already aotherwise set it*/
                if( !$imagefound ) {
                    
                    return $image->guid;
                    
                }
                    
            }
            
        }

        /* there are still no images, so lets check for linked images inside the content */
        if( !$imagefound ) {
            
            $content = get_the_content();
            $image = post_format_url_grabber($content);
            
            if( !empty($image) ) {
				return $image;
			}
			
        }

        
    }

}



/*
|--------------------------------------------------------------------------
| helper function to extract image url
|--------------------------------------------------------------------------
*/

if(!function_exists('post_format_url_grabber')) {
 
    function post_format_url_grabber( $string ) {
    
        $imageurl = !empty( $string ) ? preg_match_all('@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)@', $string , $match) : '';
        return isset($match[0][0]) ? ut_add_http($match[0][0]) : '';
    
    }
    
}

if(!function_exists('ut_add_http')) {

	function ut_add_http($url) {
		
		if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
			$url = "http://" . $url;
		}
		return esc_url_raw($url);
	}
	
}

if(!function_exists('ut_remove_http')) {

	function ut_remove_http($url) {
		
		$url = preg_replace("~^(?:f|ht)tps?://~i" , '' , $url);
		return $url;
		
	}
	
}

/*
|--------------------------------------------------------------------------
| helper function : turn embed url into regular url for lightbox
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'ut_generate_lightbox_url' ) ) {
	
	function ut_generate_lightbox_url($url) {
		
		$spliturl = explode("/", $url);		
	
		if(substr_count($url,"youtube")) {
		
			$finalurl = 'http://www.youtube.com/watch?v='.$spliturl[4];
		
		} elseif(substr_count($url,"vimeo")) {
			
			$finalurl = 'http://vimeo.com/'.$spliturl[4];

		} else {

			$finalurl = 'unknown';
					
		}
				
		return $finalurl;
	}
	
}


/*
|--------------------------------------------------------------------------
| grab exif data from wp attachment
|--------------------------------------------------------------------------
*/

if ( !function_exists( 'ut_grab_exif_data' ) ) {
	
	function ut_grab_exif_data($post_ID ) {
		
		global $id, $post;
		
		if ( !isset($post_ID) || '' == $post_ID )
			return FALSE;
		
		$meta = wp_get_attachment_metadata($post_ID, FALSE);
		
		$exif = '';
		
		/* timestamp */
		if ( $meta['image_meta']['created_timestamp'] ) :
			
			$exif .= '<li class="exif-date">';
			$exif .= '<span>' . __( 'Photo Taken: ', 'unitedthemes' )  . '</span>';
			$exif .= date( "d-M-Y H:i:s", $meta['image_meta']['created_timestamp'] );
			$exif .= '</li>';
		
		endif;

		/* copyright */				
		if ( $meta['image_meta']['copyright'] ) :
			
			$exif .= '<li class="exif-copyright">';
			$exif .= '<span>' .__( 'Copyright: ', 'unitedthemes' ) . '</span>';
			$exif .= $meta['image_meta']['copyright'];
			$exif .= '</li>';
		
		endif;
		
		/* photographer */		
		if ( $meta['image_meta']['credit'] ) :
			
			$exif .= '<li class="exif-credit">';
			$exif .= '<span>' . __( 'Credit: ', 'unitedthemes' ) . '</span>';
			$exif .=  $meta['image_meta']['credit'] ;
			$exif .= '</li>';
		
		endif;
		
		/* Image Title */	
		if ( $meta['image_meta']['title'] ) :
			
			$exif .= '<li class="exif-title">';
			$exif .= '<span>' . __( 'Title: ', 'unitedthemes' ) . '</span>';
			$exif .= $meta['image_meta']['title'];
			$exif .= '</li>';
		
		endif;	
		
		/* Caption */	
		if ( $meta['image_meta']['caption'] ) :
			
			$exif .= '<li class="exif-caption">';
			$exif .= '<span>' . __( 'Caption: ', 'unitedthemes' ) . '</span>';
			$exif .= $meta['image_meta']['caption'];
			$exif .= '</li>';
		
		endif;	
			
		/* Camera */
		if ( $meta['image_meta']['camera'] ) :
			
			$exif .= '<li class="exif-camera">';
			$exif .= '<span>' . __( 'Camera: ', 'unitedthemes' ) . '</span>';
			$exif .= $meta['image_meta']['camera'];
			$exif .= '</li>';
		
		endif;
		
		/* Focal Length */
		if ( $meta['image_meta']['focal_length'] ) :
			
			$exif .= '<li class="exif-focal-length">';
			$exif .= '<span>' . __( 'Focal Length: ', 'unitedthemes' ) . '</span>';
			$exif .= $meta['image_meta']['focal_length'];
			$exif .= __( 'mm', 'unitedthemes' );
			$exif .= '</li>';
		
		endif;
		
		/* Aperture */
		if ( $meta['image_meta']['aperture'] ) :
			
			$exif .= '<li class="exif-aperture">';
			$exif .= '<span>' . __( 'Aperture: ', 'unitedthemes' ) . '</span>';
			$exif .= $meta['image_meta']['aperture'];
			$exif .= '</li>';
		
		endif;
		
		/* ISO */
		if ( $meta['image_meta']['iso'] ) :
			
			$exif .= '<li class="exif-iso">';
			$exif .= '<span>' . __( 'ISO: ', 'unitedthemes' ) . '</span>';
			$exif .= $meta['image_meta']['iso'];
			$exif .= '</li>';
		
		
		endif;
		
		/* Shutters Speed*/			
		if ( $meta['image_meta']['shutter_speed'] ) :
			
			$exif .= '<li class="exif-shutter-speed">';
			$exif .= '<span>' . __( 'Shutter Speed: ', 'unitedthemes' ) . '</span>';
			$exif .=  number_format($meta['image_meta']['shutter_speed'], 3);
			$exif .= __( 'seconds', 'unitedthemes' );
			$exif .= '</li>';
		
		
		endif;

		return $exif;
		
	}
}

if ( !function_exists( 'ut_simple_exif' ) ) {
	
	function ut_simple_exif($post_ID ) {
		
		echo get_ut_simple_exif($post_ID );
	
	}
	
}


if ( !function_exists( 'get_ut_simple_exif' ) ) {
	
	function get_ut_simple_exif($post_ID ) {
		
		return ut_grab_exif_data($post_ID );
	
	}
	
}

if ( !function_exists( 'ut_get_attachment_id_from_url' ) ) {

	function ut_get_attachment_id_from_url( $attachment_url = '' ) {
	 
		global $wpdb;
		$attachment_id = false;
	 
		// If there is no url, return.
		if ( '' == $attachment_url )
			return;
	 
		// Get the upload directory paths
		$upload_dir_paths = wp_upload_dir();
	 
		// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
		if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
	 
			// If this is the URL of an auto-generated thumbnail, get the URL of the original image
			$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
	 
			// Remove the upload path base directory from the attachment URL
			$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
	 
			// Finally, run a custom database query to get the attachment ID from the modified attachment URL
			$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
	 
		}
	 
		return $attachment_id;
	
	}

}