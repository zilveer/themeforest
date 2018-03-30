<?php
/**
 * The Template Part for displaying a collection of works.
 * 
 * Can be used by:
 * 1) work archive|index templates
 * 2) shortcodes which displays a collection of works
 * 3) widgets which displays a collection of works
 *
 * Please don't remove empty HTML comments <!-- -->. 
 * They are required to eliminate whitespace after "display:inline-block" elements
 *
 * @package BTP_Flare_Theme
 */
?>
<?php
global $post;
extract( btp_part_get_vars() );
?>
<div class="collection works view-as-grid one-third">
<ul><!-- --><?php while ($query->have_posts()): $query->the_post(); ?><li>    	            
          	<article class="pid-<?php the_ID(); ?>">
	            <?php if ( $elems['featured_media'] ) { btp_entry_render_featured_media('one_third', $lightbox_group); } ?>
	            
	            <?php if( $elems['title'] || $elems['date'] || $elems['comments_link'] ) : ?>
	            <header>
					<?php if ( $elems['title']) btp_entry_render_title( $lightbox_group ); ?> 
										
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
				
				<?php if ( $elems['summary']) { btp_entry_render_summary();} ?>
				
				<?php if( $elems['categories'] || $elems['tags'] || $elems['button_1'] ) : ?>	
				<footer>
					<?php if ( $elems['categories'] || $elems['tags'] ): ?>
					<div class="meta entry-terms">					
						<?php 
							if ( $elems['categories']) { btp_entry_render_categories(); }
							if ( $elems['tags']) { btp_entry_render_tags(); }
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
	       		
       		</article><!-- .pid-XX -->						
		</li><!-- --><?php endwhile; ?></ul>
</div>		