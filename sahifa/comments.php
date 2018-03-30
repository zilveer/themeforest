<?php
if ( post_password_required() ) {
	return;
}
?>
		
<div id="comments">

<?php if ( have_comments() ) : ?>
	
	<div id="comments-box">
		<div class="block-head">
			<h3 id="comments-title"><?php comments_number( __ti( 'No comments' ), __ti( 'One comment' ), '% '.__ti( 'comments' ) );?> </h3><div class="stripe-line"></div>
		</div>
		<div class="post-listing">

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __ti( '<span>&larr;</span> Older Comments' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __ti( 'Newer Comments <span>&rarr;</span>' ) ); ?></div>
			</div> <!-- .navigation -->
		<?php endif; ?>
	
		<?php $comments_by_type = separate_comments($comments); ?>
			
		<?php if ( !empty($comments_by_type['comment']) ) : ?>
		
			<ol class="commentlist"><?php wp_list_comments('type=comment&callback=tie_custom_comments'); ?></ol>
				
		<?php endif; ?> 

			
		<?php $comment_counter = 0 ; ?>
			
		<?php if ( !empty($comments_by_type['pings']) ) : ?>
			
		<div id="pings" class="commentlist">
		
			<ol class="pinglist"><?php wp_list_comments('type=pings&trackback&pingback&callback=tie_custom_pings'); ?></ol>
			
		</div>
			
		<?php endif; ?>	
		</div>
	</div><!-- #comments-box -->
			
<?php endif; ?>

<div class="clear"></div>
<?php comment_form(); ?>


</div><!-- #comments -->
