<?php
$grid_link = $grid_layout_mode = $title = $filter= '';
$posts = array();
extract(shortcode_atts(array(
    'el_class'     => '',
    'style'        => 'classic',
    'no'           => '4',
    'cols'         => 'four',
    'loop'         => ''
), $atts));
if(empty($loop)) return;

    // Check pagination

    $pagination = ( $cols == 'four' && $no > 4 ) || ( $cols == 'three' && $no > 3 ) || ( $cols == 'two' && $no > 2 );

	$output = '<div class="krown-latest-posts ' . $style . ($el_class != '' ? ' ' . $el_class : '') . ( $pagination ? ' carousel" data-visible="' . $cols . '"' : ' no-carousel"' ) .  '>';

    if ( $pagination ) {
        $output .= '<div class="post-nav"><a class="btn-prev" href="#"></a><a class="btn-next" href="#"></a></div>';
    }

	$output .= '<div class="inner">
	
	<ul class="posts-grid clearfix' . ( $style == 'classic' ? ' c' . $cols : '' ) . '">';


$this->getLoop( $loop );
$my_query = $this->query;
$args = $this->loop_args;

$args['posts_per_page'] = $no;

$paged_string = is_home() || is_front_page() ? 'page' : 'paged';
$paged = get_query_var( $paged_string ) ? get_query_var( $paged_string ) : 1;

$args['paged'] = $paged;

$all_posts = new WP_Query( $args );

while( $all_posts->have_posts() ) { 

    $all_posts->the_post();
    $post_id = get_the_ID();

    $post_format = get_post_format() == '' ? 'standard' : get_post_format(); 
    $title_permalink = ( $post_format == 'link' ) ? get_post_meta( $post_id, 'krown_post_link', true ) : get_permalink();
    $title_string = ( $post_format == 'quote' ) ? get_post_meta( $post_id, 'krown_post_quote_1', true ) : get_the_title(); 

    $output .= '<li class="item">';

    // Get proper thumb size

    if ( $style == 'list' ) {
		$retina = krown_retina();
    	$img_size = $retina === 'true' ? array( 800, 400 ) : array( 400, 200 );
    } else {
    	$img_size = krown_portfolio_thumbnails_size( $style, $cols );
    }

    if ( has_post_thumbnail() ) {

	    $thumb = get_post_thumbnail_id();
	    $img_url = wp_get_attachment_url( $thumb, 'full' );  
	    $image = aq_resize( $img_url, $img_size[0], $img_size[1], true, false );

    } else {

    	$image = aq_resize( get_template_directory_uri() . '/images/blank_2.gif', $img_size[0], $img_size[1], true, false );

    }

    if ( $style == 'list' ) {

    	$output .= '<a href="' . $title_permalink . '" class="item-link">';

	    $output .= '<span class="post-img-link ' . $post_format . ( has_post_thumbnail() ? ' no-icon' : '' ) . '" style="background-image:url(' . $image[0] . ')"></span>';

	    $output .= '<div class="content clearfix">
	    	<h3>' . $title_string . '</h3>
			<span class="comments krown-icon-comment-1">' . get_comments_number( '0', '1', '%' ) . '</span>
			<time class="time" pubdate datetime="' . get_the_time( 'c' ) . '"><span class="l">' . get_the_time( __( 'F j, Y', 'krown' ) ) . '</span><span class="s">' . get_the_time( __( 'm/j/y', 'krown' ) ) . '</span></time>
		</div>';

		$output .= '</a>';

    } else {

	    $output .= '<a href="' . $title_permalink . '" class="post-img-link ' . $post_format . ( has_post_thumbnail() ? ' no-icon' : '' ) . '"><img class="post-img" src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . get_the_title() . '" /></a>';

	    $output .= '<a href="' . $title_permalink . '"><h3>' . $title_string . '</h3></a>
		<time pubdate datetime="' . get_the_time( 'c' ) . '">' . get_the_time( __( 'F j, Y', 'krown' ) ) . '</time>';

		$output .= '<p>' . krown_excerpt( 'krown_excerptlength_post' ) . '</p>';

    }

	$output .= '</li>';

}
wp_reset_query();

$output .= '</ul>';

    $output .= '</div></div>';

echo $output;

//$el_class = $this->getExtraClass( $el_class );