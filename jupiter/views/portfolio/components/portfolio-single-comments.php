<?php

/**
 * template part for portfolio single content single.php. views/portfolio/components
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.0.0
 */

global $mk_options;

if ($mk_options['enable_portfolio_comment'] == 'true') {
    
    comments_template('', true);
    
}
