<?php
/************************************************************************
* Comments Template
*************************************************************************/

if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'This file can not be accessed directly!' );
}

if ( post_password_required() ) {
	return;
}

if( get_comments_number() == 0 ){
	$ex_class = " no-comments";
}else{
	$ex_class = " has-comments";
}
?>


<div class="heading<?php echo esc_attr( $ex_class );?>" id="comments">
	<h4><?php comments_number( esc_html__( 'No Comments', 'ninezeroseven' ), esc_html__( '1 Comment', 'ninezeroseven' ), esc_html__( '% Comments', 'ninezeroseven' ) );?></h4>
</div>

<?php if ( have_comments() ): ?>

	<ul class="post-comments">
		<?php wp_list_comments( 'callback=wbc907_custom_comments' );?>
	</ul>

	<div class="navigation">
	  <?php paginate_comments_links(); ?>
	</div>

<?php elseif ( !comments_open() && !is_page() && post_type_supports( get_post_type(), 'comments' ) ): ?>

	<p>Comments are closed</p>

<?php endif;?>

<?php wbc907_custom_comment_form(); ?>
