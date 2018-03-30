<?php
global $qode_options;
global $more;
$more = 0;

$blog_hide_comments = "";
if (isset($qode_options['blog_hide_comments'])) {
    $blog_hide_comments = $qode_options['blog_hide_comments'];
}

$blog_hide_author = "";
if (isset($qode_options['blog_hide_author'])) {
    $blog_hide_author = $qode_options['blog_hide_author'];
}

$qode_like = "on";
if (isset($qode_options['qode_like'])) {
    $qode_like = $qode_options['qode_like'];
}

$qode_social_share = "";
if (isset($qode_options['enable_social_share'])) {
    $qode_social_share = $qode_options['enable_social_share'];
}

$wp_read_more = "off";
if (isset($qode_options['wp_read_more'])) {
    $wp_read_more = $qode_options['wp_read_more'];
}
$_post_format = get_post_format();

$post_class = '';
$post_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
$post_bg_color = get_post_meta(get_the_ID(), "qode_blog_chequered_color", true);

if($post_bg_color != '') {
    $holder_style = 'background-color: ' . $post_bg_color;
    $post_class .= 'qodef-with-bg-color';
}
else {
    $holder_style = 'background-image: url("' . $post_thumbnail . '")';
    $post_class .= 'qodef-with-bg-image';
}
?>
<?php
switch ($_post_format) {
case "video":
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
    <div class="qodef-post-content" style="<?php echo esc_attr($holder_style); ?>">
        <span class="qodef-post-content-overlay"></span>
        <div class="qodef-post-content-inner">
            <div class="qodef-post-text">
                <div class="qodef-post-text-inner">
                    <h3 class="qodef-post-title">
                        <span class="time">
                            <span><?php the_time(get_option('date_format')); ?></span>
                        </span>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <?php if($blog_hide_author == "no") { ?>
                        <div class="post_info">
                            <span class="post_author">
                            <span><?php _e('By', 'qode'); ?></span>
                            <a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                <span><?php the_author_meta('display_name'); ?></span>
                            </a>
                        </span>
                        </div>
                    <?php } ?>
                    <?php
                        qode_excerpt();
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>
<?php
break;
case "audio":
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
    <div class="qodef-post-content" style="<?php echo esc_attr($holder_style); ?>">
        <span class="qodef-post-content-overlay"></span>
        <div class="qodef-post-content-inner">
            <div class="qodef-post-text">
                <div class="qodef-post-text-inner">
                    <h3 class="qodef-post-title">
                        <span class="time">
                            <span><?php the_time(get_option('date_format')); ?></span>
                        </span>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <?php if($blog_hide_author == "no") { ?>
                        <div class="post_info">
                            <span class="post_author">
                            <span><?php _e('By', 'qode'); ?></span>
                            <a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                <span><?php the_author_meta('display_name'); ?></span>
                            </a>
                        </span>
                        </div>
                    <?php } ?>
                    <?php
                        qode_excerpt();
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>
<?php
break;
case "gallery":
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
    <div class="qodef-post-content" style="<?php echo esc_attr($holder_style); ?>">
        <span class="qodef-post-content-overlay"></span>
        <div class="qodef-post-content-inner">
            <div class="qodef-post-text">
                <div class="qodef-post-text-inner">
                    <h3 class="qodef-post-title">
                        <span class="time">
                            <span><?php the_time(get_option('date_format')); ?></span>
                        </span>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <?php if($blog_hide_author == "no") { ?>
                        <div class="post_info">
                            <span class="post_author">
                            <span><?php _e('By', 'qode'); ?></span>
                            <a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                <span><?php the_author_meta('display_name'); ?></span>
                            </a>
                        </span>
                        </div>
                    <?php } ?>
                    <?php
                        qode_excerpt();
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>
<?php
break;
case "link":
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
    <div class="qodef-post-content" style="<?php echo esc_attr($holder_style); ?>">
        <span class="qodef-post-content-overlay"></span>
        <div class="qodef-post-content-inner">
            <div class="qodef-post-text">
                <div class="qodef-post-text-inner">
                    <h3 class="qodef-post-title">
                        <span class="time">
                            <span><?php the_time(get_option('date_format')); ?></span>
                        </span>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</article>
<?php
break;
case "quote":
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
    <div class="qodef-post-content" style="<?php echo esc_attr($holder_style); ?>">
        <span class="qodef-post-content-overlay"></span>
        <div class="qodef-post-content-inner">
            <div class="qodef-post-text">
                <div class="qodef-post-text-inner">
                    <h3 class="qodef-post-title">
                        <span class="time">
                            <span><?php the_time(get_option('date_format')); ?></span>
                        </span>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_post_meta(get_the_ID(), "quote_format", true); ?></a>
                    </h3>
                    <span class="quote_author">&ndash; <?php the_title(); ?></span>
                </div>
            </div>
        </div>
    </div>
</article>
<?php
break;
default:
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
    <div class="qodef-post-content" style="<?php echo esc_attr($holder_style); ?>">
        <span class="qodef-post-content-overlay"></span>
        <div class="qodef-post-content-inner">
            <div class="qodef-post-text">
                <div class="qodef-post-text-inner">
                    <h3 class="qodef-post-title">
                        <span class="time">
                            <span><?php the_time(get_option('date_format')); ?></span>
                        </span>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    <?php if($blog_hide_author == "no") { ?>
                        <div class="post_info">
                            <span class="post_author">
                            <span><?php _e('By', 'qode'); ?></span>
                            <a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                <span><?php the_author_meta('display_name'); ?></span>
                            </a>
                        </span>
                        </div>
                    <?php } ?>
                    <?php
                        qode_excerpt();
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>
<?php
}
?>