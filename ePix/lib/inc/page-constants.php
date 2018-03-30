<?php 

/* ------------------------------------
:: CUSTOM PAGE DATA
------------------------------------*/

	global
	$post, 
	$NV_skinopt,
	$NV_layout,
	$NV_textresize,
	$NV_pagetitle,
	$NV_pagesubtitle,
	$NV_headerlayout,
	$NV_hidebreadcrumbs,
	$NV_contentborder,
	$NV_disablefooter,
	$NV_postdate,
	$NV_authorname,
	$NV_hidecontent,	
	$NV_sidebar_one_borders,
	$NV_sidebar_two_borders,
	$NV_sidebar_one_select,
	$NV_sidebar_two_select,
	$NV_infobar_classes,	
	$NV_infobar,	
	$NV_twitter,
	$NV_socialicons,
	$NV_socialicons_color,
	$NV_disableheart,
	$NV_socialdeli,
	$NV_socialdigg,
	$NV_socialreddit,
	$NV_sociallinkedin,
	$NV_socialstumble,
	$NV_socialyoutube,
	$NV_socialvimeo,
	$NV_socialpinterest,
	$NV_socialemail,	
	$NV_socialtwitter,
	$NV_socialgoogle,
	$NV_socialfb,
	$NV_socialrss,
	$NV_show_slider,
	$NV_datasource,
	$NV_attachedmedia,
	$NV_flickrset,
	$NV_gallerycat,
	$NV_gallerypostformat,
	$NV_productcat,
	$NV_producttag,
	$NV_mediacat,
	$NV_slidesetid,
	$NV_imgheight,
	$NV_imgwidth,
	$NV_galleryheight,
	$NV_gallerynumposts,
	$NV_gallerysortby,
	$NV_galleryexcerpt,
	$NV_galleryorderby,
	$NV_stagetimeout,
	$NV_stagetransition,
	$NV_stagetween,
	$NV_playnav,	
	$NV_gridcolumns,
	$NV_gridshowposts,
	$NV_gridfilter,
	$NV_groupsliderpos,
	$NV_groupgridcontent,
	$NV_accordiontitles,
	$NV_accordionautoplay,
	$NV_nivoeffect,
	$NV_imageeffect,
	$NV_lightbox,
	$NV_disablegallink,
	$NV_galexturl,
	$NV_skin,
	$NV_archivecat,
	$NV_filterformats,
	$NV_verticalslide,
	$NV_imgalign,
	$NV_slidercolumns,
	$NV_galleryclass,
	$NV_autohide_menu,
	$NV_wide_layout;
	
	$NV_layout 			= ( get_post_meta( $post->ID, '_cmb_layout', true ) !='' ) 			? get_post_meta( $post->ID, '_cmb_layout', true ) : of_get_option('pagelayout');
	
	if( get_option('themeva_theme') == 'ePix' )
	{
		$NV_wide_layout = ( get_post_meta( $post->ID, '_cmb_wide_layout', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_wide_layout', true ) : of_get_option('wide_layout');
	}
	else
	{
		$NV_wide_layout = '';
	}
	
	$NV_textresize 	= ( get_post_meta( $post->ID, '_cmb_textresize', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_textresize', true ) : '';
	$NV_pagetitle		= ( get_post_meta( $post->ID, '_cmb_pagetitle', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_pagetitle', true ) : '';
	$NV_pagesubtitle	= ( get_post_meta( $post->ID, '_cmb_pagesubtitle', true !='' ) )	? get_post_meta( $post->ID, '_cmb_pagesubtitle', true ) : '';
	$NV_postdate		= ( get_post_meta( $post->ID, '_cmb_postdate', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_postdate', true ) : '';
	$NV_authorname 	= ( get_post_meta( $post->ID, '_cmb_authorname', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_authorname', true ) : '';
	$NV_displaytitle	= ( get_post_meta( $post->ID, '_cmb_displaytitle', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_displaytitle', true ) : '';
	
	if( $NV_displaytitle == 'disable' ) : $NV_pagetitle = 'BLANK'; endif;
	
	if( $NV_authorname == 'yes' || of_get_option('author_bio') == 'enable' ) 
	{
		$NV_authorname = 'enable'; 
	}
	elseif( of_get_option('author_bio') == 'posts' && is_single() && $NV_authorname != 'disable' ) 
	{
		$NV_authorname = 'posts'; 
	}
	else
	{
		$NV_authorname = 'disable';	
	}	
	
	$NV_hidebreadcrumbs =   ( get_post_meta( $post->ID, '_cmb_hidebreadcrumbs', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_hidebreadcrumbs', true ) : '';
	$NV_contentborder = 	  ( get_post_meta( $post->ID, '_cmb_contentborder', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_contentborder', true ) : '';
	$NV_disableheader = 	  ( get_post_meta( $post->ID, '_cmb_disableheader', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_disableheader', true ) : '';
	$NV_hidecontent = 		  ( get_post_meta( $post->ID, '_cmb_hidecontent', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_hidecontent', true ) : '';
	$NV_disablefooter = 	  ( get_post_meta( $post->ID, '_cmb_disablefooter', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_disablefooter', true ) : '';
	$NV_sidebar_one_borders = ( get_post_meta( $post->ID, '_cmb_border_config_one', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_border_config_one', true ) : '';
	$NV_sidebar_two_borders = ( get_post_meta( $post->ID, '_cmb_border_config_two', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_border_config_two', true ) : '';
	$NV_sidebar_one_select =  ( get_post_meta( $post->ID, '_cmb_sidebar_one', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_sidebar_one', true ) : '';
	$NV_sidebar_two_select =  ( get_post_meta( $post->ID, '_cmb_sidebar_two', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_sidebar_two', true ) : '';
	$NV_infobar_classes = 	  ( get_post_meta( $post->ID, '_cmb_infobar_classes', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_infobar_classes', true ) : '';	
	$NV_infobar = 			  ( get_post_meta( $post->ID, '_cmb_infobartext', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_infobartext', true ) : '';
	$NV_socialicons = 		  ( get_post_meta( $post->ID, '_cmb_socialicons', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_socialicons', true ) : of_get_option('display_socialicons');
	$NV_socialicons_color =	  ( get_post_meta( $post->ID, '_cmb_socialicons_color', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_socialicons_color', true ) : of_get_option('socialicons_color');		
	$NV_disableheart = 		  ( get_post_meta( $post->ID, '_cmb_disableheart', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_disableheart', true ) : of_get_option('socialicons_share');	
	$NV_twitter = 			  ( get_post_meta( $post->ID, '_cmb_twitter', true ) !='' && 
								get_post_meta( $post->ID, '_cmb_twitter', true ) !='none' ) 		? get_post_meta( $post->ID, '_cmb_twitter', true ) : of_get_option('twitter_display');
	$NV_socialdeli = 		  ( get_post_meta( $post->ID, '_cmb_sociallink_deli', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_sociallink_deli', true ) : '';		
	$NV_socialdigg = 		  ( get_post_meta( $post->ID, '_cmb_sociallink_digg', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_sociallink_digg', true ) : '';
	$NV_socialtwitter = 	  ( get_post_meta( $post->ID, '_cmb_sociallink_twitter', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_sociallink_twitter', true ) : '';
	$NV_socialgoogle = 	  ( get_post_meta( $post->ID, '_cmb_sociallink_google', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_sociallink_google', true ) : '';
	$NV_socialfb = 		  ( get_post_meta( $post->ID, '_cmb_sociallink_fb', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_sociallink_fb', true ) : '';
	$NV_socialrss = 		  ( get_post_meta( $post->ID, '_cmb_sociallink_rss', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_sociallink_rss', true ) : '';	
	$NV_socialreddit = 	  ( get_post_meta( $post->ID, '_cmb_sociallink_reddit', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_sociallink_reddit', true ) : '';	
	$NV_sociallinkedin = 	  ( get_post_meta( $post->ID, '_cmb_sociallink_linkedin', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_sociallink_linkedin', true ) : '';
	$NV_socialstumble = 	  ( get_post_meta( $post->ID, '_cmb_sociallink_stumble', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_sociallink_stumble', true ) : '';
	$NV_socialyoutube = 	  ( get_post_meta( $post->ID, '_cmb_sociallink_youtube', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_sociallink_youtube', true ) : '';	
	$NV_socialvimeo = 		  ( get_post_meta( $post->ID, '_cmb_sociallink_vimeo', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_sociallink_vimeo', true ) : '';
	$NV_socialpinterest =	  ( get_post_meta( $post->ID, '_cmb_sociallink_pinterest', true ) !='') ? get_post_meta( $post->ID, '_cmb_sociallink_pinterest', true ) : '';
	$NV_socialemail = 		  ( get_post_meta( $post->ID, '_cmb_sociallink_email', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_sociallink_email', true ) : '';
	$NV_socialinstagram =	  ( get_post_meta( $post->ID, '_cmb_sociallink_instagram',true ) !='' ) ? get_post_meta( $post->ID, '_cmb_sociallink_instagram', true ) : '';
	$NV_socialsoundcloud =  ( get_post_meta( $post->ID, '_cmb_sociallink_soundcloud',true ) !='') ? get_post_meta( $post->ID, '_cmb_sociallink_soundcloud', true ) : '';
	$NV_socialflickr =		  ( get_post_meta( $post->ID, '_cmb_sociallink_flickr',true ) !='') 	? get_post_meta( $post->ID, '_cmb_sociallink_flickr', true ) : '';
	$NV_show_slider = 		  ( get_post_meta( $post->ID, '_cmb_gallery', true ) !='' ) 			? get_post_meta( $post->ID, '_cmb_gallery', true ) : '';
	$NV_datasource = 		  ( get_post_meta( $post->ID, '_cmb_datasource_selector', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_datasource_selector', true ) : '';
	$NV_attachedmedia = 	  ( get_post_meta( $post->ID, '_cmb_data-1', true ) !='' ) 				? get_post_meta( $post->ID, '_cmb_data-1', true ) : '';
	$NV_gallerycat = 		  ( get_post_meta( $post->ID, '_cmb_data-2', true ) !='' ) 			? get_post_meta( $post->ID, '_cmb_data-2', true ) : '';
	$NV_gallerypostformat = ( get_post_meta( $post->ID, '_cmb_data-2-formats', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_data-2-formats', true ) : '';
	$NV_flickrset = 		  ( get_post_meta( $post->ID, '_cmb_data-3', true ) !='' ) 				? get_post_meta( $post->ID, '_cmb_data-3', true ) : '';
	$NV_slidesetid = 		  ( get_post_meta( $post->ID, '_cmb_data-4', true ) !='' ) 			? get_post_meta( $post->ID, '_cmb_data-4', true ) : '';	
	$NV_productcat = 		  ( get_post_meta( $post->ID, '_cmb_data-5', true ) !='' ) 			? get_post_meta( $post->ID, '_cmb_data-5', true ) : '';
	$NV_producttag = 		  ( get_post_meta( $post->ID, '_cmb_data-5-tags', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_data-5-tags', true ) : '';
	$NV_mediacat = 		  ( get_post_meta( $post->ID, '_cmb_data-6', true ) !='' ) 			? get_post_meta( $post->ID, '_cmb_data-6', true ) : '';
	$NV_pagepost_id =	 	  ( get_post_meta( $post->ID, '_cmb_data-8', true ) !='' ) 				? get_post_meta( $post->ID, '_cmb_data-8', true ) : '';
	$NV_archivecat =		  ( get_post_meta( $post->ID, '_cmb_archivecat', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_archivecat', true ) : '';
	$NV_filterformats =	  ( get_post_meta( $post->ID, '_cmb_filter_formats', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_filter_formats', true ) : '';
	$NV_imgheight = 		  ( get_post_meta( $post->ID, '_cmb_imgheight', true ) !='' ) 			? get_post_meta( $post->ID, '_cmb_imgheight', true ) : '';
	$NV_imgwidth = 		  ( get_post_meta( $post->ID, '_cmb_imgwidth', true ) !='' ) 			? get_post_meta( $post->ID, '_cmb_imgwidth', true ) : '';
	$NV_galleryheight = 	  ( get_post_meta( $post->ID, '_cmb_galleryheight', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_galleryheight', true ) : '';
	$NV_gallerynumposts =   ( get_post_meta( $post->ID, '_cmb_gallerynumposts', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_gallerynumposts', true ) : '';
	$NV_galleryexcerpt = 	  ( get_post_meta( $post->ID, '_cmb_gallerynpostexcerpt', true ) !='' )	? get_post_meta( $post->ID, '_cmb_gallerynpostexcerpt', true ) : '55';
	$NV_gallerysortby = 	  ( get_post_meta( $post->ID, '_cmb_gallerysortby', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_gallerysortby', true ) : '';
	$NV_galleryorderby = 	  ( get_post_meta( $post->ID, '_cmb_galleryorderby', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_galleryorderby', true ) : '';
	$NV_stagetimeout = 	  ( get_post_meta( $post->ID, '_cmb_stagetimeout', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_stagetimeout', true ) : '';
	$NV_stagetransition =   ( get_post_meta( $post->ID, '_cmb_stagetransition', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_stagetransition', true ) : '';
	$NV_stagetween = 		  ( get_post_meta( $post->ID, '_cmb_stagetween', true ) !='' ) 			? get_post_meta( $post->ID, '_cmb_stagetween', true ) : '';
	$NV_stageplaypause = 	  ( get_post_meta( $post->ID, '_cmb_stageplaypause', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_stageplaypause', true ) : '';
	$NV_groupsliderpos = 	  ( get_post_meta( $post->ID, '_cmb_groupsliderpos', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_groupsliderpos', true ) : '';
	$NV_gridcolumns = 		  ( get_post_meta( $post->ID, '_cmb_gridcolumns', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_gridcolumns', true ) : '';
	$NV_gridshowposts = 	  ( get_post_meta( $post->ID, '_cmb_gridshowposts', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_gridshowposts', true ) : '';
	$NV_gridfilter = 		  ( get_post_meta( $post->ID, '_cmb_gridfilter', true ) !='' ) 			? get_post_meta( $post->ID, '_cmb_gridfilter', true ) : '';
	$NV_groupgridcontent =  ( get_post_meta( $post->ID, '_cmb_groupgridcontent', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_groupgridcontent', true ) : '';
	$NV_accordiontitles =   ( get_post_meta( $post->ID, '_cmb_accordiontitles', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_accordiontitles', true ) : '';
	$NV_accordionautoplay = ( get_post_meta( $post->ID, '_cmb_accordionautoplay', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_accordionautoplay', true ) : '';
	$NV_nivoeffect = 		  ( get_post_meta( $post->ID, '_cmb_nivoeffect', true ) !='' ) 			? get_post_meta( $post->ID, '_cmb_nivoeffect', true ) : '';
	$NV_imageeffect = 		  ( get_post_meta( $post->ID, '_cmb_imageeffect', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_imageeffect', true ) : '';
	$NV_lightbox = 		  ( get_post_meta( $post->ID, '_cmb_lightbox', true ) !='' ) 			? get_post_meta( $post->ID, '_cmb_lightbox', true ) : '';
	$NV_verticalslide = 	  ( get_post_meta( $post->ID, '_cmb_sliderlayout', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_sliderlayout', true ) : '';
	$NV_imgalign = 		  ( get_post_meta( $post->ID, '_cmb_sliderimagealign', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_sliderimagealign', true ) : '';
	$NV_slidercolumns = 	  ( get_post_meta( $post->ID, '_cmb_gridcolumns', true ) !='' ) 		? get_post_meta( $post->ID, '_cmb_gridcolumns', true ) : '';
	$NV_galleryclass = 	  ( get_post_meta( $post->ID, '_cmb_gallerycssclass', true ) !='' ) 	? get_post_meta( $post->ID, '_cmb_gallerycssclass', true ) : '';
	$NV_autohide_menu = 	  ( get_post_meta( $post->ID, '_cmb_autohide_menu', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_autohide_menu', true ) : '';
	$NV_zoomhover = 		  ( get_post_meta( $post->ID, '_cmb_zoomhover', true ) !='' ) 			? get_post_meta( $post->ID, '_cmb_zoomhover', true ) : '';


	// Get Skin ID's
	$theme_skin_ids = '';
	if( get_option( 'themeva_theme' ) == 'DynamiX' ) 
	{
		$theme_skin_ids = 'skins_dynamix_ids'; 
	}
	elseif( get_option( 'themeva_theme' ) == 'ePix' ) 
	{
		$theme_skin_ids = 'skins_epix_ids'; 
	}
	elseif( get_option( 'themeva_theme' ) == 'Copa' ) 
	{
		$theme_skin_ids = 'skins_copa_ids';
	}	
	else {
		$theme_skin_ids = 'skin_data_ids';
	}
	
	// Destroy default / preview Skin setting if doesn't match current theme skin id's
	if( get_option('default_skin' ) !='' ) if( strpos( get_option( $theme_skin_ids ), get_option('default_skin' ) ) === false ) update_option('default_skin', '');
	if( get_option('preview_skin' ) !='' ) if( strpos( get_option( $theme_skin_ids ), get_option('preview_skin' ) ) === false ) update_option('preview_skin', '');
	if( get_post_meta( $post->ID, '_cmb_customskin', true ) !='' ) if( strpos( get_option( $theme_skin_ids ), get_post_meta( $post->ID, '_cmb_customskin', true ) ) === false ) update_post_meta(  $post->ID, '_cmb_customskin', ''); 
	
	// Assign Skin
	if( get_post_meta( $post->ID, '_cmb_customskin', true ) !='' )
	{
		$NV_skin = get_post_meta( $post->ID, '_cmb_customskin', true );
		$_SESSION['NV_skin'] = $NV_skin;
	}
	elseif( get_option('default_skin') != '' )
	{
		$NV_skin = get_option('default_skin');
		$_SESSION['NV_skin'] = get_option('default_skin');	
	} 
	elseif( get_option('default_skin') == '' && get_option('preview_skin' ) != '' )
	{
		$NV_skin = get_option('preview_skin');
		$_SESSION['NV_skin'] = get_option('preview_skin');		
	} 	
	else
	{
		global $NV_defaultskin;
		$NV_skin = $NV_defaultskin;
		$_SESSION['NV_skin'] = $NV_defaultskin;	
	}
	
	// Menu alignment
	if( get_post_meta( $post->ID, '_cmb_menu_alignment', true ) !='' )
	{
		$NV_menu_alignment = get_post_meta( $post->ID, '_cmb_menu_alignment', true );
	} 
	else
	{
		if( of_get_option('menu_alignment') !='' ) $NV_menu_alignment = of_get_option('menu_alignment'); else $NV_menu_alignment='right';
	}
	
	// Branding alignment
	if( get_post_meta( $post->ID, '_cmb_branding_alignment', true ) !='' )
	{
		$NV_branding_alignment = get_post_meta( $post->ID, '_cmb_branding_alignment', true );
	} 
	else
	{
		if( of_get_option('branding_alignment') !='' ) $NV_branding_alignment = of_get_option('branding_alignment'); else $NV_branding_alignment='left';
	}	
	
	if( $NV_branding_alignment == $NV_menu_alignment )
	{ 
		$NV_menu_alignment = $NV_menu_alignment.' match'; 
		$NV_branding_alignment = $NV_branding_alignment.' match';
	}
	
	// Infobar
	if( empty($NV_infobar) )
	{
		$NV_infobar = of_get_option('header_infobar');
	}
		
	 /* ------------------------------------
	:: BUDDYPRESS SETTINGS
	------------------------------------*/
	
	if( class_exists( 'BP_Core_User' ) ) 
	{
		if( !bp_is_blog_page() )
		{
			$NV_layout = ( of_get_option('buddylayout') !='' ) ? of_get_option('buddylayout') : ( !empty( $NV_layout ) ? $NV_layout : 'layout_four' );
			
			if( empty($NV_menu_alignment) && of_get_option('menu_alignment') == '')
			{
				 $NV_menu_alignment = 'right';
			}
			elseif( of_get_option('menu_alignment') !='' )
			{ 
				$NV_menu_alignment = of_get_option('menu_alignment');
			}
			
			if( empty($NV_branding_alignment) && of_get_option('branding_alignment') == '' )
			{
				 $NV_branding_alignment = 'left'; 
			}
			elseif( of_get_option('branding_alignment') !='' )
			{
				$NV_branding_alignment = of_get_option('branding_alignment');
			}
			
			if( $NV_branding_alignment == $NV_menu_alignment )
			{ 
				$NV_menu_alignment = $NV_menu_alignment.' match'; 
				$NV_branding_alignment = $NV_branding_alignment.' match';
			}
			
			if( empty($NV_infobar) ) $NV_infobar = of_get_option('header_infobar');
		}
	}

	/* ------------------------------------
	:: SEARCH SETTINGS
	------------------------------------*/
	
	if( is_search() || is_404() || is_archive() )
	{
		$NV_show_slider = $show_slider = '';
		
		if( empty($NV_menu_alignment) && of_get_option('menu_alignment') == '' )
		{
			$NV_menu_alignment = 'right';
		}
		elseif( of_get_option('menu_alignment') !='' )
		{ 
			$NV_menu_alignment = of_get_option('menu_alignment');
		}
			
		if( empty($NV_branding_alignment) && of_get_option('branding_alignment') == '' )
		{
			$NV_branding_alignment = 'left'; 
		} 
		elseif( of_get_option('branding_alignment') !='' ) {
			$NV_branding_alignment = of_get_option('branding_alignment');
		}
			
		if( $NV_branding_alignment == $NV_menu_alignment )
		{ 
			$NV_menu_alignment = $NV_menu_alignment.' match'; 
			$NV_branding_alignment = $NV_branding_alignment.' match';
		}
			
		if( empty($NV_infobar) ) $NV_infobar = of_get_option('header_infobar');

		// Assign Skin
		if( get_option('default_skin') != '' )
		{
			$NV_skin = get_option('default_skin');
			$_SESSION['NV_skin'] = get_option('default_skin');	
		} 
		elseif( get_option('default_skin') == '' && get_option('preview_skin' ) != '' )
		{
			$NV_skin = get_option('preview_skin');
			$_SESSION['NV_skin'] = get_option('preview_skin');		
		} 	
		else
		{
			global $NV_defaultskin;
			$NV_skin = $NV_defaultskin;
			$_SESSION['NV_skin'] = $NV_defaultskin;	
		}
		
		if( of_get_option('pagelayout') == '' )
		{
			$NV_layout = 'layout_four';
		}
	}
	

	/* ------------------------------------
	:: SINGLE ARCHIVE WIDE SETTINGS
	------------------------------------*/
		
	if( is_single() || is_archive() )
	{
		if( get_option('themeva_theme') == 'ePix' )
		{
			$NV_wide_layout = ( of_get_option('wide_layout_blog') !='' ) ? of_get_option('wide_layout_blog') : $NV_wide_layout;
		}		
	}


	/* ------------------------------------
	:: WOOCOMMERCE SETTINGS
	------------------------------------*/

	if( class_exists( 'woocommerce' ) )
	{
		if( is_woocommerce() )
		{
			$NV_layout = of_get_option('woocomlayout');
			$NV_sidebar_one_select = of_get_option('woocomcolone');
			$NV_sidebar_two_select = of_get_option('woocomcoltwo');
			
			$NV_wide_layout = ( of_get_option('wide_layout_woocommerce') !='' ) ? of_get_option('wide_layout_woocommerce') : $NV_wide_layout;			
		}
	}	
	
	/* ------------------------------------
	:: BBPRESS SETTINGS
	------------------------------------*/

	if( class_exists( 'bbPress' ) ) {
	
		if ( is_bbpress() ) {
			
			if( of_get_option('buddylayout') != '' )
			{
				$NV_layout = of_get_option('buddylayout'); 
			}
			else
			{
				$NV_layout = 'layout_four'; 
			}
			$NV_sidebar_one_select = of_get_option('buddycolone');
			$NV_sidebar_two_select = of_get_option('buddycoltwo');
		}
		
	}

	/* ------------------------------------
	:: RESS
	------------------------------------*/		
	
	global $deviceType;

	if( !class_exists( 'Mobile_Detect' ) )
	{
		require_once NV_FILES . '/adm/functions/Mobile_Detect.php';
	}	
	
	$detect = new Mobile_Detect;
	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');