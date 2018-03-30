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
$holder_style = '';
$post_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
if($post_thumbnail) {
    $holder_style .= 'style="background-image: url("' . $post_thumbnail . '")"';
}

?>
<?php
switch ($_post_format) {
    case "video":
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="qodef-post-content">
                <a class="qodef-post-content-inner" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <span class="qodef-post-content-overlay">
                        <span aria-hidden="true" class="arrow_carrot-right"></span>
                    </span>
                    <div class="qodef-post-image">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                    <div class="qodef-post-text">
                        <h4 class="qodef-post-title"><?php the_title(); ?></h4>
                        <div class="post_info">
                            <span class="time">
								<span><?php the_time(get_option('date_format')); ?></span>
							</span>
                            <?php if($blog_hide_author == "no") { ?>
                                <span class="post_author">
									<span><?php _e('By', 'qode'); ?></span>
                                    <span><?php the_author_meta('display_name'); ?></span>
								</span>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>
        </article>
        <?php
        break;
    case "audio":
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="qodef-post-content">
                <a class="qodef-post-content-inner" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <span class="qodef-post-content-overlay">
                        <span aria-hidden="true" class="arrow_carrot-right"></span>
                    </span>
                    <div class="qodef-post-image">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                    <div class="qodef-post-text">
                        <h4 class="qodef-post-title"><?php the_title(); ?></h4>
                        <div class="post_info">
                            <span class="time">
								<span><?php the_time(get_option('date_format')); ?></span>
							</span>
                            <?php if($blog_hide_author == "no") { ?>
                                <span class="post_author">
									<span><?php _e('By', 'qode'); ?></span>
                                    <span><?php the_author_meta('display_name'); ?></span>
								</span>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>
        </article>
        <?php
        break;
    case "gallery":
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="qodef-post-content">
                <a class="qodef-post-content-inner" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <span class="qodef-post-content-overlay">
                        <span aria-hidden="true" class="arrow_carrot-right"></span>
                    </span>
                    <div class="qodef-post-image">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                    <div class="qodef-post-text">
                        <h4 class="qodef-post-title"><?php the_title(); ?></h4>
                        <div class="post_info">
                            <span class="time">
								<span><?php the_time(get_option('date_format')); ?></span>
							</span>
                            <?php if($blog_hide_author == "no") { ?>
                                <span class="post_author">
									<span><?php _e('By', 'qode'); ?></span>
                                    <span><?php the_author_meta('display_name'); ?></span>
								</span>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>
        </article>
        <?php
        break;
    case "link":
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="qodef-post-content">
                <a class="qodef-post-content-inner" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <span class="qodef-post-content-overlay">
                        <span aria-hidden="true" class="arrow_carrot-right"></span>
                    </span>
                    <div class="qodef-post-image">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                    <div class="qodef-post-text">
                        <h4 class="qodef-post-title"><?php the_title(); ?></h4>
                        <div class="post_info">
                            <span class="time">
								<span><?php the_time(get_option('date_format')); ?></span>
							</span>
                            <?php if($blog_hide_author == "no") { ?>
                                <span class="post_author">
									<span><?php _e('By', 'qode'); ?></span>
                                    <span><?php the_author_meta('display_name'); ?></span>
								</span>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>
        </article>
        <?php
        break;
    case "quote":
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="qodef-post-content">
                <a class="qodef-post-content-inner" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <span class="qodef-post-content-overlay">
                        <span aria-hidden="true" class="arrow_carrot-right"></span>
                    </span>
                    <div class="qodef-post-image">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                    <div class="qodef-post-text">
                        <h4 class="qodef-post-title"><?php echo get_post_meta(get_the_ID(), "quote_format", true); ?></h4>
                        <div class="post_info">
                            <span class="time">
								<span><?php the_time(get_option('date_format')); ?></span>
							</span>
                            <?php if($blog_hide_author == "no") { ?>
                                <span class="post_author">
									<span><?php _e('By', 'qode'); ?></span>
                                    <span><?php the_author_meta('display_name'); ?></span>
								</span>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>
        </article>
        <?php
        break;
    default:
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="qodef-post-content">
                <a class="qodef-post-content-inner" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <span class="qodef-post-content-overlay">
                        <span aria-hidden="true" class="arrow_carrot-right"></span>
                    </span>
                    <div class="qodef-post-image">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                    <div class="qodef-post-text">
                        <h4 class="qodef-post-title"><?php the_title(); ?></h4>
                        <div class="post_info">
                            <span class="time">
								<span><?php the_time(get_option('date_format')); ?></span>
							</span>
                            <?php if($blog_hide_author == "no") { ?>
                                <span class="post_author">
									<span><?php _e('By', 'qode'); ?></span>
                                    <span><?php the_author_meta('display_name'); ?></span>
								</span>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>
        </article>
    <?php
}
?>