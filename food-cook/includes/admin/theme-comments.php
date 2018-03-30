<?php
// Fist full of comments
if (!function_exists("custom_comment")) {
	function custom_comment( $comment, $args, $depth ) {
	   $GLOBALS['comment'] = $comment; ?>
	                 
		<li <?php comment_class(); ?>>
	    
	    	<a name="comment-<?php comment_ID() ?>"></a>
	      	
	      	<div id="li-comment-<?php comment_ID() ?>" class="comment-container">
	      	
				<?php if( get_comment_type() == 'comment' ) { ?>
	                <div class="avatar"><?php the_commenter_avatar( $args ); ?></div>
	            <?php } ?>            
	
		      	<div class="comment-head">
		      	            
	                <span class="name"><?php comment_author_link(); ?></span>           
	                <span class="date"><?php echo get_comment_date(get_option( 'date_format' )) ?> <?php _e('at', 'woothemes'); ?> <?php echo get_comment_time(get_option( 'time_format' )); ?></span>
	                <span class="perma"><a href="<?php echo get_comment_link(); ?>" title="<?php _e('Direct link to this comment', 'woothemes'); ?>">#</a></span>
	                <span class="edit"><?php edit_comment_link(__('Edit', 'woothemes'), '', ''); ?></span>
		        		          	
				</div><!-- /.comment-head -->
		      
		   		<div class="comment-entry"  id="comment-<?php comment_ID(); ?>">
				
				<?php comment_text() ?>
		            
				<?php if ($comment->comment_approved == '0') { ?>
	                <p class='unapproved'><?php _e('Your comment is awaiting moderation.', 'woothemes'); ?></p>
	            <?php } ?>
						
	                <div class="reply">
	                    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	                </div><!-- /.reply -->                       
			
				</div><!-- /comment-entry -->
	
			</div><!-- /.comment-container -->
			
	<?php 
	}
}

// PINGBACK / TRACKBACK OUTPUT
if ( ! function_exists( 'list_pings' ) ) {
	function list_pings( $comment, $args, $depth ) {
	
		$GLOBALS['comment'] = $comment;
?>	
		<li id="comment-<?php comment_ID(); ?>">
			<span class="author"><?php comment_author_link(); ?></span> - 
			<span class="date"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></span>
			<span class="pingcontent"><?php comment_text(); ?></span>
<?php 
	} 
}

if ( ! function_exists( 'the_commenter_avatar' ) ) {
	function the_commenter_avatar( $args ) {
		global $comment;
	    $avatar = get_avatar( $comment,  $args['avatar_size'] );
	    echo $avatar;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Modify the default "comment" form field. */
/*-----------------------------------------------------------------------------------*/
/**
 * Modify the default "comment" form field.
 *
 * @package WooFramework
 * @subpackage Filters
 */
 
  add_filter( 'comment_form_field_comment', 'woo_comment_form_comment', 10 );
 
if ( ! function_exists( 'woo_comment_form_comment' ) ) { 
function woo_comment_form_comment ( $field ) {
	$field = str_replace( '<label ', '<label class="hide" ', $field );
	$field = str_replace( 'cols="45"', 'cols="50"', $field );
	$field = str_replace( 'rows="8"', 'rows="10"', $field );

	return $field;
} // End woo_comment_form_comment()
}

/*-----------------------------------------------------------------------------------*/
/* Add theme default comment form fields. */
/*-----------------------------------------------------------------------------------*/ 
/**
 * Add theme default comment form fields.
 *
 * @package WooFramework
 * @subpackage Filters
 */
 
add_filter( 'comment_form_default_fields', 'woo_comment_form_fields', 10 );
 
if ( ! function_exists( 'woo_comment_form_fields' ) ) { 
function woo_comment_form_fields ( $fields ) {
	$commenter = wp_get_current_commenter();

$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$fields =  array(
	'author' => '<p class="comment-form-author"><input placeholder="Name" id="author" name="author" type="text" class="txt" tabindex="1" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
				'<label for="author">' . __( 'Name', 'woothemes' ) . ( $req ? ' <span class="required">(' . __( 'required', 'woothemes' ) . ')</span>' : '' ) . '</label> ' . '</p>',
	'email'  => '<p class="comment-form-email"><input placeholder="Email" id="email" name="email" type="text" class="txt" tabindex="2" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . 
				'<label for="email">' . __( 'Email (will not be published)', 'woothemes' ) . ( $req ? ' <span class="required">(' . __( 'required', 'woothemes' ) . ')</span>' : '' ) . '</label> ' . '</p>',
	'url'    => '<p class="comment-form-url"><input placeholder="Website" id="url" name="url" type="text" class="txt" tabindex="3" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />' .
	            '<label for="url">' . __( 'Website', 'woothemes' ) . '</label></p>',
);

	return $fields;
} // End woo_comment_form_fields()
}

/*-----------------------------------------------------------------------------------*/
/* Add theme default comment form arguments. */
/*-----------------------------------------------------------------------------------*/ 
/**
 * Add theme default comment form arguments.
 *
 * @package WooFramework
 * @subpackage Filters
 */
 
 add_filter( 'comment_form_defaults', 'woo_comment_form_args', 10 );
 
if ( ! function_exists( 'woo_comment_form_args' ) ) { 
	function woo_comment_form_args ( $args ) {
		// Add tabindex of "field count + 1" to the comment textarea. This lets us cater for additional fields and have a dynamic tab index.
		$tabindex = count( $args['fields'] ) + 1;
		$args['comment_field'] = str_replace( '<textarea ', '<textarea tabindex="' . $tabindex . '" ', $args['comment_field'] );

		// Adjust tabindex for "submit" button.
		$tabindex++;

		$args['label_submit'] = __( 'Submit', 'woothemes' );
		$args['comment_notes_before'] = '';
		$args['comment_notes_after'] = '';
		$args['cancel_reply_link'] = __( 'Click here to cancel reply.', 'woothemes' );

		return $args;
	} // End woo_comment_form_args()
}