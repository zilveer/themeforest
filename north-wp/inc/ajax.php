<?php
add_action("wp_ajax_nopriv_thb_ajax", "load_more_posts");
add_action("wp_ajax_thb_ajax", "load_more_posts");

function load_more_posts() {
	$count = $_POST['count'];
	$page = $_POST['page'];
	$blog_type = $_POST['style'];
	
	  $args = array(
  		'paged'	=> $page,
  		'post_status' => 'publish'
	  );
	
	$query = new WP_Query( $args );
	if ($query->have_posts()) :  while ($query->have_posts()) : $query->the_post(); ?>
		<?php if ($blog_type == 'style1') { ?>
			<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('post style1'); ?> id="post-<?php the_ID(); ?>" role="article">
				<header class="post-title">
					<h2 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				</header>
				<?php get_template_part( 'inc/postformats/post-meta' ); ?>
				<div class="row align-center">
					<div class="small-12 medium-10 large-9 columns">
						<?php
							set_query_var( 'masonry', false );
							set_query_var( 'grid', false );
							get_template_part( 'inc/postformats/standard' );
						?>
					</div>
					<div class="small-12 medium-8 large-6 columns post-content text-center">
						<?php the_excerpt(); ?>
						<a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Read More', 'north' ); ?></a>
					</div>
				</div>
			</article>
		<?php } else if ($blog_type == 'style2') { ?>
			<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('small-12 medium-6 large-4 item post columns'); ?> id="post-<?php the_ID(); ?>" role="article">
				<?php 
					set_query_var( 'masonry', true );
					set_query_var( 'grid', false );
					get_template_part( 'inc/postformats/standard' );
				?>
				<header class="post-title">
					<h2 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				</header>
				<?php get_template_part( 'inc/postformats/post-meta' ); ?>
				
				<div class="post-content bold-text">
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Read More', 'north' ); ?></a>
				</div>
			</article>
		<?php } else if ($blog_type == 'style3') { ?>
			<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('small-12 medium-6 large-4 item post columns'); ?> id="post-<?php the_ID(); ?>" role="article">
				<?php 
					set_query_var( 'masonry', false );
					set_query_var( 'grid', true);
					get_template_part( 'inc/postformats/standard' );
				?>
				<header class="post-title">
					<h2 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				</header>
				<?php get_template_part( 'inc/postformats/post-meta' ); ?>
				
				<div class="post-content bold-text">
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Read More', 'north' ); ?></a>
				</div>
			</article>
		<?php } ?>
	<?php
	endwhile; else : endif; 
	wp_die();
}

add_action("wp_ajax_nopriv_thb_product_ajax", "load_products");
add_action("wp_ajax_thb_product_ajax", "load_products");

function load_products() {
	$type = isset($_POST['type']) ? $_POST['type'] : "latest-products"; 
	$footer_products_count = ot_get_option('footer_products_count',6);

	if ($type == "latest-products") {
		
		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'   => 1,
			'posts_per_page' => $footer_products_count,
			'no_found_rows' => true,
			'suppress_filters' => 0
		);
	} else if ($type == "featured-products") {			
		$args = array(
	    	'post_type'	=> 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' => $footer_products_count,
			'meta_query' => array(
				array(
					'key' => '_visibility',
					'value' => array('catalog', 'visible'),
					'compare' => 'IN'
				),
				array(
					'key' => '_featured',
					'value' => 'yes'
				)
			),
			'no_found_rows' => true,
			'suppress_filters' => 0
		);
	} else if ($type == "best-sellers") {
		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'   => 1,
			'posts_per_page' => $footer_products_count,
			'meta_key' 		 => 'total_sales',
			'orderby' 		 => 'meta_value',
			'meta_query' => array(
				array(
					'key' => '_visibility',
					'value' => array( 'catalog', 'visible' ),
					'compare' => 'IN'
				)
			),
			'no_found_rows' => true,
			'suppress_filters' => 0
		);
	} else {
		$category = get_term_by('id',$type,'product_cat'); 
		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'   => 1,
			'product_cat' => $category->slug,
			'posts_per_page' => $footer_products_count,
			'no_found_rows' => true,
			'suppress_filters' => 0
		);		
	}
	$products = new WP_Query( $args );
	

	$catalog_mode = ot_get_option('shop_catalog_mode', 'off');
	
	
	if ( $products->have_posts() ) { ?>
		<div class="carousel products slick" data-columns="6" data-navigation="true" data-loop="true">	
	    <?php while ( $products->have_posts() ) { $products->the_post(); ?>
	    	<?php wc_get_template_part( 'content', 'product' ); ?>
	    <?php } ?>
	    
		</div>
		<div class="ai-dotted ai-indicator"><span class="ai-inner1"></span><span class="ai-inner2"></span><span class="ai-inner3"></span></div>
	<?php
	}
	wp_reset_query();
	wp_reset_postdata();
	wp_die();
}