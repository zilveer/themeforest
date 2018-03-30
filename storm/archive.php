<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
?>
<?php
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
		<div class="heading-wrap">
			<h2 class="heading"><?php

				$var = get_query_var('post_format');
				// POST FORMATS
				if ($var == 'post-format-image') :
					_e('Image ', 'bkninja');
				elseif ($var == 'post-format-gallery') :
					_e('Gallery ', 'bkninja');
				elseif ($var == 'post-format-video') :
					_e('Video ', 'bkninja');
				elseif ($var == 'post-format-audio') :
					_e('Audio ', 'bkninja');
				endif;

				if ( is_day() ) :
					printf( __( 'Daily Archives: %s', 'bkninja' ), get_the_date() );
				elseif ( is_month() ) :
					printf( __( 'Monthly Archives: %s', 'bkninja' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'bkninja' ) ) );
				elseif ( is_year() ) :
					printf( __( 'Yearly Archives: %s', 'bkninja' ), get_the_date( _x( 'Y', 'yearly archives date format', 'bkninja' ) ) );
				elseif ( is_tag() ) :
                    printf( __( 'Tag: %s', 'bkninja' ), single_tag_title('',false) );
                else :
					_e( 'Archives', 'bkninja' );
				endif;
			?></h2>
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