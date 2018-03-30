<?php
/**
 * The template for displaying Search Results pages.
 */

get_header(); 
global $bk_option;
if (isset($bk_option) && ($bk_option != '')): 
    $bk_video_thumb = $bk_option['bk-video-thumb'];
    $bk_layout = $bk_option['bk-archive-layout'];
endif;
if ($bk_layout == 'grid-2') {
    $col = 2;    
} else if ($bk_layout == 'grid-3') {
    $col = 3;
}
?>
<div class="bk-archive-content content <?php if (!($bk_layout == 'masonry-3') && !($bk_layout == 'card') && !($bk_layout == 'grid-3')): echo 'has-sidebar'; endif;?>">
    <?php if (have_posts()): ?>
		<div class="heading-wrap">
			<h2 class="heading"><?php printf( __( 'Search Results for: %s', 'bkninja' ), get_search_query() ); ?></h2>
            <hr />
		</div>
        <?php
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
        ?>
    <?php else: ?>
        <div class="heading-wrap">
			<h2 class="heading"><?php printf( __( 'No Result for: %s', 'bkninja' ), get_search_query() ); ?></h2>
            <hr />
		</div>
        <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'bkninja' ); ?></p>
        <div class="search-form">
           <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
</div>
<?php
if (!($bk_layout == 'masonry-3') && !($bk_layout == 'card') && !($bk_layout == 'grid-3')) {
    get_sidebar();
}
?>

<?php get_footer(); ?>