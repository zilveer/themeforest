<?php if( comments_open() && !( is_page() && theme_options('page', 'comment_enable') == 'off' ) ): ?>

	<div class="stack stack-comment" id="<?php echo $stack['id']; ?>">
	<div class="container">
		<div class="row">
			<div class="span12">

				<?php comments_template(); ?>
			
			</div>
		</div>
	</div>
	</div><!-- .stack-comment -->

<?php endif; ?>