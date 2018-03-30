<?php
function dt_get_soc_link_script( $type = 'twitter' ) {

	ob_start();
	?>
	
	<!-- twitter -->
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	
	<?php
	$twitter = ob_get_clean();
	
	ob_start();
	?>
	
	<!-- google plus -->
	<script type="text/javascript">
	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'https://apis.google.com/js/plusone.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
	
	<?php
	$google_plus = ob_get_clean();
	
	ob_start();
	?>
	
	<!-- faceboock SDK -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
	<?php
	$faceboock = ob_get_clean();
	
	if( isset($$type) )
		return $$type;
	return '';
}

function dt_get_like_button( $type = 'twitter', $post_id = null, $echo = true ) {
	global $post;
	if( !$post_id && $post )
		$post_id = $post->ID;
	
	$url_params = array(
		'twitter'		=> ' data-url="%s"',
		'faceboock'		=> ' data-href="%s"',	
		'google_plus'	=> ' data-href="%s"'
	);

	$buttons = array(
		'twitter'		=> '<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en"%s>Tweet</a>',
		'faceboock'		=> '<div class="fb-like" data-send="false" data-width="120" data-show-faces="false" data-layout="button_count"%s></div>',
		'google_plus'	=> '<div class="g-plusone" data-size="medium" data-annotation="inline" data-width="120"%s></div>'
	);

	$button = $url_param = $permalink = '';
	if( dt_get_theme_options($type.'_lb') && isset($buttons[$type]) ) {
		if( $permalink = get_permalink($post_id) )
			$url_param = sprintf($url_params[$type], $permalink);
		$button = sprintf($buttons[$type], $url_param);
		$button = dt_get_soc_link_script( $type ). $button;
	}

	if( $echo ) {
		echo $button;
		return false;
	}
	return $button;
}

function is_lb_enabled( $type = '' ) {
	$options = dt_get_theme_options();
	
	if( !$options  )
		return false;

	if( $type ) {
		if( isset($options[$type.'_lb']) && $options[$type.'_lb'] )
			return true;
		return false;
	}

	if( (isset($options['twitter_lb']) && $options['twitter_lb']) ||
		(isset($options['faceboock_lb']) && $options['faceboock_lb']) ||
		(isset($options['google_plus_lb']) && $options['google_plus_lb']) ||
		(isset($options['use_custom_likes']) && $options['use_custom_likes']) )
		return true;

	return false;
}

function dt_get_custom_like_buttons( $post_id = null, $echo = true ) {
	global $post;
	if( !$post_id && $post )
		$post_id = $post->ID;

	ob_start();
	include dirname(dirname(__FILE__)). '/socials_code.php';
	$html = ob_get_clean();
	$links = str_replace( array('%POST_PERMALINK%'), array(get_permalink($post_id)), $html );

	if( $echo ) {
		echo $links;
		return false;
	}
	return $links;
}

function dt_get_like_buttons( $post_id = null, $wrap = '', $echo = true ) {
	if( !$wrap )
		$wrap = '<div class="dt-social-buttons">%s</div><style>.article{overflow: visible !important;}</style>';
	
	if( !dt_get_theme_options('use_custom_likes') ) {
		$links = dt_get_like_button('faceboock', $post_id, false);	
		$links .= dt_get_like_button('twitter', $post_id, false);	
		$links .= dt_get_like_button('google_plus', $post_id, false);	
	}else {
		$links = dt_get_custom_like_buttons( $post_id, false );
	}


	$links = sprintf( $wrap, $links );

	if( $echo ) {
		echo $links;
		return false;
	}
	return $links;
}

function dt_get_like_window( $args = array(), $echo = true ) {
	if( !is_array($args) )
		$args = array();

	if( is_lb_enabled('twitter') )
		$args['tw'] = 1;
			
	if( is_lb_enabled('faceboock') )
		$args['fb'] = 1;

	if( is_lb_enabled('google_plus') )
		$args['gp'] = 1;


	if( dt_get_theme_options('use_custom_likes') )
		$args['use_custom'] = 1;
	
	$href = add_query_arg( $args, get_template_directory_uri().'/like_window.php' );
	
	ob_start();
	?>		
	<div class="dt-social-buttons dt-window-link">	
		<a href="<?php echo esc_url($href); ?>" target="_blank" rel="nofollow" onClick="popupWin = window.open(this.href, 'like window', 'location,width=465,height=320,top=0'); popupWin.focus(); return false;"><?php _e('Like!', LANGUAGE_ZONE); ?></a>	
	</div>
	<?php
	$html = ob_get_clean();

	if( $echo ) {
		echo $html;
		return false;
	}
	return $html;
}
?>
