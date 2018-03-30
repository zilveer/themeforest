<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. 
 *
 * @package WordPress
 * @subpackage rentify
 * @since 1.0
 */



if(!empty($_SERVER['SCRIPT-FILENAME']) && basename($_SERVER['SCRIPT-FILENAME']) == 'comments.php'){

	die(esc_html__('You can not access this file directly','rentify'));
}

/*check comments required password start*/
if(post_password_required()) : ?>

	<p>
		<?php esc_html_e('The post is password protected ! Enter password to see the post','rentify');
			  return;	
		 ?>
	</p>

<?php endif;
/*check comments required password end*/


if(have_comments()){ ?>
	<!-- comments show start -->
	<ul>
		<li>
		<?php 
		$args = array(
			'walker'            => new rentify_comment_walker,
			'max_depth'         => '',
			'style'             => 'ul',
			'callback'          => null,
			'end-callback'      => null,
			'type'              => 'all',
			'reply_text'        => 'Reply',
			'page'              => '',
			'per_page'          => '5',
			'reverse_top_level' => null,
			'reverse_children'  => '',
			'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
			'short_ping'        => false,   // @since 3.6
		    'echo'              => true     // boolean, default is true
		); 
		?>
		 <?php wp_list_comments($args); ?>
		</li>
	</ul>
	<!-- comments show end -->


	<!-- comments navigation start -->
	<!-- comments navigation start -->
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

		<nav>
			<div class="paginate-com">
			<?php 
			//Create pagination links for the comments on the current post, with single arrow heads for previous/next
				paginate_comments_links( array('prev_text' => '&lsaquo; Previous Comments', 'next_text' => 'Next Comments &rsaquo;')); 
			?>
			</div>
		</nav>

	<?php endif; ?>
	<!-- comments navigation end -->


<?php } 


/*check comment is closed start*/
if(!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')){ ?>

	<p>
		<?php esc_html_e('comments are closed .','rentify') ?>	
	</p>

<?php }
/*check comment is closed end*/

comment_form();


?>