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

wp_reset_query();
$page_id = ( !is_null( get_the_ID() ) ) ? get_the_ID() : '';
$args = array(
    'post_type' => 'services',
    'page_id' => $page_id
);

$args['posts_per_page'] = 1;

$services = new WP_Query( $args );   

get_header();
do_action( 'yit_before_primary' ) ;

if( $services->have_posts() )
	yit_single_service();

do_action( 'yit_after_primary' );
get_footer() ?>