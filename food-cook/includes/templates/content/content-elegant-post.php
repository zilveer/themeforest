<?php
// File Security Check
if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) :
    die('You do not have sufficient permissions to access this page!');
endif;

/**
 * Medium Post Content Template
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

if (!is_single()) :
    $title_before = '<h2 class="title"><a href="' . esc_url(get_permalink(get_the_ID())) . '" rel="bookmark" title="' . esc_attr(the_title_attribute(array('echo' => 0))) . '">';
    $title_after = '</a></h2>';
endif;

$page_link_args = apply_filters('woothemes_pagelinks_args', array('before' => '<div class="page-link">' . __('Pages : ', 'woothemes'), 'after' => '</div>'));

woo_post_before();
?>

<div <?php post_class(); ?>>

    <div class="elegant-post-meta">
        <div class="meta"> 
            <abbr class="time published" title=<?php echo get_the_time('Y-m-d\TH:i:sO'); ?>>
                <span class="small day"><?php the_time('d'); ?></span>
                <span class="small month"><?php the_time('M'); ?> <?php the_time('o'); ?></span>
            </abbr>
            <div class="meta-divider"></div>		
        </div>
    </div>

    <div class="entry">
        <?php woo_post_inside_before(); ?>

        <?php if (isset($woo_options['woo_post_content']) && $woo_options['woo_post_content'] != 'content' && !is_singular()) : ?>
            <?php
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
            ?>
        <?php endif; ?>

        <?php the_title($title_before, $title_after); ?>
        <?php woo_elegant_post_meta(); ?>

        <?php
        if (isset($woo_options['woo_post_content']) && ( $woo_options['woo_post_content'] == 'content' || is_single() )) :
            the_content(__('Read More &rarr;', 'woothemes'));
        else :
            the_excerpt();
        endif;

        if (isset($woo_options['woo_post_content']) && ( $woo_options['woo_post_content'] == 'content' || is_singular() )) :
            wp_link_pages($page_link_args);
        endif;
        ?>
        <?php woo_post_inside_after(); ?>
    </div><!-- /.entry -->

    <div class="fix"></div>

</div><!-- /.post -->

<?php
woo_post_after();
$comm = '';

if (isset($woo_options['woo_comments'])) :
    $comm = $woo_options['woo_comments'];
endif;

if (( $comm == 'post' || $comm == 'both' ) && is_single()) :
    comments_template();
endif;