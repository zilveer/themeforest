<?php

function ubermenu_register_icons( $group , $iconmap ){
	_UBERMENU()->register_icons( $group, $iconmap );
}

function ubermenu_deregister_icons( $group ){
	_UBERMENU()->deregister_icons( $group );
}
function ubermenu_get_registered_icons(){
	return _UBERMENU()->get_registered_icons();
}
function ubermenu_get_icon_ops(){

	$icons = ubermenu_get_registered_icons();

	$icon_select = array( '' => array( 'title' => 'None' ) );

	foreach( $icons as $icon_group => $group ){

		$iconmap = $group['iconmap'];
		$prefix = isset( $group['class_prefix'] ) ? $group['class_prefix'] : '';

		foreach( $iconmap as $icon_class => $icon ){

			$icon_select[$prefix.$icon_class] = $icon; //$icon['title']; //ucfirst( str_replace( '-' , ' ' , str_replace( 'icon-' , '' , $icon_class ) ) );

		}

	}

	return $icon_select;
}

function ubermenu_register_default_icons(){

	ubermenu_register_icons( 'font-awesome' , array(
		'title' => 'Font Awesome',
		'class_prefix' => 'fa ',
		'iconmap' => ubermenu_get_icons() 
	));

}

function ubermenu_get_icons(){

	$icons = array(
		'fa-bars'	=> 	array(
			'title'	=> 	'Bars',
		),
		'fa-music'	=>	array(
			'title'	=>	'Music',
		),
		'fa-search'	=>	array(
			'title'	=>	'Search',
		),
		'fa-gear'	=>	array(
			'title'	=>	'Gear',
		),
		'fa-envelope-o'	=>	array(
			'title'	=>	'Envelope (Outline)',
		),
		'fa-user'	=>	array(
			'title'	=>	'User',
		),
		'fa-film'	=>	array(
			'title'	=>	'Film',
		),
		'fa-home'	=>	array(
			'title'	=>	'Home',
		),
		'fa-download'	=>	array(
			'title'	=>	'Download',
		),
		
		'fa-lock'	=>	array(
			'title'	=>	'Lock',
		),
		
		'fa-headphones'	=>	array(
			'title'	=>	'Headphones',
		),
		
		'fa-book'	=>	array(
			'title'	=>	'Book',
		),
		'fa-bookmark'	=>	array(
			'title'	=>	'Bookmark',
		),
		
		'fa-camera'	=>	array(
			'title'	=>	'Camera',
		),
		
		'fa-video-camera'	=>	array(
			'title'	=>	'video-camera',
		),
		'fa-picture-o'	=>	array(
			'title'	=>	'Picture (Outline)',
		),
		'fa-pencil'	=>	array(
			'title'	=>	'Pencil',
		),
		'fa-map-marker'	=>	array(
			'title'	=>	'Map Marker',
		),
		
		'fa-calendar'	=>	array(
			'title'	=>	'Calendar',
		),

		'fa-desktop'	=>	array(
			'title'	=>	'Desktop',
		),
		'fa-laptop'	=>	array(
			'title'	=>	'Laptop',
		),
		'fa-tablet'	=>	array(
			'title'	=>	'Tablet',
		),
		'fa-mobile'	=>	array(
			'title'	=>	'Mobile',
		),

		
		'fa-shopping-cart'	=>	array(
			'title'	=>	'Shopping Cart',
		),
		'fa-twitter-square'	=>	array(
			'title'	=>	'Twitter Square',
		),
		'fa-facebook-square'	=>	array(
			'title'	=>	'Facebook Square',
		),
		'fa-sign-out'	=>	array(
			'title'	=>	'Sign Out',
		),
		'fa-linkedin-square'	=>	array(
			'title'	=>	'Linkedin Square',
		),
		'fa-sign-in'	=>	array(
			'title'	=>	'Sign In',
		),
		'fa-phone'	=>	array(
			'title'	=>	'Phone',
		),
		'fa-phone-square'	=>	array(
			'title'	=>	'Phone Square',
		),
		'fa-twitter'	=>	array(
			'title'	=>	'Twitter',
		),
		'fa-facebook'	=>	array(
			'title'	=>	'Facebook',
		),
		'fa-github'	=>	array(
			'title'	=>	'Github',
		),
		'fa-pinterest'	=>	array(
			'title'	=>	'Pinterest',
		),
		'fa-pinterest-square'	=>	array(
			'title'	=>	'Pinterest Square',
		),
		'fa-google-plus-square'	=>	array(
			'title'	=>	'Google Plus Square',
		),
		'fa-google-plus'	=>	array(
			'title'	=>	'Google Plus',
		),
		'fa-envelope'	=>	array(
			'title'	=>	'Envelope',
		),
		'fa-linkedin'	=>	array(
			'title'	=>	'Linkedin',
		),

		'fa-youtube-square'	=>	array(
			'title'	=>	'Youtube Square',
		),
		'fa-youtube'	=>	array(
			'title'	=>	'Youtube',
		),
		'fa-youtube-play'	=>	array(
			'title'	=>	'Youtube Play',
		),
		'fa-stack-overflow'	=>	array(
			'title'	=>	'Stack Overflow',
		),
		'fa-instagram'	=>	array(
			'title'	=>	'Instagram',
		),
		'fa-flickr'	=>	array(
			'title'	=>	'Flickr',
		),
		'fa-bitbucket'	=>	array(
			'title'	=>	'Bitbucket',
		),
		'fa-bitbucket-square'	=>	array(
			'title'	=>	'Bitbucket Square',
		),
		'fa-tumblr'	=>	array(
			'title'	=>	'Tumblr',
		),
		'fa-tumblr-square'	=>	array(
			'title'	=>	'Tumblr Square',
		),
		'fa-dribbble'	=>	array(
			'title'	=>	'Dribbble',
		),
		'fa-skype'	=>	array(
			'title'	=>	'Skype',
		),
		'fa-foursquare'	=>	array(
			'title'	=>	'Foursquare',
		),
		'fa-gittip'	=>	array(
			'title'	=>	'Gittip',
		),
		'fa-vimeo-square'	=>	array(
			'title'	=>	'Vimeo Square',
		),
	);

	return $icons;
}
