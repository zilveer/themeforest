<?php
/*
Template Name: Blog Centered
*/
?>
<?php get_header(); ?>
<?php
global $wp_query;
global $qode_template_name;
$id = $wp_query->get_queried_object_id();
$qode_template_name = get_page_template_slug($id);
$category = get_post_meta($id, "qode_choose-blog-category", true);
$post_number = get_post_meta($id, "qode_show-posts-per-page", true);
if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
$page_object = get_post( $id );
$q_content = $page_object->post_content;
$q_content = apply_filters( 'the_content', $q_content );

$sidebar = get_post_meta($id, "qode_show-sidebar", true);

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

if($qode_options['number_of_chars_centered'] != "") {
    qode_set_blog_word_count($qode_options['number_of_chars_centered']);
}

?>
<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
    <script>
        var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
    </script>
<?php } ?>
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
<?php
query_posts('post_type=post&paged='. $paged . '&cat=' . $category .'&posts_per_page=' . $post_number );
?>
    <div class="container"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
        <div class="container_inner default_template_holder" <?php if($content_style != "") { echo wp_kses($content_style, array('style')); } ?>>
            <?php if(($sidebar == "default")||($sidebar == "")) : ?>
                <?php
	            print $q_content;
                get_template_part('templates/blog/blog', 'structure');
                ?>
            <?php elseif($sidebar == "1" || $sidebar == "2"): ?>
                <div class="<?php if($sidebar == "1"):?>two_columns_66_33<?php elseif($sidebar == "2") : ?>two_columns_75_25<?php endif; ?> background_color_sidebar grid2 clearfix">
                    <div class="column1">
                        <div class="column_inner">
                            <?php
                            print $q_content;
                            get_template_part('templates/blog/blog', 'structure');
                            ?>
                        </div>
                    </div>
                    <div class="column2">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            <?php elseif($sidebar == "3" || $sidebar == "4"): ?>
                <div class="<?php if($sidebar == "3"):?>two_columns_33_66<?php elseif($sidebar == "4") : ?>two_columns_25_75<?php endif; ?> background_color_sidebar grid2 clearfix">
                    <div class="column1">
                        <?php get_sidebar(); ?>
                    </div>
                    <div class="column2">
                        <div class="column_inner">
                            <?php
                            print $q_content;
                            get_template_part('templates/blog/blog', 'structure');
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>