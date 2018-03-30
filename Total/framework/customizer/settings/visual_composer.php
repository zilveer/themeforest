<?php
/**
 * Customizer => Visual Composer
 *
 * @package Total WordPress Theme
 * @subpackage Customizer
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// General
$this->sections['wpex_visual_composer'] = array(
	'title' => esc_html__( 'General', 'total' ),
	'settings' => array(
		array(
			'id' => 'vc_row_bottom_margin',
			'transport' => 'postMessage',
			'default' => '40px',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Column Bottom Margin', 'total' ),
				'description' => esc_html__( 'Enter a default bottom margin for all Visual Composer columns to help speed up development.', 'total' ),
			),
			'inline_css' => array(
				'target' => '.wpex-vc-column-wrapper',
				'alter' => 'margin-bottom',
			),
		),
		/*
		 * @deprecated 3.3.0
		array(
			'id' => 'vcex_text_separator_two_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Separator With Text Border Color', 'total' ),
			),
			'inline_css' => array(
				'target' => 'body .vc_text_separator_two span',
				'alter' => 'border-color',
			),
		),*/
		array(
			'id' => 'vcex_text_tab_two_bottom_border',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Tabs Alternative 2 Border Color', 'total' ),
			),
			'inline_css' => array(
				'target' => 'body .wpb_tabs.tab-style-alternative-two .wpb_tabs_nav li.ui-tabs-active a',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'vcex_carousel_arrows',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Carousel Arrows Highlight Color', 'total' ),
			),
			'inline_css' => array(
				'target' => array(
					'.wpex-carousel .owl-prev',
					'.wpex-carousel .owl-next',
					'.wpex-carousel .owl-prev:hover',
					'.wpex-carousel .owl-next:hover',
				),
				'alter' => 'background-color',
			),
		),
		// Grid filter
		array(
			'id' => 'vcex_grid_filter_active_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Grid Filter: Active Link Color', 'total' ),
				'description' => esc_html__( 'Legacy Option', 'total' ),
			),
			'inline_css' => array(
				'target' => array(
					'.vcex-filter-links a.theme-button.minimal-border:hover',
					'.vcex-filter-links li.active a.theme-button.minimal-border',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'vcex_grid_filter_active_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Grid Filter: Active Link Background', 'total' ),
				'description' => esc_html__( 'Legacy Option', 'total' ),
			),
			'inline_css' => array(
				'target' => array(
					'.vcex-filter-links a.theme-button.minimal-border:hover',
					'.vcex-filter-links li.active a.theme-button.minimal-border',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'vcex_grid_filter_active_border',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Grid Filter: Active Link Border', 'total' ),
				'description' => esc_html__( 'Legacy Option', 'total' ),
			),
			'inline_css' => array(
				'target' => array(
					'.vcex-filter-links a.theme-button.minimal-border:hover',
					'.vcex-filter-links li.active a.theme-button.minimal-border',
				),
				'alter' => 'border-color',
			),
		),
		// Recent news
		array(
			'id' => 'vcex_recent_news_date_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Recent News Date: Background', 'total' ),
			),
			'inline_css' => array(
				'target' => '.vcex-recent-news-date span.month',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'vcex_recent_news_date_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Recent News Date: Color', 'total' ),
			),
			'inline_css' => array(
				'target' => '.vcex-recent-news-date span.month',
				'alter' => 'color',
			),
		),
	),
);