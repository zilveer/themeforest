<?php

$post_categories = array('' => 'All');
if (function_exists('get_categories')) {
    $post_categories_raw = get_categories("hierarchical=0");
    foreach ($post_categories_raw as $post_category_raw)
    {
        $post_categories[$post_category_raw->slug] = $post_category_raw->name;
    }
}

$portfolio_categories = array('' => 'All');
if (function_exists('get_categories')) {
    $portfolio_categories_raw = get_categories("taxonomy=us_portfolio_category&hierarchical=0");
    foreach ($portfolio_categories_raw as $portfolio_category_raw)
    {
        $portfolio_categories[$portfolio_category_raw->slug] = $portfolio_category_raw->name;
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Blog Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['blog'] = array(
	'no_preview' => true,
	'params' => array(
        'type' => array(
            'type' => 'select',
            'label' => 'Style',
            'desc' => '',
            'options' => array(
                'square' => 'Square Image at left',
                'rounded' => 'Rounded Image at left',
                'masonry' => 'Masonry grid',
            )
        ),
		'columns' => array(
			'type' => 'select',
			'label' => 'Columns',
			'desc' => '',
            'options' => array(
                '1' => '1 column',
                '2' => '2 columns',
                '3' => '3 columns',
            )
		),
		'items' => array(
			'type' => 'text',
			'std' => '4',
			'label' => 'Posts Quantity',
			'desc' => '',
		),
        'show_date' => array(
            'std' => false,
            'type' => 'checkbox',
            'label' => 'Date',
            'checkbox_text' => 'Show Post Date',
            'desc' => '',
        ),
        'show_author' => array(
            'std' => false,
            'type' => 'checkbox',
            'label' => 'Author',
            'checkbox_text' => 'Show Post Author',
            'desc' => '',
        ),
        'show_categories' => array(
            'std' => false,
            'type' => 'checkbox',
            'label' => 'Categories',
            'checkbox_text' => 'Show Post Categories',
            'desc' => '',
        ),
        'show_tags' => array(
            'std' => false,
            'type' => 'checkbox',
            'label' => 'Tags',
            'checkbox_text' => 'Show Post Tags',
            'desc' => '',
        ),
        'show_comments' => array(
            'std' => false,
            'type' => 'checkbox',
            'label' => 'Comments',
            'checkbox_text' => 'Show Post Comments',
            'desc' => '',
        ),
        'show_read_more' => array(
            'std' => false,
            'type' => 'checkbox',
            'label' => 'Read More',
            'checkbox_text' => 'Show Read More Buttons',
            'desc' => '',
        ),
		'category' => array(
			'type' => 'select',
			'label' => 'Category',
			'desc' => '',
			'options' => $post_categories,
		),
        'pagination' => array(
            'type' => 'select',
            'label' => 'Pagination',
            'desc' => '',
            'options' => array(
                '' => 'No Pagination',
                'regular' => 'Regular Pagination',
                'ajax' => 'Ajax Pagination (Load More button)'
            )
        ),
	),
	'shortcode' => '[blog type="{{type}}" columns="{{columns}}" items="{{items}}" show_date="{{show_date}}" show_author="{{show_author}}" show_categories="{{show_categories}}" show_tags="{{show_tags}}" show_comments="{{show_comments}}" show_read_more="{{show_read_more}}" category="{{category}}" pagination="{{pagination}}"]',
	'popup_title' => 'Insert Blog shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	Portfolio Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['portfolio'] = array(
    'no_preview' => true,
    'params' => array(
        'columns' => array(
            'type' => 'select',
            'label' => 'Columns',
            'desc' => '',
            'options' => array(
                '5' => '5 columns',
                '4' => '4 columns',
                '3' => '3 columns',
                '2' => '2 columns',
            )
        ),
        'items' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'Items Quantity',
            'desc' => 'If left blank, equals amount of Columns',
        ),
        'style' => array(
            'type' => 'select',
            'label' => 'Items Style',
            'desc' => '',
            'options' => array(
                'type_1' => 'Type 1',
                'type_2' => 'Type 2',
                'type_3' => 'Type 3',
                'type_4' => 'Type 4',
                'type_5' => 'Type 5',
                'type_6' => 'Type 6',
            )
        ),
        'align' => array(
            'type' => 'select',
            'label' => 'Items Text Alignment',
            'desc' => '',
            'options' => array(
                'center' => 'Center',
                'left' => 'Left',
                'right' => 'Right',
            )
        ),
        'ratio' => array(
            'type' => 'select',
            'label' => 'Items Ratio',
            'desc' => '',
            'options' => array(
                '3:2' => '3:2 (landscape)',
                '4:3' => '4:3 (landscape)',
                '1:1' => '1:1 (square)',
                '2:3' => '2:3 (portrait)',
                '3:4' => '3:4 (portrait)',
            )
        ),
        'no_indents' => array(
            'std' => '0',
            'type' => 'checkbox',
            'label' => 'Items Indents',
            'checkbox_text' => 'Add indents between Items',
            'desc' => '',
        ),
        'meta' => array(
            'type' => 'select',
            'label' => 'Items Meta',
            'desc' => 'Displays text below Item title',
            'options' => array(
                '' => 'Do not show',
                'date' => 'Show Item date',
                'category' => 'Show Item category',
            )
        ),
        'filters' => array(
            'std' => '0',
            'type' => 'checkbox',
            'label' => 'Filtering',
            'checkbox_text' => 'Display bar with filtering by category',
            'desc' => '',
        ),
        'category' => array(
            'type' => 'select',
            'label' => 'Category',
            'desc' => 'Displays items of selected category only',
            'options' => $portfolio_categories,
        ),
        'pagination' => array(
            'std' => '0',
            'type' => 'checkbox',
            'label' => 'Pagination',
            'checkbox_text' => 'Enable pagination',
            'desc' => 'If checked, Items Quantity parameter sets amount of Items per page',
        ),
        'items_bg_color' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'Items Background Color (optional)',
            'desc' => 'Set color in #000000 format',
        ),
        'items_text_color' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'Items Text Color (optional)',
            'desc' => 'Set color in #000000 format',
        ),
    ),
    'shortcode' => '[portfolio columns="{{columns}}" items="{{items}}" style="{{style}}" align="{{align}}" ratio="{{ratio}}" indents="{{no_indents}}" meta="{{meta}}" filters="{{filters}}" category="{{category}}" pagination="{{pagination}}" items_bg_color="{{items_bg_color}}" items_text_color="{{items_text_color}}"]',
    'popup_title' => 'Insert Portfolio shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'URL',
			'desc' => 'Add the button\'s url eg http://example.com'
		),
		'text' => array(
			'std' => 'Push the Button',
			'type' => 'text',
			'label' => 'Text',
			'desc' => '',
		),
		'color' => array(
			'type' => 'select',
			'label' => 'Color Style',
			'desc' => '',
			'options' => array(
				'primary' => 'Primary (theme color)',
				'secondary' => 'Secondary (theme color)',
				'text' => 'Text (theme color)',
				'faded' => 'Faded (theme color)',
                'white' => 'White',
                'red' => 'Red',
                'blue' => 'Blue',
                'green' => 'Green',
                'yellow' => 'Yellow',
                'purple' => 'Purple',
                'pink' => 'Pink',
                'navy' => 'Navy',
                'brown' => 'Brown',
                'midnight' => 'Midnight',
                'teal' => 'Teal',
                'cream' => 'Cream',
                'lime' => 'Lime',
                'transparent' => 'Transparent',
			)
		),
        'outlined' => array(
            'std' => '0',
            'type' => 'checkbox',
            'label' => 'Outlined',
            'checkbox_text' => 'Apply Outlined Style to the Button',
            'desc' => '',
        ),
		'size' => array(
			'type' => 'select',
			'label' => 'Size',
			'desc' => '',
			'options' => array(
				'' => 'Normal',
				'small' => 'Small',
				'big' => 'Big'
			)
		),
		'icon' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Icon (optional)',
			'desc' => 'FontAwesome Icon name. <a href="http://fontawesome.io/icons/" target="_blank">Full list of icons</a>',
		),
		'external' => array(
			'std' => false,
			'type' => 'checkbox',
			'label' => 'External Link',
			'checkbox_text' => 'Open link in new tab',
			'desc' => '',
		),
	),
	'shortcode' => '[button url="{{url}}" text="{{text}}" size="{{size}}" color="{{color}}" outlined="{{outlined}}" icon="{{icon}}" external="{{external}}"]',
	'popup_title' => 'Insert Button shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Team Member Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['team_member'] = array(
    'params' => array(
        'name' => array(
            'std' => 'John Smith',
            'type' => 'text',
            'label' => 'Name',
            'desc' => '',
        ),
        'role' => array(
            'std' => 'designer',
            'type' => 'text',
            'label' => 'Role',
            'desc' => '',
        ),
        'img' => array(
            'std' => '',
            'type' => 'image',
            'label' => 'Photo',
            'desc' => 'Recommended size 500x500 px',
        ),
        'rounded' => array(
            'std' => false,
            'type' => 'checkbox',
            'label' => 'Rounded Photo',
            'checkbox_text' => 'Place photo in a circle',
            'desc' => '',
        ),
        'email' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'Email',
            'desc' => '',
        ),
        'facebook' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'Facebook',
            'desc' => '',
        ),
        'twitter' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'Twitter',
            'desc' => '',
        ),
        'linkedin' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'LinkedIn',
            'desc' => '',
        ),
        'custom_icon' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'Custom Icon',
            'desc' => 'FontAwesome Icon name. <a href="http://fontawesome.io/icons/" target="_blank">Full list of icons</a>',
        ),
        'custom_link' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'Custom Link',
            'desc' => 'Fill Custom Link and Custom Icon fields to display additional icon for Team Member',
        ),
        'style' => array(
            'type' => 'select',
            'label' => 'Layout Style',
            'desc' => '',
            'options' => array(
                'type_1' => 'Icons below photo',
                'type_2' => 'Icons below name and description',
                'type_3' => 'Icons inside photo on hover',
                'type_4' => 'All content inside photo',
            )
        ),
        'link' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'Link (optional)',
            'desc' => 'Put URL here to turn Member name and photo into link',
        ),
        'external' => array(
            'std' => false,
            'type' => 'checkbox',
            'label' => 'External Link',
            'checkbox_text' => 'Open link in new tab',
            'desc' => '',
        ),
        'content' => array(
            'std' => '',
            'type' => 'textarea',
            'label' => 'Member Description (optional)',
            'desc' => '',
        ),
    ),
	'no_preview' => true,
	'shortcode' => '[team_member name="{{name}}" role="{{role}}" img="{{img}}" rounded="{{rounded}}" email="{{email}}" facebook="{{facebook}}" twitter="{{twitter}}" linkedin="{{linkedin}}" custom_icon="{{custom_icon}}" custom_link="{{custom_link}}" style="{{style}}" link="{{link}}" external="{{external}}"]{{content}}[/team_member]',
	'popup_title' => 'Insert Team Member shortcode',


);

/*-----------------------------------------------------------------------------------*/
/*	Separator Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['separator'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => 'Separator Type',
			'desc' => '',
			'options' => array(
				'invisible' => 'Invisible',
				'' => 'Standard Line',
				'fullwidth' => 'Full Width Line',
				'short' => 'Short Line',
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => 'Separator Height',
			'desc' => '',
			'options' => array(
				'medium' => 'Medium',
				'small' => 'Small',
				'big' => 'Big',
				'huge' => 'Huge',
			)
		),
		'icon' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Icon (optional)',
			'desc' => 'FontAwesome Icon name. <a href="http://fontawesome.io/icons/" target="_blank">Full list of icons</a>',
		),
	),
	'shortcode' => '[separator type="{{type}}" size="{{size}}" icon="{{icon}}"]',
	'popup_title' => 'Insert Separator shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Icon Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['icon'] = array(
	'no_preview' => true,
	'params' => array(
		'icon' => array(
			'std' => 'star',
			'type' => 'text',
			'label' => 'Icon',
			'desc' => 'FontAwesome Icon name. <a href="http://fontawesome.io/icons/" target="_blank">Full list of icons</a>',
		),
		'color' => array(
			'type' => 'select',
			'label' => 'Color',
			'desc' => '',
			'options' => array(
				'primary' => 'Primary (theme color)',
				'secondary' => 'Secondary (theme color)',
				'text' => 'Text (theme color)',
				'faded' => 'Faded (theme color)',
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => 'Size',
			'desc' => '',
			'options' => array(
				'tiny' => 'Tiny',
				'small' => 'Small',
				'medium' => 'Medium',
				'big' => 'Big',
				'huge' => 'Huge',
			)
		),
        'outline' => array(
            'type' => 'select',
            'label' => 'Outline',
            'desc' => '',
            'options' => array(
                '' => 'No Outline',
                'square' => 'Square Outline',
                'circle' => 'Circle Outline',
            )
        ),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Link (optional)',
			'desc' => '',
		),
	),

	'shortcode' => '[icon icon="{{icon}}" color="{{color}}" outline="{{outline}}" size="{{size}}" link="{{link}}"]',
	'popup_title' => 'Insert Icon shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	IconBox Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['iconbox'] = array(
	'no_preview' => true,
	'params' => array(
		'icon' => array(
			'std' => 'star',
			'type' => 'text',
			'label' => 'Icon',
			'desc' => 'FontAwesome Icon name. <a href="http://fontawesome.io/icons/" target="_blank">Full list of icons</a>',
		),
		'pos' => array(
			'type' => 'select',
			'label' => 'Icon Position',
			'desc' => '',
			'options' => array(
				'top' => 'Top',
				'left' => 'Left',
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => 'Icon Size',
			'desc' => '',
			'options' => array(
				'tiny' => 'Tiny',
				'small' => 'Small',
				'medium' => 'Medium',
				'big' => 'Big',
				'huge' => 'Huge ',
			)
		),
        'color' => array(
            'type' => 'select',
            'label' => 'Icon Color',
            'desc' => '',
            'options' => array(
                'primary' => 'Primary (theme color)',
                'secondary' => 'Secondary (theme color)',
                'text' => 'Text (theme color)',
                'faded' => 'Faded (theme color)',
            )
        ),
        'outline' => array(
            'type' => 'select',
            'label' => 'Icon Outline',
            'desc' => '',
            'options' => array(
                '' => 'No Outline',
                'square' => 'Square Outline',
                'circle' => 'Circle Outline',
            )
        ),
		'title' => array(
			'std' => 'Title goes here',
			'type' => 'text',
			'label' => 'Title',
			'desc' => '',
		),
		'content' => array(
			'std' => 'Any text goes here',
			'type' => 'textarea',
			'label' => 'IconBox Text',
			'desc' => '',
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Link (optional)',
			'desc' => '',
		),
		'external' => array(
			'std' => false,
			'type' => 'checkbox',
			'label' => 'External Link',
			'checkbox_text' => 'Open link in new tab',
			'desc' => '',
		),
		'img' => array(
			'std' => '',
			'type' => 'image',
			'label' => 'Image (optional)',
			'desc' => '',
		),
	),
	'shortcode' => '[iconbox icon="{{icon}}" pos="{{pos}}" size="{{size}}" color="{{color}}" outline="{{outline}}" title="{{title}}" link="{{link}}" external="{{external}}" img="{{img}}"] {{content}} [/iconbox]',
	'popup_title' => 'Insert IconBox shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Testimonials Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['testimonial'] = array(

	'no_preview' => true,
	'popup_title' => 'Insert Testimonial shortcode',

	'params' => array(
		'author' => array(
			'std' => 'Author Name',
			'type' => 'text',
			'label' => 'Author',
			'desc' => '',
		),
		'description' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Description',
			'desc' => 'Author\'s Description',
		),
        'img' => array(
            'std' => '',
            'type' => 'image',
            'label' => 'Photo',
            'desc' => 'Recommended size 100x100 px',
        ),
		'content' => array(
			'std' => 'This Theme is brilliant!',
			'type' => 'textarea',
			'label' => 'Testimonial Text',
			'desc' => '',
		),
	),
	'shortcode' => '<br>[testimonial author="{{author}}" description="{{description}}" img="{{img}}"]{{content}}[/testimonial]',
);

/*-----------------------------------------------------------------------------------*/
/*	Slider Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['simple_slider'] = array(
	'params' => array(),
	'no_preview' => true,
	'shortcode' => '[simple_slider auto_scroll="0" interval="5" arrows="1" type=""] {{child_shortcode}} [/simple_slider]',
	'popup_title' => 'Insert Simple Slider shortcode',

	'child_shortcode' => array(
		'params' => array(
			'img' => array(
				'std' => '',
				'type' => 'image',
				'label' => 'Image',
				'desc' => '',
			),
		),
		'shortcode' => '<br>[simple_slide img="{{img}}"]',
		'clone_button' => 'Add Slide'
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Counter Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['counter'] = array(
	'no_preview' => true,
	'params' => array(
		'count' => array(
			'std' => '99',
			'type' => 'text',
			'label' => 'Number',
			'desc' => '',
		),
        'color' => array(
            'type' => 'select',
            'label' => 'Number Color',
            'desc' => '',
            'options' => array(
                'text' => 'Text (theme color)',
                'primary' => 'Primary (theme color)',
                'secondary' => 'Secondary (theme color)',
				'faded' => 'Faded (theme color)',
            )
        ),
        'size' => array(
            'type' => 'select',
            'label' => 'Number Size',
            'desc' => '',
            'options' => array(
                'medium' => 'Medium',
                'small' => 'Small',
                'big' => 'Big',
            )
        ),
        'title' => array(
            'std' => 'Projects completed',
            'type' => 'text',
            'label' => 'Title',
            'desc' => '',
        ),
		'prefix' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Prefix (optional)',
			'desc' => 'Text before number',
		),
		'suffix' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Suffix (optional)',
			'desc' => 'Text after number',
		),
	),
	'shortcode' => '[counter count="{{count}}" color="{{color}}" size="{{size}}" title="{{title}}" prefix="{{prefix}}" suffix="{{suffix}}"]',
	'popup_title' => 'Insert Counter shortcode'
);


/*-----------------------------------------------------------------------------------*/
/*	Tabs Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['tabs'] = array(
	'params' => array(),
	'no_preview' => true,
	'shortcode' => '[tabs] {{child_shortcode}} <br>[/tabs]',
	'popup_title' => 'Insert Tabs shortcode',

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => 'Title',
				'type' => 'text',
				'label' => 'Tab Title',
				'desc' => '',
			),
			'content' => array(
				'std' => 'You can use other shortcodes here',
				'type' => 'textarea',
				'label' => 'Tab Content',
				'desc' => ''
			),
			'icon' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Tab Icon (optional)',
				'desc' => 'FontAwesome Icon name. <a href="http://fontawesome.io/icons/" target="_blank">Full list of icons</a>',
			),
			'no_indents' => array(
				'std' => false,
				'type' => 'checkbox',
				'label' => '',
				'checkbox_text' => 'Remove indents around Tab Content',
				'desc' => '',
			),
			'open' => array(
				'std' => false,
				'type' => 'checkbox',
				'label' => '',
				'checkbox_text' => 'Open this Tab',
				'desc' => '',
			),
		),
		'shortcode' => '<br>[item title="{{title}}" icon="{{icon}}" no_indents="{{no_indents}}" open="{{open}}" bg_color="" text_color=""] {{content}} [/item]',
		'clone_button' => 'Add Tab'
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Toggle Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['toggle'] = array(
	'params' => array(),
	'no_preview' => true,
	'shortcode' => '[toggle] {{child_shortcode}} [/toggle]',
	'popup_title' => 'Insert Toggles shortcode',

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => 'Title',
				'type' => 'text',
				'label' => 'Toggle Title',
				'desc' => '',
			),
			'content' => array(
				'std' => 'You can use other shortcodes here',
				'type' => 'textarea',
				'label' => 'Toggle Content',
				'desc' => ''
			),
			'icon' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Toggle Icon (optional)',
				'desc' => 'FontAwesome Icon name. <a href="http://fontawesome.io/icons/" target="_blank">Full list of icons</a>',
			),
			'no_indents' => array(
				'std' => false,
				'type' => 'checkbox',
				'label' => '',
				'checkbox_text' => 'Remove indents around Toggle Content',
				'desc' => '',
			),
			'open' => array(
				'std' => false,
				'type' => 'checkbox',
				'label' => '',
				'checkbox_text' => 'Open this Toggle',
				'desc' => '',
			),
		),
		'shortcode' => '<br>[item title="{{title}}" icon="{{icon}}" no_indents="{{no_indents}}" open="{{open}}" bg_color="" text_color=""] {{content}} [/item]',
		'clone_button' => 'Add Toggle'
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Accordion Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['accordion'] = array(
	'params' => array(),
	'no_preview' => true,
	'shortcode' => '[accordion] {{child_shortcode}} [/accordion]',
	'popup_title' => 'Insert Accordion shortcode',

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => 'Title',
				'type' => 'text',
				'label' => 'Accordion Section Title',
				'desc' => '',
			),
			'content' => array(
				'std' => 'You can use other shortcodes here',
				'type' => 'textarea',
				'label' => 'Accordion Section Content',
				'desc' => ''
			),
			'icon' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Accordion Section Icon (optional)',
				'desc' => 'FontAwesome Icon name. <a href="http://fontawesome.io/icons/" target="_blank">Full list of icons</a>',
			),
			'no_indents' => array(
				'std' => false,
				'type' => 'checkbox',
				'label' => '',
				'checkbox_text' => 'Remove indents around Accordion Section Content',
				'desc' => '',
			),
			'open' => array(
				'std' => false,
				'type' => 'checkbox',
				'label' => '',
				'checkbox_text' => 'Open this Accordion Section',
				'desc' => '',
			),
		),
		'shortcode' => '<br>[item title="{{title}}" icon="{{icon}}" no_indents="{{no_indents}}" open="{{open}}" bg_color="" text_color=""] {{content}} [/item]',
		'clone_button' => 'Add Accordion Section'
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Video Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['responsive_video'] = array(
	'no_preview' => true,
	'params' => array(
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Video link',
			'desc' => 'Link to the video. More about supported formats at <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>',
		),

	),
	'shortcode' => '[responsive_video link="{{link}}"]',
	'popup_title' => 'Insert Video shortcode'
);


/*-----------------------------------------------------------------------------------*/
/*	Google Maps Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['gmaps'] = array(
	'no_preview' => true,
	'params' => array(
		'address' => array(
			'std' => '1600 Amphitheatre Parkway, Mountain View, CA 94043, United States',
			'type' => 'text',
			'label' => 'Map Address',
			'desc' =>  '',
		),
		'marker' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Map Marker text',
			'desc' =>  'Leave blank to hide the Marker.',
		),
		'height' => array(
			'std' => '400',
			'type' => 'text',
			'label' => 'Map height',
			'desc' =>  'Enter map height in pixels. Default: 400.',
		),
		'type' => array(
			'type' => 'select',
			'label' => 'Map type',
			'desc' => '',
			'options' => array(
				'ROADMAP' => 'Roadmap',
				'SATELLITE' => 'Satellite',
				'HYBRID' => 'Map + Terrain',
				'TERRAIN' => 'Terrain',
			)
		),
		'zoom' => array(
			'type' => 'select',
			'label' => 'Map zoom',
			'desc' => '',
			'options' => array(
				'14' => '14 - Default',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'11' => '11',
				'12' => '12',
				'13' => '13',
				'15' => '15',
				'16' => '16',
				'17' => '17',
				'18' => '18',
				'19' => '19',
				'20' => '20',
			)
		),
		'latitude' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Map Latitude',
			'desc' =>  'If Longitude and Latitude are set, they override the Address for Google Map.',
		),
		'longitude' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Map Longitude',
			'desc' =>  'If Longitude and Latitude are set, they override the Address for Google Map.',
		),
	),
	'shortcode' => '[gmaps address="{{address}}" latitude="{{latitude}}" longitude="{{longitude}}" marker="{{marker}}" height="{{height}}" type="{{type}}" zoom="{{zoom}}"]',
	'popup_title' => 'Insert Google Maps shortcode'
);


/*-----------------------------------------------------------------------------------*/
/*	Social Links Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['social_links'] = array(
	'no_preview' => true,
	'params' => array(
		'size' => array(
			'type' => 'select',
			'label' => 'Icons Size',
			'desc' => '',
			'options' => array(
				'normal' => 'Normal',
				'' => 'Small',
				'big' => 'Big',
			)
		),
		'align' => array(
			'type' => 'select',
			'label' => 'Align',
			'desc' => '',
			'options' => array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
			)
		),
		'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Email',
			'desc' => '',
		),
		'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Facebook',
			'desc' => '',
		),
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Twitter',
			'desc' => '',
		),
		'google' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Google+',
			'desc' => '',
		),
		'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'LinkedIn',
			'desc' => '',
		),
		'youtube' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'YouTube',
			'desc' => '',
		),
		'vimeo' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Vimeo',
			'desc' => '',
		),
		'flickr' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Flickr',
			'desc' => '',
		),
		'instagram' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Instagram',
			'desc' => '',
		),
		'behance' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Behance',
			'desc' => '',
		),
		'pinterest' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Pinterest',
			'desc' => '',
		),
		'skype' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Skype',
			'desc' => '',
		),
		'tumblr' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Tumblr',
			'desc' => '',
		),
		'dribbble' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Dribbble',
			'desc' => '',
		),
		'vk' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Vkontakte',
			'desc' => '',
		),
        'xing' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'Xing',
            'desc' => '',
        ),
        'soundcloud' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'SoundCloud',
            'desc' => '',
        ),
        'yelp' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'Yelp',
            'desc' => '',
        ),
        'twitch' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'Twitch',
            'desc' => '',
        ),
        'deviantart' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'DeviantArt',
            'desc' => '',
        ),
        'foursquare' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'Foursquare',
            'desc' => '',
        ),
        'github' => array(
            'std' => '',
            'type' => 'text',
            'label' => 'GitHub',
            'desc' => '',
        ),
		'rss' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'RSS',
			'desc' => '',
		),

	),
	'shortcode' => '[social_links size="{{size}}" align="{{align}}" email="{{email}}" facebook="{{facebook}}" twitter="{{twitter}}" google="{{google}}" linkedin="{{linkedin}}" youtube="{{youtube}}" vimeo="{{vimeo}}" flickr="{{flickr}}" instagram="{{instagram}}" behance="{{behance}}" pinterest="{{pinterest}}" skype="{{skype}}" tumblr="{{tumblr}}" dribbble="{{dribbble}}" vk="{{vk}}" xing="{{xing}}" soundcloud="{{soundcloud}}" yelp="{{yelp}}" twitch="{{twitch}}" deviantart="{{deviantart}}" foursquare="{{foursquare}}" github="{{github}}" rss="{{rss}}"]',
	'popup_title' => 'Insert Social Links shortcode'
);


/*-----------------------------------------------------------------------------------*/
/*	ActionBox Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['actionbox'] = array(
	'no_preview' => true,
	'params' => array(
		'color' => array(
			'type' => 'select',
			'label' => 'Color Style',
			'desc' => '',
			'options' => array(
				'primary' => 'Primary Background (theme color)',
				'secondary' => 'Secondary Background (theme color)',
			)
		),
		'title' => array(
			'std' => 'This is Call-to-Action Title',
			'type' => 'text',
			'label' => 'ActionBox Title',
			'desc' =>  '',
		),
		'description' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => 'ActionBox Description (optional)',
			'desc' =>  '',
		),
		'btn_label' => array(
			'std' => 'Click Me!',
			'type' => 'text',
			'label' => 'Button Label',
			'desc' => '',
		),
		'btn_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button Link',
			'desc' => '',
		),
		'btn_color' => array(
			'type' => 'select',
			'label' => 'Button Color',
			'desc' => '',
			'options' => array(
				'primary' => 'Primary (theme color)',
				'secondary' => 'Secondary (theme color)',
				'text' => 'Text (theme color)',
				'faded' => 'Faded (theme color)',
				'white' => 'White',
                'red' => 'Red',
                'blue' => 'Blue',
                'green' => 'Green',
                'yellow' => 'Yellow',
                'purple' => 'Purple',
                'pink' => 'Pink',
                'navy' => 'Navy',
                'brown' => 'Brown',
                'midnight' => 'Midnight',
                'teal' => 'Teal',
                'cream' => 'Cream',
                'lime' => 'Lime',
			)
		),
		'btn_size' => array(
			'type' => 'select',
			'label' => 'Button Size',
			'desc' => '',
			'options' => array(
				'' => 'Normal',
				'small' => 'Small',
				'big' => 'Big'
			)
		),
		'btn_icon' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button Icon (optional)',
			'desc' => 'FontAwesome Icon name. <a href="http://fontawesome.io/icons/" target="_blank">Full list of icons</a>',
		),
		'btn_external' => array(
			'std' => false,
			'type' => 'checkbox',
			'label' => 'Button External',
			'checkbox_text' => 'Open link in new tab',
			'desc' => '',
		),
	),
	'shortcode' => '[actionbox color="{{color}}" title="{{title}}" description="{{description}}" btn_label="{{btn_label}}" btn_link="{{btn_link}}" btn_color="{{btn_color}}" btn_size="{{btn_size}}" btn_icon="{{btn_icon}}" btn_external="{{btn_external}}"]',
	'popup_title' => 'Insert ActionBox shortcode'
);

$us_zilla_shortcodes['clients'] = array(
    'no_preview' => true,
    'params' => array(
        'auto_scroll' => array(
            'std' => '0',
            'type' => 'checkbox',
            'label' => 'Autoscroll',
            'checkbox_text' => 'Automatically scrolls Clients Logos',
            'desc' => '',
        ),
        'interval' => array(
            'std' => '3',
            'type' => 'text',
            'label' => 'Autoscroll Interval (in seconds)',
            'desc' => '',
        ),
        'arrows' => array(
            'std' => '0',
            'type' => 'checkbox',
            'label' => 'Navigation',
            'checkbox_text' => 'Show navigation arrows',
            'desc' => '',
        ),
    ),
    'shortcode' => '[clients auto_scroll="{{auto_scroll}}" interval="{{interval}}" arrows="{{arrows}}"]',
    'popup_title' => 'Insert Clients Logos shortcode'
);


/*-----------------------------------------------------------------------------------*/
/*	Mega Heading Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['mega_heading'] = array(
	'params' => array(),
	'no_preview' => true,
	'shortcode' => '[mega_heading align="center"] {{child_shortcode}} <br>[/mega_heading]',
	'popup_title' => 'Insert Mega Heading shortcode',

	'child_shortcode' => array(
		'params' => array(
			'content' => array(
				'std' => 'Any text goes here',
				'type' => 'text',
				'label' => 'Text',
				'desc' => '',
			),
			'color' => array(
				'type' => 'select',
				'label' => 'Color Style',
				'desc' => '',
				'options' => array(
					'white' => 'White',
					'black' => 'Black',
					'primary' => 'Primary',
					'secondary' => 'Secondary',
					'faded' => 'Faded',
					'light_bg' => 'Light Background',
					'dark_bg' => 'Dark Background',
					'primary_bg' => 'Primary Background',
					'secondary_bg' => 'Secondary Background',
					'faded_bg' => 'Faded Background',
				)
			),
		),
		'shortcode' => '<br>[heading_line color="{{color}}" new_line="0"] {{content}} [/heading_line]',
		'clone_button' => 'Add Line'
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Highlight Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['highlight'] = array(
	'params' => array(
        'color' => array(
            'type' => 'select',
            'label' => 'Color Style',
            'desc' => '',
            'options' => array(
                'white' => 'White',
                'black' => 'Black',
                'primary' => 'Primary',
                'secondary' => 'Secondary',
                'faded' => 'Faded',
                'light_bg' => 'Light Background',
                'dark_bg' => 'Dark Background',
                'primary_bg' => 'Primary Background',
                'secondary_bg' => 'Secondary Background',
                'faded_bg' => 'Faded Background',
            )
        )
    ),
	'no_preview' => true,
	'shortcode' => '[highlight color="{{color}}"] ... [/highlight]',
	'popup_title' => 'Insert Highlight shortcode',
);


/*-----------------------------------------------------------------------------------*/
/*	Alert Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['message_box'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => 'Message Type',
			'desc' => '',
			'options' => array(
				'info' => 'Notification (blue)',
				'attention' => 'Attention (yellow)',
				'success' => 'Success (green)',
				'error' => 'Error (red)',
			)
		),
		'content' => array(
			'std' => 'Message Text',
			'type' => 'textarea',
			'label' => 'Message Text',
			'desc' => '',
		)

	),
	'shortcode' => '[message_box type="{{type}}"] {{content}} [/message_box]',
	'popup_title' => 'Insert Message Box shortcode'
);