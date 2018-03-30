<?php
//
// post tags
//
?>

<?php $video_tags = wp_get_post_terms(get_the_ID(), 'video-tags', array("fields" => "all")); ?>

<?php if( !empty( $video_tags ) ): ?>
<div class="post-tags">
	<div class="module-top clearfix">
		<h4 class="module-title"><?php _e( 'Tags', 'magzilla' ); ?></h4>
	</div><!-- module-top -->
	<div class="module-body">
		<?php

		//Returns Array of Term Names for "my_taxonomy"
		foreach($video_tags as $tag): 
	            $term_link = get_term_link( $tag, 'video-tags' );
	            if( is_wp_error( $term_link ) )
	                continue;
	           
	            echo '<a href="'.$term_link.'">'.$tag->name.'</a>' . ' '; 
	              
	    endforeach;

		?>
	</div><!-- module-body -->
</div><!-- post-tags -->

<?php endif; ?>