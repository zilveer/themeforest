<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$blog_type = is_singular( 'post' ) ? 'single_' . $blog_type : $blog_type;
?>

<?php if ( $show_date ) : ?>
    <div class="yit_post_meta_date">
        <span class="day">
            <?php echo get_the_date( 'd' ) ?>
        </span>

        <span class="month">
            <?php echo get_the_date( 'M' ) ?>
        </span>
    </div>
<?php endif; ?>

<div class="yit_the_content">
    <?php  ( true == $show_read_more ) ? the_content( $read_more_text ) : the_excerpt(); ?>
</div>

<?php if ( $show_title ) : ?>
    <?php yit_string( "<h3 class='post-title'><a href='{$link}'>", $title, "</a></h3>" ); ?>
<?php endif; ?>