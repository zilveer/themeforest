<?php 
/**
 * The template for displaying Category pages.
 *
 */

get_header(); 
global $bk_option;
if (isset($bk_option) && ($bk_option != '')): 
    $bk_video_thumb = $bk_option['bk-video-thumb'];
    $bk_cat_layout = $bk_option['bk-category-layout'];
endif;
$cat_id = $wp_query->get_queried_object_id();
$cat_layout = '';
$cat_feat = '';
$cat_opt = array();
$meta = array();
$meta = get_option('bk_cat_opt');
if (array_key_exists($cat_id,$meta)) {$cat_opt = $meta[$cat_id]; };
if (array_key_exists('cat_layout',$cat_opt)) { $cat_layout = $cat_opt['cat_layout'];};
if (array_key_exists('cat_feat',$cat_opt)) { $cat_feat = $cat_opt['cat_feat'];};

if (($cat_layout == '')||($cat_layout == 'global')) { $cat_layout = $bk_cat_layout;};
if ($cat_feat == '') { $cat_feat = 0;};
if ($cat_layout == 'grid-2') { $col = 2;} else if ($cat_layout == 'grid-3') { $col = 3;};
?>
<div class="bk-archive-content content <?php if (!($cat_layout == 'masonry-3') && !($cat_layout == 'card') && !($cat_layout == 'grid-3')): echo 'has-sidebar'; endif;?>">
		<div class="heading-wrap">
			<h2 class="heading"><?php single_cat_title();?></h2>
            <hr />
            <?php if ( category_description() ) : // Show an optional category description ?>
				    <div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif;?>
		</div>
        <?php 
        if (have_posts()) { 
            if ($cat_feat) {get_template_part('/library/cat_feat_slider');}

            if ($cat_layout == 'classic-small') {
                echo '<div class="archive-classic-small">';
                    display_archive_classic_small_style($bk_video_thumb);
                echo '</div>';
            } else if (($cat_layout == 'masonry-3') || ($cat_layout == 'masonry-2')) {
                echo '<div class="archive-masonry">';
                    display_archive_masonry_style($bk_video_thumb);
                echo '</div>';
            } else if ($cat_layout == 'classic-big') {
                echo '<div class="archive-classic-big">';
                    display_archive_classic_big_style($bk_video_thumb);
                echo '</div>';
            } else if (($cat_layout == 'grid-2')||($cat_layout == 'grid-3')) {
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
if (!($cat_layout == 'masonry-3') && !($cat_layout == 'card') && !($cat_layout == 'grid-3')) {
    get_sidebar();
}
?>

<?php get_footer(); ?>