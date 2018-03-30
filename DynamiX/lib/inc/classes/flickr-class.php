<?php

/* ------------------------------------

:: FLICKR SET DATA

------------------------------------ */

	$postcount = 0;

	$NV_slidearray = $NV_navimg = $slider_frame = '';
	
	if( empty( $NV_shortcode_id ) ) $NV_shortcode_id = ''; // if is shortcode assign ID.
	
	// Get Slider Frame Path
	$slider_frame = get_slider_frame( $NV_show_slider );

	/* ------------------------------------
	:: SET IMAGE SIZE
	------------------------------------ */

	if(	$NV_imgheight>='350') { 
		$img_size ="large";
	} elseif($NV_imgheight>='150') {
		$img_size ="medium";
	} else {
		$img_size ="small";
	}
	
	require_once(NV_FILES."/adm/inc/phpFlickr/phpFlickr.php");
	$f = new phpFlickr( '7caca0370ede756c26832c28b266ead5' ); // API
	//$f->enableCache("fs", "cache");  
	$user = of_get_option('flickr_userid');
	
	if( is_array( $NV_flickrset ) )
	{
		$NV_flickrset = implode( $NV_flickrset, ',' );
	}
	
	$photos = $f->photosets_getPhotos( $NV_flickrset );
		
	$post_count = count($photos); // count query
	
	/* ------------------------------------
	:: BLACK AND WHITE EFFECT	
	------------------------------------ */

	if( $NV_imageeffect == 'shadowblackwhite' || $NV_imageeffect == 'frameblackwhite' || $NV_imageeffect == 'blackwhite' )
	{
		$NV_blackwhite = 'blackwhite';
		
		if( $NV_imageeffect == 'shadowblackwhite' ) $NV_imageeffect = 'shadow';
		if( $NV_imageeffect == 'frameblackwhite' ) $NV_imageeffect = 'frame';
		if( $NV_imageeffect == 'blackwhite' ) $NV_imageeffect = 'none';

		// enqueue black and white script
		wp_deregister_script('jquery-blackandwhite');	
		wp_register_script('jquery-blackandwhite', get_template_directory_uri().'/js/jquery.blackandwhite.min.js',false,array('jquery'),true);
		wp_enqueue_script('jquery-blackandwhite');
	}
	else
	{
		$NV_blackwhite = '';
	}		

/* ------------------------------------

:: GRID ONLY

------------------------------------ */

	if($NV_show_slider=='gridgallery')
	{
		$output .= '<div class="nv-sortable row">';
	}

/* ------------------------------------

:: GRID ONLY *END*

------------------------------------ */	

    foreach ($photos['photoset']['photo'] as $photo): 
	
		$photodata = $f->photos_getInfo($photo['id']);
		
		if ( 'video' == $photodata['photo']['media'] ) {
			$sizes = $f->photos_getSizes($photo['id']);
			$NV_movieurl 		=	$sizes[6]["source"]; // Movie File URL
			$NV_videotype		=	'swf';
			$NV_previewimgurl	=	'';
		} else {
			$NV_previewimgurl	=	$f->buildPhotoURL($photo, $img_size); // Preview Image URL
		}
	
		$NV_posttitle		=	$photo['title'];
		$NV_description		=	$photo['description'];
		$NV_disablegallink	= 	'';
		$NV_galexturl		=	'http://www.flickr.com/photos/'.$user;
		$NV_disablereadmore	=	'yes';
		
		$slide_id='';
		$slide_id="slide-".$post->ID;
		
		if(empty($NV_customlayer)) $NV_customlayer='';		
		
		// Check is Timthumb is Enabled or Disabled
		if( of_get_option('timthumb_disable') !='disable' && empty( $NV_customlayer ) )
		{  
			require_once NV_FILES . '/adm/functions/BFI_Thumb.php';
			
			if( !empty( $NV_imgwidth ) )
			{
				$params['width'] = $NV_imgwidth;	
			}
	
			if( !empty( $NV_imgheight ) )
			{
				$params['height'] = $NV_imgheight;	
			}		
			
			if( $NV_imgzoomcrop == '0' )
			{
				$params['crop'] = true;	
			}

			if( empty( $NV_imgwidth ) )
			{
					if( $NV_show_slider == 'stageslider' || $NV_show_slider == 'gallery3d' || $NV_show_slider == 'nivo' )
					{
						if( get_option('themeva_theme') == 'ePix' || get_option('themeva_theme') == 'Copa' )
						{
							$params['width'] = 1050;
						}
						else
						{
							$params['width'] = 980;
						}
					}
					elseif( $NV_show_slider == 'islider' || $NV_show_slider == 'galleryaccordion' )
					{
						$params['width'] = 720;
					}
					else
					{
						$params['width'] = 300;
					}
			}			
			
			$NV_imagepath = bfi_thumb( dyn_getimagepath($NV_previewimgurl) , $params );
		}
		else 
		{
			$NV_imagepath = dyn_getimagepath($NV_previewimgurl);
		}
		
		$postcount++;
		$post_count++; // REQUIRED FOR GROUP SLIDER
	
/* ------------------------------------

:: 3D ONLY

------------------------------------ */

		if(empty($NV_3dsegments)) 		$NV_3dsegments='';
		if(empty($NV_3dtween))  		$NV_3dtween='';
		if(empty($NV_3dtweentime)) 	$NV_3dtweentime='';
		if(empty($NV_3dtweendelay)) 	$NV_3dtweendelay='';
		if(empty($NV_3dzdistance)) 	$NV_3dzdistance='';
		if(empty($NV_3dexpand))		$NV_3dexpand='';
		
		$NV_3dsegments_slide	= $NV_3dsegments;
		$NV_3dtween_slide		= $NV_3dtween;
		$NV_3dtweentime_slide	= $NV_3dtweentime;
		$NV_3dtweendelay_slide	= $NV_3dtweendelay;
		$NV_3dzdistance_slide	= $NV_3dzdistance;
		$NV_3dexpand_slide		= $NV_3dexpand;
		
		$NV_transitions = array($NV_transitions,'<Transition Pieces="'.$NV_3dsegments_slide.'" Time="'.$NV_3dtweentime_slide.'" Transition="'.$NV_3dtween_slide.'" Delay="'.$NV_3dtweendelay_slide.'"  DepthOffset="'.$NV_3dzdistance_slide.'" CubeDistance="'.$NV_3dexpand_slide.'"></Transition>');

/* ------------------------------------

:: 3D ONLY *END*

------------------------------------ */	
	
		/* ------------------------------------
		:: GET SLIDER FRAME
		------------------------------------ */			
			
		require $slider_frame;

		/* ------------------------------------
		:: / GET SLIDER FRAME
		------------------------------------ */	
			
		if($NV_slidetimeout) {
			$NV_slidearray = $NV_slidearray . $NV_slidetimeout .","; 
		} elseif($NV_stagetimeout) {
			$NV_slidearray = $NV_slidearray . $NV_stagetimeout .","; 
		} else {
			$NV_slidearray = $NV_slidearray . "10,";
		} 
					
		if($NV_show_slider=='islider') {
			if($NV_previewimgurl) { $NV_navimg.=$NV_previewimgurl.','; } elseif($image) { $NV_navimg.=$image.','; }
		}
	
	endforeach; 

	/* ------------------------------------
	
	:: GROUP SLIDER ONLY 
	
	------------------------------------ */
	
	if($NV_show_slider=='groupslider')
	{
		if($postcount!="0") 
		{ 
			$postcount="0"; // CHECK NEEDS END TAG
			$output .= '</div><!--  / row -->';
		} 
	}
	
	/* ------------------------------------
	
	:: GRID ONLY 
	
	------------------------------------ */
	
	if($NV_show_slider=='gridgallery')
	{
		$output .= '<div class="clear"></div>';
		$output .= '</div><!--  / row -->';
	}