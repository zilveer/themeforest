<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for shows popular posts
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

echo do_shortcode('[recentpost items="' . $items . '" cat_name="' . $cat_name . '" excerpt="' . $excerpt . '" date="' . $date . '" author="' . $author . '" comments="' . $comments . '" showthumb="' . $showthumb . '" popular="yes" date="' . $date . '" excerpt_length="' . $excerpt_length .'" readmore="' . $readmore . '" animation_delay="' . $animation_delay . '" animate="' . $animate . '"]');