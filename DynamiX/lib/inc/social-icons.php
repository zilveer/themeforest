<?php 

	wp_deregister_script('jquery-tooltips');	
	wp_register_script('jquery-tooltips',get_template_directory_uri().'/js/jquery.tooltips.js',false,array('jquery'));
	wp_enqueue_script('jquery-tooltips');

	$color = '';
		
	if( !empty( $NV_socialicons_color ) )
	{
		$color = $NV_socialicons_color;
	}	
	
	if( $NV_textresize == "yes" )
	{
		echo "\n" . '<div class="textresize '. $color .'">';
		echo "\n\t" . '<ul>';
		echo "\n\t\t" . '<li class="resize-sml decreaseFont"><i class="fa fa-font fa-lg"></i></li>';
		echo "\n\t\t" . '<li class="resize-lrg increaseFont"><i class="fa fa-font fa-lg"></i></li>';
	 	echo "\n\t" . '</ul>';
		echo "\n" . '</div><!-- /textresizer -->' . "\n";
	}
	
	if( $NV_socialicons == "yes" || $NV_socialicons == "global" && get_post_meta( $post->ID, '_cmb_socialicons', true ) != 'disable' )
	{
	
		if( $NV_disableheart == "yes" ) 
		{ ?>
			<div class="socialicons display <?php echo $color; ?>"><?php 
		} 
		else 
		{ ?>
			<div id="togglesocial" class="<?php echo $color; ?>">
				<ul>                     
					<li><div class="socialinithide"><a href="#" class="socialinit"><i class="fa fa-share-square-o fa-lg"></i></a></div></li>
					            
				</ul>
			</div><!-- /togglesocial -->                            
			<div class="socialicons <?php echo $color; ?>"  style="display:none;">
		<?php 
		}
		
		// get social media button links
		require NV_FILES .'/adm/inc/social-media-urls.php';
		
			$output = '';
			$output .= "\n\t". '<ul class="clearfix">';
		
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
				
				if( ${'NV_social'. $icon_id } != 'yes' )
				{

					$sociallink = ( isset( ${ $social_icon } ) ) ? getsociallink( ${ $social_icon } ) : '';
						
					$icon_name = '';
					$icon_name = strtolower( str_replace('.','',$value['name'] ) );
						
					if( $icon_name == 'vimeo' ) $icon_name = 'vimeo-square';
					if( $icon_name == 'email' ) $icon_name = 'envelope';
					if( $icon_name == 'google' ) $icon_name = 'google-plus';
			
	
		
					
					$output .= "\n\t\t". '<li class="social-'. strtolower( str_replace('.','',$value['name'] ) ) .'">';
					$output .= "\n\t\t\t". '<div class="tooltip-info top center" data-tooltip-position="top center">';
					$output .= "\n\t\t\t\t". '<a href="'. $sociallink .'" title="'. $value['name'] .'" target="_blank"><i class="social-icon fa-lg fa fa-'. $icon_name .'"></i></a>';
					$output .= "\n\t\t\t". '</div>';
					$output .= "\n\t\t\t". '<div class="tooltip dark">'. $value['name'] .'</div>';
					$output .= "\n\t\t". '</li>';
				}
			}
			
			$output .= "\n\t". '</ul>';
			
			echo $output; ?>
		
	
		</div><!-- /socialicons -->
	
	<?php 
	} ?>

	<div class="clear"></div>