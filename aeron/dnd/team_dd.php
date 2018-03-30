<?php

/*********** Shortcode: Team ************************************************************/
$ABdevDND_shortcodes['team_dd'] = array(
	'attributes' => array(
		'name' => array(
			'description' => __('Name', 'dnd-shortcodes'),
		),
		'position' => array(
			'description' => __('Position', 'dnd-shortcodes'),
		),
		'image' => array(
			'type' => 'image',
			'description' => __('Image URL', 'dnd-shortcodes'),
		),
		'link' => array(
			'description' => __('Profile URL', 'dnd-shortcodes'),
			'info' => __('Link to about page', 'dnd-shortcodes'),
		),
		'modal' => array(
			'type' => 'checkbox',
			'description' => __('Use Modal Instead Link', 'dnd-shortcodes'),
			'info' => __('Modal window will appear on click instead of following a link. Use content to add modal window content', 'dnd-shortcodes'),
		),
		'mail' => array(
			'description' => __('E-mail address', 'dnd-shortcodes'),
		),
		'facebook' => array(
			'description' => __('Facebook URL', 'dnd-shortcodes'),
		),
		'twitter' => array(
			'description' => __('Twitter URL', 'dnd-shortcodes'),
		),
		'linkedin' => array(
			'description' => __('Linkedin URL', 'dnd-shortcodes'),
		),
		'googleplus' => array(
			'description' => __('Google+ URL', 'dnd-shortcodes'),
		),
		'youtube' => array(
			'description' => __('Youtube URL', 'dnd-shortcodes'),
		),
		'pinterest' => array(
			'description' => __('Pinterest URL', 'dnd-shortcodes'),
		),
		'github' => array(
			'description' => __('Github URL', 'dnd-shortcodes'),
		),
		'feed' => array(
			'description' => __('Feed URL', 'dnd-shortcodes'),
		),
		'behance' => array(
			'description' => __('Behance URL', 'dnd-shortcodes'),
		),
		'blogger_blog' => array(
			'description' => __('Blogger URL', 'dnd-shortcodes'),
		),
		'delicious' => array(
			'description' => __('Delicious URL', 'dnd-shortcodes'),
		),
		'designcontest' => array(
			'description' => __('DesignContest URL', 'dnd-shortcodes'),
		),
		'deviantart' => array(
			'description' => __('DeviantART URL', 'dnd-shortcodes'),
		),
		'digg' => array(
			'description' => __('Digg URL', 'dnd-shortcodes'),
		),
		'dribbble' => array(
			'description' => __('Dribbble URL', 'dnd-shortcodes'),
		),
		'dropbox' => array(
			'description' => __('Dropbox URL', 'dnd-shortcodes'),
		),
		'flickr' => array(
			'description' => __('Flickr URL', 'dnd-shortcodes'),
		),
		'forrst' => array(
			'description' => __('Forrst URL', 'dnd-shortcodes'),
		),
		'instagram' => array(
			'description' => __('Instagram URL', 'dnd-shortcodes'),
		),
		'lastfm' => array(
			'description' => __('Last.fm URL', 'dnd-shortcodes'),
		),
		'myspace' => array(
			'description' => __('Myspace URL', 'dnd-shortcodes'),
		),
		'picasa' => array(
			'description' => __('Picasa URL', 'dnd-shortcodes'),
		),
		'skype' => array(
			'description' => __('Skype URL', 'dnd-shortcodes'),
		),
		'stumbleupon' => array(
			'description' => __('StumbleUpon URL', 'dnd-shortcodes'),
		),
		'vimeo' => array(
			'description' => __('Vimeo URL', 'dnd-shortcodes'),
		),
		'zerply' => array(
			'description' => __('Zerply URL', 'dnd-shortcodes'),
		),
		'social_target' => array(
			'description' => __('Social Link Target', 'dnd-shortcodes'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  __('Self', 'dnd-shortcodes'),
				'_blank' => __('Blank', 'dnd-shortcodes'),
			),
		),
		'social_under' => array(
			'type' => 'checkbox',
			'description' => __('Social icons under position', 'dnd-shortcodes'),
			'info' => __('If enabled social icons will appear under position instead on image overlay.', 'dnd-shortcodes'),
		),
	),
	'content' => '',
	'description' => __('Team Member', 'dnd-shortcodes' )
);
function ABdevDND_team_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('team_dd'), $attributes));



	$return = '
		<div class="dnd_team_member">';

	$social_links = '';
	if($twitter!='') $social_links .= '<a href="'.$twitter.'" target="'.$social_target.'"><i class="ABdev_icon-twitter"></i></a>';
	if($linkedin!='') $social_links .= '<a href="'.$linkedin.'" target="'.$social_target.'"><i class="ABdev_icon-linkedin"></i></a>';
	if($mail!='') $social_links .= '<a href="mailto:'.$mail.'"><i class="ABdev_icon-emailalt"></i></a>';
	if($facebook!='') $social_links .= '<a href="'.$facebook.'" target="'.$social_target.'"><i class="ABdev_icon-facebook"></i></a>';
	if($googleplus!='') $social_links.='<a href="'.$googleplus.'" target="'.$social_target.'"><i class="ABdev_icon-googleplus"></i></a>';
	if($youtube!='') $social_links.='<a href="'.$youtube.'" target="'.$social_target.'"><i class="ABdev_icon-youtube"></i></a>';
	if($pinterest!='') $social_links.='<a href="'.$pinterest.'" target="'.$social_target.'"><i class="ABdev_icon-pinterest"></i></a>';
	if($github!='') $social_links.='<a href="'.$github.'" target="'.$social_target.'"><i class="ABdev_icon-github"></i></a>';
	if($feed!='') $social_links.='<a href="'.$feed.'" target="'.$social_target.'"><i class="ABdev_icon-rss"></i></a>';
	if($behance!='') $social_links.='<a href="'.$behance.'" target="'.$social_target.'"><i class="ABdev_icon-behance"></i></a>';
	if($blogger_blog!='') $social_links.='<a href="'.$blogger_blog.'" target="'.$social_target.'"><i class="ABdev_icon-blogger-blog"></i></a>';
	if($delicious!='') $social_links.='<a href="'.$delicious.'" target="'.$social_target.'"><i class="ABdev_icon-delicious"></i></a>';
	if($designcontest!='') $social_links.='<a href="'.$designcontest.'" target="'.$social_target.'"><i class="ABdev_icon-designcontest"></i></a>';
	if($deviantart!='') $social_links.='<a href="'.$deviantart.'" target="'.$social_target.'"><i class="ABdev_icon-deviantart"></i></a>';
	if($digg!='') $social_links.='<a href="'.$digg.'" target="'.$social_target.'"><i class="ABdev_icon-digg"></i></a>';
	if($dribbble!='') $social_links.='<a href="'.$dribbble.'" target="'.$social_target.'"><i class="ABdev_icon-dribbble"></i></a>';
	if($dropbox!='') $social_links.='<a href="'.$dropbox.'" target="'.$social_target.'"><i class="ABdev_icon-dropbox"></i></a>';
	if($flickr!='') $social_links.='<a href="'.$flickr.'" target="'.$social_target.'"><i class="ABdev_icon-flickr"></i></a>';
	if($forrst!='') $social_links.='<a href="'.$forrst.'" target="'.$social_target.'"><i class="ABdev_icon-forrst"></i></a>';
	if($instagram!='') $social_links.='<a href="'.$instagram.'" target="'.$social_target.'"><i class="ABdev_icon-instagram"></i></a>';
	if($lastfm!='') $social_links.='<a href="'.$lastfm.'" target="'.$social_target.'"><i class="ABdev_icon-lastfm"></i></a>';
	if($myspace!='') $social_links.='<a href="'.$myspace.'" target="'.$social_target.'"><i class="ABdev_icon-myspace"></i></a>';
	if($picasa!='') $social_links.='<a href="'.$picasa.'" target="'.$social_target.'"><i class="ABdev_icon-picasa"></i></a>';
	if($skype!='') $social_links.='<a href="'.$skype.'" target="'.$social_target.'"><i class="ABdev_icon-skype"></i></a>';
	if($stumbleupon!='') $social_links.='<a href="'.$stumbleupon.'" target="'.$social_target.'"><i class="ABdev_icon-stumbleupon"></i></a>';
	if($vimeo!='') $social_links.='<a href="'.$vimeo.'" target="'.$social_target.'"><i class="ABdev_icon-vimeo"></i></a>';
	if($zerply!='') $social_links.='<a href="'.$zerply.'" target="'.$social_target.'"><i class="ABdev_icon-zerply"></i></a>';


		if(($social_links!='' && $social_under!=1) || $link!=''){
			$return .= '<div class="dnd_overlayed">
				<img src="'.$image.'" alt="'.$name.'">
				<div class="dnd_overlay">
					<p>';
						if($social_under==1 || $social_links==''){
							if ($modal==1){
								$return .='<a class="dnd_team_member_link dnd_team_member_modal_link" href="'.$link.'"><i class="ABdev_icon-zoom-in"></i></a>';
							}else{
								$return .='<a href="'.$link.'"><i class="ABdev_icon-linkalt"></i></a>';
							}
						}
						else{	
							$return .= $social_links;
						}
					$return .= '</p>
				</div>
			</div>';
		}
		else{
			$return.= '<img src="'.$image.'" alt="'.$name.'">';
		}
		$return .= '<a class="dnd_team_member_link'.(($modal==1)?' dnd_team_member_modal_link':'').'" href="'.$link.'">
			<span class="dnd_team_member_name">'.$name.'</span>
			<span class="dnd_team_member_position">'.$position.'</span>
		</a>';

		if($modal == 1){
			$return .= '
				<div class="dnd_team_member_modal">
					<h4 class="dnd_team_member_name">'.$name.'</h4>
					<p class="dnd_team_member_position">'.$position.'</p>
					<div class="dnd_container">
						<div class="dnd_column_dd_span6">
							<img src="'.$image.'" alt="'.$name.'">
						</div>
						<div class="dnd_column_dd_span6">
							'.do_shortcode($content).'
						</div>
					</div>
					<div class="dnd_team_member_modal_close">X</div>
				</div>';
		}
		else{
			$return .= '
				<p>'.$content.'</p>
			';
		}

		if($social_under==1){
			$return .= '<div class="dnd_team_member_social_under">'.$social_links.'</div>';
		}

		$return .= '</div>';

	return $return;
}



