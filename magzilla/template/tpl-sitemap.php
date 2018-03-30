<?php 
/**
 * Template Name: Sitemap
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/ 
global $fave_container;

get_header(); ?>

<div class="<?php echo $fave_container; ?>">
		
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="page-header">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>		
		</div><!-- col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
	</div><!-- row -->

	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<main class="site-main" role="main">
				<div class="sitemap">
					
					<div class="page-entry">
						<?php while( have_posts()): the_post(); ?>

							<?php the_content(); ?>
				        
				        <?php endwhile; ?>
					</div>

					<div class="row">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<h2><?php _e( 'Pages', 'magzilla' ); ?></h2>
							<ul>
								<?php $args = array(
									'authors'      => '',
									'child_of'     => 0,
									'date_format'  => get_option('date_format'),
									'depth'        => 0,
									'echo'         => 1,
									'exclude'      => '',
									'include'      => '',
									'link_after'   => '',
									'link_before'  => '',
									'post_type'    => 'page',
									'post_status'  => 'publish',
									'show_date'    => '',
									'sort_column'  => 'menu_order, post_title',
								    'sort_order'   => '',
									'title_li'     => '', 
									//'walker'       => new Walker_Page
								); ?>
								<?php wp_list_pages( $args ); ?>
							</ul>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<h2><?php _e( 'Categories', 'magzilla' ); ?></h2>
							<ul>
								<?php 
								    $args = array(
									'show_option_all'    => '',
									'orderby'            => 'name',
									'order'              => 'ASC',
									'style'              => 'list',
									'show_count'         => 1,
									'hide_empty'         => 1,
									'use_desc_for_title' => 1,
									'child_of'           => 0,
									'feed'               => '',
									'feed_type'          => '',
									'feed_image'         => '',
									'exclude'            => '',
									'exclude_tree'       => '',
									'include'            => '',
									'hierarchical'       => 1,
									'title_li'           => '',
									'show_option_none'   => '',
									'number'             => null,
									'echo'               => 1,
									'depth'              => 0,
									'current_category'   => 0,
									'pad_counts'         => 0,
									'taxonomy'           => 'category',
									'walker'             => null
								    );
								    wp_list_categories( $args ); 
								?>
							</ul>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<h2><?php _e( 'Recent Articles', 'magzilla' ); ?></h2>
							<ul>
								<?php $args = array(
									'type'            => 'postbypost',
									'limit'           => '',
									'format'          => 'html', 
									'before'          => '',
									'after'           => '',
									'show_post_count' => true,
									'echo'            => 1,
									'order'           => 'DESC'
								); ?>
								<?php wp_get_archives( $args ); ?> 
							</ul>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<h2><?php _e( 'Archives', 'magzilla' ); ?></h2>
							<ul>
								<?php $args = array(
									'type'            => 'monthly',
									'limit'           => '',
									'format'          => 'html', 
									'before'          => '',
									'after'           => '',
									'show_post_count' => true,
									'echo'            => 1,
									'order'           => 'DESC'
								); ?>
								<?php wp_get_archives( $args ); ?> 
							</ul>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<h2><?php _e( 'Galleries', 'magzilla' ); ?></h2>
							<ul>
								<?php 
								    $args = array(
									'show_option_all'    => '',
									'orderby'            => 'name',
									'order'              => 'ASC',
									'style'              => 'list',
									'show_count'         => 1,
									'hide_empty'         => 1,
									'use_desc_for_title' => 1,
									'child_of'           => 0,
									'feed'               => '',
									'feed_type'          => '',
									'feed_image'         => '',
									'exclude'            => '',
									'exclude_tree'       => '',
									'include'            => '',
									'hierarchical'       => 1,
									'title_li'           => '',
									'show_option_none'   => '',
									'number'             => null,
									'echo'               => 1,
									'depth'              => 0,
									'current_category'   => 0,
									'pad_counts'         => 0,
									'taxonomy'           => 'gallery-categories',
									'walker'             => null
								    );
								    wp_list_categories( $args ); 
								?>
							</ul>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<h2><?php _e( 'Videos', 'magzilla' ); ?></h2>
							<ul>
								<?php 
								    $args = array(
									'show_option_all'    => '',
									'orderby'            => 'name',
									'order'              => 'ASC',
									'style'              => 'list',
									'show_count'         => 1,
									'hide_empty'         => 1,
									'use_desc_for_title' => 1,
									'child_of'           => 0,
									'feed'               => '',
									'feed_type'          => '',
									'feed_image'         => '',
									'exclude'            => '',
									'exclude_tree'       => '',
									'include'            => '',
									'hierarchical'       => 1,
									'title_li'           => '',
									'show_option_none'   => '',
									'number'             => null,
									'echo'               => 1,
									'depth'              => 0,
									'current_category'   => 0,
									'pad_counts'         => 0,
									'taxonomy'           => 'video-categories',
									'walker'             => null
								    );
								    wp_list_categories( $args ); 
								?>
							</ul>
						</div>
					</div>
				</div><!-- archive authors-archive -->
			</main><!-- site-main -->
		</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-12 -->
	</div><!-- .row -->


</div>

<?php get_footer(); ?>