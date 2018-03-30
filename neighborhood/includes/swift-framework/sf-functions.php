<?php

    /*
    *
    *	Swift Framework Functions
    *	------------------------------------------------
    * 	Copyright Swift Ideas 2014 - http://www.swiftideas.net
    *
   	*/	    
   	
	/* GET CUSTOM POST TYPE TAXONOMY LIST
	================================================== */
    function get_category_list( $category_name, $filter = 0, $category_child = "" ) {

        if ( ! $filter ) {

            $get_category  = get_categories( array( 'taxonomy' => $category_name ) );
            $category_list = array( '0' => 'All' );

            foreach ( $get_category as $category ) {
                if ( isset( $category->slug ) ) {
                    $category_list[] = $category->slug;
                }
            }

            return $category_list;

        } else if ( $category_child != "" && $category_child != "All" ) {

            $childcategory = get_term_by( 'slug', $category_child, $category_name );
            $get_category  = get_categories( array(
                    'taxonomy' => $category_name,
                    'child_of' => $childcategory->term_id
                ) );
            $category_list = array( '0' => 'All' );

            foreach ( $get_category as $category ) {
                if ( isset( $category->cat_name ) ) {
                    $category_list[] = $category->slug;
                }
            }

            return $category_list;

        } else {

            $get_category  = get_categories( array( 'taxonomy' => $category_name ) );
            $category_list = array( '0' => 'All' );

            foreach ( $get_category as $category ) {
                if ( isset( $category->cat_name ) ) {
                    $category_list[] = $category->cat_name;
                }
            }

            return $category_list;
        }
    }
	
	function get_category_list_key_array($category_name) {
			
		$get_category = get_categories( array( 'taxonomy' => $category_name	));
		$category_list = array( 'all' => 'All');
		
		foreach( $get_category as $category ){
			if (isset($category->slug)) {
			$category_list[$category->slug] = $category->cat_name;
			}
		}
			
		return $category_list;
	}
	

	/* CUSTOM POST TYPE COLUMNS
    ================================================== */
    function sf_posts_custom_columns( $column ) {
        global $post;
        switch ( $column ) {
            case "description":
                the_excerpt();
                break;
            case "thumbnail":
                the_post_thumbnail( 'thumbnail' );
                break;
            case "portfolio-category":
                echo get_the_term_list( $post->ID, 'portfolio-category', '', ', ', '' );
                break;
            case "swift-slider-category":
                echo get_the_term_list( $post->ID, 'swift-slider-category', '', ', ', '' );
                break;
            case "gallery-category":
                echo get_the_term_list( $post->ID, 'gallery-category', '', ', ', '' );
                break;
            case "testimonials-category":
                echo get_the_term_list( $post->ID, 'testimonials-category', '', ', ', '' );
                break;
            case "team-category":
                echo get_the_term_list( $post->ID, 'team-category', '', ', ', '' );
                break;
            case "clients-category":
                echo get_the_term_list( $post->ID, 'clients-category', '', ', ', '' );
                break;
            case "directory-category":
                echo get_the_term_list( $post->ID, 'directory-category', '', ', ', '' );
                break;
            case "directory-location":
                echo get_the_term_list( $post->ID, 'directory-location', '', ', ', '' );
                break;
            case "faqs-category":
                echo get_the_term_list( $post->ID, 'faqs-category', '', ', ', '' );
                break;
        }
    }

    add_action( "manage_posts_custom_column", "sf_posts_custom_columns" );
    
    /* GET ATTACHMENT META
    ================================================== */
    function sf_get_attachment_meta( $attachment_id ) {

		$attachment = get_post( $attachment_id );

		if ( isset( $attachment ) ) {
			return array(
				'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
				'caption' => $attachment->post_excerpt,
				'description' => $attachment->post_content,
				'href' => get_permalink( $attachment->ID ),
				'src' => $attachment->guid,
				'title' => $attachment->post_title
			);
		}
	}
	
?>