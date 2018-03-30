<?php
/**
 * Template Name: EDD Store Front
 */
$store_page_setting = (is_front_page() && is_page_template('edd-store-front.php') ? 'page' : 'paged' );
$current_page = get_query_var( $store_page_setting );
$per_page = intval( get_theme_mod( 'bwpy_store_front_count', 9 ) );
$offset = $current_page > 0 ? $per_page * ( $current_page-1 ) : 0;
$product_args = array(
	'post_type'		=> 'download',
	'posts_per_page'	=> $per_page,
	'offset'		=> $offset
);
$products = new WP_Query( $product_args );

$show_excerpt = true;
$show_buy_btn = true;
$width = 'col-sm-3';
$columns = '4';
if ( isset($sf_options['edd_display_columns']) ) {
	$columns = $sf_options['edd_display_columns'];
}
if ($columns == "4") {
	$width = 'col-sm-3';
} else if ($columns == "5") {
	$width = 'col-sm-sf-5';
} else if ($columns == "3") {
	$width = 'col-sm-4';
} else if ($columns == "2") {
	$width = 'col-sm-6';
} else if ($columns == "6") {
	$width = 'col-sm-2';
} else if ($columns == "1") {
	$width = 'col-sm-12';
}
$thumb_width = 500;
$thumb_height = 350;
if ( isset($sf_options['edd_thumb_width']) ) {
	$thumb_width = $sf_options['edd_thumb_width'];
}
if ( isset($sf_options['edd_thumb_height']) ) {
	$thumb_height = $sf_options['edd_thumb_height'];
}


get_header(); ?>

<div id="edd-grid" class="container">
	<?php if ( $products->have_posts() ) : $i = 1; ?>
		<div class="store-info">
			<?php the_content(); ?>
		</div>
		<div class="product-grid download-grid clearfix">
			<?php while ( $products->have_posts() ) : $products->the_post();?>	
				<div class="<?php echo $width; ?> download-item">
					<?php if ( has_post_thumbnail() ) {
						$thumb_image   = get_post_thumbnail_id();
						$thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
						$image = sf_aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false );	
						$image_meta = sf_get_attachment_meta( $thumb_image );
						$image_alt = "";
						if ( isset($image_meta) ) {
							$image_alt 			= esc_attr( $image_meta['alt'] );
						}
					?>
					<div class="figure-wrap">
						<figure class="animated-overlay">
							<a href="<?php the_permalink(); ?>"></a>
							<div class="img-wrap">
								<img itemprop="image" src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php echo $image_alt; ?>" />
							</div>
							<div class="figcaption-wrap"></div>
							<figcaption>
							    <div class="thumb-info thumb-info-alt">
							        <?php echo apply_filters( 'sf_next_icon' , '<i class="ss-navigateright"></i>' ); ?>
							    </div>
							</figcaption>
						</figure>
					</div>
					<?php } ?>
					<div class="product-description">
						<h3><a class="product-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php if ( $show_excerpt ) : // show downloads description? ?>
							<div class="product-info">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
						<?php if ( $show_buy_btn ) :
							echo do_shortcode('[purchase_link]');
						endif; ?>
					</div>
				</div>
	
				<?php $i+=1; ?>
			<?php endwhile; ?>
		</div>			
		<div class="store-pagination">
			<?php 					
				$big = 999999999; // need an unlikely intege					
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, $current_page ),
					'total' => $products->max_num_pages
				) );
			?>
		</div>
	<?php else : ?>
	
		<div class="col-sm-12">
			<h2><?php _e( 'Not Found', 'swiftframework' ); ?></h2>
			<p><?php _e( 'Sorry, but you are looking for something that isn\'t here. Please search or use the browser\'s back button.', 'swiftframework' ); ?></p>
			<form method="get" class="search-form" action="<?php echo home_url(); ?>/">
		   	<input type="text" placeholder="<?php _e( "Search", "swiftframework" ); ?>" name="s"/>
			</form>
		</div>
	<?php endif; ?>
</div>

<?php get_footer(); ?>