<?php if(! defined('ABSPATH')){ return; }
/**
 * Displays the layout for the post type PAGE, inside page.php
 * @internal
 * @see page-content-template.inc.php
 */


$image = '';
if ( has_post_thumbnail() && !post_password_required() ) {
    $thumb   = get_post_thumbnail_id();
    $f_image = wp_get_attachment_url( $thumb );
    if ( $f_image ) {

        $featured_image = wp_get_attachment_image_src($thumb, 'full');
        if(isset($featured_image[0]) && !empty($featured_image[0])) {
            $image = '<div class="zn_page_image kl-blog-page-image"><a data-lightbox="image" href="' . $featured_image[0] . '" class="hoverBorder full-width kl-blog-page-image-link" style="margin-bottom:4px;"><img class="kl-blog-page-img" src="' . $featured_image[0] . '" '.ZngetImageSizesFromUrl($featured_image[0], true).' alt="'. ZngetImageAltFromUrl( $featured_image[0] ) .'" title="'. ZngetImageTitleFromUrl( $featured_image[0] ) .'" /></a></div>';
        }

    }
}

echo '<div class="zn_content kl-blog-page-content">';

    // TITLE
    $page_title_show = get_post_meta( get_the_ID(), 'zn_page_title_show', true );

    if( !empty( $page_title_show ) && $page_title_show == 'yes' ){
        echo '<h1 class="page-title kl-blog-page-title" '.WpkPageHelper::zn_schema_markup('title').'>' . get_the_title() . '</h1>';
    }

?>
        <div class="itemBody kl-blog-page-body">
            <!-- Blog Image -->
            <?php echo $image; ?>
            <!-- Blog Content -->
            <?php the_content(); ?>

        </div>
<?php

echo '</div>';
