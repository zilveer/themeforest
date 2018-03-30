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
  

$nav_args = array(
    'theme_location' => 'nav',
    'container' => 'none',
    'menu_class' => 'level-1',
    'depth' => apply_filters( 'yit_main_nav_depth', 3 ),
    //'fallback_fb' => false,
    //'walker' => new YIT_Walker_Nav_Menu()
);


if ( has_nav_menu( 'nav' ) )
    $nav_args['walker'] = new YIT_Walker_Nav_Menu();

wp_nav_menu( $nav_args );
