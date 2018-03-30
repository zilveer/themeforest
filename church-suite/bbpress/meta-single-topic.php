<?php
/** Single topic meta */
?>


<div class="bbp-single-topic-meta">
	
	<div class="back-to">
		<a href="<?php echo bbp_get_forum_permalink(); ?>">&larr; Back to discussions</a>
	</div>


	<div class="posted-in">
		Posted in: <?php echo '<a href="' . bbp_get_forum_permalink() . '" class="parent-forum">' . bbp_get_forum_title(bbp_get_topic_forum_id()) . '</a>'; ?> &nbsp;
	</div>
	
</div>
