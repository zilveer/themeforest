<?php
if (!defined('ABSPATH')) exit();

get_header();

$show_post_metadata = TMM::get_option("gall_single_show_all_metadata");

$blog_single_show_bio = TMM::get_option("gall_single_show_bio");
$blog_single_show_likes = TMM::get_option("gall_single_show_likes");
$blog_single_show_social_share = TMM::get_option("gall_single_show_social_share");
$blog_single_show_posts_nav = TMM::get_option("gall_single_show_posts_nav");

if (have_posts()) {
    while (have_posts()) {
        the_post();
        TMM_Helper::tmm_set_post_views($post->ID);

        $user = get_userdata($post->post_author);

        $post_template = get_post_meta($post->ID, 'post_template', 1);

        $post_class = (isset($post_template) && $post_template == 'alternate') ? 'full-width-alternate' : 'full-width';

        if ($blog_single_show_posts_nav !== '0') {
            $next_post = get_next_post();
            $prev_post = get_previous_post();

            $next_post_url = "";
            $prev_post_url = "";

            $next_post_title = "";
            $prev_post_title = "";

            if (is_object($next_post)) {
                $next_post_url = get_permalink($next_post->ID);
                $next_post_title = $next_post->post_title;
            }

            if (is_object($prev_post)) {
                $prev_post_url = get_permalink($prev_post->ID);
                $prev_post_title = $prev_post->post_title;
            }
        }

        $uniqid = uniqid();

        $meta = get_post_custom($post->ID);
        if (!empty($meta["thememakers_gallery"][0]) AND is_serialized($meta["thememakers_gallery"][0])) {
            $pictures = unserialize($meta["thememakers_gallery"][0]);
        }

        if (!isset($image_size) || empty($image_size))
            $image_size = '745*450';

        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="post <?php echo esc_attr($post_class); ?>">

                <?php
                if (!empty($pictures)){ ?>

                    <div class="post">

                        <div class="image-post post-type-gallery-<?php echo $uniqid ?>">

                            <?php foreach ($pictures as $key => $source_url){
                                $source_url = $source_url['imgurl'];
                                ?>

                                <a href="<?php echo is_single() ? esc_url(TMM_Helper::get_image($source_url, '')) : esc_url(get_the_permalink($post->ID)); ?>" class="item-overlay item image-link">
                                    <img src="<?php echo esc_url(TMM_Helper::resize_image($source_url, $image_size)); ?>" alt="<?php echo esc_attr($post->post_title); ?>">
                                </a>

                            <?php }; ?>

                        </div>

                    </div>

                    <script>
                        (function($) {

                            var postSlider = $('.post-type-gallery-<?php echo $uniqid; ?>');

                            $(function() {

                                if (postSlider.length) {
                                    postSlider.owlCarousel({
                                        autoPlay : <?php echo (isset($post_type_values['gallery_autoplay']) && $post_type_values['gallery_autoplay']) ? esc_js($post_type_values['gallery_speed']) : 'false' ?>,
                                        stopOnHover : true,
                                        navigation: true,
                                        slideSpeed: 300,
                                        paginationSpeed: 400,
                                        singleItem: true,
                                        theme : "owl-theme",
                                        transitionStyle : "fadeUp"
                                    });
                                }

                            });
                        })(jQuery);
                    </script>

                <?php
                }else{
                    $href = TMM_Helper::get_post_featured_image($post->ID, '');
                    ?>

                    <a href="<?php echo esc_url($href) ?>" class="image-post item-overlay single-image-link">
                        <img src="<?php echo esc_url(TMM_Helper::get_post_featured_image($post->ID, $image_size)); ?>" alt="<?php echo esc_attr($post->post_title); ?>" />
                    </a>

                <?php
                }
                ?>

                <header class="entry-header">

                    <h2 class="entry-title"><?php the_title(); ?></h2>

                    <?php if ($show_post_metadata !== '0') { ?>

                        <div class="entry-meta">

                            <span class="posted-on"><a href="<?php echo esc_url(TMM_Helper::get_post_date_link(get_the_date('d.m.Y'))); ?>"><?php echo get_the_date(TMM::get_option('date_format')); ?></a></span>

                            <span class="byline"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>

                        </div>

                    <?php } ?>

                </header>

                <div class="entry-content">

                    <?php
                    the_content();
                    tmm_link_pages();
                    tmm_layout_content($post->ID, 'default');
                    ?>

                </div>

                <?php if ($show_post_metadata !== '0') { ?>

                    <footer class="entry-footer">
                        <?php  if ($show_post_metadata !== '0') { ?>

                            <div class="left">

                                    <span class="cat-links"><?php echo get_the_category_list(', '); ?></span>

                            </div>

                            <div class="right">
                                <?php  if ($blog_single_show_likes !== '0') { ?>
                                    <?php echo TMM_Helper::get_post_like($post->ID); ?>
                                <?php } ?>
                            </div>

                        <?php } ?>
                    </footer>

                <?php } ?>

            </div><!--/ .post-->

            <?php if ($blog_single_show_social_share !== '0') { ?>

                <div class="social-shares">

                    <?php TMM_Helper::display_share_buttons('', $post->ID); ?>

                </div><!--/ .social-shares-->

            <?php } ?>

            <?php if ($blog_single_show_posts_nav !== '0') { ?>

                <div class="single-nav clearfix">

                    <?php if (!empty($prev_post_url)){ ?>

                        <a title="<?php _e('Previous post', 'diplomat'); ?>" href="<?php echo esc_url($prev_post_url); ?>" class="prev">
                            <?php _e('Previous gallery', 'diplomat'); ?>
                            <b><?php echo $prev_post_title; ?></b>
                        </a>

                    <?php } ?>

                    <?php if (!empty($next_post_url)){ ?>

                        <a title="<?php _e('Next post', 'diplomat'); ?>" href="<?php echo esc_url($next_post_url); ?>" class="next">
                            <?php _e('Next gallery', 'diplomat'); ?>
                            <b><?php echo $next_post_title; ?></b>
                        </a>

                    <?php } ?>

                </div><!--/ .single-nav-->

            <?php } ?>

            <?php if ($blog_single_show_bio !== '0' && is_object($user)){ ?>

                <div class="author-holder clearfix">

                    <div class="author-thumb">
                        <div class="avatar">
                            <?php echo get_avatar($user->user_email, 100); ?>
                        </div>
                    </div>

                    <div class="author-about">
                        <h4 class="author-title"><?php echo $user->display_name ?></h4>
                        <p><?php echo stripslashes($user->description); ?></p>
                        <div class="author-contacts">
                            <?php TMM_Users::my_author_social_links($user->ID); ?>
                        </div>

                    </div><!--/ .author-about-->

                </div><!--/ .author-holder-->

            <?php } ?>

        </article><!--/ .entry-->

    <?php
    }
}
?>

<?php get_footer(); ?>
