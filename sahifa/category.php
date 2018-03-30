<?php get_header(); ?>

	<div class="content">
	
	<?php tie_breadcrumbs() ?>
	
	<?php
		$category_id = get_query_var('cat') ;
		$tie_cats_options = get_option( 'tie_cats_options' );
		
		if( !empty( $tie_cats_options[ $category_id ] ) )
			$cat_options = $tie_cats_options[ $category_id ];
	?>
		
		<div class="page-head">
		
			<h1 class="page-title">
				<?php echo single_cat_title( '', false ) ?>
			</h1>
			
			<?php if( tie_get_option( 'category_rss' ) ): ?>
			<a class="rss-cat-icon ttip" title="<?php _eti( 'Feed Subscription' ); ?>" href="<?php echo get_category_feed_link($category_id) ?>"><i class="fa fa-rss"></i></a>
			<?php endif; ?>
			
			<div class="stripe-line"></div>

			<?php
			if( tie_get_option( 'category_desc' ) ):	
				$category_description = category_description();
				if ( ! empty( $category_description ) )
				echo '<div class="clear"></div><div class="archive-meta">' . $category_description . '</div>';
			endif;
			?>
		</div>
		
		<?php get_template_part( 'framework/parts/slider-category' ); ?>
		
		<?php $loop_layout = ( !empty( $cat_options[ 'category_layout' ] ) ? $cat_options[ 'category_layout' ] :  tie_get_option( 'category_layout' ) );	?>
		
		<?php get_template_part( 'loop' );	?>
		
		<?php if ($wp_query->max_num_pages > 1) tie_pagenavi(); ?>
		
	</div> <!-- .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>