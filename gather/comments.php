<?php
/**
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

if ( post_password_required() )
    return;
?>
<section class="comments" >
<?php if ( have_comments() ) : ?>
    <h5 class="comments-title">
    	<?php
			printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments_title', 'gather' ),
				number_format_i18n( get_comments_number() ), get_the_title() );
		?>
	</h5>
	<?php 
	$args = array(
		'walker'            => null,
		'max_depth'         => '',
		'style'             => 'li',
		'callback'          => 'gather_comments',
		'end-callback'      => null,
		'type'              => 'all',
		'reply_text'        => __('<i class="fa fa-reply"></i>','gather'),
		'page'              => '',
		'per_page'          => '',
		'avatar_size'       => 60,
		'reverse_top_level' => null,
		'reverse_children'  => '',
		'format'            => 'html5', //or xhtml if no HTML5 theme support
		'short_ping'        => false, // @since 3.6,
	    'echo'     			=> true, // boolean, default is true
	);
	?>

    <ul class="comments-list clearfix">
        <?php wp_list_comments($args);?>
    </ul>
    <?php
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<div class="content-nav">
		<ul class="pager">
			<li class="previous"><?php previous_comments_link( __( '<i class="fa fa-long-arrow-left"></i>', 'gather' ) ); ?></li>
			<li><span>/</span></li>
			<li class="next"><?php next_comments_link( __( '<i class="fa fa-long-arrow-right"></i>', 'gather' ) ); ?></li>
		</ul>
	</div>
	<?php endif; // Check for comment navigation ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments" style="margin-left:15px;"><?php _e( 'Comments are closed.' , 'gather' ); ?></p>
	<?php endif; ?>
<?php endif;?>
</section>

<?php if(comments_open( )) : ?>
<section class="post-comment-form">
    <?php
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$comment_args = array(
		'title_reply'=> __('Leave A Comment','gather'),
		'fields' => apply_filters( 'comment_form_default_fields', 
		array(
				'author' => '<div class="row"><div class="form-group col-md-4 col-sm-4"><input type="text" class="form-control input-lg" id="author" name="author"  placeholder="'.__('Name','gather').'" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . '></div>',
				'email' =>'<div class="form-group col-md-4 col-sm-4"><input id="email" name="email" type="text" class="form-control input-lg"  placeholder="'.__('E-mail','gather').'" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" ' . $aria_req . ' /></div>',
				'url' =>'<div class="form-group col-md-4 col-sm-4"><input id="url" name="url" type="text" class="form-control input-lg" value="' . esc_attr( $commenter['comment_author_url'] ) .'" size="30"  placeholder="'.__('Website (optional)','gather').'" /></div></div>',
				) 
			),
		'comment_field' => '<div class="row"><div class="form-group col-md-12"><textarea class="form-control input-lg"  placeholder="'.__('Message','gather').'"  id="comment" cols="8" rows="4" name="comment"  '.$aria_req.'></textarea></div></div>',
		'id_form'=>'comment-form',
		'id_submit' => 'submit',
		'class_submit'=>'btn btn-success btn-lg',
		'label_submit' => __('Submit your comment','gather'),
		'must_log_in'=> '<p class="not-empty" style="margin-left:15px;">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ,'gather'), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'logged_in_as' => '<p class="not-empty" style="margin-left:15px;">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','gather' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		//'comment_notes_before' => '<h5 class="text-center">'.__('Your email is safe with us.','gather').'</h5>',
		'comment_notes_after' => '',
		);
	?>
	<?php comment_form($comment_args); ?>
</section>
<?php endif;?>