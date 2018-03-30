<?php header("Content-type: text/xml; charset: UTF-8");
	require_once( '../../../../../wp-load.php' );

	if( isset($_SESSION['piecemaker_ID']) )
	{
		$page_id = $_SESSION['piecemaker_ID'];
	}
	elseif( isset($_GET['page_id']) )
	{
		$page_id = $_GET['page_id'];
	}

	$NV_show_slider   	= ( get_post_meta( $page_id, '_cmb_gallery', true ) !='' ) 				? get_post_meta( $page_id, '_cmb_gallery', true ) : '';
	$NV_datasource	   	= ( get_post_meta( $page_id, '_cmb_datasource_selector', true ) !='' )  ? get_post_meta( $page_id, '_cmb_datasource_selector', true ) : '';
	$NV_gallerynumposts = ( get_post_meta( $page_id, '_cmb_gallerynumposts', true ) !='' ) 		? get_post_meta( $page_id, '_cmb_gallerynumposts', true ) : '';
	$NV_galleryexcerpt 	= ( get_post_meta( $page_id, '_cmb_gallerynpostexcerpt', true ) !='' )	? get_post_meta( $page_id, '_cmb_gallerynpostexcerpt', true ) : '55';
	$NV_gallerysortby 	= ( get_post_meta( $page_id, '_cmb_gallerysortby', true ) !='' ) 		? get_post_meta( $page_id, '_cmb_gallerysortby', true ) : '';
	$NV_galleryorderby 	= ( get_post_meta( $page_id, '_cmb_galleryorderby', true ) !='' ) 		? get_post_meta( $page_id, '_cmb_galleryorderby', true ) : '';	
	
	$NV_attachedmedia = 	  ( get_post_meta( $page_id, '_cmb_data-1', true ) !='' ) 			? get_post_meta( $page_id, '_cmb_data-1', true ) : '';
	$NV_gallerycat = 		  ( get_post_meta( $page_id, '_cmb_data-2', false ) !='' ) 			? get_post_meta( $page_id, '_cmb_data-2', false ) : '';
	$NV_gallerypostformat =   ( get_post_meta( $page_id, '_cmb_data-2-formats', true ) !='' ) 	? get_post_meta( $page_id, '_cmb_data-2-formats', true ) : '';
	$NV_flickrset = 		  ( get_post_meta( $page_id, '_cmb_data-3', true ) !='' ) 			? get_post_meta( $page_id, '_cmb_data-3', true ) : '';
	$NV_slidesetid = 		  ( get_post_meta( $page_id, '_cmb_data-4', false ) !='' ) 			? get_post_meta( $page_id, '_cmb_data-4', false ) : '';	
	$NV_productcat = 		  ( get_post_meta( $page_id, '_cmb_data-5', false ) !='' ) 			? get_post_meta( $page_id, '_cmb_data-5', false ) : '';
	$NV_producttag = 		  ( get_post_meta( $page_id, '_cmb_data-5-tags', false ) !='' ) 	? get_post_meta( $page_id, '_cmb_data-5-tags', false ) : '';
	$NV_mediacat = 			  ( get_post_meta( $page_id, '_cmb_data-6', false ) !='' ) 			? get_post_meta( $page_id, '_cmb_data-6', false ) : '';	
	$NV_pagepost_id = 		  ( get_post_meta( $page_id, '_cmb_data-8', true ) !='' ) 			? get_post_meta( $page_id, '_cmb_data-8', true ) : '';	
	
	$NV_imgheight 	  	= ( get_post_meta( $page_id, '_cmb_imgheight', true ) !='' ) 			? get_post_meta( $page_id, '_cmb_imgheight', true ) : '350';
	$NV_imgwidth 	  	= ( get_post_meta( $page_id, '_cmb_imgwidth', true ) !='' ) 			? get_post_meta( $page_id, '_cmb_imgwidth', true ) : '980';
	$NV_imageeffect   	= ( get_post_meta( $page_id, '_cmb_imageeffect', true ) !='' ) 		 	? get_post_meta( $page_id, '_cmb_imageeffect', true ) : '';

	$NV_3dsegments    	= ( get_post_meta( $page_id, '_cmb_gallery3dsegments', true ) !='' )    ? get_post_meta( $page_id, '_cmb_gallery3dsegments', true ) : '15';
	$NV_3dtween	      	= ( get_post_meta( $page_id, '_cmb_gallery3dtween', true ) !='' ) 	 	? get_post_meta( $page_id, '_cmb_gallery3dtween', true )	: 'linear';
	$NV_3dtweentime   	= ( get_post_meta( $page_id, '_cmb_gallery3dtweentime', true ) !='' )  	? get_post_meta( $page_id, '_cmb_gallery3dtweentime', true )	: '1.2';
	$NV_3dtweendelay  	= ( get_post_meta( $page_id, '_cmb_gallery3dtweendelay', true ) !='' )  ? get_post_meta( $page_id, '_cmb_gallery3dtweendelay', true ) : '0.1';
	$NV_3dzdistance   	= ( get_post_meta( $page_id, '_cmb_gallery3dzdistance', true ) !='' )  	? get_post_meta( $page_id, '_cmb_gallery3dzdistance', true ) : '0';
	$NV_3dexpand      	= ( get_post_meta( $page_id, '_cmb_gallery3dexpand', true ) !='' ) 	 	? get_post_meta( $page_id, '_cmb_gallery3dexpand', true ) : '20';
	$NV_3dincolor     	= ( get_post_meta( $page_id, '_cmb_gallery3dincolor', true ) !='' ) 	? '0x'. get_post_meta( $page_id, '_cmb_gallery3dincolor', true ) : '0x111111';
	$NV_3dtxtbcolor   	= ( get_post_meta( $page_id, '_cmb_gallery3dtextcolor', true ) !='' )  	? '0x'. get_post_meta( $page_id, '_cmb_gallery3dtextcolor', true ) : '0x111111';
	$NV_3dtextdist    	= ( get_post_meta( $page_id, '_cmb_gallery3dtextdist', true ) !='' )   	? get_post_meta( $page_id, '_cmb_gallery3dtextdist', true ) : '25';
	$NV_3dtimeout     	= ( get_post_meta( $page_id, '_cmb_stagetimeout', true ) !='' )  		? get_post_meta( $page_id, '_cmb_stagetimeout', true ) : '10';
	$NV_gallery3dypos 	= ( get_post_meta( $page_id, '_cmb_gallery3dypos', true ) !='' )  	 	? get_post_meta( $page_id, '_cmb_gallery3dypos', true ) : '280';
	$NV_gallery3dxpos 	= ( get_post_meta( $page_id, '_cmb_gallery3dxpos', true ) !='' )  	 	? get_post_meta( $page_id, '_cmb_gallery3dxpos', true ) : '470';
	$NV_shadow 		  	= '100'; 


	if( !$NV_imgheight && !$NV_imgwidth )
	{
		$NV_image_size = "w=". $NV_imgwidth ."&amp;";
	} 
	elseif( $NV_imgwidth && !$NV_imgheight )
	{
		$NV_image_size = "w=". $NV_imgwidth ."&amp;";	
	}
	elseif( $NV_imgheight && !$NV_imgwidth )
	{
		$NV_image_size = "h=". $NV_imgheight ."&amp;";	
	}
	elseif( $NV_imgheight && $NV_imgwidth )
	{
		$NV_image_size = "w=". $NV_imgwidth ."&amp;h=". $NV_imgheight ."&amp;";	
	}


	echo '<?xml version="1.0" encoding="utf-8" ?>
	
	<Piecemaker>
		<Contents>';
	
	if($NV_imgheight) {
	$NV_galleryheight=$NV_imgheight; // No Reflection
	} else {
	$NV_galleryheight="350"; // Set default Gallery Height
	}
	
	
	if($NV_imageeffect=="reflection" || $NV_imageeffect=="shadowreflection") {	 
	
		$NV_galleryheight=$NV_galleryheight+"55"; 
	
	} else {
		$NV_galleryheight=$NV_galleryheight+"40"; 
	} 
	
	// Calculate height of Gallery based on Image Height 
	
	ob_start();
	
	/* ------------------------------------
	
	:: LOAD DATA SOURCE
	
	------------------------------------ */
	 
	// Check datasource, if no datasource check Post Categories / Slide Set selected (backwards compatibility) 
	if( empty( $NV_datasource ) ) 
	{ 
		if( empty( $NV_slidesetid ) )
		{
			$NV_datasource = 'data-2';
		}
		else
		{
			$NV_datasource = 'data-1';
		}
	}
				
	if( $NV_datasource == "data-1" ) 
	{
		include(NV_FILES .'/inc/classes/post-attachments-class.php');		
	}
	elseif( $NV_datasource == "data-2" ||  $NV_datasource == "data-5" || $NV_datasource == "data-6" || $NV_datasource == "data-8" ) 
	{
		include(NV_FILES .'/inc/classes/post-categories-class.php');		
	}
	elseif( $NV_datasource == "data-3" )
	{
		include(NV_FILES .'/inc/classes/flickr-class.php');			
	}
	elseif( $NV_datasource == "data-4" )
	{
		include(NV_FILES .'/inc/classes/slideset-class.php');		
	}
	
	/* ------------------------------------
	
	:: LOAD DATA SOURCE *END*
	
	------------------------------------ */
	
	$output_string="";
	$output_string=ob_get_contents();
	ob_end_clean();
	
	echo $output_string;
	$postcount = 0;
	
	
	echo '</Contents>
	
	<Settings ImageWidth="'.$NV_imgwidth.'" ImageHeight="'.$NV_imgheight.'" LoaderColor="0x333333" InnerSideColor="0x222222" SideShadowAlpha="0.8" DropShadowAlpha="0.7" DropShadowDistance="25" DropShadowScale="0.95" DropShadowBlurX="40" DropShadowBlurY="4" MenuDistanceX="20" MenuDistanceY="50" MenuColor1="0x222222" MenuColor2="0x333333" MenuColor3="0xFFFFFF" ControlSize="70" ControlDistance="20" ControlColor1="0x222222" ControlColor2="0xFFFFFF" ControlAlpha="0.8" ControlAlphaOver="0.95" ControlsX="'.$NV_gallery3dxpos.'" ControlsY="'.$NV_gallery3dypos.'&#xD;&#xA;" ControlsAlign="center" TooltipHeight="30" TooltipColor="0x222222" TooltipTextY="5" TooltipTextStyle="P-Italic" TooltipTextColor="0xFFFFFF" TooltipMarginLeft="5" TooltipMarginRight="7" TooltipTextSharpness="50" TooltipTextThickness="-100" InfoWidth="400" InfoBackground="'. $NV_3dtxtbcolor .'" InfoBackgroundAlpha="0.65" InfoMargin="15" InfoSharpness="0" InfoThickness="0" Autoplay="'.$NV_3dtimeout.'" FieldOfView="45"></Settings>
	  <Transitions>';
	if(is_array($NV_transitions)) {
	foreach($NV_transitions as $transition) { 
	echo $transition."\n";
	}
	} else {
	echo $NV_transitions;	
	}
	echo '</Transitions>
	</Piecemaker>';