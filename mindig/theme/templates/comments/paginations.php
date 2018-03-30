<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-below" class="row navigation comment-navigation" role="navigation">
        <div class="nav-previous col-sm-6">
            <?php previous_comments_link( __( '&larr; Older Comments', 'yit' ) ); ?>
        </div>
        <div class="nav-next col-sm-6">
            <?php next_comments_link( __( 'Newer Comments &rarr;', 'yit' ) ); ?>
        </div>
    </nav>
<?php endif; ?>