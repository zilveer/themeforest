<?php 
/**
 * This file shows content of blog posts
 *
 */
 
global $unik_data; ?>

<div class="clearfix">
	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<a href="<?php the_permalink() ?>" class="button"><?php _e('read more',THEMENAME); ?></a>
	</div>
	<?php else : ?>
	
	<div class="entry-content entry-content-large">
		<?php if(!is_single()): ?>		
		<?php 
			if ( preg_match('/<!--more(.*?)?-->/', $post->post_content) or $unik_data['blog_post_size']== 'full_content'){
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', THEMENAME ) );
			}
			else { 
				the_excerpt(); 
			}	
		?>
		
		<?php else : ?>
		
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', THEMENAME ) );
			
		endif;
		?>
		<?php if(is_single()){ wp_link_pages( array( 'before' => '<div class="pagination-wrap clearfix"><div class="left">'.__('Pages: &nbsp; &nbsp; ').'</div><div class="pagination left">', 'after' => '</div></div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); }?>
	</div>
	<?php endif; ?>	
</div>