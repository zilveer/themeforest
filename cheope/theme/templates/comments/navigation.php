<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
?>
<div class="navigation">
	<div class="nav-previous"><?php previous_comments_link( apply_filters( 'yit_previous_comments_text', __( '<span class="meta-nav">&larr;</span> Older Comments', 'yit' ) ) ); ?></div>
	<div class="nav-next"><?php next_comments_link( apply_filters( 'yit_next_comments_text', __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'yit' ) ) ); ?></div>
</div>