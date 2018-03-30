<?php
/**
 * Template Name: Portfolio
 *
 * @package spectra
 * @since 1.0.0
 */

get_header(); ?>

<?php 
	// Get Custom Intro Section
	get_template_part( 'inc/custom-intro' );

?>

<!-- ############ PORTFOLIO ############ -->
<div id="page">
	
    <?php 
    global $spectra_opts, $wp_query, $post;

    // Copy query
    $temp_post = $post;
    $query_temp = $wp_query;

    // Page Filter
    $portfolio_filter = get_post_meta( $wp_query->post->ID, '_portfolio_filter', true );

    // Pagination Limit
    $limit = (int)get_post_meta( $wp_query->post->ID, '_limit', true );
    $limit = $limit && $limit == '' ? $limit = 6 : $limit = $limit;

    // Date format
    $date_format = 'd/m/y';
    if ( $spectra_opts->get_option( 'custom_date' ) ) {
        $date_format = $spectra_opts->get_option( 'custom_date' );
    }

    ?>

	<?php if ( $portfolio_filter && $portfolio_filter === 'on' ) : ?>
	<!-- ############ Portfolio Filter ############ -->
	<div id="portfolio-main-filter" class="filter">
		<ul class="filter-list item-filter active-filter clearfix">
			<li class="filter-label"><span class="label"><?php echo esc_attr( __( 'Filter', SPECTRA_THEME ) ) ?></span></li>
			<li><a data-categories="*"><?php echo esc_attr( __( 'All', SPECTRA_THEME ) ) ?></a></li>
			<?php 
            $term_args = array( 'hide_empty' => '1', 'orderby' => 'name', 'order' => 'ASC' );
            $terms = get_terms( 'spectra_portfolio_cats', $term_args );
            if ( $terms ) {
                foreach ( $terms as $term ) {
                	echo '<li><a data-categories="' . esc_attr( $term->slug ) . '">' . $term->name . '</a></li>';
                }
            }
        	?>
		</ul>
	</div>
	<!-- /portfolio filter -->
	<?php endif ?>

	<!--############ Portfolio grid ############ -->
	<div id="portfolio-items" class="fullwidth items clearfix">
		
		<?php
			// Begin Loop
			$args = array(
                'post_type' => 'spectra_portfolio',
                'orderby'   => 'menu_order',
                'order'     => 'ASC',
                'showposts' => $limit,
                'paged'     => $paged
			);
			$wp_query = new WP_Query();
			$wp_query->query( $args );
        ?>
	
	 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php

        	// Get thumbnail data

            // Thumb type 
            $thumb_type = get_post_meta( $wp_query->post->ID, '_thumb_type', true );

            // Tracks
            $tracks_id = get_post_meta( $wp_query->post->ID, '_tracks_id', true );
            $hidden_tracklist = '';
            if ( ! $tracks_id && $thumb_type === 'audio' ) {
                continue;
            }

            // Lightbox image 
            $lightbox_image = get_post_meta( $wp_query->post->ID, '_lightbox_image', true );

            // Thumb Iframe 
            $thumb_iframe = get_post_meta( $wp_query->post->ID, '_thumb_iframe', true );

            // Video Link
            $video_link = get_post_meta( $wp_query->post->ID, '_video_link', true );

            // Lightbox group 
            $lightbox_group = get_post_meta( $wp_query->post->ID, '_lightbox_group', true );

            // Badge 
            $badge = get_post_meta( $wp_query->post->ID, '_badge', true );

            // Custom link 
            $custom_link = get_post_meta( $wp_query->post->ID, '_link_url', true );

            // Link target attribute 
            $target = get_post_meta( $wp_query->post->ID, '_target', true );
            $target = isset( $target ) && $target == 'on' ? $target = '_blank' : $target = '';

            // Thumb subtitle
            $thumb_subtitle = get_post_meta( $wp_query->post->ID, '_thumb_subtitle', true );

            // Bulid genres 
            $post_terms = get_the_terms( get_the_ID(), 'spectra_portfolio_cats' );
            $filter_slugs = '';
            $filter_names = '';
            $term_count = 0;
            if ( $post_terms ) {
                $terms_count = count( $post_terms );
                foreach ( $post_terms as $term ) {
                    $term_count++;
                    if ( $term_count < $terms_count ) {
                        $filter_slugs .= $term->slug . ' ';
                        $filter_names .= $term->name . ' / ';
                    } else {
                        $filter_slugs .= $term->slug;
                        $filter_names .= $term->name;
                    }
                }
            }

            // Generate thumbnail link
            $thumb_link = 'href="' . esc_url( get_permalink() ) .'"';

            // Generate thumbnail class
            $thumb_class = 'thumb project-thumb frame-box';

            // Data attributes
            $thumb_attr = '';

            // Lightbox group
            if ( $lightbox_group !== '' ) {
                $thumb_attr = $thumb_attr . 'data-group="' . esc_attr( $lightbox_group ) . '"';
            }

            switch ( $thumb_type ) {

                    // Image
                    case 'image' :
                        $thumb_link = '';
                    break;

                    // Lightbox image
                    case 'lightbox_image' :
                        $thumb_link = 'href="' . esc_url( $lightbox_image ) . '"';
                        $thumb_class = $thumb_class . ' imagebox';
                    break;

                    // Iframe
                    case 'lightbox_video':
                    	if ( isset( $video_link ) && $video_link !== '' ) {
	                      
							$thumb_link = 'href="' . esc_url( $video_link ) . '"';
	                        $thumb_class = $thumb_class . ' videobox';
	                         
	                        
                    	}

                    break;

                    case 'lightbox_soundcloud':
                        if ( isset( $thumb_iframe ) && $thumb_iframe !== '' ) {
                            $attr = array();
                            $attr = explode( '|', $thumb_iframe );
                            if ( isset( $attr ) && is_array( $attr) ) {

                                if ( $attr[1] == '100%' ) {
                                    $attr[1] = 'auto';
                                }
                                $thumb_link = 'href="' . esc_url( str_replace('&','&amp;',$attr[0]) ) . '"';
                                $thumb_class = $thumb_class . ' mediabox';
                                $thumb_attr = $thumb_attr . ' data-width="' . esc_attr( $attr[1] ) . '" data-height="' . esc_attr( $attr[2] ) . '"';
                            }
                        }

                    break;

                    // Custom link
                    case 'custom_link' :
                        $thumb_link = 'href="' . esc_url( $custom_link ) . '"';
                        if ( $target !== '' ) {
                        	$thumb_attr = $thumb_attr . ' target="' . esc_attr( $target ) . '"';
                    	}
                    break;

                    // Project link
                    case 'project_link' :
                       $thumb_link = 'href="' . esc_url( get_permalink() ) . '"';
                    break;

                    // Audio
                    case 'audio' :
                        
                        if ( function_exists( 'scamp_player_get_list' ) && scamp_player_get_list( $tracks_id ) ) {
                            $tracklist = scamp_player_get_list( $tracks_id );

                            // Single track
                            if ( count( $tracklist ) === 1 ){
                                $thumb_class = $thumb_class . ' sp-play-track';
                                $thumb_link = 'href="' . esc_url( $tracklist[0]['url'] ) . '"';
                                if ( function_exists( 'spectra_get_image_id' ) &&  spectra_get_image_id( $tracklist[0]['cover'], 'full' ) ) {
                                    $tracklist[0]['cover'] = spectra_get_image_id( $tracklist[0]['cover'], array( 90, 90 ) );
                                }
                                $thumb_attr = $thumb_attr . ' data-cover="' . esc_attr( $tracklist[0]['cover'] ) . '" data-artist="' . esc_attr( $tracklist[0]['artists'] ) . '" data-artist_url="' . esc_url( $tracklist[0]['artists_url'] ) . '" data-artist_target="' . esc_attr( $tracklist[0]['artists_target'] ) . '" data-release_url="' . esc_url( $tracklist[0]['release_url'] ) . '" data-release_target="' . esc_attr( $tracklist[0]['release_target'] ) . '" data-shop_url="' . esc_url( $tracklist[0]['cart_url'] ) . '" data-shop_target="' . esc_attr( $tracklist[0]['cart_target'] ) . '"';

                            // Tracks
                            } else {
                                $thumb_class = $thumb_class . ' sp-play-list';
                                $thumb_link = 'href="' . esc_url( get_permalink() ) . '"';
                                $thumb_attr = $thumb_attr . ' data-id="tracklist' . esc_attr( $post->ID ) . '"';

                                // Generate hidden list
                                $hidden_tracklist = '<ul id="tracklist' . esc_attr( $post->ID ) . '" class="hidden">'."\n";
                                foreach ( $tracklist as $track ) {
                                    if ( function_exists( 'spectra_get_image_id' ) &&  spectra_get_image_id( $track['cover'], 'full' ) ) {
                                        $track['cover'] = spectra_get_image_id( $track['cover'], array( 90, 90 ) );
                                    }
                                    $hidden_tracklist .= '<li><a href="' . esc_url( $track['url'] ) . '" data-cover="' . esc_attr( $track['cover'] ) . '" data-artist="' . esc_attr( $track['artists'] ) . '" data-artist_url="' . esc_url( $track['artists_url'] ) . '" data-artist_target="' . esc_attr( $track['artists_target'] ) . '" data-release_url="' . esc_url( $track['release_url'] ) . '" data-release_target="' . esc_attr( $track['release_target'] ) . '" data-shop_url="' . esc_url( $track['cart_url'] ) . '" data-shop_target="' . esc_attr( $track['cart_target'] ) . '" class="sp-play-track">' . $track['title'] . '</a></li>' ."\n";
                                }
                                $hidden_tracklist .= '</ul>'."\n";
                            }

                        } else {
                            $thumb_link = 'href="' . esc_url( get_permalink() ) . '"';
                        }
                        
                    break;
                }

                
        ?>

		<?php if ( has_post_thumbnail() ) : ?>
		<!-- item -->
		<div class="item" data-categories="<?php echo esc_attr( $filter_slugs ) ?>">
			<a <?php $spectra_opts->e_esc( $thumb_link ) ?> class="<?php echo esc_attr( $thumb_class ) ?>" <?php $spectra_opts->e_esc( $thumb_attr ); ?>>
				<!-- title and opacity mask -->
				<div class="inner">
					<h6><?php 
						the_title(); 
						if ( $thumb_subtitle && $thumb_subtitle !== '' ) {
							echo '<span>' . esc_attr( $thumb_subtitle ) . '</span>';
						}
						?>
					</h6>
				</div>
				<!-- /title and opacity mask -->
				<!-- image -->
                <img src="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) )?>" alt="<?php echo esc_attr( __( 'Porfolio thumbnail', SPECTRA_THEME ) ); ?>">
                <?php if ( $badge && $badge != 'none' ) : ?>
    				<!-- badge -->
                    <?php 
                         switch ( $badge ) {

                            // New
                            case 'new' :
                                echo '<span class="badge new">' .  __( 'NEW', SPECTRA_THEME ) . '</span>';
                            break;
                            // Free
                            case 'free' :
                                echo '<span class="badge free">' .  __( 'FREE', SPECTRA_THEME ) . '</span>';
                            break;
                            // Custom
                            case 'custom' :
                                $badge_color = get_post_meta( $wp_query->post->ID, '_badge_color', true );
                                $badge_text = get_post_meta( $wp_query->post->ID, '_badge_text', true );
                                echo '<span class="badge" style="background-color:' . $badge_color . '">' . esc_html( $badge_text ) . '</span>';
                            break;
                        }

                     ?>

                <?php endif; // end badge ?>

			</a>
            <?php $spectra_opts->e_esc( $hidden_tracklist ); ?>
		</div>
		<!-- /item -->
		<?php endif; // End has thumbnail ?>
		<?php endwhile; // End Loop ?>
	</div>
    <div class="clear"></div>
    <?php spectra_paging_nav(); ?>
    <?php endif; ?>
			
</div>
<!-- /page -->
<?php
   // Get orginal query
   $post = $temp_post;
   $wp_query = $query_temp;
?>
<?php get_footer(); ?>