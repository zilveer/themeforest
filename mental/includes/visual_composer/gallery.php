<?php

function get_vcm_mental_gallery_categories() {
	$gallery_categories_raw = get_terms( 'gallery_category', 'orderby=name&hide_empty=0' );
	$gallery_categories     = array( '' => '' );
	foreach ( $gallery_categories_raw as $gallery_category ) {
		$gallery_categories[ $gallery_category->name ] = $gallery_category->term_id;
	}

	return $gallery_categories;
}

add_filter( 'vc_before_init', 'register_vcm_mental_custom_gallery' );
function register_vcm_mental_custom_gallery() {
	vc_map( array(
		'icon'            => 'vcm-mental-gallery',
		'name'            => __( 'Mentas Gallery', 'mental' ),
		"base"            => "vcm_mental_gallery", // bind with our shortcode
		"content_element" => true, // set this parameter when element will has a content
		//"is_container" => true, // set this param when you need to add a content element in this element
		"category"        => __( 'Mentas Elements' ),
		// Here starts the definition of array with parameters of our compnent
		"params"          => array(
			array(
				'type'       => 'dropdown',
				'param_name' => 'category',
				'heading'    => __( 'Gallery category', 'mental' ),
				'value'      => get_vcm_mental_gallery_categories()
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'type',
				'heading'    => __( 'Gallery type', 'mental' ),
				'value'      => array(
					'Expanding' => 'expanding',
					'Normal'    => 'normal',
					'Pinterest' => 'pinterest',
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'load_on_scroll',
				'heading'    => __( 'Load new items on scroll (infinite scroll)', 'mental' ),
				'value'      => array(
					__( 'No', 'mental' )  => 'no',
					__( 'Yes', 'mental' ) => 'yes',
				)
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_filter',
				'heading'    => __( 'Show filters panel', 'mental' ),
				'value'      => array(
					__( 'Yes', 'mental' ) => 'yes',
					__( 'No', 'mental' )  => 'no',
				)
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'filter_align',
				'heading'    => __( 'Filter align', 'mental' ),
				'value'      => array(
					'Left'   => 'left',
					'Center' => 'center',
					'Right'  => 'right',
				)
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_load_more',
				'heading'    => __( 'Show load more', 'mental' ),
				'value'      => array(
					__( 'Yes', 'mental' ) => 'yes',
					__( 'No', 'mental' )  => 'no',
				)
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'fixed_items',
				'heading'    => __( 'Fixed images ratio', 'mental' ),
				'value'      => array(
					__( 'No', 'mental' )  => 'no',
					__( 'Yes', 'mental' ) => 'yes',
				)
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'items_per_page',
				'heading'    => __( 'Items per page', 'mental' )
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'columns_count',
				'heading'    => __( 'Columns count', 'mental' ),
				'value'      => array(
					3,
					4,
					5
				)
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'columns_count_sm',
				'heading'    => __( 'Columns count on small device', 'mental' ),
				'value'      => array(
					1,
					2
				)
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'preview_full_size',
				'heading'    => __( 'Show full size preview', 'mental' ),
				'value'      => array(
					__( 'No', 'mental' )  => 'no',
					__( 'Yes', 'mental' ) => 'yes',
				)
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'item_padding',
				'heading'    => __( 'Item padding', 'mental' ),
				'value'      => '0'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'orderby',
				'heading'    => __( 'Sort retrieved posts by parameter. Defaults to \'date (post_date)\'.', 'mental' ),
				'value'      => array(
					'No order'                       => 'none',
					'Order by post id'               => 'ID',
					'Order by author'                => 'author',
					'Order by title'                 => 'title',
					'Order by post name (post slug)' => 'name',
					'Order by date'                  => 'date',
					'Order by last modified date'    => 'modified',
					'Random order'                   => 'rand',
					'Order by number of comments'    => 'comment_count',
				)
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'order',
				'heading'    => __( 'Designates the ascending or descending order of the \'orderby\' parameter.', 'mental' ),
				'value'      => array(
					'ASC'  => 'ASC',
					'DESC' => 'DESC',
				)
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'id',
				'heading'    => __( 'Gallery ID', 'mental' )
			),
		)
	) );
}

add_shortcode( 'vcm_mental_gallery', 'vcm_mental_gallery_shortcode' );
function vcm_mental_gallery_shortcode( $atts, $content = null ) {

	$atts = shortcode_atts( array(
		'id'                    => 'gallery-' . rand( 1, 999 ),
		'category'              => '',
		'type'                  => get_mental_option( 'gallery_type' ),
		'items_per_page'        => get_mental_option( 'gallery_items_per_page' ),
		'columns_count'         => get_mental_option( 'gallery_columns_count' ),
		'columns_count_sm'         => '1',
		'show_load_more'        => 'yes',
		'show_filter'           => 'yes',
		'filter_align'          => 'left',
		'fixed_items'           => get_mental_option( 'gallery_fixed_items' ),
		'load_on_scroll'        => 'no',
		'preview_full_size'     => get_mental_option( 'gallery_preview_full_size' ) ? 'yes' : 'no',
		'preview_show_zoom'     => get_mental_option( 'gallery_preview_show_zoom' ) ? 'yes' : 'no',
		'preview_show_readmore' => get_mental_option( 'gallery_preview_show_readmore' ) ? 'yes' : 'no',
		'preview_show_share'    => get_mental_option( 'gallery_preview_show_share' ) ? 'yes' : 'no',
		'ajax_action'           => 'mental_gallery',
		'item_padding'          => '0',
		'orderby'               => 'date',
		'order'                 => 'DESC',
	), $atts, 'vcm_mental_gallery' );
	//print_r($atts);die();
	if ( ! empty( $atts['category'] ) ) {
		$filters = azl_get_category_tags( $atts['category'], 'gallery_filter', 'gallery_category' );
	} else {
		$filters = get_terms( "gallery_filter", array() );
	}

	ob_start();
	?>

	<?php if ( ! empty( $filters ) && $atts['show_filter'] == 'yes' ): ?>

		<ul class="gallery-filters" data-gallery-id="<?php echo esc_attr( $atts['id'] ); ?>"
		    style="text-align: <?php echo esc_attr( $atts['filter_align'] ); ?>">
			<li class="active filter-item  all-filter_s"><a data-filter="*" href="#"><?php _e( 'All', 'mental' ) ?></a></li>
			<?php
$i = 0;	
$j = 0;	
			?>
			<?php foreach ( $filters as $filter ): //if ($category->slug == 'uncategorized') continue; {{
				

				?>
				<li class="filter-item item-filter  " data-fl="filter<?php echo $i++; ?>" data-content="content<?php echo $j++; ?>"><a data-filter="<?php echo esc_attr( $filter->slug ) ?>"
				       href="#"><?php echo esc_html( $filter->name ); ?></a></li>
			<?php endforeach ?>
			<li class="gf-underline"></li>
		</ul>

	<?php endif ?>
    <div class="gallery-home active" data-amount="<?php echo esc_attr( $atts['items_per_page'] ); ?>">
        <ul id="<?php echo esc_attr( $atts['id'] ); ?>"
            class="gallery gallerys gallery-home-inner  sm-cols-<?php echo esc_attr( $atts['columns_count_sm'] ); ?> gl-cols-<?php echo esc_attr( $atts['columns_count'] ); ?> <?php echo ( $atts['type'] == 'pinterest' ) ? 'gl-pinterest' : '' ?>"
            data-options="<?php echo esc_attr( azl_serialize_atts( $atts ) ); ?>" >
            <?php vcm_mental_gallery_loop( 0, $atts ) ?>
        </ul> <!-- gallery -->
    </div>
	<?php if ( $atts['load_on_scroll'] == 'yes' ): ?>
		<div id="scload" class="load-more-block dark  loadmore lmb-on-scroll">
			<span class="loading-spinner"></span>
			<span class="no-more-items-sign"><?php _e( 'No more items', 'mental' ) ?></span>
		</div>
	<?php endif ?>

	<?php if ( $atts['show_load_more'] == 'yes' && $atts['load_on_scroll'] == 'no' ): ?>
		<div id="load-more-block" class="load-more-block dark loadmore">
			<a href="#"  class="load-more-button load-more-button2"
			   data-gallery-id="<?php echo esc_attr( $atts['id'] ); ?>"><?php _e( 'Load more', 'mental' ) ?></a>
			<span class="loading-spinner"></span>
			<span id="item-more"  class="no-more-items-sign "><?php _e( 'No more items', 'mental' ) ?></span>
		</div>
	<?php endif ?>

	<?php
	return ob_get_clean();
}


function vcm_mental_gallery_loop( $offset, $atts ) {

	$atts = shortcode_atts( array(
		'category'              => '',
		'type'                  => get_mental_option( 'gallery_type' ),
		'items_per_page'        => get_mental_option( 'gallery_items_per_page' ),
		'fixed_items'           => get_mental_option( 'gallery_fixed_items' ),
		'preview_full_size'     => get_mental_option( 'gallery_preview_full_size' ) ? 'yes' : 'no',
		'preview_show_zoom'     => get_mental_option( 'gallery_preview_show_zoom' ) ? 'yes' : 'no',
		'preview_show_readmore' => get_mental_option( 'gallery_preview_show_readmore' ) ? 'yes' : 'no',
		'preview_show_share'    => get_mental_option( 'gallery_preview_show_share' ) ? 'yes' : 'no',
		'item_padding'          => '0',
		'orderby'               => 'date',
		'order'                 => 'DESC',
	), $atts, 'vcm_mental_gallery' );

	$paged = ceil( $offset / $atts['items_per_page'] ) + 1;

	// Can work with or ID or Slug
	if ( intval( $atts['category'] ) ) {
		$tax_field = "term_id";
	} else {
		$tax_field = "slug";
	}

	if ( ! empty( $atts['category'] ) ) {
		$tax_query = array(
			array(
				'taxonomy' => 'gallery_category',
				'terms'    => $atts['category'],
				'field'    => $tax_field,
			)
		);
	} else {
		$tax_query = '';
	}

	query_posts( array(
		'post_type'      => 'gallery',
		'tax_query'      => $tax_query,
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'paged'          => $paged,
		'orderby'        => $atts['orderby'],
		'order'          => $atts['order']
	) );
	?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php // Get categories
		$post_filters = wp_get_post_terms( get_the_ID(), 'gallery_filter' );
		$filt_names   = array();
		$filt_slugs   = array();

		foreach ( $post_filters as $post_filter ) {
			$filt_names[] = $post_filter->name;
			$filt_slugs[] = $post_filter->slug;
		}
		$item_meta = get_post_meta( get_the_ID(), 'gallery_item', true );
		?>
		<li class="gl-item gallery-item gallery-item_s  gallery-item-anime  gl-loading <?php if ( ! empty( $item_meta['double_size'] ) && $atts['type'] != 'expanding' ) {
			echo 'gl-double';
		} ?>
         <?php echo ( ( $atts['fixed_items'] == 'fixed' || $atts['type'] == 'expanding' ) && 'pinterest' != $atts['type'] ) ? 'gl-fixed-ratio-item' : '' ?>"
		    data-category="<?php echo implode( ', ', $filt_slugs ) ?>"
		    style="padding: <?php echo esc_attr( $atts['item_padding'] ) . 'px'; ?>">

			<a href="<?php the_permalink() ?>">
				<figure>
					<?php if ( has_post_thumbnail() ): ?>
						<?php
						if ( class_exists( 'MultiPostThumbnails' ) && MultiPostThumbnails::has_post_thumbnail( get_post_type(), 'additional_thumbnail' ) ) :
							MultiPostThumbnails::the_post_thumbnail( get_post_type(), 'additional_thumbnail' );
						else:
							the_post_thumbnail( 'medium', array( 'alt' => '' ) );
						endif;
						?>
					<?php else: ?>
						<?php
						$placeholder_image = get_mental_option( 'gallery_placeholder' ); // returns an array
						if ( $placeholder_image && $placeholder_image_src = wp_get_attachment_image_src( $placeholder_image, 'medium' ) ) { ?>
							<img src="<?php echo esc_url( $placeholder_image_src[0] ); ?>" alt="slide">
						<?php } else { ?>
							<img src="http://placehold.it/700x471" alt="slide">
						<?php } ?>
					<?php endif ?>
					<figcaption>
						<div class="middle">
							<div class="middle-inner">

								<?php if ( $atts['type'] != 'pinterest' ): ?>
									<?php if ( get_post_format() == 'gallery' ): ?>
										<p class="gl-item-icon"><i class="fa fa-picture-o"></i></p>
									<?php elseif ( get_post_format() == 'video' ): ?>
										<p class="gl-item-icon"><i class="fa fa-play-circle-o"></i></p>
										<?php
									elseif ( get_post_format() == 'audio' ): ?>
										<p class="gl-item-icon"><i class="fa fa-music"></i></p>
									<?php endif ?>
								<?php endif ?>

								<p class="gl-item-title"><?php the_title(); ?></p>

								<?php if ( $atts['type'] == 'pinterest' ): ?>
									<p class="gl-item-descr"><?php the_mental_excerpt( 'mental_excerpt_length_20' ); ?></p>
								<?php else: ?>
									<p class="gl-item-category"><?php echo implode( ', ', $filt_names ) ?></p>
								<?php endif ?>

							</div>
						</div>
					</figcaption>
				</figure>
			</a>

			<?php if ( $atts['type'] == 'expanding' ): ?>

				<div class="gl-preview" style="diplay:none;" data-category="people">
					<span class="glp-arrow"></span>
					<a href="#" class="glp-close"></a>

					<?php if ( $atts['preview_full_size'] == 'yes' ): ?>

						<div class="glp-fullsize">
							<?php vcm_mental_gallery_preview( $atts, 'full' ); ?>
						</div>

					<?php else: ?>

						<div class="row gl-preview-container">
							<div class="col-sm-8 gl-preview-image">

								<?php vcm_mental_gallery_preview( $atts ); ?>

							</div>
							<div class="col-sm-4 lg-preview-descr">

								<h4><?php the_title(); ?></h4>

								<?php if ( get_post_format() == 'audio' ): ?>
									<?php the_mental_audio_excerpt( 'wp-audio-shortcode-preview' ); ?>
									<?php the_mental_playlist_excerpt( 'wp-playlist-preview' ); ?>
									<?php the_excerpt(); ?>
								<?php else: ?>
									<?php the_excerpt(); ?>
								<?php endif ?>

								<?php if ( $atts['preview_show_readmore'] == 'yes' ): ?>
									<a href="<?php the_permalink() ?>"
									   class="btn btn-primary glp-readmore"><?php _e( 'Read More', 'mental' ) ?></a>
								<?php endif ?>

								<?php if ( $atts['preview_show_share'] == 'yes' && get_mental_option( 'social_block_show' ) ): ?>
									<div class="mb-social glp-social">
										<span><?php _e( 'Share', 'mental' ) ?></span>
										<?php get_template_part( 'blocks/social-share' ) ?>
									</div>
								<?php endif ?>

							</div>
						</div>

					<?php endif ?>

				</div> <!-- gl-preview -->

			<?php endif ?>

		</li>

		<?php
	endwhile;
	wp_reset_query();
	?>
	<?php
}


function vcm_mental_gallery_preview( $atts, $preview_size = 'medium' ) {
	?>

	<?php if ( get_post_format() == 'video' && $video = get_post_video( get_the_content(), 'wp-video-shortcode-preview' ) ): ?>

		<div class="responsive-embed">
			<?php echo mental_escape_iframe( $video ); ?>
		</div>

	<?php elseif ( get_post_format() == 'gallery' && $gallery = get_post_gallery( get_the_ID(), false ) ) : // If Post gallery {?>

		<div id="carousel-<?php echo get_the_ID() ?>" class="carousel slide" data-ride="carousel">

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<?php
				$img_ids = explode( ',', $gallery['ids'] );
				$i       = 0;
				foreach ( $img_ids as $img_id ):
					?>
					<?php $img_src = wp_get_attachment_image_src( $img_id, $preview_size ) ?>
					<?php $img_full_src = wp_get_attachment_image_src( $img_id, 'full' ) ?>
					<div class="item <?php echo ( $i == 0 ) ? 'active' : '' ?>">
						<img src="<?php echo esc_url( $img_src[0] ); ?>" alt="slide">
						<?php if ( $atts['preview_show_zoom'] == 'yes' ): ?>
							<a class="glp-zoom" data-image="<?php echo esc_url( $img_full_src[0] ); ?>"><i></i></a>
						<?php endif ?>
					</div>
					<?php $i ++; endforeach ?>
			</div>
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php $i = 0;
				foreach ( $img_ids as $img_id ): ?>
					<li data-target="#carousel-<?php echo get_the_ID() ?>" data-slide-to="<?php echo (int) $i ?>"
					    class="<?php echo ( $i == 0 ) ? 'active' : '' ?>"></li>
					<?php $i ++; endforeach ?>
			</ol>

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-<?php echo get_the_ID() ?>" data-slide="prev">
				<span></span>
			</a>
			<a class="right carousel-control" href="#carousel-<?php echo get_the_ID() ?>" data-slide="next">
				<span></span>
			</a>

		</div> <!-- carousel -->

	<?php elseif ( has_post_thumbnail() ):
		$img_full_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		?>
		<figure>
			<?php the_post_thumbnail( $preview_size ) ?>
			<?php if ( $atts['preview_show_zoom'] == 'yes' ): ?>
				<a class="glp-zoom" data-image="<?php echo esc_url( $img_full_src[0] ); ?>"><i></i></a>
			<?php endif ?>
		</figure>
	<?php else: ?>
		<figure>
			<?php _e( 'No featured image selected', 'mental' ) ?>
		</figure>
	<?php endif ?>

	<?php
}