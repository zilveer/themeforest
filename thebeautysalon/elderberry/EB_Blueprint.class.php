<?php

/**
  * The Blueprint class is a helper class handling many
  * frontend tasks for themes. It is used to display
  * pages as well as multiple loops on page templates,
  *
  * It includes numerous helper methods for figuring
  * out sidebar placement and other wonderful things.
  *
  * A number of filters are defined so themes can
  * modify functionality easily.
  *
  * @package Elderberry
  *
  */
class EB_Blueprint {

	/** Constructor
	  *
	  * Adds a number of filters and actions which hook
	  * into WordPress to provide the functionality we
	  * need.
	  *
	  */
	function __construct( $framework ) {
		$this->framework = $framework;
		add_filter( 'post_thumbnail_html', array( $this, 'format_image' ), 10, 5 );
		add_filter( 'the_content', array( $this, 'format_content' ), 9999 );

		add_action( 'wp_ajax_load_posts', array( $this, 'load_posts' ) );
		add_action( 'wp_ajax_nopriv_load_posts', array( $this, 'load_posts' ) );

	}

	/** Additional Post Data
	  *
	  * Adds postmeta to our existing post data by
	  * adding a postmeta variable to the object.
	  * if an array is passed its data will
	  * overwrite the default arguments.
	  *
	  * @param array $args A list of arguments - overwrites the default
	  *
	  */

	function add_data( $args = array() ) {
		global $post;
		$data = $this->get_all_postmeta( $post->ID );
		$data = wp_parse_args( $args, $data );
		$post->postmeta = $data;
	}


	/** Get All Metadata
	  *
	  * Retrieves all the metadata related to a post
	  *
	  * @global object $wpdb WordPress database object
	  * @see $blueprint
	  * @uses get_all_postmeta()
	  *
	  * @return array $postmeta Array of Metadata
	  *
	  */
	function get_all_postmeta( $post_id ) {
		global $wpdb;

		if( empty( $post_id ) OR !is_numeric( $post_id ) ) {
			return false;
		}

		$postmeta = array();
		$data = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE post_id = $post_id " );

		foreach( $data as $meta ) {
			$postmeta[$meta->meta_key] = $meta->meta_value;
		}

		return $postmeta;

	}


	/** Blueprint Header Checker
	  *
	  * Decides if a blueprint needs a header section at all.
	  * A header section is needed if there is either a title
	  * an image or post content.
	  *
	  * @global object $post WordPress post object
	  *
	  * @return bool
	  *
	  */
	function blueprint_has_header() {
		$header = array();
		$header['title']      = $this->has_title();
		$header['thumbnail']  = $this->has_thumbnail();
		$header['content']    = $this->has_post_content();

		if( !in_array( true, $header ) ) {
			return false;
		}

		return true;
	}

	/** Blueprint Sidebar Checker
	  *
	  * Decides if a blueprint needs a sidebar at all.
	  * A sidebar is needed if it is globally set to
	  * be shown or it is specifically set to be shown
	  * on a specific page
	  *
	  * @global object $post WordPress post object
	  *
	  * @return bool
	  *
	  */
	function has_sidebar( $no_sidebar = array() ) {
		global $post;

		if( in_array( $this->framework->get_post_type() , $no_sidebar ) ) {
			return false;
		}

		if( is_singular() ) {
			if( $this->framework->has_element( 'show_sidebar' ) ) {
				return true;
			}
		}
		else {
			if( $this->framework->options['show_sidebar'] == 'yes' ) {
				return true;
			}
		}

		return false;
	}


	function has_pushed_sidebar() {
		global $post;
		if( !empty( $post->postmeta['sidebar_push'] ) AND $post->postmeta['sidebar_push'] == 'yes' ) {
			return true;
		}

		return false;
	}


	/** Title Checker
	  *
	  * Decides if a title should be displayed for a post or not.
	  * A title is displayed if it is not empty and the show_title
	  * meta is set to yes.
	  *
	  * @global object $post WordPress post object
	  *
	  * @return bool
	  *
	  */
	function has_title() {
		global $post;
		$title = trim( the_title( '', '', false ) );

		if( $this->framework->has_element( 'show_title' ) AND !empty( $title ) ) {
			return true;
		}

		return false;
	}


	/** Thumbnail Checker
	  *
	  * Decides if a thumbnail should be displayed or not.
	  * A thumbnail is displayed if it is set and
	  * the show_thumbnail meta is set to yes.
	  *
	  * @global object $post WordPress post object
	  *
	  * @return bool
	  *
	  */
	function has_thumbnail() {
		global $post;
		if( has_post_thumbnail() AND $this->framework->has_element( 'show_thumbnail' ) ) {
			return true;
		}
		return false;
	}

	/** Post Content Checker
	  *
	  * Decides if a post content should be displayed or not.
	  * A post content is displayed if it is not empty and
	  * the show_content meta is set to yes.
	  *
	  * @global object $post WordPress post object
	  *
	  * @return bool
	  *
	  */
	function has_post_content() {
		global $post;
		$content = trim( $post->post_content );

		if( $this->framework->has_element( 'show_content' ) AND !empty( $content ) ) {
			return true;
		}

		return false;
	}


	/** Item Feature Checker
	  *
	  * Checks weather an item inside a list has
	  * a specific feature or not. For example,
	  * it can check weather a displayed gallery
	  * item should have a read more link.
	  *
	  * @global object $parent WordPress post object
	  *
	  * @param string $element The element to check
	  *
	  * @return bool
	  *
	  */

	function item_has( $element ) {
		global $parent;
		if( $parent->postmeta['show_item_' . $element] == 'yes' ) {
			return true;
		}
		else {
			return false;
		}
	}


	/** Post Feature Checker
	  *
	  * Checks weather the current post has
	  * a specific feature or not. For example,
	  * it can check weather a displayed gallery
	  * item should have a read more link.
	  *
	  * @global object $parent WordPress post object
	  *
	  * @param string $element The element to check
	  *
	  * @return bool
	  *
	  */

	function post_has( $element, $default = '' ) {
		global $post;
		$element = $post->postmeta['show_post_' . $element];

		if( !empty( $default ) ) {
			if( $element == 'default' ) {
				$return = $default;
			}
		}

		if( $element == 'yes' ) {
			$return = 'yes';
		}
		elseif( $element == 'no' ) {
			$return = 'no';
		}

		if( $return == 'yes' ) {
			return true;
		}
		else {
			return false;
		}



	}

	/** No Posts Display
	  *
	  * This function is used to display a message when there
	  * are no posts available. A theme can modify the
	  * functionality by specifying using the blueprint_show_no_posts
	  * hook
	  *
	  */
	function show_no_posts() {
		if( is_search() ) {
			$html = '
				<div class="twelve columns">
				<hgroup class="notice">
					<h1>' . $this->framework->options['no_search_results_title'] . '</h1>
					<h2>' . $this->framework->options['no_search_results_message'] . '</h2>
				</hgroup>
				</div>
			';
		}
		else {
			$html = '
				<div class="twelve columns">
				<hgroup class="notice">
					<h1>' . $this->framework->options['no_posts_title'] . '</h1>
					<h2>' . $this->framework->options['no_posts_message'] . '</h2>
				</hgroup>
				</div>
			';
		}

		$html = apply_filters( 'blueprint_show_no_posts', $html );
		echo $html;
	}

	/** Format Image
	  *
	  * This function is used to modify the display of
	  * images. It can be used for any HTML and is also
	  * hooked into the get_post_thumbnail filter. A theme
	  * can modify this functionality by using the
	  * blueprint_format_image hook
	  *
	  * @param string $html The HTML to modify
	  * @param integer $post_id The ID of the post the image is for
	  * @param integer $post_thumbnail_id The ID of the thumbnail
	  * @param string $size The size name of the image
	  * @param array $attr an array of attributes
	  *
	  * @return string $html
	  *
	  */

	function format_image( $html = '', $post_id, $post_thumbnail_id, $size = '', $attr = '' ) {
		$html = '<div class="image">' . $html . '</div>';
		$html = apply_filters( 'blueprint_format_image', $html, $post_id, $post_thumbnail_id, $size, $attr );
		return $html;
	}


	/** Format Content
	  *
	  * This function is used to modify the display of
	  * the post content. It can be used for any HTML and
	  * is also hooked into the the_content() filter. A theme
	  * can overwrite this functionality by specifying the
	  *  [prefix]format_content()
	  * function.
	  *
	  * @param string $content The HTML to modify
	  *
	  * @return string $content
	  *
	  */

	function format_content( $content ) {
		$content = '<div class="content">' . $content . '</div>';
		$content = apply_filters( 'blueprint_format_content', $content );
		return $content;
	}


	/** Boxed Classes
	  *
	  * Determines which class to give an element
	  * based on its boxed_[type] property. If content
	  * is boxed it will receive the box class, otherwise
	  * it will receive the section class
	  *
	  * @patam string $type The type of element
	  * @param string $classes Additional classes to add
	  *
	  * @return string
	  *
	  */
	function boxed_class( $type = 'content', $classes = '' ) {
		global $post, $in_mashup;

		if( $type == 'content' ) {
			$classes .= ' content';
		}

		if( $this->framework->has_element( 'boxed_' . $type ) AND empty( $in_mashup ) ) {
			return 'class="box ' . $classes . '"';
		}

		return 'class="section ' . $classes . '"';
	}


	/** Sidebar Positioning
	  *
	  * Determines the position of the sidebar on a page
	  *
	  * @global object $post The WordPress post object
	  *
	  * @return string
	  *
	  */
	function get_sidebar_position() {
		return $this->framework->get_sidebar_position();
	}

	/** Sidebar Content
	  *
	  * Determines the which sidebar to use on a page
	  *
	  * @global object $post The WordPress post object
	  *
	  * @return string
	  *
	  */
	function get_sidebar_content() {
		return $this->framework->get_sidebar_content();
	}


	/** Get Blueprint Template
	  *
	  * Determines which template file shuold be used as
	  * the main contents of a page. To make sure all is well
	  * the template must exist in the templates directory.
	  *
	  * Templates follow a specific naming convention. WordPress
	  * page templates must be prefixed by 'template-'. Each
	  * WordPress template file must be accompanied by a file
	  * in the templates directory which we use to display
	  * the contents. This must be named without the prefix.
	  *
	  * For post types the template name must be the same as
	  * the post type name.
	  *
	  * @global object $post The WordPress post object
	  *
	  * @return string
	  *
	  */
	function blueprint_template( $display = 'file', $mashup = false ) {
		global $post;

		if( $mashup == false AND ( is_archive() OR is_home() OR is_search() ) ) {
			$template = 'default.php';
		}
		else {
			$template = ( !empty( $post->postmeta['_wp_page_template'] ) ) ? str_replace( 'template-', '', $post->postmeta['_wp_page_template'] ) : $post->post_type . '.php';
			$template = ( $template == 'default' ) ? 'page.php' : $template;
		}

		if( $display == 'name') {
			$template = str_replace( '.php', '', $template );
		}




		return $template;
	}


	function get_blueprint_template( $post_id ) {
		$template = get_post_meta( $post_id, '_wp_page_template', true );
		$template = ( !empty( $template ) ) ? str_replace( 'template-', '', $template ) : get_post_type( $post_id ) . '.php';
		$template = ( $template == 'default' ) ? 'page.php' : $template;

		return $template;

	}

	/** Display Content Area
	  *
	  * Determines which content template to show, which
	  * sidebar to show (if any) and also determines the
	  * set positions for these elements and displays them.
	  *
	  * To display templates properly the template must exist
	  * in the templates directory.
	  *
	  * @uses get_sidebar_position()
	  * @uses get_sidebar_content()
	  * @uses blueprint_has_sidebar()
	  * @uses blueprint_template()
	  *
	  * @return string
	  *
	  */
  function blueprint_content( $no_sidebar = array() ) {
    global $post;

    $sidebar_position = $this->get_sidebar_position();
    $sidebar_content = $this->get_sidebar_content();

    $sidebar_classes = ( $sidebar_position == 'right' ) ? 'right last' : 'left';

    $content_classes = 'twelvecol';
    if( $this->has_sidebar( $no_sidebar ) AND !$this->has_pushed_sidebar() ) {
      $content_classes = ( $sidebar_position == 'right' ) ? 'left eightcol' : 'right eightcol last';
    }

    ob_start();
    if( $this->has_sidebar( $no_sidebar ) AND !$this->has_pushed_sidebar() ) {
      echo '<div class="' . $sidebar_classes . ' fourcol" id="blueprint-sidebar"><div class="page-sidebar">';
      dynamic_sidebar( $sidebar_content );
      echo '</div></div>';
    }
    $sidebar = ob_get_clean();

    ob_start();
      echo '<div class="' . $content_classes . '" id="blueprint-content"><div class="page-content">';
      	if( file_exists( get_template_directory() . '/templates/' . $this->blueprint_template() ) ) {
        	include( get_template_directory() . '/templates/' . $this->blueprint_template() );
        }

        comments_template();

      echo '</div></div>';
    $content = ob_get_clean();

    if( $sidebar_position == 'left' ) {
      echo $sidebar . $content;
    }
    else {
      echo $content . $sidebar;
    }

  }



	/** Display Pushed Sidebar Content
	  *
	  * In some cases a sidebar may be needed, but you may want
	  * to push it below some other content which is on top of
	  * the page.
	  *
	  * This function will take a fully formed content section
	  * (use of output buffering makes this easy) and generates
	  * the sidebared content area needed.
	  *
	  * @uses get_sidebar_position()
	  * @uses get_sidebar_content()
	  * @uses blueprint_has_sidebar()
	  *
	  * @return string
	  *
	  */

	function generate_pushed_content( $content ) {
		global $post;

		$sidebar_position = $this->get_sidebar_position();
		$sidebar_content = $this->get_sidebar_content();
		$sidebar_classes = ( $sidebar_position == 'right' ) ? 'last' : '';

		$content_classes = 'twelve columns';
		if( $this->has_sidebar() AND $this->has_pushed_sidebar() ) {
			$content_classes = ( $sidebar_position == 'right' ) ? 'eight columns' : 'eight columns';
		}

		ob_start();
		if( $this->has_sidebar() AND $this->has_pushed_sidebar() ) {
			echo '<div class="' . $sidebar_classes . ' four columns" id="blueprint-sidebar">';
			dynamic_sidebar( $sidebar_content );
			echo '</div>';
		}
		$sidebar = ob_get_clean();

		ob_start();
			echo '<div class="' . $content_classes . '">';
			echo $content;
			echo '</div>';
		$content = ob_get_clean();

		if( $sidebar_position == 'left' ) {
			echo $sidebar . $content;
		}
		else {
			echo $content . $sidebar;
		}
	}

	/** Layout Template
	  *
	  * Determines which content layout to how for agiven item.
	  * Layouts must be sorted into their respective directories
	  * in the layouts folder. The given $type parameter should
	  * be the name of the folder and the files should be named
	  * layout-[name].php
	  *
	  * To display layouts properly the layout must exist in the
	  * layouts directory.
	  *
	  */
	function layout_template( $type, $template = '' ) {
		if( empty( $template ) OR $template == 'default' ) {
			$template = $this->framework->options[$type . '_layout' ];
		}

		$template = str_replace( 'layout-' , '', $template );


		get_template_part( 'layouts/' . $type . '/layout', $template );
	}

	/** Postlist Arguments
	  *
	  * Compiles arguments for use in a post list.
	  *
	  * @global integer $paged The WordPress page number
	  *
	  * @return array $args An array to be passed to a WP_Query object
	  *
	  */
	function get_postlist_args( $postmeta ) {
		global $paged;
		$args = array(
			'posts_per_page' => ( isset( $postmeta['posts_per_page'] ) AND $postmeta['posts_per_page'] == 0 ) ? -1 : $postmeta['posts_per_page'],
			'orderby' => $postmeta['orderby'],
			'order' => $postmeta['order'],
			'paged' => $paged,
		);

		if( !empty( $postmeta['category'] ) ) {
			$category = @unserialize( $postmeta['category'] );
			if( !empty( $category ) and is_array( $category ) ) {
				$args['category__in'] = unserialize( $postmeta['category'] );
			}
		}

		if ( !empty( $postmeta['only_thumbnailed'] ) AND $postmeta['only_thumbnailed'] == 'yes' ) {
			$args['meta_query'] = array(
				array(
					'key' => '_thumbnail_id',
					'value' => '',
					'compare' => '!='
				)
			);
		}

		return $args;
	}


	/** Pagination Navigation
	  *
	  * Creates page number links so the user can navigate
	  * between pages. A theme can modify the output by using
	  * the blueprint_pagination filter
	  *
	  * @global object $wp_query The WordPress query object
	  *
	  */
	function page_navigation_pagination( $query = false, $page = false ) {
		if( $query == false ) {
			global $wp_query;
			$query = $wp_query;
		}


		$pagination = array(
			'base'       => str_replace( 99999, '%#%', get_pagenum_link( 99999 ) ),
			'format'     => '?paged=%#%',
			'current'    => ( !empty( $page ) ) ? $page : max( 1, get_query_var( 'paged' ) ),
			'total'      => $query->max_num_pages,
			'next_text'  => __( 'next', 'elderberry' ) ,
			"prev_text"  => __( 'previous', 'elderberry' )
		);

		echo '<div class="pagination posts-navigation">';

		ob_start();
		echo paginate_links( $pagination );
		$html = ob_get_clean();
		$html = apply_filters( 'blueprint_pagination', $html );

		echo $html;
		echo '</div>';

	}

	/** Page Navigation Links
	  *
	  * Creates next and previous navigation links for pages.
	  *
	  * @global object $wp_query The WordPress query object
	  *
	  */
	function page_navigation_links( $query = false, $page = false ) {
		global $paged;
		$paged = ( !empty( $page ) ) ? $page : $paged;
		$page = ( $paged == 0 ) ? 1 : $paged;

		$previous_page = $page - 1;
		$next_page = $page + 1;

		$previous = '';
		if( $previous_page >= 1 ) {
			$previous = get_pagenum_link( $previous_page );
			$previous = '<a href="' . $previous . '">' . __( 'previous', 'elderberry' ) . '</a>';
		}

		$next = '';
		if( $next_page <= $query->max_num_pages ) {
			$next = get_pagenum_link( $next_page );
			$next = '<a href="' . $next . '">' . __( 'next', 'elderberry' ) . '</a>';
		}

	?>

			<div class='posts-navigation prevnext'>
				<div class='previous-posts'>
					<?php echo $previous ?>
				</div>
				<div class='next-posts'>
					<?php echo $next ?>
				</div>
			</div>

	<?php
	}

	/** Page Navigation
	  *
	  * Finds and displays the navigation type needed.
	  *
	  */
	function page_navigation( $query, $page = false ) {
		call_user_func( array( $this, 'page_navigation_' . $this->framework->options['pagination_type'] ), $query, $page );
	}



	/** AJAX Post Loader
	  *
	  * Allows users to navigate through post lists using ajax.
	  * It is used in mashup pages which have multiple post
	  * lists.
	  *
	  * @uses layout_template()
	  * @uses show_no_posts()
	  *
	  */
	function load_posts() {

		$args = unserialize( urldecode( $_POST['args'] ) );
		$args['paged'] = $_POST['page'];

		$posts = new WP_Query( $args );

		if( $posts->have_posts() ) {

			echo '<div class="posts" data-paged="' . $_POST['page'] . '" data-type="postlist" data-layout="' . $_POST['layout'] . '" data-args="' . urlencode( serialize( $args ) ) . '"><div class="inner">';

			while( $posts->have_posts() ) {
				$posts->the_post();
				$this->layout_template( 'post', $_POST['layout'] );
			}

			$this->page_navigation( $posts, $_POST['page'] );

			echo '</div></div>';

		}
		else {
			$this->show_no_posts();
		}

		die();


	}


	function get_page_title() {
		if( is_category() ) {
			$title = $this->framework->options['category_page_title'];
			$title = str_replace( '%s', single_cat_title( '', false ), $title );
		}
		elseif( is_tag() ) {
			$title = $this->framework->options['tag_page_title'];
			$title = str_replace( '%s', single_cat_title( '', false ), $title );
		}
		elseif( is_author() ) {
			$title = $this->framework->options['author_page_title'];
			$title = str_replace( '%s', get_the_author(), $title );
		}
		elseif( is_day() ) {
			$title = $this->framework->options['daily_page_title'];
			$title = str_replace( '%s', get_the_date(), $title );
		}
		elseif( is_month() ) {
			$title = $this->framework->options['monthly_page_title'];
			$title = str_replace( '%s', get_the_date( 'F Y' ), $title );
		}
		elseif( is_year() ) {
			$title = $this->framework->options['yearly_page_title'];
			$title = str_replace( '%s', get_the_date( 'Y' ), $title );
		}
		elseif( is_search() ) {
			$title = $this->framework->options['search_page_title'];
			$title = str_replace( '%s', get_search_query(), $title );
		}
		elseif( is_home() ) {
			$title = $this->framework->options['home_page_title'];
		}
		else {
			$title = 'Archives';
		}
		return apply_filters( 'blueprint_page_title', $title );
	}


}





?>