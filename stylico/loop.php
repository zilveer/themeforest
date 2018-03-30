<?php
/**
 * The default template for the loop
 *
 */
?>
	<article <?php post_class('clearfix'); ?>>
    
		<?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'stylico' ), get_the_title() ); ?>" class="post-thumbnail"><?php the_post_thumbnail('thumbnail'); ?></a>
        <?php endif; ?>
        
        <div class="post-entry">
            
            <h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'stylico' ), get_the_title() ); ?>"><?php the_title(); ?></a></h2>
            
			<?php post_meta_menu(); ?>
            
            <div class="post-excerpt"><?php the_excerpt(); ?></div>
        
        </div>
        
    </article>
    
    <hr class="post-dotted-line" />