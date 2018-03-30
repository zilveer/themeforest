<?php
global $post, $page_builder_id;

$share_box_class= "mini-share-post";
if( is_singular() && empty( $page_builder_id )  ) $share_box_class = "share-post";

$post_link	= tie_get_option( 'share_shortlink' ) ? esc_url( wp_get_shortlink() ) : esc_url( get_permalink() );
$post_title = wp_strip_all_tags( get_the_title() );
$protocol	= is_ssl() ? 'https' : 'http';

?>
<div class="<?php echo $share_box_class ?>">
	<span class="share-text"><?php _eti( 'Share' );?></span>
	
	<?php if( tie_get_option( 'share_post_type' ) == 'flat' ) :
			$post_title = htmlspecialchars(urlencode(html_entity_decode( $post_title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	 ?>
	<ul class="flat-social">	
	<?php if( tie_get_option( 'share_facebook' ) ): ?>
		<li><a href="http://www.facebook.com/sharer.php?u=<?php echo $post_link; ?>" class="social-facebook" rel="external" target="_blank"><i class="fa fa-facebook"></i> <span><?php _eti( 'Facebook' );?></span></a></li>
	<?php endif; ?>	
	<?php if( tie_get_option( 'share_tweet' ) ): ?>
		<li><a href="https://twitter.com/intent/tweet?text=<?php echo $post_title; ?><?php if( tie_get_option( 'share_twitter_username' )) echo ' via %40'.tie_get_option( 'share_twitter_username' ); ?>&url=<?php echo $post_link; ?>" class="social-twitter" rel="external" target="_blank"><i class="fa fa-twitter"></i> <span><?php _eti( 'Twitter' );?></span></a></li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_google' ) ): ?>
		<li><a href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=<?php echo $post_link; ?>&amp;name=<?php echo $post_title; ?>" class="social-google-plus" rel="external" target="_blank"><i class="fa fa-google-plus"></i> <span><?php _eti( 'Google +' );?></span></a></li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_stumble' ) ): ?>
		<li><a href="http://www.stumbleupon.com/submit?url=<?php echo $post_link; ?>&title=<?php echo $post_title;?>" class="social-stumble" rel="external" target="_blank"><i class="fa fa-stumbleupon"></i> <span><?php _eti( 'Stumbleupon' );?></span></a></li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_linkdin' ) ): ?>
		<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_link; ?>&title=<?php echo $post_title; ?>" class="social-linkedin" rel="external" target="_blank"><i class="fa fa-linkedin"></i> <span><?php _eti( 'LinkedIn' );?></span></a></li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_pinterest' ) ): ?>
		<li><a href="http://pinterest.com/pin/create/button/?url=<?php echo $post_link; ?>&amp;description=<?php echo $post_title; ?>&amp;media=<?php echo tie_thumb_src( 'slider' ); ?>" class="social-pinterest" rel="external" target="_blank"><i class="fa fa-pinterest"></i> <span><?php _eti( 'Pinterest' );?></span></a></li>
	<?php endif; ?>
	</ul>
	<?php
	else: ?>
	<script>
	window.___gcfg = {lang: 'en-US'};
	(function(w, d, s) {
	  function go(){
		var js, fjs = d.getElementsByTagName(s)[0], load = function(url, id) {
		  if (d.getElementById(id)) {return;}
		  js = d.createElement(s); js.src = url; js.id = id;
		  fjs.parentNode.insertBefore(js, fjs);
		};
		load('//connect.facebook.net/en/all.js#xfbml=1', 	'fbjssdk' );
		load('https://apis.google.com/js/plusone.js', 		'gplus1js');
		load('//platform.twitter.com/widgets.js', 			'tweetjs' );
	  }
	  if (w.addEventListener) { w.addEventListener("load", go, false); }
	  else if (w.attachEvent) { w.attachEvent("onload",go); }
	}(window, document, 'script'));
	</script>
	<ul class="normal-social">	
	<?php if( tie_get_option( 'share_facebook' ) ): ?>
		<li>
			<div class="fb-like" data-href="<?php echo $post_link; ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
		</li>
	<?php endif; ?>	
	<?php if( tie_get_option( 'share_tweet' ) ): ?>
		<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $post_link; ?>" data-text="<?php echo $post_title; ?>" data-via="<?php echo tie_get_option( 'share_twitter_username' ) ?>" data-lang="en">tweet</a></li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_google' ) ): ?>
		<li style="width:80px;"><div class="g-plusone" data-size="medium" data-href="<?php echo $post_link; ?>"></div></li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_stumble' ) ): ?>
		<li><su:badge layout="2" location="<?php echo $post_link; ?>"></su:badge>
			<script type="text/javascript">
				(function() {
					var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
					li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
				})();
			</script>
		</li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_linkdin' ) ): ?>
		<li><script src="<?php echo $protocol ?>://platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="<?php echo $post_link; ?>" data-counter="right"></script></li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_pinterest' ) ): ?>
		<li style="width:80px;"><script type="text/javascript" src="<?php echo $protocol ?>://assets.pinterest.com/js/pinit.js"></script><a href="http://pinterest.com/pin/create/button/?url=<?php echo $post_link; ?>&amp;media=<?php echo tie_thumb_src( 'slider' ); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="<?php echo $protocol ?>://assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
	<?php endif; ?>
	</ul>
	<?php endif; ?>
	<div class="clear"></div>
</div> <!-- .share-post -->