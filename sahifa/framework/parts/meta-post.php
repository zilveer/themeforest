<?php
global $get_meta;
if( ( tie_get_option( 'post_meta' ) && empty( $get_meta["tie_hide_meta"][0] ) ) || $get_meta["tie_hide_meta"][0] == 'no' ): ?>		
<p class="post-meta">
<?php if( tie_get_option( 'post_author' ) ): ?>		
	<span class="post-meta-author"><i class="fa fa-user"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title=""><?php echo get_the_author() ?> </a></span>
<?php endif; ?>	
<?php if( tie_get_option( 'post_date' ) ): ?>		
	<?php tie_get_time() ?>
<?php endif; ?>	
<?php if( tie_get_option( 'post_cats' ) ): ?>
	<span class="post-cats"><i class="fa fa-folder"></i><?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
<?php endif; ?>	
<?php if( tie_get_option( 'post_comments' ) ): ?>
	<span class="post-comments"><i class="fa fa-comments"></i><?php comments_popup_link( __ti( 'Leave a comment'  ), __ti( '1 Comment' ), __ti( '% Comments' ) ); ?></span>
<?php endif; ?>
<?php if( tie_get_option( 'post_views' ) ):
	$text = __ti( 'Views' );
	echo tie_views( $text ); ?>
<?php endif; ?>
</p>
<div class="clear"></div>
<?php endif; ?>