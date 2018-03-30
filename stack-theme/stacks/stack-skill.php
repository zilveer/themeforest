<div class="stack stack-skill" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">

	<?php if( $stack['stack_title'] != '' ): ?><div class="span12"><div class="stack-title"><?php echo $stack['stack_title']; ?><span class="spot"></span></div></div><?php endif; ?>

	<?php if( $stack['content'] ): ?>
		<div class="span4"><div class="padding-right-20"><?php echo apply_filters('the_content', $stack['content']); ?></div></div>
	<?php endif; ?>

	<div class="span<?php echo ( $stack['content'] )?'8':'12'; ?>">
	<?php foreach ($stack['skill_list'] as $skill ): ?>
		<?php echo $skill['stack_title']; ?>
		<div class="skill-bar"><div class="skill-score" style="width:<?php echo $skill['score']; ?>%;"><span><?php echo $skill['score']; ?>%</span></div></div>
	<?php endforeach; ?>
	</div>

</div>
</div>
</div><!-- .stack-skill -->