<?php
/**
 * @author Stylish Themes
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'haze_page_title' ) ) :

    function haze_page_title() {
        ?>
                <h1>
                    <?php

                    if (is_home()) :

                        _e('Welcome to <strong>Clubix</strong>', LANGUAGE_ZONE);

                    elseif (is_page()) :

                        the_title();

                    elseif (is_tag()) : ?>

                        <?php _e('Posts in ', LANGUAGE_ZONE);?> <strong><?php echo single_cat_title(); ?></strong>

                    <?php elseif (is_category()) : ?>

                        <?php _e('Posts in ', LANGUAGE_ZONE);?> <strong><?php echo single_cat_title(); ?></strong>

                    <?php elseif (is_tax(AlbumPostType::get_instance()->postTypeTag)) : ?>

                        <?php _e('Albums in ', LANGUAGE_ZONE);?> <strong><?php echo single_cat_title('' , false); ?></strong>

                    <?php elseif (is_search()) : ?>

                        <?php _e('Search results for ', LANGUAGE_ZONE);?> <strong><?php echo get_search_query(); ?></strong>

                    <?php
                        endif;
                    ?>
                </h1>
    <?php
    }

endif;

if ( ! function_exists( 'haze_pagination' ) ) :

    add_action('clubix_after_posts_loop', 'haze_pagination', 10, 3);

    function haze_pagination( $query, $pages = '', $range = 2 ) {
        ?>
        <!-- ========== START PAGINATION ========== -->
        <?php
        $showitems = ($range * 2)+1;

        global $paged;
        if(empty($paged)) $paged = 1;

        if($pages == '')
        {
            $pages = $query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }

        if(1 != $pages)
        {
            echo '<div class="row"><div class="col-sm-12"><ul class="pagination">';
            if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
            if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                {
                    echo ($paged == $i)? "<li class='active'><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
                }
            }

            if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
            echo "</ul></div></div>\n";
        }
        ?>
        <!-- ========== END PAGINATION ========== -->
    <?php
    }

endif;