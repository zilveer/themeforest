<?php
/**
 * The template for displaying Author archive pages
 *
 */
 ?> 
<?php get_header();?>
<?php
if ($post == NULL) {
    $bk_author_id = $author;
} else {
    $bk_author_id = $post->post_author; 
}

$bk_author_name = get_the_author_meta('display_name', $bk_author_id); 
if (isset($bk_option) && ($bk_option != '')): 
    $bk_video_thumb = $bk_option['bk-video-thumb'];
    $bk_layout = $bk_option['bk-author-layout'];
endif;
if ($bk_layout == 'grid-2') {
    $col = 2;    
} else if ($bk_layout == 'grid-3') {
    $col = 3;
}
?>
   			
<div class="bk-author-content content <?php if (!($bk_layout == 'masonry-3') && !($bk_layout == 'card') && !($bk_layout == 'grid-3')): echo 'has-sidebar'; endif;?>">
    
    <?php echo bk_author_details($bk_author_id); ?>

    <div id="main-content" class="clear-fix" role="main">
		
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

	</div> <!-- end #main -->

</div> <!-- end #bk-content -->

<?php
if (!($bk_layout == 'masonry-3') && !($bk_layout == 'card') && !($bk_layout == 'grid-3')) {
    get_sidebar();
}
?>
<?php get_footer(); ?>
