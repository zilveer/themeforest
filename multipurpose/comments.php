
<?php
	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<?php if(comments_open()): ?>
<div id="comments">
	<?php if ($comments) : ?>
		<section class="comments">
			<h2 class="underline"><span><?php printf( _n( 'One comment', '%1$s comments', get_comments_number(), 'multipurpose'), number_format_i18n( get_comments_number() ));?></span></h2>
			<ul class="commentlist">
				<?php wp_list_comments('callback=multipurpose_comment'); ?>
			</ul>		
			<p><?php paginate_comments_links(); ?></p>			
		</section>
	<?php endif; ?>
	<section class="comment-form" id="respond">
		<h2 class="underline"><span><?php esc_attr_e('Leave a Comment','multipurpose');?></span></h2>
		<?php comment_form(multipurpose_comment_form_args()); ?>
	</section>
</div>
<?php endif; ?>