<?php
/**
 * Blog list shortcode.
 */

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . 'abstract-dt-shortcode-with-inline-css.php';
require_once trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . 'class-dt-blog-lessvars-manager.php';
require_once trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . 'class-dt-blog-shortcode-html.php';

if ( ! class_exists( 'DT_Shortcode_BlogList', false ) ):

	class DT_Shortcode_BlogList extends DT_Shortcode_With_Inline_Css {

		/**
		 * @var string
		 */
		protected $post_type;

		/**
		 * @var string
		 */
		protected $taxonomy;

		/**
		 * @var DT_Shortcode_BlogList|null
		 */
		public static $instance = null;

		/**
		 * @return DT_Shortcode_BlogList
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * DT_Shortcode_BlogList constructor.
		 */
		public function __construct() {
			$this->sc_name = 'dt_blog_list';
			$this->unique_class_base = 'blog-list-shortcode-id';
			$this->taxonomy = 'category';
			$this->post_type = 'post';
			$this->default_atts = array(
				'category'                       => '',
				'layout'                         => 'classic',
				'cl_image_width'                 => '50%',
				'cl_dividers'                    => 'n',
				'cl_dividers_color'              => '',
				'ce_content_width'               => '75%',
				'ce_dividers'                    => 'n',
				'ce_dividers_color'              => '',
				'bo_content_width'               => '75%',
				'bo_content_top_overlap'         => '100px',
				'si_content_align'               => 'checkerboard',
				'si_content_side_overlap'        => '150px',
				'si_content_top_margin'          => '50px',
				'si_image_width'                 => '75%',
				'mobile_switch_width'            => '768px',
				'custom_title_color'             => '',
				'custom_content_color'           => '',
				'custom_meta_color'              => '',
				'content_bg'                     => 'y',
				'custom_content_bg_color'        => '',
				'image_sizing'                   => 'resize',
				'resized_image_dimensions'       => '3x2',
				'image_paddings'                 => '0px 0px 0px 0px',
				'image_scale_animation_on_hover' => 'y',
				'loading_mode'                   => 'disabled',
				'dis_posts_total'                => '-1',
				'st_posts_per_page'              => '',
				'st_show_all_pages'              => 'n',
				'st_gap_before_pagination'       => '50px',
				'jsp_posts_total'                => '-1',
				'jsp_posts_per_page'             => '',
				'jsp_show_all_pages'             => 'n',
				'jsp_gap_before_pagination'      => '50px',
				'jsm_posts_total'                => '-1',
				'jsm_posts_per_page'             => '',
				'jsm_gap_before_pagination'      => '50px',
				'jsl_posts_total'                => '-1',
				'jsl_posts_per_page'             => '',
				'fancy_date'                     => 'n',
				'fancy_date_font_color'          => '#2d2d2d',
				'fancy_date_bg_color'            => '#ffffff',
				'fancy_date_line_color'          => '',
				'fancy_categories'               => 'n',
				'fancy_categories_font_color'    => '',
				'fancy_categories_bg_color'      => '',
				'post_content_paddings'          => '25px 30px 30px 30px',
				'post_title_font_style'          => '',
				'post_title_font_size'           => '',
				'post_title_line_height'         => '',
				'post_title_bottom_margin'       => '5px',
				'post_date'                      => 'y',
				'post_category'                  => 'y',
				'post_author'                    => 'y',
				'post_comments'                  => 'y',
				'meta_info_font_style'           => '',
				'meta_info_font_size'            => '',
				'meta_info_line_height'          => '',
				'meta_info_bottom_margin'        => '15px',
				'post_content'                   => 'show_excerpt',
				'excerpt_words_limit'            => '',
				'content_font_style'             => '',
				'content_font_size'              => '',
				'content_line_height'            => '',
				'content_bottom_margin'          => '5px',
				'read_more_button'               => 'default_link',
				'read_more_button_text'          => 'Read more',
				'show_categories_filter'         => 'n',
				'show_orderby_filter'            => 'n',
				'show_order_filter'              => 'n',
				'gap_between_posts'              => '50px',
				'order'                          => 'desc',
				'orderby'                        => 'date',
				'gap_below_category_filter'      => '50px',
				'navigation_font_color'          => '',
				'navigation_accent_color'        => '',
			);

			parent::__construct();
		}

		/**
		 * Do shortcode here.
		 */
		protected function do_shortcode( $atts, $content = '' ) {
			// Loop query.
			$query = $this->get_posts_by_terms( $this->get_query_args() );

			$loading_mode = $this->get_att( 'loading_mode' );

			$data_post_limit = '-1';
			switch ( $loading_mode ) {
				case 'js_pagination':
					$data_post_limit = $this->get_att( 'jsp_posts_per_page', get_option( 'posts_per_page' ) );
					break;
				case 'js_more':
					$data_post_limit = $this->get_att( 'jsm_posts_per_page', get_option( 'posts_per_page' ) );
					break;
				case 'js_lazy_loading':
					$data_post_limit = $this->get_att( 'jsl_posts_per_page', get_option( 'posts_per_page' ) );
					break;
			}

			if ( 'disabled' == $loading_mode ) {
				$data_pagination_mode = 'none';
			} else if ( in_array( $loading_mode, array( 'js_more', 'js_lazy_loading' ) ) ) {
				$data_pagination_mode = 'load-more';
			} else {
				$data_pagination_mode = 'pages';
			}

			$data_atts = array(
				'data-post-limit="' . intval( $data_post_limit ) . '"',
				'data-pagination-mode="' . esc_attr( $data_pagination_mode ) . '"',
			);
			echo '<div ' . $this->container_class( 'articles-list blog-shortcode mode-list' ) . presscore_list_container_data_atts( $data_atts ) . '>';

			// Posts filter.
			$filter_class = array();
			if ( 'standard' == $loading_mode ) {
				$filter_class[] = 'without-isotope';
			}

			if ( ! $this->get_flag( 'show_orderby_filter' ) && ! $this->get_flag( 'show_order_filter' ) ) {
				$filter_class[] = 'extras-off';
			}

			$config = presscore_config();

			switch ( $config->get( 'template.posts_filter.style' ) ) {
				case 'minimal':
					$filter_class[] = 'filter-bg-decoration';
					break;
				case 'material':
					$filter_class[] = 'filter-underline-decoration';
					break;
			}

			$terms = array();
			if ( $this->get_flag( 'show_categories_filter' ) ) {
				if ( 'standard' == $loading_mode ) {
					$terms_args = array(
						'taxonomy' => $this->taxonomy,
						'hide_empty' => true,
					);
					$category_att = $this->get_att( 'category' );
					if ( $category_att ) {
						$terms_args['slug'] = presscore_sanitize_explode_string( $category_att );
					}
					$terms = get_terms( $terms_args );
				} else {
					$post_ids = wp_list_pluck( $query->posts, 'ID' );
					$terms = wp_get_object_terms( $post_ids, $this->taxonomy, array( 'fields' => 'all_with_object_id' ) );
				}
			}

			DT_Blog_Shortcode_HTML::display_posts_filter( $terms, $filter_class );

			/**
			 * Blog posts have a custom lazy loading classes.
			 * @see DT_Blog_Shortcode_HTML::get_post_image
			 */
			presscore_remove_lazy_load_attrs();

			// Start loop.
			if ( $query->have_posts() ): while( $query->have_posts() ): $query->the_post();

				do_action('presscore_before_post');

				remove_filter( 'presscore_post_details_link', 'presscore_return_empty_string', 15 );

				// Article layout (odd, even).
				$article_layout = presscore_get_template_image_layout( $config->get( 'layout' ), ( $query->current_post + 1 ) );

				// Post visibility on the first page.
				$visibility = 'visible';
				if ( $data_post_limit >= 0 && $query->current_post >= $data_post_limit ) {
					$visibility = 'hidden';
				}

				$post_class_array = array(
					'post',
					"project-{$article_layout}",
					$visibility
				);

				echo '<article ' . $this->post_class( $post_class_array ) . ' data-name="' . esc_attr( get_the_title() ) . '" data-date="' . esc_attr( get_the_date( 'c' ) ) . '">';

				// Print custom css for VC scripts.
				if ( 'show_content' === $this->get_att( 'post_content' ) && function_exists( 'visual_composer' ) ) {
					visual_composer()->addShortcodesCustomCss();
				}

				// populate config with current post settings
				presscore_populate_post_config();

				// Post media.
				$thumb_args = apply_filters( 'dt_post_thumbnail_args', array(
					'img_id'	=> get_post_thumbnail_id(),
					'class'		=> 'post-thumbnail-rollover',
					'href'		=> get_permalink(),
					'wrap'		=> '<a %HREF% %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /></a>',
					'echo'      => false,
				) );

				// Custom lazy loading classes.
				if ( presscore_lazy_loading_enabled() ) {
					$thumb_args['lazy_loading'] = true;
					$thumb_args['img_class'] = ( 'standard' === $loading_mode ? 'lazy-load' : 'blog-thumb-lazy-load' );
					$thumb_args['class'] .= ' layzr-bg';
				}

				$post_media = dt_get_thumb_img( $thumb_args );

				$details_btn_style = $this->get_att( 'read_more_button' );
				$details_btn_text = $this->get_att( 'read_more_button_text' );

				presscore_get_template_part( 'shortcodes', 'blog-list/tpl-layout', $this->get_att( 'layout' ), array(
					'post_media' => $post_media,
					'details_btn' => DT_Blog_Shortcode_HTML::get_details_btn( $details_btn_style, $details_btn_text ),
					'post_excerpt' => $this->get_post_excerpt(),
					'fancy_category_args' => array(
						'custom_text_color' => ( ! $this->get_att( 'fancy_categories_font_color' ) ),
						'custom_bg_color' => ( ! $this->get_att( 'fancy_categories_bg_color' ) ),
					),
				) );

				echo '</article>';

				do_action('presscore_after_post');

			endwhile; endif;

			presscore_add_lazy_load_attrs();

			if ( 'disabled' == $loading_mode ) {
				// Do not output pagination.
			} else if ( in_array( $loading_mode, array( 'js_more', 'js_lazy_loading' ) ) ) {
				// JS load more.
				echo dt_get_next_page_button( 2, 'paginator paginator-more-button' );
			} else if ( 'js_pagination' == $loading_mode ) {
				// JS pagination.
				echo '<div class="paginator" role="navigation"></div>';
			} else {
				// Pagination.
				dt_paginator( $query, array( 'class' => 'paginator' ) );
			}

			echo '</div>';
		}

		/**
		 * Return post excerpt with $length words.
		 *
		 * @return mixed
		 */
		protected function get_post_excerpt() {
			if ( 'off' === $this->atts['post_content'] ) {
				return '';
			}

			if ( 'show_content' === $this->atts['post_content'] ) {
				return apply_filters( 'the_content', get_the_content( '' ) );
			}

			$length = absint( $this->atts['excerpt_words_limit'] );
			$excerpt = get_the_excerpt();

			// VC excerpt fix.
			if ( function_exists( 'vc_manager' ) ) {
				$excerpt = vc_manager()->vc()->excerptFilter( $excerpt );
			}

			if ( $length ) {
				$excerpt = wp_trim_words( $excerpt, $length );
			}

			return apply_filters( 'the_excerpt', $excerpt );
		}

		/**
		 * Return container class attribute.
		 *
		 * @param array $class
		 *
		 * @return string
		 */
		protected function container_class( $class = array() ) {
			if ( ! is_array( $class ) ) {
				$class = explode( ' ', $class );
			}

			// Unique class.
			$class[] = $this->get_unique_class();

			$layout_classes = array(
				'classic' => 'classic-layout-list',
				'centered' => 'centered-layout-list',
				'bottom_overlap' => 'bottom-overlap-layout-list',
				'side_overlap' => 'side-overlap-layout-list',
			);

			$layout = $this->get_att( 'layout' );
			if ( array_key_exists( $layout, $layout_classes ) ) {
				$class[] = $layout_classes[ $layout ];
			}

			if ( 'classic' === $this->get_att( 'layout' ) && $this->get_flag( 'cl_dividers' ) ) {
				$class[] = 'dividers-on';
			}

			if ( 'centered' === $this->get_att( 'layout' ) && $this->get_flag( 'ce_dividers' ) ) {
				$class[] = 'dividers-on';
			}

			if ( $this->get_flag( 'content_bg' ) ) {
				$class[] = 'content-bg-on';
			}

			$loading_mode = $this->get_att( 'loading_mode' );
			if ( 'standard' !== $loading_mode ) {
				$class[] = 'jquery-filter';
			}

			if ( 'js_lazy_loading' === $loading_mode ) {
				$class[] = 'lazy-loading-mode';
			}

			if ( $this->get_flag( 'jsp_show_all_pages' ) ) {
				$class[] = 'show-all-pages';
			}

			if ( $this->get_flag( 'image_scale_animation_on_hover' ) ) {
				$class[] = 'scale-img';
			}

			return presscore_list_container_html_class( $class );
		}

		/**
		 * Return post classes.
		 *
		 * @param string|array $class
		 *
		 * @return string
		 */
		protected function post_class( $class = array() ) {
			if ( ! is_array( $class ) ) {
				$class = explode( ' ', $class );
			}

			if ( 'classic' === $this->atts['layout'] && absint( $this->atts['cl_image_width'] ) >= 100 ) {
				$class[] = ' full-width-img';
			}

			return 'class="' . join( ' ', get_post_class( $class, null ) ) . '"';
		}

		/**
		 * Return shortcode less file absolute path to output inline.
		 *
		 * @return string
		 */
		protected function get_less_file_name() {
			switch ( $this->atts['layout'] ) {
				case 'centered':
					$less_file_name = 'centered-layout-blog';
					break;
				case 'bottom_overlap':
					$less_file_name = 'bottom-overlap-layout-blog';
					break;
				case 'side_overlap':
					$less_file_name = 'side-overlap-layout-blog';
					break;
				case 'classic':
				default:
					$less_file_name = 'classic-layout-blog';
			}

			// @TODO: Remove in production.
			$less_file_name = 'blog';

			$less_file_path = trailingslashit( get_template_directory() ) . "css/dynamic-less/shortcodes/{$less_file_name}.less";

			return $less_file_path;
		}

		/**
		 * Setup theme config for shortcode.
		 */
		protected function setup_config() {
			$config = presscore_config();

			$config->set( 'load_style', 'default' );
			$config->set( 'template', 'blog' );

			$layout = 'list';
			if ( 'side_overlap' === $this->get_att( 'layout' ) ) {
				$layout = $this->get_att( 'si_content_align' );
			}
			$config->set( 'layout', $layout );
			$config->set( 'all_the_same_width', true );

			$config->set( 'show_excerpts', ( 'off' !== $this->get_att( 'post_content' ) ) );
			$config->set( 'show_details', ( 'off' !== $this->get_att( 'read_more_button' ) ) );

			$config->set( 'image_layout', ( 'resize' === $this->get_att( 'image_sizing' ) ? $this->get_att( 'image_sizing' ) : 'original' ) );

			if ( 'resize' == $this->get_att( 'image_sizing' ) && $this->get_att( 'resized_image_dimensions' ) ) {
				// Sanitize.
				$img_dim = array_slice( array_map( 'absint', explode( 'x', strtolower( $this->get_att( 'resized_image_dimensions' ) ) ) ), 0, 2 );
				// Make sure that all values is set.
				for ( $i = 0; $i < 2; $i++ ) {
					if ( empty( $img_dim[ $i ] ) ) {
						$img_dim[ $i ] = '';
					}
				}
				$config->set( 'thumb_proportions', array( 'width' => $img_dim[0], 'height' => $img_dim[1] ) );
			} else {
				$config->set( 'thumb_proportions', '' );
			}

			$config->set( 'post.meta.fields.date', apply_filters( 'dt_sanitize_flag', $this->get_att( 'post_date' ) ) );
			$config->set( 'post.meta.fields.categories', apply_filters( 'dt_sanitize_flag', $this->get_att( 'post_category' ) ) );
			$config->set( 'post.meta.fields.comments', apply_filters( 'dt_sanitize_flag', $this->get_att( 'post_comments' ) ) );
			$config->set( 'post.meta.fields.author', apply_filters( 'dt_sanitize_flag', $this->get_att( 'post_author' ) ) );

			$config->set( 'post.fancy_date.enabled', apply_filters( 'dt_sanitize_flag', $this->get_att( 'fancy_date' ) ) );
			$config->set( 'post.fancy_category.enabled', apply_filters( 'dt_sanitize_flag', $this->get_att( 'fancy_categories' ) ) );
			$config->set( 'post.preview.background.enabled', false );
			$config->set( 'post.preview.background.style',  '' );
			$config->set( 'post.preview.media.width', 30 );
			$config->set( 'post.preview.load.effect', 'fade_in' );

			$config->set( 'template.posts_filter.terms.enabled', apply_filters( 'dt_sanitize_flag', $this->get_att( 'show_categories_filter' ) ) );
			$config->set( 'template.posts_filter.orderby.enabled', apply_filters( 'dt_sanitize_flag', $this->get_att( 'show_orderby_filter' ) ) );
			$config->set( 'template.posts_filter.order.enabled', apply_filters( 'dt_sanitize_flag',  $this->get_att( 'show_order_filter' ) ) );

			if ( 'standard' === $this->get_att( 'loading_mode' ) ) {
				$config->set( 'show_all_pages', $this->get_flag( 'st_show_all_pages' ) );

				// Allow sorting from request.
				if ( ! $config->get('order') ) {
					$config->set( 'order', $this->get_att( 'order' ) );
				}

				if ( ! $config->get('orderby') ) {
					$config->set( 'orderby', $this->get_att( 'orderby' ) );
				}
			} else {
				$config->set( 'show_all_pages', $this->get_flag( 'jsp_show_all_pages' ) );

				$config->set( 'request_display', false );
				$config->set( 'order', $this->get_att( 'order' ) );
				$config->set( 'orderby', $this->get_att( 'orderby' ) );
			}

			// Get terms ids.
			$terms = get_terms( array(
				'taxonomy' => 'category',
				'slug' => presscore_sanitize_explode_string( $this->get_att( 'category' ) ),
			    'fields' => 'ids',
			) );

			$config->set( 'display', array(
				'type' => 'category',
				'terms_ids' => $terms,
				'select' => ( $terms ? 'only' : 'all' ),
			) );
		}

		/**
		 * Return array of prepared less vars to insert to less file.
		 *
		 * @return array
		 */
		protected function get_less_vars() {
			$storage = new Presscore_Lib_SimpleBag();
			$factory = new Presscore_Lib_LessVars_Factory();
			$less_vars = new DT_Blog_LessVars_Manager( $storage, $factory );

			$less_vars->add_keyword( 'unique-shortcode-class-name', 'blog-shortcode.' . $this->get_unique_class(), '~"%s"' );

			switch ( $this->get_att( 'layout' ) ) {
				case 'classic':
					$less_vars->add_keyword( 'post-divider-color', $this->get_att( 'cl_dividers_color', '~""' ) );
					$less_vars->add_percent_number( 'post-thumbnail-width', $this->get_att( 'cl_image_width' ) );
					break;
				case 'centered':
					$less_vars->add_keyword( 'post-divider-color', $this->get_att( 'cl_dividers_color', '~""' ) );
					$less_vars->add_pixel_or_percent_number( 'post-content-width', $this->get_att( 'ce_content_width' ) );
					break;
				case 'bottom_overlap':
					$less_vars->add_pixel_or_percent_number( 'post-content-width', $this->get_att( 'bo_content_width' ) );
					$less_vars->add_pixel_number( 'post-content-top-overlap', $this->get_att( 'bo_content_top_overlap' ) );
					break;
				case 'side_overlap':
					$less_vars->add_pixel_or_percent_number( 'post-thumbnail-width', $this->get_att( 'si_image_width' ) );
					$less_vars->add_pixel_number( 'post-content-side-overlap', $this->get_att( 'si_content_side_overlap' ) );
					$less_vars->add_pixel_number( 'post-content-top-overlap', $this->get_att( 'si_content_top_margin' ) );
			}

			$less_vars->add_pixel_number( 'switch-blog-list-to-mobile', $this->get_att( 'mobile_switch_width' ) );
			$less_vars->add_keyword( 'post-title-color', $this->get_att( 'custom_title_color', '~""' ) );
			$less_vars->add_keyword( 'post-meta-color', $this->get_att( 'custom_meta_color', '~""' ) );
			$less_vars->add_keyword( 'post-content-color', $this->get_att( 'custom_content_color', '~""' ) );
			$less_vars->add_keyword( 'post-content-bg', $this->get_att( 'custom_content_bg_color', '~""' ) );

			$less_vars->add_paddings( array(
				'post-thumb-padding-top',
				'post-thumb-padding-right',
				'post-thumb-padding-bottom',
				'post-thumb-padding-left',
			), $this->get_att( 'image_paddings' ), '%|px' );

			$less_vars->add_keyword( 'fancy-data-color', $this->get_att( 'fancy_date_font_color' ) );
			$less_vars->add_keyword( 'fancy-data-bg', $this->get_att( 'fancy_date_bg_color' ) );
			$less_vars->add_keyword( 'fancy-data-line-color', $this->get_att( 'fancy_date_line_color', '~""' ) );
			$less_vars->add_keyword( 'fancy-category-color', $this->get_att( 'fancy_categories_font_color', '~""' ) );
			$less_vars->add_keyword( 'fancy-category-bg', $this->get_att( 'fancy_categories_bg_color', '~""' ) );

			$less_vars->add_paddings( array(
				'post-content-padding-top',
				'post-content-padding-right',
				'post-content-padding-bottom',
				'post-content-padding-left',
			), $this->get_att( 'post_content_paddings' ) );

			$less_vars->add_pixel_number( 'post-title-font-size', $this->get_att( 'post_title_font_size' ) );
			$less_vars->add_pixel_number( 'post-title-line-height', $this->get_att( 'post_title_line_height' ) );
			$less_vars->add_pixel_number( 'post-meta-font-size', $this->get_att( 'meta_info_font_size' ) );
			$less_vars->add_pixel_number( 'post-meta-line-height', $this->get_att( 'meta_info_line_height' ) );

			$less_vars->add_pixel_number( 'post-excerpt-font-size', $this->get_att( 'content_font_size' ) );
			$less_vars->add_pixel_number( 'post-excerpt-line-height', $this->get_att( 'content_line_height' ) );
			$less_vars->add_pixel_number( 'post-meta-margin-bottom', $this->get_att( 'meta_info_bottom_margin' ) );
			$less_vars->add_pixel_number( 'post-title-margin-bottom', $this->get_att( 'post_title_bottom_margin' ) );
			$less_vars->add_pixel_number( 'post-excerpt-margin-bottom', $this->get_att( 'content_bottom_margin' ) );
			$less_vars->add_pixel_number( 'gap-between-posts', $this->get_att( 'gap_between_posts' ) );
			$less_vars->add_font_style( array(
				'post-title-font-style',
				'post-title-font-weight',
				'post-title-text-transform',
			), $this->get_att( 'post_title_font_style' ) );
			$less_vars->add_font_style( array(
				'post-meta-font-style',
				'post-meta-font-weight',
				'post-meta-text-transform',
			), $this->get_att( 'meta_info_font_style' ) );
			$less_vars->add_font_style( array(
				'post-content-font-style',
				'post-content-font-weight',
				'post-content-text-transform',
			), $this->get_att( 'content_font_style' ) );
			$less_vars->add_pixel_number( 'shortcode-filter-gap', $this->get_att( 'gap_below_category_filter', '' ) );
			$less_vars->add_keyword( 'shortcode-filter-color', $this->get_att( 'navigation_font_color', '~""' ) );
			$less_vars->add_keyword( 'shortcode-filter-accent', $this->get_att( 'navigation_accent_color', '~""' ) );

			$gap_before_pagination = '';
			switch ( $this->get_att( 'loading_mode' ) ) {
				case 'standard':
					$gap_before_pagination = $this->get_att( 'st_gap_before_pagination', '' );
					break;
				case 'js_pagination':
					$gap_before_pagination = $this->get_att( 'jsp_gap_before_pagination', '' );
					break;
				case 'js_more':
					$gap_before_pagination = $this->get_att( 'jsm_gap_before_pagination', '' );
					break;
			}
			$less_vars->add_pixel_number( 'shortcode-pagination-gap', $gap_before_pagination );

			return $less_vars->get_vars();
		}

		/**
		 * Return dummy html for VC inline editor.
		 *
		 * @return string
		 */
		protected function get_vc_inline_html() {
			$terms_title = _x( 'Display categories', 'vc inline dummy', 'the7mk2' );

			return $this->vc_inline_dummy( array(
				'class' => 'dt_vc-blog_list',
				'title' => _x( 'Blog List', 'vc inline dummy', 'the7mk2' ),
				'fields' => array(
					$terms_title => presscore_get_terms_list_by_slug( array( 'slugs' => $this->atts['category'], 'taxonomy' => 'category' ) ),
				),
			) );
		}

		/**
		 * Return query args.
		 *
		 * @return array
		 */
		protected function get_query_args() {
			$pagination_mode = $this->get_att( 'loading_mode' );
			$posts_total = -1;
			switch ( $pagination_mode ) {
				case 'disabled':
					$posts_total = $this->get_att( 'dis_posts_total' );
					break;
				case 'standard':
					$posts_total = $this->get_att( 'st_posts_per_page' );
					break;
				case 'js_pagination':
					$posts_total = $this->get_att( 'jsp_posts_total' );
					break;
				case 'js_more':
					$posts_total = $this->get_att( 'jsm_posts_total' );
					break;
				case 'js_lazy_loading':
					$posts_total = $this->get_att( 'jsl_posts_total' );
					break;
			}

			$category_att = $this->get_att( 'category' );
			$terms_slugs = '';
			if ( $category_att ) {
				$terms_slugs = presscore_sanitize_explode_string( $category_att );
			}

			$query_args =  array(
				'orderby' => $this->get_att( 'orderby' ),
				'order' => $this->get_att( 'order' ),
				'number' => $posts_total,
				'select' => ( $terms_slugs ? 'only' : 'all' ),
				'category' => $terms_slugs,
			);

			// For standard pagination mode.
			if ( 'standard' == $pagination_mode ) {
				$config = presscore_config();
				$query_args['orderby'] = $config->get( 'orderby' );
				$query_args['order'] = $config->get( 'order' );
				$query_args['paged'] = dt_get_paged_var();

				$request = $config->get( 'request_display' );
				if ( $request ) {
					$query_args['select'] = $request['select'];
					$terms = get_terms( array(
						'taxonomy' => 'category',
						'include' => $request['terms_ids'],
						'fields' => 'id=>slug',
					) );
					if ( ! is_wp_error( $terms ) ) {
						$query_args['category'] = array_values( $terms );
					}
				}
			}

			return $query_args;
		}
	}

	DT_Shortcode_BlogList::get_instance()->add_shortcode();

endif;
