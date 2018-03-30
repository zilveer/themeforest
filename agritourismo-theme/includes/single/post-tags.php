<?php
	//post tags
	$posttags = get_the_tags();
?>
<?php if ($posttags) { ?>
		<!-- BEGIN .tagcloud -->
		<div class="tagcloud">
			<?php	
				  foreach($posttags as $tag) {
					echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name . '</a>'; 
				  }
			?>
		<!-- END .tagcloud -->
		</div>
		<div class="split-line-1"></div>
<?php } ?>