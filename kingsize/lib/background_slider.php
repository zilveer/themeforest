<?php
/**
 * @KingSize 2012
 * Full-width Background Image Form theme-background.php
 **/
?>
<?php
global $data,$cnt_slider;

if((is_single() || is_page()) && (get_post_meta( $wp_query->post->ID, 'kingsize_post_background', true )!='' || get_post_meta($wp_query->post->ID, 'kingsize_post_background_slider_id', true )) ) {	//post background

	//if(get_post_meta($wp_query->post->ID, 'kingsize_post_background_slider_id', true ) == '') 
	if(get_post_meta($wp_query->post->ID, 'kingsize_post_slider_video_background', true ) == '') //4/13/2013
	{
		echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/supersized.3.2.6.min.js"></script>';
		echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/supersized.css" type="text/css" media="screen" />';

		$theme_custom_bg = get_post_meta( $wp_query->post->ID, 'kingsize_post_background', true );

		if($theme_custom_bg == '')
			$theme_custom_bg = $data['wm_background_image'];

		echo '
		<script type="text/javascript">			
			jQuery(function($){				
				$.supersized({
					slides  :  	[ {image : "'.$theme_custom_bg.'"} ]
				});
		    });		    
		</script>';
	}else{
		include (get_template_directory() . '/lib/slider.php'); 
	}
}
elseif((is_single() || is_page()) && (get_post_meta( $wp_query->post->ID, 'kingsize_page_background', true )!='' || get_post_meta($wp_query->post->ID, 'kingsize_page_background_slider_id', true ))){	//page background

		if(get_post_meta($wp_query->post->ID, 'kingsize_page_slider_video_background', true ) == '') //4/13/2013
		{
			echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/supersized.3.2.6.min.js"></script>';
			echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/supersized.css" type="text/css" media="screen" />';

			$theme_custom_bg = get_post_meta( $wp_query->post->ID, 'kingsize_page_background', true );
			
			
			if($theme_custom_bg == '')
				$theme_custom_bg = $data['wm_background_image'];

			echo '
			<script type="text/javascript">			
				jQuery(function($){				
					$.supersized({
						slides  :  	[ {image : "'.$theme_custom_bg.'"} ]
					});
				});		    
			</script>';
		}
		else{
			include (get_template_directory() . '/lib/slider.php'); 
		}
}
elseif((is_single() || is_page()) && (get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_background', true )!='' ||  get_post_meta($wp_query->post->ID, 'kingsize_portfolio_background_slider_id', true )) ){	//portfolio background
	
	if(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_video_background', true ) == '') //4/13/2013
	{
		echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/supersized.3.2.6.min.js"></script>';
		echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/supersized.css" type="text/css" media="screen" />';

		$theme_custom_bg = get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_background', true );
		
		if($theme_custom_bg == '')
			$theme_custom_bg = $data['wm_background_image'];

		echo '
		<script type="text/javascript">			
			jQuery(function($){				
				$.supersized({
					slides  :  	[ {image : "'.$theme_custom_bg.'"} ]
				});
		    });		    
		</script>';
	}else{
		include (get_template_directory() . '/lib/slider.php'); 
	}
}
elseif(is_home()) { //If Home page then show the background/slider
	
	include (get_template_directory() . '/lib/slider.php'); 

}
else { //default
	
	echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/supersized.3.2.6.min.js"></script>';
	echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/supersized.css" type="text/css" media="screen" />';

	
	$theme_custom_bg = $data['wm_background_image'];
	echo '
		<script type="text/javascript">			
			jQuery(function($){				
				$.supersized({
					slides  :  	[ {image : "'.$theme_custom_bg.'"} ]
				});
		    });		    
		</script>';	
}
?>
