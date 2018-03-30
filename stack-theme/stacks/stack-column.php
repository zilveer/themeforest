<div class="stack stack-wysiwyg" id="<?php echo $stack['id']; ?>">
<div class="container">
	<div class="row">

		<?php if( $stack['stack_title'] != '' ): ?><div class="span12"><div class="stack-title"><?php echo __($stack['stack_title']); ?><span class="spot"></span></div></div><?php endif; ?>
			
		<?php if( $stack['layout'] == '1' ): ?>
			<div class="span12">
				<?php echo apply_filters('the_content', $stack['column_1']); ?>
			</div>
		<?php endif; ?>

		<?php if( $stack['layout'] == '2-1' ): ?>
			<div class="span6">
				<?php echo apply_filters('the_content', $stack['column_1']); ?>
			</div>
			<div class="span6">
				<?php echo apply_filters('the_content', $stack['column_2']); ?>
			</div>
		<?php endif; ?>

		<?php if( $stack['layout'] == '2-2' ): ?>
			<div class="span4">
				<?php echo apply_filters('the_content', $stack['column_1']); ?>
			</div>
			<div class="span8">
				<?php echo apply_filters('the_content', $stack['column_2']); ?>
			</div>
		<?php endif; ?>

		<?php if( $stack['layout'] == '2-3' ): ?>
			<div class="span8">
				<?php echo apply_filters('the_content', $stack['column_1']); ?>
			</div>
			<div class="span4">
				<?php echo apply_filters('the_content', $stack['column_2']); ?>
			</div>
		<?php endif; ?>

		<?php if( $stack['layout'] == '2-4' ): ?>
			<div class="span3">
				<?php echo apply_filters('the_content', $stack['column_1']); ?>
			</div>
			<div class="span9">
				<?php echo apply_filters('the_content', $stack['column_2']); ?>
			</div>
		<?php endif; ?>

		<?php if( $stack['layout'] == '2-5' ): ?>
			<div class="span9">
				<?php echo apply_filters('the_content', $stack['column_1']); ?>
			</div>
			<div class="span3">
				<?php echo apply_filters('the_content', $stack['column_2']); ?>
			</div>
		<?php endif; ?>

		<?php if( $stack['layout'] == '3' ): ?>
			<div class="span4">
				<?php echo apply_filters('the_content', $stack['column_1']); ?>
			</div>
			<div class="span4">
				<?php echo apply_filters('the_content', $stack['column_2']); ?>
			</div>
			<div class="span4">
				<?php echo apply_filters('the_content', $stack['column_3']); ?>
			</div>
		<?php endif; ?>

		<?php if( $stack['layout'] == '4' ): ?>
			<div class="span3">
				<?php echo apply_filters('the_content', $stack['column_1']); ?>
			</div>
			<div class="span3">
				<?php echo apply_filters('the_content', $stack['column_2']); ?>
			</div>
			<div class="span3">
				<?php echo apply_filters('the_content', $stack['column_3']); ?>
			</div>
			<div class="span3">
				<?php echo apply_filters('the_content', $stack['column_4']); ?>
			</div>
		<?php endif; ?>


	</div>
</div>
</div><!-- .stack-column -->