<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package smartfood
 */

/* If a post password is required or no comments are given and comments/pings are closed and comments not disabled from theme options panel, return. */
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
	return;
?>

<section id="comments-template">

	<?php if ( have_comments() ) : // Check if there are any comments. ?>

		<div id="comments">

			<header id="comments-header">
				<h3 id="comments-number"><?php comments_number(); ?></h3>
			</header><!-- #comments-header -->

			<?php if ( get_option( 'page_comments' ) && 1 < get_comment_pages_count() ) : // Check for paged comments. ?>

				<div class="comments-nav">

					<?php previous_comments_link( _x( 'Previous', 'comments navigation', 'smartfood' ) ); ?>

					<span class="page-numbers"><?php 
						/* Translators: Comments page numbers. 1 is current page and 2 is total pages. */
						printf( __( 'Page %1$s of %2$s', 'smartfood' ), get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1, get_comment_pages_count() ); 
					?></span>

					<?php next_comments_link( _x( 'Next', 'comments navigation', 'smartfood' ) ); ?>

				</div><!-- .comments-nav -->

			<?php endif; // End check for paged comments. ?>

			<ul class="tdp-commentlist">
					<?php wp_list_comments( 'callback=tdp_theme_comments_layout&type=comment' ); ?>
			</ul>

		</div><!-- #comments-->

	<?php endif; // End check for comments. ?>
	<?php 
			
			$fields =  array(
				'author'=> '<div class="comment-form-name comment-form-row col-md-4 col-sm-12"><input type="text" name="author" class="text-input" id="author" tabindex="54" placeholder="'.__('Your Name', 'smartfood').'"  /></div>',
				'email' => '<div class="comment-form-email comment-form-row col-md-4 col-sm-12"><input type="text" name="email" class="text-input" id="email" tabindex="56" placeholder="'.__('Email Address', 'smartfood').'" /></div>',
				'url' 	=> '<div class="comment-form-website comment-form-row col-md-4 col-sm-12"><input type="text" name="url" class="text-input" id="url" tabindex="57" placeholder="'.__('Website', 'smartfood').'" /></div>',
			);

			//Comment Form Args
	        $comments_args = array(
				'fields' => $fields,
				'title_reply'=>'<div class="single-post-fancy-title"><span>'.__('Leave a Comment', 'smartfood').'</span></div>',
				'comment_field' => '<div class="comment-textarea"><textarea placeholder="'.__('Your message', 'smartfood').'" class="textarea" name="comment" rows="8" id="comment" tabindex="58"></textarea></div>',
				'comment_notes_before' => apply_filters( 'tdp_comment_form_notes_before', '' ),
				'comment_notes_after' => apply_filters( 'tdp_comment_form_notes_after', '' ),
				'label_submit' => __('Submit Message', 'smartfood')
			);
			comment_form($comments_args); 
		?> 
</section><!-- #comments-template -->
