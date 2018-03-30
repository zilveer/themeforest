<?php
/*-----------------------------------------------------------------------------------*/
/* Gallery
/*-----------------------------------------------------------------------------------*/

function fav_custom_post_gallery( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'post_from'			=> '',
		'category_id'		=> '',
		'sort'	  			=> '',
		'posts_limit'	  	=> '',
		'offset'	 	 	=> '',
		'gallery_title'	  	=> '',
		'module_bg' => '',
		'module_padding' => ''
    ), $atts ) );
	
	ob_start();

	$video_link = $video_duration = '';

    $wp_query_args = array(
        'ignore_sticky_posts' => 1
    );

    if( $post_from == "category_posts" ) {
	    
	    if( !empty($category_id) ) {
		    $wp_query_args['tax_query'] = array(
	            array(
	            'taxonomy' => 'gallery-categories',
	            'field' => 'term_id',
	            'terms' => $category_id,
	            )
	        );
		}
	}

	if( $post_from == "featured" ) {
            
        $wp_query_args['meta_key'] = 'fave_gallery_featured';
        $wp_query_args['meta_value'] = '1';
    }

    $current_day = date('j');

    switch ($sort) {
        
        case 'popular':
            $wp_query_args['meta_key'] = 'fave-post_views';
            $wp_query_args['orderby'] = 'meta_value_num';
            $wp_query_args['order'] = 'DESC';
            break;
        case 'review_high':
            $wp_query_args['meta_key'] = '';//td_review::$td_review_key;
            $wp_query_args['orderby'] = 'meta_value_num';
            $wp_query_args['order'] = 'DESC';
            break;
        case 'random_posts':
            $wp_query_args['orderby'] = 'rand';
            break;
        case 'alphabetical_order':
            $wp_query_args['orderby'] = 'title';
            $wp_query_args['order'] = 'ASC';
            break;
        case 'comment_count':
            $wp_query_args['orderby'] = 'comment_count';
            $wp_query_args['order'] = 'DESC';
            break;
        case 'random_today':
            $wp_query_args['orderby'] = 'rand';
            $wp_query_args['year'] = date('Y');
            $wp_query_args['monthnum'] = date('n');
            $wp_query_args['day'] = date('j');
            break;
        case 'random_7_day':
            $wp_query_args['orderby'] = 'rand';
            $wp_query_args['date_query'] = array(
                        'column' => 'post_date_gmt',
                        'after' => '1 week ago'
                        );
            break;
    }

    //custom pagination limit
    if (empty($posts_limit)) {
        $posts_limit = get_option('posts_per_page');
    }
    $wp_query_args['posts_per_page'] = $posts_limit;

    // offset
    if (!empty($offset) and $paged > 1) {
        $wp_query_args['offset'] = $offset + ( ($paged - 1) * $posts_limit) ;
    } else {
        $wp_query_args['offset'] = $offset ;
    }

    $wp_query_args['post_type'] = 'gallery';

    $the_query = new WP_Query($wp_query_args);

    $unique_key = fave_unique_key();

	$style = $bg = $padding = '';
	if( !empty( $module_bg ) ) {
		$bg = "background-color:".$module_bg.";";
	}
	if( !empty( $module_padding ) ) {
		$padding = "padding:".$module_padding.";";
	}

	if( !empty( $bg ) || !empty( $padding ) ) {
		$style = 'style="' . $bg . ' ' . $padding . '"';
	}
	?>


	<div class="post-gallery-wrap" <?php echo $style; ?>>
		<div class="post-gallery">
			
			<div class="post-gallery-top">
				<div class="post-gallery-title">
					<i class="fa fa-picture-o"></i> <?php echo esc_attr( $gallery_title ); ?>
				</div>
			</div>

			<div class="post-gallery-body">
				<!-- big images -->
				<div id="sync1-<?php echo $unique_key; ?>" class="images-owl-carousel">
					
					<?php while( $the_query->have_posts() ): $the_query->the_post(); ?>

					<div class="item">
						<?php the_post_thumbnail('gal-big'); ?>
					</div><!-- item -->
					
					<?php endwhile; ?>

				</div><!-- owl-carousel -->

				<!-- thumbnails -->
				<div id="sync2-<?php echo $unique_key; ?>" class="thumbnails-owl-carousel">
					
					<?php while( $the_query->have_posts() ): $the_query->the_post(); ?>
					<div class="item">
						<?php the_post_thumbnail('gal-thumb'); ?>
					</div><!-- item -->
					<?php endwhile; ?>

				</div><!-- owl-carousel -->
			</div><!-- post-gallery-body -->
		</div><!-- post-gallery -->
	</div><!-- post-gallery-wrap -->

	<?php
	wp_register_style( 'fave-slick-css', get_template_directory_uri(). '/slick/slick.css', array(), '1.1.2', 'all' );
	wp_register_style( 'fave-slick-theme', get_template_directory_uri(). '/slick/slick-theme.css', array(), '1.1.2', 'all' );
	wp_enqueue_style( 'fave-slick-css' );
	wp_enqueue_style( 'fave-slick-theme' );

	wp_enqueue_script( 'fave-slick.min.js', get_template_directory_uri() . '/slick/slick.min.js', 'jquery', '1.1.2', true );

	if ( is_rtl() ) {
		$magzilla_rtl = 'true';
	} else {
		$magzilla_rtl = 'false';
	}

	?>

	<script type="text/javascript">
	jQuery(document).ready(function($) {

		var sync1 = $("#sync1-<?php echo $unique_key; ?>");
		var sync2 = $("#sync2-<?php echo $unique_key; ?>");

			sync1.slick({
				rtl: <?php echo $magzilla_rtl; ?>,
				slidesToShow: 1,
				slidesToScroll: 1,
				adaptiveHeight: true,
				arrows: true,
				prevArrow: "<button type='button' class='slick-prev'><i class='fa fa-chevron-left'></i></button>",
				nextArrow: "<button type='button' class='slick-next'><i class='fa fa-chevron-right'></i></button>",
				fade: true,
				asNavFor: sync2
			});
			sync2.slick({
				rtl: <?php echo $magzilla_rtl; ?>,
				slidesToShow: 8,
				slidesToScroll: 1,
				asNavFor: sync1,
				dots: false,
				arrows: false,
				centerMode: true,
				focusOnSelect: true,
				responsive: [
					{
						breakpoint: 1199,
						settings: {
							slidesToShow: 8,
							slidesToScroll: 1,
						}
					},
					{
						breakpoint: 979,
						settings: {
							slidesToShow: 5,
							slidesToScroll: 1,
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 5,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
						}
					},
					{
						breakpoint: 450,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
						}
					}
				]
			});

	});


	</script>
	
	
	<?php
	wp_reset_postdata();

	$result = ob_get_contents();  
	ob_end_clean();
	return $result;
	   
	}

add_shortcode('fav-custom-post-gallery', 'fav_custom_post_gallery');
?>