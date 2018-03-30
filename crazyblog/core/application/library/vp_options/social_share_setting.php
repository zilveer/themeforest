<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_social_share_setting_menu {

	public $title = 'Social Sharing Setting';
	public $icon = 'fa-share';

	public function crazyblog_menu() {

		$return = array(
			array(
				'type' => 'toggle',
				'name' => 'show_fb_share',
				'label' => esc_html__( 'Facebook', 'crazyblog' ),
			),
			array(
				'type' => 'toggle',
				'name' => 'show_twitter_share',
				'label' => esc_html__( 'Twitter', 'crazyblog' ),
			),
			array(
				'type' => 'toggle',
				'name' => 'show_linkedin_share',
				'label' => esc_html__( 'Linkedin', 'crazyblog' ),
			),
			array(
				'type' => 'toggle',
				'name' => 'show_pinterest_share',
				'label' => esc_html__( 'Pinterest', 'crazyblog' ),
			),
			array(
				'type' => 'toggle',
				'name' => 'show_gplus_share',
				'label' => esc_html__( 'Google Plus', 'crazyblog' ),
			),
			array(
				'type' => 'toggle',
				'name' => 'show_reddit_share',
				'label' => esc_html__( 'Reddit', 'crazyblog' ),
			),
			array(
				'type' => 'toggle',
				'name' => 'show_tumblr_share',
				'label' => esc_html__( 'Tumblr', 'crazyblog' ),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_social_share_', $return );
	}

}
