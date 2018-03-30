<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 */
$g5plus_archive_loop = &G5Plus_Global::get_archive_loop();
$g5plus_options = &G5Plus_Global::get_options();

$size = 'full';
if (isset($g5plus_archive_loop['image-size'])) {
    $size = $g5plus_archive_loop['image-size'];
}

$archive_style = 'large-image';
if (isset($g5plus_archive_loop['style']) && !empty($g5plus_archive_loop['style'])) {
    $archive_style  = $g5plus_archive_loop['style'];
}

$archive_display_type = isset($_GET['style']) ? $_GET['style'] : '';
if (!in_array($archive_display_type, array('list','masonry'))) {
    $archive_display_type = $g5plus_options['archive_display_type'];
}




$class = array();
$class[]= "clearfix";
$iconClass_format = "";
switch(get_post_format()) {
    case 'image' :
        $iconClass_format = "fa fa-file-image-o";
        break;
    case 'gallery':
        $iconClass_format = "fa fa-file-image-o";
        break;
    case 'video':
        $iconClass_format = "fa fa-play-circle-o";
        break;
    case 'audio':
        $iconClass_format = "fa fa-microphone";
        break;
    case 'aside':
        $iconClass_format = "fa fa-file-o";
        break;
    default:
        $iconClass_format = "fa fa-file-text-o";
        break;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <?php
    $thumbnail = g5plus_post_thumbnail($size, $showDate);
    if (!empty($thumbnail)) : ?>
        <div class="entry-thumbnail-wrap">
            <?php echo wp_kses_post($thumbnail);?>
            <?php if(!$showDate):?>
                <div class="entry-format-date">
                    <span class="entry-icon-format">
                        <i class="<?php echo esc_attr($iconClass_format)?>"></i>
                    </span>
                    <span class="entry-date">
                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"> <?php echo  get_the_date(get_option('date_format'));?> </a>
                    </span>
                </div>
            <?php endif;?>
        </div>
    <?php endif; ?>
    <div class="entry-content-wrap">
        <h3 class="entry-post-title p-font">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="entry-excerpt">
            <?php the_excerpt(); ?>
        </div>
        <div class="entry-post-meta-wrap">
            <?php g5plus_post_meta(); ?>
        </div>
    </div>
</article>


