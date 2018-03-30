<?php
	
	function gdl_social_share_title(){
		$title = str_replace(' ', '%20', get_the_title());
		$title  = str_replace('{', '%7B', $title);
		$title = str_replace('}', '%7D', $title);
		return $title;
	}
	
	function include_social_shares(){
		global $gdl_icon_type;
		
		$currentUrl = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		if( !empty($_SERVER['HTTPS']) ){
			$currentUrl = "https://" . $currentUrl;
		}else{
			$currentUrl = "http://" . $currentUrl;
		}
		
		echo '<div class="social-shares">';
		echo '<ul>';
		
		if( get_option(THEME_SHORT_NAME.'_facebook_share') == 'enable'){
			?>
			<li>
				<a href="http://www.facebook.com/share.php?u=<?php echo $currentUrl;?>" target="_blank">
					<img class="no-preload" src="<?php echo GOODLAYERS_PATH;?>/images/icon/social-icon-m/facebook.png" width="32" height="32" />
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_SHORT_NAME.'_twitter_share') == 'enable'){		
			?>
			<li>
				<a href="http://twitter.com/share?url=<?php echo $currentUrl;?>" target="_blank">
					<img class="no-preload" src="<?php echo GOODLAYERS_PATH;?>/images/icon/social-icon-m/twitter.png" width="32" height="32" />
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_SHORT_NAME.'_stumble_upon_share') == 'enable'){		
			?>
			<li>
				<a href="http://www.stumbleupon.com/submit?url=<?php echo $currentUrl;?>&#038;title=<?php echo gdl_social_share_title();?>" target="_blank">
					<img class="no-preload" src="<?php echo GOODLAYERS_PATH;?>/images/icon/social-icon-m/stumble-upon.png" width="32" height="32" />
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_SHORT_NAME.'_my_space_share') == 'enable'){		
			?>
			<li>
				<a href="http://www.myspace.com/Modules/PostTo/Pages/?u=<?php echo $currentUrl;?>" target="_blank">
					<img class="no-preload" src="<?php echo GOODLAYERS_PATH;?>/images/icon/social-icon-m/my-space.png" width="32" height="32" />
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_SHORT_NAME.'_digg_share') == 'enable'){		
			?>
			<li>
				<a href="http://digg.com/submit?url=<?php echo $currentUrl;?>&#038;title=<?php echo gdl_social_share_title();?>" target="_blank">
					<img class="no-preload" src="<?php echo GOODLAYERS_PATH;?>/images/icon/social-icon-m/digg.png" width="32" height="32" />
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_SHORT_NAME.'_reddit_share') == 'enable'){		
			?>
			<li>
				<a href="http://reddit.com/submit?url=<?php echo $currentUrl;?>&#038;title=<?php echo gdl_social_share_title();?>" target="_blank">
					<img class="no-preload" src="<?php echo GOODLAYERS_PATH;?>/images/icon/social-icon-m/reddit.png" width="32" height="32" />
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_SHORT_NAME.'_linkedin_share') == 'enable'){		
			?>
			<li>
				<a href="http://www.linkedin.com/shareArticle?mini=true&#038;url=<?php echo $currentUrl;?>&#038;title=<?php echo gdl_social_share_title(); ?>" target="_blank">
					<img class="no-preload" src="<?php echo GOODLAYERS_PATH;?>/images/icon/social-icon-m/linkedin.png" width="32" height="32" />
				</a>
			</li>
			<?php
		}
		
		if( get_option(THEME_SHORT_NAME.'_google_plus_share') == 'enable'){		
			?>
			<li>		
				<a href="https://plus.google.com/share?url=<?php echo $currentUrl;?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
					<img class="no-preload" src="<?php echo GOODLAYERS_PATH;?>/images/icon/social-icon-m/google-plus.png" alt="google-share" width="32" height="32" />
				</a>					
			</li>
			<?php
		}
		if( get_option(THEME_SHORT_NAME.'_pinterest_share') == 'enable'){	
				$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'full' );
			?>
			<li>
				<a href="http://pinterest.com/pin/create/button/?url=<?php echo $currentUrl;?>&media=<?php echo $thumbnail[0]; ?>" class="pin-it-button" count-layout="horizontal" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
					<img class="no-preload" src="<?php echo GOODLAYERS_PATH;?>/images/icon/social-icon-m/pinterest.png" width="32" height="32" />
				</a>	
			</li>
			<?php
		}		
		
		echo '</ul>';
		echo '</div>';
	
	}
	
?>