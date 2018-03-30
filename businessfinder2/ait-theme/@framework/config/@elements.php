<?php


return array(
	'page-title' => array(
		'title' => _x('Page Title', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => true,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'sortable' => false,
			'cloneable' => false,
			'columnable' => false,
		),
	),

	'revolution-slider' => array(
		'title' => _x('Revolution Slider', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'sortable' => false,
			'cloneable' => false,
			'columnable' => false,
		),
	),

	'content' => array(
		'title' => _x('Content', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => true,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => false,
			'columnable' => false,
			'sortable' => true,
		),
	),

	'comments' => array(
		'title' => _x('Comments', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => true,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => false,
			'sortable' => true,
			'columnable' => false,
		),
	),

	'portfolio' => array(
		'title' => _x('Portfolio', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'columnable' => false,
			'sortable' => true,
			'cloneable' => true,
			'cpt' => array(
				'portfolio-item',
			),
			'assets' => array(
				'js' => array(
					'jquery-quicksand' => array(
						'file' => '/libs/jquery.quicksand.js',
						'deps' => array('ait'),
					),
					'jquery-quicksand-sorting' => array(
						'file' => '/libs/jquery.quicksand.sorting-1.3.js',
						'deps' => array('ait'),
					),
					'jquery-easing' => array(
						'file' => '/libs/jquery.easing-1.3.js',
						'deps' => array('ait'),
					),
					'ait-jquery-portfolio' => array(
						'file' => '/jquery.portfolio.js',
						'deps' => array(
							'ait',
							'jquery-quicksand',
							'jquery-quicksand-sorting',
							'jquery-easing',
							'jquery-colorbox',
						),
						'in-footer' => true,
					),
				),
			),
		),
	),

	'testimonials' => array(
		'title' => _x('Testimonials', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => false,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'cpt' => array(
				'testimonial',
			),
			'assets' => array(
				'js' => array(
					'ait-jquery-carousel' => true,
				),
			),
		),
	),

	'text' => array(
		'title' => _x('Text', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => true,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
		),
	),

	'columns' => array(
		'free' => true,
		'title' => _x('Columns', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => true,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => false,
            'narrow-columns' => array(
                'column-grid-2' => array(
                    'column-span-1',
                ),
                'column-grid-3' => array(
                    'column-span-1',
                ),
                'column-grid-4' => array(
                    'column-span-1',
                    'column-span-2',
                ),
                'column-grid-5' => array(
                    'column-span-1',
                    'column-span-2',
                ),
                'column-grid-6' => array(
                    'column-span-1',
                    'column-span-2',
                    'column-span-3',
                ),
            )
		),
	),

	'partners' => array(
		'title' => _x('Partners', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => false,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'cpt' => array(
				'partner',
			),
		),
	),

	'facebook' => array(
		'title' => _x('Facebook', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
		),
	),

	'faq' => array(
		'free' => false,
		'title' => _x('FAQ', 'name of element', 'ait-admin'),
		'package' => array(
			'standard' => false,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'cpt' => array(
				'faq'
			),
		),
	),

	'google-map' => array(
		'title' => _x('Google Map', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'assets' => array(
				'js' => array(
					'jquery-gmap3' => true,
					'modernizr' => true,
				),
			),
		),
	),

	'member' => array(
		'title' => _x('Member', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => false,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'cpt' => array(
				'member',
			),
		),
	),

	'price-table' => array(
		'title' => _x('Price Table', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => false,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => false,
			'cpt' => array(
				'price-table',
			),
			'assets' => array(
				'js' => array(
					'ait-jquery-pricetable' => array(
						'file' => '/jquery.pricetable.js',
						'deps' => array('ait'),
						'in-footer' => true,
					),
				),
			),
		),
	),

	'twitter' => array(
		'title' => _x('Twitter', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
		),
	),

	'video' => array(
		'title' => _x('Video', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
		),
	),

	'toggles' => array(
		'title' => _x('Toggles', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'cpt' => array(
				'toggle',
			),
			'assets' => array(
				'js' => array(
					'jquery-ui-tabs' => true,
					'jquery-ui-accordion' => true,
					'ait-tabs-script' => array(
						'file' => '/tabs.js',
						'deps' => array('jquery', 'ait-mobile-script'),
					),
				),
			),
		),
	),

 	'soundcloud' => array(
		'title' => _x('SoundCloud', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
		),
	),

	'mixcloud' => array(
		'title' => _x('Mixcloud', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
		),
	),

	'counters' => array(
		'title' => _x('Counters', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => true,
			'standard' => false,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'assets' => array(
				'js' => array(
					'ait-jquery-charts' => array(
						'file' => '/jquery.charts.js',
						'deps' => array('ait'),
					),
				),
			),
		),
	),

	'countdown' => array(
		'title' => _x('Countdown', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => false,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'assets' => array(
				'js' => array(
					'ait-countdown' => array(
						'file' => '/jquery.countdown.js',
						'deps' => array('ait'),
					),
				),
			),
		),
	),

	'rule' => array(
		'title' => _x('Horizontal Rule', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => false,
			'assets' => array(
				'js' => array(
					'ait-rule-btn' => array(
						'file' => '/rule-btn.js',
						'deps' => array('ait'),
					)
				),
			),
		),
	),

	'events' => array(
		'title' => _x('Events', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => false,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'cpt' => array(
				'event',
			),
			'assets' => array(
				'js' => array(
					'ait-jquery-carousel' => true,
				),
			),
		),
	),

	'events-with-map' => array(
		'title' => _x('Events With Map', 'name of element', 'ait-admin'),
		'disabled' => true, // disabled by default, only enabled explicitly in some themes like cityguide
		'package' => array(
			'free' => false,
			'standard' => false,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'cpt' => array(
				'event-with-map',
			),
			'assets' => array(
				'js' => array(
					'ait-jquery-carousel' => true,
				),
			),
		),
	),

	'job-offers' => array(
		'title' => _x('Job Offers', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => false,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'cpt' => array(
				'job-offer',
			),
			'assets' => array(
				'js' => array(
					'ait-jquery-carousel' => true,
				),
			),
		),
	),

	'opening-hours' => array(
		'title' => _x('Opening Hours', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => false,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
		),
	),

	'contact-form' => array(
		'title' => _x('Contact Form', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'assets' => array(
				'js' => array(
					'jquery-ui-datepicker' => true
				),
			),
		),
	),

	'sitemap' => array(
		'title' => _x('Sitemap', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
		),
	),

	'advertising-spaces' => array(
		'title' => _x('Advertisements', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'cpt' => array(
				'ad-space',
			),
			'assets' => array(
				'js' => array(
					'ait-adspaces' => array(
						'file' => '/jquery.adspaces.js',
						'deps' => array('ait'),
					),
				),
			),
		),
	),

	'seo' => array(
		'title' => _x('SEO', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => false,
			'business' => true,
			'developer' => true,
			'themeforest' => true,
		),
		'configuration' => array(
			'sortable' => false,
			'cloneable' => false,
			'columnable' => false,
		),
	),

	'posts' => array(
		'title' => _x('Posts', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'assets' => array(
				'js' => array(
					'ait-jquery-carousel' => true,
					'transit'	=> true,
				),
			),
		),
	),

	'members' => array(
		'title' => _x('Members', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => false,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'cpt' => array(
				'member',
			),
			'assets' => array(
				'js' => array(
					'ait-jquery-carousel' => true,
					'transit'	=> true
				),
			),
		),
	),

	'services' => array(
		'title' => _x('Services', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => false,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'cpt' => array(
				'service-box',
			),
			'assets' => array(
				'js' => array(
					'ait-jquery-carousel' => true,
					'transit' => true
				),
			),
		),
	),

	'easy-slider' => array(
		'title' => _x('Easy Slider', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'assets' => array(
				'css' => array(
					'jquery-bxslider' => true,
				),
				'js' => array(
					'jquery-bxslider' => true,
				),
			),
		),
	),

	'products' => array(
		'title' => _x('Products', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
			'cpt' => array(
				'product-item',
			),
		),
	),

	'image' => array(
		'title' => _x('Image', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
		),
	),

	'lists' => array(
		'title' => _x('Lists', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
		),
	),

	'promotion' => array(
		'title' => _x('Promotion', 'name of element', 'ait-admin'),
		'package' => array(
			'free' => false,
			'standard' => true,
			'themeforest' => true,
			'business' => true,
			'developer' => true,
		),
		'configuration' => array(
			'cloneable' => true,
			'sortable' => true,
			'columnable' => true,
		),
	),
);
