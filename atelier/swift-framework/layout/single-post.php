<?php
    global $sf_options, $sf_sidebar_config;

    /* META SETUP */
    $show_author_info        = sf_get_post_meta( $post->ID, 'sf_author_info', true );
    $show_social             = sf_get_post_meta( $post->ID, 'sf_social_sharing', true );
    $show_related            = sf_get_post_meta( $post->ID, 'sf_related_articles', true );
    $remove_next_prev        = sf_get_post_meta( $post->ID, 'sf_remove_next_prev', true );
    $page_design_style 	  	 = sf_get_post_meta( $post->ID, 'sf_page_design_style', true ); 
    $default_sidebar_config  = $sf_options['default_post_sidebar_config'];
    $default_left_sidebar    = $sf_options['default_post_left_sidebar'];
    $default_right_sidebar   = $sf_options['default_post_right_sidebar'];
    $default_include_author  = $sf_options['default_include_author'];
    $default_include_social  = $sf_options['default_include_social'];
    $default_include_related = $sf_options['default_include_related'];

    $sidebar_config = sf_get_post_meta( $post->ID, 'sf_sidebar_config', true );
    $left_sidebar   = sf_get_post_meta( $post->ID, 'sf_left_sidebar', true );
    $right_sidebar  = sf_get_post_meta( $post->ID, 'sf_right_sidebar', true );

    if ( $sidebar_config == "" ) {
        $sidebar_config = $default_sidebar_config;
    }
    if ( $left_sidebar == "" ) {
        $left_sidebar = $default_left_sidebar;
    }
    if ( $right_sidebar == "" ) {
        $right_sidebar = $default_right_sidebar;
    }
    if ( $show_author_info == "" ) {
        $show_author_info = $default_include_author;
    }
    if ( $show_social == "" ) {
        $show_social = $default_include_social;
    }
    if ( $show_related == "" ) {
        $show_related = $default_include_related;
    }
    $page_content_class = $content_wrap_class = $post_aux_wrap_class = "";

    /* SIDEBAR SETUP */
    if ( $sidebar_config == "left-sidebar" ) {
        add_action( 'sf_after_post_content', 'sf_post_left_sidebar', 10 );
    } else if ( $sidebar_config == "right-sidebar" ) {
        add_action( 'sf_after_post_content', 'sf_post_right_sidebar', 10 );
    }

    /* PAGE BUILDER CHECK */
    $pb_active = sf_get_post_meta( $post->ID, '_spb_js_status', true );
    if ( $pb_active != "true" || ( $pb_active == "true" && $sidebar_config != "no-sidebars" ) ) {
        $page_content_class = apply_filters( 'sf_post_page_content_class_pb_inactive', 'container' );
        /* CONTENT WRAP */
        if ( $page_design_style == "hero-content-split" ) {
        	$content_wrap_class = apply_filters( 'sf_post_content_wrap_class_content_split', 'col-sm-12' );
        	$post_aux_wrap_class = apply_filters( 'sf_post_aux_wrap_class', 'col-sm-12' );
        } else if ( $sidebar_config == "right-sidebar" ) {
        	if ($sf_options['sidebar_width'] == "reduced") {
				$content_wrap_class = apply_filters( 'sf_post_content_wrap_class_rightsidebar', 'col-sm-9 content-left' );
        	} else {
        		$content_wrap_class = apply_filters( 'sf_post_content_wrap_class_rightsidebar', 'col-sm-8 content-left' );
        	}
        } else if ( $sidebar_config == "left-sidebar" ) {
			if ($sf_options['sidebar_width'] == "reduced") {
				$content_wrap_class = apply_filters( 'sf_post_content_wrap_class_rightsidebar', 'col-sm-9 content-right' );
			} else {
				$content_wrap_class = apply_filters( 'sf_post_content_wrap_class_rightsidebar', 'col-sm-8 content-right' );
			}
        } else {
            $content_wrap_class = apply_filters( 'sf_post_content_wrap_class_nosidebar', 'col-sm-8 col-sm-offset-2' );
        }
    } else {
    	$page_content_class = apply_filters( 'sf_post_page_content_class_pb_active', '' );
    	if ( $page_design_style == "hero-content-split" ) {
    		$content_wrap_class = apply_filters( 'sf_post_content_wrap_class_content_split', 'col-sm-12' );
    		$post_aux_wrap_class = apply_filters( 'sf_post_aux_wrap_class', 'col-sm-12' );
    	} else {
       		$content_wrap_class = apply_filters( 'sf_post_content_wrap_class_content_pb_active', '' );
       		$post_aux_wrap_class = apply_filters( 'sf_post_aux_wrap_class', 'col-sm-8 col-sm-offset-2' );
       	}
    }

    /* MEDIA DISPLAY */
    $fw_media_display = sf_get_post_meta( $post->ID, 'sf_fw_media_display', true );
    $media_type       = sf_get_post_meta( $post->ID, 'sf_media_type', true );
    if ( $fw_media_display == "fw-media-title" && $media_type != "none" ) {
        remove_action( 'sf_post_article_start', 'sf_post_detail_heading', 10 );
    }
    if ( $sidebar_config == "one-sidebar" || $fw_media_display == "standard" ) {
        remove_action( 'sf_post_article_start', 'sf_post_detail_media', 20 );
        add_action( 'sf_post_content_start', 'sf_post_detail_media', 10 );
    }

    /* CUSTOM FORMATTING */
    $extra_paragraph_spacing = sf_get_post_meta( $post->ID, 'sf_extra_paragraph_spacing', true );
    if ( $extra_paragraph_spacing && $sidebar_config == "no-sidebars" ) {
        $content_wrap_class .= ' extra-spacing';
    }

    /* RELATED */
    if ( ! $show_related ) {
        remove_action( 'sf_post_after_article', 'sf_post_related_articles', 10 );
        remove_action( 'sf_post_after_article', 'sf_post_related_articles', 30 );
        remove_action( 'sf_post_after_article_extras', 'sf_post_related_articles', 10 );
    }

    /* SOCIAL */
    if ( ! $show_social ) {
        remove_action( 'sf_post_content_end', 'sf_post_share', 30 );
    }

    /* NEXT/PREV */
    if ( $remove_next_prev ) {
        remove_action( 'sf_post_after_article', 'sf_post_pagination', 5 );
    }

    /* REVIEW */
    $review_post = sf_get_post_meta( $post->ID, 'sf_review_post', true );
    if ( $review_post ) {
        add_action( 'sf_post_content_end', 'sf_post_review', 20 );
    }
?>

<?php while (have_posts()) : the_post(); ?>

    <?php do_action( 'sf_post_before_article' ); ?>

    <!-- OPEN article -->
    <article <?php post_class( 'clearfix single-post-' . $fw_media_display ); ?> id="<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Article">

        <?php
            /**
             * @hooked - sf_post_detail_heading - 10
             * @hooked - sf_post_detail_media - 20
             **/
            do_action( 'sf_post_article_start' );
        ?>

        <section class="page-content clearfix <?php echo esc_attr($page_content_class); ?>">

            <?php
                do_action( 'sf_before_post_content' );
            ?>

            <div class="content-wrap <?php echo esc_attr($content_wrap_class); ?> clearfix" itemprop="articleBody">
                <?php
                    /**
                     * @hooked - sf_post_detail_media - 10 (standard)
                     **/
                    do_action( 'sf_post_content_start' );
                ?>
                <?php the_content(); ?>
                <div class="link-pages"><?php wp_link_pages(); ?></div>
                <div class="post-aux-wrap <?php echo esc_attr($post_aux_wrap_class); ?>">
                    <?php
                        /**
                         * @hooked - sf_post_review - 20
                         * @hooked - sf_post_share - 30
                         * @hooked - sf_post_details - 40
                         **/
                        do_action( 'sf_post_content_end' );
                    ?>
                </div>
            </div>

            <?php
                /**
                 * @hooked - sf_post_left_sidebar - 10
                 * @hooked - sf_post_right_sidebar - 10
                 **/
                do_action( 'sf_after_post_content' );
            ?>

        </section>

        <?php
            do_action( 'sf_post_article_end' );
        ?>

        <!-- CLOSE article -->
    </article>

    <section class="article-extras">

        <?php
            /**
             * @hooked - sf_post_pagination - 5
             * @hooked - sf_post_related_articles - 10
             * @hooked - sf_post_comments - 20
             **/
            do_action( 'sf_post_after_article' );
        ?>

    </section>
    
    <?php do_action( 'sf_post_after_article_extras' ); ?>

<?php endwhile; ?>
