<?php
//
// post sharing buttons
//
global $ft_option;
global $post_layout;

$twitter_user = $ft_option['twitter_username'];
?>
<div class="post-sharing-buttons <?php if( $post_layout == 'e' ) { echo 'text-center'; } ?>">
	<div class="btn-group">
		<?php
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );

		echo '<a class="btn btn-share btn-facebook" href="http://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-facebook-square"></i> Facebook</a>
		<a class="btn btn-share btn-twitter" href="https://twitter.com/intent/tweet?text=' . urlencode(get_the_title()) . '&url=' .  urlencode(get_permalink()) . '&via=' . urlencode($twitter_user ? $twitter_user : get_bloginfo('name')) .'" onclick="if(!document.getElementById(\'td_social_networks_buttons\')){window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;}"><i class="fa fa-twitter-square"></i> Twitter</a>
		
		<a class="btn btn-share btn-pinterest" href="http://pinterest.com/pin/create/button/?url='. esc_url( get_permalink() ) .'&amp;media=' . (!empty($image[0]) ? $image[0] : '') . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-pinterest"></i>Pinterest</a>

		<a class="btn btn-share btn-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url='. esc_url( get_permalink() ) .'&title=' . get_the_title() . '&source='.esc_url( home_url( '/' ) ).'" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-linkedin-square"></i> Linkedin</a>

		<a class="btn btn-share btn-google-plus" href="http://plus.google.com/share?url=' . esc_url( get_permalink() ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-google-plus-square"></i> Google +</a>
		<a class="btn btn-share btn-email" href="mailto:example.com?subject='.esc_attr( get_the_title() ).'"><i class="fa fa-envelope"></i> Email</a>'; ?>

	</div>
</div>