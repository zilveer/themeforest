<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

 
/**
 * Add more shortcodes to the framework
 * 
 */
function yit_add_shortcodes( $shortcodes ) {
	/** Removing section shortcodes **/
	unset($shortcodes['section_blog']);
	unset($shortcodes['section_portfolio']);
	unset($shortcodes['section_services']);
	global $name_tab;
	unset($name_tab['section']);
	/** end removing shortcodes **/
	
	$faq_categories = yit_get_faq_categories();
	$testimonial_categories = yit_get_testimonial_categories();
	
    return array_merge( $shortcodes, array(
		/* === TESTIMONIALS === */
		'testimonials' => array(
			'title' => 'Testimonials',
			'description' => 'Show all post on testimonials post types',
			'tab' => 'cpt',
            'has_content' => false,
			'attributes' => array(
				'items' => array(
					'title' => __('N. of items', 'yit'),
					'description' => __('Show all with -1', 'yit'),
            		'type' => 'number', 
					'std'  => '-1'
				),
				'cat' => array(
					'title' => __('Categories', 'yit'),
					'description' => __('Select the categories of posts to show', 'yit'),
            		'type' => 'select', 
            		'options' => $testimonial_categories,
					'std'  => ''
                )
			)
		),
		/* === TESTIMONIALS SLIDER === */
        'testimonials_slider' => array(
        	'title' => __('Testimonials slider', 'yit' ),
        	'description' =>  __('Show a slider with testimonials', 'yit' ),
        	'tab' => 'shortcodes',
            'has_content' => false,
        	'attributes' => array(
        		'items' => array(
        			'title' => __('N. of items', 'yit'),
            		'type' => 'number', 
        			'std'  => ''
        		),
        		'excerpt' => array(
        			'title' => __('Limit words', 'yit'),
            		'type' => 'number', 
        			'std'  => '32'
        		),
        		'speed' => array(
        			'title' => __('Speed (ms)', 'yit'),
            		'type' => 'number', 
        			'std'  => '500'
        		),
        		'timeout' => array(
        			'title' => __('Time out (ms)', 'yit'),
            		'type' => 'number', 
        			'std'  => '5000'
        		),
				'cat' => array(
					'title' => __('Categories', 'yit'),
					'description' => __('Select the categories of posts to show', 'yit'),
            		'type' => 'select', 
            		'options' => $testimonial_categories,
					'std'  => ''
                )
        	)
        ),
		/* === LOGOS SLIDER === */
        'logos_slider' => array(
        	'title' => __('Logos slider', 'yit' ),
        	'description' =>  __('Show a slider with logos', 'yit' ),
        	'tab' => 'shortcodes',
            'has_content' => false,
        	'attributes' => array(
        		'title' => array(
        			'title' => __('Title', 'yit'),
            		'type' => 'text', 
        			'std'  => ''
        		),
        		'items' => array(
        			'title' => __('N. of items', 'yit'),
            		'type' => 'number', 
        			'std'  => '-1'
        		),
				'height' => array(
						'title' => __('Height (px)', 'yit'),
						'type' => 'number', 
						'std'  => '50'
					),
				'speed' => array(
					'title' => __('Speed (ms)', 'yit'),
					'type' => 'number', 
					'std'  => '500'
				)
        	)
        ),
        'social' => array(
            	'title' => __('Social', 'yit' ),
            	'description' =>  __('Print a simple icon link for social', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'type' => array(
            			'title' => __('Type', 'yit'),
            			'type' => 'select', // facebook|twitter|rss|ecc
            			'options' => array(
							'facebook' => __('Facebook', 'yit'),
							'twitter' => __('Twitter', 'yit'),
							'rss' => __('RSS', 'yit'),
							'flickr' => __('Flickr', 'yit'),
							'linkedin' => __('LinkedIn', 'yit'),
							'skype' => __('Skype', 'yit'),
							'google' => __('Google', 'yit'),
							'pinterest' => __('Pinterest', 'yit'),
                            'bookmark' => __('Bookmark', 'yit'),
                            'instagram' => __('Instagram', 'yit'),
                            'youtube' => __('Youtube', 'yit'),
                            'vkontakte' => __( 'VKontakte', 'yit'),
                            'mail' => __('Mail', 'yit'),
                            'vimeo' => __('Vimeo', 'yit'),
                            'vine' => __('Vine', 'yit'),
                            'tumblr' => __('Tumblr', 'yit'),
						),
            			'std'  => ''
            		),
            		'size' => array(
            			'title' => __('Size', 'yit'),
            			'type' => 'select', // small|
            			'options' => array(
							'small' => __('Small', 'yit'),
							'' => __('Normal', 'yit')
						),
            			'std'  => ''
            		),
            		'href' => array(
            			'title' => __('URL', 'yit'),
            			'type' => 'text', 
            			'std'  => '#'
            		),
            		'target' => array(
            			'title' => __('Target', 'yit'),
            			'type' => 'select',
            			'options' => array(
							'' => __('Default', 'yit'),
							'_blank' => __('Blank', 'yit'),
							'_parent' => __('Parent', 'yit'),
							'_top' => __('Top', 'yit')						
						),
            			'std'  => ''
            		),
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		)
            	)
            ),
        /* === RANDOM NUMBERS === */
        'random_numbers' => array(
        	'title' => __('Random numbers', 'yit' ),
        	'description' =>  __('Show a icon with a block text', 'yit' ),
        	'tab' => 'shortcodes',
            'has_content' => false,
        	'attributes' => array(
        		'icon' => array(
        			'title' => __('Icon URL', 'yit'),
            		'type' => 'text', 
        			'std'  => ''
        		),
        		'text' => array(
        			'title' => __('Text', 'yit'),
            		'type' => 'text', 
        			'std'  => ''
        		),
        		'number' => array(
        			'title' => __('Number', 'yit'),
            		'type' => 'text', 
        			'std'  => ''
        		),
        		'last' => array(
        			'title' => __('Last element', 'yit'),
        			'type' => 'checkbox',
        			'std'  => 'no'
        		)    		
        	)
        ),
        /* === BOX TITLE === */
        'box_title' => array(
        	'title' => __('Box title', 'yit' ),
        	'description' =>  __('Show a title centered with line', 'yit' ),
        	'tab' => 'shortcodes',
            'has_content' => true,
        	'attributes' => array(
        	)
        ),
        /* === FAQ === */        
        'faq' => array(
           	'title' => __('FAQ', 'yit' ),
        	'description' =>  __('Show a Frequently Asked Questions', 'yit' ),
        	'tab' => 'cpt',
            'has_content' => false,
        	'attributes' => array(
        		'filter' => array(
        			'title' => __('Filterable', 'yit'),
        			'type' => 'checkbox',        			
        			'std'  => 'yes'
        		),
        		'category' => array(
        			'title' => __('Category', 'yit'),
        			'type' => 'checklist',
					'options' => $faq_categories,
        			'std'  => ''
        		),
        	)
         ),
         /* === CREDIT CARD === */
         'credit_card' => array(
           	'title' => __('Credit card', 'yit' ),
        	'description' =>  __('Show an images of credit cards', 'yit' ),
        	'tab' => 'shortcodes',
            'has_content' => false,
        	'attributes' => array(
        		'type' => array(
        			'title' => __('Type', 'yit'),
        			'type' => 'checklist',        			
        			'options'  => array(
						'amazon' => 'Amazon',
						'amex' => 'American Express',
						'amex_gold' => 'American Express Gold',
						'amex_green' => 'American Express Green',
						'amex_silver' => 'American Express Silver',
						'apple' => 'Apple',
						'bank' => 'Bank',
						'cash' => 'Cash',
						'chase' => 'Chase',
						'coupon' => 'Coupon',
						'credit' => 'Credit',
						'debit' => 'Debit',
						'discover' => 'Discover',
						'discover_novus' => 'Discover Novus',
						'echeck' => 'eCheck',
						'generic_1' => 'Generic 1',
						'generic_2' => 'Generic 2',
						'generic_3' => 'Generic 3',
						'gift' => 'Gift',
						'gold' => 'Gold',
						'googleckout' => 'Google Checkout',
						'itunes' => 'iTunes (red)',
						'itunes_2' => 'iTunes (blue)',
						'itunes_3' => 'iTunes (green)',
						'mastercard' => 'Mastercard',
						'mileage' => 'Mileage',
						'paypal' => 'PayPal',
						'sapphire' => 'Sapphire',
						'solo' => 'Solo',
						'visa' => 'Visa'
					),
					'std' => 'generic_1'
        		),
        	)
         ),
         /* === CALL TO ACTION 3 === */
         'call_three' => array(
           	'title' => __('Call to action newsletter', 'yit' ),
        	'description' =>  __('Show a message with newsletter subscription', 'yit' ),
        	'tab' => 'shortcodes',
        	'has_content' => false,
        	'attributes' => array(
        		'title' => array(
        			'title' => __('Title', 'yit'),
        			'type' => 'text',
        			'std'  => ''
        		),
        		'incipit' => array(
        			'title' => __('Incipit', 'yit'),
        			'type' => 'text',
        			'std'  => ''
        		),
        		'email' => array(
        			'title' => __('E-mail', 'yit'),
        			'type' => 'text',
        			'std'  => ''
        		),
        		'email_label' => array(
        			'title' => __('E-mail label', 'yit'),
        			'type' => 'text', 
        			'std'  => 'your e-mail'
        		),		
        		'submit' => array(
        			'title' => __('Button text', 'yit'),
        			'type' => 'text',
        			'std'  => ''
        		),
        		'action' => array(
        			'title' => __('Action URL', 'yit'),
        			'type' => 'text', 
        			'std'  => ''
        		),
        		'hidden_fields' => array(
        			'title' => __('Hidden fields', 'yit'),
        			'type' => 'text', 
        			'std'  => ''
        		),
        		'method' => array(
        			'title' => __('Method', 'yit'),
        			'type' => 'select', // post|get 
        			'options' => array(
						'post' => __('POST', 'yit'),
						'get' => __('GET', 'yit')							
					),
        			'std'  => 'post'
        		)
        	)
         ),
         'logo' => array(
           	'title' => __('Logo font', 'yit' ),
        	'description' =>  __('Show a text with logo style', 'yit' ),
        	'tab' => 'shortcodes',
        	'has_content' => true,
        	'attributes' => array(
        		'size' => array(
        			'title' => __('Size of text', 'yit'),
        			'type' => 'number',
        			'std'  => '44'
        		),
        		'unit' => array(
        			'title' => __('Unit', 'yit'),
        			'type' => 'select',
        			'options' => array(
						'px' => 'px',
						'em' => 'em',
						'%' => '%'
					),
        			'std'  => 'px'
        		),
        		'color' => array(
        			'title' => __('Color', 'yit'),
        			'type' => 'colorpicker',
        			'std'  => '#b6b6b7'
        		)
        	)
         ),
        'sitemap' => array(
            'title' => __('Sitemap', 'yit' ),
            'description' =>  __('The sitemap can be configured in Theme Options settings.', 'yit' ),
            'tab' => 'shortcodes',
            'has_content' => false,
            'multiple' => false,
            'unlimited'   => false,
            'attributes' => array(
                'title' => array(
                    'title' => __('Title', 'yit'),
                    'type' => 'text',
                    'std'  => ''
                )
            )
        ),
         /* === HIDE FOR THIS THEME === */
         'label' => array(
            'hide' => true,
         )
	));
}
add_filter( 'yit_add_shortcodes', 'yit_add_shortcodes' );

add_action('wp_enqueue_scripts', 'add_shortcodes_theme_css');

if( !function_exists( 'add_shortcodes_theme_css' ) ) {
	/*
	 * Add style of widgets in theme
	 */
	function add_shortcodes_theme_css(){
		$url = YIT_THEME_ASSETS_URL . '/css/shortcodes.css';
	    //wp_register_style('shortcodes_theme_css', $url);
	    yit_wp_enqueue_style(1201, 'shortcodes_theme_css', $url);	
	}
}

function yit_get_faq_categories(){
	global $wpdb, $blog_id, $current_blog;
	
	wp_reset_query();
	$terms = $wpdb->get_results('SELECT name, ' . $wpdb->prefix . 'terms.term_id FROM ' . $wpdb->prefix . 'terms, ' . $wpdb->prefix . 'term_taxonomy WHERE ' . $wpdb->prefix . 'terms.term_id = ' . $wpdb->prefix . 'term_taxonomy.term_id AND taxonomy = "category-faq" ORDER BY name ASC;');
	
	$categories = array();
	$categories['0'] = __('All categories', 'yit');
	if ($terms) :
		foreach ($terms as $cat) : 
			$categories[$cat->term_id] = ($cat->name) ? $cat->name : 'ID: '. $cat->term_id;
		endforeach;
	endif;
	return $categories;		
}

function yit_get_testimonial_categories(){
	global $wpdb, $blog_id, $current_blog;
	
	wp_reset_query();
	$terms = $wpdb->get_results('SELECT name, ' . $wpdb->prefix . 'terms.term_id FROM ' . $wpdb->prefix . 'terms, ' . $wpdb->prefix . 'term_taxonomy WHERE ' . $wpdb->prefix . 'terms.term_id = ' . $wpdb->prefix . 'term_taxonomy.term_id AND taxonomy = "category-testimonial" ORDER BY name ASC;');
	
	$categories = array();
	$categories['0'] = __('All categories', 'yit');
	if ($terms) :
		foreach ($terms as $cat) : 
			$categories[$cat->term_id] = ($cat->name) ? $cat->name : 'ID: '. $cat->term_id;
		endforeach;
	endif;
	return $categories;		
}