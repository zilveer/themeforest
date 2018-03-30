<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

global $post;

// Post teasers count
if ( $post_number != '' && !is_numeric($post_number) ) $post_number = -1;
if ( $post_number != '' && is_numeric($post_number) ) $post_number = $post_number;

if ( $post_columns_count=="2clm") { $post_columns_count = 'col-md-6'; }
if ( $post_columns_count=="3clm") { $post_columns_count = 'col-md-4'; }
if ( $post_columns_count=="4clm") { $post_columns_count = 'col-md-3'; }

$args = array( 
	'showposts' => $post_number,
	'category_name' => $post_categories,
	'ignore_sticky_posts' => 1
);

// Run query
$my_query = new WP_Query($args);

$post_cont_id = 'latest-posts-items-'.uniqid().'';

if ($post_layout=="grid-layout") { 
	$output .= '<div class="row'. $el_class .'">';
	$output .= '<div id="latest-posts-items" class="grid-layout">';
}
else if ($post_layout=="masonry-layout") {
	$output .= '<div class="row '. $el_class .'">';
	$output .= '<div id="'.$post_cont_id.'" class="grid-layout masonry-layout isotope">';
}
else if ($post_layout=="listed-layout") {
	$output .= '<div class="row wall-effect '. $el_class .'">';
	$output .= '<div id="latest-posts-items" class="list-layout">';
}

while($my_query->have_posts()) : $my_query->the_post();

$post_id = $my_query->post->ID;

$thumb = get_post_thumbnail_id();
if ($post_layout=="grid-layout") { 
	$img_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'latest-blog-thumb' );
}
else if ($post_layout=="masonry-layout") { 
	$img_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'latest-masonry-blog-thumb' );
}

$num_comments = get_comments_number(); 	
$comments_output = null;

if ( comments_open() ) {
	if ( $num_comments == 0 ) {
		$comments = __('No Comments', 'js_composer');
	} elseif ( $num_comments > 1 ) {
		$comments = $num_comments . __(' Comments', 'js_composer');
	} else {
		$comments = __('1 Comment', 'js_composer');
	}
	$comments_output .= '<a href="' . get_comments_link() .'">'. $comments.'</a>';
}

if ($post_layout=="grid-layout" || $post_layout=="masonry-layout") { 
	$output .= '<div class="single-item-posts '.$post_columns_count.'">';
	$output .= '<article class="post">';

	if(!empty($thumb)) {

	$output .= '<div class="post-thumb">
					<a title="'. get_the_title() .'" href="'. get_permalink($post_id) .'" class="hover-wrap">
	 			 	<img class="img-full-responsive" src="'. $img_thumb[0] .'" width="'.$img_thumb[1].'" height="'.$img_thumb[2].'" alt="'. get_the_title() .'" />
				 	<span class="overlay"><i class="font-icon-plus-3"></i></span>
				 	</a>
				</div>';
	}

	$output .= '<div class="post-name">
					<h2 class="entry-title">
				 		<a href="'. get_permalink($post_id) .'" title="'. get_the_title() .'"> '. get_the_title() .'</a>
				 	</h2>
				</div>';
				 
	$output .= '<div class="entry-content"><p>' .get_the_excerpt(). '</p></div>';

	$output .= '<div class="entry-meta entry-header">
					<span class="published">'. get_the_time( get_option('date_format') ) .'</span>
					<span class="meta-sep"> / </span>
					<span class="comment-count">'. $comments_output .'</span>
				</div>';
				
	$output .= '</article>';		

	$output .= '</div>';
} 

else if ($post_layout=="listed-layout") { 
	$output .= '<div class="single-item-posts">';
	$output .= '<article class="post">';

	$output .= '<div class="post-name">
					<h2 class="entry-title">
				 		<a href="'. get_permalink($post_id) .'" title="'. get_the_title() .'"> '. get_the_title() .'</a>
				 	</h2>
				 	<span class="line"></span>
				</div>';

	$output .= '<div class="entry-meta entry-header">
					<span class="published">'. get_the_time( get_option('date_format') ) .'</span>
					<span class="meta-sep"> / </span>
					<span class="comment-count">'. $comments_output .'</span>
					<span class="meta-sep"> / </span>
					<span class="author"><a href="'.get_author_posts_url( get_the_author_meta('ID') ).'">'.get_the_author_meta( 'display_name' ).'</a></span>
				</div>';
				
	$output .= '</article>';		

	$output .= '</div>';
}

endwhile;

wp_reset_query();

$output .= '</div>';

$output .= '</div>'. $this->endBlockComment('az_latest_posts');

if ($post_layout == 'masonry-layout') {
$output .= '
<script type="text/javascript">
jQuery(document).ready(function(){
	var container = jQuery("#'.$post_cont_id.'");

	container.imagesLoaded(function() {
		container.isotope({
		  resizable: false,
		  layoutMode: "masonry",
          itemSelector : ".single-item-posts",
          transitionDuration: 0
        });
    }).done( function( instance ) {
    	container.velocity({ opacity: 1 }, 850, "easeInOutExpo" );
  	});
});
</script>';
}


echo $output;
