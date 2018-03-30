<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="meta clearfix row services single">
        <div class="col-sm-12">
            <h1><?php the_title();?></h1>

            <?php the_content(); ?>
        </div>
    </div>
</div>