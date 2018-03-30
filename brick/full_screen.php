<?php
/*
Template Name: Full Screen Sections
*/
?>
<?php
global $wp_query;
$id = $wp_query->get_queried_object_id();

$full_screen_holder_style = "";

if(get_post_meta($id, "qode_page_background_color", true) != ""){
    $full_screen_holder_style .= "background-color:".esc_attr(get_post_meta($id, "qode_page_background_color", true)).";";
}else{
    $full_screen_holder_style .= "";
}

$header_bottom_appearance = 'regular';
if(isset($qode_options['header_bottom_appearance'])){
    $header_bottom_appearance = $qode_options['header_bottom_appearance'];
}

$enable_vertical_menu = false;
if(isset($qode_options['vertical_area']) && $qode_options['vertical_area'] =='yes'){
    $enable_vertical_menu = true;
}

$content_style = "";
if(get_post_meta($id, "qode_content-top-padding", true) != ""){
    if(get_post_meta($id, "qode_content-top-padding-mobile", true) == 'yes'){
        $content_style = "padding-top:".esc_attr(get_post_meta($id, "qode_content-top-padding", true))."px !important";
    }else{
        $content_style = "padding-top:".esc_attr(get_post_meta($id, "qode_content-top-padding", true))."px";
    }
}

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

?>
<?php get_header(); ?>
    <div class="full_screen_preloader">
        <?php
        if($qode_options['loading_animation'] == "on") {
            if($qode_options['loading_image'] != "") { ?>
                <div class="ajax_loader"><div class="ajax_loader_1"><div class="ajax_loader_2"><img src="<?php echo esc_url($qode_options['loading_image']) ?>" alt="" /></div></div></div>
            <?php }
            else { ?>
                <div class="ajax_loader"><div class="ajax_loader_1"><?php qode_loading_spinners(); ?></div></div>
            <?php }
        }
        ?>
    </div>

    <div class="full_screen_holder"<?php qode_inline_style($full_screen_holder_style); ?>>
        <div class="full_screen_inner" <?php qode_inline_style($content_style); ?>>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <?php the_content(); ?>

            <?php endwhile; endif; ?>

        </div>
        <div class="full_screen_navigation_holder">
            <div class="full_screen_navigation_inner">
                <a id="up_fs_button" href="#" target="_self"><span class='arrow_carrot-up'></span></a>
                <a id="down_fs_button" href="#" target="_self"><span class='arrow_carrot-down'></span></a>
            </div>
        </div>
    </div>

<?php get_footer(); ?>