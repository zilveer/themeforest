<?php
/*
Template Name: Landing Page
*/
global $qode_options;
global $wp_query;
$id = $wp_query->get_queried_object_id();
$sidebar = get_post_meta($id, "qode_show-sidebar", true);

$enable_page_comments = false;
if(get_post_meta($id, "qode_enable-page-comments", true) == 'yes') {
    $enable_page_comments = true;
}

if(get_post_meta($id, "qode_page_background_color", true) != ""){
    $background_color = get_post_meta($id, "qode_page_background_color", true);
}else{
    $background_color = "";
}

$content_style = "";
if(get_post_meta($id, "qode_content-top-padding", true) != ""){
    if(get_post_meta($id, "qode_content-top-padding-mobile", true) == "yes"){
        $content_style = "style='padding-top:".get_post_meta($id, "qode_content-top-padding", true)."px !important'";
    }else{
        $content_style = "style='padding-top:".get_post_meta($id, "qode_content-top-padding", true)."px'";
    }
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
        if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
            echo('<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">');

        $responsiveness = "yes";
        if (isset($qode_options['responsiveness'])) $responsiveness = $qode_options['responsiveness'];
        if($responsiveness != "no"){
            ?>
            <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
            <?php
        }else{
            ?>
            <meta name="viewport" content="width=1200,user-scalable=no">
        <?php } ?>
        <title><?php wp_title(''); ?></title>

        <?php do_action('qode_header_meta'); ?>

        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php endif; ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url($qode_options['favicon_image']); ?>" />
        <link rel="apple-touch-icon" href="<?php echo esc_url($qode_options['favicon_image']); ?>" />
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
			<?php get_template_part( 'title' ); ?>
            <?php
                $revslider = get_post_meta($id, "qode_revolution-slider", true);
                if (!empty($revslider)){ ?>
                <div class="q_slider"><div class="q_slider_inner">
                    <?php echo do_shortcode($revslider); ?>
                </div></div>
            <?php
            }
            ?>
        <div class="full_width"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
            <div class="full_width_inner" <?php if($content_style != "") { echo wp_kses($content_style, array('style')); } ?>>
                <?php if(($sidebar == "default")||($sidebar == "")) : ?>
                    <?php if (have_posts()) :
                        while (have_posts()) : the_post(); ?>
                            <?php the_content(); ?>
                            <?php
                            $args_pages = array(
                                'before'           => '<p class="single_links_pages">',
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
                                                'before'           => '<p class="single_links_pages">',
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
                                                        'before'           => '<p class="single_links_pages">',
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
        <?php wp_footer(); ?>
    </body>
</html>