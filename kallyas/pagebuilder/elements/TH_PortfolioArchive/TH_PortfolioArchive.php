<?php if(! defined('ABSPATH')){ return; }

/*
 Name: Portfolio Archive
 Description: Create and display a Portfolio archive element
 Class: TH_PortfolioArchive
 Category: content
 Level: 3
 Keywords: category, showcase, projects, sortable, carousel
*/
/**
 * Class TH_PortfolioArchive
 *
 * Create and display a Portfolio Category element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_PortfolioArchive extends ZnElements
{
	public static function getName(){
		return __( "Portfolio Category", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		global $paged, $zn_config;

		$options = $this->data['options'];

		echo '<div class="elm-portfolio-archive '.$this->data['uid'].' '.zn_get_element_classes($options).'" '.zn_get_element_attributes($options).'>';

		// Get the proper page - this resolves the pagination on static frontpage
		if( get_query_var('paged') ){ $paged = get_query_var('paged'); }
		elseif( get_query_var('page') ){ $paged = get_query_var('page'); }
		else{ $paged = 1; }

		$portfolio_style = $this->opt( 'portfolio_style', 'portfolio_sortable' );

		// Forwared element set-up to templates
		$zn_config['port_columns'] = $this->opt( 'ports_num_columns', '4' );
		$zn_config['ports_carousel_columns'] = $this->opt( 'ports_carousel_columns', '1' );
		$zn_config['frame_style'] = $this->opt( 'frame_style', 'classic' );
		$zn_config['portfolio_categories'] = $this->opt( 'portfolio_categories' );
		$zn_config['posts_per_page'] = $this->opt( 'ports_per_page_visible', 4 );
		$zn_config['ports_extra_content'] = $this->opt( 'ports_extra_content', 'no' );
		$zn_config['ptf_sort_activebutton'] = $this->opt( 'ptf_sort_activebutton', '*' );
		$zn_config['ptf_sort_loadmore'] = $this->opt( 'ptf_sort_loadmore', 'no' );
		$zn_config['portfolio_scheme'] = $this->opt( 'portfolio_scheme', '' );
		$zn_config['ptf_show_sort'] = $this->opt( 'ptf_show_sort', 'yes' );
		$zn_config['ptf_cats_align'] = $this->opt( 'ptf_cats_align', 'left' );
		$zn_config['ptf_show_desc'] = $this->opt( 'ptf_show_desc', 'yes' );
		$zn_config['ptf_show_title'] = $this->opt( 'ptf_show_title', 'yes' );
		$zn_config['ptf_sortby_type'] = $this->opt( 'ptf_sortby_type', 'date' );
		$zn_config['ptf_sort_dir'] = $this->opt( 'ptf_sort_dir', 'asc' );
		$zn_config['ptf_sort_img_width'] = $this->opt( 'ptf_sort_img_width', '' );
		$zn_config['zn_link_portfolio'] = $this->opt( 'zn_link_portfolio', '' );

		// Build query
		$queryArgs = array(
			'post_type' => 'portfolio',
			'paged' => $paged,
			'posts_per_page' => $zn_config['posts_per_page'],
			'orderby' => $this->opt( 'ptf_sortby_type', 'date' ),
			'order' => $this->opt( 'ptf_sort_dir', 'asc' ),
		);

		if( !empty( $zn_config['portfolio_categories'] ) ){
			$queryArgs['tax_query'] = array(
				array(
					'taxonomy' => 'project_category',
					'field' => 'id',
					'terms' => $zn_config['portfolio_categories']
				),
			);
		}

		query_posts($queryArgs);
		get_template_part( 'inc/loop', $portfolio_style );
		wp_reset_query();

		echo '</div>';
	}

	function scripts() {
		$portfolio_style = $this->opt( 'portfolio_style', 'portfolio_sortable' );

		if( $portfolio_style == 'portfolio_sortable' || $portfolio_style == 'portfolio_carousel' ){
			wp_enqueue_script( 'isotope');
		}
		elseif( $portfolio_style == 'portfolio_carousel' ){
			wp_enqueue_script( 'caroufredsel');
		}
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{

		$activelist = WpkZn::getPortfolioCategories();
		if(!empty($activelist)){
			$allarr = array("*" => "All");
			$activelist = $allarr + $activelist;
		}

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array(
						"name" => __("Portfolio Category", 'zn_framework'),
						"description" => __("Select the portfolio category to show items", 'zn_framework'),
						"id" => "portfolio_categories",
						"multiple"    => true,
						"std" => "0",
						"type" => "select",
						"options" => WpkZn::getPortfolioCategories(),
					),

					array(
						"name" => __("Archive style", 'zn_framework'),
						"description" => __("Please choose the desired archive style to display.", 'zn_framework'),
						"id" => "portfolio_style",
						"std" => 'portfolio_sortable',
						"options"     => array(
							array(
								'value' => 'portfolio_category',
								'name'  => __( 'Portfolio Category', 'zn_framework' ),
								'image' => THEME_BASE_URI .'/images/admin/portfolio_layouts/category.gif'
							),
							array(
								'value' => 'portfolio_sortable',
								'name'  => __( 'Portfolio Sortable', 'zn_framework' ),
								'image' => THEME_BASE_URI .'/images/admin/portfolio_layouts/sortable.gif'
							),
							array(
								'value' => 'portfolio_carousel',
								'name'  => __( 'Portfolio Carousels', 'zn_framework' ),
								'image' => THEME_BASE_URI .'/images/admin/portfolio_layouts/carousels.gif'
							),
						),
						"type"        => "radio_image",
						"class"        => "ri-hover-line ri-3",
					),

					array(
						"name" => __("Number of columns (Portfolio Carousels)", 'zn_framework'),
						"description" => __("Please select on how many columns the portfolio should be displayed.", 'zn_framework'),
						"id" => "ports_carousel_columns",
						"std" => "1",
						"options" => array(
							'1' => __('1', 'zn_framework'),
							'2' => __('2', 'zn_framework'),
							'3' => __('3', 'zn_framework'),
						),
						"type" => "select",
						'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array( 'portfolio_carousel' ) ),
					),

					array(
						"name" => __("Number of portfolio Items Per Page", 'zn_framework'),
						"description" => __("Please enter how many portfolio items you want to load on a page.", 'zn_framework'),
						"id" => "ports_per_page_visible",
						"std" => "4",
						"type" => "text"
					),

					array(
						"name" => __("Number of columns", 'zn_framework'),
						"description" => __("Please select on how many columns the portfolio should be displayed.", 'zn_framework'),
						"id" => "ports_num_columns",
						"std" => "4",
						"options" => array(
							'1' => __('1', 'zn_framework'),
							'2' => __('2', 'zn_framework'),
							'3' => __('3', 'zn_framework'),
							'4' => __('4', 'zn_framework'),
							'5' => __('5', 'zn_framework'),
							'6' => __('6', 'zn_framework'),
						),
						"type" => "select",
						'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array( 'portfolio_sortable', 'portfolio_category' ) ),
					),

					array(
						"name" => __("Show load more button", 'zn_framework'),
						"description" => __("Choose if you want to show the load more button or not.", 'zn_framework'),
						"id" => "ptf_sort_loadmore",
						"std" => 'no',
						"type" => "toggle2",
						"value" => "yes",
						'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array('portfolio_sortable') ),
					),

					array(
						"name" => __("Default Sorting type", 'zn_framework'),
						"description" => __("Choose the default sorting type.", 'zn_framework'),
						"id" => "ptf_sortby_type",
						"std" => 'date',
						"type" => "select",
						"options" => array(
							'name' => __('Name', 'zn_framework'),
							'date' => __('Date', 'zn_framework'),
						),
					),

					array(
						"name" => __("Default Sorting Direction", 'zn_framework'),
						"description" => __("Choose the default sorting direction.", 'zn_framework'),
						"id" => "ptf_sort_dir",
						"std" => 'asc',
						"type" => "select",
						"options" => array(
							'asc' => __('Ascending order', 'zn_framework'),
							'desc' => __('Descending order', 'zn_framework'),
						),
					),


				),
			),

			'layout' => array(
				'title' => 'Layout options',
				'options' => array(


					array(
						'id'          => 'title2',
						'name'        => 'Items Options',
						'description' => 'These are options to customize the portfolio items.',
						'type'        => 'zn_title',
						'class'        => 'zn_full zn-custom-title-large',
					),

					array(
						"name" => __("Show item title", 'zn_framework'),
						"description" => __("Choose if you want to show the item title.", 'zn_framework'),
						"id" => "ptf_show_title",
						"std" => 'yes',
						"type" => "toggle2",
						"value" => "yes",
					),

					array(
						"name" => __("Show item description", 'zn_framework'),
						"description" => __("Choose if you want to show the item description.", 'zn_framework'),
						"id" => "ptf_show_desc",
						"std" => 'yes',
						"type" => "toggle2",
						"value" => "yes",
					),
					array(
						"name" => __("Images Width", 'zn_framework'),
						"description" => __("This option will resize and cache the images in your portfolio listing page's items. Not specifying a width will result in full-width images that would slow down the loading of your page. ", 'zn_framework'),
						"id" => "ptf_sort_img_width",
						"std" => '',
						"type" => "text",
						"placeholder" => "eg: 600px",
						'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array('portfolio_sortable') ),
					),
					array(
						"name" => __("Show item details below post content", 'zn_framework'),
						"description" => __("Here, you can choose to show the portfolio item details like CLIENt, YEAR, etc. <b> Important : Will only work when you select 1 column layout </b> ).", 'zn_framework'),
						"id" => "ports_extra_content",
						"std" => "no",
						"options" => array(
							'yes' => __('Show', 'zn_framework'),
							'no' => __('Hide', 'zn_framework'),
						),
						"type" => "select",
						'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array( 'portfolio_category' ) ),
					),

					array(
						"name" => __("Frame Style", 'zn_framework'),
						"description" => __("Please choose which frame style to apply.", 'zn_framework'),
						"id" => "frame_style",
						"std" => 'classic',
						"type" => "select",
						"options" => array(
							"classic" => 'Classic',
							"modern" => 'Modern',
							"minimal" => 'Minimal',
						),
						'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array('portfolio_carousel') ),
					),


					array (
						"name"        => __( "Link Portfolio Media", 'zn_framework' ),
						"description" => __( "Select Yes if you want your portfolio images to be linked to the portfolio item as opposed to open the image in lightbox.", 'zn_framework' ),
						"id"          => "zn_link_portfolio",
						"std"         => "no",
						"options"     => array (
							'yes'       => __( 'Link all to portfolio item', 'zn_framework' ),
							'no'        => __( 'Open the image in lightbox, title links to portfolio item', 'zn_framework' ),
							'no_all'    => __( 'Open the image in lightbox, title is unlinked', 'zn_framework' )
						),
						"type"        => "select"
					),

					array(
						'id'          => 'title1',
						'name'        => 'Toolbars Options',
						'description' => 'These are options to customize the toolbars of the sortable portfolio.',
						'type'        => 'zn_title',
						'class'        => 'zn_full zn-custom-title-large',
					),

					array(
						"name" => __("Portfolio Menu - Active Button", 'zn_framework'),
						"description" => __("Choose the active category or whether all should be displayed on page load.", 'zn_framework'),
						"id" => "ptf_sort_activebutton",
						"std" => '*',
						"type" => "select",
						"options" => $activelist,
						'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array('portfolio_sortable') ),
					),

					array(
						"name" => __("Portfolio Menu - Alignment", 'zn_framework'),
						"description" => __("The alignment of the portfolio categories menu.", 'zn_framework'),
						"id" => "ptf_cats_align",
						"std" => "left",
						"options" => array(
							'left' => __('Left', 'zn_framework'),
							'center' => __('Center', 'zn_framework'),
							'right' => __('Right', 'zn_framework'),
						),
						"type" => "select",
						'dependency'  => array( 'element' => 'portfolio_style', 'value'=> array('portfolio_sortable') ),
					),

					array(
						"name" => __("Show 'Sort by Name/Date & Direction' Toolbar?", 'zn_framework'),
						"description" => __("Choose if you want to show Sort by Name/Date & Direction bar.", 'zn_framework'),
						"id" => "ptf_show_sort",
						"std" => 'yes',
						"type" => "toggle2",
						"value" => "yes",
						'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array('portfolio_sortable') ),
					),

					array(
						'id'          => 'portfolio_scheme',
						'name'        => 'Portfolio color scheme',
						'description' => 'Select the color scheme of the Portfolio',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Portfolio Options (Kallyas options)',
							'light' => 'Light',
							'dark' => 'Dark'
						),
					),
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#b1z44M6EaM4',
				'docs'    => 'http://support.hogash.com/documentation/portfolio-archive/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
