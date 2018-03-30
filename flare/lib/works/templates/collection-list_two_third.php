<?php
/**
 * The Template Part for displaying a collection of works.
 * 
 * Can be used by:
 * 1) work archive|index templates
 * 2) shortcodes which displays a collection of works
 * 3) widgets which displays a collection of works
 *
 * @package BTP_Flare_Theme
 */
?>
<?php
global 	$post;
extract( btp_part_get_vars() );

$class = '';
$class .= 'collection works view-as-list two-third';
$class .= $elems['featured_media'] ? '' : ' no-featured-media';
$i = 0;	
?>
<div class="<?php echo esc_attr( $class ); ?>">
<ul>
	<?php while ( $query->have_posts()): $query->the_post(); ?>
	<li class="<?php echo ( $i++ % 2 ) ? 'even' : 'odd';?>">
    	<article class="pid-<?php the_ID(); ?> grid">
            
			<?php if( $elems['featured_media'] ): ?>
			<div class="c-two-third">					     	    
               <?php btp_entry_render_featured_media( 'two_third', $lightbox_group ); ?>
			</div>
			<?php endif; ?>				
			
			<div class="c-one-third">
				<?php if( $elems['title'] || $elems['date'] || $elems['comments_link'] ) : ?>					
				<header>
					<?php if ( $elems['title'] ) { btp_entry_render_title( $lightbox_group, '<h3>', '</h3>'); } ?>
					
                	<?php if ( $elems['date'] || $elems['comments_link'] ): ?>
					<p class="meta entry-meta">					
						<?php 
							if ( $elems['date'] ) { btp_entry_render_date( 'M Y' ); }
							if ( $elems['comments_link'] ) { btp_entry_render_comments_link(); }
						?>
					</p>
					<?php endif; ?>
				</header>
				<?php endif; ?>
				
				<?php if ( $elems['summary'] ) { btp_entry_render_summary();} ?>
				
				<?php if( $elems['categories'] || $elems['tags'] || $elems['button_1'] ) : ?>	
				<footer>
					<?php if ( $elems['categories'] || $elems['tags'] ): ?>
					<div class="meta entry-terms">					
						<?php 
							if ( $elems['categories'] ) { btp_entry_render_categories(); }
							if ( $elems['tags'] ) { btp_entry_render_tags(); }
						?>
					</div>
					<?php endif; ?>
	                
	                <?php  if ( $elems['button_1'] ): ?>
	        	    <ul class="entry-buttons">						
	        	    	<li><?php  if ( $elems['button_1'] ) { btp_entry_render_button_1( $lightbox_group ); } ?></li>
	        	    </ul>              
	        	    <?php endif; ?>
	        	</footer>
	        	<?php endif; ?>	    
			
			</div><!-- .c-two-third -->				
		</article><!-- .pid-XX -->			
	</li>
	<?php endwhile; ?>			        
</ul>
</div>