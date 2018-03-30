<?php if(! defined('ABSPATH')){ return; }
/**
* Single Social - Facebook
*/
?>
<!-- Social sharing -->
<div class="blog-item-share clearfix" data-share-title="<?php echo esc_attr( __( 'SHARE:', 'zn_framework') ); ?>">
<?php

	$encoded_url = urlencode( get_permalink() );
	$share_text = htmlspecialchars( urlencode( __( "Check out - ", 'zn_framework' ) . get_the_title() ), ENT_COMPAT, 'UTF-8');

	$mail_subject = htmlspecialchars( __( "Check out this awesome project: ", 'zn_framework' ) .get_the_title() );
	$mail_body = htmlspecialchars( __( "You can see it live here ", 'zn_framework' ) .$encoded_url.'%3Futm_source%3Dsharemail .'."\n\n". __( " Made by ", 'zn_framework' ) . get_bloginfo() . ' ' . get_site_url() );

	$socialicons = array();
	$socialicons['twitter'] = array(
		'url' => 'https://twitter.com/intent/tweet?text='.$share_text.'&amp;url='.$encoded_url.'%3Futm_source%3Dsharetw',
		'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue82f')
	);
	$socialicons['facebook'] = array(
		'url' => 'https://www.facebook.com/sharer/sharer.php?display=popup&amp;u='.$encoded_url.'%3Futm_source%3Dsharefb',
		'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue83f')
	);
	$socialicons['gplus'] = array(
		'url' => 'https://plus.google.com/share?url='.$encoded_url.'%3Futm_source%3Dsharegp',
		'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue808')
	);
	$socialicons['pinterest'] = array(
		'url' => 'http://pinterest.com/pin/create/button?description='.$share_text.'&amp;url='.$encoded_url.'%3Futm_source%3Dsharepi',
		'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue80e')
	);
	$socialicons['mail'] = array(
		'url' => 'mailto:?body='.$mail_body.'&amp;subject='.$mail_subject,
		'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue836')
	);

	foreach ($socialicons as $key => $value) {
		echo '<a href="'.$value['url'].'" title="' . __( "SHARE ON", 'zn_framework' ) . ' '.strtoupper($key).'" class=" portfolio-item-share-link portfolio-item-share-'.$key.'">';
		echo '<span '. zn_generate_icon( $value['icon'] ) .'></span>';
		echo '</a>';
	}

?>

</div><!-- social links -->
