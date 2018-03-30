<?php

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die (_e( 'Please do not load this page directly. Thanks!', 'swmtranslate' ));

if ( post_password_required() ) { ?>
	<p class="nocomments">
		<?php _e( 'This post is password protected. Enter the password to view comments.', 'swmtranslate' ); ?>
	</p>
	<?php 
	return; 
} ?>

<!-- Blog Responses Start -->
<div id="blog_responses">
	<?php if ( have_comments() ) : ?>

		<div class="blog-single-heading">
			<h4><?php comments_number('No Comments', 'One Comment', '% Comments' );?></h4>
		</div>	
		
<?php
/* ----------------------------------------------------------------------------------
	Comments Listing
---------------------------------------------------------------------------------- */ ?>

		<section id="comment-wrap">
			<ol class="commentlist primary_color">	
				<?php wp_list_comments( array( 'callback' => 'swm_comment_listing' ) );	?>
			</ol>
		<div class="clear"></div>
		</section>
	
<?php
/* ----------------------------------------------------------------------------------
	Comments Pagination
---------------------------------------------------------------------------------- */ ?>

		<?php if (get_option('comments_per_page') > 0) : ?>

			<div class="paginate-com">
				<?php paginate_comments_links(array('prev_text' => '&laquo;', 'next_text' => '&raquo;')); ?>
			</div>	
	 
		<?php endif; 
	
	else : // this is displayed if there are no comments so far ?>
 
<?php
/* ----------------------------------------------------------------------------------
	Comments Open/Close message
---------------------------------------------------------------------------------- */ ?>

		<?php if ( comments_open() ) : 
				
				/* If comments are open, but there are no comments. */
	
		else : // comments are closed ?>
			
					<p class="nocomments">
						<?php _e( 'Comments are disabled.', 'swmtranslate' ); ?>
					</p>

		<?php endif; ?>
	<?php endif; ?>
</div>
<!-- Blog Responses End -->

<div class="clear"></div>

<?php

$swm_num_comments = get_comments_number();

if ($swm_num_comments != 0 ) { ?>
	
<?php }

?>	

<?php
/* ----------------------------------------------------------------------------------
	Comments Form
---------------------------------------------------------------------------------- */ ?>

<?php if ( comments_open() ) : ?>

	<div class="primary_color">
	
		<?php comment_form( array(
			'label_submit' => esc_html__( 'Submit', 'swmtranslate' ), 
			'title_reply' => __( '<span>Leave a Reply</span>', 'swmtranslate' ), 
			'cancel_reply_link' => esc_html__( 'Cancel Reply' , 'swmtranslate' ), 
			'title_reply_to' => esc_html__( 'Leave a Reply' , 'swmtranslate' )) 
			); 
		?>

	</div>	

<?php endif;?>

