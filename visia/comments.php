<?php $t =& peTheme(); ?>
<?php if ($t->comments->supported()): ?>
<!--comment section-->
<div class="row-fluid" id="comments">
	<div class="span12 commentsWrap">
		<div class="inner-spacer-right-lrg">

			<!--title-->
			<div class="row-fluid">
				<div class="span12">
					<h6 id="comments-title">
						<?php _e("Comments",'Pixelentity Theme/Plugin'); ?> <span>( <?php $t->content->comments(); ?> )</span>
					</h6>
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
		
	</div>
	<!--end comments wrap-->
</div>
<!--end comments-->
<?php endif; ?>