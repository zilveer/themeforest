<?php
class mom_gregsThreadedCommentNumbering {

	var $plugin_prefix;        // prefix for options
	var $plugin_version;       // what's our version number?
	var $our_name;             // who are we?
	var $consolidate;          // whether we'll be consolidating our options into single array, or keeping discrete
	// These are global vars for keeping an efficient running tally
	var $currentnumber = array();
	var $currentnumber_simple;
	var $parenttrap = array();

	function __construct($plugin_prefix='',$plugin_version='',$our_name='',$option_style='') {
		$this->plugin_prefix = $plugin_prefix;
		$this->plugin_version = $plugin_version;
		$this->our_name = $our_name;
		if (!empty($option_style)) $this->consolidate = ('consolidate' == $option_style) ? true : false;
		else $this->consolidate = true;
		return;
	} // end constructor

	// grab a setting
	function opt($name) {
		$prefix = rtrim($this->plugin_prefix, '_');
		// try getting consolidated settings
		if ($this->consolidate) $settings = get_option($prefix . '_settings');
		// is_array test will fail if settings not consolidated, isset will fail for private option not in array
		if (is_array($settings)) $value = (isset($settings[$name])) ? $settings[$name] : get_option($prefix . '_' . $name);
		// get discrete-style settings instead
		else $value = get_option($prefix . '_' . $name);
		return $value;
	} // end option retriever
	
	// grab a setting and tidy it up
	function opt_clean($name) {
		return stripslashes(wp_specialchars_decode($this->opt($name),ENT_QUOTES));
	} // end clean option retriever

	### Function: Greg's Threaded Comment Numbering Lookup
	function comment_counter_db_lookup ($comment_ID,$args = array(),$forcesimple=false) { // count comments older than current one
		global $wpdb;
		if ( !$comment = get_comment( $comment_ID ) ) // check also grabs $comment
			return;
		$allowedtypes = array(
						'comment' => '',
						'pingback' => 'pingback',
						'trackback' => 'trackback',
						);
	  
		$comtypewhere = ( 'all' != $args['type'] && isset($allowedtypes[$args['type']]) ) ? " AND comment_type = '" . $allowedtypes[$args['type']] . "'" : '';
		
		if (!(get_option('thread_comments')) || $forcesimple) { // if not displaying threaded comments, count all older comments
			$oldercoms = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved = 1 AND comment_post_ID = %d AND comment_date_gmt < '%s'" . $comtypewhere, $comment->comment_post_ID, $comment->comment_date_gmt ) );
		}
		else { // if displaying threaded comments, count only top level older comments
			$oldercoms = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved = 1 AND comment_post_ID = %d AND comment_parent = 0 AND comment_date_gmt < '%s'" . $comtypewhere, $comment->comment_post_ID, $comment->comment_date_gmt ) );	  
		} // end check for threading
		return $oldercoms + 1;
	} // end comment_counter_db_lookup

	### Function: Determine Comment Depth
	function get_depth($comment_ID = 0) { // recursive depth check
		global $wpdb;
		$comment = get_comment( $comment_ID );
		$parent = $comment->comment_parent;
		if ((0 == $parent) || ($this->parent_trashed($comment))) // must NOT use '===' because empty result, where we do not have a comment parent at all because it has been deleted, needs to evaluate as true
		return '1'; 
		else return $this->get_depth($parent) + 1;
	}

	### Function: Do parents actually exist?
	function parents_exist($comment_ID = 0) { // explicit check for comments with deleted parents
		if ($this->opt('do_parent_check')) {
			global $wpdb;
			$comment = get_comment( $comment_ID );
			$parent = $comment->comment_parent;
			if ($parent == '') return false;
			elseif ($this->parent_trashed($comment)) return false;
			elseif (0 == $parent) return true;
			else return $this->parents_exist($parent);
		}
		else return true;
	}

	### Function: Is parent in the trash?
	function parent_trashed($comment) { // check if comment's immediate parent is in trash
		global $wpdb;
		$parent = $comment->comment_parent;
		if ('' == $parent) return false; // no parent, no trash
		$approval = get_comment($parent); // have to do this in two steps for PHP4 compatibility
		$approval = $approval->comment_approved;
		if ($approval == 'trash') return true;
		else return false;
	}

	### Function: Build output
	function build_output($number = array(),$placeholder=1) { // recursively build the number to display
		if ($number[$placeholder + 1] == '')
		return $number[$placeholder];
		else return $number[$placeholder] . '.' . $this->build_output($number,$placeholder + 1);
	}

	### Function: Do simple count
	function do_simple_count($comment_ID, $args = array(), $before='', $after='' ) {
		global $wpdb;
		if (empty($this->currentnumber_simple)) { // have not started yet, so get number for first comment
			$this->currentnumber_simple = $this->comment_counter_db_lookup ($comment_ID,$args,true);
			echo $before . $this->currentnumber_simple . $after;
			return;
		} // end getting first number
		
		if ($args['reverse_top_level']) // bump up or down, depending on order
			$this->currentnumber_simple --;
		else
			$this->currentnumber_simple ++;
		echo $before . $this->currentnumber_simple . $after;
		return;
	}

	### Function: Do jumble count
	function do_jumble_count($comment_ID, $args = array(), $before='', $after='' ) {
		global $wpdb;
		$this->currentnumber = $this->comment_counter_db_lookup ($comment_ID,$args,true);
		echo $before . $this->currentnumber . $after;
		return;
	}

	### Function: Greg's Threaded Comment Numbering Core
	function comment_numbering( $comment_ID, $args = array(), $wrapclass = 'commentnumber', $mode = 'echo' ) {
		// this would all be so easy, were it not for threading and paging and reversing, which make counting go all funky
	
		global $wpdb;
	
		$prefix = $this->plugin_prefix;
	
		$comment = get_comment($comment_ID);
		
		if ( !( 1 == $comment->comment_approved )) // quick test for the case where a user has entered a comment which is in moderation, but that same user's subsequent comment is approved, in which case do not do anything with the number for the moderated comment
			return;
	
		$before = "<div class=\"$wrapclass\">";
	
		$after = '</div>';
		
			update_option("{$prefix}_deepest_display",'5');
		
		$nesting_replacement = (1 == $this->opt('nesting_replacement')) ? '&#8230;' : '';
		
		$orphan_replacement = (1 == $this->opt('orphan_replacement')) ? '[]' : '';
			
		if ( '' === $args['max_depth'] ) {
			if ( get_option('thread_comments') )
				$args['max_depth'] = get_option('thread_comments_depth');
			else
				$args['max_depth'] = -1;
		}
	
		if ( $args['max_depth'] <= 1 )  { // no threading
			$this->do_simple_count($comment_ID,$args,$before,$after);
			return;
		} // end of counting where there is no threading
	
		// Jumble count instead?
	
		if (($this->opt('jumble_count') == 1)) {
			$this->do_jumble_count($comment_ID,$args,$before,$after);
			return;
		} // end jumble count
	
		// Some quick traps
	
		$depth = $this->get_depth($comment_ID);
	
		if (($depth > $args['max_depth']) || ! $this->parents_exist($comment_ID) || $this->parent_trashed($comment)) { // trap for comment orphaned by too low a depth or by deleted or trashed parent
			echo $before . $orphan_replacement . $after;
			return;
		}
		if ($depth > $this->opt('deepest_display')) { // trap for no more nesting
			echo $before . $nesting_replacement . $after;
			return;
		}
			 
		// Begin the real stuff
	
		if ( 0 == $comment->comment_parent ) { // we are at top level so just grab a count for first on page and then bump it up or down for each successive comment
	
			if (empty($this->currentnumber)) { // have not started yet, so get number for first comment
			
				$this->currentnumber[$depth] = $this->comment_counter_db_lookup ($comment_ID,$args);
	
			} // end getting first number
			
			else { // we're not on first comment of page
	
				if ($args['reverse_top_level']) // bump up or down, depending on order
					$this->currentnumber[$depth]--;
				else
					$this->currentnumber[$depth]++;
				 
			} // finished updating counter for other than first comment
		
		} // end handling for top level
	
		else { // handle children
		
			if ( $args['max_depth'] > 1 && 0 != $comment->comment_parent )
				$myparent = $comment->comment_parent; // get parent
	
			if ( $myparent == $this->parenttrap[$depth - 1]) { // check whether current comment's parent matches saved parent at next higher level, in which case this is a reply to that previous comment: re-use and increment its count
				$this->currentnumber[$depth] ++;
			} // end case where we already have a count for the parent
				  
			else { // if we don't have a match that means we are in a reply to a reply, changing two depths one after the other
				$this->currentnumber[$depth] = 1; // set initial count
			} // end handling of reply to reply
	
		} // end handling of children
	
		// Finish up with things we need to do on each run-through
	
		$this->currentnumber[$depth + 1] = ''; // and start over for the next lower
		$this->parenttrap[$depth] = $comment_ID; // save this ID in case of use by further children
	
		$out = $before . $this->build_output($this->currentnumber) . $after;
		// support quiet return of the output
		if ('quiet' == $mode) return $out;
		else echo $out;
		return;
		
	} // end comment_numbering

} // end class definition

if ( ! function_exists( 'mom_comment' ) ) :
function mom_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class('single-comment base-box'); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'theme' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'theme' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>

	<li <?php comment_class('single-comment'); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrap base-box">
		<?php if (mom_option('post_cn') == 1) { echo momcn_comment_numbering($comment->comment_ID, $args); }  ?>
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'theme' ); ?></em>
			<?php endif; ?>
				<?php
					echo get_avatar( $comment, 60 );
				?>
		<div class="comment-content">
			 <?php
                            printf( '<h4 class="comment-author fn">%1$s %2$s</h4>',
                                    get_comment_author_link(),
                                    // If current post author is also comment author, make it known visually.
                                    ( $comment->user_id === $post->post_author ) ? '' : ''
                            );

                        ?>
			<?php
					printf( '<span class="comment-meta commentmetadata "><a href="%1$s"><time datetime="%2$s">%3$s</time></a></span>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'theme' ), get_comment_date(), get_comment_time() )
					);

                        ?>

                        <div class="comment-text"><?php comment_text(); ?></div>
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'theme' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			<?php edit_comment_link( __( 'Edit', 'theme' )); ?>
			</div>

		</div><!-- #comment-## -->
		
                        
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
$momcn = new mom_gregsThreadedCommentNumbering('momcn', '1.5.2', "Greg's Threaded Comment Numbering");
function momcn_comment_numbering($comment_ID, $args, $wrapclass = 'commentnumber', $mode = 'echo') {
	global $momcn;
	return $momcn->comment_numbering($comment_ID, $args, $wrapclass, $mode);
}
