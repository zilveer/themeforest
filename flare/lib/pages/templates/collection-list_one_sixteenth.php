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
global 	$post;
extract( btp_part_get_vars() );

$class = '';
$class .= 'collection pages view-as-list one-sixteenth';
$class .= $elems['featured_media'] ? '' : ' no-featured-media';	
?>
<ul class="<?php echo esc_attr( $class ); ?>">
	<?php while ( $query->have_posts()): $query->the_post(); ?>
	<li>    	            
    	<article class="pid-<?php the_ID(); ?> grid">
            
			<?php if( $elems['featured_media'] ): ?>
			<div class="c-one-sixteenth">					     	    
               <?php btp_entry_render_featured_media( 'one_sixteenth', $lightbox_group ); ?>
			</div>
			<?php endif; ?>				
			
			<div class="c-x">
				<?php if( $elems['title'] ): ?>					
				<header>
					<?php btp_entry_render_title( $lightbox_group, '<h5>', '</h5>'); ?>					
				</header>
				<?php endif; ?>
				
				<?php if ( $elems['summary'] ) { btp_entry_render_summary();} ?>
				
				<?php if ( $elems['button_1'] ) : ?>	
				<footer>                
	        	    <ul class="entry-buttons">						
	        	    	<li><?php  if ( $elems['button_1'] ) { btp_entry_render_button_1( $lightbox_group ); } ?></li>
	        	    </ul>
	        	</footer>
	        	<?php endif; ?>	    
			
			</div><!-- .c-x -->				
		</article><!-- .pid-XX -->			
	</li>
	<?php endwhile; ?>			        
</ul>