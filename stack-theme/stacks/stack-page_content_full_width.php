<?php if( get_the_content() != '' ): ?>
<div class="stack stack-page-content" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">
	<div class="span12">
		<?php the_content(); ?>
	</div>
</div>
</div>
</div><!-- .stack-page-content -->
<?php endif; ?>