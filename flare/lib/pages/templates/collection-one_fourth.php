<?php
/**
 * The Template Part for displaying a collection of pages.
 * 
 * Can be used by:
 * 1) shortcodes which displays a collection of pages
 * 2) widgets which displays a collection of pages
 *
 * @package BTP_Flare_Theme
 */
?>
<?php
global	$post;
extract( btp_part_get_vars() );
?>
<ul class="collection pages view-as-grid one-fourth"><?php while ($query->have_posts()): $query->the_post(); ?><li>    	            
     	<article class="pid-<?php the_ID(); ?>">     	
     		<?php if ( $elems['featured_media'] ) { btp_entry_render_featured_media('one_fourth', $lightbox_group); } ?>       	
        	
        	<?php if ( $elems['title'] ) : ?>
            <header>
				<?php btp_entry_render_title( $lightbox_group ); ?>
			</header>	
			<?php endif; ?>
					
			<?php if ( $elems['summary'] ) { btp_entry_render_summary( 20 ); } ?>
						
			<?php if ( $elems['button_1'] ) : ?>		
			<footer>
        	    <ul class="entry-buttons">						
        	    	<li><?php  if ( $elems['button_1'] ) { btp_entry_render_button_1( $lightbox_group ); } ?></li>
        	    </ul>        	    
        	</footer>
        	<?php endif; ?>	    
					     
		</article><!-- .pid-XX -->						
	</li><?php endwhile; ?></ul>