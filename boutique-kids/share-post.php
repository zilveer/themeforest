<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="share-post-wrapper dtbaker_banner">
	<div class="share-post">
		<div class="title"><?php
			$type = get_post_type( get_the_ID() );
			$object = get_post_type_object( $type );
			if($object && !empty($object->labels->singular_name)){
				printf( __( 'Share %s:', 'boutique-kids' ) , $object->labels->singular_name );
			}
			?>
		</div>
		<ul class="share-buttons">
			<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr(urlencode(get_home_url()));?>&t=" target="_blank" title="Share on Facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;"><i class="fa fa-facebook-square fa-2x"></i></a></li>
			<li><a href="https://twitter.com/intent/tweet?source=<?php echo esc_attr(urlencode(get_home_url()));?>&text=:%20<?php echo esc_attr(urlencode(get_home_url()));?>" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20' + encodeURIComponent(document.URL)); return false;"><i class="fa fa-twitter-square fa-2x"></i></a></li>
			<li><a href="https://plus.google.com/share?url=<?php echo esc_attr(urlencode(get_home_url()));?>" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;"><i class="fa fa-google-plus-square fa-2x"></i></a></li>
			<li><a href="http://www.tumblr.com/share?v=3&u=<?php echo esc_attr(urlencode(get_home_url()));?>&t=&s=" target="_blank" title="Post to Tumblr" onclick="window.open('http://www.tumblr.com/share?v=3&u=' + encodeURIComponent(document.URL) + '&t=' +  encodeURIComponent(document.title)); return false;"><i class="fa fa-tumblr-square fa-2x"></i></a></li>
			<li><a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_attr(urlencode(get_home_url()));?>&description=" target="_blank" title="Pin it" onclick="window.open('http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(document.URL) + '&description=' +  encodeURIComponent(document.title)); return false;"><i class="fa fa-pinterest-square fa-2x"></i></a></li>
			<li><a href="http://www.reddit.com/submit?url=<?php echo esc_attr(urlencode(get_home_url()));?>&title=" target="_blank" title="Submit to Reddit" onclick="window.open('http://www.reddit.com/submit?url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><i class="fa fa-reddit-square fa-2x"></i></a></li>
			<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_attr(urlencode(get_home_url()));?>&title=&summary=&source=<?php echo esc_attr(urlencode(get_home_url()));?>" target="_blank" title="Share on LinkedIn" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
			<li><a href="mailto:?subject=&body=:%20<?php echo esc_attr(urlencode(get_home_url()));?>" target="_blank" title="Email" onclick="window.open('mailto:?subject=' + encodeURIComponent(document.title) + '&body=' +  encodeURIComponent(document.URL)); return false;"><i class="fa fa-envelope-square fa-2x"></i></a></li>
		</ul>
	</div>
</div>

<?php
/*
<a href="https://pinterest.com/pin/create/bookmarklet/?media=<?php
	$thumb_id = get_post_thumbnail_id();
	if ( $thumb_id ) {
	    $image = wp_get_attachment_image_src( $thumb_id, 'full' );
		if ( $image ) {
			list( $src, $width, $height ) = $image;
			echo esc_attr( urlencode( $src ) );
		}
	}
	;?>&url=<?php echo esc_attr( urlencode( get_permalink() ) );?>&is_video=0&description=<?php echo esc_attr( urlencode( get_the_title() ) );?>" class="webicon pinterest small"  target="_blank">pinterest</a>
     */
?>