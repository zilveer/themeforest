<?php 

	
	if( $NV_socialicons == "yes" || $NV_socialicons == "global" && get_post_meta( $post->ID, '_cmb_socialicons', true ) != 'disable' )
	{
		$social_init = $output = $display_type = '';

		if( $NV_disableheart == "yes" ) $social_init = 'no'; else $social_init = 'yes';
		
		if( $social_init == "yes" || $mobile_social == "mobile-social" )
		{
			echo "\n". '<li class="dock-tab '. $mobile_social .'"><a data-show-dock="social-wrap" class="dock-tab-trigger" href="#"><i class="fa fa-share-square-o fa-lg"></i></a>';
			echo "\n\t". '<ul class="dock-tab-wrapper social-wrap skinset-header nv-skin">';
		}
		
		// get social media button links
		require NV_FILES .'/adm/inc/social-media-urls.php';
		
		// Get Social Icons
		$get_social_icons = social_icon_data();
		
			
		foreach( $get_social_icons as $social_icon => $value )
		{
			$icon_id = str_replace( 'sociallink_','',$social_icon );
				
			// Check global Social Options
			if( of_get_option( 'display_socialicons' ) == "yes" && get_post_meta( $post->ID, '_cmb_socialicons', true ) != "yes" )
			{
				$global_socialicons = of_get_option('socialicons');
					
				if( $global_socialicons[ strtolower( str_replace('.','',$value['name'] ) ) ] == '0' )
				{
					${'NV_social'. $icon_id } = 'yes';	
				}
		
			}
			
			// Set display type
			if(  $mobile_social == 'mobile-social' ) 
			{
				$display_type = 'socicons_mobile';
			}
			else
			{
				$display_type = 'socicons';
			}
				
			if( ${'NV_social'. $icon_id } != 'yes' )
			{
				$sociallink = ( isset( ${ $social_icon } ) ) ? getsociallink( ${ $social_icon } ) : '';
					
				$icon_name = '';
				$icon_name = strtolower( str_replace('.','',$value['name'] ) );
					
				if( $icon_name == 'vimeo' ) $icon_name = 'vimeo-square';
				if( $icon_name == 'email' ) $icon_name = 'envelope';
				if( $icon_name == 'google' ) $icon_name = 'google-plus';
				
				$color = 'normal';
				
				if( of_get_option( 'socialicons_color' ) == 'color' )
				{
					$color = 'color';	
				}
					
				$output .= "\n\t\t". '<li class="dock-tab '. $display_type .' '. $color .' social-'. strtolower( str_replace('.','',$value['name'] ) ) .'">';
				$output .= "\n\t\t\t". '<a href="'. str_replace(' ', '%20', $sociallink) .'" title="'. $value['name'] .'" target="_blank"><i class="social-icon fa-lg fa fa-'. $icon_name .'"></i></a>';
				$output .= "\n\t\t". '</li>';
			}
		}		
			
		echo $output; 
		
		if( $social_init == "yes" || $mobile_social == "mobile-social" )
		{
			echo "\n\t". '</ul></li>';
		}
	}