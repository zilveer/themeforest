<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Recent Work
 Description: Create and display a Recent Work element
 Class: TH_RecentWork
 Category: content
 Level: 3
 Scripts: true
 Keywords: projects, portfolio
*/

/**
 * Class TH_RecentWork
 *
 * Create and display a Recent Work element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_RecentWork extends ZnElements
{
	public static function getName(){
		return __( "Recent Work", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];
		$rwStyle = $this->opt('rw_style', '1');
		$rwStyleMod = $rwStyle;
		$custom_img_size = $this->opt('custom_img_size') === 'yes' ? true : false;

		$col_left = 3;
		$col_right = 9;

		// For styles 2 and 3, do some re-spacing
		if($rwStyle == 3 || $rwStyle == 2){
			// Check if forced bigger description is enabled
			if($this->opt('rw_forcebiggerdesc','') != 1){
				$col_left = 4;
				$col_right = 8;
			}
			$rwStyleMod = '2 rwc--3';
		}


		$rwheight = (int)$this->opt('rw_height',165);

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'recentwork--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$elm_classes[] = 'recentwork_carousel--'.(int)$rwStyleMod;

		// [wpk]
		// @since 4.0.9
		$autoplay = ($this->opt('rw_slider_autoplay', 1) == 1 ? 1 : 0);
		$timeout = $this->opt('rw_slider_timeout', 5000);
		?>

<div class="recentwork_carousel <?php echo implode(' ', $elm_classes); ?> clearfix" <?php echo $attributes; ?>>

	<div class="row">

		<div class="col-sm-<?php echo $col_left; ?>">
			<div class="recentwork_carousel__left">
				<?php
					// ELEMENT TITLE
					if ( ! empty ( $options['rw_title'] ) ) {
						echo '<h3 class="recentwork_carousel__title element-scheme__hdg1" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['rw_title'] . '</h3>';
					}
					// ELEMENT DESCRIPTION
					if ( ! empty ( $options['rw_desc'] ) ) {
						echo '<p class="recentwork_carousel__desc">' . $options['rw_desc'] . '</p>';
					}
					// PORTFOLIO PAGE LINK
					if ( ! empty ( $options['rw_port_link'] ) && ($rwStyle == 2 || $rwStyle == 3) ) {
						echo '<a href="' . $options['rw_port_link'] . '" class="btn btn-fullcolor">'. $this->opt('rw_port_link_text', 'VIEW ALL') .'</a>';
					}
				?>
				<div class="controls recentwork_carousel__controls">
					<a href="#" class="prev recentwork_carousel__prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
					<?php
						// PORTFOLIO PAGE LINK
						if ( ! empty ( $options['rw_port_link'] ) && ($rwStyle != 2 && $rwStyle != 3) ) {
							echo '<a href="' . $options['rw_port_link'] . '" class="complete"><span class="glyphicon glyphicon-th"></span></a>';
						}
					?>
					<a href="#" class="next recentwork_carousel__next"><span class="glyphicon glyphicon-chevron-right"></span></a>
				</div><!-- /.recentwork_carousel__controls -->
				</div><!-- /.recentwork_carousel__left -->
		</div>

		<div class="col-sm-<?php echo $col_right; ?>">
			<div class="recentwork_carousel__crsl-wrapper">
				<ul class="recent_works1 fixclear recentwork_carousel__crsl zn-modal-img-gallery"
					data-autoplay="<?php echo $autoplay;?>"
					data-timeout="<?php echo $timeout;?>">
					<?php
						global $post;

						$posts_per_page = $this->opt('ports_per_page', '4'); // how many posts

						if ( empty ( $options['portfolio_categories'] ) ) {
							$options['portfolio_categories'] = '';
						}

						// Start the query
						$queryArgs = array (
							'post_type'      => 'portfolio',
							'posts_per_page' => $posts_per_page,
							'post_status'    => 'publish',
						);

						if( !empty( $options['portfolio_categories'] ) ){
							$queryArgs['tax_query'] = array (
								array (
									'taxonomy' => 'project_category',
									'field'    => 'id',
									'terms'    => $options['portfolio_categories']
								)
							);
						}

						$theQuery = new WP_Query($queryArgs);

						// Start the loop
						if( $theQuery->have_posts() ) {

							while($theQuery->have_posts()){
								$theQuery->the_post();

								echo '<li '.WpkPageHelper::zn_schema_markup('creative_work').'>';

								$port_media = get_post_meta( $post->ID, 'zn_port_media', true );
								if ( ! empty ( $port_media ) && is_array( $port_media ) ) {

									$size      = zn_get_size( 'four' );
									$has_image = false;

									if ( $portfolio_image = $port_media[0]['port_media_image_comb'] ) {
										if ( is_array( $portfolio_image ) ) {

											if ( $saved_image = $portfolio_image['image'] ) {
												$has_image = true;
											}
										}
										else {
											$saved_image = $portfolio_image;
											$has_image   = true;
										}

										if ( $has_image ) {

											if ($custom_img_size) {
												$img_width = $this->opt('img_width', 270);
												$img_height = $this->opt('img_height', 320);
												$image = vt_resize( '', $saved_image, $img_width, $img_height, true );
											}
											else {
												$image = vt_resize( '', $saved_image, $size['width'], '', true );
											}


										}
									}

									// Check to see if we have video
									if ( $portfolio_media = $port_media[0]['port_media_video_comb'] ) {
									}
								}

								$url = get_permalink();
								$target = '';

								$portfolio_item_link = $this->opt('portfolio_item_link','');

								if($portfolio_item_link == 'image' && empty($portfolio_media)){
									$url = $saved_image;
									$target = 'data-type="image"';
								}

								echo '<a href="' . $url . '" '.$target.' class="recentwork_carousel__link">';

								if ( ! empty ( $port_media ) && is_array( $port_media ) ) {

									echo '<div class="hover recentwork_carousel__hover">';
									// IMAGE
									if ( ! empty( $saved_image ) ) {
										echo '<div style="height: '.$rwheight.'px;" class="recentwork_carousel__img-wrapper">';
										echo '<img class="recentwork_carousel__img cover-fit-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="'. ZngetImageAltFromUrl( $saved_image ) .'" title="'.ZngetImageTitleFromUrl( $saved_image ).'">';
										echo '</div>';
									}
									elseif ( $portfolio_media ) {
										echo get_video_from_link( $portfolio_media, '', "100%", $rwheight );
									}
										echo '<span class="hov recentwork_carousel__hov"></span>';
									echo '</div>';
								}

								$cat = '<span class="recentwork_carousel__cat">' . strip_tags( get_the_term_list( $post->ID, 'project_category', '', ' , ', '' ) ) . '</span>';

								echo '<div class="details recentwork_carousel__details">';
									echo '<span class="bg recentwork_carousel__bg"></span>';

									if($rwStyle == 2 || $rwStyle == 3) echo $cat;

									// GET THE POST TITLE
									echo '<h4 class="recentwork_carousel__crsl-title '.( $rwStyle == '1' ? 'text-custom':'' ).'" '.WpkPageHelper::zn_schema_markup('title').'>' . get_the_title() . '</h4>';

									// GET ALL POST CATEGORIES
									if($rwStyle != 2 && $rwStyle != 3) echo $cat;

								echo '</div>';

								echo '</a>';

								echo '</li>';
							}
							wp_reset_query();
						}
					?>

				</ul>
			</div><!-- /.recentwork_carousel__crsl-wrapper -->
		</div>
	</div>
</div><!-- end row // recentworks_carousel default-style -->



		<?php
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Recent Works Title", 'zn_framework' ),
						"description" => __( "Enter a title for your Recent Works element", 'zn_framework' ),
						"id"          => "rw_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Recent Works Description", 'zn_framework' ),
						"description" => __( "Please enter a description that will appear bellow
										 the title.", 'zn_framework' ),
						"id"          => "rw_desc",
						"std"         => "",
						"type"        => "textarea",
					),
					array (
						"name"        => __( "Portfolio page link", 'zn_framework' ),
						"description" => __( "Please enter the link to your portfolio page.", 'zn_framework' ),
						"id"          => "rw_port_link",
						"std"         => "",
						"type"        => "text",
					),

					array (
						"name"        => __( "Portfolio text button", 'zn_framework' ),
						"description" => __( "Please enter the text for the link to your portfolio page.", 'zn_framework' ),
						"id"          => "rw_port_link_text",
						"std"         => "VIEW ALL",
						"type"        => "text",
						"dependency"  => array( 'element' => 'rw_style' , 'value'=> array('2', '3') )
					),

					array (
						"name"        => __( "Force bigger description column?", 'zn_framework' ),
						"description" => __( "By default the descrption column on the left has 4 columns (of 12) in width (aprox. 1/3). This option will force the description column to resize to be smaller (aprox. 1/4). This option helps this element when it's located inside a Fixed-width Section or Full-width Section. <a href='http://hogash.d.pr/16EHy' target='_blank'>Example here</a> ", 'zn_framework' ),
						"id"          => "rw_forcebiggerdesc",
						"std"         => "",
						"value"        => "1",
						"type"        => "toggle2",
						"dependency"  => array( 'element' => 'rw_style' , 'value'=> array('2', '3') )
					),

				),
			),

			'portfolio' => array(
				'title' => 'Portfolio Settings',
				'options' => array(

					array (
						"name"        => __( "Portfolio Category", 'zn_framework' ),
						"description" => __( "Select the portfolio category to show items", 'zn_framework' ),
						"id"          => "portfolio_categories",
						"multiple"         => true,
						"std"         => "0",
						"type"        => "select",
						"options"     => WpkZn::getPortfolioCategories(),
					),
					array (
						"name"        => __( "Number of portfolio Items", 'zn_framework' ),
						"description" => __( "Please enter how many portfolio items you want to load.", 'zn_framework' ),
						"id"          => "ports_per_page",
						"std"         => "4",
						"type"        => "text"
					),
					array (
						"name"        => __( "Autoplay carousel?", 'zn_framework' ),
						"description" => __( "Does the carousel autoplay itself?", 'zn_framework' ),
						"id"          => "rw_slider_autoplay",
						"std"         => "1",
						"value"         => "1",
						"type"        => "toggle2"
					),
					array (
						"name"        => __( "Timout duration", 'zn_framework' ),
						"description" => __( "The amount of milliseconds the carousel will pause", 'zn_framework' ),
						"id"          => "rw_slider_timeout",
						"std"         => "5000",
						"type"        => "text"
					),
					array (
						"name"        => __( "Portfolio Item Link", 'zn_framework' ),
						"description" => __( "Select the type of portfolio item link.", 'zn_framework' ),
						"id"          => "portfolio_item_link",
						"std"         => "",
						"type"        => "select",
						"options"     => array(
							'' => __( 'Link to portfolio item', 'zn_framework' ),
							'image' => __( 'Link to media (Open modal)', 'zn_framework' ),
						),
					),
				),
			),

			'style' => array(
				'title' => 'Style options',
				'options' => array(

					array (
						"name"        => __( "Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use.", 'zn_framework' ),
						"id"          => "rw_style",
						"std"         => "1",
						"type"        => "select",
						"options"     => array (
							'1' => __( 'Style 1', 'zn_framework' ),
							'2' => __( 'Style 2 - Place inside Full-width Section', 'zn_framework' ),
							'3' => __( 'Style 3 - Place inside Fixed-width Section', 'zn_framework' )
						),
					),

					array (
						"name"        => __( "Recent Works Items Height", 'zn_framework' ),
						"description" => __( "Enter a height for the carousel items", 'zn_framework' ),
						"id"          => "rw_height",
						"std"         => "165",
						"type"        => "text",
						"placeholder" => "ex: 165px"
					),
					array(
						'id'            => 'custom_img_size',
						'name'          => 'Custom image size',
						'description'   => 'Select if you want to enter a custom size for the images. If not, default size will be used. Please note that this option doesn\'t change the actual width of the image. It is usefull when displaying the element in a large container to prevent image blurring.',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => 'yes'
					),
					array(
						'id'          => 'img_width',
						'name'        => 'Image width',
						'description' => 'Enter the desired image width.',
						'type'        => 'slider',
						'std'		  => '653',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '10',
							'max' => '1920',
							'step' => '1'
						),
						'dependency'  => array( 'element' => 'custom_img_size' , 'value'=> array('yes') ),
					),
					array(
						'id'          => 'img_height',
						'name'        => 'Image height',
						'description' => 'Enter the desired image height.',
						'type'        => 'slider',
						'std'		  => '361',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '10',
							'max' => '1080',
							'step' => '1'
						),
						'dependency'  => array( 'element' => 'custom_img_size' , 'value'=> array('yes') ),
					),

					array(
						'id'          => 'element_scheme',
						'name'        => 'Element Color Scheme',
						'description' => 'Select the color scheme of this element',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
							'light' => 'Light (default)',
							'dark' => 'Dark'
						),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'recentwork--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#hnKkfdiu1Ig',
				'docs'    => 'http://support.hogash.com/documentation/recent-work/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
