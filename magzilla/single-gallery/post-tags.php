<?php
//
// post tags
//
?>

<?php $gallery_tags = wp_get_post_terms(get_the_ID(), 'gallery-tags', array("fields" => "all")); ?>

<?php if( !empty( $gallery_tags ) ): ?>
<div class="post-tags">
	<div class="module-top clearfix">
		<h4 class="module-title"><?php _e( 'Tags', 'magzilla' ); ?></h4>
	</div><!-- module-top -->
	<div class="module-body">
		<?php

		//Returns Array of Term Names for "my_taxonomy"
		foreach($gallery_tags as $tag): 
	            $term_link = get_term_link( $tag, 'gallery-tags' );
	            if( is_wp_error( $term_link ) )
	                continue;
	           
	            echo '<a href="'.esc_url( $term_link ).'">'.esc_attr( $tag->name ).'</a>' . ' ';
	              
	    endforeach;

		?>
	</div><!-- module-body -->
</div><!-- post-tags -->

<?php endif; ?>