<?php

if( has_post_thumbnail() ){
	$share_image 			= wp_get_attachment_image_src( get_post_thumbnail_id(), 'xl' );
	$share_image 			= $share_image[0];
	$share_image_portrait 	= wp_get_attachment_image_src( get_post_thumbnail_id(), 'square-m' );
	$share_image_portrait 	= $share_image_portrait[0];
}else{
	$share_image 			= '';
	$share_image_portrait 	= '';
}

$share_excerpt = strip_tags( sleek_get_wp_excerpt('',false), '<b><i><strong><a>' );


?>

<div class="social-nav">
	<div class="social-nav__title"> <?php _e('Share this', 'sleek'); ?></div>

	<ul class="social-nav__items">

		<li class="social-nav__item">
			<a title="Email" class="social-nav__link js-skip-ajax" href="mailto:?subject=<?php echo ( rawurlencode( get_the_title() ) ); ?>&amp;body=<?php echo ( rawurlencode ( $share_excerpt . ' ' . get_the_permalink() ) ); ?>">
				<i class="icon-mail6"></i>
			</a>
		</li>

		<li class="social-nav__item">
			<a title="Pinterest" class="social-nav__link js-sharer js-skip-ajax" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo( rawurlencode( get_the_permalink() ) ); ?>&amp;media=<?php echo ( rawurlencode( $share_image_portrait ) ); ?>&amp;description=<?php echo( rawurlencode( get_the_title() ) ); ?>">
				<i class="icon-pinterest3"></i>
			</a>
		</li>

		<li class="social-nav__item">
			<a title="Google+" class="social-nav__link js-sharer js-skip-ajax" target="_blank" href="https://plus.google.com/share?url=<?php echo( rawurlencode( get_the_permalink() ) ); ?>">
				<i class="icon-googleplus5"></i>
			</a>
		</li>

		<li class="social-nav__item">
			<a title="Twitter" class="social-nav__link js-sharer js-skip-ajax" target="_blank"  href="http://twitter.com/intent/tweet?text=<?php echo( rawurlencode( get_the_title() ) ); ?>&amp;url=<?php echo( rawurlencode( get_the_permalink() ) ); ?>">
				<i class="icon-twitter"></i>
			</a>
		</li>

		<li class="social-nav__item">
			<a title="Facebook" class="social-nav__link js-sharer js-skip-ajax" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo( rawurlencode( get_the_permalink() ) ); ?>">
				<i class="icon-facebook"></i>
			</a>
		</li>

	</ul>
</div>
