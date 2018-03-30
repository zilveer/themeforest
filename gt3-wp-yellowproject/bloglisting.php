<?php
$pf = get_post_format();
if (empty($pf)) $pf = "default";
$pfIcon = get_pf_icon($pf);
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$gt3_pagebuilder = get_theme_pagebuilder(get_the_ID());
?>
<div <?php post_class("blog_post_preview"); ?>>
    <div class="blogpost_title">
        <a href="<?php the_permalink(); ?>" class="mainTitlePermalink"><h4><?php the_title(); ?></h4></a>
    </div>
    <div class="blog_info">
        <span class="blog_posttype <?php echo $pfIcon; ?>"></span>
        <div class="blog_info_block">
            <span class="author_name">Posted by: <?php the_author_posts_link(); ?></span>
            <span class="category">In: <?php the_category(', '); ?></span>
            <span class="date"><?php the_time("d M Y") ?></span>
            <span class="comments"><a href="<?php echo get_comments_link(); ?>"><?php echo ((get_theme_option("translator_status") == "enable") ? get_text("comments_number") : __('Comments','theme_localization')).": "; echo comments_number( '0', '1', '%' ); ?></a></span>
            <?php the_tags("<span class='blog_tags'>".((get_theme_option("translator_status") == "enable") ? get_text("tags_caption") : __('Tags: ','theme_localization')), ', ', '</span>'); ?>
        </div>
    </div>
    <?php include ("ext/pf_type1.php"); ?>
    <article class="contentarea">
        <?php
        global $more;
        $more = 0;
        the_content(((get_theme_option("translator_status") == "enable") ? get_text("read_more_link") : __('Read more...','theme_localization')));
        ?>
    </article>
    <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . ((get_theme_option("translator_status") == "enable") ? get_text("translate_pages") : __('Pages','theme_localization')) . ': </span>', 'after' => '</div>' ) ); ?>
</div><!-- .blog_post_preview -->