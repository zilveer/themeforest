<?php get_header(); ?>
	<div class="content">
		<?php tie_breadcrumbs() ?>

		<div class="page-head">
		
			<h1 class="page-title">
				<?php printf( __ti( 'Tag Archives: %s' ), '<span>' . single_tag_title( '', false ) . '</span>' );	?>
			</h1>
			
			<?php if( tie_get_option( 'tag_rss' ) ):
				$tag_id = get_query_var('tag_id'); ?>
			<a class="rss-cat-icon tooltip" title="<?php _eti( 'Feed Subscription' ); ?>"  href="<?php echo  get_term_feed_link($tag_id , 'post_tag', "rss2") ?>"><i class="fa fa-rss"></i></a>
			<?php endif; ?>
			
			<div class="stripe-line"></div>
			
			<?php
			if( tie_get_option( 'tag_desc' ) ):	
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) )
				echo '<div class="clear"></div><div class="archive-meta">' . $tag_description . '</div>';
			endif;
			?>
			
		</div>
		
		<?php $loop_layout = tie_get_option( 'tag_layout' );	?>
		<?php get_template_part( 'loop' );	?>
		<?php if ($wp_query->max_num_pages > 1) tie_pagenavi(); ?>
		
	</div> <!-- .content -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>