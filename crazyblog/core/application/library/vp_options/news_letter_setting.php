<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_news_letter_setting_menu {

	public $title = 'Newsletter Settings';
	public $icon = 'fa-paper-plane-o';

	public function crazyblog_menu() {

		$return = array(
			array(
				'type' => 'section',
				'title' => esc_html__( 'News Letter', 'crazyblog' ),
				'name' => 'news_letter_section',
				'fields' => array(
					array(
						'type' => 'textbox',
						'name' => 'mail_chimp_api_key',
						'label' => esc_html__( 'MailChimp API Key:', 'crazyblog' ),
						'description' => sprintf( esc_html__( 'Enter your MailChimp API Key. You can get it %s.', 'crazyblog' ), '<a target="_blank" href="https://admin.mailchimp.com/account/api-key-popup">' . esc_html__( 'here', 'crazyblog' ) . '</a>' ),
					),
					array(
						'type' => 'textbox',
						'name' => 'mail_chimp_list_id',
						'label' => esc_html__( 'List ID:', 'crazyblog' ),
						'description' => sprintf( esc_html__( 'Enter your List ID. You can get it %s.', 'crazyblog' ), '<a target="_blank" href="https://admin.mailchimp.com/lists/">' . esc_html__( 'here', 'crazyblog' ) . '</a>' )
					),
				)
			),
		);

		return apply_filters( 'crazyblog_vp_opt_news_letter_', $return );
	}

}
