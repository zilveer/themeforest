
		<div class="three columns alpha clearfix">
			<ul class="entry-meta meta1 clearfix">
				<li><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><time><span class="date-month"><?php echo esc_attr( get_the_time('M') ); ?></span><span class="date-day"><?php echo esc_attr( get_the_time('d') ); ?></span><span class="date-year"><?php echo esc_attr( get_the_time('Y') ); ?></span></time></a></li>
				<?php 
				global $NHP_Options; 
				$options_morphis = $NHP_Options; 
				?>
				<?php $select_skin = $options_morphis['select_skin']; ?>
				<?php if($select_skin == 'dark'): ?>
				<li><img src="<?php echo get_template_directory_uri() . '/images/icons/glyphish/124-bullhorn.png'; ?>" class="post-format-icon" title="Status Post Format"/></li>
				<?php endif; ?>
				<li><?php _e( 'by', 'morphis' ); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'morphis' ), get_the_author() ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></li>
				
				<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( ', ' );
					if ( $categories_list ):
				?>
				<li><span><?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'morphis' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
				 ?></span></li>	
				<?php endif; // End if categories ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>				
				<li><span class="tag-links">
					<?php printf( __( '<span class="%1$s">Tagged in</span> %2$s', 'morphis' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
					?>
				</span></li>
				<?php endif; // End if $tags_list ?>
				<?php endif; // End if 'post' == get_post_type() ?>
				<?php if ( comments_open() ) : ?>
				
				<li><span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'morphis' ) . '</span>', __( '<b>1</b> Comment', 'morphis' ), __( '<b>%</b> Comments', 'morphis' ) ); ?></span></li>
				<?php endif; // End if comments_open() ?>
				<div class="clear"></div>
				<li><?php edit_post_link( __( 'Edit', 'morphis' ), '<span class="edit-link">', '</span>' ); ?></li>	
				
			</ul>	
		</div>
		
		<?php $sidebar_pos = $options_morphis['radio_img_select_sidebar'] ?>
		
		<?php //get the page ID ?>
		<?php global $wp_query; ?>
		<?php $page_id = $wp_query->get_queried_object_id(); ?>		
		<?php $unique_sidebar_layout = get_post_meta($page_id,'_cmb_page_layout_sidebar',TRUE); ?>		
		
		<?php if($sidebar_pos == '3') : ?>	
			<?php if($unique_sidebar_layout == 'no_sidebar') : ?>
				<div class="thirteen columns omega clearfix">						
			<?php elseif($unique_sidebar_layout == 'right_sidebar' || $unique_sidebar_layout == 'left_sidebar') : ?>
				<div class="nine columns omega clearfix">						
			<?php else: ?>
				<div class="thirteen columns omega clearfix">						
			<?php endif; ?>
		<?php else :  ?>
			<?php if($unique_sidebar_layout == 'no_sidebar') : ?>
				<div class="thirteen columns omega clearfix">						
			<?php elseif($unique_sidebar_layout == 'right_sidebar' || $unique_sidebar_layout == 'left_sidebar') : ?>
				<div class="nine columns omega clearfix">						
			<?php else: ?>
				<?php if($sidebar_pos == '2' || $sidebar_pos == '1') : ?>	
					<div class="nine columns omega clearfix">						
				<?php else: ?>
					<div class="thirteen columns omega clearfix">						
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>		
		
			<div class="post-body">						
				
				<div class="clear"></div>
				
				<div class="entry-content status">					
					<?php $statusMsg = get_post_meta($post->ID, '_cmb_status_pf_message', true); ?>
					<?php echo '<p class="status_pf">' . $statusMsg . '</p>'; ?>
					<?php
						if($options_morphis['select_post_content']=='2'):
							global $more;    // Declare global $more (before the loop).
							$more = 0;       // Set (inside the loop) to display content above the more tag.
							the_content(morphis_read_more_text());
						else:
							the_excerpt();
						endif;
					?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'morphis' ) . '</span>', 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
				<?php $divider = $options_morphis['radio_img_select_divider']; ?>
				<?php if($divider != 'vintage-none') : ?>
					<hr class="<?php echo $divider; ?>" />	
				<?php endif; ?>
			</div>	
			
		</div>
		
		<hr />