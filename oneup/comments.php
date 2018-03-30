<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php if ($t->comments->supported()): ?>
<!--comment section-->
<div class="row-fluid" id="comments">
	<div class="span12 commentsWrap">

		<!--title-->
		<div class="row-fluid">
			<div class="span12">
				<h3 id="comments-title">
					<?php _e("Comments",'Pixelentity Theme/Plugin'); ?> <span>( <?php $t->content->comments(); ?> )</span>
				</h3>
			</div>
		</div>
		
		<?php $t->comments->show(); ?>
		
		<div class="row-fluid">
			<div class="span12">
				<?php $t->comments->pager(); ?>
			</div>
		</div>
		
		<?php $t->comments->form(); ?>
		
	</div>
	<!--end comments wrap-->
</div>
<!--end comments-->
<?php endif; ?>