<?php          
/**
 * Configuration of all colors customizable. Follow the default scheme already written.
 * Replace all string uppercased.
 * 
 * This add automatically the options on Theme Options and generate the custom css
 * with all colors set by user, including it on theme.    
 * 
 * @package WordPress
 * @subpackage Kassyopea
 * @since 1.0 
 */   

//array of all colors customizable by user
$yiw_colors = array(
	'general' => array(    
		'name-section' => __( 'General', 'yiw' ),   
		'options' => array(
	
			'general-color-titles' => array(    
				'default' => '#232221',
				'css_role' => 'h1, h2, h3, h4, h5, h6', 
				'css_attr' => 'color', 
				'panel_title' => __( "Titles color", 'yiw' ),  
				'panel_desc' => __( "Select the text color of all titles.", 'yiw' ) 
			),
	
			'general-color-text' => array(    
				'default' => '#5e6060',
				'css_role' => 'p, li, address', 
				'css_attr' => 'color', 
				'panel_title' => __( "Text color", 'yiw' ),  
				'panel_desc' => __( "Select the text color of all titles.", 'yiw' ) 
			),
	
			'general-color-links' => array(    
				'default' => '#D77002',
				'css_role' => 'a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Links color", 'yiw' ),  
				'panel_desc' => __( "Select the general color of all links.", 'yiw' ) 
			),
	
			'general-color-links-hover' => array(    
				'default' => '#000',
				'css_role' => 'a:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Links color hover", 'yiw' ),  
				'panel_desc' => __( "Select the general color of all links, in hover state.", 'yiw' ) 
			),
	
			'general-color-slogan-title' => array(    
				'default' => '#1F1D1B',
				'css_role' => '#slogan h1', 
				'css_attr' => 'color', 
				'panel_title' => __( "Slogan title", 'yiw' ),  
				'panel_desc' => __( "Select the text color of the slogan title.", 'yiw' ) 
			),
	
			'general-color-slogan-subtitle' => array(    
				'default' => '#1F1D1B',
				'css_role' => '#slogan h2', 
				'css_attr' => 'color', 
				'panel_title' => __( "Slogan subtitle", 'yiw' ),  
				'panel_desc' => __( "Select the text color of the slogan subtitle.", 'yiw' ) 
			),
		
		),
		
	),
	
	'header' => array(    
		'name-section' => __( 'Header', 'yiw' ),   
		'options' => array(
	
			'header-logo-text' => array(    
				'default' => '#fff',
				'css_role' => '#logo .logo-title', 
				'css_attr' => 'color', 
				'panel_title' => __( "Text logo", 'yiw' ),  
				'panel_desc' => __( "The color of logo text, when is the title of wp.", 'yiw' ) 
			),
	
			'header-logo-tagline' => array(    
				'default' => '#fff',
				'css_role' => '#logo .logo-description', 
				'css_attr' => 'color', 
				'panel_title' => __( "Tagline logo", 'yiw' ),  
				'panel_desc' => __( "The color of the logo tagline.", 'yiw' ) 
			),
	
			'header-links' => array(    
				'default' => '#fff',
				'css_role' => '#linksbar li, #linksbar li a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Header links", 'yiw' ),  
				'panel_desc' => __( "The color of the links of header.", 'yiw' ) 
			),
	
			'header-links-hover' => array(    
				'default' => '#b9b8b8',
				'css_role' => '#linksbar li a:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Header links hover", 'yiw' ),  
				'panel_desc' => __( "The color of the links, in hover state, of header.", 'yiw' ) 
			),
	
			'header-searchform-text' => array(    
				'default' => '#fff',
				'css_role' => '#header #s, #header #searchsubmit, #header #searchform .screen-reader-text', 
				'css_attr' => 'color', 
				'panel_title' => __( "Text of search form", 'yiw' ),  
				'panel_desc' => __( "The color of the text on search form.", 'yiw' ) 
			),  
		
		),
		
	),
	
	'elegant-navigation' => array(    
		'name-section' => __( 'Navigation', 'yiw' ),   
		'options' => array(
	
			'elegant-navigation-links' => array(    
				'default' => '#fff',
				'css_role' => '#nav.elegant ul li a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Navigation links", 'yiw' ),  
				'panel_desc' => __( "The color of the navigation links.", 'yiw' ) 
			),  
	
			'elegant-navigation-links-hover' => array(    
				'default' => '#b9b8b8',
				'css_role' => '#nav.elegant ul li a:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Navigation hover links", 'yiw' ),  
				'panel_desc' => __( "The hover color of the navigation links.", 'yiw' ) 
			),    
	
			'elegant-dropdown-links' => array(    
				'default' => '#fff',
				'css_role' => '#nav.elegant ul.sub-menu li a, #nav.elegant ul.children li a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Dropdown links", 'yiw' ),  
				'panel_desc' => __( "The color of the dropdown links.", 'yiw' ) 
			),    
	
			'elegant-dropdown-links-hover' => array(    
				'default' => '#b9b8b8',
				'css_role' => '#nav.elegant ul.sub-menu li a:hover, #nav.elegant ul.children li a:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Dropdown hover links", 'yiw' ),  
				'panel_desc' => __( "The hover color of the dropdown links.", 'yiw' ) 
			),    
	
			'elegant-dropdown-bg' => array(    
				'default' => '#363636',
				'css_role' => '#nav.elegant ul.sub-menu, #nav.elegant ul.children', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Dropdown bg", 'yiw' ),  
				'panel_desc' => __( "The background color of the dropdown.", 'yiw' ) 
			),    
	
			'elegant-megamenu-border' => array(    
				'default' => '#525252',
				'css_role' => '#nav.elegant .megamenu ul.sub-menu li', 
				'css_attr' => 'border-left-color', 
				'panel_title' => __( "Megamenu border", 'yiw' ),  
				'panel_desc' => __( "The border color of the columns on megamenu.", 'yiw' ) 
			),    
	
			'elegant-dropdown-bg-hover' => array(    
				'default' => '#b9b8b8',
				'css_role' => '#nav.elegant ul.sub-menu li:hover, #nav.elegant ul.children li:hover, #nav.elegant .megamenu ul.sub-menu li ul li:hover', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Dropdown bg hover", 'yiw' ),  
				'panel_desc' => __( "The background color on hover of the dropdown items.", 'yiw' ) 
			),   
	
			'elegant-megamenu-title' => array(    
				'default' => '#fff',
				'css_role' => '#nav.elegant .megamenu > ul.sub-menu > li > a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Megamenu Title", 'yiw' ),  
				'panel_desc' => __( "The color of the titles in megamenu.", 'yiw' ) 
			),   
		
		),
		
	),
	
	'creative-navigation' => array(    
		'name-section' => __( 'Navigation', 'yiw' ),   
		'options' => array(
	
			'creative-navigation-links' => array(    
				'default' => '#000',
				'css_role' => '#nav.creative ul li a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Navigation links", 'yiw' ),  
				'panel_desc' => __( "The color of the navigation links.", 'yiw' ) 
			),  
	
			'creative-navigation-links-hover' => array(    
				'default' => '#000',
				'css_role' => '#nav.creative ul li a:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Navigation hover links", 'yiw' ),  
				'panel_desc' => __( "The hover color of the navigation links.", 'yiw' ) 
			),    
	
			'creative-navigation-tab-inactive' => array(    
				'default' => '#DDDADA',
				'css_role' => '#nav.creative li a', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Navigation tab inactive", 'yiw' ),  
				'panel_desc' => __( "The background colors of the tab inactive.", 'yiw' ) 
			),    
	
			'creative-navigation-tab-active' => array(    
				'default' => '#fff',
				'css_role' => '#nav.creative li.current-menu-item a, #nav.creative li.current-menu-parent a, #nav.creative li.current-page-parent a, #nav.creative li.current-page-ancestor a, #nav.creative li.current-menu-ancestor a', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Navigation tab active", 'yiw' ),  
				'panel_desc' => __( "The background colors of the tab active.", 'yiw' ) 
			),   
	
			'creative-navigation-tab-hover' => array(    
				'default' => '#c3c1c1',
				'css_role' => '#nav.creative li:hover a, #nav.creative ul.sub-menu, #nav.creative ul.children', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Navigation tab hover", 'yiw' ),  
				'panel_desc' => __( "The background colors of the tab hover and for the background of dropdown.", 'yiw' ) 
			),    
	
			'creative-dropdown-links' => array(    
				'default' => '#514E4E',
				'css_role' => '#nav.creative ul.sub-menu li a, #nav.creative ul.children li a, #nav.creative .megamenu ul.sub-menu li ul li a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Dropdown links", 'yiw' ),  
				'panel_desc' => __( "The color of the dropdown links.", 'yiw' ) 
			),    
	
			'creative-dropdown-links-hover' => array(    
				'default' => '#514E4E',
				'css_role' => '#nav.creative ul.sub-menu li a:hover, #nav.creative ul.children li a:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Dropdown hover links", 'yiw' ),  
				'panel_desc' => __( "The hover color of the dropdown links.", 'yiw' ) 
			),    
	
			'creative-megamenu-border' => array(    
				'default' => '#A8A6A6',
				'css_role' => '#nav.creative .megamenu ul.sub-menu li', 
				'css_attr' => 'border-left-color', 
				'panel_title' => __( "Megamenu border", 'yiw' ),  
				'panel_desc' => __( "The border color of the columns on megamenu.", 'yiw' ) 
			),    
	
			'creative-dropdown-bg-hover' => array(    
				'default' => '#CECDCD',
				'css_role' => '#nav.creative ul.sub-menu li a:hover, #nav.creative ul.children li a:hover', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Dropdown bg hover", 'yiw' ),  
				'panel_desc' => __( "The background color on hover of the dropdown items.", 'yiw' ) 
			),   
	
			'creative-megamenu-title' => array(    
				'default' => '#0A4066',
				'css_role' => '#nav.creative .megamenu ul.sub-menu li > a, #nav.creative .megamenu ul.children li > a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Megamenu Title", 'yiw' ),  
				'panel_desc' => __( "The color of the titles in megamenu.", 'yiw' ) 
			),   
		
		),
		
	),
	
	'store-products' => array(    
		'name-section' => __( 'Store list products', 'yiw' ),   
		'options' => array(
	
			'store-products-offer-text' => array(    
				'default' => '#fff',
				'css_role' => 'span.onsale', 
				'css_attr' => 'color', 
				'panel_title' => __( "On sale text color", 'yiw' ),  
				'panel_desc' => __( 'Select the text color of the "On Sale" baloon.', 'yiw' ) 
			),
	
			'store-products-offer-bg' => array(    
				'default' => '#b9b701',
				'css_role' => 'span.onsale', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "On sale background color", 'yiw' ),  
				'panel_desc' => __( 'Select the background color of the "On Sale" baloon.', 'yiw' ) 
			),                 
	
			'store-products-label-products-bg' => array(    
				'default' => '#000',
				'css_role' => '.products li a strong', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Label products item background", 'yiw' ),  
				'panel_desc' => __( 'The background color of the label inside the thumbnails of products.', 'yiw' ) 
			),             
	
			'store-products-label-products-text' => array(    
				'default' => '#fff',
				'css_role' => '.products li a strong', 
				'css_attr' => 'color', 
				'panel_title' => __( "Label products item text", 'yiw' ),  
				'panel_desc' => __( 'The text color of the label inside the thumbnails of products.', 'yiw' ) 
			),          
	
			'store-products-button-add-to-cart-bg' => array(    
				'default' => '#6B90A9',
				'css_role' => '.products li .buttons a.add-to-cart', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Button add to cart background", 'yiw' ),  
				'panel_desc' => __( 'The button for purchase on list products.', 'yiw' ) 
			),       
	
			'store-products-button-details-bg' => array(    
				'default' => '#535353',
				'css_role' => '.products li .buttons a.details', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Button details background", 'yiw' ),  
				'panel_desc' => __( 'The button for product details on list products.', 'yiw' ) 
			),     
	
			'store-products-button-add-to-cart-text' => array(    
				'default' => '#fff',
				'css_role' => '.products li .buttons a.add-to-cart', 
				'css_attr' => 'color', 
				'panel_title' => __( "Button add to cart text color", 'yiw' ),  
				'panel_desc' => __( 'The button for purchase on list products.', 'yiw' ) 
			),       
	
			'store-products-button-details-text' => array(    
				'default' => '#fff',
				'css_role' => '.products li .buttons a.details', 
				'css_attr' => 'color', 
				'panel_title' => __( "Button details text color", 'yiw' ),  
				'panel_desc' => __( 'The button for product details on list products.', 'yiw' ) 
			),              
	
			'store-products-button-add-to-cart-bg-hover' => array(    
				'default' => '#7aa5c2',
				'css_role' => '.products li .buttons a.add-to-cart:hover', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Button add to cart background hover", 'yiw' ),  
				'panel_desc' => __( 'The button for purchase on list products.', 'yiw' ) 
			),       
	
			'store-products-button-details-bg-hover' => array(    
				'default' => '#6b6b6b',
				'css_role' => '.products li .buttons a.details:hover', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Button details background hover", 'yiw' ),  
				'panel_desc' => __( 'The button for product details on list products.', 'yiw' ) 
			),     
	
			'store-products-button-add-to-cart-text-hover' => array(    
				'default' => '#fff',
				'css_role' => '.products li .buttons a.add-to-cart:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Button add to cart text color hover", 'yiw' ),  
				'panel_desc' => __( 'The button for purchase on list products.', 'yiw' ) 
			),       
	
			'store-products-button-details-text-hover' => array(    
				'default' => '#fff',
				'css_role' => '.products li .buttons a.details:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Button details text color hover", 'yiw' ),  
				'panel_desc' => __( 'The button for product details on list products.', 'yiw' ) 
			),     
		
		),
		
	),
	
	'store-single' => array(    
		'name-section' => __( 'Store product detail page', 'yiw' ),   
		'options' => array( 
	
			'store-single-price-card-bg' => array(    
				'default' => '#7FA92D',
				'roles' => array(
                    array(
                        'css_role' => 'div.product p.price', 
				        'css_attr' => 'background-color', 
                    ),
                    array(
                        'css_role' => 'div.product p.price:before', 
				        'css_attr' => 'border-left-color', 
                    ),
                ),
				'panel_title' => __( "Price background color", 'yiw' ),  
				'panel_desc' => __( 'Select the color of background color of the ticket of price, in the layout single product page.', 'yiw' ) 
			),  
	
			'store-single-price-card-text' => array(    
				'default' => '#fff',
				'css_role' => 'div.product p.price', 
				'css_attr' => 'color', 
				'panel_title' => __( "Price text color", 'yiw' ),  
				'panel_desc' => __( 'Select the color of text color of the ticket of price, in the layout single product page.', 'yiw' ) 
			),  
	
			'store-single-bg-color-add-cart' => array(    
				'default' => '#A1CB4F',
				'css_role' => 'a.button.checkout, .button-alt, .button.alt', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Background button Add to cart", 'yiw' ),  
				'panel_desc' => __( 'Select the background color of the "Add to cart" button.', 'yiw' ) 
			),
	
			'store-single-bg-color-add-cart-hover' => array(    
				'default' => '#b2dc60',
				'css_role' => 'a.button.checkout:hover, .button-alt:hover, .button.alt:hover, a.button:hover,button.button:hover,input.button:hover,#review_form #submit:hover', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Background button Add to cart on hover state", 'yiw' ),  
				'panel_desc' => __( 'Select the background color of the "Add to cart" button on hover state.', 'yiw' ) 
			),   
	
			'store-single-color-add-cart' => array(    
				'default' => '#194300',
				'css_role' => 'form.cart .button-alt, form.cart .button.alt', 
				'css_attr' => 'color', 
				'panel_title' => __( "Text color of Add to cart", 'yiw' ),  
				'panel_desc' => __( 'Select the text color of the "Add to cart" button.', 'yiw' ),
                'important' => true 
			),      
	
			'store-single-bg-border-add-cart' => array(    
				'default' => '#5D870B',
				'css_role' => 'a.button.checkout, .button-alt, .button.alt', 
				'css_attr' => 'border-color', 
				'panel_title' => __( "Button add to cart border", 'yiw' ),  
				'panel_desc' => __( 'Select the border color of the "Add to cart" button.', 'yiw' ) 
			),
		
		),
		
	),
	
	'newsletter-form' => array(    
		'name-section' => __( 'Newsletter Section', 'yiw' ),   
		'options' => array(
	
			'newsletter-bg-color' => array(    
				'default' => '#fff',
				'css_role' => '#newsletter-form', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Background of section", 'yiw' ),  
				'panel_desc' => __( "Select the background color of this section.", 'yiw' ) 
			),
	
			'newsletter-color-text' => array(    
				'default' => '#545252',
				'css_role' => '#newsletter-form p.description', 
				'css_attr' => 'color', 
				'panel_title' => __( "Text color of this section", 'yiw' ),  
				'panel_desc' => __( "Select the text color of this section.", 'yiw' ) 
			),
	
			'newsletter-bg-inputs' => array(    
				'default' => '#3B3C3E',
				'css_role' => '#newsletter-form .newsletter-section form ul li input.text-field', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Bg color inputs", 'yiw' ),  
				'panel_desc' => __( "Select the background color of the inputs of the form.", 'yiw' ) 
			),
	
			'newsletter-border-inputs' => array(    
				'default' => '#DDDDDD',
				'css_role' => '#newsletter-form .newsletter-section form ul li input.text-field', 
				'css_attr' => 'border-color', 
				'panel_title' => __( "Border color inputs", 'yiw' ),  
				'panel_desc' => __( "Select the border color of the inputs of the form.", 'yiw' ) 
			),
	
			'newsletter-text-labels' => array(    
				'default' => '#3B3C3E',
				'css_role' => '#newsletter-form .newsletter-section form ul li label, #newsletter-form .newsletter-section form ul li input.text-field', 
				'css_attr' => 'color', 
				'panel_title' => __( "Text color inputs", 'yiw' ),  
				'panel_desc' => __( "Select the text color of the inputs of the form.", 'yiw' ) 
			),
	
			'newsletter-bg-submit' => array(    
				'default' => '#3B3C3E',
				'css_role' => '#newsletter-form .newsletter-section form ul li input.submit-field', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Bg color submit", 'yiw' ),  
				'panel_desc' => __( "Select the background color of the submit of the form.", 'yiw' ) 
			),
	
			'newsletter-bg-submit-hover' => array(    
				'default' => '#3B3C3E',
				'css_role' => '#newsletter-form .newsletter-section form ul li input.submit-field:hover', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Bg color submit hover", 'yiw' ),  
				'panel_desc' => __( "Select the background color of the submit in hover state, of the form.", 'yiw' ) 
			),
	
			'newsletter-text-submit' => array(    
				'default' => '#FFF',
				'css_role' => '#newsletter-form .newsletter-section form ul li input.submit-field', 
				'css_attr' => 'color', 
				'panel_title' => __( "Text color submit", 'yiw' ),  
				'panel_desc' => __( "Select the text color of the submit of the form.", 'yiw' ) 
			),
		
		),
		
	),
	
	'footer' => array(    
		'name-section' => __( 'Footer', 'yiw' ),   
		'options' => array(
	
			'footer-bg-color' => array(    
				'default' => '#fff',
				'css_role' => '#footer', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Background color", 'yiw' ),  
				'panel_desc' => __( "The background of all section.", 'yiw' ) 
			),
	
			'footer-color-titles' => array(    
				'default' => '#000',
				'css_role' => '#footer h3', 
				'css_attr' => 'color', 
				'panel_title' => __( "Color titles", 'yiw' ),  
				'panel_desc' => __( "The color of all titles of the footer.", 'yiw' ) 
			),
	
			'footer-color-text' => array(    
				'default' => '#767778',
				'css_role' => '#footer p', 
				'css_attr' => 'color', 
				'panel_title' => __( "Color text", 'yiw' ),  
				'panel_desc' => __( "The color of text", 'yiw' ) 
			),
	
			'footer-color-links' => array(    
				'default' => '#414243',
				'css_role' => '#footer a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Color links", 'yiw' ),  
				'panel_desc' => __( "The color of all links, of the footer.", 'yiw' ),
                'important' => true  
			),
	
			'footer-color-links-hover' => array(    
				'default' => '#414243',
				'css_role' => '#footer a:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Color links hover", 'yiw' ),  
				'panel_desc' => __( "The color of all links in hover state, of the footer.", 'yiw' ),
                'important' => true    
			),
	
			'footer-color-menues-links' => array(    
				'default' => '#414243',
				'css_role' => '#footer .widget ul li a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Color links menues", 'yiw' ),  
				'panel_desc' => __( "The color of links of menues, of the footer.", 'yiw' ),
                'important' => true  
			),
	
			'footer-color-menues-links-hover' => array(    
				'default' => '#414243',
				'css_role' => '#footer .widget ul li a:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Color links menues hover", 'yiw' ),  
				'panel_desc' => __( "The color of links of menues in hover state, of the footer.", 'yiw' ),
                'important' => true   
			),     
	
			'footer-border' => array(    
				'default' => '#d1d2d2',
				'css_role' => '#footer .footer-sidebar, #copyright .inner', 
				'css_attr' => 'border-color', 
				'panel_title' => __( "Border footer", 'yiw' ),  
				'panel_desc' => __( "The border that divide footer sidebar from main section.", 'yiw' ) 
			),
		
		),
		
	),
	
	'copyright' => array(    
		'name-section' => __( 'Copyright', 'yiw' ),   
		'options' => array(
	
			'copyright-bg-color' => array(    
				'default' => '#fff',
				'css_role' => '#copyright', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Background color", 'yiw' ),  
				'panel_desc' => __( "Select the background color of the copyright section.", 'yiw' ) 
			),
	
			'copyright-text-color' => array(    
				'default' => '#3a3939',
				'css_role' => '#copyright p', 
				'css_attr' => 'color', 
				'panel_title' => __( "Text color", 'yiw' ),  
				'panel_desc' => __( "Select the text color of the copyright section.", 'yiw' ) 
			),
	
			'copyright-links-color' => array(    
				'default' => '#D77002',
				'css_role' => '#copyright a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Links color", 'yiw' ),  
				'panel_desc' => __( "Select the color of the links on the copyright section.", 'yiw' ) 
			),
	
			'copyright-links-color-hover' => array(    
				'default' => '#000',
				'css_role' => '#copyright a:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Links color hover", 'yiw' ),  
				'panel_desc' => __( "Select the color of the links, in state hover, on the copyright section.", 'yiw' ) 
			),
	
			'copyright-border-footer' => array(    
				'default' => '#d1d2d2',
				'css_role' => '#copyright .inner', 
				'css_attr' => 'border-top-color', 
				'panel_title' => __( "Border Top copyright", 'yiw' ),  
				'panel_desc' => __( "Select the color of top border of the copyright section.", 'yiw' ) 
			),
	
			'copyright-logo-color' => array(    
				'default' => '#a8a8a8',
				'css_role' => '.logo', 
				'css_attr' => 'color',
                'important' => true, 
				'panel_title' => __( "Footer logo color", 'yiw' ),  
				'panel_desc' => __( "The logo showed by the shortcode &#91;logo&#93;.", 'yiw' ) 
			),
		
		),
		
	),
);    
    
$default_images = array(
    'gradient-home-section'	=> "bg/gradient-home-section.png",
    'home-section-bg'		=> "bg/home-section-bg.png",     
    'pag-slider'			=> "bg/pag-slider.png",
    'logo'					=> "logo.png"
);

?>