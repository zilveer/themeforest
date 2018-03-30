<?php 
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */
get_header();
global $bk_option;
if (isset($bk_option) && ($bk_option != '')): 
    $bk_video_thumb = $bk_option['bk-video-thumb'];
    $bk_layout = $bk_option['bk-blog-layout'];
endif;
if ($bk_layout == 'grid-2') {
    $col = 2;    
} else if ($bk_layout == 'grid-3') {
    $col = 3;
}
?>

<div class="bk-archive-content content <?php if (!($bk_layout == 'masonry-3') && !($bk_layout == 'card') && !($bk_layout == 'grid-3')): echo 'has-sidebar'; endif;?>">
		<div class="heading-wrap">
			<h2 class="heading"><?php _e('Latest Articles', 'bkninja') ?></h2>
            <hr />
		</div>
        <?php 
        if (have_posts()) { 
            if ($bk_layout == 'classic-small') {
                echo '<div class="archive-classic-small">';
                    display_archive_classic_small_style($bk_video_thumb);
                echo '</div>';
            } else if (($bk_layout == 'masonry-3') || ($bk_layout == 'masonry-2')) {
                echo '<div class="archive-masonry">';
                    display_archive_masonry_style($bk_video_thumb);
                echo '</div>';
            } else if ($bk_layout == 'classic-big') {
                echo '<div class="archive-classic-big">';
                    display_archive_classic_big_style($bk_video_thumb);
                echo '</div>';
            } else if (($bk_layout == 'grid-2')||($bk_layout == 'grid-3')) {
                echo '<div class="archive-grid">';
                    display_archive_grid_style($col);
                echo '</div>';
            } else {
                echo '<div class="archive-card">';
                    display_archive_card_style($bk_video_thumb);
                echo '</div>';
            }
        } else { _e('No post to display','bkninja');} ?>
</div>
<?php
if (!($bk_layout == 'masonry-3') && !($bk_layout == 'card') && !($bk_layout == 'grid-3')) {
    get_sidebar();
}
?>

<?php get_footer(); ?>	