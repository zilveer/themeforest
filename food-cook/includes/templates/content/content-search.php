<?php
// File Security Check
if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die('You do not have sufficient permissions to access this page!');
}
?>
<?php
/**
 * Post Content Template
 *
 * This template is the default page content template. It is used to display the content of the
 * `single.php` template file, contextually, as well as in archive lists or search results.
 *
 * @package WooFramework
 * @subpackage Template
 */
/**
 * Settings for this template file.
 *
 * This is where the specify the HTML tags for the title.
 * These options can be filtered via a child theme.
 *
 * @link http://codex.wordpress.org/Plugin_API#Filters
 */
global $woo_options;

$title_before = '<h1 class="title">';
$title_after = '</h1>';

if (!is_single()) {
    $title_before = '<h2 class="title"><a href="' . get_permalink(get_the_ID()) . '" rel="bookmark" title="' . the_title_attribute(array('echo' => 0)) . '">';
    $title_after = '</a></h2>';
}

$page_link_args = apply_filters('woothemes_pagelinks_args', array('before' => '<div class="page-link">' . __('Pages:', 'woothemes'), 'after' => '</div>'));

woo_post_before();
?>
<div <?php post_class(); ?>>
    <?php
    woo_post_inside_before();
    if (isset($woo_options['woo_post_content']) AND $woo_options['woo_post_content'] != 'content' AND ! is_singular())
        get_the_image(array(
            'order' => array('featured', 'default'),
            'featured' => true,
            'default' => esc_url(get_template_directory_uri() . '/includes/assets/images/image.jpg'),
            'size' => 'thumbnail-blog',
            'image_class' => 'aligncenter',
            'width' => 610,
            'height' => 300,
            'link_to_post' => true
        ));
    the_title($title_before, $title_after);
    woo_post_meta();
    ?>
    <div class="entry">
        <?php
        the_excerpt();
        ?>
    </div><!-- /.entry -->
    <div class="fix"></div>
    <?php
    woo_post_inside_after();
    ?>
</div><!-- /.post -->
<?php
woo_post_after();
$comm = '';
if (isset($woo_options['woo_comments'])) {
    $comm = $woo_options['woo_comments'];
}

if (( $comm == 'post' || $comm == 'both' ) && is_single()) {
    comments_template();
}
?>