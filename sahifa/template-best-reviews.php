<?php 
/*
Template Name: Best Reviews
*/
?>
<?php get_header(); ?>
	<div class="content">
		<?php tie_breadcrumbs() ?>
				
		<?php if ( ! have_posts() ) : ?>
			<?php get_template_part( 'framework/parts/not-found' ); ?>
		<?php endif; ?>

		<?php $get_meta = get_post_custom($post->ID);  ?>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php //Above Post Banner
		if( empty( $get_meta["tie_hide_above"][0] ) ){
			if( !empty( $get_meta["tie_banner_above"][0] ) ) echo '<div class="e3lan e3lan-post">' .do_shortcode( htmlspecialchars_decode($get_meta["tie_banner_above"][0]) ).'</div>';
			else tie_banner('banner_above' , '<div class="e3lan e3lan-post">' , '</div>' );
		}
		?>
		
		<article <?php post_class('post-listing post'); ?>>
			<?php get_template_part( 'framework/parts/post-head' ); ?>
			<div class="post-inner">
				<h1 class="name post-title entry-title" itemprop="name"><?php the_title(); ?></h1>
				<p class="post-meta"></p>
				<div class="clear"></div>
				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __ti( 'Pages:' ), 'after' => '</div>' ) ); ?>

					<ul class="best-reviews">
					<?php
						$tie_blog_cats = unserialize($get_meta["tie_blog_cats"][0]);
						if( empty( $tie_blog_cats ) ) $tie_blog_cats = tie_get_all_category_ids();
						
						$num_posts = $get_meta["tie_posts_num"][0];
						$counter = 0;

						$original_post = $post;
						$cat_query = new WP_Query(array('category__in' => $tie_blog_cats , 'posts_per_page' => $num_posts, 'orderby' => 'meta_value_num' ,  'meta_key' => 'taq_review_score', 'post_status' => 'publish', 'no_found_rows' => 1 ));
						while ( $cat_query->have_posts() ) : $cat_query->the_post(); $counter++ ;?>
					<li <?php tie_post_class(''); ?>>
						<div class="best-review-score-image">
							<span class="best-review-score" ><?php echo $counter ?></span>
							<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail('thumbnail');  ?>
									<span class="fa overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
							<?php endif; ?>
						</div>
						<div class="best-reviews-content">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php tie_get_score( false , 'large' ); ?>
							<div class="clear"></div>
							<p class="post-meta">
								<span class="post-meta-author"><i class="fa fa-user"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title=""><?php echo get_the_author() ?> </a></span>
								<?php tie_get_time() ?>
								<span class="post-cats"><i class="fa fa-folder"></i><?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
							</p>
						</div>
					</li>
					<?php endwhile;
						$post = $original_post;
						wp_reset_query();
					?>
					</ul>
					<?php edit_post_link( __ti( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry /-->	
				<span style="display:none" class="updated"><?php the_time( 'Y-m-d' ); ?></span>

			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
		<?php endwhile; ?>
		
		<?php //Below Post Banner
		if( empty( $get_meta["tie_hide_below"][0] ) ){
			if( !empty( $get_meta["tie_banner_below"][0] ) ) echo '<div class="e3lan e3lan-post">' .do_shortcode( htmlspecialchars_decode($get_meta["tie_banner_below"][0]) ) .'</div>';
			else tie_banner('banner_below' , '<div class="e3lan e3lan-post">' , '</div>' );
		}
		?>
		<?php comments_template( '', true ); ?>
	</div><!-- .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>