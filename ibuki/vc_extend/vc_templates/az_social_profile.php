<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

$class = setClass(array('az-social-profile', $el_class));

$output .= '<div'.$class.'>
			<ul class="social-icons">';

if(!empty($px))
$output .= '<li><a href="'.$px.'" target="_blank"><i class="font-icon-social-500px"></i></a></li>';

if(!empty($behance))
$output .= '<li><a href="'.$behance.'" target="_blank"><i class="font-icon-social-behance"></i></a></li>';

if(!empty($bebo))
$output .= '<li><a href="'.$bebo.'" target="_blank"><i class="font-icon-social-bebo"></i></a></li>';

if(!empty($blogger))
$output .= '<li><a href="'.$blogger.'" target="_blank"><i class="font-icon-social-blogger"></i></a></li>';

if(!empty($deviantart))
$output .= '<li><a href="'.$deviantart.'" target="_blank"><i class="font-icon-social-deviant-art"></i></a></li>';

if(!empty($digg))
$output .= '<li><a href="'.$digg.'" target="_blank"><i class="font-icon-social-digg"></i></a></li>';

if(!empty($dribbble))
$output .= '<li><a href="'.$dribbble.'" target="_blank"><i class="font-icon-social-dribbble"></i></a></li>';

if(!empty($email))
$output .= '<li><a href="'.$email.'" target="_blank"><i class="font-icon-social-email"></i></a></li>';

if(!empty($envato))
$output .= '<li><a href="'.$envato.'" target="_blank"><i class="font-icon-social-envato"></i></a></li>';

if(!empty($evernote))
$output .= '<li><a href="'.$evernote.'" target="_blank"><i class="font-icon-social-evernote"></i></a></li>';

if(!empty($facebook))
$output .= '<li><a href="'.$facebook.'" target="_blank"><i class="font-icon-social-facebook"></i></a></li>';

if(!empty($flickr))
$output .= '<li><a href="'.$flickr.'" target="_blank"><i class="font-icon-social-flickr"></i></a></li>';

if(!empty($forrst))
$output .= '<li><a href="'.$forrst.'" target="_blank"><i class="font-icon-social-forrst"></i></a></li>';

if(!empty($github))
$output .= '<li><a href="'.$github.'" target="_blank"><i class="font-icon-social-github"></i></a></li>';

if(!empty($googleplus))
$output .= '<li><a href="'.$googleplus.'" target="_blank"><i class="font-icon-social-google-plus"></i></a></li>';

if(!empty($grooveshark))
$output .= '<li><a href="'.$grooveshark.'" target="_blank"><i class="font-icon-social-grooveshark"></i></a></li>';

if(!empty($instagram))
$output .= '<li><a href="'.$instagram.'" target="_blank"><i class="font-icon-social-instagram"></i></a></li>';

if(!empty($lastfm))
$output .= '<li><a href="'.$lastfm.'" target="_blank"><i class="font-icon-social-last-fm"></i></a></li>';

if(!empty($linkedin))
$output .= '<li><a href="'.$linkedin.'" target="_blank"><i class="font-icon-social-linkedin"></i></a></li>';

if(!empty($paypal))
$output .= '<li><a href="'.$paypal.'" target="_blank"><i class="font-icon-social-paypal"></i></a></li>';

if(!empty($pinterest))
$output .= '<li><a href="'.$pinterest.'" target="_blank"><i class="font-icon-social-pinterest"></i></a></li>';

if(!empty($quora))
$output .= '<li><a href="'.$quora.'" target="_blank"><i class="font-icon-social-quora"></i></a></li>';

if(!empty($sharethis))
$output .= '<li><a href="'.$sharethis.'" target="_blank"><i class="font-icon-social-share-this"></i></a></li>';

if(!empty($skype))
$output .= '<li><a href="'.$skype.'" target="_blank"><i class="font-icon-social-skype"></i></a></li>';

if(!empty($soundcloud))
$output .= '<li><a href="'.$soundcloud.'" target="_blank"><i class="font-icon-social-soundcloud"></i></a></li>';

if(!empty($stumbleupon))
$output .= '<li><a href="'.$stumbleupon.'" target="_blank"><i class="font-icon-social-stumbleupon"></i></a></li>';

if(!empty($tumblr))
$output .= '<li><a href="'.$tumblr.'" target="_blank"><i class="font-icon-social-tumblr"></i></a></li>';

if(!empty($twitter))
$output .= '<li><a href="'.$twitter.'" target="_blank"><i class="font-icon-social-twitter"></i></a></li>';

if(!empty($viddler))
$output .= '<li><a href="'.$viddler.'" target="_blank"><i class="font-icon-social-viddler"></i></a></li>';

if(!empty($vimeo))
$output .= '<li><a href="'.$vimeo.'" target="_blank"><i class="font-icon-social-vimeo"></i></a></li>';

if(!empty($virb))
$output .= '<li><a href="'.$virb.'" target="_blank"><i class="font-icon-social-virb"></i></a></li>';

if(!empty($wordpress))
$output .= '<li><a href="'.$wordpress.'" target="_blank"><i class="font-icon-social-wordpress"></i></a></li>';

if(!empty($yahoo))
$output .= '<li><a href="'.$yahoo.'" target="_blank"><i class="font-icon-social-yahoo"></i></a></li>';

if(!empty($yelp))
$output .= '<li><a href="'.$yelp.'" target="_blank"><i class="font-icon-social-yelp"></i></a></li>';

if(!empty($youtube))
$output .= '<li><a href="'.$youtube.'" target="_blank"><i class="font-icon-social-youtube"></i></a></li>';

if(!empty($xing))
$output .= '<li><a href="'.$xing.'" target="_blank"><i class="font-icon-social-xing"></i></a></li>';

if(!empty($zerply))
$output .= '<li><a href="'.$zerply.'" target="_blank"><i class="font-icon-social-zerply"></i></a></li>';


$output .= '</ul>
			</div>';

echo $output.$this->endBlockComment('az_social_profile');

?>