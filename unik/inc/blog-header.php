<!-- Entry header -->
<div class="entry-header clearfix">
	<?php
	
	if(get_post_type( get_the_ID() )=='event'): 
		$date = new DateTime(get_post_meta($post->ID, THEMENAME.'_event_date',true));
		 
	?>
	
		<div class="date"><span class="day"><?php echo $date->format('d'); ?></span><span class="month"><?php  echo $date->format('M').','.$date->format('y') ; ?></span></div>
	<?php else : ?>		
	
	<div class="date"><span class="day"><?php echo get_the_time('d'); ?></span><span class="month"><?php echo get_the_time('M').','.get_the_time('y') ; ?></span></div>
	
	<?php endif; ?>
	
	<!-- Title for single -->
<?php if ( is_single() ) : ?>	
	
		<span class="right post-next-prev"><?php previous_post_link('%link', __('<i class="icon-angle-left"></i>  Prev', THEMENAME)); ?>
			<?php	next_post_link('%link', __('Next  <i class="icon-angle-right"></i>', THEMENAME)); ?> 
		</span>
		

	<h3 class="entry-title"><?php the_title(); ?></h3>
	
	
<?php else: ?>
	
	<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<?php endif; ?>
	
	<!-- info box -->
	<div class="info-box">
		<?php if(get_post_type( get_the_ID() )=='post'): ?>
			<span><i class="icon-user"></i> <?php the_author_posts_link(); ?></span>
		<?php endif; ?>
		
		<span><i class="icon-th-list"></i> 
		
		<?php 
			if(get_post_type( get_the_ID() )=='event'){
				echo get_the_term_list( $post->ID, 'event_cat', '', ', ' );
			}else{
				echo get_the_category_list( ', ' );
			}
		?>		
		</span>
		
		<span>
			<?php if(has_tag() && is_single()): ?><i class="icon-tags"></i> <?php echo get_the_tag_list( '',', ' ); ?><?php endif; ?>
		</span>	
		
		<span><?php if ($post->comment_status == 'open') : ?><i class="icon-comment"></i> <?php comments_popup_link( __( 'Comment', THEMENAME ) , __( 'One comment', THEMENAME ), __( 'View all % comments', THEMENAME ) ); endif; ?></span>

		<?php edit_post_link( __( 'Edit', THEMENAME ), '<i class="icon-edit"></i><small>', '</small>' ); ?>
	</div>
	

	<div class="clear"></div>
</div>