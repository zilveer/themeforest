<?php 
/*
Template Name: Media Page
*/
?>
<?php get_header(); ?>
	<div id="media-page" class="content">
		<?php tie_breadcrumbs() ?>
		
		<?php if( get_query_var('page') ) $paged = get_query_var('page') ; ?>

		<?php if ( ! have_posts() ) : ?>
			<?php get_template_part( 'framework/parts/not-found' ); ?>
		<?php endif; ?>
		
		<div class="page-head">
			<h1 class="page-title">
				<?php the_title(); ?>
			</h1>
		</div>
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php $get_meta = get_post_custom($post->ID);  ?>
		<?php get_template_part( 'framework/parts/post-head' ); ?>
		<div class="entry"><?php the_content(); ?></div>
		<?php endwhile; ?>
		
		<?php //Above Post Banner
		if( empty( $get_meta["tie_hide_above"][0] ) ){
			if( !empty( $get_meta["tie_banner_above"][0] ) ) echo '<div class="e3lan e3lan-post">' .do_shortcode( htmlspecialchars_decode($get_meta["tie_banner_above"][0]) ) .'</div>';
			else tie_banner('banner_above' , '<div class="e3lan e3lan-post">' , '</div>' );
		}
		?>
		
		<?php
			$tie_blog_cats = unserialize($get_meta["tie_blog_cats"][0]);
			if( empty( $tie_blog_cats ) ) $tie_blog_cats = tie_get_all_category_ids();
			
			query_posts( array( 'paged' => $paged , 'category__in' => $tie_blog_cats ));
		?>
		<div id="featured-posts">
		<?php $i = 0;
			while ( have_posts() ) : the_post(); $i++; ?>
			<div class="featured-post featured-post-<?php echo $i; ?>">
				<div <?php tie_post_class('featured-post-inner'); ?> style="background-image:url(<?php echo tie_thumb_src( 'slider' ); ?>);">
					<span class="fa overlay-icon"></span>
					<div class="featured-cover"><a href="<?php the_permalink(); ?>"></a></div>
					<div class="featured-title">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<h3><?php echo tie_content_limit( get_the_excerpt() , 100 ) ?></h3>
					</div>
				</div>
			</div>
			<?php if( $i == 5) $i=0;
			endwhile;?>
		</div>
		<?php
			if ($wp_query->max_num_pages > 1) tie_pagenavi(); ?>
		
		<?php //Below Post Banner
		if( empty( $get_meta["tie_hide_below"][0] ) ){
			if( !empty( $get_meta["tie_banner_below"][0] ) ) echo '<div class="e3lan e3lan-post">' .do_shortcode( htmlspecialchars_decode($get_meta["tie_banner_below"][0]) ).'</div>';
			else tie_banner('banner_below' , '<div class="e3lan e3lan-post">' , '</div>' );
		}
		?>
		
		<?php comments_template( '', true ); ?>
	</div><!-- .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>