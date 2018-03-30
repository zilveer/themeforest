<?php
/**
 * The Template Part for displaying a collection of posts.
 * 
 * Can be used by:
 * 1) post archive|index templates
 * 2) shortcodes which displays a collection of posts
 * 3) widgets which displays a collection of posts
 *
 * @package BTP_Flare_Theme
 */
?>
<?php
global 	$post;
extract( btp_part_get_vars() );
?>
<div class="collection posts view-as-grid two-thirds">
<ul>
<?php while ( $query->have_posts()): $query->the_post(); ?><li>
    	<article class="pid-<?php the_ID(); ?> format-<?php echo get_post_format(); ?>">
			<span class="entry-format"><span></span></span>    	
    		<?php if( $elems['title'] || $elems['date'] || $elems['author'] || $elems['comments_link'] ) : ?>            	
            <header>
				<?php if ( $elems['title'] ) btp_entry_render_title( $lightbox_group ); ?>
				<?php if ( $elems['date'] || $elems['author'] || $elems[ 'comments_link' ] ): ?>
				<p class="meta entry-meta">					
					<?php 
						if ( $elems['date'] ) { btp_entry_render_date(); }
						if ( $elems['author'] ) { btp_entry_render_author(); }
						if ( $elems['comments_link'] ) { btp_entry_render_comments_link(); }
					?>
				</p>
				<?php endif; ?>
			</header>
			<?php endif; ?>
			
			<?php if ( $elems['featured_media'] ) { btp_entry_render_featured_media( 'two_third', $lightbox_group, false ); } ?>
		
			<?php if ( $elems['summary'] ) { btp_entry_render_summary(null, 'cut-off');} ?>
		
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
       	</article><!-- .pid-XX -->	
	</li><?php endwhile; ?>
</ul>
</div>