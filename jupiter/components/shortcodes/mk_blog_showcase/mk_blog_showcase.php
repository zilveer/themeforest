<?php
	$phpinfo =  pathinfo( __FILE__ );
	$path = $phpinfo['dirname'];
	include( $path . '/config.php' );

	$output = '';
	$id = uniqid();
	$query = array(
		'post_type' => 'post',
		'posts_per_page' => 3,
		'ignore_sticky_posts' => 1
	);
	if ( $cat ) {
		$query['cat'] = $cat;
	}
	if ( $author ) {
		$query['author'] = $author;
	}
	if ( $offset ) {
		$query['offset'] = $offset;
	}
	if ( $posts ) {
		$query['post__in'] = explode( ',', $posts );
	}
	if ( $orderby ) {
		$query['orderby'] = $orderby;
	}
	if ( $order ) {
		$query['order'] = $order;
	}

	$r = new WP_Query( $query );


	$output .= '<div class="mk-blog-showcase '.$el_class.'">';
	$output .= '<ul>';

	$i = 0;
	if ( $r->have_posts() ):
		while ( $r->have_posts() ) :
			$r->the_post();
		$i++;

	$featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), 'blog-showcase', 260, 180, $crop = true, $dummy = true);

	$first_el_class = $i == 1 ? 'mk-blog-first-el' : '';

	$output .= '<li class="'.$first_el_class.'">';
	$output .= '<div class="mk-blog-showcase-thumb">
					<div class="showcase-blog-overlay"></div>
						<a href="' . esc_url( get_permalink() ) . '">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-jupiter-icon-plus-circle').'</a>
						<img src="'.$featured_image_src['dummy'].'" '.$featured_image_src['data-set'].' alt="'.the_title_attribute(array('echo' => false)).'" title="'.the_title_attribute(array('echo' => false)).'" />
					</div>';
	$output .= '<div class="blog-showcase-extra-info">';
	$output .='<time datetime="'.get_the_date('Y-m-d').'">';
	$output .='<a href="'.get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ).'">'.get_the_date().'</a>';
	$output .='</time>';
	$output .= '<a class="blog-showcase-title" href="' . esc_url( get_permalink() ) . '">'.get_the_title().'</a><div class="clearboth"></div>';
	if($excerpt_length != 0) {
		ob_start();
		mk_excerpt_max_charlength($excerpt_length);
		$output .= '<div class="the-excerpt">' . ob_get_clean() . '</div>';
	}
	$output .='<a href="' . esc_url( get_permalink() ) . '" class="blog-showcase-more">'.__( 'Read more' , 'mk_framework' ).'<i class="mk-icon-double-angle-right"></i></a>';
	$output .= '</div>';

	$output .= '</li>';

	endwhile;
	wp_reset_query();
	endif;


	$output .= '<div class="clearboth"></div></ul></div>';
	echo $output;
