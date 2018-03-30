<?php

return array(
	'icon'   => 'el el-share-alt',
	'title'  => __( 'Social', 'BERG' ),
	'fields' => array(

		array(
			'id' => 'share_on_facebook',
			'type' => 'checkbox',
			'title' => __('Show share on Facebook', 'BERG'),
			'default' => '1',
		),

		array(
			'id' => 'share_on_twitter',
			'type' => 'checkbox',
			'title' => __('Show share on Twitter', 'BERG'),
			'default' => '1',
		),

		array(
			'id' => 'share_on_google_plus',
			'type' => 'checkbox',
			'title' => __('Show share on Google+', 'BERG'),
			'default' => '1',
		),

		array(
			'id' => 'share_on_pinterest',
			'type' => 'checkbox',
			'title' => __('Show share on Pinterest', 'BERG'),
			'default' => '1',
		),

		array(
			'id' => 'share_on_linkedin',
			'type' => 'checkbox',
			'title' => __('Show share on LinkedIn', 'BERG'),
			'default' => '1',
		),
		array(
			'id' => 'share_new_window',
			'type' => 'checkbox',
			'title' => __('Open in new window', 'BERG'),
			'default' => '1',
		),		

		array(
		    'id'   =>'berg_social_profiles_divide',
		    'title' => __('Social profiles', 'BERG'),
		    'type' => 'divide'
		),

		array(
			'id'       => 'social-title',
			'type'     => 'text',
			'title'    => __( 'Social profile title', 'BERG' ),
			'default' => ''
		),
		array(
			'id'       => 'social-link',
			'type'     => 'text',
			'title'    => __( 'Social profile URL link', 'BERG' ),
			'default' => ''
		),		
		array(
			'id' => 'social_profiles',
			'type' => 'social_profiles',
			'title' => __( 'Add social profile', 'BERG' ),
		),
	)
);