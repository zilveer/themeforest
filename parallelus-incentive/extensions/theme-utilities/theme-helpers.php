<?php

#-----------------------------------------------------------------
# Enable shortdoces in sidebar default Text widget
#-----------------------------------------------------------------
add_filter('widget_text', 'do_shortcode');


#-----------------------------------------------------------------
# Register custom templates contexts for Layout Manager
#-----------------------------------------------------------------

/**
 * When creating custom templates that can be selected from the Page 
 * templates menu they can be registered with the Layout Manager to 
 * ensure the default context (and layout settings) are applied to 
 * these files instead of the stanard "Page" context.
 */
if ( ! function_exists( 'theme_template_file_context' ) ) :
	function theme_template_file_context( $context, $template ) {

		// Blog templates
		$blog_template[] = locate_template('templates/blog-image-top.php');
		$blog_template[] = locate_template('templates/blog-image-left.php');

		if ( in_array($template, $blog_template) ) {
			$context = 'blog';
		}

		// Portfolio templates
		$portfolio_template[] = locate_template('templates/grid-rows.php');
		$portfolio_template[] = locate_template('templates/grid-rows-filtered.php');
		$portfolio_template[] = locate_template('templates/grid-staggered.php');
		$portfolio_template[] = locate_template('templates/grid-staggered-filtered.php');

		if ( in_array($template, $portfolio_template) ) {
			$context = 'portfolio';
		}

		return $context;
	}
endif;
add_filter( 'template_context', 'theme_template_file_context', 10, 2 );


#-----------------------------------------------------------------
# Site Title
#-----------------------------------------------------------------

function format_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	$_paged = (isset($paged) && is_numeric($paged)) ? $paged : 0;
	$_page = (isset($page) && is_numeric($page)) ? $page : 0;
	$paging = max( intval($_paged), intval($_page) );
	if ( $paging >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'framework' ), $paging );

	return $title;
}
add_filter( 'wp_title', 'format_wp_title', 10, 2 );


#-----------------------------------------------------------------
# Post Item Details (meta: category, tags, author, etc...)
#-----------------------------------------------------------------

if ( ! function_exists( 'theme_post_meta' ) ) :
function theme_post_meta() {

	// Separator
	$sep = '<span class="meta-sep">/</span>';

	// Date
	$date = sprintf( '<span class="date-meta"><span class="meta-label">'. __( 'Date:', 'framework' ) .' </span><time class="entry-date" datetime="%1$s">%2$s</time>'.$sep.'</span>',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	// Author
	$author = sprintf( '<span class="author vcard author-meta">'. $sep .'<span class="meta-label">'. __( 'Posted by:', 'framework' ) .' </span> &nbsp;<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'framework' ), get_the_author() ) ),
		get_the_author()
	);

	// Categories
	if ( get_post_type() == 'portfolio' ) {
		// Portfolio categories
		$categories_list = get_the_term_list( $post->ID, 'portfolio-category', '', __( ', ', 'framework' ) );
	} else {
		// Blog categories
		$categories_list = get_the_category_list( __( ', ', 'framework' ) );
	}

	if ($categories_list) 
		$categories = '<span class="categories-meta"><span class="meta-label">'. __( 'Category:', 'framework' ) .' </span>'. $categories_list .'</span>';

	// Comments
	$comments_link = '';
	if ( comments_open() ) {
		$count = get_comments_number();
		if ( $count == 0 ) {
			$comments = __( 'Leave a reply', 'framework' );
		} elseif ( $count > 1 ) {
			$comments = $count . __( ' Replies', 'framework' );
		} else {
			$comments = __( '1 Reply', 'framework' );
		}
		$show_sep = ($categories) ? $sep : '';
		$comments_link = '<span class="comments-meta">'. $show_sep .'<a href="' . get_comments_link() .'" class="link-to-comments">'. $comments.'</a></span>';
	}

	// Output the items above
	echo '<div class="post-meta clearfix">'. $date . $categories . $comments_link . $author . '</div>';
	
	// Tag List (this is last)
	$show_tags = (get_options_data('blog-options', 'show-tags')) ? true : false;
	if ( has_tag() && $show_tags ) echo '<div class="tags-meta"><span class="meta-label">'. __( 'Tags:', 'framework' ) .' </span>'. get_the_tag_list( '', __( ', ', 'framework' ) ) .'</div>';

}
endif;


#-----------------------------------------------------------------
# Comments and Pingbacks
#-----------------------------------------------------------------

if ( ! function_exists( 'theme_comment' ) ) :
function theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'framework' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'framework' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'framework' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'framework' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'framework' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'framework' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'framework' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;


#-----------------------------------------------------------------
# Next / Previous Post Navigation
#-----------------------------------------------------------------
if ( ! function_exists( 'next_and_previous_post_navigation' ) ) :
/**
 * Displays navigation to next/previous pages when possible.
 */
function next_and_previous_post_navigation( $options = false ) {
	global $post;

	// Query Next/Previous Posts
	$postNav['next'] = get_next_post();
	$postNav['prev'] = get_previous_post();

	// Create the navitation elements
	foreach($postNav as $nav => $navPost) {

		if ($navPost) {
			$args = array(
				'posts_per_page' => 1,
				'include' => $navPost->ID
			);
			$postObj = get_posts($args);
			foreach ($postObj as $post) {
				setup_postdata($post);
				?>
				<a href="<?php the_permalink() ?>" class="post-nav post-<?php echo $nav ?>" rel="<?php echo $nav ?>">
					<i class="fa fa-angle-<?php echo ($nav == 'next') ? 'right' : 'left' ?> nav-arrow"></i>
					<b class="post-nav-shadow"></b>
					<div class="nav-thumb">
						<?php 
						if ( '' != get_the_post_thumbnail() ) {
							// show thumbnail 
							$thumb = get_post_thumbnail_id(); 
							$image = vt_resize( $thumb, '', 300, 200, true ); // 3x2 image ratio
							echo '<img src="'. $image['url'] .'" alt="'. esc_attr('') .'">';

						} else {

							// show post format icon ?>
							<div class="post-symbol">
								<?php 
								// Output Post Format Icon
								switch(get_post_format()) {
									case "audio":
										echo '<i class="fa fa-volume-up"></i>';
										break;
									case "gallery":
										echo '<i class="fa fa-camera"></i>';
										break;
									case "image":
										echo '<i class="fa fa-picture-o"></i>';
										break;
									case "link":
										echo '<i class="fa fa-link"></i>';
										break;
									case "quote":
										echo '<i class="fa fa-quote-left"></i>';
										break;
									case "video":
										echo '<i class="fa fa-play"></i>';
										break;
									default:
										echo '<i class="fa fa-file"></i>';
								}
								?>
							</div>
							<?php
						} ?>
					</div>
					<div class="post-nav-info-wrapper">
						<span class="post-nav-info">
							<h4 class="entry-title"><?php the_title(); ?></h4>
							<p class="entry-date"><?php the_date('F j, Y'); ?></p>
						</span>
					</div>
				</a>
				<?php
				wp_reset_postdata();
			} //end foreach
		} // end if
	} // end foreach
}
endif;


#-----------------------------------------------------------------
# Post Content and Related Functions
#-----------------------------------------------------------------

// Get image size information
//...............................................

if ( ! function_exists( 'get_post_image_size' ) ) :
	function get_post_image_size( $default = 'post-thumbnail', $shortcode = false ) {

		$size = $default;

		if (isset($shortcode)) {
			// Test for shortcode specified width params
			$img_w = (isset($shortcode['image_width'])) ? $shortcode['image_width'] : '';
			$img_h = (isset($shortcode['image_height'])) ? $shortcode['image_height'] : '';
		} else {
			// Use standard WP thumbnail aliases
			$prefix = (is_single()) ? 'single-' : '';
			$img_w = get_options_data('blog-options', $prefix.'image-width');  
			$img_h = get_options_data('blog-options', $prefix.'image-height'); // defaults to 9999 for unlimited
		}

		// is a size set for width or height
		if ( !empty($img_w) || !empty($img_h) ) {
			// defaults to 0 for auto
			if (empty($img_w)) $img_w = 0;
			if (empty($img_h)) $img_h = 0;
			// set size
			$size = array($img_w, $img_h);
		}

		return $size;
	}
endif;

// Show Post Content (excerpt or full post)
//...............................................

if ( ! function_exists( 'theme_post_content' ) ) :
	function theme_post_content( $post_id = false, $content = false, $excerpt = false ) {
		global $post, $custom_query;

		$post_id = ($post_id) ? $post_id : $post->ID;
		$post_type = get_post_type($post_id);

		$postExcerpts  = get_options_data('blog-options', 'post-excerpts', false);
		$excerptLength = get_options_data('blog-options', 'excerpt-length', false);
		$readMore = get_options_data('blog-options', 'read-more', -1);
		$readMore_Exclude = array('quote','link','image'); // post formats to exclude read more link

		// Check for setting overrides by a shortcode query
		if (isset($custom_query)) {
			$customPostExcerpts = (isset($custom_query->query['post_excerpts'])) ? $custom_query->query['post_excerpts'] : false;
			if ($customPostExcerpts && !empty($customPostExcerpts) && $customPostExcerpts !== 'false') {
				$postExcerpts = true;
			}
			$customExcerptLength = (isset($custom_query->query['excerpt_length'])) ? $custom_query->query['excerpt_length'] : false;
			if ($customExcerptLength && !empty($customExcerptLength)) {
				$excerptLength = $customExcerptLength;
			}
			$customReadMore = (isset($custom_query->query['read_more'])) ? $custom_query->query['read_more'] : false;
			if ($customReadMore !== false && !empty($customReadMore)) {
				$readMore = $customReadMore;
			}
		}
		if ( !is_single() && ($postExcerpts || is_search()) ) : ?>
			<div class="entry-content summary">
				<p><?php echo customExcerpt(get_the_excerpt(), $excerptLength); ?></p>
				<?php if ( isset($readMore) && !empty($readMore) && $readMore != -1 && !in_array(get_post_format(), $readMore_Exclude) ) : ?>
					<p class="readmore"><a href="<?php the_permalink() ?>" class="btn small"><?php echo $readMore ?></a></p>
				<?php endif; ?>
			</div><!-- .entry-summary -->
			<?php 
		else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'framework' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'framework' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
			<?php 
		endif;

		// Footer 
		if ($post_type == 'post') { 
			?>
			<footer class="entry-footer entry-meta">
				<?php 

				if (is_single()) {
					edit_post_link( __( 'Edit', 'framework' ), '<span class="edit-link">', '</span>' ); 
				} 

				if (get_post_format() == 'image' && !is_single()) {
					// Image post format, title in footer
					theme_post_title();
				}

				theme_post_meta(); 

				if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
					<div class="author-info">
						<div class="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'theme_author_bio_avatar_size', 68 ) ); ?>
						</div><!-- .author-avatar -->
						<div class="author-description">
							<h2><?php printf( __( 'About %s', 'framework' ), get_the_author() ); ?></h2>
							<p><?php the_author_meta( 'description' ); ?></p>
							<div class="author-link">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'framework' ), get_the_author() ); ?>
								</a>
							</div><!-- .author-link	-->
						</div><!-- .author-description -->
					</div><!-- .author-info -->
				<?php endif; ?>
			</footer><!-- .entry-meta -->
			<?php
		} // End Footer
	}
endif;


#-----------------------------------------------------------------
# Header and Footer Content
#-----------------------------------------------------------------

// Check the content type
function get_top_content( $field ) {
	$type = false;
	$content = explode('@', $field);

	// Look up the content
	if ( is_array($content) && isset($content[0]) ) {
		// Get the specified content type
		$type = $content[0];
	} else {
		$type = 'default';
	}
	return $type;

}
// Output the content
function show_top_content( $type = 'default', $source ) {
	if ($type == 'slide-show' && function_exists('putRevSlider')) :
		// Get slide show information
		$content = explode(':', $source);
		$sliderAlias   = apply_filters( 'header-slide-show', $content[1] );
		$sectionClass  = 'rev_slider-'. $sliderAlias;
		// Slide show
		putRevSlider( $sliderAlias ); 
	else :
		// Default Header (title and breadcrumbs) ?>
		<div class="inner-wrapper">
			<?php
			if ($type != 'default') :							
				if ($type == 'static-block') $type = 'static_block';
				$content = explode('@', $source);
				echo get_layout_content_block($type, $content[1]);
			/* 
			// NO DEFAULT, Default is empty.
			else : ?>
				<!-- default content -->
				<?php
			*/
			endif; // $type != 'default' ?>
		</div>
		<?php
	endif; // $type == 'slideshow' 
}

function get_footer_content( $field ) {
	return get_top_content( $field );
}
function show_footer_content( $type = 'default', $source ) {
	show_top_content( $type, $source );
}


#-----------------------------------------------------------------
# Title Functions
#-----------------------------------------------------------------

// Show Page Titles
//...............................................
// Outputs title with link or static container for loops and single posts/pages

if ( ! function_exists( 'theme_post_title' ) ) :
	function theme_post_title( $post_id = false, $tag = false, $title = false ) {
		global $post;

		$post_id   = ($post_id) ? $post_id : $post->ID;
		$tag       = ($tag) ? $tag : 'h1';
		$title     = ($title) ? $title : get_the_title($post_id); // esc_attr($post->post_title)
		$hideTitle = get_post_meta($post_id, 'hide_title', true);

		if ($hideTitle && is_single()) {
			return false;
		}

		if ( is_single() ) :
			// single, get as just text
			echo '<'.$tag.' class="page-title">'. $title .'</'.$tag.'>';
		else :
			// list (blog) get as link
			echo '<'.$tag.' class="entry-title">';
			echo '	<a href="'. get_permalink($post_id) .'" title="'. sprintf( __( 'Permalink to %s', 'framework' ), the_title_attribute( 'echo=0' ) ) .'" rel="bookmark">'. $title .'</a>';
			echo '</'.$tag.'>';
		endif; // is_single() 

	}
endif;


// More Page Titles (outside the loop)
//...............................................
// Similar to titles generaged by wp_title() for use in headers and other areas outside the loop.


function generate_title() {
	global $wpdb, $wp_locale;

	$m        = get_query_var('m');
	$year     = get_query_var('year');
	$monthnum = get_query_var('monthnum');
	$day      = get_query_var('day');
	$search   = get_search_query();
	$title    = '';
	$t_sep    = ' ';

	// If there is a post
	if ( is_single() || ( is_home() && !is_front_page() ) || ( is_page() && !is_front_page() ) ) {
		$title = single_post_title( '', false );
	}
	// If there's a category or tag
	if ( is_category() || is_tag() ) {
		$title = single_term_title( '', false );
	}
	// If there's a taxonomy
	if ( is_tax() ) {
		$term = get_queried_object();
		$tax = get_taxonomy( $term->taxonomy );
		$title = single_term_title( $tax->labels->name . $t_sep, false );
	}
	// If there's an author
	if ( is_author() ) {
		$author = get_queried_object();
		$title = $author->display_name;
	}
	// If there's a post type archive
	if ( is_post_type_archive() )
		$title = post_type_archive_title( '', false );
	// If there's a month
	if ( is_archive() && !empty($m) ) {
		$my_year = substr($m, 0, 4);
		$my_month = $wp_locale->get_month(substr($m, 4, 2));
		$my_day = intval(substr($m, 6, 2));
		$title = ( $my_month ? $my_month .  $t_sep : '' ) . ( $my_day ? $my_day . $t_sep : '' ) . $my_year;
	}
	// If there's a year
	if ( is_archive() && !empty($year) ) {
		$title = '';
		if ( !empty($monthnum) )
			$title .= $wp_locale->get_month($monthnum) . $t_sep;
		if ( !empty($day) )
			$title .= zeroise($day, 2) . $t_sep;
		$title .= $year;
	}
	// If it's a search
	if ( is_search() ) {
		/* translators: 1: separator, 2: search phrase */
		$title = sprintf(__('Search Results %1$s %2$s', 'framework'), __('for', 'framework'), strip_tags($search));
	}
	// If it's a 404 page
	if ( is_404() ) {
		$title = __('Page not found', 'framework');
	}

	return $title;

}


#-----------------------------------------------------------------
# Get Skin (find and return the skin filename)
#-----------------------------------------------------------------

if (!function_exists('get_theme_skin')) :
function get_theme_skin( $options = array() ) {

	// Get the layout specific data.
	$layout_data = get_layout_options('other_options');
//	$layout = (isset($layout_data['custom_options'])) ? $layout_data['custom_options'] : false;

	// Skin
	$skin = get_options_data('options-page', 'skin');
	//$skin = (isset($layout['skin']) && !empty($layout['skin'])) ? $layout['skin'] : $skin; // layout specific skin override
	$skin = (isset($layout_data['skin']) && !empty($layout_data['skin'])) ? $layout_data['skin'] : $skin; // layout specific skin override	
	$skin = apply_filters( 'skin_css', $skin ); // filter for overloading (if needed)
	$skin = (!isset($skin) || empty($skin)) ? 'style-skin-1.css' : $skin; // make sure we don't have blank values

	return $skin;
}
endif;


#-----------------------------------------------------------------
# Body Class
#-----------------------------------------------------------------

function add_theme_body_class( $classes ) {

	// Get layout data
	$layout = get_layout_options();

	// Get layout data
	$layout_data = get_layout_options('other_options');
	$layout_options = (isset($layout_data['custom_options'])) ? $layout_data['custom_options'] : false;

	// Layout Specific
	//...............................................

	if ( $layout && isset($layout['title']) ) {
		$classes[] = 'layout-'. sanitize_title($layout['title']);
	} else {
		// If not using Layout Manager (or if error, fallback is default WP functionality)
		$classes[] = 'no-layout';
		// More cases specific no Layout Manager
		if ( ! is_active_sidebar( 'sidebar-default' ) || is_page_template( 'templates/full-width.php' ) || is_page_template( 'templates/grid-rows.php' ) || is_page_template( 'templates/grid-rows-filtered.php' ) || is_page_template( 'templates/grid-staggered.php' ) || is_page_template( 'templates/grid-staggered-filtered.php' ) || is_tax('portfolio-category') || is_singular('portfolio')  ) {
			$classes[] = 'full-width'; 
		}
	}

	// Blank page
	if ( is_page_template( 'templates/blank-page.php' ) ) {
		$classes[] = 'blank-page'; 
	}

	// Layout Style
	//$layout_style = (!empty($layout_options['layout-style'])) ? $layout_options['layout-style'] : get_options_data('options-page', 'layout-style');
	$layout_style = (!empty($layout_data['layout-style'])) ? $layout_data['layout-style'] : get_options_data('options-page', 'layout-style');

	if ($layout_style == 'boxed' || $layout_style == 'padded-box') { 
		$classes[] = 'boxed';
	}
	if ($layout_style == 'padded-box') {
		$classes[] = 'padded-box';
	}

	// Skin
	$skin = get_theme_skin();
	if ( isset($skin) && !empty($skin) ) { 
		$skin_class = str_replace('.css', '', $skin);
		$classes[] = $skin_class;
	}

	// context
	if ( isset($GLOBALS['context']) ) {
		$classes[] = 'context-'.$GLOBALS['context'];
	}

	// Generic WP
	//...............................................

	// Post thumbnails
	if ( !is_404() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	// No author names on posts when site has only one author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	return $classes;
}
add_filter( 'body_class', 'add_theme_body_class' );


#-----------------------------------------------------------------
# Post Format Media
#-----------------------------------------------------------------

// Output Audio Player for Post Format
//...............................................

if ( !function_exists( 'theme_audio_player' ) ) :
    function theme_audio_player($post_id, $width = 1200) {

    	// Get the player media
		$mp3    = get_post_meta($post_id, 'postformat_audio_mp3', TRUE);
		$ogg    = get_post_meta($post_id, 'postformat_audio_ogg', TRUE);
		$embed  = get_post_meta($post_id, 'postformat_audio_embedded', TRUE);
		$height = get_post_meta($post_id, 'postformat_poster_height', TRUE);

		if ( isset($embed) && $embed != '' ) {
			// Embed Audio
			if( !empty($embed) ) {
				// run oEmbed for known sources to generate embed code from audio links
				echo '<div class="audio-container">'. $GLOBALS['wp_embed']->autoembed( stripslashes(htmlspecialchars_decode($embed)) ) .'</div>';

				return; // and.... Done!
			}

		} else {
		    // Other audio formats ?>

			<script type="text/javascript">
		
				jQuery(document).ready(function(){

					if(jQuery().jPlayer) {
						jQuery("#jquery_jplayer_<?php echo $post_id; ?>").jPlayer({
							ready: function (event) {

								// set media
								jQuery(this).jPlayer("setMedia", {
								    <?php 
								    /*
								    if($poster != '') :
								    	echo 'poster: "'. $poster .'",';
								    endif;
								    */
								    if($mp3 != '') :
										echo 'mp3: "'. $mp3 .'",';
									endif;
									if($ogg != '') :
										echo 'oga: "'. $ogg .'",';
									endif; ?>
									end: ""
								});
							},
							<?php if( !empty($poster) ) { ?>
							size: {
	        				    width: "<?php echo $width; ?>px",
	        				    height: "<?php echo $height . 'px'; ?>"
	        				},
	        				<?php } ?>
							swfPath: "<?php echo get_stylesheet_directory_uri(); ?>/assets/js",
							cssSelectorAncestor: "#jp_interface_<?php echo $post_id; ?>",
							supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
						});
					
					}
				});
			</script>

			<div id="jquery_jplayer_<?php echo $post_id; ?>" class="jp-jplayer jp-jplayer-audio"></div>

			<div class="jp-audio-container">
				<div class="jp-audio">
					<div class="jp-type-single">
						<div id="jp_interface_<?php echo $post_id; ?>" class="jp-interface">
							<ul class="jp-controls">
								<li><div class="seperator-first"></div></li>
								<li><div class="seperator-second"></div></li>
								<li><a href="#" class="jp-play" tabindex="1"><i class="fa fa-play"></i><span>play</span></a></li>
								<li><a href="#" class="jp-pause" tabindex="1"><i class="fa fa-pause"></i><span>pause</span></a></li>
								<li><a href="#" class="jp-mute" tabindex="1"><i class="fa fa-volume-up"></i><span>mute</span></a></li>
								<li><a href="#" class="jp-unmute" tabindex="1"><i class="fa fa-volume-off"></i><span>unmute</span></a></li>
							</ul>
							<div class="jp-progress-container">
								<div class="jp-progress">
									<div class="jp-seek-bar">
										<div class="jp-play-bar"></div>
									</div>
								</div>
							</div>
							<div class="jp-volume-bar-container">
								<div class="jp-volume-bar">
									<div class="jp-volume-bar-value"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
		} // End if embedded/else
    }
endif;

// Video Player / Embeds (self-hosted, jPlayer)
//...............................................

if ( !function_exists( 'theme_video_player' ) ) :
    function theme_video_player($post_id, $width = 1200) {
		
    	// Check for embedded video
    	$embed = get_post_meta($post_id, 'postformat_video_embed', true); 
    	if( !empty($embed) ) {
			// run oEmbed for known sources to generate embed code from video links
			echo '<div class="video-container">'. $GLOBALS['wp_embed']->autoembed( stripslashes(htmlspecialchars_decode($embed)) ) .'</div>';

			return; // and.... Done!
		}


		// Get the player media options
    	$height = get_post_meta($post_id, 'postformat_video_height', true);
    	$m4v = get_post_meta($post_id, 'postformat_video_m4v', true);
    	$ogv = get_post_meta($post_id, 'postformat_video_ogv', true);
    	$webm = get_post_meta($post_id, 'postformat_video_webm', true);
    	$poster = get_post_meta($post_id, 'postformat_video_poster', true);

		?>
	    <script type="text/javascript">
	    	jQuery(document).ready(function(){
			
	    		if(jQuery().jPlayer) {
	    			jQuery("#jquery_jplayer_<?php echo $post_id; ?>").jPlayer({
	    				ready: function (event) {
							// mobile display helper
							// if(event.jPlayer.status.noVolume) {	$('#jp_interface_<?php echo $post_id; ?>').addClass('no-volume'); }
							// set media
	    					jQuery(this).jPlayer("setMedia", {
	    						<?php if($m4v != '') : ?>
	    						m4v: "<?php echo $m4v; ?>",
	    						<?php endif; ?>
	    						<?php if($ogv != '') : ?>
	    						ogv: "<?php echo $ogv; ?>",
	    						<?php endif; ?>
	    						<?php if($webm != '') : ?>
	    						webmv: "<?php echo $webm; ?>",
	    						<?php endif; ?>
	    						<?php if ($poster != '') : ?>
	    						poster: "<?php echo $poster; ?>"
	    						<?php endif; ?>
	    					});
	    				},
	    				size: {
	    				    width: "<?php echo $width ?>px",
	    				    // height: "<?php echo $height . 'px'; ?>"
	    				},
	    				swfPath: "<?php echo get_stylesheet_directory_uri(); ?>/assets/js",
	    				cssSelectorAncestor: "#jp_interface_<?php echo $post_id; ?>",
	    				supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
	    			});
	    		}
	    	});
	    </script>

	    <div id="jquery_jplayer_<?php echo $post_id; ?>" class="jp-jplayer jp-jplayer-video"></div>

	    <div class="jp-video-container">
	        <div class="jp-video">
	            <div class="jp-type-single">
	                <div id="jp_interface_<?php echo $post_id; ?>" class="jp-interface">
	                    <ul class="jp-controls">
	                    	<li><div class="seperator-first"></div></li>
	                        <li><div class="seperator-second"></div></li>
	                        <li><a href="#" class="jp-play" tabindex="1"><i class="fa fa-play"></i><span>play</span></a></li>
	                        <li><a href="#" class="jp-pause" tabindex="1"><i class="fa fa-pause"></i><span>pause</span></a></li>
	                        <li><a href="#" class="jp-mute" tabindex="1"><i class="fa fa-volume-up"></i><span>mute</span></a></li>
	                        <li><a href="#" class="jp-unmute" tabindex="1"><i class="fa fa-volume-off"></i><span>unmute</span></a></li>
	                    </ul>
	                    <div class="jp-progress-container">
	                        <div class="jp-progress">
	                            <div class="jp-seek-bar">
	                                <div class="jp-play-bar"></div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="jp-volume-bar-container">
	                        <div class="jp-volume-bar">
	                            <div class="jp-volume-bar-value"></div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <?php 

	}
endif;


#-----------------------------------------------------------------
# Excerpt Functions
#-----------------------------------------------------------------

// Replace "[...]" in excerpt with "..."
//................................................................
function new_excerpt_more($excerpt) {
	return str_replace('[...]', '...', $excerpt);
}
add_filter('wp_trim_excerpt', 'new_excerpt_more');


// Modify the WordPress excerpt length
//................................................................
/**
 * We set this pretty high because our "customExcerpt" function 
 * uses the WordPress excerpt for its source since it is already 
 * stripped of HTML, images, shortcodes, etc.  
 * 
 */
function new_excerpt_length($length) {
	return 250;
}
add_filter('excerpt_length', 'new_excerpt_length');


// Custom Length Excerpts
//................................................................
/**
 * Usage:
 *
 * echo customExcerpt(get_the_content(), 30);
 * echo customExcerpt(get_the_content(), 50);
 * echo customExcerpt($your_content, 30);
 * 
 */
function customExcerpt($excerpt = '', $excerpt_length = 50, $tags = '', $trailing = '...') {
	global $post;
	
	if (has_excerpt()) {
		// see if there is a user created excerpt, if so we use that without any trimming
		return  get_the_excerpt();
	} else {
		// otherwise make a custom excerpt
		$string_check = explode(' ', $excerpt);
		if (count($string_check, COUNT_RECURSIVE) > $excerpt_length) {
			$excerpt = strip_shortcodes( $excerpt );
			$new_excerpt_words = explode(' ', $excerpt, $excerpt_length+1); 
			array_pop($new_excerpt_words);
			$excerpt_text = implode(' ', $new_excerpt_words); 
			$temp_content = strip_tags($excerpt_text, $tags);
			$short_content = preg_replace('`\[[^\]]*\]`','',$temp_content);
			$short_content .= $trailing;
			
			return $short_content;
		} else {
			// no trimming needed, excerpt is too short.
			return $excerpt;
		}
	}
} 


#-----------------------------------------------------------------
# Menu (fallback to page list)
#-----------------------------------------------------------------

function theme_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'theme_page_menu_args' );


#-----------------------------------------------------------------
# Color Converstions
#-----------------------------------------------------------------

// HEX->RGB
//................................................................
if ( ! function_exists( 'HexToRGB' ) ) :
	function HexToRGB($hex) {
		$hex = str_replace("#", "", $hex);
		$color = array();
		
		if(strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . $r);
			$color['g'] = hexdec(substr($hex, 1, 1) . $g);
			$color['b'] = hexdec(substr($hex, 2, 1) . $b);
		}
		else if(strlen($hex) == 6) {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}
		
		return $color;
	}
endif;

if ( ! function_exists( 'get_as_rgba' ) ) :
	function get_as_rgba($hex = '#000000', $opacity = 1) {
		$rgb = HexToRGB($hex);
		$rgba = 'rgba('.$rgb['r'].','.$rgb['g'].','.$rgb['b'].','.$opacity.')';
		
		return $rgba;
	}
endif;

if ( ! function_exists( 'as_rgba' ) ) :
	function as_rgba($hex = '#000000', $opacity = 1) {
		$rgba = get_as_rgba($hex, $opacity);
		echo $rgba;
	}
endif;


#-----------------------------------------------------------------
# Other stuff
#-----------------------------------------------------------------

// Fix wmode in WP oEmbeds
//................................................................
/**
 * Prevents iframes (like YouTube) from floating over menus z-indexed CSS
 */
function add_video_wmode_transparent($html, $url, $attr) {
   if (strpos($html, "<embed src=" ) !== false) {
        $html = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed wmode="transparent" ', $html);
        return $html;
   } else {
        return $html;
   }
}
add_filter('embed_oembed_html', 'add_video_wmode_transparent', 10, 3);

// Fix for Jetpack error
//................................................................
/**
 * overrides problem with opengraph tags resulting in error message:
 * Warning: preg_match() expects parameter 2 to be string, object given in /home/nopants/public_html/vellum-demo/wp-includes/post-template.php on line 199
 *
 * The problem is specific to the way the opengraph functions try to get excerpts when applying certain filters, which calls the_content() and returns an
 * object instead of a string, resulting in the error.
 */
add_filter('jetpack_enable_open_graph', 'no_jetpack_opengraph_please', 10, 3);
function no_jetpack_opengraph_please(){
	return false;
}

// Add Runway credits
//................................................................
function built_with_runway() {
	echo '<style type="text/css">#footer-thankyou { display:none; } </style>';
	echo '<script>jQuery("p#footer-left").html(\'Built with <a href="http://runwaywp.com" target="_blank">Runway</a> for <a href="http://wordpress.org" target="_blank">WordPress</a>\');</script>';
}
add_action('admin_footer', 'built_with_runway');


?>