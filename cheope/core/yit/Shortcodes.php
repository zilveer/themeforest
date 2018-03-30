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
 * Class to manage shortcodes
 * 
 * @since 1.0.0
 */
class YIT_Shortcodes {

	/**
	 * Shortcodes
	 * 
	 * The array is created by using the following rules:
	 * 
	 * [shortcode_name] => array(
	 *     [title] => 'title',
	 *     [description] => 'description',
	 *     [has_content] => true,
	 *     [attributes] => array(
	 *       [param1_name] => array(
	 *        'type' => 'param1_type',
	 * 		  'std'  => 'param1_std'
	 * 	    )
	 * 	    [param2_name] => array(
	 *        'type' => 'param2_type',
	 * 		  'std'  => 'param2_std'
	 * 	    )
	 *    )
	 * )
	 * 
	 * @var array
	 * 
	 */
	public $shortcodes = array();
	
	/**
	 * Constructor
	 * 
	 */
	public function __construct() {
		global $name_tab;
		$name_tab = apply_filters( 'yit_shortcodes_tabs', array(
			'shortcodes' => __('Shortcodes', 'yit'),
			'section' => __('Section', 'yit'),
			'cpt' => __('Post Type', 'yit')
		) );
	}
	
	
	/**
	 * Init
	 * 
	 */
	public function init() {
		add_action('wp_enqueue_scripts', array(&$this, 'add_shortcodes_css_js'));
		
		$categories = $this->yit_get_categories();
		$set_icons = $this->get_set_icons();
		$button_style = $this->get_button_style();
		$awesome_icons = $this->get_awesome_icons();
		
		$shortcodes = array(
            /* === BOX SECTION === */
            'box_section' => array(
            	'title' => __('Icon box', 'yit' ),
            	'description' =>  __('Shows a box, with Title and icons on left and a text of section (you can use HTML tags)', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'icon' => array(
            			'title' => __('Icon', 'yit'),
            			'type' => 'select', // list of icon in YIT/images/icons/set_icons (bag|box|calendar)
            			'options' => $set_icons,
            			'std'  => 'box'
            		),
            		'size' => array(
            			'title' => __('Icon size', 'yit'),
            			'type' => 'select', // 32 or 48
            			'options' => array(
            				'32' => '32',
							'48' => '48'
						),
            			'std'  => '32'
            		),
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text',
            			'std'  => 'the title'
            		),
            		'title_size' => array(
            			'title' => __('Title size', 'yit'),
            			'type' => 'select',
            			'options' => array(
            				'' => __('Default', 'yit'),
            				'h1' => __('h1', 'yit'),
            				'h2' => __('h2', 'yit'),
            				'h3' => __('h3', 'yit'),
            				'h4' => __('h4', 'yit'),
            				'h5' => __('h5', 'yit'),
            				'h6' => __('h6', 'yit')
						),
            			'std'  => ''
            		),
            		'class' => array(
            			'title' => __('CSS class', 'yit'),
            			'type' => 'text',
            			'std'  => 'box-sections'
            		),
            		/*'border' => array(
            			'title' => __('Border', 'yit'),
            			'type' => 'checkbox',
            			'std'  => 'no'
            		),*/
            		'link' => array(
            			'title' => __('Link', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'link_title' => array(
            			'title' => __('Link title', 'yit'),
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
            /* == BOX TEXT SECTION === */
            'section_text' => array(
            	'title' => __('Section text', 'yit' ),
            	'description' =>  __('Shows a box, with Title and icons on left and a text of section (you can use HTMl tags)', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(				
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text',
            			'std'  => 'the title'
            		),
            		'class' => array(
            			'title' => __('CSS class', 'yit'),
            			'type' => 'text',
            			'std'  => 'box-sections'
            		),
            		'last' => array(
            			'title' => __('Last element', 'yit'),
            			'type' => 'checkbox',
            			'std'  => 'no'
            		)
            	),
            	'hide' => true
            ),
            /* === SECTION CAPTION === */ //caption_text?
            'section_caption' => array(
            	'title' => __('Section caption', 'yit' ),
            	'description' =>  __('Show a box with a captions', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text',
            			'std'  => 'title'
            		)
            	),
            	'hide' => true
            ),
            /* === CAPTION TEXT === */
            'caption_text' => array(
            	'title' => __('Caption text', 'yit' ),
            	'description' =>  __('Show a text with a captions', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text',
            			'std'  => 'title'
            		)
            	),
            	'code' => '[section_caption title="title"]
            					[caption_text title="title-caption"]Your content[/caption_text]
            					[caption_text title="title-caption"]Your content[/caption_text]
            				[/section_caption]',
            	'hide' => true
            ),
            /* === SUCCESS BOX === */
            'success' => array(
            	'title' => __('Success box', 'yit' ),
            	'description' =>  __('Show an example of success box alert', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		
            	)
            ),
            /* === ARROW BOX === */
            'arrow' => array(
            	'title' => __('Arrow box', 'yit' ),
            	'description' =>  __('Show an example of box alert, with an arrow icon', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		
            	)
            ),
            /* === ALERT BOX === */
            'alert' => array(
            	'title' => __('Alert box', 'yit' ),
            	'description' =>  __('Show an alert box', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		
            	)
            ),
            /* === ERROR BOX === */
            'error' => array(
            	'title' => __('Error box', 'yit' ),
            	'description' =>  __('Show an error box', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		
            	)
            ),
            /* === NOTICE BOX === */
            'notice' => array(
            	'title' => __('Notice box', 'yit' ),
            	'description' =>  __('Show a notice box', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		
            	)
            ),
            /* === INFO BOX === */
            'info' => array(
            	'title' => __('Info box', 'yit' ),
            	'description' =>  __('Show an info box', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		
            	)
            ),
            /* === BUTTON === */
            /* === BUTTON === */
            'button' => array(
            	'title' => __('Button', 'yit' ),
            	'description' =>  __('Show a simple custom button', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
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
            		'color' => array(
            			'title' => __('Color', 'yit'),
            			'type' => 'select', // btn-view-over-the-town-1|btn-the-bizzniss-1|btn-french-1|ecc
            			'options' => $button_style,
            			'std'  => ''
            		),
            		'colorstart' => array(
            			'title' => __('Color start', 'yit'),
            			'type' => 'colorpicker',
            			'std'  => '#000000'
            		),
            		'colorend' => array(
            			'title' => __('Color end', 'yit'),
            			'type' => 'colorpicker',
            			'std'  => '#FFFFFF'
            		),
            		'align' => array(
            			'title' => __('Alignment', 'yit'),
            			'type' => 'select', // vertical|horizontal
            			'options' => array(
            				'vertical' => __('Vertical', 'yit'),
							'horizontal' => __('Horizontal', 'yit')
						),
            			'std'  => 'vertical'
            		),
            		'colortext' => array(
            			'title' => __('Color of text', 'yit'),
            			'type' => 'colorpicker',
            			'std'  => '#FFFFFF'
            		),
            		'width' => array(
            			'title' => __('Width', 'yit'),
            			'type' => 'select',  // large|normal|small|mini
            			'options' => array(
            				'large' => __('Large', 'yit'),
            				'normal' => __('Normal', 'yit'),
            				'small' => __('Small', 'yit'),
            				'mini' => __('Mini', 'yit')            				
						),
            			'std'  => 'normal'   
            		),
            		'icon' => array(
            			'title' => __('Icon', 'yit'),
            			'type' => 'select',  // home|file|time|ecc
            			'options' => $awesome_icons,
            			'std'  => ''
            		),
            		'icon_size' => array(
            			'title' => __('Icon size', 'yit'),
            			'type' => 'number', 
            			'std'  => '12'
            		),
            		'class' => array(
            			'title' => __('CSS class', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'force_style' => array(
						'hide' => true,
						'std' => '0'
					)
            	),
            	//'code' => '[button href="#" color="view-over-the-town-1" width="normal" icon="home" icon_size="12"]Your text[/button]'
            ),
            /* == BUTTON ICON === */
            'button_icon' => array(
            	'title' => __('Button icon', 'yit' ),
            	'description' =>  __('Show a simple custom button, with icon', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'href' => array(
            			'title' => __('URL', 'yit'),
            			'type' => 'text',
            			'std'  => '#'
            		),
            		'icon' => array(
            			'title' => __('Icon', 'yit'),
            			'type' => 'select', // arrow|arrow-left|calc|gift|offer|remove
            			'options' => array(
            				'arrow' => __('Arrow', 'yit'),
            				'arrow-left' => __('Arrow left', 'yit'),
            				'calc' => __('Calc', 'yit'),
            				'gift' => __('Gift', 'yit') ,
            				'offer' => __('Offer', 'yit'),
							'remove' => __('Remove', 'yit')            				
						),
            			'std'  => ''
            		),
            		'icon_path' => array(
            			'title' => __('Custom icon path', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'sense' => array(
            			'title' => __('Sense', 'yit'),
            			'type' => 'select', // rtl|ltr
            			'options' => array(
            				'rtl' => __('Right to left', 'yit'),
            				'ltr' => __('Left to right', 'yit')
						),
            			'std'  => 'ltr'
            		)
            	)
            ),
            /* === LIST BULLET === */
            'list_bullet' => array(
            	'title' => __('List bullet', 'yit' ),
            	'description' =>  __('Show a list with bullet', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'type' => array(
            			'title' => __('Type of bullet', 'yit'),
            			'type' => 'select', // star|arrow|check|add|info
            			'options' => array(
            				'star' => __('Star', 'yit'),
            				'arrow' => __('Arrow', 'yit'),
            				'check' => __('Check', 'yit'),
            				'add' => __('Add', 'yit'),
            				'info' => __('Info', 'yit')
						),
            			'std'  => 'star'
            		)			
            	)
            ),
            /* === ONE / FOURTH === */
            'one_fourth' => array(
            	'title' => __('1/4 Column', 'yit' ),
            	'description' =>  __('Create one column of a quarter', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'class' => array(
            			'title' => __('CSS class', 'yit'),
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
            /* === THREE / FOURTH === */
            'three_fourth' => array(
            	'title' => __('3/4 Column', 'yit' ),
            	'description' =>  __('Create three column of a quarter', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'class' => array(
            			'title' => __('CSS class', 'yit'),
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
            /* === ONE / THIRD === */
            'one_third' => array(
            	'title' => __('1/3 Column', 'yit' ),
            	'description' =>  __('Create one column of a third', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'class' => array(
            			'title' => __('CSS class', 'yit'),
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
            /* === TWO / THIRD === */
            'two_third' => array(
            	'title' => __('2/3 Column', 'yit' ),
            	'description' =>  __('Create a content in two column of a third', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'class' => array(
            			'title' => __('CSS class', 'yit'),
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
            /* === TWO / FOURTH === */
            'two_fourth' => array(
            	'title' => __('2/4 Column', 'yit' ),
            	'description' =>  __('Create a content in two column of a quarter', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'class' => array(
            			'title' => __('CSS class', 'yit'),
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
            /* === TABLE === */
            'table' => array(
            	'title' => __('Table', 'yit' ),
            	'description' =>  __('Create a table content', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'color' => array(
            			'title' => __('Border Color', 'yit'),
            			'type' => 'select', // white|red|grey|blue
            			'options' => array(
							'white' => __('White', 'yit'),
							'red' => __('Red', 'yit'),
							'grey' => __('Grey', 'yit'),
							'blue' => __('Blue', 'yit'),
						),
            			'std'  => 'white'
            		),		
            	)
            ),
            /* === FLEXSLIDER === */
            'images_slider' => array(
                'title' => __( 'Images slider', 'yit' ),
                'description' => __( 'Create an image slider', 'yit' ),
                'tab' => 'shortcodes',
                'has_content' => true,
                'attributes' => array(
                    'effect' => array(
                        'title' => __( 'Effect', 'yit' ),
                        'type' => 'select',
                        'options' => array(
                            'fade' => __( 'Fade', 'yit' ),
                            'slide' => __( 'Slide', 'yit' )
                        ),
                        'std' => 'fade'
                    ),
                    'width' => array(
                        'title' => __( 'Width', 'yit' ),
                        'type' => 'number',
                        'std' => '0',
                        'description' => __( 'px (0 = 100%)', 'yit' )
                    ),
                    'height' => array(
                        'title' => __( 'Height ( In px )', 'yit' ),
                        'type' => 'number',
                        'std' => '200',
                        'description' => __( 'px (0 = 100%)', 'yit' )
                    ),
                    'speed' => array(
                        'title' => __( 'Speed', 'yit' ),
                        'type' => 'number',
                        'std' => '8000'
                    ),
                    'direction' => array(
                        'title' => __( 'Direction', 'yit' ),
                        'type' => 'select',
                        'options' => array(
                            'horizontal' => __( 'Horizontal', 'yit' ),
                            'vertical' => __( 'Vertical', 'yit' )
                        ),
                        'std' => 'horizontal'
                    )
                )
            ),
            /* === TICK === */
            'x' => array(
            	'title' => __('Tick', 'yit' ),
            	'description' =>  __('Insert a tick on the content', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'size' => array(
            			'title' => __('Size', 'yit'),
            			'type' => 'number',
            			'std'  => '18'
            		),
            		'color' => array(
            			'title' => __('Color', 'yit'),
            			'type' => 'colorpicker',
            			'std'  => '#23b10b'
            		)	
            	)
            ),
            /* === PRICE === */
            'price' => array(
            	'title' => __('Price box', 'yit' ),
            	'description' =>  __('Create a box of prices', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text',
            			'std'  => 'title'
            		),
            		'price' => array(
            			'title' => __('Price', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'href' => array(
            			'title' => __('URL', 'yit'),
            			'type' => 'text',
            			'std'  => '#'
            		),
            		'buttontext' => array(
            			'title' => __('Text of button', 'yit'),
            			'type' => 'text',
            			'std'  => 'Show'
            		),
            		'textcolor' => array(
            			'title' => __('Text Color', 'yit'),
            			'type' => 'colorpicker',
            			'std'  => '#000000'
            		),
					'color' => array(
            			'title' => __('Box Color', 'yit'),
            			'type' => 'colorpicker',
            			'std'  => '#ffffff'
            		),
					/*
            		'color' => array(
            			'title' => __('Color', 'yit'),
            			'type' => 'select', // white|red|grey|blue|green|yellow
            			'options' => array(
							'white' => __('White', 'yit'),
							'red' => __('Red', 'yit'),
							'grey' => __('Grey', 'yit'),
							'blue' => __('Blue', 'yit'),
							'green' => __('Green', 'yit'),
							'yellow' => __('Yellow', 'yit')
						),
            			'std'  => 'white'
            		),
					*/
            		'last' => array(
            			'title' => __('Last element', 'yit'),
            			'type' => 'checkbox',
            			'std'  => 'no'
            		)
            	)
            ),
            /* === PRICE TABLE === */
            'price_table' => array(
            	'title' => __('Price table', 'yit' ),
            	'description' =>  __('Create a table box of prices', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'type' => array(
            			'title' => __('Type', 'yit'),
            			'type' => 'select', // large|small
            			'options' => array(
							'large' => __('Large', 'yit'),
							'small' => __('Small', 'yit')
						),
            			'std'  => ''
            		),
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text',
            			'std'  => 'title'
            		),
            		'price' => array(
            			'title' => __('Price', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'href' => array(
            			'title' => __('URL', 'yit'),
            			'type' => 'text',
            			'std'  => '#'
            		),
            		'buttontext' => array(
            			'title' => __('Text of button', 'yit'),
            			'type' => 'text',
            			'std'  => 'Show'
            		),
            		'color' => array(
            			'title' => __('Color of header', 'yit'),
            			'type' => 'colorpicker',
            			'std'  => ''
            		),
            	),
            	'hide' => true
            ),
            /* === PRICE TABLE TWO COLUMNS === */
            'price_table_two' => array(
            	'title' => __('Price table 2 columns', 'yit' ),
            	'description' =>  __('Create a table box of prices', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		
            	),
            	'code' => '[price_table_two]
            					[price_table type="large" color="#686767" title="title" price="10.20" href="#" buttontext="Show"][/price_table]
            					[price_table title="title" price="10.20" href="#" buttontext="Show"][/price_table]			
            	[/price_table_two]'
            ),
            /* === PRICE TABLE THREE COLUMNS === */
            'price_table_three' => array(
            	'title' => __('Price table 3 columns', 'yit' ),
            	'description' =>  __('Create a table box of prices', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		
            	),
            	'code' => '[price_table_three]
            					[price_table title="title" price="10.20" href="#" buttontext="Show"][/price_table]			
            					[price_table type="large" color="#686767" title="title" price="10.20" href="#" buttontext="Show"][/price_table]
            					[price_table title="title" price="10.20" href="#" buttontext="Show"][/price_table]			
            				[/price_table_three]'
            ),
            /* === PRICE TABLE FOUR COLUMNS === */
            'price_table_four' => array(
            	'title' => __('Price table 4 columns', 'yit' ),
            	'description' =>  __('Create a table box of prices', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		
            	),
            	'code' => '[price_table_four]
            					[price_table title="title" price="10.20" href="#" buttontext="Show"][/price_table]			
            					[price_table type="large" color="#686767" title="title" price="10.20" href="#" buttontext="Show"][/price_table]
            					[price_table title="title" price="10.20" href="#" buttontext="Show"][/price_table]			
            					[price_table title="title" price="10.20" href="#" buttontext="Show"][/price_table]			
            				[/price_table_four]'
            ),
            /* === PRICE TABLE FIVE COLUMNS === */
            'price_table_five' => array(
            	'title' => __('Price table 5 columns', 'yit' ),
            	'description' =>  __('Create a table box of prices', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		
            	),
            	'code' => '[price_table_five]
            					[price_table title="title" price="10.20" href="#" buttontext="Show"][/price_table]			
            					[price_table title="title" price="10.20" href="#" buttontext="Show"][/price_table]			
            					[price_table type="large" color="#686767" title="title" price="10.20" href="#" buttontext="Show"][/price_table]
            					[price_table title="title" price="10.20" href="#" buttontext="Show"][/price_table]			
            					[price_table title="title" price="10.20" href="#" buttontext="Show"][/price_table]			
            				[/price_table_five]'
            ),
            /* === MEMBERS ONLY === */
            'members_only' => array(
            	'title' => __('Members only', 'yit' ),
            	'description' =>  __('Shows contents for registered members only', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'role' => array(
            			'title' => __('Role', 'yit'),
            			'type' => 'select', // administrator|editor|author|contributor|subscriber
            			'options' => array(
							'administrator' => __('Administrator', 'yit'),
							'editor' => __('Editor', 'yit'),
							'author' => __('Author', 'yit'),
							'contributor' => __('Contributor', 'yit'),
							'subscriber' => __('Subscriber', 'yit')
						),
            			'std'  => 'administrator'
            		),
            		'message' => array(
            			'title' => __('Message', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		)	
            	)
            ),
            'logged_user' => array(
                'title' => __( 'Logged user', 'yit' ),
                'description' => __( 'Show the username of the logged user with some option text before or after.', 'yit' ),
                'tab' => 'shortcodes',
                'has_content' => false,
                'attributes' => array(
                    'before' => array(
                        'title' => __( 'Text before username', 'yit' ),
                        'type' => 'text',
                        'std' => 'Hello '
                    ),
                    'after' => array(
                        'title' => __( 'Text after username', 'yit' ),
                        'type' => 'text',
                        'std' => ''
                    ),
                    'display' => array(
                        'title' => __( 'Display', 'yit' ),
                        'type' => 'select',
                        'options' => array(
                            'user_login' => __( 'Login', 'yit' ),
                            'user_email' => __( 'Email', 'yit' ),
                            'user_firstname' => __( 'First name', 'yit' ),
                            'user_lastname' => __( 'Last name', 'yit' ),
                            'first_last' => __( 'First and Last name', 'yit' ),
                            'last_first' => __( 'Last and First name', 'yit' ),
                            'display_name' => __( 'Display name', 'yit' ),
                            'ID' => __( 'ID', 'yit' )
                        ),
                        'std' => 'display_name'
                    )
                )
            ),
            /* === END CONTENT === */
            
            /* === START FORMATTING === */
            /* == PRINT CLEAR === */
            'clear' => array(
            	'title' => __('Print clear', 'yit' ),
            	'description' =>  __('Print a clear, to undo the floating', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            	)
            ),
            /* === PRINT SPACE === */
            'space' => array(
            	'title' => __('Add space', 'yit' ),
            	'description' =>  __('Print a space', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            	)
            ),
            /* === PRINT BORDER === */
            'border' => array(
            	'title' => __('Print border line', 'yit' ),
            	'description' =>  __('Print a border', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            	)
            ),
            /* === PRINT LINE === */
            'line' => array(
            	'title' => __('Print line', 'yit' ),
            	'description' =>  __('Print a line', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            	),
            	'hide' => true
            ),
            /* === DROPCAP === */
            'dropcap' => array(
            	'title' => __('Dropcap', 'yit' ),
            	'description' =>  __('Format content, with big first letter', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            	)
            ),
            /* === QUOTE === */
            'quote' => array(
            	'title' => __('Quote', 'yit' ),
            	'description' =>  __('Adds the content into a box quote', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            	)
            ),
            /* === HIGHLIGHT === */
            'highlight' => array(
            	'title' => __('Highlight', 'yit' ),
            	'description' =>  __('Text highlight', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            	)
            ),
            /* === LABEL === */
            'label' => array(
            	'title' => __('Label', 'yit' ),
            	'description' =>  __('Insert a label in the content', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'color' => array(
            			'title' => __('Color', 'yit'),
            			'type' => 'select', // green|red|orange|grey|black|lightblue
            			'options' => array(
							'green' => __('Green', 'yit'),
							'red' => __('Red', 'yit'),
							'orange' => __('Orange', 'yit'),
							'grey' => __('Grey', 'yit'),
							'black' => __('Black', 'yit'),
							'lightblue' => __('Lightblue', 'yit')
						),
            			'std'  => ''
            		),
            		'icon' => array(
            			'title' => __('Icon', 'yit'),
            			'type' => 'select', // home|file|time|ecc
            			'options' => $awesome_icons,
            			'std'  => ''
            		)
            	)
            ),
            /* === ICON === */
            'icon' => array(
            	'title' => __('Icon', 'yit' ),
            	'description' =>  __('Insert an icon in the content', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'type' => array(
            			'title' => __('Type', 'yit'),
            			'type' => 'select', // home|file|time|ecc
            			'options' => $awesome_icons,
            			'std'  => ''
            		),
            		'color' => array(
            			'title' => __('Color', 'yit'),
            			'type' => 'colorpicker', 
            			'std'  => '#000'
            		),
            		'size' => array(
            			'title' => __('Size', 'yit'),
            			'type' => 'number', 
            			'std'  => '12'
            		),
            		'unit' => array(
            			'title' => __('Unit', 'yit'),
            			'type' => 'select', // px|%|em
            			'options' => array(
							'px' => __('px', 'yit'),
            				'%' => __('%', 'yit'),
            				'em' => __('em', 'yit')
						),
            			'std'  => 'px'
            		)
            	)
            ),
            /* === BOLD === */
            'b' => array(
            	'title' => __('Bold', 'yit' ),
            	'description' =>  __('Bold text', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            	),
            	'hide' => true
            ),
            /* === STRONG === */
            'strong' => array(
            	'title' => __('Strong', 'yit' ),
            	'description' =>  __('Bold text', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            	),
            	'hide' => true
            ),
            /* === ITALIC === */
            'i' => array(
            	'title' => __('Italic', 'yit' ),
            	'description' =>  __('Italic text', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            	),
            	'hide' => true
            ),
            /* === ITALIC EM === */
            'em' => array(
            	'title' => __('Italic em', 'yit' ),
            	'description' =>  __('Italic text', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            	),
            	'hide' => true
            ),
            /* === URL === */
            'url' => array(
            	'title' => __('URL', 'yit' ),
            	'description' =>  __('Insert an URL link', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'href' => array(
            			'title' => __('URL', 'yit'),
            			'type' => 'text',
            			'std'  => '#'
            		),
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		)
            	)
            ),
            /* === IMG === */
            'img' => array(
            	'title' => __('Image', 'yit' ),
            	'description' =>  __('Insert an image', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'src' => array(
            			'title' => __('URL', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'alt' => array(
            			'title' => __('Alternate text', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'width' => array(
            			'title' => __('Width', 'yit'),
            			'type' => 'number',
            			'std'  => ''
            		),
            		'height' => array(
            			'title' => __('Height', 'yit'),
            			'type' => 'number', 
            			'std'  => ''
            		)
            	)
            ),
            /* === IMAGE === */
            'image' => array(
            	'title' => __('Image lightbox', 'yit' ),
            	'description' =>  __('Insert an image', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'url' => array(
            			'title' => __('URL', 'yit'),
            			'type' => 'text',            			
            			'std'  => ''
            		),
                    'link' => array(
            			'title' => __('Link', 'yit'),
            			'type' => 'text',            			
            			'std'  => ''
            		),
            		'size' => array(
            			'title' => __('Size', 'yit'),
            			'type' => 'select', // small|medium|large|fullwidth
            			'options' => array(
							'small' => __('Small', 'yit'),
            				'medium' => __('Medium', 'yit'),
            				'large' => __('Large', 'yit'),
            				'fullwidth' => __('Full width', 'yit')
						),
            			'std'  => 'medium'
            		),
            		'target' => array(
            			'title' => __('Target', 'yit'),
            			'type' => 'select', // _blank|_parent|_self|_top
            			'options' => array(
							'_blank' => __('New window', 'yit'),
            				'_parent' => __('Principal window', 'yit'),
            				'_self' => __('Same window', 'yit'),
            				'_top' => __('New full window', 'yit')
						),
            			'std'  => ''
            		),
            		'lightbox' => array(
            			'title' => __('Lightbox', 'yit'),
            			'type' => 'select', // true|false
            			'options' => array(
							'true' => __('Yes', 'yit'),
            				'false' => __('No', 'yit')
						),
            			'std'  => 'true'
            		),
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'align' => array(
            			'title' => __('Alignment', 'yit'),
            			'type' => 'select', // left|right|center
            			'options' => array(
							'left' => __('Left', 'yit'),
            				'right' => __('Right', 'yit'),
            				'center' => __('Center', 'yit')
						),
            			'std'  => 'left'
            		),
            		/*'width' => array(
            			'title' => __('Width', 'yit'),
            			'type' => 'number',
            			'std'  => '640'
            		),
            		'height' => array(
            			'title' => __('Height', 'yit'),
            			'type' => 'number', 
            			'std'  => '480'
            		),*/
            		/*'group' => array(
            			'title' => __('Group', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),*/
            		'autoheight' => array(
            			'title' => __('Auto height', 'yit'),
            			'type' => 'select',
            			'options' => array (
							'false' => __('No', 'yit'),
							'true' => __('Yes', 'yit')
						),
            			'std'  => 'false'
            		)
            	)
            ),
            /* === SIZE === */
            'size' => array(
            	'title' => __('Size of text', 'yit' ),
            	'description' =>  __('Select a size of text', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'px' => array (
						'title' => __('Pixel', 'yit'),
            			'type' => 'number',
            			'std'  => ''
					),
					'perc' => array (
						'title' => __('Percent', 'yit'),
            			'type' => 'number',
            			'std'  => ''
					),
					'em' => array (
						'title' => __('Em', 'yit'),
            			'type' => 'number',
            			'std'  => ''
					)
            		/*'size' => array(
            			'title' => __('Size', 'yit'),
            			'type' => 'number',
            			'std'  => '12'
            		),
            		'unit' => array(
            			'title' => __('Unit', 'yit'),
            			'type' => 'select', // px|%|em
            			'options' => array(
							'px' => __('px', 'yit'),
            				'%' => __('%', 'yit'),
            				'em' => __('em', 'yit')
						),
            			'std'  => 'px'
            		)*/
            	)
            ),
            /* === SPECIAL FONT === */
            'special_font' => array(
            	'title' => __('Special font', 'yit' ),
            	'description' =>  __('Select a special font of text', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'size' => array(
            			'title' => __('Size', 'yit'),
            			'type' => 'number',
            			'std'  => '12'
            		),
            		'unit' => array(
            			'title' => __('Unit', 'yit'),
            			'type' => 'select', // px|%|em
            			'options' => array(
							'px' => __('px', 'yit'),
            				'%' => __('%', 'yit'),
            				'em' => __('em', 'yit')
						),
            			'std'  => 'px'
            		)
            	)
            ),
            /* === END FORMATTING === */
            
            /* === START MEDIA === */
            /* === YOUTUBE === */
            'youtube' => array(
            	'title' => __('Youtube video', 'yit' ),
            	'description' =>  __('Embed the player youtube video', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'video_id' => array(
            			'title' => __('Video ID', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'width' => array(
            			'title' => __('Width', 'yit'),
            			'type' => 'number',
            			'std'  => '640'
            		),
            		'height' => array(
            			'title' => __('Height', 'yit'),
            			'type' => 'number',
            			'std'  => '360'
            		)
            	)
            ),
            /* === VIMEO === */
            'vimeo' => array(
            	'title' => __('Vimeo video', 'yit' ),
            	'description' =>  __('Embed the player vimeo video', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'video_id' => array(
            			'title' => __('Video ID', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'width' => array(
            			'title' => __('Width', 'yit'),
            			'type' => 'number',
            			'std'  => '640'
            		),
            		'height' => array(
            			'title' => __('Height', 'yit'),
            			'type' => 'number',
            			'std'  => '360'
            		)
            	)
            ),
            /* === DAILYMOTION === */
            'dailymotion' => array(
            	'title' => __('Dailymotion video', 'yit' ),
            	'description' =>  __('Embed the player dailymotion video', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'video_id' => array(
            			'title' => __('Video ID', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'width' => array(
            			'title' => __('Width', 'yit'),
            			'type' => 'number',
            			'std'  => '640'
            		),
            		'height' => array(
            			'title' => __('Height', 'yit'),
            			'type' => 'number',
            			'std'  => '360'
            		)
            	)
            ),
            /* === YAHOO VIDEO === */
            'yahoo' => array(
            	'title' => __('Yahoo video', 'yit' ),
            	'description' =>  __('Embed the player yahoo video', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'video_id' => array(
            			'title' => __('Video ID', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'width' => array(
            			'title' => __('Width', 'yit'),
            			'type' => 'number',
            			'std'  => '640'
            		),
            		'height' => array(
            			'title' => __('Height', 'yit'),
            			'type' => 'number',
            			'std'  => '360'
            		)
            	)
            ),
            /* === BLIPTV === */
            'bliptv' => array(
            	'title' => __('Bliptv video', 'yit' ),
            	'description' =>  __('Embed the player bliptv video', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'video_id' => array(
            			'title' => __('Video ID', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'width' => array(
            			'title' => __('Width', 'yit'),
            			'type' => 'number',
            			'std'  => '640'
            		),
            		'height' => array(
            			'title' => __('Height', 'yit'),
            			'type' => 'number',
            			'std'  => '360'
            		)
            	)
            ),
            /* === VEOH === */
            'veoh' => array(
            	'title' => __('Veoh video', 'yit' ),
            	'description' =>  __('Embed the player veoh video', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'video_id' => array(
            			'title' => __('Video ID', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'width' => array(
            			'title' => __('Width', 'yit'),
            			'type' => 'number',
            			'std'  => '640'
            		),
            		'height' => array(
            			'title' => __('Height', 'yit'),
            			'type' => 'number',
            			'std'  => '360'
            		)
            	)
            ),
            /* === VIDDLER === */
            'viddler' => array(
            	'title' => __('Viddler video', 'yit' ),
            	'description' =>  __('Embed the player viddler video', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'video_id' => array(
            			'title' => __('Video ID', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'width' => array(
            			'title' => __('Width', 'yit'),
            			'type' => 'number',
            			'std'  => '640'
            		),
            		'height' => array(
            			'title' => __('Height', 'yit'),
            			'type' => 'number',
            			'std'  => '360'
            		)
            	)
            ),
            /* === VIDEO === */
            'video' => array(
            	'title' => __('Video', 'yit' ),
            	'description' =>  __('Embed the player video', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'type' => array(
            			'title' => __('Type', 'yit'),
            			'type' => 'select', // youtube|vimeo|dailymotion|yahoo|bliptv|veoh|viddler
            			'options' => array(
							'youtube' => 'Youtube',
							'vimeo' => 'Vimeo',
							'dailymotion' => 'Daily Motion',
							'yahoo' => 'Yahoo',
							'bliptv' => 'Blip TV',
							'veoh' => 'Veoh',
							'viddler' => 'Viddler'							
						),
            			'std'  => ''
            		),
            		'video_id' => array(
            			'title' => __('Video ID', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'width' => array(
            			'title' => __('Width', 'yit'),
            			'type' => 'number',
            			'std'  => '640'
            		),
            		'height' => array(
            			'title' => __('Height', 'yit'),
            			'type' => 'number',
            			'std'  => '360'
            		)
            	)
            ),
            /* === END MEDIA === */
            
            /* === START WIDGETS === */
            /* === CALL TO ACTION === */
            'call' => array(
            	'title' => __('Call to action phone', 'yit' ),
            	'description' =>  __('Shows a box with an incipit and a number phone', 'yit' ),
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
            		'phone' => array(
            			'title' => __('Phone', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'class' => array(
            			'title' => __('CSS class', 'yit'),
            			'type' => 'text',
            			'std'  => 'call-to-action'
            		)
            	)
            ),
            /* === CALL TO ACTION 2 === */
            'call_two' => array(
            	'title' => __('Call to action with button', 'yit' ),
            	'description' =>  __('Shows a box with an incipit and a number phone', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'href' => array(
            			'title' => __('URL', 'yit'),
            			'type' => 'text',
            			'std'  => '#'
            		),
            		'label_button' => array(
            			'title' => __('Label button', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'class' => array(
            			'title' => __('CSS class', 'yit'),
            			'type' => 'text',
            			'std'  => 'call-to-action-two'
            		),
            		'color' => array(
            			'title' => __('Color', 'yit'),
            			'type' => 'select', // btn-view-over-the-town-1|btn-the-bizzniss-1|btn-french-1|ecc
            			'options' => $button_style,
            			'std'  => ''
            		),
            		'colorstart' => array(
            			'title' => __('Color start', 'yit'),
            			'type' => 'colorpicker',
            			'std'  => '#000000'
            		),
            		'colorend' => array(
            			'title' => __('Color end', 'yit'),
            			'type' => 'colorpicker',
            			'std'  => '#FFFFFF'
            		),
            		'align' => array(
            			'title' => __('Alignment', 'yit'),
            			'type' => 'select', // vertical|horizontal
            			'options' => array(
            				'vertical' => __('Vertical', 'yit'),
							'horizontal' => __('Horizontal', 'yit')
						),
            			'std'  => 'vertical'
            		),
            		'colortext' => array(
            			'title' => __('Color of text', 'yit'),
            			'type' => 'colorpicker',
            			'std'  => '#FFFFFF'
            		),
            		'width' => array(
            			'title' => __('Width', 'yit'),
            			'type' => 'select',  // large|normal|small|mini
            			'options' => array(
            				'large' => __('Large', 'yit'),
            				'normal' => __('Normal', 'yit'),
            				'small' => __('Small', 'yit'),
            				'mini' => __('Mini', 'yit')            				
						),
            			'std'  => 'normal'   
            		),
            		'icon' => array(
            			'title' => __('Icon', 'yit'),
            			'type' => 'select',  // home|file|time|ecc
            			'options' => $awesome_icons,
            			'std'  => ''
            		),
            		'icon_size' => array(
            			'title' => __('Icon size', 'yit'),
            			'type' => 'number', 
            			'std'  => '12'
            		)
            	)
            ),
            /* === LAST POST BOX === */
            'lastpost' => array(
            	'title' => __('Last post box', 'yit' ),
            	'description' =>  __('Shows last post of a specific category', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'icon' => array(
            			'title' => __('Icon', 'yit'),
            			'type' => 'select', // box|calendars|ecc
            			'options' => $set_icons,
            			'std'  => 'box'
            		),
            		'size' => array(
            			'title' => __('Size', 'yit'),
            			'type' => 'select', // 32|48
            			'options' => array(
							'32' => __('32', 'yit'),
            				'48' => __('48', 'yit')
						),
            			'std'  => '32'
            		),
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'class' => array(
            			'title' => __('CSS class', 'yit'),
            			'type' => 'text',
            			'std'  => 'box-sections'
            		),
            		'cat_name' => array(
            			'title' => __('Category', 'yit'),
            			'type' => 'select', // list of all categories
            			'options' => $categories,
            			'std'  => '0'
            		),
            		'more_text' => array(
            			'title' => __('More text', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),
            		'showdate' => array(
            			'title' => __('Show date', 'yit'),
            			'type' => 'checkbox', // yes|no
            			'std'  => 'yes'
            		),
            		'showtitle' => array(
            			'title' => __('Show title', 'yit'),
            			'type' => 'checkbox', // yes|no
            			'std'  => 'yes'
            		),
            		'last' => array(
            			'title' => __('Last element', 'yit'),
            			'type' => 'checkbox',
            			'std'  => 'no'
            		)
            	)
            ),
            /* === RECENT POST === */
            'recentpost' => array(
            	'title' => __('Recent post box', 'yit' ),
            	'description' =>  __('Shows last post of a specific category', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
                    'post_layout' => array(
                        'title' => __( 'Select layout', 'yit' ),
                        'type' => 'select', // widget|columns
                        'options' => array(
                            'widget' => __( 'Widget', 'yit' ),
                            'columns' => __( 'Columns', 'yit' ),
                        ),
                        'std'  => 'widget'
                    ),
            		'items' => array(
            			'title' => __('N. of items', 'yit'),
            			'type' => 'number',
            			'std'  => '3'
            		),
            		'cat_name' => array(
            			'title' => __('Category', 'yit'),
            			'type' => 'select', // list of all categories
            			'options' => $categories,
            			'std'  => '0'
            		),
            		'showthumb' => array(
            			'title' => __('Thumbnail', 'yit'),
            			'type' => 'checkbox', // yes|no
            			'std'  => 'yes'
            		),
            		'date' => array(
            			'title' => __( 'Show Date or Excerpt', 'yit' ),
            			'type' => 'select', // yes|no
						'options' => array(
							'yes' => __( 'Date', 'yit' ),
							'no' => __( 'Excerpt', 'yit' ),
						),
            			'std'  => 'no'
            		),
            		'excerpt_length' => array(
            			'title' => __('Limit words', 'yit'),
            			'type' => 'number', 
            			'std'  => '20'
            		),
            		'readmore' => array(
            			'title' => __('More text', 'yit'),
            			'type' => 'text', 
            			'std'  => 'Read more...'
            		),
                    'popular' => array(
                        'title' => __('Show popular posts', 'yit'),
                        'type' => 'checkbox', // yes|no
                        'std'  => 'no'
                    ),
            	)
            ),
            /* === POPULAR POST === */
            'popularpost' => array(
            	'title' => __('Popular post box', 'yit' ),
            	'description' =>  __('Shows popular posts', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
                    'post_layout' => array(
                        'title' => __( 'Select layout', 'yit' ),
                        'type' => 'select', // widget|columns
                        'options' => array(
                            'widget' => __( 'Widget', 'yit' ),
                            'columns' => __( 'Columns', 'yit' ),
                        ),
                        'std'  => 'widget'
                    ),
            		'items' => array(
            			'title' => __('N. of items', 'yit'),
            			'type' => 'number',
            			'std'  => '3'
            		),
            		'cat_name' => array(
            			'title' => __('Category', 'yit'),
            			'type' => 'select', // list of all categories
            			'options' => $categories,
            			'std'  => '0'
            		),
            		'showthumb' => array(
            			'title' => __('Thumbnail', 'yit'),
            			'type' => 'checkbox', // yes|no
            			'std'  => 'yes'
            		),
            		'date' => array(
            			'title' => __( 'Show Date or Excerpt', 'yit' ),
            			'type' => 'select', // yes|no
						'options' => array(
							'yes' => __( 'Date', 'yit' ),
							'no' => __( 'Excerpt', 'yit' ),
						),
            			'std'  => 'yes'
            		),
            		'excerpt_length' => array(
            			'title' => __('Limit words', 'yit'),
            			'type' => 'number', 
            			'std'  => '20'
            		),
            		'readmore' => array(
            			'title' => __('More text', 'yit'),
            			'type' => 'text', 
            			'std'  => 'Read more...'
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
							'youtube' => __('Youtube', 'yit'),
							'delicious' => __('Delicious', 'yit'),
							'vimeo' => __('Vimeo', 'yit'),
							'flickr' => __('Flickr', 'yit'),
							'stumble' => __('Stumble', 'yit'),
							'linkedin' => __('LinkedIn', 'yit'),
							'skype' => __('Skype', 'yit'),
							'lastfm' => __('Lastfm', 'yit'),
							'myspace' => __('My Space', 'yit'),
							'tumblr' => __('Tumblr', 'yit'),
							'digg' => __('Digg', 'yit'),
							'quora' => __('Quora', 'yit'),
							'dribble' => __('Dribble', 'yit'),
							'forrst' => __('Forrst', 'yit'),
							'google' => __('Google', 'yit'),
							'ember' => __('Ember', 'yit'),
							'pinterest' => __('Pinterest', 'yit')
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
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		)
            	)
            ),
            /* === TWITTER === */
            'twitter' => array(
                'title' => __('Twitter', 'yit' ),
                'description' =>  __('Print a list of last tweets', 'yit' ),
                'tab' => 'shortcodes',
                'has_content' => false,
                'attributes' => array(
                    'username' => array(
                        'title' => __('Username', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'consumer_key' => array(
                        'title' => __('Consumer Key', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'consumer_secret' => array(
                        'title' => __('Consumer Secret', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'access_token' => array(
                        'title' => __('Access Token', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'access_token_secret' => array(
                        'title' => __('Access Token Secret', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'items' => array(
                        'title' => __('N. of items', 'yit'),
                        'type' => 'number',
                        'std'  => '5'
                    ),
                    'class' => array(
                        'title' => __('CSS class', 'yit'),
                        'type' => 'text',
                        'std'  => 'last-tweets-widget'
                    ),
                    'time' => array(
                        'title' => __('Time', 'yit'),
                        'type' => 'checkbox',
                        'std'  => 'yes'
                    ),
                )
            ),
            /* === TOGGLE === */
            'toggle' => array(
            	'title' => __('Toggle', 'yit' ),
            	'description' =>  __('Create a toggle content', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text', 
            			'std'  => 'your_title'
            		),
            		'opened' => array(
            			'title' => __('Opened', 'yit'),
            			'type' => 'checkbox', 
            			'std'  => 'no'
            		)
            	)
            ),
            /* === TABS === */
            'tabs' => array(
            	'title' => __('Tabs', 'yit' ),
            	'description' =>  __('Create a content with tabs.', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'unlimited'   => true,
            	'code'        => '[tabs tab1="Tab 1" tab2="Tab 2" tab3="Tab 3"]
            						[tab id="tab1"]Your content 1[/tab]
            						[tab id="tab2"]Your content 2[/tab]
            						[tab id="tab3"]Your content 3[/tab]
            					  [/tabs]'
            ),
            /* === TAB === */
            'tab' => array(
            	'title' => __('Tab', 'yit' ),
            	'description' =>  __('Create a content tab in shortcode tabs.', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		'id' => array(
            			'title' => __('ID', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		)
            	),
            	'hide' => true
            ),
            /* === FAQS === */ // da testare
            'faq' => array(
            	'title' => __('Faqs', 'yit' ),
            	'description' =>  __('Show all post on faq post types', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'items' => array(
            			'title' => __('N. of items', 'yit'),
            			'type' => 'number', 
            			'std'  => ''
            		),
            		'category' => array(
            			'title' => __('Category', 'yit'),
            			'type' => 'select', // list of faq category
            			'std'  => '0'
            		),
            		'close_first' => array(
            			'title' => __('Close first', 'yit'),
            			'type' => 'checkbox', 
            			'std'  => '0'
            		)
            	)
            ),
            /* === TESTIMONIALS === */
            'testimonials' => array(
            	'title' => __('Testimonials', 'yit' ),
            	'description' =>  __('Show all post on testimonials post types', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'items' => array(
            			'title' => __('N. of items', 'yit'),
            			'type' => 'number', 
            			'std'  => ''
            		)
            	)
            ),
            /* === GOOGLE MAPS === */
            'googlemap' => array(
            	'title' => __('Google Maps', 'yit' ),
            	'description' =>  __('Print the google map box', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'width' => array(
            			'title' => __('Width', 'yit'),
            			'type' => 'number', 
            			'std'  => ''
            		),
            		'height' => array(
            			'title' => __('Height', 'yit'),
            			'type' => 'number', 
            			'std'  => ''
            		),
            		'src' => array(
            			'title' => __('URL', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		)
            	)
            ),
            /* === POSTS LIST (ex news list) === */
            'posts' => array(
            	'title' => __('Posts list', 'yit' ),
            	'description' =>  __('Print list of posts', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'cat' => array(
            			'title' => __('Category', 'yit'),
            			'type' => 'select', // list of all category
            			'options' => $categories,
            			'std'  => '0'
            		),				
            		'items' => array(
            			'title' => __('N. of items', 'yit'),
            			'type' => 'number', 
            			'std'  => '3'
            		),
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		)
            	)
            ),
            /* === NEWSLETTER FORM === */
            'newsletter_form' => array(
            	'title' => __('Newsletter form', 'yit' ),
            	'description' =>  __('Show a newsletter form<br /> (If you leave empty a field, it will use the default value setted in Theme Options -> General -> Newsletter)', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text',
            			'std'  => ''
            		),				
            		'description' => array(
            			'title' => __('Description', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'action' => array(
            			'title' => __('URL', 'yit'),
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
            			'std'  => ''
            		),				
            		'submit' => array(
            			'title' => __('Submit text', 'yit'),
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
            /* === TEAM === */
            'team' => array(
            	'title' => __( 'Team', 'yit' ),
                'description' => __( 'Print a created team.', 'yit' ),
                'tab' => 'cpt',
            	'has_content' => false,
                'attributes' => array(                    
                    'name' => array(
                        'title' => __('Name', 'yit'),
            			'type' => 'select',
            			'options' => $this->get_accordions(),
                        'std' => ''
                    )
                )
            ),
            /* === FEATURES TAB === */ // da testare
            'features_tab' => array(
                'create' => false,
            	'title' => __('Features Tab', 'yit' ),
            	'description' =>  __('Show all features tab posts in a tabbed div', 'yit' ),
            	'tab' => 'cpt',
            	'has_content' => false,
            	'attributes' => array(
            		'name' => array(
            			'title' => __('Name', 'yit'),
            			'type' => 'select',
                        'options' => $this->get_features_tabs(), 
            			'std'  => ''
            		)
            	)
            ),
            /* === FEED SLIDER === */
            'feed_slider' => array(
            	'title' => __('Feed slider', 'yit' ),
            	'description' =>  __('Create a slider containing RSS Feeds', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'url' => array(
            			'title' => __('URL', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'number' => array(
            			'title' => __('N. of items', 'yit'),
            			'type' => 'number', 
            			'std'  => '3'
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
            /* === CONTACT INFO === */
            'contact_info' => array(
            	'title' => __('Contact info', 'yit' ),
            	'description' =>  __('Show a contact info', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'address' => array(
            			'title' => __('Address', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'address_icon' => array(
            			'title' => __('Address icon', 'yit'),
            			'type' => 'select',
            			'options' => $awesome_icons,
            			'std'  => ''
            		),
            		'phone' => array(
            			'title' => __('Phone', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'phone_icon' => array(
            			'title' => __('Phone icon', 'yit'),
            			'type' => 'select',
            			'options' => $awesome_icons,
            			'std'  => ''
            		),
            		'mobile' => array(
            			'title' => __('Mobile', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'mobile_icon' => array(
            			'title' => __('Mobile icon', 'yit'),
            			'type' => 'select',
            			'options' => $awesome_icons,
            			'std'  => ''
            		),
            		'fax' => array(
            			'title' => __('Fax', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'fax_icon' => array(
            			'title' => __('Fax icon', 'yit'),
            			'type' => 'select',
            			'options' => $awesome_icons,
            			'std'  => ''
            		),
            		'email' => array(
            			'title' => __('E-mail', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'email_icon' => array(
            			'title' => __('E-mail icon', 'yit'),
            			'type' => 'select',
            			'options' => $awesome_icons,
            			'std'  => ''
            		),
            	)
            ),
            /* === PRE === */
            'pre' => array(
            	'title' => __('Show code', 'yit' ),
            	'description' =>  __('Show code without execute it', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		
            	)
            ),
            /* === PRINT SHORTCODE === */
            'print_sc' => array(
            	'title' => __('Print shortcode', 'yit' ),
            	'description' =>  __('Show code without execute it', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => true,
            	'attributes' => array(
            		
            	)
            ),
            /* === SOUNDCLOUD === */
            'soundcloud' => array(
                'title' => __( 'SoundCloud player', 'yit' ),
                'description' => __( 'Show the audio player of SoundCloud', 'yit' ),
                'tab' => 'shortcodes',
                'has_content' => false,
                'attributes' => array(
                    'iframe' => array(
                        'title' => __( 'Use iFrame', 'yit' ),
                        'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'url' => array(
                        'title' => __( 'URL', 'yit' ),
                        'type' => 'text',
                        'std' => ''
                    ),
                    'auto_play' => array(
                        'title' => __( 'Auto play', 'yit' ),
                        'type' => 'checkbox',
                        'std' => 'no'
                    ),
                    'show_artwork' => array(
                        'title' => __( 'Show artwork', 'yit' ),
                        'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_comments' => array(
                        'title' => __( 'Show comments', 'yit' ),
                        'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'color' => array(
                        'title' => __( 'Color', 'yit' ),
                        'type' => 'colorpicker',
                        'std' => '#ff7700'
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
            			'title' => __('N. items', 'yit'),
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
            /* === SHARE === */
            'share' => array(
                'title' => __( 'Share', 'yit' ),
                'description' => __( 'Print share buttons', 'yit' ),
                'has_content' => false,
                'tab' => 'shortcodes',
                'attributes' => array(
                    'title' => array(
                        'title' => __( 'Title', 'yit' ),
                        'type' => 'text',
                        'std' => ''
                    ),
                    'socials' => array(
                        'title' => __( 'Socials', 'yit' ),
                        'type' => 'text',
                        'std' => 'facebook, twitter, google, pinterest, bookmark'
                    ),
                    'class' => array(
                        'title' => __( 'CSS Class', 'yit' ),
                        'type' => 'text',
                        'std' => ''
                    )
                )
            ),
            /* === BANNER === */
            'banner' => array(
                'title' => __( 'Animated Banner', 'yit' ),
                'description' => __( 'Print a banner', 'yit' ),
                'has_content' => false,
                'tab' => 'shortcodes',
                'attributes' => array(
                    'type' => array(
                        'title' => __( 'Type', 'yit' ),
                        'type' => 'select',
                        'options' => array(
                            'switch-text' => __( 'Switch texts', 'yit' ),
                            'zoom-left' => __( 'Zoom from left', 'yit' ),
                            'zoom-icon' => __( 'Zoom icon', 'yit' ),
                            'top-entry' => __( 'Top entry', 'yit' ),
                            'left-entry-zoom' => __( 'Left entry and zoom', 'yit' ),
                            'rotate-zoom' => __( 'Rotate and zoom', 'yit' ),
                            'zoom-box' => __( 'Zoom box', 'yit' ),
                            'small-to-big' => __( 'Small to big icon', 'yit' )
                        ),
                        'std' => 'switch-text'                    
                    ),
                    'width' => array(
                        'title' => __( 'Width (in px. 0 = 100%)', 'yit' ),
                        'type' => 'number',
                        'std' => '0'
                    ),
                    'height' => array(
                        'title' => __( 'Height (in px)', 'yit' ),
                        'type' => 'number',
                        'std' => '100'
                    ),
                    'url' => array(
                        'title' => __( 'Link URL', 'yit' ),
                        'type' => 'text',
                        'std' => '#'
                    ),
                    'target' => array(
                        'title' => __( 'Open in a new window', 'yit' ),
                        'type' => 'checkbox',
                        'std' => 'no'
                    ),
                    'title' => array(
                        'title' => __( 'Title', 'yit' ),
                        'type' => 'text',
                        'std' => ''
                    ),
                    'subtitle' => array(
                        'title' => __( 'Sub title', 'yit' ),
                        'type' => 'text',
                        'std' => ''
                    ),
                    'icon' => array(
                        'title' => __( 'Icon', 'yit' ),
                        'type' => 'select',
                        'options' => $awesome_icons,
                        'std' => ''
                    ),
                    'style' => array(
                        'title' => __( 'Predefinied style', 'yit' ),
                        'type' => 'select',
                        'options' => array(
                            'no' => __( 'Choose a style', 'yit' ),
                            'grey' => __( 'Grey', 'yit' ),
                            'orange' => __( 'Orange', 'yit' )
                        ),
                        'std' => 'no'
                    ),
                    'title_size' => array(
                        'title' => __( 'Title size (in px)', 'yit' ),
                        'type' => 'number',
                        'std' => '14'
                    ),
                    'title_size_hover' => array(
                        'title' => __( 'Title hover size (in px)', 'yit' ),
                        'type' => 'number',
                        'std' => '11'
                    ),
                    'subtitle_size' => array(
                        'title' => __( 'Subtitle size (in px)', 'yit' ),
                        'type' => 'number',
                        'std' => '11'
                    ),
                    'subtitle_size_hover' => array(
                        'title' => __( 'Subtitle hover size (in px)', 'yit' ),
                        'type' => 'number',
                        'std' => '14'
                    ),
                    'icon_size' => array(
                        'title' => __( 'Icon size (in px)', 'yit' ),
                        'type' => 'number',
                        'std' => '35'
                    ),
                    'icon_size_hover' => array(
                        'title' => __( 'Icon hover size (in px)', 'yit' ),
                        'type' => 'number',
                        'std' => '50'
                    ),
                    'background' => array(
                        'title' => __( 'Background color', 'yit' ),
                        'type' => 'colorpicker',
                        'std' => ''
                    ),
                    'background_image' => array(
                        'title' => __( 'Background image URL', 'yit' ),
                        'type' => 'text',
                        'std' => ''
                    ),
                    'border' => array(
                        'title' => __( 'Border color', 'yit' ),
                        'type' => 'colorpicker',
                        'std' => ''
                    ),
                    'color_icon' => array(
                        'title' => __( 'Icon color', 'yit' ),
                        'type' => 'colorpicker',
                        'std' => ''
                    ),
                    'color_title' => array(
                        'title' => __( 'Title color', 'yit' ),
                        'type' => 'colorpicker',
                        'std' => ''
                    ),
                    'color_subtitle' => array(
                        'title' => __( 'Subtitle color', 'yit' ),
                        'type' => 'colorpicker',
                        'std' => ''
                    ),
                    'background_hover' => array(
                        'title' => __( 'Background hover color', 'yit' ),
                        'type' => 'colorpicker',
                        'std' => ''
                    ),
                    'border_hover' => array(
                        'title' => __( 'Border hover color', 'yit' ),
                        'type' => 'colorpicker',
                        'std' => ''
                    ),
                    'color_icon_hover' => array(
                        'title' => __( 'Icon hover color', 'yit' ),
                        'type' => 'colorpicker',
                        'std' => ''
                    ),
                    'color_title_hover' => array(
                        'title' => __( 'Title hover color', 'yit' ),
                        'type' => 'colorpicker',
                        'std' => ''
                    ),
                    'color_subtitle_hover' => array(
                        'title' => __( 'Subtitle hover color', 'yit' ),
                        'type' => 'colorpicker',
                        'std' => ''
                    ),
                    
                )
            ),
            /* === START SECTIONS === */
            'section' => array(
                'title' => __( 'Section', 'yit' ),
                'description' => __( 'Print a specified section type.', 'yit' ),
                'tab' => 'section',
            	'has_content' => false,
                'attributes' => array(
                    'type' => array(
                        'title' => __('Type', 'yit'),
            			'type' => 'select', //blog|portfolio|services|gallery
            			'options' => array(
							'blog' => __('Blog', 'yit'),
							'portfolio' => __('Portfolio', 'yit'),
							'services' => __('Services', 'yit'),
							'gallery' => __('Gallery', 'yit')							
						),
                        'std' => ''
                    ),
                    'items' => array(
                        'title' => __('N. of items', 'yit'),
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
                    'category' => array(
                        'title' => __('Category', 'yit'),
            			'type' => 'select', // list of category
                        'std' => '0'
                    ),
                    'portfolio' => array(
                        'title' => __('Portfolio', 'yit'),
            			'type' => 'select',
                        'std' => ''
                    ),
                    'show_excerpt' => array(
                        'title' => __('Show excerpt', 'yit'),
            			'type' => 'select',
                        'std' => 'yes'
                    ),
                    'excerpt_length' => array(
                        'title' => __('Limit words', 'yit'),
            			'type' => 'number',
                        'std' => '10'
                    ),
                    'show_title' => array(
                        'title' => __('Show title', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_comments' => array(
                        'title' => __('Show comments', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_date' => array(
                        'title' => __('Show date', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_readmore' => array(
                        'title' => __('Show read more', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'no'
                    ),
                    'readmore_text' => array(
                        'title' => __('More text', 'yit'),
            			'type' => 'text',
                        'std' => __( '|| Read more', 'yit' )
                    ),
 					'show_overlay' => array(
                        'title' => __('Show overlay', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
					),
                    'show_lightbox_hover' => array(
                        'title' => __('Show lightbox hover', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'no'
                    ),
                    'show_detail_hover' => array(
                        'title' => __('Show detail hover', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_title_hover' => array(
                        'title' => __('Show title hover', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_categories' => array(
                        'title' => __('Show categories', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_featured' => array(
                        'title' => __('Show featured', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'featured_excerpt_length' => array(
                        'title' => __('Limit words', 'yit'),
            			'type' => 'number',
                        'std' => '0'
                    ),
                    'other_posts_label' => array(
                        'title' => __('Other posts label', 'yit'),
                        'type' => 'text',
                        'std' => __( 'Other articles', 'yit' )
                    )
                ),
                'hide' => true
            ),
            /* === SECTION -> BLOG === */
            'section_blog' => array(
                'title' => __( 'Blog', 'yit' ),
                'description' => __( 'Print a blog type.', 'yit' ),
                'tab' => 'section',
            	'has_content' => false,
                'attributes' => array(                    
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
                    'category' => array(
                        'title' => __('Category', 'yit'),
            			'type' => 'select', // list of category
            			'options' => $categories,
                        'std' => '0'
                    ),
                    'show_excerpt' => array(
                        'title' => __('Show excerpt', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'excerpt_length' => array(
                        'title' => __('Limit words', 'yit'),
            			'type' => 'number',
                        'std' => '10'
                    ),
                    'show_title' => array(
                        'title' => __('Show title', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_comments' => array(
                        'title' => __('Show comments', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_date' => array(
                        'title' => __('Show date', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_readmore' => array(
                        'title' => __('Show read more', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'no'
                    ),
                    'readmore_text' => array(
                        'title' => __('More text', 'yit'),
            			'type' => 'text',
                        'std' => __( '|| Read more', 'yit' )
                    ),
                    'show_featured' => array(
                        'title' => __('Show featured', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'other_posts_label' => array(
                        'title' => __('Other posts label', 'yit'),
                        'type' => 'text',
                        'std' => __( 'Other articles', 'yit' )
                    )
                )
            ),
            /* === SECTION -> PORTFOLIO === */
            'section_portfolio' => array(
                'title' => __( 'Portfolio', 'yit' ),
                'description' => __( 'Print a portfolio type.', 'yit' ),
                'tab' => 'section',
            	'has_content' => false,
                'attributes' => array(                    
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
            			'options' => $this->get_portfolios(),
                        'std' => ''
                    ),
                    'show_excerpt' => array(
                        'title' => __('Show excerpt', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'excerpt_length' => array(
                        'title' => __('Limit words', 'yit'),
            			'type' => 'number',
                        'std' => '10'
                    ),
                    'show_title' => array(
                        'title' => __('Show title', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_readmore' => array(
                        'title' => __('Show read more', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'no'
                    ),
                    'readmore_text' => array(
                        'title' => __('More text', 'yit'),
            			'type' => 'text',
                        'std' => __( '|| Read more', 'yit' )
                    ),
 					'show_lightbox_hover' => array(
                        'title' => __('Show lightbox hover', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'no'
                    ),
                    'show_detail_hover' => array(
                        'title' => __('Show detail hover', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_title_hover' => array(
                        'title' => __('Show title hover', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_categories' => array(
                        'title' => __('Show categories', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_featured' => array(
                        'title' => __('Show featured', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'featured_excerpt_length' => array(
                        'title' => __('Featured limit words', 'yit'),
            			'type' => 'number',
                        'std' => '0'
                    ),
                )
            ),
            /* === SECTION -> SERVICES === */
            'section_services' => array(
                'title' => __( 'Services', 'yit' ),
                'description' => __( 'Print a services type.', 'yit' ),
                'tab' => 'section',
            	'has_content' => false,
                'attributes' => array(                    
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
                    'show_excerpt' => array(
                        'title' => __('Show excerpt', 'yit'),
            			'type' => 'checkbox',
            			'std' => 'yes'
                    ),
                    'excerpt_length' => array(
                        'title' => __('Limit words', 'yit'),
            			'type' => 'number',
                        'std' => '10'
                    ),
                    'show_title' => array(
                        'title' => __('Show title', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_detail_hover' => array(
                        'title' => __('Show detail hover', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_title_hover' => array(
                        'title' => __('Show title hover', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                )
            ),
            /* === END SECTION === */
            
            /* === START CPT Unlimited === */
			/* === SLIDER === */
            'slider' => array(
            	'title' => __('Slider', 'yit' ),
            	'description' =>  __('Show a created slider', 'yit' ),
            	'tab' => 'cpt',
            	'has_content' => false,
            	'attributes' => array(
            		'name' => array(
            			'title' => __('Name of slider', 'yit'),
            			'type' => 'select',
            			'options' => $this->get_sliders(),
            			'std'  => ''
            		),
            		'align' => array(
            			'title' => __('Alignment', 'yit'),
            			'type' => 'select',
            			'options' => array(
							'' => __('Select an option', 'yit'),
							'left' => __('Left', 'yit'),
							'right' => __('Right', 'yit'),
							'center' => __('Center', 'yit'),
						),
            			'std'  => ''
            		)
            	)
            ),		
            /* === CONTACT FORM === */
            'contact_form' => array(
            	'create' => false,
                'title' => __( 'Contact form', 'yit' ),
                'description' => __( 'Print a created contact form.', 'yit' ),
                'tab' => 'cpt',
            	'has_content' => false,
                'attributes' => array(                    
                    'name' => array(
                        'title' => __('Name', 'yit'),
            			'type' => 'select',
            			'options' => $this->get_contact_form(),
                        'std' => ''
                    )
                )
            ),
            /* === PORTFOLIO === */
            'portfolio' => array(
            	'create' => false,
                'title' => __( 'Portfolios', 'yit' ),
                'description' => __( 'Print a created portfolio.', 'yit' ),
                'tab' => 'cpt',
            	'has_content' => false,
                'attributes' => array(                    
                    'name' => array(
                        'title' => __('Name', 'yit'),
            			'type' => 'select',
            			'options' => $this->get_portfolios(),
                        'std' => ''
                    )
                )
            )
            /* === END CPT Unlimited === */
        );
		$this->shortcodes = apply_filters( 'yit_add_shortcodes', $shortcodes );
		asort( $this->shortcodes );
		$this->add_shortcodes();
	}
	
	
	/**
	 * Register shortcodes
	 * 
	 */
	public function add_shortcodes() {
		foreach( $this->shortcodes as $shortcode=> $atts) {
		    if ( isset( $atts['create'] ) && ! $atts['create'] ) continue;
			add_shortcode( $shortcode, array( &$this, 'add_shortcode') );
		}
	}
	
	
	/**
	 * Shortcode callback
	 * 
	 * @param $atts array()
	 * @param $content mixed
	 * @param $shortcode string
	 * 
	 * @return string
	 */
	public function add_shortcode( $atts, $content = null, $shortcode ) {
		
		if( isset($this->shortcodes[$shortcode]['unlimited']) && $this->shortcodes[$shortcode]['unlimited'] ) {
			$atts['content'] = $content;
		} else {
			//retrieves default atts
			$default_atts = array();
			
			if( !empty( $this->shortcodes[$shortcode]['attributes'] ) ) {
				foreach( $this->shortcodes[$shortcode]['attributes'] as $name=>$type ) {
					$default_atts[$name] = isset($type['std']) ? $type['std'] : '';
				}
			}

			//combines with user attributes
			$atts = shortcode_atts( $default_atts, $atts);
			$atts['content'] = $content;
		}
		
		ob_start();
		yit_get_template( 'shortcodes/'.$shortcode.'.php', $atts );
		$shortcode_html = ob_get_clean();
		
		return apply_filters( 'yit_shortcode_' . $shortcode, $shortcode_html );
	}
	
	/**
	 * Add shortcodes style
	 * 
	 */
	public function add_shortcodes_css_js() {
	    $url = get_template_directory_uri() . '/core/assets/css/shortcodes.css';
	    yit_wp_enqueue_style(1200,'shortcodes_css', $url);
	  
	    wp_enqueue_script('shortcode_twitter', get_template_directory_uri() . '/core/assets/js/twitter-text.js', array('jquery'), '', true );
	    //yit_wp_enqueue_style(1200,'shortcode_twitter');
	  
	    yit_wp_enqueue_style(1200,'shortcode_tipsy_css', get_template_directory_uri() . '/core/assets/css/tipsy.css', array('jquery'), '', true );
	    wp_enqueue_script('shortcode_tipsy_js', get_template_directory_uri() . '/core/assets/js/jquery.tipsy.js', array('jquery'), '', true );
	    //yit_wp_enqueue_style(1200,'shortcode_tipsy_js');
	  
	    wp_enqueue_script('shortcode_cycle_js', get_template_directory_uri() . '/core/assets/js/jquery.cycle.min.js', array('jquery'), '', true );
  	    //yit_wp_enqueue_style(1200,'shortcodes_cycle_js');
	  
	    wp_enqueue_script('shortcode_js', get_template_directory_uri() . '/core/assets/js/shortcodes.js', array('jquery'), '', true );
	    //yit_wp_enqueue_style(1200,'shortcodes_js');
	  
	 }

	/**
	 * Get categories to show in select menu
	 * 
	 */
	public function yit_get_categories(){
		$cats = get_categories('orderby=name&use_desc_for_title=1&hierarchical=1&style=0&hide_empty=0');
		$categories = array();
		$categories['0'] = __('All categories', 'yit');
		foreach ($cats as $cat) : 
			$categories[$cat->slug] = ($cat->cat_name) ? $cat->cat_name : 'ID: '. $cat->cat_name;
		endforeach;
		return $categories;		
	}	
	
	/**
	 * Get sliders to show in select menu
	 * 
	 */
	public function get_sliders(){					
		$sliders = yit_get_model('cpt_unlimited')->get_posts_types('sliders');
		$s = array();
		foreach( $sliders as $slider ): 
			 $s[$slider->post_name] = ($slider->post_title) ? $slider->post_title : 'Slider ID: ' . $slider->ID;
		endforeach;
		return $s;
	}
	
	/**
	 * Get portfolios to show in select menu
	 * 
	 */
	public function get_portfolios(){			
		$portfolios = yit_get_model('cpt_unlimited')->get_posts_types('portfolios');
		$p = array();
		foreach( $portfolios as $portfolio ): 
			 $p[$portfolio->post_name] = ($portfolio->post_title) ? $portfolio->post_title : 'Portfolio ID: ' . $portfolio->ID;
		endforeach;
		return $p;
	}	
		
	/**
	 * Get contact form to show in select menu
	 * 
	 */
	public function get_contact_form(){			
		$contact = yit_get_model('cpt_unlimited')->get_posts_types('contactform');
		$c = array();
		foreach( $contact as $cont ): 
			 $c[$cont->post_name] = ($cont->post_title) ? $cont->post_title : 'Form ID: '. $cont->ID;
		endforeach;
		return $c;
	}
    
    /**
	 * Get features tabs to show in select menu
	 * 
	 */
    public function get_features_tabs(){			
		$featurestabs = yit_get_model('cpt_unlimited')->get_posts_types('featurestab');
		$a = array();
		foreach( $featurestabs as $featurestab ): 
			 $a[$featurestab->post_name] = ($featurestab->post_title) ? $featurestab->post_title : 'Accordion ID: ' . $featurestab->ID;
		endforeach;
		return $a;
	}        
	
	/**
	 * Get accordions to show in select menu
	 * 
	 */
	public function get_accordions(){			
		$accordions = yit_get_model('cpt_unlimited')->get_posts_types('accordions');
		$a = array();
		foreach( $accordions as $accordion ): 
			 $a[$accordion->post_name] = ($accordion->post_title) ? $accordion->post_title : 'Accordion ID: ' . $accordion->ID;
		endforeach;
		return $a;
	}	
	
	/**
	 * Get set icons to show in select menu
	 * 
	 */
	public function get_set_icons(){
		$icons = (glob('../../../../images/icons/set_icons/*.png'));
		$del = array('../../../../images/icons/set_icons/', '32.png','48.png','.png');
		
		$set_icons = array('none' => 'none');
		if ($icons) :
			foreach ($icons as $ic) :
				$name = str_replace($del, '', $ic);
				$set_icons = array_merge( (array) $set_icons, array($name => $name) );
			endforeach;
		endif;
		$set_icons = array_unique($set_icons);		
		return $set_icons;		
	}
	
	/**
	 * Get CSS style of button to show in Color select menu
	 * 
	 */
	public function get_button_style(){
		$style = (glob('../../../assets/css/buttons/*.css'));
		$del = array('../../../assets/css/buttons/', '.css');
		
		$button_style = array('' => 'Custom color');		
		if ($style) :
			foreach ($style as $s) :
				$name = str_replace($del, '', $s);
				$button_style = array_merge( (array) $button_style, array($name => $name) );
			endforeach;
		endif;
		$button_style = array_unique($button_style);		
		return $button_style;		
	}
	
	/**
	 * Get CSS style of button to show in Color select menu
	 * 
	 */
	public function get_awesome_icons(){				
		$config = YIT_Config::load();
		return $config['awesome_icons'];
	}

}