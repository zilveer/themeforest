<?php

defined('WEBNUS_TEXT_DOMAIN') or define('WEBNUS_TEXT_DOMAIN', 'WEBNUS_TEXT_DOMAIN');
class PageNavi_Options_Page extends scbAdminPage {

	
	
	function setup() {
		

		$this->args = array(
			'page_title' => __( 'PageNavi Settings', WEBNUS_TEXT_DOMAIN ),
			'menu_title' => __( 'PageNavi', WEBNUS_TEXT_DOMAIN ),
			'page_slug' => 'pagenavi',
		);
	}

	function validate( $options, $temp = null ) {
		foreach ( array( 'style', 'num_pages', 'num_larger_page_numbers', 'larger_page_numbers_multiple' ) as $key )
			$options[$key] = absint( @$options[$key] );

		foreach ( array( 'use_pagenavi_css', 'always_show' ) as $key )
			$options[$key] = (bool) @$options[$key];

		return $options;
	}

	function page_content() {
		$rows = array(
			array(
				'title' => __( 'Text For Number Of Pages', WEBNUS_TEXT_DOMAIN ),
				'type' => 'text',
				'name' => 'pages_text',
				'extra' => 'size="50"',
				'desc' => '<br />
					%CURRENT_PAGE% - ' . __( 'The current page number.', WEBNUS_TEXT_DOMAIN ) . '<br />
					%TOTAL_PAGES% - ' . __( 'The total number of pages.', WEBNUS_TEXT_DOMAIN )
			),

			array(
				'title' => __( 'Text For Current Page', WEBNUS_TEXT_DOMAIN ),
				'type' => 'text',
				'name' => 'current_text',
				'desc' => '<br />
					%PAGE_NUMBER% - ' . __( 'The page number.', WEBNUS_TEXT_DOMAIN )
			),

			array(
				'title' => __( 'Text For Page', WEBNUS_TEXT_DOMAIN ),
				'type' => 'text',
				'name' => 'page_text',
				'desc' => '<br />
					%PAGE_NUMBER% - ' . __( 'The page number.', WEBNUS_TEXT_DOMAIN )
			),

			array(
				'title' => __( 'Text For First Page', WEBNUS_TEXT_DOMAIN ),
				'type' => 'text',
				'name' => 'first_text',
				'desc' => '<br />
					%TOTAL_PAGES% - ' . __( 'The total number of pages.', WEBNUS_TEXT_DOMAIN )
			),

			array(
				'title' => __( 'Text For Last Page', WEBNUS_TEXT_DOMAIN ),
				'type' => 'text',
				'name' => 'last_text',
				'desc' => '<br />
					%TOTAL_PAGES% - ' . __( 'The total number of pages.', WEBNUS_TEXT_DOMAIN )
			),

			array(
				'title' => __( 'Text For Previous Page', WEBNUS_TEXT_DOMAIN ),
				'type' => 'text',
				'name' => 'prev_text',
			),

			array(
				'title' => __( 'Text For Next Page', WEBNUS_TEXT_DOMAIN ),
				'type' => 'text',
				'name' => 'next_text',
			),

			array(
				'title' => __( 'Text For Previous ...', WEBNUS_TEXT_DOMAIN ),
				'type' => 'text',
				'name' => 'dotleft_text',
			),

			array(
				'title' => __( 'Text For Next ...', WEBNUS_TEXT_DOMAIN ),
				'type' => 'text',
				'name' => 'dotright_text',
			),
		);

		$out =
		 html( 'h3', __( 'Page Navigation Text', WEBNUS_TEXT_DOMAIN ) )
		.html( 'p', __( 'Leaving a field blank will hide that part of the navigation.', WEBNUS_TEXT_DOMAIN ) )
		.$this->table( $rows );


		$rows = array(
			array(
				'title' => __( 'Use pagenavi-css.css', WEBNUS_TEXT_DOMAIN ),
				'type' => 'checkbox',
				'name' => 'use_pagenavi_css',
			),

			array(
				'title' => __( 'Page Navigation Style', WEBNUS_TEXT_DOMAIN ),
				'type' => 'select',
				'name' => 'style',
				'values' => array( 1 => __( 'Normal', WEBNUS_TEXT_DOMAIN ), 2 => __( 'Drop-down List', WEBNUS_TEXT_DOMAIN ) ),
				'text' => false
			),

			array(
				'title' => __( 'Always Show Page Navigation', WEBNUS_TEXT_DOMAIN ),
				'type' => 'checkbox',
				'name' => 'always_show',
				'desc' => __( "Show navigation even if there's only one page.", WEBNUS_TEXT_DOMAIN )
			),

			array(
				'title' => __( 'Number Of Pages To Show', WEBNUS_TEXT_DOMAIN ),
				'type' => 'text',
				'name' => 'num_pages',
				'extra' => 'class="small-text"'
			),

			array(
				'title' => __( 'Number Of Larger Page Numbers To Show', WEBNUS_TEXT_DOMAIN ),
				'type' => 'text',
				'name' => 'num_larger_page_numbers',
				'extra' => 'class="small-text"',
				'desc' =>
				'<br />' . __( 'Larger page numbers are in addition to the normal page numbers. They are useful when there are many pages of posts.', WEBNUS_TEXT_DOMAIN ) .
				'<br />' . __( 'For example, WP-PageNavi will display: Pages 1, 2, 3, 4, 5, 10, 20, 30, 40, 50.', WEBNUS_TEXT_DOMAIN ) .
				'<br />' . __( 'Enter 0 to disable.', WEBNUS_TEXT_DOMAIN )
			),

			array(
				'title' => __( 'Show Larger Page Numbers In Multiples Of', WEBNUS_TEXT_DOMAIN ),
				'type' => 'text',
				'name' => 'larger_page_numbers_multiple',
				'extra' => 'class="small-text"',
				'desc' =>
				'<br />' . __( 'For example, if mutiple is 5, it will show: 5, 10, 15, 20, 25', WEBNUS_TEXT_DOMAIN )
			),
		);

		$out .=
		 html( 'h3', __( 'Page Navigation Options', WEBNUS_TEXT_DOMAIN ) )
		.$this->table( $rows );

		echo $this->form_wrap( $out );
	}
}

