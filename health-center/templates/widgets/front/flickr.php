<?php

if ( !empty( $flickr_id ) ):

echo $before_widget;
if($title)
	echo $before_title . $title . $after_title;
?>
	<div class="flickr_wrap clearfix">
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $count; ?>&amp;display=<?php echo $display; ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type;?>&amp;<?php echo $type;?>=<?php echo $flickr_id; ?>"></script>
	</div>
<?php
echo $after_widget;
endif; 
