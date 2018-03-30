<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme customizations.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Config
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

if( ! function_exists('thb_comment_form_fields') ) {
	/**
	 * Customizations for the form
	 */
	function thb_comment_form_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$args = array(
			'format' => 'xhtml'
		);
		$html5 = 'html5' === $args['format'];
		$args = wp_parse_args( $args );

		if ( ! isset( $args['format'] ) )
			$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

		$fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Name','thb_text_domain' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author" type="text" placeholder="' . __('Your name *', 'thb_text_domain') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
		$fields['email'] = '<p class="comment-form-email"><label for="email">' . __( 'Email','thb_text_domain' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
						'<input id="email" name="email" placeholder="' . __('Your email *','thb_text_domain') . '" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
		$fields['url'] = '<p class="comment-form-url"><label for="url">' . __( 'Website','thb_text_domain' ) . '</label> ' .
						'<input id="url" name="url" placeholder="' . __('Your website url', 'thb_text_domain') . '" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

		return $fields;
	}

	add_filter('comment_form_default_fields','thb_comment_form_fields');
}

if( !function_exists('thb_password_form') ) {
	/**
	 * THB custom password protection form
	 */
	function thb_password_form() {
		 global $post;
	    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	    $o = '<p class="thb-password-protected-message">' . __( "This content is password protected", 'thb_text_domain') . '<span>' . __("to view it please enter your password below", 'thb_text_domain') . '</span></p>
	    <form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
			<label class="hidden" for="' . $label . '">' . __( "Password:",'thb_text_domain' ) . ' </label>
			<input name="post_password" placeholder="Password" id="' . $label . '" type="password" size="20" maxlength="20" />
			<input id="submit" type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
		</form>
	    ';
	    return $o;
	}
	add_filter( 'the_password_form', 'thb_password_form' );
}

if( !function_exists('thb_title_format') ) {
	/**
	 * Change the title for the protected content
	 */
	function thb_title_format($content) {
		return '%s';
	}

	add_filter('private_title_format', 'thb_title_format');
	add_filter('protected_title_format', 'thb_title_format');
}


if( ! function_exists('thb_theme_layout_options') ) {
	/**
	 * Page extra layout features
	 */
	function thb_theme_layout_options() {
		foreach( thb_theme()->getPublicPostTypes() as $post_type ) {
			if ( ! $thb_metabox = $post_type->getMetabox('layout') ) {
				return;
			}

			$all_templates = thb_get_theme_templates();

			if( thb_is_admin_template( $all_templates ) ) {

				$thb_container = $thb_metabox->getContainer( 'layout_container' );

				$thb_field = new THB_GraphicRadioField( 'one_page_header_layout' );
					$thb_field->setLabel( __( 'Page header layout', 'thb_text_domain' ) );
					$thb_field->setOptions(array(
						'pageheader-layout-a' => get_template_directory_uri() . '/css/i/options/pageheader-layout-a.png',
						'pageheader-layout-b' => get_template_directory_uri() . '/css/i/options/pageheader-layout-b.png',
						'pageheader-layout-c' => get_template_directory_uri() . '/css/i/options/pageheader-layout-c.png',
						'pageheader-layout-d' => get_template_directory_uri() . '/css/i/options/pageheader-layout-d.png',
						'pageheader-layout-e' => get_template_directory_uri() . '/css/i/options/pageheader-layout-e.png',
						'pageheader-layout-f' => get_template_directory_uri() . '/css/i/options/pageheader-layout-f.png',
					));
				$thb_container->addField($thb_field);

				$thb_field = new THB_SelectField( 'one_page_header_alignment' );
					$thb_field->setLabel( __( 'Page header alignment', 'thb_text_domain' ) );
					$thb_field->setOptions(array(
						'pageheader-alignment-left'   => __('Left', 'thb_text_domain'),
						'pageheader-alignment-center' => __('Center', 'thb_text_domain'),
						'pageheader-alignment-right'  => __('Right', 'thb_text_domain')
					));
				$thb_container->addField($thb_field);

				$thb_field = new THB_SelectField( 'one_subtitle_position' );
					$thb_field->setLabel( __( 'Page subtitle position', 'thb_text_domain' ) );
					$thb_field->setOptions(array(
						'subtitle-top' => __('Top', 'thb_text_domain'),
						'subtitle-bottom' => __('Bottom', 'thb_text_domain')
					));
				$thb_container->addField($thb_field);

				$thb_field = new THB_CheckboxField( 'one_page_header_parallax' );
					$thb_field->setLabel( __( 'Parallax on page header', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Parallax will work on extended headers only.', 'thb_text_domain' ) );
				$thb_container->addField($thb_field);

				$thb_field = new THB_OneBackgroundField('header_background');
				$thb_field->setLabel( __('Header background', 'thb_text_domain') );
				$thb_field->setHelp( __( 'In extended page header configurations, the color of the overlay (even if not enabled) or background determines the skin used for texts (e.g. a dark color automatically generates light text).<br><br>If present, the slideshows have precedence over this field.', 'thb_text_domain' ) );
				$thb_container->addField($thb_field);

			}

		}
	}

	add_action('wp_loaded', 'thb_theme_layout_options');
}

if( ! function_exists( 'thb_theme_portfolio_options' ) ) {
	/**
	 * Theme portfolio options.
	 */
	function thb_theme_portfolio_options() {
		if( thb_is_admin_template( 'template-portfolio.php' ) ) {

			$thb_metabox = thb_theme()->getPostType( 'page' )->getMetabox( 'layout' );
			$thb_portfolio_options_tab = $thb_container = $thb_metabox->getTab( 'portfolio_options' );

			if ( $thb_portfolio_options_tab ) {
				$thb_container = $thb_portfolio_options_tab->getContainer( 'portfolio_loop_container' );

				$thb_field = new THB_GraphicRadioField( 'one_portfolio_layout' );
				$thb_field->setLabel( __('Portfolio layout', 'thb_text_domain') );
				$thb_field->setOptions(array(
					'thb-portfolio-grid-a' => get_template_directory_uri() . '/css/i/options/portfolio-grid-a.png',
					'thb-portfolio-grid-b' => get_template_directory_uri() . '/css/i/options/portfolio-grid-b.png',
					'thb-portfolio-grid-c' => get_template_directory_uri() . '/css/i/options/portfolio-grid-c.png',
					'thb-portfolio-grid-d' => get_template_directory_uri() . '/css/i/options/portfolio-grid-d.png'
				));
				$thb_container->addField($thb_field);

				$thb_field = new THB_SelectField( 'one_portfolio_filter_alignment' );
					$thb_field->setLabel( __( 'Filter alignment', 'thb_text_domain' ) );
					$thb_field->setOptions(array(
						'filter-alignment-left'   => __('Left', 'thb_text_domain'),
						'filter-alignment-center' => __('Center', 'thb_text_domain'),
						'filter-alignment-right'  => __('Right', 'thb_text_domain')
					));
				$thb_container->addField($thb_field);
			}
		}

		if( thb_is_admin_template( 'single-works.php' ) ) {

			$thb_metabox = thb_theme()->getPostType( 'works' )->getMetabox( 'layout' );
			$thb_container = $thb_metabox->getContainer( 'layout_container' );

			$thb_field = new THB_GraphicRadioField( 'one_single_work_layout' );
			$thb_field->setLabel( __('Single work layout', 'thb_text_domain') );
			$thb_field->setOptions(array(
				'thb-single-work-layout-a' => get_template_directory_uri() . '/css/i/options/thb-single-work-layout-a.png',
				'thb-single-work-layout-b' => get_template_directory_uri() . '/css/i/options/thb-single-work-layout-b.png',
				'thb-single-work-layout-c' => get_template_directory_uri() . '/css/i/options/thb-single-work-layout-c.png'
			));
			$thb_container->addField($thb_field);

			$thb_field = new THB_CheckboxField( 'one_single_work_slideshow' );
				$thb_field->setLabel( __( 'Display as slideshow', 'thb_text_domain') );
				$thb_field->setHelp( __('Tick if you want to display images and videos as a slideshow.', 'thb_text_domain') );
			$thb_container->addField($thb_field);

			$thb_field = new THB_TextField( 'project_short_description' );
				$thb_field->setLabel( __('Project short description', 'thb_text_domain') );
				$thb_field->setHelp( __('You can place here a short description or the tagline for your project.', 'thb_text_domain') );
			$thb_container->addField($thb_field);

			$thb_field = new THB_CheckboxField( 'disable_work_image_link' );
				$thb_field->setLabel( __( 'Disable images lightbox', 'thb_text_domain') );
				$thb_field->setHelp( __('Tick if you want to disable creation of a link that will open the image in a lightbox for this work.', 'thb_text_domain') );
			$thb_container->addField($thb_field);

		}
	}

	if ( function_exists( 'thb_portfolio_loop' ) ) {
		add_action( 'wp_loaded', 'thb_theme_portfolio_options' );
	}
}

if( ! function_exists( 'thb_portfolio_likes_container' ) ) {
	/**
	 * Add a field to the Portfolio tab to activate likes for Portfolio items.
	 */
	function thb_portfolio_likes_container() {
		$portfolio_options_tab = thb_theme()->getAdmin()->getMainPage()->getTab( 'portfolio' );

		if ( $portfolio_options_tab ) {
			$thb_container = $portfolio_options_tab->getContainer( 'single_work_options' );

				$thb_field = new THB_CheckboxField( 'thb_portfolio_likes_active' );
				$thb_field->setLabel( __( 'Activate likes for Portfolio items', 'thb_text_domain' ) );

			$thb_container->addField( $thb_field );
		}
	}

	add_action( 'wp_loaded', 'thb_portfolio_likes_container' );
}

if( !function_exists('thb_theme_body_classes') ) {
	/**
	 * THB custom body classes
	 */
	function thb_theme_body_classes( $classes ) {
		$thb_id = thb_get_page_ID();

		$classes[] = thb_get_layout_width();
		$classes[] = 'header-' . thb_get_header_layout();
		$classes[] = thb_get_page_header_alignment();
		$classes[] = thb_get_page_header_layout();
		$classes[] = thb_get_subtitle_position();

		if ( thb_one_pageheader_parallax() ) {
			$classes[] = 'thb-pageheader-parallax';
		}

		if ( thb_is_thb_sticky_header() ) {
			$classes[] = 'thb-sticky-header';
		}

		if ( thb_is_disabled_fittext() ) {
			$classes[] = "thb-fittext-disabled";
		}

		if ( empty( $thb_id ) ) {
			return $classes;
		}

		if( thb_is_page_template( 'single-works.php' ) ) {
			$classes[] = thb_get_single_work_layout( $thb_id );
		}

		return $classes;
	}

	add_filter('body_class', 'thb_theme_body_classes');
}

if( !function_exists('thb_footer_skin') ) {
	function thb_footerskin() {
		$bg_color = get_theme_mod('footer_bg', '#272727');
		$skin = 'thb-skin-' . thb_color_get_opposite_skin( $bg_color );

		return $skin;
	}
}

if( !function_exists('thb_pagecontent_skin') ) {
	function thb_pagecontent_skin() {
		$bg_color = get_theme_mod('body_bg', '#ffffff');
		$skin = 'thb-skin-' . thb_color_get_opposite_skin( $bg_color );

		return $skin;
	}
}

if( ! function_exists( 'thb_get_theme_social_options' ) ) {
	/**
	 * Get the social options for the theme.
	 *
	 * @return array
	 */
	function thb_get_theme_social_options() {
		$thb_page = thb_theme()->getAdmin()->getMainPage();
		$thb_container = $thb_page->getTab('social')->getContainer('social_options');
		$options = array();

		foreach( $thb_container->getFields() as $field ) {
			$options[$field->getName()] = $field->getLabel();
		}

		return $options;
	}
}

if( !function_exists('thb_builder_load') ) {
	/**
	 * Attach the builder functionality to every page_end hook
	 */
	function thb_builder_load() {
		if ( thb_is_builder_position_top() ) {
			add_action( 'thb_page_content_start', 'thb_builder' );
			add_action( 'thb_single_content_start', 'thb_builder' );
		}
		else {
			add_action( 'thb_page_end', 'thb_builder' );
			add_action( 'thb_post_end', 'thb_builder' );
		}
	}

	add_action( 'thb_before_doctype', 'thb_builder_load' );
}

if( !function_exists( 'thb_portfolio_index' ) ) {
	/**
	 * Print the back to portfolio link
	 *
	 * @return html
	 */
	function thb_portfolio_index() {
		$thb_portfolio_index = thb_portfolio_get_index( thb_get_page_ID() );
	?>
		<?php if ( !empty( $thb_portfolio_index ) ) : ?>
			<a class="back-to-portfolio" href="<?php echo get_permalink( $thb_portfolio_index ); ?>">
				<span><?php _e('Back to Portfolio', 'thb_text_domain' ); ?></span>
			</a>
		<?php endif; ?>
	<?php }
}

if( !function_exists('thb_portfolio_filter_class') ) {
	/**
	 * Add a filter alignment class to the portfolio block.
	 */
	function thb_portfolio_filter_class( $block_classes, $block_data, $slug ) {

		if ( $slug == 'thb_portfolio' ) {
			$block_classes[] = $block_data['one_portfolio_filter_alignment'];
		}

		return $block_classes;
	}

	add_filter( 'thb_block_classes', 'thb_portfolio_filter_class', 10, 3 );
}

if ( ! function_exists( 'thb_one_setup_work_slides' ) ) {
	/**
	 * Setup work slides.
	 *
	 * @param THB_SlideField $slide_field
	 * @return THB_SlideField
	 */
	function thb_one_setup_work_slides( $slide_field ) {
		$video_modal = $slide_field->getModal( 'edit_slide_video' );

		if ( $video_modal ) {
			$container = $video_modal->getContainer( 'edit_slide_video_container' );

			$container->removeField( 'autoplay' );
			$container->removeField( 'loop' );
			$container->removeField( 'fit' );
		}

		return $slide_field;
	}

	add_filter( 'thb_work_slide', 'thb_one_setup_work_slides' );
}

if( !function_exists('thb_search_icon') ) {
	/**
	 * Main nav search icon
	 */
	function thb_search_icon() {
		echo "<div class='thb-search-icon-container'>";
			echo "<a href='#'><span>" . __( 'Search', 'thb_text_domain' ) . "</span></a>";
		echo "</div>";
	}
}

if( !function_exists('thb_search_icon_placement') ) {
	/**
	 * Attach the search icon to the main nav
	 */
	function thb_search_icon_placement(  ) {
		if ( thb_get_logo_position() == 'logo-left' ) {
			add_action( 'thb_nav_after', 'thb_search_icon', 10 );
		} else {
			add_action( 'thb_nav_before', 'thb_search_icon', 20 );
		}
	}

	if ( thb_is_enabled_search() ) {
		add_action( 'wp_head', 'thb_search_icon_placement' );
	}
}

if ( ! function_exists( 'thb_disable_blocks' ) ) {
	function thb_disable_blocks() {
		thb_builder_instance()->getBlock( 'thb_radial_chart' )->deactivate();
		thb_builder_instance()->getBlock( 'thb_testimonial' )->deactivate();
		thb_builder_instance()->getBlock( 'thb_google_map' )->deactivate();
		// thb_builder_instance()->getBlock( 'thb_counter' )->deactivate();
	}

	add_action( 'wp_loaded', 'thb_disable_blocks' );
}

function thb_one_title() {
	add_theme_support( 'title-tag' );
}

add_action( 'after_setup_theme', 'thb_one_title' );