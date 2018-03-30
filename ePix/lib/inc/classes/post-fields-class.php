<?php
/**
 * The template for retrieving custom post data
 *
 * @package WordPress
 */
 

	global $NV_is_widget; // Check if placed within a widget
	
	$NV_previewimgurl	 = ( get_post_meta( $post->ID, '_cmb_previewimgurl', true ) !='' ) 	 ? get_post_meta( $post->ID, '_cmb_previewimgurl', true ) : '';
	$NV_movieurl 		 = ( get_post_meta( $post->ID, '_cmb_movieurl', true ) !='' ) 		 ? get_post_meta( $post->ID, '_cmb_movieurl', true ) : '';
	$NV_stagegallery   	 = ( get_post_meta( $post->ID, '_cmb_stagegallery', true ) !='' ) 	 ? get_post_meta( $post->ID, '_cmb_stagegallery', true ) : '';
	$NV_disablegallink 	 = ( get_post_meta( $post->ID, '_cmb_disablegallink', true ) !='' )  ? get_post_meta( $post->ID, '_cmb_disablegallink', true ) : '';
	$NV_disablereadmore  = ( get_post_meta( $post->ID, '_cmb_disablereadmore', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_disablereadmore', true ) : '';
	$NV_imgzoomcrop 	 = ( get_post_meta( $post->ID, '_cmb_imgzoomcrop', true ) !='' ) 	 ? get_post_meta( $post->ID, '_cmb_imgzoomcrop', true ) : '';
	$NV_displaytitle 	 = ( get_post_meta( $post->ID, '_cmb_displaytitle', true ) !='' ) 	 ? get_post_meta( $post->ID, '_cmb_displaytitle', true ) : '';
	$NV_postsubtitle 	 = ( get_post_meta( $post->ID, '_cmb_pagesubtitle', true ) !='' ) 	 ? get_post_meta( $post->ID, '_cmb_pagesubtitle', true ) : '';
	$NV_posttitle	 	 = ( get_post_meta( $post->ID, '_cmb_pagetitle', true ) !='' ) 		 ? get_post_meta( $post->ID, '_cmb_pagetitle', true ) : '';
	$NV_videotype 		 = ( get_post_meta( $post->ID, '_cmb_videotype', true ) !='' ) 		 ? get_post_meta( $post->ID, '_cmb_videotype', true ) : '';
	$ratio 				 = ( get_post_meta( $post->ID, '_cmb_videoratio', true ) !='' ) 	 ? get_post_meta( $post->ID, '_cmb_videoratio', true ) : '';
	$NV_videoautoplay	 = ( get_post_meta( $post->ID, '_cmb_videoautoplay', true ) !='' ) 	 ? get_post_meta( $post->ID, '_cmb_videoautoplay', true ) : '';
	$NV_galexturl		 = ( get_post_meta( $post->ID, '_cmb_galexturl', true ) !='' ) 		 ? get_post_meta( $post->ID, '_cmb_galexturl', true ) : '';
	$NV_displayblogimage = ( get_post_meta( $post->ID, '_cmb_postshowimage', true ) !='' ) 	 ? get_post_meta( $post->ID, '_cmb_postshowimage', true ) : '';
	$NV_authorname 		 = ( get_post_meta( $post->ID, '_cmb_authorname', true ) !='' ) 	 ? get_post_meta( $post->ID, '_cmb_authorname', true ) : '';
	$NV_postdate		 = ( get_post_meta( $post->ID, '_cmb_postdate', true ) !='' ) 		 ? get_post_meta( $post->ID, '_cmb_postdate', true ) : '';
	$NV_displaytitle	= ( get_post_meta( $post->ID, '_cmb_displaytitle', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_displaytitle', true ) : '';
	
	if( $NV_displaytitle == 'disable' ) : $NV_posttitle = 'BLANK'; endif;
	
	/* ------------------------------------
	:: Video Autoplay
	------------------------------------ */
	
	if(!empty($NV_videoautoplay)) :
		$NV_videoautoplay = '1';
	else :
		$NV_videoautoplay = '0';	
	endif;

	/* ------------------------------------
	:: Display Single / Archive Blog Image
	------------------------------------ */

	if( is_single() )
	{
		if( $NV_displayblogimage != 'archive' && $NV_displayblogimage != 'disable' && ( of_get_option('arhpostimage') == '' || of_get_option('arhpostimage') == 'single' || $NV_displayblogimage == 'single' ||  $NV_displayblogimage == 'singlearchive' ) )
		{
			$NV_displayblogimage = 'display';
		}
	}
	elseif( !is_single() )
	{
		if( $NV_displayblogimage != 'single' && $NV_displayblogimage != 'disable' && ( of_get_option('arhpostimage') == '' || of_get_option('arhpostimage') == 'archive' || $NV_displayblogimage == 'archive' ||  $NV_displayblogimage == 'singlearchive' ) )
		{
			$NV_displayblogimage = 'display';
		}
	}	

	/* ------------------------------------
	:: Display Author Bio
	------------------------------------ */

	if( empty($NV_authorname) && of_get_option('author_bio') == 'enable' )
	{
		$NV_authorname = 'enable';
	}
	elseif( of_get_option('author_bio') == 'posts' && is_single() && $NV_authorname != 'disable' ) 
	{
		$NV_authorname = 'posts';
	}
	elseif( $NV_authorname == 'yes' )
	{
		$NV_authorname = 'enable';	
	}
	else
	{
		$NV_authorname = 'disable';		
	}

	/* ------------------------------------
	:: Display Image
	------------------------------------ */

	// check what image to use, custom, featured, image within post. 
	if(empty($NV_previewimgurl))
	{ 
		$post_image_id = get_post_thumbnail_id(get_the_ID());
		
		if( !empty($post_image_id) )
		{
			$thumbnail = wp_get_attachment_image_src( $post_image_id, 'large', false);
			$NV_previewimgurl = $thumbnail[0];
		}
		else
		{
			$NV_previewimgurl = catch_image(); // Check for images within post 
		}
	}	
	
	
	/* ------------------------------------
	:: Display Postmeta Data
	------------------------------------ */


	global $NV_postlayout;

	$NV_postmetaalign = ( $NV_postlayout == 'grid' ? 'post_title' : of_get_option("postmetaalign") ); // Display Postmeta Data	
	
	$NV_arhpostpostmeta = of_get_option('arhpostpostmeta'); // get postmeta data configuration
	
	if( is_single() && ($NV_arhpostpostmeta == 'post_only' || $NV_arhpostpostmeta == '') )
	{ 			
		$NV_arhpostpostmeta = 'display';
	}
	elseif( !is_single() && ($NV_arhpostpostmeta == '' || $NV_arhpostpostmeta == 'archive_only'))
	{	
		$NV_arhpostpostmeta = 'display';
	}
	
	global $NV_gallery_postformat; // check is post type is displayed in gallery
	
	if( $NV_gallery_postformat == 'yes' ) $NV_arhpostpostmeta = 'hide';  // use page settings if a gallery
	 
	if( $NV_arhpostpostmeta == 'display' && ( $NV_postmetaalign == '' || $NV_postmetaalign == 'default' ) )
	{ 
		$columns = 'ten columns last clearfix';
		$offset_columns = 'offset-by-two';
	}
	else
	{ 
		$columns = 'twelve columns'; 
		$offset_columns = '';
	}