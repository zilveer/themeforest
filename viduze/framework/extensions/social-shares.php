<?php

	function include_social_shares(){
		global $cp_icon_type;
		
		$currentUrl = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		if( !empty($_SERVER['HTTPS']) ){
			$currentUrl = "https://" . $currentUrl;
		}else{
			$currentUrl = "http://" . $currentUrl;
		}
		
		echo '<div class="social-shares">';
		echo '<ul>';
		
		if( get_option(THEME_NAME_S.'_facebook_share') == 'enable'){
			?>
			<li>
				<a href="http://www.facebook.com/share.php?u=<?php echo $currentUrl;?>" target="_blank">
					<img class="no-preload" src="<?php echo CP_THEME_PATH_URL;?>/images/icon/social/facebook-share.png">
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_NAME_S.'_twitter_share') == 'enable'){		
			?>
			<li>
				<a href="http://twitter.com/home?status=<?php echo str_replace(' ', '%20', get_the_title());?>%20-%20<?php echo $currentUrl;?>" target="_blank">
					<img class="no-preload" src="<?php echo CP_THEME_PATH_URL;?>/images/icon/social/twitter-share.png">
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_NAME_S.'_google_share') == 'enable'){		
			?>
			<li>
				<a href="http://www.google.com/bookmarks/mark?op=edit&#038;bkmk=<?php echo $currentUrl;?>&#038;title=<?php the_title();?>" target="_blank">
					<img class="no-preload" src="<?php echo CP_THEME_PATH_URL;?>/images/icon/social/google-share.png">
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_NAME_S.'_stumble_upon_share') == 'enable'){		
			?>
			<li>
				<a href="http://www.stumbleupon.com/submit?url=<?php echo $currentUrl;?>&#038;title=<?php the_title();?>" target="_blank">
					<img class="no-preload" src="<?php echo CP_THEME_PATH_URL;?>/images/icon/social/stumble-upon-share.png">
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_NAME_S.'_my_space_share') == 'enable'){		
			?>
			<li>
				<a href="http://www.myspace.com/Modules/PostTo/Pages/?u=<?php echo $currentUrl;?>" target="_blank">
					<img class="no-preload" src="<?php echo CP_THEME_PATH_URL;?>/images/icon/social/my-space-share.png">
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_NAME_S.'_delicious_share') == 'enable'){		
			?>
			<li>
				<a href="http://delicious.com/post?url=<?php echo $currentUrl;?>&#038;title=<?php the_title();?>" target="_blank">
					<img class="no-preload" src="<?php echo CP_THEME_PATH_URL;?>/images/icon/social/delicious-share.png">
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_NAME_S.'_digg_share') == 'enable'){		
			?>
			<li>
				<a href="http://digg.com/submit?url=<?php echo $currentUrl;?>&#038;title=<?php the_title();?>" target="_blank">
					<img class="no-preload" src="<?php echo CP_THEME_PATH_URL;?>/images/icon/social/digg-share.png">
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_NAME_S.'_reddit_share') == 'enable'){		
			?>
			<li>
				<a href="http://reddit.com/submit?url=<?php echo $currentUrl;?>&#038;title=<?php the_title();?>" target="_blank">
					<img class="no-preload" src="<?php echo CP_THEME_PATH_URL;?>/images/icon/social/reddit-share.png">
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_NAME_S.'_linkedin_share') == 'enable'){		
			?>
			<li>
				<a href="http://www.linkedin.com/shareArticle?mini=true&#038;url=<?php echo $currentUrl;?>&#038;title=<?php echo str_replace(' ', '%20', get_the_title()); ?>" target="_blank">
					<img class="no-preload" src="<?php echo CP_THEME_PATH_URL;?>/images/icon/social/linkedin-share.png">
				</a>
			</li>
			<?php
		}
		
		if( get_option(THEME_NAME_S.'_google_plus_share') == 'enable'){		
			?>
			<li>		
				<a href="https://plus.google.com/share?url={<?php echo $currentUrl;?>}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
					<img class="no-preload" src="<?php echo CP_THEME_PATH_URL;?>/images/icon/social/google-plus-share.png" alt="google-share">
				</a>					
			</li>
			<?php
		}		
		
		echo '</ul>';
		echo '</div>';
	
	}
	
?>