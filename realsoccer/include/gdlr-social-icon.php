<?php
	/*	
	*	Goodlayers Framework File
	*	---------------------------------------------------------------------
	*	This file contains the function that helps you print the social section
	*	---------------------------------------------------------------------
	*/
	
	$gdlr_header_social_icon = array(
		'delicious'		=> __('Delicius','gdlr_translate'), 
		'deviantart'	=> __('Deviant Art','gdlr_translate'), 
		'digg'			=> __('Digg','gdlr_translate'),
		'email' 		=> __('Email','gdlr_translate'),				
		'facebook'		=> __('Facebook','gdlr_translate'), 
		'flickr'		=> __('Flickr','gdlr_translate'),
		'google-plus' 	=> __('Google Plus','gdlr_translate'),				
		'lastfm'       	=> __('Lastfm','gdlr_translate'),
		'linkedin' 		=> __('Linkedin','gdlr_translate'),
		'picasa' 		=> __('Picasa','gdlr_translate'),
		'pinterest' 	=> __('Pinterest','gdlr_translate'),
		'rss' 			=> __('Rss','gdlr_translate'),
		'skype'			=> __('Skype','gdlr_translate'),
		'stumble-upon' 	=> __('Stumble Upon','gdlr_translate'),
		'tumblr' 		=> __('Tumblr','gdlr_translate'),
		'twitter' 		=> __('Twitter','gdlr_translate'),
		'vimeo' 		=> __('Vimeo','gdlr_translate'),
		'youtube' 		=> __('Youtube','gdlr_translate'),
	);	
	
	add_filter('gdlr_admin_option', 'gdlr_register_header_social_option');
	if( !function_exists('gdlr_register_header_social_option') ){
		function gdlr_register_header_social_option( $array ){		
			if( empty($array['overall-elements']['options']) ) return $array;
			
			global $gdlr_header_social_icon;
			$header_social = array( 									
				'title' => __('Header Social', 'gdlr_translate'),
				'options' => array(
					'header-social-type' => array(
						'title' => __('Header Social Icon Type', 'gdlr_translate'),
						'type' => 'combobox',	
						'options' => array(
							'light' => __('Light', 'gdlr_translate'),
							'dark' => __('Dark', 'gdlr_translate')
						),
						'default' => 'dark'
					),
				)
			);
				
			foreach( $gdlr_header_social_icon as $social_slug => $social_name ){
				$header_social['options'][$social_slug . '-header-social'] = array(
					'title' => $social_name . ' ' . __('Header Social', 'gdlr_translate'),
					'type' => 'text',				
				);
				
				if( $social_slug = 'email' ){
					$header_social['options'][$social_slug . '-header-social']['description'] =
						'Adding \'mailto:someone@example.com\' will allows users to click the icon to send an e-mail.';
				}
			}
			
			$array['overall-elements']['options']['header-social'] = $header_social;
			return $array;
		}
	}
	
	
	if( !function_exists('gdlr_print_header_social') ){
		function gdlr_print_header_social(){
			global $gdlr_header_social_icon, $theme_option;
			$type = empty($theme_option['header-social-type'])? 'dark': $theme_option['header-social-type'];
			
			foreach( $gdlr_header_social_icon as $social_slug => $social_name ){
				if( !empty($theme_option[$social_slug . '-header-social']) ){
?>
<div class="social-icon">
<a href="<?php echo $theme_option[$social_slug . '-header-social']; ?>" target="_blank" >
<img width="32" height="32" src="<?php echo GDLR_PATH . '/images/' . $type . '/social-icon/' . $social_slug . '.png'; ?>" alt="<?php echo $social_name; ?>" />
</a>
</div>
<?php				
				}
			}
			gdlr_get_woocommerce_nav();
			echo '<div class="clear"></div>';
		}
	}	
	
	add_filter('gdlr_admin_option', 'gdlr_register_social_shares_option');
	if( !function_exists('gdlr_register_social_shares_option') ){
		function gdlr_register_social_shares_option( $array ){	
			if( empty($array['overall-elements']['options']) ) return $array;
			
			$gdlr_social_shares = array(
				'digg'			=> __('Digg','gdlr_translate'),			
				'facebook'		=> __('Facebook','gdlr_translate'), 
				'google-plus' 	=> __('Google Plus','gdlr_translate'),	
				'linkedin' 		=> __('Linkedin','gdlr_translate'),
				'my-space' 		=> __('My Space','gdlr_translate'),
				'pinterest' 	=> __('Pinterest','gdlr_translate'),
				'reddit' 		=> __('Reddit','gdlr_translate'),
				'stumble-upon' 	=> __('Stumble Upon','gdlr_translate'),
				'twitter' 		=> __('Twitter','gdlr_translate'),
			);	
			$header_social = array( 									
				'title' => __('Social Shares', 'gdlr_translate'),
				'options' => array(
					'enable-social-share'=> array(
						'title' => __('Enable Social Share' ,'gdlr_translate'),
						'type' => 'checkbox',
						'description' => 'Enable this option to show the social shares below each post'
					)
				)
			);
				
			foreach( $gdlr_social_shares as $social_slug => $social_name ){
				$header_social['options'][$social_slug . '-share'] = array(
					'title' => $social_name,
					'type' => 'checkbox'				
				);
			}
			
			$array['overall-elements']['options']['social-shares'] = $header_social;
			return $array;
		}
	}	
	
	if( !function_exists('gdlr_get_social_shares') ){
		function gdlr_get_social_shares(){	
			global $theme_option;

			$page_title = rawurlencode(get_the_title());
			$current_url = GDLR_HTTP . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

			if($theme_option['enable-social-share'] == 'enable'){ ?>
<div class="gdlr-social-share">
<span class="social-share-title"><?php echo __('Share Post:', 'gdlr_translate'); ?></span>
<?php if($theme_option['digg-share'] == 'enable'){ ?>
	<a href="http://digg.com/submit?url=<?php echo $current_url; ?>&#038;title=<?php echo $page_title; ?>" target="_blank">
		<img src="<?php echo GDLR_PATH; ?>/images/dark/social-icon/digg.png" alt="digg-share" width="32" height="32" />
	</a>
<?php } ?>

<?php if($theme_option['facebook-share'] == 'enable'){ ?>
	<a href="http://www.facebook.com/share.php?u=<?php echo $current_url; ?>" target="_blank">
		<img src="<?php echo GDLR_PATH; ?>/images/dark/social-icon/facebook.png" alt="facebook-share" width="32" height="32" />
	</a>
<?php } ?>

<?php if($theme_option['google-plus-share'] == 'enable'){ ?>
	<a href="https://plus.google.com/share?url=<?php echo $current_url; ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=500');return false;">
		<img src="<?php echo GDLR_PATH; ?>/images/dark/social-icon/google-plus.png" alt="google-share" width="32" height="32" />
	</a>
<?php } ?>

<?php if($theme_option['linkedin-share'] == 'enable'){ ?>
	<a href="http://www.linkedin.com/shareArticle?mini=true&#038;url=<?php echo $current_url; ?>&#038;title=<?php echo $page_title; ?>" target="_blank">
		<img src="<?php echo GDLR_PATH; ?>/images/dark/social-icon/linkedin.png" alt="linked-share" width="32" height="32" />
	</a>
<?php } ?>

<?php if($theme_option['my-space-share'] == 'enable'){ ?>
	<a href="http://www.myspace.com/Modules/PostTo/Pages/?u=<?php echo $current_url; ?>" target="_blank">
		<img src="<?php echo GDLR_PATH; ?>/images/dark/social-icon/my-space.png" alt="my-space-share" width="32" height="32" />
	</a>
<?php } ?>

<?php 
	if($theme_option['pinterest-share'] == 'enable'){ 
		$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'large' ); 
?>
	<a href="http://pinterest.com/pin/create/button/?url=<?php echo $current_url; ?>&media=<?php echo $thumbnail[0]; ?>" class="pin-it-button" count-layout="horizontal" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
		<img src="<?php echo GDLR_PATH; ?>/images/dark/social-icon/pinterest.png" alt="pinterest-share" width="32" height="32" />
	</a>	
<?php } ?>

<?php if($theme_option['reddit-share'] == 'enable'){ ?>
	<a href="http://reddit.com/submit?url=<?php echo $current_url; ?>&#038;title=<?php echo $page_title; ?>" target="_blank">
		<img src="<?php echo GDLR_PATH; ?>/images/dark/social-icon/reddit.png" alt="reddit-share" width="32" height="32" />
	</a>
<?php } ?>

<?php if($theme_option['stumble-upon-share'] == 'enable'){ ?>
	<a href="http://www.stumbleupon.com/submit?url=<?php echo $current_url; ?>&#038;title=<?php echo $page_title; ?>" target="_blank">
		<img src="<?php echo GDLR_PATH; ?>/images/dark/social-icon/stumble-upon.png" alt="stumble-upon-share" width="32" height="32" />
	</a>
<?php } ?>

<?php if($theme_option['twitter-share'] == 'enable'){ ?>
	<a href="http://twitter.com/home?status=<?php echo str_replace('%26%23038%3B', '%26', $page_title) . ' - ' . $current_url; ?>" target="_blank">
		<img src="<?php echo GDLR_PATH; ?>/images/dark/social-icon/twitter.png" alt="twitter-share" width="32" height="32" />
	</a>
<?php } ?>
	
<div class="clear"></div>
</div>
			<?php }
		}
	}	
	
?>