<?php

/**
 * template part for portfolio single portfolio-single.php. views/portfolio/components
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.0.0
 */

global $mk_options;

if (have_posts()) while (have_posts()):
    the_post();
    
    do_action('portfolio_single_before_meta');
    
    mk_get_view('portfolio/components', 'portfolio-single-meta');
    
    mk_get_view('portfolio/components', 'portfolio-single-featured');
    
    do_action('portfolio_single_before_the_content');
    
    the_content();
    
    do_action('portfolio_single_after_the_content');
    
    mk_get_view('portfolio/components', 'portfolio-single-comments');
    
    do_action('portfolio_single_after_comments');
endwhile;
?>
