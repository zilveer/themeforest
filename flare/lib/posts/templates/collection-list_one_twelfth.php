<?php
/**
 * The Template Part for displaying a collection of posts.
 * 
 * Can be used by: 
 * 1) shortcodes which displays a collection of posts
 * 2) widgets which displays a collection of posts
 *
 * @package BTP_Flare_Theme
 */
?>
<?php
global 	$post;
extract( btp_part_get_vars() );

$class = '';
$class .= 'collection posts view-as-list one-twelfth';
$class .= $elems['featured_media'] ? '' : ' no-featured-media';	
?>
<div class="<?php echo esc_attr( $class ); ?>">
<ul>
	<?php while ( $query->have_posts()): $query->the_post(); ?>
	<li>    	            
    	<article class="pid-<?php the_ID(); ?> grid">
            
			<?php if( $elems['featured_media'] ): ?>
			<div class="c-one-sixteenth">					     	    
               <?php btp_entry_render_featured_media( 'one_twelfth', $lightbox_group ); ?>
			</div>
			<?php endif; ?>				
			
			<div class="c-x">
				<?php if( $elems['title'] || $elems['date'] || $elems['author'] || $elems['comments_link'] ) : ?>					
				<header>
					<?php if ( $elems['title'] ) { btp_entry_render_title( $lightbox_group, '<h5>', '</h5>'); } ?>
					
                	<?php if ( $elems['date'] || $elems['author'] || $elems['comments_link'] ): ?>
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
			
			</div><!-- .c-x -->				
		</article><!-- .pid-XX -->			
	</li>
	<?php endwhile; ?>			        
</ul>
</div>