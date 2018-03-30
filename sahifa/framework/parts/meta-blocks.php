<?php

global $get_meta;

?>
<p class="post-meta">
<?php if( !empty( $get_meta[ 'box_meta_score' ][0] ) ) tie_get_score(); ?>
<?php if( !empty( $get_meta[ 'box_meta_author' ][0] ) ): ?>		
	<span class="post-meta-author"><i class="fa fa-user"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title=""><?php echo get_the_author() ?> </a></span>
<?php endif; ?>	
<?php if( !empty( $get_meta[ 'box_meta_date' ][0] ) ) tie_get_time() ?>
<?php if( !empty( $get_meta[ 'box_meta_cats' ][0] ) ): ?>
	<span class="post-cats"><i class="fa fa-folder"></i><?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
<?php endif; ?>	
<?php if( !empty( $get_meta[ 'box_meta_comments' ][0] ) ): ?>
	<span class="post-comments"><i class="fa fa-comments"></i><?php comments_popup_link( '0' , '1' , '%' ); ?></span>
<?php endif; ?>
<?php if( !empty( $get_meta[ 'box_meta_views' ][0] ) ): ?>
	<?php echo tie_views(); ?>
<?php endif; ?>
</p>
