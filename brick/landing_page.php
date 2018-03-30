<?php
/*
Template Name: Landing Page
*/
global $wp_query;
global $qode_options;
$id = $wp_query->get_queried_object_id();
$sidebar = get_post_meta($id, "qode_show-sidebar", true);  

$enable_page_comments = false;
if(get_post_meta($id, "qode_enable-page-comments", true) == 'yes') {
	$enable_page_comments = true;
}

if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$background_color = 'background-color: '.esc_attr(get_post_meta($id, "qode_page_background_color", true));
}else{
	$background_color = "";
}

$pagination_classes = '';
if( isset($qode_options['pagination_type']) && $qode_options['pagination_type'] == 'standard' ) {
	if( isset($qode_options['pagination_standard_position']) && $qode_options['pagination_standard_position'] !== '' ) {
		$pagination_classes .= "standard_".esc_attr($qode_options['pagination_standard_position']);
	}
}
elseif ( isset($qode_options['pagination_type']) && $qode_options['pagination_type'] == 'arrows_on_sides' ) {
	$pagination_classes .= "arrows_on_sides";
}

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <?php
        if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
            echo('<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">');
        } ?>

        <?php qode_wp_title(); ?>

        <?php
        /**
         * qode_header_meta hook
         *
         * @see qode_header_meta() - hooked with 10
         * @see qode_user_scalable_meta() - hooked with 10
         */
        do_action('qode_header_meta');
        ?>

        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url($qode_options['favicon_image']); ?>">
        <link rel="apple-touch-icon" href="<?php echo esc_url($qode_options['favicon_image']); ?>"/>
        <!--[if gte IE 9]>
        <style type="text/css">
            .gradient {
                filter: none;
            }
        </style>
        <![endif]-->

        <?php wp_head(); ?>

    </head>

<body <?php body_class(); ?>>

<div class="wrapper">
    <div class="wrapper_inner">
        <div class="content content_top_margin_none">
            <div class="content_inner">
                <?php get_template_part( 'title' ); ?>
                <?php get_template_part('slider');?>
                <div class="full_width"<?php qode_inline_style($background_color); ?>>
                    <div class="full_width_inner">
                        <?php if(($sidebar == "default")||($sidebar == "")) : ?>
                            <?php if (have_posts()) :
                                while (have_posts()) : the_post(); ?>
                                    <?php the_content(); ?>
                                    <?php
                                    $args_pages = array(
                                        'before'           => '<div class="single_links_pages ' .$pagination_classes. '"><div class="single_links_pages_inner">',
                                        'after'            => '</p>',
                                        'pagelink'         => '<span>%</span>'
                                    );

                                    wp_link_pages($args_pages); ?>
                                    <?php
                                    if($enable_page_comments){
                                        ?>
                                        <div class="container">
                                            <div class="container_inner">
                                                <?php
                                                comments_template('', true);
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        <?php elseif($sidebar == "1" || $sidebar == "2"): ?>

                        <?php if($sidebar == "1") : ?>
                        <div class="two_columns_66_33 clearfix grid2">
                            <div class="column1">
                        <?php elseif($sidebar == "2") : ?>
                        <div class="two_columns_75_25 clearfix grid2">
                            <div class="column1">
                                <?php endif; ?>
                                <?php if (have_posts()) :
                                    while (have_posts()) : the_post(); ?>
                                        <div class="column_inner">

                                            <?php the_content(); ?>
                                            <?php
                                            $args_pages = array(
                                                'before'           => '<div class="single_links_pages ' .$pagination_classes. '"><div class="single_links_pages_inner">',
                                                'after'            => '</p>',
                                                'pagelink'         => '<span>%</span>'
                                            );

                                            wp_link_pages($args_pages); ?>
                                            <?php
                                            if($enable_page_comments){
                                                ?>
                                                <div class="container">
                                                    <div class="container_inner">
                                                        <?php
                                                        comments_template('', true);
                                                        ?>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>


                            </div>
                            <div class="column2"><?php get_sidebar();?></div>
                        </div>
                        <?php elseif($sidebar == "3" || $sidebar == "4"): ?>
                        <?php if($sidebar == "3") : ?>
                        <div class="two_columns_33_66 clearfix grid2">
                            <div class="column1"><?php get_sidebar();?></div>
                            <div class="column2">
                                <?php elseif($sidebar == "4") : ?>
                                <div class="two_columns_25_75 clearfix grid2">
                                    <div class="column1"><?php get_sidebar();?></div>
                                    <div class="column2">
                                        <?php endif; ?>
                                        <?php if (have_posts()) :
                                            while (have_posts()) : the_post(); ?>
                                                <div class="column_inner">
                                                    <?php the_content(); ?>
                                                    <?php
                                                    $args_pages = array(
                                                        'before'           => '<div class="single_links_pages ' .$pagination_classes. '"><div class="single_links_pages_inner">',
                                                        'after'            => '</p>',
                                                        'pagelink'         => '<span>%</span>'
                                                    );

                                                    wp_link_pages($args_pages); ?>
                                                    <?php
                                                    if($enable_page_comments){
                                                        ?>
                                                        <div class="container">
                                                            <div class="container_inner">
                                                                <?php
                                                                comments_template('', true);
                                                                ?>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            <?php endwhile; ?>
                                        <?php endif; ?>


                                    </div>

                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>