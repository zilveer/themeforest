<?php
// Remove any filters added by theme functions.
remove_filter( 'pre_get_posts', 'wploop_exclude' );

//get slider
//@since 2.2 mod by denzel to use category id from slider category id text input added in custom-metaboxes.php
//as a fail safe in case slider category dropdown does not save the correct category id.
	global $post;
    $tt_sterling_slider_category       = get_post_meta($post->ID, 'slider_cat_id',true);
    if($tt_sterling_slider_category!=''){
    $tt_sterling_slider_category_id    = $tt_sterling_slider_category;
    }else{
    //if user does not enter a slider category id, we use back the category dropdown
    $tt_sterling_slider_category       = get_post_meta($post->ID, 'truethemes_sterling_slider_category',true);
    $tt_sterling_slider_category_id    = $tt_sterling_slider_category[0];
    }  

//Start determine which database query to make.

//check if there is a slider category in post meta, we do the taxonomy query using slider category id.
if(!empty($tt_sterling_slider_category_id)){

		//prepare the query variables.
		$args = array(
			'post_type' => 'slider',
			'tax_query' => array(
				array(
					'taxonomy' => 'sterling-slider-category',
					'field' => 'id',
					'terms' => $tt_sterling_slider_category_id, //mod @since 2.2
				)
			)
		);
		
		//we do the taxonomy query using the above query variables.
		$wp_query = new WP_Query( $args );
		
			//make sure slider category is not empty, 
			//if it is empty, probably due to customer editing old page, and saving the first empty slider category in the post meta, 
			//or there is no slider posts tagged to slider category.
			//we output all slider posts.
			
			if(!$wp_query->have_posts()){
			//if there is no slider posts due to any of the above mentioned reasons, we show all slider posts.
			//this is for backward compatibility.
			$wp_query = new WP_Query( 'post_type=slider&posts_per_page=100' );	
			}

}else{

//This is the old query_posts which displays all slider posts, when there is no slider category saved in post meta.
//This is for backward compatibility.
//Using WP_Query class so that it works with latest WPML plugin, query_posts does not work properly anymore.
$wp_query = new WP_Query( 'post_type=slider&posts_per_page=100' );

}



//we output the query results here.
if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
    // Process all individual post meta.
    $slider_image           = get_post_meta( $post->ID, 'slider_image', true );
    $slider_image_link      = get_post_meta( $post->ID, 'slider_image_url', true );
    $slider_image_alt_text  = get_post_meta( $post->ID, 'slider_image_alt_text', true );
    $slider_video           = get_post_meta( $post->ID, 'slider_video', true );
    $slider_alignment       = get_post_meta( $post->ID, 'slider_alignment', true );

    // If image = false and video = false, display the content area.
    if ( empty( $slider_image ) && empty( $slider_video ) ) { ?>
        <div class="clearfix home-slider-post" id="slider-post-<?php the_ID(); ?>">
            <?php the_content(); ?>
        </div><!-- end .home-slider-post -->
    <?php }

    // If image = true and alignment = right, output appropriate content.
    if ( ! empty( $slider_image ) && 'align_right' == $slider_alignment ) { ?>
        <div class="clearfix home-slider-post" id="slider-post-<?php the_ID(); ?>">
            <div class="one_half">
                <?php the_content(); ?>
            </div>

            <div class="one_half">
                <?php echo do_shortcode( '[image_frame image_path="' . esc_url( $slider_image ) . '" size="full-half" alt="' . esc_attr( $slider_image_alt_text ) . '" link_to_page="' . esc_url( $slider_image_link ) . '"]' ); ?>
            </div>
        </div><!-- end .home-slider-post -->
    <?php }

    // If image = true and alignment = left, output appropriate content.
    if ( ! empty( $slider_image ) && 'align_left' == $slider_alignment ) { ?>
        <div class="clearfix home-slider-post" id="slider-post-<?php the_ID(); ?>">
            <div class="one_half">
                <?php echo do_shortcode( '[image_frame image_path="' . esc_url( $slider_image ) . '" size="full-half" description="' . esc_attr( $slider_image_alt_text ) . '" link_to_page="' . esc_url( $slider_image_link ) . '"]' ); ?>
            </div>

            <div class="one_half">
                <?php the_content(); ?>
            </div>
        </div><!-- end .home-slider-post -->
    <?php }

    // If video = true and alignment = right, output appropriate content.
    if ( ! empty( $slider_video ) && 'align_right' == $slider_alignment ) { ?>
        <div class="clearfix home-slider-post" id="slider-post-<?php the_ID(); ?>">
            <div class="one_half">
                <?php the_content(); ?>
            </div>

            <div class="one_half">
                <div class="single-post-thumb">
                    <?php
                        global $wp_embed;
                        $shortcode = '[embed width="445" height="273"]' . $slider_video . '[/embed]';
                        echo $wp_embed->run_shortcode( $shortcode );
                    ?>
                </div>
            </div>
        </div><!-- end .home-slider-post -->
    <?php }

    // If video = true and alignment = left, output appropriate content.
    if ( ! empty( $slider_video ) && 'align_left' == $slider_alignment ) { ?>
        <div class="clearfix home-slider-post" id="slider-post-<?php the_ID(); ?>">
            <div class="one_half">
                <div class="single-post-thumb">
                    <?php
                        global $wp_embed;
                        $shortcode = '[embed width="445" height="273"]' . $slider_video . '[/embed]';
                        echo $wp_embed->run_shortcode($shortcode);
                    ?>
                </div>
            </div>

            <div class="one_half">
                <?php the_content(); ?>
            </div>
        </div><!-- end .home-slider-post -->
    <?php }
// That's it for this template!
endwhile; endif; wp_reset_query();