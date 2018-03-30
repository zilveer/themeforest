<?php
/*-----------------------------------------------------------------------------------*/
/*	Video Gallery
/*-----------------------------------------------------------------------------------*/

function fav_video_gallery( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'post_from'			=> '',
		'category_id'		=> '',
		'sort'	  			=> '',
		'autors_id'	  		=> '',
		'posts_limit'	  	=> '',
		'offset'	 	 	=> '',
		'playlist_title'	  	=> '',
		'module_bg' => '',
		'module_padding' => ''
    ), $atts ) );
	
	ob_start();

	$video_link = $video_duration = '';

    $wp_query_args = array(
        'ignore_sticky_posts' => 1
    );


    if( $post_from == "category_videos" && !empty($category_id)) {
	    $wp_query_args['tax_query'] = array(
            array(
            'taxonomy' => 'video-categories',
            'field' => 'term_id',
            'terms' => $category_id,
            )
        );
	}

	if( $post_from == "featured" ) {
            
        $wp_query_args['meta_key'] = 'fave_video_featured';
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
            $wp_query_args['meta_key'] = '';
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

    $wp_query_args['post_type'] = 'video';

    $the_query_1 = new WP_Query($wp_query_args);
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
	
	<script type="text/javascript">
		function htmlUpdateSize(){
	    	// Get the dimensions of the viewport
	    	var height = jQuery(".player-holder-<?php echo $unique_key; ?> .player").height();
	    	jQuery('.scroll-pane-<?php echo $unique_key; ?>').css({
	    		height: [height],
	    	});
		};
		jQuery(document).ready(htmlUpdateSize);    // When the page first loads
		jQuery(window).resize(htmlUpdateSize);     // When the browser changes size

		jQuery(document).ready(function($) {
			$( ".favethemes-video-<?php echo $unique_key; ?> a" ).click(function() {
			  	$(this).parent().addClass('selected').siblings().removeClass('selected');
				$('#video-player-<?php echo $unique_key; ?> iframe').attr('src', $(this).attr('href'));
				return false;
			});
		});

	</script>

<div class="featured-gallery video-gallery" <?php echo $style; ?>>
	
	<?php if( !empty( $playlist_title ) ): ?>
	<div class="video-gallery-top">
		<div class="video-gallery-title">
			<i class="fa fa-video-camera"></i> <?php echo esc_attr( $playlist_title ); ?>
		</div>
	</div>
	<?php endif; ?>

	<div id="video-player-<?php echo $unique_key; ?>" class="video-gallery-holder">
		<div class="row row-no-padding">
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
				<div class="player-holder player-holder-<?php echo $unique_key; ?>">
					<div class="player">
						
						<?php $i = 0; ?>
						<?php while ( $the_query_1->have_posts() ): $the_query_1->the_post(); $i++; 
						
							  $video_channel = get_post_meta( get_the_ID(), 'fave_video_channel', true );
							  $video_id = get_post_meta( get_the_ID(), 'fave_video_id', true );
							  $video_duration = get_post_meta( get_the_ID(), 'fave_video_duration', true );

							  if ( $video_channel == 'vimeo' ) {

						  			$video_link = "https://player.vimeo.com/video/".esc_attr( $video_id )."?color=ffcc3a";

						  		} elseif ( $video_channel == 'youtube' ) {

						  			$video_link = "https://www.youtube.com/embed/".esc_attr( $video_id )."";

						  		} else {

						  			$video_link = "";

						  		}
						?>

						<iframe src="<?php echo esc_url( $video_link ); ?>" frameborder="0" allowfullscreen></iframe>

						<?php if( $i == 1 ): break; endif; ?>

						<?php endwhile; ?>

					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="playlist-holder scroll-pane scroll-pane-<?php echo esc_attr( $unique_key ); ?>">

					<?php $i = 0; ?>
					<?php while ( $the_query->have_posts() ): $the_query->the_post(); $i++; 

						  $video_channel = get_post_meta( get_the_ID(), 'fave_video_channel', true );
						  $video_id = get_post_meta( get_the_ID(), 'fave_video_id', true );
						  $video_duration = get_post_meta( get_the_ID(), 'fave_video_duration', true );

						  if ( $video_channel == 'vimeo' ) {

					  			$video_link = "https://player.vimeo.com/video/".esc_attr( $video_id )."?color=ffcc3a";

					  		} elseif ( $video_channel == 'youtube' ) {

					  			$video_link = "https://www.youtube.com/embed/".esc_attr( $video_id )."";

					  		} else {

					  			$video_link = "";

					  		}
					?>

					<div class="playlist-video favethemes-video-<?php echo esc_attr( $unique_key ); ?> <?php if( $i == 1 ){ echo "selected"; }?>">
						<a href="<?php echo esc_url( $video_link ); ?>">
							<div class="media">
								<div class="media-left">
									<img class="media-object" src="<?php echo fave_featured_image( get_the_ID(), 160, 90, true, true, true ); ?>" alt="<?php the_title(); ?>" alt="<?php the_title(); ?>">
								</div>
								<div class="media-body">
									<div class="media-heading"><?php the_title(); ?></div>
									<?php if( !empty($video_duration) ): ?>
									<i class="fa fa-clock-o"></i> <?php echo esc_attr( $video_duration ); ?>
									<?php endif; ?>
								</div>
							</div>
						</a>
					</div><!-- playlist-video -->

					<?php endwhile; ?>

				</div>
			</div>
		</div>
	</div>
</div>
	<?php 

	$result = ob_get_contents();  
	ob_end_clean();
	return $result;
	   
	}

add_shortcode('fav-video-gallery', 'fav_video_gallery');
?>