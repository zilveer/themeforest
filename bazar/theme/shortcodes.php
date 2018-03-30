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
	/** Edit attributes in existing shortcodes */
	unset($shortcodes['section_blog']['attributes']['other_posts_label']);
    unset($shortcodes['section_services']['attributes']['show_detail_hover']);
	unset($shortcodes['section_services']['attributes']['show_title_hover']);
	
	unset($shortcodes['recentpost']['attributes']['date']);
	unset($shortcodes['recentpost']['attributes']['excerpt_length']);
	unset($shortcodes['recentpost']['attributes']['readmore']);
	
	$shortcodes['recentpost']['attributes']['date'] = array(
		'title' => __('Show date', 'yit'),
		'type' => 'checkbox',		
        'std' => 'yes'
	);
	
	unset($shortcodes['popularpost']['attributes']['date']);
	unset($shortcodes['popularpost']['attributes']['excerpt_length']);
	unset($shortcodes['popularpost']['attributes']['readmore']);
	
	$shortcodes['popularpost']['attributes']['date'] = array(
		'title' => __('Show date', 'yit'),
		'type' => 'checkbox',		
        'std' => 'yes'
	);
	
	$shortcodes['section']['attributes']['items_per_row'] = array(
		'title' => __('Items per row', 'yit'),
		'type' => 'select',
		'options' => array(
		   '2' => __('2 items', 'yit'),
		   '3' => __('3 items', 'yit'),
		   '4' => __('4 items', 'yit'),
		   '6' => __('6 items', 'yit')
		  ),
        'std' => '4'
	);
	
	$shortcodes['section']['attributes']['show_services_button'] = array(
		'title' => __('Show Button', 'yit'),
		'type' => 'checkbox',
        'std' => 'yes'
	);
	
	$shortcodes['section']['attributes']['services_button_text'] = array(
		'title' => __('Button Text', 'yit'),
		'type' => 'text',
        'std' => 'Read More'
	);
	
	$shortcodes['section_services']['attributes']['services_style'] = array(
		'title' => __('Style', 'yit'),
		'type' => 'select',
		'options' => array(
			'circle' => __('Circle', 'yit'),
			'bandw' => __('Black &amp; White', 'yit'),
		),
		'std'  => 'circle'
	);
	
	$shortcodes['section']['attributes']['services_style'] = array(
	  'title' => __('Style', 'yit'),
	  'type' => 'select',
	  'options' => array(
	   '' => __('Select an option', 'yit'),
	   'circle' => __('Circle', 'yit'),
	   'bandw' => __('Black &amp; White', 'yit'),
	  ),
	  'std'  => 'circle'
	 );
	
	$shortcodes['section_services']['attributes']['items_per_row'] = array(
		'title' => __('Items per row', 'yit'),
		'type' => 'select',
		'options' => array(
		   '2' => __('2 items', 'yit'),
		   '3' => __('3 items', 'yit'),
		   '4' => __('4 items', 'yit'),
		   '6' => __('6 items', 'yit')
		  ),
        'std' => '4'
	);
	
	$shortcodes['section_services']['attributes']['show_detail_hover'] = array(
		'title' => __('Show detail (Circle)', 'yit'),
		'type' => 'checkbox',
        'std' => 'yes'
	);
	
	$shortcodes['section_services']['attributes']['show_title_hover'] = array(
		'title' => __('Show title (Circle)', 'yit'),
		'type' => 'checkbox',
        'std' => 'yes'
	);

	$shortcodes['section_services']['attributes']['show_services_button'] = array(
		'title' => __('Show Button (B.&amp;W.)', 'yit'),
		'type' => 'checkbox',
        'std' => 'yes'
	);
	
	$shortcodes['section_services']['attributes']['services_button_text'] = array(
		'title' => __('Button Text (B.&amp;W.)', 'yit'),
		'type' => 'text',
        'std' => 'Read More'
	);
	
	$shortcodes['section']['attributes']['portfolio_style'] = array(
            			'title' => __('Style', 'yit'),
            			'type' => 'select',
            			'options' => array(
							'' => __('Select an option', 'yit'),
							'slider' => __('Slider', 'yit'),
						),
            			'std'  => 'slider'
    );
	$shortcodes['section_portfolio']['attributes'] = array(
        'items' => array(
			'title' => __('N. of items', 'yit'),
            'description' => __('Show all with -1', 'yit'),
            'type' => 'number',
            'std' => '-1'
        ),
        'title' => array(
        	'title' => __('Title', 'yit'),
            'type' => 'text',
            'std' => ''
        ),
        'description' => array(
        	'title' => __('Description', 'yit'),
            'type' => 'text',
            'std' => ''
        ),
        'portfolio' => array(
        	'title' => __('Portfolio', 'yit'),
            'type' => 'select',
            'options' => yit_get_model('shortcodes')->get_portfolios(),
            'std' => ''
        ),
 		'show_lightbox_hover' => array(
            'title' => __('Show lightbox hover', 'yit'),
            'type' => 'checkbox',
            'std' => 'no'
        ),
		'portfolio_style'=> array(
        	'title' => __('Style', 'yit'),
            'type' => 'select',
            'options' => array(
				'classic' => __('Classic', 'yit'),
				'slider' => __('Slider', 'yit'),
			),
            'std'  => 'classic'
    	),
    );
	
    $shortcodes['section']['attributes']['show_author'] = array(
            			'title' => __('Show author', 'yit'),
            			'type' => 'checkbox',
            			'std'  => 'yes'
    );
	$shortcodes['section_blog']['attributes']['show_author'] = array(
            			'title' => __('Show author', 'yit'),
            			'type' => 'checkbox',
            			'std'  => 'yes'
    );
    $shortcodes['section_blog']['attributes']['show_featured_image'] = array(
        'title' => __('Show featured image (for sticky posts)', 'yit'),
        'type' => 'checkbox',
        'std'  => 'yes'
    );

	/** Adding Icon Type to share **/
	$shortcodes['share']['attributes']['icon_type'] = array(
				 		'title' => __('Icon Type', 'yit'),
						'type' => 'select',
						'options' => array(
							'default' => __('Simple', 'yit'),
							'fade' => __('Round', 'yit'),
							'square' => __('Square', 'yit'),
						),
						'std'  => 'rounded'
    );
	
	/** Team/accordion **/
	$shortcodes['team']['attributes']['style'] = array(
				 		'title' => __('Style', 'yit'),
						'type' => 'select',
						'options' => array(
							//'accordion' => __('Accordion', 'yit'),
							'professional' => __('Professional', 'yit'),
							//'rounded' => __('Round and Fade', 'yit'),
							//'squared' => __('Squared', 'yit')
						),
						'std'  => 'professional',
    );
	/* ***** SQUARED (RUMBLE) STYLE *****
	
	$shortcodes['team']['attributes']['sqrcols'] = array(
				 		'title' => __('Squared columns', 'yit'),
						'type' => 'text',
						'std'  => 'auto'
    );
	$shortcodes['team']['attributes']['sqrsize'] = array(
				 		'title' => __('Squared box size', 'yit'),
						'type' => 'text',
						'std'  => '0.974'
    );
	$shortcodes['team']['attributes']['sqrxoom'] = array(
				 		'title' => __('Squared zoom', 'yit'),
						'type' => 'text',
						'std'  => '1.5'
    );
	$shortcodes['team']['attributes']['sqrslow'] = array(
				 		'title' => __('Squared slowness', 'yit'),
						'type' => 'text',
						'std'  => '150'
    );
	*/
	
	$faq_categories = yit_get_faq_categories();
    return array_merge( $shortcodes, array(
		/* === TESTIMONIALS === */
		'testimonials' => array(
			'title' => __('Testimonials', 'yit' ),
			'description' => __('Show all post on testimonials post types', 'yit' ),
			'tab' => 'cpt',
            'has_content' => false,
			'attributes' => array(
				'items' => array(
					'title' => __('N. of items', 'yit'),
					'description' => __('Show all with -1', 'yit'),
            		'type' => 'number', 
					'std'  => '-1'
				),
				'style' => array(
					'title' => __('Style', 'yit'),
            		'type' => 'select',
					'options' => array(
						'square-style' => __('Square Style', 'yit'),
						'quote-style' => __('Quote Style', 'yit'),
						'circle-style' => __('Circle Style', 'yit'),
						'bazar-style' => __('Bazar Style', 'yit'),
					),
					'std'  => 'square-style'
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
		/* === SOCIAL === */
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
                            'instagram' => __('Instagram', 'yit'),
                            'google' => __('Google Plus', 'yit'),
                            'youtube' => __('Youtube', 'yit'),
                            'bookmark' => __('Bookmark', 'yit'),
                            'mail' => __('Mail', 'yit'),
                            'vimeo' => __('Vimeo', 'yit'),
                            'vine' => __('Vine', 'yit'),
                        ),
            			'std'  => ''
            		),
            		'icon_type' => array(
            			'title' => __('Icon Type', 'yit'),
            			'type' => 'select',
            			'options' => array(
							'default' => __('Default', 'yit'),
							'fade' => __('Round and Fade', 'yit'),
							'square' => __('Square', 'yit'),
						),
            			'std'  => 'default'
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
         'numbers_sections' => array(
           	'title' => __('Numbers sections', 'yit' ),
        	'description' =>  __('Show a number background with a title and text', 'yit' ),
        	'tab' => 'shortcodes',
        	'has_content' => true,
        	'attributes' => array(
        		'number' => array(
        			'title' => __('Number', 'yit'),
        			'type' => 'number',
        			'std'  => '1'
        		),
        		'title' => array(
        			'title' => __('Title', 'yit'),
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
         'box_service' => array(
           	'title' => __('Box service', 'yit' ),
        	'description' =>  __('Show a box with services style', 'yit' ),
        	'tab' => 'shortcodes',
        	'has_content' => true,
        	'attributes' => array(
        		'title' => array(
        			'title' => __('Title', 'yit'),
        			'type' => 'text',
        			'std'  => ''
        		),
        		'url' => array(
        			'title' => __('URL', 'yit'),
        			'type' => 'text',
        			'std'  => 'http://'
        		),
        		'img' => array(
        			'title' => __('Image URL', 'yit'),
        			'type' => 'text',
        			'std'  => 'http://'
        		),
        		/*
        		'last' => array(
        			'title' => __('Last element', 'yit'),
        			'type' => 'checkbox',
        			'std'  => 'no'
        		),
				*/
        		'show_title' => array(
					'title' => __('Show Title', 'yit'),
        			'type' => 'checkbox',
        			'std'  => 'yes'
				),
        		'show_content' => array(
					'title' => __('Show Content', 'yit'),
        			'type' => 'checkbox',
        			'std'  => 'yes'
				),
        		'show_services_button' => array(
					'title' => __('Show Button', 'yit'),
        			'type' => 'checkbox',
        			'std'  => 'yes'
				),
        		'services_button_text' => array(
					'title' => __('Button Text', 'yit'),
        			'type' => 'text',
        			'std'  => 'Read More'
				)
        	)
         ),
         'grid' => array(
           	'title' => __('Grid', 'yit' ),
        	'description' =>  __('Use the grid for the responsive', 'yit' ),
        	'tab' => 'shortcodes',
        	'has_content' => true,
        	'attributes' => array(
        		'first' => array(
        			'title' => __('First', 'yit'),
        			'type' => 'checkbox',
        			'std'  => 'no'
        		),
				'last' => array(
        			'title' => __('Last', 'yit'),
        			'type' => 'checkbox',
        			'std'  => 'no'
        		),
        		'columns' => array(
        			'title' => __('Columns', 'yit'),
        			'description' => __('value between 1 and 12', 'yit'),
        			'type' => 'number',
        			'std'  => '1',
					'min'  => '1',
					'max'  => '12',
        		)
        	)
         ),
         'icon_list' => array(
           	'title' => __('Icon list', 'yit' ),
        	'description' =>  __('Use a list with an icon', 'yit' ),
        	'tab' => 'shortcodes',
        	'has_content' => false,
        	'multiple' => true,
        	'unlimited'   => true,
        	'attributes' => array(
        		'title' => array(
        			'title' => __('Title', 'yit'),
        			'type' => 'text',
        			'std'  => ''
        		),
        		'last' => array(
        			'title' => __('Last element', 'yit'),
        			'type' => 'checkbox',
        			'std'  => 'no'
        		),    
        		'icon_1' => array(
        			'title' => __('Icon', 'yit'),
        			'type' => 'select',
        			'options' => yit_get_model('shortcodes')->get_awesome_icons(),
        			'std'  => '',
        			'multiple' => true
        		),
        		'icon_url_1' => array(
        			'title' => __('Icon url', 'yit'),
        			'type' => 'text',
        			'std'  => '',
        			'multiple' => true
        		),
        		'item_1' => array(
        			'title' => __('Item', 'yit'),
        			'type' => 'text',
        			'std'  => '',
        			'multiple' => true
        		),
        		'item_link_1' => array(
        			'title' => __('Item link', 'yit'),
        			'type' => 'text',
        			'std'  => '',
        			'multiple' => true
        		),
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
	$terms = $wpdb->get_results( "SELECT name, t.term_id FROM $wpdb->terms AS t, $wpdb->term_taxonomy AS tt WHERE t.term_id = tt.term_id AND taxonomy = 'category-faq' ORDER BY name ASC" );
	
	$categories = array();
	$categories['0'] = __('All categories', 'yit');
	if ($terms) :
		foreach ($terms as $cat) : 
			$categories[$cat->term_id] = ($cat->name) ? $cat->name : 'ID: '. $cat->term_id;
		endforeach;
	endif;
	return $categories;		
}