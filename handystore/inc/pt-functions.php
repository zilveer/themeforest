<?php
/*------- Handy Theme Functions ----------*/

/* Contents:
	- Custom excerpt "more" text
	- Custom media fields (for filters)
	- Meta output functions
	- Views counter function
  - Adding new social links to user profile
	- Custom comments walker
	- Custom comment form
	- Maintenance Mode function
	- Add favicon function
	- Scroll to top button
	- Extra Shema Mark-up
	- Main Site wrapper functions
	- Header functions
    - custom header background
    - page title function
  - Page Content functions
    - adaptive class function
    - single post adaptive class
  - Footer functions
    - custom footer background
    - footer shortcode section
 */


// ----- Custom excerpt "more" text
if ( ! function_exists( 'pt_excerpt_more' ) ) {
	function pt_excerpt_more() {
		if ( !handy_get_option('blog_read_more_text')=='') {
			return handy_get_option('blog_read_more_text');
		} else { return __('Read More', 'plumtree'); }
	}
}
add_filter('pt_more', 'pt_excerpt_more');


// ----- Plumtree custom media fields function
if ( ! function_exists( 'pt_custom_media_fields' ) ) {
	function pt_custom_media_fields( $form_fields, $post ) {

		$form_fields['portfolio_filter'] = array(
			'label' => 'Portfolio Filters',
			'input' => 'text',
			'value' => get_post_meta( $post->ID, 'portfolio_filter', true ),
			'helps' => __('Used only for Portfolio and Gallery Pages Isotope filtering', 'plumtree'),
		);

		return $form_fields;
	}
}
add_filter( 'attachment_fields_to_edit', 'pt_custom_media_fields', 10, 2 );

if ( ! function_exists( 'pt_custom_media_fields_save' ) ) {
	function pt_custom_media_fields_save( $post, $attachment ) {

		if( isset( $attachment['portfolio_filter'] ) )
			update_post_meta( $post['ID'], 'portfolio_filter', $attachment['portfolio_filter'] );

		if( isset( $attachment['hover_style'] ) )
			update_post_meta( $post['ID'], 'hover_style', $attachment['hover_style'] );

		return $post;
	}
}
add_filter( 'attachment_fields_to_save', 'pt_custom_media_fields_save', 10, 2 );


// ----- Plumtree Meta output functions
if ( ! function_exists( 'pt_entry_publication_time' ) ) {
	function pt_entry_publication_time() {
	    $date = sprintf( '<time class="entry-date" datetime="%1$s" itemprop="datePublished">%2$s&nbsp;%3$s,&nbsp;%4$s</time>',
	      esc_attr( get_the_date('c') ),
	      esc_html( get_the_date('M') ),
	      esc_html( get_the_date('j') ),
	      esc_html( get_the_date('Y') )
	    );
	    echo '<div class="time-wrapper">'.__('Posted ', 'plumtree').$date.'</div>';
			$last_modified_time = get_the_modified_date();
			if ($last_modified_time && $last_modified_time!='') {
					echo '<meta itemprop="dateModified" content="'. esc_attr($last_modified_time) .'">';
			}
	}
}

if ( ! function_exists( 'pt_entry_comments_counter' ) ) {
	function pt_entry_comments_counter() {
	    echo '<div class="post-comments" itemprop="interactionCount"><i class="fa fa-comments"></i>(';
	    comments_popup_link( '0', '1', '%', 'comments-link', __('Commenting: OFF', 'plumtree'));
	    echo ')</div>';
	}
}

if ( ! function_exists( 'pt_entry_post_cats' ) ) {
	function pt_entry_post_cats() {
	    $categories_list = get_the_category_list( __( ', ', 'plumtree' ) );
	    if ( $categories_list ) { echo '<div class="post-cats" itemprop="articleSection">'.__('In ', 'plumtree').$categories_list.'</div>'; }
	}
}

if ( ! function_exists( 'pt_entry_post_tags' ) ) {
	function pt_entry_post_tags() {
	    $tag_list = get_the_tag_list( '', __( ', ', 'plumtree' ) );
	    if ( $tag_list ) { echo '<div class="post-tags">'.__('Tagged with ', 'plumtree').$tag_list.'</div>'; }
	}
}

if ( ! function_exists( 'pt_entry_author' ) ) {
	function pt_entry_author() {
	    printf( '<div class="post-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">'.__('By ', 'plumtree').'<a href="%1$s" title="%2$s" rel="author" itemprop="url"><span itemprop="name">%3$s</span></a></div>',
	      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	      esc_attr( sprintf( __( 'View all posts by %s', 'plumtree' ), get_the_author() ) ),
	      get_the_author()
	    );
			echo '<div itemprop="publisher" itemscope="itemscope" itemtype="https://schema.org/Organization">
    				<meta itemprop="name" content="'.get_bloginfo('name').'">
						<meta itemprop="url" content="'.home_url().'">
						<div itemprop="logo" itemscope="itemscope" itemtype="http://schema.org/ImageObject"><meta itemprop="url" content="'.handy_get_option('site_logo').'"></div>
    				</div>';
	}
}

if ( ! function_exists( 'pt_entry_post_views' ) ) {
	function pt_entry_post_views() {
	    global $post;
	    $views = get_post_meta ($post->ID,'views',true);
	    if ($views) {
	        echo '<div class="post-views"><span>'.__('Views: ', 'plumtree').'</span><i class="fa fa-eye"></i>('.$views.')</div>';
	    } else { echo '<div class="post-views"><span>'.__('Views: ', 'plumtree').'</span><i class="fa fa-eye"></i>(0)</div>'; }
	}
}

// ----- Plumtree Views counter function
if ( ! function_exists( 'pt_postviews' ) ) {
    function pt_postviews() {

    /* ------------ Settings -------------- */
    $meta_key       = 'views';  	// The meta key field, which will record the number of views.
    $who_count      = 0;            // Whose visit to count? 0 - All of them. 1 - Only the guests. 2 - Only registred users.
    $exclude_bots   = 1;            // Exclude bots, robots, spiders, and other mischief? 0 - no. 1 - yes.

    global $user_ID, $post;
        if(is_singular()) {
            $id = (int)$post->ID;
            static $post_views = false;
            if($post_views) return true;
            $post_views = (int)get_post_meta($id,$meta_key, true);
            $should_count = false;
            switch( (int)$who_count ) {
                case 0: $should_count = true;
                    break;
                case 1:
                    if( (int)$user_ID == 0 )
                        $should_count = true;
                    break;
                case 2:
                    if( (int)$user_ID > 0 )
                        $should_count = true;
                    break;
            }
            if( (int)$exclude_bots==1 && $should_count ){
                $useragent = $_SERVER['HTTP_USER_AGENT'];
                $notbot = "Mozilla|Opera"; //Chrome|Safari|Firefox|Netscape - all equals Mozilla
                $bot = "Bot/|robot|Slurp/|yahoo";
                if ( !preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent) )
                    $should_count = false;
            }
            if($should_count)
                if( !update_post_meta($id, $meta_key, ($post_views+1)) ) add_post_meta($id, $meta_key, 1, true);
        }
        return true;
    }
}
add_action('wp_head', 'pt_postviews');


// ----- Adding new social links to user profile
if ( ! function_exists( 'pt_new_author_contacts' ) ) {
	function pt_new_author_contacts( $contactmethods ) {
	  // Add Twitter
	  if ( !isset( $contactmethods['twitter'] ) )
	    $contactmethods['twitter'] = 'Twitter';

	  // Add Google Plus
	  if ( !isset( $contactmethods['googleplus'] ) )
	    $contactmethods['googleplus'] = 'Google Plus';

	  // Add Facebook
	  if ( !isset( $contactmethods['facebook'] ) )
	    $contactmethods['facebook'] = 'Facebook';

	  return $contactmethods;
	}
}
add_filter( 'user_contactmethods', 'pt_new_author_contacts', 10, 1 );

if ( ! function_exists( 'pt_output_author_contacts' ) ) {
	function pt_output_author_contacts() {
	    global $post;
	    $twitter = get_the_author_meta( 'twitter', $post->post_author );
	    $facebook = get_the_author_meta( 'facebook', $post->post_author );
	    $googleplus = get_the_author_meta( 'googleplus', $post->post_author );

	    if (isset($facebook) || isset($twitter) || isset($googleplus)) { ?>
	       <div class="author-contacts">
	    <?php }

	    if (isset($twitter)) echo '<a href="'.esc_url($twitter).'" rel="author" target="_blank"><i class="fa fa-twitter-square"></i></a>';
	    if (isset($facebook)) echo '<a href="'.esc_url($facebook).'" rel="author" target="_blank"><i class="fa fa-facebook-square"></i></a>';
	    if (isset($googleplus)) echo '<a href="'.esc_url($googleplus).'" rel="author" target="_blank"><i class="fa fa-google-plus-square"></i></a>';

	    if (isset($facebook) || isset($twitter) || isset($googleplus)) { ?>
	       </div>
	    <?php }
	}
}


// ----- Custom comments walker
if ( ! class_exists('pt_comments_walker')) {
	class pt_comments_walker extends Walker_Comment {
	    var $tree_type = 'comment';
	    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

	    // wrapper for child comments list
	    function start_lvl( &$output, $depth = 0, $args = array() ) {
	        $GLOBALS['comment_depth'] = $depth + 1; ?>
	        <div class="child-comments comments-list">
	    <?php }

	    // closing wrapper for child comments list
	    function end_lvl( &$output, $depth = 0, $args = array() ) {
	        $GLOBALS['comment_depth'] = $depth + 1; ?>
				</div>
	    <?php }

	    // HTML for comment template
	    function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
	        $depth++;
	        $GLOBALS['comment_depth'] = $depth;
	        $GLOBALS['comment'] = $comment;
	        $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );
	        if ( 'article' == $args['style'] ) {
	            $add_below = 'comment';
	        } else {
	            $add_below = 'comment';
	        } ?>

	    <article <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope="itemscope" itemtype="http://schema.org/UserComments">
	        <figure class="gravatar"><?php echo get_avatar( $comment, 70 ); ?></figure>

	        <div class="comment-meta" role="complementary">
	            <h2 class="comment-author" itemprop="creator" itemscope="itemscope" itemtype="http://schema.org/Person">
	                <?php _e('Posted by ', 'plumtree'); ?>
	                <?php if (get_comment_author_url() != '') { ?>
	                    <a class="comment-author-link" href="<?php esc_url(comment_author_url()); ?>" itemprop="url"><span itemprop="name"><?php comment_author(); ?></span></a>
	                <?php } else { ?>
	                    <span class="author" itemprop="name"><?php comment_author(); ?></span>
	                <?php } ?>
	            </h2>
	            <?php _e(' on ', 'plumtree'); ?>
	            <time class="comment-meta-time" datetime="<?php comment_date() ?>T<?php comment_time() ?>" itemprop="commentTime"><?php comment_date() ?><?php _e(', at ', 'plumtree');?><a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time>
	            <?php edit_comment_link(esc_html__('Edit', 'plumtree'),'',''); ?>
	            <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	        </div>

	        <?php if ($comment->comment_approved == '0') : ?>
	            <p class="comment-meta-item"><?php _e("Your comment is awaiting moderation.", "plumtree") ?></php></p>
	        <?php endif; ?>

	        <div class="comment-content post-content" itemprop="commentText">
	            <?php comment_text() ?>
	        </div>

	    <?php }
	    // end_el – closing HTML for comment template
	    function end_el( &$output, $comment, $depth = 0, $args = array() ) { ?>
	        </article>
	    <?php }
	}
}


// ----- Custom comment form
if ( ! function_exists( 'pt_comment_form' ) ) {
	function pt_comment_form() {

	    $commenter = wp_get_current_commenter();
	    $req = get_option( 'require_name_email' );
	    $aria_req = ( $req ? " aria-required='true'" : '' );
	    $user = wp_get_current_user();
	    $user_identity = $user->exists() ? $user->display_name : '';

	    $custom_args = array(
	        'id_form'           => 'commentform',
	        'id_submit'         => 'submit',
	        'title_reply'       => __( 'Leave Your Comment', 'plumtree' ),
	        'title_reply_to'    => __( 'Leave Your Comment to %s', 'plumtree' ),
	        'cancel_reply_link' => __( 'Cancel Reply', 'plumtree' ),
	        'label_submit'      => __( 'Submit Comment', 'plumtree' ),

	        'comment_field' =>  '<p class="comment-form-comment">
	                             <label for="comment">'.__( 'Comment', 'plumtree' ).'</label>
	                             <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" aria-describedby="form-allowed-tags" placeholder="'.__('Comment:', 'plumtree').'"></textarea>
	                             </p>',

	        'must_log_in' => '<p class="must-log-in">'.
	                          sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'plumtree' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ).
	                         '</p>',

	        'logged_in_as' => '<p class="logged-in-as">'.
	                           sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'plumtree' ),
	                            admin_url( 'profile.php' ),
	                            $user_identity,
	                            wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ).
	                          '</p>',

	        'comment_notes_before' => false,

	        'comment_notes_after' => false,

	        'fields' => apply_filters( 'comment_form_default_fields', array(
	            'author' =>
	                        '<p class="comment-form-author">
	                        <label for="author">'. __( 'Name', 'plumtree' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label>
	                        <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" aria-required="true" placeholder="' . ( $req ? __( 'Name (required):', 'plumtree' ) : __( 'Name:', 'plumtree' ) ) . '" />
	                        </p>',

	            'email' =>
	                        '<p class="comment-form-email">
	                        <label for="email">'. __( 'E-mail', 'plumtree' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label>
	                        <input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" aria-required="true" aria-describedby="email-notes" placeholder="' . ( $req ? __( 'E-mail (will not be published, required):', 'plumtree' ) : __( 'E-mail (will not be published):', 'plumtree' ) ) . '" />
	                        </p>',

	            'url' =>
	                        '<p class="comment-form-url">
	                        <label for="url">'. __( 'Website', 'plumtree' ) . '</label>
	                        <input id="url" name="url" type="text" value="' . esc_url( $commenter['comment_author_url'] ) . '" placeholder="' . __( 'Website:', 'plumtree' ) . '" />
	                        </p>',
	        )),
	    );
	    comment_form( $custom_args );
	}
}


// ----- Maintenance Mode function
$maintenance_mode = (handy_get_option('site_maintenance_mode') != '') ? handy_get_option('site_maintenance_mode') : 'off';
if ( $maintenance_mode=='on' || ( isset($_GET['MAINTENANCE'] ) && $_GET['MAINTENANCE'] == 'true' ) ) {
	define('PT_IN_MAINTENANCE', true);
} else {
	define('PT_IN_MAINTENANCE', false);
}

if ( ! function_exists( 'pt_maintenance' ) ) {
	function pt_maintenance(){
	    global $pagenow;
	    if(
	       defined('PT_IN_MAINTENANCE')
	       && PT_IN_MAINTENANCE
	       && $pagenow !== 'wp-login.php'
	       && ! is_user_logged_in() ) {
	       		$protocol = "HTTP/1.0";
				if ( "HTTP/1.1" == $_SERVER["SERVER_PROTOCOL"] ) {
					$protocol = "HTTP/1.1";
				}
			    header( "$protocol 503 Service Unavailable", true, 503 );
			    header( "Retry-After: 3600" );
			    header( "Content-Type: text/html; charset=utf-8" );

		    	require_once('pt-maintenance.php');
		    	die();
	    }
	    return false;
	}
}
add_action('wp_loaded', 'pt_maintenance');


// ----- Add favicon function
if (handy_get_option('site_favicon') && handy_get_option('site_favicon')!='') {
	if ( ! function_exists( 'pt_favicon' ) ) {
		function pt_favicon() { ?>
			<link rel="shortcut icon" href="<?php echo esc_url( handy_get_option('site_favicon') );?>" >
		<?php }
	}
	add_action('wp_head', 'pt_favicon');
}


// ----- Scroll to top button
if (handy_get_option('totop_button') == 'on') {
	if ( ! function_exists( 'pt_add_totop_button' ) ) {
		function pt_add_totop_button() {
			echo '<a href="#0" class="to-top" title="'.__('Back To Top', 'plumtree').'"><i class="fa fa-chevron-up"></i></a>';
		}
	}
	add_action('wp_footer', 'pt_add_totop_button');
}


// ----- Extra Shema mark-up
// Adding itemprop to all nav menus
if (!function_exists('pt_add_itemprop')) {
	function pt_add_itemprop( $atts, $item, $args ) {
	    $atts['itemprop'] = 'url';
	    return $atts;
	}
	add_filter('nav_menu_link_attributes', 'pt_add_itemprop', 10, 3);
}


// ----- Main Site wrapper functions
if (!function_exists('pt_site_wrapper_start')) {
	function pt_site_wrapper_start() {
		if (handy_get_option('site_layout')=='boxed') { ?>
			<div class="site-wrapper container">
				<div class="row">
		<?php } else { ?>
			<div class="site-wrapper">
		<?php }
	}
}

if (!function_exists('pt_site_wrapper_end')) {
	function pt_site_wrapper_end() {
		if (handy_get_option('site_layout')=='boxed') { ?>
			</div></div>
		<?php } else { ?>
			</div>
		<?php }
	}
}


// ----- Header functions
// Header background
if (!function_exists('pt_custom_header_bg')) {
	function pt_custom_header_bg() {
		$background = handy_get_option('header_bg');
		if ( $background ) {
			if ( $background['image'] ) {
				echo ' style="background-image:url('. esc_url($background['image']) .');
										  background-repeat:'. esc_attr($background['repeat']) .';
										  background-position:'. esc_attr($background['position']) .';
										  background-attachment:'. esc_attr($background['attachment']) .';
											background-color:'. esc_attr($background['color']) .'"';
			} else {
				echo ' style="background-color:'. esc_attr($background['color']) .';"';
			}
		} else {
			return false;
		};
	}
}

// Page title function
if (!function_exists('pt_output_page_title')) {
	function pt_output_page_title() { ?>
		<div class="page-title">
			<?php
			// Archives
			if (is_archive() && ( class_exists('Woocommerce') && !is_woocommerce() ) ) {
				esc_attr( the_archive_title() );
			} else if ( is_archive() ) {
				esc_attr( the_archive_title() );
			}
			// 404
			elseif ( is_404() ) {
				_e( 'Page 404', 'plumtree' );
			}
			// Search
			elseif ( is_search() ) {
				printf( __( 'Search Results for: %s', 'plumtree' ), get_search_query() );
			}
			// Blog
			elseif ( is_home() ) {
				_e( 'Blog', 'plumtree' );
			}
			elseif ( is_home() && get_option( 'page_for_posts' ) ) {
				echo esc_attr( get_the_title( get_option( 'page_for_posts' ) ) );
			}
			else {
				echo esc_attr( get_the_title() );
			}
			?>
		</div>
	<?php }
}


// ----- Page Content functions
// Adaptive class for main content
if (!function_exists('pt_main_content_class')) {
	function pt_main_content_class() {
		if ( pt_show_layout()=='layout-one-col' ) { $content_class = ' col-xs-12 col-md-12 col-sm-12'; }
		elseif ( pt_show_layout()=='layout-two-col-left' ) { $content_class = ' col-xs-12 col-md-9 col-sm-8 col-md-push-3 col-sm-push-4'; }
		else { $content_class = ' col-xs-12 col-md-9 col-sm-8'; }

		/* Live preview */
		if( isset( $_GET['b_type'] ) ){
			$blog_type = $_GET['b_type'];
			if ( $blog_type=='3cols' || $blog_type=='4cols' || $blog_type=='filters' ) {
				$content_class = ' col-xs-12 col-md-12 col-sm-12';
			}
		}
		if( isset( $_GET['shop_w_sidebar'] ) ){
			$content_class = ' col-xs-12 col-md-9 col-sm-8 col-md-push-3 col-sm-push-4';
		}

		/* Advanced Blog layout */
		if ( handy_get_option('blog_frontend_layout')=='grid' || handy_get_option('blog_frontend_layout')=='isotope' ) {
			$content_class .= ' grid-layout '.handy_get_option('blog_grid_columns');
		}

		/* Infinite blog extra class */
		if ( handy_get_option('blog_pagination')=='infinite' && is_home() ) {
			$content_class .= ' infinite-blog';
		}

		echo esc_attr($content_class);
	}
}

// Single post class
if (!function_exists('pt_single_content_class')) {
	function pt_single_content_class() {
		$extra_class = '';
		if ( (handy_get_option('blog_frontend_layout')=='grid' ||
			  handy_get_option('blog_frontend_layout')=='isotope') &&
			  !is_single() &&
			  !is_search() ) {
			$blog_cols = handy_get_option('blog_grid_columns');
			switch ($blog_cols) {
				case 'cols-2':
					$extra_class = 'col-md-6 col-sm-12 col-xs-12';
				break;
				case 'cols-3':
					$extra_class = 'col-md-4 col-sm-6 col-xs-12';
				break;
				case 'cols-4':
					$extra_class = 'col-lg-3 col-md-4 col-sm-6 col-xs-12';
				break;
			}
		}
		/* Live preview */
		if( isset( $_GET['b_type'] ) ){
			$blog_type = $_GET['b_type'];
			switch ($blog_type) {
				case '2cols':
					$extra_class = 'col-md-6 col-sm-12 col-xs-12';
				break;
				case '3cols':
					$extra_class = 'col-md-4 col-sm-6 col-xs-12';
				break;
				case 'filters':
					$extra_class = 'col-md-4 col-sm-6 col-xs-12';
				break;
				case '4cols':
					$extra_class = 'col-lg-3 col-md-4 col-sm-6 col-xs-12';
				break;
			}
		}
		return esc_attr($extra_class);
	}
}


// ----- Footer functions
// Footer custom background
if (!function_exists('handy_custom_footer_bg')) {
	function handy_custom_footer_bg() {
		$background = handy_get_option('footer_bg');
		if ( $background ) {
			if ( $background['image'] ) {
				echo ' style="background-image:url('. esc_url($background['image']) .');
										  background-repeat:'. esc_attr($background['repeat']) .';
										  background-position:'. esc_attr($background['position']) .';
										  background-attachment:'. esc_attr($background['attachment']) .';
											background-color:'. esc_attr($background['color']) .'"';
			} else {
				echo ' style="background-color:'. esc_attr($background['color']) .';"';
			}
		} else {
			return false;
		};
	}
}

// Footer shortcode section
if (!function_exists('pt_shortcode_section')) {
	function pt_shortcode_section() {
		// Variables
		$shortcode = handy_get_option('footer_shortcode_section_shortcode');
		function handy_footer_shortcode_section_bg() {
			$background = handy_get_option('footer_shortcode_section_bg');
			if ( $background ) {
				if ( $background['image'] ) {
					echo ' style="background-image:url('. esc_url($background['image']) .');
												background-repeat:'. esc_attr($background['repeat']) .';
												background-position:'. esc_attr($background['position']) .';
												background-attachment:'. esc_attr($background['attachment']) .';
												background-color:'. esc_attr($background['color']) .'"';
				} else {
					echo ' style="background-color:'. esc_attr($background['color']) .';"';
				}
			} else {
				return false;
			};
		} ?>

		<div class="footer-shortcode"<?php handy_footer_shortcode_section_bg();?>>
			<div class="container">
				<?php echo do_shortcode( $shortcode ) ?>
			</div>
		</div>

	<?php }
}

/* Special sidebar on Theme Options */
add_action('optionsframework_after','optionscheck_display_sidebar', 100);

function optionscheck_display_sidebar() { ?>
	<div id="options-sidebar-holder" class="metabox-holder">
	  <div id="options-sidebar">
	    <h3><i class="custom-icon-help"></i><?php esc_html_e('Need Help?', 'plumtree'); ?></h3>
	    <div class="section">
				<p><?php echo wp_kses( __('Please, create ticket at <a href="https://themeszone.freshdesk.com" target="_blank">https://themeszone.freshdesk.com</a> to get help with the theme.', 'plumtree'), $allowed_html=array('a' => array( 'href'=>array(),'target'=>array() )) ); ?></p>
				<p><?php esc_html_e("Our support team will be glad to answer your questions regarding theme usage. We also provide paid customization and paid theme installation services. Please contact support on this matter!", "plumtree"); ?></p>
				<p><?php esc_html_e("Please, be sure to read the online version of this theme's documentation, it contains answers to many questions people usually ask.", "plumtree" ); ?></p>
			</div>
			<div class="support-links">
				<a href="http://handystorehelp.themes.zone/" target="_blank" title="<?php esc_html_e('Read Theme Documentation', 'plumtree'); ?>"><i class="custom-icon-docs"></i><?php esc_html_e('Theme Documentation', 'plumtree'); ?></a>
				<span>&nbsp;|&nbsp;</span>
				<a href="https://themeszone.freshdesk.com" target="_blank" title="<?php esc_html_e('Create Support Ticket', 'plumtree'); ?>"><i class="custom-icon-support"></i><?php esc_html_e('Support', 'plumtree'); ?></a>
			</div>
	  </div>
	</div>
<?php }

/* Add custom image sizes attribute to enhance responsive image functionality */
function handy_content_image_sizes_attr($sizes, $size) {
     $width = $size[0];
     //Page without sidebar
     if (pt_show_layout()=='layout-one-col') {
         if ($width > 938) {
             return '(max-width: 768px) 92vw, (max-width: 992px) 718px, (max-width: 1200px) 938px, 1138px';
         } elseif ($width < 938 && $width > 718) {
             return '(max-width: 768px) 92vw, (max-width: 992px) 718px, 938px';
         } else {
	         	 return '(max-width: ' . $width . 'px) 92vw, ' . $width . 'px';
				 }
     } else {
		 //Page with sidebar
				 if ($width > 846) {
						 return '(max-width: 768px) 92vw, (max-width: 992px) 468px, (max-width: 1200px) 696px, 846px';
				 }
				 if ($width < 846 && $width > 696) {
						 return '(max-width: 768px) 92vw, (max-width: 992px) 468px, 696px';
				 }
				 return '(max-width: ' . $width . 'px) 92vw, ' . $width . 'px';
		 }
}
add_filter('wp_calculate_image_sizes', 'handy_content_image_sizes_attr', 10 , 2);

/* Add custom image sizes attribute to enhance responsive image functionality for post thumbnails */
function handy_post_thumbnail_sizes_attr($attr, $attachment, $size) {
		 switch ($size) {
			 case 'post-thumbnail':
			 		if (pt_show_layout()=='layout-one-col') {
			 				$attr['sizes'] = '(max-width: 768px) 92vw, (max-width: 992px) 718px, (max-width: 1200px) 938px, 1138px';
					} else {
							$attr['sizes'] = '(max-width: 768px) 92vw, (max-width: 992px) 468px, (max-width: 1200px) 696px, 846px';
					}
			 break;
			 case 'shop_single':
					if (pt_show_layout()=='layout-one-col') {
						 $attr['sizes'] = '(max-width: 768px) 92vw, (max-width: 992px) 345px, (max-width: 1200px) 455px, 555px';
				  } else {
						 $attr['sizes'] = '(max-width: 768px) 92vw, (max-width: 992px) 400px, (max-width: 1200px) 334px, 409px';
					}
			 break;
			 case 'full':
					$attr['sizes'] = '(max-width: 768px) 92vw, (max-width: 992px) 970px, (max-width: 1200px) 1170px, 1200px';
			 break;
		 };
     return $attr;
 }
add_filter('wp_get_attachment_image_attributes', 'handy_post_thumbnail_sizes_attr', 10 , 3);

if ( class_exists( 'WPBakeryShortCode' ) ) {
	/* Add new style to visual composer elements */
	add_action( 'vc_after_init', 'add_vc_tabs_handy_style' ); /* Note: here we are using vc_after_init because WPBMap::GetParam and mutateParame are available only when default content elements are "mapped" into the system */
	function add_vc_tabs_handy_style() {
	  //Get current values stored in the color param in "Call to Action" element
	  $param = WPBMap::getParam( 'vc_tta_tabs', 'style' );
	  //Append new value to the 'value' array
	  $param['value'][__( 'Handy Style', 'plumtree' )] = 'handy-style';
	  //Finally "mutate" param with new values
	  vc_update_shortcode_param( 'vc_tta_tabs', $param );
		//Get current values stored in the color param in "Call to Action" element
		$param = WPBMap::getParam( 'vc_tta_accordion', 'style' );
		//Append new value to the 'value' array
		$param['value'][__( 'Handy Style', 'plumtree' )] = 'handy-style';
		//Finally "mutate" param with new values
		vc_update_shortcode_param( 'vc_tta_accordion', $param );
	}

	/* New Param for positioning */
	vc_add_shortcode_param( 'position', 'handy_position_settings_field' );
	function handy_position_settings_field( $settings, $value ) {
		return '<div class="position_block">'
		        .'<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-numberinput ' .
		        esc_attr( $settings['param_name'] ) . ' ' .
		        esc_attr( $settings['type'] ) . '_field" type="number" value="' . esc_attr( $value ) . '" />' .
		        '</div>'; // This is html markup that will be outputted in content elements edit form
	}
}
